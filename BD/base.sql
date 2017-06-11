-- phpMyAdmin SQL Dump
-- version 4.7.0
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 11-06-2017 a las 11:33:06
-- Versión del servidor: 10.1.22-MariaDB
-- Versión de PHP: 7.1.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";

--
-- Base de datos: `mis_aves`
--
CREATE DATABASE IF NOT EXISTS `mis_aves` DEFAULT CHARACTER SET latin1 COLLATE latin1_spanish_ci;
USE `mis_aves`;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `ave`
--
-- Creación: 11-06-2017 a las 01:23:26
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
-- RELACIONES PARA LA TABLA `ave`:
--   `Ave_estado`
--       `estado` -> `Est_id`
--   `Ave_especie`
--       `especie` -> `Esp_id`
--

--
-- Volcado de datos para la tabla `ave`
--

INSERT INTO `ave` (`Ave_anillo`, `Ave_nombre`, `Ave_estado`, `Ave_fecha_nac`, `Ave_especie`, `Ave_genero`) VALUES
('h.123', 'Turok', 'tra', '2000-01-20', 'agu', 'M'),
('h.210', 'Pollo', 'mud', '2000-01-20', 'agu', 'M');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `cargo`
--
-- Creación: 11-06-2017 a las 01:23:26
--

DROP TABLE IF EXISTS `cargo`;
CREATE TABLE `cargo` (
  `Car_cod` varchar(3) COLLATE latin1_spanish_ci NOT NULL COMMENT 'ID',
  `Car_descrip` varchar(30) COLLATE latin1_spanish_ci NOT NULL COMMENT 'Descripci?n'
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_spanish_ci COMMENT='Cargo de un usuario en la empresa';

--
-- RELACIONES PARA LA TABLA `cargo`:
--

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
-- Creación: 11-06-2017 a las 01:23:26
--

DROP TABLE IF EXISTS `cliente`;
CREATE TABLE `cliente` (
  `cli_cod` varchar(3) COLLATE latin1_spanish_ci NOT NULL COMMENT 'c?digo',
  `cli_nombre` varchar(30) COLLATE latin1_spanish_ci DEFAULT NULL COMMENT 'Nombre',
  `cli_descrip` varchar(100) COLLATE latin1_spanish_ci NOT NULL COMMENT 'Descripci?n',
  `cli_rubro` varchar(3) COLLATE latin1_spanish_ci DEFAULT NULL COMMENT 'Rubro'
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_spanish_ci COMMENT='Cliente en la que va a trabajar un ave';

--
-- RELACIONES PARA LA TABLA `cliente`:
--   `cli_rubro`
--       `rubro` -> `Rub_cod`
--

--
-- Volcado de datos para la tabla `cliente`
--

INSERT INTO `cliente` (`cli_cod`, `cli_nombre`, `cli_descrip`, `cli_rubro`) VALUES
('hom', 'homecenter', 'Tienda de art?culos del hogar', 'urb'),
('met', 'metro', 'Metro de Santiago', 'urb');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `comuna`
--
-- Creación: 11-06-2017 a las 00:23:27
-- Última actualización: 11-06-2017 a las 01:23:27
--

DROP TABLE IF EXISTS `comuna`;
CREATE TABLE `comuna` (
  `com_id` int(3) NOT NULL COMMENT 'Codigo',
  `com_nombre` varchar(40) CHARACTER SET utf8 DEFAULT NULL COMMENT 'Nombre',
  `com_idprov` int(11) DEFAULT NULL COMMENT 'Provincia a la que pertenece'
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_spanish_ci COMMENT='Comunas de Chile' ROW_FORMAT=DYNAMIC;

--
-- RELACIONES PARA LA TABLA `comuna`:
--   `com_idprov`
--       `provincia` -> `pro_id`
--

--
-- Volcado de datos para la tabla `comuna`
--

INSERT INTO `comuna` (`com_id`, `com_nombre`, `com_idprov`) VALUES
(1, 'Iquique', 3),
(2, 'Alto Hospicio', 3),
(3, 'Pozo Almonte', 4),
(4, 'Cami?a', 4),
(5, 'Colchane', 4),
(6, 'Huara', 4),
(7, 'Pica', 4),
(8, 'Antofagasta', 5),
(9, 'Mejillones', 5),
(10, 'Sierra Gorda', 5),
(11, 'Taltal', 5),
(12, 'Calama', 6),
(13, 'Ollag?e', 6),
(14, 'San Pedro de Atacama', 6),
(15, 'Tocopilla', 7),
(16, 'Mar?a Elena', 7),
(17, 'Copiap?', 8),
(18, 'Caldera', 8),
(19, 'Tierra Amarilla', 8),
(20, 'Cha?aral', 9),
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
(31, 'Vicu?a', 11),
(32, 'Illapel', 12),
(33, 'Canela', 12),
(34, 'Los Vilos', 12),
(35, 'Salamanca', 12),
(36, 'Ovalle', 13),
(37, 'Combarbal?', 13),
(38, 'Monte Patria', 13),
(39, 'Punitaqui', 13),
(40, 'R?o Hurtado', 13),
(41, 'Valpara?so', 14),
(42, 'Casablanca', 14),
(43, 'Conc?n', 14),
(44, 'Juan Fern?ndez', 14),
(45, 'Puchuncav?', 14),
(46, 'Quintero', 14),
(47, 'Vi?a del Mar', 14),
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
(74, 'Santa Mar?a', 20),
(75, 'Quilpu?', 21),
(76, 'Limache', 21),
(77, 'Olmu?', 21),
(78, 'Villa Alemana', 21),
(79, 'Rancagua', 22),
(80, 'Codegua', 22),
(81, 'Coinco', 22),
(82, 'Coltauco', 22),
(83, 'Do?ihue', 22),
(84, 'Graneros', 22),
(85, 'Las Cabras', 22),
(86, 'Machal?', 22),
(87, 'Malloa', 22),
(88, 'Mostazal', 22),
(89, 'Olivar', 22),
(90, 'Peumo', 22),
(91, 'Pichidegua', 22),
(92, 'Quinta de Tilcoco', 22),
(93, 'Rengo', 22),
(94, 'Requ?noa', 22),
(95, 'San Vicente', 22),
(96, 'Pichilemu', 23),
(97, 'La Estrella', 23),
(98, 'Litueche', 23),
(99, 'Marchihue', 23),
(100, 'Navidad', 23),
(101, 'Paredones', 23),
(102, 'San Fernando', 24),
(103, 'Ch?pica', 24),
(104, 'Chimbarongo', 24),
(105, 'Lolol', 24),
(106, 'Nancagua', 24),
(107, 'Palmilla', 24),
(108, 'Peralillo', 24),
(109, 'Placilla', 24),
(110, 'Pumanque', 24),
(111, 'Santa Cruz', 24),
(112, 'Talca', 25),
(113, 'Constituci?n', 25),
(114, 'Curepto', 25),
(115, 'Empedrado', 25),
(116, 'Maule', 25),
(117, 'Pelarco', 25),
(118, 'Pencahue', 25),
(119, 'R?o Claro', 25),
(120, 'San Clemente', 25),
(121, 'San Rafael', 25),
(122, 'Cauquenes', 26),
(123, 'Chanco', 26),
(124, 'Pelluhue', 26),
(125, 'Curic?', 27),
(126, 'Huala??', 27),
(127, 'Licant?n', 27),
(128, 'Molina', 27),
(129, 'Rauco', 27),
(130, 'Romeral', 27),
(131, 'Sagrada Familia', 27),
(132, 'Teno', 27),
(133, 'Vichuqu?n', 27),
(134, 'Linares', 28),
(135, 'Colb?n', 28),
(136, 'Longav?', 28),
(137, 'Parral', 28),
(138, 'Retiro', 28),
(139, 'San Javier', 28),
(140, 'Villa Alegre', 28),
(141, 'Yerbas Buenas', 28),
(142, 'Concepci?n', 29),
(143, 'Coronel', 29),
(144, 'Chiguayante', 29),
(145, 'Florida', 29),
(146, 'Hualqui', 29),
(147, 'Lota', 29),
(148, 'Penco', 29),
(149, 'San Pedro de la Paz', 29),
(150, 'Santa Juana', 29),
(151, 'Talcahuano', 29),
(152, 'Tom?', 29),
(153, 'Hualp?n', 29),
(154, 'Lebu', 30),
(155, 'Arauco', 30),
(156, 'Ca?ete', 30),
(157, 'Contulmo', 30),
(158, 'Curanilahue', 30),
(159, 'Los ?lamos', 30),
(160, 'Tir?a', 30),
(161, 'Los ?ngeles', 31),
(162, 'Antuco', 31),
(163, 'Cabrero', 31),
(164, 'Laja', 31),
(165, 'Mulch?n', 31),
(166, 'Nacimiento', 31),
(167, 'Negrete', 31),
(168, 'Quilaco', 31),
(169, 'Quilleco', 31),
(170, 'San Rosendo', 31),
(171, 'Santa B?rbara', 31),
(172, 'Tucapel', 31),
(173, 'Yumbel', 31),
(174, 'Alto Biob?o', 31),
(175, 'Chill?n', 32),
(176, 'Bulnes', 32),
(177, 'Cobquecura', 32),
(178, 'Coelemu', 32),
(179, 'Coihueco', 32),
(180, 'Chill?n Viejo', 32),
(181, 'El Carmen', 32),
(182, 'Ninhue', 32),
(183, '?iqu?n', 32),
(184, 'Pemuco', 32),
(185, 'Pinto', 32),
(186, 'Portezuelo', 32),
(187, 'Quill?n', 32),
(188, 'Quirihue', 32),
(189, 'R?nquil', 32),
(190, 'San Carlos', 32),
(191, 'San Fabi?n', 32),
(192, 'San Ignacio', 32),
(193, 'San Nicol?s', 32),
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
(209, 'Pitrufqu?n', 33),
(210, 'Puc?n', 33),
(211, 'Saavedra', 33),
(212, 'Teodoro Schmidt', 33),
(213, 'Tolt?n', 33),
(214, 'Vilc?n', 33),
(215, 'Villarrica', 33),
(216, 'Cholchol', 33),
(217, 'Angol', 34),
(218, 'Collipulli', 34),
(219, 'Curacaut?n', 34),
(220, 'Ercilla', 34),
(221, 'Lonquimay', 34),
(222, 'Los Sauces', 34),
(223, 'Lumaco', 34),
(224, 'Pur?n', 34),
(225, 'Renaico', 34),
(226, 'Traigu?n', 34),
(227, 'Victoria', 34),
(228, 'Puerto Montt', 37),
(229, 'Calbuco', 37),
(230, 'Cocham?', 37),
(231, 'Fresia', 37),
(232, 'Frutillar', 37),
(233, 'Los Muermos', 37),
(234, 'Llanquihue', 37),
(235, 'Maull?n', 37),
(236, 'Puerto Varas', 37),
(237, 'Castro', 38),
(238, 'Ancud', 38),
(239, 'Chonchi', 38),
(240, 'Curaco de V?lez', 38),
(241, 'Dalcahue', 38),
(242, 'Puqueld?n', 38),
(243, 'Queil?n', 38),
(244, 'Quell?n', 38),
(245, 'Quemchi', 38),
(246, 'Quinchao', 38),
(247, 'Osorno', 39),
(248, 'Puerto Octay', 39),
(249, 'Purranque', 39),
(250, 'Puyehue', 39),
(251, 'R?o Negro', 39),
(252, 'San Juan de la Costa', 39),
(253, 'San Pablo', 39),
(254, 'Chait?n', 40),
(255, 'Futaleuf?', 40),
(256, 'Hualaihu?', 40),
(257, 'Palena', 40),
(258, 'Coyhaique', 41),
(259, 'Lago Verde', 41),
(260, 'Ays?n', 42),
(261, 'Cisnes', 42),
(262, 'Guaitecas', 42),
(263, 'Cochrane', 43),
(264, 'O\'Higgins', 43),
(265, 'Tortel', 43),
(266, 'Chile Chico', 44),
(267, 'R?o Ib??ez', 44),
(268, 'Punta Arenas', 45),
(269, 'Laguna Blanca', 45),
(270, 'R?o Verde', 45),
(271, 'San Gregorio', 45),
(272, 'Cabo de Hornos', 46),
(273, 'Ant?rtica', 46),
(274, 'Porvenir', 47),
(275, 'Primavera', 47),
(276, 'Timaukel', 47),
(277, 'Natales', 48),
(278, 'Torres del Paine', 48),
(279, 'Santiago', 49),
(280, 'Cerrillos', 49),
(281, 'Cerro Navia', 49),
(282, 'Conchal?', 49),
(283, 'El Bosque', 49),
(284, 'Estaci?n Central', 49),
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
(297, 'Maip?', 49),
(298, '?u?oa', 49),
(299, 'Pedro Aguirre Cerda', 49),
(300, 'Pe?alol?n', 49),
(301, 'Providencia', 49),
(302, 'Pudahuel', 49),
(303, 'Quilicura', 49),
(304, 'Quinta Normal', 49),
(305, 'Recoleta', 49),
(306, 'Renca', 49),
(307, 'San Joaqu?n', 49),
(308, 'San Miguel', 49),
(309, 'San Ram?n', 49),
(310, 'Vitacura', 49),
(311, 'Puente Alto', 50),
(312, 'Pirque', 50),
(313, 'San Jos? de Maipo', 50),
(314, 'Colina', 51),
(315, 'Lampa', 51),
(316, 'Tiltil', 51),
(317, 'San Bernardo', 52),
(318, 'Buin', 52),
(319, 'Calera de Tango', 52),
(320, 'Paine', 52),
(321, 'Melipilla', 53),
(322, 'Alhu?', 53),
(323, 'Curacav?', 53),
(324, 'Mar?a Pinto', 53),
(325, 'San Pedro', 53),
(326, 'Talagante', 54),
(327, 'El Monte', 54),
(328, 'Isla de Maipo', 54),
(329, 'Padre Hurtado', 54),
(330, 'Pe?aflor', 54),
(331, 'Valdivia', 35),
(332, 'Corral', 35),
(333, 'Lanco', 35),
(334, 'Los Lagos', 35),
(335, 'M?fil', 35),
(336, 'Mariquina', 35),
(337, 'Paillaco', 35),
(338, 'Panguipulli', 35),
(339, 'La Uni?n', 36),
(340, 'Futrono', 36),
(341, 'Lago Ranco', 36),
(342, 'R?o Bueno', 36),
(343, 'Arica', 1),
(344, 'Camarones', 1),
(345, 'Putre', 2),
(346, 'General Lagos', 2);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `control`
--
-- Creación: 11-06-2017 a las 01:23:26
--

DROP TABLE IF EXISTS `control`;
CREATE TABLE `control` (
  `Con_id` int(6) NOT NULL COMMENT 'ID',
  `Con_Ave` varchar(5) COLLATE latin1_spanish_ci NOT NULL COMMENT 'Ave',
  `Con_usu` int(9) NOT NULL COMMENT 'Usuario',
  `Con_fecha` date NOT NULL COMMENT 'Fecha',
  `Con_turno` int(1) NOT NULL COMMENT 'Turno',
  `Con_peso` int(4) NOT NULL COMMENT 'Peso ave',
  `Con_cape` varchar(1) COLLATE latin1_spanish_ci NOT NULL COMMENT 'Peso medido con o sin caperuza',
  `Con_obs` varchar(400) COLLATE latin1_spanish_ci DEFAULT NULL COMMENT 'Observaciones'
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_spanish_ci COMMENT='Control de cada ave';

--
-- RELACIONES PARA LA TABLA `control`:
--   `Con_Ave`
--       `ave` -> `Ave_anillo`
--   `Con_turno`
--       `turno` -> `Tur_cod`
--

--
-- Volcado de datos para la tabla `control`
--

INSERT INTO `control` (`Con_id`, `Con_Ave`, `Con_usu`, `Con_fecha`, `Con_turno`, `Con_peso`, `Con_cape`, `Con_obs`) VALUES
(1, 'h.123', 50553205, '2018-05-21', 0, 456, 'S', 'El ave estaba agitada.'),
(2, 'h.210', 101366006, '2018-10-21', 1, 400, 'N', 'El ave est? demasiada flaca.');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `control_comida`
--
-- Creación: 11-06-2017 a las 01:23:26
--

DROP TABLE IF EXISTS `control_comida`;
CREATE TABLE `control_comida` (
  `Cco_control` int(6) NOT NULL COMMENT 'Control',
  `Cco_tco` varchar(2) COLLATE latin1_spanish_ci NOT NULL COMMENT 'Comida',
  `Coo_cant` int(1) NOT NULL COMMENT 'Cantidad'
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_spanish_ci COMMENT='Comida que come un ave en un control' ROW_FORMAT=COMPACT;

--
-- RELACIONES PARA LA TABLA `control_comida`:
--   `Cco_control`
--       `control` -> `Con_id`
--   `Cco_tco`
--       `tipo_comida` -> `Tco_cod`
--   `Cco_tco`
--       `tipo_comida` -> `Tco_cod`
--

--
-- Volcado de datos para la tabla `control_comida`
--

INSERT INTO `control_comida` (`Cco_control`, `Cco_tco`, `Coo_cant`) VALUES
(1, 'po', 1),
(1, 'ra', 3);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `destino`
--
-- Creación: 11-06-2017 a las 01:23:26
--

DROP TABLE IF EXISTS `destino`;
CREATE TABLE `destino` (
  `Des_Control` int(6) NOT NULL COMMENT 'Control',
  `Des_sede` varchar(5) COLLATE latin1_spanish_ci NOT NULL COMMENT 'Sede'
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_spanish_ci COMMENT='Lugar al que va un ave';

--
-- RELACIONES PARA LA TABLA `destino`:
--   `Des_Control`
--       `control` -> `Con_id`
--   `Des_sede`
--       `sede` -> `sed_cod`
--

--
-- Volcado de datos para la tabla `destino`
--

INSERT INTO `destino` (`Des_Control`, `Des_sede`) VALUES
(1, 'hompt'),
(2, 'metpb');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `especie`
--
-- Creación: 11-06-2017 a las 01:23:26
--

DROP TABLE IF EXISTS `especie`;
CREATE TABLE `especie` (
  `Esp_id` varchar(3) COLLATE latin1_spanish_ci NOT NULL COMMENT 'ID',
  `Esp_nombre` varchar(30) COLLATE latin1_spanish_ci NOT NULL COMMENT 'Especie de un ave'
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_spanish_ci COMMENT='Especie de un ave';

--
-- RELACIONES PARA LA TABLA `especie`:
--

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
-- Creación: 11-06-2017 a las 01:23:26
--

DROP TABLE IF EXISTS `estado`;
CREATE TABLE `estado` (
  `Est_id` varchar(3) COLLATE latin1_spanish_ci NOT NULL COMMENT 'ID',
  `Est_descrip` varchar(30) COLLATE latin1_spanish_ci NOT NULL COMMENT 'Descripci?n'
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_spanish_ci COMMENT='Estado del ave';

--
-- RELACIONES PARA LA TABLA `estado`:
--

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
-- Creación: 11-06-2017 a las 01:23:26
--

DROP TABLE IF EXISTS `nota`;
CREATE TABLE `nota` (
  `not_cod` int(6) NOT NULL COMMENT 'ID',
  `not_usuario` int(9) DEFAULT NULL COMMENT 'Usuario',
  `not_fecha` date DEFAULT NULL COMMENT 'Fecha',
  `not_descrip` varchar(500) COLLATE latin1_spanish_ci DEFAULT NULL COMMENT 'anotacion',
  `not_turno` int(1) DEFAULT NULL COMMENT 'turno'
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_spanish_ci COMMENT='Notas que pueden dejar los usuarios';

--
-- RELACIONES PARA LA TABLA `nota`:
--

--
-- Volcado de datos para la tabla `nota`
--

INSERT INTO `nota` (`not_cod`, `not_usuario`, `not_fecha`, `not_descrip`, `not_turno`) VALUES
(1, 101366006, '2017-05-09', 'Todas las aves estaban alteradas, no s? que les paso, no estoy entrenado para esto.', 0),
(2, 101366006, '2017-05-09', 'Est?n m?s tranquilas ahora, hoy fue un d?a fresco y donde trabajaron hab?an hartos ?rboles as? que se divirtieron un poco.', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `provincia`
--
-- Creación: 11-06-2017 a las 00:23:27
-- Última actualización: 11-06-2017 a las 01:23:27
--

DROP TABLE IF EXISTS `provincia`;
CREATE TABLE `provincia` (
  `pro_id` int(3) NOT NULL COMMENT 'C?digo',
  `pro_nombre` varchar(40) DEFAULT NULL COMMENT 'Nombre',
  `pro_idreg` varchar(5) DEFAULT NULL COMMENT 'Region a la que pertenece'
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COMMENT='Provincias de Chile' ROW_FORMAT=DYNAMIC;

--
-- RELACIONES PARA LA TABLA `provincia`:
--   `pro_idreg`
--       `region` -> `reg_ID`
--

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
(8, 'Copiap?', '3'),
(9, 'Cha?aral', '3'),
(10, 'Huasco', '3'),
(11, 'Elqui', '4'),
(12, 'Choapa', '4'),
(13, 'Limar?', '4'),
(14, 'Valpara?so', '5'),
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
(27, 'Curic?', '7'),
(28, 'Linares', '7'),
(29, 'Concepci?n', '8'),
(30, 'Arauco', '8'),
(31, 'Biob?o', '8'),
(32, '?uble', '8'),
(33, 'Caut?n', '9'),
(34, 'Malleco', '9'),
(35, 'Valdivia', '14'),
(36, 'Ranco', '14'),
(37, 'Llanquihue', '10'),
(38, 'Chilo?', '10'),
(39, 'Osorno', '10'),
(40, 'Palena', '10'),
(41, 'Coihaique', '11'),
(42, 'Ais?n', '11'),
(43, 'Capit?n Prat', '11'),
(44, 'General Carrera', '11'),
(45, 'Magallanes', '12'),
(46, 'Ant?rtica Chilena', '12'),
(47, 'Tierra del Fuego', '12'),
(48, '?ltima Esperanza', '12'),
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
-- Creación: 11-06-2017 a las 01:23:26
--

DROP TABLE IF EXISTS `region`;
CREATE TABLE `region` (
  `reg_ID` int(3) NOT NULL COMMENT 'Codigo',
  `reg_nombre` varchar(60) COLLATE latin1_spanish_ci DEFAULT NULL COMMENT 'Nombre',
  `reg_abrev` varchar(5) COLLATE latin1_spanish_ci DEFAULT NULL COMMENT 'Abreviatura de las regiones ISO 3166 2 CL'
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_spanish_ci COMMENT='Regiones de chile';

--
-- RELACIONES PARA LA TABLA `region`:
--

--
-- Volcado de datos para la tabla `region`
--

INSERT INTO `region` (`reg_ID`, `reg_nombre`, `reg_abrev`) VALUES
(1, 'Tarapac?', 'CL-TA'),
(2, 'Antofagasta', 'CL-AN'),
(3, 'Atacama', 'CL-AT'),
(4, 'Coquimbo', 'CL-CO'),
(5, 'Valpara?so', 'CL-VS'),
(6, 'Regi?n del Libertador Gral. Bernardo O?Higgins', 'CL-LI'),
(7, 'Regi?n del Maule', 'CL-ML'),
(8, 'Regi?n del Biob?o', 'CL-BI'),
(9, 'Regi?n de la Araucan?a', 'CL-AR'),
(10, 'Regi?n de Los Lagos', 'CL-LL'),
(11, 'Regi?n Ais?n del Gral. Carlos Ib??ez del Campo', 'CL-AI'),
(12, 'Regi?n de Magallanes y de la Ant?rtica Chilena', 'CL-MA'),
(13, 'Regi?n Metropolitana de Santiago', 'CL-RM'),
(14, 'Regi?n de Los R?os', 'CL-LR'),
(15, 'Arica y Parinacota', 'CL-AP');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `rubro`
--
-- Creación: 11-06-2017 a las 01:23:26
--

DROP TABLE IF EXISTS `rubro`;
CREATE TABLE `rubro` (
  `Rub_cod` varchar(3) COLLATE latin1_spanish_ci NOT NULL COMMENT 'ID',
  `Rub_descrip` varchar(50) CHARACTER SET latin1 DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_spanish_ci COMMENT='Sector en el que se desempe?a el cliente';

--
-- RELACIONES PARA LA TABLA `rubro`:
--

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
-- Creación: 11-06-2017 a las 01:23:26
--

DROP TABLE IF EXISTS `sede`;
CREATE TABLE `sede` (
  `sed_cod` varchar(5) COLLATE latin1_spanish_ci NOT NULL COMMENT 'C?digo',
  `sed_nombre` varchar(150) COLLATE latin1_spanish_ci NOT NULL COMMENT 'Nombre',
  `sed_cliente` varchar(3) COLLATE latin1_spanish_ci NOT NULL COMMENT 'Cliente',
  `sed_comuna` int(3) NOT NULL COMMENT 'Comuna'
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_spanish_ci COMMENT='Sede del cliente';

--
-- RELACIONES PARA LA TABLA `sede`:
--   `sed_cliente`
--       `cliente` -> `cli_cod`
--   `sed_comuna`
--       `comuna` -> `com_id`
--

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
-- Creación: 11-06-2017 a las 01:23:26
--

DROP TABLE IF EXISTS `tipo_comida`;
CREATE TABLE `tipo_comida` (
  `Tco_cod` varchar(2) COLLATE latin1_spanish_ci NOT NULL COMMENT 'ID',
  `Tco_animal` varchar(30) COLLATE latin1_spanish_ci NOT NULL COMMENT 'Animal'
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_spanish_ci COMMENT='Tipo de comida que come un ave';

--
-- RELACIONES PARA LA TABLA `tipo_comida`:
--

--
-- Volcado de datos para la tabla `tipo_comida`
--

INSERT INTO `tipo_comida` (`Tco_cod`, `Tco_animal`) VALUES
('po', 'Pollito'),
('ra', 'Rat?n');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `turno`
--
-- Creación: 11-06-2017 a las 01:23:26
--

DROP TABLE IF EXISTS `turno`;
CREATE TABLE `turno` (
  `Tur_cod` int(1) NOT NULL COMMENT 'ID',
  `Tur_descp` varchar(50) COLLATE latin1_spanish_ci NOT NULL COMMENT 'Descripci?n',
  `Tur_hora_ini` varchar(5) COLLATE latin1_spanish_ci NOT NULL COMMENT 'Hora inicio',
  `Tur_hora_final` varchar(5) COLLATE latin1_spanish_ci NOT NULL COMMENT 'Hora final'
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_spanish_ci COMMENT='Turno en el que hace un control';

--
-- RELACIONES PARA LA TABLA `turno`:
--

--
-- Volcado de datos para la tabla `turno`
--

INSERT INTO `turno` (`Tur_cod`, `Tur_descp`, `Tur_hora_ini`, `Tur_hora_final`) VALUES
(0, 'Ma?ana', '08:00', '10:00'),
(1, 'tarde', '19:00', '22:00');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuario`
--
-- Creación: 11-06-2017 a las 01:37:24
--

DROP TABLE IF EXISTS `usuario`;
CREATE TABLE `usuario` (
  `usu_rut` int(9) NOT NULL COMMENT 'Rut',
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
-- RELACIONES PARA LA TABLA `usuario`:
--   `usu_cargo`
--       `cargo` -> `Car_cod`
--   `usu_comuna`
--       `comuna` -> `com_id`
--

--
-- Volcado de datos para la tabla `usuario`
--

INSERT INTO `usuario` (`usu_rut`, `usu_contra`, `usu_nombre`, `usu_apellido`, `usu_fnac`, `usu_dir`, `usu_comuna`, `usu_telefono`, `usu_celular`, `usu_cargo`) VALUES
(50553205, 'asdf', 'Claudi', 'Saji', '1996-09-11', 'cosa #213', 288, 987654321, 569876543, 'Cet'),
(101366006, 'qwerty', 'Rodolfo', 'Zu?iga', '1995-10-25', 'San fernando #9876', 296, 789789789, 561234567, 'Jef');

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
  ADD PRIMARY KEY (`cli_cod`);

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
  ADD KEY `Con_turno` (`Con_turno`);

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
  ADD PRIMARY KEY (`Des_Control`,`Des_sede`);

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
  ADD PRIMARY KEY (`not_cod`);

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
  ADD PRIMARY KEY (`sed_cod`);

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
  MODIFY `Con_id` int(6) NOT NULL AUTO_INCREMENT COMMENT 'ID', AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT de la tabla `nota`
--
ALTER TABLE `nota`
  MODIFY `not_cod` int(6) NOT NULL AUTO_INCREMENT COMMENT 'ID', AUTO_INCREMENT=3;
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
-- Filtros para la tabla `control`
--
ALTER TABLE `control`
  ADD CONSTRAINT `control_ibfk_1` FOREIGN KEY (`Con_Ave`) REFERENCES `ave` (`Ave_anillo`),
  ADD CONSTRAINT `control_ibfk_2` FOREIGN KEY (`Con_turno`) REFERENCES `turno` (`Tur_cod`);

--
-- Filtros para la tabla `control_comida`
--
ALTER TABLE `control_comida`
  ADD CONSTRAINT `control_comida_ibfk_2` FOREIGN KEY (`Cco_tco`) REFERENCES `tipo_comida` (`Tco_cod`);


--
-- Metadatos
--
USE `phpmyadmin`;

--
-- Metadatos para la tabla ave
--

--
-- Metadatos para la tabla cargo
--

--
-- Metadatos para la tabla cliente
--

--
-- Metadatos para la tabla comuna
--

--
-- Metadatos para la tabla control
--

--
-- Metadatos para la tabla control_comida
--

--
-- Metadatos para la tabla destino
--

--
-- Metadatos para la tabla especie
--

--
-- Metadatos para la tabla estado
--

--
-- Volcado de datos para la tabla `pma__table_uiprefs`
--

INSERT INTO `pma__table_uiprefs` (`username`, `db_name`, `table_name`, `prefs`, `last_update`) VALUES
('root', 'mis_aves', 'estado', '{\"sorted_col\":\"`estado`.`Est_descrip` ASC\"}', '2017-06-11 07:41:33');

--
-- Metadatos para la tabla nota
--

--
-- Metadatos para la tabla provincia
--

--
-- Metadatos para la tabla region
--

--
-- Metadatos para la tabla rubro
--

--
-- Metadatos para la tabla sede
--

--
-- Metadatos para la tabla tipo_comida
--

--
-- Metadatos para la tabla turno
--

--
-- Metadatos para la tabla usuario
--

--
-- Metadatos para la base de datos mis_aves
--

--
-- Volcado de datos para la tabla `pma__relation`
--

INSERT INTO `pma__relation` (`master_db`, `master_table`, `master_field`, `foreign_db`, `foreign_table`, `foreign_field`) VALUES
('mis_aves', 'cliente', 'cli_rubro', 'mis_aves', 'rubro', 'Rub_cod'),
('mis_aves', 'comuna', 'com_idprov', 'mis_aves', 'provincia', 'pro_id'),
('mis_aves', 'control_comida', 'Cco_control', 'mis_aves', 'control', 'Con_id'),
('mis_aves', 'control_comida', 'Cco_tco', 'mis_aves', 'tipo_comida', 'Tco_cod'),
('mis_aves', 'destino', 'Des_Control', 'mis_aves', 'control', 'Con_id'),
('mis_aves', 'destino', 'Des_sede', 'mis_aves', 'sede', 'sed_cod'),
('mis_aves', 'provincia', 'pro_idreg', 'mis_aves', 'region', 'reg_ID'),
('mis_aves', 'sede', 'sed_cliente', 'mis_aves', 'cliente', 'cli_cod'),
('mis_aves', 'sede', 'sed_comuna', 'mis_aves', 'comuna', 'com_id'),
('mis_aves', 'usuario', 'usu_cargo', 'mis_aves', 'cargo', 'Car_cod'),
('mis_aves', 'usuario', 'usu_comuna', 'mis_aves', 'comuna', 'com_id');
COMMIT;
