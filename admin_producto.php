<?php
session_start();

if (empty($_SESSION['usuario_admin'])) {
    header("Location: index.php");
    exit;
}

require_once "includes/conexion.php";
require_once "includes/funciones.php";

$id = (int) ($_GET['id'] ?? 0);
$juego = null;

if ($id > 0) {
    $sql = "SELECT * FROM productos WHERE id = $id";
    $resultado = mysqli_query($con, $sql);
    $juego = mysqli_fetch_assoc($resultado);
}

if ($_SERVER["REQUEST_METHOD"] === "POST") {

    $nombre      = mysqli_real_escape_string($con, $_POST['nombre']);
    $descripcion = mysqli_real_escape_string($con, $_POST['descripcion']);
    $precio      = (float) $_POST['precio'];
    $stock       = (int) $_POST['stock'];
    $idDesarrollador = (int) $_POST['id_desarrollador'];
    $plataforma = mysqli_real_escape_string($con, $_POST['plataforma']);
    $genero = mysqli_real_escape_string($con, $_POST['genero']);
    $clasificacion = mysqli_real_escape_string($con, $_POST['clasificacion']);
    $color = mysqli_real_escape_string($con, $_POST['color']);
    $trailer = mysqli_real_escape_string($con, $_POST['trailer']);
    $anio = $_POST['anio'] !== '' ? (int) $_POST['anio'] : 'NULL';
    $colorFondo = $_POST['color_fondo'] !== ''
        ? "'" . mysqli_real_escape_string($con, $_POST['color_fondo']) . "'"
        : 'NULL';

    if ($id > 0) {
        $carpeta = dirname($juego['portada']);

        if ($_FILES['portada']['error'] === UPLOAD_ERR_OK) {
            $nueva = guardarImagen($_FILES['portada'], $carpeta, 'portada-' . time());
            if ($nueva) {
                if (is_file($juego['portada'])) {
                    unlink($juego['portada']);
                }
                $nueva = mysqli_real_escape_string($con, $nueva);
                mysqli_query($con, "UPDATE productos SET portada = '$nueva' WHERE id = $id");
            }
        }

        if ($_FILES['fondo']['error'] === UPLOAD_ERR_OK) {
            $nueva = guardarImagen($_FILES['fondo'], $carpeta, 'fondo-' . time());
            if ($nueva) {
                if (is_file($juego['fondo'])) {
                    unlink($juego['fondo']);
                }
                $nueva = mysqli_real_escape_string($con, $nueva);
                mysqli_query($con, "UPDATE productos SET fondo = '$nueva' WHERE id = $id");
            }
        }

        
        $sql = "UPDATE productos SET
                    nombre = '$nombre',
                    descripcion = '$descripcion',
                    precio = $precio,
                    stock = $stock,
                    id_desarrollador = $idDesarrollador,
                    anio = $anio,
                    color_fondo = $colorFondo,
                    plataforma = '$plataforma',
                    genero = '$genero',
                    clasificacion = '$clasificacion',
                    trailer = '$trailer',
                    color = '$color'                   
                WHERE id = $id";
        mysqli_query($con, $sql);
    }else {
        $carpeta = "assets/juegos/" . crearSlug($_POST['nombre']);
        
        $portada = guardarImagen($_FILES['portada'], $carpeta, 'portada');
        $fondo   = guardarImagen($_FILES['fondo'], $carpeta, 'fondo');
        
        $sql = "INSERT INTO productos
                (nombre, descripcion, precio, stock, id_desarrollador, plataforma, genero,
                clasificacion, anio, color, color_fondo, portada, fondo, trailer)
                VALUES
                ('$nombre', '$descripcion', $precio, $stock, $idDesarrollador, '$plataforma', '$genero',
                '$clasificacion', $anio, '$color', $colorFondo, '$portada', '$fondo', '$trailer')";
        mysqli_query($con, $sql);
        
        $nuevoId = mysqli_insert_id($con);

        $capturas = $_FILES['capturas'];
        for ($i = 0; $i < count($capturas['name']); $i++) {
            $archivo = [
                'name'     => $capturas['name'][$i],
                'tmp_name' => $capturas['tmp_name'][$i],
                'error'    => $capturas['error'][$i],
            ];
            $ruta = guardarImagen($archivo, $carpeta, 'captura' . ($i + 1));

            if ($ruta) {
                $orden = $i + 1;
                if (!$portada) {
                    echo "No se pudo guardar la portada. Revisa que sea una imagen válida.";
                    exit;
                }
                mysqli_query($con, "INSERT INTO fotos_producto (id_producto, ruta, orden)
                                    VALUES ($nuevoId, '$ruta', $orden)");
            }
        }
    }

    header("Location: admin.php");
    exit;
}

$desarrolladores = mysqli_query($con, "SELECT id, nombre FROM desarrolladores ORDER BY nombre");

$titulo = $juego ? "Editar juego" : "Agregar juego";
include "includes/header.php";
?>

<div class="container py-4">
    <div class="row justify-content-center">
        <div class="col-lg-8">
            <h1 class="mb-4"><?= $titulo ?></h1>

            <form method="post" enctype="multipart/form-data">
                <div class="row g-3">

                    <div class="col-md-8">
                        <label for="nombre" class="form-label">Nombre</label>
                        <input type="text" class="form-control" id="nombre" name="nombre" required
                                value="<?= htmlspecialchars($juego['nombre'] ?? '') ?>">
                    </div>

                    <div class="col-md-4">
                        <label for="id_desarrollador" class="form-label">Desarrollador</label>
                        <select class="form-select" id="id_desarrollador" name="id_desarrollador" required>
                            <?php while ($d = mysqli_fetch_assoc($desarrolladores)): ?>
                                <option value="<?= $d['id'] ?>"
                                    <?= ($juego['id_desarrollador'] ?? 0) == $d['id'] ? 'selected' : '' ?>>
                                    <?= htmlspecialchars($d['nombre']) ?>
                                </option>
                            <?php endwhile; ?>
                        </select>
                    </div>

                    <div class="col-12">
                        <label for="descripcion" class="form-label">Descripción</label>
                        <textarea class="form-control" id="descripcion" name="descripcion" rows="5" required><?= htmlspecialchars($juego['descripcion'] ?? '') ?></textarea>
                    </div>

                    <div class="col-md-4">
                        <label for="precio" class="form-label">Precio</label>
                        <input type="number" step="0.01" min="0" class="form-control" id="precio" name="precio" required
                                value="<?= htmlspecialchars($juego['precio'] ?? '') ?>">
                    </div>
                    
                    <div class="col-md-4">
                        <label for="stock" class="form-label">Stock</label>
                        <input type="number" class="form-control" id="stock" name="stock" min="0" required
                            value="<?= htmlspecialchars($juego['stock'] ?? '0') ?>">
                    </div>

                    <div class="col-md-4">
                        <label for="anio" class="form-label">Año</label>
                        <input type="number" class="form-control" id="anio" name="anio" min="1970" max="2100"
                            value="<?= htmlspecialchars($juego['anio'] ?? '') ?>">
                    </div>

                    <div class="col-md-6">
                        <label for="plataforma" class="form-label">Plataforma(s)</label>
                        <input type="text" class="form-control" id="plataforma" name="plataforma"
                            placeholder="PC, PlayStation 5, Nintendo Switch"
                            value="<?= htmlspecialchars($juego['plataforma'] ?? '') ?>">
                    </div>

                    <div class="col-md-3">
                        <label for="genero" class="form-label">Género</label>
                        <input type="text" class="form-control" id="genero" name="genero"
                            value="<?= htmlspecialchars($juego['genero'] ?? '') ?>">
                    </div>

                    <div class="col-md-3">
                        <label for="clasificacion" class="form-label">Clasificación</label>
                        <select class="form-select" id="clasificacion" name="clasificacion">
                            <?php foreach (['E', 'E10+', 'T', 'M', 'AO'] as $c): ?>
                                <option value="<?= $c ?>" <?= ($juego['clasificacion'] ?? '') === $c ? 'selected' : '' ?>><?= $c ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>

                    <div class="col-md-4">
                        <label for="color" class="form-label">Color</label>
                        <input type="color" class="form-control form-control-color" id="color" name="color"
                            value="<?= htmlspecialchars($juego['color'] ?? '#6c757d') ?>">
                    </div>

                    <div class="col-md-4">
                        <label for="color_fondo" class="form-label">Color de fondo (opcional)</label>
                        <input type="text" class="form-control" id="color_fondo" name="color_fondo"
                            placeholder="#0d1410"
                            value="<?= htmlspecialchars($juego['color_fondo'] ?? '') ?>">
                    </div>

                    <div class="col-md-4">
                        <label for="trailer" class="form-label">Tráiler</label>
                        <input type="text" class="form-control" id="trailer" name="trailer"
                            placeholder="ID de YouTube"
                            value="<?= htmlspecialchars($juego['trailer'] ?? '') ?>">
                    </div>

                    <div class="col-md-6">
                        <label for="portada" class="form-label">Portada</label>
                        <?php if ($juego): ?>
                            <img src="<?= htmlspecialchars($juego['portada']) ?>" class="d-block rounded mb-2" width="80" alt="Portada actual">
                        <?php endif; ?>
                        <input type="file" class="form-control" id="portada" name="portada" accept="image/*"
                            <?= $juego ? '' : 'required' ?>>
                    </div>

                    <div class="col-md-6">
                        <label for="fondo" class="form-label">Fondo</label>
                        <?php if ($juego && $juego['fondo']): ?>
                            <img src="<?= htmlspecialchars($juego['fondo']) ?>" class="d-block rounded mb-2" width="140" alt="Fondo actual">
                        <?php endif; ?>
                        <input type="file" class="form-control" id="fondo" name="fondo" accept="image/*"
                            <?= $juego ? '' : 'required' ?>>
                    </div>

                    <div class="col-12">
                        <label for="capturas" class="form-label">Capturas</label>
                        <input type="file" class="form-control" id="capturas" name="capturas[]" accept="image/*" multiple
                            <?= $juego ? '' : 'required' ?>>
                        <div class="form-text">Puedes elegir varias imágenes a la vez.</div>
                    </div>

                    <div class="col-12 d-flex gap-2">
                        <button type="submit" class="btn btn-success">Guardar</button>
                        <a href="admin.php" class="btn btn-outline-secondary">Cancelar</a>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>

<?php include "includes/footer.php"; ?>