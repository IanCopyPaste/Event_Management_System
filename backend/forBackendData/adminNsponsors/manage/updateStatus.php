<?php
header("Content-Type: application/json");
header("Access-Control-Allow-Origin: *");

require_once "../../../database/config.php";

$input = json_decode(file_get_contents("php://input"), true);

$sponsor_id = isset($input["sponsor_id"]) ? intval($input["sponsor_id"]) : 0;
$status = trim($input["status"] ?? "");

if (!$sponsor_id) {
    echo json_encode([
        "success" => false,
        "message" => "Invalid sponsor ID."
    ]);
    exit;
}

$allowed = ["activated", "deactivated"];

if (!in_array($status, $allowed)) {
    echo json_encode([
        "success" => false,
        "message" => "Invalid status value."
    ]);
    exit;
}

$check = $conn->prepare("
    SELECT sponsor_id 
    FROM sponsorships 
    WHERE sponsor_id = ?
");

$check->bind_param("i", $sponsor_id);
$check->execute();
$check->store_result();

if ($check->num_rows === 0) {

    echo json_encode([
        "success" => false,
        "message" => "Sponsor not found."
    ]);

    exit;
}

$check->close();

$stmt = $conn->prepare("
    UPDATE sponsorships
    SET status = ?
    WHERE sponsor_id = ?
");

$stmt->bind_param("si", $status, $sponsor_id);

if ($stmt->execute()) {

    echo json_encode([
        "success" => true,
        "message" => "Status updated successfully.",
        "status" => $status
    ]);

} else {

    echo json_encode([
        "success" => false,
        "message" => $stmt->error
    ]);
}

$stmt->close();
$conn->close();