<?php
error_reporting(0);      
ini_set('display_errors', 0);
session_start();
include("../../database/config.php");
header("Content-Type: application/json");

$event_name = $_POST["event_name"];
$description = $_POST["event_desc"];
$location = $_POST["event_location"];
$start_date = $_POST["event_start_date"];
$end_date = $_POST["event_end_date"];
$start_time = $_POST["event_start_time"];
$end_time = $_POST["event_end_time"];
$registration_deadline = $_POST["event_regs_deadline"];
$capacity = $_POST["event_capacity"];
$restrictions = json_decode($_POST["restricted"], true);

$uploadDir = "../../../image_data/event_bg_picture/";

$fileName = null;

if (isset($_FILES["file"]) && $_FILES["file"]["error"] === 0) {

    $fileTmp = $_FILES["file"]["tmp_name"];
    $originalName = $_FILES["file"]["name"];

    $ext = pathinfo($originalName, PATHINFO_EXTENSION);

    $fileName = uniqid("event_", true) . "." . $ext;

    $targetPath = $uploadDir . $fileName;

    move_uploaded_file($fileTmp, $targetPath);
}

$query = "INSERT INTO events (
    org_id,
    event_name,
    description,
    location,
    start_date,
    end_date,
    start_time,
    end_time,
    registration_deadline,
    capacity,
    event_bg_picture,
    restrictions
) VALUES (?,?,?,?,?,?,?,?,?,?,?,?)";

$stmt = mysqli_prepare($conn, $query);

//$org_id = 1; // placeholder ng org in gago

mysqli_stmt_bind_param(
    $stmt,
    "issssssssiss",
    $_SESSION["org_id"],
    $event_name,
    $description,
    $location,
    $start_date,
    $end_date,
    $start_time,
    $end_time,
    $registration_deadline,
    $capacity,
    $fileName,
    json_encode($restrictions)
);

if (mysqli_stmt_execute($stmt)) {
    echo json_encode([
        "status" => true,
        "message" => "Event created successfully",
        "file" => $fileName
    ]);
} else {
    echo json_encode([
        "status" => false,
        "message" => "Database insert failed"
    ]);
}
?>