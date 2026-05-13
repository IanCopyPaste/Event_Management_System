<?php
include("../../database/config.php");
header("Content-Type: application/json");

// Pulls active organizations joined with department names 
$query = "SELECT o.*, d.department_name 
          FROM organizations o 
          JOIN department d ON o.department_id = d.department_id 
          WHERE o.status = 'active'";

$result = mysqli_query($conn, $query);
if ($result) {
    $orgs = mysqli_fetch_all($result, MYSQLI_ASSOC);
    echo json_encode(["status" => true, "data" => $orgs]);
} else {
    echo json_encode(["status" => false, "message" => mysqli_error($conn)]);
}
?>