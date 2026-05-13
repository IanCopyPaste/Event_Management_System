<style>
    /* Global refined resets */
    * {
        padding: 0;
        margin: 0;
        box-sizing: border-box;
    }

    header {
        font-family: 'Barlow', sans-serif;
        padding: 12px 40px;
        background: rgba(255, 255, 255, 0.9);
        backdrop-filter: blur(10px); /* Modern glass effect */
        border-bottom: 1px solid #e2e8f0;
        position: sticky;
        top: 0;
        z-index: 1000;
        box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.05);
    }

    .upper-container {
        display: grid;
        /* Adjusted grid for better balance */
        grid-template-columns: 1fr auto 1fr; 
        align-items: center;
    }

    /* Logo Styling */
    .logo-container {
        display: flex;
        align-items: center;
        gap: 12px;
        font-size: 1.2rem;
        font-weight: 800;
        color: #1e293b;
        letter-spacing: -0.5px;
    }

    .logo-container img {
        width: 45px;
        height: auto;
        filter: drop-shadow(0 2px 4px rgba(0,0,0,0.1));
    }

    /* Navigation Styling */
    .nav-container ul {
        display: flex;
        gap: 32px;
        list-style-type: none;
    }

    .nav-container button {
        background: none;
        border: none;
        cursor: pointer;
        color: #64748b;
        font-family: 'Barlow', sans-serif; /* Consistent font */
        font-weight: 600;
        position: relative;
        transition: all 0.3s ease;
        padding: 8px 0;
        font-size: 15px;
    }

    .nav-container button:hover {
        color: #2563eb;
    }

    /* Elegant Underline Animation */
    .nav-container button::after {
        content: "";
        position: absolute;
        width: 0%;
        height: 2px;
        background: #2563eb;
        left: 0;
        bottom: 0;
        transition: 0.3s cubic-bezier(0.4, 0, 0.2, 1);
        border-radius: 2px;
    }

    .nav-container button:hover::after,
    .nav-container button.active::after {
        width: 100%;
    }

    .nav-container button.active {
        color: #2563eb;
    }

    /* Right Section: Login Buttons */
    .right-container {
        display: flex;
        justify-content: flex-end;
    }

    .rightLogin-container {
        display: flex;
        gap: 12px;
    }

    .rightLogin-container button {
        font-family: 'Barlow', sans-serif;
        font-weight: 700;
        font-size: 0.9rem;
        padding: 10px 24px;
        border-radius: 10px;
        border: none;
        transition: all 0.3s ease;
    }

    .btnLog {
        background-color: transparent;
        color: #2563eb;
        border: 1px solid #e2e8f0 !important;
    }

    .btnLogOrg {
        background-color: #2563eb;
        color: white;
        box-shadow: 0 4px 14px rgba(37, 99, 235, 0.2);
    }

    .rightLogin-container button:hover {
        cursor: pointer;
        transform: translateY(-2px);
        box-shadow: 0 6px 20px rgba(0,0,0,0.1);
    }

    /* Right Section: Profile Info */
    .rightInfo-container {
        display: flex;
        gap: 15px;
        align-items: center;
        background: #f8fafc;
        padding: 6px 6px 6px 18px;
        border-radius: 50px;
        border: 1px solid #e2e8f0;
    }

    .info-container {
        display: flex;
        flex-direction: column;
        line-height: 1.2;
    }

    .txtName {
        font-size: 0.95rem;
        font-weight: 700;
        color: #1e293b;
    }

    .txtUserid {
        font-size: 0.75rem;
        color: #64748b;
        font-weight: 500;
    }

    .rightInfo-container img {
        width: 42px;
        height: 42px;
        border-radius: 50%;
        object-fit: cover;
        border: 2px solid white;
        box-shadow: 0 2px 8px rgba(0,0,0,0.1);
        transition: 0.3s ease;
    }

    .rightInfo-container img:hover {
        cursor: pointer;
        transform: scale(1.1);
        border-color: #2563eb;
    }
</style>

<header>
    <div class="upper-container">
        <div class="logo-container">
            <img src="frontend/assetsImages/login/logoUKE.svg" alt="univLogo">
            <p>University of Kristian Evangelion</p>
        </div>

        <nav class="nav-container">
            <form action="index.php" method="GET">
                <ul>
                    <li>
                        <button name="page" value="home" class="<?= $page == 'home' ? 'active' : '' ?>">Home</button>
                    </li>
                    <li>
                        <button name="page" value="events" class="<?= ($page == 'events' || $page == 'eventView') ? 'active' : '' ?>">Events</button>
                    </li>
                    <li>
                        <button name="page" value="calendar" class="<?= $page == 'calendar' ? 'active' : '' ?>">My Calendar</button>
                    </li>
                    <li>
                        <button name="page" value="orgs" class="<?= $page == 'orgs' ? 'active' : '' ?>">Organizations</button>
                    </li>
                </ul>
            </form>
        </nav>

        <div class="right-container">
            <div class="rightLogin-container" id="loginArea" style="display: none;">
                <button class="btnLog">Login</button>
                <button class="btnLogOrg">Login as Organizer</button>
            </div>
            
            <div class="rightInfo-container" id="profileArea" style="display: none;">
                <div class="info-container">
                    <p class="txtName">Loading...</p>
                    <p class="txtUserid">User ID: ---</p>
                </div>
                <img src="<?= "image_data/user_pic/" . ($_SESSION["users_pic"] ?? "profileImg.png") ?>" alt="User Profile">
            </div>
        </div>
    </div>
</header>

<script>
    // All your existing logic remains untouched and fully functional
    const btnToLogin = document.querySelector(".btnLog");
    const btnLogOrg = document.querySelector(".btnLogOrg");
    const BtnprofileImg = document.querySelector(".rightInfo-container img");

    document.addEventListener("DOMContentLoaded", async () => {
        const profileContainer = document.getElementById("profileArea");
        const loginContainer = document.getElementById("loginArea");
        const profileName = document.querySelector(".txtName");
        const profileUserid = document.querySelector(".txtUserid");

        try {
            const response = await fetch("backend/forBackendData/checkUser_id.php");
            const data = await response.json();
            
            if (data["isStored"] == true) {
                profileContainer.style.display = "flex";
                loginContainer.style.display = "none";
                getUserCredential();
            } else {
                loginContainer.style.display = "flex";
                profileContainer.style.display = "none";
            }
        } catch (error) {
            console.error(error);
        }

        async function getUserCredential() {
            try {
                const response = await fetch("backend/forBackendData/homePage/userDisplay.php");
                const data = await response.json();
                profileName.textContent = data.last_name + ", " + data.first_name + " " + (data.middle_name ?? '');
                profileUserid.textContent = "User ID: " + data.users_id;
            } catch (e) { console.error("Credential fetch failed"); }
        }
    });

    btnToLogin.addEventListener("click", () => { window.location.href = "loginLanding.php" });
    btnLogOrg.addEventListener("click", () => { window.location.href = "loginLanding.php?page=orgForm0" });
    BtnprofileImg.addEventListener("click", () => { window.location.href = "frontend/pages/headerFooter/userProfile.php" });
</script>