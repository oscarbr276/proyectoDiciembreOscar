<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['post_id'])) {

  $postId = $_POST['post_id'];
  include 'context.php';

  try {

    $stmt = $conn->prepare("DELETE FROM posts WHERE post_id = :post_id");

    $stmt->bindParam(":post_id", $postId);
    $stmt->execute();

    if ($stmt->rowCount() > 0) {
      header("Location: index.php");
      exit();
    } else {
      echo "Error al eliminar la publicación";
    }
  } catch (PDOException $e) {
    echo "Error en la consulta: " . $e->getMessage();
  }
}
?>