<?php
require_once './includes/db.php'; // DB connection file
require_once './includes/header.php'; // Header HTML

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $name = trim($_POST['name']);
    $email = trim($_POST['email']);
    $message = trim($_POST['message']);

    if ($name && $email && $message) {
        $stmt = $conn->prepare("INSERT INTO contact_messages (name, email, message) VALUES (?, ?, ?)");
        $stmt->bind_param("sss", $name, $email, $message);

        if ($stmt->execute()) {
            $success = "Thank you! Your message has been sent.";
        } else {
            $error = "Something went wrong. Please try again.";
        }
    } else {
        $error = "All fields are required.";
    }
}
?>
<link rel="stylesheet" href="assets/css/contact.css">


<div class="contact-container">
    <a href="index.php" class="back-btn"><i class="fas fa-arrow-left"></i></a>

      <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <h2>Contact Us</h2>

    <?php if (isset($success)) echo "<p class='success'>$success</p>"; ?>
    <?php if (isset($error)) echo "<p class='error'>$error</p>"; ?>

    <form action="contact.php" method="POST" class="contact-form">
        <label>Enter your Name</label><br>
        <input type="text" name="name" placeholder="Your Name" required />
        <label>Enter your Email</label><br>
        <input type="email" name="email" placeholder="Your Email" required />
        <label>Message</label><br>
        <textarea name="message" placeholder="Your Message here....." rows="5" required></textarea>
        <button type="submit">Send Message</button>
    </form>
</div>

<?php require_once './includes/footer.php'; ?>

