<?php
try {
    session_start();
    include("../../database/config.php");
    header("Content-Type: application/json");
    $data = json_decode(file_get_contents("php://input"), true);

    $query = "SELECT * FROM sponsorships WHERE username=?";
    $stmt = mysqli_prepare($conn, $query);
    mysqli_stmt_bind_param($stmt, "s", $data["username"]);

    $records = [];

    if (mysqli_stmt_execute($stmt)) {
        $result = mysqli_stmt_get_result($stmt);
        if (mysqli_num_rows($result) > 0) {

            $row = mysqli_fetch_assoc($result);

            if(($row["status"] != "activated")){
                echo json_encode([
                   "status" => false,
                   "message" => "Your Sponsor Account cannot be logged in, Please Contact Admin for Further Assistance" 
                ]);
                die;
            }

            if ($data["username"] == $row["username"] && password_verify($data["password"], $row["password"])) {
                $records[] = $row;

                $_SESSION["sponsor_id"] = $row["sponsor_id"];
                $_SESSION["sponsor_name"] = $row["company_name"];
                $_SESSION["sponsor_address"] = $row["company_address"];
                //$_SESSION["sponsor_desc"] = $row["description"];
                $_SESSION["sponsor_logo"] = $row["sponsor_logo"];
                $_SESSION["sponsor_email"] = $row["sponsor_email"];
                $_SESSION["sponsor_contact"] = $row["sponsor_contact_no"];
                $_SESSION["sponsor_status"] = $row["status"];
                $_SESSION["created_at"] = $row["created_at"];
                $_SESSION["sponsor_username"] = $row["username"];
                $_SESSION["sponsor_password"] = $row["password"];

                echo json_encode([
                    "status" => true,
                    "message" => "Welcome! " . $row["company_name"],
                    "records" => $records
                ]);
            } else {
                echo json_encode([
                    "status" => false,
                    "message" => "Incorrect username or password"
                ]);
            }
        } else {
            echo json_encode([
                "status" => false,
                "message" => "User not found!"
            ]);
        }
    } else {
        echo json_encode([
            "status" => false,
            "message" => "query execution failed"
        ]);
    }
} catch (\Throwable $th) {
    echo json_encode([
        "status" => false,
        "message" => "error occured in php"
    ]);
}
