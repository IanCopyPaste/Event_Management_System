<?php
include("../../database/config.php");
header("Content-Type: application/json");
$data = json_decode(file_get_contents("php://input"),true);

$query = "DELETE FROM packages WHERE package_id=?";
$stmt = mysqli_prepare($conn, $query);
mysqli_stmt_bind_param($stmt,"i",$data["package_id"]);

if (mysqli_stmt_execute($stmt)) {
    echo json_encode([
        "status" => true,
        "message" => "Package deleted",
    ]);
} else {
    echo json_encode([
        "status" => false,
        "message" => "query execution failed"
    ]);
}
