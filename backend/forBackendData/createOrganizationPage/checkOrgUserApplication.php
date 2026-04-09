<?php
session_start();
include("../../database/config.php");
header("Content-Type: application/json");

$query = "SELECT * FROM org_application WHERE user_id=? AND status='pending'";
$stmt = mysqli_prepare($conn, $query);
mysqli_stmt_bind_param($stmt, "i", $_SESSION["users_id"]);
mysqli_stmt_execute($stmt);
$result = mysqli_stmt_get_result($stmt);

if(mysqli_num_rows($result) > 0){
    echo json_encode([
        "status" => false,
        "message" => "user still has pending request"
    ]);
}else{
    echo json_encode([
        "status" => true,
        "message" => "user is allowed to apply for organization"
    ]);
}
?>