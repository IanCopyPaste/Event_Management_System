<?php
session_start();
include("../../database/config.php");
header("Content-Type: application/json");

$status = "pending";

$query = "SELECT * FROM events WHERE org_id=? AND approval_status=?";
$stmt = mysqli_prepare($conn,$query);
mysqli_stmt_bind_param($stmt,"is",$_SESSION["org_id"],$status);
mysqli_stmt_execute($stmt);
$result = mysqli_stmt_get_result($stmt);

if(mysqli_num_rows($result) > 0){
    echo json_encode([
        "status" => true,
        "message" => "row found"
    ]);
}else{
    echo json_encode([
        "status" => false,
        "message" => "row not found"
    ]);
}
?>