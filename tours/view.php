<?php
include('../includes/db.php');
include('../includes/header.php');

if (!isset($_GET['id']) || !is_numeric($_GET['id'])) {
    echo "<p>Invalid tour ID.</p>";
    include('../includes/footer.php');
    exit;
}

$id = intval($_GET['id']);
$sql = "SELECT * FROM tours WHERE id = $id";
$result = $conn->query($sql);

if ($result->num_rows === 0) {
    echo "<p>Tour not found.</p>";
    include('../includes/footer.php');
    exit;
}

$tour = $result->fetch_assoc();
?>

<link rel="stylesheet" href="../assets/css/view.css">

<div class="tour-detail-container">
    <div class="tour-header">
        <h1><?php echo htmlspecialchars($tour['title']); ?></h1>
        <p class="meta">Posted on: <?php echo date("d M Y", strtotime($tour['created_at'])); ?></p>
    </div>

    <div class="tour-info-box">
        <p class="description"><?php echo nl2br(htmlspecialchars($tour['description'])); ?></p>
        <p class="price"><strong>Price:</strong> ₹<?php echo number_format($tour['price']); ?></p>
<a href="book.php?id=<?php echo $tour['id']; ?>" class="book-btn">Book Now</a>

    </div>
</div>

<?php include('../includes/footer.php'); ?>


