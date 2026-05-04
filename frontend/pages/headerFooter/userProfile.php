<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Profile - University of Kristian Evangelion</title>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
    <script src="https://unpkg.com/lucide@latest"></script>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Inter', sans-serif;
            background-color: #f9fafb;
            color: #111827;
            line-height: 1.5;
        }

        .back-nav-container {
            max-width: 1152px;
            margin: 1.5rem auto 0;
            padding: 0 1rem;
        }

        .main-container {
            max-width: 1024px;
            margin: 3rem auto 0;
            padding: 0 1rem;
        }

        .profile-header {
            display: flex;
            flex-direction: column;
            align-items: center;
            margin-bottom: 2.5rem;
        }

        .avatar-container {
            position: relative;
        }

        .avatar-circle {
            width: 8rem;
            height: 8rem;
            background-color: #bfdbfe;
            border-radius: 9999px;
            display: flex;
            align-items: center;
            justify-content: center;
            overflow: hidden;
            border: 4px solid white;
            box-shadow: 0 1px 3px rgba(0,0,0,0.1);
        }

        .avatar-circle i {
            width: 5rem;
            height: 5rem;
            color: #3b82f6;
        }

        .camera-overlay {
            position: absolute;
            bottom: 0.25rem;
            right: 0.25rem;
            background: white;
            padding: 0.375rem;
            border-radius: 9999px;
            border: 1px solid #e5e7eb;
            box-shadow: 0 4px 6px -1px rgba(0,0,0,0.1);
            cursor: pointer;
        }

        .camera-overlay:hover {
            background-color: #f9fafb;
        }

        .profile-name {
            font-size: 1.5rem;
            font-weight: 700;
            margin-top: 1rem;
        }

        .profile-id {
            color: #6b7280;
            font-size: 0.875rem;
        }

        .icon-button-circle {
            width: 2.5rem;
            height: 2.5rem;
            display: flex;
            align-items: center;
            justify-content: center;
            border-radius: 9999px;
            border: none;
            background: transparent;
            cursor: pointer;
            transition: all 0.2s;
        }

        .icon-button-circle:hover {
            background-color: #e5e7eb;
        }

        .icon-button-circle i {
            color: #4b5563;
        }

        .icon-button-circle:hover i {
            color: #000;
        }

        .info-card {
            background: white;
            border: 1px solid #d1d5db;
            border-radius: 0.75rem;
            padding: 2rem;
            box-shadow: 0 1px 2px rgba(0,0,0,0.05);
            max-width: 1152px;
            margin: 1rem auto 0;
        }

        .card-title {
            font-size: 1.25rem;
            font-weight: 700;
            margin-bottom: 2rem;
            color: #1f2937;
        }

        .form-grid {
            display: grid;
            grid-template-columns: repeat(12, 1fr);
            column-gap: 1rem;
            row-gap: 1rem;
            align-items: center;
        }

        .col-2 { grid-column: span 2; }
        .col-3 { grid-column: span 3; }
        .col-4 { grid-column: span 4; }
        .col-6 { grid-column: span 6; }
        .col-7 { grid-column: span 7; }
        .col-10 { grid-column: span 10; }

        .label {
            text-align: right;
            font-weight: 500;
            padding-right: 0.5rem;
            color: #1f2937;
        }

        .field-box {
            background-color: #DEDEDE;
            height: 2rem;
            border-radius: 0.5rem;
            width: 100%;
        }

        .password-row {
            display: flex;
            align-items: center;
            gap: 0.75rem;
        }

        .password-placeholder {
            display: flex;
            align-items: center;
            padding: 0 0.75rem;
            color: #4b5563;
            font-size: 0.75rem;
            letter-spacing: 0.1em;
        }

        .edit-btn {
            border: none;
            background: none;
            color: #374151;
            cursor: pointer;
            flex-shrink: 0;
        }

        .edit-btn:hover {
            color: #000;
        }

        .status-container {
            display: flex;
            align-items: center;
            gap: 0.5rem;
        }

        .status-text {
            font-size: 0.875rem;
        }

        .status-dot {
            width: 0.875rem;
            height: 0.875rem;
            background-color: #00A651;
            border-radius: 9999px;
        }

        .log-text {
            font-size: 0.875rem;
        }

        .logout-wrapper {
            display: flex;
            justify-content: flex-end;
        }

        .btn-logout {
            background-color: #AD2626;
            color: white;
            padding: 0.5rem 2rem;
            border-radius: 0.5rem;
            font-weight: 700;
            font-size: 0.875rem;
            border: none;
            cursor: pointer;
            transition: background 0.2s;
        }

        .btn-logout:hover {
            background-color: #991b1b;
        }
    </style>
</head>
<body>

    <div class="back-nav-container">
        <button id="backBtn" class="icon-button-circle">
            <i data-lucide="chevron-left"></i>
        </button>
    </div>

    <main class="main-container">
        <section class="profile-header">
            <div class="avatar-container">
                <div class="avatar-circle">
                    <i data-lucide="user"></i>
                </div>
                <button class="camera-overlay">
                    <i data-lucide="camera"></i>
                </button>
            </div>
            <h1 class="profile-name">Dela Cruz, Juan T.</h1>
            <p class="profile-id">Student ID: 10-2001</p>
        </section>

        <div class="info-card">
            <h2 class="card-title">Account Info</h2>

            <div class="form-grid">
                <div class="label col-2">First Name:</div>
                <div class="col-2"><div class="field-box"></div></div>

                <div class="label col-2">Last Name:</div>
                <div class="col-2"><div class="field-box"></div></div>

                <div class="label col-2">Middle Name:</div>
                <div class="col-2"><div class="field-box"></div></div>

                <div class="label col-2">Year Level:</div>
                <div class="field-container col-3">
                    <div class="field-box"></div>
                </div>
                <div class="spacer col-7"></div>

                <div class="label col-2">Program:</div>
                <div class="field-container col-3">
                    <div class="field-box"></div>
                </div>
                <div class="spacer col-7"></div>

                <div class="label col-2">Email:</div>
                <div class="field-container col-3">
                    <div class="field-box"></div>
                </div>
                <div class="spacer col-7"></div>

                <div class="label col-2">Password:</div>
                <div class="field-container col-3 password-row">
                    <div class="field-box password-placeholder">**************</div>
                    <button class="edit-btn">
                        <i data-lucide="square-pen" class="w-5 h-5"></i>
                    </button>
                </div>
                <div class="spacer col-7"></div>

                <div class="label col-2">Status:</div>
                <div class="status-container col-10">
                    <span class="status-text">Active</span>
                    <div class="status-dot"></div>
                </div>

                <div class="label col-2">Last logged:</div>
                <div class="log-text col-10">3/7/2026</div>

                <div class="label col-2">Created On:</div>
                <div class="log-text col-6">3/7/2026</div>

                <div class="col-4 logout-wrapper">
                    <button id="logOutBtn" class="btn-logout">Logout</button>
                </div>
            </div>
        </div>
    </main>

    <script>
        document.getElementById("backBtn").addEventListener("click", () => {
            window.location.href = "../../../index.php";
        });

        document.getElementById("logOutBtn").addEventListener("click", () => {
            window.location.href = "loginLanding.php?page=loginForm0";
        });

        lucide.createIcons();
    </script>
</body>
</html>