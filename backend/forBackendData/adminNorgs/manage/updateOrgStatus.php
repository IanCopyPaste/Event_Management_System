<?php
header("Content-Type: application/json");

require_once "../../../database/config.php";

$data = json_decode(file_get_contents("php://input"), true);

$org_id = intval($data["org_id"] ?? 0);
$status = trim($data["status"] ?? "");

if (!$org_id || !$status) {
    echo json_encode([
        "success" => false,
        "message" => "Missing required fields"
    ]);
    exit;
}

if ($status !== "active" && $status !== "inactive") {
    echo json_encode([
        "success" => false,
        "message" => "Invalid status"
    ]);
    exit;
}

$stmt = $conn->prepare("
    UPDATE organizations
    SET status = ?
    WHERE org_id = ?
");

$stmt->bind_param("si", $status, $org_id);

if ($stmt->execute()) {

    echo json_encode([
        "success" => true,
        "message" => "Status updated successfully"
    ]);

} else {

    echo json_encode([
        "success" => false,
        "message" => "Database update failed"
    ]);
}
?>