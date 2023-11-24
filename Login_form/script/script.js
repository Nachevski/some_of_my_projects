`use strict`;
const allInuts = document.querySelectorAll("input");

allInuts.forEach(function (element) {
  element.addEventListener("keyup", (e) => {
    let getErrorClassName = e.target.id.slice(5);
    if (e.target.classList.contains("borderError") && e.target.value != "") {
      e.target.classList.remove("borderError");
      document.querySelector(`.${getErrorClassName}`).classList.add("hide");
    }
  });
});
