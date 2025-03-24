<?php
session_start();
if (!isset($_SESSION['user_id'])) {
    exit();
}

$conn = new mysqli("localhost", "root", "", "realestate");
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$loggedInUser = $_SESSION['user_id'];
$receiverId = intval($_GET['user_id']);

$sql = "SELECT * FROM messages WHERE 
        (sender_id = ? AND receiver_id = ?) OR 
        (sender_id = ? AND receiver_id = ?)
        ORDER BY timestamp ASC";
$stmt = $conn->prepare($sql);
$stmt->bind_param("iiii", $loggedInUser, $receiverId, $receiverId, $loggedInUser);
$stmt->execute();
$result = $stmt->get_result();

while ($row = $result->fetch_assoc()) {
    $class = ($row['sender_id'] == $loggedInUser) ? "sent" : "received";
    echo "<div class='chat-message $class'><p>" . htmlspecialchars($row['message']) . "</p><span class='chat-time'>" . $row['timestamp'] . "</span></div>";
}
$stmt->close();
?>
