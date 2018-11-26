-- phpMyAdmin SQL Dump
-- version 4.8.2
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 26-11-2018 a las 00:53:40
-- Versión del servidor: 10.1.34-MariaDB
-- Versión de PHP: 7.2.7

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `compuactual`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `categoria`
--

CREATE TABLE `categoria` (
  `id` int(11) NOT NULL,
  `nombre` text COLLATE utf8_spanish_ci NOT NULL,
  `fecha` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `categoria`
--

INSERT INTO `categoria` (`id`, `nombre`, `fecha`) VALUES
(3, 'Electrónica', '2018-10-25 15:37:08'),
(4, 'Deportes', '2018-08-24 20:45:41'),
(5, 'Otros', '2018-08-24 20:45:45'),
(6, 'Didacticos', '2018-08-29 16:53:12'),
(27, 'BEBE', '2018-10-25 15:47:45'),
(28, 'Papeleria', '2018-11-01 16:01:41'),
(29, 'Herramientas de Jardín', '2018-11-06 03:12:34');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `cliente`
--

CREATE TABLE `cliente` (
  `id` int(11) NOT NULL,
  `nombre_cliente` text COLLATE utf8_spanish_ci NOT NULL,
  `numero_cliente` int(11) NOT NULL,
  `rfc` varchar(13) COLLATE utf8_spanish_ci NOT NULL,
  `email` text COLLATE utf8_spanish_ci NOT NULL,
  `telefono` text COLLATE utf8_spanish_ci NOT NULL,
  `fecha` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `cliente`
--

INSERT INTO `cliente` (`id`, `nombre_cliente`, `numero_cliente`, `rfc`, `email`, `telefono`, `fecha`) VALUES
(1, 'Cliente', 1, 'SN', 'NOTIENECORREO@hotmai.com', '(000) 000-0000', '2018-10-31 06:08:13'),
(16, 'Presidencia Municipal Zaragoza', 1, 'MPZ870425BT6', 'PUMA123@HOTMAIL.COM', '(233) 125-4678', '2018-10-25 17:39:54'),
(17, 'Pedro Fernandez', 3, '741258963ZADS', 'pedro@hotmail.com', '(233) 142-7896', '2018-10-31 03:53:22'),
(18, 'Julian Flores Lucas', 4, '741258963ASDC', 'julianFL@hotmail.com', '(741) 233-1458', '2018-10-31 03:54:49'),
(19, 'Mauricio Moreno Prieto', 6, '147852369QWER', 'mau16@hotmail.com', '(222) 412-3658', '2018-10-31 04:03:18'),
(21, 'Luis Fernando Juarez', 7, '741258963ASDC', 'mau16@hotmail.com', '(789) 456-1234', '2018-10-31 04:05:45'),
(22, 'Jose Juarez Leon', 8, '147852369QWER', 'julianFL@hotmail.com', '(789) 654-1345', '2018-10-31 04:12:32');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `orden`
--

CREATE TABLE `orden` (
  `id` int(11) NOT NULL,
  `id_proveedor` int(11) NOT NULL,
  `productos` text COLLATE utf8_spanish_ci NOT NULL,
  `total` float NOT NULL,
  `fecha` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `orden`
--

INSERT INTO `orden` (`id`, `id_proveedor`, `productos`, `total`, `fecha`) VALUES
(1, 2, '[{\"descripcion\":\"Osos grandes\",\"cantidad\":\"1\",\"precio\":\"75\"},{\"descripcion\":\"Zacapuntas\",\"cantidad\":\"25\",\"precio\":\"456\"},{\"descripcion\":\"Osos pequeños\",\"cantidad\":\"3\",\"precio\":\"756\"},{\"descripcion\":\"Zacapuntas\",\"cantidad\":\"1\",\"precio\":\"456\"}]', 1743, '2018-11-16 21:53:17'),
(2, 2, '[{\"descripcion\":\"Osos grandes\",\"cantidad\":\"2\",\"precio\":\"256\"},{\"descripcion\":\"Carros azules\",\"cantidad\":\"2\",\"precio\":\"456\"}]', 712, '2018-11-16 21:55:24');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `producto`
--

CREATE TABLE `producto` (
  `id` int(11) NOT NULL,
  `id_categoria` int(11) NOT NULL,
  `id_subcategoria` int(11) NOT NULL,
  `codigo` text COLLATE utf8_spanish_ci NOT NULL,
  `descripcion` text COLLATE utf8_spanish_ci NOT NULL,
  `imagen` text COLLATE utf8_spanish_ci NOT NULL,
  `stock` int(11) NOT NULL,
  `precio_compra` float NOT NULL,
  `precio_venta` float NOT NULL,
  `fecha` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `id_proveedor` int(11) NOT NULL,
  `nuevaclave` int(8) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `producto`
--

INSERT INTO `producto` (`id`, `id_categoria`, `id_subcategoria`, `codigo`, `descripcion`, `imagen`, `stock`, `precio_compra`, `precio_venta`, `fecha`, `id_proveedor`, `nuevaclave`) VALUES
(7, 4, 30, '202', 'Muñecos', 'vistas/img/productos/default/anonymous.png', 9, 150, 170, '2018-11-21 20:12:18', 0, 12365478),
(11, 3, 31, '206', 'Osos', 'vistas/img/productos/default/anonymous.png', 46, 150, 180, '2018-11-21 20:12:18', 0, 21474836),
(15, 3, 0, '902', 'Muñeca', 'vistas/img/productos/default/anonymous.png', 29, 150, 165, '2018-11-21 23:19:44', 0, 74125896),
(17, 27, 33, '801', 'Mi prueba numerica', 'vistas/img/productos/default/anonymous.png', 38, 200, 220, '2018-11-21 23:19:44', 0, 0),
(22, 3, 39, '1701', 'Juguetero', 'vistas/img/productos/1701/201.png', 45, 150, 165, '2018-11-21 23:19:44', 0, 0),
(24, 27, 31, '2701', 'SONAJA MANITAS', 'vistas/img/productos/default/anonymous.png', 17, 12.5, 24.5, '2018-11-21 20:12:19', 0, 74125897),
(25, 27, 39, '2702', 'SONAJA FLOR', 'vistas/img/productos/default/anonymous.png', 18, 11.5, 22.5, '2018-11-21 23:19:44', 0, 0),
(26, 27, 32, '2703', 'SONAJA DOBLE CARITA', 'vistas/img/productos/default/anonymous.png', 12, 16.5, 28.5, '2018-11-14 04:29:57', 0, 74125897),
(27, 3, 30, '302', 'Muñeca sirena', 'vistas/img/productos/default/anonymous.png', 68, 20, 75, '2018-11-14 04:29:57', 0, 21474836),
(28, 3, 39, '303', 'Kingston usb', 'vistas/img/productos/default/anonymous.png', 60, 40, 90, '2018-11-14 19:09:06', 0, 98745612),
(29, 3, 38, '304', 'Usb', 'vistas/img/productos/default/anonymous.png', 75, 75, 82.5, '2018-11-07 18:20:16', 0, 74125891),
(30, 3, 38, '305', 'Radio usb', 'vistas/img/productos/305/255.png', 75, 78, 85.8, '2018-11-09 22:39:51', 0, 14785236),
(32, 29, 40, '2901', 'Tijeras para podar', 'vistas/img/productos/2901/332.png', 75, 159, 190.8, '2018-11-14 01:57:34', 0, 12457896),
(33, 4, 30, '203', 'balon', 'vistas/img/productos/203/374.jpg', 10, 75, 82.5, '2018-11-14 18:18:31', 0, 74125896);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `promocion`
--

CREATE TABLE `promocion` (
  `id_promocion` int(11) NOT NULL,
  `codigo` int(11) NOT NULL,
  `nombre_promocion` text COLLATE utf8_spanish_ci NOT NULL,
  `precio_promocion` float NOT NULL,
  `fecha_inicio` date NOT NULL,
  `fecha_fin` date NOT NULL,
  `id_producto` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `promocion`
--

INSERT INTO `promocion` (`id_promocion`, `codigo`, `nombre_promocion`, `precio_promocion`, `fecha_inicio`, `fecha_fin`, `id_producto`) VALUES
(65, 1, 'Rebajas de buen fin', 25, '2018-11-20', '2018-11-24', 7),
(66, 1, 'Rebajas de buen fin', 25, '2018-11-20', '2018-11-24', 33),
(67, 1, 'Rebajas de buen fin', 25, '2018-11-20', '2018-11-24', 11),
(68, 2, 'Rebajas de buen fin', 256, '2018-11-21', '2018-11-23', 27),
(69, 2, 'Rebajas de buen fin', 256, '2018-11-21', '2018-11-23', 28),
(70, 3, 'Rebajas de buen fin', 258, '2018-11-25', '2018-11-25', 33),
(71, 3, 'Rebajas de buen fin', 258, '2018-11-25', '2018-11-25', 7),
(72, 3, 'Rebajas de buen fin', 258, '2018-11-25', '2018-11-25', 28);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `proveedor`
--

CREATE TABLE `proveedor` (
  `id` int(11) NOT NULL,
  `nombre_proveedor` text COLLATE utf8_spanish_ci NOT NULL,
  `producto` text COLLATE utf8_spanish_ci NOT NULL,
  `descripcion` varchar(100) COLLATE utf8_spanish_ci NOT NULL,
  `telefono` text COLLATE utf8_spanish_ci NOT NULL,
  `correo` text COLLATE utf8_spanish_ci NOT NULL,
  `fecha` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `proveedor`
--

INSERT INTO `proveedor` (`id`, `nombre_proveedor`, `producto`, `descripcion`, `telefono`, `correo`, `fecha`) VALUES
(2, 'Maria flores', 'Libretas,Zacapuntas', 'Es de Teziutlan', '(789) 456-3211', 'jj@hotmail.com', '2018-11-07 17:33:30'),
(7, 'JUAN MANUEL PÉREZ RAMON', 'Osos zapatos ropa Rosas', 'ES DE ZACATECAS Y CONDUCE UN CARRO AZUL', '(233) 123-1478', 'NOTIENE@HOTMAIL.COM', '2018-10-26 02:56:54'),
(8, 'Zacarias Flores', 'Osos grades', 'Es del estado de México', '(551) 234-5689', 'zaca_flores@gmail.com', '2018-11-14 18:33:04');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `subcategoria`
--

CREATE TABLE `subcategoria` (
  `id` int(11) NOT NULL,
  `id_categoria` int(11) NOT NULL,
  `nombre` text COLLATE utf8_spanish_ci NOT NULL,
  `fecha` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `subcategoria`
--

INSERT INTO `subcategoria` (`id`, `id_categoria`, `nombre`, `fecha`) VALUES
(30, 4, 'Futbol', '2018-11-05 23:31:10'),
(31, 10, 'Juguetes', '2018-11-05 23:56:07'),
(33, 5, 'Zapatos', '2018-11-05 23:56:17'),
(34, 30, 'comedia numero uno', '2018-10-25 04:30:16'),
(37, 3, 'Bocina', '2018-10-25 04:47:15'),
(39, 3, 'Memoria usb', '2018-11-01 03:32:34'),
(40, 29, 'Rosas', '2018-11-14 01:27:42');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuarios`
--

CREATE TABLE `usuarios` (
  `id` int(11) NOT NULL,
  `nombre` text COLLATE utf8_spanish_ci NOT NULL,
  `usuario` text COLLATE utf8_spanish_ci NOT NULL,
  `password` text COLLATE utf8_spanish_ci NOT NULL,
  `perfil` text COLLATE utf8_spanish_ci NOT NULL,
  `foto` text COLLATE utf8_spanish_ci NOT NULL,
  `estado` int(11) NOT NULL,
  `ultimo_login` datetime NOT NULL,
  `fecha` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `usuarios`
--

INSERT INTO `usuarios` (`id`, `nombre`, `usuario`, `password`, `perfil`, `foto`, `estado`, `ultimo_login`, `fecha`) VALUES
(34, 'admin', 'admin', '$2a$07$asxx54ahjppf45sd87a5auXBm1Vr2M1NV5t/zNQtGHGpS5fFirrbG', 'Administrador', 'vistas/img/usuarios/admin/389.jpg', 1, '2018-11-25 23:55:08', '2018-11-26 05:55:08'),
(35, 'vendedor', 'vendedor', '$2a$07$asxx54ahjppf45sd87a5auF3SxTPxKrykQWP2opioJ/PI/QjcniEW', 'Vendedor', '', 1, '2018-11-25 20:37:10', '2018-11-26 02:37:10'),
(36, 'agente', 'agente', '$2a$07$asxx54ahjppf45sd87a5auu3CrZUJWQyy3d0qBQuQ40X2N5KmbmwG', 'Agente', '', 1, '2018-10-30 00:54:26', '2018-10-30 06:54:26'),
(37, 'inventario', 'inventario', '$2a$07$asxx54ahjppf45sd87a5auu8kcJxlm.W6Ki52dSHYDvN7zsFyrcp6', 'Inventario', '', 1, '2018-10-30 00:54:45', '2018-10-30 06:54:45'),
(38, 'contador', 'contador', '$2a$07$asxx54ahjppf45sd87a5auHoBhCVazvrxYw2YPz7NW1/JLqzy9K42', 'Contador', '', 1, '2018-10-30 00:54:53', '2018-10-30 06:54:53');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `venta`
--

CREATE TABLE `venta` (
  `id` int(11) NOT NULL,
  `codigo_venta` int(11) NOT NULL,
  `producto` text COLLATE utf8_spanish_ci NOT NULL,
  `impuesto` float NOT NULL,
  `subtotal` float NOT NULL,
  `total` float NOT NULL,
  `metodo_pago` text COLLATE utf8_spanish_ci NOT NULL,
  `id_vendedor` int(11) NOT NULL,
  `id_cliente` int(11) NOT NULL,
  `fecha` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `venta`
--

INSERT INTO `venta` (`id`, `codigo_venta`, `producto`, `impuesto`, `subtotal`, `total`, `metodo_pago`, `id_vendedor`, `id_cliente`, `fecha`) VALUES
(24, 1, '[{\"id\":\"7\",\"descripcion\":\"Muñecos\",\"cantidad\":\"1\",\"stock\":\"113\",\"precio\":\"170\",\"total\":\"170\"},{\"id\":\"11\",\"descripcion\":\"Osos\",\"cantidad\":\"1\",\"stock\":\"55\",\"precio\":\"180\",\"total\":\"180\"},{\"id\":\"15\",\"descripcion\":\"Muñeca\",\"cantidad\":\"1\",\"stock\":\"46\",\"precio\":\"165\",\"total\":\"165\"},{\"id\":\"17\",\"descripcion\":\"Mi prueba numerica\",\"cantidad\":\"1\",\"stock\":\"46\",\"precio\":\"220\",\"total\":\"220\"},{\"id\":\"7\",\"descripcion\":\"Muñecos\",\"cantidad\":\"1\",\"stock\":\"100\",\"precio\":\"170\",\"total\":\"170\"},{\"id\":\"27\",\"descripcion\":\"Muñeca sirena\",\"cantidad\":\"1\",\"stock\":\"74\",\"precio\":\"75\",\"total\":\"75\"}]', 124.828, 780.172, 980, 'Efectivo', 34, 16, '2018-11-13 16:40:00'),
(25, 2, '[{\"id\":\"7\",\"descripcion\":\"Muñecos\",\"cantidad\":\"1\",\"stock\":\"112\",\"precio\":\"170\",\"total\":\"170\"},{\"id\":\"22\",\"descripcion\":\"Juguetero\",\"cantidad\":\"1\",\"stock\":\"48\",\"precio\":\"165\",\"total\":\"165\"},{\"id\":\"17\",\"descripcion\":\"Mi prueba numerica\",\"cantidad\":\"1\",\"stock\":\"45\",\"precio\":\"220\",\"total\":\"220\"},{\"id\":\"15\",\"descripcion\":\"Muñeca\",\"cantidad\":\"1\",\"stock\":\"45\",\"precio\":\"165\",\"total\":\"165\"}]', 99.3103, 620.69, 720, 'Efectivo', 34, 1, '2018-11-07 07:01:17'),
(26, 3, '[{\"id\":\"7\",\"descripcion\":\"Muñecos\",\"cantidad\":\"3\",\"stock\":\"109\",\"precio\":\"170\",\"total\":\"510\"},{\"id\":\"11\",\"descripcion\":\"Osos\",\"cantidad\":\"1\",\"stock\":\"54\",\"precio\":\"180\",\"total\":\"180\"},{\"id\":\"15\",\"descripcion\":\"Muñeca\",\"cantidad\":\"1\",\"stock\":\"44\",\"precio\":\"165\",\"total\":\"165\"}]', 117.931, 737.069, 855, 'Efectivo', 34, 1, '2018-11-07 17:04:57'),
(27, 4, '[{\"id\":\"7\",\"descripcion\":\"Muñecos\",\"cantidad\":\"1\",\"stock\":\"108\",\"precio\":\"170\",\"total\":\"170\"},{\"id\":\"11\",\"descripcion\":\"Osos\",\"cantidad\":\"1\",\"stock\":\"53\",\"precio\":\"180\",\"total\":\"180\"},{\"id\":\"15\",\"descripcion\":\"Muñeca\",\"cantidad\":\"1\",\"stock\":\"43\",\"precio\":\"165\",\"total\":\"165\"}]', 71.0345, 443.966, 515, 'Efectivo', 34, 19, '2018-11-07 17:46:14'),
(28, 5, '[{\"id\":\"7\",\"descripcion\":\"Muñecos\",\"cantidad\":\"5\",\"stock\":\"103\",\"precio\":\"170\",\"total\":\"850\"},{\"id\":\"11\",\"descripcion\":\"Osos\",\"cantidad\":\"4\",\"stock\":\"49\",\"precio\":\"180\",\"total\":\"720\"},{\"id\":\"15\",\"descripcion\":\"Muñeca\",\"cantidad\":\"3\",\"stock\":\"40\",\"precio\":\"165\",\"total\":\"495\"}]', 284.828, 1780.17, 2065, 'Efectivo', 34, 1, '2018-11-07 19:09:46'),
(29, 6, '[{\"id\":\"7\",\"descripcion\":\"Muñecos\",\"cantidad\":\"1\",\"stock\":\"102\",\"precio\":\"170\",\"total\":\"170\"}]', 23.4483, 146.552, 170, 'Efectivo', 34, 1, '2018-11-07 19:12:41'),
(31, 8, '[{\"id\":\"7\",\"descripcion\":\"Muñecos\",\"cantidad\":\"1\",\"stock\":\"101\",\"precio\":\"170\",\"total\":\"170\"},{\"id\":\"15\",\"descripcion\":\"Muñeca\",\"cantidad\":\"1\",\"stock\":\"39\",\"precio\":\"165\",\"total\":\"165\"},{\"id\":\"26\",\"descripcion\":\"SONAJA DOBLE CARITA\",\"cantidad\":\"1\",\"stock\":\"13\",\"precio\":\"28.5\",\"total\":\"28.5\"}]', 50.1379, 313.362, 363.5, 'Efectivo', 34, 1, '2018-11-09 05:31:43'),
(32, 9, '[{\"id\":\"\",\"descripcion\":\"Muñecos\",\"cantidad\":\"3\",\"stock\":\"98\",\"precio\":\"\",\"total\":\"510\"},{\"id\":\"\",\"descripcion\":\"Juguetero\",\"cantidad\":\"1\",\"stock\":\"47\",\"precio\":\"\",\"total\":\"165\"},{\"id\":\"\",\"descripcion\":\"SONAJA FLOR\",\"cantidad\":\"5\",\"stock\":\"16\",\"precio\":\"\",\"total\":\"112.5\"}]', 108.621, 678.879, 787.5, 'Efectivo', 34, 1, '2018-11-14 04:05:46'),
(33, 10, '[{\"id\":\"\",\"descripcion\":\"Mi prueba numerica\",\"cantidad\":\"1\",\"stock\":\"44\",\"precio\":\"\",\"total\":\"220\"},{\"id\":\"\",\"descripcion\":\"Muñecos\",\"cantidad\":\"1\",\"stock\":\"100\",\"precio\":\"\",\"total\":\"170\"}]', 53.7931, 336.207, 390, 'Efectivo', 34, 1, '2018-11-09 05:50:16'),
(34, 11, '[{\"id\":\"25\",\"descripcion\":\"SONAJA FLOR\",\"cantidad\":\"1\",\"stock\":\"20\",\"precio\":\"22.5\",\"total\":\"22.5\"},{\"id\":\"17\",\"descripcion\":\"Mi prueba numerica\",\"cantidad\":\"1\",\"stock\":\"44\",\"precio\":\"220\",\"total\":\"220\"},{\"id\":\"22\",\"descripcion\":\"Juguetero\",\"cantidad\":\"1\",\"stock\":\"47\",\"precio\":\"165\",\"total\":\"165\"}]', 56.2069, 351.293, 407.5, 'Efectivo', 34, 1, '2018-11-09 06:30:50'),
(35, 12, '[{\"id\":\"11\",\"descripcion\":\"Osos\",\"cantidad\":\"6\",\"stock\":\"49\",\"precio\":\"180\",\"total\":\"1080\"},{\"id\":\"15\",\"descripcion\":\"Muñeca\",\"cantidad\":\"8\",\"stock\":\"38\",\"precio\":\"165\",\"total\":\"1320\"},{\"id\":\"24\",\"descripcion\":\"SONAJA MANITAS\",\"cantidad\":\"5\",\"stock\":\"20\",\"precio\":\"24.5\",\"total\":\"122.5\"},{\"id\":\"17\",\"descripcion\":\"Mi prueba numerica\",\"cantidad\":\"5\",\"stock\":\"41\",\"precio\":\"220\",\"total\":\"1100\"},{\"id\":\"27\",\"descripcion\":\"Muñeca sirena\",\"cantidad\":\"6\",\"stock\":\"68\",\"precio\":\"75\",\"total\":\"450\"},{\"id\":\"28\",\"descripcion\":\"Kingston usb\",\"cantidad\":\"25\",\"stock\":\"50\",\"precio\":\"90\",\"total\":\"2250\"},{\"id\":\"26\",\"descripcion\":\"SONAJA DOBLE CARITA\",\"cantidad\":\"1\",\"stock\":\"12\",\"precio\":\"28.5\",\"total\":\"28.5\"},{\"id\":\"25\",\"descripcion\":\"SONAJA FLOR\",\"cantidad\":\"1\",\"stock\":\"19\",\"precio\":\"22.5\",\"total\":\"22.5\"}]', 879.103, 5494.4, 6373.5, 'Efectivo', 34, 1, '2018-11-14 04:29:57'),
(36, 13, '[{\"id\":\"7\",\"descripcion\":\"Muñecos\",\"cantidad\":\"1\",\"stock\":\"98\",\"precio\":\"170\",\"total\":\"170\"},{\"id\":\"11\",\"descripcion\":\"Osos\",\"cantidad\":\"1\",\"stock\":\"48\",\"precio\":\"180\",\"total\":\"180\"},{\"id\":\"15\",\"descripcion\":\"Muñeca\",\"cantidad\":\"1\",\"stock\":\"37\",\"precio\":\"165\",\"total\":\"165\"},{\"id\":\"17\",\"descripcion\":\"Mi prueba numerica\",\"cantidad\":\"1\",\"stock\":\"40\",\"precio\":\"220\",\"total\":\"220\"}]', 101.379, 633.621, 735, 'TC-789654123456987', 34, 1, '2018-11-14 01:04:25'),
(37, 14, '[{\"id\":\"7\",\"descripcion\":\"Muñecos\",\"cantidad\":\"172\",\"stock\":\"1\",\"precio\":\"170\",\"total\":\"29240\"}]', 4033.1, 25206.9, 29240, 'Efectivo', 34, 1, '2018-11-14 03:59:13'),
(38, 15, '[{\"id\":\"15\",\"descripcion\":\"Muñeca\",\"cantidad\":\"10\",\"stock\":\"27\",\"precio\":\"165\",\"total\":\"1650\"}]', 227.586, 1422.41, 1650, 'Efectivo', 34, 1, '2018-11-14 04:22:06'),
(39, 16, '[{\"id\":\"15\",\"descripcion\":\"Muñeca\",\"cantidad\":\"1\",\"stock\":\"26\",\"precio\":\"165\",\"total\":\"165\"},{\"id\":\"25\",\"descripcion\":\"SONAJA FLOR\",\"cantidad\":\"1\",\"stock\":\"18\",\"precio\":\"22.5\",\"total\":\"22.5\"},{\"id\":\"24\",\"descripcion\":\"SONAJA MANITAS\",\"cantidad\":\"1\",\"stock\":\"19\",\"precio\":\"24.5\",\"total\":\"24.5\"},{\"id\":\"22\",\"descripcion\":\"Juguetero\",\"cantidad\":\"1\",\"stock\":\"35\",\"precio\":\"165\",\"total\":\"165\"}]', 52, 325, 377, 'Efectivo', 34, 1, '2018-11-14 04:17:57'),
(40, 17, '[{\"id\":\"7\",\"descripcion\":\"Muñecos\",\"cantidad\":\"1\",\"stock\":\"1\",\"precio\":\"170\",\"total\":\"170\"}]', 23.4483, 146.552, 170, 'Efectivo', 34, 1, '2018-11-14 18:16:30'),
(41, 18, '[{\"id\":\"11\",\"descripcion\":\"Osos\",\"cantidad\":\"1\",\"stock\":\"48\",\"precio\":\"180\",\"total\":\"180\"},{\"id\":\"15\",\"descripcion\":\"Muñeca\",\"cantidad\":\"5\",\"stock\":\"33\",\"precio\":\"165\",\"total\":\"825\"},{\"id\":\"24\",\"descripcion\":\"SONAJA MANITAS\",\"cantidad\":\"2\",\"stock\":\"18\",\"precio\":\"24.5\",\"total\":\"49\"}]', 145.379, 908.621, 1054, 'Efectivo', 34, 1, '2018-11-16 18:42:03'),
(42, 19, '[{\"id\":\"11\",\"descripcion\":\"Osos\",\"cantidad\":\"1\",\"stock\":\"47\",\"precio\":\"180\",\"total\":\"180\"},{\"id\":\"15\",\"descripcion\":\"Muñeca\",\"cantidad\":\"1\",\"stock\":\"32\",\"precio\":\"165\",\"total\":\"165\"},{\"id\":\"7\",\"descripcion\":\"Muñecos\",\"cantidad\":\"1\",\"stock\":\"0\",\"precio\":\"170\",\"total\":\"170\"}]', 71.0345, 443.966, 515, 'Efectivo', 34, 1, '2018-11-16 19:22:54'),
(43, 20, '[{\"id\":\"15\",\"descripcion\":\"Muñeca\",\"cantidad\":\"1\",\"stock\":\"31\",\"precio\":\"165\",\"total\":\"165\"},{\"id\":\"17\",\"descripcion\":\"Mi prueba numerica\",\"cantidad\":\"1\",\"stock\":\"40\",\"precio\":\"220\",\"total\":\"220\"},{\"id\":\"22\",\"descripcion\":\"Juguetero\",\"cantidad\":\"1\",\"stock\":\"46\",\"precio\":\"165\",\"total\":\"165\"}]', 75.8621, 474.138, 550, 'Efectivo', 34, 1, '2018-11-16 20:56:48'),
(44, 21, '[{\"id\":\"7\",\"descripcion\":\"Muñecos\",\"cantidad\":\"1\",\"stock\":\"9\",\"precio\":\"170\",\"total\":\"170\"},{\"id\":\"11\",\"descripcion\":\"Osos\",\"cantidad\":\"1\",\"stock\":\"46\",\"precio\":\"180\",\"total\":\"180\"},{\"id\":\"15\",\"descripcion\":\"Muñeca\",\"cantidad\":\"1\",\"stock\":\"30\",\"precio\":\"165\",\"total\":\"165\"},{\"id\":\"17\",\"descripcion\":\"Mi prueba numerica\",\"cantidad\":\"1\",\"stock\":\"39\",\"precio\":\"220\",\"total\":\"220\"},{\"id\":\"24\",\"descripcion\":\"SONAJA MANITAS\",\"cantidad\":\"1\",\"stock\":\"17\",\"precio\":\"24.5\",\"total\":\"24.5\"}]', 104.759, 654.741, 759.5, 'Efectivo', 34, 1, '2018-11-21 20:12:19'),
(45, 22, '[{\"id\":\"15\",\"descripcion\":\"Muñeca\",\"cantidad\":\"1\",\"stock\":\"29\",\"precio\":\"165\",\"total\":\"165\"},{\"id\":\"17\",\"descripcion\":\"Mi prueba numerica\",\"cantidad\":\"1\",\"stock\":\"38\",\"precio\":\"220\",\"total\":\"220\"},{\"id\":\"22\",\"descripcion\":\"Juguetero\",\"cantidad\":\"1\",\"stock\":\"45\",\"precio\":\"165\",\"total\":\"165\"},{\"id\":\"25\",\"descripcion\":\"SONAJA FLOR\",\"cantidad\":\"1\",\"stock\":\"18\",\"precio\":\"22.5\",\"total\":\"22.5\"}]', 78.9655, 493.534, 572.5, 'Efectivo', 34, 1, '2018-11-21 23:19:44');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `categoria`
--
ALTER TABLE `categoria`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `cliente`
--
ALTER TABLE `cliente`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `orden`
--
ALTER TABLE `orden`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `producto`
--
ALTER TABLE `producto`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `promocion`
--
ALTER TABLE `promocion`
  ADD PRIMARY KEY (`id_promocion`);

--
-- Indices de la tabla `proveedor`
--
ALTER TABLE `proveedor`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `subcategoria`
--
ALTER TABLE `subcategoria`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `venta`
--
ALTER TABLE `venta`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `categoria`
--
ALTER TABLE `categoria`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=30;

--
-- AUTO_INCREMENT de la tabla `cliente`
--
ALTER TABLE `cliente`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- AUTO_INCREMENT de la tabla `orden`
--
ALTER TABLE `orden`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de la tabla `producto`
--
ALTER TABLE `producto`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=34;

--
-- AUTO_INCREMENT de la tabla `promocion`
--
ALTER TABLE `promocion`
  MODIFY `id_promocion` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=73;

--
-- AUTO_INCREMENT de la tabla `proveedor`
--
ALTER TABLE `proveedor`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT de la tabla `subcategoria`
--
ALTER TABLE `subcategoria`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=41;

--
-- AUTO_INCREMENT de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=39;

--
-- AUTO_INCREMENT de la tabla `venta`
--
ALTER TABLE `venta`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=46;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
