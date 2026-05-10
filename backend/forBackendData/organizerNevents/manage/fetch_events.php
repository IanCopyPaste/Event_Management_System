<?php
session_start();
header('Content-Type: application/json');
require_once "../../../database/config.php";

$org_id = $_SESSION['org_id'];
$now = date('Y-m-d H:i:s');

$status_update_query = "
    UPDATE events 
    SET status = CASE 
        WHEN status = 'cancelled' THEN 'cancelled'
        WHEN status = 'rescheduled' THEN 'rescheduled'
        WHEN '$now' > CONCAT(end_date, ' ', end_time) THEN 'finished'
        WHEN '$now' BETWEEN CONCAT(start_date, ' ', start_time) AND CONCAT(end_date, ' ', end_time) THEN 'ongoing'
        ELSE status
    END
    WHERE org_id = ? AND status != 'finished'";

$stmt_upd = $conn->prepare($status_update_query);
$stmt_upd->bind_param("i", $org_id);
$stmt_upd->execute();

$query = "SELECT * FROM events WHERE org_id = ? ORDER BY created_at DESC";
$stmt = $conn->prepare($query);
$stmt->bind_param("i", $org_id);
$stmt->execute();
$events = $stmt->get_result()->fetch_all(MYSQLI_ASSOC);

$prog_query = "SELECT program_id, prog_abv FROM programs";
$prog_result = $conn->query($prog_query);
$programs = $prog_result->fetch_all(MYSQLI_ASSOC);

echo json_encode([
    "events" => $events,
    "programs" => $programs
]);