<?php
session_start();
if(!isset($_SESSION["org_id"])){
    echo "page not found";
    exit;
}
$altPath = "frontend/assetsImages/univLogo.png";
$path = "image_data/org_logo/";
?>
<style>
    * {
        padding: 0;
        margin: 0;
        box-sizing: border-box;
        font-family: 'Barlow', sans-serif;
    }

    .side-container p {
        color: white;
    }

    .adminProfile-container {
        display: flex;
        gap: 10px;
        margin-left: 5px;
    }

    .adminInfo-container {
        display: flex;
        gap: 5px;
        flex-direction: column;
    }

    .adminProfile-container img {
        width: 50px;
        height: 50px;
    }

    .adminName {
        font-size: 1.5rem;
        font-weight: 600;
    }
    .side-container form{
        display: flex;
        flex-direction: column;
        margin-top: 50px;
        gap: 15px;
    }
    .side-container button{
        padding: 15px 0px;
        font-size: 1.1rem;
        font-weight: 600;
        border-radius: 5px;
        border: none;
        background-color: rgba(83, 155, 255, 1);
        color: white;
        outline: none;
        transition: 0.2s ease;
    }
    .side-container button:hover{
        transform: translateY(-2px) scale(1.02);
         box-shadow: 0 6px 16px rgba(0, 0, 0, 0.2);
        cursor: pointer;
    }
    #org-active{
        background-color: rgba(0, 65, 156, 1);
         box-shadow: 0 6px 18px rgba(0, 0, 0, 0.25);
    }
    #btnLogout{
        background-color: red;
        padding: 10px;
        position: fixed;
        bottom: 20px;

    }
</style>
<div class="side-container">
    <div class="adminProfile-container">
        <img src="<?php if(!isset($_SESSION["org_logo"])){echo $altPath;}else{echo $path . $_SESSION["org_logo"];}?>" alt="NoProfile">
        <div class="adminInfo-container" >
            <p class="adminName" style="word-wrap: break-word;"><?=  $_SESSION["org_name"]?></p>
            <p class="adminID">ORG ID: <?=  $_SESSION["org_id"]?></p>
        </div>
    </div>
    <form action="organizer.php" method="GET">
        <!--<button name="organizerPages" value="analyticsDash" id="<//?= $page == 'analyticsDash' ? 'org-active' : ''?>">Analytics Dashboard</button>-->
        <button name="organizerPages" value="eventsDash" id="<?= $page == 'eventsDash' ? 'org-active' : ''?>">Events</button>
        <button name="organizerPages" value="sponsorDash" id="<?= ($page == 'sponsorDash' || $page == 'sponsorApply') ? 'org-active' : ''?>">Sponsorships</button>
        <button name="organizerPages" value="settingsDash" id="<?= $page =='settingsDash' ? 'org-active' : ''?>">Org Settings</button>
    </form>
</div>