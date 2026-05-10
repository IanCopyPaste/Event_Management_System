<?php
session_start();
header('Content-Type: application/json');
include("../../database/config.php");

// Get the logged-in organizer's ID from the session
$org_id = isset($_SESSION['org_id']) ? $_SESSION['org_id'] : 1; 

// Query: Get packages linked to the sponsor and the organizer's pending events
$query = "SELECT 
            p.package_id, p.package_name, p.description, p.benefits, p.approval_status AS offer_status, p.created_at AS offer_date,
            s.company_name, s.sponsor_email, s.sponsor_logo, s.sponsor_contact_no, s.company_address,
            e.event_name, e.location, e.start_date, e.status AS event_lifecycle
          FROM packages p
          JOIN sponsorships s ON p.sponsor_id = s.sponsor_id
          JOIN events e ON p.event_id = e.event_id
          WHERE e.org_id = ? AND e.approval_status = 'pending'
          ORDER BY p.created_at DESC";

$stmt = $conn->prepare($query);
$stmt->bind_param("i", $org_id);
$stmt->execute();
$result = $stmt->get_result();

$offers = [];
while ($row = $result->fetch_assoc()) {
    $offers[] = $row;
}

echo json_encode(['success' => true, 'offers' => $offers]);

$stmt->close();
$conn->close();
?>