<?php
include("../../../database/config.php");
$data = json_decode(file_get_contents("php://input"), true);
header("Content-type: application/json");

$query = "UPDATE org_application SET status=? WHERE org_apply_id=?";
$stmt = mysqli_prepare($conn,$query);
mysqli_stmt_bind_param($stmt,"si",$data["statusString"],$data["orgApplyID"]);

if(mysqli_stmt_execute($stmt)){
    echo json_encode([
        "status" => true,
        "message" => "Record updated successfuly!",
        "applicationID" => $data["orgApplyID"]
    ]);
}else{
    echo json_encode([
        "status" => false,
        "message" => "Record updated failed!",
        "applicationID" => $data["orgApplyID"]
    ]);
}
?>