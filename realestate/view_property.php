<?php
session_start();
$conn = new mysqli("localhost", "root", "", "realestate");
$id = intval($_GET['id']);
$property = $conn->query("SELECT * FROM properties WHERE property_id = $id")->fetch_assoc();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <title>Property Details - SellX</title>
    <link rel="stylesheet" href="/project/assets/view_property.css?v=<?php echo time(); ?>">
</head>
<body>
<header><h1>Property Details</h1></header>

<div class="property-detail-card">
    <img src="uploads/<?= htmlspecialchars($property['image']) ?>" alt="Property Image">
    <h2><?= htmlspecialchars($property['property_name']) ?></h2>
    <p><strong>Price:</strong> ₹<?= number_format($property['price']) ?></p>
    <p><strong>Location:</strong> <?= htmlspecialchars($property['address']) ?></p>
    <p><strong>Description:</strong> <?= nl2br(htmlspecialchars($property['description'])) ?></p>
    <a href="index.php" class="back-btn">Back to Home</a>
</div>

<footer>&copy; 2025 SellX</footer>
</body>
</html>
