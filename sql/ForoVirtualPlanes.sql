-- phpMyAdmin SQL Dump
-- version 4.8.1-dev
-- https://www.phpmyadmin.net/
--
-- Servidor: localhost
-- Tiempo de generación: 03-08-2018 a las 12:22:54
-- Versión del servidor: 5.7.21-21-log
-- Versión de PHP: 7.0.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `u137048db1`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `comentario_foro`
--

CREATE TABLE `comentario_foro` (
  `id_comentario` int(10) UNSIGNED NOT NULL,
  `id_tema` int(10) UNSIGNED DEFAULT NULL,
  `id_usuario` int(10) UNSIGNED DEFAULT NULL,
  `comentario` mediumtext,
  `fecha` date DEFAULT NULL,
  `activo` tinyint(1) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `estadisticas`
--

CREATE TABLE `estadisticas` (
  `id_estadistica` int(10) UNSIGNED NOT NULL,
  `id_tema` int(10) UNSIGNED NOT NULL,
  `id_usuario` int(10) UNSIGNED NOT NULL,
  `fecha` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `foro_categoria`
--

CREATE TABLE `foro_categoria` (
  `id_forocategoria` int(10) UNSIGNED NOT NULL,
  `categoria` varchar(250) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `foro_categoria`
--

INSERT INTO `foro_categoria` (`id_forocategoria`, `categoria`) VALUES
(1, 'Formación profesional'),
(2, 'Desconecta');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `foro_foro`
--

CREATE TABLE `foro_foro` (
  `id_foro` int(10) UNSIGNED NOT NULL,
  `id_forocategoria` int(10) UNSIGNED NOT NULL,
  `foro` varchar(250) NOT NULL,
  `descripcion` mediumtext NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `foro_foro`
--

INSERT INTO `foro_foro` (`id_foro`, `id_forocategoria`, `foro`, `descripcion`) VALUES
(1, 1, '1º Desarrollo de Aplicaiones Web', 'Los estudios de este título consiste en desarrollar, implantar, y 					mantener aplicaciones web,\r\n                               con independencia del modelo empleado y utilizando tecnologías 						específicas, garantizando el \r\n                               acceso a los datos de forma segura y cumpliendo los criterios de 					accesibilidad, usabilidad y calidad \r\n                               exigidas en los estándares establecidos.'),
(2, 1, '2º Desarrollo de Aplicaiones Web', 'Los estudios de este título consiste en desarrollar, implantar, y 					mantener aplicaciones web,\r\n                               con independencia del modelo empleado y utilizando tecnologías 						específicas, garantizando el \r\n                               acceso a los datos de forma segura y cumpliendo los criterios de 					accesibilidad, usabilidad y calidad \r\n                               exigidas en los estándares establecidos.'),
(3, 1, '1º Sistemas Microinformáticos y Redes', 'Los estudios de este título consiste en instalar, \r\n				configurar y mantener sistemas microinformáticos, \r\n				aislados o en red, así como redes locales en pequeños entornos.'),
(4, 1, '2º Sistemas Microinformáticos y Redes', 'Los estudios de este título consiste en instalar, \r\n				configurar y mantener sistemas microinformáticos, \r\n				aislados o en red, así como redes locales en pequeños entornos.'),
(5, 2, 'Habla de cualquier cosa', ''),
(6, 2, 'Deportes', ''),
(7, 2, 'Entretenimiento audiovisual', ''),
(8, 2, 'Política', '');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `foro_subforos`
--

CREATE TABLE `foro_subforos` (
  `id_subforo` int(10) UNSIGNED NOT NULL,
  `id_foro` int(10) UNSIGNED DEFAULT NULL,
  `subforo` varchar(250) DEFAULT NULL,
  `descripcion` mediumtext
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `foro_subforos`
--

INSERT INTO `foro_subforos` (`id_subforo`, `id_foro`, `subforo`, `descripcion`) VALUES
(1, 1, 'Sistemas Informáticos', ''),
(2, 1, 'Bases de Datos', ''),
(3, 1, 'Programación', ''),
(4, 1, 'Entornos de desarrollo', ''),
(5, 1, 'Formación y orientación laboral', ''),
(6, 1, 'Empresa e iniciativa emprendedora', ''),
(7, 1, 'Inglés', ''),
(8, 2, 'Lenguajes de marcas y sistemas de gestión de información', ''),
(9, 2, 'Desarrollo web en entorno cliente', ''),
(10, 2, 'Desarrollo web en entorno servidor', ''),
(11, 2, 'Despliegue de aplicaciones web', ''),
(12, 2, 'Diseño de interfaces web', ''),
(13, 2, 'FCT (Formación en Centros de Trabajo)', ''),
(14, 2, 'Proyecto de desarrollo de aplicaciones web', ''),
(15, 3, 'Montaje y mantenimiento de equipos', ''),
(16, 3, 'Sistemas operativos monopuesto', ''),
(17, 3, 'Aplicaciones ofimáticas', ''),
(18, 3, 'Redes locales', ''),
(19, 3, 'Inglés técnico', ''),
(20, 3, 'Formación y orientación laboral', ''),
(21, 4, 'Sistemas operativos en red', ''),
(22, 4, 'Seguridad informática', ''),
(23, 4, 'Servicios en red', ''),
(24, 4, 'Aplicaciones web', ''),
(25, 4, 'Empresa e iniciativa emprendedora', ''),
(26, 5, 'Offtopic', ''),
(27, 6, 'Fútbol', ''),
(28, 6, 'Baloncesto', ''),
(29, 6, 'Tenis', ''),
(30, 6, 'Otros', ''),
(31, 7, 'Cine', ''),
(32, 7, 'Series', ''),
(33, 7, 'Música', ''),
(34, 7, 'Otros', ''),
(35, 8, 'Nacional', ''),
(36, 8, 'Internacional', '');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `foro_temas`
--

CREATE TABLE `foro_temas` (
  `id_tema` int(10) UNSIGNED NOT NULL,
  `id_foro` int(10) UNSIGNED NOT NULL,
  `id_subforo` int(10) UNSIGNED NOT NULL,
  `titulo` varchar(250) NOT NULL,
  `contenido` mediumtext NOT NULL,
  `fecha` date NOT NULL,
  `id_usuario` int(10) UNSIGNED NOT NULL,
  `activo` tinyint(2) NOT NULL,
  `hits` int(11) NOT NULL
  `created_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuarios`
--

CREATE TABLE `usuarios` (
  `id` int(10) UNSIGNED NOT NULL,
  `nick` varchar(100) NOT NULL,
  `password` varchar(100) NOT NULL,
  `nombre` varchar(150) NOT NULL,
  `correo` varchar(100) NOT NULL,
  `facebook` varchar(250) NOT NULL,
  `twitter` varchar(250) NOT NULL,
  `fechaderegistro` date NOT NULL,
  `ultimoacceso` varchar(45) NOT NULL,
  `activo` tinyint(2) NOT NULL,
  `avatar` varchar(200) NOT NULL,
  `firma` mediumtext NOT NULL,
  `privileges` varchar(50) DEFAULT NULL,
  `signature` varchar(255) DEFAULT NULL,
  `token` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `usuarios`
--

INSERT INTO `usuarios` (`id`, `nick`, `password`, `nombre`, `correo`, `facebook`, `twitter`, `fechaderegistro`, `ultimoacceso`, `activo`, `avatar`, `firma`, `privileges`, `signature`, `token`) VALUES
(1, 'nicolasmeseguer', '2c7eb404b515333876bd827ed26aecb9', 'NicolasMeseguer', 'nicolasmeseguer@icloud.com', '', '', '2018-08-03', '2018-08-03 14:21:57', 1, 'default.jpg', 'Me encanta FVP', 'master', '4907a40502dca9010cccbccf7997aa5c', NULL);

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `comentario_foro`
--
ALTER TABLE `comentario_foro`
  ADD PRIMARY KEY (`id_comentario`),
  ADD KEY `comentario_foro_id_tema_foro_temas_idx` (`id_tema`),
  ADD KEY `comentario_foro_id_usuario_usuarios_idx` (`id_usuario`);

--
-- Indices de la tabla `estadisticas`
--
ALTER TABLE `estadisticas`
  ADD PRIMARY KEY (`id_estadistica`),
  ADD KEY `estadisticas_id_tema_foro_temas_idx` (`id_tema`),
  ADD KEY `estadisticas_id_usuario_usuarios_idx` (`id_usuario`);

--
-- Indices de la tabla `foro_categoria`
--
ALTER TABLE `foro_categoria`
  ADD PRIMARY KEY (`id_forocategoria`);

--
-- Indices de la tabla `foro_foro`
--
ALTER TABLE `foro_foro`
  ADD PRIMARY KEY (`id_foro`),
  ADD KEY `foro_foro_id_forocategoria_foro_categoria_idx` (`id_forocategoria`);

--
-- Indices de la tabla `foro_subforos`
--
ALTER TABLE `foro_subforos`
  ADD PRIMARY KEY (`id_subforo`),
  ADD KEY `foro_subforo_id_foro_foro_foro_idx` (`id_foro`);

--
-- Indices de la tabla `foro_temas`
--
ALTER TABLE `foro_temas`
  ADD PRIMARY KEY (`id_tema`),
  ADD KEY `foros_temas_id_foro_foro_foro_idx` (`id_foro`),
  ADD KEY `foro_temas_id_subforo_foro_subforo_idx` (`id_subforo`),
  ADD KEY `foro_temas_id_usuario_usuarios_idx` (`id_usuario`);

--
-- Indices de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `nick_UNIQUE` (`nick`),
  ADD UNIQUE KEY `password_UNIQUE` (`password`),
  ADD UNIQUE KEY `correo_UNIQUE` (`correo`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `comentario_foro`
--
ALTER TABLE `comentario_foro`
  MODIFY `id_comentario` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `estadisticas`
--
ALTER TABLE `estadisticas`
  MODIFY `id_estadistica` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `foro_categoria`
--
ALTER TABLE `foro_categoria`
  MODIFY `id_forocategoria` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de la tabla `foro_foro`
--
ALTER TABLE `foro_foro`
  MODIFY `id_foro` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT de la tabla `foro_subforos`
--
ALTER TABLE `foro_subforos`
  MODIFY `id_subforo` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=37;

--
-- AUTO_INCREMENT de la tabla `foro_temas`
--
ALTER TABLE `foro_temas`
  MODIFY `id_tema` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `comentario_foro`
--
ALTER TABLE `comentario_foro`
  ADD CONSTRAINT `comentario_foro_id_tema_foro_temas` FOREIGN KEY (`id_tema`) REFERENCES `foro_temas` (`id_tema`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `comentario_foro_id_usuario_usuarios` FOREIGN KEY (`id_usuario`) REFERENCES `usuarios` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `estadisticas`
--
ALTER TABLE `estadisticas`
  ADD CONSTRAINT `estadisticas_id_tema_foro_temas` FOREIGN KEY (`id_tema`) REFERENCES `foro_temas` (`id_tema`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `estadisticas_id_usuario_usuarios` FOREIGN KEY (`id_usuario`) REFERENCES `usuarios` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `foro_foro`
--
ALTER TABLE `foro_foro`
  ADD CONSTRAINT `foro_foro_id_forocategoria_foro_categoria` FOREIGN KEY (`id_forocategoria`) REFERENCES `foro_categoria` (`id_forocategoria`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `foro_subforos`
--
ALTER TABLE `foro_subforos`
  ADD CONSTRAINT `foro_subforo_id_foro_foro_foro` FOREIGN KEY (`id_foro`) REFERENCES `foro_foro` (`id_foro`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `foro_temas`
--
ALTER TABLE `foro_temas`
  ADD CONSTRAINT `foro_temas_id_subforo_foro_subforo` FOREIGN KEY (`id_subforo`) REFERENCES `foro_subforos` (`id_subforo`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `foro_temas_id_usuario_usuarios` FOREIGN KEY (`id_usuario`) REFERENCES `usuarios` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `foros_temas_id_foro_foro_foro` FOREIGN KEY (`id_foro`) REFERENCES `foro_foro` (`id_foro`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
