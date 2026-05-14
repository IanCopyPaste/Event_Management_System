<style>
    /* --- Section: Featured Events Slider --- */
.featured-container {
    height: 85vh; /* Increased slightly for more "breathability" */
    position: relative;
    width: 100%;
    overflow: hidden;
    background-color: #000;
    display: flex;
    align-items: center;
    justify-content: center;
}

.backblur-img {
    inset: 0;
    position: absolute;
    z-index: 1;
}

.backblur-img img {
    height: 100%;
    width: 100%;
    filter: blur(20px) brightness(0.35); /* Deeper blur for better text contrast */
    object-fit: cover;
}

.overlay-shading {
    position: absolute;
    inset: 0;
    background: radial-gradient(circle at center, transparent 0%, rgba(0,0,0,0.7) 100%);
    z-index: 2;
}

.featured-title {
    position: absolute;
    top: 50px;
    left: 8%;
    z-index: 5;
    color: var(--white);
    font-family: 'Barlow', sans-serif;
    font-weight: 900;
    font-size: clamp(1.5rem, 4vw, 2.5rem);
    text-transform: uppercase;
    letter-spacing: 2px;
    border-left: 6px solid var(--primary-blue);
    padding-left: 20px;
}

/* --- The Event Card --- */
.top-img-container {
    position: relative;
    z-index: 4;
    width: clamp(320px, 85vw, 1100px);
    height: 520px;
    border-radius: 16px; /* Modern, softer corners */
    overflow: hidden;
    box-shadow: 0 40px 100px rgba(0,0,0,0.9);
    transition: var(--transition);
}

.top-img-container:hover {
    transform: translateY(-5px);
}

.top-img-main {
    width: 100%;
    height: 100%;
    object-fit: cover;
    transition: transform 0.8s ease;
}

.top-img-container:hover .top-img-main {
    transform: scale(1.05);
}

.text-overlay {
    position: absolute;
    bottom: 0;
    left: 0;
    right: 0;
    padding: 60px 50px 40px;
    background: linear-gradient(to top, 
        rgba(0, 10, 25, 0.95) 0%, 
        rgba(0, 10, 25, 0.6) 50%, 
        transparent 100%);
    z-index: 5;
}

.event-org {
    color: var(--primary-blue);
    text-transform: uppercase;
    font-weight: 800;
    letter-spacing: 3px;
    font-size: 0.9rem;
}

.event-title {
    font-family: 'Barlow', sans-serif;
    color: var(--white);
    font-size: clamp(2.2rem, 6vw, 4rem);
    font-weight: 900;
    margin: 10px 0;
    line-height: 0.9;
}

.event-details-row {
    display: flex;
    justify-content: space-between;
    align-items: center;
    margin-top: 25px;
    border-top: 1px solid rgba(255,255,255,0.1);
    padding-top: 20px;
}

.event-time {
    color: rgba(255,255,255,0.6);
    font-size: 1.1rem;
    font-weight: 500;
}

.event-status {
    background: var(--primary-blue);
    color: var(--white);
    font-weight: 800;
    padding: 10px 30px;
    border-radius: 50px; /* Pill shape is more modern */
    text-transform: uppercase;
    font-size: 0.85rem;
    box-shadow: 0 4px 15px rgba(0, 100, 214, 0.4);
}

/* --- Section: About --- */
.about-section {
    padding: 150px 8%;
    background-color: var(--white);
}

.about-container {
    display: grid;
    grid-template-columns: 1fr 1fr;
    gap: 100px;
    align-items: flex-start;
}

.about-heading {
    font-family: 'Barlow', sans-serif;
    font-size: clamp(2.5rem, 5vw, 3.8rem);
    font-weight: 900;
    text-transform: uppercase;
    color: var(--dark-navy);
    margin-bottom: 40px;
    line-height: 1;
}

.about-text {
    font-size: 1.15rem;
    line-height: 1.7;
    color: var(--text-muted);
    margin-bottom: 30px;
    text-align: justify;
}

.about-text strong {
    color: var(--primary-blue);
    font-weight: 700;
}

.about-stats {
    display: grid;
    grid-template-columns: repeat(2, 1fr);
    gap: 30px;
    margin-top: 50px;
    padding-top: 40px;
    border-top: 2px solid #f0f0f0;
}

.stat-item {
    display: flex;
    flex-direction: column;
}

.stat-number {
    font-family: 'Barlow', sans-serif;
    font-size: 3rem;
    font-weight: 900;
    color: var(--primary-blue);
    line-height: 1;
}

.stat-label {
    font-size: 0.8rem;
    text-transform: uppercase;
    color: #bbb;
    letter-spacing: 2px;
    margin-top: 10px;
    font-weight: 700;
}

/* --- About Image Frame (Precision Layout) --- */
.about-image-wrapper {
    position: relative;
    padding: 20px; /* Creates space for the offset frame */
}

.about-image {
    width: 100%;
    height: 600px;
    object-fit: cover;
    border-radius: 8px;
    position: relative;
    z-index: 3;
    box-shadow: 0 20px 40px rgba(0,0,0,0.15);
}

.image-accent-frame {
    position: absolute;
    bottom: -20px; /* Offset as seen in image_b179b7.jpg */
    right: -20px;
    width: 100%;
    height: 100%;
    border: 15px solid var(--primary-blue);
    z-index: 1;
    border-radius: 8px;
}

/* --- Controls --- */
.slide-btns {
    position: absolute;
    bottom: 40px;
    right: 8%;
    display: flex;
    gap: 15px;
    z-index: 10;
    pointer-events: auto;
}

.sliders {
    background: var(--glass-bg);
    border: 1px solid rgba(255, 255, 255, 0.2);
    color: var(--white);
    width: 60px;
    height: 60px;
    border-radius: 50%;
    cursor: pointer;
    backdrop-filter: blur(12px);
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 1.2rem;
    transition: var(--transition);
}

.sliders:hover {
    background: var(--primary-blue);
    border-color: var(--primary-blue);
    transform: scale(1.1);
}

/* --- Responsive --- */
@media (max-width: 1024px) {
    .about-container { grid-template-columns: 1fr; gap: 60px; }
    .about-image { height: 450px; }
    .about-heading { font-size: 3rem; }
    .featured-container { height: 70vh; }
}
</style>
<!-- Featured Events Slider -->
<section class="featured-container" id="feat">
    <div class="backblur-img">
        <img src="frontend/assetsImages/imgBG.jpg" alt="Background Blur" id="backBlur">
        <div class="overlay-shading"></div>
    </div>

    <h1 class="featured-title">Featured Events</h1>

    <div class="top-img-container">
        <img src="frontend/assetsImages/imgBG.jpg" alt="Event Image" class="top-img-main">
        
        <div class="text-overlay">
            <span class="event-org">Loading...</span>
            <h1 class="event-title">Upcoming Event</h1>
            <div class="event-details-row">
                <p class="event-time">Schedule Loading...</p>
                <span class="event-status">Checking Status</span>
            </div>
        </div>
    </div>

    <div class="slide-btns">
        <button class="sliders" id="prevBtn" aria-label="Previous Slide">&#10094;</button>
        <button class="sliders" id="nextBtn" aria-label="Next Slide">&#10095;</button>
    </div>
</section>

<script>
    const slides = [];
let currentSlide = 0;
let slideInterval;

// Selectors matching your professional design
const img = document.querySelector(".top-img-main");
const org = document.querySelector(".event-org");
const title = document.querySelector(".event-title");
const time = document.querySelector(".event-time");
const statusLabel = document.querySelector(".event-status");
const backBlur = document.querySelector("#backBlur");

const prevBtn = document.getElementById("prevBtn");
const nextBtn = document.getElementById("nextBtn");

/**
 * Fetches event data from the backend.
 * Dedicated to school members: Students and Faculty.
 */
async function getEvents() {
    try {
        const response = await fetch("backend/forBackendData/adminNevents/getEvents.php");
        const data = await response.json();

        if (data.status === true && data.records.length > 0) {
            data.records.forEach(event => {
                // Precision pathing for the event images
                const imgPath = "image_data/event_bg_picture/" + event.event_bg_picture;
                
                slides.push({
                    img: imgPath,
                    org: event.org_name,
                    title: event.event_name,
                    // Standardizing date/time for the calendar view
                    time: `${event.start_date} | ${event.start_time}`,
                    status: calculateStatus(event) 
                });
            });

            // Initializing the first slide once data is ready
            showSlide(currentSlide);
            startSlider();
        } else {
            console.warn("No events found for school members.");
            displayPlaceholder();
        }
    } catch (error) {
        console.error("Meticulous logic check: Error fetching events:", error);
        displayPlaceholder();
    }
}

/**
 * Calculates registration status based on the deadline.
 */
function calculateStatus(event) {
    const now = new Date();
    const deadline = new Date(event.registration_deadline);

    // Returns 'Closed' if current time has surpassed the deadline
    return now > deadline ? "Closed" : "Open"; 
}

/**
 * Updates the UI with the selected event details.
 */
function showSlide(index) {
    if (slides.length === 0) return;

    const current = slides[index];

    // Smoothly update content from placeholders to fetched data
    img.src = current.img;
    backBlur.src = current.img;
    org.textContent = current.org;
    title.textContent = current.title;
    time.textContent = current.time;
    statusLabel.textContent = current.status === "Open" ? "Open for Registration" : "Registration Closed";

    // Professional color logic for status indicators
    statusLabel.style.backgroundColor = current.status === "Open" ? "#28a745" : "#dc3545";
}

/**
 * Placeholder handling for empty states or fetch errors.
 */
function displayPlaceholder() {
    title.textContent = "No Upcoming Events";
    org.textContent = "Check back later";
    time.textContent = "Schedule Pending";
    statusLabel.textContent = "N/A";
    statusLabel.style.backgroundColor = "#6c757d";
}

// Slider Control Logic
function startSlider() {
    slideInterval = setInterval(() => {
        currentSlide = (currentSlide + 1) % slides.length;
        showSlide(currentSlide);
    }, 5000);
}

function resetInterval() {
    clearInterval(slideInterval);
    startSlider();
}

// Navigation Event Listeners
nextBtn.addEventListener("click", () => {
    if (slides.length === 0) return;
    currentSlide = (currentSlide + 1) % slides.length;
    showSlide(currentSlide);
    resetInterval();
});

prevBtn.addEventListener("click", () => {
    if (slides.length === 0) return;
    currentSlide = (currentSlide - 1 + slides.length) % slides.length;
    showSlide(currentSlide);
    resetInterval();
});

// Initialization
getEvents();
</script>