<?php
session_start();
$conn = new mysqli("localhost", "root", "", "realestate");

if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}

$user_id = $_SESSION['user_id']; 


$stmt = $conn->prepare("SELECT property_id, property_name, image FROM properties WHERE user_id = ?");
$stmt->bind_param("i", $user_id);
$stmt->execute();
$result = $stmt->get_result();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>
    <link rel="stylesheet" href="assets/dashboard.css">
</head>
<body>
    <h1>Dashboard - Manage Properties</h1>

    <?php if ($result->num_rows > 0): ?>
        <table border="1">
            <tr>
                <th>ID</th>
                <th>Name</th>
                <th>Image</th>
                <th>Actions</th>
            </tr>

            <?php while ($p = $result->fetch_assoc()): ?>
                <tr>
                    <td><?= htmlspecialchars($p['property_id']) ?></td>
                    <td><?= htmlspecialchars($p['property_name']) ?></td>
                    <td>
                        <img src="uploads/<?= htmlspecialchars($p['image']) ?>" width="100" alt="Property Image">
                    </td>
                    <td>
                        
                        <a href="delete_property.php?id=<?= urlencode($p['property_id']) ?>" class="delete-btn">Delete</a>
                    </td>
                </tr>
            <?php endwhile; ?>
        </table>
    <?php else: ?>
        <p>No properties added yet.</p>
    <?php endif; ?>

</body>
</html>

<?php
$stmt->close();
$conn->close();
?>
