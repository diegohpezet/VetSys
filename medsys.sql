-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 27-04-2022 a las 18:29:30
-- Versión del servidor: 10.4.11-MariaDB
-- Versión de PHP: 7.4.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `medsys`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `especialidades`
--

CREATE TABLE `especialidades` (
  `especialidad` varchar(200) COLLATE utf8_spanish_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `especialidades`
--

INSERT INTO `especialidades` (`especialidad`) VALUES
('Control'),
('Radiografia'),
('Castración'),
('Cirugía');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `mascotas`
--

CREATE TABLE `mascotas` (
  `id_mascota` int(4) NOT NULL,
  `nombre` varchar(200) COLLATE utf8_spanish_ci NOT NULL,
  `especie` varchar(200) COLLATE utf8_spanish_ci NOT NULL,
  `sexo` varchar(10) COLLATE utf8_spanish_ci NOT NULL,
  `raza` varchar(200) COLLATE utf8_spanish_ci DEFAULT NULL,
  `peso` float DEFAULT NULL,
  `etapa` varchar(200) COLLATE utf8_spanish_ci DEFAULT NULL,
  `id_dueño` int(8) DEFAULT NULL,
  `ultima_visita` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `mascotas`
--

INSERT INTO `mascotas` (`id_mascota`, `nombre`, `especie`, `sexo`, `raza`, `peso`, `etapa`, `id_dueño`, `ultima_visita`) VALUES
(1, 'Yacko', 'Perro', 'Macho', NULL, NULL, NULL, 45031729, NULL),
(2, 'Fabri', 'Gato', 'Macho', NULL, NULL, NULL, 45297893, NULL),
(3, 'Gato', 'Gato', 'Macho', NULL, NULL, NULL, 45031729, NULL),
(4, 'Test', 'Perro', 'Macho', NULL, NULL, NULL, 45031729, NULL);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `turnos`
--

CREATE TABLE `turnos` (
  `nro_Turno` int(4) NOT NULL,
  `dni_cliente` int(8) NOT NULL,
  `asunto` varchar(200) COLLATE utf8_spanish_ci NOT NULL,
  `mascota` varchar(200) COLLATE utf8_spanish_ci NOT NULL,
  `fecha` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `turnos`
--

INSERT INTO `turnos` (`nro_Turno`, `dni_cliente`, `asunto`, `mascota`, `fecha`) VALUES
(1, 45031729, 'Radiografía', 'Yacko', '2022-04-12'),
(3, 45031729, 'Castración', 'Gato', '2022-04-22'),
(6, 45031729, 'Radiografia', 'Gato', '2022-04-29');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `user`
--

CREATE TABLE `user` (
  `dni` int(8) NOT NULL,
  `email` varchar(45) COLLATE utf8_spanish_ci NOT NULL,
  `pass` varchar(20) COLLATE utf8_spanish_ci NOT NULL,
  `nombre` varchar(40) COLLATE utf8_spanish_ci NOT NULL,
  `apellido` varchar(40) COLLATE utf8_spanish_ci NOT NULL,
  `telefono` int(10) NOT NULL,
  `status` int(1) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `user`
--

INSERT INTO `user` (`dni`, `email`, `pass`, `nombre`, `apellido`, `telefono`, `status`) VALUES
(12345678, 'patri@gmail.com', '202cb962ac59075b964b', 'Patricia', 'Placzek', 1234567890, 1),
(27192677, 'placzekgaby@gmail.com', '202cb962ac59075b964b', 'Gabriela', 'Placzek', 1112121212, 0),
(45031729, 'diegoxd@gmail.com', '202cb962ac59075b964b', 'Diego', 'Pezet', 12345678, 0),
(45297893, 'brisa@gmail.com', '202cb962ac59075b964b', 'Brisa', 'de la Cerda', 12345678, 0);

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `mascotas`
--
ALTER TABLE `mascotas`
  ADD PRIMARY KEY (`id_mascota`);

--
-- Indices de la tabla `turnos`
--
ALTER TABLE `turnos`
  ADD PRIMARY KEY (`nro_Turno`);

--
-- Indices de la tabla `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`dni`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `mascotas`
--
ALTER TABLE `mascotas`
  MODIFY `id_mascota` int(4) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT de la tabla `turnos`
--
ALTER TABLE `turnos`
  MODIFY `nro_Turno` int(4) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
