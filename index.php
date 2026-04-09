<?php
session_start();
$page = $_GET['page'] ?? 'home';

// Handle protected pages FIRST
if ($page === "events" && !isset($_SESSION["users_id"])) {
    header("Location: loginLanding.php");
    exit;
}
if ($page === "calendar" && !isset($_SESSION["users_id"])) {
    header("Location: loginLanding.php");
    exit;
}
if ($page === "org" && !isset($_SESSION["users_id"])) {
    header("Location: loginLanding.php");
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>University of Kristian Evangelion Events</title>
    <link rel="stylesheet" href="frontend/css/index.css">
    <link rel="stylesheet" href="frontend/css/calendar.css">

    <!--CALENDAR CONFIGS-->
    <link href="https://cdn.jsdelivr.net/npm/fullcalendar@6.1.11/index.global.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/@fullcalendar/core@6.1.14/index.global.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@fullcalendar/daygrid@6.1.14/index.global.min.js"></script>
</head>

<body>

    <?php include("frontend/pages/headerFooter/header.php") ?>

    <?php
    switch ($page) {
        case "home":
            include("frontend/pages/index/home.php");
            break;

        case 'newHome':
            include("frontend/pages/index/newHome.php");
            break;

        case "events":
            include("frontend/pages/index/events.php");
            break;

        case "calendar":
            include("frontend/pages/index/calendar.php");
            break;

        case "org":
            include("frontend/pages/index/org.php");
            break;

        default:
            echo "Page not found";
    }
    ?>

    <?php include("frontend/pages/headerFooter/footer.php") ?>

</body>
</html>