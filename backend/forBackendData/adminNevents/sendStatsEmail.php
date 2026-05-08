<?php
session_start();

use PHPMailer\PHPMailer\PHPMailer;

require '../../../vendor/autoload.php';

include("../../database/config.php");

header("Content-Type: application/json");

$data = json_decode(file_get_contents("php://input"), true);

// ─────────────────────────────
// VALIDATION SAFETY
// ─────────────────────────────
if (
    !isset($data["org_email"]) ||
    !isset($data["org_name"]) ||
    !isset($data["event_name"]) ||
    !isset($data["status"])
) {
    echo json_encode([
        "status" => false,
        "message" => "Missing required fields"
    ]);
    exit;
}

// ─────────────────────────────
// MAILER SETUP
// ─────────────────────────────
$mail = new PHPMailer(true);

try {

    $mail->isSMTP();
    $mail->Host       = 'smtp.gmail.com';
    $mail->SMTPAuth   = true;

    // ⚠️ IMPORTANT: make sure this exists in config.php
    $mail->Username   = 'bobbycuen@gmail.com';
    $mail->Password   = $app_pass; // app password from config
    $mail->SMTPSecure = 'tls';
    $mail->Port       = 587;

    $mail->setFrom(
        'bobbycuen@gmail.com',
        'University of Kristian Evangelion Student Affairs'
    );

    $mail->addAddress($data["org_email"]);

    $mail->Subject = 'Event Application Status Update';

    // ─────────────────────────────
    // EMAIL BODY
    // ─────────────────────────────
    $body = "Dear {$data['org_name']},

Greetings!

Your application for the event:

\"{$data['event_name']}\"

has been updated.

Current Status: " . strtoupper($data["status"]) . "

";

    if ($data["status"] === "approved") {

        $body .= "
Congratulations!

Your event has successfully met the requirements and is now APPROVED.
You may proceed with coordination with the Student Affairs Office.
";

    } elseif ($data["status"] === "rejected") {

        $body .= "
We regret to inform you that your application was NOT APPROVED.

You may review your submission and reapply after improvements.
";

    } else {

        $body .= "
Your application is currently UNDER REVIEW.
Please wait for further updates.
";
    }

    $body .= "

Thank you for your cooperation.

University of Kristian Evangelion Student Affairs
";

    $mail->Body = $body;

    $mail->send();

    echo json_encode([
        "status" => true,
        "message" => "Email sent successfully"
    ]);

} catch (Exception $e) {

    echo json_encode([
        "status" => false,
        "message" => "Mailer Error: " . $mail->ErrorInfo
    ]);
}
?>