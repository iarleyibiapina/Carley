const linkInterno = document.querySelector(
  '[data-scroll="suave"] a[href^="#"]'
);

function scrollTop() {
  e.preventDefault();
  const href = e.currentTarget.getAttribute("href");
  const topo = document.querySelector(href);
  topo.scrollIntoView({
    behavior: "smooth",
    block: "start",
  });
}

linkInterno.addEventListener("click", scrollTop);
