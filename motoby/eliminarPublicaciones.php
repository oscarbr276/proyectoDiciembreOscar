<?php
require_once "context.php";

if(isset($_POST['delete_post'])) {
    $post_id = $_POST['post_id'];
    try {
        $sql = "DELETE FROM publicaciones WHERE post_id = :post_id";
        $stmt = $conn->prepare($sql);
        $stmt->bindParam(':post_id', $post_id, PDO::PARAM_INT);
        $stmt->execute();
        header("Location: index.php");
        exit();
    } catch(PDOException $e) {
        echo "Error al eliminar la publicación: " . $e->getMessage();
    }
}
?>