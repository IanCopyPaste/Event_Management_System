<?php
include("../../database/config.php");
header("Content-Type: application/json");
$data = json_decode(file_get_contents("php://input"), true);

$query = "DELETE FROM advertisement WHERE event_id=? AND package_id=?";
$stmt = mysqli_prepare($conn, $query);
mysqli_stmt_bind_param($stmt, "ii", $data["event_id"], $data["pack_id"]);

if (mysqli_stmt_execute($stmt)) {
    $result = mysqli_stmt_get_result($stmt);
    if (mysqli_affected_rows($conn) > 0) {
        echo json_encode([
            "status" => true,
            "message" => "advertisement application deleted"
        ]);
    }else{
        echo json_encode([
            "status" => false,
            "message" => "advertisement application not deleted"
        ]);
    }
} else {
    echo json_encode([
        "status" => false,
        "message" => "query execution failed"
    ]);
}
