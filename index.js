const nav = document.querySelector(".nav-mobile");
const buttonNav = document.querySelector(".nav-toggle");

buttonNav.addEventListener("click", () => {
  nav.classList.toggle("toggle-menu");
});
