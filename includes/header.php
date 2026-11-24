<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
define("NOMBRE_TIENDA", "GAME CAT");
?>
<!DOCTYPE html>
<html lang="es" data-bs-theme="dark">
<head>
    <script>
        try {
            const tema = localStorage.getItem("tema");
            if (tema) document.documentElement.setAttribute("data-bs-theme", tema);
        } catch (e) {}
    </script>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= $titulo ?? NOMBRE_TIENDA ?></title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css" rel="stylesheet">
    <link href="css/estilos.css" rel="stylesheet">
    <link rel="icon" type="image/png" href="assets/sitio/favicon.png">
</head>
<body class="d-flex flex-column min-vh-100">

<nav class="navbar navbar-expand-lg bg-body-tertiary sticky-top">
    <div class="container">
        <a class="navbar-brand d-flex align-items-center gap-2" href="index.php">
            <img src="assets/sitio/logo.svg" alt="" height="32">
        </a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#menu">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="menu">
            <ul class="navbar-nav me-auto">
                <li class="nav-item"><a class="nav-link" href="index.php">Catálogo</a></li>
                <li class="nav-item"><a class="nav-link" href="contacto.php">Contacto</a></li>
                <?php if(!empty($_SESSION['usuario_admin'])): ?>
                    <li class="nav-item"><a class="nav-link" href="admin.php">Admin</a></li>
                <?php endif; ?>
            </ul>
            <?php if(isset($_SESSION['usuario_id'])): ?>
                <ul class="navbar-nav">
                    <button type="button" id="btnTema" class="btn btn-link nav-link" data-bs-toggle="tooltip" title="Cambiar tema">
                        <i class="bi bi-sun"></i>
                    </button>
                    <li class="nav-item">
                        <a class="nav-link" href="carrito.php" data-bs-toggle="tooltip" data-bs-placement="bottom" data-bs-title="Mi carrito">
                            <i class="bi bi-cart"></i>
                            <span class="d-lg-none ms-2">Mi carrito</span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="perfil.php" data-bs-toggle="tooltip" data-bs-placement="bottom" data-bs-title="Mi perfil">
                            <i class="bi bi-person-circle"></i>
                            <span class="d-lg-none ms-2">Mi perfil</span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="logout.php" data-bs-toggle="tooltip" data-bs-placement="bottom" data-bs-title="Cerrar sesión">
                            <i class="bi bi-box-arrow-right"></i>
                            <span class="d-lg-none ms-2">Cerrar sesión</span>
                        </a>
                    </li>
                </ul>
            <?php else: ?>
                <ul class="navbar-nav">
                    <button type="button" id="btnTema" class="btn btn-link nav-link" data-bs-toggle="tooltip" title="Cambiar tema">
                        <i class="bi bi-sun"></i>
                    </button>
                    <li class="nav-item"><a class="nav-link" href="login.php">Iniciar sesión</a></li>
                    <li class="nav-item"><a class="nav-link" href="registro.php">Registrarse</a></li>
                </ul>
            <?php endif; ?>
        </div>
    </div>
</nav>

<main class="flex-grow-1">