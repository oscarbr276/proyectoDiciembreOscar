<?php
session_start();
require_once "context.php";
require_once "crearPost.php";
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit;
}
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $user_id = $_SESSION['user_id'];
    $content = $_POST['content'];
    $date = date("Y-m-d H:i:s");
    $sql = "INSERT INTO posts (user_id, content, fecha_publicacion) VALUES ('$user_id', '$content', '$date')";
    $result = $conn->query($sql);
    if ($result) {
        echo "La publicación se creó correctamente.";  
        exit;
    } else {
        echo "Error al crear la publicación.";
    }
}
?>
<script>
  document.getElementById("myForm").addEventListener("submit", function(event) {
    event.preventDefault(); 

    var contenido = document.getElementById("contenido").value;
    if (contenido.trim() !== "") {
      window.location.href = "index.php";
    }
  });
</script>