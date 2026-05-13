<?php
include("../../database/config.php");
header("Content-Type: application/json");

$data = json_decode(file_get_contents("php://input"), true);
$org_id = $data['org_id'] ?? 0;

// Pulls approved events for a specific organization 
$query = "SELECT event_id, event_name, event_bg_picture, status, start_date 
          FROM events 
          WHERE org_id = ? AND approval_status = 'approved'
          ORDER BY start_date DESC";

$stmt = mysqli_prepare($conn, $query);
mysqli_stmt_bind_param($stmt, "i", $org_id);
mysqli_stmt_execute($stmt);
$result = mysqli_stmt_get_result($stmt);
$events = mysqli_fetch_all($result, MYSQLI_ASSOC);

echo json_encode(["status" => true, "data" => $events]);
?>