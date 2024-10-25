-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 25-10-2024 a las 11:49:22
-- Versión del servidor: 10.4.32-MariaDB
-- Versión de PHP: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `cepa`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `alumno`
--

CREATE TABLE `alumno` (
  `idAlumno` int(10) NOT NULL,
  `nombre` varchar(50) NOT NULL,
  `primerApellido` varchar(50) NOT NULL,
  `segundoApellido` varchar(50) DEFAULT NULL,
  `dni` varchar(9) NOT NULL,
  `telefono` int(9) NOT NULL,
  `direccion` varchar(100) NOT NULL,
  `cp` varchar(5) NOT NULL,
  `ciudad` varchar(50) NOT NULL,
  `fechaUltimoEst` date DEFAULT NULL,
  `idProvincia` int(3) NOT NULL,
  `idEstudios` int(2) NOT NULL,
  `idFamiliar` int(10) DEFAULT NULL,
  `fechaNacimiento` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `alumno`
--

INSERT INTO `alumno` (`idAlumno`, `nombre`, `primerApellido`, `segundoApellido`, `dni`, `telefono`, `direccion`, `cp`, `ciudad`, `fechaUltimoEst`, `idProvincia`, `idEstudios`, `idFamiliar`, `fechaNacimiento`) VALUES
(20, 'José Luis', 'Osorio', 'González', '52385922h', 651484015, 'Calle Cardenio', '13600', 'Alcázar De San Juán', '2024-10-10', 13, 18, 20, '2006-10-11');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `familiar`
--

CREATE TABLE `familiar` (
  `idFamiliar` int(10) NOT NULL,
  `nombreFamiliar` varchar(100) NOT NULL,
  `telefono` int(9) NOT NULL,
  `idRelacion` int(2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `familiar`
--

INSERT INTO `familiar` (`idFamiliar`, `nombreFamiliar`, `telefono`, `idRelacion`) VALUES
(20, 'osrio', 666666666, 8);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `nivelestudios`
--

CREATE TABLE `nivelestudios` (
  `idEstudios` int(2) NOT NULL,
  `nombreNivel` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `nivelestudios`
--

INSERT INTO `nivelestudios` (`idEstudios`, `nombreNivel`) VALUES
(2, 'E. universitarios 1º ciclo (Diplomatura-Grados)'),
(3, 'E. universitarios 2º ciclo (Licenciatura-Master)'),
(4, 'Prueba de acceso a la Universidad'),
(5, 'BUP'),
(6, 'Educacion primaria'),
(7, 'E. universitarios 3º ciclo (Doctorado)'),
(8, 'TECNICO AUXILIAR'),
(9, 'CERTIFICA. PROFES. N 3'),
(10, 'LICENCIATURA'),
(11, 'GRADO'),
(12, 'Competencias Clave Nivel 2'),
(13, 'MASTER UNIVERSITARIO'),
(14, 'TECNICO SUPERIOR'),
(15, 'BACHILLERATO'),
(16, 'GRADO SUPERIOR'),
(17, 'PRUEBAS DE ACCESO A GRADO SUPERIOR'),
(18, 'I.T. INFORMATICO DE SISTEMAS'),
(19, 'CERTIFICA. PROFES. N 2'),
(20, 'GRADO MEDIO'),
(21, 'ESO'),
(22, 'CERTIFICA. PROFES. N 1'),
(23, 'Sin Estudios'),
(24, 'DIPLOMATURA'),
(25, 'FPI'),
(26, 'COMPETENCIAS CLAVE'),
(27, 'GRADUADO ESCOLAR'),
(28, 'FPII '),
(29, 'EGB'),
(30, 'PRUEBA DE ACCESO A GRADO MEDIO'),
(31, 'Competencias Clave Nivel 3'),
(32, 'COU');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `parentesco`
--

CREATE TABLE `parentesco` (
  `idRelacion` int(2) NOT NULL,
  `nombreRelacion` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `parentesco`
--

INSERT INTO `parentesco` (`idRelacion`, `nombreRelacion`) VALUES
(1, 'CÓNYUGE'),
(2, 'PADRE'),
(3, 'MADRE'),
(4, 'HERMAN@'),
(5, 'ABUEL@'),
(6, 'SUEGR@'),
(7, 'CUÑAD@'),
(8, 'PRIM@'),
(9, 'TI@'),
(10, 'VECIN@'),
(11, 'AMIG@'),
(12, 'OTROS');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `provincia`
--

CREATE TABLE `provincia` (
  `idProvincia` int(3) NOT NULL,
  `nombreProvincia` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `provincia`
--

INSERT INTO `provincia` (`idProvincia`, `nombreProvincia`) VALUES
(1, 'Araba/Alava'),
(2, 'Albacete'),
(3, 'Alicante/Alacant'),
(4, 'Almeria'),
(5, 'Avila'),
(6, 'Badajoz'),
(7, 'Balears, Illes'),
(8, 'Barcelona'),
(9, 'Burgos'),
(10, 'Caceres'),
(11, 'Cadiz'),
(12, 'Castellon/Castello'),
(13, 'Ciudad Real'),
(14, 'Cordoba'),
(15, 'Coruña, A'),
(16, 'Cuenca'),
(17, 'Girona'),
(18, 'Granada'),
(19, 'Guadalajara'),
(20, 'Gipuzkoa'),
(21, 'Huelva'),
(22, 'Huesca'),
(23, 'Jaen'),
(24, 'Leon'),
(25, 'Lleida'),
(26, 'Rioja, La'),
(27, 'Lugo'),
(28, 'Madrid'),
(29, 'Malaga'),
(30, 'Murcia'),
(31, 'Navarra'),
(32, 'Ourense'),
(33, 'Asturias'),
(34, 'Palencia'),
(35, 'Palmas, Las'),
(36, 'Pontevedra'),
(37, 'Salamanca'),
(38, 'Santa Cruz de Tenerife'),
(39, 'Cantabria'),
(40, 'Segovia'),
(41, 'Sevilla'),
(42, 'Soria'),
(43, 'Tarragona'),
(44, 'Teruel'),
(45, 'Toledo'),
(46, 'Valencia/Valencia'),
(47, 'Valladolid'),
(48, 'Bizkaia'),
(49, 'Zamora'),
(50, 'Zaragoza'),
(51, 'Ceuta'),
(52, 'Melilla');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `alumno`
--
ALTER TABLE `alumno`
  ADD PRIMARY KEY (`idAlumno`),
  ADD KEY `idProvincia` (`idProvincia`),
  ADD KEY `idEstudios` (`idEstudios`),
  ADD KEY `idFamiliar` (`idFamiliar`);

--
-- Indices de la tabla `familiar`
--
ALTER TABLE `familiar`
  ADD PRIMARY KEY (`idFamiliar`),
  ADD KEY `idRelacion` (`idRelacion`);

--
-- Indices de la tabla `nivelestudios`
--
ALTER TABLE `nivelestudios`
  ADD PRIMARY KEY (`idEstudios`);

--
-- Indices de la tabla `parentesco`
--
ALTER TABLE `parentesco`
  ADD PRIMARY KEY (`idRelacion`);

--
-- Indices de la tabla `provincia`
--
ALTER TABLE `provincia`
  ADD PRIMARY KEY (`idProvincia`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `alumno`
--
ALTER TABLE `alumno`
  MODIFY `idAlumno` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT de la tabla `familiar`
--
ALTER TABLE `familiar`
  MODIFY `idFamiliar` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT de la tabla `nivelestudios`
--
ALTER TABLE `nivelestudios`
  MODIFY `idEstudios` int(2) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=33;

--
-- AUTO_INCREMENT de la tabla `parentesco`
--
ALTER TABLE `parentesco`
  MODIFY `idRelacion` int(2) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT de la tabla `provincia`
--
ALTER TABLE `provincia`
  MODIFY `idProvincia` int(3) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=53;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `alumno`
--
ALTER TABLE `alumno`
  ADD CONSTRAINT `alumno_ibfk_1` FOREIGN KEY (`idProvincia`) REFERENCES `provincia` (`idProvincia`) ON UPDATE CASCADE,
  ADD CONSTRAINT `alumno_ibfk_2` FOREIGN KEY (`idEstudios`) REFERENCES `nivelestudios` (`idEstudios`) ON UPDATE CASCADE,
  ADD CONSTRAINT `alumno_ibfk_3` FOREIGN KEY (`idFamiliar`) REFERENCES `familiar` (`idFamiliar`) ON UPDATE CASCADE;

--
-- Filtros para la tabla `familiar`
--
ALTER TABLE `familiar`
  ADD CONSTRAINT `familiar_ibfk_1` FOREIGN KEY (`idRelacion`) REFERENCES `parentesco` (`idRelacion`) ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
