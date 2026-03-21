<?php
session_start();
//$_SESSION["user_id"] = 4;
unset($_SESSION["user_id"]);
if(isset($_SESSION["user_id"])){
    echo json_encode([
        "isStored" => true,
        "user_id" => $_SESSION["user_id"]
    ]);
}else{
    echo json_encode([
        "isStored" => false
    ]);
}
?>