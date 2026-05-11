<?php
header('Content-Type: application/json');
session_start();

include("../../database/config.php"); 
require '../../../vendor/autoload.php'; // Adjust path for PHPMailer

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

if (!isset($_SESSION['org_id'])) {
    echo json_encode(['success' => false, 'message' => 'Unauthorized']);
    exit;
}

$org_id = $_SESSION['org_id'];

// Get sponsor email
$sql = "SELECT org_email, org_name FROM organizations WHERE org_id = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $org_id);
$stmt->execute();
$result = $stmt->get_result();
$org = $result->fetch_assoc();
$stmt->close();

if (!$org) {
    echo json_encode(['success' => false, 'message' => 'Sponsor not found']);
    exit;
}

// Generate a 6-digit OTP
$otp = rand(100000, 999999);

// Store it in session for verification later
$_SESSION['profile_update_otp'] = $otp;

// Send the Email
$mail = new PHPMailer(true);

try {
    $mail->isSMTP();
    $mail->Host       = 'smtp.gmail.com'; 
    $mail->SMTPAuth   = true;
    $mail->Username   = "bobbycuen@gmail.com"; 
    $mail->Password   = $app_pass;   
    $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS; 
    $mail->Port       = 587; 

    $mail->setFrom("bobbycuen@gmail.com", 'Organization Platform Security');
    $mail->addAddress($org['org_email'], $org['org_name']);

    $mail->isHTML(true);
    $mail->Subject = "Profile Update Verification Code";
    $mail->Body    = "Hello {$org['org_name']},<br><br>You requested to update your profile. Please use the following OTP to confirm your changes:<br><br><h2 style='color:#3b82f6; letter-spacing: 3px;'>{$otp}</h2><br><br>If you did not request this, please ignore this email.";
    
    $mail->send();
    echo json_encode(['success' => true, 'message' => 'OTP Sent']);

} catch (Exception $e) {
    echo json_encode(['success' => false, 'message' => 'Mailer Error: ' . $mail->ErrorInfo]);
}
?>