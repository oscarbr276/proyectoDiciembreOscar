<?php
require_once "editarProducto.php";
require_once "context.php";

$product_id = $_GET['product_id'];
$product_name = $_POST['product_name'];
$description = $_POST['description'];
$price = $_POST['price'];
$category = $_POST['category'];

$stmt = $conn->prepare("UPDATE products SET product_name = $product_name , description = $description , price = $price , category = $category   WHERE product_id = $product_id ");
$stmt->execute([$product_name, $description, $price, $category]);

?>