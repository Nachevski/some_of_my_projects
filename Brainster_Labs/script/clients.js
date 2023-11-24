`use strict`;
// DOM VARIBLES
const contentCards = document.querySelector(".content-cards");
const tableData = document.querySelector(".table-data");

// IS IN TABLET MODE
let isLowResMode = window.matchMedia("(max-width: 800px)");

// CHANGING CLIENTS LAYOUT WHEN IS IN TABLET MODE
window.addEventListener("resize", () => {
  if (isLowResMode.matches) {
    tableData.classList.add("hide-data");
    contentCards.classList.remove("hide-data");
  } else {
    tableData.classList.remove("hide-data");
    contentCards.classList.add("hide-data");
  }
});
