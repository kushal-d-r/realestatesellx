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

$loggedInUser = $_SESSION['user_id'];


$sql = "SELECT m1.*, 
            CASE 
                WHEN m1.sender_id = $loggedInUser THEN u2.first_name 
                ELSE u1.first_name 
            END AS first_name,
            CASE 
                WHEN m1.sender_id = $loggedInUser THEN u2.last_name 
                ELSE u1.last_name 
            END AS last_name,
            CASE 
                WHEN m1.sender_id = $loggedInUser THEN m1.receiver_id
                ELSE m1.sender_id
            END AS chat_user_id
        FROM messages m1
        INNER JOIN (
            SELECT 
                GREATEST(sender_id, receiver_id) AS user1,
                LEAST(sender_id, receiver_id) AS user2,
                MAX(timestamp) AS latest
            FROM messages
            GROUP BY user1, user2
        ) m2 
        ON ((m1.sender_id = m2.user1 AND m1.receiver_id = m2.user2) 
            OR (m1.sender_id = m2.user2 AND m1.receiver_id = m2.user1))
        AND m1.timestamp = m2.latest
        INNER JOIN users u1 ON u1.user_id = m1.sender_id
        INNER JOIN users u2 ON u2.user_id = m1.receiver_id
        WHERE (m1.sender_id = $loggedInUser OR m1.receiver_id = $loggedInUser)
        GROUP BY user1, user2
        ORDER BY m1.timestamp DESC";

$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Messages</title>
    <link rel="stylesheet" href="assets/messages.css?v=<?php echo time(); ?>">
</head>
<body>

<header>
    <h1>Messages</h1>
    <button onclick="location.href='index.php'">Back</button>
</header>

<div class="message-container">
    <h2>Your Conversations</h2>
    <?php if ($result->num_rows > 0): ?>
        <?php while ($row = $result->fetch_assoc()): ?>
            <div class="message" onclick="window.location.href='chat.php?user_id=<?php echo $row['chat_user_id']; ?>'">
                <strong><?php echo htmlspecialchars($row['first_name'] . ' ' . $row['last_name']); ?></strong>
                <p><?php echo htmlspecialchars($row['message']); ?></p>
                <span class="timestamp"><?php echo $row['timestamp']; ?></span>
            </div>
        <?php endwhile; ?>
    <?php else: ?>
        <p>No conversations found.</p>
    <?php endif; ?>
</div>

</body>
</html>
