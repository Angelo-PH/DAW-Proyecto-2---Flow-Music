-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 29-04-2024 a las 10:30:49
-- Versión del servidor: 10.4.28-MariaDB
-- Versión de PHP: 8.1.17

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `flowmusic_bd`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `album`
--

CREATE TABLE `album` (
  `album_id` int(11) NOT NULL,
  `album_nom` varchar(255) NOT NULL,
  `año_lanzamiento` int(11) NOT NULL,
  `id_autor` int(11) NOT NULL,
  `id_genero` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `artista`
--

CREATE TABLE `artista` (
  `artista_id` int(11) NOT NULL,
  `artista_nombre` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `cancion`
--

CREATE TABLE `cancion` (
  `cancion_id` int(11) NOT NULL,
  `cancion_nombre` varchar(255) NOT NULL,
  `src` varchar(255) NOT NULL,
  `id_album` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `genero`
--

CREATE TABLE `genero` (
  `genero_id` int(11) NOT NULL,
  `genero_nom` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `lista_reproduccion`
--

CREATE TABLE `lista_reproduccion` (
  `lista_id` int(11) NOT NULL,
  `lista_nombre` varchar(255) NOT NULL,
  `usuario_id` int(11) NOT NULL,
  `fecha_creacion` date NOT NULL,
  `visibilidad` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuario`
--

CREATE TABLE `usuario` (
  `usuario_id` int(11) NOT NULL,
  `usuario_nombre` varchar(255) NOT NULL,
  `contrasena` varchar(255) NOT NULL,
  `fecha_registro` varchar(10) DEFAULT NULL,
  `suscripcion` varchar(255) DEFAULT NULL,
  `correo_electronico` varchar(255) DEFAULT NULL,
  `titular_tarjeta_nom` varchar(255) NOT NULL,
  `tarjeta_num` varchar(255) NOT NULL,
  `fecha_caducidad` varchar(255) NOT NULL,
  `cvv` int(3) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `usuario`
--

INSERT INTO `usuario` (`usuario_id`, `usuario_nombre`, `contrasena`, `fecha_registro`, `suscripcion`, `correo_electronico`, `titular_tarjeta_nom`, `tarjeta_num`, `fecha_caducidad`, `cvv`) VALUES
(3, 'asdasdas', '$2y$10$GQHoJ2uZ/vSM8kY5SCzVkOIePSgVIVtDY8c8D.O8pSbkueaZCEQC2', NULL, NULL, 'asdadas@gmail.com', '', '0', '', 0),
(4, 'fff', '$2y$10$sUcf3bzxF/EOj3qRm1qXdO9Vvcc4w4lLZVr4sVTA2ju32GICeunw6', NULL, NULL, 'fff@g.n', '', '0', '', 0),
(5, 'xcv', '$2y$10$3GMqvyB1fX1xBL9Rood84.Ujnhx6XlpcTJyCEQi7Pn54AspJUlglq', NULL, NULL, 'xcv@f.f', '', '0', '', 0),
(6, 'hola', '$2y$10$oU6cSoha67NsC2QSlAQ8ru2UG/6wNQTBbR/VSx9tC1/LqcoLzjWkm', NULL, NULL, 'hola@hola.php', '', '0', '', 0),
(7, 'xcv', '$2y$10$MuMSX4qsQTghpBpYGBOJse/ifaaMjl7nvcFqbnA6r/mJNcdneLGIu', NULL, NULL, 'xcv@f.f', '', '0', '', 0),
(8, 'adam iglesias', '$2y$10$HI3ijUgrE2EoAHvr7GXnAOx0nBPVeT1EeSMxARfgfaUUV8eL488VC', NULL, NULL, 'aiglesias@gmail.com', '', '0', '', 0),
(9, 'angelo', '$2y$10$hJ.FaFDVjtaKt9WsMflHvuRJ.1CY8TM1puyjbzivdZpjUPeWgOjJe', NULL, NULL, 'angelo@gmail.com', '', '0', '', 0),
(10, 'angelo ponte', '$2y$10$eMgSI/IAVeiCQbL1J0J2UOkKoxIagNGpHfYRCct5RUqbqRJhCppc2', NULL, NULL, 'angeloponte@gmail.com', '', '0', '', 0),
(11, 'Registro Ejemplo', '$2y$10$PiGMO8R/Q2pvL0sxlm5q2ebNbeyiTe.Ul9Z7slDjX0a0Y0ttUWMlu', NULL, NULL, 'registroejemplo@gmail.com', '', '0', '', 0),
(12, 'Registro Ejemplo2 ', '$2y$10$E4fRS.BiPV70ORxsRLo9Veuza3UKsX25AKRfrP9Il887yct.TYqwq', NULL, NULL, 'registroejemplo2@gmail.com', '', '0', '', 0),
(13, '', '$2y$10$LbUchX/ykjhmVumB8QbHa.hhtkT9EtuVPhXOvPyZAfQSHvTk96xKK', NULL, NULL, '', '', '0', '', 0),
(14, '', '$2y$10$Mn5J8V12aeeVjNiewVimdOrXXOjqCWY9we6D2Iyy40FnYk6PXbGJO', NULL, NULL, '', '', '0', '', 0),
(15, '', '$2y$10$i4lBhqSrG1aiCToT1.lohe3BKaMuDSPoySEDB010ygTlO0PtZlAHO', NULL, NULL, '', '', '0', '', 0),
(16, 'prueba1', '$2y$10$fMgpdEPGSa6B.28PDmng3u92WTLir8mylioIa60Nj2YrXZd6cnaAG', NULL, NULL, 'prueba1@gmail.com', '', '0', '', 0),
(17, 'xpalau', '$2y$10$DU5x9rKWCp87WJCJKfaVquenKcyJbpmd/ebaQzJaZKtMb1XDggTdy', NULL, 'mensual', 'xpalau@gmail.com', 'Angelo Ponte Hinostroza', '123123123', '123', 123),
(19, 'usuario prueba', '$2y$10$PDtxpjEK5ALAaJ1kuh4J3eS/gS.UYNJfr30FrnRI2nn25JX/71axS', NULL, 'mensual', 'uprueba@gmail.com', '', '0', '', 0);

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `album`
--
ALTER TABLE `album`
  ADD PRIMARY KEY (`album_id`),
  ADD KEY `album_id` (`album_id`),
  ADD KEY `id_autor` (`id_autor`),
  ADD KEY `id_genero` (`id_genero`);

--
-- Indices de la tabla `artista`
--
ALTER TABLE `artista`
  ADD PRIMARY KEY (`artista_id`);

--
-- Indices de la tabla `cancion`
--
ALTER TABLE `cancion`
  ADD PRIMARY KEY (`cancion_id`),
  ADD KEY `album_id` (`id_album`);

--
-- Indices de la tabla `genero`
--
ALTER TABLE `genero`
  ADD PRIMARY KEY (`genero_id`);

--
-- Indices de la tabla `lista_reproduccion`
--
ALTER TABLE `lista_reproduccion`
  ADD PRIMARY KEY (`lista_id`),
  ADD KEY `usuario_id` (`usuario_id`);

--
-- Indices de la tabla `usuario`
--
ALTER TABLE `usuario`
  ADD PRIMARY KEY (`usuario_id`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `album`
--
ALTER TABLE `album`
  MODIFY `album_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `artista`
--
ALTER TABLE `artista`
  MODIFY `artista_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `genero`
--
ALTER TABLE `genero`
  MODIFY `genero_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `lista_reproduccion`
--
ALTER TABLE `lista_reproduccion`
  MODIFY `lista_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `usuario`
--
ALTER TABLE `usuario`
  MODIFY `usuario_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `album`
--
ALTER TABLE `album`
  ADD CONSTRAINT `album_ibfk_1` FOREIGN KEY (`id_autor`) REFERENCES `artista` (`artista_id`) ON UPDATE CASCADE;

--
-- Filtros para la tabla `cancion`
--
ALTER TABLE `cancion`
  ADD CONSTRAINT `cancion_ibfk_1` FOREIGN KEY (`id_album`) REFERENCES `album` (`album_id`) ON UPDATE CASCADE;

--
-- Filtros para la tabla `genero`
--
ALTER TABLE `genero`
  ADD CONSTRAINT `genero_ibfk_1` FOREIGN KEY (`genero_id`) REFERENCES `album` (`id_genero`) ON UPDATE CASCADE;

--
-- Filtros para la tabla `lista_reproduccion`
--
ALTER TABLE `lista_reproduccion`
  ADD CONSTRAINT `lista_reproduccion_ibfk_1` FOREIGN KEY (`usuario_id`) REFERENCES `usuario` (`usuario_id`) ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
