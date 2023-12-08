<?php
$post_id = $_POST['post_id'];

require_once "context.php";

$sql = "DELETE FROM posts WHERE post_id = :post_id";
$stmt = $conn->prepare($sql);
$stmt->bindValue(':post_id', $post_id);

if ($stmt->execute()) {

  $response = ['success' => true];
} else {
  $response = ['success' => false];
}

echo json_encode($response);
?>