import { Modal } from './modal.js';
import { TabNav } from './tabnav.js';

document.addEventListener("DOMContentLoaded", () => {
  const containerModal = document.getElementById("modal");
  const openModalBtn = document.querySelectorAll(".open-modal-btn");

  const modal = new Modal(containerModal, openModalBtn);
  modal.init();

  const tabnav = new TabNav(".tables-change-btns button", ".tab");
});
