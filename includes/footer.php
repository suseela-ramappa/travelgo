<?php
// Common footer

echo '
<footer>
    <p>&copy; 2025 TravelGo. All rights reserved.</p>
    
    <div class="footer-links">
        <a href="about.php">About Us</a>
        <a href="privacy.php">Privacy Policy</a>
        <a href="terms.php">Terms & Conditions</a>
    </div>
    
    <div class="footer-contact">
        <p>Contact Us: <a href="mailto:contact@travelgo.com">contact@travelgo.com</a> | Phone: +1 800-123-4567</p>
    </div>
    
    <div class="footer-socials">
        <a href="https://www.facebook.com/TravelGo" target="_blank" title="Facebook"><i class="fa fa-facebook"></i></a>
        <a href="https://twitter.com/TravelGo" target="_blank" title="Twitter"><i class="fa fa-twitter"></i></a>
        <a href="https://www.instagram.com/TravelGo" target="_blank" title="Instagram"><i class="fa fa-instagram"></i></a>
        <a href="https://www.linkedin.com/company/TravelGo" target="_blank" title="LinkedIn"><i class="fa fa-linkedin"></i></a>
    </div>
</footer>
';
?>

<head>
    
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

    <style>
 /* Apply full height layout */
html, body {
    height: 100%;
    margin: 0;
    padding: 0;
    display: flex;
    flex-direction: column;
}

/* Main content area */
main {
    flex: 1;
}

/* Footer styles */
footer {
    background-color:rgb(0, 0, 0);
    color: #fff;
    text-align: center;
    padding: 30px 20px;
    font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
    box-shadow: 0 -2px 10px rgba(0, 0, 0, 0.3);
    margin-top: auto;
}

footer p {
    margin: 10px 0;
    font-size: 16px;
    color: #ddd;
}

.footer-links,
.footer-contact,
.footer-socials {
    margin-top: 15px;
}

.footer-links a,
.footer-contact a,
.footer-socials a {
    color: #00adb5;
    text-decoration: none;
    margin: 0 12px;
    transition: color 0.3s ease;
    font-size: 16px;
}

.footer-links a:hover,
.footer-contact a:hover,
.footer-socials a:hover {
    color: #ffd369;
}

.footer-socials a {
    font-size: 20px;
}

.footer-socials i {
    margin: 0 8px;
    transition: transform 0.3s ease;
}

.footer-socials i:hover {
    transform: scale(1.2);
}

@media (max-width: 600px) {
    .footer-links,
    .footer-contact,
    .footer-socials {
        display: block;
        margin: 10px 0;
    }

    .footer-links a,
    .footer-contact a,
    .footer-socials a {
        display: inline-block;
        margin: 8px;
    }
}

        </style>
</head>