<?php
include("backend/database/config.php"); // Adjust path to your config

// Check auth
if (!isset($_SESSION['users_id'])) {
    header("Location: loginLanding.php");
    exit;
}

$users_id = $_SESSION['users_id'];

// Fetch current sponsor data
$sql = "SELECT * FROM users u JOIN programs p ON p.program_id = u.program_id WHERE u.users_id = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $users_id);
$stmt->execute();
$result = $stmt->get_result();
$users = $result->fetch_assoc();
$stmt->close();

$logo_path = !empty($users['profile_pic']) ? "image_data/admin_profile/" . $users['profile_pic'] : "image_data/admin_profile/profileImg.png";
?>
<style>
    /* [KEEP ALL YOUR PREVIOUS CSS HERE] */
    :root {
        --bg-body: #f1f5f9;
        --surface: #ffffff;
        --text-main: #1e293b;
        --text-muted: #64748b;
        --border: #e2e8f0;
        --primary: #3b82f6;
        --danger: #ef4444;
    }

    body {
        font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        background-color: var(--bg-body);
        color: var(--text-main);
        margin: 0;
        padding: 40px 20px;
    }

    .profile-container {
        max-width: 1000px;
        margin: calc(50vh - 300px) auto 0;
        /* 50% of viewport height minus half the card height */
        display: grid;
        grid-template-columns: 1fr 2fr;
        gap: 30px;
    }

    .profile-card {
        background: var(--surface);
        padding: 30px;
        border-radius: 16px;
        box-shadow: 0 4px 6px rgba(0, 0, 0, 0.05);
        text-align: center;
        border: 1px solid var(--border);
    }

    .avatar-wrapper {
        position: relative;
        width: 120px;
        height: 120px;
        margin: 0 auto 15px;
    }

    .profile-avatar {
        width: 100%;
        height: 100%;
        border-radius: 50%;
        object-fit: cover;
        border: 4px solid #fff;
        box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
    }

    .upload-btn {
        position: absolute;
        bottom: 0;
        right: 0;
        background: var(--primary);
        color: white;
        border: none;
        border-radius: 50%;
        width: 36px;
        height: 36px;
        cursor: pointer;
        display: flex;
        align-items: center;
        justify-content: center;
        box-shadow: 0 2px 5px rgba(0, 0, 0, 0.2);
        transition: transform 0.2s;
    }

    .upload-btn:hover {
        transform: scale(1.1);
    }

    input[type="file"] {
        display: none;
    }

    .company-name {
        font-size: 1.4rem;
        font-weight: 700;
        margin-bottom: 5px;
    }

    .member-since {
        font-size: 0.85rem;
        color: var(--text-muted);
        margin-bottom: 20px;
    }

    .status-badge {
        display: inline-block;
        padding: 5px 12px;
        background: #dcfce7;
        color: #166534;
        border-radius: 20px;
        font-size: 0.8rem;
        font-weight: 600;
        text-transform: uppercase;
        margin-bottom: 25px;
    }

    .info-group {
        text-align: left;
        margin-bottom: 15px;
        font-size: 0.95rem;
    }

    .info-group strong {
        display: block;
        color: var(--text-muted);
        font-size: 0.8rem;
        text-transform: uppercase;
        letter-spacing: 0.5px;
        margin-bottom: 4px;
    }

    .settings-card {
        background: var(--surface);
        padding: 30px;
        border-radius: 16px;
        box-shadow: 0 4px 6px rgba(0, 0, 0, 0.05);
        border: 1px solid var(--border);
    }

    .settings-card h3 {
        margin-top: 0;
        padding-bottom: 15px;
        border-bottom: 1px solid var(--border);
        color: var(--text-main);
    }

    .form-group {
        margin-bottom: 20px;
    }

    .form-group label {
        display: block;
        font-weight: 600;
        margin-bottom: 8px;
        font-size: 0.95rem;
    }

    .form-control {
        width: 100%;
        padding: 12px;
        border: 1px solid var(--border);
        border-radius: 8px;
        font-size: 1rem;
        box-sizing: border-box;
        transition: border-color 0.3s;
    }

    .form-control:focus {
        outline: none;
        border-color: var(--primary);
        box-shadow: 0 0 0 3px rgba(59, 130, 246, 0.1);
    }

    .form-text {
        font-size: 0.8rem;
        color: var(--text-muted);
        margin-top: 5px;
        display: block;
    }

    .btn-majestic {
        background: linear-gradient(135deg, #3b82f6, #2563eb);
        color: white;
        border: none;
        padding: 12px 24px;
        border-radius: 8px;
        font-size: 1rem;
        font-weight: 600;
        cursor: pointer;
        transition: all 0.3s ease;
        box-shadow: 0 4px 6px rgba(37, 99, 235, 0.2);
    }

    .btn-majestic:hover {
        transform: translateY(-2px);
        box-shadow: 0 6px 15px rgba(37, 99, 235, 0.4);
    }

    .btn-danger {
        background: white;
        color: var(--danger);
        border: 1px solid var(--danger);
        padding: 12px 24px;
        border-radius: 8px;
        font-weight: 600;
        cursor: pointer;
        transition: all 0.2s;
    }

    .btn-danger:hover {
        background: #fef2f2;
    }

    .form-actions {
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-top: 30px;
        padding-top: 20px;
        border-top: 1px solid var(--border);
    }

    .modal-overlay {
        display: none;
        position: fixed;
        inset: 0;
        background: rgba(15, 23, 42, 0.6);
        backdrop-filter: blur(4px);
        z-index: 1000;
        justify-content: center;
        align-items: center;
    }

    .modal-content {
        background: var(--surface);
        padding: 30px;
        border-radius: 16px;
        width: 100%;
        max-width: 400px;
        text-align: center;
        box-shadow: 0 20px 25px -5px rgba(0, 0, 0, 0.1);
    }

    .modal-content h2 {
        margin-top: 0;
        color: var(--text-main);
    }

    .modal-content p {
        color: var(--text-muted);
        margin-bottom: 25px;
    }

    .modal-buttons {
        display: flex;
        gap: 15px;
        justify-content: center;
    }

    .btn-cancel {
        background: #e2e8f0;
        color: #475569;
        border: none;
        padding: 10px 20px;
        border-radius: 8px;
        font-weight: 600;
        cursor: pointer;
    }

    .btn-confirm {
        background: var(--primary);
        color: white;
        border: none;
        padding: 10px 20px;
        border-radius: 8px;
        font-weight: 600;
        cursor: pointer;
    }

    /* Loading Spinner Styles */
    .btn-majestic.loading {
        position: relative;
        color: transparent !important;
        /* Hide text */
        pointer-events: none;
        /* Prevent double clicks */
    }

    .btn-majestic.loading::after {
        content: "";
        position: absolute;
        width: 20px;
        height: 20px;
        top: 50%;
        left: 50%;
        margin-top: -10px;
        margin-left: -10px;
        border: 3px solid rgba(255, 255, 255, 0.3);
        border-radius: 50%;
        border-top-color: #fff;
        animation: spin 0.8s linear infinite;
    }

    @keyframes spin {
        to {
            transform: rotate(360deg);
        }
    }

    @media (max-width: 768px) {
        .profile-container {
            grid-template-columns: 1fr;
        }
    }
</style>

<div class="profile-container">

    <div class="profile-card">
        <div class="avatar-wrapper">
            <img id="profileImagePreview" src="<?= htmlspecialchars($logo_path) ?>" alt="User Pic" class="profile-avatar">
            <label for="logoUpload" class="upload-btn" title="Change Profile Picture">📷</label>
        </div>

        <div class="company-name">
    <?= htmlspecialchars(
        $users['last_name'] . ", " .
        $users['first_name'] . " " .
        ($users['middle_name'] ?? "")
    ) ?>
</div>
        <div class="status-badge"><?= htmlspecialchars($users['status']) ?></div>

        <div class="member-since" id="formattedDate">
            <input type="hidden" id="rawDate" value="<?= htmlspecialchars($users['created_at']) ?>">
        </div>

        <hr style="border: 0; border-top: 1px solid var(--border); margin: 20px 0;">

        <div class="info-group">
            <strong>Email Address</strong>
            <?= htmlspecialchars($users['email']) ?>
        </div>
        <div class="info-group">
            <strong>Contact Number</strong>
            <?= htmlspecialchars($users['contact_no']) ?>
        </div>
        <div class="info-group">
            <strong>Program</strong>
            <?= htmlspecialchars(($users['program_name'] ?? "None")) ?>
        </div>
        <div class="info-group">
            <strong>Year Level</strong>
            <?= htmlspecialchars($users['year_level']) ?>
        </div>
    </div>

    <div class="settings-card">
        <h3>Account Settings</h3>

        <form id="settingsForm">
            <input type="file" id="logoUpload" name="new_logo" accept="image/*" onchange="previewImage(event)">

            <div class="form-group">
                <label for="username">Admin ID</label>
                <input type="text" id="username" name="username" class="form-control" value="<?= htmlspecialchars($users['users_id']) ?>" readonly>
                <span class="form-text">This is the id you use to log in.</span>
            </div>

            <div style="margin: 30px 0 15px 0; border-bottom: 1px solid var(--border); padding-bottom: 10px;">
                <h4 style="margin: 0; color: var(--text-main);">Security (Password Update)</h4>
                <span class="form-text">Leave these fields blank if you do not wish to change your password.</span>
            </div>

            <div class="form-group">
                <label for="current_password">Current Password</label>
                <input type="password" id="current_password" name="current_password" class="form-control" placeholder="Enter current password to verify changes">
            </div>

            <div class="form-group">
                <label for="new_password">New Password</label>
                <input type="password" id="new_password" name="new_password" class="form-control" placeholder="Enter new password">
            </div>

            <div class="form-actions">
                <button type="button" class="btn-danger" onclick="openLogoutModal()">Log Out</button>
                <button type="button" class="btn-majestic" onclick="initiateUpdate()">Save Changes</button>
            </div>
        </form>
    </div>
</div>

<div id="otpModal" class="modal-overlay">
    <div class="modal-content">
        <h2>Security Verification</h2>
        <p>An OTP has been sent to your email. Please enter it below to confirm your changes.</p>
        <div class="form-group">
            <input type="text" id="otpInput" class="form-control" placeholder="Enter 6-digit OTP" style="text-align: center; letter-spacing: 5px; font-size: 1.2rem; font-weight: bold;">
        </div>
        <div class="modal-buttons">
            <button class="btn-cancel" onclick="closeModal('otpModal')">Cancel</button>
            <button class="btn-confirm" onclick="submitProfileUpdate()">Verify & Save</button>
        </div>
    </div>
</div>

<div id="logoutModal" class="modal-overlay">
    <div class="modal-content">
        <h2>Sign Out</h2>
        <p>Are you sure you want to log out of your sponsor dashboard?</p>
        <div class="modal-buttons">
            <button class="btn-cancel" onclick="closeLogoutModal()">Cancel</button>
            <button class="btn-confirm-logout" style="padding: 6px; border-radius:5px; border:none; background-color:red; color:white;">Yes, Log Out</button>
        </div>
    </div>
</div>

<script>
    // Formate Date
    document.addEventListener('DOMContentLoaded', () => {
        const rawDateStr = document.getElementById('rawDate').value;
        if (rawDateStr) {
            const dateObj = new Date(rawDateStr);
            const options = {
                year: 'numeric',
                month: 'long',
                day: 'numeric'
            };
            document.getElementById('formattedDate').innerHTML = `Member since: <strong>${dateObj.toLocaleDateString('en-US', options)}</strong>`;
        }
    });

    // Image Preview
    function previewImage(event) {
        const reader = new FileReader();
        reader.onload = function() {
            document.getElementById('profileImagePreview').src = reader.result;
        };
        if (event.target.files[0]) reader.readAsDataURL(event.target.files[0]);
    }

    // Modals
    // Function to open the modal (Called by the red 'Log Out' button)
    function openLogoutModal() {
        document.getElementById('logoutModal').style.display = 'flex';
    }

    // Function to close the modal
    function closeLogoutModal() {
        document.getElementById('logoutModal').style.display = 'none';
    }

    // Your logic applied to the "Confirm" button inside the modal
    const btnConfirmLogout = document.querySelector(".btn-confirm-logout");

    if (btnConfirmLogout) {
        btnConfirmLogout.addEventListener("click", async () => {
            try {
                // Call your backend
                const response = await fetch("backend/forBackendData/logout.php");
                const data = await response.json();

                // Check for your specific message
                if (data.message === "logged out") {
                    // Optional: You can keep the alert or just redirect immediately
                    // alert("Logged out successfully"); 
                    window.location.href = "loginLanding.php";
                }
            } catch (error) {
                // Fallback if backend fails or path is wrong
                console.log("Backend not found, but logout was attempted!", error);
                // Even if backend fails, usually safe to redirect to login
                window.location.href = "loginLanding.php";
            }
        });
    }

    function closeModal(id) {
        document.getElementById(id).style.display = 'none';
    }

    // --- NEW OTP LOGIC ---
    async function initiateUpdate() {
        const btn = document.querySelector('.btn-majestic');
        const newPass = document.getElementById('new_password').value;
        const curPass = document.getElementById('current_password').value;

        if (newPass && !curPass) {
            alert("Please enter your current password to set a new one.");
            return;
        }

        // Start Loading
        btn.classList.add('loading');

        try {
            const response = await fetch('backend/forBackendData/adminNsettings/send_otp.php', {
                method: 'POST'
            });
            const result = await response.json();

            if (result.success) {
                document.getElementById('otpModal').style.display = 'flex';
            } else {
                alert("Failed to send OTP: " + result.message);
            }
        } catch (error) {
            console.error("Error:", error);
            alert("Server connection failed.");
        } finally {
            // Stop Loading
            btn.classList.remove('loading');
        }
    }

    async function submitProfileUpdate() {
        const verifyBtn = document.querySelector('#otpModal .btn-confirm');
        const otpCode = document.getElementById('otpInput').value;

        if (!otpCode) {
            alert("Please enter the OTP.");
            return;
        }

        // Start Loading on the Verify Button
        verifyBtn.classList.add('loading');
        verifyBtn.innerText = ""; // Clear text for spinner

        const form = document.getElementById('settingsForm');
        const formData = new FormData(form);
        formData.append('otp', otpCode);

        try {
            const response = await fetch('backend/forBackendData/adminNsettings/update_profile.php', {
                method: 'POST',
                body: formData
            });
            const result = await response.json();

            if (result.success) {
                alert("Profile updated successfully!");
                window.location.reload();
            } else {
                alert("Update failed: " + result.message);
                verifyBtn.classList.remove('loading');
                verifyBtn.innerText = "Verify & Save";
            }
        } catch (error) {
            console.error("Error:", error);
            alert("Failed to process update.");
            verifyBtn.classList.remove('loading');
            verifyBtn.innerText = "Verify & Save";
        }
    }
</script>