"use strict";

// DOM VARIABLES
const theme = document.querySelector(".theme");
const themeSelector = document.querySelector(".option-select");
const bodyTheme = document.querySelector(".body");
const navbar = document.querySelector(".navbar");
const menu = document.querySelector(".menu");
const listItems = document.querySelector(".list-items");
const burgerMenu = document.querySelector(".burger-menu");
const main = document.querySelector(".main");
const maxImgLoad = document.getElementById("maxImgLoad");
const gallery = document.querySelector(".gallery");
const result = document.querySelector(".result");
const settings = document.querySelector(".settings");
const resolution = window.screen.width;

//VARIABLES
let currentTheme;
const imagesAvailable = 6; //AVAILABLE IMAGES IN FOLDER
const numberImagesReload = 6; //REQUESTED RELOAD COUNT (MIN:2 MAX: ~)
let randomAray = [];
let totalImagesCount = gallery.childElementCount;

// SETTING IMAGE COUNT SLIDER VALUES
maxImgLoad.step = numberImagesReload;
maxImgLoad.value = totalImagesCount;
result.value = gallery.childElementCount;

// ENABLING EXTRA SETTINGS IN HTML
enableExtras();

// GETTING USER THEME FROM LOCAL STORAGE
setUserTheme();

// EVENT LISTENERS ************

// UPDATE SLIDER COUNT
//(IF) DISABLED FOR SMOOTH VARIANTS TESTING

// if (resolution > 768) {
maxImgLoad.addEventListener("mousemove", () => {
  result.value = maxImgLoad.value;
  checkForDelete();
});
// } else {
maxImgLoad.addEventListener("touchmove", () => {
  result.value = maxImgLoad.value;
  checkForDelete();
});
// }

// SHOW MENU ON BURGER CLICK
burgerMenu.addEventListener("click", () => {
  if (listItems.classList.contains("show-menu")) {
    listItems.classList.remove("show-menu");
    burgerMenu.innerHTML = `<i class="fas fa-bars"></i>`;
  } else {
    listItems.classList.add("show-menu");
    burgerMenu.innerHTML = `<i class="fa-solid fa-square-xmark"></i>`;
  }
});

// LOAD IMAGES WHEN SCROLL TO END-PAGE
document.addEventListener("scroll", () => {
  const endOfPage = window.innerHeight + window.scrollY >= document.body.scrollHeight - 50;
  if (endOfPage) {
    if (gallery.childElementCount < maxImgLoad.value) loadImages();
  }
});

// THEME BUTTON CHANGE
themeSelector.addEventListener("click", setNewTheme);

// FUNCTIONS ************

// SETTING USE THEME FROM LOCAL STORAGE
function setUserTheme() {
  currentTheme = localStorage.getItem("currentTheme");
  if (currentTheme == null) currentTheme = "default-theme";
  if (currentTheme != "default-theme") setDarkTheme();
}

// ENABLING EXTRA SETTINGS IN HTML
function enableExtras() {
  settings.classList.add("show-settings");
  settings.classList.remove("hide-settings");
  listItems.classList.remove("auto");
}

// SETTING USER THEME
function setNewTheme() {
  themeSelector.classList.contains("default") ? setDarkTheme() : setDefaultTheme();
}

// SETTING DEFAULT THEME
function setDefaultTheme() {
  theme.classList.add("default"), theme.classList.remove("dark");
  themeSelector.classList.add("default"), themeSelector.classList.remove("dark");
  bodyTheme.classList.add("default-theme"), bodyTheme.classList.remove("dark-theme");
  menu.classList.add("default-theme"), menu.classList.remove("dark-theme");
  navbar.classList.add("default-theme"), navbar.classList.remove("dark-theme");
  localStorage.setItem("currentTheme", "default-theme");
}

// SETTING DARK THEME
function setDarkTheme() {
  menu.classList.add("dark-theme"), menu.classList.remove("default-theme");
  bodyTheme.classList.add("dark-theme"), bodyTheme.classList.remove("default-theme");
  navbar.classList.add("dark-theme"), navbar.classList.remove("default-theme");
  theme.classList.add("dark"), theme.classList.remove("default");
  themeSelector.classList.add("dark"), themeSelector.classList.remove("default");
  localStorage.setItem("currentTheme", "dark-theme");
}

// CHECK FOR DELETE IMAGES ON SLIDER DECREASED
function checkForDelete() {
  if (maxImgLoad.value < gallery.childElementCount) deleteImages();
}

// SHUFFLE RANDOM FILENAME NUMBERS BEFORE EVERY LOAD
function shuffleImgNames() {
  let randomNumber = 0;
  let temp;
  let imagesReload = numberImagesReload - 1;
  let arrayItem = 1;
  // GENERATING NEW ARRAY
  for (let i = 1; i <= numberImagesReload; i++) {
    if (arrayItem > imagesAvailable) arrayItem = Math.floor(Math.random() * imagesAvailable + 1);
    if (imagesAvailable > numberImagesReload) arrayItem = Math.floor(Math.random() * imagesAvailable + 1);
    randomAray.push(arrayItem);
    arrayItem++;
  }
  // SHUFFLE GENERATED ARRAY
  randomAray.forEach((i) => {
    if (imagesReload <= 0) imagesReload = numberImagesReload - 1;
    randomNumber = Math.floor(Math.random() * (imagesReload - 1));
    temp = randomAray[imagesReload];
    randomAray[imagesReload] = randomAray[randomNumber];
    randomAray[randomNumber] = temp;
    imagesReload--;
  });
}

// LOAD MORE IMAGE FUNCTION
function loadImages() {
  shuffleImgNames();
  randomAray.forEach((i, index) => {
    totalImagesCount++;
    let newImagePost = `
      <div class="image-post">
      <a href="#">
      <div class="post front-side">
      <div class="image-cover">
      <img src="./img/work${randomAray[index]}.jpg" alt="" />
      </div>
      </div>
      <div class="post back-side">
      <div class="post-text">
      <h2>Picture ${totalImagesCount}</h2>
      <p>Lorem ipsum dolor sit amet consectetur, adipisicing elit.</p>
      </div>
      </div>
      </a>
      </div>`;
    gallery.innerHTML += newImagePost;
  });
  randomAray = [];
}

// DELETE IMAGE POSTS FROM HTML
function deleteImages() {
  let current = gallery.childElementCount;
  let max = maxImgLoad.value;
  for (current; max <= current - 1; current--) gallery.removeChild(gallery.lastElementChild);
  totalImagesCount = gallery.childElementCount;
}
