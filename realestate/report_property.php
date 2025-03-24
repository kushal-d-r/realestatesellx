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

if (!isset($_GET['property_id']) || !is_numeric($_GET['property_id'])) {
    die("Invalid property ID.");
}

$propertyId = intval($_GET['property_id']);
$userId = $_SESSION['user_id'];

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $reason = trim($_POST['reason']);

    if (empty($reason)) {
        $error = "Reason cannot be empty!";
    } else {
        $stmt = $conn->prepare("INSERT INTO reports (user_id, property_id, reason) VALUES (?, ?, ?)");
        $stmt->bind_param("iis", $userId, $propertyId, $reason);
        if ($stmt->execute()) {
            $success = "Property reported successfully!";
        } else {
            $error = "Error reporting property.";
        }
        $stmt->close();
    }
}

$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <title>Report Property</title>
    <link rel="stylesheet" href="assets/report_property.css">
</head>
<body>
    <div class="report-container">
        <h2>Report Property</h2>
        <?php if (isset($error)) echo "<p class='error'>$error</p>"; ?>
        <?php if (isset($success)) echo "<p class='success'>$success</p>"; ?>
        <form method="POST">
            <label for="reason">Reason:</label>
            <textarea name="reason" id="reason" required></textarea>
            <button type="submit">Submit Report</button>
        </form>
    </div>
</body>
</html>
