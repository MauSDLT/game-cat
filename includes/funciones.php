<?php
function crearSlug($texto) {
    $texto = iconv('UTF-8', 'ASCII//TRANSLIT', $texto); 
    $texto = strtolower($texto);
    $texto = preg_replace('/[^a-z0-9]+/', '-', $texto); 
    return trim($texto, '-');
}


function guardarImagen($archivo, $carpeta, $nombre) {
    if ($archivo['error'] !== UPLOAD_ERR_OK) {
        return null;
    }

    $permitidas = ['jpg', 'jpeg', 'png', 'webp', 'avif', 'gif'];
    $extension = strtolower(pathinfo($archivo['name'], PATHINFO_EXTENSION));
    if (!in_array($extension, $permitidas)) {
        return null;
    }

    if (getimagesize($archivo['tmp_name']) === false) {
        return null;
    }

    if (!is_dir($carpeta)) {
        mkdir($carpeta, 0755, true);
    }

    $ruta = "$carpeta/$nombre.$extension";
    if (move_uploaded_file($archivo['tmp_name'], $ruta)) {
        return $ruta;
    }
    return null;
}