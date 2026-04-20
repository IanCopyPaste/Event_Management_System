<?php
session_start();

use PHPMailer\PHPMailer\PHPMailer;

require '../../../vendor/autoload.php';
$mail = new PHPMailer(true);

include("../../database/config.php");
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
$mail->addAddress($_SESSION["org_email"]);

$mail->Subject = 'Application Status Update';

$body = $body = "Dear " . $_SESSION["org_name"] . ",

Greetings!

Thank you for submitting your event application for: ". $data["event_name"] ."

We would like to inform you that your application status is currently: PENDING.

Your application is under review by the University of Kristian Evangelion Student Affairs. We appreciate your patience as our team carefully evaluates all submissions.

If you have any questions or would like to follow up, feel free to reply to this email.

Thank you for your interest in becoming part of the university community.

Sincerely,  
University of Kristian Evangelion Student Affairs";

$mail->Body = $body;

$mail->send();

echo json_encode([
    "status" => true,
    "message" => "Application Successfully Sent! Check Email for Confirmation!"
]);
