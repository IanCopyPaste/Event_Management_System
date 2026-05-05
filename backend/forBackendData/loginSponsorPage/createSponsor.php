<?php
header("Content-Type: application/json");
include("../../database/config.php");

$response = ["status" => false, "message" => "Something went wrong"];

try {

    // get POST data
    $company_name = $_POST['company_name'] ?? '';
    $company_address = $_POST['company_address'] ?? '';
    $sponsor_email = $_POST['sponsor_email'] ?? '';
    $sponsor_contact_no = $_POST['sponsor_contact_no'] ?? '';
    $username = $_POST['username'] ?? '';
    $password = $_POST['password'] ?? '';

    // validation
    if (
        empty($company_name) || empty($company_address) || empty($sponsor_email) ||
        empty($sponsor_contact_no) || empty($username) || empty($password)
    ) {
        echo json_encode(["status" => false, "message" => "All fields required"]);
        exit;
    }

    // hash password
    $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

    // file upload
    $fileName = null;

    if (isset($_FILES['additional_documents']) && $_FILES['additional_documents']['error'] === 0) {

        $uploadDir = "../../../image_data/sponsor_application_docs/";
        if (!is_dir($uploadDir)) {
            mkdir($uploadDir, 0777, true);
        }

        $fileTmp = $_FILES['additional_documents']['tmp_name'];
        $originalName = basename($_FILES['additional_documents']['name']);
        $fileExt = pathinfo($originalName, PATHINFO_EXTENSION);

        $fileName = uniqid("doc_", true) . "." . $fileExt;
        $destination = $uploadDir . $fileName;

        move_uploaded_file($fileTmp, $destination);
    }

    // insert query
    $query = "INSERT INTO sponsorships 
        (company_name, company_address, sponsor_email, sponsor_contact_no, additional_documents, username, password) 
        VALUES (?, ?, ?, ?, ?, ?, ?)";

    $stmt = mysqli_prepare($conn, $query);

    mysqli_stmt_bind_param(
        $stmt,
        "sssssss",
        $company_name,
        $company_address,
        $sponsor_email,
        $sponsor_contact_no,
        $fileName,
        $username,
        $hashedPassword
    );

    if (mysqli_stmt_execute($stmt)) {
        $response["status"] = true;
        $response["message"] = "Sponsor registered successfully";
    } else {
        $response["status"] = false;
        $response["message"] = "Database insert failed";
    }

} catch (Exception $e) {
    $response["message"] = $e->getMessage();
}

echo json_encode($response);