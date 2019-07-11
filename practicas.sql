-- phpMyAdmin SQL Dump
-- version 4.8.5
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 11-07-2019 a las 16:10:37
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
-- Estructura de tabla para la tabla `acreditacion`
--

CREATE TABLE `acreditacion` (
  `codi_acre` int(10) UNSIGNED NOT NULL,
  `tipo_acre` varchar(250) COLLATE utf8mb4_spanish2_ci NOT NULL,
  `esta_acre` int(10) UNSIGNED NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_spanish2_ci;

--
-- Volcado de datos para la tabla `acreditacion`
--

INSERT INTO `acreditacion` (`codi_acre`, `tipo_acre`, `esta_acre`) VALUES
(1, 'Medivam', 1),
(2, 'Nuevax', 1);

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

--
-- Volcado de datos para la tabla `casa`
--

INSERT INTO `casa` (`codi_casa`, `nomb_casa`, `dire_casa`, `codi_tipo_casa`, `logo_casa`, `esta_casa`) VALUES
(1, 'Universidad Don Bosco', 'San Salvador', 1, '5ce327891e610.jpg', 1),
(2, 'Instituto Tecnico Ricaldone', 'San Salvador', 2, '5cec3e6320b30.png', 1);

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
  `esta_curs` int(1) UNSIGNED NOT NULL DEFAULT '1',
  `cant_part` int(10) UNSIGNED NOT NULL,
  `mont_esti` varchar(10) COLLATE utf8mb4_spanish2_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_spanish2_ci;

--
-- Volcado de datos para la tabla `curso`
--

INSERT INTO `curso` (`codi_curs`, `codi_cate`, `codi_casa`, `nomb_curs`, `fech_inic`, `fech_fin`, `esta_curs`, `cant_part`, `mont_esti`) VALUES
(1, 2, 1, 'Curso Redes', '2019-02-04', '2019-07-12', 1, 12, '200'),
(2, 3, 1, 'Curso de CSS', '2019-01-28', '2019-12-13', 1, 50, '500'),
(3, 1, 1, 'XD', '2019-07-01', '2019-07-09', 4, 12, '12');

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

--
-- Volcado de datos para la tabla `docente`
--

INSERT INTO `docente` (`codi_doce`, `codi_casa`, `nomb_doce`, `apel_doce`, `esta_doce`) VALUES
(1, 1, 'Alirio', 'Quintanilla', 1),
(2, 1, 'Calixto', 'Rodriguez', 1),
(3, 1, 'Juan Jose', 'Martinez Gutierrez', 0),
(4, 1, 'Dwayne', 'Wadw', 0),
(5, 1, 'Alex', 'Morgan', 0),
(6, 1, 'Alex', 'Morgan', 0),
(7, 1, 'Morgan', 'Alex', 0),
(8, 1, 'Juan', 'Gomez', 0),
(9, 1, 'Juab', 'ZX', 0),
(10, 1, 'Jusn', 'SX', 0),
(11, 1, 'X', 'D', 0),
(12, 1, 'x', 's', 0),
(13, 1, 'Fernando', 'Carranza', 0),
(14, 1, 'Fernando', 'Carranza', 0),
(15, 1, 'Fernando', 'Carranza', 0),
(16, 1, 'Fernando', 'Carranza', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `factura`
--

CREATE TABLE `factura` (
  `codi_fact` int(11) UNSIGNED NOT NULL,
  `nume_fact` varchar(50) COLLATE utf8mb4_spanish2_ci NOT NULL,
  `fech_emis_fact` date NOT NULL,
  `fech_ingr` date NOT NULL,
  `arch_fact` varchar(500) COLLATE utf8mb4_spanish2_ci NOT NULL,
  `cant_fact` decimal(10,2) NOT NULL,
  `esta_fact` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_spanish2_ci;

--
-- Volcado de datos para la tabla `factura`
--

INSERT INTO `factura` (`codi_fact`, `nume_fact`, `fech_emis_fact`, `fech_ingr`, `arch_fact`, `cant_fact`, `esta_fact`) VALUES
(8, '298034', '2019-06-03', '2019-07-11', '5d26c88b73430.pdf', '300.00', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `factura_detalle`
--

CREATE TABLE `factura_detalle` (
  `codi_fact_deta` int(10) UNSIGNED NOT NULL,
  `codi_fact` int(10) UNSIGNED NOT NULL,
  `codi_curs` int(10) UNSIGNED NOT NULL,
  `esta_fact_deta` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_spanish2_ci;

--
-- Volcado de datos para la tabla `factura_detalle`
--

INSERT INTO `factura_detalle` (`codi_fact_deta`, `codi_fact`, `codi_curs`, `esta_fact_deta`) VALUES
(5, 8, 3, 1);

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

--
-- Volcado de datos para la tabla `horario`
--

INSERT INTO `horario` (`codi_hora`, `codi_dia`, `codi_casa`, `hora_inic`, `hora_fin`, `esta_hora`) VALUES
(1, 1, 1, '07:00:00', '09:15:00', 1),
(2, 1, 1, '09:30:00', '11:50:00', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `intermedia_acreditacion_docente`
--

CREATE TABLE `intermedia_acreditacion_docente` (
  `codi_inte_acre_doce` int(10) UNSIGNED NOT NULL,
  `codi_acre` int(10) UNSIGNED NOT NULL,
  `codi_doce` int(10) UNSIGNED NOT NULL,
  `esta_inte_acre_doce` int(10) UNSIGNED NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_spanish2_ci;

--
-- Volcado de datos para la tabla `intermedia_acreditacion_docente`
--

INSERT INTO `intermedia_acreditacion_docente` (`codi_inte_acre_doce`, `codi_acre`, `codi_doce`, `esta_inte_acre_doce`) VALUES
(1, 2, 1, 1),
(2, 1, 16, 1);

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

--
-- Volcado de datos para la tabla `intermedia_curso_salon`
--

INSERT INTO `intermedia_curso_salon` (`codi_inte_curs_salo`, `codi_curs`, `codi_salo`, `esta_inte_curs_salo`) VALUES
(1, 1, 1, 1),
(3, 1, 1, 1),
(4, 2, 2, 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `intermedia_docente_profesion`
--

CREATE TABLE `intermedia_docente_profesion` (
  `codi_inte_doce_prof` int(10) UNSIGNED NOT NULL,
  `codi_prof` int(10) UNSIGNED NOT NULL,
  `codi_doce` int(10) UNSIGNED NOT NULL,
  `esta_inte_doce_prof` int(10) UNSIGNED NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_spanish2_ci;

--
-- Volcado de datos para la tabla `intermedia_docente_profesion`
--

INSERT INTO `intermedia_docente_profesion` (`codi_inte_doce_prof`, `codi_prof`, `codi_doce`, `esta_inte_doce_prof`) VALUES
(1, 1, 1, 1),
(2, 1, 16, 1);

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

--
-- Volcado de datos para la tabla `intermedia_horario_docente`
--

INSERT INTO `intermedia_horario_docente` (`codi_inte_hora_doce`, `codi_inte_curs_salo`, `codi_hora`, `codi_doce`, `esta_inte_hora_doce`) VALUES
(1, 1, 1, 2, 1),
(2, 3, 2, 2, 1),
(3, 4, 1, 1, 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `notificaciones`
--

CREATE TABLE `notificaciones` (
  `codi_noti` int(10) UNSIGNED NOT NULL,
  `codi_casa` int(10) UNSIGNED NOT NULL,
  `codi_emis` int(10) UNSIGNED NOT NULL,
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

--
-- Volcado de datos para la tabla `presupuesto`
--

INSERT INTO `presupuesto` (`codi_pres`, `codi_casa`, `codi_usua`, `cant_pres`, `fech_pres`) VALUES
(2, 1, 1, '3000.00', '2019-05-27');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `presupuesto_detalle`
--

CREATE TABLE `presupuesto_detalle` (
  `codi_pres_deta` int(10) UNSIGNED NOT NULL,
  `codi_pres` int(10) UNSIGNED NOT NULL,
  `codi_usua` int(10) UNSIGNED NOT NULL,
  `codi_cate` int(10) UNSIGNED NOT NULL,
  `cant_pres_deta` decimal(10,2) NOT NULL,
  `fech_pres_deta` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_spanish2_ci;

--
-- Volcado de datos para la tabla `presupuesto_detalle`
--

INSERT INTO `presupuesto_detalle` (`codi_pres_deta`, `codi_pres`, `codi_usua`, `codi_cate`, `cant_pres_deta`, `fech_pres_deta`) VALUES
(1, 2, 1, 1, '200.00', '2019-05-27'),
(2, 2, 1, 2, '800.00', '2019-07-09');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `profesion`
--

CREATE TABLE `profesion` (
  `codi_prof` int(10) UNSIGNED NOT NULL,
  `nomb_prof` varchar(150) COLLATE utf8mb4_spanish2_ci NOT NULL,
  `esta_prof` int(10) UNSIGNED NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_spanish2_ci;

--
-- Volcado de datos para la tabla `profesion`
--

INSERT INTO `profesion` (`codi_prof`, `nomb_prof`, `esta_prof`) VALUES
(1, 'Ingeniero en Ciencias de la Computación', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `quedan_detalle`
--

CREATE TABLE `quedan_detalle` (
  `codi_qued_deta` int(10) UNSIGNED NOT NULL,
  `codi_qued` int(10) UNSIGNED NOT NULL,
  `codi_pres_deta` int(10) UNSIGNED NOT NULL,
  `esta_qued_deta` int(10) UNSIGNED NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_spanish2_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `quedan_maestro`
--

CREATE TABLE `quedan_maestro` (
  `codi_qued` int(10) UNSIGNED NOT NULL,
  `nume_qued` varchar(20) COLLATE utf8mb4_spanish2_ci NOT NULL,
  `fech_emis` date NOT NULL,
  `cant_fact` int(5) UNSIGNED NOT NULL,
  `arch_qued` varchar(500) COLLATE utf8mb4_spanish2_ci NOT NULL,
  `fech_ing` date NOT NULL,
  `esta_qued` int(10) UNSIGNED NOT NULL DEFAULT '1'
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

--
-- Volcado de datos para la tabla `salon`
--

INSERT INTO `salon` (`codi_salo`, `codi_casa`, `nomb_salo`, `esta_salo`) VALUES
(1, 1, 'C33', 1),
(2, 1, 'C32', 1);

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
-- Volcado de datos para la tabla `usuario`
--

INSERT INTO `usuario` (`codi_usua`, `nomb_usua`, `apel_usua`, `corre_usua`, `cont_usua`, `codi_casa`, `codi_tipo_usua`, `esta_usua`) VALUES
(1, 'Fernando Ernesto', 'Carranza Guardado', 'carranzafernando99@gmail.com', '$2y$10$tcgOMpnucTJ7C9Eum8cO.OqM4vUzb8XehiBXlyhWF4gbzsG3qbTky', 1, 1, 1),
(2, 'Luis Gerardo', 'Diaz Ventura', 'foreverfas_fc@hotmail.com', '$2y$10$SEYz6DC/EgqW11L.FVtE8u8B/rsEqobXvBW.qIstvuHtagnU7UitK', 2, 1, 1);

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `acreditacion`
--
ALTER TABLE `acreditacion`
  ADD PRIMARY KEY (`codi_acre`);

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
-- Indices de la tabla `factura`
--
ALTER TABLE `factura`
  ADD PRIMARY KEY (`codi_fact`);

--
-- Indices de la tabla `factura_detalle`
--
ALTER TABLE `factura_detalle`
  ADD PRIMARY KEY (`codi_fact_deta`),
  ADD KEY `fk-factura-facturaDetalle` (`codi_fact`),
  ADD KEY `fk-curso-facturaDetalle` (`codi_curs`);

--
-- Indices de la tabla `horario`
--
ALTER TABLE `horario`
  ADD PRIMARY KEY (`codi_hora`);

--
-- Indices de la tabla `intermedia_acreditacion_docente`
--
ALTER TABLE `intermedia_acreditacion_docente`
  ADD PRIMARY KEY (`codi_inte_acre_doce`),
  ADD KEY `fk-acreditacion-intermedia` (`codi_acre`),
  ADD KEY `fk-docente-intermedia` (`codi_doce`);

--
-- Indices de la tabla `intermedia_curso_salon`
--
ALTER TABLE `intermedia_curso_salon`
  ADD PRIMARY KEY (`codi_inte_curs_salo`),
  ADD KEY `fk-intermedia_salon` (`codi_salo`),
  ADD KEY `fk-intermedia-curso` (`codi_curs`);

--
-- Indices de la tabla `intermedia_docente_profesion`
--
ALTER TABLE `intermedia_docente_profesion`
  ADD PRIMARY KEY (`codi_inte_doce_prof`),
  ADD KEY `codi_doce` (`codi_doce`),
  ADD KEY `codi_prof` (`codi_prof`);

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
-- Indices de la tabla `profesion`
--
ALTER TABLE `profesion`
  ADD PRIMARY KEY (`codi_prof`);

--
-- Indices de la tabla `quedan_detalle`
--
ALTER TABLE `quedan_detalle`
  ADD PRIMARY KEY (`codi_qued_deta`),
  ADD KEY `fk-queda-detalle` (`codi_qued`),
  ADD KEY `fk-queda-presupuesto` (`codi_pres_deta`);

--
-- Indices de la tabla `quedan_maestro`
--
ALTER TABLE `quedan_maestro`
  ADD PRIMARY KEY (`codi_qued`);

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
-- AUTO_INCREMENT de la tabla `acreditacion`
--
ALTER TABLE `acreditacion`
  MODIFY `codi_acre` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de la tabla `casa`
--
ALTER TABLE `casa`
  MODIFY `codi_casa` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de la tabla `categoria`
--
ALTER TABLE `categoria`
  MODIFY `codi_cate` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de la tabla `curso`
--
ALTER TABLE `curso`
  MODIFY `codi_curs` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de la tabla `docente`
--
ALTER TABLE `docente`
  MODIFY `codi_doce` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT de la tabla `factura`
--
ALTER TABLE `factura`
  MODIFY `codi_fact` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT de la tabla `factura_detalle`
--
ALTER TABLE `factura_detalle`
  MODIFY `codi_fact_deta` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT de la tabla `horario`
--
ALTER TABLE `horario`
  MODIFY `codi_hora` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de la tabla `intermedia_acreditacion_docente`
--
ALTER TABLE `intermedia_acreditacion_docente`
  MODIFY `codi_inte_acre_doce` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de la tabla `intermedia_curso_salon`
--
ALTER TABLE `intermedia_curso_salon`
  MODIFY `codi_inte_curs_salo` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT de la tabla `intermedia_docente_profesion`
--
ALTER TABLE `intermedia_docente_profesion`
  MODIFY `codi_inte_doce_prof` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de la tabla `intermedia_horario_docente`
--
ALTER TABLE `intermedia_horario_docente`
  MODIFY `codi_inte_hora_doce` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de la tabla `notificaciones`
--
ALTER TABLE `notificaciones`
  MODIFY `codi_noti` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `presupuesto`
--
ALTER TABLE `presupuesto`
  MODIFY `codi_pres` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de la tabla `presupuesto_detalle`
--
ALTER TABLE `presupuesto_detalle`
  MODIFY `codi_pres_deta` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de la tabla `profesion`
--
ALTER TABLE `profesion`
  MODIFY `codi_prof` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de la tabla `quedan_detalle`
--
ALTER TABLE `quedan_detalle`
  MODIFY `codi_qued_deta` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `quedan_maestro`
--
ALTER TABLE `quedan_maestro`
  MODIFY `codi_qued` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `salon`
--
ALTER TABLE `salon`
  MODIFY `codi_salo` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

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
  MODIFY `codi_usua` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

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
-- Filtros para la tabla `factura_detalle`
--
ALTER TABLE `factura_detalle`
  ADD CONSTRAINT `fk-curso-facturaDetalle` FOREIGN KEY (`codi_curs`) REFERENCES `curso` (`codi_curs`),
  ADD CONSTRAINT `fk-factura-facturaDetalle` FOREIGN KEY (`codi_fact`) REFERENCES `factura` (`codi_fact`);

--
-- Filtros para la tabla `intermedia_acreditacion_docente`
--
ALTER TABLE `intermedia_acreditacion_docente`
  ADD CONSTRAINT `fk-acreditacion-intermedia` FOREIGN KEY (`codi_acre`) REFERENCES `acreditacion` (`codi_acre`),
  ADD CONSTRAINT `fk-docente-intermedia` FOREIGN KEY (`codi_doce`) REFERENCES `docente` (`codi_doce`);

--
-- Filtros para la tabla `intermedia_curso_salon`
--
ALTER TABLE `intermedia_curso_salon`
  ADD CONSTRAINT `fk-intermedia-curso` FOREIGN KEY (`codi_curs`) REFERENCES `curso` (`codi_curs`) ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk-intermedia_salon` FOREIGN KEY (`codi_salo`) REFERENCES `salon` (`codi_salo`);

--
-- Filtros para la tabla `intermedia_docente_profesion`
--
ALTER TABLE `intermedia_docente_profesion`
  ADD CONSTRAINT `fk-docente-inter` FOREIGN KEY (`codi_doce`) REFERENCES `docente` (`codi_doce`),
  ADD CONSTRAINT `fk-profesion-inter` FOREIGN KEY (`codi_prof`) REFERENCES `profesion` (`codi_prof`);

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
-- Filtros para la tabla `quedan_detalle`
--
ALTER TABLE `quedan_detalle`
  ADD CONSTRAINT `fk-queda-detalle` FOREIGN KEY (`codi_qued`) REFERENCES `quedan_maestro` (`codi_qued`),
  ADD CONSTRAINT `fk-queda-presupuesto` FOREIGN KEY (`codi_pres_deta`) REFERENCES `presupuesto_detalle` (`codi_pres_deta`);

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
