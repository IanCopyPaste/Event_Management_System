<?php
session_start();

use PHPMailer\PHPMailer\PHPMailer;

require '../../../../vendor/autoload.php';
$mail = new PHPMailer(true);

include("../../../database/config.php");
header("Content-Type: application/json");

$data = json_decode(file_get_contents("php://input"), true);

$mail->isSMTP();
$mail->Host = 'smtp.gmail.com';
$mail->SMTPAuth = true;
$mail->Username = 'bobbycuen@gmail.com';
$mail->Password = $app_pass;
$mail->SMTPSecure = 'tls';
$mail->Port = 587;

$mail->setFrom('bobbycuen@gmail.com', 'UNIVERSITY OF KRISTIAN EVAGELION');
$mail->addAddress($data["sponsor_email"]);

$mail->Subject = 'Application Status Update';

$body = "Dear " . $data["sponsor_id"] . " / " . $data["company_name"] . ",

Greetings!

We would like to inform you that your application status is: " . $data["approval_status"] . ".

";

if ($data["approval_status"] === "approved") {
    $body .= "Congratulations! Your organization has successfully met the requirements and standards set by the University of Kristian Evangelion Student Affairs. You may now proceed with the necessary steps to officially operate and coordinate with our office for further instructions.\n\n";
} else if ($data["approval_status"] === "rejected") {
    $body .= "After careful evaluation, we regret to inform you that your application was not approved at this time. You may review your submission and make improvements should you wish to reapply in the future.\n\n";
} else {
    $body .= "Your application is currently under review. We appreciate your patience as our team carefully evaluates all submissions.\n\n";
}

$body .= "If you have any questions or would like to follow up, feel free to reply to this email.

Thank you for your interest in becoming part of the university community.

Sincerely,
University of Kristian Evangelion Student Affairs";

$mail->Body = $body;

$mail->send();

echo json_encode([
    "status" => true,
    "message" => "Application Successfully Sent! Check Email for Confirmation!"
]);
