console.log("APP JS LOADED");


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

    // Theme toggle
    const themeToggle = document.querySelector(".theme-toggle");
    const root = document.documentElement;

    // Load saved theme
    const savedTheme = localStorage.getItem("theme");
    if (savedTheme) {
        root.setAttribute("data-theme", savedTheme);
        updateThemeIcon(savedTheme);
    }

    // Toggle theme
    themeToggle?.addEventListener("click", () => {
        const current = root.getAttribute("data-theme") === "dark" ? "light" : "dark";
        root.setAttribute("data-theme", current);
        localStorage.setItem("theme", current);
        updateThemeIcon(current);
    });

    // Update icon
    function updateThemeIcon(theme) {
        const icon = themeToggle.querySelector("i");
        if (theme === "dark") {
            icon.classList.remove("bi-moon-fill");
            icon.classList.add("bi-sun-fill");
        } else {
            icon.classList.remove("bi-sun-fill");
            icon.classList.add("bi-moon-fill");
        }
    }

});