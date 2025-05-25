<?php
// index.php - Landing page
include('includes/header.php');
?>
   <html>
    <body>
<head><link rel="stylesheet" href="assets/css/style.css"></head>
<div class="hero-section">
    <div class="hero-content">
        <h2>Welcome to TravelGo</h2>
        <p>Your journey starts here. Explore the world with our exclusive tour packages!</p>
        <a href="tours/list.php" class="btn-primary">Browse Tours</a>
     
    </div>
</div>

<section class="featured-tours">
    <div class="container">
        <br><br>
        <h2>Featured Tours</h2><br><br>

        <?php
        // Display featured tours
        include('includes/db.php');
        $sql = "SELECT * FROM tours ORDER BY created_at DESC LIMIT 3";
        $result = $conn->query($sql);

        while ($tour = $result->fetch_assoc()) {
            echo "
            <div class='tour-item'>
               
                <h3>{$tour['title']}</h3>
                <p>{$tour['description']}</p><br>
                <a href='tours/view.php?id={$tour['id']}' class='btn-secondary'>View Details</a><br>
            </div>";
        }
        ?>
    </div>
</section>

<section class="about-us">
    <div class="container">
        <h2>About Us</h2><br>
        <p>TravelGo is your go-to platform for exploring new destinations, booking amazing tours, and creating memories that will last a lifetime.</p>
       <br> <a href="about.php" class="btn-primary">Learn More</a>
    </div>
</section>

<section class="contact-us">
    <div class="container">
        <h2>Get in Touch</h2><br>
        <p>Have questions or need help? Reach out to us!</p><br>
        <a href="contact.php" class="btn-primary">Contact Us</a>
    </div>
</section>
    </body>
       </html>
<?php
include('includes/footer.php');
?>
