<?php
session_start();
header('Content-Type: application/json');

$hashCodigo  = '42765a283a34a924d27beb8bdd15c1f2f6a3a154489fa8c8adb22954d070123a';
$largoCodigo = 82;

$personajes = glob('assets/sitio/p7q/*.gif');

$accion = $_POST['a'] ?? '';
$respuesta = [];

if ($accion === 'c') {
    $ahora = time();
    if ($ahora - ($_SESSION['ee_t'] ?? 0) > 2) {
        $_SESSION['ee_c'] = 0;
    }
    $_SESSION['ee_t'] = $ahora;
    $_SESSION['ee_c'] = ($_SESSION['ee_c'] ?? 0) + 1;

    if ($_SESSION['ee_c'] >= 7) {
        $_SESSION['ee_ok'] = true;
        $_SESSION['ee_c'] = 0;
        $_SESSION['ee_b'] = '';
    }
}

// Etapa 2: el código, solo si ya se pasó la etapa 1
if ($accion === 'k' && !empty($_SESSION['ee_ok'])) {
    $tecla = substr(preg_replace('/[^a-z0-9]/', '', strtolower($_POST['k'] ?? '')), 0, 12);
    $_SESSION['ee_b'] = substr(($_SESSION['ee_b'] ?? '') . $tecla . ',', -150);

    $ultimas = substr($_SESSION['ee_b'], -$largoCodigo);
    if (hash('sha256', $ultimas) === $hashCodigo) {
        $respuesta['p'] = $personajes;
        $_SESSION['ee_ok'] = false;
        $_SESSION['ee_b'] = '';
    }
}

echo json_encode($respuesta);