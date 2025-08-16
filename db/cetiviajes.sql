-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 16-08-2025 a las 22:14:43
-- Versión del servidor: 10.11.2-MariaDB
-- Versión de PHP: 8.1.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `cetiviajes`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `admins`
--

CREATE TABLE `admins` (
  `id` int(11) NOT NULL,
  `usuario` varchar(50) NOT NULL,
  `nombre` varchar(50) NOT NULL,
  `correo` varchar(50) NOT NULL,
  `password` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `admins`
--

INSERT INTO `admins` (`id`, `usuario`, `nombre`, `correo`, `password`) VALUES
(1, 'Admin1', 'Hector', 'a21310386@ceti.mx', '12345');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `agencia`
--

CREATE TABLE `agencia` (
  `nombre` varchar(50) NOT NULL,
  `transporte` varchar(40) DEFAULT NULL,
  `rating` float(2,1) DEFAULT NULL,
  `categoria` varchar(20) DEFAULT NULL,
  `coste` int(4) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `agencia`
--

INSERT INTO `agencia` (`nombre`, `transporte`, `rating`, `categoria`, `coste`) VALUES
('Bocho Viajes', 'Autobus', 7.9, 'Transporte Económico', 500),
('Costco', 'Avión', 8.0, 'Transporte Económico', 600),
('Trosten Transport', 'Avión', 9.7, 'Transporte de Lujo', 1000),
('Turistica Allende', 'Autobus', 8.2, 'Transporte de Lujo', 750),
('Viajes Baratos', 'Bici', 9.9, 'Super Económico ', 50);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `destinos`
--

CREATE TABLE `destinos` (
  `nombre` varchar(30) NOT NULL,
  `estado` varchar(20) DEFAULT NULL,
  `descripcion` text DEFAULT NULL,
  `imagen` varchar(255) DEFAULT NULL,
  `hospedaje` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `destinos`
--

INSERT INTO `destinos` (`nombre`, `estado`, `descripcion`, `imagen`, `hospedaje`) VALUES
('Bacalar', 'Quintana Roo', 'También llamada Laguna de los Siete Colores es impactante por su belleza, sus rápidos, sus estromatolitos y muy especialmente por sus embrujadores cenotes. La laguna es también sitio de moda para la motonáutica y otros atractivos acuáticos', 'Img_2.jpg', 'Secrets Maroma'),
('Cascada Hierve Agua', 'Oaxaca', 'Una maravilla natural del Estado de Oaxaca, Las cataratas pétreas se formaron a lo largo de los milenios, mediante el goteo del agua saturada de carbonatos, de la misma manera que se erigen las estalactitas y estalagmitas en las cavernas', 'Img_3.jpg', 'San Judas'),
('Cascadas Agua Azul', 'Chiapas', ' Los ríos Otulún, Shumuljá y Tulijá, en el municipio chiapaneco de Tumbalá, forman acantilados verticales en sus cañones, por los que se desprenden unas bellas cataratas blaquiazules, las cascadas Agua Azul', 'Img_7.jpg', 'Le Resort'),
('Huasteca Potosina', 'San Luis Potosi', 'Es un amplio espacio del estado de San Luis Potosi, que reúne un conjunto de municipios y atracciones, como si estuvieras en un pequeño país, presto a disfrutar de todos los encantos disponibles', 'Img_1.jpg', 'Garza Blanca'),
('Islas Marietas', 'Nayarit', 'Son dos islas nayaritas deshabitadas, llamadas Isla Redonda e Isla Larga. Son frecuentadas por sus hermosas playas, ideales para el buceo, el snorkel y la observación de la vida submarina', 'Img_5.jpg', 'Hyatt Hotels'),
('Palenque', 'Chiapas', 'Es una ciudad de origen maya en el estado de Chiapas, cuyos principales atractivos son sus yacimientos arqueológicos y sus hermosas cascadas. Buena parte de la zona arqueológica está aún por desenterrar', 'Img_9.jpg', 'Ritz-Carlton'),
('Playa del Carmen', 'Quintana Roo', 'La Riviera Maya, en el Caribe mexicano, es uno de los principales corredores mundiales del turismo de playa y su corazón es Playa del Carmen. La ciudad del estado de Quintana Roo, frente a la isla de Cozumel, cuenta con una infraestructura hotelera de primer orden', 'Img_6.jpg', 'Four Seasons Hotels'),
('Pozas de Xilitla', 'San Luis Potosí', 'El conglomerado arquitectónico y escultórico se encuentra en un hermoso predio de más de 300 mil metros cuadrados y las piezas artísticas están admirablemente integradas a cascadas, pozas, jardines y otros componentes del entorno natural', 'Img_4.jpg', 'Paraíso Encantado'),
('Prueba', 'CETI', 'Revision', '54c9f8d0422f0dca12c66d242f5c954e.jpg', NULL),
('Recinto de Mariposas Monarca', 'Michoacan', 'En Michoacán tiene dos grandes santuarios, la montaña de El Rosario y Sierra Chincua. Los observadores de la vida silvestre se las arreglan para ver a estos curiosos insectos que se hospedan en México entre Noviembre y Marzo', 'Img_8.jpg', 'Hotel BosqueLuna');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `hospedaje`
--

CREATE TABLE `hospedaje` (
  `nombre` varchar(30) NOT NULL,
  `costo` int(10) DEFAULT NULL,
  `tipo_habitacion1` varchar(50) DEFAULT NULL,
  `tipo_habitacion2` varchar(50) DEFAULT NULL,
  `rating` float(2,1) DEFAULT NULL,
  `destino` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `hospedaje`
--

INSERT INTO `hospedaje` (`nombre`, `costo`, `tipo_habitacion1`, `tipo_habitacion2`, `rating`, `destino`) VALUES
('Four Seasons Hotels', 10200, 'Gran Suite', 'Suite Personal', 9.7, 'Playa del Carmen'),
('Garza Blanca', 2500, 'Simple', 'Suite', 8.5, 'Huasteca Potosina'),
('Hotel BosqueLuna', 3800, 'Individual Simple', 'Doble Junior Suite', 8.0, 'Recinto de Mariposas Monarca'),
('Hyatt Hotels', 7800, 'Familiar', 'Gran Suite', 9.4, 'Islas Marietas'),
('Le Resort', 4200, 'Penthouse', 'Simple con Jacuzi', 9.9, 'Cascadas Agua Azul'),
('Paraíso Encantado', 1050, 'Simple', 'Doble', 8.7, 'Pozas de Xilitla'),
('Ritz-Carlton', 2300, 'Doble', 'Estudio', 7.5, 'Palenque'),
('San Judas', 1600, 'Doble', 'Suite', 8.2, 'Cascada Hierve Agua'),
('Secrets Maroma', 12450, 'Simple Familiar', 'Suite Doble', 8.4, 'Bacalar');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuarios`
--

CREATE TABLE `usuarios` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `nombre` varchar(50) DEFAULT NULL,
  `password` varchar(50) DEFAULT NULL,
  `apellido` varchar(50) DEFAULT NULL,
  `usuario` varchar(50) DEFAULT NULL,
  `correo` varchar(50) DEFAULT NULL,
  `telefono` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `usuarios`
--

INSERT INTO `usuarios` (`id`, `nombre`, `password`, `apellido`, `usuario`, `correo`, `telefono`) VALUES
(1, 'Héctor', '12345', 'Rodríguez', 'Heptor1234', 'a21310386@ceti.mx', '3320094223'),
(2, 'Luips', '1234', 'Algo', 'Luipsjefe1', 'algo@ceti.mx', '3320094223'),
(3, 'Ricardo', '12', 'Padilla', 'algo123', 'ceti@ceti.mx', '1234567890'),
(4, 'Algo', '12', 'algo', 'algo432', 'algo@algo.com', '1234567890'),
(5, 'Brenda', '12345', 'Davalos', 'Davalor12', 'algo@ceti.mx', '1234567890'),
(6, 'Prueba1', '12', 'Prueba1', 'prueba', 'prueva@prueva.com', '1123456789'),
(11, 'Naomi', '12345', 'Naomi', 'Naomi1', 'algo@algo.com', '1234567897'),
(12, 'Adolfo', '12', 'Adolfo', 'AD', 'algo@algo.com', '1234567890'),
(13, 'Revision', '12345', 'Algo', 'revision1', 'rsantana@ceti.mx', '1234567890'),
(14, 'Consola', '12345', 'Consola2', 'CS', 'algo@ceti.mx', '3312195452'),
(15, 'Prueba Web 2', '12345', 'Nada', 'PruebaWeb2', 'web2@outlook.com', '3320094223');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `admins`
--
ALTER TABLE `admins`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `agencia`
--
ALTER TABLE `agencia`
  ADD PRIMARY KEY (`nombre`);

--
-- Indices de la tabla `destinos`
--
ALTER TABLE `destinos`
  ADD PRIMARY KEY (`nombre`);

--
-- Indices de la tabla `hospedaje`
--
ALTER TABLE `hospedaje`
  ADD PRIMARY KEY (`nombre`);

--
-- Indices de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `admins`
--
ALTER TABLE `admins`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
