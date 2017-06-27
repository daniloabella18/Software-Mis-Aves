-- phpMyAdmin SQL Dump
-- version 4.7.0
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 27-06-2017 a las 09:44:25
-- Versión del servidor: 10.1.24-MariaDB
-- Versión de PHP: 7.1.6

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";

--
-- Base de datos: `mis_aves`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuario`
--
-- Creación: 25-06-2017 a las 10:36:01
--

DROP TABLE IF EXISTS `usuario`;
CREATE TABLE IF NOT EXISTS `usuario` (
  `usu_rut` varchar(10) COLLATE latin1_spanish_ci NOT NULL COMMENT 'Rut',
  `usu_contra` varchar(60) COLLATE latin1_spanish_ci NOT NULL COMMENT 'Contraseña',
  `usu_nombre` varchar(60) COLLATE latin1_spanish_ci DEFAULT NULL COMMENT 'Nombre',
  `usu_apellido` varchar(60) COLLATE latin1_spanish_ci DEFAULT NULL COMMENT 'Apellido',
  `usu_fnac` date NOT NULL COMMENT 'Fecha nacimiento',
  `usu_dir` varchar(100) COLLATE latin1_spanish_ci DEFAULT NULL COMMENT 'Direccion',
  `usu_comuna` int(3) DEFAULT NULL COMMENT 'Comuna',
  `usu_telefono` int(9) NOT NULL COMMENT 'Numero telefono casa',
  `usu_celular` int(11) DEFAULT NULL COMMENT 'Numero telefono celular',
  `usu_cargo` varchar(3) COLLATE latin1_spanish_ci DEFAULT NULL COMMENT 'cargo',
  PRIMARY KEY (`usu_rut`)
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
('10136600-6', 'qwerty', 'Rodolfo', 'Zuñiga', '1995-10-25', 'San fernando #9876', 296, 789789789, 561234567, 'Jef'),
('5055320-5', 'asdf', 'Claudi', 'Saji', '1996-09-11', 'cosa #213', 288, 987654321, 569876543, 'Cet');


--
-- Metadatos
--
USE `phpmyadmin`;

--
-- Metadatos para la tabla usuario
--
COMMIT;
