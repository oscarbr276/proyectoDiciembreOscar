<?php
$nombreServidor = "localhost";
$nombreUsuario = "root";
$contrasena = "root";
$nombreBaseDatos = "motoby";

try {
    $dsn = "mysql:host=$nombreServidor;dbname=$nombreBaseDatos";
    $conn = new PDO($dsn, $nombreUsuario, $contrasena);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    echo "Error en la conexión: " . $e->getMessage();
}

?>