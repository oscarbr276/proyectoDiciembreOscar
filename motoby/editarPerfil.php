<?php
session_start();
require_once "context.php";
require_once "config.php";
if (!isset($_SESSION['user_id'])) {
  header("Location: login.php");
  exit;
}
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  $user_id = $_SESSION['user_id'];
  $username = $_POST['username'];
  $full_name = $_POST['full_name'];
  $password = $_POST['password'];
  $profile_image = addslashes(file_get_contents($_FILES['profile_image']['tmp_name']));
  if (checkUsernameExists($username)) {
    echo "El nombre de usuario ya está en uso. Por favor, elija otro nombre.";
    exit();
  }


  $sql = "UPDATE users SET username = :username, full_name = :full_name, password = :password, profile_image = :profile_image WHERE user_id = :user_id";
  $stmt = $conn->prepare($sql);
  $stmt->bindValue(':username', $username);
  $stmt->bindValue(':full_name', $full_name);
  $stmt->bindValue(':password', $password);
  $stmt->bindValue(':user_id', $user_id);
  $stmt->bindValue(':profile_image', $profile_image);
  $stmt->execute();

  exit();
}

function checkUsernameExists($username) {
  global $conn;

  $sql = "SELECT COUNT(*) FROM users WHERE username = :username";
  $stmt = $conn->prepare($sql);
  $stmt->bindValue(':username', $username);
  $stmt->execute();
  $count = $stmt->fetchColumn();

  return $count > 0;
}
?>