let lastScroll = 0;
const upperCont = document.querySelector(".upper-container");
const navBar = document.querySelector(".nav-container");

window.addEventListener("scroll", function () {
    let currentScroll = window.pageYOffset;

    // threshold to prevent twitching
    if (Math.abs(currentScroll - lastScroll) < 70) return;

    if (currentScroll > lastScroll) {
        // scrolling down → hide
        upperCont.classList.add("hide");
        navBar.style.margin = "10px 10px"
    } else {
        // scrolling up → show
        upperCont.classList.remove("hide");
        navBar.style.margin = "0px 0px 10px 0px"
    }

    lastScroll = currentScroll;
});