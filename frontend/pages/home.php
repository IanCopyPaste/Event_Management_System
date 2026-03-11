<section class="featured-container" id="feat">
    <div class="slider-container" style="height: 80vh;">
        <div class="backblur-img">
            <img src="frontend/assetsImages/imgBG.jpg" alt="blur.jpg" id="backBlur">
        </div>

        <h1 class="featured-title">Featured Events</h1>

        <div class="top-img">
            <div class="top-img-container">
                <img src="frontend/assetsImages/imgBG.jpg" alt="center.jpg" class="top-img-main">
                <h2 class="event-org">Computer Studies</h2>
                <h2 class="event-title">Holloween Party</h2>
                <p class="event-time">7:00 PM to 12:00 AM</p>
                <h2 class="event-status">Open</h2>
            </div>
        </div>

        <div class="slide-btns">
            <button class="sliders" id="prevBtn">&#10094</button>
            <button class="sliders" id="nextBtn">&#10095</button>
        </div>
    </div>

    <div class="slider-organization" style="height: 20vh; width: 100%;">
        <h2
            style="text-align: center; font-family: 'Lucida Sans', 'Lucida Sans Regular', 'Lucida Grande', 'Lucida Sans Unicode', Geneva, Verdana, sans-serif; margin: 15px;">
            Participated Organization:</h2>
        <div class="org-slide-wrapper">
            <div class="org-slide-container">
                <!-- original -->
                <img src="frontend/assetsImages/univLogo.png" class="orgs-main">
                <img src="frontend/assetsImages/univLogo.png" class="orgs-main">
                <img src="frontend/assetsImages/univLogo.png" class="orgs-main">
                <img src="frontend/assetsImages/univLogo.png" class="orgs-main">

                <img src="frontend/assetsImages/univLogo.png" class="orgs-main">
                <img src="frontend/assetsImages/univLogo.png" class="orgs-main">
                <img src="frontend/assetsImages/univLogo.png" class="orgs-main">
                <img src="frontend/assetsImages/univLogo.png" class="orgs-main">
                <img src="frontend/assetsImages/univLogo.png" class="orgs-main">
                <img src="frontend/assetsImages/univLogo.png" class="orgs-main">
                <img src="frontend/assetsImages/univLogo.png" class="orgs-main">
                <img src="frontend/assetsImages/univLogo.png" class="orgs-main">
                <img src="frontend/assetsImages/univLogo.png" class="orgs-main">
                <img src="frontend/assetsImages/univLogo.png" class="orgs-main">
                <img src="frontend/assetsImages/univLogo.png" class="orgs-main">
                <img src="frontend/assetsImages/univLogo.png" class="orgs-main">
                <img src="frontend/assetsImages/univLogo.png" class="orgs-main">
                <img src="frontend/assetsImages/univLogo.png" class="orgs-main">
                <img src="frontend/assetsImages/univLogo.png" class="orgs-main">
                <img src="frontend/assetsImages/univLogo.png" class="orgs-main">
                <img src="frontend/assetsImages/univLogo.png" class="orgs-main">
                <img src="frontend/assetsImages/univLogo.png" class="orgs-main">
                <img src="frontend/assetsImages/univLogo.png" class="orgs-main">
                <img src="frontend/assetsImages/univLogo.png" class="orgs-main">
                <img src="frontend/assetsImages/univLogo.png" class="orgs-main">
                <img src="frontend/assetsImages/univLogo.png" class="orgs-main">
                <img src="frontend/assetsImages/univLogo.png" class="orgs-main">
                <img src="frontend/assetsImages/univLogo.png" class="orgs-main">
            </div>
        </div>
    </div>
</section>
<section class="mainNav-container">

    <form action="index.php" method="GET">
        <button class="box" id="box1"
            style="background:url(frontend/assetsImages/imgBG3.jpg);">
            <input type="hidden" name="page" value="events">
            <h1 id="txtEvents">Events</h1>
        </button>
    </form>

    <form action="index.php" method="GET">
        <button class="box" id="box2"
            style="background:url(frontend/assetsImages/Calendar_2024.jpg);">
            <input type="hidden" name="page" value="calendar">
            <h1 id="txtCalendar">My Calendar</h1>
        </button>
    </form>

    <form action="index.php" method="GET">
        <button class="box" id="box3"
            style="background:url(frontend/assetsImages/campus_map.jpg);">
            <input type="hidden" name="page" value="map">
            <h1 id="txtMap">Campus Map</h1>
        </button>
    </form>

</section>