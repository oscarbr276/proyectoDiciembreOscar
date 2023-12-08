<?php

require_once "context.php";

$sql = "SELECT products.*, users.username, users.profile_image FROM products JOIN users ON products.user_id = users.user_id ORDER BY products.fecha_publicacion DESC";

$result = $conn->query($sql);
function buscarProductos($nombre, $minPrecio, $maxPrecio, $categoria) {
    global $conn;

    $query = "SELECT p.*, u.username, u.profile_image FROM products p
              INNER JOIN users u ON p.user_id = u.user_id
              WHERE 1";

    if (!empty($nombre)) {
        $query .= " AND p.product_name LIKE :nombre";
        $nombreParam = '%' . $nombre . '%';
    }
    if (!empty($minPrecio)) {
        $query .= " AND p.price >= :minPrecio";
        $minPrecioParam = $minPrecio;
    }
    if (!empty($maxPrecio)) {
        $query .= " AND p.price <= :maxPrecio";
        $maxPrecioParam = $maxPrecio;
    }
    if (!empty($categoria)) {
        $query .= " AND p.category LIKE :categoria";
        $categoriaParam = '%' . $categoria . '%';
    }

    $query .= " ORDER BY p.fecha_publicacion DESC";

    $stmt = $conn->prepare($query);

    if (!empty($nombre)) {
        $stmt->bindParam(':nombre', $nombreParam, PDO::PARAM_STR);
    }
    if (!empty($minPrecio)) {
        $stmt->bindParam(':minPrecio', $minPrecioParam, PDO::PARAM_INT);
    }
    if (!empty($maxPrecio)) {
        $stmt->bindParam(':maxPrecio', $maxPrecioParam, PDO::PARAM_INT);
    }
    if (!empty($categoria)) {
        $stmt->bindParam(':categoria', $categoriaParam, PDO::PARAM_STR);
    }

    $stmt->execute();

    return $stmt;
}
?>