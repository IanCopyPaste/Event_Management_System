<?php
header("Content-Type: application/json");

require_once "../../../database/config.php";

$data = json_decode(file_get_contents("php://input"), true);

$status   = trim($data["status"] ?? "");
$event_id = intval($data["event_id"] ?? 0);

if (!$status || !$event_id) {

    echo json_encode([
        "status" => false,
        "message" => "Missing required fields"
    ]);

    exit;
}

$allowed = ["approved", "pending", "rejected"];

if (!in_array($status, $allowed)) {

    echo json_encode([
        "status" => false,
        "message" => "Invalid status"
    ]);

    exit;
}

$stmt = $conn->prepare("
    UPDATE events
    SET approval_status = ?
    WHERE event_id = ?
");

$stmt->bind_param("si", $status, $event_id);

if ($stmt->execute()) {

    echo json_encode([
        "status" => true,
        "message" => "Event status updated successfully"
    ]);

} else {

    echo json_encode([
        "status" => false,
        "message" => "Failed to update event"
    ]);
}
?>