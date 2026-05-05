<!-- Font Awesome for icons -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">

<?php
$path = "image_data/org_logo/";
?>

<style>
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
    box-shadow: 0 2px 8px rgba(0, 0, 0, 0.15);
}

.org-name {
    margin: 15px 0 5px 0;
    font-size: 24px;
    font-weight: 500;
}

.org-id {
    color: #666;
    font-size: 14px;
}

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
    cursor: pointer;
    margin-left: 10px;
}

.status-dot {
    display: inline-block;
    width: 14px;
    height: 14px;
    background-color: #00c853;
    border-radius: 50%;
    margin-left: 15px;
}

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
}

.edit-modal {
    display: none;
    position: fixed;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    background: rgba(0, 0, 0, 0.5);
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
</style>

<div class="settings-view">
    <div class="settings-container">
        <h1 class="page-title">Account Settings</h1>

        <div class="profile-header">
            <div class="image-wrapper">
                <img src="<?= $path . ($_SESSION["org_logo"] ?? "profileImg.png") ?>" 
                     class="profile-logo" id="profileImg">

                <label for="imgUpload" class="camera-icon">
                    <i class="fas fa-camera"></i>
                </label>

                <input type="file" id="imgUpload" hidden accept="image/*">
            </div>

            <h2 class="org-name"><?= $_SESSION["sponsor_name"] ?></h2>
            <p class="org-id">Sponsor ID: <?= $_SESSION["sponsor_id"] ?></p>
        </div>

        <div class="info-list">
            <div class="info-row">
                <span class="label">Username:</span>
                <span class="value"><?= $_SESSION["sponsor_username"] ?></span>
            </div>

            <div class="info-row">
                <span class="label">Email:</span>
                <span class="value" id="val-email"><?= $_SESSION["sponsor_email"] ?></span>
                <i class="fa-solid fa-pen edit-icon" onclick="openEdit('Email', 'val-email')"></i>
            </div>

            <div class="info-row">
                <span class="label">Contact Number:</span>
                <span class="value" id="val-contact"><?= $_SESSION["sponsor_contact"] ?></span>
                <i class="fa-solid fa-pen edit-icon" onclick="openEdit('Contact Number', 'val-contact')"></i>
            </div>

            <div class="info-row">
                <span class="label">Password:</span>
                <input type="password" value="********" disabled>
            </div>

            <div class="info-row">
                <span class="label">Status:</span>
                <span class="value"><?= $_SESSION["sponsor_status"] ?></span>
            </div>

            <div class="info-row">
                <span class="label">Created At:</span>
                <span class="value"><?= $_SESSION["created_at"] ?></span>
            </div>
        </div>

        <div class="btn-logout-container">
            <button id="btnlogout">Logout</button>
        </div>
    </div>
</div>

<!-- Modal -->
<div id="modalOverlay" class="edit-modal">
    <div class="modal-content">
        <h3 id="modalTitle"></h3>
        <input type="text" id="modalInput">
        <div style="text-align:right;">
            <button onclick="closeEdit()">Cancel</button>
            <button onclick="saveEdit()">Save</button>
        </div>
    </div>
</div>

<script>
// Image preview
const imgUpload = document.getElementById('imgUpload');
if (imgUpload) {
    imgUpload.addEventListener('change', function () {
        if (this.files[0]) {
            const reader = new FileReader();
            reader.onload = e => document.getElementById('profileImg').src = e.target.result;
            reader.readAsDataURL(this.files[0]);
        }
    });
}

// Modal logic
let currentTargetId = "";

function openEdit(label, id) {
    currentTargetId = id;
    document.getElementById('modalTitle').innerText = "Edit " + label;
    document.getElementById('modalInput').value = document.getElementById(id).innerText;
    document.getElementById('modalOverlay').style.display = 'flex';
}

function closeEdit() {
    document.getElementById('modalOverlay').style.display = 'none';
}

function saveEdit() {
    const val = document.getElementById('modalInput').value;
    if (currentTargetId) {
        document.getElementById(currentTargetId).innerText = val;
    }
    closeEdit();
}

// Logout (safe for dynamic pages)
document.addEventListener("click", async function(e){
    if(e.target && e.target.id === "btnlogout"){
        try {
            const res = await fetch("backend/forBackendData/logout.php");
            const data = await res.json();

            if (data.message === "logged out") {
                alert("Logged out");
                window.location.href = "loginLanding.php";
            }
        } catch (err) {
            console.error(err);
        }
    }
});
</script>