`use strict`
const nextStep = document.querySelector(".btn-next-step");
const prevStep = document.querySelector(".btn-prev-step");
const submit = document.querySelector(".btn-submit");
const stepsCounter = document.querySelector(".steps-counter");
const allSteps = document.querySelectorAll(".steps");
const errorInputs = document.querySelectorAll('.validateError');
const statusBar = document.querySelector('.statusBar');

let screenSize = window.innerWidth;
let step = 0;
let statusCompleted = 0;

if (screenSize < 1023) {
    document.querySelector('.screenNotSupported').classList.add('active')
}

nextStep.addEventListener("click", (e) => {
    if (step == allSteps.length - 2) {
        nextStep.classList.add("disabled");
        submit.classList.remove("disabled");
    }
    prevStep.classList.remove("disabled");
    allSteps[step].classList.remove("active");
    allSteps[step].classList.add("prev");
    allSteps[++step].classList.add("active");
    stepsCounter.innerHTML = `Step ${step + 1} / ${allSteps.length}`;

    if ((step * 33.33) > statusCompleted) {
        statusBar.style.width = `${statusCompleted += 33.33}%`
    }
});

prevStep.addEventListener("click", (e) => {
    if (step < allSteps.length) {
        submit.classList.add("disabled");
        nextStep.classList.remove("disabled");
    }
    if (step == 1) {
        prevStep.classList.add("disabled");
    }
    allSteps[step].classList.remove("active");
    allSteps[--step].classList.remove("prev");
    allSteps[step].classList.add("active");
    stepsCounter.innerHTML = `Step ${step + 1} / ${allSteps.length}`;
});

errorInputs.forEach(function (element) {
    element.addEventListener("keyup", (e) => {
        if (e.target.value != '') {
            e.target.classList.remove('validateError')
            e.target.placeholder = '';
        } else {
            e.target.classList.add('validateError')
        }
    })
})