<?php
$conn = new mysqli("localhost", "root", "", "realestate");

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Validate seller_id
if (!isset($_GET['seller_id']) || !is_numeric($_GET['seller_id'])) {
    die("Invalid Seller ID.");
}

$sellerId = intval($_GET['seller_id']);

// Fetch seller details
$sql = "SELECT * FROM users WHERE user_id = $sellerId";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    $seller = $result->fetch_assoc();
    echo "<p><strong>Name:</strong> " . htmlspecialchars($seller['name']) . "</p>";
    echo "<p><strong>Phone:</strong> " . htmlspecialchars($seller['phone']) . "</p>";
    echo "<p><strong>Email:</strong> " . htmlspecialchars($seller['email']) . "</p>";
    echo "<p><strong>Address:</strong> " . htmlspecialchars($seller['address']) . "</p>";
} else {
    echo "No contact information available.";
}
?>
