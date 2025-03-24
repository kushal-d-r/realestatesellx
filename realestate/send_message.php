<?php
session_start();
$conn = new mysqli("localhost", "root", "", "realestate");

if (!isset($_SESSION['user_id']) || !isset($_POST['receiver_id']) || !isset($_POST['message'])) {
    http_response_code(400);
    exit("Invalid request");
}

$sender_id = $_SESSION['user_id'];
$receiver_id = intval($_POST['receiver_id']);
$message = trim($_POST['message']);


if ($sender_id === $receiver_id) {
    http_response_code(400);
    exit("You cannot send a message to yourself.");
}


$stmt = $conn->prepare("INSERT INTO messages (sender_id, receiver_id, message) VALUES (?, ?, ?)");
$stmt->bind_param("iis", $sender_id, $receiver_id, $message);

if ($stmt->execute()) {
    http_response_code(200);
} else {
    http_response_code(500);
    echo "Database error: " . $stmt->error;
}

$stmt->close();
$conn->close();
?>
