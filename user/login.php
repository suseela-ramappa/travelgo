<?php
session_start();
include('../includes/db.php');
$error = '';

// Handle login
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = trim($_POST['username']);
    $password = $_POST['password'];

    // Prepare and execute query to check username and plain text password
    $sql = "SELECT * FROM users WHERE username = ? AND password = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ss", $username, $password);
    $stmt->execute();
    $result = $stmt->get_result();

    // Check if user exists
    if ($result->num_rows === 1) {
        $user = $result->fetch_assoc();
        $_SESSION['user_id'] = $user['id'];
        $_SESSION['username'] = $user['username'];
        header("Location: dashboard.php");
        exit();
    } else {
        $error = "Invalid username or password.";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <title>User Login - TravelGo</title>
  <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600&display=swap" rel="stylesheet">
  <style>
/* Login Page Styles */
:root {
  --primary-color:rgb(55, 170, 68);
  --secondary-color: #e67e22;
  --dark-color: #2c3e50;
  --light-color: #ecf0f1;
  --accent-color: #e74c3c;
  --text-light: #ffffff;
  --text-dark: #333333;
  --shadow: 0 5px 15px rgba(0, 0, 0, 0.1);
  --transition: all 0.3s cubic-bezier(0.25, 0.8, 0.25, 1);
}

body {
  font-family: 'Poppins', sans-serif;
  background: linear-gradient(rgba(0, 0, 0, 0.7), rgba(0, 0, 0, 0.7)), 
              url('../assets/images/user.jpg') no-repeat center center/cover;
  min-height: 100vh;
  margin: 0;
  padding: 0;
  display: flex;
  justify-content: center;
  align-items: center;
  color: var(--text-light);
  animation: fadeIn 1s ease-in-out;
}

@keyframes fadeIn {
  from { opacity: 0; }
  to { opacity: 1; }
}

.login-container {
  background: rgba(255, 255, 255, 0.1);
  backdrop-filter: blur(10px);
  border-radius: 15px;
  padding: 2.5rem;
  width: 90%;
  max-width: 450px;
  box-shadow: 0 15px 35px rgba(0, 0, 0, 0.2);
  border: 1px solid rgba(255, 255, 255, 0.1);
  transform: translateY(20px);
  opacity: 0;
  animation: slideUp 0.8s ease-out 0.3s forwards;
}

@keyframes slideUp {
  to {
    transform: translateY(0);
    opacity: 1;
  }
}

h2 {
  text-align: center;
  margin-bottom: 1.5rem;
  font-size: 2rem;
  color: var(--text-light);
  position: relative;
  padding-bottom: 10px;
}

h2::after {
  content: '';
  position: absolute;
  bottom: 0;
  left: 50%;
  transform: translateX(-50%);
  width: 50px;
  height: 3px;
  background: var(--secondary-color);
  border-radius: 3px;
  animation: lineGrow 0.8s ease-out 0.8s forwards;
  width: 0;
}

@keyframes lineGrow {
  to { width: 50px; }
}

.error {
  background: rgba(231, 76, 60, 0.2);
  color: var(--text-light);
  padding: 1rem;
  border-radius: 5px;
  margin-bottom: 1.5rem;
  border-left: 4px solid var(--accent-color);
  animation: shake 0.5s ease-in-out;
}

@keyframes shake {
  0%, 100% { transform: translateX(0); }
  20%, 60% { transform: translateX(-5px); }
  40%, 80% { transform: translateX(5px); }
}

form {
  display: flex;
  flex-direction: column;
  gap: 1.5rem;
}

input {
  padding: 1rem;
  border: none;
  border-radius: 5px;
  background: rgba(255, 255, 255, 0.1);
  color: var(--text-light);
  font-size: 1rem;
  transition: var(--transition);
  border-left: 3px solid transparent;
}

input::placeholder {
  color: rgba(255, 255, 255, 0.7);
}

input:focus {
  outline: none;
  background: rgba(255, 255, 255, 0.2);
  border-left: 3px solid var(--secondary-color);
  transform: translateY(-2px);
  box-shadow: 0 5px 15px rgba(0, 0, 0, 0.1);
}

button {
  padding: 1rem;
  background: var(--secondary-color);
  color: white;
  border: none;
  border-radius: 5px;
  font-size: 1rem;
  font-weight: 600;
  cursor: pointer;
  transition: var(--transition);
  transform: scale(1);
}

button:hover {
  background: var(--primary-color);
  transform: scale(1.02);
  box-shadow: 0 8px 20px rgba(0, 0, 0, 0.2);
}

.links {
  display: flex;
  justify-content: space-between;
  margin-top: 1.5rem;
  animation: fadeIn 1s ease-in-out 1s forwards;
  opacity: 0;
}

.links a {
  color: var(--text-light);
  text-decoration: none;
  font-size: 0.9rem;
  position: relative;
  transition: var(--transition);
  opacity: 0.8;
}

.links a::after {
  content: '';
  position: absolute;
  bottom: -2px;
  left: 0;
  width: 0;
  height: 1px;
  background: var(--text-light);
  transition: var(--transition);
}

.links a:hover {
  opacity: 1;
}

.links a:hover::after {
  width: 100%;
}

/* Responsive Design */
@media (max-width: 768px) {
  .login-container {
    padding: 2rem 1.5rem;
    width: 95%;
  }
  
  h2 {
    font-size: 1.8rem;
  }
  
  input, button {
    padding: 0.8rem;
  }
}

@media (max-width: 480px) {
  .links {
    flex-direction: column;
    align-items: center;
    gap: 1rem;
  }
  
  h2 {
    font-size: 1.6rem;
  }
}
/*nav abars*/
.close-circle {
    position: absolute;
    top: 20px;
    right: 20px;
    width: 35px;
    height: 35px;
    background:rgb(171, 171, 171);
    color: white;
    font-size: 22px;
    text-align: center;
    line-height: 35px;
    border-radius: 50%;
    cursor: pointer;
    text-decoration: none;
    transition: background 0.3s, transform 0.2s;
    z-index: 999;
}

.close-circle:hover {
    background:rgb(221, 74, 33);
    transform: rotate(90deg);
}


  </style>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
</head>
<body>
  <!-- Add this in your <head> -->

  <div class="login-container">
    <a href="javascript:history.back()" class="close-circle">&times;</a>


    <h2>User Login</h2>

    <?php if ($error): ?>
      <div class="error"><?= $error ?></div>
    <?php endif; ?>

    <form method="POST" action="">
      <input type="text" name="username" placeholder="Username" required />
      <input type="password" name="password" placeholder="Password" required />
      <button type="submit">Login</button>
    </form>

    <div class="links">
      <a href="register.php">Register</a>
      <a href="forgot-password.php">Forgot Password?</a>
    </div>
  </div>
</body>
</html>

