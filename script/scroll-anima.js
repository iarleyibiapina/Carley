
const scrolAnima = document.querySelector('[data-anima="scroll"]');

const metadeWindow = window.innerHeight * 3.3;

function animarScrol() {
  const topoItem = scrolAnima.getBoundingClientRect().top;
  const itemVisivel = topoItem - metadeWindow < 0;
  if (itemVisivel) {
    scrolAnima.classList.add("show-button");
  } else {
    scrolAnima.classList.remove("show-button");
  }
}
window.addEventListener("scroll", animarScrol);
