<?php
$page = $_GET['page'] ?? 'login1';
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>UKE Event Registration Website</title>

    <!--this is font links barlow-->
    <link href="https://fonts.googleapis.com/css2?family=Barlow:wght@300;400;600;700&display=swap" rel="stylesheet">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Barlow+Semi+Condensed:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&family=Barlow:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap" rel="stylesheet">

    <link rel="stylesheet" href="frontend/css/login/login0.css">
    <link rel="stylesheet" href="frontend/css/login/login1.css">
    <link rel="stylesheet" href="frontend/css/login/resetPass.css">
    <link rel="stylesheet" href="frontend/css/login/changePass.css">
</head>

<body>
    <img src="frontend/assetsImages/login/logoUKE.svg" alt="Background Logo" id="logoBg">
    <img src="frontend/assetsImages/login/shape1.svg" alt="Background Shape" id="rdmBg0">
    <section>
        <div class="logo-container">
            <img src="frontend/assetsImages/login/Quezon_City.png" alt="">
            <img src="frontend/assetsImages/login/qcCircle.png" alt="">
        </div>
        <?php
        switch ($page) {
            case 'login0':
                include('frontend/pages/logInPages/login0.php');
                break;
            case 'login1':
                include('frontend/pages/logInPages/login1.php');
                break;

            case 'resetPass':
                include 'frontend/pages/logInPages/resetPass.php';
                break;

            case 'confirmOTP':
                include 'frontend/pages/logInPages/confirmOtp.php';
                break;
                
            case 'changePass':
                include 'frontend/pages/logInPages/changePass.php';
                break;

            default:
                echo "Invalid selection!";
                break;
        };
        ?>
    </section>
</body>

</html>