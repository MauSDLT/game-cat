<?php
    require_once "includes/conexion.php";

    $sql = "SELECT p.id, p.nombre, p.descripcion, p.precio, p.color, p.color_fondo, p.portada, p.fondo,
            d.nombre AS desarrollador
        FROM productos p
        JOIN desarrolladores d ON p.id_desarrollador = d.id
        ORDER BY p.nombre";

    $resultado = mysqli_query($con, $sql);

    $titulo = "Catálogo";
    include "includes/header.php";
?>
<div class="container py-4">
    <h1>Catálogo</h1>

    <div class="row g-4">
        <?php while ($row = mysqli_fetch_assoc($resultado)): ?>
            <div class="col-sm-6 col-lg-3">
                <div class="card h-100 tarjeta-juego" style="--color-juego: <?= htmlspecialchars($row['color']) ?>;
                                                                <?php if ($row['color_fondo']): ?>--color-fondo: <?= htmlspecialchars($row['color_fondo']) ?>;<?php endif; ?>">
                    <a href="producto.php?id=<?= $row['id'] ?>">
                        <div class="tarjeta-arte" style="background-image: url('<?= htmlspecialchars($row['fondo']) ?>');">
                            <img src="<?= htmlspecialchars($row['portada']) ?>"
                                class="tarjeta-portada"
                                alt="<?= htmlspecialchars($row['nombre']) ?>">
                        </div>
                    </a>
                    <div class="card-body d-flex flex-column">
                        <h2 class="h5"><?= htmlspecialchars($row['nombre']) ?></h2>
                        <p class="tarjeta-descripcion"><?= htmlspecialchars($row['descripcion']) ?></p>
                        <div class="d-flex justify-content-between align-items-center mt-auto">
                            <span class="tarjeta-precio">$<?= number_format($row['precio'], 2) ?></span>
                            <a href="producto.php?id=<?= $row['id'] ?>" class="btn btn-comprar">Comprar</a>
                        </div>
                    </div>
                </div>
            </div>
        <?php endwhile; ?>
    </div>
</div>

<?php include "includes/footer.php"; ?>