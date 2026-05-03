<?php
include("../../database/config.php");
header("Content-Type: application/json");
$data = json_decode(file_get_contents("php://input"),true);

$query = "DELETE FROM department WHERE department_id=?";
$stmt = mysqli_prepare($conn, $query);
mysqli_stmt_bind_param($stmt, "i", $data["dept_id"]);

if (mysqli_stmt_execute($stmt)) {
    echo json_encode(["status" => true, "message" => "Deleted successfully"]);
} else {
    echo json_encode(["status" => false, "message" => "Delete failed"]);
}