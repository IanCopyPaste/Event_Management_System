<?php
$page = $_GET["organizerPages"] ?? 'analyticsDash';
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard</title>
    <style>
        .organizer-container {
            display: flex;
        }

        .page-container {
            padding: 5px;
            margin-left: 250px;
            width: calc(100% - 270px);
        }

        .side-container {
            position: fixed;
            height: 100vh;
            width: 270px;
            max-width: 16%;
            padding: 20px 0px;
            border-radius: 0px 5px 5px 0px;
            background-color: rgba(39, 115, 255, 1);
            overflow: hidden;
        }
    </style>
</head>

<body class="organizer-container">
    <?php include("frontend/pages/organizerPages/organizerSidebar.php") ?>
    <div class="page-container">
        <?php
        switch ($page) {
            case 'analyticsDash':
                include("frontend/pages/organizerPages/analyticsDash/analytics.php");
                break;
            case 'userDash':
                include("frontend/pages/adminPages/userDasboard.html");
                break;
            case 'eventDash':
                include("frontend/pages/adminPages/eventDashboard.html");
                break;
            case 'sponsorDash':
                include("frontend/pages/adminPages/sponsorDashboard.html");
                break;
            case 'settingsDash':
                include("frontend/pages/organizerPages/settings.html");
                break;
            default:
                echo "Page not found";
                break;
        }
        ?>
    </div>
</body>
</html>