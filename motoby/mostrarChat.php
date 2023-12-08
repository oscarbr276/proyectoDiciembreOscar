<?php
require_once "chat.php";
require_once 'context.php';

if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}

$user_id = $_SESSION['user_id'];

$usuario_destino_id = $_GET['usuario_destino'] ?? null;

if ($usuario_destino_id === null || !ctype_digit($usuario_destino_id)) {
    header("Location: error.php");
    exit();
}

$consulta_mensajes = $conn->prepare("SELECT * FROM mensajes 
                                    WHERE (user_id = ? AND user_id = ?) 
                                    OR (user_id = ? AND user_id = ?)
                                    ORDER BY fecha_envio");
$consulta_mensajes->execute([$user_id, $usuario_destino_id, $usuario_destino_id, $user_id]);

while ($mensaje = $consulta_mensajes->fetch(PDO::FETCH_ASSOC)) {
    echo '<div>';
    echo '<strong>' . $mensaje['nombre_emisor'] . ':</strong> ' . $mensaje['contenido'];
    echo '</div>';
}


?>