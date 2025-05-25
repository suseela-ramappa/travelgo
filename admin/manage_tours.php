<?php
// manage_tours.php - Manage Tours (Add, Edit, Delete)
session_start();

// Optional login check
// if (!isset($_SESSION['admin_id'])) {
//     header('Location: login.php');
//     exit();
// }

include('../includes/db.php');

// Handle Add Tour form submission
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['add_tour' || 'update_tour'])) {

    // Validate and sanitize inputs
    $name = $_POST['title'] ?? '';
    $description = $_POST['description'] ?? '';
    $price = $_POST['price'] ?? 0;

    if (!empty($name) && !empty($description) && is_numeric($price)) {

        $sql = "INSERT INTO tours (title, description, price) VALUES (?, ?, ?)";
        $stmt = $conn->prepare($sql);

        if (!$stmt) {
            die("Prepare failed: " . $conn->error);
        }

        $stmt->bind_param("ssd", $name, $description, $price); // s: string, s: string, d: double
        $stmt->execute();
        $stmt->close();

        header('Location: manage_tours.php');
        exit();

    } else {
        echo "<p style='color:red;'>Please fill all fields correctly.</p>";
    }
}

// Fetch all tours
$sql = "SELECT * FROM tours";
$tours = $conn->query($sql);


//edit the tour

if (isset($_GET['edit'])) {
    $edit_id = $_GET['edit'];
    $result = $conn->query("SELECT * FROM tours WHERE id = $edit_id");
    $edit_tour = $result->fetch_assoc();
}

// Handle Edit Tour Submission
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['edit_tour'])) {
    $id = $_POST['tour_id'];
    $title = $_POST['title'];
    $description = $_POST['description'];
    $price = $_POST['price'];

    $stmt = $conn->prepare("UPDATE tours SET title = ?, description = ?, price = ? WHERE id = ?");
    $stmt->bind_param("ssdi", $title, $description, $price, $id);
    $stmt->execute();
    $stmt->close();

    header("Location: manage_tours.php");
    exit();
}
//delete the tour
if (isset($_GET['delete'])) {
    $id = $_GET['delete'];
    $stmt = $conn->prepare("DELETE FROM tours WHERE id=?");
    $stmt->bind_param("i", $id);
    $stmt->execute();
    $stmt->close();
    header('Location: manage_tours.php');
    exit();
}
?>
 
<!-- Add Tour Form -->
<h2><?= isset($_GET['edit']) ? 'Edit Tour' : 'Add New Tour' ?></h2>
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
<a href="javascript:history.back()" class="back-next-btn back-btn"><i class="fas fa-arrow-left"></i></a>
<form method="post" action="">
  
    <input type="hidden" name="<?= isset($_GET['edit']) ? 'edit_tour' : 'add_tour' ?>" value="1">
    <?php if (isset($_GET['edit'])): ?>
        <input type="hidden" name="tour_id" value="<?= $edit_tour['id'] ?>">
    <?php endif; ?>

    <label>Title:</label>
    <input type="text" name="title" value="<?= $edit_tour['title'] ?? '' ?>" required>

    <label>Description:</label>
    <textarea name="description" required><?= $edit_tour['description'] ?? '' ?></textarea>

    <label>Price:</label>
    <input type="number" step="0.01" name="price" value="<?= $edit_tour['price'] ?? '' ?>" required>

    <button type="submit"><?= isset($_GET['edit']) ? 'Update Tour' : 'Add Tour' ?></button>
    <?php if (isset($_GET['edit'])): ?>
        <a href="manage_tours.php" style="margin-left: 10px;">Cancel</a>
    <?php endif; ?>
</form>

<!-- Display Tours -->
<center>
<h2>All Tours</h2>
<table>
    <tr>
        <th>ID</th>
        <th>Title</th>
        <th>Description</th>
        <th>Price</th>
        <th>Actions</th>
    </tr>
    <?php while ($row = $tours->fetch_assoc()): ?>
    <tr>
        <td><?= $row['id'] ?></td>
        <td><?= htmlspecialchars($row['title']) ?></td>
        <td><?= htmlspecialchars($row['description']) ?></td>
        <td>$<?= number_format($row['price'], 2) ?></td>
        <td class="actions">
            <a href="?edit=<?= $row['id'] ?>" class="edit-btn">Edit</a><br><br>
            <a href="?delete=<?= $row['id'] ?>" class="delete-btn" onclick="return confirm('Are you sure you want to delete this tour?');">Delete</a>
        </td>
    </tr>
    <?php endwhile; ?>
</table>

    </center>
<link rel="stylesheet" href="../assets/css/manage_tours.css">

