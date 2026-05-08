<?php
header("Content-Type: application/json");

require_once "../../../database/config.php";

$data = json_decode(file_get_contents("php://input"), true);

$event_id = intval($data["event_id"] ?? 0);

$stmt = $conn->prepare("
    SELECT
        e.*,
        o.org_name,
        o.org_email,
        o.org_contact_no,
        d.department_name
    FROM events e
    INNER JOIN organizations o
        ON e.org_id = o.org_id
    INNER JOIN department d
        ON o.department_id = d.department_id
    WHERE e.event_id = ?
");

$stmt->bind_param("i", $event_id);

$stmt->execute();

$result = $stmt->get_result();

if ($result->num_rows <= 0) {

    echo json_encode([
        "status" => false,
        "message" => "Event not found"
    ]);

    exit;
}

$row = $result->fetch_assoc();

$restrictions = json_decode($row["restrictions"], true);

$programNames = [];

if (
    isset($restrictions["programs"]) &&
    is_array($restrictions["programs"]) &&
    count($restrictions["programs"]) > 0
) {

    $programIds = array_map("intval", $restrictions["programs"]);

    // SAFE: convert to comma string instead of bind_param
    $idList = implode(",", $programIds);

    $programQuery = "
        SELECT prog_abv
        FROM programs
        WHERE program_id IN ($idList)
    ";

    $progResult = $conn->query($programQuery);

    if ($progResult) {
        while ($prog = $progResult->fetch_assoc()) {
            $programNames[] = $prog["prog_abv"];
        }
    }
}
$row["program_names"] = $programNames;

echo json_encode([
    "status" => true,
    "message" => "hi",
    "records" => $row
]);
