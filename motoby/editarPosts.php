<?php
require_once "context.php";
require_once "verEditarPosts.php";
$content = $_POST['content'];

if (isset($_SESSION['user_id'])) {
  if ($_POST['content']) {
    $content = $_POST['content'];
    try {
        $stmt_update = $conn->prepare("UPDATE posts SET content = :content WHERE post_id = '".$_REQUEST["post_id"]."' ");
        $stmt_update->bindParam(':content', $content);
        $stmt_update->execute();

        echo "El post ha sido modificado correctamente.";
      
    } catch (PDOException $e) {
      echo "Error al conectar con la base de datos: " . $e->getMessage();
    }
  } else {
    echo "No se recibieron los datos necesarios para modificar el post.";
  }
} else {
  echo "No hay sesión iniciada.";
}


?>