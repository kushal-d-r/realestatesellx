<?php
session_start();
include 'db.php'; 
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}

$user_id = $_SESSION['user_id'];
$result = $conn->query("
    SELECT p.* FROM properties p
    INNER JOIN favorites f ON p.property_id = f.property_id
    WHERE f.user_id = '$user_id'
");

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <title>Favorites</title>
    <link rel="stylesheet" href="assets/favorites.css?v=<?php echo time(); ?>">

</head>
<body>

<h1>Your Favorite Properties</h1>

<?php if ($result->num_rows > 0): ?>
    <ul>
        <?php while ($p = $result->fetch_assoc()): ?>
            <li>
                <img src="uploads/<?= htmlspecialchars($p['image']) ?>" width="100">
                <strong><?= htmlspecialchars($p['property_name']) ?></strong> - 
                <?= htmlspecialchars($p['property_address']) ?>
                <a href="remove_favorite.php?property_id=<?= urlencode($p['property_id']) ?>">Remove</a>
            </li>
        <?php endwhile; ?>
    </ul>
<?php else: ?>
    <p>No favorite properties yet.</p>
<?php endif; ?>

</body>
</html>
