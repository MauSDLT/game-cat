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

header("Location: carrito.php");

