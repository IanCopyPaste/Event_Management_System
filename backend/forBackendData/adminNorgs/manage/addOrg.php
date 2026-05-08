<?php
header("Content-Type: application/json");

require_once "../../../database/config.php";

$org_name       = trim($_POST["org_name"] ?? "");
$org_email      = trim($_POST["org_email"] ?? "");
$org_contact_no = trim($_POST["org_contact_no"] ?? "");
$department_id  = intval($_POST["department_id"] ?? 0);
$org_username   = trim($_POST["org_username"] ?? "");
$org_password   = trim($_POST["org_password"] ?? "");
$status         = trim($_POST["status"] ?? "active");

if (
    !$org_name ||
    !$org_email ||
    !$org_contact_no ||
    !$department_id ||
    !$org_username ||
    !$org_password
) {
    echo json_encode([
        "success" => false,
        "message" => "Please fill in all required fields"
    ]);
    exit;
}

$check = $conn->prepare("
    SELECT org_id
    FROM organizations
    WHERE org_email = ?
       OR org_username = ?
");

$check->bind_param("ss", $org_email, $org_username);
$check->execute();

$result = $check->get_result();

if ($result->num_rows > 0) {

    echo json_encode([
        "success" => false,
        "message" => "Email or username already exists"
    ]);
    exit;
}

$logoName = null;

if (isset($_FILES["org_logo"]) && $_FILES["org_logo"]["error"] === 0) {

    $uploadDir = "../../../../image_data/org_logo/";

    if (!is_dir($uploadDir)) {
        mkdir($uploadDir, 0777, true);
    }

    $fileTmp  = $_FILES["org_logo"]["tmp_name"];
    $fileName = time() . "_" . basename($_FILES["org_logo"]["name"]);

    move_uploaded_file($fileTmp, $uploadDir . $fileName);

    $logoName = $fileName;
}

$hashedPassword = password_hash($org_password, PASSWORD_DEFAULT);

$stmt = $conn->prepare("
    INSERT INTO organizations (
        department_id,
        org_name,
        org_email,
        org_contact_no,
        org_username,
        org_password,
        org_logo,
        status
    )
    VALUES (?, ?, ?, ?, ?, ?, ?, ?)
");

$stmt->bind_param(
    "isssssss",
    $department_id,
    $org_name,
    $org_email,
    $org_contact_no,
    $org_username,
    $hashedPassword,
    $logoName,
    $status
);

if ($stmt->execute()) {

    echo json_encode([
        "success" => true,
        "message" => "Organization added successfully"
    ]);

} else {

    echo json_encode([
        "success" => false,
        "message" => "Insert failed"
    ]);
}
?>