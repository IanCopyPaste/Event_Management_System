<?php
include("../../database/config.php");
header("Content-Type: application/json");
$data = json_decode(file_get_contents("php://input"),true);

$query = "UPDATE users SET password_hashed=? WHERE users_id=?";
$stmt = mysqli_prepare($conn,$query);
mysqli_stmt_bind_param($stmt,"si",$data["newPass"],$data["users_id"]);


if($result = mysqli_stmt_execute($stmt)){
    echo json_encode([
        "status" => true,
        "message" => "Password updated sucessfully!"
    ]);
}
?>