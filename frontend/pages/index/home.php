<style>
    /* --- Universal Reset --- */
    * {
        margin: 0;
        padding: 0;
        box-sizing: border-box;
        font-family: 'Poppins', 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif; /* Poppins for clean look */
    }

    body {
        background-color: #FDFDFD;
        color: #333;
    }

    /* --- Featured Events Slider (Top Section) --- */
    .featured-container {
        display: flex;
        align-items: center;
        background-color: #EDF3FC; /* Gentle blue background */
        height: 70vh;
        width: 100%;
        position: relative;
        overflow: hidden;
    }

    /* University description on the left */
    .featured-text-block {
        flex: 1;
        padding: 8% 5% 5% 10%;
        color: #002D62; /* Navy blue */
    }

    .featured-text-block h1 {
        font-weight: 900;
        font-size: clamp(2rem, 5vw, 3.5rem);
        line-height: 1;
        margin-bottom: 20px;
    }

    .featured-text-block p {
        font-size: 1.1rem;
        line-height: 1.6;
        color: rgba(0, 45, 98, 0.85);
        margin-bottom: 30px;
    }

    /* --- Slideshow Area (Right Side) --- */
.slider-media-window {
    /* flex 1.2 or 1.3 helps prevent the image from feeling 'too big' compared to the text */
    flex: 1.2; 
    height: 100%;
    position: relative;
    display: flex;
    overflow: hidden;
    /* Ensures the image doesn't bleed out of its container */
    border-top-right-radius: 0; 
}

.slider-track {
    display: flex;
    height: 100%;
    margin-left: 6rem;
}

.slide-media {
    /* Using width: 100% instead of min-width helps with containment */
    width: 100%; 
    height: 100%;
    object-fit: cover;
    flex-shrink: 0;
}

/* --- Fixed Slider Navigation (Matching image_aec3bd.png) --- */
/* We remove .slide-btns wrapper and style .sliders directly as absolute children */
.sliders {
    position: absolute;
    top: 50%;
    transform: translateY(-50%);
    z-index: 10;
    
    /* Smaller size for better proportions */
    width: 60px;
    height: 60px;
    border-radius: 50%;
    
    /* Radial gradient for that 'glow' effect in image_aec3bd.png */
    background: radial-gradient(circle, rgba(255,255,255,0.4) 0%, rgba(255,255,255,0.1) 70%, transparent 100%);
    border: none;
    color: white;
    cursor: pointer;
    
    /* Subtle blur */
    backdrop-filter: blur(4px);
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 2rem;
    font-weight: 300;
    transition: all 0.3s ease;
}

/* Left Arrow Position */
#prevBtn {
    left: 20px;
}

/* Right Arrow Position */
#nextBtn {
    right: 20px;
}

.sliders:hover {
    background: radial-gradient(circle, rgba(255,255,255,0.6) 0%, rgba(255,255,255,0.2) 70%, transparent 100%);
    transform: translateY(-50%) scale(1.1);
}

/* Responsive fix to keep things proportional on smaller screens */
@media (max-width: 1024px) {
    .slider-media-window {
        flex: 1;
        height: 350px; /* Fixed height on mobile so it doesn't stay too big */
    }
    
    .sliderR{
        width: 50px;
        height: 50px;
        font-size: 1.5rem;
    }

<<<<<<< HEAD
    <h1 class="featured-title">Current Events</h1>
=======
    .sliderL{
>>>>>>> a33ced97f31151ed617a6fa0787189683646ab20

        width: 50px;
        height: 50px;
        font-size: 1.5rem;
        color:#002D62;
    }
}

    /* --- Blue Stats Banner (Precision Layout) --- */
    .stats-banner {
        background-color: #002D62; /* Official school navy */
        color: #FDFDFD;
        padding: 60px 10%;
        display: flex;
        justify-content: space-around;
        align-items: center;
    }

    .stat-item {
        display: flex;
        align-items: center;
        gap: 25px;
        text-align: left;
    }

    .stat-number {
        font-size: clamp(3rem, 7vw, 5rem);
        font-weight: 900;
        line-height: 1;
        letter-spacing: -2px;
    }

    .stat-label {
        font-size: clamp(0.9rem, 2vw, 1.2rem);
        font-weight: 600;
        line-height: 1.3;
        text-transform: uppercase;
    }

    /* --- Section: About University --- */
    .about-section {
        padding: 100px 10%;
    }

    .about-container {
        display: grid;
        grid-template-columns: 1fr 1fr;
        gap: 80px;
        align-items: center;
    }

    /* Left: The Library Image */
    .about-image {
        width: 100%;
        height: 550px;
        object-fit: cover;
        border-radius: 12px;
        box-shadow: 0 30px 70px rgba(0,0,0,0.1);
    }

    /* Right: The Heading and Text */
    .about-heading {
        font-size: clamp(2rem, 4vw, 2.8rem);
        font-weight: 900;
        color: #002D62;
        margin-bottom: 30px;
        line-height: 1.1;
    }

    .about-text {
        font-size: 1.1rem;
        line-height: 1.7;
        color: #666;
        margin-bottom: 25px;
        text-align: justify;
    }

    /* --- Section: Upcoming Events --- */
    .events-section {
        padding: 100px 10%;
    }

    .events-container {
        display: grid;
        grid-template-columns: 1fr 1fr;
        gap: 80px;
        align-items: center;
    }

    .events-heading {
        font-size: 2rem;
        font-weight: 900;
        text-transform: uppercase;
        color: #002D62;
        margin-bottom: 50px;
    }

    /* List of Events */
    .event-list {
        display: flex;
        flex-direction: column;
        gap: 35px;
    }

    .event-item {
        display: flex;
        gap: 30px;
        align-items: flex-start;
    }

    /* Event Date block */
    .event-date-box {
        background-color: #EDF3FC;
        color: #002D62;
        text-align: center;
        padding: 20px;
        border-radius: 10px;
        width: 120px;
    }

    .event-day {
        font-size: 3.5rem;
        font-weight: 900;
        line-height: 1;
    }

    .event-month {
        font-size: 1.2rem;
        font-weight: 700;
        text-transform: uppercase;
        margin-top: 5px;
    }

    /* Event Details */
    .event-info h3 {
        font-weight: 700;
        color: #002D62;
        margin-bottom: 8px;
        font-size: 1.3rem;
    }

    .event-info p {
        color: #777;
        line-height: 1.6;
        font-size: 1.05rem;
    }

    /* Event Image on the right */
    .event-photo {
        width: 100%;
        height: 500px;
        object-fit: cover;
        border-radius: 12px;
        box-shadow: 0 30px 70px rgba(0,0,0,0.1);
    }

    /* --- Section: Final Quote --- */
    .quote-section {
        padding: 80px 10%;
        text-align: center;
        background-color: #EDF3FC;
    }

    .quote-text {
        font-size: clamp(1.8rem, 4vw, 2.8rem);
        font-weight: 900;
        color: #002D62;
        font-style: italic;
        line-height: 1.2;
    }

    /* Responsive Logic */
    @media (max-width: 1024px) {
        .featured-container { height: 60vh; }
        .about-container, .events-container { grid-template-columns: 1fr; gap: 50px; }
        .about-image, .event-photo { height: 350px; }
        .stats-banner { padding: 40px 5%; }
        .stat-item { gap: 15px; }
    }
</style>

<section class="featured-container" id="top">
    <div class="featured-text-block">
        <h1>University of <br> Kristian Evangelion</h1>
        <p>Dynamic academic community dedicated to excellence, innovation, and holistic student growth. Explore upcoming events and inspire leadership, creativity, and lifelong learning.</p>
    </div>

    <div class="slider-media-window">
        <div class="slider-track" id="sliderTrack">
            <img src="image_data\event_bg_picture\image.png" alt="Students" class="slide-media">  
        </div>
    </div>

</section>

<section class="stats-banner">
    <div class="stat-item">
        <div class="stat-number">111</div>
        <div class="stat-label">Years of<br> Academic Excellence</div>
    </div>
    <div class="stat-item">
        <div class="stat-number">57</div>
        <div class="stat-label">Board<br> Topnotchers</div>
    </div>
    <div class="stat-item">
        <div class="stat-number">21</div>
        <div class="stat-label">Fully<br> Equipped Facilities</div>
    </div>
</section>

<section class="about-section">
    <div class="about-container">
        <img src="image_data\event_bg_picture\about-image.jpg" alt="UKE Library" class="about-image">
        <div>
            <h1 class="about-heading">Excellence built through faith and dedication</h1>
            <p class="about-text">At the University of Kristian Evangelion, our students embody the core values of faith and unwavering dedication. We approach higher education with a profound sense of purpose, striving for excellence in both rigorous academic pursuits and holistic personal growth.</p>
            <p class="about-text">Driven by ambition, our students set high standards for themselves, constantly seeking new challenges to further their professional and moral development. Excellence is not merely an aspiration—it is the standard we uphold.</p>
        </div>
    </div>
</section>

<section class="events-section">
    <div class="events-container">
        <div>
            <h1 class="events-heading">Upcoming Events</h1>
            <div class="event-list">
                <div class="event-item">
                    <div class="event-date-box">
                        <div class="event-day">19</div>
                        <div class="event-month">June</div>
                    </div>
                    <div class="event-info">
                        <h3>The SBSN Peace Retreat Movement 2024</h3>
                        <p>Fostering Prayer and Work</p>
                    </div>
                </div>

                <div class="event-item">
                    <div class="event-date-box">
                        <div class="event-day">03</div>
                        <div class="event-month">Aug</div>
                    </div>
                    <div class="event-info">
                        <h3>UKE Final Assessment Week</h3>
                        <p>Upholding Scholarly Integrity</p>
                    </div>
                </div>

                <div class="event-item">
                    <div class="event-date-box">
                        <div class="event-day">27</div>
                        <div class="event-month">Oct</div>
                    </div>
                    <div class="event-info">
                        <h3>UKE Athletics Gala 2024</h3>
                        <p>Ignite the Spirit of Competition!</p>
                    </div>
                </div>
            </div>
        </div>
        <img src="image_data\event_bg_picture\gatheringgg.jpg" alt="Event Gathering" class="event-photo">
    </div>
</section>

<section class="quote-section">
    <blockquote class="quote-text">
        "That in all things, <br> God may be Glorified"
    </blockquote>
</section>

<script>
    // Precision slider logic matching your request
    const track = document.getElementById('sliderTrack');
    const slides = document.querySelectorAll('.slide-media');
    const prevBtn = document.getElementById('prevBtn');
    const nextBtn = document.getElementById('nextBtn');

    let currentSlide = 0;
    let autoSlideInterval;

    function showSlide(index) {
        if (index >= slides.length) {
            currentSlide = 0;
        } else if (index < 0) {
            currentSlide = slides.length - 1;
        } else {
            currentSlide = index;
        }
        track.style.transform = `translateX(-${currentSlide * 100}%)`;
    }

    function nextSlide() {
        showSlide(currentSlide + 1);
        resetAutoSlide();
    }

    function prevSlide() {
        showSlide(currentSlide - 1);
        resetAutoSlide();
    }

    function startAutoSlide() {
        // Precise 5-second interval
        autoSlideInterval = setInterval(nextSlide, 5000);
    }

    function resetAutoSlide() {
        clearInterval(autoSlideInterval);
        startAutoSlide();
    }

    // Event Listeners for Nav Buttons
    nextBtn.addEventListener('click', nextSlide);
    prevBtn.addEventListener('click', prevSlide);

    // Initialization check
    if(slides.length > 0) {
        startAutoSlide();
    }
</script>