"use strict";

const intro = document.querySelector(".intro");
const gameCards = document.querySelector(".game-cards");
const cards = document.querySelectorAll(".card-img");
const newGame = document.querySelectorAll(".new-game");
const matchMessage = document.querySelector(".matching-message");
const gameOver = document.querySelector(".game-over");
const totalCounter = document.querySelector(".total-moves");
const pairsRemaining = document.querySelector(".pairs-remaining");
const gamesPlayed = document.querySelector(".games-played");
const gamesWin = document.querySelector(".games-win");
const youLose = document.querySelector(".you-lose");
const timer = document.querySelector(".timer");
const onHold = document.querySelector(".on-hold");

let totalMoves = 0;
let gamePlayedCounter = 0;
let gamesWinCounter = 0;
const cardsDeck = 9; //AVAILABLE IMAGES IN DECK, CHANGE WHEN MORE CARDS ARE ADDED
const cardsReload = 18; //TOTAL CARDS LOAD | YOU CAN CHANGE THIS, INCREMENTS BY 2
let totalPairs = cardsReload / 2;
let match = [];
const cardsNames = [];
const cardsCount = [];
let randomAray = [];
let uniqueNameAray = [];
let timeout;
let gameTimer;

// EVENT LISTENERS FOR NEW GAME BUTTON
for (let newGameBtn of newGame) {
  newGameBtn.addEventListener("click", () => loadNewGame());
}

// EVENT LISTENERS FOR PAGE FOCUS
window.addEventListener("blur", () => clearInterval(gameTimer));

window.addEventListener("focus", () => {
  if (intro.classList.contains("hidden")) loseTimer();
});

// EVENT LISTENERS FOR CARDS CLICKS
function waitForClick() {
  const cards = document.querySelectorAll(".card-img");
  if (match.length > 2) match = [];
  for (let cardSelected of cards) {
    cardSelected.addEventListener("click", (e) => {
      e.stopPropagation;
      clearInterval(gameTimer);
      loseTimer();
      let target = e.currentTarget;
      if (!target.classList.contains("selected")) {
        target.classList.add("selected");
        match.push(e.currentTarget);
      }
      if (match.length == 2) {
        onHold.classList.add("active");
        setTimeout(function () {
          totalMoves++;
          totalCounter.innerHTML = totalMoves;
          checkMatch(match);
        }, 500);
        setTimeout(function () {
          match = [];
        }, 600);
      }
    });
  }
}

// CHECK IF 2 SELECTED CARDS ARE THE SAME
function checkMatch(match) {
  let matchStatus = false;
  for (let i = 0; i <= randomAray.length; i++) {
    if (match[0].classList.contains(randomAray[i]) && match[1].classList.contains(randomAray[i])) {
      match[0].classList.add("matched");
      match[1].classList.add("matched");
      totalPairs--;
      pairsRemaining.innerHTML = totalPairs;
      matchMessage.classList.add("show");
      matchStatus = true;
      setTimeout(function () {
        matchMessage.classList.remove("show");
        onHold.classList.remove("active");
      }, 950);
      if (totalPairs == 0) {
        setTimeout(function () {
          gameOver.classList.add("show");
          clearInterval(gameTimer);
          gamesWinCounter++;
          gamesWin.innerHTML = gamesWinCounter;
        }, 650);
      }
      break;
    }
  }
  if (matchStatus != true) {
    timeout = setTimeout(function () {
      match[0].classList.remove("selected");
      match[1].classList.remove("selected");
      onHold.classList.remove("active");
    }, 1000);
  }
}

// SHUFFLE CARDS ARRAY
function shuffleImgNames() {
  let randomNumber = 0;
  let temp;
  let imagesReload = cardsReload - 1;
  let arrayItem = 0;

  // GENERATING NEW UNIQUE CLASS NAMES
  generateUniqueNames();

  // GENNERATING NEW ARRAY
  for (let i = 1; i <= cardsReload / 2; i++) {
    if (arrayItem > cardsDeck - 1) arrayItem = 0;
    randomAray.push(uniqueNameAray[arrayItem]);
    randomAray.push(uniqueNameAray[arrayItem]);
    arrayItem++;
  }

  // SHUFFLE GENERATED ARRAY
  randomAray.forEach((i) => {
    if (imagesReload <= 0) imagesReload = cardsDeck - 1;

    randomNumber = Math.floor(Math.random() * (imagesReload - 1));
    temp = randomAray[imagesReload];
    randomAray[imagesReload] = randomAray[randomNumber];
    randomAray[randomNumber] = temp;
    imagesReload--;
  });
}

// LOAD NEW GAME
function loadNewGame() {
  randomAray = [];
  gameOver.classList.remove("show");
  youLose.classList.remove("show");
  intro.classList.add("hidden");
  intro.classList.remove("show");

  setGameStatistics();
  deleteCards();
  shuffleImgNames();

  clearInterval(gameTimer);
  if (document.hasFocus()) loseTimer();

  // ADDING RANDOM CARD COVER
  let randomCover = Math.floor(Math.random() * 7 + 1);

  // ADDING CARDS CONTENT
  randomAray.forEach((i) => {
    gameCards.innerHTML += `
    <div class="card-img ${i}">
    <div class="card-inner">
    <div class="card front-side">
    <div class="image-cover">
    <img src="./img/covers/cover${randomCover}.jpg" alt="" />
    </div>
    </div>
    <div class="card back-side">
    <div class="image-face">
    <img src="./img/cards/card${findIndexOfUniqueName(i)}.jpg" alt="" />
    </div>
    </div>
    </div>
    </div>`;
  });
  waitForClick();
}

// GENERATE RANDOM UNIQUE CARDS CLASS NAMES
// NO CHEATING VIA INSPECT :))
function generateUniqueNames() {
  const cryptArray = ["NaAcH", "NaCHE", "NAchE", "NaCHe", "NAcEV", "NaSkI", "NaChV", "NaVLa", "NaDiM", "NaIRR"];
  let cryptName = "";

  for (let i = 1; i <= cardsDeck; i++) {
    for (let j = 0; j <= cryptArray.length; j++) cryptName += cryptArray[Math.floor(Math.random() * 10)];

    uniqueNameAray.push(`{NACHE${cryptName}VSKI}`);
    cryptName = "";
  }
}

// SETTING GAME STATISTICS
function setGameStatistics() {
  totalMoves = 0;
  gamePlayedCounter++;
  totalPairs = cardsReload / 2;
  pairsRemaining.innerHTML = totalPairs;
  totalCounter.innerHTML = totalMoves;
  gamesPlayed.innerHTML = gamePlayedCounter;
  gamesWin.innerHTML = gamesWinCounter;
}

// FIND UNIQUE NAME AND LINK TO CARD NAME
function findIndexOfUniqueName(i) {
  let indexOff = "";
  indexOff = uniqueNameAray.findIndex((cardName) => cardName === i);
  return indexOff;
}

// DELETE ALL CONTENT CARDS FOR RELOAD
function deleteCards() {
  let current = gameCards.childElementCount;
  for (current; current - 1 >= 0; current--) gameCards.removeChild(gameCards.lastElementChild);
}

// GAME TIMER
function loseTimer() {
  // IF GAME IS IN FOCUS BUT NOTHING IS CLICKED FOR 15 SEC YOU LOSE THE GAME
  // DISABLE FUNCTION CONTENT ONLY FOR TESTING!
  gameTimer = setInterval(gameLose, 15000);
}

// LOSE GAME EXCEPTION
function gameLose() {
  youLose.classList.add("show");
}
