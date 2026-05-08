<!-- Font Awesome for icons -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
<?php
$path = "image_data/org_logo/";
?>
<style>
    /* 
       CRITICAL: We wrap everything in .settings-view and remove 'body' styles 
       to prevent the sidebar from moving.
    */
    .settings-view {
        width: 100%;
        min-height: 100%;
        background-color: #ffffff;
        font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        color: #333;
        display: flex;
        justify-content: center;
        padding: 40px 20px;
    }

    .settings-container {
        width: 100%;
        max-width: 650px;
    }

    .page-title {
        color: #1a56be;
        font-size: 28px;
        margin-bottom: 30px;
        border-left: 6px solid #1a56be;
        padding-left: 15px;
        font-weight: bold;
    }

    /* Profile Header Section */
    .profile-header {
        text-align: center;
        margin-bottom: 50px;
    }

    .image-wrapper {
        position: relative;
        display: inline-block;
    }

    .profile-logo {
        width: 150px;
        height: 150px;
        border-radius: 50%;
        object-fit: cover;
        border: 1px solid #ddd;
    }

    .camera-icon {
        position: absolute;
        bottom: 5px;
        right: -5px;
        background: white;
        padding: 8px;
        font-size: 18px;
        cursor: pointer;
        border-radius: 50%;
        box-shadow: 0 2px 8px rgba(0,0,0,0.15);
        display: flex;
        align-items: center;
        justify-content: center;
    }

    .org-name {
        margin: 15px 0 5px 0;
        font-size: 24px;
        font-weight: 500;
    }

    .org-id {
        color: #666;
        font-size: 14px;
        margin: 0;
    }

    /* Info List Rows */
    .info-list {
        margin-top: 20px;
    }

    .info-row {
        display: flex;
        align-items: center;
        padding: 18px 0;
        font-size: 18px;
        border-bottom: 1px solid #f0f0f0;
    }

    .label {
        width: 220px;
        font-weight: 600;
        flex-shrink: 0;
    }

    .value {
        flex-grow: 1;
        color: #444;
    }

    .edit-icon {
        color: #333;
        cursor: pointer;
        font-size: 16px;
        margin-left: 10px;
        transition: transform 0.2s, color 0.2s;
    }

    .edit-icon:hover {
        color: #1a56be;
        transform: scale(1.1);
    }

    .status-dot {
        display: inline-block;
        width: 14px;
        height: 14px;
        background-color: #00c853;
        border-radius: 50%;
        margin-left: 15px;
        vertical-align: middle;
    }

    /* Logout Button Styling */
    .btn-logout-container {
        margin-top: 40px;
        text-align: right;
    }

    #btnlogout {
        padding: 12px 30px;
        background-color: #f44336;
        color: white;
        border: none;
        border-radius: 5px;
        cursor: pointer;
        font-weight: bold;
        font-size: 16px;
        transition: background 0.3s;
    }

    #btnlogout:hover {
        background-color: #d32f2f;
    }

    /* Simple Modal for Editing */
    .edit-modal {
        display: none;
        position: fixed;
        top: 0; left: 0; width: 100%; height: 100%;
        background: rgba(0,0,0,0.5);
        z-index: 1000;
        align-items: center;
        justify-content: center;
    }
    .modal-content {
        background: white;
        padding: 30px;
        border-radius: 8px;
        width: 380px;
    }
    .modal-content input {
        width: 100%;
        padding: 10px;
        margin: 15px 0;
        border: 1px solid #ccc;
        border-radius: 4px;
    }
</style>

<div class="settings-view">
    <div class="settings-container">
        <h1 class="page-title">Account Settings</h1>

        <div class="profile-header">
            <div class="image-wrapper">
                <img src="<?= $path . ($_SESSION["org_logo"] ?? "profileImg.png")?>" alt="College Logo" class="profile-logo" id="profileImg">
                <label for="imgUpload" class="camera-icon"><i class="fas fa-camera"></i></label>
                <input type="file" id="imgUpload" hidden accept="image/*">
            </div>
            <h2 class="org-name"><?= $_SESSION["org_name"]?></h2>
            <p class="org-id">Organization ID: <?= $_SESSION["org_id"]?></p>
        </div>

        <div class="info-list">
            <div class="info-row">
                <span class="label">Username:</span>
                <span class="value"><?= $_SESSION["org_username"]?></span>
            </div>
            
            <div class="info-row">
                <span class="label">Email:</span>
                <span class="value" id="val-name"><?= $_SESSION["org_email"] ?></span>
                <i class="fa-solid fa-arrow-up-right-from-square edit-icon" onclick="openEdit('Full Name', 'val-name')"></i>
            </div>

            <div class="info-row">
                <span class="label">Contact_No:</span>
                <span class="value" id="val-email"><?= $_SESSION["org_contact"] ?></span>
                <i class="fa-solid fa-arrow-up-right-from-square edit-icon" onclick="openEdit('Email', 'val-email')"></i>
            </div>

            <div class="info-row">
                <span class="label">Password:</span>
                <input type="password" value="<?= $_SESSION["org_password"] ?>">
                <i class="fa-solid fa-arrow-up-right-from-square edit-icon" onclick="openEdit('Password', 'val-pass')"></i>
            </div>

            <div class="info-row">
                <span class="label">Status:</span>
                <span class="value"><?= $_SESSION["org_status"] ?></span>
            </div>

            <div class="info-row">
                <span class="label">Created At:</span>
                <span class="value"><?= $_SESSION["org_created_at"] ?></span>
            </div>
        </div>

        <div class="btn-logout-container">
            <button id="btnlogout">Logout</button>
        </div>
    </div>
</div>

<!-- Simple Edit Modal -->
<div id="modalOverlay" class="edit-modal">
    <div class="modal-content">
        <h3 id="modalTitle">Edit Field</h3>
        <input type="text" id="modalInput">
        <div style="text-align: right;">
            <button onclick="closeEdit()" style="background:none; border:none; cursor:pointer; color:#666; margin-right:10px;">Cancel</button>
            <button onclick="saveEdit()" style="background:#1a56be; color:white; border:none; padding:8px 20px; border-radius:4px; cursor:pointer;">Save</button>
        </div>
    </div>
</div>

<script>
    // --- Profile Picture Preview ---
    document.getElementById('imgUpload').addEventListener('change', function(e) {
        if (this.files && this.files[0]) {
            const reader = new FileReader();
            reader.onload = (e) => document.getElementById('profileImg').src = e.target.result;
            reader.readAsDataURL(this.files[0]);
        }
    });

    // --- Modal Logic ---
    let currentTargetId = "";
    function openEdit(label, id) {
        currentTargetId = id;
        document.getElementById('modalTitle').innerText = "Edit " + label;
        document.getElementById('modalInput').value = id !== 'val-pass' ? document.getElementById(id).innerText : "";
        document.getElementById('modalOverlay').style.display = 'flex';
    }

    function closeEdit() { document.getElementById('modalOverlay').style.display = 'none'; }

    function saveEdit() {
        const newVal = document.getElementById('modalInput').value;
        if(currentTargetId && currentTargetId !== 'val-pass') {
            document.getElementById(currentTargetId).innerText = newVal;
        }
        closeEdit();
    }

    // --- Logout Logic ---
    const btnLogout = document.querySelector("#btnlogout");
    btnLogout.addEventListener("click", async () => {
        try {
            const response = await fetch("backend/forBackendData/logout.php");
            const data = await response.json();
            if (data.message == "logged out") {
                alert("logged out");
                window.location.href = "loginLanding.php";
            }
        } catch(e) {
            console.error("Logout path error - ensure backend/forBackendData/logout.php exists.");
        }
    });
</script>