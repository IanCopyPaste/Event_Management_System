<?php
header("Content-Type: application/json");

$pack_id = $_POST['pack_id'];
$event_id = $_POST['event_id'];

$uploadDir = "../../../image_data/package_application/";

if (!is_dir($uploadDir)) {
    mkdir($uploadDir, 0777, true);
}

$fileName = null;

if (isset($_FILES['document']) && $_FILES['document']['error'] == 0) {
    $fileName = time() . "_" . basename($_FILES['document']['name']);
    $targetPath = $uploadDir . $fileName;

    move_uploaded_file($_FILES['document']['tmp_name'], $targetPath);
}

// SAVE TO DATABASE (example)
include("../../database/config.php");
$stmt = $conn->prepare("INSERT INTO advertisement (package_id, event_id, additional_files) VALUES (?, ?, ?)");
$stmt->bind_param("iis", $pack_id, $event_id, $fileName);

if ($stmt->execute()) {
    echo json_encode(["status" => true]);
} else {
    echo json_encode(["status" => false]);
}
?>