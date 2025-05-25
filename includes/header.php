
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Your Website</title>

  <!-- Google Fonts -->
  <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600&display=swap" rel="stylesheet">

  <style>
/* Reset and Base Styles */
:root {
  --primary-color: #3498db;
  --secondary-color: #e67e22;
  --dark-color: #2c3e50;
  --light-color: #ecf0f1;
  --accent-color: #e74c3c;
  --text-light: #ffffff;
  --text-dark: #333333;
  --shadow: 0 5px 15px rgba(0, 0, 0, 0.1);
  --transition: all 0.3s cubic-bezier(0.25, 0.8, 0.25, 1);
}

* {
  margin: 0;
  padding: 0;
  box-sizing: border-box;
}

body {
  font-family: 'Poppins', sans-serif;
  line-height: 1.6;
  color: var(--text-dark);
}

/* Header Styles */
header {
  background: linear-gradient(135deg, var(--dark-color), var(--secondary-color));
  padding: 1rem 0;
  position: sticky;
  top: 0;
  z-index: 1000;
  box-shadow: var(--shadow);
  transition: all 0.5s ease;
}

.header-container {
  max-width: 1200px;
  margin: 0 auto;
  padding: 0 2rem;
  display: flex;
  justify-content: space-between;
  align-items: center;
}

.logo {
  font-size: 2rem;
  font-weight: 700;
  color: var(--text-light);
  text-transform: uppercase;
  letter-spacing: 2px;
  user-select: none;
  transition: var(--transition);
  position: relative;
  padding: 0.5rem 0;
}

.logo::after {
  content: '';
  position: absolute;
  bottom: 0;
  left: 0;
  width: 0;
  height: 3px;
  background-color: var(--text-light);
  transition: var(--transition);
}

.logo:hover::after {
  width: 100%;
}

/* Navigation Styles */
nav ul {
  list-style: none;
  display: flex;
  gap: 2rem;
}

nav ul li {
  position: relative;
}

nav ul li a {
  text-decoration: none;
  color: var(--text-light);
  font-weight: 600;
  font-size: 1.1rem;
  padding:  1 rem 0;
  position: relative;
  transition: var(--transition);
  display: inline-block;
}

/* Hover Effect 1: Underline with gradient */
/* Hover Effect: Gradient text fill with sliding underline */
nav ul li a {
  position: relative;
  overflow: hidden;
  background-clip: text;
  -webkit-background-clip: text;
  color: white;
  background-image: linear-gradient(90deg, var(--text-light), var(--text-light));
  background-size: 0% 100%;
  background-repeat: no-repeat;
  background-position: left center;
  transition: all 0.6s cubic-bezier(0.77, 0, 0.175, 1);
}

nav ul li a::before {
  content: '';
  position: absolute;
  bottom: 0;
  left: 0;
  width: 100%;
  height: 2px;
  background: linear-gradient(90deg, var(--accent-color), var(--secondary-color));
  transform: scaleX(0);
  transform-origin: right;
  transition: transform 0.6s cubic-bezier(0.77, 0, 0.175, 1);
}

nav ul li a:hover {
  background-size: 100% 100%;
  background-image: linear-gradient(90deg, var(--text-light), var(--accent-color));
}

nav ul li a:hover::before {
  transform: scaleX(1);
  transform-origin: left;
}

/* Fallback for browsers that don't support background-clip:text */
@supports not (background-clip: text) {
  nav ul li a {
    color: var(--text-light);
    background-image: none;
  }
  
  nav ul li a::after {
    content: '';
    position: absolute;
    bottom: 0;
    left: 0;
    width: 0;
    height: 100%;
    background: linear-gradient(90deg, rgba(255,255,255,0.1), rgba(255,255,255,0.3));
    z-index: -1;
    transition: width 0.6s ease;
  }
  
  nav ul li a:hover::after {
    width: 100%;
  }
}
/* Hover Effect 2: Background highlight
nav ul li a::after {
  content: '';
  position: absolute;
  top: 50%;
  left: 50%;
  width: 0;
  height: 0;
  background: rgba(255, 255, 255, 0.1);
  border-radius: 50%;
  transform: translate(-50%, -50%);
  transition: var(--transition);
  z-index: -1;
} */

nav ul li a:hover::after {
  width: 40px;
  height: 40px;
}

/* Hover Effect 3: 3D lift */
nav ul li a:hover {
  transform: translateY(-3px);
  text-shadow: 0 5px 15px rgba(0, 0, 0, 0.2);
}

/* Menu Toggle Styles */
.menu-toggle {
  display: none;
  cursor: pointer;
  width: 30px;
  height: 25px;
  position: relative;
  z-index: 1001;
}

.menu-toggle span {
  display: block;
  position: absolute;
  height: 3px;
  width: 100%;
  background: var(--text-light);
  border-radius: 3px;
  opacity: 1;
  left: 0;
  transform: rotate(0deg);
  transition: var(--transition);
}

.menu-toggle span:nth-child(1) {
  top: 0;
}

.menu-toggle span:nth-child(2),
.menu-toggle span:nth-child(3) {
  top: 10px;
}

.menu-toggle span:nth-child(4) {
  top: 20px;
}

.menu-toggle.open span:nth-child(1),
.menu-toggle.open span:nth-child(4) {
  top: 10px;
  width: 0%;
  left: 50%;
}

.menu-toggle.open span:nth-child(2) {
  transform: rotate(45deg);
}

.menu-toggle.open span:nth-child(3) {
  transform: rotate(-45deg);
}

/* Responsive Styles */
@media (max-width: 992px) {
  .logo {
    font-size: 1.8rem;
  }
  
  nav ul {
    gap: 1rem;
  }
}

@media (max-width: 768px) {
  .menu-toggle {
    display: block;
  }
  
  nav {
    position: absolute;
    top: 100%;
    left: 0;
    width: 100%;
    background: linear-gradient(135deg, var(--dark-color), var(--secondary-color));
    box-shadow: 0 10px 20px rgba(0, 0, 0, 0.1);
    clip-path: circle(0px at 90% -10%);
    transition: all 0.8s ease-out;
    pointer-events: none;
  }
  
  nav ul {
    flex-direction: column;
    align-items: center;
    padding: 2rem 0;
    gap: 2rem;
  }
  
  nav ul li a {
    font-size: 1.3rem;
    padding: 0.5rem 1rem;
  }
  
  /* Mobile hover effects */
  nav ul li a:hover {
    background: rgba(255, 255, 255, 0.1);
    border-radius: 5px;
    transform: translateX(10px);
  }
  
  nav ul li a::before,
  nav ul li a::after {
    display: none;
  }
}

/* Animation for logo */
@keyframes logoPulse {
  0% { transform: scale(1); }
  50% { transform: scale(1.05); }
  100% { transform: scale(1); }
}

.logo:hover {
  animation: logoPulse 1s ease infinite;
}
  </style>
</head>
<body>

<?php
// Get current file name to highlight the active nav link
$current_page = basename($_SERVER['PHP_SELF']);
?>
<header>
  <div class="header-container">
    <div class="logo">TravelGo</div>
    <nav>
      <ul id="nav-menu">
             
        <li><a href="/travelgo/index.php" class="<?php echo strpos($current_path, 'index.php') !== false ? 'active' : ''; ?>">Home</a></li>

        <li><a href="/travelgo/tours/list.php" class="<?php echo strpos($current_path, 'tours/list.php') !== false ? 'active' : ''; ?>">Tours</a></li>
        <li><a href="/travelgo/contact.php" class="<?php echo strpos($current_path, 'contact.php') !== false ? 'active' : ''; ?>">Contact</a></li>
        <li><a href="/travelgo/user/login.php" class="<?php echo strpos($current_path, 'user/login.php') !== false ? 'active' : ''; ?>">Login</a></li>
        <li><a href="/travelgo/user/register.php" class="<?php echo strpos($current_path, 'user/register.php') !== false ? 'active' : ''; ?>">Register</a></li>
        <li><a href="/travelgo/admin/login.php" class="<?php echo strpos($current_path, 'admin/login.php') !== false ? 'active' : ''; ?>">Admin Login</a></li>
           <li><a href="/travelgo/search.php" class="<?php echo strpos($current_path, 'search.php') !== false ? 'active' : ''; ?>">search</a></li>
      </ul>
    </nav>
    <div class="menu-toggle" onclick="toggleMenu()">
      <span></span>
      <span></span>
      <span></span>
    </div>
  </div>
</header>



      </ul>
    </nav>
    <div class="menu-toggle" onclick="toggleMenu()">
      <span></span>
      <span></span>
      <span></span>
    </div>
  </div>
</header>

<script>
 function toggleMenu() {
  const nav = document.querySelector('nav');
  const menuToggle = document.querySelector('.menu-toggle');
  
  // Toggle classes
  nav.classList.toggle('open');
  menuToggle.classList.toggle('open');
  
  // Prevent scrolling when menu is open
  if (nav.classList.contains('open')) {
    document.body.style.overflow = 'hidden';
  } else {
    document.body.style.overflow = '';
  }
}

// Close menu when clicking on a link
document.querySelectorAll('nav ul li a').forEach(link => {
  link.addEventListener('click', () => {
    if (window.innerWidth <= 768) {
      toggleMenu();
    }
  });
});
</script>
