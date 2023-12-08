<?php
session_start();
require_once "context.php";
require_once "crearProducto.php";
if (!isset($_SESSION['user_id'])) {
  header("Location: login.php");
  exit;
}
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  $user_id = $_SESSION['user_id'];
  $product_name = $_POST['product_name'];
  $description = $_POST['description'];
  $price = $_POST['price'];
  $category = $_POST['category'];
  $image = addslashes(file_get_contents($_FILES['image']['tmp_name']));
  
  if (empty($product_name) || empty($price) || empty($category)) {
    echo "Por favor, completa todos los campos obligatorios.";
    exit();
  }
  
  $fecha_publicacion = date('Y-m-d H:i:s');
  
  $sql = "INSERT INTO products (user_id, product_name, description, price, category, fecha_publicacion, image) 
          VALUES (:user_id, :product_name, :description, :price, :category, :fecha_publicacion, :image)";
  $stmt = $conn->prepare($sql);
  $stmt->bindValue(':user_id', $user_id);
  $stmt->bindValue(':product_name', $product_name);
  $stmt->bindValue(':description', $description);
  $stmt->bindValue(':price', $price);
  $stmt->bindValue(':category', $category);
  $stmt->bindValue(':fecha_publicacion', $fecha_publicacion);
  $stmt->bindValue(':image', $image);
  $stmt->execute();

  exit();
}
?>