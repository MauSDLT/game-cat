<?php
session_start();

if (!isset($_SESSION['usuario_id'])) {
    header("Location: login.php");
    exit;
}

require_once "includes/conexion.php";

$idUsuario = $_SESSION['usuario_id'];
$id = (int) ($_POST['id'] ?? 0);

$sql = "DELETE FROM carrito WHERE id = $id AND id_usuario = $idUsuario;";
mysqli_query($con, $sql);

header("Location: carrito.php");
exit;