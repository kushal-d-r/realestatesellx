<?php
session_start();
$conn = new mysqli("localhost", "root", "", "realestate");

if (!isset($_SESSION['user_id']) || !isset($_POST['property_id'])) {
    http_response_code(400);
    exit();
}

$user_id = $_SESSION['user_id'];
$property_id = intval($_POST['property_id']);

$checkFavorite = $conn->query("SELECT * FROM favorites WHERE user_id = $user_id AND property_id = $property_id");

if ($checkFavorite->num_rows == 0) {
    $conn->query("INSERT INTO favorites (user_id, property_id) VALUES ($user_id, $property_id)");
}

$conn->close();
http_response_code(200);
exit();
