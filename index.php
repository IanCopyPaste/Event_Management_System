<?php
$page = $_GET['page'] ?? 'home';
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
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>

</head>

<body>
   <?php include("frontend/pages/headerFooter/header.php")?>

    <?php
    try {
        switch ($page) {
            case "home":
                include("frontend/pages/index/home.php");
                break;

            case "events":
                include("frontend/pages/index/events.php");
                break;

            case "calendar":
                include("frontend/pages/index/calendar.php");
                break;

            case "map":
                include("frontend/pages/index/map.php");  
                break;

            default:
                echo "Page not found";
        }
    } catch (\Throwable $th) {
        //echo "page might not be found";
    }
    ?>

   <?php include("frontend/pages/headerFooter/footer.php")?>
</body>
<script>
    async function checkID(params) {
        try {
            const response = await fetch("backend/checkUser_id.php");
        } catch (error) {
            alert(error);
        }
    }
</script>
</html>