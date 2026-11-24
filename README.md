# GAME CAT 🐱🎮

Tienda en línea de videojuegos desarrollada para la materia **Programación para Internet**, Universidad Anáhuac.

**Autor:** Mauricio Sánchez De La Torre

## Tecnologías

- PHP 8 + MySQL 8
- Bootstrap 5.3 y Bootstrap Icons
- Docker

## Funcionalidades

- Catálogo con carrusel de destacados, filas por sección, búsqueda, filtros y ordenamiento
- Página de detalle con capturas, tráiler y ficha técnica
- Registro e inicio de sesión
- Carrito de compras y finalización de compra (actualiza inventario e historial)
- Favoritos y perfil de usuario con historial de compras
- Panel de administrador: inventario, alta y edición de productos, historial de ventas
- Modo claro / oscuro
- Diseño responsivo

## Cómo ejecutarlo

Requisito: tener [Docker Desktop](https://www.docker.com/products/docker-desktop/) instalado y abierto.

1. Clona el repositorio:
   ```
   git clone https://github.com/MauSDLT/game-cat.git
   cd game-cat
   ```

2. Copia el archivo de configuración:
   ```
   cp includes/config.example.php includes/config.php
   ```
   Llénalo con los datos del servicio `db` de `docker-compose.yml` (el host es `db`).

3. Levanta los contenedores:
   ```
   docker compose up -d --build
   ```

4. Entra a phpMyAdmin en [http://localhost:8081](http://localhost:8081), crea la base `tienda` e importa el archivo `tienda.sql`.

5. Abre la tienda en [http://localhost:8080](http://localhost:8080)

## Usuario de prueba

| Rol | Correo | Contraseña |
|---|---|---|
| Administrador | `adminprueba@gamecat.com` | `P4sw0rd789` |

> Todos los usuarios y números de tarjeta son de prueba; no se almacenan datos reales.

## Estructura

```
├── includes/          # header, footer, conexión y tarjeta
├── css/               # estilos.css
├── assets/            # logo, favicon e imágenes de los juegos
├── index.php          # catálogo
├── producto.php       # detalle del juego
├── carrito.php        # carrito de compras
├── perfil.php         # cuenta, favoritos e historial
├── admin.php          # panel de administrador
├── tienda.sql         # base de datos
├── Dockerfile
└── docker-compose.yml
```