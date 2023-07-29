function search() {
  var input = document.getElementById("pesquisa").value;
  input = input.toLowerCase();
  let card_title = document.getElementsByClassName("card-title");
  let card = document.getElementsByClassName("card-item");
  for (let i = 0; i < card.length; i++) {
    if (!card_title[i].innerHTML.toLowerCase().includes(input)) {
      card[i].style.display = "none";
    } else {
      card[i].style.display = "flex";
    }
  }
}

function clearSearch() {
  this.input.value.innerHTML = "";
}
