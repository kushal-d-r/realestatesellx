<?php
include 'db.php'; 
$errors = [];

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $first_name = mysqli_real_escape_string($conn, $_POST['first_name']);
    $last_name = mysqli_real_escape_string($conn, $_POST['last_name']);
    $email = mysqli_real_escape_string($conn, $_POST['email']);
    $phone = mysqli_real_escape_string($conn, $_POST['phone']);
    $address =mysqli_real_escape_string($conn, $_POST['address']);
    $dob = mysqli_real_escape_string($conn, $_POST['dob']);
    $password = mysqli_real_escape_string($conn, $_POST['password']);
    
    // Age Check (only allow 18+)
    $today = new DateTime();
    $birthdate = new DateTime($dob);
    $age = $today->diff($birthdate)->y;
    if ($age < 18) {
        $errors[] = "You must be at least 18 years old to register.";
    }

    // Check if email or phone already exists
    $check_query = "SELECT * FROM users WHERE email='$email' OR phone='$phone'";
    $check_result = mysqli_query($conn, $check_query);
    if (mysqli_num_rows($check_result) > 0) {
        $errors[] = "Email or Phone already exists!";
    }

    if (empty($errors)) {
        $hashed_password = password_hash($password, PASSWORD_DEFAULT);
        $query = "INSERT INTO users (first_name, last_name, email, phone, dob, address, password) 
        VALUES ('$first_name', '$last_name', '$email', '$phone', '$dob', '$address', '$hashed_password')";

        if (mysqli_query($conn, $query)) {
            session_start();
            $_SESSION['user_email'] = $email;
            header('Location: index.php'); // Redirect to home page after successful registration
            exit;
        } else {
            $errors[] = "Failed to register. Please try again.";
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <title>Register</title>
    <link rel="stylesheet" href="/realestate/assets/register.css">

</head>
<body>

<div class="form-container">
    <h2> SellX </h2>
    <h1>Register</h1>
    
    <?php
    if (!empty($errors)) {
        echo '<div class="error-messages">';
        foreach ($errors as $error) {
            echo "<p>$error</p>";
        }
        echo '</div>';
    }
    ?>
    
    <form method="post" action="register.php">
        <input type="text" name="first_name" placeholder="First Name" required>
        <input type="text" name="last_name" placeholder="Last Name" required>
        <input type="email" name="email" placeholder="Email" required>
        <input type="text" name="phone" placeholder="Phone Number" required>
        <input type="date" name="dob" required>
        <input type="text" name="address" placeholder="Address" required>
        <input type="password" name="password" placeholder="Password" required>
        <button type="submit">Register</button>
    </form>
    
    <p>Already have an account? <a href="login.php">Login here</a></p>
</div>

</body>
</html>
