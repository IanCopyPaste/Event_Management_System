<?php
include("../../../database/config.php");
header("Content-Type: application/json");

$data = json_decode(file_get_contents("php://input"), true);

$query = "UPDATE sponsorships SET status=? WHERE sponsor_id=?";
$stmt = mysqli_prepare($conn, $query);
mysqli_stmt_bind_param($stmt,"si",$data["status"],$data["sponsor_id"]);

if(mysqli_stmt_execute($stmt)){
    echo json_encode([
        "status" => true,
        "message" => "status updated successfuly",
    ]);
}else{
    echo json_encode([
        "status" => false,
        "message" => "status updated not successful"
    ]);
}
?>