<?php
session_start();

if (!isset($_SESSION['usuario_id'])) {
    header("Location: login.php");
    exit;
}

require_once "includes/conexion.php";

$idUsuario  = $_SESSION['usuario_id'];
$idProducto = (int) ($_POST['id_producto'] ?? 0);

$sql = "INSERT INTO carrito (id_usuario, id_producto, cantidad) VALUES ($idUsuario, $idProducto, 1)
        ON DUPLICATE KEY UPDATE cantidad = cantidad + 1;";
mysqli_query($con, $sql);
$res = mysqli_query($con, "SELECT stock FROM productos WHERE id = $idProducto");
$producto = mysqli_fetch_assoc($res);

if (!$producto || $producto['stock'] <= 0) {
    header("Location: producto.php?id=$idProducto");
    exit;
}

header("Location: carrito.php");

