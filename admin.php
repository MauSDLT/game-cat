<?php
session_start();

if (empty($_SESSION['usuario_admin'])) {
    header("Location: index.php");
    exit;
}

$titulo = "Admin";
include "includes/header.php";
?>

<div class="container py-4">
    <h1>Admin</h1>
    <p class="text-body-secondary">Próximamente.</p>
</div>

<?php include "includes/footer.php"; ?>