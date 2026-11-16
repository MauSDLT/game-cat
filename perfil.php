<?php
session_start();

if (!isset($_SESSION['usuario_id'])) {
    header("Location: login.php");
    exit;
}
require_once "includes/conexion.php";

$idUsuario = $_SESSION['usuario_id'];
$sql = "SELECT nombre, correo, nacimiento, tarjeta, direccion FROM usuarios WHERE id = $idUsuario";
$resultado = mysqli_query($con, $sql);
$usuario = mysqli_fetch_assoc($resultado);

$digitos = preg_replace('/\D/', '', $usuario['tarjeta']);
$tarjetaOculta = "**** **** **** " . substr($digitos, -4);

$sqlCompras = "SELECT h.fecha, p.id AS id_producto, p.nombre, p.portada, h.cantidad, h.precio
                FROM historial h
                JOIN productos p ON h.id_producto = p.id
                WHERE h.id_usuario = $idUsuario
                ORDER BY h.fecha DESC";
$compras = mysqli_query($con, $sqlCompras);

$sqlFavoritos = "SELECT p.id, p.nombre, p.portada
                FROM favoritos f
                JOIN productos p ON f.id_producto = p.id
                WHERE f.id_usuario = $idUsuario
                ORDER BY f.id
                LIMIT 4";
$favoritos = mysqli_query($con, $sqlFavoritos);

$titulo = "Perfil";
include "includes/header.php";
?>

<div class="container py-4">
    <div class="row justify-content-center">
        <div class="col-md-8 col-lg-6">
            <h1>Perfil</h1>
            <div class="card">
                <div class="card-header">
                    <h2 class="h4 mb-0"><?= htmlspecialchars($usuario['nombre']) ?></h2>
                </div>
                <ul class="list-group list-group-flush">
                    <li class="list-group-item d-flex justify-content-between gap-3">
                        <span class="text-body-secondary">Correo</span>
                        <span><?= htmlspecialchars($usuario['correo']) ?></span>
                    </li>
                    <li class="list-group-item d-flex justify-content-between gap-3">
                        <span class="text-body-secondary text-nowrap">Fecha de Nacimiento</span>
                        <span class="text-end"><?= date("d/m/Y", strtotime($usuario['nacimiento'])) ?></span>
                    </li>
                    <li class="list-group-item d-flex justify-content-between gap-3">
                        <span class="text-body-secondary">Tarjeta</span>
                        <span><?= htmlspecialchars($tarjetaOculta) ?></span>
                    </li>
                    <li class="list-group-item d-flex justify-content-between gap-3">
                        <span class="text-body-secondary text-nowrap">Dirección</span>
                        <span class="text-end"><?= nl2br(htmlspecialchars($usuario['direccion'])) ?></span>
                    </li>
                </ul>
                <div class="card-body">
                    <h3 class="h6 text-body-secondary mb-3">Juegos favoritos</h3>
                    <?php if (mysqli_num_rows($favoritos) === 0): ?>
                        <p class="text-body-secondary small mb-0">Aún no tienes favoritos. Márcalos con ♡ en la página de cada juego. <a href="index.php" style="color: #FFFFFF">Explora juegos.</a></p>
                    <?php endif; ?>
                    <div class="row g-2">
                        <?php while ($fav = mysqli_fetch_assoc($favoritos)): ?>
                            <div class="col-3">
                                <a href="producto.php?id=<?= $fav['id'] ?>" title="<?= htmlspecialchars($fav['nombre']) ?>">
                                    <div class="ratio" style="--bs-aspect-ratio: 150%;">
                                        <img src="<?= htmlspecialchars($fav['portada']) ?>"
                                            class="rounded object-fit-cover"
                                            alt="<?= htmlspecialchars($fav['nombre']) ?>">
                                    </div>
                                </a>
                            </div>
                        <?php endwhile; ?>
                    </div>
                </div>
            </div>

            <h2 class="h4 mt-5 mb-3">Mis compras</h2>
            <?php if (mysqli_num_rows($compras) === 0): ?>
                <div class="alert alert-info">
                    Aún no has comprado nada. <a href="index.php" class="alert-link">Explora el catálogo</a>.
                </div>
            <?php else: ?>
                <div class="table-responsive">
                    <table class="table align-middle">
                        <thead>
                            <tr>
                                <th>Fecha</th>
                                <th>Juego</th>
                                <th>Cantidad</th>
                                <th>Total</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php while ($compra = mysqli_fetch_assoc($compras)): ?>
                                <tr>
                                    <td><?= date("d/m/Y H:i", strtotime($compra['fecha'])) ?></td>
                                    <td>
                                        <a href="producto.php?id=<?= $compra['id_producto'] ?>"
                                        class="d-flex align-items-center gap-2 text-reset text-decoration-none">
                                            <img src="<?= htmlspecialchars($compra['portada']) ?>"
                                                class="rounded" width="40"
                                                alt="<?= htmlspecialchars($compra['nombre']) ?>">
                                            <span><?= htmlspecialchars($compra['nombre']) ?></span>
                                        </a>
                                    </td>
                                    <td><?= htmlspecialchars($compra['cantidad']) ?></td>
                                    <td>$<?= number_format($compra['precio'] * $compra['cantidad'], 2) ?></td>
                                </tr>
                            <?php endwhile; ?>
                        </tbody>
                    </table>
                </div>
            <?php endif; ?>
        </div>
    </div>
</div>

<?php include "includes/footer.php"; ?>