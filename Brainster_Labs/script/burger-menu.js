// DOM VARIABLES
const openMenu = document.querySelector(".hamburger-menu");
const showMenu = document.querySelector(".menu");

// LISTENER FOR MENU BUTTON, IF CLICKED TO OPEN MENU, AND HIDE IF YOU CLICKED AGAIN
openMenu.addEventListener("click", () => {
  if (openMenu.classList.contains("open-menu")) {
    openMenu.classList.remove("open-menu");
    showMenu.classList.remove("show-menu");
  } else {
    openMenu.classList.add("open-menu");
    showMenu.classList.add("show-menu");
  }
});
