<?php
session_start();

// Check if admin is logged in
if (!isset($_SESSION['admin_id'])) {
    header('Location: login.php');
    exit();
}

include('../includes/db.php');

// Check if an ID is provided for deletion
if (isset($_GET['id'])) {
    $booking_id = $_GET['id'];

    // Prepare and execute the deletion query
    $stmt = $conn->prepare("DELETE FROM bookings WHERE id = ?");
    $stmt->bind_param("i", $booking_id);

    if ($stmt->execute()) {
        // Redirect back to manage bookings page after successful deletion
        header('Location: manage_bookings.php');
        exit();
    } else {
        echo "Error deleting booking: " . $conn->error;
    }
} else {
    echo "Booking ID not specified.";
}
