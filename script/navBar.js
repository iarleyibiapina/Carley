class MobileNav {
  constructor(menu, navList, navLinks) {
    this.menu = document.querySelector(menu);
    this.navList = document.querySelector(navList);
    this.navLinks = document.querySelectorAll(navLinks);
    this.activeClass = "active";

    this.handleClick = this.handleClick.bind(this);
  }

  animateLinks() {
    this.navLinks.forEach((link, index) => {
      link.style.animation
        ? (link.style.animation = "")
        : (link.style.animation = `navLinkFade 0.5s ease forwards ${
            index / 7 + 0.3
          }s`);
    });
  }

  handleClick() {
    this.navList.classList.toggle(this.activeClass);
    this.navList.style.display = "flex";
    this.menu.classList.toggle(this.activeClass);
    this.animateLinks();
  }

  addClickEvent() {
    this.menu.addEventListener("click", this.handleClick);
  }
  // inicia SE a classe menu esta no documento, if sozinho retorna true ou falso
  init() {
    if (this.menu) {
      this.addClickEvent();
    }
    return this;
  }
}

const mobileNav = new MobileNav(".btn-navbar", ".nav-list", ".nav-list li");

mobileNav.init();
