-- phpMyAdmin SQL Dump
-- version 4.5.1
-- http://www.phpmyadmin.net
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 29-09-2017 a las 13:59:44
-- Versión del servidor: 10.1.16-MariaDB
-- Versión de PHP: 7.0.9

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `loteria`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `anulaciones`
--

CREATE TABLE `anulaciones` (
  `id` int(10) UNSIGNED NOT NULL,
  `nro_ticket` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `valor` double(8,2) NOT NULL,
  `usuario` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `fecha` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `apuestas`
--

CREATE TABLE `apuestas` (
  `id` int(10) UNSIGNED NOT NULL,
  `cantidad` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `apuestas`
--

INSERT INTO `apuestas` (`id`, `cantidad`) VALUES
(52, 5),
(53, 2),
(54, 1),
(55, 3),
(56, 9),
(57, 7),
(58, 4),
(59, 8),
(60, 6),
(61, 10),
(62, 15),
(63, 13),
(64, 25),
(65, 50),
(66, 0),
(67, 12),
(68, 14),
(69, 34),
(70, 19),
(71, 100),
(72, 111),
(73, 20),
(74, 21),
(75, 89),
(76, 18),
(77, 78);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `cierres`
--

CREATE TABLE `cierres` (
  `id` int(10) UNSIGNED NOT NULL,
  `fecha` date NOT NULL,
  `echo` int(11) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `cierres`
--

INSERT INTO `cierres` (`id`, `fecha`, `echo`) VALUES
(18, '2017-07-28', 0);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `jugadas`
--

CREATE TABLE `jugadas` (
  `id` int(10) UNSIGNED NOT NULL,
  `numero` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tipo` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `jugadas`
--

INSERT INTO `jugadas` (`id`, `numero`, `tipo`) VALUES
(243, '77-77-77', 3),
(244, '01', 1),
(245, '23-32', 2),
(246, '02', 1),
(247, '12-23', 2),
(248, '23-23-43', 3),
(249, '88-88-88', 3),
(250, '12-12', 2),
(251, '33', 1),
(252, '00-09-89', 3),
(253, '12', 1),
(254, '11-12-21', 3),
(255, '09-09-90', 3),
(256, '89', 1),
(257, '23-23-23', 3),
(258, '89-89', 2),
(259, '31-32-32', 3),
(260, '01-23-43', 3),
(261, '56', 1),
(262, '00', 1),
(263, '11', 1),
(264, '59', 1),
(265, '31', 1),
(266, '21-21', 2),
(267, '12-31-32', 3),
(268, '12-21-23', 3),
(269, '00-00-00', 3),
(270, '23', 1),
(271, '24', 1),
(272, '32', 1),
(273, '11-11', 2),
(274, '13-13', 2),
(275, '32-32', 2),
(276, '12-21-32', 3),
(277, '89-89-89', 3),
(278, '76-76-76', 3),
(279, '45-45-54', 3),
(280, '20', 1),
(281, '10-10', 2),
(282, '90', 1),
(283, '89-98', 2),
(284, '67-76-78', 3),
(285, '87', 1),
(286, '45-54', 2),
(287, '34-54-55', 3),
(288, '12-21', 2),
(289, '67', 1),
(290, '35', 1),
(291, '12-32', 2),
(292, '78-78-87', 3),
(293, '98-98', 2),
(294, '03-03-03', 3),
(295, '07-78-87', 3),
(296, '45', 1),
(297, '89-98-98', 3),
(298, '34', 1),
(299, '15', 1),
(300, '08', 1),
(301, '10-15', 2),
(302, '10', 1),
(303, '78-87', 2),
(304, '56-56-56', 3),
(305, '07', 1),
(306, '15-15', 2),
(307, '00-01-02', 3),
(308, '25', 1),
(309, '23-24', 2),
(310, '23-25', 2),
(311, '24-25', 2),
(312, '23-24-25', 3),
(313, '23-23', 2),
(314, '10-12-12', 3),
(315, '09-78-90', 3),
(316, '67-87', 2),
(317, '67-67-67', 3),
(318, '12-89-90', 3),
(319, '00-01', 2),
(320, '89-90', 2),
(321, '56-65', 2),
(322, '11-12', 2),
(323, '65', 1),
(324, '23-90-98', 3),
(325, '43', 1),
(326, '23-23-24', 3),
(327, '12-34-89', 3),
(328, '90-90', 2),
(329, '09-23-78', 3),
(330, '34-67', 2),
(331, '12-78-90', 3),
(332, '67-89-90', 3),
(333, '23-45-56', 3),
(334, '55-76', 2),
(335, '56-67', 2),
(336, '04-05-54', 3);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `jugada_sorteo`
--

CREATE TABLE `jugada_sorteo` (
  `id` int(10) UNSIGNED NOT NULL,
  `jugada_id` int(10) UNSIGNED NOT NULL,
  `sorteo_id` int(10) UNSIGNED NOT NULL,
  `acumulado` int(11) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `jugada_sorteo`
--

INSERT INTO `jugada_sorteo` (`id`, `jugada_id`, `sorteo_id`, `acumulado`) VALUES
(65, 309, 2, 10),
(66, 309, 3, 10),
(67, 309, 4, 10),
(68, 330, 3, 5),
(69, 330, 4, 5),
(70, 331, 3, 4),
(71, 331, 4, 4),
(72, 332, 1, 5),
(73, 332, 2, 5),
(74, 332, 3, 5),
(75, 332, 4, 5),
(76, 333, 1, 5),
(77, 333, 2, 5),
(78, 333, 3, 5),
(79, 333, 4, 5),
(80, 270, 1, 6),
(81, 270, 2, 6),
(82, 270, 3, 6),
(83, 270, 4, 6),
(84, 271, 1, 5),
(85, 271, 2, 5),
(86, 271, 3, 5),
(87, 271, 4, 5),
(88, 334, 1, 9),
(89, 334, 2, 9),
(90, 334, 3, 9),
(91, 334, 4, 9),
(92, 319, 2, 2),
(93, 319, 3, 2),
(94, 335, 2, 4),
(95, 335, 3, 4),
(96, 336, 1, 5);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `j_acumulados`
--

CREATE TABLE `j_acumulados` (
  `id` int(10) UNSIGNED NOT NULL,
  `jugada` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `fecha` date NOT NULL,
  `acumulado` double(8,2) NOT NULL DEFAULT '0.00',
  `porcentaje_v` varchar(25) CHARACTER SET utf8 COLLATE utf8_spanish_ci DEFAULT '0 %'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `maximas`
--

CREATE TABLE `maximas` (
  `id` int(10) UNSIGNED NOT NULL,
  `quiniela` int(11) NOT NULL DEFAULT '15',
  `pale` int(11) NOT NULL DEFAULT '10',
  `tripleta` int(11) NOT NULL DEFAULT '5',
  `tiempoCierre` int(11) NOT NULL,
  `ticket` int(11) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `maximas`
--

INSERT INTO `maximas` (`id`, `quiniela`, `pale`, `tripleta`, `tiempoCierre`, `ticket`) VALUES
(1, 20, 10, 5, 30, 10),
(2, 15, 10, 0, 0, 43);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(3, '2017_04_24_013442_TablaSorteos', 1),
(6, '2017_04_29_183039_TablaApuestaMaxima', 3),
(7, '2017_04_22_225101_TablaPerfiles', 4),
(8, '2017_04_23_171535_TablaVistas', 5),
(9, '2017_04_27_135432_TablaPerfilVista', 6),
(10, '2017_04_30_045814_TablaUsuarios', 6),
(11, '2017_04_30_103927_TablaPremios', 7),
(12, '2017_05_01_213825_TablaJugada', 8),
(13, '2017_05_01_214636_TablaApuestas', 9),
(29, '2017_05_08_042107_TabalaJugadaSorteo', 14),
(32, '2017_05_07_231630_TablaVentas', 15),
(33, '2017_05_07_235542_TablaTickets', 15),
(34, '2017_05_08_000241_TablaTransacciones', 15),
(36, '2017_07_24_151513_Tabla_Cierres', 17),
(38, '2017_07_24_143758_Tabla_acumulado_jugada', 18),
(39, '2017_07_24_180048_Tabla_acumulado_sorteo', 18),
(40, '2017_07_24_181132_Tabla_acumulado_usuarios', 18),
(41, '2017_07_24_181510_Tabla_acumulado_tipos', 18),
(42, '2017_07_24_181819_Tabla_acumulado_ventas', 18),
(43, '2017_07_25_081823_Tabla_sorteo_jugada_ganadora', 19),
(44, '2017_07_26_050203_Tabla_premios_ticket', 20),
(45, '2017_07_28_043247_tabla_pagos_ticket', 21),
(46, '2017_07_28_053318_Tabla_anulaciones', 22);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `pago_tickets`
--

CREATE TABLE `pago_tickets` (
  `id` int(10) UNSIGNED NOT NULL,
  `nro_ticket` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `sorteo` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `premio` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `jugada` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tipo` varchar(50) CHARACTER SET utf8 COLLATE utf8_spanish_ci NOT NULL,
  `apuesta` int(11) NOT NULL,
  `pago` double(8,2) NOT NULL,
  `usuario` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `fecha` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `perfiles`
--

CREATE TABLE `perfiles` (
  `id` int(10) UNSIGNED NOT NULL,
  `descripcion` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `perfiles`
--

INSERT INTO `perfiles` (`id`, `descripcion`) VALUES
(1, 'Administrador'),
(2, 'Vendedor');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `perfil_reportes`
--

CREATE TABLE `perfil_reportes` (
  `id` int(10) NOT NULL,
  `id_reportes` int(100) NOT NULL,
  `id_perfiles` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish2_ci;

--
-- Volcado de datos para la tabla `perfil_reportes`
--

INSERT INTO `perfil_reportes` (`id`, `id_reportes`, `id_perfiles`) VALUES
(1, 1, 1),
(2, 2, 1),
(3, 3, 1),
(4, 4, 1),
(5, 2, 2),
(6, 3, 2),
(7, 4, 2);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `perfil_vista`
--

CREATE TABLE `perfil_vista` (
  `id` int(10) UNSIGNED NOT NULL,
  `perfil_id` int(10) UNSIGNED NOT NULL,
  `vista_id` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `perfil_vista`
--

INSERT INTO `perfil_vista` (`id`, `perfil_id`, `vista_id`) VALUES
(1, 1, 1),
(2, 1, 2),
(3, 1, 3),
(4, 1, 4),
(5, 1, 5),
(6, 1, 6),
(7, 1, 7),
(8, 2, 1),
(9, 2, 2),
(10, 1, 8),
(11, 2, 3);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `premios`
--

CREATE TABLE `premios` (
  `id` int(10) UNSIGNED NOT NULL,
  `primerPremio` int(11) NOT NULL DEFAULT '0',
  `segundoPremio` int(11) NOT NULL DEFAULT '0',
  `tercerPremio` int(11) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `premios`
--

INSERT INTO `premios` (`id`, `primerPremio`, `segundoPremio`, `tercerPremio`) VALUES
(1, 10, 5, 3),
(2, 21, 2, 12),
(3, 121, 21, 0);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `p_tickets`
--

CREATE TABLE `p_tickets` (
  `id` int(10) UNSIGNED NOT NULL,
  `nro_ticket` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `sorteo` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `jugada` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tipo` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `premio` varchar(40) COLLATE utf8mb4_unicode_ci NOT NULL,
  `apuesta` int(11) NOT NULL,
  `pago` double(8,2) NOT NULL,
  `fecha` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `reportes`
--

CREATE TABLE `reportes` (
  `id` int(100) NOT NULL,
  `nombre_reporte` text COLLATE utf8_spanish2_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish2_ci;

--
-- Volcado de datos para la tabla `reportes`
--

INSERT INTO `reportes` (`id`, `nombre_reporte`) VALUES
(1, 'Consolidado'),
(2, 'Ventas'),
(3, 'Anulaciones'),
(4, 'Comisiones');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `sorteos`
--

CREATE TABLE `sorteos` (
  `id` int(10) UNSIGNED NOT NULL,
  `descripcion` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `horaSorteo` time NOT NULL,
  `tiempoCierre` int(11) NOT NULL DEFAULT '15',
  `disponible` int(11) NOT NULL DEFAULT '0',
  `abierto` int(11) NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `sorteos`
--

INSERT INTO `sorteos` (`id`, `descripcion`, `horaSorteo`, `tiempoCierre`, `disponible`, `abierto`) VALUES
(1, 'Zulia-12:00 Pm', '00:00:00', 15, 1, 1),
(2, 'Zulia-8:00 pm', '20:00:00', 15, 1, 1),
(3, 'Caracas-12:00 Pm', '00:00:00', 15, 1, 1),
(4, 'Caracas- 8:00 pm', '12:00:00', 15, 1, 1),
(5, 'Nueva', '14:32:00', 15, 0, 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `s_acumulados`
--

CREATE TABLE `s_acumulados` (
  `id` int(10) UNSIGNED NOT NULL,
  `sorteo` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `fecha` date NOT NULL,
  `acumulado` double(8,2) NOT NULL DEFAULT '0.00',
  `porcentaje_v` varchar(25) CHARACTER SET utf8 COLLATE utf8_spanish_ci NOT NULL DEFAULT '0 %'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `s_jugadas`
--

CREATE TABLE `s_jugadas` (
  `id` int(10) UNSIGNED NOT NULL,
  `sorteo` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `jugada` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `fecha` date NOT NULL,
  `status` varchar(45) CHARACTER SET utf8 COLLATE utf8_spanish_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `s_jugadas`
--

INSERT INTO `s_jugadas` (`id`, `sorteo`, `jugada`, `fecha`, `status`) VALUES
(13, 'Zulia-12:00 Pm', 'XX-XX-XX', '2017-07-28', ''),
(14, 'Zulia-8:00 pm', 'XX-XX-XX', '2017-07-28', ''),
(15, 'Caracas-12:00 Pm', 'XX-XX-XX', '2017-07-28', ''),
(16, 'Caracas- 8:00 pm', 'XX-XX-XX', '2017-07-28', '');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tickets`
--

CREATE TABLE `tickets` (
  `id` int(10) UNSIGNED NOT NULL,
  `numero` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `fecha` date NOT NULL,
  `hora` time NOT NULL,
  `usuario` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `valor` int(11) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `tickets`
--

INSERT INTO `tickets` (`id`, `numero`, `fecha`, `hora`, `usuario`, `valor`) VALUES
(1, 'LTR-1609179', '2017-09-16', '04:41:06', 'NAICELIS', 5);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `transacciones`
--

CREATE TABLE `transacciones` (
  `id` int(10) UNSIGNED NOT NULL,
  `jugada_id` int(10) UNSIGNED NOT NULL,
  `sorteo_id` int(10) UNSIGNED NOT NULL,
  `apuesta_id` int(10) UNSIGNED NOT NULL,
  `ticket_id` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `transacciones`
--

INSERT INTO `transacciones` (`id`, `jugada_id`, `sorteo_id`, `apuesta_id`, `ticket_id`) VALUES
(1, 336, 1, 52, 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `t_acumulados`
--

CREATE TABLE `t_acumulados` (
  `id` int(10) UNSIGNED NOT NULL,
  `tipo_jugada` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `fecha` date NOT NULL,
  `acumulado` double(8,2) NOT NULL DEFAULT '0.00',
  `porcentaje_v` varchar(25) CHARACTER SET utf8 COLLATE utf8_spanish_ci NOT NULL DEFAULT '0 %'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuarios`
--

CREATE TABLE `usuarios` (
  `id` int(10) UNSIGNED NOT NULL,
  `username` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `perfil_id` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `usuarios`
--

INSERT INTO `usuarios` (`id`, `username`, `password`, `perfil_id`) VALUES
(1, 'JOSETAYUPO', '123', 2),
(2, 'VINCEN', '123', 1),
(5, 'NAICELIS', '123', 2),
(8, 'PRUEBA', '123', 2),
(9, 'NUEVO', '123', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `u_acumulados`
--

CREATE TABLE `u_acumulados` (
  `id` int(10) UNSIGNED NOT NULL,
  `usuario` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `fecha` date NOT NULL,
  `acumulado` double(8,2) NOT NULL DEFAULT '0.00',
  `porcentaje_v` varchar(20) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '0 %',
  `comision` double NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `ventas`
--

CREATE TABLE `ventas` (
  `id` int(10) UNSIGNED NOT NULL,
  `jugada_id` int(10) UNSIGNED NOT NULL,
  `sorteo_id` int(10) UNSIGNED NOT NULL,
  `apuesta_id` int(10) UNSIGNED NOT NULL,
  `usuario` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `fila` int(11) NOT NULL,
  `fecha` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `vistas`
--

CREATE TABLE `vistas` (
  `id` int(10) UNSIGNED NOT NULL,
  `descripcion` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `ruta` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `padre` int(11) NOT NULL DEFAULT '1',
  `dependencia` int(10) UNSIGNED NOT NULL,
  `clase` varchar(100) CHARACTER SET utf8 COLLATE utf8_spanish_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `vistas`
--

INSERT INTO `vistas` (`id`, `descripcion`, `ruta`, `padre`, `dependencia`, `clase`) VALUES
(1, 'Apuestas', '/home', 1, 1, ''),
(2, 'Buscar Ticket', '/buscar-ticket', 1, 2, ''),
(3, 'Reportes', '/reportes', 1, 3, ''),
(4, 'Administracion', ' ', 1, 4, 'link'),
(5, 'Usuarios', '/administracion/usuarios', 0, 4, ''),
(6, 'Loterias', '/administracion/loterias', 0, 4, ''),
(7, 'Configurar Premios', '/administracion/set_premios', 0, 4, ''),
(8, 'Jugada del Día', '/administracion/jugada_dia', 0, 4, '');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `v_acumulados`
--

CREATE TABLE `v_acumulados` (
  `id` int(10) UNSIGNED NOT NULL,
  `fecha` date NOT NULL,
  `v_acumulado` double(8,2) NOT NULL,
  `c_acumulado` double(8,2) NOT NULL,
  `t_acumulado` double(8,2) NOT NULL DEFAULT '0.00'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `anulaciones`
--
ALTER TABLE `anulaciones`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `apuestas`
--
ALTER TABLE `apuestas`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `cierres`
--
ALTER TABLE `cierres`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `jugadas`
--
ALTER TABLE `jugadas`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `jugada_sorteo`
--
ALTER TABLE `jugada_sorteo`
  ADD PRIMARY KEY (`id`),
  ADD KEY `jugada_sorteo_jugada_id_foreign` (`jugada_id`),
  ADD KEY `jugada_sorteo_sorteo_id_foreign` (`sorteo_id`);

--
-- Indices de la tabla `j_acumulados`
--
ALTER TABLE `j_acumulados`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `maximas`
--
ALTER TABLE `maximas`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `pago_tickets`
--
ALTER TABLE `pago_tickets`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `perfiles`
--
ALTER TABLE `perfiles`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `perfil_reportes`
--
ALTER TABLE `perfil_reportes`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_reportes` (`id_reportes`),
  ADD KEY `id_perfiles` (`id_perfiles`);

--
-- Indices de la tabla `perfil_vista`
--
ALTER TABLE `perfil_vista`
  ADD PRIMARY KEY (`id`),
  ADD KEY `perfil_vista_perfil_id_foreign` (`perfil_id`),
  ADD KEY `perfil_vista_vista_id_foreign` (`vista_id`);

--
-- Indices de la tabla `premios`
--
ALTER TABLE `premios`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `p_tickets`
--
ALTER TABLE `p_tickets`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `reportes`
--
ALTER TABLE `reportes`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `sorteos`
--
ALTER TABLE `sorteos`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `s_acumulados`
--
ALTER TABLE `s_acumulados`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `s_jugadas`
--
ALTER TABLE `s_jugadas`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `tickets`
--
ALTER TABLE `tickets`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `transacciones`
--
ALTER TABLE `transacciones`
  ADD PRIMARY KEY (`id`),
  ADD KEY `transacciones_jugada_id_foreign` (`jugada_id`),
  ADD KEY `transacciones_sorteo_id_foreign` (`sorteo_id`),
  ADD KEY `transacciones_apuesta_id_foreign` (`apuesta_id`),
  ADD KEY `transacciones_ticket_id_foreign` (`ticket_id`);

--
-- Indices de la tabla `t_acumulados`
--
ALTER TABLE `t_acumulados`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  ADD PRIMARY KEY (`id`),
  ADD KEY `usuarios_perfil_id_foreign` (`perfil_id`);

--
-- Indices de la tabla `u_acumulados`
--
ALTER TABLE `u_acumulados`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `ventas`
--
ALTER TABLE `ventas`
  ADD PRIMARY KEY (`id`),
  ADD KEY `ventas_jugada_id_foreign` (`jugada_id`),
  ADD KEY `ventas_sorteo_id_foreign` (`sorteo_id`),
  ADD KEY `ventas_apuesta_id_foreign` (`apuesta_id`);

--
-- Indices de la tabla `vistas`
--
ALTER TABLE `vistas`
  ADD PRIMARY KEY (`id`),
  ADD KEY `vistas_dependencia_foreign` (`dependencia`);

--
-- Indices de la tabla `v_acumulados`
--
ALTER TABLE `v_acumulados`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `anulaciones`
--
ALTER TABLE `anulaciones`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT de la tabla `apuestas`
--
ALTER TABLE `apuestas`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=78;
--
-- AUTO_INCREMENT de la tabla `cierres`
--
ALTER TABLE `cierres`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;
--
-- AUTO_INCREMENT de la tabla `jugadas`
--
ALTER TABLE `jugadas`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=337;
--
-- AUTO_INCREMENT de la tabla `jugada_sorteo`
--
ALTER TABLE `jugada_sorteo`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=97;
--
-- AUTO_INCREMENT de la tabla `j_acumulados`
--
ALTER TABLE `j_acumulados`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT de la tabla `maximas`
--
ALTER TABLE `maximas`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT de la tabla `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=47;
--
-- AUTO_INCREMENT de la tabla `pago_tickets`
--
ALTER TABLE `pago_tickets`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT de la tabla `perfiles`
--
ALTER TABLE `perfiles`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT de la tabla `perfil_reportes`
--
ALTER TABLE `perfil_reportes`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;
--
-- AUTO_INCREMENT de la tabla `perfil_vista`
--
ALTER TABLE `perfil_vista`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;
--
-- AUTO_INCREMENT de la tabla `premios`
--
ALTER TABLE `premios`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT de la tabla `p_tickets`
--
ALTER TABLE `p_tickets`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT de la tabla `reportes`
--
ALTER TABLE `reportes`
  MODIFY `id` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT de la tabla `sorteos`
--
ALTER TABLE `sorteos`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT de la tabla `s_acumulados`
--
ALTER TABLE `s_acumulados`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT de la tabla `s_jugadas`
--
ALTER TABLE `s_jugadas`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;
--
-- AUTO_INCREMENT de la tabla `tickets`
--
ALTER TABLE `tickets`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT de la tabla `transacciones`
--
ALTER TABLE `transacciones`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT de la tabla `t_acumulados`
--
ALTER TABLE `t_acumulados`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;
--
-- AUTO_INCREMENT de la tabla `u_acumulados`
--
ALTER TABLE `u_acumulados`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT de la tabla `ventas`
--
ALTER TABLE `ventas`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT de la tabla `vistas`
--
ALTER TABLE `vistas`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;
--
-- AUTO_INCREMENT de la tabla `v_acumulados`
--
ALTER TABLE `v_acumulados`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;
--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `jugada_sorteo`
--
ALTER TABLE `jugada_sorteo`
  ADD CONSTRAINT `jugada_sorteo_jugada_id_foreign` FOREIGN KEY (`jugada_id`) REFERENCES `jugadas` (`id`),
  ADD CONSTRAINT `jugada_sorteo_sorteo_id_foreign` FOREIGN KEY (`sorteo_id`) REFERENCES `sorteos` (`id`);

--
-- Filtros para la tabla `perfil_reportes`
--
ALTER TABLE `perfil_reportes`
  ADD CONSTRAINT `perfiles` FOREIGN KEY (`id_perfiles`) REFERENCES `perfiles` (`id`),
  ADD CONSTRAINT `reportes` FOREIGN KEY (`id_reportes`) REFERENCES `reportes` (`id`);

--
-- Filtros para la tabla `perfil_vista`
--
ALTER TABLE `perfil_vista`
  ADD CONSTRAINT `perfil_vista_perfil_id_foreign` FOREIGN KEY (`perfil_id`) REFERENCES `perfiles` (`id`),
  ADD CONSTRAINT `perfil_vista_vista_id_foreign` FOREIGN KEY (`vista_id`) REFERENCES `vistas` (`id`);

--
-- Filtros para la tabla `transacciones`
--
ALTER TABLE `transacciones`
  ADD CONSTRAINT `transacciones_apuesta_id_foreign` FOREIGN KEY (`apuesta_id`) REFERENCES `apuestas` (`id`),
  ADD CONSTRAINT `transacciones_jugada_id_foreign` FOREIGN KEY (`jugada_id`) REFERENCES `jugadas` (`id`),
  ADD CONSTRAINT `transacciones_sorteo_id_foreign` FOREIGN KEY (`sorteo_id`) REFERENCES `sorteos` (`id`),
  ADD CONSTRAINT `transacciones_ticket_id_foreign` FOREIGN KEY (`ticket_id`) REFERENCES `tickets` (`id`);

--
-- Filtros para la tabla `usuarios`
--
ALTER TABLE `usuarios`
  ADD CONSTRAINT `usuarios_perfil_id_foreign` FOREIGN KEY (`perfil_id`) REFERENCES `perfiles` (`id`);

--
-- Filtros para la tabla `ventas`
--
ALTER TABLE `ventas`
  ADD CONSTRAINT `ventas_apuesta_id_foreign` FOREIGN KEY (`apuesta_id`) REFERENCES `apuestas` (`id`),
  ADD CONSTRAINT `ventas_jugada_id_foreign` FOREIGN KEY (`jugada_id`) REFERENCES `jugadas` (`id`),
  ADD CONSTRAINT `ventas_sorteo_id_foreign` FOREIGN KEY (`sorteo_id`) REFERENCES `sorteos` (`id`);

--
-- Filtros para la tabla `vistas`
--
ALTER TABLE `vistas`
  ADD CONSTRAINT `vistas_dependencia_foreign` FOREIGN KEY (`dependencia`) REFERENCES `vistas` (`id`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
