<?php
header('Content-Type: application/json');
session_start();

include("../../database/config.php"); 

if (!isset($_SESSION['users_id'])) {
    echo json_encode(['success' => false, 'message' => 'Unauthorized access.']);
    exit;
}

$users_id = $_SESSION['users_id'];
$user_otp = $_POST['otp'] ?? '';

// 1. Verify the OTP
if (empty($_SESSION['profile_update_otp']) || $user_otp != $_SESSION['profile_update_otp']) {
    echo json_encode(['success' => false, 'message' => 'Invalid or expired OTP.']);
    exit;
}

// Once verified, clear the OTP so it can't be reused
unset($_SESSION['profile_update_otp']);

$current_password = $_POST['current_password'] ?? '';
$new_password = $_POST['new_password'] ?? '';

$update_fields = [];
$types = "";
$params = [];

// --- UPDATE PASSWORD ---
if (!empty($new_password)) {
    $stmt = $conn->prepare("SELECT password_hashed FROM users WHERE users_id = ?");
    $stmt->bind_param("i", $users_id);
    $stmt->execute();
    $result = $stmt->get_result();
    $row = $result->fetch_assoc();
    $stmt->close();

    if ($current_password === $row["password_hashed"]) {
        $update_fields[] = "password_hashed = ?";
        $types .= "s";
        $params[] = $new_password;
    } else {
        echo json_encode(['success' => false, 'message' => 'Your current password was incorrect.']);
        exit;
    }
}

// --- UPDATE LOGO ---
if (isset($_FILES['new_logo']) && $_FILES['new_logo']['error'] === UPLOAD_ERR_OK) {
    $upload_dir = '../../../image_data/admin_profile/'; 
    $file_info = pathinfo($_FILES['new_logo']['name']);
    $file_extension = strtolower($file_info['extension']);
    $allowed_exts = ['jpg', 'jpeg', 'png', 'gif'];

    if (in_array($file_extension, $allowed_exts)) {
        $new_filename = "users_" . $users_id . "_" . time() . "." . $file_extension;
        $destination = $upload_dir . $new_filename;

        if (move_uploaded_file($_FILES['new_logo']['tmp_name'], $destination)) {
            $update_fields[] = "profile_pic = ?";
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
    $sql = "UPDATE users SET " . implode(", ", $update_fields) . " WHERE users_id = ?";
    $types .= "i";
    $params[] = $users_id;

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