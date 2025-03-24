<?php
session_start();
$conn = new mysqli("localhost", "root", "", "realestate");


if (isset($_GET['id'])) {
    $property_id = $_GET['id'];

 
    $result = $conn->query("SELECT image FROM properties WHERE property_id = '$property_id'");
    $property = $result->fetch_assoc();
    if ($property && file_exists("uploads/" . $property['image'])) {
        unlink("uploads/" . $property['image']); // Delete image file
    }

    
    $conn->query("DELETE FROM properties WHERE property_id = '$property_id'");

   
    header("Location: dashboard.php");
    exit();
} else {
    echo "Invalid request.";
}
?>
