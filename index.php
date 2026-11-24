<?php
    require_once "includes/conexion.php";

    // Consulta base para las tarjetas
    $base = "SELECT p.id, p.nombre, p.descripcion, p.precio, p.color, p.color_fondo,
                    p.portada, p.fondo, d.nombre AS desarrollador
            FROM productos p
            JOIN desarrolladores d ON p.id_desarrollador = d.id";

    // Carrusel
    $destacados = mysqli_query($con,
        "SELECT id, nombre, fondo, color
        FROM productos
        WHERE fondo IS NOT NULL AND fondo <> ''
        ORDER BY RAND()
        LIMIT 5");

    // Filas
    $novedades  = mysqli_query($con, "$base ORDER BY p.anio DESC, p.nombre LIMIT 10");
    $top        = mysqli_query($con, "$base JOIN historial h ON h.id_producto = p.id
                                        GROUP BY p.id, d.nombre
                                        ORDER BY SUM(h.cantidad) DESC LIMIT 10");
    $nuevo      = mysqli_query($con, "$base ORDER BY RAND() LIMIT 10");
    $economicos = mysqli_query($con, "$base WHERE p.precio < 500 ORDER BY p.precio LIMIT 10");
    $ultimas    = mysqli_query($con, "$base WHERE p.stock BETWEEN 1 AND 5 ORDER BY p.stock LIMIT 10");

    // Filtros
    $condiciones = [];

    $q = trim($_GET['q'] ?? '');
    if ($q !== '') {
        $qEsc = mysqli_real_escape_string($con, $q);
        $condiciones[] = "p.nombre LIKE '%$qEsc%'";
    }

    // géneros: debe cumplir todos los marcados
    $generosSel = (array) ($_GET['genero'] ?? []);
    foreach ($generosSel as $g) {
        $gEsc = mysqli_real_escape_string($con, $g);
        $condiciones[] = "FIND_IN_SET('$gEsc', REPLACE(p.genero, ', ', ','))";
    }

    // desarrolladores: cualquiera de los marcados
    $devsSel = array_map('intval', (array) ($_GET['dev'] ?? []));
    if ($devsSel) {
        $condiciones[] = "p.id_desarrollador IN (" . implode(",", $devsSel) . ")";
    }

    // orden con lista blanca
    $ordenes = [
        'nombre'      => 'p.nombre',
        'precio_asc'  => 'p.precio ASC',
        'precio_desc' => 'p.precio DESC',
        'nuevos'      => 'p.anio DESC, p.nombre',
    ];
    $ordenSel = $_GET['orden'] ?? 'nombre';
    $orden = $ordenes[$ordenSel] ?? 'p.nombre';

    $where = $condiciones ? "WHERE " . implode(" AND ", $condiciones) : "";
    $resultado = mysqli_query($con, "$base $where ORDER BY $orden");
    $hayFiltros = !empty($condiciones);

    // Opciones de los checkbox
    $generos = [];
    $resG = mysqli_query($con, "SELECT genero FROM productos");
    while ($fila = mysqli_fetch_assoc($resG)) {
        foreach (explode(",", $fila['genero']) as $g) {
            $generos[] = trim($g);
        }
    }
    $generos = array_unique($generos);
    sort($generos);

    $desarrolladores = mysqli_query($con, "SELECT id, nombre FROM desarrolladores ORDER BY nombre");

    // Fila horizontal de tarjetas
    function fila($titulo, $resultado) {
        if (mysqli_num_rows($resultado) === 0) return;
        ?>
        <section class="mb-4">
            <h2 class="h4 mb-3 mt-4"><?= htmlspecialchars($titulo) ?></h2>
            <div class="fila-juegos">
                <?php while ($row = mysqli_fetch_assoc($resultado)): ?>
                    <div class="fila-item"><?php include "includes/tarjeta.php"; ?></div>
                <?php endwhile; ?>
            </div>
        </section>
        <?php
    }

    include "includes/header.php";
?>
<div class="container py-4">

    <?php if (!$hayFiltros): ?>

        <!-- Carrusel -->
        <?php if (mysqli_num_rows($destacados) > 0): ?>
        <div id="carruselDestacados" class="carousel slide carousel-fade mb-4 rounded-4 overflow-hidden" data-bs-ride="carousel">

            <div class="carousel-indicators">
                <?php $total = mysqli_num_rows($destacados); ?>
                <?php for ($i = 0; $i < $total; $i++): ?>
                    <button type="button" data-bs-target="#carruselDestacados" data-bs-slide-to="<?= $i ?>"
                            class="<?= $i === 0 ? 'active' : '' ?>" aria-label="Juego <?= $i + 1 ?>"></button>
                <?php endfor; ?>
            </div>

            <p class="carrusel-titulo">Descubre la belleza de nuestros juegos</p>

            <div class="carousel-inner">
                <?php $i = 0; while ($juego = mysqli_fetch_assoc($destacados)): ?>
                    <div class="carousel-item destacado <?= $i === 0 ? 'active' : '' ?>"
                            style="--color-juego: <?= htmlspecialchars($juego['color']) ?>"
                            data-bs-interval="6000">
                        <a href="producto.php?id=<?= $juego['id'] ?>"><img src="<?= htmlspecialchars($juego['fondo']) ?>" class="d-block w-100" alt="<?= htmlspecialchars($juego['nombre']) ?>"></a>
                        <div class="carousel-caption text-start">
                            <h2 class="fw-bold"><?= htmlspecialchars($juego['nombre']) ?></h2>
                            <a href="producto.php?id=<?= $juego['id'] ?>" class="btn btn-comprar">Ver juego</a>
                        </div>
                    </div>
                <?php $i++; endwhile; ?>
            </div>

            <button class="carousel-control-prev" type="button" data-bs-target="#carruselDestacados" data-bs-slide="prev">
                <span class="carousel-control-prev-icon"></span>
                <span class="visually-hidden">Anterior</span>
            </button>
            <button class="carousel-control-next" type="button" data-bs-target="#carruselDestacados" data-bs-slide="next">
                <span class="carousel-control-next-icon"></span>
                <span class="visually-hidden">Siguiente</span>
            </button>
        </div>
        <?php endif; ?>

        <h1>Catálogo</h1>

        <!-- Filas -->
        <?php fila('Novedades', $novedades); ?>
        <?php fila('Lo más vendido', $top); ?>
        <?php fila('Descubre algo nuevo', $nuevo); ?>
        <?php fila('Menos de $500', $economicos); ?>
        <?php fila('Últimas piezas', $ultimas); ?>

    <?php endif; ?>

    <!-- Catálogo completo -->
    <section id="catalogo" class="mt-5">
        <h2 class="h4 mb-3"><?= $hayFiltros ? 'Resultados' : 'Todos los juegos' ?></h2>

            <form method="get" action="index.php#catalogo" class="mb-4">
                <input type="hidden" name="q" value="<?= htmlspecialchars($q) ?>">

                <div class="row g-2 justify-content-end">
                    <div class="col-6 col-md-auto">
                        <div class="input-group">
                            <label class="input-group-text" for="orden">Ordenar por</label>
                            <select name="orden" id="orden" class="form-select" onchange="this.form.requestSubmit()">
                                <option value="nombre"      <?= $ordenSel === 'nombre' ? 'selected' : '' ?>>Nombre</option>
                                <option value="precio_asc"  <?= $ordenSel === 'precio_asc' ? 'selected' : '' ?>>Precio: menor a mayor</option>
                                <option value="precio_desc" <?= $ordenSel === 'precio_desc' ? 'selected' : '' ?>>Precio: mayor a menor</option>
                                <option value="nuevos"      <?= $ordenSel === 'nuevos' ? 'selected' : '' ?>>Más recientes</option>
                            </select>
                        </div>
                    </div>
                    <div class="col-6 col-md-auto d-flex gap-2">
                        <button type="button" class="btn btn-outline-secondary flex-fill"
                                data-bs-toggle="collapse" data-bs-target="#panelFiltros">
                            <i class="bi bi-funnel"></i> Filtros
                        </button>
                        <button type="submit" class="btn btn-primary flex-fill">Aplicar</button>
                    </div>
                </div>

            <!-- panel de checkbox -->
            <div class="collapse <?= ($generosSel || $devsSel) ? 'show' : '' ?>" id="panelFiltros">
                <div class="row mt-3 p-3 border rounded-3">
                    <div class="col-md-8">
                        <h3 class="h6">Géneros</h3>
                        <div class="row row-cols-2 row-cols-md-3">
                            <?php foreach ($generos as $g): ?>
                                <div class="form-check col">
                                    <input class="form-check-input" type="checkbox" name="genero[]"
                                            value="<?= htmlspecialchars($g) ?>" id="g-<?= md5($g) ?>"
                                            <?= in_array($g, $generosSel) ? 'checked' : '' ?>>
                                    <label class="form-check-label" for="g-<?= md5($g) ?>"><?= htmlspecialchars($g) ?></label>
                                </div>
                            <?php endforeach; ?>
                        </div>
                    </div>
                    <div class="col-md-4 mt-3 mt-md-0">
                        <h3 class="h6">Desarrollador</h3>
                        <?php while ($d = mysqli_fetch_assoc($desarrolladores)): ?>
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" name="dev[]"
                                        value="<?= $d['id'] ?>" id="d-<?= $d['id'] ?>"
                                        <?= in_array($d['id'], $devsSel) ? 'checked' : '' ?>>
                                <label class="form-check-label" for="d-<?= $d['id'] ?>"><?= htmlspecialchars($d['nombre']) ?></label>
                            </div>
                        <?php endwhile; ?>
                    </div>
                </div>
            </div>
        </form>

        <?php if ($hayFiltros): ?>
            <p class="text-body-secondary">
                <?= mysqli_num_rows($resultado) ?> juego(s) encontrados
                <?php if ($q !== ''): ?> para "<?= htmlspecialchars($q) ?>"<?php endif; ?> ·
                <a href="index.php">Limpiar filtros</a>
            </p>
        <?php endif; ?>

        <div class="row g-3">
            <?php while ($row = mysqli_fetch_assoc($resultado)): ?>
                <div class="col-6 col-lg-3">
                    <?php include "includes/tarjeta.php"; ?>
                </div>
            <?php endwhile; ?>
        </div>
    </section>

</div>

<script>
document.querySelector("#catalogo form").addEventListener("submit", (e) => {
    e.preventDefault();
    const params = new URLSearchParams(new FormData(e.target));
    location.replace("index.php?" + params + "#catalogo");
});
</script>

<?php include "includes/footer.php"; ?>