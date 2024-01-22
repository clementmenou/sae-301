const burgerMenu = document.querySelector(".burger-menu");
const HeaderLinkZone = document.querySelector(".header-link-zone");

burgerMenu.addEventListener("click", function () {
  HeaderLinkZone.classList.toggle("active");
  burgerMenu.classList.toggle("active");
  console.log("TEST");
});
