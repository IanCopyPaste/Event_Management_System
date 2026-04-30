<?php
try {
    session_start();
    include("../database/config.php");
    header("Content-Type: application/json");

    $query = "SELECT d.department_name ,o.org_name, e.event_id, e.event_name, e.description, e.location, e.start_date, e.end_date, e.start_time, e.end_time,
e.registration_deadline, e.capacity, e.slot_taken, e.status, e.event_bg_picture, r.created_at from responses r 
    JOIN events e ON e.event_id = r.event_id
    JOIN organizations o ON e.org_id = o.org_id
    JOIN department d ON d.department_id = o.department_id
    WHERE r.users_id=?";
    $stmt = mysqli_prepare($conn, $query);
    mysqli_stmt_bind_param($stmt, "i", $_SESSION["users_id"]);

    $record = [];

    if (mysqli_stmt_execute($stmt)) {
        $result = mysqli_stmt_get_result($stmt);

        while ($row = mysqli_fetch_assoc($result)) {
            $record[] = $row;
        }

        echo json_encode([
            "status" => true,
            "message" => "query executed success",
            "record" => $record
        ]);
    } else {
        echo json_encode([
            "status" => false,
            "message" => "query execution failed"
        ]);
    }
} catch (\Throwable $th) {
    echo json_encode([
        "status" => false,
        "message" => "error occured in php"
    ]);
}
