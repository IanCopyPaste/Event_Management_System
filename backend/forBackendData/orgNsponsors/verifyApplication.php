<?php
include("../../database/config.php");
header("Content-Type: application/json");
$data = json_decode(file_get_contents("php://input"), true);

$query = "SELECT * FROM advertisement WHERE event_id=? AND package_id=? AND status = 'pending'";
$stmt = mysqli_prepare($conn, $query);
mysqli_stmt_bind_param($stmt, "ii", $data["event_id"], $data["pack_id"]);

$packs = [];

if (mysqli_stmt_execute($stmt)) {
    $result = mysqli_stmt_get_result($stmt);
    if (mysqli_num_rows($result) > 0) {
        echo json_encode([
            "status" => true,
            "message" => "organizer already registered"
        ]);
    }else{
        echo json_encode([
            "status" => false,
            "message" => "organizer is not yet registered"
        ]);
    }
} else {
    echo json_encode([
        "status" => false,
        "message" => "query execution failed"
    ]);
}
