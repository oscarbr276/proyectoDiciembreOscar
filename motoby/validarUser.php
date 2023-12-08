<?php
session_start();
require_once "login.php";
require_once "context.php"; 

$username = $_POST['username'];
$password = $_POST['password'];

$_SESSION['username'] = $username;

$sql=$conn->query("SELECT * FROM users WHERE username = '$username' and password = '$password' ");

    if (empty($username) and empty($password)) {
        echo 'Rellena todos los campos';
    } else if ($datos=$sql->fetchObject()) {
        $_SESSION["user_id"]=$datos->user_id;
        header ("location:index.php");
        
     } else {
         echo "Datos erroneos";
     }
?>