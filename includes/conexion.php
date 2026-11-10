<?php
require_once __DIR__ . "/config.php";

$con = mysqli_connect($DB_HOST, $DB_USER, $DB_PASS, $DB_NAME);

if (!$con) {
    die("Error al conectar con la base de datos.");
}

mysqli_set_charset($con, "utf8mb4");
?>  