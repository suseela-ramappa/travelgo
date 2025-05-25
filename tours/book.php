<?php
session_start();
include('../includes/db.php');
include('../includes/auth.php');

// Check if user is logged in
checkUserLogin();

if (!isset($_GET['id']) || !is_numeric($_GET['id'])) {
    echo "<p>Invalid tour ID.</p>";
    exit;
}

$tour_id = intval($_GET['id']);
$user_id = $_SESSION['user_id'];

// Check if the tour exists
$tour_sql = "SELECT * FROM tours WHERE id = ?";
$stmt = $conn->prepare($tour_sql);
$stmt->bind_param("i", $tour_id);
$stmt->execute();
$tour_result = $stmt->get_result();

if ($tour_result->num_rows === 0) {
    echo "<p>Tour not found.</p>";
    exit;
}
$tour = $tour_result->fetch_assoc();

// Optional: prevent duplicate booking
$check_sql = "SELECT * FROM bookings WHERE user_id = ? AND tour_id = ?";
$check_stmt = $conn->prepare($check_sql);
$check_stmt->bind_param("ii", $user_id, $tour_id);
$check_stmt->execute();
$check_result = $check_stmt->get_result();

if ($check_result->num_rows > 0) {
    echo "<p>You have already booked this tour.</p>";
    exit;
}

// Insert the booking
$insert_sql = "INSERT INTO bookings (user_id, tour_id) VALUES (?, ?)";
$insert_stmt = $conn->prepare($insert_sql);
$insert_stmt->bind_param("ii", $user_id, $tour_id);

if ($insert_stmt->execute()) {
    echo "<div style='padding:20px; font-family:sans-serif; background:#e6ffe6; border:1px solid #4CAF50; border-radius:8px; max-width:600px; margin:50px auto; text-align:center;'>
            <h2 style='color:#2e7d32;'>Booking Successful!</h2>
            <p>Thank you for booking <strong>" . htmlspecialchars($tour['title']) . "</strong>.</p>
            <p>We’ll contact you soon with further details.</p>
            <a href='../index.php' style='display:inline-block; margin-top:15px; padding:10px 20px; background:#4CAF50; color:white; text-decoration:none; border-radius:5px;'>Back to Home</a>
        </div>";
} else {
    echo "<p>Error: " . $conn->error . "</p>";
}
?>

<link rel="stylesheet" href="../assets/css/book.css">
