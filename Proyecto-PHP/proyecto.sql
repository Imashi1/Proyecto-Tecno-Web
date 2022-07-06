-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 06-07-2022 a las 23:28:14
-- Versión del servidor: 10.4.24-MariaDB
-- Versión de PHP: 8.1.6

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `proyecto`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `administradores`
--

CREATE TABLE `administradores` (
  `id` int(11) NOT NULL,
  `nombre` varchar(50) NOT NULL,
  `apellido` varchar(50) NOT NULL,
  `correo` varchar(100) NOT NULL,
  `contrasena` varchar(100) NOT NULL,
  `fecha_creacion` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `administradores`
--

INSERT INTO `administradores` (`id`, `nombre`, `apellido`, `correo`, `contrasena`, `fecha_creacion`) VALUES
(1, 'admin', 'admin', 'admin@admin.cl', 'admin', '2022-06-29');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `platos`
--

CREATE TABLE `platos` (
  `idPlato` int(11) NOT NULL,
  `nombrePlato` varchar(100) NOT NULL,
  `descripcionPlato` text NOT NULL,
  `imagenPlato` varchar(150) NOT NULL,
  `precioPlato` int(11) NOT NULL,
  `idUbicaciones` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `platos`
--

INSERT INTO `platos` (`idPlato`, `nombrePlato`, `descripcionPlato`, `imagenPlato`, `precioPlato`, `idUbicaciones`) VALUES
(1, 'hola', 'no hay platp', '1657139747_finale.jpg', 2000, 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `prueba`
--

CREATE TABLE `prueba` (
  `idUser` int(11) NOT NULL,
  `idPlato` int(11) NOT NULL,
  `numero1` int(11) NOT NULL,
  `numero12` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `ubicaciones`
--

CREATE TABLE `ubicaciones` (
  `id` int(11) NOT NULL,
  `nombreTienda` varchar(100) NOT NULL,
  `descripcionTienda` text NOT NULL,
  `imagen` varchar(255) NOT NULL,
  `latitud` double NOT NULL,
  `longitud` double NOT NULL,
  `id_administradores` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `ubicaciones`
--

INSERT INTO `ubicaciones` (`id`, `nombreTienda`, `descripcionTienda`, `imagen`, `latitud`, `longitud`, `id_administradores`) VALUES
(1, 'Tienda Prueba', '', '', -18.49029295024546, -70.2967055487439, 1),
(2, 'Tienda Prueba 2', 'Buena Tienda', '', -18.49012347431713, -70.2958859896876, 1),
(3, 'Tienda Prueba 3', 'Buena descripción', '', -18.490398142116888, -70.29654533419158, 1),
(4, 'Tienda Prueba 4', 'HOlaaaaaaaaaaaaaaaaaa', '', -18.489498165131607, -70.2956025331715, 1),
(5, 'Tienda Prueba 5', 'asdfasdfasf', '', -18.490538397844475, -70.29668090035102, 1),
(6, 'Tienda Prueba 6', 'Mala descripción', '', -18.489277279228375, -70.2949894044046, 1),
(7, 'Tienda Prueba 7', 'Ahora con imagen', '1656957833_finale.jpg', -18.490373624745004, -70.295722694086, 1),
(8, 'Tienda Prueba 8', 'Sin imagen', 'notfound.jpg', -18.489204822382675, -70.2957781529698, 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuarios`
--

CREATE TABLE `usuarios` (
  `id` int(11) NOT NULL,
  `nombre` varchar(50) NOT NULL,
  `apellido` varchar(50) NOT NULL,
  `correo` varchar(100) NOT NULL,
  `contrasena` varchar(100) NOT NULL,
  `fecha_creacion` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `usuarios`
--

INSERT INTO `usuarios` (`id`, `nombre`, `apellido`, `correo`, `contrasena`, `fecha_creacion`) VALUES
(2, 'user', 'user', 'user@user.cl', 'user', '2022-06-29');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `administradores`
--
ALTER TABLE `administradores`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `platos`
--
ALTER TABLE `platos`
  ADD PRIMARY KEY (`idPlato`),
  ADD KEY `fk_ubicacion` (`idUbicaciones`);

--
-- Indices de la tabla `ubicaciones`
--
ALTER TABLE `ubicaciones`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_admin` (`id_administradores`);

--
-- Indices de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `administradores`
--
ALTER TABLE `administradores`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de la tabla `platos`
--
ALTER TABLE `platos`
  MODIFY `idPlato` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de la tabla `ubicaciones`
--
ALTER TABLE `ubicaciones`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `platos`
--
ALTER TABLE `platos`
  ADD CONSTRAINT `fk_ubicacion` FOREIGN KEY (`idUbicaciones`) REFERENCES `platos` (`idPlato`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `ubicaciones`
--
ALTER TABLE `ubicaciones`
  ADD CONSTRAINT `fk_admin` FOREIGN KEY (`id_administradores`) REFERENCES `administradores` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
