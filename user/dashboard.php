<?php
// User dashboard page

session_start();
include('../includes/db.php');
include('../includes/auth.php');

checkUserLogin();
$username = $_SESSION['username']; // assuming user_id stores username
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>User Dashboard</title>
  <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600&display=swap" rel="stylesheet">
  <style>
    body {
      margin: 0;
      padding: 0;
      font-family: 'Poppins', sans-serif;
  background: linear-gradient(rgba(0, 0, 0, 0.7), rgba(0, 0, 0, 0.7)), 
              url('../assets/images/user.jpg') no-repeat center center/cover;
      height: 100vh;
      display: flex;
      align-items: center;
      justify-content: center;
    }

    .dashboard {
      background: rgba(255, 255, 255, 0.1);
      border-radius: 16px;
      padding: 40px;
      backdrop-filter: blur(12px);
      box-shadow: 0 8px 32px rgba(0, 0, 0, 0.2);
      width: 90%;
      max-width: 600px;
      text-align: center;
      animation: fadeIn 1s ease-in-out;
    }

    h1 {
      color: #fff;
      margin-bottom: 20px;
      animation: slideIn 1s ease-in-out;
    }

    .btn-container {
      display: flex;
      flex-wrap: wrap;
      gap: 15px;
      justify-content: center;
      margin-top: 20px;
    }

    .btn {
      background: rgba(255, 255, 255, 0.2);
      padding: 12px 25px;
      border: none;
      border-radius: 30px;
      color: white;
      font-weight: bold;
      text-decoration: none;
      transition: all 0.3s ease;
      cursor: pointer;
      backdrop-filter: blur(6px);
    }

    .btn:hover {
      background: rgba(255, 255, 255, 0.4);
      transform: scale(1.05);
      box-shadow: 0 0 10px rgba(255, 255, 255, 0.3);
    }

    @keyframes fadeIn {
      from { opacity: 0; transform: scale(0.95); }
      to { opacity: 1; transform: scale(1); }
    }

    @keyframes slideIn {
      from { transform: translateY(-20px); opacity: 0; }
      to { transform: translateY(0); opacity: 1; }
    }
  </style>
</head>
<body>

  <div class="dashboard">
    <h1>Welcome, <?php echo ($username); ?> 👋</h1>
    <p style="color: white;">Here's your dashboard for managing your tour bookings and profile.</p>

    <div class="btn-container">
        <a href="../tours/list.php" class="btn">Book a trip</a>
      <a href="bookings.php" class="btn"> View Bookings</a>
      <a href="../tours/list.php" class="btn"> My Tours</a>
      <a href="logout.php" class="btn"> Logout</a>
    </div>
  </div>

</body>
</html>
