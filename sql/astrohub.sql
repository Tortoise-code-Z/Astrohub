-- Crear la base de datos si no existe
CREATE DATABASE IF NOT EXISTS `astrohub` CHARACTER SET utf8mb4 COLLATE utf8mb4_spanish_ci;

-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 21-10-2024 a las 15:49:38
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
-- Base de datos: `astrohub`
--
USE `astrohub`;
-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `citas`
--

CREATE TABLE `citas` (
  `idCita` int(11) NOT NULL,
  `idUser` int(11) NOT NULL,
  `fecha_cita` date NOT NULL,
  `motivo_cita` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_spanish_ci;

--
-- Volcado de datos para la tabla `citas`
--

INSERT INTO `citas` (`idCita`, `idUser`, `fecha_cita`, `motivo_cita`) VALUES
(4, 5, '2024-11-07', 'Debate'),
(5, 10, '2024-12-22', 'Error en noticia'),
(6, 2, '2024-10-07', 'Investigación'),
(7, 3, '2024-12-02', 'Investigación'),
(8, 9, '2024-11-09', 'Error en noticia'),
(9, 6, '2025-02-09', 'Error en noticia'),
(10, 8, '2025-12-12', 'Investigación'),
(14, 7, '2025-12-12', 'Debate'),
(15, 4, '2025-12-11', 'Hola mundo');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `noticias`
--

CREATE TABLE `noticias` (
  `idNoticia` int(11) NOT NULL,
  `titulo` varchar(255) NOT NULL,
  `imagen` text NOT NULL,
  `texto` longtext NOT NULL,
  `fecha` date NOT NULL,
  `idUser` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_spanish_ci;

--
-- Volcado de datos para la tabla `noticias`
--

INSERT INTO `noticias` (`idNoticia`, `titulo`, `imagen`, `texto`, `fecha`, `idUser`) VALUES
(1, 'Científicos descubren un nuevo agujero negro cercano a la Tierra', 'imagen1.jpg', 'Astrónomos detectan un agujero negro a 1,500 años luz, el más cercano jamás observado desde nuestro planeta.', '2024-10-07', 7),
(2, 'Nuevas imágenes revelan detalles sorprendentes de Saturno', 'imagen2.jpg', 'Las últimas imágenes de la sonda espacial Cassini muestran nuevas características en los anillos de Saturno y su atmósfera dinámica.', '2024-10-04', 7),
(3, 'Descubren un exoplaneta potencialmente habitable', 'imagen3.jpg', 'Un nuevo exoplaneta en la zona habitable de su estrella podría tener condiciones adecuadas para la vida, según un reciente estudio.', '2024-10-08', 8),
(4, 'Marte revela nuevos secretos en su superficie', 'imagen4.jpg', 'La última misión del rover Perseverance ha descubierto indicios de agua antigua en Marte, lo que podría cambiar nuestra comprensión del planeta.', '2024-10-02', 8),
(5, 'Nuevos hallazgos sobre la luna Europa de Júpiter', 'imagen5.jpg', 'Científicos detectan signos de actividad geológica en Europa, sugiriendo que su océano subterráneo podría albergar vida.', '2024-10-09', 4),
(6, 'Descubren un nuevo planeta helado en los límites del sistema solar', 'imagen6.jpg', 'Un planeta helado desconocido ha sido detectado más allá de Neptuno, lo que podría cambiar nuestra comprensión de los cuerpos celestes lejanos.', '2024-10-09', 5),
(7, 'Científicos estudian la formación de estrellas en la nebulosa de Orión', 'imagen7.jpg', 'Nuevas observaciones en la nebulosa de Orión revelan cómo se forman estrellas y sistemas planetarios en esta región rica en gas y polvo.', '2024-09-29', 10),
(8, 'Astrónomos descubren una supernova brillante en una galaxia lejana', 'imagen8.jpg', 'Una nueva supernova ha sido observada en una galaxia distante, proporcionando información valiosa sobre la muerte de las estrellas y la formación de elementos.', '2024-10-04', 2),
(9, 'Revelan la estructura compleja de una galaxia espiral lejana', 'imagen9.jpg', 'Un estudio reciente ha proporcionado nuevas imágenes de una galaxia espiral, mostrando brazos de estrellas y áreas de formación estelar activas.', '2024-10-06', 3),
(10, 'Astrónomos descubren una estrella con un inusual patrón de brillo', 'imagen10.jpg', 'Una estrella recién descubierta presenta fluctuaciones en su brillo que desafían las teorías existentes sobre la evolución estelar y su estructura interna.', '2024-09-25', 9),
(11, 'Descubren un planeta habitable similar a la Tierra en otra galaxia', 'imagen11.jpg', 'Científicos han encontrado un exoplaneta en la zona habitable de su estrella, con condiciones que podrían permitir la existencia de agua líquida y vida.', '2024-10-07', 9),
(12, 'Nuevo laboratorio espacial abrirá oportunidades para la investigación', 'imagen12.jpg', 'La NASA inaugurará un laboratorio en la Estación Espacial Internacional para realizar experimentos sobre la vida y la física en condiciones de microgravedad.', '2024-10-09', 6);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `users_data`
--

CREATE TABLE `users_data` (
  `idUser` int(11) NOT NULL,
  `nombre` varchar(100) NOT NULL,
  `apellidos` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `telefono` varchar(15) NOT NULL,
  `fecha_nacimiento` date NOT NULL,
  `direccion` text DEFAULT NULL,
  `sexo` enum('Masculino','Femenino','Sin definir') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_spanish_ci;

--
-- Volcado de datos para la tabla `users_data`
--

INSERT INTO `users_data` (`idUser`, `nombre`, `apellidos`, `email`, `telefono`, `fecha_nacimiento`, `direccion`, `sexo`) VALUES
(1, 'Root', 'Root', 'root@astrohub.es', '666778899', '1973-12-13', 'Root 18', 'Sin definir'),
(2, 'María', 'León', 'maria@astrohub.es', '666778899', '1999-12-13', '', 'Femenino'),
(3, 'Pepe', 'Pérez', 'pepe@astrohub.es', '666666666', '1989-10-12', '', 'Masculino'),
(4, 'Manolo', 'Murillo', 'manolo@astrohub.es', '666666662', '2001-12-14', '', 'Masculino'),
(5, 'Manuel', 'Mesa', 'manuel@astrohub.es', '666778899', '1997-04-17', 'Calle Inventada 12', 'Masculino'),
(6, 'Sofía', 'Alonso', 'sofia@astrohub.es', '678909876', '1989-10-30', 'Calle Inventada 13', 'Femenino'),
(7, 'Francisco', 'Cabrera', 'francisco@astrohub.es', '765890987', '1988-02-12', 'Calle Inventada 14', 'Masculino'),
(8, 'Lisa', 'Cabrera', 'lisa@astrohub.es', '654127890', '2001-08-23', '', 'Sin definir'),
(9, 'Pepe', 'González', 'pepito@astrohub.es', '678654890', '1967-12-12', 'Calle Inventada 11', 'Masculino'),
(10, 'Mari', 'Smith', 'meri@astrohub.es', '654121212', '1995-12-14', 'Calle Inventada 08', 'Masculino'),
(11, 'Didi', 'Didi', 'didi@astrohub.es', '66666660', '2000-12-12', '', 'Sin definir'),
(13, 'Astrohub', 'Astrohub', 'astrohub@astrohub.es', '1234567', '1996-02-29', '', 'Masculino');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `users_login`
--

CREATE TABLE `users_login` (
  `idLogin` int(11) NOT NULL,
  `idUser` int(11) NOT NULL,
  `usuario` varchar(100) NOT NULL,
  `password` varchar(255) NOT NULL,
  `rol` enum('admin','user') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_spanish_ci;

--
-- Volcado de datos para la tabla `users_login`
--

INSERT INTO `users_login` (`idLogin`, `idUser`, `usuario`, `password`, `rol`) VALUES
(1, 1, 'root', '$2y$10$Xll75Xx2NIGTB.XsUzgM1OAqq0nokt86j6Y6JXA9tgVgm9lKPWtsG', 'admin'),
(2, 2, 'Maria', '$2y$10$wKyUaEN/FjEN9Rg/lieb7ebnjT1oYIGurRDWiEaUzzWLMo7yL/jLK', 'user'),
(3, 3, 'Pepe', '$2y$10$iFPJLUMIHAnhSc2NwLb/Guu0UKOx94pNDw6kgY.sGty6byeBgtemq', 'user'),
(4, 4, 'Manolo', '$2y$10$YemDa6T6AwKzgIADynieEer9BHlZYssQJMEYotdO4shUgEwI3DvBW', 'user'),
(5, 5, 'Manuel', '$2y$10$y0VjBAMpDrBmS5h4yyGpueek7XyoqmLOeWAtmUYPLM1ilfanYlFtu', 'user'),
(6, 6, 'Sofia', '$2y$10$tXUy.cqB/nUAo32KrXnD5eyol5wpOfN7SJiCfUqXnVSmDO02gTqlG', 'user'),
(7, 7, 'Francisco', '$2y$10$T61jnqwzqLF9Etu3KvIMeeIpqSjdKEVbXHTiSRP9TbPBZLiRBTjGi', 'user'),
(8, 8, 'Lisa12', '$2y$10$UGiriXFIFiC8eoweTpxGhegBuqftXqGOQl7uCXcAHszlb1ZA1cvWa', 'user'),
(9, 9, 'Pepito12', '$2y$10$BOc8qcjQwa0bLLNWk5Wrdu0sFc0ha1VTxU6oFqecfraIFjKhmftYG', 'user'),
(10, 10, 'mari_12', '$2y$10$EUMVmg6LZ.gCsimYXLeqIO4W9k2oAQsm3v6a39cRQ50yZFPT1nR0e', 'user'),
(11, 11, 'Didi12', '$2y$10$e4OmAVcH33rmKl5Oh1l5P./j0sOUiPwMmbZjTdtEgXq6Tw3NW75qS', 'user'),
(13, 13, 'astrohub2024', '$2y$10$xDG3RLF4ObSdyyJcTPaB2OFvD21XXHWEm015UR1OuHi5aVLgVJrW2', 'user');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `citas`
--
ALTER TABLE `citas`
  ADD PRIMARY KEY (`idCita`),
  ADD KEY `idUser` (`idUser`);

--
-- Indices de la tabla `noticias`
--
ALTER TABLE `noticias`
  ADD PRIMARY KEY (`idNoticia`),
  ADD UNIQUE KEY `titulo` (`titulo`),
  ADD KEY `idUser` (`idUser`);

--
-- Indices de la tabla `users_data`
--
ALTER TABLE `users_data`
  ADD PRIMARY KEY (`idUser`),
  ADD UNIQUE KEY `email` (`email`);

--
-- Indices de la tabla `users_login`
--
ALTER TABLE `users_login`
  ADD PRIMARY KEY (`idLogin`),
  ADD UNIQUE KEY `idUser` (`idUser`),
  ADD UNIQUE KEY `usuario` (`usuario`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `citas`
--
ALTER TABLE `citas`
  MODIFY `idCita` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT de la tabla `noticias`
--
ALTER TABLE `noticias`
  MODIFY `idNoticia` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT de la tabla `users_data`
--
ALTER TABLE `users_data`
  MODIFY `idUser` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT de la tabla `users_login`
--
ALTER TABLE `users_login`
  MODIFY `idLogin` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `citas`
--
ALTER TABLE `citas`
  ADD CONSTRAINT `citas_ibfk_1` FOREIGN KEY (`idUser`) REFERENCES `users_data` (`idUser`) ON DELETE CASCADE;

--
-- Filtros para la tabla `noticias`
--
ALTER TABLE `noticias`
  ADD CONSTRAINT `noticias_ibfk_1` FOREIGN KEY (`idUser`) REFERENCES `users_data` (`idUser`) ON DELETE CASCADE;

--
-- Filtros para la tabla `users_login`
--
ALTER TABLE `users_login`
  ADD CONSTRAINT `users_login_ibfk_1` FOREIGN KEY (`idUser`) REFERENCES `users_data` (`idUser`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
