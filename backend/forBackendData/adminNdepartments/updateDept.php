<?php
include("../../database/config.php");
header("Content-Type: application/json");

$id = $_POST["dept_id"];
$name = $_POST["dept_name"];
$status = $_POST["dept_status"];

$logo_db = null;

if (!empty($_FILES["dept_logo"]["name"])) {

    $logo = $_FILES["dept_logo"];

    $ext = pathinfo($logo["name"], PATHINFO_EXTENSION);
    $logo_db = uniqid("dept_", true) . "." . $ext;

    move_uploaded_file($logo["tmp_name"], "../../../image_data/department_logo/" . $logo_db);
}

if ($logo_db) {
    $query = "UPDATE department SET department_name=?, department_logo=?, status=? WHERE department_id=?";
    $stmt = mysqli_prepare($conn, $query);
    mysqli_stmt_bind_param($stmt, "sssi", $name, $logo_db, $status, $id);
} else {
    $query = "UPDATE department SET department_name=?, status=? WHERE department_id=?";
    $stmt = mysqli_prepare($conn, $query);
    mysqli_stmt_bind_param($stmt, "ssi", $name, $status, $id);
}

if (mysqli_stmt_execute($stmt)) {
    echo json_encode(["status" => true, "message" => "Updated successfully"]);
} else {
    echo json_encode(["status" => false, "message" => "Update failed"]);
}
?>