<?php
include("../../database/config.php");
header("Content-Type: application/json");
$data = json_decode(file_get_contents("php://input"),true);

$query = "select e.restrictions,e.event_bg_picture, e.event_name, e.status, e.description, e.location, org.org_name,
org.org_email, org.org_contact_no, dpt.department_name, e.capacity, e.slot_taken, e.registration_deadline, e.start_date, e.end_date,
e.approval_status from events e
join organizations org on e.org_id = org.org_id
join department dpt on org.department_id = dpt.department_id
where e.event_id=?";
$stmt = mysqli_prepare($conn, $query);
mysqli_stmt_bind_param($stmt,"i",$data["event_id"]);

$record = [];

if(mysqli_stmt_execute($stmt)){
    $result = mysqli_stmt_get_result($stmt);
    $record[] = mysqli_fetch_assoc($result);
    echo json_encode([
        "status" => true,
        "message" => "fetched successful!",
        "record" => $record
    ]);
}else{
    echo json_encode([
        "status" => false,
        "message" => "fetch unsuccessful"
    ]);
}

?>