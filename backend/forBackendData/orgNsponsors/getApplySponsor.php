<?php
session_start();
include("../../database/config.php");
header("Content-Type: application/json");

$pack_id = $_GET['pack_id'] ?? 0;

$sql = "SELECT p.*, 
               s.company_name, 
               s.company_address, 
               s.sponsor_logo, 
               s.sponsor_email, 
               s.sponsor_contact_no
        FROM packages p
        JOIN sponsorships s ON p.sponsor_id = s.sponsor_id
        WHERE p.package_id = ?";

$stmt = mysqli_prepare($conn, $sql);
mysqli_stmt_bind_param($stmt, "i", $pack_id);
mysqli_stmt_execute($stmt);
$result = mysqli_stmt_get_result($stmt);

if($row = mysqli_fetch_assoc($result)){
    echo json_encode([
        "status" => true,
        "record" => $row
    ]);
}else{
    echo json_encode([
        "status" => false
    ]);
}