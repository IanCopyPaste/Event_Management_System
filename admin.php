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
        .page-container{
            padding: 5px;
            width: 80%;
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