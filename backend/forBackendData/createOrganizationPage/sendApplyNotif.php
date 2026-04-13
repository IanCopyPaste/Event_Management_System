<?php
session_start();
use PHPMailer\PHPMailer\PHPMailer;

require '../../../vendor/autoload.php';
$mail = new PHPMailer(true);

include("../../database/config.php");
header("Content-Type: application/json");
$data = json_decode(file_get_contents("php://input"),true);

$mail->isSMTP();
$mail->Host = 'smtp.gmail.com';
$mail->SMTPAuth = true;
$mail->Username = 'bobbycuen@gmail.com';
$mail->Password = $app_pass; //app password
$mail->SMTPSecure = 'tls';
$mail->Port = 587;

$mail->setFrom('bobbycuen@gmail.com', 'UNIVERSITY OF KRISTIAN EVAGELION');
$mail->addAddress($_SESSION["users_email"]);

$mail->Subject = 'Application Status Update - Pending Review';
$mail->Body = "Dear ".$_SESSION["users_fname"]." " .$_SESSION["users_mname"]." ".$_SESSION["users_lname"].",

Greetings!

Thank you for submitting your application for " . $data["org_name"] ."

We would like to inform you that your application is currently pending review. Our team is carefully evaluating all submitted applications, and we appreciate your patience during this process.

Please rest assured that you will be notified once a final decision has been made or if additional information is required from your end.

If you have any questions or would like to follow up, feel free to reply to this email.

Thank you for your interest in becoming part of.

Sincerely,
University of Kristian Evangelion Student Affairs";

$mail->send();
echo json_encode([
    "status" => true,
    "message" => "Apllication Successfuly Sent! Check Email for Confirmation!"
]);
