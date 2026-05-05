<?php
include("../../../database/config.php");
$data = json_decode(file_get_contents("php://input"), true);
header("Content-type: application/json");

try {
    if (isset($data["sponsor_id"])) {
        $query = "SELECT * FROM sponsorships WHERE sponsor_id=?";
        $stmt = mysqli_prepare($conn, $query);
        mysqli_stmt_bind_param($stmt, "i", $data["sponsor_id"]);
        mysqli_stmt_execute($stmt);
        $result = mysqli_stmt_get_result($stmt);
        $row = mysqli_fetch_assoc($result);

        if ($row) {
            echo json_encode([
                "status" => true,
                "message" => "fetched success",
                "record" => $row
            ]);
        } else {
            echo json_encode([
                "status" => false,
                "message" => "no record found",
            ]);
        }
    } else {
        $query = "SELECT * FROM sponsorships WHERE approval_status<>'approved'";
        $stmt = mysqli_prepare($conn, $query);
        mysqli_stmt_execute($stmt);
        $result = mysqli_stmt_get_result($stmt);

        $org_applies = [];

        if ($result && mysqli_num_rows($result) > 0) {
            while ($row = mysqli_fetch_assoc($result)) {
                $org_applies[] = $row;
            }
            echo json_encode([
                "status" => true,
                "message" => "fetched success",
                "record" => $org_applies
            ]);
        } else {
            echo json_encode([
                "status" => false,
                "message" => "no record found"
            ]);
        }
    }
} catch (\Throwable $th) {
    echo json_encode([
        "status" => false,
        "message" => "error occured fetching"
    ]);
}
