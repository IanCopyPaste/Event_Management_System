 <header class="header-container">
        <div class="upper-container">
            <div class="left-container">
                <a href="index.php">
                    <img src="frontend/assetsImages/univLogo.png" alt="univLogo.png"
                        style="width: clamp(40px, 6vw, 70px); height:auto;">
                </a>

                <h2 style="font-family: 'Lucida Sans', 'Lucida Sans Regular', 'Lucida Grande', 
            'Lucida Sans Unicode', Geneva, Verdana, sans-serif; width: 350px;" id="title">
                    University of Kristian Evangelion: Events
                </h2>
            </div>

            <div class="right-container" style="display: none;">
                <div class="info-container">
                    <h2 style="font-family: 'Lucida Sans', 'Lucida Sans Regular', 
                'Lucida Grande', 'Lucida Sans Unicode', Geneva, Verdana, sans-serif;">
                        Dela Cruz, Juan T.
                    </h2>
                    <p>Student ID: 20-2001</p>
                </div>

                <img src="frontend/assetsImages/icons8-management-100.png" alt="profile.png"
                    style="width: clamp(45px, 7vw, 80px); height:auto; border-radius:200px; border:1px solid black;">
            </div>

            <div class="right-container2" style="display: flex;">
                <a href="loginLanding.php" style="text-decoration: none;"><button class="btnLog" id="btnLogOrg"
                        style="background-color: white; font-family: 'Lucida Sans', 'Lucida Sans Regular', 'Lucida Grande', 'Lucida Sans Unicode', Geneva, Verdana, sans-serif; font-weight: bold;">Login</button></a>
                <button class="btnLog" id="btnLogOrg" style="background-color: rgb(0, 100, 214);; color: white; font-family: 'Lucida Sans', 'Lucida Sans Regular', 'Lucida Grande', 'Lucida Sans Unicode', Geneva, Verdana, sans-serif; font-weight: bold;">Login as
                    organizer</button>
            </div>
        </div>
        <nav class="nav-container" style="margin:0px 0px 10px 0px;">
            <form action="index.php" method="GET">
                <ul>
                    <li><button name="page" value="home" class="<?= $page == 'home' ? 'active' : '' ?>">Home</button></li>
                    <li><button name="page" value="events" class="<?= $page == 'events' ? 'active' : '' ?>">Events</button></li>
                    <li><button name="page" value="calendar" class="<?= $page == 'calendar' ? 'active' : '' ?>">My Calendar</button></li>
                    <li><button name="page" value="map" class="<?= $page == 'map' ? 'active' : '' ?>">Campus Map</button></li>
                </ul>
            </form>
        </nav>
    </header>