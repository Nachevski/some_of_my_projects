`use strict`;
// DOM VARIABLES
const slideCards = document.querySelector(".side-slide-items");
const filterBTN = document.querySelector("#filter-cards");
let isLowResMode = window.matchMedia("(max-width: 800px)");

const totalImagesCount = 13;
let imageIndex = 1;
let imageSlideDuration = 5000;
slideShow();

const iframeUrls = {
  programing: "https://brainster.co/full-stack/",
  marketing: "https://brainster.co/marketing/",
  design: "https://brainster.co/graphic-design/",
  dataScience: "https://brainster.co/data-science/",
};

// INTERVAR AND STEPCOUNTER  ARE USED FOR LOADING CARDS ANIMATION.
// -INCREASING INTERVAL VALUE WILL INCREASE LOAD TIME (MS) FOR EACH CARD.
// STEPCOUNTER ADDS DELAY TIME BETWEEN EVERY CARD LOAD TO PREVENT LOAD ALL IN SAME TIME.
let interval = 250,
  stepCounter = 1;

// SCRIPT VARIABLES
// CHAR LIMIT IS USED TO LIMIT MAX CHARACTERS IN CARDS PROJECT DESCRIPTION
const charLimit = 100;
//CALLING FUNCTION TO CHECK IF SOME CARD DESCRIPTION HAS MORE THEN 100 CHARS.
checkDecriptionLenght();

// GENERATING EFFECTS VALUES ON EVERY PAGE LOAD FOR DIFFERENT CARDS SHOW ANIMATIONS :))
// EXCEPT 1,2 OTHERS HAS RANGES MIN FROM -50% TO -20% AND MAX FROM 20% to 50%
const effects = [
  `translateX(${-100}%)`,
  `translateX(${100}%)`,
  `translateY(${Math.floor(Math.random() * 30 + 20)}%)`,
  `translateY(${-Math.floor(Math.random() * 30 + 20)}%)`,
  `translate(${Math.floor(Math.random() * 30 + 20)}%,  ${Math.floor(Math.random() * 30 + 20)}%)`,
  `translate(${-Math.floor(Math.random() * 30 + 20)}%,  ${-Math.floor(Math.random() * 30 + 20)}%)`,
  `translate(${-Math.floor(Math.random() * 30 + 20)}%,  ${Math.floor(Math.random() * 30 + 20)}%)`,
  `translate(${Math.floor(Math.random() * 30 + 20)}%,  ${-Math.floor(Math.random() * 30 + 20)}%)`,
];

// EVENT LISTENER FOR ALL BUTTONS SECTION INSTEAD OF DIFFERENT LISTENERS FOR EVERY BUTTON
// EVERY CLICK IS RECONGNIZED WHICH BUTTON IS CLICKED BY ID
filterBTN.addEventListener("click", (e) => {
  e.stopPropagation;
  let filterName;
  // PREVENTION IF YOU CLICK CHECKED ICON TO GET PARRENT ID NAME
  e.target.id ? (filterName = e.target.id) : (filterName = e.target.parentElement.id);
  // IF BUTTON IS NOT CHECKED
  if (!document.querySelector(`#${filterName}`).classList.contains("active")) {
    // CALLING FUNCTION WITH ARGUMENT TO DELETE CARDS CLASSES USED FOR ANIMATIONS
    cardsFilter("resetAllCards");
    // CALLING FUNCTION WITH ARGUMENT TO FILTER CARDS DETERMINED BU ID NAME
    // CUTTING FIRST 7 CHARACTERS (FILTER_) WITH SLICE() TO GET REQUESTED CARD CATEGORY.
    // BUTTON_ID = FILTER-MARKETING => FILTERANEME= MARKETING
    // BUTTON_ID = FILTER-DESIGN => FILTERANEME= DESING
    // BUTTON_ID = FILTER-PROGRAMING => FILTERANEME= PROGRAMING
    cardsFilter(filterName.slice(7));
    // RESETING ACTIVE BUTTONS IN CASE IF YOU JUMP FROM ONE TO OTHER CATEGORY
    resetFilterBtn();
    document.querySelector(`#${filterName}`).classList.add("active");
  } else {
    resetFilterBtn();
    // CALLING FUNCTION WITH ARGUMENT TO SHOW ALL CARDS
    // cardsFilter("resetAllCards");
    cardsFilter("showAllCards");
  }
});

// RESETING ALL BUTTONS THAT ARE CHECKED (ACTIVE)
function resetFilterBtn() {
  document.querySelectorAll(".filter-btn").forEach((btn) => {
    btn.classList.remove("active");
  });
}
// FUNCTION TO APPLY REQUESTED FILTER PASSED WITH ARGUMENT
function cardsFilter(request) {
  // SWITCH CASE TO DETERMINE WHICH FILTER TO APPLY
  switch (request) {
    // IF REQUEST IS TO RESET ALL CARDS ANIMATION CLASES
    case "resetAllCards":
      document.querySelectorAll(".card").forEach((card) => {
        card.classList.remove("card-fadeout", "card-fadein", "show-card", "hide-card");
      });
      break;
    // IF REQUEST IS TO SHOW ALL CARDS
    case "showAllCards":
      stepTemp = stepCounter;
      document.querySelectorAll(".card").forEach((card) => {
        card.classList.remove("card-fadein");
        // TIMEOUT FUNCTION TO ADS TRANSITIONS TO CARDS
        setTimeout(function () {
          // CHOOSE DIFFERENT EFFECT FOR EACH CARD ON EVERY FILTER CHANGE
          card.style.transform = generateEffect();
          card.classList.add("show-card");
          card.classList.remove("card-fadeout", "hide-card");
          // PREDEFINED INTERVAL VARIABLE
        }, interval);

        // TIMEOUT FUNCTION TO ADS TRANSITIONS TO CARDS
        setTimeout(function () {
          card.classList.add("card-fadein");
          card.removeAttribute("style");
        }, interval * stepTemp++);
      });
      break;
    // IF REQUEST IS TO APPLY CHOOSED FILTER (MARKETING, DESING, PROGRAMING OR ANY ADDED DIFFERENT LATER)
    default:
      // GENERATING NEW VARIABLE TO PREVENT CHANGE DEFAULT SET VALUE
      stepTemp = stepCounter;
      document.querySelectorAll(".card").forEach((card) => {
        card.removeAttribute("style");
        card.classList.remove("card-fadein");
        card.classList.add("show-card");
        // HERE IT CHECKS IF CARD HAS REQUESTED CLASS NAME TO SHOW THAT CARD
        if (card.classList.contains(request)) {
          // TIMEOUT FUNCTION TO ADS TRANSITIONS TO CARDS
          setTimeout(function () {
            // CHOOSE DIFFERENT EFFECT FOR EACH CARD ON EVERY FILTER CHANGE
            card.style.transform = generateEffect();
            card.classList.add("show-card");
            card.classList.remove("card-fadeout", "hide-card");
          }, interval);
          // TIMEOUT FUNCTION TO ADS TRANSITIONS TO CARDS
          setTimeout(function () {
            card.classList.add("card-fadein");
            card.removeAttribute("style");
          }, interval * stepTemp++);
        } else {
          // HIDE ALL CARDS OTHER THAN REQUESTED
          card.classList.add("hide-card");
          card.classList.remove("show-card");
        }
      });
      break;
  }
}
// GENERATING RANDOM INDEX NUMBER TO SELECT DIFFERENT EFFECT FROM ARRAY ON EVERY CALL
// VALUES FROM 0 TO 7, TOTAL 8 EFFECTS
function generateEffect() {
  // IN TABLET RESOLUTION AND BELLOW LIMITED ONLY TO 1 EFFECT (CAUSING PROBLEMS WITH PAGE WIDTH)
  if (isLowResMode.matches) {
    return effects[0];
  } else {
    // RETURNS EFFECT ON INDEX POSITION EFFECT[RANDOM]
    return effects[Math.floor(Math.random() * effects.length)];
  }
}

// IMAGE SLIDEN IN BANNER SECTION
function slideShow() {
  // IT CHECKS IF RESOLUTION IS NOT NOT IN TABLET MODE TO LOAD PICTURES SLIDE
  // IN TABLET MODE PICTURE SLIDE IS HIDEN
  if (!isLowResMode.matches) {
    // ADDING SOME TRANSITION WHEN CHANGING PICTIRE
    document.querySelector(".img-slide").classList.add("change-img");
    // SETTING DELAY OF 1S BETWEEN SHOW/HIDE PICTURES
    setTimeout(function () {
      // IT CHANGES SRC ON IMG TAG FOR EVERY PIC
      // PICTURES ARE IN IMGS/BANNER FOLDER
      // IMAGEINDEX IS DEFINED AT TOP, AND IS COUNTER FOR HOW MANY IMAGES HAS IN FOLDER TO SHOW
      document.getElementsByClassName("img-slider")[0].src = `./imgs/Banner/slide-${imageIndex++}.jpg`;
      document.querySelector(".img-slide").classList.remove("change-img");
    }, 1000);
    // RESSETING COUNTER IF REACH LIMIT
    if (imageIndex > totalImagesCount) {
      imageIndex = 1;
    }
    // RECURSIVE SELF CALLING FUNCTION, INFINITE LOOP
    // SLIDE DURATION DEFINED AT TOP VARIABLES. CHANGE IF YOU WANT TO CHANGE DELAY TIME BETWEEN IMGS CHANGE
    setTimeout(slideShow, imageSlideDuration);
  }
}
// BRAINSTER CITE IFRAMES AT BANNER LEFT POSITIONS COLORED ICONS
// FOR ANY ICONS WHEN CLICKED
slideCards.addEventListener("click", (e) => {
  let slideCardName;
  let iFrame;
  // GETTING CLICKED ICON ID
  e.target.id ? (slideCardName = e.target) : (slideCardName = e.target.parentElement);
  // IF SELLECTED ICON IS NOT OPENED, CLOSING ANY OPENED ACTIVE SLIDES (IF ANY)
  // AND THEN OPENS REQUESTED
  if (!slideCardName.classList.contains("active-slide")) {
    resetActiveSlide();
    slideCardName.classList.add("active-slide");
    iFrame = document.querySelector(".active-slide .brainster-iframe");
    // CHECKS IF ANY IFRAME WAS OPENED BEFORE TO PREVENT LOADING THE SAME PAGE EVERY
    // CLICK OF THE SAME SLIDE ICON
    if (!iFrame.classList.contains("already-loaded")) {
      // DELAY BEFORE START LOADING REQUESTED BRAINSTER SITE
      setTimeout(function () {
        // SETTING IFRAME URL (DEFINED AT TOP) WITH SLICED FIRST ^ CHARS FROM ID TO GET VARIABLE NAME
        // slide-marketing => marketing
        // slide-programing => programing etc..
        iFrame.src = iframeUrls[slideCardName.id.slice(6)];
      }, 750);
    }
    // ADDING CLASS ALREADY LOADING TO PREVENT LOAD WHEN PRESED NEXT TIME
    iFrame.classList.add("already-loaded");
  } else {
    // CLOSING SLIDE IF IS OPEN
    slideCardName.classList.remove("active-slide");
  }
});
// CLOSING ACTIVE SLIDE WHEN YOU CLICK ANYWHERE ON DOCUMENT, OUTSIDE OF LOADED SLIDE
document.addEventListener("click", (e) => {
  if (!e.target.closest(".slide-item")) {
    resetActiveSlide();
  }
});
// CLOSING ALL OPENED SLIDES (IF ANY)
function resetActiveSlide() {
  document.querySelectorAll(".slide-item").forEach((slide) => {
    slide.classList.remove("active-slide");
  });
}

// CHECK IF CARD DESCRIPTION HAS MORE THAN LIMIT CHARACTERS - CHARLIMIT=100 CHARS
// IF HAS OVER LIMIT IT CUTS AND ADDS ...
function checkDecriptionLenght() {
  document.querySelectorAll(".project-description").forEach((desc) => {
    if (desc.innerHTML.length > charLimit) desc.innerHTML = `${desc.innerHTML.substring(0, charLimit)}...`;
  });
}

console.log("====== END OF SCRIPT ======");
console.log("====== WARNINGS BELLOW COMES FROM LOADING IFRAME ======");
