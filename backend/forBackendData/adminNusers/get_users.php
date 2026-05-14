<?php
// api/get_users.php
header("Content-Type: application/json");
require_once "../../database/config.php"; // Your database connection file

$sql = "SELECT * FROM users ORDER BY created_at DESC";
$result = $conn->query($sql);

$users = [];
while ($row = $result->fetch_assoc()) {
    // We remove the hashed password before sending data to the frontend for security
    unset($row['password_hashed']); 
    $users[] = $row;
}

// Convert the PHP array into a JSON string for JS to fetch
echo json_encode($users);
?>