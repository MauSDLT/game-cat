<?php
session_start();
require_once "includes/conexion.php";

$mensaje = "";

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $correo = mysqli_real_escape_string($con, $_POST["correo"]);
    $contrasena = $_POST["contrasena"];

    $sql = "SELECT id, nombre, contrasena, admin FROM usuarios WHERE correo = '$correo';";
    $resultado = mysqli_query($con, $sql);
    $usuario = mysqli_fetch_assoc($resultado);

    if ($usuario && password_verify($contrasena, $usuario['contrasena'])) {
        $_SESSION['usuario_id'] = $usuario['id'];
        $_SESSION['usuario_nombre'] = $usuario['nombre'];
        $_SESSION['usuario_admin'] = $usuario['admin'];

        header("Location: index.php");
        exit;
    } else {
        $mensaje = "Correo o contraseña incorrectos.";
    }
}
$titulo = "Iniciar Sesión";
include "includes/header.php";
?>

<div class="container py-5">
    <div class="row justify-content-center">
        <div class="col-md-8 col-lg-6">
            <h1>Iniciar sesión</h1>
            <?php if ($mensaje !== ""): ?>
                <div class="alert alert-danger"><?= $mensaje ?></div>
            <?php endif; ?>
            <form action="" method="post">
                <div class="mb-3 mt-3">
                    <label for="correo" class="form-label">Correo:</label>
                    <input type="email" class="form-control" id="correo" placeholder="Ingresa tu correo" name="correo" required>
                </div>
                <div class="mb-3">
                    <label for="contrasena" class="form-label">Contraseña:</label>
                    <input type="password" class="form-control" id="contrasena" placeholder="Ingresa tu contraseña" name="contrasena" required>
                </div>
                <button type="submit" class="btn btn-primary">Iniciar sesión</button>
            </form>
            <div class="alert alert-info mt-3">
                ¿Aún no tienes cuenta? <a href='registro.php' class='alert-link'>Regístrate</a>.
            </div>
        </div>
    </div>
</div>

<?php include "includes/footer.php"; ?>