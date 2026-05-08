<?php
session_start();
header("Content-Type: application/json");

require_once "../../../database/config.php";

$data = json_decode(file_get_contents("php://input"), true);

$event_id = $data["event_id"] ?? null;

if ($event_id) {

    $stmt = $conn->prepare("
        SELECT
            e.*,
            o.org_name,
            d.department_name
        FROM events e
        INNER JOIN organizations o
            ON e.org_id = o.org_id
        INNER JOIN department d
            ON o.department_id = d.department_id
        WHERE e.event_id = ? AND WHERE e.org_id=?
    ");

    $stmt->bind_param("ii", $event_id, $_SESSION["org_id"]);
    $stmt->execute();

    $result = $stmt->get_result();

    if ($result->num_rows > 0) {

        echo json_encode([
            "status" => true,
            "records" => $result->fetch_assoc()
        ]);
    } else {

        echo json_encode([
            "status" => false,
            "message" => "No event found"
        ]);
    }
} else {
    $query = "
    SELECT
        e.*,
        o.org_name,
        d.department_name
    FROM events e
    INNER JOIN organizations o
        ON e.org_id = o.org_id
    INNER JOIN department d
        ON o.department_id = d.department_id
    WHERE e.org_id = ?
    ORDER BY e.created_at DESC
";

    $stmt = $conn->prepare($query);

    if (!$stmt) {
        echo json_encode([
            "status" => false,
            "message" => "Prepare failed: " . $conn->error
        ]);
        exit;
    }

    $stmt->bind_param("i", $_SESSION["org_id"]);
    $stmt->execute();

    $result = $stmt->get_result();

    $records = [];

    while ($row = $result->fetch_assoc()) {
        $records[] = $row;
    }

    echo json_encode([
        "status" => true,
        "org_id" => $_SESSION["org_id"],
        "records" => $records
    ]);
}
