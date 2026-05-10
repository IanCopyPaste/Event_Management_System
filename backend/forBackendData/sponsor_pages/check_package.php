<?php
session_start();
header('Content-Type: application/json');
include("../../database/config.php");

$sponsor_id = isset($_SESSION['sponsor_id']) ? $_SESSION['sponsor_id'] : 1;
$event_id = isset($_GET['event_id']) ? (int)$_GET['event_id'] : 0;

$response = ['exists' => false];

if ($event_id > 0) {
    $sql = "SELECT package_id FROM packages WHERE sponsor_id = ? AND event_id = ? AND approval_status <> 'rejected' LIMIT 1";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ii", $sponsor_id, $event_id);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $response['exists'] = true;
    }
    $stmt->close();
}

$conn->close();
echo json_encode($response);