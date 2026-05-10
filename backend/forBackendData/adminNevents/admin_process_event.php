<?php
header('Content-Type: application/json');
require_once "../../database/config.php";
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
require '../../../vendor/autoload.php'; 

$data = json_decode(file_get_contents("php://input"), true);
$event_id = $data['event_id'];
$action = $data['action']; 

$stmt = $conn->prepare("SELECT e.event_name, e.approval_status, o.org_email, o.org_name FROM events e LEFT JOIN organizations o ON e.org_id = o.org_id WHERE e.event_id = ?");
$stmt->bind_param("i", $event_id);
$stmt->execute();
$event = $stmt->get_result()->fetch_assoc();

if (!$event) {
    echo json_encode(['status' => false, 'message' => 'Event not found']);
    exit;
}

$current_approval = $event['approval_status'];
$new_approval_status = ($action === 'approve') ? 'approved' : 'rejected';
$new_event_status = null;

if ($current_approval === 'for_reschedule' && $action === 'approve') {
    $new_event_status = 'rescheduled';
}

if ($new_event_status) {
    $upd = $conn->prepare("UPDATE events SET approval_status = ?, status = ? WHERE event_id = ?");
    $upd->bind_param("ssi", $new_approval_status, $new_event_status, $event_id);
} else {
    $upd = $conn->prepare("UPDATE events SET approval_status = ? WHERE event_id = ?");
    $upd->bind_param("si", $new_approval_status, $event_id);
}

$upd->execute();

$mail = new PHPMailer(true);
try {
    $mail->isSMTP();
    $mail->Host       = 'smtp.gmail.com';
    $mail->SMTPAuth   = true;
    $mail->Username   = 'bobbycuen@gmail.com'; 
    $mail->Password   = $app_pass;    
    $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
    $mail->Port       = 587;

    $mail->setFrom('YOUR_EMAIL@gmail.com', 'Admin System');
    $mail->addAddress($event['org_email'], $event['org_name']);

    $mail->isHTML(true);
    $mail->Subject = "Update on your event: " . $event['event_name'];
    
    $bodyText = $action === 'approve' ? "We are pleased to inform you that your event has been approved." : "We regret to inform you that your event has been rejected.";
    $mail->Body = "<h3>Hello {$event['org_name']},</h3><p>{$bodyText}</p><p>Event: <b>{$event['event_name']}</b></p>";

    $mail->send();
    echo json_encode(['status' => true, 'message' => 'Event updated and email sent successfully.']);
} catch (Exception $e) {
    echo json_encode(['status' => true, 'message' => 'Event updated, but failed to send email.']);
}