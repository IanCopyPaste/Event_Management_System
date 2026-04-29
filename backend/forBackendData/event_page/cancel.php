<?php
session_start();
include("../../database/config.php");
header("Content-Type: application/json");
$data = json_decode(file_get_contents("php://input"),true);

$query = "DELETE FROM responses WHERE event_id=? AND users_id=?";
$stmt = mysqli_prepare($conn, $query);
mysqli_stmt_bind_param($stmt,"ii",$data["event_id"],$_SESSION["users_id"]);

if(mysqli_stmt_execute($stmt)){
    echo json_encode([
        "status" => true,
        "message" => "response submitted success"
    ]);
}else{
    echo json_encode([
        "status" => false,
        "message" => "query execution failed"
    ]);
}
