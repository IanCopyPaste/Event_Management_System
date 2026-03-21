<?php
include("../database/config.php");
header("Content-Type: application/json");
session_start();

$query = "SELECT * FROM clients WHERE id = ?";
$result = $conn->execute_query($query);
$data = mysqli_fetch_assoc($result);
$client = [];

while($data = mysqli_fetch_assoc($result)){
    $client[] = $data;
}

if($data){
    echo json_encode($data);
}else{
    echo json_encode([
        "status" => "not connected"
    ]);
}
?>