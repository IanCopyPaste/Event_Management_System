<?php
$page = $_GET["organizerPages"] ?? 'eventsDash';
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

        @media (max-width: 480px) {
            .page-container {
                padding: 8px;
            }
        }
    </style>
</head>

<body class="organizer-container">
    <?php include("frontend/pages/organizerPages/organizerSidebar.php") ?>
    <div class="page-container">
        <?php
        switch ($page) {
            case 'analyticsDash':
                include("frontend/pages/organizerPages/analyticsDash/analyticsDash.php");
                break;
            case 'eventsDash':
                include("frontend/pages/organizerPages/eventsDash/eventDash.php");
                break;
            case 'sponsorDash':
                include("frontend/pages/organizerPages/sponsorDash/SponsorDisplay.html");
                break;
            case 'sponsorApply':
                include("frontend/pages/organizerPages/sponsorDash/sponsorApply.php");
                break;
            case 'settingsDash':
                include("frontend/pages/organizerPages/settings.php");
                break;
            default:
                echo "Page not found";
                break;
        }
        ?>
    </div>
</body>

</html>