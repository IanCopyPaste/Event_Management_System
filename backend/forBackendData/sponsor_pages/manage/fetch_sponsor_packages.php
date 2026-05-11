<?php
header('Content-Type: application/json');
session_start();
include("../../../database/config.php");

if (!isset($_SESSION['sponsor_id'])) {
    echo json_encode(["error" => "Unauthorized access. Please log in."]);
    exit;
}

$sponsor_id = $_SESSION['sponsor_id'];

// Added extra columns for Event and Org details
$sql = "SELECT 
            p.package_id, 
            p.package_name, 
            p.description AS package_description, 
            p.benefits, 
            p.status AS package_live_status, 
            p.approval_status, 
            p.created_at AS package_created, 
            e.event_id,
            e.event_name, 
            e.event_bg_picture,
            e.description AS event_description,
            e.location,
            e.start_date,
            e.start_time,
            e.end_date,
            e.end_time,
            e.status AS event_live_status,
            e.approval_status AS event_approval_status,
            e.capacity,
            e.slot_taken,
            o.org_name, 
            o.org_logo,
            o.org_email,
            o.org_contact_no
        FROM packages p
        INNER JOIN events e ON p.event_id = e.event_id
        INNER JOIN organizations o ON e.org_id = o.org_id
        WHERE p.sponsor_id = ?
        ORDER BY p.created_at DESC";

$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $sponsor_id);
$stmt->execute();
$result = $stmt->get_result();

$packages = [];
while ($row = $result->fetch_assoc()) {
    $packages[] = $row;
}

echo json_encode($packages);
$stmt->close();
$conn->close();
?>