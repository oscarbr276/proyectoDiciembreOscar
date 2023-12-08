<?php
require_once "context.php";

$sql = "SELECT posts.*, users.username,  users.profile_image  FROM posts JOIN users ON posts.user_id = users.user_id ORDER BY posts.fecha_publicacion DESC";

$result = $conn->query($sql);
function buscarPublicaciones($conn, $termino) {
    $sql = "SELECT p.*, u.username, u.profile_image FROM posts p
            INNER JOIN users u ON p.user_id = u.user_id
            WHERE p.content LIKE :termino
            ORDER BY p.fecha_publicacion DESC";

    $stmt = $conn->prepare($sql);
    $termino = '%' . $termino . '%';
    $stmt->bindParam(':termino', $termino, PDO::PARAM_STR);
    $stmt->execute();

    return $stmt;
}
function cargarPublicaciones($conn) {
    $sql = "SELECT p.*, u.username, u.profile_image FROM posts p
            INNER JOIN users u ON p.user_id = u.user_id
            ORDER BY p.fecha_publicacion DESC";

    $stmt = $conn->prepare($sql);
    $stmt->execute();

    return $stmt;
}
?>