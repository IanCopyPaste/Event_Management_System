<?php
header('Content-Type: application/json');
session_start();

include("../../database/config.php"); 

if (!isset($_SESSION['org_id'])) {
    echo json_encode(['success' => false, 'message' => 'Unauthorized access.']);
    exit;
}

$org_id = $_SESSION['org_id'];
$user_otp = $_POST['otp'] ?? '';

// 1. Verify the OTP
if (empty($_SESSION['profile_update_otp']) || $user_otp != $_SESSION['profile_update_otp']) {
    echo json_encode(['success' => false, 'message' => 'Invalid or expired OTP.']);
    exit;
}

// Once verified, clear the OTP so it can't be reused
unset($_SESSION['profile_update_otp']);

$username = $_POST['username'] ?? '';
$current_password = $_POST['current_password'] ?? '';
$new_password = $_POST['new_password'] ?? '';

$update_fields = [];
$types = "";
$params = [];

// --- UPDATE USERNAME ---
if (!empty($username)) {
    $update_fields[] = "org_username = ?";
    $types .= "s";
    $params[] = $username;
}

// --- UPDATE PASSWORD ---
if (!empty($new_password)) {
    $stmt = $conn->prepare("SELECT org_password FROM organizations WHERE org_id = ?");
    $stmt->bind_param("i", $org_id);
    $stmt->execute();
    $result = $stmt->get_result();
    $row = $result->fetch_assoc();
    $stmt->close();

    if (password_verify($current_password, $row['org_password'])) {
        $hashed_password = password_hash($new_password, PASSWORD_DEFAULT);
        $update_fields[] = "org_password = ?";
        $types .= "s";
        $params[] = $hashed_password;
    } else {
        echo json_encode(['success' => false, 'message' => 'Your current password was incorrect.']);
        exit;
    }
}

// --- UPDATE LOGO ---
if (isset($_FILES['new_logo']) && $_FILES['new_logo']['error'] === UPLOAD_ERR_OK) {
    $upload_dir = '../../../image_data/org_logo/'; 
    $file_info = pathinfo($_FILES['new_logo']['name']);
    $file_extension = strtolower($file_info['extension']);
    $allowed_exts = ['jpg', 'jpeg', 'png', 'gif'];

    if (in_array($file_extension, $allowed_exts)) {
        $new_filename = "org_" . $org_id . "_" . time() . "." . $file_extension;
        $destination = $upload_dir . $new_filename;

        if (move_uploaded_file($_FILES['new_logo']['tmp_name'], $destination)) {
            $update_fields[] = "org_logo = ?";
            $types .= "s";
            $params[] = $new_filename;
        } else {
            echo json_encode(['success' => false, 'message' => 'Failed to save the image.']);
            exit;
        }
    } else {
        echo json_encode(['success' => false, 'message' => 'Invalid file format.']);
        exit;
    }
}

// --- EXECUTE UPDATE ---
if (count($update_fields) > 0) {
    $sql = "UPDATE organizations SET " . implode(", ", $update_fields) . " WHERE org_id = ?";
    $types .= "i";
    $params[] = $org_id;

    $stmt = $conn->prepare($sql);
    $stmt->bind_param($types, ...$params);

    if ($stmt->execute()) {
        echo json_encode(['success' => true, 'message' => 'Profile updated successfully.']);
    } else {
        echo json_encode(['success' => false, 'message' => 'Database error.']);
    }
    $stmt->close();
} else {
    echo json_encode(['success' => true, 'message' => 'No changes were made.']);
}

$conn->close();
?>