<?php
include("../../../database/config.php");
$data = json_decode(file_get_contents("php://input"), true);
header("Content-type: application/json");

$query = "UPDATE advertisement SET agreement_status=? WHERE advertisement_id=?";
$stmt = mysqli_prepare($conn,$query);
mysqli_stmt_bind_param($stmt,"si",$data["agreement_status"],$data["advertisement_id"]);

if(mysqli_stmt_execute($stmt)){
    echo json_encode([
        "status" => true,
        "message" => "Record updated successfuly!",
        "advertisement_id" => $data["advertisement_id"]
    ]);
}else{
    echo json_encode([
        "status" => false,
        "message" => "Record updated failed!",
        "advertisement_id" => $data["advertisement_id"]
    ]);
}
?>