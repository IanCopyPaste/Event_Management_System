<?php
include("../../database/config.php");
header("Content-Type: application/json");
$data = json_decode(file_get_contents("php://input"),true);

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
WHERE e.event_id=?
ORDER BY e.created_at DESC";
$stmt = mysqli_prepare($conn, $query);
mysqli_stmt_bind_param($stmt,"i",$data["event_id"]);
if (mysqli_stmt_execute($stmt)) {

    $result = mysqli_stmt_get_result($stmt);
    echo json_encode([
        "status" => true,
        "message" => "event info fetched successful",
        "records" => mysqli_fetch_assoc($result),
        "id" => $data["event_id"]
    ]);
}else{
    echo json_encode([
        "status" => false,
        "message" => "event info fetched unsuccessful"
    ]);
}
