<?php
session_start();
include 'db.php';

if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}

if (!isset($_GET['property_id'])) {
    die("Error: Property ID is missing.");
}

$property_id = intval($_GET['property_id']);
$user_id = $_SESSION['user_id'];

$conn->query("DELETE FROM favorites WHERE user_id = '$user_id' AND property_id = '$property_id'");

header("Location: favorites.php");
exit();
