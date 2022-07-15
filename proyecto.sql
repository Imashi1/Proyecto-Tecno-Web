-- phpMyAdmin SQL Dump
-- version 5.3.0-dev+20220624.1c2b611173
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 15-07-2022 a las 15:48:31
-- Versión del servidor: 10.4.24-MariaDB
-- Versión de PHP: 8.1.5

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
(1, 'admin', 'admin', 'admin@admin.cl', 'admin', '2022-06-29'),
(2, 'admin2', '2', 'admin2@admin.cl', 'admin2', '2022-07-15');

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
(25, 'Completo', 'Completo palta tomate vienesa', '1657885524_Completo.png', 1000, 13),
(26, 'Churrasco', 'Churrazco tomate', '1657885599_Churrasco .png', 2000, 13),
(27, 'Chorrillana', 'Papas vienesa', '1657885655_Chorrillana.png', 2500, 13),
(28, 'Empanada', 'Empanada  pino carne cebolla', '1657885708_Empanadas.png', 1000, 13),
(29, 'Chocolate Latte', 'Rica bedida caliente de chocolate con leche y café espumoso', '1657885764_Chocolate Latte.png', 2000, 14),
(30, 'Muffins', 'Muffins esponjosos de vainilla', '1657885779_Muffins .png', 1000, 14),
(31, 'Tarta de Durazno', 'Trozo individual de tarta ', '1657885827_Pie de durazno.png', 2500, 14),
(32, 'Churrasco papa', 'Churrazco papa palta tomate', '1657885958_Churrasco con papas.png', 2300, 15),
(33, 'Carne con Arroz', 'Carne asada con arroz blanco', '1657886021_Carne con arroz.png', 2500, 17),
(34, 'Leche asada', 'Postre individual de leche asada', '1657886097_Leche asada .png', 1000, 17);

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
(13, 'Tienda 1', 'Hamburguesas, Completos y mas.', '1657852086_Foto Local Roly.png', -18.488305924205704, -70.2948761605402, 1),
(14, 'Tienda 2', 'Cafe, tortas y mas', 'notfound.jpg', -18.491124856869092, -70.29594584755576, 1),
(15, 'Tienda 3', 'Sandwiches, papas y mas.', '1657852667_Foto local.png', -18.489088725876883, -70.29607481691212, 1),
(17, 'Tienda 4', 'Almuerzo y colaciones', 'notfound.jpg', -18.491445743195897, -70.29609909358852, 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuarioplato`
--

CREATE TABLE `usuarioplato` (
  `idUser` int(11) NOT NULL,
  `idPlato` int(11) NOT NULL,
  `repPlato` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

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
(2, 'user', 'user2', 'user@user.cl', 'user', '2022-06-29'),
(8, 'user3', 'user3', 'user3@user.cl', 'user', '2022-07-15');

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
(2, 13, 1),
(2, 13, 2),
(2, 13, 3),
(2, 13, 4),
(2, 13, 5),
(2, 13, 6),
(2, 13, 7),
(2, 13, 8),
(2, 13, 9),
(2, 13, 10),
(2, 14, 1),
(2, 14, 2),
(2, 14, 3),
(2, 14, 4),
(2, 14, 5),
(2, 14, 6),
(2, 14, 7),
(2, 15, 1),
(2, 15, 2),
(2, 15, 3),
(2, 17, 1);

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
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de la tabla `platos`
--
ALTER TABLE `platos`
  MODIFY `idPlato` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=35;

--
-- AUTO_INCREMENT de la tabla `ubicaciones`
--
ALTER TABLE `ubicaciones`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

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



