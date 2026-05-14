<?php

header("Content-Type: application/json");
session_start();

require_once "../../database/config.php";

if (!isset($_GET["event_id"])) {
    echo json_encode([
        "success" => false,
        "message" => "Missing event ID"
    ]);
    exit;
}

$event_id = intval($_GET["event_id"]);



/* =========================================================
   EVENT INFO
========================================================= */

$eventQuery = "
SELECT
    event_id,
    event_name,
    description,
    location,
    start_date,
    end_date,
    start_time,
    end_time,
    capacity,
    slot_taken,
    status,
    approval_status
FROM events
WHERE event_id = ?
";

$stmt = mysqli_prepare($conn, $eventQuery);
mysqli_stmt_bind_param($stmt, "i", $event_id);
mysqli_stmt_execute($stmt);

$eventResult = mysqli_stmt_get_result($stmt);

$event = mysqli_fetch_assoc($eventResult);



/* =========================================================
   RESPONDENTS
========================================================= */

$respondentsQuery = "
SELECT

    r.response_id,
    r.created_at AS registered_at,

    u.users_id,
    u.first_name,
    u.middle_name,
    u.last_name,
    u.email,
    u.profile_pic,
    u.year_level,
    u.program_id,
    u.contact_no,
    u.status,
    u.last_logged

FROM responses r

INNER JOIN users u
ON r.users_id = u.users_id

WHERE r.event_id = ?

ORDER BY r.created_at DESC
";

$stmt = mysqli_prepare($conn, $respondentsQuery);
mysqli_stmt_bind_param($stmt, "i", $event_id);
mysqli_stmt_execute($stmt);

$result = mysqli_stmt_get_result($stmt);

$respondents = [];

while ($row = mysqli_fetch_assoc($result)) {
    $respondents[] = $row;
}



/* =========================================================
   STATS
========================================================= */

$totalRegistrants = count($respondents);

$remainingSlots =
    intval($event["capacity"]) -
    intval($event["slot_taken"]);

$percentage = 0;

if ($event["capacity"] > 0) {

    $percentage = round(
        ($event["slot_taken"] / $event["capacity"]) * 100
    );
}



echo json_encode([
    "success" => true,

    "event" => $event,

    "stats" => [
        "total_registrants" => $totalRegistrants,
        "remaining_slots" => $remainingSlots,
        "percentage" => $percentage
    ],

    "respondents" => $respondents
]);

?>