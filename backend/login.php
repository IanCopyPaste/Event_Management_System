<?php
include("../database/config.php");
header("Content-Type: application/json");

$query = "SELECT * FROM clients";
$result = $conn->execute_query($query);
$data = mysqli_fetch_assoc($result);

if($data){
    echo json_encode($data);
}else{
    echo json_encode([
        "status" => "not connected"
    ]);
}
?>