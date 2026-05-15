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
    $query = "SELECT prog_abv FROM programs WHERE program_id = ?";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("i", $row['program_id']);
    $stmt->execute();
    $prog_result = $stmt->get_result();
    if ($prog_result->num_rows > 0) {
        $prog_row = $prog_result->fetch_assoc();
        $row['program_abv'] = $prog_row['prog_abv'];
    } else {
        $row['program_abv'] = null; 
    } 
    $users[] = $row;
}

// Convert the PHP array into a JSON string for JS to fetch
echo json_encode($users);
?>