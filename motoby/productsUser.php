<?php
require_once "context.php";
session_start();

$userId = $_SESSION['user_id']; 

$sql = "SELECT products.*, users.username, users.profile_image FROM products JOIN users ON products.user_id = users.user_id WHERE products.user_id = :userId";
$stmt = $conn->prepare($sql);
$stmt->bindParam(':userId', $userId);
$stmt->execute();

?>