<?php
session_start();

if (empty($_SESSION['usuario_admin'])) {
    header("Location: index.php");
    exit;
}

require_once "includes/conexion.php";

$sql = "SELECT p.id, p.nombre, p.precio, p.stock, p.portada,
            d.nombre AS desarrollador
        FROM productos p
        JOIN desarrolladores d ON p.id_desarrollador = d.id
        ORDER BY p.nombre;";
$resultado = mysqli_query($con, $sql);

$h = "SELECT h.fecha, u.nombre AS usuario, p.nombre AS juego, h.cantidad, h.precio
            FROM historial h
            JOIN usuarios u ON h.id_usuario = u.id
            JOIN productos p ON h.id_producto = p.id
            ORDER BY h.fecha DESC";
$historial = mysqli_query($con, $h);

$titulo = "Administración";
include "includes/header.php";
?>

<div class="container py-4">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h1 class="mb-0">Inventario</h1>
        <a href="admin_producto.php" class="btn btn-success">Agregar juego</a>
    </div>

    <div class="table-responsive">
        <table class="table align-middle">
            <thead>
                <tr>
                    <th></th>
                    <th>Juego</th>
                    <th>Desarrollador</th>
                    <th>Precio</th>
                    <th>Stock</th>
                    <th></th>
                </tr>
            </thead>
            <tbody>
                <?php while ($row = mysqli_fetch_assoc($resultado)): ?>
                    <tr>
                        <td><img src="<?= htmlspecialchars($row['portada']) ?>" class="rounded"
                            alt="<?= htmlspecialchars($row['nombre']) ?>" width=80></td>
                            <td><?= htmlspecialchars($row['nombre']) ?></td>
                        <td><?= htmlspecialchars($row['desarrollador']) ?></td>
                        <td>$<?= number_format($row['precio'],2) ?></td>
                        <td class="<?= $row['stock'] < 5 ? 'text-danger fw-bold' : '' ?>"><?= $row['stock'] ?></td>
                    </tr>
                <?php endwhile; ?>
            </tbody>
        </table>

        <h2 class="mt-5">Historial de compras</h2>
        <table class="table align-middle">
            <thead>
                <th>Fecha</th>
                <th>Usuario</th>
                <th>Juego</th>
                <th>Cantidad</th>
                <th>Precio</th>
                <th>Total</th>
            </thead>
            <tbody>
                <?php while($row = mysqli_fetch_array($historial)): ?>
                    <tr>
                        <td><?= date("d/m/Y H:i", strtotime($row['fecha'])) ?></td>
                        <td><?= htmlspecialchars($row['usuario']) ?></td>
                        <td><?= htmlspecialchars($row['juego']) ?></td>
                        <td><?= htmlspecialchars($row['cantidad']) ?></td>
                        <td>$<?= number_format($row['precio'], 2) ?></td>
                        <td>$<?= number_format($row['precio'] * $row['cantidad'], 2) ?></td>
                        
                    </tr>
                <?php endwhile; ?>
            </tbody>
        </table>
    </div>
</div>

<?php include "includes/footer.php"; ?>