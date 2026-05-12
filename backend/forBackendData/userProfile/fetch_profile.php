<?php
session_start();
include("../../database/config.php");
header("Content-Type: application/json");

if (!isset($_SESSION["users_id"])) {
    echo json_encode(["status" => false, "message" => "Unauthorized access."]);
    exit;
}

$user_id = $_SESSION["users_id"];

// Fetch user info and join with programs table for the program name
$query = "SELECT u.*, p.program_name 
          FROM users u 
          LEFT JOIN programs p ON u.program_id = p.program_id 
          WHERE u.users_id = ?";

$stmt = mysqli_prepare($conn, $query);
mysqli_stmt_bind_param($stmt, "i", $user_id);

if (mysqli_stmt_execute($stmt)) {
    $result = mysqli_stmt_get_result($stmt);
    $user = mysqli_fetch_assoc($result);
    
    if ($user) {
        unset($user['password_hashed']); // Security: Don't send the hash to frontend
        echo json_encode(["status" => true, "data" => $user]);
    } else {
        echo json_encode(["status" => false, "message" => "User not found."]);
    }
} else {
    echo json_encode(["status" => false, "message" => "Database error."]);
}
?>