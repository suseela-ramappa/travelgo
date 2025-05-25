<?php
include('../includes/db.php');
include('../includes/header.php');
?>

<link rel="stylesheet" href="../assets/css/list.css">

<div class="tour-list-container">
    <h1>All TravelGo Tours</h1>
    <p class="subheading">Explore top destinations and exclusive packages from TravelGo.</p>

    <div class="tour-grid">
        <?php
        $sql = "SELECT * FROM tours ORDER BY created_at DESC";
        $result = $conn->query($sql);

        if ($result->num_rows > 0):
            while ($row = $result->fetch_assoc()):
        ?>
            <div class="tour-card">
                <div class="tour-details">
                    <h3><?php echo htmlspecialchars($row['title']); ?></h3>
                    <p class="description"><?php echo substr(htmlspecialchars($row['description']), 0, 120); ?>...</p>
                    <p><strong>Price:</strong> ₹<?php echo number_format($row['price']); ?></p>
                    <p><strong>Posted on:</strong> <?php echo date("d M Y", strtotime($row['created_at'])); ?></p>
                    <a href="view.php?id=<?php echo $row['id']; ?>" class="btn-view">View Details</a>
                </div>
            </div>
        <?php
            endwhile;
        else:
            echo "<p>No tours available at the moment.</p>";
        endif;
        ?>
    </div>
</div>

<?php include('../includes/footer.php'); ?>


