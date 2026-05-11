<?php
header('Content-Type: application/json');
session_start();

include("../../../database/config.php"); 
require '../../../../vendor/autoload.php'; // Adjust path for PHPMailer

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

if (!isset($_SESSION['sponsor_id'])) {
    echo json_encode(['success' => false, 'message' => 'Unauthorized']);
    exit;
}

$sponsor_id = $_SESSION['sponsor_id'];

// Get sponsor email
$sql = "SELECT sponsor_email, company_name FROM sponsorships WHERE sponsor_id = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $sponsor_id);
$stmt->execute();
$result = $stmt->get_result();
$sponsor = $result->fetch_assoc();
$stmt->close();

if (!$sponsor) {
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

    $mail->setFrom("bobbycuen@gmail.com", 'Sponsorship Platform Security');
    $mail->addAddress($sponsor['sponsor_email'], $sponsor['company_name']);

    $mail->isHTML(true);
    $mail->Subject = "Profile Update Verification Code";
    $mail->Body    = "Hello {$sponsor['company_name']},<br><br>You requested to update your profile. Please use the following OTP to confirm your changes:<br><br><h2 style='color:#3b82f6; letter-spacing: 3px;'>{$otp}</h2><br><br>If you did not request this, please ignore this email.";
    
    $mail->send();
    echo json_encode(['success' => true, 'message' => 'OTP Sent']);

} catch (Exception $e) {
    echo json_encode(['success' => false, 'message' => 'Mailer Error: ' . $mail->ErrorInfo]);
}
?>