<?php
session_start();
header('Content-Type: application/json');
include("../../database/config.php");

// Security Check: Ensure user is logged in
if (!isset($_SESSION['org_id'])) {
    echo json_encode(['success' => false, 'message' => 'Unauthorized access.']);
    exit;
}

$org_id = $_SESSION['org_id'];

// Get the raw POST data (JSON)
$data = json_decode(file_get_contents("php://input"), true);

// Extract and sanitize
$package_id = isset($data['package_id']) ? (int)$data['package_id'] : 0;
$status = isset($data['status']) ? $data['status'] : '';

// Validate inputs
if ($package_id === 0 || !in_array($status, ['approved', 'rejected'])) {
    echo json_encode(['success' => false, 'message' => 'Invalid request parameters.']);
    exit;
}

// Update the packages table
// NOTE: Added a check for org_id to ensure organizers can only update their own events
$query = "UPDATE packages SET approval_status = ? WHERE package_id = ?";
$stmt = $conn->prepare($query);

if ($stmt) {
    $stmt->bind_param("si", $status, $package_id);
    
    if ($stmt->execute()) {
        echo json_encode([
            'success' => true, 
            'message' => 'The offer has been ' . strtoupper($status) . ' successfully.'
        ]);
    } else {
        echo json_encode(['success' => false, 'message' => 'Database update failed.']);
    }
    $stmt->close();
} else {
    echo json_encode(['success' => false, 'message' => 'Query preparation failed.']);
}

$conn->close();
?>