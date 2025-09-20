// Hamburger line
const hamburger = document.querySelector("#burgerButton");
const navMenu = document.querySelector("#nav-menu");

hamburger.addEventListener("click", function () {
    hamburger.classList.toggle("hamburger-open");
    navMenu.classList.toggle("hidden");
});
