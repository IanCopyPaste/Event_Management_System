<?php
header('Content-Type: application/json');
require_once "../../../database/config.php";
$data = json_decode(file_get_contents("php://input"), true);
$action = $data['action'];
$event_id = $data['event_id'];

$check = $conn->prepare("SELECT status, approval_status FROM events WHERE event_id = ?");
$check->bind_param("i", $event_id);
$check->execute();
$current = $check->get_result()->fetch_assoc();

if ($current['status'] === 'finished' && $action !== 'view') {
    echo json_encode(['status' => false, 'message' => 'Event is finished and cannot be modified.']);
    exit;
}

if ($action == 'update_full') {
    $stmt = $conn->prepare("UPDATE events SET event_name=?, description=?, location=?, start_date=?, end_date=?, start_time=?, end_time=?, registration_deadline=?, capacity=? WHERE event_id=? AND approval_status='pending'");
    $stmt->bind_param("ssssssssii", $data['event_name'], $data['description'], $data['location'], $data['start_date'], $data['end_date'], $data['start_time'], $data['end_time'], $data['registration_deadline'], $data['capacity'], $event_id);
    $stmt->execute();
} 

elseif ($action == 'update_status') {
    $new_status = $data['status'];
    
    if ($current['status'] === 'ongoing' && $new_status !== 'cancelled') {
        echo json_encode(['status' => false, 'message' => 'Ongoing events can only be cancelled.']);
        exit;
    }

    if ($new_status == 'open') {
        $stmt = $conn->prepare("SELECT registration_deadline FROM events WHERE event_id=?");
        $stmt->bind_param("i", $event_id);
        $stmt->execute();
        $res = $stmt->get_result()->fetch_assoc();
        if (strtotime($res['registration_deadline']) < time()) {
            echo json_encode(['status' => false, 'message' => 'Registration deadline has passed.']);
            exit;
        }
    }
    
    $stmt = $conn->prepare("UPDATE events SET status=? WHERE event_id=? AND approval_status='approved'");
    $stmt->bind_param("si", $new_status, $event_id);
    $stmt->execute();
}

elseif ($action == 'reschedule') {
    $stmt = $conn->prepare("UPDATE events SET start_date=?, end_date=?, start_time=?, end_time=?, registration_deadline=?, approval_status='for_reschedule', status='closed' WHERE event_id=?");
    $stmt->bind_param("sssssi", $data['start_date'], $data['end_date'], $data['start_time'], $data['end_time'], $data['registration_deadline'], $event_id);
    $stmt->execute();
}

echo json_encode(['status' => true]);