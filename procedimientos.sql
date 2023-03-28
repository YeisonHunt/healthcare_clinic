-- phpMyAdmin SQL Dump
-- version 4.2.11
-- http://www.phpmyadmin.net
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 09-03-2017 a las 23:30:53
-- Versión del servidor: 5.6.21
-- Versión de PHP: 5.6.3

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Base de datos: `clinic`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `procedimientos`
--

CREATE TABLE IF NOT EXISTS `procedimientos` (
`idPro` int(11) NOT NULL,
  `cantidad` varchar(120) DEFAULT '1',
  `descripcionPro` varchar(450) DEFAULT NULL,
  `formaFarma` varchar(120) NOT NULL,
  `necesidad` varchar(120) DEFAULT NULL,
  `tiempo` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `tipoProcedimiento_idTipo` int(11) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=106 DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `procedimientos`
--

INSERT INTO `procedimientos` (`idPro`, `cantidad`, `descripcionPro`, `formaFarma`, `necesidad`, `tiempo`, `tipoProcedimiento_idTipo`) VALUES
(1, '1', 'Cloruro de sodio 9% ó Lactato según necesidad', 'Frasco o bolsa', '500 ó 200 ml', '2017-02-24 16:56:16', 2),
(2, '1', 'Bryonal LHA', 'Ampolla', '2 ml', '2017-02-21 21:19:47', 2),
(3, '1', 'Discolver LHA', 'Ampolla ', '2 ml', '2017-02-21 21:19:47', 2),
(4, '1', 'Tranic LHA', 'Ampolla', '2 ml', '2017-02-21 21:19:47', 2),
(5, '1', 'Calhose LHA ', 'Ampolla ', '2 ml', '2017-02-21 21:19:47', 2),
(6, '1', 'Rutox LHA', 'Ampolla ', '2 ml', '2017-02-21 21:19:47', 2),
(7, '1', 'Magnesio sulfato', 'Ampolla', '10 ml', '2017-02-21 21:19:47', 2),
(8, '1', 'Bicarbonato de Sodio', 'Ampolla ', '10 ml', '2017-02-21 21:19:47', 2),
(9, '1', 'Oligomax LHA', 'Vial', '10 ml', '2017-02-21 21:19:47', 2),
(10, '1', 'Procaina Clohidrato 2%', 'Frasco', '2 ml', '2017-02-21 21:19:47', 2),
(11, '1', 'Cloruro de Sodio 9% o Lactáto según necesidad', 'Frasco o bolsa', '500 ó 250 ml', '2017-02-24 21:41:01', 3),
(12, '1', 'Echinal LHA', 'Ampolla', '2 ml', '2017-02-24 21:41:01', 3),
(13, '1', 'Vintox LHA', 'Ampolla', '2 ml', '2017-02-24 21:41:01', 3),
(14, '1', 'Azuphur LHA', 'Ampolla', '2 ml', '2017-02-24 21:41:01', 3),
(15, '1', 'Nuxvom LHA', 'Ampolla', '2 ml', '2017-02-24 21:41:01', 3),
(16, '1', 'Magnesio', 'Ampolla', '10 ml', '2017-02-24 21:41:49', 3),
(17, '1', 'Oligomax LHA', 'Vial', '10 ml', '2017-02-24 21:41:49', 3),
(18, '1', 'Ácido ascórbico', 'Frasco o ampolla', '5 gr', '2017-02-24 21:43:03', 3),
(19, '1', 'Procaína clorhidrato 2%', 'Frasco', '2 ml', '2017-02-24 21:43:03', 3),
(20, '1', 'Cloruro de Sodio 9% ó Lactato según necesidad', 'Frasco o Bolsa', '500 ó 200 ml', '2017-02-24 21:56:21', 4),
(21, '1', 'Hamadron LHA', 'Ampolla', '2 ml', '2017-02-24 21:56:21', 4),
(22, '1', 'Barycar LHA', 'Ampolla', ' 2 ml', '2017-02-24 21:57:44', 4),
(23, '1', 'Plazar LHA', 'Ampolla', '2 ml', '2017-02-24 21:57:44', 4),
(24, '1', 'Cedronal LHA', 'Ampolla', '2 ml', '2017-02-24 21:58:27', 4),
(25, '1', 'Trarnic LHA', 'Ampolla', '2 ml', '2017-02-24 21:58:27', 4),
(26, '1', 'Procaína clorhidrato 1%', 'Frasco ', '2 ml', '2017-02-24 21:59:20', 4),
(27, '1', 'Magnesio', 'Ampolla', '10 ml', '2017-02-24 21:59:56', 4),
(28, '1', 'Potasio', '', '', '2017-02-24 23:37:18', 4),
(29, '1', 'Oligomax LHA', 'Vial', '10 ml', '2017-02-24 22:00:28', 4),
(30, '1', 'Complejo B', 'Frasco o Ampolla ', '2 ml', '2017-02-24 22:01:24', 4),
(31, '1', 'Acido ascórbico', '', '', '2017-02-24 22:05:12', 4),
(34, '1', 'Cloruro de sodio 9% ó lactato según necesidad', 'Frasco o bolsa', '500 ó 250 ml', '2017-02-24 22:08:19', 5),
(35, '1', 'Agnamar MR', 'Ampolla ', '2 ml', '2017-02-24 22:08:19', 5),
(36, '1', 'Emzym LHA', 'Ampolla', '2 ml', '2017-02-24 22:09:03', 5),
(37, '1', 'Plazar LHA', 'Ampolla ', '2 ml', '2017-02-24 22:09:03', 5),
(38, '1', 'Glanthy LHA', 'Ampolla', '2 ml', '2017-02-24 22:25:38', 5),
(39, '1', 'Barycar LHA', 'Ampolla', '2 ml', '2017-02-24 22:10:06', 5),
(42, '1', 'Testes LHA (Masculino)', 'Ampolla', ' 2 ml', '2017-02-24 22:15:43', 5),
(43, '1', 'Ovafem (Femenino)', 'Ampolla', '2 ml', '2017-02-24 22:15:43', 5),
(44, '1', 'Magnesio sultafo', 'Ampolla', '10 ml', '2017-02-24 22:16:21', 5),
(45, '1', 'Potasio ', 'Ampolla', '10 ml', '2017-02-24 22:16:21', 5),
(46, '1', 'Oligomax LHA ', 'Vial', '10 ml', '2017-02-24 22:17:32', 5),
(47, '1', 'Complejo B', 'Frasco ó Ampolla', '2 ml', '2017-02-24 22:17:32', 5),
(48, '1', 'Procaína clorhidrato 1 %', 'Frasco', '2 ml', '2017-02-24 22:17:53', 5),
(49, '1', 'Cloruro de sodio 9% ó Lactáto según necesidad', 'Frasco ó Bolsa', '500 ó 250 ml', '2017-02-24 22:25:20', 6),
(50, '1', 'Glanthy LHA', 'Ampolla ', '2 ml', '2017-02-24 22:25:20', 6),
(51, '1', 'Fusorbes LHA', 'Ampolla', '2 ml', '2017-02-24 22:26:36', 6),
(52, '1', 'Grader LHA', 'Ampolla', ' 2 ml', '2017-02-24 22:26:36', 6),
(53, '1', 'Potasio', 'Ampolla', '10 ml', '2017-02-24 22:27:07', 6),
(54, '1', 'Oligomax LHA', 'Vial', '10 ml', '2017-02-24 22:27:07', 6),
(55, '1', 'Ácido ascórbico', 'Frasco', '5 gr', '2017-02-24 22:27:36', 6),
(56, '1', 'Cloruro de sodio 9% o lactáto según necesidad', 'Frasco o bolsa', '500 ml', '2017-02-24 22:29:36', 7),
(57, '1', 'Trarnic LHA', 'Ampolla', '2 ml', '2017-02-24 22:29:36', 7),
(58, '1', 'Berbull LHA', 'Ampolla', '2 ml', '2017-02-24 22:30:18', 7),
(59, '1', 'Scrolyn LHA', 'Ampolla', '2 ml', '2017-02-24 22:30:18', 7),
(60, '1', 'Nuxvom LHA', 'Ampolla', '2 ml', '2017-02-24 22:31:05', 7),
(61, '1', 'Bicarbonato de sodio', 'Ampolla', '2 ml', '2017-02-24 22:31:05', 7),
(62, '1', 'Oligomax LHA', 'Vial', '10 ml', '2017-02-24 22:31:42', 7),
(63, '1', 'Ácido ascórbico', 'Frasco o ampolla', '5 gr', '2017-02-24 22:31:42', 7),
(64, '1', 'Cloruro de sodio 9% ó Lactato según necesidad', 'Frasco ó bolsa', '500 ó 250 ml', '2017-02-24 22:33:29', 8),
(65, '1', 'Lycop LHA', 'Ampolla', '2 ml', '2017-02-24 22:33:29', 8),
(66, '1', 'Apimel LHA', 'Ampolla ', '2 ml', '2017-02-24 22:35:14', 8),
(67, '1', 'Berbull LHA', 'Ampolla ', '2 ml', '2017-02-24 22:35:14', 8),
(68, '1', 'Chimall LHA', 'Ampolla', '2 ml', '2017-02-24 22:36:05', 8),
(69, '1', 'Galdepur LHA', 'Ampolla ', '2 ml', '2017-02-24 22:36:05', 8),
(70, '1', 'Bicarbonato de sodio', 'Ampolla', '10 ml', '2017-02-24 22:36:44', 8),
(71, '1', 'Oligomax LHA', 'Vial ', '10 ml', '2017-02-24 22:36:44', 8),
(72, '1', 'Procaína clorhidrato 2%', 'Frasco', '2 ml', '2017-02-24 22:37:38', 8),
(73, '1', 'Ácido ascórbico', 'Frasco o ampolla', '5 gr', '2017-02-24 22:37:38', 8),
(76, '1', 'Cloruro de sodio 9% o lactato según necesidad', 'Frasco ó Bolsa', '250 ml', '2017-02-24 22:39:32', 9),
(77, '1', 'Emzym LHA', 'Ampolla', '2 ml', '2017-02-24 22:39:32', 9),
(78, '1', 'Galdepur LHA', 'Ampolla', '2 ml', '2017-02-24 22:40:47', 9),
(79, '1', 'Nuxvom LHA', 'Ampolla', '2 ml', '2017-02-24 22:40:47', 9),
(80, '1', 'Berbull LHA', 'Ampolla', '2 ml', '2017-02-24 22:42:00', 9),
(81, '1', 'Procaína clorhidrato 1%', 'Frasco', '2 ml', '2017-02-24 22:42:00', 9),
(82, '1', 'Bicarbonato de sodio', 'Ampolla', '10 ml', '2017-02-24 22:42:38', 9),
(83, '1', 'Ácido ascórbico', 'Frasco ó Ampolla', '5 gr', '2017-02-24 22:42:38', 9),
(84, '1', 'Oligomax LHA', 'Vial', '10 ml', '2017-02-24 22:43:17', 9),
(85, '1', 'Complejo B', 'Frasco ó Ampolla', '2 ml', '2017-02-24 22:43:17', 9),
(86, '1', 'Cloruro de sodio 9% o lactato según necesidad', 'Frasco ó bolsa', '500 ó 250 ml', '2017-02-24 22:45:50', 10),
(87, '1', 'Galdepur LHA', 'Ampolla ', '2 ml', '2017-02-24 22:45:50', 10),
(88, '1', 'Emzym LHA', 'Ampolla', '2 ml', '2017-02-24 22:46:25', 10),
(89, '1', 'Nuxvom LHA', 'Ampolla', '2 ml', '2017-02-24 22:46:25', 10),
(90, '1', 'Scrolyn LHA', 'Ampolla', '2 ml', '2017-02-24 22:47:12', 10),
(91, '1', 'Potasio', 'Ampolla', '10 ml', '2017-02-24 22:47:12', 10),
(92, '1', 'Bicarbonato de sodio', 'Ampolla', '20 ml', '2017-02-24 22:47:59', 10),
(93, '1', 'Oligomax LHA ', 'Vial', '10 ml', '2017-02-24 22:47:59', 10),
(94, '1', 'Ácido ascórbico', 'Frasco', '10 gr', '2017-02-24 22:49:10', 10),
(95, '1', 'Procaína clorhidrato 2%', 'Frasco', '2 ml', '2017-02-24 22:49:10', 10),
(96, '1', 'Cloruro de sodio 9% o Lactato según necesidad', 'Frasco o Bolsa', '500 ó 250 ml', '2017-03-09 17:00:14', 1),
(97, '1', 'Mucsan LHA', 'Ampolla', '2 ml', '2017-03-09 17:00:14', 1),
(98, '1', 'Colozyn LHA', 'Ampolla', '2 ml', '2017-03-09 17:01:22', 1),
(99, '1', 'Scrolyn LHA', 'Ampolla ', '2 ml', '2017-03-09 17:01:22', 1),
(100, '1', 'Nuxvom LHA', 'Ampolla', '2 ml', '2017-03-09 17:08:10', 1),
(101, '1', 'Epache LHA ', 'Ampolla', '2 ml', '2017-03-09 17:08:10', 1),
(102, '1', 'Magnesio Sulfato', 'Ampolla', '10 ml', '2017-03-09 17:09:15', 1),
(103, '1', 'Potasio', 'A criterio médico', 'A criterio', '2017-03-09 17:09:15', 1),
(104, '1', 'Oligomax LHA', 'Vial', '10 ml', '2017-03-09 17:10:42', 1),
(105, '1', 'Procaína Clorhidrato 2%', 'Frasco', '2 ml', '2017-03-09 17:10:42', 1);

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `procedimientos`
--
ALTER TABLE `procedimientos`
 ADD PRIMARY KEY (`idPro`,`tipoProcedimiento_idTipo`), ADD KEY `fk_procedimientos_tipoProcedimiento1_idx` (`tipoProcedimiento_idTipo`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `procedimientos`
--
ALTER TABLE `procedimientos`
MODIFY `idPro` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=106;
--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `procedimientos`
--
ALTER TABLE `procedimientos`
ADD CONSTRAINT `fk_procedimientos_tipoProcedimiento1` FOREIGN KEY (`tipoProcedimiento_idTipo`) REFERENCES `tipoprocedimiento` (`idTipo`) ON DELETE NO ACTION ON UPDATE NO ACTION;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
