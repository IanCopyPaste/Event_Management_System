<?php

header("Content-Type: application/json");

require_once "../../database/config.php";

$query = "
SELECT *
FROM events
WHERE approval_status = 'pending'
ORDER BY created_at DESC
";

$result = mysqli_query($conn, $query);

$records = [];

while($row = mysqli_fetch_assoc($result)){

    $restrictions = json_decode($row["restrictions"], true);

    // DEFAULTS
    $restrictions["year_level"] = $restrictions["year_level"] ?? [];
    $restrictions["programs"] = $restrictions["programs"] ?? [];

    $programs = [];

    // GET PROGRAM DETAILS
    if(count($restrictions["programs"]) > 0){

        $programIDs = implode(",", array_map("intval", $restrictions["programs"]));

        $programQuery = "
        SELECT 
            program_id,
            program_name,
            program_logo,
            prog_abv
        FROM programs
        WHERE program_id IN ($programIDs)
        ";

        $programResult = mysqli_query($conn, $programQuery);

        while($prog = mysqli_fetch_assoc($programResult)){
            $programs[] = $prog;
        }
    }

    $records[] = [
        "event_id" => $row["event_id"],
        "event_name" => $row["event_name"],
        "description" => $row["description"],
        "location" => $row["location"],
        "start_date" => $row["start_date"],
        "end_date" => $row["end_date"],
        "start_time" => $row["start_time"],
        "end_time" => $row["end_time"],
        "registration_deadline" => $row["registration_deadline"],
        "capacity" => $row["capacity"],
        "slot_taken" => $row["slot_taken"],
        "status" => $row["status"],
        "event_bg_picture" => $row["event_bg_picture"],
        "approval_status" => $row["approval_status"],
        "created_at" => $row["created_at"],

        "restrictions" => [
            "year_level" => $restrictions["year_level"]
        ],

        "programs" => $programs
    ];
}

echo json_encode([
    "status" => true,
    "records" => $records
]);