<?php
define("NOMBRE_TIENDA", "Tienda");
?>
<!DOCTYPE html>
<html lang="es" data-bs-theme="dark">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= $titulo ?? NOMBRE_TIENDA ?></title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="css/estilos.css" rel="stylesheet">
</head>
<body class="d-flex flex-column min-vh-100">

<nav class="navbar navbar-expand-lg bg-body-tertiary sticky-top">
    <div class="container">
        <a class="navbar-brand fw-bold" href="index.php"><?= NOMBRE_TIENDA ?></a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#menu">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="menu">
            <ul class="navbar-nav me-auto">
                <li class="nav-item"><a class="nav-link" href="index.php">Catálogo</a></li>
                <li class="nav-item"><a class="nav-link" href="contacto.php">Contacto</a></li>
                <li class="nav-item"><a class="nav-link" href="admin.php">Admin</a></li>
            </ul>
            <ul class="navbar-nav">
                <li class="nav-item"><a class="nav-link" href="carrito.php">Carrito</a></li>
                <li class="nav-item"><a class="nav-link" href="perfil.php">Mi cuenta</a></li>
                <li class="nav-item"><a class="nav-link" href="login.php">Iniciar sesión</a></li>
                <li class="nav-item"><a class="nav-link" href="registro.php">Registrarse</a></li>
            </ul>
        </div>
    </div>
</nav>

<main class="flex-grow-1">