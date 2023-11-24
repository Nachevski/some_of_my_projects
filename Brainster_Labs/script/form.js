`use strict`;
// DOM VARIBLES
const inputs = document.querySelectorAll("input");
const submit = document.getElementById("submit");
const typeStudent = document.getElementById("academy-type");
const customSelect = document.querySelector(".custom-select");
const errorMsg = document.querySelector(".error-message");

// REGEX PATTERNS
const regexPatterns = {
  fullname: /^([a-zA-Z\s]+$)/,
  companyName: /^([a-zA-Z0-9\s]+)/,
  phone: /^[+]?[0-9]+$/,
  email: /^[a-zA-Z0-9._%+-]+@[a-zA-Z0-9-]+\.[a-zA-Z0-9-]{2,5}/,
};

// EVENT LISTENER FOR IN REAL TIME CHECK IF INPUT VALUE PASS REGEX VALIDATION
// AND CHANGE STYLE TO RED OR GREEN
inputs.forEach((input) => {
  input.addEventListener("keyup", (e) => {
    if (checkValidation(e.target) == false) {
      e.target.parentElement.classList.add("activeMsg");
      postValidationStyles(e.target, false);
    } else {
      e.target.parentElement.classList.remove("activeMsg");
      postValidationStyles(e.target, true);
    }
    if (input.value == "") {
      e.target.parentElement.classList.remove("active");
      e.target.parentElement.querySelector("input").style.boxShadow = "";
    }
  });
});

// CHECKS IF EVERY INPUT AND CUSTOM SELECT PASED VALIDATION BEFORE SUBMITING FORM TO DATABASE
submit.addEventListener("click", (e) => {
  inputs.forEach((input) => {
    if (checkValidation(input) === false) {
      e.preventDefault();
    }
  });
  if (checkCustomBox() == false) {
    e.preventDefault();
  }
});

// CALLING VALIDATE FUNCTION WHEN YOU CHOOSE ITEM FROM DROPDOWN SELECT MENU
customSelect.addEventListener("click", () => {
  checkCustomBox();
});

//FUNCTION WHO GETS 2 ARGUMENTS AND TESTING IT FOR INPUT VALIDATION AND
// RETURN TRUE IF PASSED THE TEST AND FALSE IF NOT
function checkValidation(inputValue) {
  if (inputValue.value.match(regexPatterns[inputValue.name])) {
    return true;
  } else {
    // IF VALIDATION FAILS CALING POSTVALIDATION FUNCTION TO APPLY STYLES TO INPUT (RED)
    postValidationStyles(inputValue, false);
    inputValue.parentElement.classList.add("activeMsg");
    return false;
  }
}
// FUNCTION WHO CHECKS IF CHECKBOX HAS NOT CHOSEN ANY OPTION
// AND APPLYING STYLES IF NOT
// RETURNING TRUE OR FALSE NEEDED WHEN SUBMIT BUTTON IS PRESSED
function checkCustomBox() {
  if (typeStudent.value == "") {
    customSelect.style.boxShadow = "0px 0px 8px 4px red";
    typeStudent.parentElement.parentElement.classList.add("active", "activeMsg");
    return false;
  } else {
    customSelect.style.boxShadow = "0px 0px 8px 4px green";
    typeStudent.parentElement.parentElement.classList.remove("active", "activeMsg");
    return true;
  }
}

// APPLYING STYLES TO INPUT OBJECTS DEPENDING IF THEY ARE VALIDATED OR NOT
function postValidationStyles(targetElement, isValidated) {
  targetElement.parentElement.classList.add("active");
  if (isValidated) {
    targetElement.parentElement.querySelector("input").style.boxShadow = "0px 0px 8px 4px green";
    targetElement.parentElement.querySelector(".show-icon").classList.remove("fa-circle-xmark");
    targetElement.parentElement.querySelector(".show-icon").classList.add("fa-circle-check");
    targetElement.parentElement.querySelector(".show-icon").style.color = "green";
  } else {
    targetElement.parentElement.querySelector("input").style.boxShadow = "0px 0px 8px 4px red";
    targetElement.parentElement.querySelector(".show-icon").classList.add("fa-circle-xmark");
    targetElement.parentElement.querySelector(".show-icon").classList.remove("fa-circle-check");
    targetElement.parentElement.querySelector(".show-icon").style.color = "red";
  }
}
