<?php
header("Content-Type: application/json");

require_once "../../../database/config.php";

$query = "
    SELECT *
    FROM department
    WHERE status = 'active'
    ORDER BY department_name ASC
";

$result = $conn->query($query);

$departments = [];

while ($row = $result->fetch_assoc()) {
    $departments[] = $row;
}

echo json_encode([
    "status" => true,
    "departments" => $departments
]);
?>