<?php
// Authentication middleware
//session_start();

function checkUserLogin() {
    if (!isset($_SESSION['user_id'])) {
        header('Location: login.php');
        exit();
    }
}

function checkAdminLogin() {
    if (!isset($_SESSION['admin_id'])) {
        header('Location: admin/login.php');
        exit();
    }
}
?>
