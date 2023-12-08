<?php
require_once "context.php";
require_once "mostrarPerfilDatos.php";

$user_id = $_GET['user_id'];

$sql = "SELECT * FROM users WHERE user_id = :user_id";
$stmt = $conn->prepare($sql);
$stmt->bindValue(':user_id', $user_id);
$stmt->execute();
$user = $stmt->fetch(PDO::FETCH_ASSOC);

if ($user) {
    
    
} else {
    echo "Usuario no encontrado";
}
?>