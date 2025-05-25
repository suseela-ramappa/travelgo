<?php
session_start();
include('../includes/db.php');

if (!isset($_SESSION['otp']) || !isset($_SESSION['reset_email'])) {
    header("Location: forgot-password.php");
    exit();
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if (isset($_POST['otp'])) {
        if ($_POST['otp'] == $_SESSION['otp']) {
            $_SESSION['verified'] = true;
        } else {
            $error = "Invalid OTP!";
        }
    }

    // Reset password
    if (isset($_POST['new_password']) && $_SESSION['verified']) {
        $new_password = password_hash($_POST['new_password'], PASSWORD_DEFAULT);
        $email = $_SESSION['reset_email'];

        $stmt = $conn->prepare("UPDATE users SET password=? WHERE email=?");
        $stmt->bind_param("ss", $new_password, $email);
        $stmt->execute();

        unset($_SESSION['otp'], $_SESSION['reset_email'], $_SESSION['verified']);

        echo "<script>alert('Password successfully updated!'); window.location='login.php';</script>";
        exit();
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Verify OTP</title>
    <link rel="stylesheet" href="../assets/css/verifyotp.css">
</head>
<body>
<div class="form-container">
    <h2>Verify OTP</h2>
    <?php if (isset($error)) echo "<p class='error'>$error</p>"; ?>

    <?php if (!isset($_SESSION['verified'])): ?>
    <form method="POST">
        <label>Enter OTP:</label>
        <input type="number" name="otp" required>
        <button type="submit">Verify</button>
    </form>
    <?php else: ?>
    <form method="POST">
        <label>New Password:</label>
        <input type="password" name="new_password" required>
        <button type="submit">Reset Password</button>
    </form>
    <?php endif; ?>
</div>
</body>
</html>
