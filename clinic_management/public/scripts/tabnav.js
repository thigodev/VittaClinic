export class TabNav {
  constructor(btns, tables) {
    this.btns = document.querySelectorAll(btns);
    this.tables = document.querySelectorAll(tables);
    this.init();
  }

  activeTable(index) {
    this.btns.forEach((btn) => {
      btn.classList.remove("active");
    });
    this.btns[index].classList.add("active");
    this.tables.forEach((table) => {
      table.classList.remove("active");
    });
    this.tables[index].classList.add("active");
  }

  init() {
    this.btns.forEach((btn, index) => {
      btn.addEventListener("click", () => {
        this.activeTable(index);
      });
    });
  }
}
