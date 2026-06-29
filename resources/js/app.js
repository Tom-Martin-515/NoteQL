console.log("APP JS LOADED");

import '../css/ui.css';

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

// ===============================
// Dark Mode Toggle (UI-V2)
// ===============================

document.addEventListener('DOMContentLoaded', () => {

    // Always apply saved preference, even if toggle isn't present
    const saved = localStorage.getItem('noteql-dark-mode');
    if (saved === 'on') {
        document.documentElement.classList.add('dark-mode');
    }

    // Only handle toggle logic if the toggle exists on this page
    const toggle = document.getElementById('darkModeToggle');
    if (!toggle) return;

    // Set toggle state based on saved preference
    if (saved === 'on') {
        toggle.checked = true;
    }

    // Toggle handler
    toggle.addEventListener('change', () => {
        if (toggle.checked) {
            document.documentElement.classList.add('dark-mode');
            localStorage.setItem('noteql-dark-mode', 'on');
        } else {
            document.documentElement.classList.remove('dark-mode');
            localStorage.setItem('noteql-dark-mode', 'off');
        }
    });

});

