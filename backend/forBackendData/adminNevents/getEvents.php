<?php
include("../../database/config.php");
header("Content-Type: application/json");

$query = "SELECT 
    e.event_id,
    e.event_name,
    e.description,
    e.location,
    e.start_date,
    e.end_date,
    e.start_time,
    e.end_time,
    e.registration_deadline,
    e.capacity,
    e.slot_taken,
    e.event_bg_picture,
    e.status,
    e.restrictions,
    e.approval_status,
    e.created_at AS event_created_at,

    o.org_name,
    o.org_email,
    o.org_contact_no,
    o.org_logo,

    d.department_name,
    d.department_logo

FROM events e
JOIN organizations o ON e.org_id = o.org_id
JOIN department d ON o.department_id = d.department_id
ORDER BY e.created_at DESC;";
$stmt = mysqli_prepare($conn, $query);
if (mysqli_stmt_execute($stmt)) {

    $result = mysqli_stmt_get_result($stmt);

    $records = [];

    while ($row = mysqli_fetch_assoc($result)) {
        $records[] = $row;
    }

    echo json_encode([
        "status" => true,
        "message" => "event info fetched successful",
        "records" => $records
    ]);
}else{
    echo json_encode([
        "status" => false,
        "message" => "event info fetched unsuccessful"
    ]);
}
