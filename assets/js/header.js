
    document.addEventListener("DOMContentLoaded", function () {
        const toggleBtn = document.getElementById("navbar-toggle");
        const navLinks = document.querySelector(".navbar-links");

        toggleBtn.addEventListener("click", () => {
            navLinks.classList.toggle("open");
        });
    });

