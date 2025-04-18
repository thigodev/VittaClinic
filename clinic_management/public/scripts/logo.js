window.addEventListener("scroll", function () {
    const header = document.getElementById("header");
    const logo = document.querySelector(".header-logo"); // Corrigido para selecionar pela classe
  
    if (window.scrollY > 0) {
        header.classList.add("scrolled");
        logo.src = "/clinic_management/public/img/vitta-white.svg"; // Caminho para a logo branca
    } else {
        header.classList.remove("scrolled");
        logo.src = "/clinic_management/public/img/vitta-logo-header.svg"; // Caminho para a logo padrão
    }
});