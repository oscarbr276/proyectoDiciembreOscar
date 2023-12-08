<?php
require_once 'context.php';

session_start();

if (!isset($_SESSION['user_id'])) {
    exit();
}

$user_id = $_SESSION['user_id'];

if (!isset($_GET['receptor_id'])) {
    exit();
}

$receptor_id = $_GET['receptor_id'];

$obtener_mensajes = $conn->prepare("SELECT * FROM mensajes WHERE (emisor_id = ? AND receptor_id = ?) OR (emisor_id = ? AND receptor_id = ?) ORDER BY fecha_envio ASC");
$obtener_mensajes->execute([$user_id, $receptor_id, $receptor_id, $user_id]);
$mensajes = $obtener_mensajes->fetchAll(PDO::FETCH_ASSOC);

foreach ($mensajes as $mensaje) {
    echo "<p>{$mensaje['contenido']} ({$mensaje['fecha_envio']})</p>";
}
?>