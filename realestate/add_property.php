<?php
session_start();

// Check if user is logged in
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}


$user_id = $_SESSION['user_id'];


$conn = new mysqli("localhost", "root", "", "realestate");

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}


$uploadDir = __DIR__ . "/uploads/";
if (!file_exists($uploadDir)) {
    mkdir($uploadDir, 0777, true);
}


if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $property_name = $_POST['property_name'];
    $price = floatval($_POST['price']); 
    $property_address = $_POST['address']; 
    $owner_name = $_POST['owner_name'];
    $owner_email = $_POST['owner_email'];
    $owner_phone = $_POST['owner_phone'];
    $property_type = $_POST['property_type'];
    $description = $_POST['description'];

    
    $image = $_FILES['property_image'];
    $imageName = time() . '-' . basename($image['name']);
    $targetFile = $uploadDir . $imageName;

    if (move_uploaded_file($image['tmp_name'], $targetFile)) {
        
        $stmt = $conn->prepare("
            INSERT INTO properties (property_name, price, property_address, owner_name, owner_email, owner_phone, property_type, image, description, user_id) 
            VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?)
        ");

        $stmt->bind_param("sdsssssssi", $property_name, $price, $property_address, $owner_name, $owner_email, $owner_phone, $property_type, $imageName, $description, $user_id);

        if ($stmt->execute()) {
            header("Location: index.php");
            exit();
        } else {
            echo "Database Error: " . $stmt->error;
        }
    } else {
        echo "Failed to upload image.";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <title>Add Property - SellX</title>
    <link rel="stylesheet" href="/realestate/assets/add_property.css?v=<?php echo time(); ?>">
</head>
<body>

<div class="form-container">
    <h3>SellX</h3>
    <h2>Add Property</h2>

    <form action="add_property.php" method="POST" enctype="multipart/form-data">
        <label>Property Name:</label>
        <input type="text" name="property_name" required>

        <label>Price (in ₹):</label>
        <input type="number" step="0.01" name="price" required>

        <label>Address:</label>
        <input type="text" name="address" required>

        <label>Owner Name:</label>
        <input type="text" name="owner_name" required>

        <label>Owner Email:</label>
        <input type="email" name="owner_email" required>

        <label>Owner Phone:</label>
        <input type="text" name="owner_phone" required>

        <label>Property Type:</label>
        <select name="property_type" required>
            <option value="House">House</option>
            <option value="Apartment">Apartment</option>
            <option value="Land">Land</option>
        </select>

        <label>Description:</label>
        <input type="text" name="description" required>

        <label>Upload Image:</label>
        <input type="file" name="property_image" accept="image/*" required>

        <button type="submit">Add Property</button>
    </form>
</div>

</body>
</html>
