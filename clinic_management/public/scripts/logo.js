window.addEventListener("scroll", function () {
  const header = document.getElementById("header");
  const logo = document.querySelector(".header-logo"); // Corrigido para selecionar pela classe
  const textLogo = document.querySelector(".header-menu");
  const navBtnWhite = this.document.querySelector(".nav-btn");

  if (window.scrollY > 0) {
    header.classList.add("scrolled");
    logo.src = "/clinic_management/public/img/vitta-white.svg"; // Caminho para a logo branca
    textLogo.classList.add("header-menu-text-white");
    navBtnWhite.classList.add("nav-btn-white");
  } else {
    header.classList.remove("scrolled");
    logo.src = "/clinic_management/public/img/vitta-logo-header.svg"; // Caminho para a logo padrão
    textLogo.classList.remove("header-menu-text-white");
    navBtnWhite.classList.remove("nav-btn-white");
  }
});
