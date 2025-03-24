<?php
session_start();

if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}


$conn = new mysqli("localhost", "root", "", "realestate");

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Validate property ID
if (!isset($_GET['id']) || !is_numeric($_GET['id'])) {
    die("Invalid property ID.");
}

$propertyId = intval($_GET['id']);

// Fetch property details including uploader (seller) ID
$sql = "SELECT p.property_id, p.property_name, p.property_address, p.price, p.property_type, p.description, p.image, 
               p.owner_name, p.owner_phone, p.owner_email, p.user_id AS seller_id
        FROM properties p
        WHERE p.property_id = ?";

$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $propertyId);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows == 0) {
    die("Property not found.");
}

$property = $result->fetch_assoc();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <title><?php echo htmlspecialchars($property['property_name']); ?> - SellX</title>
    <link rel="stylesheet" href="/realestate/assets/property_details.css?v=<?php echo time(); ?>">
</head>
<body>
    <div class="property-container">
        <div class="image-section">
            <img src="uploads/<?php echo htmlspecialchars($property['image']); ?>" alt="Property Image">
        </div>
        <div class="details-section">
            <h1><?php echo htmlspecialchars($property['property_name']); ?></h1>
            <p><strong>Address:</strong> <?php echo isset($property['property_address']) ? htmlspecialchars($property['property_address']) : 'N/A'; ?></p>
            <p><strong>Price:</strong> ₹<?php echo number_format($property['price']); ?></p>
            <p><strong>Type:</strong> <?php echo htmlspecialchars($property['property_type']); ?></p>
            <p><strong>Description:</strong> <?php echo nl2br(htmlspecialchars($property['description'])); ?></p>

            <h3>Owner Information</h3>
            <p><strong>Name:</strong> <?php echo htmlspecialchars($property['owner_name']); ?></p>
            <p><strong>Phone:</strong> <?php echo htmlspecialchars($property['owner_phone']); ?></p>
            <p><strong>Email:</strong> <?php echo htmlspecialchars($property['owner_email']); ?></p>

            <!-- Buttons Section -->
            <div class="buttons">
                
                <a href="chat.php?user_id=<?php echo $property['seller_id']; ?>" class="message-button">Message Dealer</a>
                
               
                <a href="report_property.php?property_id=<?php echo $propertyId; ?>" class="report-button">Report Property</a>
            </div>
        </div>
    </div>
</body>
</html>
