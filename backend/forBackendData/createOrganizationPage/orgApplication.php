<?php
session_start();
include("../../database/config.php");
header("Content-Type: application/json");

try {
    $user_id = $_POST["user_id"] ?? null;
    $department_id = $_POST["org_dept"] ?? null;
    $org_name = $_POST["org_name"] ?? null;
    $org_email = $_POST["org_email"] ?? null;
    $org_contact_no = $_POST["org_number"] ?? null;
    $org_username = $_POST["org_username"] ?? null;
    $org_password = $_POST["org_password"] ?? null;
    $additional_files = null;

    if (isset($_FILES["file"]) && $_FILES["file"]["error"] === 0) {
        $uploadDir = "../../../image_data/org_applications_docs/";
        if (!is_dir($uploadDir)) mkdir($uploadDir, 0777, true);

        $fileExt = pathinfo($_FILES["file"]["name"], PATHINFO_EXTENSION);
        $fileName = uniqid("file_", true) . "." . $fileExt;
        $targetFile = $uploadDir . $fileName;

        if (move_uploaded_file($_FILES["file"]["tmp_name"], $targetFile)) $additional_files = $targetFile;
    }

    $hashed_password = password_hash($org_password, PASSWORD_DEFAULT);
    $created_at = date("Y-m-d H:i:s");

    $stmt = $conn->prepare("INSERT INTO org_application (user_id, department_id, org_name, org_email, org_contact_no, org_username, org_password, additional_files, created_at) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)");
    $stmt->bind_param("iisssssss", $user_id, $department_id, $org_name, $org_email, $org_contact_no, $org_username, $hashed_password, $additional_files, $created_at);
    $stmt->execute();

    echo json_encode([
        "status" => true,
        "message" => "Application submitted successfuly!",
        "org_apply_id" => $conn->insert_id
    ]);
} catch (\Throwable $th) {
    echo json_encode([
        "status" => false,
        "message" => "Error Occured in Backend!"
    ]);
}
?>