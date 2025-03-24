<?php
session_start();
include 'db.php';

if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}

$user_id = $_SESSION['user_id'];
$result = $conn->query("SELECT * FROM users WHERE user_id = '$user_id'");
$user = $result->fetch_assoc();
?>

<div style="max-width: 400px; margin: 50px auto; padding: 20px; border: 1px solid #ddd; border-radius: 10px; box-shadow: 2px 2px 12px rgba(0, 0, 0, 0.1); font-family: Arial, sans-serif; background-color: #f9f9f9;">
    <h2 style="text-align: center; color: #333;">User Profile</h2>
    <p style="font-size: 16px; color: #555;"><strong>First Name:</strong> <?php echo $user['first_name']; ?></p>
    <p style="font-size: 16px; color: #555;"><strong>Last Name:</strong> <?php echo $user['last_name']; ?></p>
    <p style="font-size: 16px; color: #555;"><strong>Email:</strong> <?php echo $user['email']; ?></p>
    <p style="font-size: 16px; color: #555;"><strong>Phone:</strong> <?php echo $user['phone']; ?></p>
    <p style="font-size: 16px; color: #555;"><strong>Address:</strong> <?php echo $user['address']; ?></p>
    <p style="font-size: 16px; color: #555;"><strong>DOB:</strong> <?php echo $user['dob']; ?></p>
    <p style="font-size: 16px; color: #555;"><strong>User ID:</strong> <?php echo $user['user_id']; ?></p>
</div>
