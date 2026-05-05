<!-- Font Awesome for the edit and camera icons -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
<?php
$picPath = "image_data/user_profile_pic/";
?>
<style>
    /* 
       1. FIX: REMOVED body { display: flex }. 
       This prevents the sidebar from being pulled into the center.
    */
    .settings-main-wrapper {
        font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        background-color: #ffffff;
        color: #333;
        width: 100%;
        padding: 40px;
        /* This wrapper ensures the card stays centered in the right-hand area */
        display: flex; 
        justify-content: center;
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
        text-align: left;
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
    }

    .camera-icon {
        position: absolute;
        bottom: 5px;
        right: -5px;
        background: white;
        padding: 6px;
        font-size: 18px;
        cursor: pointer;
        border-radius: 50%;
        box-shadow: 0 2px 5px rgba(0,0,0,0.1);
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
        padding: 15px 0;
        font-size: 18px;
        border-bottom: 1px solid #f0f0f0;
    }

    .label {
        width: 220px;
        font-weight: 600;
        flex-shrink: 0;
        text-align: left;
    }

    .value {
        flex-grow: 1;
        color: #444;
        text-align: left;
    }

    .edit-icon {
        color: #333;
        cursor: pointer;
        font-size: 16px;
        margin-left: 10px;
        transition: color 0.2s;
    }

    .edit-icon:hover {
        color: #1a56be;
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
    .footer-actions {
        margin-top: 30px;
        text-align: right;
    }

    .btnLogout {
        padding: 10px 25px;
        background-color: #f44336;
        color: white;
        border: none;
        border-radius: 4px;
        cursor: pointer;
        font-weight: bold;
        transition: background 0.3s;
    }

    .btnLogout:hover {
        background-color: #d32f2f;
    }

    /* Modal Styling for Editing */
    .modal {
        display: none;
        position: fixed;
        z-index: 9999;
        left: 0;
        top: 0;
        width: 100%;
        height: 100%;
        background-color: rgba(0,0,0,0.5);
        align-items: center;
        justify-content: center;
    }
    .modal-content {
        background: white;
        padding: 25px;
        border-radius: 8px;
        width: 350px;
        text-align: center;
    }
    .modal-content input {
        width: 100%;
        padding: 10px;
        margin: 15px 0;
        border: 1px solid #ddd;
        border-radius: 4px;
    }
    .btn-save {
        background: #1a56be;
        color: white;
        border: none;
        padding: 8px 20px;
        border-radius: 4px;
        cursor: pointer;
    }
</style>

<div class="settings-main-wrapper">
    <div class="settings-container">
        <h1 class="page-title">Account Settings</h1>

        <div class="profile-header">
            <div class="image-wrapper">
                <img src="<?=$picPath . ($_SESSION["users_pic"] ?? 'profileImg.png');?>" alt="College Logo" class="profile-logo" id="profile-img">
                <label for="upload-photo" class="camera-icon">
                    <i class="fas fa-camera"></i>
                </label>
                <input type="file" id="upload-photo" hidden accept="image/*">
            </div>
            <h2 class="org-name"><?= $_SESSION["users_fname"] . " " . ($_SESSION["users_mname"] ?? '') . " " . $_SESSION["users_lname"]; ?></h2>
            <p class="org-id">Admin ID: <?=  $_SESSION["users_id"]?></p>
        </div>

        <div class="info-list">
            <div class="info-row">
                <span class="label">Program:</span>
                <span class="value"><?= $_SESSION["users_program"] ?></span>
            </div>
            
            <!-- Editable Rows -->
            <div class="info-row">
                <span class="label">Year Level:</span>
                <span class="value" id="val-fullname"><?= $_SESSION["users_year"] ?></span>
            </div>
            
            <div class="info-row">
                <span class="label">Email:</span>
                <span class="value" id="val-email"><?= $_SESSION["users_email"] ?></span>
            </div>

            <div class="info-row">
                <span class="label">Password:</span>    
                <span class="value">**************</span>
                <i class="fa-solid fa-arrow-up-right-from-square edit-icon" onclick="openModal('Password', '')"></i>
            </div>

            <div class="info-row">
                <span class="label">Status:</span>
                <span class="value"><?= $_SESSION["users_status"] ?> <span class="status-dot"></span></span>
            </div>
            
            <div class="info-row">
                <span class="label">Created On:</span>
                <span class="value"><?= $_SESSION["created_at"] ?></span>
            </div>
        </div>

        <div class="footer-actions">
            <button class="btnLogout">Logout</button>
        </div>
    </div>
</div>

<!-- Edit Modal -->
<div id="editModal" class="modal">
    <div class="modal-content">
        <h3 id="modalTitle">Edit</h3>
        <input type="text" id="editInput">
        <div>
            <button class="btn-save" onclick="saveEdit()">Save</button>
            <button onclick="closeModal()" style="border:none; background:none; cursor:pointer; color:#666;">Cancel</button>
        </div>
    </div>
</div>

<script>
    // Handle Profile Image Preview
    document.getElementById('upload-photo').addEventListener('change', function(e) {
        if (this.files && this.files[0]) {
            const reader = new FileReader();
            reader.onload = function(e) {
                document.getElementById('profile-img').src = e.target.result;
            };
            reader.readAsDataURL(this.files[0]);
        }
    });

    // Modal Logic
    let activeElementId = '';
    function openModal(title, id) {
        activeElementId = id;
        document.getElementById('modalTitle').innerText = "Edit " + title;
        document.getElementById('editInput').value = id ? document.getElementById(id).innerText : "";
        document.getElementById('editModal').style.display = 'flex';
    }

    function closeModal() {
        document.getElementById('editModal').style.display = 'none';
    }

    function saveEdit() {
        const newVal = document.getElementById('editInput').value;
        if(activeElementId) {
            document.getElementById(activeElementId).innerText = newVal;
        }
        closeModal();
    }

    // Logout Logic (from your original script)
    const btnLogout = document.querySelector(".btnLogout");
    if(btnLogout) {
        btnLogout.addEventListener("click", async () => {
            try {
                const response = await fetch("backend/forBackendData/logout.php");
                const data = await response.json();
                if (data.message == "logged out") {
                    alert("logged out");
                    window.location.href = "loginLanding.php";
                }
            } catch (error) {
                console.log("Backend not found, but button clicked!");
            }
        });
    }
</script>