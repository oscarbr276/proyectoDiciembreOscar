<?php
session_start();

if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}

require_once 'context.php';

$user_id = $_SESSION['user_id'];

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['seguir_user_id'])) {
    $user_seguido_id = $_POST['seguir_user_id'];

    $verificar_seguimiento = $conn->prepare("SELECT id FROM seguidores WHERE user_id = ? AND user_seguido_id = ?");
    $verificar_seguimiento->execute([$user_id, $user_seguido_id]);

    if ($verificar_seguimiento->rowCount() === 0) {

        $agregar_seguimiento = $conn->prepare("INSERT INTO seguidores (user_id, user_seguido_id) VALUES (?, ?)");
        $agregar_seguimiento->execute([$user_id, $user_seguido_id]);
    }
}

$obtener_user_actual = $conn->prepare("SELECT user_id, username FROM users WHERE user_id = ?");
$obtener_user_actual->execute([$user_id]);
$user_actual = $obtener_user_actual->fetch(PDO::FETCH_ASSOC);

$obtener_seguidos = $conn->prepare("SELECT u.user_id, u.username FROM users u
                                    JOIN seguidores s ON u.user_id = s.user_seguido_id
                                    WHERE s.user_id = ?");
$obtener_seguidos->execute([$user_id]);
$seguidos = $obtener_seguidos->fetchAll(PDO::FETCH_ASSOC);
header("Location: mostrarPerfilDatos.php?user_id=$user_seguido_id");
exit();
?>
