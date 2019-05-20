-- phpMyAdmin SQL Dump
-- version 4.8.5
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 20-05-2019 a las 21:42:39
-- Versión del servidor: 10.1.38-MariaDB
-- Versión de PHP: 7.3.3

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `practicas`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `casa`
--

CREATE TABLE `casa` (
  `codi_casa` int(10) UNSIGNED NOT NULL,
  `nomb_casa` varchar(200) COLLATE utf8mb4_spanish2_ci NOT NULL,
  `dire_casa` varchar(500) COLLATE utf8mb4_spanish2_ci NOT NULL,
  `codi_tipo_casa` int(10) UNSIGNED NOT NULL,
  `logo_casa` varchar(250) COLLATE utf8mb4_spanish2_ci NOT NULL,
  `esta_casa` int(1) UNSIGNED NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_spanish2_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `categoria`
--

CREATE TABLE `categoria` (
  `codi_cate` int(10) UNSIGNED NOT NULL,
  `nomb_cate` varchar(100) COLLATE utf8mb4_spanish2_ci NOT NULL,
  `esta_cate` int(1) UNSIGNED NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_spanish2_ci;

--
-- Volcado de datos para la tabla `categoria`
--

INSERT INTO `categoria` (`codi_cate`, `nomb_cate`, `esta_cate`) VALUES
(1, 'Hábil', 1),
(2, 'Hábil Tecnico', 1),
(3, 'Permanente', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `curso`
--

CREATE TABLE `curso` (
  `codi_curs` int(10) UNSIGNED NOT NULL,
  `codi_cate` int(10) UNSIGNED NOT NULL,
  `codi_casa` int(10) UNSIGNED NOT NULL,
  `nomb_curs` varchar(250) COLLATE utf8mb4_spanish2_ci NOT NULL,
  `fech_inic` date NOT NULL,
  `fech_fin` date NOT NULL,
  `esta_curs` int(1) UNSIGNED NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_spanish2_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `docente`
--

CREATE TABLE `docente` (
  `codi_doce` int(10) UNSIGNED NOT NULL,
  `codi_casa` int(10) UNSIGNED NOT NULL,
  `nomb_doce` varchar(100) COLLATE utf8mb4_spanish2_ci NOT NULL,
  `apel_doce` varchar(100) COLLATE utf8mb4_spanish2_ci NOT NULL,
  `esta_doce` int(1) UNSIGNED NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_spanish2_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `horario`
--

CREATE TABLE `horario` (
  `codi_hora` int(10) UNSIGNED NOT NULL,
  `codi_dia` int(1) UNSIGNED NOT NULL,
  `codi_casa` int(10) UNSIGNED NOT NULL,
  `hora_inic` time NOT NULL,
  `hora_fin` time NOT NULL,
  `esta_hora` int(1) UNSIGNED NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_spanish2_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `intermedia_curso_salon`
--

CREATE TABLE `intermedia_curso_salon` (
  `codi_inte_curs_salo` int(10) UNSIGNED NOT NULL,
  `codi_curs` int(10) UNSIGNED NOT NULL,
  `codi_salo` int(10) UNSIGNED NOT NULL,
  `esta_inte_curs_salo` int(1) UNSIGNED NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_spanish2_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `intermedia_horario_docente`
--

CREATE TABLE `intermedia_horario_docente` (
  `codi_inte_hora_doce` int(10) UNSIGNED NOT NULL,
  `codi_inte_curs_salo` int(10) UNSIGNED NOT NULL,
  `codi_hora` int(10) UNSIGNED NOT NULL,
  `codi_doce` int(10) UNSIGNED NOT NULL,
  `esta_inte_hora_doce` int(1) UNSIGNED NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_spanish2_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `notificaciones`
--

CREATE TABLE `notificaciones` (
  `codi_noti` int(10) UNSIGNED NOT NULL,
  `codi_casa` int(10) UNSIGNED NOT NULL,
  `acci_noti` varchar(400) COLLATE utf8mb4_spanish2_ci NOT NULL,
  `esta_noti` int(1) UNSIGNED NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_spanish2_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `presupuesto`
--

CREATE TABLE `presupuesto` (
  `codi_pres` int(10) UNSIGNED NOT NULL,
  `codi_casa` int(10) UNSIGNED NOT NULL,
  `codi_usua` int(10) UNSIGNED NOT NULL,
  `cant_pres` decimal(10,2) NOT NULL,
  `fech_pres` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_spanish2_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `presupuesto_detalle`
--

CREATE TABLE `presupuesto_detalle` (
  `codi_pres_deta` int(10) UNSIGNED NOT NULL,
  `codi_pres` int(10) UNSIGNED NOT NULL,
  `codi_usua` int(10) UNSIGNED NOT NULL,
  `codi_casa` int(10) UNSIGNED NOT NULL,
  `cant_pres_deta` decimal(10,2) NOT NULL,
  `arch_pres_deta` varchar(250) COLLATE utf8mb4_spanish2_ci NOT NULL,
  `fech_pres_deta` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_spanish2_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `salon`
--

CREATE TABLE `salon` (
  `codi_salo` int(10) UNSIGNED NOT NULL,
  `codi_casa` int(10) UNSIGNED NOT NULL,
  `nomb_salo` varchar(100) COLLATE utf8mb4_spanish2_ci NOT NULL,
  `esta_salo` int(10) UNSIGNED NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_spanish2_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `telefono`
--

CREATE TABLE `telefono` (
  `codi_tele` int(10) UNSIGNED NOT NULL,
  `codi_casa` int(10) UNSIGNED NOT NULL,
  `codi_tipo_tele` int(10) UNSIGNED NOT NULL,
  `nume_tele` varchar(20) COLLATE utf8mb4_spanish2_ci NOT NULL,
  `esta_tele` int(1) UNSIGNED NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_spanish2_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tipo_casa`
--

CREATE TABLE `tipo_casa` (
  `codi_tipo_casa` int(10) UNSIGNED NOT NULL,
  `nomb_tipo_casa` varchar(50) COLLATE utf8mb4_spanish2_ci NOT NULL,
  `esta_tipo_casa` int(1) UNSIGNED NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_spanish2_ci;

--
-- Volcado de datos para la tabla `tipo_casa`
--

INSERT INTO `tipo_casa` (`codi_tipo_casa`, `nomb_tipo_casa`, `esta_tipo_casa`) VALUES
(1, 'Encargada', 1),
(2, 'Normal', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tipo_telefono`
--

CREATE TABLE `tipo_telefono` (
  `codi_tipo_tele` int(10) UNSIGNED NOT NULL,
  `nomb_tipo_tele` varchar(100) COLLATE utf8mb4_spanish2_ci NOT NULL,
  `esta_tipo_tele` int(1) UNSIGNED NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_spanish2_ci;

--
-- Volcado de datos para la tabla `tipo_telefono`
--

INSERT INTO `tipo_telefono` (`codi_tipo_tele`, `nomb_tipo_tele`, `esta_tipo_tele`) VALUES
(1, 'Fijo', 1),
(2, 'Celular', 1),
(3, 'FAX', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tipo_usuario`
--

CREATE TABLE `tipo_usuario` (
  `codi_tipo_usua` int(10) UNSIGNED NOT NULL,
  `nomb_tipo_usua` varchar(100) COLLATE utf8mb4_spanish2_ci NOT NULL,
  `esta_tipo_usua` int(1) UNSIGNED NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_spanish2_ci;

--
-- Volcado de datos para la tabla `tipo_usuario`
--

INSERT INTO `tipo_usuario` (`codi_tipo_usua`, `nomb_tipo_usua`, `esta_tipo_usua`) VALUES
(1, 'Administrador', 1),
(2, 'Financiero', 1),
(3, 'Encargado', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuario`
--

CREATE TABLE `usuario` (
  `codi_usua` int(10) UNSIGNED NOT NULL,
  `nomb_usua` varchar(100) COLLATE utf8mb4_spanish2_ci NOT NULL,
  `apel_usua` varchar(100) COLLATE utf8mb4_spanish2_ci NOT NULL,
  `corre_usua` varchar(200) COLLATE utf8mb4_spanish2_ci NOT NULL,
  `cont_usua` varchar(250) COLLATE utf8mb4_spanish2_ci NOT NULL,
  `codi_casa` int(11) UNSIGNED NOT NULL,
  `codi_tipo_usua` int(11) UNSIGNED NOT NULL,
  `esta_usua` int(1) UNSIGNED NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_spanish2_ci;

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `casa`
--
ALTER TABLE `casa`
  ADD PRIMARY KEY (`codi_casa`),
  ADD KEY `fk-tipoCasa-casa` (`codi_tipo_casa`);

--
-- Indices de la tabla `categoria`
--
ALTER TABLE `categoria`
  ADD PRIMARY KEY (`codi_cate`);

--
-- Indices de la tabla `curso`
--
ALTER TABLE `curso`
  ADD PRIMARY KEY (`codi_curs`),
  ADD KEY `fk-curso_casa` (`codi_casa`),
  ADD KEY `fk-curso_categoria` (`codi_cate`);

--
-- Indices de la tabla `docente`
--
ALTER TABLE `docente`
  ADD PRIMARY KEY (`codi_doce`);

--
-- Indices de la tabla `horario`
--
ALTER TABLE `horario`
  ADD PRIMARY KEY (`codi_hora`);

--
-- Indices de la tabla `intermedia_curso_salon`
--
ALTER TABLE `intermedia_curso_salon`
  ADD PRIMARY KEY (`codi_inte_curs_salo`),
  ADD KEY `fk-intermedia_salon` (`codi_salo`),
  ADD KEY `fk-intermedia-curso` (`codi_curs`);

--
-- Indices de la tabla `intermedia_horario_docente`
--
ALTER TABLE `intermedia_horario_docente`
  ADD PRIMARY KEY (`codi_inte_hora_doce`),
  ADD KEY `fk-intermedia_horario` (`codi_hora`),
  ADD KEY `fk-intermedia_docente` (`codi_doce`),
  ADD KEY `fk-intermediaM-intermediaD` (`codi_inte_curs_salo`);

--
-- Indices de la tabla `notificaciones`
--
ALTER TABLE `notificaciones`
  ADD PRIMARY KEY (`codi_noti`),
  ADD KEY `fk-notificaciones_casa` (`codi_casa`);

--
-- Indices de la tabla `presupuesto`
--
ALTER TABLE `presupuesto`
  ADD PRIMARY KEY (`codi_pres`),
  ADD KEY `fk-presupuesto_casa` (`codi_casa`);

--
-- Indices de la tabla `presupuesto_detalle`
--
ALTER TABLE `presupuesto_detalle`
  ADD PRIMARY KEY (`codi_pres_deta`),
  ADD KEY `fk-presupuestoDetale_presupuesto` (`codi_pres`);

--
-- Indices de la tabla `salon`
--
ALTER TABLE `salon`
  ADD PRIMARY KEY (`codi_salo`);

--
-- Indices de la tabla `telefono`
--
ALTER TABLE `telefono`
  ADD PRIMARY KEY (`codi_tele`),
  ADD KEY `fk-telefono_casa` (`codi_casa`),
  ADD KEY `fk-telefono_tipo-telefono` (`codi_tipo_tele`);

--
-- Indices de la tabla `tipo_casa`
--
ALTER TABLE `tipo_casa`
  ADD PRIMARY KEY (`codi_tipo_casa`);

--
-- Indices de la tabla `tipo_telefono`
--
ALTER TABLE `tipo_telefono`
  ADD PRIMARY KEY (`codi_tipo_tele`);

--
-- Indices de la tabla `tipo_usuario`
--
ALTER TABLE `tipo_usuario`
  ADD PRIMARY KEY (`codi_tipo_usua`);

--
-- Indices de la tabla `usuario`
--
ALTER TABLE `usuario`
  ADD PRIMARY KEY (`codi_usua`),
  ADD KEY `fk-usuario_casa` (`codi_casa`),
  ADD KEY `fk-usuario_tipoUsuario` (`codi_tipo_usua`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `casa`
--
ALTER TABLE `casa`
  MODIFY `codi_casa` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `categoria`
--
ALTER TABLE `categoria`
  MODIFY `codi_cate` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de la tabla `curso`
--
ALTER TABLE `curso`
  MODIFY `codi_curs` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `docente`
--
ALTER TABLE `docente`
  MODIFY `codi_doce` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `horario`
--
ALTER TABLE `horario`
  MODIFY `codi_hora` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `intermedia_curso_salon`
--
ALTER TABLE `intermedia_curso_salon`
  MODIFY `codi_inte_curs_salo` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `intermedia_horario_docente`
--
ALTER TABLE `intermedia_horario_docente`
  MODIFY `codi_inte_hora_doce` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `notificaciones`
--
ALTER TABLE `notificaciones`
  MODIFY `codi_noti` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `presupuesto`
--
ALTER TABLE `presupuesto`
  MODIFY `codi_pres` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `presupuesto_detalle`
--
ALTER TABLE `presupuesto_detalle`
  MODIFY `codi_pres_deta` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `salon`
--
ALTER TABLE `salon`
  MODIFY `codi_salo` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `telefono`
--
ALTER TABLE `telefono`
  MODIFY `codi_tele` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `tipo_casa`
--
ALTER TABLE `tipo_casa`
  MODIFY `codi_tipo_casa` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de la tabla `tipo_telefono`
--
ALTER TABLE `tipo_telefono`
  MODIFY `codi_tipo_tele` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de la tabla `tipo_usuario`
--
ALTER TABLE `tipo_usuario`
  MODIFY `codi_tipo_usua` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de la tabla `usuario`
--
ALTER TABLE `usuario`
  MODIFY `codi_usua` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `casa`
--
ALTER TABLE `casa`
  ADD CONSTRAINT `fk-tipoCasa-casa` FOREIGN KEY (`codi_tipo_casa`) REFERENCES `tipo_casa` (`codi_tipo_casa`);

--
-- Filtros para la tabla `curso`
--
ALTER TABLE `curso`
  ADD CONSTRAINT `fk-curso_casa` FOREIGN KEY (`codi_casa`) REFERENCES `casa` (`codi_casa`),
  ADD CONSTRAINT `fk-curso_categoria` FOREIGN KEY (`codi_cate`) REFERENCES `categoria` (`codi_cate`);

--
-- Filtros para la tabla `intermedia_curso_salon`
--
ALTER TABLE `intermedia_curso_salon`
  ADD CONSTRAINT `fk-intermedia-curso` FOREIGN KEY (`codi_curs`) REFERENCES `curso` (`codi_curs`) ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk-intermedia_salon` FOREIGN KEY (`codi_salo`) REFERENCES `salon` (`codi_salo`);

--
-- Filtros para la tabla `intermedia_horario_docente`
--
ALTER TABLE `intermedia_horario_docente`
  ADD CONSTRAINT `fk-intermediaM-intermediaD` FOREIGN KEY (`codi_inte_curs_salo`) REFERENCES `intermedia_curso_salon` (`codi_inte_curs_salo`) ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk-intermedia_docente` FOREIGN KEY (`codi_doce`) REFERENCES `docente` (`codi_doce`),
  ADD CONSTRAINT `fk-intermedia_horario` FOREIGN KEY (`codi_hora`) REFERENCES `horario` (`codi_hora`);

--
-- Filtros para la tabla `notificaciones`
--
ALTER TABLE `notificaciones`
  ADD CONSTRAINT `fk-notificaciones_casa` FOREIGN KEY (`codi_casa`) REFERENCES `casa` (`codi_casa`);

--
-- Filtros para la tabla `presupuesto`
--
ALTER TABLE `presupuesto`
  ADD CONSTRAINT `fk-presupuesto_casa` FOREIGN KEY (`codi_casa`) REFERENCES `casa` (`codi_casa`);

--
-- Filtros para la tabla `presupuesto_detalle`
--
ALTER TABLE `presupuesto_detalle`
  ADD CONSTRAINT `fk-presupuestoDetale_presupuesto` FOREIGN KEY (`codi_pres`) REFERENCES `presupuesto` (`codi_pres`);

--
-- Filtros para la tabla `telefono`
--
ALTER TABLE `telefono`
  ADD CONSTRAINT `fk-telefono_casa` FOREIGN KEY (`codi_casa`) REFERENCES `casa` (`codi_casa`),
  ADD CONSTRAINT `fk-telefono_tipo-telefono` FOREIGN KEY (`codi_tipo_tele`) REFERENCES `tipo_telefono` (`codi_tipo_tele`);

--
-- Filtros para la tabla `usuario`
--
ALTER TABLE `usuario`
  ADD CONSTRAINT `fk-usuario_casa` FOREIGN KEY (`codi_casa`) REFERENCES `casa` (`codi_casa`),
  ADD CONSTRAINT `fk-usuario_tipoUsuario` FOREIGN KEY (`codi_tipo_usua`) REFERENCES `tipo_usuario` (`codi_tipo_usua`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
