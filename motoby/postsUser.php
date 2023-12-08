<?php
session_start();
require_once "context.php";

$user_id = $_SESSION['user_id'];

$sql = "SELECT * FROM posts WHERE user_id = :user_id ORDER BY fecha_publicacion DESC";
$stmt = $conn->prepare($sql);
$stmt->bindParam(':user_id', $user_id);
$stmt->execute();
$result = $stmt->fetchAll(PDO::FETCH_ASSOC);


?>