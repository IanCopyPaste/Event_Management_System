<?php
include("../../database/config.php");
header("Content-Type: application/json");
$data = json_decode(file_get_contents("php://input"), true);

$event_id = $data['event_id'] ?? 0;

// Joining users and programs to get detailed attendee info 
$query = "SELECT 
            f.feedback_star, 
            f.feedback_comment, 
            f.created_at, 
            u.first_name, 
            u.last_name, 
            u.year_level, 
            u.profile_pic,
            p.program_name 
          FROM feedbacks f 
          JOIN users u ON f.users_id = u.users_id 
          LEFT JOIN programs p ON u.program_id = p.program_id
          WHERE f.event_id = ? 
          ORDER BY f.created_at DESC";

$stmt = mysqli_prepare($conn, $query);
mysqli_stmt_bind_param($stmt, "i", $event_id);

if(mysqli_stmt_execute($stmt)) {
    $result = mysqli_stmt_get_result($stmt);
    $records = mysqli_fetch_all($result, MYSQLI_ASSOC);
    echo json_encode(["status" => true, "records" => $records]);
} else {
    echo json_encode(["status" => false, "message" => "Database error"]);
}
?>