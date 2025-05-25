<?php
// logout.php - Admin logout page

// Start the session
session_start();

// Destroy the session to log out the admin
session_unset();
session_destroy();

// Redirect to the login page
header('Location: login.php');
exit();
?>
