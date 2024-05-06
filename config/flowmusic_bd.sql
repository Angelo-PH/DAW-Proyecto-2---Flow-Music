-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 06-05-2024 a las 13:06:28
-- Versión del servidor: 10.4.28-MariaDB
-- Versión de PHP: 8.1.17

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

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
  `artista_autor` varchar(255) NOT NULL,
  `file` varchar(255) NOT NULL,
  `cover` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `cancion`
--

INSERT INTO `cancion` (`cancion_id`, `cancion_nombre`, `artista_autor`, `file`, `cover`) VALUES
(1, 'El sonido de campanas', 'Oscar Lee', '../assets/media/audio/Oscar Lee - EL SONIDO DE CAMPANAS.mp3', '../assets/media/img/elSonidoDeCampanas.jpg'),
(2, 'A 300', 'JC Reyes', '../assets/media/audio/Mp3juice.blog JC REYES - A 300.mp3', '../assets/media/img/A300.jpg'),
(3, 'Me prefieres a mí', 'Arcangel', '../assets/media/audio/Arcangel - Me Prefieres a Mi [Official Video].mp3', '../assets/media/img/mePrefieresAMi.jpg'),
(4, 'Entramos Disparando', 'Ñengo Flow', '../assets/media/audio/Ñengo Flow - Entramos Disparando [Official Audio].mp3', '../assets/media/img/entramosDisparando.jpg'),
(5, 'Y si la ves', 'Ñejo', '../assets/media/audio/ÑEJO - Y SI LA VES.mp3', '../assets/media/img/ySiLaVes.jpg'),
(6, 'Or Nah', 'Anuel AA', '../assets/media/audio/Or Nah.mp3', '../assets/media/img/orNah.jpg'),
(7, 'Escápate conmigo Remix', 'Wolfine', '../assets/media/audio/Escápate Conmigo (Remix).mp3', '../assets/media/img/escapateConmigoRemix.jpg'),
(8, 'A escondidas', '$kyhook', '../assets/media/audio/$kyhook - A Escondidas (Audio) ft. Morad.mp3', '../assets/media/img/aEscondidas.jpg'),
(9, '34 Amor y mafia', 'JC Reyes', '../assets/media/audio/34 AMOR Y MAFIA REMIX FT ECKO, PABLO CHILL-E, EL JINCHO & HARRY NACH [ VIDEOCLIP OFICIAL ] LGL 2.0.mp3', '../assets/media/img/amorYMafia.jpg'),
(10, 'Asalto', 'Almighty', '../assets/media/audio/Almighty - Asalto (Official Music Video).mp3', '../assets/media/img/asalto.jpg'),
(11, 'Flow 2000 Remix', 'Bad Gyal', '../assets/media/audio/Bad Gyal, Beny Jr - Flow 2000 (Remix) (Official Video).mp3', '../assets/media/img/flow2000.jpg'),
(12, 'Fardos', 'JC Reyes', '../assets/media/audio/JC REYES FT DE LA GHETTO - FARDOS.mp3', '../assets/media/img/fardos.jpg'),
(13, 'La paso cabrón', 'Noriel', '../assets/media/audio/La Paso Cabrón (Cover Audio).mp3', '../assets/media/img/laPasoCabron.jpg'),
(14, 'Las Bratz (REMIX)', 'JC Reyes', '../assets/media/audio/LAS BRATZ (remix) - Aissa, Saiko, JC Reyes ft El bobe, Juseph, Nickzzy.mp3', '../assets/media/img/lasBratz.jpg'),
(15, 'DM', 'Cosculluela', '../assets/media/audio/Mueka, Cosculluela - DM (Video Oficial).mp3', '../assets/media/img/DM.jpg');

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
  `fecha_creacion` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `payment_info`
--

CREATE TABLE `payment_info` (
  `payment_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `cardholder_name` varchar(255) NOT NULL,
  `card_number` varchar(16) NOT NULL,
  `expiry_month` int(11) NOT NULL,
  `expiry_year` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `payment_info`
--

INSERT INTO `payment_info` (`payment_id`, `user_id`, `cardholder_name`, `card_number`, `expiry_month`, `expiry_year`, `created_at`) VALUES
(2, 1, 'Angelo Ponte', '555555555555', 12, 0, '2024-04-30 11:28:24');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `subscription`
--

CREATE TABLE `subscription` (
  `subscription_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `subscription_type` enum('none','mensual','trimestral','semestral','anual') NOT NULL,
  `start_date` varchar(255) DEFAULT NULL,
  `end_date` varchar(255) DEFAULT NULL,
  `status` enum('activo','inactivo','pendiente') DEFAULT 'pendiente'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `subscription`
--

INSERT INTO `subscription` (`subscription_id`, `user_id`, `subscription_type`, `start_date`, `end_date`, `status`) VALUES
(1, 1, 'mensual', '2024-04-29', '2024-05-29', 'activo'),
(2, 23, 'mensual', '2024-04-29', '2024-05-29', 'activo'),
(3, 24, 'mensual', '2024-04-29', '2024-05-29', 'inactivo');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuario`
--

CREATE TABLE `usuario` (
  `usuario_id` int(11) NOT NULL,
  `usuario_nombre` varchar(255) NOT NULL,
  `contrasena` varchar(255) NOT NULL,
  `fecha_registro` varchar(10) DEFAULT NULL,
  `correo_electronico` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `usuario`
--

INSERT INTO `usuario` (`usuario_id`, `usuario_nombre`, `contrasena`, `fecha_registro`, `correo_electronico`) VALUES
(1, 'EjemploUsuario', 'micontrasena123', '2024-04-29', 'ejemplo@correo.com'),
(23, 'usuario creado', '123456', '29-04-2024', 'ucreado@gmail.com'),
(24, 'Adam Iglesias', '123456', '2024-04-29', 'aiglesias@gmail.com'),
(25, 'User Created', '123456', '2024-04-30', 'ucreated@gmail.com');

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
  ADD PRIMARY KEY (`cancion_id`);

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
-- Indices de la tabla `payment_info`
--
ALTER TABLE `payment_info`
  ADD PRIMARY KEY (`payment_id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indices de la tabla `subscription`
--
ALTER TABLE `subscription`
  ADD PRIMARY KEY (`subscription_id`),
  ADD KEY `user_id` (`user_id`);

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
-- AUTO_INCREMENT de la tabla `payment_info`
--
ALTER TABLE `payment_info`
  MODIFY `payment_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de la tabla `subscription`
--
ALTER TABLE `subscription`
  MODIFY `subscription_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT de la tabla `usuario`
--
ALTER TABLE `usuario`
  MODIFY `usuario_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `album`
--
ALTER TABLE `album`
  ADD CONSTRAINT `album_ibfk_1` FOREIGN KEY (`id_autor`) REFERENCES `artista` (`artista_id`) ON UPDATE CASCADE;

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

--
-- Filtros para la tabla `payment_info`
--
ALTER TABLE `payment_info`
  ADD CONSTRAINT `payment_info_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `usuario` (`usuario_id`);

--
-- Filtros para la tabla `subscription`
--
ALTER TABLE `subscription`
  ADD CONSTRAINT `subscription_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `usuario` (`usuario_id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
