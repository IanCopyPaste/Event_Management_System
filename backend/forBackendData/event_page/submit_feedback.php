<?php
session_start();
include("../../database/config.php");
header("Content-Type: application/json");
$data = json_decode(file_get_contents("php://input"), true);

// Check if user is logged in
if(!isset($_SESSION['users_id'])) {
    echo json_encode(["status" => false, "message" => "You must be logged in to leave feedback."]);
    exit;
}

$event_id = $data['event_id'];
$user_id = $_SESSION['users_id'];
$star = (int)$data['star'];
$comment = htmlspecialchars(strip_tags($data['comment'])); // Sanitize input

// Optional: Check if user already submitted feedback to prevent spam
$check_query = "SELECT feedback_id FROM feedbacks WHERE event_id = ? AND users_id = ?";
$check_stmt = mysqli_prepare($conn, $check_query);
mysqli_stmt_bind_param($check_stmt, "ii", $event_id, $user_id);
mysqli_stmt_execute($check_stmt);
mysqli_stmt_store_result($check_stmt);

if(mysqli_stmt_num_rows($check_stmt) > 0) {
    echo json_encode(["status" => false, "message" => "You have already submitted feedback for this event."]);
    exit;
}

// Insert new feedback
$query = "INSERT INTO feedbacks (event_id, users_id, feedback_star, feedback_comment, created_at) VALUES (?, ?, ?, ?, NOW())";
$stmt = mysqli_prepare($conn, $query);
mysqli_stmt_bind_param($stmt, "iiis", $event_id, $user_id, $star, $comment);

if(mysqli_stmt_execute($stmt)) {
    echo json_encode(["status" => true]);
} else {
    echo json_encode(["status" => false, "message" => "Failed to save feedback."]);
}
?>