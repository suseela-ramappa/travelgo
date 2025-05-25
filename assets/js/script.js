// Main JS file for interactivity

// Sample JS to handle form submission, date picker, or navbar toggles if needed

// Example: Toggle mobile navbar
const mobileMenu = document.querySelector('.mobile-menu');
const navbar = document.querySelector('nav');

mobileMenu.addEventListener('click', () => {
    navbar.classList.toggle('open');
});

  const toggleBtn = document.querySelector('.menu-toggle');
  const nav = document.querySelector('nav');

  toggleBtn.addEventListener('click', () => {
    nav.classList.toggle('active');
  });

