import './bootstrap';

import Alpine from 'alpinejs';

window.Alpine = Alpine;

Alpine.start();

document.addEventListener("DOMContentLoaded", () => {

    // Sidebar collapse (desktop)
    const collapseBtn = document.querySelector(".sidebar-collapse");
    const sidebar = document.querySelector(".sidebar");

    collapseBtn?.addEventListener("click", () => {
        sidebar.classList.toggle("collapsed");
    });

    // Mobile sidebar toggle
    const mobileToggle = document.querySelector(".sidebar-toggle");

    mobileToggle?.addEventListener("click", () => {
        sidebar.classList.toggle("open");
    });

});