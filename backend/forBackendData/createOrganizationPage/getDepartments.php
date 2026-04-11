<?php
include("../../database/config.php");
header("Content-Type: application/json");

$query = "SELECT * FROM department";
$stmt = mysqli_prepare($conn, $query);
mysqli_stmt_execute($stmt);

$result = mysqli_stmt_get_result($stmt);

$dept = [];

while ($row = mysqli_fetch_assoc($result)) {
    $dept[] = $row;
}

echo json_encode($dept);
?>