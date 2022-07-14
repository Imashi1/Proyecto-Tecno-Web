-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 14-07-2022 a las 21:44:57
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
(20, 'Plato 9', 'Buen plato para comer en familia', '1657779652_thumbs-up-192.jpg', 3000, 8);

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
(8, 'Tienda Prueba 8', 'Sin imagen', 'notfound.jpg', -18.489204822382675, -70.2957781529698, 1),
(11, 'Tienda Prueba 11', 'no hay', '1657256923_unknown.png', -18.490740608780655, -70.29701673470065, 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuarioplato`
--

CREATE TABLE `usuarioplato` (
  `idUser` int(11) NOT NULL,
  `idPlato` int(11) NOT NULL,
  `repPlato` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `usuarioplato`
--

INSERT INTO `usuarioplato` (`idUser`, `idPlato`, `repPlato`) VALUES
(2, 20, 1);

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
(2, 'user', 'user', 'user@user.cl', 'user', '2022-06-29'),
(5, 'usuario', 'usuario', 'usuario@usuario.cl', 'prueba', '2022-07-08'),
(6, 'fabian', 'bugueno', 'fabian@bugueno.cl', 'fabian', '2022-07-14');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuarioubicacion`
--

CREATE TABLE `usuarioubicacion` (
  `idUser` int(11) NOT NULL,
  `idUbicacion` int(11) NOT NULL,
  `repUbicacion` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `usuarioubicacion`
--

INSERT INTO `usuarioubicacion` (`idUser`, `idUbicacion`, `repUbicacion`) VALUES
(2, 8, 1);

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
  ADD KEY `fk_ubicacion` (`idUbicaciones`) USING BTREE;

--
-- Indices de la tabla `ubicaciones`
--
ALTER TABLE `ubicaciones`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_admin` (`id_administradores`);

--
-- Indices de la tabla `usuarioplato`
--
ALTER TABLE `usuarioplato`
  ADD PRIMARY KEY (`idUser`,`idPlato`,`repPlato`),
  ADD KEY `idUser` (`idUser`,`idPlato`) USING BTREE,
  ADD KEY `fk_plato` (`idPlato`);

--
-- Indices de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `usuarioubicacion`
--
ALTER TABLE `usuarioubicacion`
  ADD PRIMARY KEY (`idUser`,`idUbicacion`,`repUbicacion`),
  ADD KEY `idUser` (`idUser`,`idUbicacion`),
  ADD KEY `fk_ubicación` (`idUbicacion`);

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
  MODIFY `idPlato` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT de la tabla `ubicaciones`
--
ALTER TABLE `ubicaciones`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `platos`
--
ALTER TABLE `platos`
  ADD CONSTRAINT `fk_ubicacion` FOREIGN KEY (`idUbicaciones`) REFERENCES `ubicaciones` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `ubicaciones`
--
ALTER TABLE `ubicaciones`
  ADD CONSTRAINT `fk_admin` FOREIGN KEY (`id_administradores`) REFERENCES `administradores` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `usuarioplato`
--
ALTER TABLE `usuarioplato`
  ADD CONSTRAINT `fk_plato` FOREIGN KEY (`idPlato`) REFERENCES `platos` (`idPlato`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_user` FOREIGN KEY (`idUser`) REFERENCES `usuarios` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `usuarioubicacion`
--
ALTER TABLE `usuarioubicacion`
  ADD CONSTRAINT `fk_ubicación` FOREIGN KEY (`idUbicacion`) REFERENCES `ubicaciones` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_user_ubicacion` FOREIGN KEY (`idUser`) REFERENCES `usuarios` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
