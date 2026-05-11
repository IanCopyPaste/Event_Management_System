<?php
header('Content-Type: application/json');
session_start();

// 1. Include your database config (This provides $conn, and assuming $app_pass & $smtp_email are here)
include("../../../database/config.php"); 

// 2. Include PHPMailer (Adjust the path based on your setup)
// If using Composer:
require '../../../../vendor/autoload.php'; 
// If installed manually, uncomment these:
// require '../../../PHPMailer/src/Exception.php';
// require '../../../PHPMailer/src/PHPMailer.php';
// require '../../../PHPMailer/src/SMTP.php';

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

// Check auth
if (!isset($_SESSION['sponsor_id'])) {
    echo json_encode(["success" => false, "message" => "Unauthorized."]);
    exit;
}

// Read JSON input
$data = json_decode(file_get_contents("php://input"), true);
$package_id = $data['package_id'] ?? null;
$new_status = $data['status'] ?? null;
$sponsor_id = $_SESSION['sponsor_id'];

if (!$package_id || !in_array($new_status, ['ongoing', 'onhold'])) {
    echo json_encode(["success" => false, "message" => "Invalid data provided."]);
    exit;
}

// --- STEP 1: Update the Status in the Database ---
$update_sql = "UPDATE packages SET status = ? WHERE package_id = ? AND sponsor_id = ?";
$stmt = $conn->prepare($update_sql);
$stmt->bind_param("sii", $new_status, $package_id, $sponsor_id);

if (!$stmt->execute()) {
    echo json_encode(["success" => false, "message" => "Database error during update."]);
    $stmt->close();
    $conn->close();
    exit;
}
$stmt->close();

// --- STEP 2: Fetch Data needed for the Email ---
$fetch_sql = "SELECT 
                p.package_name, 
                e.event_name, 
                o.org_name, 
                o.org_email 
              FROM packages p
              INNER JOIN events e ON p.event_id = e.event_id
              INNER JOIN organizations o ON e.org_id = o.org_id
              WHERE p.package_id = ? AND p.sponsor_id = ?";

$stmt = $conn->prepare($fetch_sql);
$stmt->bind_param("ii", $package_id, $sponsor_id);
$stmt->execute();
$result = $stmt->get_result();
$details = $result->fetch_assoc();
$stmt->close();

// If we somehow didn't find the details, just return success for the update and skip the email
if (!$details || empty($details['org_email'])) {
    echo json_encode(["success" => true, "message" => "Status updated, but could not send email (missing details)."]);
    $conn->close();
    exit;
}

// --- STEP 3: Setup and Send the Email via PHPMailer ---
$mail = new PHPMailer(true);

try {
    // Server settings
    $mail->isSMTP();
    $mail->Host       = 'smtp.gmail.com'; // Change if not using Gmail
    $mail->SMTPAuth   = true;
    
    // Make sure $smtp_email and $app_pass are defined in your config.php
    $mail->Username   = "bobbycuen@gmail.com"; 
    $mail->Password   = $app_pass;   
    $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS; 
    $mail->Port       = 587; 

    // Recipients
    $mail->setFrom("bobbycuen@gmail.com", 'Sponsorship Platform'); // Change generic name if needed
    $mail->addAddress($details['org_email'], $details['org_name']);

    // Status logic for the email body
    if ($new_status === 'ongoing') {
        $statusText = "Ongoing";
        $explanation = "The sponsor is actively fulfilling their commitments and proceeding with the sponsorship arrangements.";
        $color = "#10b981"; // Emerald green
    } else {
        $statusText = "On-Hold";
        $explanation = "The sponsor has temporarily paused the progression of this package. This could be due to a need for further clarification, pending internal approvals, or scheduling adjustments. Please reach out to them if you need more details.";
        $color = "#f59e0b"; // Amber/Orange
    }

    // Email Content (HTML)
    $mail->isHTML(true);
    $mail->Subject = "Sponsorship Update: {$details['package_name']} is now {$statusText}";
    
    // Build a nice looking HTML email
    $mail->Body = "
    <div style='font-family: Arial, sans-serif; max-width: 600px; margin: 0 auto; border: 1px solid #e2e8f0; border-radius: 8px; padding: 20px;'>
        <h2 style='color: #1e293b; border-bottom: 2px solid #f1f5f9; padding-bottom: 10px;'>Sponsorship Status Update</h2>
        
        <p style='color: #475569; font-size: 16px;'>Hello <strong>{$details['org_name']}</strong>,</p>
        
        <p style='color: #475569; font-size: 16px;'>There has been an update regarding a sponsorship package for your event, <strong>{$details['event_name']}</strong>.</p>
        
        <div style='background-color: #f8fafc; padding: 15px; border-left: 4px solid {$color}; margin: 20px 0;'>
            <p style='margin: 0 0 10px 0; font-size: 15px;'><strong>Package Name:</strong> {$details['package_name']}</p>
            <p style='margin: 0; font-size: 15px;'><strong>New Live Status:</strong> <span style='color: {$color}; font-weight: bold; text-transform: uppercase;'>{$statusText}</span></p>
        </div>
        
        <h3 style='color: #1e293b; margin-top: 25px;'>What does this mean?</h3>
        <p style='color: #475569; font-size: 15px; line-height: 1.5;'>{$explanation}</p>
        
        <p style='color: #94a3b8; font-size: 13px; margin-top: 30px; border-top: 1px solid #e2e8f0; padding-top: 15px;'>
            This is an automated message. You can log into your organizer dashboard to view more details.
        </p>
    </div>";

    // Fallback plain-text body
    $mail->AltBody = "Hello {$details['org_name']},\n\nThe sponsorship package '{$details['package_name']}' for your event '{$details['event_name']}' has been marked as {$statusText}.\n\nWhat this means: {$explanation}\n\nPlease check your organizer dashboard for details.";

    // Send the email
    $mail->send();
    
    // Return total success to the frontend
    echo json_encode(["success" => true, "message" => "Status updated to {$statusText} and the organizer has been notified!"]);

} catch (Exception $e) {
    // If update worked but email failed, let the user know
    echo json_encode([
        "success" => true, 
        "message" => "Status updated successfully, but the notification email could not be sent. Mailer Error: {$mail->ErrorInfo}"
    ]);
}

$conn->close();
?>