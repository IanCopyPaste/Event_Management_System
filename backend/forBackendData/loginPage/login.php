<?php
session_start();
include("../../database/config.php");
header("Content-Type: application/json");
$data = json_decode(file_get_contents("php://input"), true);

$query = "SELECT * FROM users WHERE users_id = ?";
$stmt = mysqli_prepare($conn,$query);
mysqli_stmt_bind_param($stmt,"s",$data["users_id"]);
mysqli_stmt_execute($stmt);
$result = mysqli_stmt_get_result($stmt);

if($row = mysqli_fetch_assoc($result)){
    if(($data["users_id"] == $row["users_id"]) && ($data["password"] == $row["password_hashed"])){
        echo json_encode([
            "remarks" => true,
            "message" => "Login Successful! Welcome " . $row["first_name"]
        ]);
        $_SESSION["users_id"] = $row["users_id"];
    }else{
        echo json_encode([
            "remarks" => false,
            "message" => "Incorrect Password or School ID!"
        ]);    
    }
}else{
    echo json_encode([
        "remarks" => false,
        "message" => "User not Found!"
    ]);
}
?>