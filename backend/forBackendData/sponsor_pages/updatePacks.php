<?php
session_start();
include("../../database/config.php");
header("Content-Type: application/json");

$package_id = $_POST['package_id'] ?? 0;
$package_name = $_POST['package_name'] ?? '';
$description = $_POST['description'] ?? '';
$price = $_POST['price'] ?? 0;
$status = $_POST['status'] ?? 'active';
$benefits = $_POST['benefits'] ?? '[]';

$image_name = null;
$image_uploaded = false;

if (!empty($_FILES['package_bg']['name'])) {
    $image_name = time() . "_" . basename($_FILES['package_bg']['name']);
    $target = "../../image_data/package_bg/" . $image_name;
    move_uploaded_file($_FILES['package_bg']['tmp_name'], $target);
    $image_uploaded = true;
}

if ($image_uploaded) {

    $sql = "UPDATE sponsorship_packages 
            SET package_name=?, description=?, price=?, benefits=?, status=?, package_bg=?
            WHERE package_id=?";

    $stmt = mysqli_prepare($conn, $sql);

    mysqli_stmt_bind_param(
        $stmt,
        "ssdsssi",
        $package_name,
        $description,
        $price,
        $benefits,
        $status,
        $image_name,
        $package_id
    );

} else {

    $sql = "UPDATE packages 
            SET package_name=?, description=?, price=?, benefits=?, status=?
            WHERE package_id=?";

    $stmt = mysqli_prepare($conn, $sql);

    mysqli_stmt_bind_param(
        $stmt,
        "ssdssi",
        $package_name,
        $description,
        $price,
        $benefits,
        $status,
        $package_id
    );
}

if (mysqli_stmt_execute($stmt)) {
    echo json_encode(["status" => true]);
} else {
    echo json_encode(["status" => false]);
}