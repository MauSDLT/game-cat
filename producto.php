<?php
    require_once "includes/conexion.php";
    $id = (int) ($_GET['id'] ?? 0);

    $sql = "SELECT p.id, p.nombre, p.descripcion, p.precio, p.color, p.color_fondo, p.portada, p.fondo,
            d.nombre AS desarrollador
        FROM productos p
        JOIN desarrolladores d ON p.id_desarrollador = d.id
        WHERE p.id = $id";
    $resultado = mysqli_query($con, $sql);
    $juego = mysqli_fetch_assoc($resultado);

    $sqlFotos = "SELECT ruta FROM fotos_producto WHERE id_producto = $id ORDER BY orden";
    $fotos = mysqli_query($con, $sqlFotos);

    $sqlInfo = "SELECT p.plataforma, p.genero, p.clasificacion, p.anio, p.stock, d.pais
                FROM productos p
                JOIN desarrolladores d ON p.id_desarrollador = d.id
                WHERE p.id = $id;";
    $i = mysqli_query($con, $sqlInfo);
    $info = mysqli_fetch_assoc($i);

    
    $titulo = $juego['nombre'] ?? 'Juego no encontrado';
    include "includes/header.php";
?>



    <?php if (!$juego): ?>
        <div class="container py-4">
            <div class="alert alert-danger">
                <strong>Juego no encontrado. </strong><a href="index.php" class="alert-link">Regresar al catálogo</a>.
            </div>
        </div>
    <?php else: ?>
        <section class="producto-hero" style="background-image: url('<?= htmlspecialchars($juego['fondo']) ?>'); --color-juego: <?= htmlspecialchars($juego['color']) ?>;">
            <div class="container">
                <div class="row align-items-center">
                    <div class="col-md-3">
                        <img src="<?= htmlspecialchars($juego['portada']) ?>" class="img-fluid" alt="<?= htmlspecialchars($juego['nombre']) ?>">
                    </div>
                    <div class="col-md-9">
                        <h1 class="display-5"><?= htmlspecialchars($juego['nombre']) ?></h1>
                        <p><?= nl2br(htmlspecialchars($juego['descripcion'])) ?></p>
                        <p class="text-white-50">Desarrollador: <?= htmlspecialchars($juego['desarrollador']) ?></p>
                        <div class="d-flex align-items-center gap-3 mt-4">
                            <span class="tarjeta-precio fs-3">$<?= number_format($juego['precio'],2) ?></span>
                            <a href="" class="btn btn-comprar btn-lg">Agregar al carrito</a>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <div class="container py-5">
            <div class="row g-4">
                <div class="col-lg-8">
                    <div id="carruselJuego" class="carousel slide" data-bs-ride="carousel">
                        <div class="carousel-inner rounded">
                            <?php $primera = true; ?>
                            <?php while ($foto = mysqli_fetch_assoc($fotos)): ?>
                                <div class="carousel-item <?= $primera ? 'active' : '' ?>">
                                    <div class="ratio ratio-16x9">
                                        <img src="<?= htmlspecialchars($foto['ruta']) ?>"
                                            class="object-fit-cover"
                                            alt="Captura de <?= htmlspecialchars($juego['nombre']) ?>">
                                    </div>
                                </div>
                                <?php $primera = false; ?>
                            <?php endwhile; ?>
                        </div>

                        <button class="carousel-control-prev" type="button" data-bs-target="#carruselJuego" data-bs-slide="prev">
                            <span class="carousel-control-prev-icon"></span>
                        </button>

                        <button class="carousel-control-next" type="button" data-bs-target="#carruselJuego" data-bs-slide="next">
                            <span class="carousel-control-next-icon"></span>
                        </button>
                    </div>
                </div>

                <div class="col-lg-4">
                    <h2 class="h4 mb-3">Ficha técnica</h2>
                    <ul class="list-group">
                        <li class="list-group-item d-flex justify-content-between gap-5 text-end">
                            <span class="text-body-secondary">Plataformas</span>
                            <span><?= htmlspecialchars($info['plataforma']) ?></span>
                        </li>
                        <li class="list-group-item d-flex justify-content-between">
                            <span class="text-body-secondary">Género</span>
                            <span><?= htmlspecialchars($info['genero']) ?></span>
                        </li>
                        <li class="list-group-item d-flex justify-content-between">
                            <span class="text-body-secondary">Clasificación</span>
                            <span><?= htmlspecialchars($info['clasificacion']) ?></span>
                        </li>
                        <li class="list-group-item d-flex justify-content-between">
                            <span class="text-body-secondary">Año de lanzamiento</span>
                            <span><?= htmlspecialchars($info['anio']) ?></span>
                        </li>
                        <li class="list-group-item d-flex justify-content-between">
                            <span class="text-body-secondary">Copias restantes</span>
                            <span><?= htmlspecialchars($info['stock']) ?></span>
                        </li>
                        
                    </ul>
                </div>

            </div>
        </div>
    <?php endif ?>


<?php include "includes/footer.php"; ?>