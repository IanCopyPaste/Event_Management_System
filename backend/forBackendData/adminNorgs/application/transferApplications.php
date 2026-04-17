<?php
try {
    include("../../../database/config.php");
header("Content-type: application/json");

$data = json_decode(file_get_contents("php://input"), true);

$query = "INSERT INTO organizations (
    users_id,
    department_id,
    org_name,
    org_email,
    org_contact_no,
    org_username,
    org_password,
    created_at
)
SELECT
    oa.user_id,
    oa.department_id,
    oa.org_name,
    oa.org_email,
    oa.org_contact_no,
    oa.org_username,
    oa.org_password,
    oa.created_at
FROM org_application oa
WHERE oa.org_apply_id = ?
AND NOT EXISTS (
    SELECT 1
    FROM organizations o
    WHERE o.org_name = oa.org_name
    AND o.users_id = oa.user_id
)";

$stmt = mysqli_prepare($conn, $query);
mysqli_stmt_bind_param($stmt, "i", $data["applyID"]);

if (mysqli_stmt_execute($stmt)) {
    echo json_encode([
        "status" => true,
        "message" => "Transfer sakses"
    ]);
} else {
    echo json_encode([
        "status" => false,
        "message" => "Transfer failed from php"
    ]);
}
} catch (\Throwable $th) {
   echo json_encode([
        "status" => false,
        "message" => "Error occured from php"
    ]);
}
?>