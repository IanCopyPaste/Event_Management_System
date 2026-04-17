<?php
try {
    include("../../../database/config.php");
    header("Content-Type: application/json");

    $data = json_decode(file_get_contents("php://input"), true);

    $newestFirst = $data["sortNewest"] ?? null;
    $status = $data["sortStatus"] ?? null;
    $search = $data["txtSearch"] ?? null;

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
    JOIN department d ON oa.department_id = d.department_id";

    $conditions = [];

    if (!empty($status) && $status != "all") {
        $conditions[] = "oa.status = '" . mysqli_real_escape_string($conn, $status) . "'";
    }

    if (!empty($search)) {
        $conditions[] = "oa.org_name LIKE '%" . mysqli_real_escape_string($conn, $search) . "%'";
    }

    if (count($conditions) > 0) {
        $query .= " WHERE " . implode(" AND ", $conditions);
    }

    if ($newestFirst == "newest") {
        $query .= " ORDER BY oa.created_at DESC";
    } elseif ($newestFirst == "oldest") {
        $query .= " ORDER BY oa.created_at ASC";
    } elseif ($newestFirst == "az") {
        $query .= " ORDER BY oa.org_name ASC";
    } elseif ($newestFirst == "za") {
        $query .= " ORDER BY oa.org_name DESC";
    }

    $result = mysqli_query($conn, $query);

    $output = [];

    if (mysqli_num_rows($result) > 0) {
        while ($row = mysqli_fetch_assoc($result)) {
            $output[] = $row;
        }

        echo json_encode([
            "status" => true,
            "message" => "result fetched succesfully",
            "record" => $output
        ]);
    } else {
        echo json_encode([
            "status" => false,
            "message" => "no results found"
        ]);
    }
} catch (Throwable $th) {
    echo json_encode([
        "status" => false,
        "message" => "error occured from php"
    ]);
}
