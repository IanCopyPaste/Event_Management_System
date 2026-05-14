<?php
session_start();
if(!isset($_SESSION["sponsor_id"])){
    echo "page not found";
    exit;
}
?>
<style>
    * {
        padding: 0;
        margin: 0;
        box-sizing: border-box;
        font-family: 'Barlow', sans-serif;
    }

    .side-container {
        /* Kept fluid like your original, but capped the width so buttons look neat */
        width: 100%;
        max-width: 280px; 
        padding: 20px 10px;
    }

    .side-container p {
        color: white;
    }

    .adminProfile-container {
        display: flex;
        align-items: center; /* Better vertical alignment */
        gap: 15px;
        margin-left: 5px;
    }

    .adminInfo-container {
        display: flex;
        gap: 2px; /* Tighter gap between name and ID */
        flex-direction: column;
    }

    .adminProfile-container img {
        width: 50px;
        height: 50px;
        border-radius: 10px; /* Slight rounding for a polished look */
        object-fit: cover;
    }

    .adminName {
        font-size: 1.4rem;
        font-weight: 700;
        line-height: 1.2;
    }

    .adminID {
        font-size: 0.9rem;
        color: rgba(255, 255, 255, 0.7); /* Slightly dimmed for visual hierarchy */
    }

    .side-container form {
        display: flex;
        flex-direction: column;
        margin-top: 40px; /* Adjusted spacing */
        gap: 15px;
    }

    .side-container button {
        padding: 14px 20px; /* Added horizontal padding to contain text properly */
        font-size: 1.1rem;
        font-weight: 600;
        border-radius: 8px; /* Smoother corners */
        border: none;
        background-color: rgba(83, 155, 255, 1);
        color: white;
        outline: none;
        transition: all 0.25s ease;
        text-align: center;
    }

    .side-container button:hover {
        transform: translateY(-2px) scale(1.02);
        box-shadow: 0 6px 16px rgba(0, 0, 0, 0.2);
        background-color: rgba(100, 165, 255, 1); /* Slight brighten on hover */
        cursor: pointer;
    }

    #admin-active {
        background-color: rgba(0, 65, 156, 1);
        box-shadow: 0 6px 18px rgba(0, 0, 0, 0.25);
    }
    
    /* Prevents the active button from popping out again when hovered */
    #admin-active:hover {
        transform: none;
        background-color: rgba(0, 65, 156, 1); 
    }

    #btnLogout {
        background-color: #ef4444; /* Clean modern red */
        padding: 12px;
        position: fixed;
        bottom: 20px;
        border-radius: 8px;
        color: white;
        font-weight: bold;
        border: none;
        cursor: pointer;
        transition: 0.2s ease;
    }
    
    #btnLogout:hover {
        background-color: #dc2626;
    }
</style>

<div class="side-container">
    <div class="adminProfile-container">
        <img src="frontend/assetsImages/univLogo.png" alt="NoProfile">
        <div class="adminInfo-container">
            <p class="adminName"><?= $_SESSION["sponsor_name"] ?></p>
            <p class="adminID">Sponsor ID: <?= $_SESSION["sponsor_id"] ?></p>
        </div>
    </div>
    
    <form action="sponsor.php" method="GET">
        <button name="SponPage" value="applications" id="<?= $sponPage == 'applications' ? 'admin-active' : ''?>">Manage Packages</button>
        <button name="SponPage" value="packages" id="<?= $sponPage == 'packages' ? 'admin-active' : ''?>">Sponsor Event/s</button>
        <button name="SponPage" value="settings" id="<?= $sponPage == 'settings' ? 'admin-active' : ''?>">Profile</button>
    </form>
</div>

<script>
    document.addEventListener("DOMContentLoaded", () => {

    });
</script>