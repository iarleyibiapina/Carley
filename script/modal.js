var modal = document.getElementById("open_modal");
var announcement = document.getElementById("announcement_modal");
var main = document.querySelector("section");

function see_profile() {
  modal.classList.toggle("open");
  if (modal.getAttribute("class") === "modal open") {
    return abrirModal();
  } else {
    return fecharModal();
  }
}
function abrirModal() {
  modal.style.translate = "calc(0%) ";
  modal.style.transition = "2s ease";
}
function fecharModal() {
  modal.style.translate = "calc(-110%) ";
  modal.style.transition = "2s ease";
}

main.addEventListener("click", (event) => {
  if (!event.target.matches("open_modal")) {
    fecharModal();
  }
});


