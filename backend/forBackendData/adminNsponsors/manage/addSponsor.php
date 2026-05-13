<?php
header("Content-Type: application/json");
header("Access-Control-Allow-Origin: *");

require_once "../../../database/config.php";

$required = [
    "company_name",
    "sponsor_email",
    "sponsor_contact_no",
    "username",
    "password"
];

foreach ($required as $field) {

    if (empty(trim($_POST[$field] ?? ""))) {

        echo json_encode([
            "success" => false,
            "message" => "$field is required."
        ]);

        exit;
    }
}

$company_name = trim($_POST["company_name"]);
$sponsor_email = trim($_POST["sponsor_email"]);
$sponsor_contact_no = trim($_POST["sponsor_contact_no"]);
$company_address = trim($_POST["company_address"] ?? "");
$username = trim($_POST["username"]);

$password = password_hash(
    trim($_POST["password"]),
    PASSWORD_BCRYPT
);

$status = $_POST["status"] ?? "activated";

$checkStmt = $conn->prepare("
    SELECT sponsor_id
    FROM sponsorships
    WHERE sponsor_email = ?
    OR username = ?
");

$checkStmt->bind_param(
    "ss",
    $sponsor_email,
    $username
);

$checkStmt->execute();
$checkStmt->store_result();

if ($checkStmt->num_rows > 0) {

    echo json_encode([
        "success" => false,
        "message" => "Email or username already exists."
    ]);

    exit;
}

$checkStmt->close();

$sponsor_logo = null;

if (!empty($_FILES["sponsor_logo"]["name"])) {

    $uploadDir = "../../../../image_data/sponsor_logo/";

    if (!is_dir($uploadDir)) {
        mkdir($uploadDir, 0755, true);
    }

    $ext = strtolower(
        pathinfo(
            $_FILES["sponsor_logo"]["name"],
            PATHINFO_EXTENSION
        )
    );

    $newName =
        "sponsor_" .
        time() .
        "_" .
        uniqid() .
        "." .
        $ext;

    $uploadPath = $uploadDir . $newName;

    move_uploaded_file(
        $_FILES["sponsor_logo"]["tmp_name"],
        $uploadPath
    );

    $sponsor_logo =
        "uploads/sponsor_logos/" . $newName;
}

$stmt = $conn->prepare("
    INSERT INTO sponsorships (
        sponsor_logo,
        sponsor_email,
        sponsor_contact_no,
        created_at,
        username,
        password,
        company_name,
        company_address,
        status
    )
    VALUES (
        ?, ?, ?, NOW(),
        ?, ?, ?, ?, ?
    )
");

$stmt->bind_param(
    "ssssssss", 
    $sponsor_logo,
    $sponsor_email,
    $sponsor_contact_no,
    $username,
    $password,
    $company_name,
    $company_address,
    $status
);

if ($stmt->execute()) {

    echo json_encode([
        "success" => true,
        "message" => "Sponsor added successfully."
    ]);

} else {

    echo json_encode([
        "success" => false,
        "message" => $stmt->error
    ]);
}

$stmt->close();
$conn->close();