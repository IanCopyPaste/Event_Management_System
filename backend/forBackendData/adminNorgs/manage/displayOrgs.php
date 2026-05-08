<?php
header("Content-Type: application/json");

require_once "../../../database/config.php";

$data = json_decode(file_get_contents("php://input"), true);

$org_id = isset($data["org_id"]) ? intval($data["org_id"]) : null;

if ($org_id) {

    $stmt = $conn->prepare("
        SELECT 
            o.*,
            d.department_name
        FROM organizations o
        LEFT JOIN department d
            ON o.department_id = d.department_id
        WHERE o.org_id = ?
    ");

    $stmt->bind_param("i", $org_id);
    $stmt->execute();

    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        echo json_encode([
            "status" => true,
            "record" => $result->fetch_assoc()
        ]);
    } else {
        echo json_encode([
            "status" => false,
            "message" => "Organization not found"
        ]);
    }

} else {

    $query = "
        SELECT 
            o.*,
            d.department_name
        FROM organizations o
        LEFT JOIN department d
            ON o.department_id = d.department_id
    ";

    $result = $conn->query($query);

    $records = [];

    while ($row = $result->fetch_assoc()) {
        $records[] = $row;
    }

    echo json_encode([
        "status" => true,
        "record" => $records
    ]);
}
?>