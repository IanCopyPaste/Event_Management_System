<?php
session_start();
include("../../database/config.php");
header("Content-Type: application/json");
//$data = json_encode(file_get_contents("php://input"),true);

$query = "SELECT * FROM events WHERE org_id=? AND status='open'";
$stmt = mysqli_prepare($conn, $query);
mysqli_stmt_bind_param($stmt,"i",$_SESSION["org_id"]);

$events = [];

if (mysqli_stmt_execute($stmt)) {
    $result = mysqli_stmt_get_result($stmt);
    while ($row = mysqli_fetch_assoc($result)) {
        $events[] = $row;
    }
    echo json_encode([
        "status" => true,
        "message" => "query execution success",
        "id" => $_SESSION["org_id"],
        "records" => $events
    ]);
} else {
    echo json_encode([
        "status" => false,
        "message" => "query execution failed"
    ]);
}
