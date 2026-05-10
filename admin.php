<?php
$adminPages = $_GET["adminPages"] ?? null;

if ($adminPages == 'manageSpon' || $adminPages == 'applySpon') {
    $page = 'sponsorDash';
} elseif ($adminPages == 'manageOrg' || $adminPages == 'applyOrg') {
    $page = 'orgDash';
} else {
    $page = $_GET["page"] ?? 'orgDash';
}
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
            padding: 0px;
        }

        .side-container {
            position: fixed;
            height: 100vh;
            width: 270px;
            max-width: 80%;
            padding: 20px 0px;
            border-radius: 0px 5px 5px 0px;
            background-color: rgba(39, 115, 255, 1);
            overflow: hidden;
            transition: transform 0.3s ease;
        }

        .page-container {
            padding: 10px;
            margin-left: 270px;
            width: calc(100% - 270px);
            transition: all 0.3s ease;
        }

        @media (max-width: 768px) {
            .side-container {
                transform: translateX(-100%);
                position: fixed;
                z-index: 1000;
            }

            .side-container.active {
                transform: translateX(0);
            }

            .page-container {
                margin-left: 0;
                width: 100%;
            }
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
                include("frontend/pages/adminPages/sponsorDashboards/sponsorDashboard.php");
                break;
            case 'settingsDash':
                include("frontend/pages/adminPages/settingDashboard.php");
                break;
            case 'departmentsDash':
                include("frontend/pages/adminPages/departments.html");
                break;
            default:
                echo "Page not found";
                break;
        }
        ?>
    </div>
</body>
</html>