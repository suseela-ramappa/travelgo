<?php
session_start();

// Check if admin is logged in
if (!isset($_SESSION['admin_id'])) {
    header('Location: login.php');
    exit();
}

include('../includes/db.php');

// Fetch all bookings and handle query errors
$sql = "SELECT bookings.id, users.username AS user_name, tours.title AS tour_name, bookings.booking_date 
        FROM bookings 
        JOIN users ON bookings.user_id = users.id 
        JOIN tours ON bookings.tour_id = tours.id";

$bookings = $conn->query($sql);

// Check if the query executed successfully
if (!$bookings) {
    die("Query failed: " . $conn->error);
}

include('../includes/header.php');
?>

<link rel="stylesheet" href="../assets/css/manage_bookings.css">
 
<div class="manage-bookings-container">
    <h2>Manage Bookings</h2>
          <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
<a href="javascript:history.back()" class="back-next-btn back-btn"><i class="fas fa-arrow-left"></i></a>
    <?php if ($bookings->num_rows > 0): ?>
        <center>
        <table>
            <thead>
                <tr>
                    <th>User</th>
                    <th>Tour</th>
                    <th>Booking Date</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php while ($booking = $bookings->fetch_assoc()): ?>
                    <tr>
                        <td><?php echo htmlspecialchars($booking['user_name']); ?></td>
                        <td><?php echo htmlspecialchars($booking['tour_name']); ?></td>
                        <td><?php echo htmlspecialchars($booking['booking_date']); ?></td>
                        <td>
                            <a href="delete_booking.php?id=<?php echo $booking['id']; ?>" class="btn">Delete</a>
                        </td>
                    </tr>
                <?php endwhile; ?>
            </tbody>
        </table></center>
    <?php else: ?>
        <p>No bookings available.</p>
    <?php endif; ?>
</div>

<?php include('../includes/footer.php'); ?>
