<?php
$page = $_GET["page"] ?? 'orgDash';
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard</title>
    <style>
        .admin-container {
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

<body class="admin-container">
    <?php include("frontend/pages/adminPages/adminSidebar.php") ?>
    <div class="page-container">
        <?php
        switch ($page) {
            case 'orgDash':
                include("frontend/pages/adminPages/orgDashboards/orgDashboard.php");
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
                include("frontend/pages/adminPages/settingDashboard.html");
                break;
            default:
                echo "Page not found";
                break;
        }
        ?>
    </div>
</body>

</html>