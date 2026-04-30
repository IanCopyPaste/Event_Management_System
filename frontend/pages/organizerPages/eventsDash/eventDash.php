<?php
$page = $_GET["eventPages"]  ?? 'manageEvents';
?>
<style>
    * {
        margin: 0;
        padding: 0;
        box-sizing: border-box;
        font-family: 'Barlow', sans-serif;
    }

    .orgPage-container {
        display: flex;
        gap: 20px;
        margin: 20px 10px;
    }

    .orgPage-container button {
        background-color: transparent;
        border: none;
        outline: none;
        font-size: 1.1rem;
        font-weight: 500;
        padding: 10px 14px;
        border-radius: 6px;
        transition: all 0.2s ease;
        color: #000000;
        box-shadow: 0px 1px 2px grey;
    }

    .orgPage-container button:hover {
        background-color: rgba(83, 155, 255, 1);
        cursor: pointer;
        color: white;
        font-weight: 500;
        transform: translateY(-1px);
    }

    .orgPage-container button.org-active {
        font-weight: 700;
        text-decoration: none;
        color: rgb(255, 255, 255);
        background-color: rgba(83, 155, 255, 1);
        box-shadow: 0 2px 8px rgba(0, 0, 0, 0.08);
        border: none;
    }

    .orgPage-container button.org-active:hover {
        background-color: rgba(83, 155, 255, 1);
        transform: none;
    }
</style>
<form action="organizer.php" method="GET" class="orgPage-container">
    <button name="eventPages" value="manageEvents" class="<?= $page == 'manageEvents' ? 'org-active' : '' ?>">Manage Events</button>
    <button name="eventPages" value="createEvents" class="<?= $page == 'createEvents' ? 'org-active' : '' ?>">Create Events</button>
</form>
<div class="orgDash-container">
    <?php
    switch ($page) {
        case 'manageEvents':
            include("frontend/pages/organizerPages/eventsDash/manageEvents.php");
            break;
        case 'createEvents':
            include("frontend/pages/organizerPages/eventsDash/createEvents.html");
            break;
        default:
            echo "page not found";
            break;
    }
    ?>
</div>