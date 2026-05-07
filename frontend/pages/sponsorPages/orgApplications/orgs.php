<?php
$packPages = $_GET["packPages"]  ?? 'packManage';
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
<form action="sponsor.php" method="GET" class="orgPage-container">
    <button name="packPages" value="packManage" class="<?= $packPages == 'packManage' ? 'org-active' : '' ?>">Manage Sponsorships</button>
    <button name="packPages" value="packApply" class="<?= $packPages == 'packApply' ? 'org-active' : '' ?>">Sponsorship Aplications</button>
</form>
<div class="orgDash-container">
    <?php
    switch ($packPages) {
        case 'packManage':
            include("frontend/pages/sponsorPages/orgApplications/manage.php");
            break;
        case 'packApply':
            include("frontend/pages/sponsorPages/orgApplications/applications.php");
            break;
        default:
            echo "page not found";
            break;
    }
    ?>
</div>