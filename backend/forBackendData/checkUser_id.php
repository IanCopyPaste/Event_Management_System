<?php
session_start();
//$_SESSION["user_id"] = 4;
//unset($_SESSION["users_id"]);
if(isset($_SESSION["users_id"])){
    echo json_encode([
        "isStored" => true,
        "user_id" => $_SESSION["users_id"]
    ]);
}else{
    echo json_encode([
        "isStored" => false
    ]);
}
?>