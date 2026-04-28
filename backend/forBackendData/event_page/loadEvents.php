<?php
include("../../database/config.php");
header("Content-Type: application/json");

$query = "select * from events";
$result = mysqli_query($conn, $query);

$events = [];

while($row = mysqli_fetch_assoc($result)){
    $events[] = $row;
}

echo json_encode($events);
?>
