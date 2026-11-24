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
        <h3 class="h5"><a href="producto.php?id=<?= $row['id'] ?>" class="text-reset text-decoration-none"><?= htmlspecialchars($row['nombre']) ?></a></h3>
        <p class="tarjeta-descripcion"><?= htmlspecialchars($row['descripcion']) ?></p>
        <p class="text-white-50"><?= htmlspecialchars($row['desarrollador']) ?></p>
        <div class="d-flex justify-content-between align-items-center mt-auto">
            <span class="tarjeta-precio">$<?= number_format($row['precio'], 2) ?></span>
            <a href="producto.php?id=<?= $row['id'] ?>" class="btn btn-comprar">Comprar</a>
        </div>
    </div>
</div>