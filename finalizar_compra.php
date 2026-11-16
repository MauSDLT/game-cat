<?php
session_start();

if (!isset($_SESSION['usuario_id'])) {
    header("Location: login.php");
    exit;
}

require_once "includes/conexion.php";

$idUsuario = $_SESSION['usuario_id'];

$sql = "SELECT c.id_producto, c.cantidad, p.nombre, p.precio, p.stock
        FROM carrito c
        JOIN productos p ON c.id_producto = p.id
        WHERE c.id_usuario = $idUsuario";
$resultado = mysqli_query($con, $sql);

$items = [];
$error = "";

while ($item = mysqli_fetch_assoc($resultado)) {
    if($item['cantidad'] > $item['stock']){
        $error = "No hay suficientes copias de " . $item['nombre'] . ". Disponibles: " . $item['stock'] . ".";
    }
    $items[] = $item;
}
if (empty($items)) {
    $error = "Tu carrito está vacío.";
}

if ($error === "") {
    mysqli_begin_transaction($con);

    foreach ($items as $item) {
        $idProducto = $item['id_producto'];
        $cantidad   = $item['cantidad'];
        $precio     = $item['precio'];

        $insert = "INSERT INTO historial (id_usuario, id_producto, cantidad, precio)
                    VALUES ($idUsuario, $idProducto, $cantidad, $precio);";
        mysqli_query($con, $insert);

        $stock = "UPDATE productos SET stock = stock - $cantidad WHERE id = $idProducto;";
        mysqli_query($con, $stock);
    }

    $carrito = "DELETE FROM carrito WHERE id_usuario = $idUsuario;";
    mysqli_query($con, $carrito);

    mysqli_commit($con);
    $_SESSION['mensaje_compra'] = "¡Compra realizada con éxito!";
}else {
    $_SESSION['mensaje_compra'] = $error;
}

header("Location: carrito.php");
exit;