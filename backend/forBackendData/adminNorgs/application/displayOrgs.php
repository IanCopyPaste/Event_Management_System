<?php
include("../../../database/config.php");
header("Content-Type: application/json");

$data = json_decode(file_get_contents("php://input"), true);

try {

    if (!empty($data["org_id"])) {

        $query = "SELECT 
            o.org_id,
            o.users_id,
            o.org_name,
            o.org_email,
            o.org_contact_no,
            dpt.department_name,
            o.created_at,
            CONCAT(u.first_name,' ',u.middle_name,' ',u.last_name) AS organizer
        FROM organizations o
        JOIN department dpt ON o.department_id = dpt.department_id
        JOIN users u ON o.users_id = u.users_id
        WHERE o.org_id = ?";

        $stmt = mysqli_prepare($conn, $query);
        mysqli_stmt_bind_param($stmt, "i", $data["org_id"]);
        mysqli_stmt_execute($stmt);
        $result = mysqli_stmt_get_result($stmt);

        if (mysqli_num_rows($result) > 0) {
            echo json_encode([
                "status" => true,
                "record" => mysqli_fetch_assoc($result)
            ]);
        } else {
            echo json_encode([
                "status" => false,
                "message" => "not found"
            ]);
        }

    } else {
        $query = "SELECT 
            o.org_id,
            o.users_id,
            o.org_name,
            o.org_email,
            o.org_contact_no,
            dpt.department_name,
            CONCAT(u.first_name,' ',u.middle_name,' ',u.last_name) AS organizer,
            o.created_at
        FROM organizations o
        JOIN department dpt ON o.department_id = dpt.department_id
        JOIN users u ON o.users_id = u.users_id";

        $stmt = mysqli_prepare($conn, $query);
        mysqli_stmt_execute($stmt);
        $result = mysqli_stmt_get_result($stmt);

        $output = [];

        while ($row = mysqli_fetch_assoc($result)) {
            $output[] = $row;
        }

        echo json_encode([
            "status" => true,
            "record" => $output
        ]);
    }

} catch (\Throwable $th) {
    echo json_encode([
        "status" => false,
        "message" => "error occured fetching"
    ]);
}
?>