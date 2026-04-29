<?php
session_start();
include("../../database/config.php");
header("Content-Type: application/json");

$data = json_decode(file_get_contents("php://input"), true);

$query = "SELECT restrictions, status FROM events WHERE event_id=?";
$stmt = mysqli_prepare($conn, $query);
mysqli_stmt_bind_param($stmt,"i",$data["event_id"]);

if(mysqli_stmt_execute($stmt)){
    $result = mysqli_stmt_get_result($stmt);
    $row = mysqli_fetch_assoc($result);

    $restrict = json_decode($row['restrictions'], true);

    $userProgram = $_SESSION["users_program"];
    $userYear = $_SESSION["users_year"];

    $isProgramAllowed = in_array($userProgram, $restrict["programs"]);
    $isYearAllowed = in_array($userYear, $restrict["year_level"]);

    if($isProgramAllowed || $isYearAllowed || ($row["status"] == "ongoing") || ($row["status"] == "finished")){
        echo json_encode([
            "status" => true,
            "message" => "user is restricted",
            "restrictions" => $restrict
        ]);
    }else{
        echo json_encode([
            "status" => false,
            "message" => "user is allowed"
        ]);
    }
}else{
    echo json_encode([
        "status" => false,
        "message" => "query execution failed"
    ]);
}
?>