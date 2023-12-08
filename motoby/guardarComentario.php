<?php

require_once "context.php";
session_start();

if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}

require_once 'context.php';

$user_id = $_SESSION['user_id'];
$post_id = $_POST['post_id'];
$content = $_POST['content']; 

try {

    $insertar_comentario = "INSERT INTO comentarios (user_id, post_id, content, fecha_publicacion) VALUES (?, ?, ?, NOW())";
    $stmt = $conn->prepare($insertar_comentario);


    $stmt->bindParam(1, $user_id, PDO::PARAM_INT);
    $stmt->bindParam(2, $post_id, PDO::PARAM_INT);
    $stmt->bindParam(3, $content, PDO::PARAM_STR); 


    $stmt->execute();


    header("Location: index.php");
    exit();
} catch (PDOException $e) {
    echo "Error al guardar el comentario: " . $e->getMessage();
}

?>