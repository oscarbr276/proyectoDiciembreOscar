<?php
require_once('context.php');

$product_id = $_GET['product_id'];

$stmt = $conn->prepare('SELECT * FROM productos WHERE product_id = :product_id');
$stmt->bindParam(':product_id', $product_id);
$stmt->execute();
$product = $stmt->fetch(PDO::FETCH_ASSOC);

if (!$product) {
    echo 'El producto no existe.';
    exit;
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    $stmt = $conn->prepare('DELETE FROM productos WHERE product_id = :product_id');
    $stmt->bindParam(':product_id', $product_id);
    $stmt->execute();

    header('Location: productos.php');
    exit;
}
?>