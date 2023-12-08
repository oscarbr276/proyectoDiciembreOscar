<?php
require_once "context.php";
require_once "register.php";
    $full_name = $_POST['full_name'];
    $email = $_POST['email'];
    $username = $_POST['username'];
    $password = $_POST['password'];

    if (empty($full_name) || empty($email) || empty($username) || empty($password)) {
        echo 'Rellena todos los datos';
    } else {
        $checkQuery = "SELECT COUNT(*) as count FROM users WHERE username = '$username' or email = '$email'";
        $result = $conn->query($checkQuery);
        $row = $result->fetch(PDO::FETCH_ASSOC);
        $count = $row['count'];
    
        if ($count > 0) {
            echo 'El usuario ya existe';
        } else {
            $sql = "INSERT INTO users (full_name, email, password, username) VALUES ('$full_name', '$email', '$password', '$username' )";  
            if ($conn->query($sql) === TRUE) {
                echo 'Error al crear el usuario: ';
                
            } else {
                echo 'Usuario creado correctamente';
                header ("location:login.php");
            }
        }
    }
?>