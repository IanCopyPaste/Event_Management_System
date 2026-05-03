const slides = [];

async function getEvents() {
    const response = await fetch("backend/forBackendData/adminNevents/getEvents.php"); // FIX THIS PATH
    const data = await response.json();
    

    if (data.status === true) {
        data.records.forEach(event => {
            const imgPath = "image_data/event_bg_picture/" + event.event_bg_picture;
            slides.push({
                img: imgPath,
                org: event.org_name,
                title: event.event_name,
                time: `${event.start_date} ${event.start_time}`,
                status: getStatus(event.status)
            });
        });

        showSlide(currentSlide);
        startSlider();
    }
}

function getStatus(event) {
    const now = new Date();
    const deadline = new Date(event.registration_deadline);

    if (now > deadline) return "Closed";
    return event;
}

let currentSlide = 0;

const img = document.querySelector(".top-img-main");
const org = document.querySelector(".event-org");
const title = document.querySelector(".event-title");
const time = document.querySelector(".event-time");
const status = document.querySelector(".event-status");
const backBlur = document.querySelector("#backBlur");

const prevBtn = document.getElementById("prevBtn");
const nextBtn = document.getElementById("nextBtn");

function showSlide(index) {
    if (slides.length === 0) return;

    img.src = slides[index].img;
    org.textContent = slides[index].org;
    title.textContent = slides[index].title;
    time.textContent = slides[index].time;
    backBlur.src = slides[index].img;

    status.textContent = slides[index].status;

    if (slides[index].status === "Open") {
        status.style.backgroundColor = "green";
    } else if (slides[index].status === "Closed") {
        status.style.backgroundColor = "red";
    } else {
        status.style.backgroundColor = "orange";
    }
}

let slideInterval;

function startSlider() {
    slideInterval = setInterval(() => {
        currentSlide = (currentSlide + 1) % slides.length;
        showSlide(currentSlide);
    }, 4000);
}

nextBtn.addEventListener("click", () => {
    currentSlide = (currentSlide + 1) % slides.length;
    showSlide(currentSlide);
    resetInterval();
});

prevBtn.addEventListener("click", () => {
    currentSlide = (currentSlide - 1 + slides.length) % slides.length;
    showSlide(currentSlide);
    resetInterval();
});

function resetInterval() {
    clearInterval(slideInterval);
    startSlider();
}

// 🔥 IMPORTANT: call this
getEvents();