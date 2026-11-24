-- phpMyAdmin SQL Dump
-- version 5.2.3
-- https://www.phpmyadmin.net/
--
-- Servidor: db
-- Tiempo de generación: 24-11-2026 a las 04:30:28
-- Versión del servidor: 8.1.0
-- Versión de PHP: 8.3.26

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `tienda`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `carrito`
--

CREATE TABLE `carrito` (
  `id` int NOT NULL,
  `id_usuario` int NOT NULL,
  `id_producto` int NOT NULL,
  `cantidad` int NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `desarrolladores`
--

CREATE TABLE `desarrolladores` (
  `id` int NOT NULL,
  `nombre` varchar(100) NOT NULL,
  `pais` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Volcado de datos para la tabla `desarrolladores`
--

INSERT INTO `desarrolladores` (`id`, `nombre`, `pais`) VALUES
(1, 'Nintendo', 'Japón'),
(2, 'Unknown Worlds', 'Estados Unidos'),
(3, 'Creative Assembly', 'Reino Unido'),
(4, 'Rocksteady Studios', 'Reino Unido'),
(5, 'Tarsier Studios', 'Suecia'),
(6, 'Monomi Park', 'Estados Unidos'),
(7, 'Bandai Namco Studios', 'Japón'),
(8, 'PopCap', 'Estados Unidos'),
(9, 'Red Barrels Studio', 'Canadá'),
(10, 'Rockstar Games', 'Estados Unidos'),
(11, 'Ninja Kiwi', 'Nueva Zelanda'),
(12, 'Mojang Studios', 'Suecia'),
(13, 'Santa Monica Studios', 'Estados Unidos'),
(14, 'Team Cherry', 'Australia'),
(15, 'Naughty Dog', 'Estados Unidos'),
(17, 'Atlus', 'Japón'),
(18, 'Landfall', 'Suecia'),
(19, '343 Industries', 'Estados Unidos'),
(20, 'HAL Laboratory', 'Japón'),
(21, 'Bandai Namco Studios / Sora Ltd.', 'Japón');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `favoritos`
--

CREATE TABLE `favoritos` (
  `id` int NOT NULL,
  `id_usuario` int NOT NULL,
  `id_producto` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Volcado de datos para la tabla `favoritos`
--

INSERT INTO `favoritos` (`id`, `id_usuario`, `id_producto`) VALUES
(14, 2, 1),
(13, 2, 2),
(16, 2, 3),
(15, 2, 5),
(9, 3, 1),
(6, 3, 2),
(8, 3, 3),
(10, 3, 5),
(19, 3, 10),
(20, 3, 19),
(17, 6, 7),
(21, 8, 4),
(23, 8, 9),
(22, 8, 22);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `fotos_producto`
--

CREATE TABLE `fotos_producto` (
  `id` int NOT NULL,
  `id_producto` int NOT NULL,
  `ruta` varchar(255) NOT NULL,
  `orden` int NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Volcado de datos para la tabla `fotos_producto`
--

INSERT INTO `fotos_producto` (`id`, `id_producto`, `ruta`, `orden`) VALUES
(1, 1, 'assets/juegos/super-mario-galaxy/captura1.png', 1),
(2, 1, 'assets/juegos/super-mario-galaxy/captura2.png\r\n', 2),
(3, 1, 'assets/juegos/super-mario-galaxy/captura3.png', 3),
(4, 1, 'assets/juegos/super-mario-galaxy/captura4.png', 4),
(5, 1, 'assets/juegos/super-mario-galaxy/captura5.png', 5),
(6, 2, 'assets/juegos/alien-isolation/captura1.avif', 1),
(7, 2, 'assets/juegos/alien-isolation/captura2.jpg', 2),
(8, 2, 'assets/juegos/alien-isolation/captura3.jpg', 3),
(9, 2, 'assets/juegos/alien-isolation/captura4.jpg', 4),
(10, 2, 'assets/juegos/alien-isolation/captura5.jpg', 5),
(11, 3, 'assets/juegos/subnautica/captura1.png', 1),
(12, 3, 'assets/juegos/subnautica/captura2.png', 2),
(13, 3, 'assets/juegos/subnautica/captura3.png\r\n', 3),
(14, 3, 'assets/juegos/subnautica/captura4.png', 4),
(15, 3, 'assets/juegos/subnautica/captura5.png', 5),
(16, 4, 'assets/juegos/ocarina-of-time/captura1.png', 1),
(17, 4, 'assets/juegos/ocarina-of-time/captura2.png', 2),
(18, 4, 'assets/juegos/ocarina-of-time/captura3.jpg', 3),
(19, 4, 'assets/juegos/ocarina-of-time/captura4.png', 4),
(20, 4, 'assets/juegos/ocarina-of-time/captura5.png', 5),
(21, 5, 'assets/juegos/subnautica-2/captura1.webp', 1),
(22, 5, 'assets/juegos/subnautica-2/captura2.webp', 2),
(23, 5, 'assets/juegos/subnautica-2/captura3.webp', 3),
(24, 5, 'assets/juegos/subnautica-2/captura4.webp', 4),
(25, 5, 'assets/juegos/subnautica-2/captura5.webp', 5),
(26, 6, 'assets/juegos/subnautica-below-zero/captura1.webp', 1),
(27, 6, 'assets/juegos/subnautica-below-zero/captura2.webp', 2),
(28, 6, 'assets/juegos/subnautica-below-zero/captura3.webp', 3),
(29, 6, 'assets/juegos/subnautica-below-zero/captura4.webp', 4),
(30, 6, 'assets/juegos/subnautica-below-zero/captura5.webp', 5),
(31, 7, 'assets/juegos/super-mario-galaxy-2/captura1.webp', 1),
(32, 7, 'assets/juegos/super-mario-galaxy-2/captura2.webp', 2),
(33, 7, 'assets/juegos/super-mario-galaxy-2/captura3.webp', 3),
(34, 7, 'assets/juegos/super-mario-galaxy-2/captura4.webp', 4),
(35, 7, 'assets/juegos/super-mario-galaxy-2/captura5.webp', 5),
(36, 8, 'assets/juegos/batman-arkham-asylum/captura1.webp', 1),
(37, 8, 'assets/juegos/batman-arkham-asylum/captura2.webp', 2),
(38, 8, 'assets/juegos/batman-arkham-asylum/captura3.webp', 3),
(39, 8, 'assets/juegos/batman-arkham-asylum/captura4.webp', 4),
(40, 8, 'assets/juegos/batman-arkham-asylum/captura5.webp', 5),
(41, 9, 'assets/juegos/batman-arkham-city/captura1.webp', 1),
(42, 9, 'assets/juegos/batman-arkham-city/captura2.webp', 2),
(43, 9, 'assets/juegos/batman-arkham-city/captura3.webp', 3),
(44, 9, 'assets/juegos/batman-arkham-city/captura4.webp', 4),
(45, 9, 'assets/juegos/batman-arkham-city/captura5.webp', 5),
(46, 10, 'assets/juegos/batman-arkham-knight/captura1.webp', 1),
(47, 10, 'assets/juegos/batman-arkham-knight/captura2.webp', 2),
(48, 10, 'assets/juegos/batman-arkham-knight/captura3.webp', 3),
(49, 10, 'assets/juegos/batman-arkham-knight/captura4.webp', 4),
(50, 10, 'assets/juegos/batman-arkham-knight/captura5.webp', 5),
(51, 11, 'assets/juegos/little-nightmares/captura1.webp', 1),
(52, 11, 'assets/juegos/little-nightmares/captura2.webp', 2),
(53, 11, 'assets/juegos/little-nightmares/captura3.webp', 3),
(54, 11, 'assets/juegos/little-nightmares/captura4.webp', 4),
(55, 11, 'assets/juegos/little-nightmares/captura5.webp', 5),
(56, 12, 'assets/juegos/little-nightmares-2/captura1.webp', 1),
(57, 12, 'assets/juegos/little-nightmares-2/captura2.webp', 2),
(58, 12, 'assets/juegos/little-nightmares-2/captura3.webp', 3),
(59, 12, 'assets/juegos/little-nightmares-2/captura4.webp', 4),
(60, 12, 'assets/juegos/little-nightmares-2/captura5.webp', 5),
(61, 13, 'assets/juegos/slime-rancher/captura1.jpg', 1),
(62, 13, 'assets/juegos/slime-rancher/captura2.jpg', 2),
(63, 13, 'assets/juegos/slime-rancher/captura3.jpg', 3),
(64, 13, 'assets/juegos/slime-rancher/captura4.jpg', 4),
(65, 13, 'assets/juegos/slime-rancher/captura5.jpg', 5),
(66, 14, 'assets/juegos/super-smash-bros-ultimate/captura1.jpg', 1),
(67, 14, 'assets/juegos/super-smash-bros-ultimate/captura2.jpg', 2),
(68, 14, 'assets/juegos/super-smash-bros-ultimate/captura3.jpg', 3),
(69, 14, 'assets/juegos/super-smash-bros-ultimate/captura4.jpg', 4),
(70, 14, 'assets/juegos/super-smash-bros-ultimate/captura5.jpg', 5),
(71, 15, 'assets/juegos/plants-vs-zombies/captura1.jpg', 1),
(72, 15, 'assets/juegos/plants-vs-zombies/captura2.jpg', 2),
(73, 15, 'assets/juegos/plants-vs-zombies/captura3.jpg', 3),
(74, 15, 'assets/juegos/plants-vs-zombies/captura4.jpg', 4),
(75, 15, 'assets/juegos/plants-vs-zombies/captura5.jpg', 5),
(76, 16, 'assets/juegos/outlast/captura1.webp', 1),
(77, 16, 'assets/juegos/outlast/captura2.webp', 2),
(78, 16, 'assets/juegos/outlast/captura3.webp', 3),
(79, 16, 'assets/juegos/outlast/captura4.webp', 4),
(80, 16, 'assets/juegos/outlast/captura5.webp', 5),
(81, 17, 'assets/juegos/grand-theft-auto-vi/captura1.webp', 1),
(82, 17, 'assets/juegos/grand-theft-auto-vi/captura2.webp', 2),
(83, 17, 'assets/juegos/grand-theft-auto-vi/captura3.webp', 3),
(84, 17, 'assets/juegos/grand-theft-auto-vi/captura4.webp', 4),
(85, 17, 'assets/juegos/grand-theft-auto-vi/captura5.webp', 5),
(86, 18, 'assets/juegos/bloons-td-6/captura1.webp', 1),
(87, 18, 'assets/juegos/bloons-td-6/captura2.webp', 2),
(88, 18, 'assets/juegos/bloons-td-6/captura3.webp', 3),
(89, 18, 'assets/juegos/bloons-td-6/captura4.webp', 4),
(90, 18, 'assets/juegos/bloons-td-6/captura5.webp', 5),
(91, 19, 'assets/juegos/minecraft/captura1.webp', 1),
(92, 19, 'assets/juegos/minecraft/captura2.webp', 2),
(93, 19, 'assets/juegos/minecraft/captura3.webp', 3),
(94, 19, 'assets/juegos/minecraft/captura4.webp', 4),
(95, 19, 'assets/juegos/minecraft/captura5.webp', 5),
(96, 20, 'assets/juegos/god-of-war-ragnarok/captura1.webp', 1),
(97, 20, 'assets/juegos/god-of-war-ragnarok/captura2.webp', 2),
(98, 20, 'assets/juegos/god-of-war-ragnarok/captura3.webp', 3),
(99, 20, 'assets/juegos/god-of-war-ragnarok/captura4.webp', 4),
(100, 20, 'assets/juegos/god-of-war-ragnarok/captura5.webp', 5),
(101, 21, 'assets/juegos/hollow-knight/captura1.webp', 1),
(102, 21, 'assets/juegos/hollow-knight/captura2.webp', 2),
(103, 21, 'assets/juegos/hollow-knight/captura3.webp', 3),
(104, 21, 'assets/juegos/hollow-knight/captura4.webp', 4),
(105, 21, 'assets/juegos/hollow-knight/captura5.webp', 5),
(106, 22, 'assets/juegos/the-last-of-us-part-i/captura1.webp', 1),
(107, 22, 'assets/juegos/the-last-of-us-part-i/captura2.webp', 2),
(108, 22, 'assets/juegos/the-last-of-us-part-i/captura3.webp', 3),
(109, 22, 'assets/juegos/the-last-of-us-part-i/captura4.webp', 4),
(110, 22, 'assets/juegos/the-last-of-us-part-i/captura5.webp', 5),
(111, 23, 'assets/juegos/persona-4-revival/captura1.webp', 1),
(112, 23, 'assets/juegos/persona-4-revival/captura2.webp', 2),
(113, 23, 'assets/juegos/persona-4-revival/captura3.webp', 3),
(114, 23, 'assets/juegos/persona-4-revival/captura4.webp', 4),
(115, 23, 'assets/juegos/persona-4-revival/captura5.webp', 5),
(116, 24, 'assets/juegos/peak/captura1.webp', 1),
(117, 24, 'assets/juegos/peak/captura2.webp', 2),
(118, 24, 'assets/juegos/peak/captura3.webp', 3),
(119, 24, 'assets/juegos/peak/captura4.webp', 4),
(120, 24, 'assets/juegos/peak/captura5.webp', 5),
(121, 25, 'assets/juegos/the-legend-of-zelda-breath-of-the-wild/captura1.webp', 1),
(122, 25, 'assets/juegos/the-legend-of-zelda-breath-of-the-wild/captura2.webp', 2),
(123, 25, 'assets/juegos/the-legend-of-zelda-breath-of-the-wild/captura3.webp', 3),
(124, 25, 'assets/juegos/the-legend-of-zelda-breath-of-the-wild/captura4.webp', 4),
(125, 25, 'assets/juegos/the-legend-of-zelda-breath-of-the-wild/captura5.webp', 5),
(126, 26, 'assets/juegos/the-legend-of-zelda-tears-of-the-kingdom/captura1.webp', 1),
(127, 26, 'assets/juegos/the-legend-of-zelda-tears-of-the-kingdom/captura2.webp', 2),
(128, 26, 'assets/juegos/the-legend-of-zelda-tears-of-the-kingdom/captura3.webp', 3),
(129, 26, 'assets/juegos/the-legend-of-zelda-tears-of-the-kingdom/captura4.webp', 4),
(130, 26, 'assets/juegos/the-legend-of-zelda-tears-of-the-kingdom/captura5.webp', 5),
(131, 27, 'assets/juegos/halo-campaign-evolved/captura1.webp', 1),
(132, 27, 'assets/juegos/halo-campaign-evolved/captura2.webp', 2),
(133, 27, 'assets/juegos/halo-campaign-evolved/captura3.webp', 3),
(134, 27, 'assets/juegos/halo-campaign-evolved/captura4.webp', 4),
(135, 27, 'assets/juegos/halo-campaign-evolved/captura5.webp', 5),
(136, 28, 'assets/juegos/halo-2/captura1.webp', 1),
(137, 28, 'assets/juegos/halo-2/captura2.webp', 2),
(138, 28, 'assets/juegos/halo-2/captura3.webp', 3),
(139, 28, 'assets/juegos/halo-2/captura4.webp', 4),
(140, 28, 'assets/juegos/halo-2/captura5.webp', 5),
(141, 29, 'assets/juegos/halo-3/captura1.webp', 1),
(142, 29, 'assets/juegos/halo-3/captura2.webp', 2),
(143, 29, 'assets/juegos/halo-3/captura3.webp', 3),
(144, 29, 'assets/juegos/halo-3/captura4.webp', 4),
(145, 29, 'assets/juegos/halo-3/captura5.webp', 5),
(146, 30, 'assets/juegos/halo-4/captura1.webp', 1),
(147, 30, 'assets/juegos/halo-4/captura2.webp', 2),
(148, 30, 'assets/juegos/halo-4/captura3.webp', 3),
(149, 30, 'assets/juegos/halo-4/captura4.webp', 4),
(150, 30, 'assets/juegos/halo-4/captura5.webp', 5),
(151, 31, 'assets/juegos/halo-infinite/captura1.webp', 1),
(152, 31, 'assets/juegos/halo-infinite/captura2.webp', 2),
(153, 31, 'assets/juegos/halo-infinite/captura3.webp', 3),
(154, 31, 'assets/juegos/halo-infinite/captura4.webp', 4),
(155, 31, 'assets/juegos/halo-infinite/captura5.webp', 5),
(156, 32, 'assets/juegos/kirby-and-the-forgotten-land/captura1.webp', 1),
(157, 32, 'assets/juegos/kirby-and-the-forgotten-land/captura2.webp', 2),
(158, 32, 'assets/juegos/kirby-and-the-forgotten-land/captura3.webp', 3),
(159, 32, 'assets/juegos/kirby-and-the-forgotten-land/captura4.webp', 4),
(160, 32, 'assets/juegos/kirby-and-the-forgotten-land/captura5.webp', 5),
(161, 33, 'assets/juegos/kirby-air-riders/captura1.webp', 1),
(162, 33, 'assets/juegos/kirby-air-riders/captura2.webp', 2),
(163, 33, 'assets/juegos/kirby-air-riders/captura3.webp', 3),
(164, 33, 'assets/juegos/kirby-air-riders/captura4.webp', 4),
(165, 33, 'assets/juegos/kirby-air-riders/captura5.webp', 5),
(166, 34, 'assets/juegos/kirby-s-return-to-dream-land-deluxe/captura1.webp', 1),
(167, 34, 'assets/juegos/kirby-s-return-to-dream-land-deluxe/captura2.webp', 2),
(168, 34, 'assets/juegos/kirby-s-return-to-dream-land-deluxe/captura3.webp', 3),
(169, 34, 'assets/juegos/kirby-s-return-to-dream-land-deluxe/captura4.webp', 4),
(170, 34, 'assets/juegos/kirby-s-return-to-dream-land-deluxe/captura5.webp', 5);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `historial`
--

CREATE TABLE `historial` (
  `id` int NOT NULL,
  `id_usuario` int NOT NULL,
  `id_producto` int NOT NULL,
  `cantidad` int NOT NULL,
  `precio` decimal(10,2) NOT NULL,
  `fecha` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Volcado de datos para la tabla `historial`
--

INSERT INTO `historial` (`id`, `id_usuario`, `id_producto`, `cantidad`, `precio`, `fecha`) VALUES
(1, 3, 2, 1, 599.00, '2026-11-16 05:27:20'),
(2, 2, 3, 1, 499.00, '2026-11-16 06:34:09'),
(3, 2, 5, 1, 599.00, '2026-11-16 06:34:09'),
(4, 2, 4, 1, 1399.00, '2026-11-17 01:06:24'),
(5, 5, 2, 1, 599.00, '2026-11-18 20:43:45'),
(6, 6, 7, 1, 899.00, '2026-11-18 20:50:10'),
(7, 7, 9, 1, 399.00, '2026-11-18 20:51:02'),
(8, 8, 5, 1, 599.00, '2026-11-24 03:09:35'),
(9, 8, 13, 1, 229.00, '2026-11-24 03:18:50'),
(10, 9, 8, 1, 399.00, '2026-11-24 03:21:02'),
(11, 8, 22, 7, 859.00, '2026-11-24 03:21:32');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `productos`
--

CREATE TABLE `productos` (
  `id` int NOT NULL,
  `nombre` varchar(150) NOT NULL,
  `descripcion` text NOT NULL,
  `precio` decimal(10,2) NOT NULL,
  `stock` int NOT NULL DEFAULT '0',
  `id_desarrollador` int NOT NULL,
  `plataforma` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci DEFAULT NULL,
  `genero` varchar(50) DEFAULT NULL,
  `clasificacion` varchar(10) DEFAULT NULL,
  `anio` year DEFAULT NULL,
  `color` char(7) NOT NULL DEFAULT '#6c757d',
  `color_fondo` varchar(7) DEFAULT NULL,
  `portada` varchar(255) NOT NULL,
  `fondo` varchar(255) DEFAULT NULL,
  `trailer` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Volcado de datos para la tabla `productos`
--

INSERT INTO `productos` (`id`, `nombre`, `descripcion`, `precio`, `stock`, `id_desarrollador`, `plataforma`, `genero`, `clasificacion`, `anio`, `color`, `color_fondo`, `portada`, `fondo`, `trailer`) VALUES
(1, 'Super Mario Galaxy', 'Peach le envía una invitación a Mario para que fuese al Reino Champiñón, porque están celebrando una gran fiesta, pero cuando llega el día de dicho evento, aparece Bowser, quien, descendiendo del cielo, viene acompañado de varios barcos voladores con los que pretende invadir el lugar y secuestrar a la princesa. Cuando él intenta detenerlo, el esbirro de Bowser, Kamek, usa su varita mágica para deshacerse de Mario, enviándolo a través del cosmos. Con ayuda de Rosalina, deberá recolectar estrellas y superar galaxias para reencontrarse con Peach y derrotar a Bowser.', 799.00, 15, 1, 'Wii, Nintendo Switch, Nintendo Switch 2', 'Plataforma, Acción y Aventura', 'E', '2007', '#3b4cc0', NULL, 'assets/juegos/super-mario-galaxy/portada.png', 'assets/juegos/super-mario-galaxy/fondo.jpg', '12bHSbYfFRA'),
(2, 'Alien: Isolation', 'Descubre el verdadero significado del terror en Alien: Isolation, un juego de horror y supervivencia que transcurre en un ambiente de constante tensión y peligro. Han pasado quince años desde los sucesos de Alien. La hija de Ellen Ripley, Amanda, se ve involucrada en una desesperada batalla por sobrevivir cuando se embarca en una misión que le permitirá averiguar qué sucedió realmente a su madre.\r\nAmanda tendrá que explorar un mundo cada vez más volátil y hacer frente a los constantes ataques tanto de una población sumida en la desesperación como de un alien despiadado e impredecible.\r\nIndefensa y poco preparada, tendrá que arreglárselas para conseguir recursos, improvisar soluciones y usar su cerebro, no solo para cumplir con su misión, sino para seguir con vida.', 599.00, 8, 3, 'PC, PlayStation 4, PlayStation 5, Xbox One, Xbox Series X/S', 'Terror', 'M', '2014', '#2fa84f', '#0d1410', 'assets/juegos/alien-isolation/portada.webp', 'assets/juegos/alien-isolation/fondo.jpg', 'Whr7u_B6Jn0'),
(3, 'Subnautica', 'Subnautica es un juego de mundo abierto, exploración submarina y aventura desarrollado por Unknown Worlds.\r\nDespués de estrellarte sobre un mundo oceánico alienígena, la única dirección a la que puedes ir es hacia abajo. Los océanos de Subnautica se extienden desde los arrecifes de coral de la superficie bañados por el sol hasta las traicioneras fosas abisales. Gestiona tu suministro de oxígeno mientras exploras los bosques de algas, mesetas, arrecifes y retorcidos sistemas de cuevas. El agua rebosa de vida: algunas criaturas son útiles, la mayoría peligrosas.\r\nTras despertarte en tu cápsula de salvamento, el reloj corre para que encuentres agua, comida y desarrolles el equipo que necesitas para explorar. Recolecta recursos del océano que te rodea. Fabrica cuchillos, linternas, equipo de buceo y tu propio vehículo acuático. Aventúrate más en las profundidades para encontrar recursos más raros que te permitirán crear objetos más avanzados.', 499.00, 19, 2, 'PC, PlayStation 4, Xbox One, Nintendo Switch', 'Supervivencia', 'E10+', '2018', '#0aa3b8', NULL, 'assets/juegos/subnautica/portada.avif', 'assets/juegos/subnautica/fondo.jpg', 'Rz2SNm8VguE'),
(4, 'The Legend of Zelda: Ocarina of Time Remake', 'El malvado Ganondorf planea hurtar la mítica Trifuerza del Reino Sagrado y apoderarse del mundo. Ahora Link deberá convertirse en el Héroe del Tiempo y salvar el reino en The Legend of Zelda: Ocarina of Time.\r\nUn hada que resplandece brillantemente \r\nLink es el único miembro de los kokiri que no cuenta con un hada, hasta que el Gran Árbol Deku le pide a Navi que lo acompañe en sus aventuras. A menudo, las hadas comparten pistas útiles. Si ves algún hada en esta página, ¡intenta averiguar si quiere darte una!\r\n\r\n', 1399.00, 0, 1, 'Nintendo Switch 2', 'Aventura', 'E10+', '2026', '#c9a227', NULL, 'assets/juegos/ocarina-of-time/portada.webp', 'assets/juegos/ocarina-of-time/fondo.webp', 'wuFfiTEr2yc'),
(5, 'Subnautica 2', 'Subnautica 2 es una aventura de supervivencia submarina ambientada en un mundo alienígena completamente nuevo, desarrollada por Unknown Worlds. Juega solo o con amigos en modo cooperativo de hasta 4 jugadores. Adáptate para sobrevivir construyendo bases personalizadas y fabricando herramientas. Explora lo desconocido para descubrir los misterios que se ocultan en las profundidades.', 599.00, 28, 2, 'PC, Xbox Series X/S', 'Supervivencia', 'E10+', '2026', '#1e6fd9', NULL, 'assets/juegos/subnautica-2/portada.webp', 'assets/juegos/subnautica-2/fondo.webp', '8EZhCzFaQuw'),
(6, 'Subnautica: Below Zero', 'Sumérgete en una gélida aventura subacuática en un planeta alienígena. Below Zero está ambientado dos años después de los hechos del juego original de Subnautica. Sobrevive a las arduas condiciones construyendo hábitats, fabricando herramientas y adentrándote todavía más en el mundo de Subnautica.\r\n', 595.00, 4, 2, 'PC, PlayStation 4, Xbox One, Nintendo Switch, PlayStation 5, Xbox Series X|S, Nintendo Switch 2', 'Supervivencia', 'E10+', '2021', '#8ac8ff', NULL, 'assets/juegos/subnautica-below-zero/portada.webp', 'assets/juegos/subnautica-below-zero/fondo.webp', 'rdix1XxaZyU'),
(7, 'Super Mario Galaxy 2', 'Super Mario Galaxy 2 es la secuela de Super Mario Galaxy y la cuarta entrega de plataformas en 3D de la saga de Mario. Conserva muchos elementos de su predecesor, como la aventura en el espacio exterior, la gravedad y objetos como las Estrellas Lanzadoras y las Estrellas Honda. También regresan objetos como el Champiñón Abeja y la Flor de Fuego. Además, el juego incorpora nuevas sorpresas: Yoshi como compañero de aventura, nuevos poderes como la Flor Nube y una guía dentro del juego para quienes apenas comienzan.', 899.00, 39, 1, 'Wii, Wii U, Nintendo Switch 2', 'Plataformas', 'E', '2010', '#5cbf3f', NULL, 'assets/juegos/super-mario-galaxy-2/portada.webp', 'assets/juegos/super-mario-galaxy-2/fondo.webp', '9yTZcpAx1ik'),
(8, 'Batman: Arkham Asylum', 'Lo que parecía un traslado de rutina se convierte en una trampa: el Joker toma el control del Asilo Arkham, libera a los internos y deja a Batman atrapado en la isla junto a los villanos más peligrosos de Gotham. Harley Quinn, Killer Croc, Poison Ivy y Bane te esperan en cada rincón, mientras el Joker vigila cada uno de tus pasos.\r\n\r\nCombina el sigilo desde las sombras, el combate fluido y el modo detective para recuperar el control del asilo. Enfréntate a las pesadillas del Espantapájaros, resuelve los acertijos que el Acertijo esconde por toda la isla y descubre qué es lo que el Joker planea realmente en el corazón de Arkham.', 399.00, 27, 4, 'Nintendo Switch, PC, PlayStation 3, Xbox 360, Xbox One, Xbox Series X/S, PlayStation 4, PlayStation 5', 'Acción, Superhéroes, Aventura', 'T', '2009', '#4a6c8c', NULL, 'assets/juegos/batman-arkham-asylum/portada.webp', 'assets/juegos/batman-arkham-asylum/fondo.webp', 'T8bu2Y_cZb8'),
(9, 'Batman: Arkham City', 'Un año después de los sucesos de Arkham Asylum, una parte de Gotham ha sido amurallada y convertida en Arkham City, una enorme prisión a cielo abierto bajo el control del misterioso doctor Hugo Strange. Cuando Bruce Wayne es encerrado dentro, Batman descubre que Strange esconde un siniestro plan: el Protocolo 10.\r\n\r\nPlanea entre los edificios, enfrenta a Dos Caras, el Pingüino, Mr. Freeze y muchos más, y juega también como Gatúbela en su propia historia. Con un Joker más desesperado que nunca, una ciudad llena de secretos y los desafíos del Acertijo esperando en cada calle, Arkham City expande todo lo que hizo grande a su antecesor.', 399.00, 37, 4, 'Nintendo Switch, PC, PlayStation 3, Xbox 360, Xbox One, Xbox Series X/S, PlayStation 4, PlayStation 5', 'Acción, Superhéroes, Aventura', 'T', '2012', '#6c757d', NULL, 'assets/juegos/batman-arkham-city/portada.webp', 'assets/juegos/batman-arkham-city/fondo.webp', 'YQgF0NYzZO8'),
(10, 'Batman: Arkham Knight', 'Es la noche de Halloween y el Espantapájaros amenaza con liberar su toxina del miedo sobre toda Gotham. La ciudad ha sido evacuada, los criminales han tomado las calles y un nuevo enemigo, el misterioso Caballero de Arkham, dirige un ejército que parece conocer cada movimiento de Batman.\r\n\r\nEn el capítulo final de la saga, recorre Gotham a toda velocidad a bordo del Batimóvil, que también se transforma en un tanque de combate. Enfréntate a los peores villanos de la ciudad, descubre la identidad del Caballero de Arkham y vive la noche que pondrá a prueba como ninguna otra al Caballero de la Noche.', 399.00, 40, 4, 'Nintendo Switch, PC, PlayStation 3, Xbox 360, Xbox One, Xbox Series X/S, PlayStation 4, PlayStation 5', 'Acción, Superhéroes, Aventura', 'M', '2015', '#e2722b', NULL, 'assets/juegos/batman-arkham-knight/portada.webp', 'assets/juegos/batman-arkham-knight/fondo.webp', 'FX1uGqXD2n8'),
(11, 'Little Nightmares', 'Six, una pequeña niña con un impermeable amarillo, despierta en las Fauces, un enorme y misterioso navío habitado por criaturas grotescas. Hambrienta y sola, deberá abrirse paso entre cocinas, camarotes y bodegas, escapando de habitantes que la superan muchas veces en tamaño.\r\n\r\nEscóndete del Conserje de brazos interminables, evita a los cocineros gemelos y descubre qué espera a Six al final del barco. Con una atmósfera inquietante, acertijos ingeniosos y momentos de auténtica tensión, Little Nightmares convierte los miedos de la infancia en una pesadilla de la que no podrás apartar la mirada.', 309.00, 19, 5, 'Nintendo Switch, PC, Xbox One, Xbox Series X/S, PlayStation 4, PlayStation 5, Android, iOS', 'Terror, Aventura', 'T', '2017', '#f2b632', NULL, 'assets/juegos/little-nightmares/portada.webp', 'assets/juegos/little-nightmares/fondo.webp', '-b9IuHlvNLk'),
(12, 'Little Nightmares II', 'Mono, un niño con una bolsa de papel en la cabeza, despierta en un bosque lleno de peligros, lejos de todo. Allí encontrará a Six, y juntos emprenderán un viaje hacia la Ciudad Pálida, un lugar cuyos habitantes han quedado atrapados bajo el efecto de una extraña señal transmitida desde una torre lejana.\r\n\r\nCoopera con Six para resolver acertijos, superar obstáculos y escapar de nuevos horrores, como la Maestra y el Doctor. Recorre una escuela, un hospital y las calles de una ciudad distorsionada mientras descubres el origen de la transmisión y el oscuro destino que une a Mono con la torre.', 469.00, 16, 5, 'Nintendo Switch, PC, Xbox One, Xbox Series X/S, PlayStation 4, PlayStation 5', 'Terror, Aventura', 'T', '2021', '#7a8a6e', NULL, 'assets/juegos/little-nightmares-2/portada.webp', 'assets/juegos/little-nightmares-2/fondo.webp', 'AI9zBBTyX-E'),
(13, 'Slime Rancher', 'Beatrix LeBeau, una joven y valiente ranchera, deja la Tierra para iniciar una nueva vida a mil años luz de distancia, en la Lejana, Lejana Pradera. Su misión: atrapar, cuidar y criar slimes, pequeñas y adorables criaturas gelatinosas de todo tipo, en su propio rancho.\r\n\r\nUsa tu aspiradora de slimes para atraparlos, aliméntalos y recolecta los plorts que producen para venderlos y mejorar tu rancho. Mezcla distintas especies para crear largos, explora nuevas zonas llenas de secretos y ten cuidado: si los slimes comen demasiado, pueden convertirse en el temido Tarr.', 229.00, 23, 6, 'PC, PlayStation 4, Xbox One, PlayStation 5, Xbox Series X/S', 'Exploración, Aventura, Adorables', 'E10+', '2017', '#f47ab0', NULL, 'assets/juegos/slime-rancher/portada.webp', 'assets/juegos/slime-rancher/fondo.jpg', 'oOL-dsa79Xs'),
(14, 'Super Smash Bros. Ultimate', '¡Todos están aquí! Los luchadores más legendarios de los videojuegos se reúnen en el mayor crossover de la historia: Mario, Link, Pikachu, Samus, Kirby, Sonic, Pac-Man y muchos más se enfrentan en combates frenéticos donde el objetivo es sacar a tus rivales del escenario.\r\n\r\nElige entre más de 80 personajes, lucha en más de 100 escenarios inspirados en sus propios juegos y vive la aventura de El Mundo de Luz, donde deberás rescatar a los espíritus de cientos de personajes clásicos. Juega solo, contra tus amigos o en línea, con hasta 8 jugadores al mismo tiempo.', 799.00, 8, 7, 'Nintendo Switch, Nintendo Switch 2', 'Pelea', 'E10+', '2018', '#e4002b', NULL, 'assets/juegos/super-smash-bros-ultimate/portada.jpg', 'assets/juegos/super-smash-bros-ultimate/fondo.webp', 'tqSY9mlmWIs'),
(15, 'Plants vs. Zombies', 'Una horda de zombis viene en camino y tu casa es su próximo destino. Tu única defensa es tu jardín: siembra plantas con poderes especiales para detenerlos antes de que crucen el césped y lleguen a tu puerta.\r\n\r\nRecolecta soles para plantar lanzaguisantes que disparan sin parar, girasoles que producen más energía y nueces que bloquean el paso. Planea tu estrategia de día, de noche, en la piscina, con niebla y hasta en el techo, mientras enfrentas zombis cada vez más astutos. Con la ayuda del excéntrico Dave el Loco, prepárate para el enfrentamiento final contra el temible Dr. Zomboss.', 99.00, 4, 8, 'Android, iOS, Mac, Nintendo DSi, PC, PlayStation 3, PlayStation Vita, Windows Phone, Xbox 360, Xbox One, PlayStation 4, Nintendo Switch, Xbox Series X/S, PlayStation 5', 'Rompecabezas, Estrategia', 'E10+', '2009', '#097901', NULL, 'assets/juegos/plants-vs-zombies/portada.jpg', 'assets/juegos/plants-vs-zombies/fondo.webp', 'SIjybhkHsz4'),
(16, 'Outlast', 'El periodista independiente Miles Upshur recibe un aviso anónimo: en el Asilo Monte Masivo, propiedad de la corporación Murkoff, se están cometiendo experimentos inhumanos. Decidido a descubrir la verdad, se adentra solo en el edificio, sin imaginar que los pacientes han tomado el control.\r\n\r\nNo puedes pelear: tu única opción es correr, esconderte y sobrevivir. Usa la visión nocturna de tu videocámara para avanzar en la oscuridad, administra sus baterías con cuidado y documenta lo que ves, mientras evitas a los habitantes más perturbadores del asilo. Una experiencia de terror en primera persona que te mantendrá al borde del asiento.', 499.00, 36, 9, 'Nintendo Switch, PC, PlayStation 4, Xbox One, PlayStation 5, Xbox Series X/S', 'Terror, Supervivencia', 'M', '2013', '#a4c639', '#0b0f0a', 'assets/juegos/outlast/portada.webp', 'assets/juegos/outlast/fondo-1795482430.webp', '2GPf3MdVOKI'),
(17, 'Grand Theft Auto VI', 'Bienvenido a Leonida, un estado lleno de sol, excesos y peligro, hogar de la ciudad de Vice City. Lucia y Jason, una pareja unida por el crimen, se ven envueltos en una conspiración que los lleva a recorrer todo el estado tras un golpe que sale mal.\r\n\r\nExplora el mundo más grande y detallado creado por Rockstar Games: desde las playas y la vida nocturna de Vice City hasta los pantanos y pueblos de Leonida. Planea golpes, recorre la ciudad en todo tipo de vehículos y descubre una historia de lealtad y ambición en la entrega más esperada de la saga.', 1499.00, 3, 10, 'PlayStation 5, Xbox Series X|S', 'Acción, Mundo abierto', 'M', '2026', '#c9349b', '#3B146B', 'assets/juegos/grand-theft-auto-vi/portada.webp', 'assets/juegos/grand-theft-auto-vi/fondo.webp', 'rz1B4B2yBZY'),
(18, 'Bloons TD 6', 'Los globos están invadiendo y solo un ejército de monos puede detenerlos. Coloca torres de monos a lo largo del camino para reventar cada globo antes de que llegue al final, en este juego de defensa de torres lleno de color y estrategia.\r\n\r\nElige entre decenas de monos, cada uno con tres caminos de mejora que lo transforman en algo cada vez más poderoso. Recluta héroes con habilidades únicas, enfrenta globos blindados, de camuflaje y los gigantescos MOAB, y supera cientos de mapas y modos de dificultad. Juega solo o en cooperativo con hasta 4 amigos y descubre la combinación perfecta para no dejar escapar ni un solo globo.', 249.00, 28, 11, 'PC, iOS, Android, PlayStation 4/5, Xbox One/Series X|S, Nintendo Switch', 'Estrategia, Defensa de Torres', 'E', '2018', '#37ff00', '#16537e', 'assets/juegos/bloons-td-6/portada.webp', 'assets/juegos/bloons-td-6/fondo.webp', 'dvcQY0v0Ow8'),
(19, 'Minecraft', 'Un mundo infinito, hecho de bloques, espera ser explorado. Recolecta recursos, construye desde una pequeña cabaña hasta un castillo gigantesco, y sobrevive a las criaturas que aparecen cuando cae la noche. Aquí no hay límites: todo lo que imagines, lo puedes crear.\r\n\r\nJuega en modo Supervivencia, donde deberás encontrar comida, fabricar herramientas y protegerte de zombis, esqueletos y creepers, o en modo Creativo, con recursos ilimitados para construir sin preocupaciones. Explora cuevas profundas, viaja al Nether y enfréntate al Dragón del End, solo o con amigos.', 499.00, 100, 12, 'PC, iOS, Android, PlayStation 4/5, Xbox One/Series X|S, Nintendo Switch, Nintendo Switch 2', 'Supervivencia, Aventura', 'E10+', '2011', '#5b8c32', NULL, 'assets/juegos/minecraft/portada.webp', 'assets/juegos/minecraft/fondo.png', 'MmB9b5njVbA'),
(20, 'God of War: Ragnarök', 'El Fimbulwinter cubre los Nueve Reinos y el Ragnarök se acerca. Kratos y su hijo Atreus deben recorrer reinos helados, bosques encantados y ciudades enanas en busca de respuestas, mientras las fuerzas de Asgard, lideradas por Odín y Thor, se preparan para la guerra.\r\n\r\nEnfrenta a dioses y criaturas legendarias con el Hacha Leviatán, las Espadas del Caos y el Escudo del Guardián, en combates intensos y brutales. Una historia sobre el destino, la familia y las decisiones de un padre y un hijo que deben elegir entre la profecía y su propio camino.', 999.00, 29, 13, 'PC, PlayStation 4, PlayStation 5', 'Acción, Aventura', 'M', '2022', '#6fa8dc', NULL, 'assets/juegos/god-of-war-ragnarok/portada.webp', 'assets/juegos/god-of-war-ragnarok/fondo.webp', 'g1wr0DfV73E'),
(21, 'Hollow Knight', 'Bajo el tranquilo pueblo de Bocasucia yace Hallownest, un antiguo reino de insectos hoy en ruinas y consumido por una misteriosa infección. Como el Caballero, un pequeño y silencioso guerrero, desciende a sus profundidades para descubrir sus secretos.\r\n\r\nExplora cavernas interconectadas, ciudades olvidadas y jardines venenosos en esta aventura de acción y exploración dibujada a mano. Domina un combate desafiante, descubre nuevas habilidades que te permiten llegar a zonas antes inalcanzables y enfréntate a más de 40 jefes, mientras desentrañas la triste historia del reino caído.', 299.00, 15, 14, 'PC, Wii U, PlayStation 4, Xbox One, Nintendo Switch,PlayStation 5, Xbox Series X|S, Nintendo Switch 2', 'Plataformas, Aventura, Indie', 'E10+', '2017', '#5a7bb5', '#0e1420', 'assets/juegos/hollow-knight/portada.webp', 'assets/juegos/hollow-knight/fondo.jpg', 'Y2amTl5lBYM'),
(22, 'The Last of Us Part I', 'Veinte años después de que un hongo devastara a la humanidad, los sobrevivientes viven en zonas de cuarentena controladas por el ejército. Joel, un contrabandista endurecido por la pérdida, recibe un encargo que cambiará su vida: escoltar a Ellie, una chica de 14 años, fuera de la zona de cuarentena.\r\n\r\nLo que comienza como un simple trabajo se convierte en un viaje brutal a través de unos Estados Unidos en ruinas, donde los infectados y otros sobrevivientes son igual de peligrosos. Una historia sobre la supervivencia, la pérdida y el vínculo entre dos personas en un mundo que ya no perdona.', 859.00, 14, 15, 'PlayStation 5, PC', 'Acción, Aventura, Supervivencia', 'M', '2022', '#c8873a', NULL, 'assets/juegos/the-last-of-us-part-i/portada.webp', 'assets/juegos/the-last-of-us-part-i/fondo.webp', '8a3Aga7JJgE'),
(23, 'Persona 4 Revival', 'Un estudiante de preparatoria se muda por un año al tranquilo pueblo rural de Inaba. Poco después de su llegada, una serie de misteriosos asesinatos sacude al lugar, y empieza a circular un extraño rumor: si miras una televisión apagada a medianoche en un día de lluvia, aparece en la pantalla tu alma gemela.\r\n\r\nJunto a sus nuevos amigos, descubre un mundo dentro de la televisión donde las víctimas desaparecen, y despierta el poder de las Personas para enfrentar a las Sombras que habitan ahí. Equilibra la vida escolar, los clubes y las amistades con la investigación en este remake completo del clásico de Atlus, reconstruido con gráficos totalmente nuevos.', 999.00, 20, 17, 'PC, PlayStation 5, Xbox Series X|S, Nintendo Switch 2', 'RPG, Aventura', 'M', '2027', '#ffe100', NULL, 'assets/juegos/persona-4-revival/portada.webp', 'assets/juegos/persona-4-revival/fondo.webp', 'Bo-lYhPhDW0'),
(24, 'PEAK', 'Eres parte de un grupo de exploradores que naufragó en una misteriosa isla. Su única esperanza de ser rescatados está en la cima de la enorme montaña que domina el lugar, y la única forma de llegar es escalando.\r\n\r\nTrepa paredes de roca, cruza selvas, playas y laderas nevadas, y administra tu energía, tu comida y tus heridas para no caer en el intento. Juega solo o en cooperativo con hasta 4 amigos: ayúdense a subir, compartan provisiones y rescaten a quien se quede atrás. La isla cambia cada día, así que cada escalada es una nueva aventura... y una nueva oportunidad de caer de forma espectacular.', 119.00, 37, 18, 'PC, PlayStation 5, Xbox Series X|S, Nintendo Switch 2', 'Plataformas, Aventura, Indie', 'E10+', '2025', '#f28c1c', NULL, 'assets/juegos/peak/portada.webp', 'assets/juegos/peak/fondo.webp', 'jrlUVhLBjG0'),
(25, 'The Legend of Zelda: Breath of the Wild', 'Despierta tras un sueño de cien años en un Hyrule devastado por el Cataclismo. Link no recuerda nada, pero una voz lo guía hacia un objetivo: derrotar a Ganon antes de que consuma el reino. Explora un mundo abierto sin límites: escala cualquier montaña, planea desde lo más alto, cocina con lo que encuentres y enfrenta a los enemigos a tu manera. Resuelve más de cien santuarios, libera a las cuatro Bestias Divinas y descubre a tu propio ritmo lo que ocurrió hace un siglo.', 1199.00, 12, 1, 'Nintendo Switch, Nintendo Switch 2, Wii U', 'Rompecabezas, Aventura', 'E10+', '2017', '#3fb8c4', '#0F2A30', 'assets/juegos/the-legend-of-zelda-breath-of-the-wild/portada.webp', 'assets/juegos/the-legend-of-zelda-breath-of-the-wild/fondo.webp', 'zw47_q9wbBE'),
(26, 'The Legend of Zelda: Tears of the Kingdom', 'Bajo el castillo de Hyrule despierta un mal ancestral, y una catástrofe desgarra el reino: islas flotantes surgen en el cielo y abismos oscuros se abren bajo la tierra. Con el brazo transformado por un poder misterioso, Link deberá encontrar a Zelda y descubrir los secretos de los zonnan. Fusiona armas, construye vehículos con la Ultramano, atraviesa techos con Ascenso y explora tres capas de un mundo inmenso: el cielo, la superficie y las profundidades.', 1399.00, 18, 1, 'Nintendo Switch, Nintendo Switch 2', 'Rompecabezas, Aventura', 'E10+', '2023', '#5fd99a', '#10201A', 'assets/juegos/the-legend-of-zelda-tears-of-the-kingdom/portada.webp', 'assets/juegos/the-legend-of-zelda-tears-of-the-kingdom/fondo-1795205906.webp', 'uHGShqcAHlQ'),
(27, 'Halo: Campaign Evolved', 'La historia que lo empezó todo, reconstruida desde cero. Tras escapar de la caída de Reach, el Jefe Maestro y Cortana llegan a un misterioso mundo anillo donde el Covenant y una amenaza ancestral los esperan. Revive la campaña original con gráficos de nueva generación, combate renovado y misiones nuevas que amplían la historia.', 1199.00, 6, 19, 'Xbox Series X|S, PC, PlayStation 5', 'Shooter en primera persona', 'M', '2026', '#5e8c4a', '#121A12', 'assets/juegos/halo-campaign-evolved/portada.webp', 'assets/juegos/halo-campaign-evolved/fondo.webp', '5KhzCSeZxAU'),
(28, 'Halo 2', 'El Covenant ha llegado a la Tierra. Mientras el Jefe Maestro defiende el planeta, un guerrero caído en desgracia, el Inquisidor, recibe una misión sagrada que lo llevará a cuestionar todo en lo que cree. Dos protagonistas, dos bandos y un nuevo anillo Halo que guarda la clave para salvar o destruir la galaxia.', 349.00, 7, 19, 'PC, Xbox, Xbox One', 'Shooter en primera persona', 'M', '2004', '#8e6bc9', '#17121F', 'assets/juegos/halo-2/portada.webp', 'assets/juegos/halo-2/fondo.webp', '4ycOwVPqbxA'),
(29, 'Halo 3', 'Termina la pelea. El Jefe Maestro regresa a la Tierra para detener al Covenant y al Flood de una vez por todas. Con la ayuda del Inquisidor, viajará hasta el Arca, más allá de la galaxia, para enfrentar el destino de la humanidad. Incluye multijugador, Forge y modo Cine.', 399.00, 10, 19, 'PC, Xbox 360, Xbox One', 'Shooter en primera persona', 'M', '2007', '#c9a54a', '#1C170D', 'assets/juegos/halo-3/portada.webp', 'assets/juegos/halo-3/fondo.webp', 'T9Ezd2FqxAU'),
(30, 'Halo 4', 'Años después de la guerra, el Jefe Maestro despierta a la deriva junto a Cortana, cuya mente comienza a deteriorarse. Atrapados en el planeta Forerunner Requiem, enfrentarán a un antiguo enemigo, el Didacta, mientras el Jefe descubre qué significa ser humano. Una nueva trilogía comienza.', 449.00, 26, 19, 'PC, Xbox 360, Xbox One', 'Shooter en primera persona', 'M', '2012', '#3fa9e0', '#0D1620', 'assets/juegos/halo-4/portada.webp', 'assets/juegos/halo-4/fondo.webp', 'GO376G4tbGM'),
(31, 'Halo Infinite', 'Cuando toda esperanza parece perdida, el Jefe Maestro regresa para enfrentar a los Desterrados, el enemigo más despiadado que ha conocido. Explora el anillo Zeta Halo en la campaña más abierta de la saga, usa el gancho de agarre para moverte por el campo de batalla y descubre los secretos del anillo. Incluye multijugador gratuito con partidas por temporadas.', 1099.00, 20, 19, 'PC, Xbox One, Xbox Series X|S', 'Shooter en primera persona', 'T', '2021', '#4a9ad9', '#0E1724', 'assets/juegos/halo-infinite/portada.webp', 'assets/juegos/halo-infinite/fondo.webp', 'PyMlV5_HRWk'),
(32, 'Kirby and the Forgotten Land', 'Un misterioso vórtice transporta a Kirby a un mundo olvidado, lleno de ruinas de una civilización perdida y de la naturaleza que la ha reclamado. Recorre escenarios 3D, rescata a los Waddle Dee secuestrados por la Manada Bestial y usa el nuevo modo Bocarrellena para tragarte objetos enormes y transformarte en coche, cono de tránsito o máquina expendedora. Incluye cooperativo para dos jugadores.', 1199.00, 16, 20, 'Nintendo Switch, Nintendo Switch 2', 'Plataformas, Aventura', 'E10+', '2022', '#f28ab2', '#1F2A1A', 'assets/juegos/kirby-and-the-forgotten-land/portada.webp', 'assets/juegos/kirby-and-the-forgotten-land/fondo.webp', 'H3LAkr0ANgw'),
(33, 'Kirby Air Riders', '¡A toda velocidad! Súbete a una Air Ride Machine y compite en carreras llenas de caos, donde basta un solo botón para frenar, derrapar y absorber a tus rivales. Elige entre Kirby, Meta Knight, King Dedede y muchos más, cada uno con su propio estilo de manejo. Incluye el regreso del modo City Trial y partidas en línea con amigos.', 1399.00, 20, 21, 'Nintendo Switch 2', 'Carreras', 'E', '2025', '#ffc83d', '#0F1A33', 'assets/juegos/kirby-air-riders/portada.webp', 'assets/juegos/kirby-air-riders/fondo.webp', 'z3puFLFDfxE'),
(34, 'Kirby\'s Return to Dream Land Deluxe', 'Una nave misteriosa se estrella en Dream Land y su tripulante, Magolor, necesita ayuda para reparar las piezas perdidas. Kirby y sus amigos se lanzan a la aventura en un plataformas 2D clásico, con habilidades de copia nuevas y superhabilidades capaces de arrasar el escenario. Juega hasta con 4 personas, disfruta los minijuegos de Merry Magoland y descubre el epílogo exclusivo de Magolor.', 1049.00, 12, 20, 'Nintendo Switch, Nintendo Switch 2', 'Plataformas, Aventura', 'E10+', '2023', '#8c6ce0', '#16122A', 'assets/juegos/kirby-s-return-to-dream-land-deluxe/portada.webp', 'assets/juegos/kirby-s-return-to-dream-land-deluxe/fondo.webp', 'wqVGD_aNLdM');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuarios`
--

CREATE TABLE `usuarios` (
  `id` int NOT NULL,
  `nombre` varchar(100) NOT NULL,
  `correo` varchar(100) NOT NULL,
  `contrasena` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `nacimiento` date NOT NULL,
  `tarjeta` varchar(19) NOT NULL,
  `direccion` varchar(150) NOT NULL,
  `admin` tinyint(1) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Volcado de datos para la tabla `usuarios`
--

INSERT INTO `usuarios` (`id`, `nombre`, `correo`, `contrasena`, `nacimiento`, `tarjeta`, `direccion`, `admin`) VALUES
(2, 'Mauricio Sánchez', 'mausdlt@gmail.com', '$2y$12$hFJa1Qk739OsS4gO0b6HAO5RteZh8y8aPTSpxQSRm3bSkoTxTB9Di', '2005-11-08', '5288 7747 5253 5031', 'Av. Universidad Anáhuac 46, Lomas Anahuac, 52786 Lomas Anáhuac, Méx.', 0),
(3, 'Mauricio Sánchez', 'admin@gamecat.com', '$2y$12$g5uFqoOp06DuO6q.VDsOvOobmNn53cmEpWcJRLIsxHx.W3J6dJHUi', '2005-11-08', '5288 7747 5253 5031', 'Av. Universidad Anáhuac 46, Lomas Anahuac, 52786 Lomas Anáhuac, Méx.', 1),
(4, 'Mario Ramírez', 'marioramirez@gmail.com', '$2y$12$8GlXc.9xOvHH7wUu/3qP/eT.6ks3KVYqeVND0oDwseqZDkz5j4Aim', '2004-09-04', '1234 5678 9012', 'Av. Universidad Anáhuac 46, Lomas Anahuac, 52786', 0),
(5, 'Ana Loyola', 'ana_loyo@anahuac.mx', '$2y$12$tPDgyHB2fg3ylYMM/XNxHOKUYfjO/GnnUvdwXWXkqHTsbdv11E7j6', '2004-02-07', '8378020029288765', 'Lomas Verdes', 0),
(6, 'Maria Vairo', 'mariavairo@correo.com', '$2y$12$xEVEGDmmREWMiyxDlVP0w.QPYiQK428dT1JgHZpOSO.mQuvFPxQU2', '2003-06-28', '1234 5678 9012', 'Central Park', 0),
(7, 'Diego Rojas Lara', 'diegorojas@anahuac.mx', '$2y$12$f5o4edYEglnkGMKZqanp2OXyQ77cQrG7PBTucWgEenwktA0ynUD1C', '2005-01-19', '9638527411597536', 'Enrique segoviano #8', 0),
(8, 'Mónica De La Torre', 'monidlt@me.com', '$2y$12$l10oIvjCHiZK74af6np2TOABzxjvsUO5U2dKC0Xg4g5cpBhrOp0rC', '1975-06-07', '1234 5678 9012', 'calle falsa 123', 0),
(9, 'Ricardo Sánchez ', 'ricardosanchez@correo.com', '$2y$12$3S4tUaKiTjePEMRzPP9QlOHj0eUX9PTp3.cYJll6IHw0qWzYvEAE6', '1967-10-23', '8530345276904321', 'Wall Street 3452', 0),
(10, 'Administrador Prueba', 'adminprueba@gamecat.com', '$2y$12$bVqVRyMaIcOQ/wqvZNxhx.13o05pX7Xdl2OGarT.OzR5s5/bNcvYO', '2005-11-08', '1234 5678 9012', 'GameCat St. 341', 1);

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `carrito`
--
ALTER TABLE `carrito`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `id_usuario` (`id_usuario`,`id_producto`),
  ADD KEY `carrito-producto` (`id_producto`);

--
-- Indices de la tabla `desarrolladores`
--
ALTER TABLE `desarrolladores`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `favoritos`
--
ALTER TABLE `favoritos`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `usuario_producto` (`id_usuario`,`id_producto`),
  ADD KEY `idx_producto` (`id_producto`);

--
-- Indices de la tabla `fotos_producto`
--
ALTER TABLE `fotos_producto`
  ADD PRIMARY KEY (`id`),
  ADD KEY `foto-producto` (`id_producto`);

--
-- Indices de la tabla `historial`
--
ALTER TABLE `historial`
  ADD PRIMARY KEY (`id`),
  ADD KEY `historial-usuario` (`id_usuario`),
  ADD KEY `historial-producto` (`id_producto`);

--
-- Indices de la tabla `productos`
--
ALTER TABLE `productos`
  ADD PRIMARY KEY (`id`),
  ADD KEY `producto-desarrollador` (`id_desarrollador`);

--
-- Indices de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `correo` (`correo`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `carrito`
--
ALTER TABLE `carrito`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT de la tabla `desarrolladores`
--
ALTER TABLE `desarrolladores`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT de la tabla `favoritos`
--
ALTER TABLE `favoritos`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;

--
-- AUTO_INCREMENT de la tabla `fotos_producto`
--
ALTER TABLE `fotos_producto`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=171;

--
-- AUTO_INCREMENT de la tabla `historial`
--
ALTER TABLE `historial`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT de la tabla `productos`
--
ALTER TABLE `productos`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=35;

--
-- AUTO_INCREMENT de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `carrito`
--
ALTER TABLE `carrito`
  ADD CONSTRAINT `carrito-producto` FOREIGN KEY (`id_producto`) REFERENCES `productos` (`id`) ON DELETE CASCADE ON UPDATE RESTRICT,
  ADD CONSTRAINT `carrito-usuario` FOREIGN KEY (`id_usuario`) REFERENCES `usuarios` (`id`) ON DELETE CASCADE ON UPDATE RESTRICT;

--
-- Filtros para la tabla `favoritos`
--
ALTER TABLE `favoritos`
  ADD CONSTRAINT `id-producto` FOREIGN KEY (`id_producto`) REFERENCES `productos` (`id`) ON DELETE CASCADE ON UPDATE RESTRICT,
  ADD CONSTRAINT `id-usuario` FOREIGN KEY (`id_usuario`) REFERENCES `usuarios` (`id`) ON DELETE CASCADE ON UPDATE RESTRICT;

--
-- Filtros para la tabla `fotos_producto`
--
ALTER TABLE `fotos_producto`
  ADD CONSTRAINT `foto-producto` FOREIGN KEY (`id_producto`) REFERENCES `productos` (`id`) ON DELETE CASCADE ON UPDATE RESTRICT;

--
-- Filtros para la tabla `historial`
--
ALTER TABLE `historial`
  ADD CONSTRAINT `historial-producto` FOREIGN KEY (`id_producto`) REFERENCES `productos` (`id`) ON DELETE RESTRICT ON UPDATE RESTRICT,
  ADD CONSTRAINT `historial-usuario` FOREIGN KEY (`id_usuario`) REFERENCES `usuarios` (`id`) ON DELETE RESTRICT ON UPDATE RESTRICT;

--
-- Filtros para la tabla `productos`
--
ALTER TABLE `productos`
  ADD CONSTRAINT `producto-desarrollador` FOREIGN KEY (`id_desarrollador`) REFERENCES `desarrolladores` (`id`) ON DELETE RESTRICT ON UPDATE RESTRICT;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
