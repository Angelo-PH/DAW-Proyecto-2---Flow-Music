-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 07-05-2024 a las 13:53:49
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
-- Estructura de tabla para la tabla `cancion_lista`
--

CREATE TABLE `cancion_lista` (
  `cancion_id` int(11) NOT NULL,
  `lista_id` int(11) NOT NULL
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
  `fecha_creacion` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `lista_reproduccion`
--

INSERT INTO `lista_reproduccion` (`lista_id`, `lista_nombre`, `usuario_id`, `fecha_creacion`) VALUES
(1, 'hgfghgfh', 24, '2024-05-07'),
(2, 'pop', 24, '2024-05-07'),
(3, 'pop', 24, '2024-05-07'),
(4, 'pop', 24, '2024-05-07'),
(5, 'pop', 24, '2024-05-07'),
(6, 'pop1', 24, '2024-05-07'),
(7, 'pop1', 24, '2024-05-07'),
(8, 'mjh', 24, '2024-05-07'),
(9, 'hhh', 24, '2024-05-07'),
(10, 'hhh', 24, '2024-05-07'),
(11, 'hhh', 24, '2024-05-07'),
(12, 'regeton', 24, '2024-05-07'),
(13, 'fgfgfg', 24, '2024-05-07'),
(14, 'angelo', 24, '2024-05-07'),
(15, 'nbnvb', 24, '2024-05-07'),
(16, 'fgdfg', 24, '2024-05-07'),
(17, '', 24, '2024-05-07'),
(18, '', 24, '2024-05-07'),
(19, 'fgfgdfg', 24, '2024-05-07'),
(20, 'dfdfdf', 24, '2024-05-07'),
(21, 'fgfgfg', 24, '2024-05-07'),
(22, 'adam', 24, '2024-05-07'),
(23, 'hfghfghfg', 24, '2024-05-07'),
(24, 'fgfgfg', 24, '2024-05-07'),
(25, 'fdsfdfg', 24, '2024-05-07'),
(26, 'gfgfg', 24, '2024-05-07'),
(27, 'fgfgf', 24, '2024-05-07'),
(28, 'fgfgfg', 24, '2024-05-07'),
(29, 'fgfgf', 24, '2024-05-07'),
(30, 'fgfdgfd', 24, '2024-05-07'),
(31, 'fgdfgfd', 24, '2024-05-07'),
(32, 'fgdfg', 24, '2024-05-07'),
(33, 'gdfg', 24, '2024-05-07'),
(34, 'fvdsfgfdg', 24, '2024-05-07'),
(35, 'fsdfdsf', 24, '2024-05-07'),
(36, 'dfsdf', 24, '2024-05-07'),
(37, 'sdfsdfds', 24, '2024-05-07'),
(38, 'cvcxvcv', 24, '2024-05-07'),
(39, 'cvcxvcv', 24, '2024-05-07'),
(40, 'fgdfg', 24, '2024-05-07'),
(41, 'dfgdfg', 24, '2024-05-07'),
(42, 'dfdfsgfdg', 24, '2024-05-07'),
(43, 'fgdfgdfg', 24, '2024-05-07'),
(44, 'fgdghfd', 24, '2024-05-07'),
(45, 'jklljkl', 24, '2024-05-07'),
(46, 'asdasd', 24, '2024-05-07'),
(47, 'fsdfds', 24, '2024-05-07'),
(48, 'poop', 24, '2024-05-07'),
(49, 'pop', 24, '2024-05-07'),
(50, 'hola', 24, '2024-05-07'),
(51, 'hola', 24, '2024-05-07'),
(52, 'hola2', 24, '2024-05-07'),
(53, 'hola2', 24, '2024-05-07'),
(54, 'hola2', 24, '2024-05-07'),
(55, 'dfsdfds', 24, '2024-05-07');

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
-- Indices de la tabla `cancion_lista`
--
ALTER TABLE `cancion_lista`
  ADD PRIMARY KEY (`cancion_id`,`lista_id`),
  ADD KEY `lista_id` (`lista_id`);

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
  MODIFY `lista_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=56;

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
-- Filtros para la tabla `cancion_lista`
--
ALTER TABLE `cancion_lista`
  ADD CONSTRAINT `cancion_lista_ibfk_1` FOREIGN KEY (`cancion_id`) REFERENCES `cancion` (`cancion_id`) ON DELETE CASCADE,
  ADD CONSTRAINT `cancion_lista_ibfk_2` FOREIGN KEY (`lista_id`) REFERENCES `lista_reproduccion` (`lista_id`) ON DELETE CASCADE;

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
