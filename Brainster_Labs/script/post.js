`use strict`;
// DOM VARIABLE
const postMessage = document.querySelector(".postMessage");

// SET DELAY BEFORE SHOWING MESSAGE FOR SUCCESFUL SUBMITED FORM
setTimeout(function () {
  postMessage.classList.add("show-message");
}, 300);
