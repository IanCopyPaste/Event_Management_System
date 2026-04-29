<style>
    * {
        padding: 0;
        margin: 0;
        box-sizing: border-box;
    }

    header {
        font-style: 'Barlow', sans-serif;
        padding: 10px;
        border-radius: 0px 10px 10px 0px;
        position: sticky;
    }

    .upper-container {
        padding: 0;
        display: grid;
        grid-template-columns: repeat(3, 33%);
    }

    .logo-container {
        display: flex;
        align-items: center;
        gap: 10px;
        font-size: 1.5rem;
        font-style: 'Barlow', sans-serif;
        font-weight: 600;
    }

    .logo-container img {
        width: 60px;
        height: auto;
    }

    .nav-container {
        margin: auto;
    }

    .nav-container ul {
        display: flex;
        gap: 30px;
        list-style-type: none;
    }

    .nav-container li {
        display: inline-block;
    }

    .nav-container button {
        background: none;
        border: none;
        cursor: pointer;
        color: black;
        font-family: 'Lucida Sans', Geneva, Verdana, sans-serif;
        position: relative;
        display: inline-block;
        transition: transform 0.2s ease, color 0.2s ease;
        font-size: 16px;
    }

    .nav-container button:hover {
        color: rgb(0, 100, 214);
        ;
        transform: scale(1.05);
        font-weight: bold;
    }

    .nav-container button::after {
        content: "";
        position: absolute;
        width: 0%;
        height: 2px;
        background: rgb(0, 100, 214);
        ;
        left: 0;
        bottom: -3px;
        transition: 0.3s ease;
    }

    .nav-container button:hover::after {
        width: 100%;
    }

    .nav-container button.active {
        color: rgb(0, 100, 214);
        font-weight: bold;
    }

    .nav-container button.active::after {
        width: 100%;
    }

    .right-container .rightLogin-container {
        width: 100%;
        /*display: flex;*/
        gap: 10px;
        justify-content: end;
        margin-right: 5px;
    }

    .right-container .rightLogin-container button {
        font-family: 'Barlow', sans-serif;
        font-weight: bold;
        font-size: 1rem;
        padding: 8px 40px;
        border-radius: 5px;
        border: none;
        outline: none;
        box-shadow: 1px 3px 5px 1px rgba(125, 125, 125, 0.4);
        transition: 0.2s ease;
    }

    .right-container .rightLogin-container .btnLog {
        background-color: white;
        color: rgb(0, 100, 214);
    }

    .right-container .rightLogin-container .btnLogOrg {
        background-color: rgb(0, 100, 214);
        color: white;
    }

    .right-container .rightLogin-container button:hover {
        cursor: pointer;
        transform: scale(1.02);
    }

    .right-container .rightInfo-container {
        width: 100%;
        gap: 10px;
        justify-content: end;
        align-items: center;
    }

    .right-container .rightLogin-container .info-container {
        display: flex;
        flex-direction: column;
        gap: 20px;
        font-family: 'Barlow', sans-serif;
    }

    .right-container .rightInfo-container .info-container .txtName {
        font-size: 1.5rem;
        font-weight: 600;
    }

    .right-container .rightInfo-container .info-container .txtUserid {
        font-size: 1.1rem;
    }

    .right-container .rightInfo-container img {
        width: 70px;
        height: auto;
        border-radius: 100px;
    }
</style>
<header>
    <div class="upper-container">
        <div class="logo-container">
            <img src="frontend/assetsImages/login/logoUKE.svg" alt="univLogo.php">
            <p>University of Kristian Evangelion</p>
        </div>
        <nav class="nav-container">
            <form action="index.php" method="GET">
                <ul>
                    <li>
                        <button name="page" value="home" class="<?= $page == 'home' ? 'active' : '' ?>">
                            Home
                        </button>
                    </li>

                    <li>
                        <button name="page" value="events"
                            class="<?= ($page == 'events' || $page == 'eventView') ? 'active' : '' ?>">
                            Events
                        </button>
                    </li>

                    <li>
                        <button name="page" value="calendar"
                            class="<?= $page == 'calendar' ? 'active' : '' ?>">
                            My Calendar
                        </button>
                    </li>

                    <li>
                        <button name="page" value="org"
                            class="<?= $page == 'org' ? 'active' : '' ?>">
                            Create Organization
                        </button>
                    </li>
                </ul>
            </form>
        </nav>
        <div class="right-container">
            <div class="rightLogin-container" style="display: none;">
                <button class="btnLog">Login</button>
                <button class="btnLogOrg">Login as organizer</button>
            </div>
            <div class="rightInfo-container" style="display: flex;">
                <div class="info-container">
                    <p class="txtName">Santos, Ronald M.</p>
                    <p class="txtUserid">User ID: 20200</p>
                </div>
                <img src="frontend/assetsImages/organizerSide/profileImg.png" alt="UserIMG.jpeg">
            </div>
        </div>
    </div>
</header>
<script>
    console.log("this is from the header bitch");
    console.log("this is from the header bitch2");

    const btnToLogin = document.querySelector(".btnLog");

    document.addEventListener("DOMContentLoaded", async () => {
        const profileContainer = document.querySelector(".rightInfo-container");
        const profileName = document.querySelector(".info-container .txtName");
        const profileUserid = document.querySelector(".info-container .txtUserid");

        const loginContainer = document.querySelector(".rightLogin-container");
        try {
            const response = await fetch("backend/forBackendData/checkUser_id.php");
            const data = await response.json();
            if (data["isStored"] == true) {
                profileContainer.style.display = "flex";
                loginContainer.style.display = "none";
                getUserCredential();
            } else {
                loginContainer.style.display = "flex";
                profileContainer.style.display = "none"
            }
        } catch (error) {
            console.error(error);
        }

        async function getUserCredential() {
            const response = await fetch("backend/forBackendData/homePage/userDisplay.php");
            const data = await response.json();
            profileName.textContent = data.last_name + ", " + data.first_name + " " + (data.middle_name ?? '');
            profileUserid.textContent = "User ID: " + data.users_id;
        }
    });


    btnToLogin.addEventListener("click", () => {
        window.location.href = "loginLanding.php"
    });
</script>