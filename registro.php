<?php
require_once "includes/conexion.php";

$mensaje = "";
$tipoMensaje = "";

if ($_SERVER["REQUEST_METHOD"] === "POST") {

    $nombre     = mysqli_real_escape_string($con, $_POST["nombre"]);
    $correo     = mysqli_real_escape_string($con, $_POST["correo"]);
    $nacimiento     = mysqli_real_escape_string($con, $_POST["nacimiento"]);
    $tarjeta     = mysqli_real_escape_string($con, $_POST["tarjeta"]);
    $dirección     = mysqli_real_escape_string($con, $_POST["direccion"]);
    $contrasena  = $_POST["contrasena"];
    $contrasena2 = $_POST["contrasena2"];

    if ($contrasena !== $contrasena2) {
        $mensaje = "Las contraseñas no coinciden.";
        $tipoMensaje = "danger";
    } else {
        $sql = "SELECT id FROM usuarios WHERE correo = '$correo';";
        $resultado = mysqli_query($con, $sql);

        if (mysqli_num_rows($resultado) > 0) {
            $mensaje = "Ya existe una cuenta con ese correo.";
            $tipoMensaje = "danger";
        } else {
            $hash = password_hash($contrasena, PASSWORD_DEFAULT);

            $sql = "INSERT INTO usuarios (nombre, correo, contrasena, nacimiento, tarjeta, direccion)
                    VALUES ('$nombre', '$correo', '$hash', '$nacimiento', '$tarjeta', '$dirección');";

            if (mysqli_query($con, $sql)) {
                $mensaje = "Cuenta creada correctamente. <a href='login.php' class='alert-link'>Inicia sesión</a>.";
                $tipoMensaje = "success";
                $_POST = [];
            } else {
                $mensaje = "Ocurrió un error al crear la cuenta.";
                $tipoMensaje = "danger";
            }
        }
    }
}

$titulo = "Crear cuenta";
include "includes/header.php";
?>

<div class="container py-5">
    <div class="row justify-content-center">
        <div class="col-md-8 col-lg-6">
            <h1 class="mb-4">Crear cuenta</h1>
            <?php if ($mensaje !== ""): ?>
                <div class="alert alert-<?= $tipoMensaje ?>"><?= $mensaje ?></div>
            <?php endif; ?>

            <form method="post">
                <div id="errorContrasena" class="alert alert-danger d-none">
                    <strong>Las contraseñas no coinciden.</strong>
                </div>
                <div id="paso1">
                    <div class="mb-3">
                        <label for="nombre" class="form-label">Nombre completo</label>
                        <input type="text" class="form-control" id="nombre" name="nombre" required value="<?= htmlspecialchars($_POST['nombre'] ?? '') ?>">
                    </div>
                    <div class="mb-3">
                        <label for="correo" class="form-label">Correo electrónico</label>
                        <input type="email" class="form-control" id="correo" name="correo" required value="<?= htmlspecialchars($_POST['correo'] ?? '') ?>">
                    </div>
                    <div class="mb-3">
                        <label for="contrasena" class="form-label">Contraseña</label>
                        <div class="input-group">
                            <input type="password" class="form-control" id="contrasena" placeholder="Ingresa tu contraseña" name="contrasena" required>
                            <button type="button" class="btn btn-outline-secondary ver-contrasena" tabindex="-1">
                                <i class="bi bi-eye"></i>
                            </button>
                        </div>
                    </div>
                    <div class="mb-3">
                        <label for="contrasena2" class="form-label">Confirmar contraseña</label>
                        <div class="input-group">
                            <input type="password" class="form-control" id="contrasena" placeholder="Ingresa tu contraseña" name="contrasena" required>
                            <button type="button" class="btn btn-outline-secondary ver-contrasena" tabindex="-1">
                                <i class="bi bi-eye"></i>
                            </button>
                        </div>
                    </div>
                    <div class="mb-3">
                        <label for="nacimiento" class="form-label">Fecha de nacimiento</label>
                        <input type="date" class="form-control" id="nacimiento" name="nacimiento" required value="<?= htmlspecialchars($_POST['nacimiento'] ?? '') ?>">
                    </div>
                    <button type="button" onclick="continuar()" class="btn btn-primary w-100">Continuar</button>
                </div>
                <div id="paso2" class="d-none">
                    <div class="mb-3">
                        <label for="tarjeta" class="form-label">Número de tarjeta</label>
                        <input type="text" class="form-control" id="tarjeta" name="tarjeta" inputmode="numeric" maxlength="19" placeholder="4242 4242 4242 4242" required>
                    </div>
                    <div class="mb-3">
                        <label for="direccion" class="form-label">Dirección</label>
                        <textarea class="form-control" id="direccion" name="direccion" rows="3" required><?= htmlspecialchars($_POST['direccion'] ?? '') ?></textarea>
                    </div>
                    <button type="button" class="btn btn-outline-secondary" onclick="regresar()">Atrás</button>
                    <button type="submit" class="btn btn-primary">Crear cuenta</button>
                </div>
            </form>
        </div>
    </div>
</div>

<script>
function continuar() {
    const campos = document.querySelectorAll("#paso1 input");
    for (const campo of campos) {
        if (!campo.reportValidity()) {
            return; 
        }
    }
    if(document.getElementById("contrasena").value !== document.getElementById("contrasena2").value){
        document.getElementById("errorContrasena").classList.remove("d-none");
        return; 
    }
    document.getElementById("paso2").classList.remove("d-none");
    document.getElementById("paso1").classList.add("d-none");
    document.getElementById("errorContrasena").classList.add("d-none");
}

function regresar() {
    document.getElementById("paso1").classList.remove("d-none");
    document.getElementById("paso2").classList.add("d-none");
}
</script>

<?php include "includes/footer.php"; ?>