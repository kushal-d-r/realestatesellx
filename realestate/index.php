<?php
session_start();

if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}

$conn = new mysqli("localhost", "root", "", "realestate");
$userId = $_SESSION['user_id'];
$properties = [];
$dashboardMode = isset($_GET['dashboard']);
$favorites = [];

// Build the query
$sql = "SELECT * FROM properties";
$conditions = [];

if ($dashboardMode) {
    $conditions[] = "user_id = $userId";
}

if (count($conditions) > 0) {
    $sql .= " WHERE " . implode(" AND ", $conditions);
}

$result = $conn->query($sql);
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $properties[] = $row;
    }
}

// Fetch favorite properties
$favResult = $conn->query("SELECT property_id FROM favorites WHERE user_id = $userId");
while ($row = $favResult->fetch_assoc()) {
    $favorites[] = $row['property_id'];
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <title>SellX - Home</title>
    <link rel="stylesheet" href="/realestate/assets/home.css?v=<?php echo time(); ?>">
</head>
<body>
<header>
    <nav class="navbar">
        <ul class="nav-links">
            <li><a href="profile.php">Profile</a></li>
            <li><a href="dashboard.php">Dashboard</a></li>
            <li><a href="favorites.php">Favorites</a></li>
        </ul>
        <h1 class="site-title">SellX</h1>
        <div class="header-icons">
            <button class="messages-btn" onclick="location.href='messages.php'">💬</button>
            <button class="add-property-btn" onclick="location.href='add_property.php'">Add Property</button>
            <button class="logout-btn" onclick="location.href='logout.php'">Logout</button>
        </div>
    </nav>
</header>

<div class="content">
    <div class="property-grid">
        <?php if (count($properties) > 0): ?>
            <?php foreach ($properties as $property): ?>
                <div class="property-card">
                    <img src="uploads/<?php echo htmlspecialchars($property['image']); ?>" alt="Property Image">
                    <div class="property-details">
                        <h3><?php echo htmlspecialchars($property['property_name']); ?></h3>
                        <p><?php echo htmlspecialchars($property['property_address']); ?></p>
                        <p>Price: ₹<?php echo number_format($property['price']); ?></p>
                        <button onclick="location.href='property_details.php?id=<?php echo $property['property_id']; ?>'">View Details</button>

                        <form action="add_favorite.php" method="POST">
                            <input type="hidden" name="property_id" value="<?php echo $property['property_id']; ?>">
                            <button class="favorite-btn" onclick="addToFavorites(<?php echo $property['property_id']; ?>, this)">
                                <?php echo in_array($property['property_id'], $favorites) ? "✔ Added" : "♡ Add to Favorites"; ?>
                            </button>
                        </form>

                        <?php if ($dashboardMode): ?>
                            <button class="delete-btn" onclick="deleteProperty(<?php echo $property['property_id']; ?>)">Delete</button>
                        <?php endif; ?>
                    </div>
                </div>
            <?php endforeach; ?>
        <?php else: ?>
            <p class="no-properties">No properties found.</p>
        <?php endif; ?>
    </div>
</div>

<script src="/realestate/assets/menu.js?v=<?php echo time(); ?>"></script>
<script>
    function deleteProperty(id) {
        if (confirm('Delete property?')) location.href = 'delete_property.php?id=' + id;
    }
</script>
</body>
</html>
