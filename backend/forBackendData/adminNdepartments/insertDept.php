<?php
include("../../database/config.php");
header("Content-Type: application/json");

$name = $_POST["dept_name"];
$status = $_POST["dept_status"];

$logo_db = null;

if (!empty($_FILES["dept_logo"]["name"])) {

    $logo = $_FILES["dept_logo"];

    $ext = pathinfo($logo["name"], PATHINFO_EXTENSION);
    $logo_db = uniqid("dept_", true) . "." . $ext;

    move_uploaded_file($logo["tmp_name"], "../../../image_data/department_logo/" . $logo_db);
}

$query = "INSERT INTO department (department_name, department_logo, status) VALUES (?, ?, ?)";
$stmt = mysqli_prepare($conn, $query);

mysqli_stmt_bind_param($stmt, "sss", $name, $logo_db, $status);

if (mysqli_stmt_execute($stmt)) {
    echo json_encode(["status" => true, "message" => "Inserted successfully"]);
} else {
    echo json_encode(["status" => false, "message" => "Insert failed"]);
}
?>