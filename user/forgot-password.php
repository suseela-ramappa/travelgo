<?php
session_start();
include('../includes/db.php');

if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['email'])) {
    $email = trim($_POST['email']);
    $_SESSION['reset_email'] = $email;

    // Check if email exists
    $stmt = $conn->prepare("SELECT id FROM users WHERE email=?");
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $stmt->store_result();

    if ($stmt->num_rows == 1) {
        // Generate OTP
        $otp = rand(100000, 999999);
        $_SESSION['otp'] = $otp;

        // Normally send OTP to email. For demo, echo it.
        // In production: mail($email, "Your OTP", "Your OTP is: $otp");
              echo "<script>
            alert('Your OTP is: $otp');
            window.location.href = 'verify-otp.php';
        </script>";
        exit();
 // For testing

        header("Location: verify-otp.php");
        exit();
    } else {
        $error = "Email not found.";
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Forgot Password</title>
    <link rel="stylesheet" href="../assets/css/forgot-password.css">
</head>
<body>
<div class="form-container">
    <h2>Forgot Password</h2>
    <?php if (isset($error)) echo "<p class='error'>$error</p>"; ?>
    <form method="POST">
        <label>Email Address:</label>
        <input type="email" name="email" required placeholder="Enter your registered email">
        <button type="submit">Send OTP</button>
    </form>
</div>
</body>
</html>
