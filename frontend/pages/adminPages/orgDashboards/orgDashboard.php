<?php
$adminPages = $_GET["adminPages"] ?? 'manageOrg';
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
<form action="admin.php" method="GET" class="orgPage-container">
    <button name="adminPages" value="manageOrg" class="<?= $adminPages == 'manageOrg' ? 'org-active' : '' ?>">Manage Organizations</button>
    <button name="adminPages" value="applyOrg" class="<?= $adminPages == 'applyOrg' ? 'org-active' : '' ?>">Application Organizations</button>
</form>
<div class="orgDash-container">
    <?php
    switch ($adminPages) {
        case 'manageOrg':
            include("frontend/pages/adminPages/orgDashboards/manageOrgDash.html");
            break;
        case 'applyOrg':
            include("frontend/pages/adminPages/orgDashboards/applicationOrgDash.html");
            break;
        default:
            echo "page not found";
            break;
    }
    ?>
</div>