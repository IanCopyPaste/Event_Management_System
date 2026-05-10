<?php
session_start();

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require '../../../vendor/autoload.php';
include("../../database/config.php");

header("Content-Type: application/json");

// 1. Get the raw JSON data from the fetch request
$data = json_decode(file_get_contents("php://input"), true);

if (!$data) {
    echo json_encode(["status" => false, "message" => "Invalid Request"]);
    exit;
}

$mail = new PHPMailer(true);

try {
    // 2. SMTP Configuration
    $mail->isSMTP();
    $mail->Host       = 'smtp.gmail.com';
    $mail->SMTPAuth   = true;
    $mail->Username   = 'bobbycuen@gmail.com';
    $mail->Password   = $app_pass; // Ensure this is defined in your config.php
    $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
    $mail->Port       = 587;

    // 3. Recipients & Sender
    $mail->setFrom('bobbycuen@gmail.com', 'UNIVERSITY OF KRISTIAN EVANGELION');
    $mail->addAddress($data["sponsor_email"]);

    // 4. Content Construction
    $status       = $data["status"]; // This matches the "status" key in your JS
    $sponsor_name = $data["sponsor_name"];
    $package_name = $data["package_name"];
    $event_name   = $data["event_name"];

    $mail->Subject = "Update regarding your application for $event_name";

    $body = "Dear $sponsor_name,\n\n";
    $body .= "Greetings!\n\n";
    $body .= "We would like to inform you that your application status for the '$package_name' package is: " . strtoupper($status) . ".\n\n";

    if ($status === "approved") {
        $body .= "Congratulations! Your organization has successfully met the requirements and standards set by the University of Kristian Evangelion Student Affairs. You may now proceed with the necessary steps to officially operate and coordinate with our office for further instructions.\n\n";
    } else if ($status === "rejected") {
        $body .= "After careful evaluation, we regret to inform you that your application for the '$package_name' was not approved at this time. You may review your submission and make improvements should you wish to reapply in the future.\n\n";
    } else {
        $body .= "Your application is currently under review. We appreciate your patience as our team carefully evaluates all submissions.\n\n";
    }

    $body .= "If you have any questions or would like to follow up, feel free to reply to this email.\n\n";
    $body .= "Thank you for your interest in becoming part of the university community.\n\n";
    $body .= "Sincerely,\nUniversity of Kristian Evangelion Student Affairs";

    $mail->Body = $body;

    // 5. Send and Respond
    $mail->send();

    echo json_encode([
        "status" => true,
        "message" => "Application Successfully Sent! Check Email for Confirmation!"
    ]);

} catch (Exception $e) {
    echo json_encode([
        "status" => false,
        "message" => "Message could not be sent. Mailer Error: {$mail->ErrorInfo}"
    ]);
}