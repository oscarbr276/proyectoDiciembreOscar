<?php

$product_id = $_POST['product_id'];

require_once "context.php";

$sql = "DELETE FROM products WHERE product_id = :product_id";
$stmt = $conn->prepare($sql);
$stmt->bindValue(':product_id', $product_id);

if ($stmt->execute()) {

  $response = ['success' => true];
} else {

  $response = ['success' => false];
}

echo json_encode($response);
?>