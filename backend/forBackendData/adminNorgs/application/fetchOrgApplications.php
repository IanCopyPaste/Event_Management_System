<?php
include("../../../database/config.php");
$data = json_decode(file_get_contents("php://input"), true);
header("Content-type: application/json");

try {
    if (isset($data["org_application_id"])) {
        $query = "SELECT 
    oa.org_apply_id,
    oa.org_name,
    oa.org_email,
    oa.org_contact_no,
    oa.status,
    oa.created_at,

    u.users_id,
    CONCAT(u.first_name, ' ', u.middle_name, ' ', u.last_name) AS organizer,
    oa.additional_files,

    d.department_name

FROM org_application oa
JOIN users u ON oa.user_id = u.users_id
JOIN department d ON oa.department_id = d.department_id
WHERE oa.org_apply_id=?
ORDER BY oa.created_at";
        $stmt = mysqli_prepare($conn, $query);
        mysqli_stmt_bind_param($stmt, "i", $data["org_application_id"]);
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
        $query = "SELECT 
    oa.org_apply_id,
    oa.org_name,
    oa.org_email,
    oa.org_contact_no,
    oa.status,
    oa.created_at,
    u.users_id,
    CONCAT(u.first_name, ' ', u.middle_name, ' ', u.last_name) AS organizer,
    d.department_name
FROM org_application oa
JOIN users u ON oa.user_id = u.users_id
JOIN department d ON oa.department_id = d.department_id
ORDER BY oa.created_at DESC";

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
