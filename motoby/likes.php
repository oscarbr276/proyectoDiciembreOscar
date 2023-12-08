<?php

require_once "context.php";
$post_id = $_POST['post_id'];

$user_id = $_SESSION['user_id'];

$sql = "SELECT * FROM likes WHERE post_id = ? AND user_id = ?";
$stmt = $conn->prepare($sql);
$stmt->execute([$post_id, $user_id]);
$existing_like = $stmt->fetch(PDO::FETCH_ASSOC);


if ($_SERVER["REQUEST_METHOD"] == "POST") {
 

  $post_id = $_POST["post_id"];
  $accion = $_POST["accion"];

  if ($accion === "like") {

      $consulta = "SELECT COUNT(*) as count FROM likes WHERE user_id = $user_id AND post_id = $post_id";
      $resultado = $mysqli->query($consulta);
      $fila = $resultado->fetch_assoc();

      if ($fila["count"] == 0) {

          $insertar_like = "INSERT INTO likes (user_id, post_id) VALUES ($user_id, $post_id)";
          $mysqli->query($insertar_like);
          echo "liked";
      }
  } elseif ($accion === "unlike") {

      $consulta = "SELECT id FROM likes WHERE user_id = $user_id AND post_id = $post_id";
      $resultado = $mysqli->query($consulta);
      $fila = $resultado->fetch_assoc();

      if ($fila) {

          $id_like = $fila["id"];
          $eliminar_like = "DELETE FROM likes WHERE id = $id_like";
          $mysqli->query($eliminar_like);
          echo "unliked";
      }
  }
}


$mysqli->close();
?>


?>