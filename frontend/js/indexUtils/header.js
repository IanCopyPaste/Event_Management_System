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