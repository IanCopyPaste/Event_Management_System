<?php
session_start();
include("../../database/config.php");
header("Content-Type: application/json");

if (!isset($_SESSION["users_id"])) {
    echo json_encode(["status" => false, "message" => "Unauthorized."]);
    exit;
}

$user_id = $_SESSION["users_id"];
$response = ["status" => true, "message" => "Profile updated successfully."];

// 1. Handle Password Update
if (!empty($_POST['new_password'])) {
    $new_hash = password_hash($_POST['new_password'], PASSWORD_DEFAULT);
    $stmt = mysqli_prepare($conn, "UPDATE users SET password_hashed = ? WHERE users_id = ?");
    mysqli_stmt_bind_param($stmt, "si", $new_hash, $user_id);
    mysqli_stmt_execute($stmt);
}

// 2. Handle Profile Picture Upload
if (isset($_FILES['profile_pic']) && $_FILES['profile_pic']['error'] === 0) {
    $target_dir = "../../../image_data/user_pic/"; // Adjust based on your folder structure
    $file_ext = pathinfo($_FILES["profile_pic"]["name"], PATHINFO_EXTENSION);
    $file_name = "user_" . $user_id . "_" . time() . "." . $file_ext;
    $target_file = $target_dir . $file_name;

    if (move_uploaded_file($_FILES["profile_pic"]["tmp_name"], $target_file)) {
        $stmt = mysqli_prepare($conn, "UPDATE users SET profile_pic = ? WHERE users_id = ?");
        mysqli_stmt_bind_param($stmt, "si", $file_name, $user_id);
        mysqli_stmt_execute($stmt);
        $response["new_pic"] = $file_name;
    }
}

echo json_encode($response);
?>