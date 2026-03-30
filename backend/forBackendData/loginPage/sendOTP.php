<?php

use PHPMailer\PHPMailer\PHPMailer;

require '../../../vendor/autoload.php';
$mail = new PHPMailer(true);

include("../../database/config.php");
header("Content-Type: application/json");
$data = json_decode(file_get_contents("php://input"), true);

$query = "SELECT * FROM users WHERE users_id=?";
$stmt = mysqli_prepare($conn, $query);
mysqli_stmt_bind_param($stmt, "i", $data["student_id"]);
mysqli_stmt_execute($stmt);
$result = mysqli_stmt_get_result($stmt);

if (mysqli_num_rows($result) == 0) {
    echo json_encode([
        "status" => false,
        "message" => "User not found"
    ]);
    exit;
}

$user = mysqli_fetch_assoc($result);
$otp = random_int(100000, 999999);

switch ($data["mode"]) {
    case "email":
        $mail->isSMTP();
        $mail->Host = 'smtp.gmail.com';
        $mail->SMTPAuth = true;
        $mail->Username = 'bobbycuen@gmail.com';
        $mail->Password = $app_pass; //app password
        $mail->SMTPSecure = 'tls';
        $mail->Port = 587;

        $mail->setFrom('bobbycuen@gmail.com', 'UNIVERSITY OF KRISTIAN EVAGELION');
        $mail->addAddress($user["email"]);

        $mail->Subject = 'Your One-Time Password (OTP)';
        $mail->Body = 'Dear ' . $user["first_name"] . ' ' . $user["last_name"] . ',

Your One-Time Password (OTP) for verifying your account is:

' . $otp . '

Please enter this OTP within the next 10 minutes to complete the verification process.

If you did not request this, please ignore this message or contact our support team.

Thank you';

        $mail->send();
        echo json_encode([
            "status" => true,
            "message" => "YOUR OTP WAS SENT TO " . $user["email"],
            "otp" => $otp
        ]);
        break;

    case 'sms':

};