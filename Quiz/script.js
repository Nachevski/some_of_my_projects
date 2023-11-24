const loader = document.getElementById('loader')
const quizContent = document.getElementById('quizContent')
const quizQuestionsContainer = document.getElementById("quizQuestionsContainer")
const questionCard = document.getElementById("questionCard")
const currentQuestion = document.getElementById('currentQuestion')
const currentQuestionAnswers = document.getElementById('currentQuestionAnswers')
const currentQuestionCategory = document.getElementById('currentQuestionCategory')
const quizContentBTN = document.querySelector("#quizContent button")
const quizContentH1 = document.querySelector("#quizContent h1")
const quizContentP = document.querySelector("#quizContent p")
const statusBarContainer = document.getElementById("statusBarContainer")
const statusBarCurrent = document.querySelector(".statusBarCurrent")
const statusBarText = document.getElementById("statusBarText")
let generatedQuestions;
let questionCounter = 1
let correctAnswers = 0;
let transitionTimeMS = 250;
const numberOfQuestionsToLoad = 20 //API MAX = 50
const questionBarSteps = 100 / numberOfQuestionsToLoad;
const transitions = [
    "animate__jackInTheBox",
    "animate__fadeInDown", "animate__fadeInUp",
    "animate__zoomInDown", "animate__zoomInUp", "animate__zoomIn"]
let currentTransition = transitions[Math.floor(Math.random() * transitions.length)]

window.addEventListener("load", initializingApp)
window.addEventListener("hashchange", hashChange)

function initializingApp() {
    if (location.hash != '') location.href = "index.html"
    localStorage.clear()
    fetchQuestions()
}

function hashChange() {
    let currentHash = `#question-${questionCounter}`
    let hashQuestionCounter = location.hash.split("-")[1]
    if (location.hash == "#results") {
        showResults()
        return
    }
    if (hashQuestionCounter < questionCounter || typeof hashQuestionCounter === 'undefined') {
        location.hash = currentHash;
        alert("NOT ALLOWED TO GO BACK!")
    } else if (hashQuestionCounter > questionCounter) {
        location.hash = currentHash;
        alert("NOT ALLOWED TO MANUALLY CHANGE QUESTIONS!")
    } else {
        loadQuestion(hashQuestionCounter - 1)
    }
}

async function fetchQuestions() {
    const fetchQuestions = await fetch(`https://opentdb.com/api.php?amount=${numberOfQuestionsToLoad}`);
    const questions = await fetchQuestions.json()
    generatedQuestions = questions.results
    if (generatedQuestions.length > 0) {
        fetchingComplete()
    }
}

function fetchingComplete() {
    loader.classList.add('hide')
    quizContent.classList.remove('hide')
    statusBarContainer.classList.add("hide")
    quizContentH1.innerHTML = "Welcome to Brainster Trivia"
    quizContentP.innerHTML = "Click on start button to begin"
    quizContentBTN.classList.add("btn-success")
    quizContentBTN.innerHTML = "Start Quiz"
    quizContent.classList.add('animate__animated', "animate__fadeInUp")
    quizContentBTN.addEventListener('click', () => startQuiz())
}

function startQuiz() {
    quizContent.classList.remove('animate__fadeInUp')
    quizContent.classList.add('animate__fadeInDown')
    quizContentH1.innerHTML = "Good Luck!"
    quizContentP.innerHTML = "Click on the button to start over.."
    quizContentBTN.classList.add("btn-warning")
    quizContentBTN.innerHTML = "Start Over"
    quizContentBTN.addEventListener("click", () => location.href = "index.html")
    quizQuestionsContainer.classList.remove("hide")
    statusBarContainer.classList.remove("hide")
    location.hash = `#question-${questionCounter}`
    localStorage.setItem("correctAnswers", 0)
}

function loadQuestion(questionNumber) {
    if (questionCounter <= numberOfQuestionsToLoad) {
        const possibleAnswers = [
            ...generatedQuestions[questionNumber].incorrect_answers.map((e) => decodeToHtml(e)),
            decodeToHtml(generatedQuestions[questionNumber].correct_answer)
        ].sort(() => Math.random() - 0.5);
        setTimeout(() => {
            currentQuestionAnswers.innerHTML = ''
            currentQuestion.innerText = decodeToHtml(generatedQuestions[questionCounter - 1].question);
            currentQuestionCategory.innerText = `Category: ${generatedQuestions[questionCounter - 1].category}`
            statusBarText.innerText = `Completed: ${questionCounter - 1} / ${generatedQuestions.length}`
            possibleAnswers.forEach(choice => {
                let possibleAnswer = document.createElement('button')
                possibleAnswer.className = 'btn btn-primary m-2';
                possibleAnswer.innerText = choice
                possibleAnswer.addEventListener("click", (e) => checkAnswer(questionNumber, e.target.innerText))
                currentQuestionAnswers.appendChild(possibleAnswer)
            })
        }, transitionTimeMS + 5)
    } else {
        location.hash = '#results'
    }
    applyTransitions();
}

function checkAnswer(questionNumber, chosenAnswer) {
    if (generatedQuestions[questionNumber].correct_answer == chosenAnswer) {
        correctAnswers++
        localStorage.setItem("correctAnswers", correctAnswers)
    }
    statusBarCurrent.style.width = questionCounter * questionBarSteps + "%"
    location.hash = `#question-${++questionCounter}`
}

function showResults() {
    quizContent.classList.remove('animate__fadeInDown')
    quizContent.classList.add('animate__fadeInUp')
    quizQuestionsContainer.classList.add("hide")
    quizContentH1.innerHTML = "Let see you score!"
    quizContentP.innerHTML = "Click on the button to start again"
    document.querySelector(".statusBarBase").style.backgroundColor = "red"
    quizContentBTN.classList.add("btn-danger")
    quizContentBTN.innerHTML = "Try Again"
    let correctAnswersByLS = localStorage.getItem("correctAnswers")
    statusBarText.innerText = `Total Correct Answers: ${correctAnswersByLS} / ${generatedQuestions.length}`
    setTimeout(() => {
        statusBarCurrent.style.width = (correctAnswersByLS / generatedQuestions.length) * 100 + "%";
    }, transitionTimeMS + 250)
}

function applyTransitions() {
    let nextTransition = transitions[Math.floor(Math.random() * transitions.length)]
    if (questionCounter != 1) {
        questionCard.classList.remove(currentTransition)
        questionCard.classList.add("animate__fadeOutDown")
    }
    setTimeout(() => {
        if (questionCounter == 1) questionCard.classList.remove("hide")
        questionCard.classList.remove("animate__fadeOutDown")
        questionCard.classList.add(nextTransition)
    }, transitionTimeMS)
    currentTransition = nextTransition
}

function decodeToHtml(html) {
    let txt = document.createElement("textarea");
    txt.innerHTML = html;
    return txt.value;
}