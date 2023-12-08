<?php
require_once "context.php";

$user_id = $_SESSION['user_id'];

$sqlPosts = "SELECT COUNT(*) as total_posts FROM posts WHERE user_id = :user_id";
$stmtPosts = $conn->prepare($sqlPosts);
$stmtPosts->bindParam(':user_id', $user_id);
$stmtPosts->execute();
$resultPosts = $stmtPosts->fetch(PDO::FETCH_ASSOC);
$totalPosts = $resultPosts['total_posts'];

$sqlProducts = "SELECT COUNT(*) as total_products FROM products WHERE user_id = :user_id";
$stmtProducts = $conn->prepare($sqlProducts);
$stmtProducts->bindParam(':user_id', $user_id);
$stmtProducts->execute();
$resultProducts = $stmtProducts->fetch(PDO::FETCH_ASSOC);
$totalProducts = $resultProducts['total_products'];

?>