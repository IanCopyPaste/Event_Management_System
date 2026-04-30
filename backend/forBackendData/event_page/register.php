<?php
session_start();
include("../../database/config.php");
header("Content-Type: application/json");
$data = json_decode(file_get_contents("php://input"),true);

$query = "INSERT INTO responses (event_id, users_id) VALUES (?,?)";
$stmt = mysqli_prepare($conn, $query);
mysqli_stmt_bind_param($stmt,"ii",$data["event_id"],$_SESSION["users_id"]);

if(mysqli_stmt_execute($stmt)){

    $query1 = "UPDATE events SET slot_taken = slot_taken + 1 WHERE event_id=?";
    $stmt1 = mysqli_prepare($conn, $query1);
    mysqli_stmt_bind_param($stmt1,"i",$data["event_id"]);
    mysqli_stmt_execute($stmt1);

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
