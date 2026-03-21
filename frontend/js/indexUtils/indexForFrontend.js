document.addEventListener("DOMContentLoaded",async ()=>{
    try {
         const response = await fetch("backend/forBackendData/checkUser_id.php");
         const data = await response.json();
         if(data["isStored"] == true){
            console.log(data["user_id"]);
            displayUser(data["user_id"]);
         }else{
            console.log("user not found");
         }    
    } catch (error) {
        console.error(error);
    }    
});
function displayUser(){
    
}

let lastScroll = 0;
const upperCont = document.querySelector(".upper-container");
const navBar = document.querySelector(".nav-container");
const headerContainer = document.querySelector(".header-container");

window.onload = function(){
    window.scrollTo(0,0);
}

window.addEventListener("scroll", function () {
    let currentScroll = window.pageYOffset;

    // threshold to prevent twitching
    if (Math.abs(currentScroll - lastScroll) < 70) return;

    if (currentScroll > lastScroll) {
        // scrolling down → hide
        upperCont.classList.add("hide");
        navBar.style.margin = "10px 10px"
        headerContainer.style.backgroundColor = "rgba(255, 255, 255, 0.884)"
    } else {
        // scrolling up → show
        upperCont.classList.remove("hide");
        navBar.style.margin = "0px 0px 10px 0px"
        headerContainer.style.backgroundColor = "white"
    }

    lastScroll = currentScroll;
});
const slides = [
{
    img: "frontend/assetsImages/imgBG.jpg",
    org: "Computer Studies",
    title: "Halloween Party",
    time: "7:00 PM to 12:00 AM",
    status: "Open"
},
{
    img: "frontend/assetsImages/imgBG2.jpg",
    org: "Engineering",
    title: "Tech Expo",
    time: "9:00 AM to 5:00 PM",
    status: "Ongoing"
},
{
    img: "frontend/assetsImages/imgBG3.jpg",
    org: "Business",
    title: "Startup Pitch",
    time: "1:00 PM to 4:00 PM",
    status: "Closed"
}
];

let currentSlide = 0;

const img = document.querySelector(".top-img-main");
const org = document.querySelector(".event-org");
const title = document.querySelector(".event-title");
const time = document.querySelector(".event-time");
const status = document.querySelector(".event-status");
const backBlur = document.querySelector("#backBlur");

const prevBtn = document.getElementById("prevBtn");
const nextBtn = document.getElementById("nextBtn");

function showSlide(index){
    img.src = slides[index].img;
    org.textContent = slides[index].org;
    title.textContent = slides[index].title;
    time.textContent = slides[index].time;
    backBlur.src = slides[index].img;
    if(slides[index].status == "Open"){
        status.textContent = slides[index].status;
        status.style.backgroundColor = "green";
    }else if(slides[index].status == "Closed"){
        status.textContent = slides[index].status;
        status.style.backgroundColor = "red";
    }else{
        status.textContent = slides[index].status;
        status.style.backgroundColor = "Orange";
    }
    
}
let slideInterval = setInterval(() => {
    currentSlide++;
    if(currentSlide >= slides.length){
        currentSlide = 0;
    }
    showSlide(currentSlide);
}, 4000); // change slide every 5 seconds

nextBtn.addEventListener("click", () => {
    currentSlide++;
    if(currentSlide >= slides.length){
        currentSlide = 0;
    }
    showSlide(currentSlide);
    clearInterval(slideInterval);
    slideInterval = setInterval(() => {
        currentSlide++;
        if(currentSlide >= slides.length){
            currentSlide = 0;
        }
        showSlide(currentSlide);
    }, 5000);
});

prevBtn.addEventListener("click", () => {
    currentSlide--;
    if(currentSlide < 0){
        currentSlide = slides.length - 1;
    }
    showSlide(currentSlide);
    clearInterval(slideInterval);
    slideInterval = setInterval(() => {
        currentSlide++;
        if(currentSlide >= slides.length){
            currentSlide = 0;
        }
        showSlide(currentSlide);
    }, 5000);
});

showSlide(currentSlide);

const slider = document.querySelector(".org-slide-container");
console.log("FromFrontend");
