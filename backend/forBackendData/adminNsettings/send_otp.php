<?php
header('Content-Type: application/json');
session_start();

include("../../database/config.php");
require '../../../vendor/autoload.php'; // Adjust path for PHPMailer

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

if (!isset($_SESSION['users_id'])) {
    echo json_encode(['success' => false, 'message' => 'Unauthorized']);
    exit;
}

$users_id = $_SESSION['users_id'];

// Get sponsor email
$sql = "SELECT 
            u.email,
            CONCAT(
                u.first_name, ' ',
                COALESCE(u.middle_name, ''), ' ',
                u.last_name
            ) AS full_name
        FROM users u
        WHERE u.users_id = ?";

$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $users_id);
$stmt->execute();

$result = $stmt->get_result();
$users = $result->fetch_assoc();

$stmt->close();

if ($users) {
    $users['full_name'] = trim(preg_replace('/\s+/', ' ', $users['full_name']));
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

    $mail->setFrom("bobbycuen@gmail.com", 'Admin Platform Security');
    $mail->addAddress($users['email'], $users['full_name']);

    $mail->isHTML(true);
    $mail->Subject = "Profile Update Verification Code";
    $mail->Body    = "Hello {$users['full_name']},<br><br>You requested to update your profile. Please use the following OTP to confirm your changes:<br><br><h2 style='color:#3b82f6; letter-spacing: 3px;'>{$otp}</h2><br><br>If you did not request this, please ignore this email.";

    $mail->send();
    echo json_encode(['success' => true, 'message' => 'OTP Sent']);
} catch (Exception $e) {
    echo json_encode(['success' => false, 'message' => 'Mailer Error: ' . $mail->ErrorInfo]);
}
