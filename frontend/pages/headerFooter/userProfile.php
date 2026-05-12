<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Profile - University of Kristian Evangelion</title>
    <link href="https://fonts.googleapis.com/css2?family=Barlow:wght@400;500;600;700&display=swap" rel="stylesheet">
    <script src="https://unpkg.com/lucide@latest"></script>
    <style>
        :root {
            --primary: #3b82f6;
            --danger: #AD2626;
            --bg-gray: #f9fafb;
            /* [cite: 5] */
            --card-border: #d1d5db;
            /* [cite: 24] */
        }

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        /* [cite: 3, 4] */

        body {
            font-family: 'Barlow', sans-serif;
            /* [cite: 5] */
            background-color: var(--bg-gray);
            color: #111827;
        }

        .main-container {
            max-width: 900px;
            margin: 3rem auto;
            /* [cite: 7] */
            padding: 0 1.5rem;
        }

        /* Profile Header */
        .profile-header {
            display: flex;
            /* [cite: 8] */
            flex-direction: column;
            align-items: center;
            margin-bottom: 3rem;
        }

        .avatar-container {
            position: relative;
        }

        /* [cite: 9] */

        .avatar-circle {
            width: 9rem;
            /* [cite: 10] */
            height: 9rem;
            background-color: #bfdbfe;
            /* [cite: 10] */
            border-radius: 9999px;
            display: flex;
            align-items: center;
            justify-content: center;
            overflow: hidden;
            border: 4px solid white;
            box-shadow: 0 10px 15px -3px rgba(0, 0, 0, 0.1);
            /* [cite: 11] */
        }

        .avatar-circle img {
            width: 100%;
            height: 100%;
            object-fit: cover;
        }

        .camera-overlay {
            position: absolute;
            bottom: 5px;
            right: 5px;
            background: white;
            /* [cite: 13] */
            padding: 0.5rem;
            border-radius: 9999px;
            border: 1px solid #e5e7eb;
            cursor: pointer;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            /* [cite: 14] */
        }

        /* Info Cards */
        .card {
            background: white;
            /* [cite: 24] */
            border: 1px solid var(--card-border);
            border-radius: 1rem;
            padding: 2rem;
            margin-bottom: 1.5rem;
        }

        .section-title {
            font-size: 1.25rem;
            /* [cite: 26] */
            font-weight: 700;
            margin-bottom: 1.5rem;
            display: flex;
            align-items: center;
            gap: 0.5rem;
        }

        .grid-row {
            display: grid;
            grid-template-columns: 1fr 2fr;
            padding: 0.75rem 0;
            border-bottom: 1px solid #f3f4f6;
        }

        .grid-row:last-child {
            border-bottom: none;
        }

        .label {
            font-weight: 600;
            color: #4b5563;
        }

        /* [cite: 34] */

        .read-only-val {
            color: #111827;
        }

        /* Editable Components */
        .editable-field {
            display: flex;
            align-items: center;
            gap: 1rem;
        }

        input[type="password"] {
            border: 1px solid #d1d5db;
            border-radius: 0.375rem;
            padding: 0.25rem 0.5rem;
            font-size: 0.875rem;
        }

        .btn-save {
            background: var(--primary);
            color: white;
            padding: 0.75rem 2rem;
            border-radius: 0.5rem;
            border: none;
            font-weight: 700;
            cursor: pointer;
            width: 100%;
            margin-top: 1rem;
        }

        /* Modal Styles */
        .modal-overlay {
            position: fixed;
            inset: 0;
            background: rgba(0, 0, 0, 0.5);
            display: none;
            align-items: center;
            justify-content: center;
            z-index: 50;
        }

        .modal-content {
            background: white;
            padding: 2rem;
            border-radius: 1rem;
            max-width: 400px;
            text-align: center;
        }

        .modal-btns {
            display: flex;
            gap: 1rem;
            margin-top: 1.5rem;
        }

        .btn-cancel {
            flex: 1;
            padding: 0.5rem;
            border: 1px solid #d1d5db;
            border-radius: 0.5rem;
            background: white;
            cursor: pointer;
        }

        .btn-confirm {
            flex: 1;
            padding: 0.5rem;
            background: var(--primary);
            color: white;
            border-radius: 0.5rem;
            border: none;
            cursor: pointer;
        }
    </style>
</head>

<body>

    <div class="main-container">
        <section class="profile-header">
            <div class="avatar-container">
                <div class="avatar-circle" id="avatarPreview">
                    <i data-lucide="user" style="width: 5rem; height: 5rem; color: #3b82f6;"></i>
                </div>
                <label for="profilePicInput" class="camera-overlay">
                    <i data-lucide="camera" style="width: 1.25rem; height: 1.25rem;"></i> </label>
                <input type="file" id="profilePicInput" hidden accept="image/*">
            </div>
            <h1 class="profile-name" style="margin-top: 1rem; font-weight: 700;">Dela Cruz, Juan T.</h1>
            <p class="profile-id" style="color: #6b7280; font-size: 0.875rem;">
                Student ID: 10-2001
            </p>
        </section>

        <form id="profileForm">
            <div class="card">
                <h2 class="section-title"><i data-lucide="info"></i> Personal Information</h2>
                <div class="grid-row">
                    <div class="label">First Name</div>
                    <div class="read-only-val">Juan</div>
                </div>
                <div class="grid-row">
                    <div class="label">Last Name</div>
                    <div class="read-only-val">Dela Cruz</div>
                </div>
                <div class="grid-row">
                    <div class="label">Middle Name</div>
                    <div class="read-only-val">T.</div>
                </div>
                <div class="grid-row">
                    <div class="label">Year Level</div>
                    <div class="read-only-val">3rd Year</div>
                </div>
                <div class="grid-row">
                    <div class="label">Program</div>
                    <div class="read-only-val">BS in Computer Science</div>
                </div>
                <div class="grid-row">
                    <div class="label">Contact No</div>
                    <div class="read-only-val">09123456789</div>
                </div>
            </div>

            <div class="card">
                <h2 class="section-title"><i data-lucide="shield-check"></i> Account Security</h2>
                <div class="grid-row">
                    <div class="label">Email</div>
                    <div class="read-only-val">juan.delacruz@evangelion.edu</div>
                </div>
                <div class="grid-row">
                    <div class="label">Password</div>
                    <div class="editable-field">
                        <input
                            type="password"
                            id="passwordField"
                            placeholder="Enter new password" /> <i data-lucide="lock" style="width: 1rem; color: #9ca3af;"></i>
                    </div>
                </div>
            </div>

            <button type="button" class="btn-save" id="saveTrigger">Save Changes</button>
        </form>

        <div style="display: flex; justify-content: space-between; align-items: center; padding: 1rem;">
            <div>
                <p style="font-size: 0.75rem; color: #6b7280;">Last Logged: 3/7/2026</p>
                <p style="font-size: 0.75rem; color: #6b7280;">Account Created: 3/7/2026</p>
            </div>
            <button class="btn-logout" style="background: none; border: none; color: var(--danger); font-weight: 700; cursor: pointer;" onclick="logout()">Logout</button>
        </div>
    </div>

    <div class="modal-overlay" id="confirmModal">
        <div class="modal-content">
            <h3 style="margin-bottom: 0.5rem;">Confirm Changes</h3>
            <p style="color: #6b7280; font-size: 0.875rem;">Are you sure you want to update your profile picture and password?</p>
            <div class="modal-btns">
                <button class="btn-cancel" onclick="closeModal()">Cancel</button>
                <button class="btn-confirm" onclick="saveChanges()">Confirm</button>
            </div>
        </div>
    </div>
    <div class="back-nav-container" style="max-width: 900px; margin: 1rem auto 0; padding: 0 1.5rem;">
        <button onclick="window.location.href='../../../index.php'" style="display: flex; align-items: center; gap: 8px; background: none; border: none; cursor: pointer; font-weight: 600; color: #4b5563;">
            <i data-lucide="arrow-left"></i> Go Back
        </button>
    </div>

    <script>
        async function logout(){
            const r = await fetch("../../../backend/forBackendData/logout.php");
            const d = await r.json();
            alert(d.message);
            location.href = "../../../loginLanding.php"
        }
        lucide.createIcons();
        const PIC_PATH = "../../../image_data/user_pic/";

        // 1. Load Data on Initialization
        async function loadUserData() {
            const res = await fetch("../../../backend/forBackendData/userProfile/fetch_profile.php");
            const result = await res.json();

            if (result.status) {
                const u = result.data;

                // Set Headers
                document.querySelector(".profile-name").textContent =
                    `${u.last_name}, ${u.first_name} ${u.middle_name ?? ""}`;
                document.querySelector(".profile-id").textContent = `User ID: ${u.users_id}`;

                // Set Profile Pic
                if (u.profile_pic) {
                    document.getElementById('avatarPreview').innerHTML = `<img src="${PIC_PATH + (u.profile_pic || 'profileImg.png')}" alt="Profile">`;
                }

                // Fill Read-Only Fields
                const fieldMap = {
                    'First Name': u.first_name,
                    'Last Name': u.last_name,
                    'Middle Name': u.middle_name,
                    'Year Level': u.year_level,
                    'Program': u.program_name,
                    'Contact No': u.contact_no,
                    'Email': u.email,
                    'Last Logged': u.last_logged,
                    'Account Created': u.created_at
                };

                // Update your static values by finding the labels (you can add IDs to divs for easier selection)
                document.querySelectorAll('.grid-row').forEach(row => {
                    const label = row.querySelector('.label').textContent;
                    if (fieldMap[label]) {
                        row.querySelector('.read-only-val').textContent = fieldMap[label];
                    }
                });
            }
        }

        // 2. Save Changes (Confirmation Logic)
        async function saveChanges() {
            const password = document.getElementById('passwordField').value;
            const picInput = document.getElementById('profilePicInput');

            const formData = new FormData();
            formData.append('new_password', password);
            if (picInput.files[0]) {
                formData.append('profile_pic', picInput.files[0]);
            }
            if (password.trim() !== "") {
                formData.append('new_password', password);
            }
            try {
                const res = await fetch("../../../backend/forBackendData/userProfile/update_profile.php", {
                    method: "POST",
                    body: formData
                });
                const data = await res.json();

                if (data.status) {
                    alert("Profile successfully updated!");
                    location.reload();
                }
            } catch (err) {
                alert("Error updating profile.");
            }
            closeModal();
        }

        window.onload = loadUserData;

        function closeModal() {
            document.getElementById("confirmModal").style.display = "none";
        }

        document
            .getElementById("saveTrigger")
            .addEventListener("click", () => {

                document
                    .getElementById("confirmModal")
                    .style.display = "flex";
            });
    </script>
</body>

</html>