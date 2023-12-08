<?php
session_start();
require_once "context.php";
require_once "perfil.php";

if (!isset($_SESSION['user_id'])) {

    header("Location: login.php");
    exit();
}


$user_id = $_SESSION['user_id'];

$sql = "SELECT * FROM users WHERE user_id = :user_id";
$stmt = $conn->prepare($sql);
$stmt->bindValue(':user_id', $user_id);
$stmt->execute();

$resultados = $stmt->fetchAll(PDO::FETCH_ASSOC);

foreach ($resultados as $fila) {
   
}
?>
