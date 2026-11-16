<?php
$titulo = "Contacto";
include "includes/header.php";
?>

<div class="container py-5">

    <div class="text-center mb-5">
        <h1>Sobre <?= NOMBRE_TIENDA ?></h1>
        <p class="lead text-body-secondary"><?= NOMBRE_TIENDA ?> es una tienda en línea de videojuegos, siempre intentando tener una experiencia inmersiva para el usuario.</p>
    </div>

    <div class="row g-4">

        <div class="col-md-6">
            <h2 class="h4 mb-3">Acerca de nosotros</h2>
            <p>En <?= NOMBRE_TIENDA ?> vendemos videojuegos, ¡compra tu licencia en línea y el juego es todo tuyo!</p>
            <p>Cada juego tiene un diseño único, hecho con cariño e inmersivo para que el usuario sienta la experiencia completa en su juego favorito.</p>
            <p>Es un proyecto para la materia Programación para Internet. Hecho por Mauricio Sánchez con todo su esfuerzo.</p>
        </div>

        <div class="col-md-6">
            <div class="card">
                <div class="card-header">
                    <h2 class="h4 mb-0">Contacto</h2>
                </div>
                <ul class="list-group list-group-flush">
                    <li class="list-group-item d-flex justify-content-between gap-3">
                        <span class="text-body-secondary">
                            <i class="bi bi-envelope me-2"></i>Correo
                        </span>
                        <span><a href="mailto:contacto@gamecat.com" class="text-reset">contacto@gamecat.com</a></span>
                    </li>
                    <li class="list-group-item d-flex justify-content-between gap-3">
                        <span class="text-body-secondary">
                            <i class="bi bi-telephone me-2"></i>Teléfono
                        </span>
                        <span><a href="tel:5533908510" class="text-reset">55 3390 8510</a></span>
                    </li>
                    <li class="list-group-item d-flex justify-content-between gap-3">
                        <span class="text-body-secondary">
                            <i class="bi bi-github me-2"></i>GitHub
                        </span>
                        <span><a href="https://github.com/MauSDLT" target="_blank" rel="noopener" class="text-reset">MauSDLT</a></span>
                    </li>
                </ul>
            </div>
        </div>

    </div>

    <h2 class="h4 mt-5 mb-3">Preguntas frecuentes</h2>

    <div class="accordion" id="faq">

        <div class="accordion-item">
            <h3 class="accordion-header">
                <button class="accordion-button collapsed" type="button"
                        data-bs-toggle="collapse" data-bs-target="#pregunta1">
                    ¿Cómo hago una compra?
                </button>
            </h3>
            <div id="pregunta1" class="accordion-collapse collapse" data-bs-parent="#faq">
                <div class="accordion-body">
                    Crea una cuenta o inicia sesión, entra a la página del juego que quieras y da clic en
                    "Agregar al carrito". Cuando termines, ve al carrito y da clic en "Finalizar compra".
                </div>
            </div>
        </div>

        <div class="accordion-item">
            <h3 class="accordion-header">
                <button class="accordion-button collapsed" type="button"
                        data-bs-toggle="collapse" data-bs-target="#pregunta2">
                    ¿Puedo cambiar la cantidad de un juego en mi carrito?
                </button>
            </h3>
            <div id="pregunta2" class="accordion-collapse collapse" data-bs-parent="#faq">
                <div class="accordion-body">
                    Sí. En tu carrito, usa los botones − y + para cambiar cuántas copias quieres de cada juego,
                    o da clic en "Eliminar" para quitarlo. Los cambios se guardan aunque cierres sesión.
                </div>
            </div>
        </div>

        <div class="accordion-item">
            <h3 class="accordion-header">
                <button class="accordion-button collapsed" type="button"
                        data-bs-toggle="collapse" data-bs-target="#pregunta3">
                    ¿Dónde veo las compras que he hecho?
                </button>
            </h3>
            <div id="pregunta3" class="accordion-collapse collapse" data-bs-parent="#faq">
                <div class="accordion-body">
                    En "Mi cuenta", debajo de tus datos, encontrarás la sección "Mis compras", con la fecha,
                    el juego, la cantidad y el total de cada compra.
                </div>
            </div>
        </div>

        <div class="accordion-item">
            <h3 class="accordion-header">
                <button class="accordion-button collapsed" type="button"
                        data-bs-toggle="collapse" data-bs-target="#pregunta4">
                    ¿Cómo marco un juego como favorito?
                </button>
            </h3>
            <div id="pregunta4" class="accordion-collapse collapse" data-bs-parent="#faq">
                <div class="accordion-body">
                    En la página de cualquier juego, da clic en el corazón ♡ junto al botón de "Agregar al carrito".
                    Puedes tener hasta 4 favoritos, y aparecerán en tu perfil. Para quitar uno, vuelve a dar clic
                    en el corazón.
                </div>
            </div>
        </div>

        <div class="accordion-item">
            <h3 class="accordion-header">
                <button class="accordion-button collapsed" type="button"
                        data-bs-toggle="collapse" data-bs-target="#pregunta5">
                    ¿Qué significan las clasificaciones E, E10+, T y M?
                </button>
            </h3>
            <div id="pregunta5" class="accordion-collapse collapse" data-bs-parent="#faq">
                <div class="accordion-body">
                    Son las clasificaciones del ESRB, que indican para qué edades es apropiado cada juego:
                    <ul class="mb-0 mt-2">
                        <li><strong>E</strong>: para todo público.</li>
                        <li><strong>E10+</strong>: para mayores de 10 años.</li>
                        <li><strong>T</strong>: para adolescentes, de 13 años en adelante.</li>
                        <li><strong>M</strong>: para mayores de 17 años.</li>
                        <li><strong>AO</strong>: solo para adultos, mayores de 18 años.</li>
                    </ul>
                </div>
            </div>
        </div>

    </div>

</div>

<?php include "includes/footer.php"; ?>