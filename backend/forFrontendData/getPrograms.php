<?php
try {
    include("../database/config.php");
header("Content-Type: application/json");

$query = "SELECT * FROM programs";
$stmt = mysqli_prepare($conn,$query);
mysqli_stmt_execute($stmt);
$result = mysqli_stmt_get_result($stmt);

$programs = [];

while($row = mysqli_fetch_assoc($result)){
    $programs[] = $row;
}

echo json_encode([
    "status" => true,
    "message" => "records fetch success",
    "records" => $programs
]);
} catch (\Throwable $th) {
   echo json_encode([
    "status" => false,
    "message" => "error occured from php"
   ]);
}
?>