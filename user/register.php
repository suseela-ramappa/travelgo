<?php
// User registration page

session_start();
include('../includes/db.php');

$feedback = "";

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $username = $_POST['username'];
    $password = $_POST['password'];
    $email = $_POST['email'];

    $sql = "INSERT INTO users (username, password, email) VALUES ('$username', '$password', '$email')";
    if ($conn->query($sql)) {
        $feedback = "🎉 Registration successful! <a href='login.php'>Login now</a>";
    } else {
        $feedback = "❌ Error: " . $conn->error;
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <title>User Registration</title>
  <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600&display=swap" rel="stylesheet">

  <style>
body {
  margin: 0;
  padding: 0;
  font-family: 'Arial', sans-serif;
  background-image: url('../assets/images/user.jpg');
  background-size: cover;
  background-position: center;
  background-repeat: no-repeat;
  background-attachment: fixed;
  min-height: 100vh;
  display: flex;
  justify-content: center;
  align-items: center;
}

.register-container {
  background-color: rgba(222, 222, 222, 0.9);
  padding: 2rem;
  border-radius: 10px;
  box-shadow: 0 5px 15px rgba(0, 0, 0, 0.1);
  width: 90%;
  max-width: 400px;
  text-align: center;
}

h2 {
  color: #333;
  margin-bottom: 1.5rem;
}

.feedback {
  padding: 10px;
  margin-bottom: 15px;
  border-radius: 5px;
  background-color: #f8d7da;
  color: #721c24;
  border: 1px solid #f5c6cb;
}

form {
  display: flex;
  flex-direction: column;
  gap: 1rem;
}

input {
  padding: 12px;
  border: 1px solid #ddd;
  border-radius: 5px;
  font-size: 16px;
  transition: border 0.3s;
}

input:focus {
  outline: none;
  border-color: #4a90e2;
}

button {
  padding: 12px;
  background-color:rgb(224, 150, 23);
  color: white;
  border: none;
  border-radius: 5px;
  font-size: 16px;
  cursor: pointer;
  transition: background-color 0.3s;
}

button:hover {
  background-color: #357ab8;
}

.info-text {
  margin-top: 1.5rem;
  color: #555;
}

.info-text a {
  color: #4a90e2;
  text-decoration: none;
  transition: color 0.3s;
}

.info-text a:hover {
  color: #357ab8;
  text-decoration: underline;
}

/* Responsive adjustments */
@media (max-width: 480px) {
  .register-container {
    padding: 1.5rem;
    width: 85%;
  }
  
  input, button {
    padding: 10px;
  }
}
.register-container {
  position: relative; /* Required for absolute positioning of close button */
  background-color: rgba(222, 222, 222, 0.9);
  padding: 2rem;
  border-radius: 10px;
  box-shadow: 0 5px 15px rgba(0, 0, 0, 0.1);
  width: 90%;
  max-width: 400px;
  text-align: center;
}

.close-circle {
  position: absolute; /* Now relative to the form */
  top: 15px;
  right: 15px;
  width: 30px;
  height: 30px;
  background: rgb(171, 171, 171);
  color: white;
  font-size: 20px;
  text-align: center;
  line-height: 30px;
  border-radius: 50%;
  cursor: pointer;
  text-decoration: none;
  transition: background 0.3s ease, transform 0.3s ease;
  z-index: 10;
  animation: slideFadeIn 0.6s ease forwards;
  opacity: 0;
}

@keyframes slideFadeIn {
  0% {
    transform: translateY(-20px) scale(0.8);
    opacity: 0;
  }
  100% {
    transform: translateY(0) scale(1);
    opacity: 1;
  }
}

.close-circle:hover {
  background: rgb(221, 74, 33);
  transform: rotate(90deg) scale(1.1);
}

  </style>
</head>
<body>
  <div class="register-container">
 <a href="javascript:history.back()" class="close-circle">&times;</a>
    <h2>Create a New Account</h2>
  
    <?php if (!empty($feedback)) echo "<div class='feedback'>$feedback</div>"; ?>
  <a href="javascript:history.back()" class="close-circle">&times;</a>
    <form method="POST" action="register.php">
      <input type="text" name="username" placeholder="Choose a Username" required>
      <input type="password" name="password" placeholder="Choose a Password" required>
      <input type="email" name="email" placeholder="Your Email Address" required>
      <button type="submit">Register</button>
    </form>

    <div class="info-text">
      Already have an account? <a href="login.php">Login here</a>
    </div>
  </div>
</body>
</html>
