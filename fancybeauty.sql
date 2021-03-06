-- phpMyAdmin SQL Dump
-- version 4.8.5
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 08-06-2019 a las 09:28:22
-- Versión del servidor: 10.1.40-MariaDB
-- Versión de PHP: 7.3.5

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `fancybeauty`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `carritos`
--

CREATE TABLE `carritos` (
  `id` int(4) UNSIGNED NOT NULL,
  `usuario_id` int(4) UNSIGNED NOT NULL,
  `direccionEnvio` varchar(200) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `carrito_producto`
--

CREATE TABLE `carrito_producto` (
  `ID` int(4) UNSIGNED NOT NULL,
  `producto_id` int(4) UNSIGNED NOT NULL,
  `carrito_id` int(4) UNSIGNED NOT NULL,
  `cantidad` int(2) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `categorias`
--

CREATE TABLE `categorias` (
  `id` int(2) UNSIGNED NOT NULL,
  `nombre` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `categorias`
--

INSERT INTO `categorias` (`id`, `nombre`) VALUES
(1, 'Rostro'),
(2, 'Labios'),
(3, 'Ojos'),
(4, 'Accesorios');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `estados`
--

CREATE TABLE `estados` (
  `id` int(1) UNSIGNED NOT NULL,
  `nombre` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `estados`
--

INSERT INTO `estados` (`id`, `nombre`) VALUES
(1, 'Popular'),
(2, 'Nuevo'),
(3, 'Sin Stock'),
(4, 'Oferta');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `perfiles`
--

CREATE TABLE `perfiles` (
  `id` int(10) NOT NULL,
  `fotoPerfil` varchar(50) NOT NULL DEFAULT 'user-profile-basic.jpg',
  `fechaNacimiento` date DEFAULT NULL,
  `genero` varchar(20) DEFAULT NULL,
  `provincia` varchar(20) DEFAULT NULL,
  `tipoDePiel` varchar(20) DEFAULT NULL,
  `tonoDePiel` varchar(20) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `perfiles`
--

INSERT INTO `perfiles` (`id`, `fotoPerfil`, `fechaNacimiento`, `genero`, `provincia`, `tipoDePiel`, `tonoDePiel`, `created_at`, `updated_at`) VALUES
(1, '1-jessica_lamelli-avatar.png', '1993-12-08', 'Femenino', 'Capital Federal', 'Normal', 'Clara', '2019-06-06 04:29:33', '2019-06-08 03:02:03'),
(2, 'user-profile-basic.jpg', '1993-08-16', 'Femenino', 'Buenos Aires', 'Normal', 'Clara', '2019-06-06 04:37:08', '2019-06-06 23:15:46'),
(3, 'user-profile-basic.jpg', '1980-07-31', 'Masculino', 'Tierra del Fuego', 'Seca', 'Media', '2019-06-06 04:41:20', '2019-06-06 23:16:55'),
(4, 'user-profile-basic.jpg', NULL, NULL, NULL, NULL, NULL, '2019-06-06 23:17:42', '2019-06-06 23:17:42'),
(5, 'user-profile-basic.jpg', NULL, NULL, NULL, NULL, NULL, '2019-06-06 23:54:19', '2019-06-06 23:54:19'),
(6, '6-anto-avatar.', '1995-06-14', 'Femenino', 'Formosa', 'Normal', 'Clara', '2019-06-07 17:15:35', '2019-06-07 20:12:53');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `productos`
--

CREATE TABLE `productos` (
  `id` int(4) UNSIGNED NOT NULL,
  `categoria_id` int(2) UNSIGNED NOT NULL,
  `tipoproducto_id` int(2) UNSIGNED NOT NULL,
  `estado_id` int(1) UNSIGNED NOT NULL,
  `descripcion` varchar(100) DEFAULT NULL,
  `nombre` varchar(100) NOT NULL,
  `precio` decimal(15,2) NOT NULL,
  `rating` decimal(2,1) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `foto` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `productos`
--

INSERT INTO `productos` (`id`, `categoria_id`, `tipoproducto_id`, `estado_id`, `descripcion`, `nombre`, `precio`, `rating`, `created_at`, `updated_at`, `foto`) VALUES
(1, 1, 6, 2, 'Lallalal', 'Rubor Cremoso Rosa', '1300.00', NULL, '2019-06-07 20:49:09', NULL, '81-Rubor Cremoso Rosa.jpg'),
(2, 1, 5, 2, 'Producto de Prueba', 'Polvo Translucido', '1400.00', NULL, '2019-06-07 19:41:35', NULL, '68-Polvo Translucido.jpg'),
(3, 2, 2, 1, 'Prueba Descripcion', 'Gloss Coral', '1100.00', NULL, '2019-06-08 03:28:09', NULL, '73-Gloss Coral.jpg'),
(4, 1, 8, 1, 'Prueba', 'Iluminador Duo', '1300.00', NULL, '2019-06-08 03:30:19', NULL, '87-Iluminador Duo.jpg'),
(5, 2, 3, 1, 'Prueba', 'Labial Matte', '1200.00', NULL, '2019-06-08 03:30:57', NULL, '95-Labial Matte.jpg'),
(6, 3, 7, 1, 'Prueba', 'Paleta de Sombras', '1800.00', NULL, '2019-06-08 03:31:47', NULL, '26-Paleta de Sombras.jpg'),
(7, 1, 4, 1, 'Prueba', 'Base Matte 001', '1900.00', NULL, '2019-06-08 03:32:18', NULL, '35-Base Matte 001.png'),
(8, 4, 1, 2, 'Prueba', 'Brocha 001', '1000.00', NULL, '2019-06-08 03:32:53', NULL, '41-Brocha 001.jpg'),
(9, 2, 3, 2, 'Prueba', 'Labial Matte Azul', '1200.00', NULL, '2019-06-08 03:33:22', NULL, '11-Labial Matte Azul.png'),
(10, 2, 2, 2, 'Prueba', 'Gloss Rosa', '1100.00', NULL, '2019-06-08 03:33:59', NULL, '81-Gloss Rosa.png');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tipoProductos`
--

CREATE TABLE `tipoProductos` (
  `id` int(2) UNSIGNED NOT NULL,
  `nombre` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `tipoProductos`
--

INSERT INTO `tipoProductos` (`id`, `nombre`) VALUES
(1, 'Brocha'),
(2, 'Gloss'),
(3, 'Labial'),
(4, 'Base'),
(5, 'Polvo Translucido'),
(6, 'Rubor'),
(7, 'Sombra'),
(8, 'Iluminador');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuarios`
--

CREATE TABLE `usuarios` (
  `id` int(10) UNSIGNED NOT NULL,
  `nombre` varchar(100) NOT NULL,
  `apellido` varchar(100) NOT NULL,
  `email` varchar(255) NOT NULL,
  `contrasenia` varchar(100) NOT NULL,
  `preguntaSeguridad` varchar(50) NOT NULL,
  `respuestaSeguridad` varchar(100) NOT NULL,
  `perfil_id` int(10) UNSIGNED NOT NULL,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `usuarios`
--

INSERT INTO `usuarios` (`id`, `nombre`, `apellido`, `email`, `contrasenia`, `preguntaSeguridad`, `respuestaSeguridad`, `perfil_id`, `updated_at`, `created_at`) VALUES
(1, 'Jessica', 'Galvan', 'jessica_lamelli@hotmail.com', '$2y$10$zV0.UkSm6caA9JtDAXX6deoW4QA074/oVZK1GmU3WG98n8fkn0Oby', 'mascota', '$2y$10$B.LaAlTFNJ9Yp5yXkRO2/OTndRY.DY1WarnIExte.7YckUIo1UA5m', 1, '2019-06-06 18:23:42', '2019-06-06 04:08:45'),
(2, 'Jessica', 'Galvan', 'jessica.galvan@hotmail.com', '$2y$10$Zu/eF/ztmTasiyxqVxkX.OnyN973v3kTpuiumctzqKBVmgx/KmgIO', 'mascota', '$2y$10$KPPvyHp7YHz1c.GHAIyD6.yoYCU0p8gJkALSDOqkex.Fw3rZSUMgG', 2, '2019-06-06 04:39:55', '2019-06-06 04:39:55'),
(3, 'Harry', 'Potter', 'harry@potter.com', '$2y$10$zCZX4R70CN826KxZrQO2KeichyzOpicILIUsOMMb72QNtmkqMLOHS', 'libro', '$2y$10$joiGAbpE38XA6mQZQc.iuOx5S18W3np0kXVJarHjKb9OEexFysBTS', 3, '2019-06-06 23:16:17', '2019-06-06 04:41:20'),
(4, 'Hermione', 'Granger', 'hermione@granger.com', '$2y$10$M36LXnr8SALRgGnXNOR76.KlXob/pd.OQ/EOjixVzaPgat8MsxX8S', 'libro', '$2y$10$4tG52FU8xLd2zHUtUa8n2.viMyy6OM8k2/Cjl72BjvIIQcOJ825NG', 4, '2019-06-06 23:17:42', '2019-06-06 23:17:42'),
(5, 'Lily', 'Evans', 'lily@evans.com', '$2y$10$M1gIi90QAQjyzbYYvRDz.e5sF2MEPoxK0qY6VY2kmU/JrXdGDOoWK', 'libro', '$2y$10$XP93GCogMijV50ZfFDThKez9H3WyNEv8yYumivyCaZ5MDBiEyKcSu', 5, '2019-06-06 23:54:19', '2019-06-06 23:54:19'),
(6, 'anto', 'car', 'anto@gmail.com', '$2y$10$VEcmFzU39CVXgL/ZA5SS1OV4qh28SSSiLz0ZGaJGTJqa9dwwG0a6u', 'mascota', '$2y$10$BhSRCCoSXoQTVXnLix5pxeptYjLByGl8EJamzrtD4eMIuvCQ5erju', 6, '2019-06-07 17:17:22', '2019-06-07 17:15:35');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `carritos`
--
ALTER TABLE `carritos`
  ADD PRIMARY KEY (`id`),
  ADD KEY `carrito_usuario_id` (`usuario_id`);

--
-- Indices de la tabla `carrito_producto`
--
ALTER TABLE `carrito_producto`
  ADD PRIMARY KEY (`ID`),
  ADD KEY `carrito_id` (`carrito_id`),
  ADD KEY `producto_id` (`producto_id`);

--
-- Indices de la tabla `categorias`
--
ALTER TABLE `categorias`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `estados`
--
ALTER TABLE `estados`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `perfiles`
--
ALTER TABLE `perfiles`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `productos`
--
ALTER TABLE `productos`
  ADD PRIMARY KEY (`id`),
  ADD KEY `producto_categoria_id` (`categoria_id`),
  ADD KEY `producto_estado_id` (`estado_id`),
  ADD KEY `producto_tipo_id` (`tipoproducto_id`);

--
-- Indices de la tabla `tipoProductos`
--
ALTER TABLE `tipoProductos`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`),
  ADD UNIQUE KEY `perfil_id` (`perfil_id`) USING BTREE;

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `carritos`
--
ALTER TABLE `carritos`
  MODIFY `id` int(4) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `carrito_producto`
--
ALTER TABLE `carrito_producto`
  MODIFY `ID` int(4) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `categorias`
--
ALTER TABLE `categorias`
  MODIFY `id` int(2) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT de la tabla `estados`
--
ALTER TABLE `estados`
  MODIFY `id` int(1) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT de la tabla `perfiles`
--
ALTER TABLE `perfiles`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT de la tabla `productos`
--
ALTER TABLE `productos`
  MODIFY `id` int(4) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT de la tabla `tipoProductos`
--
ALTER TABLE `tipoProductos`
  MODIFY `id` int(2) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `carritos`
--
ALTER TABLE `carritos`
  ADD CONSTRAINT `carrito_usuario_id` FOREIGN KEY (`usuario_id`) REFERENCES `usuarios` (`id`);

--
-- Filtros para la tabla `carrito_producto`
--
ALTER TABLE `carrito_producto`
  ADD CONSTRAINT `carrito_id` FOREIGN KEY (`carrito_id`) REFERENCES `carritos` (`id`),
  ADD CONSTRAINT `producto_id` FOREIGN KEY (`producto_id`) REFERENCES `productos` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
