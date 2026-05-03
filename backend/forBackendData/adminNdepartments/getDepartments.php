<?php
include("../../database/config.php");
header("Content-Type: application/json");

$query = "SELECT * FROM department";
$stmt = mysqli_prepare($conn, $query);

$depts = [];

if (mysqli_stmt_execute($stmt)) {
    $result = mysqli_stmt_get_result($stmt);
    while ($row = mysqli_fetch_assoc($result)) {
        $depts[] = $row;
    }
    echo json_encode([
        "status" => true,
        "message" => "query execution success",
        "records" => $depts
    ]);
} else {
    echo json_encode([
        "status" => false,
        "message" => "query execution failed"
    ]);
}
