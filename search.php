<?php
include('includes/db.php');// include your DB connection
include('includes/header.php');
$searchQuery = '';
if (isset($_GET['search'])) {
    $searchQuery = trim($_GET['search']);
    $stmt = $conn->prepare("SELECT * FROM tours WHERE title LIKE ? OR description LIKE ?");
    $searchParam = "%$searchQuery%";
    $stmt->bind_param("ss", $searchParam, $searchParam);
    $stmt->execute();
    $result = $stmt->get_result();
} else {
    $result = $conn->query("SELECT * FROM tours ORDER BY id DESC LIMIT 10"); // Default
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Search Tours</title>
<link rel="stylesheet" href="assets/css/search.css">
     <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
</head>
<body>
    <div class="search-container">
   
<a href="javascript:history.back()" class="back-next-btn back-btn"><i class="fas fa-arrow-left"></i></a>
        <h2>Find Your Perfect Tour</h2>
        <form class="search-form" method="GET">
            <input type="text" name="search" placeholder="Search tours..." value="<?= htmlspecialchars($searchQuery) ?>" required>
            <button type="submit">Search</button>
        </form>

        <div class="results">
            <?php if ($result->num_rows > 0): ?>
                <?php while ($row = $result->fetch_assoc()): ?>
                    <div class="tour-card">
                        <h3><?= $row['title'] ?></h3>
                        <p><?= $row['description'] ?></p>
                        <span class="price">₹<?= $row['price'] ?></span>
                    </div>
                <?php endwhile; ?>
            <?php else: ?>
                <p class="no-results">No tours found for "<?= htmlspecialchars($searchQuery) ?>".</p>
            <?php endif; ?>
        </div>
    </div>
</body>
</html><?php
include('includes/footer.php');
?>