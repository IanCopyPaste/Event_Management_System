<?php
session_start();
include("../../database/config.php");
header("Content-Type: application/json");
$data = json_decode(file_get_contents("php://input"), true);

$query = "SELECT * FROM organizations o 
JOIN users u ON o.users_id = u.users_id
JOIN department dpt ON dpt.department_id = o.department_id 
WHERE o.org_username=?";
$stmt = mysqli_prepare($conn,$query);
mysqli_stmt_bind_param($stmt,"s",$data["org_username"]);
mysqli_stmt_execute($stmt);
$result = mysqli_stmt_get_result($stmt);

if($row = mysqli_fetch_assoc($result)){
    if(($data["org_username"] == $row["org_username"]) && (password_verify($data["org_password"],$row["org_password"]))){
        echo json_encode([
            "remarks" => true,
            "message" => "Login Successful! Welcome " . $row["org_name"] . "!"
        ]);
        $_SESSION["org_id"] = $row["org_id"];
        $_SESSION["org_name"] = $row["org_name"];
        $_SESSION["org_contact"] = $row["org_contact_no"];
        $_SESSION["org_username"] = $row["org_username"];
        $_SESSION["org_logo"] = $row["org_logo"];
        $_SESSION["organizer_fname"] = $row["first_name"];
        $_SESSION["organizer_mname"] = $row["middle_name"];
        $_SESSION["organizer_lname"] = $row["last_name"];
        $_SESSION["org_created_at"] = $row["created_at"];
        $_SESSION["org_dept_name"] = $row["department_name"];
    }else{
        echo json_encode([
            "remarks" => false,
            "message" => "Incorrect Password or Org Username!"
        ]);    
    }
}else{
    echo json_encode([
        "remarks" => false,
        "message" => "Organization not Found!"
    ]);
}
?>