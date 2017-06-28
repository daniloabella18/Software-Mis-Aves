-- phpMyAdmin SQL Dump
-- version 4.7.0
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 27-06-2017 a las 09:52:39
-- Versión del servidor: 10.1.24-MariaDB
-- Versión de PHP: 7.1.6

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `mis_aves`
--
CREATE DATABASE IF NOT EXISTS `mis_aves` DEFAULT CHARACTER SET latin1 COLLATE latin1_spanish_ci;
USE `mis_aves`;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `ave`
--

DROP TABLE IF EXISTS `ave`;
CREATE TABLE `ave` (
  `Ave_anillo` varchar(5) COLLATE latin1_spanish_ci NOT NULL COMMENT 'ID',
  `Ave_nombre` varchar(30) COLLATE latin1_spanish_ci NOT NULL COMMENT 'Nombre',
  `Ave_estado` varchar(3) COLLATE latin1_spanish_ci NOT NULL COMMENT 'Estado',
  `Ave_fecha_nac` date DEFAULT NULL COMMENT 'Fecha de nacimiento',
  `Ave_especie` varchar(3) COLLATE latin1_spanish_ci NOT NULL COMMENT 'Especie',
  `Ave_genero` varchar(1) COLLATE latin1_spanish_ci NOT NULL COMMENT 'Genero'
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_spanish_ci COMMENT='Aves de la empresa';

--
-- Volcado de datos para la tabla `ave`
--

INSERT INTO `ave` (`Ave_anillo`, `Ave_nombre`, `Ave_estado`, `Ave_fecha_nac`, `Ave_especie`, `Ave_genero`) VALUES
('h.100', 'pollo', 'mud', '2017-06-26', 'agu', 'M'),
('h.123', 'Turok', 'tra', '2000-01-20', 'agu', 'H'),
('h.124', 'rede', 'tra', '2017-06-27', 'agu', 'H'),
('h.145', 'Silvestre', 'mud', '2000-01-10', 'buh', 'H'),
('h.210', 'Pollo', 'mud', '2000-01-20', 'agu', 'M');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `cargo`
--

DROP TABLE IF EXISTS `cargo`;
CREATE TABLE `cargo` (
  `Car_cod` varchar(3) COLLATE latin1_spanish_ci NOT NULL COMMENT 'ID',
  `Car_descrip` varchar(30) COLLATE latin1_spanish_ci NOT NULL COMMENT 'Descripci?n'
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_spanish_ci COMMENT='Cargo de un usuario en la empresa';

--
-- Volcado de datos para la tabla `cargo`
--

INSERT INTO `cargo` (`Car_cod`, `Car_descrip`) VALUES
('Cet', 'Cetrero'),
('Jef', 'Jefe');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `cliente`
--

DROP TABLE IF EXISTS `cliente`;
CREATE TABLE `cliente` (
  `cli_cod` varchar(3) COLLATE latin1_spanish_ci NOT NULL COMMENT 'c?digo',
  `cli_nombre` varchar(30) COLLATE latin1_spanish_ci DEFAULT NULL COMMENT 'Nombre',
  `cli_descrip` varchar(100) COLLATE latin1_spanish_ci NOT NULL COMMENT 'Descripci?n',
  `cli_rubro` varchar(3) COLLATE latin1_spanish_ci DEFAULT NULL COMMENT 'Rubro'
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_spanish_ci COMMENT='Cliente en la que va a trabajar un ave';

--
-- Volcado de datos para la tabla `cliente`
--

INSERT INTO `cliente` (`cli_cod`, `cli_nombre`, `cli_descrip`, `cli_rubro`) VALUES
('hom', 'homecenter', 'Tienda de artículos del hogar', 'urb'),
('met', 'metro', 'Metro de Santiago', 'urb');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `comuna`
--

DROP TABLE IF EXISTS `comuna`;
CREATE TABLE `comuna` (
  `com_id` int(3) NOT NULL COMMENT 'Codigo',
  `com_nombre` varchar(40) CHARACTER SET utf8 DEFAULT NULL COMMENT 'Nombre',
  `com_idprov` int(11) DEFAULT NULL COMMENT 'Provincia a la que pertenece'
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_spanish_ci COMMENT='Comunas de Chile' ROW_FORMAT=DYNAMIC;

--
-- Volcado de datos para la tabla `comuna`
--

INSERT INTO `comuna` (`com_id`, `com_nombre`, `com_idprov`) VALUES
(1, 'Iquique', 3),
(2, 'Alto Hospicio', 3),
(3, 'Pozo Almonte', 4),
(4, 'Camiña', 4),
(5, 'Colchane', 4),
(6, 'Huara', 4),
(7, 'Pica', 4),
(8, 'Antofagasta', 5),
(9, 'Mejillones', 5),
(10, 'Sierra Gorda', 5),
(11, 'Taltal', 5),
(12, 'Calama', 6),
(13, 'Ollagüe', 6),
(14, 'San Pedro de Atacama', 6),
(15, 'Tocopilla', 7),
(16, 'María Elena', 7),
(17, 'Copiapó', 8),
(18, 'Caldera', 8),
(19, 'Tierra Amarilla', 8),
(20, 'Chañaral', 9),
(21, 'Diego de Almagro', 9),
(22, 'Vallenar', 10),
(23, 'Alto del Carmen', 10),
(24, 'Freirina', 10),
(25, 'Huasco', 10),
(26, 'La Serena', 11),
(27, 'Coquimbo', 11),
(28, 'Andacollo', 11),
(29, 'La Higuera', 11),
(30, 'Paihuano', 11),
(31, 'Vicuña', 11),
(32, 'Illapel', 12),
(33, 'Canela', 12),
(34, 'Los Vilos', 12),
(35, 'Salamanca', 12),
(36, 'Ovalle', 13),
(37, 'Combarbalá', 13),
(38, 'Monte Patria', 13),
(39, 'Punitaqui', 13),
(40, 'Río Hurtado', 13),
(41, 'Valparaíso', 14),
(42, 'Casablanca', 14),
(43, 'Concón', 14),
(44, 'Juan Fernández', 14),
(45, 'Puchuncaví', 14),
(46, 'Quintero', 14),
(47, 'Viña del Mar', 14),
(48, 'Isla de Pascua', 15),
(49, 'Los Andes', 16),
(50, 'Calle Larga', 16),
(51, 'Rinconada', 16),
(52, 'San Esteban', 16),
(53, 'La Ligua', 17),
(54, 'Cabildo', 17),
(55, 'Papudo', 17),
(56, 'Petorca', 17),
(57, 'Zapallar', 17),
(58, 'Quillota', 18),
(59, 'La Calera', 18),
(60, 'Hijuelas', 18),
(61, 'La Cruz', 18),
(62, 'Nogales', 18),
(63, 'San Antonio', 19),
(64, 'Algarrobo', 19),
(65, 'Cartagena', 19),
(66, 'El Quisco', 19),
(67, 'El Tabo', 19),
(68, 'Santo Domingo', 19),
(69, 'San Felipe', 20),
(70, 'Catemu', 20),
(71, 'Llay Llay', 20),
(72, 'Panquehue', 20),
(73, 'Putaendo', 20),
(74, 'Santa María', 20),
(75, 'Quilpué', 21),
(76, 'Limache', 21),
(77, 'Olmué', 21),
(78, 'Villa Alemana', 21),
(79, 'Rancagua', 22),
(80, 'Codegua', 22),
(81, 'Coinco', 22),
(82, 'Coltauco', 22),
(83, 'Doñihue', 22),
(84, 'Graneros', 22),
(85, 'Las Cabras', 22),
(86, 'Machalí', 22),
(87, 'Malloa', 22),
(88, 'Mostazal', 22),
(89, 'Olivar', 22),
(90, 'Peumo', 22),
(91, 'Pichidegua', 22),
(92, 'Quinta de Tilcoco', 22),
(93, 'Rengo', 22),
(94, 'Requínoa', 22),
(95, 'San Vicente', 22),
(96, 'Pichilemu', 23),
(97, 'La Estrella', 23),
(98, 'Litueche', 23),
(99, 'Marchihue', 23),
(100, 'Navidad', 23),
(101, 'Paredones', 23),
(102, 'San Fernando', 24),
(103, 'Chépica', 24),
(104, 'Chimbarongo', 24),
(105, 'Lolol', 24),
(106, 'Nancagua', 24),
(107, 'Palmilla', 24),
(108, 'Peralillo', 24),
(109, 'Placilla', 24),
(110, 'Pumanque', 24),
(111, 'Santa Cruz', 24),
(112, 'Talca', 25),
(113, 'Constitución', 25),
(114, 'Curepto', 25),
(115, 'Empedrado', 25),
(116, 'Maule', 25),
(117, 'Pelarco', 25),
(118, 'Pencahue', 25),
(119, 'Río Claro', 25),
(120, 'San Clemente', 25),
(121, 'San Rafael', 25),
(122, 'Cauquenes', 26),
(123, 'Chanco', 26),
(124, 'Pelluhue', 26),
(125, 'Curicó', 27),
(126, 'Hualañé', 27),
(127, 'Licantén', 27),
(128, 'Molina', 27),
(129, 'Rauco', 27),
(130, 'Romeral', 27),
(131, 'Sagrada Familia', 27),
(132, 'Teno', 27),
(133, 'Vichuquén', 27),
(134, 'Linares', 28),
(135, 'Colbún', 28),
(136, 'Longaví', 28),
(137, 'Parral', 28),
(138, 'Retiro', 28),
(139, 'San Javier', 28),
(140, 'Villa Alegre', 28),
(141, 'Yerbas Buenas', 28),
(142, 'Concepción', 29),
(143, 'Coronel', 29),
(144, 'Chiguayante', 29),
(145, 'Florida', 29),
(146, 'Hualqui', 29),
(147, 'Lota', 29),
(148, 'Penco', 29),
(149, 'San Pedro de la Paz', 29),
(150, 'Santa Juana', 29),
(151, 'Talcahuano', 29),
(152, 'Tomé', 29),
(153, 'Hualpén', 29),
(154, 'Lebu', 30),
(155, 'Arauco', 30),
(156, 'Cañete', 30),
(157, 'Contulmo', 30),
(158, 'Curanilahue', 30),
(159, 'Los Álamos', 30),
(160, 'Tirúa', 30),
(161, 'Los Ángeles', 31),
(162, 'Antuco', 31),
(163, 'Cabrero', 31),
(164, 'Laja', 31),
(165, 'Mulchén', 31),
(166, 'Nacimiento', 31),
(167, 'Negrete', 31),
(168, 'Quilaco', 31),
(169, 'Quilleco', 31),
(170, 'San Rosendo', 31),
(171, 'Santa Bárbara', 31),
(172, 'Tucapel', 31),
(173, 'Yumbel', 31),
(174, 'Alto Biobío', 31),
(175, 'Chillán', 32),
(176, 'Bulnes', 32),
(177, 'Cobquecura', 32),
(178, 'Coelemu', 32),
(179, 'Coihueco', 32),
(180, 'Chillán Viejo', 32),
(181, 'El Carmen', 32),
(182, 'Ninhue', 32),
(183, 'Ñiquén', 32),
(184, 'Pemuco', 32),
(185, 'Pinto', 32),
(186, 'Portezuelo', 32),
(187, 'Quillón', 32),
(188, 'Quirihue', 32),
(189, 'Ránquil', 32),
(190, 'San Carlos', 32),
(191, 'San Fabián', 32),
(192, 'San Ignacio', 32),
(193, 'San Nicolás', 32),
(194, 'Treguaco', 32),
(195, 'Yungay', 32),
(196, 'Temuco', 33),
(197, 'Carahue', 33),
(198, 'Cunco', 33),
(199, 'Curarrehue', 33),
(200, 'Freire', 33),
(201, 'Galvarino', 33),
(202, 'Gorbea', 33),
(203, 'Lautaro', 33),
(204, 'Loncoche', 33),
(205, 'Melipeuco', 33),
(206, 'Nueva Imperial', 33),
(207, 'Padre las Casas', 33),
(208, 'Perquenco', 33),
(209, 'Pitrufquén', 33),
(210, 'Pucón', 33),
(211, 'Saavedra', 33),
(212, 'Teodoro Schmidt', 33),
(213, 'Toltén', 33),
(214, 'Vilcún', 33),
(215, 'Villarrica', 33),
(216, 'Cholchol', 33),
(217, 'Angol', 34),
(218, 'Collipulli', 34),
(219, 'Curacautín', 34),
(220, 'Ercilla', 34),
(221, 'Lonquimay', 34),
(222, 'Los Sauces', 34),
(223, 'Lumaco', 34),
(224, 'Purén', 34),
(225, 'Renaico', 34),
(226, 'Traiguén', 34),
(227, 'Victoria', 34),
(228, 'Puerto Montt', 37),
(229, 'Calbuco', 37),
(230, 'Cochamó', 37),
(231, 'Fresia', 37),
(232, 'Frutillar', 37),
(233, 'Los Muermos', 37),
(234, 'Llanquihue', 37),
(235, 'Maullín', 37),
(236, 'Puerto Varas', 37),
(237, 'Castro', 38),
(238, 'Ancud', 38),
(239, 'Chonchi', 38),
(240, 'Curaco de Vélez', 38),
(241, 'Dalcahue', 38),
(242, 'Puqueldón', 38),
(243, 'Queilén', 38),
(244, 'Quellón', 38),
(245, 'Quemchi', 38),
(246, 'Quinchao', 38),
(247, 'Osorno', 39),
(248, 'Puerto Octay', 39),
(249, 'Purranque', 39),
(250, 'Puyehue', 39),
(251, 'Río Negro', 39),
(252, 'San Juan de la Costa', 39),
(253, 'San Pablo', 39),
(254, 'Chaitén', 40),
(255, 'Futaleufú', 40),
(256, 'Hualaihué', 40),
(257, 'Palena', 40),
(258, 'Coyhaique', 41),
(259, 'Lago Verde', 41),
(260, 'Aysén', 42),
(261, 'Cisnes', 42),
(262, 'Guaitecas', 42),
(263, 'Cochrane', 43),
(264, 'O\'Higgins', 43),
(265, 'Tortel', 43),
(266, 'Chile Chico', 44),
(267, 'Río Ibáñez', 44),
(268, 'Punta Arenas', 45),
(269, 'Laguna Blanca', 45),
(270, 'Río Verde', 45),
(271, 'San Gregorio', 45),
(272, 'Cabo de Hornos', 46),
(273, 'Antártica', 46),
(274, 'Porvenir', 47),
(275, 'Primavera', 47),
(276, 'Timaukel', 47),
(277, 'Natales', 48),
(278, 'Torres del Paine', 48),
(279, 'Santiago', 49),
(280, 'Cerrillos', 49),
(281, 'Cerro Navia', 49),
(282, 'Conchalí', 49),
(283, 'El Bosque', 49),
(284, 'Estación Central', 49),
(285, 'Huechuraba', 49),
(286, 'Independencia', 49),
(287, 'La Cisterna', 49),
(288, 'La Florida', 49),
(289, 'La Granja', 49),
(290, 'La Pintana', 49),
(291, 'La Reina', 49),
(292, 'Las Condes', 49),
(293, 'Lo Barnechea', 49),
(294, 'Lo Espejo', 49),
(295, 'Lo Prado', 49),
(296, 'Macul', 49),
(297, 'Maipú', 49),
(298, 'Ñuñoa', 49),
(299, 'Pedro Aguirre Cerda', 49),
(300, 'Peñalolén', 49),
(301, 'Providencia', 49),
(302, 'Pudahuel', 49),
(303, 'Quilicura', 49),
(304, 'Quinta Normal', 49),
(305, 'Recoleta', 49),
(306, 'Renca', 49),
(307, 'San Joaquín', 49),
(308, 'San Miguel', 49),
(309, 'San Ramón', 49),
(310, 'Vitacura', 49),
(311, 'Puente Alto', 50),
(312, 'Pirque', 50),
(313, 'San José de Maipo', 50),
(314, 'Colina', 51),
(315, 'Lampa', 51),
(316, 'Tiltil', 51),
(317, 'San Bernardo', 52),
(318, 'Buin', 52),
(319, 'Calera de Tango', 52),
(320, 'Paine', 52),
(321, 'Melipilla', 53),
(322, 'Alhué', 53),
(323, 'Curacaví', 53),
(324, 'María Pinto', 53),
(325, 'San Pedro', 53),
(326, 'Talagante', 54),
(327, 'El Monte', 54),
(328, 'Isla de Maipo', 54),
(329, 'Padre Hurtado', 54),
(330, 'Peñaflor', 54),
(331, 'Valdivia', 35),
(332, 'Corral', 35),
(333, 'Lanco', 35),
(334, 'Los Lagos', 35),
(335, 'Máfil', 35),
(336, 'Mariquina', 35),
(337, 'Paillaco', 35),
(338, 'Panguipulli', 35),
(339, 'La Unión', 36),
(340, 'Futrono', 36),
(341, 'Lago Ranco', 36),
(342, 'Río Bueno', 36),
(343, 'Arica', 1),
(344, 'Camarones', 1),
(345, 'Putre', 2),
(346, 'General Lagos', 2);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `control`
--

DROP TABLE IF EXISTS `control`;
CREATE TABLE `control` (
  `Con_id` int(6) NOT NULL COMMENT 'ID',
  `Con_Ave` varchar(5) COLLATE latin1_spanish_ci NOT NULL COMMENT 'Ave',
  `Con_usu` varchar(10) COLLATE latin1_spanish_ci NOT NULL COMMENT 'Usuario',
  `Con_fecha` date NOT NULL COMMENT 'Fecha',
  `Con_turno` int(1) NOT NULL COMMENT 'Turno',
  `Con_peso` int(4) NOT NULL COMMENT 'Peso ave',
  `Con_cape` varchar(2) COLLATE latin1_spanish_ci NOT NULL COMMENT 'Peso medido con o sin caperuza',
  `Con_obs` varchar(400) COLLATE latin1_spanish_ci DEFAULT NULL COMMENT 'Observaciones'
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_spanish_ci COMMENT='Control de cada ave';

--
-- Volcado de datos para la tabla `control`
--

INSERT INTO `control` (`Con_id`, `Con_Ave`, `Con_usu`, `Con_fecha`, `Con_turno`, `Con_peso`, `Con_cape`, `Con_obs`) VALUES
(59, 'h.124', '10136600-6', '2017-06-27', 0, 600, 'CC', 'Me mordio'),
(61, 'h.210', '10136600-6', '2017-06-27', 2, 600, 'CC', 'me odia'),
(64, 'h.123', '10136600-6', '2017-06-27', 0, 600, 'CC', 'koko'),
(65, 'h.124', '10136600-6', '2017-06-27', 2, 899, 'CC', 'gorda');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `control_comida`
--

DROP TABLE IF EXISTS `control_comida`;
CREATE TABLE `control_comida` (
  `Cco_control` int(6) NOT NULL COMMENT 'Control',
  `Cco_tco` varchar(2) COLLATE latin1_spanish_ci NOT NULL COMMENT 'Comida',
  `Cco_cant` int(1) NOT NULL COMMENT 'Cantidad'
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_spanish_ci COMMENT='Comida que come un ave en un control' ROW_FORMAT=COMPACT;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `destino`
--

DROP TABLE IF EXISTS `destino`;
CREATE TABLE `destino` (
  `Des_Control` int(6) NOT NULL COMMENT 'Control',
  `Des_sede` varchar(5) COLLATE latin1_spanish_ci NOT NULL COMMENT 'Sede'
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_spanish_ci COMMENT='Lugar al que va un ave';

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `especie`
--

DROP TABLE IF EXISTS `especie`;
CREATE TABLE `especie` (
  `Esp_id` varchar(3) COLLATE latin1_spanish_ci NOT NULL COMMENT 'ID',
  `Esp_nombre` varchar(30) COLLATE latin1_spanish_ci NOT NULL COMMENT 'Especie de un ave'
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_spanish_ci COMMENT='Especie de un ave';

--
-- Volcado de datos para la tabla `especie`
--

INSERT INTO `especie` (`Esp_id`, `Esp_nombre`) VALUES
('agu', 'Aguila'),
('buh', 'Búho');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `estado`
--

DROP TABLE IF EXISTS `estado`;
CREATE TABLE `estado` (
  `Est_id` varchar(3) COLLATE latin1_spanish_ci NOT NULL COMMENT 'ID',
  `Est_descrip` varchar(30) COLLATE latin1_spanish_ci NOT NULL COMMENT 'Descripci?n'
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_spanish_ci COMMENT='Estado del ave';

--
-- Volcado de datos para la tabla `estado`
--

INSERT INTO `estado` (`Est_id`, `Est_descrip`) VALUES
('mud', 'Mudando plumas'),
('tra', 'Trabajo');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `nota`
--

DROP TABLE IF EXISTS `nota`;
CREATE TABLE `nota` (
  `not_cod` int(6) NOT NULL COMMENT 'ID',
  `not_usuario` varchar(10) COLLATE latin1_spanish_ci DEFAULT NULL COMMENT 'Usuario',
  `not_fecha` date DEFAULT NULL COMMENT 'Fecha',
  `not_descrip` varchar(500) COLLATE latin1_spanish_ci DEFAULT NULL COMMENT 'anotacion',
  `not_turno` int(1) DEFAULT NULL COMMENT 'turno'
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_spanish_ci COMMENT='Notas que pueden dejar los usuarios';

--
-- Volcado de datos para la tabla `nota`
--

INSERT INTO `nota` (`not_cod`, `not_usuario`, `not_fecha`, `not_descrip`, `not_turno`) VALUES
(3, '5055320-5', '2017-06-27', 'Las aves están inquietas, algo las molesta en la noches', 0),
(4, '10136600-6', '2017-06-27', 'El día estuvo tranquilo, el clima parece que les hizo bien', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `provincia`
--

DROP TABLE IF EXISTS `provincia`;
CREATE TABLE `provincia` (
  `pro_id` int(3) NOT NULL COMMENT 'C?digo',
  `pro_nombre` varchar(40) DEFAULT NULL COMMENT 'Nombre',
  `pro_idreg` varchar(5) DEFAULT NULL COMMENT 'Region a la que pertenece'
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COMMENT='Provincias de Chile' ROW_FORMAT=DYNAMIC;

--
-- Volcado de datos para la tabla `provincia`
--

INSERT INTO `provincia` (`pro_id`, `pro_nombre`, `pro_idreg`) VALUES
(1, 'Arica', '15'),
(2, 'Parinacota', '15'),
(3, 'Iquique', '1'),
(4, 'Tamarugal', '1'),
(5, 'Antofagasta', '2'),
(6, 'El Loa', '2'),
(7, 'Tocopilla', '2'),
(8, 'Copiapó', '3'),
(9, 'Chañaral', '3'),
(10, 'Huasco', '3'),
(11, 'Elqui', '4'),
(12, 'Choapa', '4'),
(13, 'Limarí', '4'),
(14, 'Valparaíso', '5'),
(15, 'Isla de Pascua', '5'),
(16, 'Los Andes', '5'),
(17, 'Petorca', '5'),
(18, 'Quillota', '5'),
(19, 'San Antonio', '5'),
(20, 'San Felipe de Aconcagua', '5'),
(21, 'Marga Marga', '5'),
(22, 'Cachapoal', '6'),
(23, 'Cardenal Caro', '6'),
(24, 'Colchagua', '6'),
(25, 'Talca', '7'),
(26, 'Cauquenes', '7'),
(27, 'Curicó', '7'),
(28, 'Linares', '7'),
(29, 'Concepción', '8'),
(30, 'Arauco', '8'),
(31, 'Biobío', '8'),
(32, 'Ñuble', '8'),
(33, 'Cautín', '9'),
(34, 'Malleco', '9'),
(35, 'Valdivia', '14'),
(36, 'Ranco', '14'),
(37, 'Llanquihue', '10'),
(38, 'Chiloé', '10'),
(39, 'Osorno', '10'),
(40, 'Palena', '10'),
(41, 'Coihaique', '11'),
(42, 'Aisén', '11'),
(43, 'Capitán Prat', '11'),
(44, 'General Carrera', '11'),
(45, 'Magallanes', '12'),
(46, 'Antártica Chilena', '12'),
(47, 'Tierra del Fuego', '12'),
(48, 'Última Esperanza', '12'),
(49, 'Santiago', '13'),
(50, 'Cordillera', '13'),
(51, 'Chacabuco', '13'),
(52, 'Maipo', '13'),
(53, 'Melipilla', '13'),
(54, 'Talagante', '13');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `region`
--

DROP TABLE IF EXISTS `region`;
CREATE TABLE `region` (
  `reg_ID` int(3) NOT NULL COMMENT 'Codigo',
  `reg_nombre` varchar(60) COLLATE latin1_spanish_ci DEFAULT NULL COMMENT 'Nombre',
  `reg_abrev` varchar(5) COLLATE latin1_spanish_ci DEFAULT NULL COMMENT 'Abreviatura de las regiones ISO 3166 2 CL'
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_spanish_ci COMMENT='Regiones de chile';

--
-- Volcado de datos para la tabla `region`
--

INSERT INTO `region` (`reg_ID`, `reg_nombre`, `reg_abrev`) VALUES
(1, 'Tarapacá', 'CL-TA'),
(2, 'Antofagasta', 'CL-AN'),
(3, 'Atacama', 'CL-AT'),
(4, 'Coquimbo', 'CL-CO'),
(5, 'Valparaíso', 'CL-VS'),
(6, 'Región del Libertador Gral. Bernardo O’Higgins', 'CL-LI'),
(7, 'Región del Maule', 'CL-ML'),
(8, 'Región del Biobío', 'CL-BI'),
(9, 'Región de la Araucanía', 'CL-AR'),
(10, 'Región de Los Lagos', 'CL-LL'),
(11, 'Región Aisén del Gral. Carlos Ibáñez del Campo', 'CL-AI'),
(12, 'Región de Magallanes y de la Antártica Chilena', 'CL-MA'),
(13, 'Región Metropolitana de Santiago', 'CL-RM'),
(14, 'Región de Los Ríos', 'CL-LR'),
(15, 'Arica y Parinacota', 'CL-AP');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `rubro`
--

DROP TABLE IF EXISTS `rubro`;
CREATE TABLE `rubro` (
  `Rub_cod` varchar(3) COLLATE latin1_spanish_ci NOT NULL COMMENT 'ID',
  `Rub_descrip` varchar(50) CHARACTER SET latin1 DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_spanish_ci COMMENT='Sector en el que se desempe?a el cliente';

--
-- Volcado de datos para la tabla `rubro`
--

INSERT INTO `rubro` (`Rub_cod`, `Rub_descrip`) VALUES
('ind', 'Industrial'),
('urb', 'Urbano');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `sede`
--

DROP TABLE IF EXISTS `sede`;
CREATE TABLE `sede` (
  `sed_cod` varchar(5) COLLATE latin1_spanish_ci NOT NULL COMMENT 'C?digo',
  `sed_nombre` varchar(150) COLLATE latin1_spanish_ci NOT NULL COMMENT 'Nombre',
  `sed_cliente` varchar(3) COLLATE latin1_spanish_ci NOT NULL COMMENT 'Cliente',
  `sed_comuna` int(3) NOT NULL COMMENT 'Comuna'
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_spanish_ci COMMENT='Sede del cliente';

--
-- Volcado de datos para la tabla `sede`
--

INSERT INTO `sede` (`sed_cod`, `sed_nombre`, `sed_cliente`, `sed_comuna`) VALUES
('hompt', 'Home Center Puente Alto', 'hom', 311),
('metpb', 'Metro Parque Bustamante', 'met', 298);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tipo_comida`
--

DROP TABLE IF EXISTS `tipo_comida`;
CREATE TABLE `tipo_comida` (
  `Tco_cod` varchar(2) COLLATE latin1_spanish_ci NOT NULL COMMENT 'ID',
  `Tco_animal` varchar(30) COLLATE latin1_spanish_ci NOT NULL COMMENT 'Animal'
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_spanish_ci COMMENT='Tipo de comida que come un ave';

--
-- Volcado de datos para la tabla `tipo_comida`
--

INSERT INTO `tipo_comida` (`Tco_cod`, `Tco_animal`) VALUES
('po', 'Pollito'),
('ra', 'Ratón');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `turno`
--

DROP TABLE IF EXISTS `turno`;
CREATE TABLE `turno` (
  `Tur_cod` int(1) NOT NULL COMMENT 'ID',
  `Tur_descp` varchar(50) COLLATE latin1_spanish_ci NOT NULL COMMENT 'Descripci?n',
  `Tur_hora_ini` varchar(5) COLLATE latin1_spanish_ci NOT NULL COMMENT 'Hora inicio',
  `Tur_hora_final` varchar(5) COLLATE latin1_spanish_ci NOT NULL COMMENT 'Hora final'
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_spanish_ci COMMENT='Turno en el que hace un control';

--
-- Volcado de datos para la tabla `turno`
--

INSERT INTO `turno` (`Tur_cod`, `Tur_descp`, `Tur_hora_ini`, `Tur_hora_final`) VALUES
(0, 'Mañana', '08:00', '10:00'),
(1, 'tarde', '19:00', '22:00'),
(2, 'Noche', '22:00', '08:00');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuario`
--

DROP TABLE IF EXISTS `usuario`;
CREATE TABLE `usuario` (
  `usu_rut` varchar(10) COLLATE latin1_spanish_ci NOT NULL COMMENT 'Rut',
  `usu_contra` varchar(60) COLLATE latin1_spanish_ci NOT NULL COMMENT 'Contraseña',
  `usu_nombre` varchar(60) COLLATE latin1_spanish_ci DEFAULT NULL COMMENT 'Nombre',
  `usu_apellido` varchar(60) COLLATE latin1_spanish_ci DEFAULT NULL COMMENT 'Apellido',
  `usu_fnac` date NOT NULL COMMENT 'Fecha nacimiento',
  `usu_dir` varchar(100) COLLATE latin1_spanish_ci DEFAULT NULL COMMENT 'Direccion',
  `usu_comuna` int(3) DEFAULT NULL COMMENT 'Comuna',
  `usu_telefono` int(9) NOT NULL COMMENT 'Numero telefono casa',
  `usu_celular` int(11) DEFAULT NULL COMMENT 'Numero telefono celular',
  `usu_cargo` varchar(3) COLLATE latin1_spanish_ci DEFAULT NULL COMMENT 'cargo'
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_spanish_ci COMMENT='Usuarios de la empresa';

--
-- Volcado de datos para la tabla `usuario`
--

INSERT INTO `usuario` (`usu_rut`, `usu_contra`, `usu_nombre`, `usu_apellido`, `usu_fnac`, `usu_dir`, `usu_comuna`, `usu_telefono`, `usu_celular`, `usu_cargo`) VALUES
('10136600-6', 'qwerty', 'Rodolfo', 'Zuñiga', '1995-10-25', 'San fernando #9876', 296, 789789789, 561234567, 'Jef'),
('5055320-5', 'asdf', 'Claudi', 'Saji', '1996-09-11', 'cosa #213', 288, 987654321, 569876543, 'Cet');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `ave`
--
ALTER TABLE `ave`
  ADD PRIMARY KEY (`Ave_anillo`),
  ADD KEY `Ave_estado` (`Ave_estado`),
  ADD KEY `Ave_especie` (`Ave_especie`);

--
-- Indices de la tabla `cargo`
--
ALTER TABLE `cargo`
  ADD PRIMARY KEY (`Car_cod`);

--
-- Indices de la tabla `cliente`
--
ALTER TABLE `cliente`
  ADD PRIMARY KEY (`cli_cod`),
  ADD KEY `cli_rubro` (`cli_rubro`);

--
-- Indices de la tabla `comuna`
--
ALTER TABLE `comuna`
  ADD PRIMARY KEY (`com_id`);

--
-- Indices de la tabla `control`
--
ALTER TABLE `control`
  ADD PRIMARY KEY (`Con_id`),
  ADD KEY `Con_Ave` (`Con_Ave`),
  ADD KEY `Con_turno` (`Con_turno`),
  ADD KEY `Con_usu` (`Con_usu`);

--
-- Indices de la tabla `control_comida`
--
ALTER TABLE `control_comida`
  ADD PRIMARY KEY (`Cco_control`,`Cco_tco`),
  ADD KEY `Cco_tco` (`Cco_tco`);

--
-- Indices de la tabla `destino`
--
ALTER TABLE `destino`
  ADD PRIMARY KEY (`Des_Control`,`Des_sede`),
  ADD KEY `Des_sede` (`Des_sede`);

--
-- Indices de la tabla `especie`
--
ALTER TABLE `especie`
  ADD PRIMARY KEY (`Esp_id`);

--
-- Indices de la tabla `estado`
--
ALTER TABLE `estado`
  ADD PRIMARY KEY (`Est_id`);

--
-- Indices de la tabla `nota`
--
ALTER TABLE `nota`
  ADD PRIMARY KEY (`not_cod`),
  ADD KEY `not_usuario` (`not_usuario`),
  ADD KEY `not_turno` (`not_turno`);

--
-- Indices de la tabla `provincia`
--
ALTER TABLE `provincia`
  ADD PRIMARY KEY (`pro_id`);

--
-- Indices de la tabla `region`
--
ALTER TABLE `region`
  ADD PRIMARY KEY (`reg_ID`);

--
-- Indices de la tabla `rubro`
--
ALTER TABLE `rubro`
  ADD PRIMARY KEY (`Rub_cod`);

--
-- Indices de la tabla `sede`
--
ALTER TABLE `sede`
  ADD PRIMARY KEY (`sed_cod`),
  ADD KEY `sed_cliente` (`sed_cliente`);

--
-- Indices de la tabla `tipo_comida`
--
ALTER TABLE `tipo_comida`
  ADD PRIMARY KEY (`Tco_cod`);

--
-- Indices de la tabla `turno`
--
ALTER TABLE `turno`
  ADD PRIMARY KEY (`Tur_cod`);

--
-- Indices de la tabla `usuario`
--
ALTER TABLE `usuario`
  ADD PRIMARY KEY (`usu_rut`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `comuna`
--
ALTER TABLE `comuna`
  MODIFY `com_id` int(3) NOT NULL AUTO_INCREMENT COMMENT 'Codigo', AUTO_INCREMENT=347;
--
-- AUTO_INCREMENT de la tabla `control`
--
ALTER TABLE `control`
  MODIFY `Con_id` int(6) NOT NULL AUTO_INCREMENT COMMENT 'ID', AUTO_INCREMENT=66;
--
-- AUTO_INCREMENT de la tabla `nota`
--
ALTER TABLE `nota`
  MODIFY `not_cod` int(6) NOT NULL AUTO_INCREMENT COMMENT 'ID', AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT de la tabla `provincia`
--
ALTER TABLE `provincia`
  MODIFY `pro_id` int(3) NOT NULL AUTO_INCREMENT COMMENT 'C?digo', AUTO_INCREMENT=55;
--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `ave`
--
ALTER TABLE `ave`
  ADD CONSTRAINT `ave_ibfk_1` FOREIGN KEY (`Ave_estado`) REFERENCES `estado` (`Est_id`),
  ADD CONSTRAINT `ave_ibfk_2` FOREIGN KEY (`Ave_especie`) REFERENCES `especie` (`Esp_id`);

--
-- Filtros para la tabla `cliente`
--
ALTER TABLE `cliente`
  ADD CONSTRAINT `cliente_ibfk_1` FOREIGN KEY (`cli_rubro`) REFERENCES `rubro` (`Rub_cod`);

--
-- Filtros para la tabla `control`
--
ALTER TABLE `control`
  ADD CONSTRAINT `control_ibfk_1` FOREIGN KEY (`Con_Ave`) REFERENCES `ave` (`Ave_anillo`),
  ADD CONSTRAINT `control_ibfk_2` FOREIGN KEY (`Con_turno`) REFERENCES `turno` (`Tur_cod`),
  ADD CONSTRAINT `control_ibfk_3` FOREIGN KEY (`Con_usu`) REFERENCES `usuario` (`usu_rut`);

--
-- Filtros para la tabla `control_comida`
--
ALTER TABLE `control_comida`
  ADD CONSTRAINT `control_comida_ibfk_2` FOREIGN KEY (`Cco_tco`) REFERENCES `tipo_comida` (`Tco_cod`),
  ADD CONSTRAINT `control_comida_ibfk_3` FOREIGN KEY (`Cco_control`) REFERENCES `control` (`Con_id`);

--
-- Filtros para la tabla `destino`
--
ALTER TABLE `destino`
  ADD CONSTRAINT `destino_ibfk_1` FOREIGN KEY (`Des_sede`) REFERENCES `sede` (`sed_cod`),
  ADD CONSTRAINT `destino_ibfk_2` FOREIGN KEY (`Des_Control`) REFERENCES `control` (`Con_id`);

--
-- Filtros para la tabla `nota`
--
ALTER TABLE `nota`
  ADD CONSTRAINT `nota_ibfk_1` FOREIGN KEY (`not_usuario`) REFERENCES `usuario` (`usu_rut`),
  ADD CONSTRAINT `nota_ibfk_2` FOREIGN KEY (`not_turno`) REFERENCES `turno` (`Tur_cod`);

--
-- Filtros para la tabla `sede`
--
ALTER TABLE `sede`
  ADD CONSTRAINT `sede_ibfk_1` FOREIGN KEY (`sed_cliente`) REFERENCES `cliente` (`cli_cod`);


--
-- Metadatos
--
USE `phpmyadmin`;

--
-- Metadatos para la tabla ave
--
-- Error leyendo datos de la tabla phpmyadmin.pma__column_info: #1100 - Tabla 'pma__column_info' no fue trabada con LOCK TABLES
-- Error leyendo datos de la tabla phpmyadmin.pma__table_uiprefs: #1100 - Tabla 'pma__table_uiprefs' no fue trabada con LOCK TABLES
-- Error leyendo datos de la tabla phpmyadmin.pma__tracking: #1100 - Tabla 'pma__tracking' no fue trabada con LOCK TABLES

--
-- Metadatos para la tabla cargo
--
-- Error leyendo datos de la tabla phpmyadmin.pma__column_info: #1100 - Tabla 'pma__column_info' no fue trabada con LOCK TABLES
-- Error leyendo datos de la tabla phpmyadmin.pma__table_uiprefs: #1100 - Tabla 'pma__table_uiprefs' no fue trabada con LOCK TABLES
-- Error leyendo datos de la tabla phpmyadmin.pma__tracking: #1100 - Tabla 'pma__tracking' no fue trabada con LOCK TABLES

--
-- Metadatos para la tabla cliente
--
-- Error leyendo datos de la tabla phpmyadmin.pma__column_info: #1100 - Tabla 'pma__column_info' no fue trabada con LOCK TABLES
-- Error leyendo datos de la tabla phpmyadmin.pma__table_uiprefs: #1100 - Tabla 'pma__table_uiprefs' no fue trabada con LOCK TABLES
-- Error leyendo datos de la tabla phpmyadmin.pma__tracking: #1100 - Tabla 'pma__tracking' no fue trabada con LOCK TABLES

--
-- Metadatos para la tabla comuna
--
-- Error leyendo datos de la tabla phpmyadmin.pma__column_info: #1100 - Tabla 'pma__column_info' no fue trabada con LOCK TABLES
-- Error leyendo datos de la tabla phpmyadmin.pma__table_uiprefs: #1100 - Tabla 'pma__table_uiprefs' no fue trabada con LOCK TABLES
-- Error leyendo datos de la tabla phpmyadmin.pma__tracking: #1100 - Tabla 'pma__tracking' no fue trabada con LOCK TABLES

--
-- Metadatos para la tabla control
--
-- Error leyendo datos de la tabla phpmyadmin.pma__column_info: #1100 - Tabla 'pma__column_info' no fue trabada con LOCK TABLES
-- Error leyendo datos de la tabla phpmyadmin.pma__table_uiprefs: #1100 - Tabla 'pma__table_uiprefs' no fue trabada con LOCK TABLES
-- Error leyendo datos de la tabla phpmyadmin.pma__tracking: #1100 - Tabla 'pma__tracking' no fue trabada con LOCK TABLES

--
-- Metadatos para la tabla control_comida
--
-- Error leyendo datos de la tabla phpmyadmin.pma__column_info: #1100 - Tabla 'pma__column_info' no fue trabada con LOCK TABLES
-- Error leyendo datos de la tabla phpmyadmin.pma__table_uiprefs: #1100 - Tabla 'pma__table_uiprefs' no fue trabada con LOCK TABLES
-- Error leyendo datos de la tabla phpmyadmin.pma__tracking: #1100 - Tabla 'pma__tracking' no fue trabada con LOCK TABLES

--
-- Metadatos para la tabla destino
--
-- Error leyendo datos de la tabla phpmyadmin.pma__column_info: #1100 - Tabla 'pma__column_info' no fue trabada con LOCK TABLES
-- Error leyendo datos de la tabla phpmyadmin.pma__table_uiprefs: #1100 - Tabla 'pma__table_uiprefs' no fue trabada con LOCK TABLES
-- Error leyendo datos de la tabla phpmyadmin.pma__tracking: #1100 - Tabla 'pma__tracking' no fue trabada con LOCK TABLES

--
-- Metadatos para la tabla especie
--
-- Error leyendo datos de la tabla phpmyadmin.pma__column_info: #1100 - Tabla 'pma__column_info' no fue trabada con LOCK TABLES
-- Error leyendo datos de la tabla phpmyadmin.pma__table_uiprefs: #1100 - Tabla 'pma__table_uiprefs' no fue trabada con LOCK TABLES
-- Error leyendo datos de la tabla phpmyadmin.pma__tracking: #1100 - Tabla 'pma__tracking' no fue trabada con LOCK TABLES

--
-- Metadatos para la tabla estado
--
-- Error leyendo datos de la tabla phpmyadmin.pma__column_info: #1100 - Tabla 'pma__column_info' no fue trabada con LOCK TABLES
-- Error leyendo datos de la tabla phpmyadmin.pma__table_uiprefs: #1100 - Tabla 'pma__table_uiprefs' no fue trabada con LOCK TABLES
-- Error leyendo datos de la tabla phpmyadmin.pma__tracking: #1100 - Tabla 'pma__tracking' no fue trabada con LOCK TABLES

--
-- Metadatos para la tabla nota
--
-- Error leyendo datos de la tabla phpmyadmin.pma__column_info: #1100 - Tabla 'pma__column_info' no fue trabada con LOCK TABLES
-- Error leyendo datos de la tabla phpmyadmin.pma__table_uiprefs: #1100 - Tabla 'pma__table_uiprefs' no fue trabada con LOCK TABLES
-- Error leyendo datos de la tabla phpmyadmin.pma__tracking: #1100 - Tabla 'pma__tracking' no fue trabada con LOCK TABLES

--
-- Metadatos para la tabla provincia
--
-- Error leyendo datos de la tabla phpmyadmin.pma__column_info: #1100 - Tabla 'pma__column_info' no fue trabada con LOCK TABLES
-- Error leyendo datos de la tabla phpmyadmin.pma__table_uiprefs: #1100 - Tabla 'pma__table_uiprefs' no fue trabada con LOCK TABLES
-- Error leyendo datos de la tabla phpmyadmin.pma__tracking: #1100 - Tabla 'pma__tracking' no fue trabada con LOCK TABLES

--
-- Metadatos para la tabla region
--
-- Error leyendo datos de la tabla phpmyadmin.pma__column_info: #1100 - Tabla 'pma__column_info' no fue trabada con LOCK TABLES
-- Error leyendo datos de la tabla phpmyadmin.pma__table_uiprefs: #1100 - Tabla 'pma__table_uiprefs' no fue trabada con LOCK TABLES
-- Error leyendo datos de la tabla phpmyadmin.pma__tracking: #1100 - Tabla 'pma__tracking' no fue trabada con LOCK TABLES

--
-- Metadatos para la tabla rubro
--
-- Error leyendo datos de la tabla phpmyadmin.pma__column_info: #1100 - Tabla 'pma__column_info' no fue trabada con LOCK TABLES
-- Error leyendo datos de la tabla phpmyadmin.pma__table_uiprefs: #1100 - Tabla 'pma__table_uiprefs' no fue trabada con LOCK TABLES
-- Error leyendo datos de la tabla phpmyadmin.pma__tracking: #1100 - Tabla 'pma__tracking' no fue trabada con LOCK TABLES

--
-- Metadatos para la tabla sede
--
-- Error leyendo datos de la tabla phpmyadmin.pma__column_info: #1100 - Tabla 'pma__column_info' no fue trabada con LOCK TABLES
-- Error leyendo datos de la tabla phpmyadmin.pma__table_uiprefs: #1100 - Tabla 'pma__table_uiprefs' no fue trabada con LOCK TABLES
-- Error leyendo datos de la tabla phpmyadmin.pma__tracking: #1100 - Tabla 'pma__tracking' no fue trabada con LOCK TABLES

--
-- Metadatos para la tabla tipo_comida
--
-- Error leyendo datos de la tabla phpmyadmin.pma__column_info: #1100 - Tabla 'pma__column_info' no fue trabada con LOCK TABLES
-- Error leyendo datos de la tabla phpmyadmin.pma__table_uiprefs: #1100 - Tabla 'pma__table_uiprefs' no fue trabada con LOCK TABLES
-- Error leyendo datos de la tabla phpmyadmin.pma__tracking: #1100 - Tabla 'pma__tracking' no fue trabada con LOCK TABLES

--
-- Metadatos para la tabla turno
--
-- Error leyendo datos de la tabla phpmyadmin.pma__column_info: #1100 - Tabla 'pma__column_info' no fue trabada con LOCK TABLES
-- Error leyendo datos de la tabla phpmyadmin.pma__table_uiprefs: #1100 - Tabla 'pma__table_uiprefs' no fue trabada con LOCK TABLES
-- Error leyendo datos de la tabla phpmyadmin.pma__tracking: #1100 - Tabla 'pma__tracking' no fue trabada con LOCK TABLES

--
-- Metadatos para la tabla usuario
--
-- Error leyendo datos de la tabla phpmyadmin.pma__column_info: #1100 - Tabla 'pma__column_info' no fue trabada con LOCK TABLES
-- Error leyendo datos de la tabla phpmyadmin.pma__table_uiprefs: #1100 - Tabla 'pma__table_uiprefs' no fue trabada con LOCK TABLES
-- Error leyendo datos de la tabla phpmyadmin.pma__tracking: #1100 - Tabla 'pma__tracking' no fue trabada con LOCK TABLES

--
-- Metadatos para la base de datos mis_aves
--
-- Error leyendo datos de la tabla phpmyadmin.pma__bookmark: #1100 - Tabla 'pma__bookmark' no fue trabada con LOCK TABLES
-- Error leyendo datos de la tabla phpmyadmin.pma__relation: #1100 - Tabla 'pma__relation' no fue trabada con LOCK TABLES
-- Error leyendo datos de la tabla phpmyadmin.pma__savedsearches: #1100 - Tabla 'pma__savedsearches' no fue trabada con LOCK TABLES
-- Error leyendo datos de la tabla phpmyadmin.pma__central_columns: #1100 - Tabla 'pma__central_columns' no fue trabada con LOCK TABLES
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
