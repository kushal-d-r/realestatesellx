<?php
session_start();
if (!isset($_SESSION['user_id']) || !isset($_GET['user_id'])) {
    header("Location: login.php");
    exit();
}

$conn = new mysqli("localhost", "root", "", "realestate");
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$loggedInUser = $_SESSION['user_id'];
$chatUser = intval($_GET['user_id']);


$userQuery = $conn->prepare("SELECT first_name, last_name FROM users WHERE user_id = ?");
$userQuery->bind_param("i", $chatUser);
$userQuery->execute();
$userResult = $userQuery->get_result();
$chatUserData = $userResult->fetch_assoc();

if (!$chatUserData) {
    die("User not found.");
}

$chatUserName = $chatUserData['first_name'] . ' ' . $chatUserData['last_name'];
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Chat with <?php echo htmlspecialchars($chatUserName); ?></title>
    <link rel="stylesheet" href="assets/chat.css?v=<?php echo time(); ?>">
</head>
<body>

<div class="chat-container">
    <div class="chat-header">
        <a href="messages.php" class="back-btn">← Back</a>
        <span><?php echo htmlspecialchars($chatUserName); ?></span>
    </div>

    <div class="chat-body" id="chatBox">
        <!-- Messages will be loaded here via AJAX -->
    </div>

    <div class="chat-footer">
        <input type="hidden" id="receiver_id" value="<?php echo $chatUser; ?>">
        <input type="text" id="messageInput" placeholder="Type a message..." required>
        <button id="sendMessage">Send</button>
    </div>
</div>

<script>
// Function to load messages dynamically
function loadMessages() {
    let chatBox = document.getElementById("chatBox");
    let receiverId = document.getElementById("receiver_id").value;

    let xhr = new XMLHttpRequest();
    xhr.open("GET", "fetch_messages.php?user_id=" + receiverId, true);
    xhr.onreadystatechange = function() {
        if (xhr.readyState === 4 && xhr.status === 200) {
            chatBox.innerHTML = xhr.responseText;
            chatBox.scrollTop = chatBox.scrollHeight; // Auto-scroll to the latest message
        }
    };
    xhr.send();
}

// Send message via AJAX
document.getElementById("sendMessage").addEventListener("click", function() {
    let message = document.getElementById("messageInput").value.trim();
    let receiverId = document.getElementById("receiver_id").value;

    if (message === "") return;

    let xhr = new XMLHttpRequest();
    xhr.open("POST", "send_message.php", true);
    xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");

    xhr.onreadystatechange = function() {
        if (xhr.readyState === 4 && xhr.status === 200) {
            document.getElementById("messageInput").value = ""; // Clear input field
            loadMessages(); // Refresh chat without reload
        }
    };

    xhr.send("message=" + encodeURIComponent(message) + "&receiver_id=" + receiverId);
});

setInterval(loadMessages, 2000); // Auto-refresh chat every 2 seconds
</script>

</body>
</html>
