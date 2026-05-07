<?php
include("../../../database/config.php");

header("Content-Type: application/json");

$data = json_decode(file_get_contents("php://input"), true);

$advertisement_id = $data["advertisement_id"] ?? null;

$query = "
SELECT 
    a.advertisement_id,
    a.additional_files,
    a.status AS application_status,
    a.agreement_status,
    a.created_at AS applied_at,

    e.event_id,
    e.event_name,
    e.description AS event_description,
    e.location,
    e.start_date,
    e.end_date,
    e.start_time,
    e.end_time,
    e.registration_deadline,
    e.capacity,
    e.slot_taken,
    e.status AS event_status,
    e.event_bg_picture,
    e.restrictions,

    p.package_id,
    p.package_name,
    p.description AS package_description,
    p.price,
    p.benefits,
    p.package_bg,

    o.org_id,
    o.org_name,
    o.org_email,
    o.org_contact_no,
    o.org_logo,

    u.users_id,
    CONCAT(
        u.first_name, ' ',
        IFNULL(u.middle_name, ''), ' ',
        u.last_name
    ) AS representative_name,
    u.email AS representative_email,
    u.profile_pic,
    u.year_level,

    prog.program_id,
    prog.program_name,
    prog.prog_abv,
    prog.program_logo,

    d.department_id,
    d.department_name,
    d.department_logo

FROM advertisement a

INNER JOIN events e 
    ON a.event_id = e.event_id

INNER JOIN packages p 
    ON a.package_id = p.package_id

INNER JOIN organizations o 
    ON e.org_id = o.org_id

INNER JOIN users u 
    ON o.users_id = u.users_id

LEFT JOIN programs prog 
    ON u.program_id = prog.program_id

LEFT JOIN department d 
    ON o.department_id = d.department_id
";

if ($advertisement_id !== null) {

    $query .= " WHERE a.advertisement_id = ? ";

} else{
      $query .= " WHERE a.status = 'approved' ";
}

$query .= " ORDER BY a.created_at DESC ";

$stmt = mysqli_prepare($conn, $query);

if (!$stmt) {

    echo json_encode([
        "status" => false,
        "message" => "prepare failed"
    ]);

    exit;
}

if ($advertisement_id !== null) {

    mysqli_stmt_bind_param($stmt, "i", $advertisement_id);

}

if (mysqli_stmt_execute($stmt)) {

    $result = mysqli_stmt_get_result($stmt);

    if ($advertisement_id !== null) {

        $record = mysqli_fetch_assoc($result);

        echo json_encode([
            "status" => true,
            "message" => "query execution success",
            "record" => $record
        ]);

    } else {

        $records = [];

        while ($row = mysqli_fetch_assoc($result)) {

            $records[] = $row;

        }

        echo json_encode([
            "status" => true,
            "message" => "query execution success",
            "records" => $records
        ]);
    }

} else {

    echo json_encode([
        "status" => false,
        "message" => "query execution failed"
    ]);
}
?>
