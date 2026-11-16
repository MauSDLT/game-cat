<?php
session_start();

if (!isset($_SESSION['usuario_id'])) {
    header("Location: login.php");
    exit;
}

require_once "includes/conexion.php";
$idUsuario = $_SESSION['usuario_id'];

$sql = "SELECT c.id, c.cantidad, p.id AS id_producto, p.nombre, p.precio, p.portada
        FROM carrito c
        JOIN productos p ON c.id_producto = p.id
        WHERE c.id_usuario = $idUsuario";
$resultado = mysqli_query($con, $sql);

$titulo = "Carrito";
include "includes/header.php";
?>

<div class="container py-4">
    <h1>Carrito</h1>
    <?php if (isset($_SESSION['mensaje_compra'])): ?>
        <div class="alert alert-info"><?= htmlspecialchars($_SESSION['mensaje_compra']) ?></div>
        <?php unset($_SESSION['mensaje_compra']); ?>
    <?php endif; ?>
    <?php if(mysqli_num_rows($resultado) == 0): ?>
        <div class="alert alert-info">
            <strong>Tu carrito está vacío.</strong> <a href="index.php" class="alert-link">Explora el catálogo</a>.
        </div>

    <?php else: ?>
        <div class="table-responsive">
            <table class="table align-middle">
                <thead>
                    <tr>
                        <th></th>
                        <th>Juego</th>
                        <th>Precio</th>
                        <th>Cantidad</th>
                        <th>Subtotal</th>
                        <th></th>
                    </tr>
                </thead>
                <tbody>
                    <?php $total = 0; ?>
                    <?php while($row = mysqli_fetch_array($resultado)): ?>
                            <tr>
                                <td><img src="<?= htmlspecialchars($row['portada']) ?>" class="rounded"
                                    alt="<?= htmlspecialchars($row['nombre']) ?>" width=80></td>
                                <td><?= htmlspecialchars($row['nombre']) ?></td>
                                <td>$<?= number_format($row['precio'],2) ?></td>
                                <td><form action="actualizar_carrito.php" method="post">
                                        <input type="hidden" name="id" value="<?= $row['id'] ?>">
                                        <div class="btn-group btn-group-sm">
                                            <button type="submit" name="accion" value="restar" class="btn btn-outline-light btn-info"
                                                    <?= $row['cantidad'] <= 1 ? 'disabled' : '' ?>>−</button>
                                            <span class="btn btn-outline-light"><?= $row['cantidad'] ?></span>
                                            <button type="submit" name="accion" value="sumar" class="btn btn-outline-light btn-info">+</button>
                                        </div>
                                    </form>
                                </td>

                                <?php $subtotal = $row['precio'] * $row['cantidad']; ?>
                                <td>$<?= number_format($subtotal, 2) ?></td>
                                <?php $total += $subtotal; ?>
                                <td>
                                    <form action="eliminar_carrito.php" method="post">
                                        <input type="hidden" name="id" value="<?= $row['id'] ?>">
                                        <button type="submit" class="btn btn-sm btn-outline-danger">Eliminar</button>
                                    </form>
                                </td>
                            </tr>
                    <?php endwhile; ?>
                    <tr>
                        <td colspan="5" class="text-end fw-bold">Total</td>
                        <td class="fw-bold">$<?= number_format($total, 2) ?></td>
                    </tr>
                </tbody>
            </table>
            <form action="finalizar_compra.php" method="post" class="text-end">
                <button type="submit" class="btn btn-success btn-lg">Finalizar compra</button>
            </form>
        </div>
    <?php endif; ?>

    
</div>

<?php include "includes/footer.php"; ?>