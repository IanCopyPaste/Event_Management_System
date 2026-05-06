<?php
session_start();
include("../../database/config.php");
header("Content-Type: application/json");

$package_name = $_POST['package_name'] ?? '';
$description = $_POST['description'] ?? '';
$price = $_POST['price'] ?? 0;
$status = $_POST['status'] ?? 'active';
$benefits = $_POST['benefits'] ?? '[]';

$image_name = null;

if (!empty($_FILES['package_bg']['name'])) {
    $image_name = time() . "_" . basename($_FILES['package_bg']['name']);
    $target = "../../../image_data/package_bg/" . $image_name;
    move_uploaded_file($_FILES['package_bg']['tmp_name'], $target);
}

$sql = "INSERT INTO packages 
(package_name, description, price, benefits, package_bg, status,sponsor_id)
VALUES (?, ?, ?, ?, ?, ?,?)";

$stmt = mysqli_prepare($conn, $sql);
mysqli_stmt_bind_param(
    $stmt,
    "ssdsssi",
    $package_name,
    $description,
    $price,
    $benefits,
    $image_name,
    $status,
    $_SESSION["sponsor_id"]
);

if (mysqli_stmt_execute($stmt)) {
    echo json_encode(["status" => true]);
} else {
    echo json_encode(["status" => false]);
}
?>