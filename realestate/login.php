<?php
session_start();


$conn = new mysqli("localhost", "root", "", "realestate");


if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}


$error = "";
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = $_POST['email'];
    $password = $_POST['password'];

    $stmt = $conn->prepare("SELECT * FROM users WHERE email = ?");
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows === 1) {
        $user = $result->fetch_assoc();
        if (password_verify($password, $user['password'])) {
          
            $_SESSION['user_id'] = $user['user_id'];
            $_SESSION['first_name'] = $user['first_name'];
            $_SESSION['last_name'] = $user['last_name'];
            $_SESSION['email'] = $user['email'];
            $_SESSION['phone'] = $user['phone'];
            $_SESSION['profile_image'] = $user['profile_image'];

            
            header("Location: index.php");
            exit();
        } else {
            $error = "Invalid password.";
        }
    } else {
        $error = "No user found with that email.";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <title>Login - Real Estate</title>
    <link rel="stylesheet" href="assets/login2.css?v=<?php echo time(); ?>">

</head>
<body>

<div class="form-container">
    <h2>Login</h2>

    <?php if (!empty($error)) : ?>
        <div class="error-message"><?php echo $error; ?></div>
    <?php endif; ?>

    <form method="post">
        <div class="form-group">
            <label for="email">Email:</label>
            <input type="email" name="email" id="email" required placeholder="Enter your email">
        </div>

        <div class="form-group">
            <label for="password">Password:</label>
            <input type="password" name="password" id="password" required placeholder="Enter your password">
        </div>

        <div class="form-group">
            <button type="submit" class="btn-primary">Login</button>
        </div>
    </form>

    <p>Don't have an account? <a href="register.php">Register here</a></p>
</div>

</body>
</html>
