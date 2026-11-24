<?php
    session_start();
    require_once "includes/conexion.php";
    $id = (int) ($_GET['id'] ?? 0);

    $sql = "SELECT p.id, p.nombre, p.descripcion, p.precio, p.color, p.color_fondo, p.portada, p.fondo,
            d.nombre AS desarrollador, p.plataforma, p.genero, p.clasificacion, p.anio, p.stock, d.pais, p.trailer
        FROM productos p
        JOIN desarrolladores d ON p.id_desarrollador = d.id
        WHERE p.id = $id";
    $resultado = mysqli_query($con, $sql);
    $juego = mysqli_fetch_assoc($resultado);

    $sqlFotos = "SELECT ruta FROM fotos_producto WHERE id_producto = $id ORDER BY orden";
    $fotos = mysqli_query($con, $sqlFotos);

    $esFavorito = false;
    if (isset($_SESSION['usuario_id'])) {
        $idUsuario = $_SESSION['usuario_id'];
        $sqlFav = "SELECT id FROM favoritos WHERE id_usuario = $idUsuario AND id_producto = $id";
        $esFavorito = mysqli_num_rows(mysqli_query($con, $sqlFav)) > 0;
    }

    
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
                            <form action="agregar_carrito.php" method="post" class="d-inline">
                                <input type="hidden" name="id_producto" value="<?= $juego['id'] ?>">
                                <button type="submit" class="btn btn-comprar btn-lg" <?= $juego['stock'] <= 0 ? 'disabled' : '' ?>>
                                    <?= $juego['stock'] > 0 ? 'Agregar al carrito' : 'Agotado' ?>
                                </button>
                            </form>
                            <?php if (isset($_SESSION['mensaje_favorito'])): ?>
                                <div class="alert alert-warning"><?= htmlspecialchars($_SESSION['mensaje_favorito']) ?></div>
                                <?php unset($_SESSION['mensaje_favorito']); ?>
                            <?php endif; ?>
                            <form action="favorito.php" method="post" class="d-inline">
                                <input type="hidden" name="id_producto" value="<?= $juego['id'] ?>">
                                <button type="submit" class="btn btn-lg btn-favorito <?= $esFavorito ? 'activo' : '' ?>"
                                        title="<?= $esFavorito ? 'Quitar de favoritos' : 'Agregar a favoritos' ?>">
                                    <?= $esFavorito ? '♥' : '♡' ?>
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <div class="container py-5">
            <div class="row g-4">
                <div class="col-lg-8">
                    <h2 class="h4 mb-3">Capturas de Pantalla</h2>
                    <div id="carruselJuego" class="carousel slide" data-bs-ride="carousel">
                        <div class="carousel-inner rounded">
                            <?php $primera = true; ?>
                            <?php while ($foto = mysqli_fetch_assoc($fotos)): ?>
                                <div class="carousel-item <?= $primera ? 'active' : '' ?>">
                                    <div class="ratio ratio-16x9 bg-black">
                                        <img src="<?= htmlspecialchars($foto['ruta']) ?>"
                                            class="object-fit-contain"
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
                    <?php if (!empty($juego['trailer'])): ?>
                        <h2 class="h4 mt-4 mb-3">Tráiler</h2>
                        <div class="ratio ratio-16x9">
                            <iframe src="https://www.youtube.com/embed/<?= htmlspecialchars($juego['trailer']) ?>"
                                title="Tráiler de <?= htmlspecialchars($juego['nombre']) ?>"
                                allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share; fullscreen"
                                referrerpolicy="strict-origin-when-cross-origin"
                                allowfullscreen>
                            </iframe>
                        </div>
                    <?php endif; ?>
                </div>

                <div class="col-lg-4">
                    <h2 class="h4 mb-3">Ficha técnica</h2>
                    <ul class="list-group">
                        <li class="list-group-item d-flex justify-content-between gap-5 text-end">
                            <span class="text-body-secondary text-nowrap">Plataformas</span>
                            <span><?= htmlspecialchars($juego['plataforma'] ?? '—') ?></span>
                        </li>
                        <li class="list-group-item d-flex justify-content-between gap-5 text-end">
                            <span class="text-body-secondary text-nowrap">País de desarrollo</span>
                            <span><?= htmlspecialchars($juego['pais']) ?></span>
                        </li>
                        <li class="list-group-item d-flex justify-content-between gap-5 text-end">
                            <span class="text-body-secondary text-nowrap">Género</span>
                            <span><?= htmlspecialchars($juego['genero'] ?? '—') ?></span>
                        </li>
                        <li class="list-group-item d-flex justify-content-between gap-5 text-end">
                            <span class="text-body-secondary text-nowrap">Clasificación</span>
                            <span><?= htmlspecialchars($juego['clasificacion'] ?? '—') ?></span>
                        </li>
                        <li class="list-group-item d-flex justify-content-between gap-5 text-end">
                            <span class="text-body-secondary text-nowrap">Año de lanzamiento</span>
                            <span><?= htmlspecialchars($juego['anio'] ?? '—') ?></span>
                        </li>
                        <li class="list-group-item d-flex justify-content-between gap-5 text-end">
                            <span class="text-body-secondary text-nowrap">Disponibilidad</span>
                            <span><?= $juego['stock'] > 0 ? 'Disponible' : 'Agotado' ?></span>
                        </li>
                        
                    </ul>
                </div>

            </div>
        </div>
    <?php endif ?>


<?php include "includes/footer.php"; ?>