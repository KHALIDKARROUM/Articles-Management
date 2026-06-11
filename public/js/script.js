document.addEventListener("DOMContentLoaded", () => {
    const toggle = document.querySelector(".nav-toggle");
    const nav = document.querySelector("#primary-nav");
    const themeToggle = document.querySelector("[data-theme-toggle]");
    const themeLabel = document.querySelector("[data-theme-toggle-label]");

    const setTheme = (theme) => {
        document.documentElement.dataset.theme = theme;
        localStorage.setItem("theme", theme);

        if (themeToggle) {
            themeToggle.setAttribute("aria-pressed", String(theme === "dark"));
        }

        if (themeLabel) {
            themeLabel.textContent = theme === "dark" ? "Light" : "Dark";
        }
    };

    setTheme(document.documentElement.dataset.theme || "light");

    if (toggle && nav) {
        toggle.addEventListener("click", () => {
            const isOpen = nav.classList.toggle("is-open");
            toggle.setAttribute("aria-expanded", String(isOpen));
        });
    }

    if (themeToggle) {
        themeToggle.addEventListener("click", () => {
            const nextTheme = document.documentElement.dataset.theme === "dark" ? "light" : "dark";
            setTheme(nextTheme);
        });
    }

    document.querySelectorAll("[data-confirm]").forEach((element) => {
        element.addEventListener("click", (event) => {
            const message = element.getAttribute("data-confirm");

            if (message && !window.confirm(message)) {
                event.preventDefault();
            }
        });
    });
});
