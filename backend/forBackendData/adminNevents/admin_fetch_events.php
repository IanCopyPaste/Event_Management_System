<?php
header('Content-Type: application/json');
require_once "../../database/config.php";

// 1. Fetch all events
$eventsQuery = "
    SELECT 
        e.*, 
        o.org_name, o.org_email, o.org_contact_no, 
        d.department_name
    FROM events e
    LEFT JOIN organizations o ON e.org_id = o.org_id
    LEFT JOIN department d ON o.department_id = d.department_id
    ORDER BY e.created_at DESC
";
$eventsResult = $conn->query($eventsQuery);
$events = $eventsResult->fetch_all(MYSQLI_ASSOC);

// 2. Fetch all packages
$packagesQuery = "
    SELECT 
        p.event_id, p.package_name, p.description, p.benefits,
        s.company_name, s.sponsor_email, s.sponsor_contact_no
    FROM packages p
    INNER JOIN sponsorships s ON p.sponsor_id = s.sponsor_id
";
$packagesResult = $conn->query($packagesQuery);
$packages = [];
while ($row = $packagesResult->fetch_assoc()) {
    $packages[$row['event_id']][] = $row;
}

// 3. Fetch all programs ONCE to build a dictionary in PHP
// Note: Using prog_abbreviation based on your table schema 
$progQuery = "SELECT program_id, prog_abv FROM programs";
$progResult = $conn->query($progQuery);
$progMap = [];
if ($progResult && $progResult->num_rows > 0) {
    while ($row = $progResult->fetch_assoc()) {
        $progMap[$row['program_id']] = $row['prog_abv'];
    }
}

// 4. Decode restrictions and attach "program_names" to each event
foreach ($events as &$event) {
    $programNames = [];
    $restrictions = json_decode($event['restrictions'], true);
    
    // Check if the event has restricted programs
    if (isset($restrictions["programs"]) && is_array($restrictions["programs"])) {
        foreach ($restrictions["programs"] as $pid) {
            // Translate ID to Abbreviation if it exists
            if (isset($progMap[$pid])) {
                $programNames[] = $progMap[$pid];
            } else {
                $programNames[] = $pid; // Fallback to ID just in case
            }
        }
    }
    
    // Attach the translated array straight to the event object
    $event['program_names'] = $programNames;
}
unset($event); // Break the reference

// 5. Output Final JSON
echo json_encode([
    'status' => true,
    'events' => $events,
    'packages' => $packages
]);