<?php
session_start();
include('../includes/db.php');

// Check if user is logged in
if (!isset($_SESSION['user_id'])) {
    header('Location: ../user/login.php');
    exit();
}

$user_id = $_SESSION['user_id'];

include('../includes/header.php');

// Fetch user-specific bookings
$sql = "SELECT b.id, b.booking_date, t.title AS tour_name, t.price 
        FROM bookings b 
        JOIN tours t ON b.tour_id = t.id 
        WHERE b.user_id = ? 
        ORDER BY b.booking_date DESC";

$stmt = $conn->prepare($sql);

// ✅ Check for SQL errors
if (!$stmt) {
    die("SQL Prepare Failed: " . $conn->error);
}

$stmt->bind_param("i", $user_id);
$stmt->execute();
$result = $stmt->get_result();
?>

<div class="bookings-container">
    <h2>My Bookings</h2>

    <?php if ($result->num_rows > 0): ?>
        <table class="bookings-table">
            <thead>
                <tr>
                    <th>Tour Name</th>
                    <th>Booking Date</th>
                    <th>Price</th>
                </tr>
            </thead>
            <tbody>
                <?php while ($row = $result->fetch_assoc()): ?>
                    <tr>
                        <td><?php echo htmlspecialchars($row['tour_name']); ?></td>
                        <td><?php echo date("d M Y, H:i", strtotime($row['booking_date'])); ?></td>
                        <td>₹<?php echo number_format($row['price'], 2); ?></td>
                    </tr>
                <?php endwhile; ?>
            </tbody>
        </table>
    <?php else: ?>
        <p>You have not booked any tours yet.</p>
    <?php endif; ?>
</div>

<?php include('../includes/footer.php'); ?>


<!-- Add CSS for the layout and animations -->

<style>
/* My Bookings Section */
.bookings-container {
    max-width: 1000px;
    margin: 50px auto;
    padding: 40px;
    background: rgba(255, 255, 255, 0.95);
    border-radius: 16px;
    box-shadow: 0 8px 20px rgba(0, 0, 0, 0.15);
    position: relative;
    z-index: 2;
    animation: slideUp 0.8s ease-in-out;
}

.bookings-container h2 {
    text-align: center;
    margin-bottom: 30px;
    font-size: 2.2rem;
    color: #333;
}

/* Table Styling */
.bookings-table {
    width: 100%;
    border-collapse: collapse;
    background-color: #fff;
    border-radius: 12px;
    overflow: hidden;
    box-shadow: 0 4px 12px rgba(0,0,0,0.1);
}

.bookings-table th,
.bookings-table td {
    padding: 16px 20px;
    text-align: left;
}

.bookings-table th {
    background-color:rgb(234, 159, 55);
    color: #fff;
    font-weight: 600;
    font-size: 1rem;
}

.bookings-table td {
    border-bottom: 1px solid #eee;
    font-size: 0.95rem;
    color: #444;
}

/* Background Styling */
body {
    background: url('../assets/images/user.jpg') no-repeat center center/cover;
    min-height: 100vh;
    padding: 0;
    margin: 0;
    font-family: 'Segoe UI', sans-serif;
}

/* Empty Message */
.bookings-container p {
    text-align: center;
    font-size: 1.1rem;
    color: #444;
    margin-top: 20px;
}

/* Animations */
@keyframes slideUp {
    0% { opacity: 0; transform: translateY(40px); }
    100% { opacity: 1; transform: translateY(0); }
}

/* Responsive */
@media (max-width: 768px) {
    .bookings-container {
        margin: 30px 10px;
        padding: 25px 15px;
    }

    .bookings-table th,
    .bookings-table td {
        padding: 12px 10px;
        font-size: 0.9rem;
    }

    .bookings-container h2 {
        font-size: 1.8rem;
    }
}

</style>

