<?php
session_start();
include("../../database/config.php");
header("Content-Type: application/json");
$data = json_decode(file_get_contents("php://input"), true);

$query = "SELECT * FROM users u LEFT JOIN programs p ON u.program_id = p.program_id  WHERE users_id=?";
$stmt = mysqli_prepare($conn,$query);
mysqli_stmt_bind_param($stmt,"s",$data["users_id"]);
mysqli_stmt_execute($stmt);
$result = mysqli_stmt_get_result($stmt);

if($row = mysqli_fetch_assoc($result)){
    if(($data["users_id"] == $row["users_id"]) && ($data["password"] == $row["password_hashed"])){
        if($row["status"] == "inactive"){
            echo json_encode([
                "remarks" => false,
                "message" => "Your account is currently inactive. Please contact the administrator for assistance."
            ]);
            exit();

        }
        echo json_encode([
            "remarks" => true,
            "role" => $row["role"],
            "message" => "Login Successful! Welcome " . $row["first_name"] . "!"
        ]);
        $_SESSION["users_id"] = $row["users_id"];
        $_SESSION["users_email"] = $row["email"];
        $_SESSION["users_fname"] = $row["first_name"];
        $_SESSION["users_mname"] = $row["middle_name"];
        $_SESSION["users_lname"] = $row["last_name"];
        $_SESSION["users_year"] = $row["year_level"];
        $_SESSION["users_program"] = $row["program_id"];
        $_SESSION["users_pic"] = $row["profile_pic"];
        $_SESSION["users_status"] = $row["status"];
        $_SESSION["created_at"] = $row["created_at"];
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