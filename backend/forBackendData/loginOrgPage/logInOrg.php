<?php
session_start();
include("../../database/config.php");
header("Content-Type: application/json");
$data = json_decode(file_get_contents("php://input"), true);

$query = "SELECT o.org_id, o.org_name, o.org_email, o.org_contact_no, o.org_username, o.org_logo, o.created_at, dpt.department_name, o.status, o.org_password FROM organizations o 
JOIN department dpt ON dpt.department_id = o.department_id 
WHERE o.org_username=?";
$stmt = mysqli_prepare($conn,$query);
mysqli_stmt_bind_param($stmt,"s",$data["org_username"]);
mysqli_stmt_execute($stmt);
$result = mysqli_stmt_get_result($stmt);

if($row = mysqli_fetch_assoc($result)){
    if(($data["org_username"] == $row["org_username"]) && (password_verify($data["org_password"],$row["org_password"]))){
        if($row["status"] == 'deactivated'){
            echo json_encode([
                "status" => false,
                "message" => "Account disabled! please contact your IT administrator for further assistance"
            ]);
            die;
        }
        echo json_encode([
            "remarks" => true,
            "message" => "Login Successful! Welcome " . $row["org_name"] . "!"
        ]);
        $_SESSION["org_id"] = $row["org_id"];
        $_SESSION["org_name"] = $row["org_name"];
        $_SESSION["org_email"] = $row["org_email"];
        $_SESSION["org_contact"] = $row["org_contact_no"];
        $_SESSION["org_username"] = $row["org_username"];
        $_SESSION["org_logo"] = $row["org_logo"];
        $_SESSION["org_created_at"] = $row["created_at"];
        $_SESSION["org_dept_name"] = $row["department_name"];
        $_SESSION["org_password"] = $row["org_password"];
        $_SESSION["org_status"] = $row["status"];
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