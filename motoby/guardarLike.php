<?php
require_once 'context.php';

if (isset($_POST['user_id']) && isset($_POST['post_id'])) {
  $user_id = $_POST['user_id'];
  $post_id = $_POST['post_id'];

  try {
    $sql = 'INSERT INTO likes (user_id, post_id) VALUES (:user_id, :post_id)';
    $stmt = $conn->prepare($sql);
    $stmt->bindParam(':user_id', $user_id, PDO::PARAM_INT);
    $stmt->bindParam(':post_id', $post_id, PDO::PARAM_INT);

    $stmt->execute();

  } catch (PDOException $e) {

    if ($e->getCode() == '23000' && $e->errorInfo[1] == 1062) { 
    } else {

    }
  }
} else {
  $response = [
    'success' => false,
    'message' => 'Faltan parámetros requeridos'
  ];
}

header('index.php');

?>