<?php
session_start();

if (!isset($_SESSION['usuario_id'])) {
    header("Location: login.php");
    exit;
}

require_once "includes/conexion.php";

$idUsuario  = $_SESSION['usuario_id'];
$idProducto = (int) ($_POST['id_producto'] ?? 0);

$sql = "SELECT id FROM favoritos WHERE id_usuario = $idUsuario AND id_producto = $idProducto";
$yaEsFavorito = mysqli_num_rows(mysqli_query($con, $sql)) > 0;

if ($yaEsFavorito) {
    mysqli_query($con, "DELETE FROM favoritos WHERE id_usuario = $idUsuario AND id_producto = $idProducto");
} else {
    $res = mysqli_query($con, "SELECT COUNT(*) AS total FROM favoritos WHERE id_usuario = $idUsuario");
    $total = (int) mysqli_fetch_assoc($res)['total'];

    if ($total < 4) {
        mysqli_query($con, "INSERT INTO favoritos (id_usuario, id_producto) VALUES ($idUsuario, $idProducto)");
    } else {
        $_SESSION['mensaje_favorito'] = "Ya tienes 4 favoritos. Quita uno desde su página para agregar otro.";
    }
}

header("Location: producto.php?id=$idProducto");
exit;