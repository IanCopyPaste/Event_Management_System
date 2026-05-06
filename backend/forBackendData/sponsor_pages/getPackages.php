<?php
session_start();
include("../../database/config.php");
header("Content-Type: application/json");

$query = "SELECT * FROM packages WHERE sponsor_id=?";
$stmt = mysqli_prepare($conn, $query);
mysqli_stmt_bind_param($stmt,"i",$_SESSION["sponsor_id"]);

$packs = [];

if (mysqli_stmt_execute($stmt)) {
    $result = mysqli_stmt_get_result($stmt);
    while ($row = mysqli_fetch_assoc($result)) {
        $packs[] = $row;
    }
    echo json_encode([
        "status" => true,
        "message" => "query execution success",
        "id" => $_SESSION["sponsor_id"],
        "records" => $packs
    ]);
} else {
    echo json_encode([
        "status" => false,
        "message" => "query execution failed"
    ]);
}
