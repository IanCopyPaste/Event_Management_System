<?php
// api/update_status.php
require_once "../../database/config.php";

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Capture the data sent via JS FormData
    $userId = $_POST['users_id'];
    $newStatus = $_POST['status']; // 'active' or 'inactive'

    $stmt = $conn->prepare("UPDATE users SET status = ? WHERE users_id = ?");
    $stmt->bind_param("si", $newStatus, $userId);
    
    if ($stmt->execute()) {
        echo json_encode(["success" => true, "message" => "Status updated!"]);
    } else {
        echo json_encode(["success" => false, "message" => "Update failed."]);
    }
}
?>