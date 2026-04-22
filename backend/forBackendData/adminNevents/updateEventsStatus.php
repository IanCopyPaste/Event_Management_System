<?php
include("../../database/config.php");
header("Content-Type: application/json");

$data = json_decode(file_get_contents("php://input"), true);

$query = "UPDATE events SET approval_status=? WHERE event_id=?";
$stmt = mysqli_prepare($conn, $query);

mysqli_stmt_bind_param($stmt, "si", $data["status"], $data["event_id"]);
mysqli_stmt_execute($stmt);

if (mysqli_stmt_affected_rows($stmt) > 0) {
    echo json_encode([
        "status" => true,
        "message" => "event status updated successfully"
    ]);
} else {
    echo json_encode([
        "status" => false,
        "message" => "event status updated unsuccessful"
    ]);
}
?>