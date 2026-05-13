<?php
session_start();
include("../../database/config.php");
header("Content-Type: application/json");

$data = json_decode(file_get_contents("php://input"), true);
$event_id = $data["event_id"] ?? 0;

$query = "SELECT restrictions, status, slot_taken, capacity, registration_deadline FROM events WHERE event_id=?";
$stmt = mysqli_prepare($conn, $query);
mysqli_stmt_bind_param($stmt, "i", $event_id);

if (mysqli_stmt_execute($stmt)) {
    $result = mysqli_stmt_get_result($stmt);
    $row = mysqli_fetch_assoc($result);

    if (!$row) {
        echo json_encode(["status" => true, "message" => "Event not found."]);
        exit;
    }

    $restrict = json_decode($row['restrictions'], true);
    $userProgram = $_SESSION["users_program"];
    $userYear = $_SESSION["users_year"];
    
    $currentTime = time();
    $deadlineTime = strtotime($row["registration_deadline"]);

    // --- STEP-BY-STEP VERIFICATION ---

    // 1. Check Event Status
    if ($row["status"] === "finished" || $row["status"] === "ongoing") {
        echo json_encode([
            "status" => true,
            "reason" => "status",
            "message" => "Registration is closed because the event is already " . $row["status"] . "."
        ]);
        exit;
    }

    // 2. Check Deadline
    if ($currentTime > $deadlineTime) {
        echo json_encode([
            "status" => true,
            "reason" => "deadline",
            "message" => "The registration deadline for this event has passed."
        ]);
        exit;
    }

    // 3. Check Capacity
    if ($row["slot_taken"] >= $row["capacity"]) {
        echo json_encode([
            "status" => true,
            "reason" => "capacity",
            "message" => "Sorry, this event has reached its maximum capacity."
        ]);
        exit;
    }

    // 4. Check Program Restriction
    // Logic: If the restriction list is NOT empty and user is NOT in it
    if (!empty($restrict["programs"]) && !in_array($userProgram, $restrict["programs"])) {
        echo json_encode([
            "status" => false,
            "reason" => "program",
            "message" => "This event is not open to your specific academic program."
        ]);
        exit;
    }

    // 5. Check Year Level Restriction
    if (!empty($restrict["year_level"]) && !in_array($userYear, $restrict["year_level"])) {
        echo json_encode([
            "status" => true,
            "reason" => "year_level",
            "message" => "This event is restricted to other year levels."
        ]);
        exit;
    }

    // --- IF WE REACH HERE, USER IS ALLOWED ---
    echo json_encode([
        "status" => false,
        "message" => "User is allowed to register."
    ]);

} else {
    echo json_encode([
        "status" => true, 
        "message" => "Database error occurred."
    ]);
}
?>