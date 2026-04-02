<?php
session_start();
try {
    include("../../database/config.php");
    header("Content-Type: application/json");

    $query = "SELECT * FROM users WHERE users_id=?";
    $stmt = mysqli_prepare($conn, $query);
    mysqli_stmt_bind_param($stmt, "i",$_SESSION["users_id"]);//20200
    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);

    if($row = mysqli_fetch_assoc($result)){
        echo json_encode([
            "users_id" => $row["users_id"],
            "first_name" => $row["first_name"],
            "middle_name" => $row["middle_name"],
            "last_name" => $row["last_name"],
            "email" => $row["email"],
            "profile_pic" => $row["profile_pic"],
            "status" => $row["status"],
            "last_logged" => $row["last_logged"]
        ]);
    }
} catch (\Throwable $th) {
    echo json_encode([
        "status" => false,
        "message" => "Error Occured somewhere in php"
    ]);
}
?>