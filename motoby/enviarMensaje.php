<?php
session_start();

if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}

require_once 'context.php';

$user_id_emisor = $_SESSION['user_id'];

if (isset($_POST['usuario_destino_id']) && isset($_POST['contenido'])) {
    $user_id_receptor = $_POST['usuario_destino_id'];
    $contenido = $_POST['contenido'];

    $insertar_mensaje = $conn->prepare("INSERT INTO mensajes (emisor_id, receptor_id, contenido) VALUES (?, ?, ?)");
    $insertar_mensaje->execute([$user_id_emisor, $user_id_receptor, $contenido]);
}

header("Location: chat.php?user_id=$user_id_receptor");
exit();
?>