<?php
// dashboard.php - Admin Dashboard

// Start session and check if the admin is logged in

//if (!isset($_SESSION['admin_id'])) {
  //  header('Location: login.php');
    //exit();
//}
//
// Include database connection
include('../includes/db.php');

// Fetch basic stats from the database
$sql_tours = "SELECT COUNT(*) as total_tours FROM tours";
$sql_bookings = "SELECT COUNT(*) as total_bookings FROM bookings";
$sql_users = "SELECT COUNT(*) as total_users FROM users";

$tours = $conn->query($sql_tours)->fetch_assoc();
$bookings = $conn->query($sql_bookings)->fetch_assoc();
$users = $conn->query($sql_users)->fetch_assoc();

include('../includes/header.php');
?>

<link rel="stylesheet" href="../assets/css/dashboard.css">
<div class="dashboard-container">
    <h2>Admin Dashboard</h2>

    <div class="stats">
        <div class="stat">
            <h3>Total Tours</h3>
            <p><?php echo $tours['total_tours']; ?></p>
        </div>
        <div class="stat">
            <h3>Total Bookings</h3>
            <p><?php echo $bookings['total_bookings']; ?></p>
        </div>
        <div class="stat">
            <h3>Total Users</h3>
            <p><?php echo $users['total_users']; ?></p>
        </div>
    </div>

    <div class="admin-actions">
        <a href="manage_tours.php" class="btn">Manage Tours</a>
        <a href="manage_users.php" class="btn">Manage Users</a>
        <a href="manage_bookings.php" class="btn">Manage Bookings</a>
    </div>
</div>

<?php include('../includes/footer.php'); ?>
