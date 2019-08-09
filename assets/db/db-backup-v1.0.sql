-- phpMyAdmin SQL Dump
-- version 4.6.5.2
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 09-08-2019 a las 17:59:03
-- Versión del servidor: 10.1.21-MariaDB
-- Versión de PHP: 5.6.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `fies2018`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `accesorio`
--

CREATE TABLE `accesorio` (
  `idAccesorioGlobal` int(11) NOT NULL,
  `idAccesorio` int(11) DEFAULT NULL,
  `accesorio` varchar(50) COLLATE utf32_spanish_ci NOT NULL,
  `idEquipo` int(11) NOT NULL,
  `idEquipoGlobal` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf32 COLLATE=utf32_spanish_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `analisis_condamb`
--

CREATE TABLE `analisis_condamb` (
  `idMedicionGlobal` int(11) DEFAULT NULL,
  `idMedicion` int(11) DEFAULT NULL,
  `idHospital` int(11) DEFAULT NULL,
  `idArea` int(11) DEFAULT NULL,
  `idParametro` int(11) DEFAULT NULL,
  `promedio` float DEFAULT NULL,
  `magnitud` varchar(10) COLLATE utf8_spanish2_ci DEFAULT NULL,
  `cumple` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish2_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `analisis_recelec`
--

CREATE TABLE `analisis_recelec` (
  `idMedicionGlobal` int(11) NOT NULL,
  `idMedicion` int(11) NOT NULL,
  `idHospital` int(11) DEFAULT NULL,
  `idArea` int(11) DEFAULT NULL,
  `polaridad` float DEFAULT NULL,
  `vfaseneutro` float DEFAULT NULL,
  `vneutrotierra` float DEFAULT NULL,
  `vfasetierra` float DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish2_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `area`
--

CREATE TABLE `area` (
  `idArea` int(11) NOT NULL,
  `nombreArea` varchar(25) COLLATE utf32_spanish_ci NOT NULL,
  `plano` blob,
  `idHospital` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf32 COLLATE=utf32_spanish_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `clase`
--

CREATE TABLE `clase` (
  `idClase` int(11) NOT NULL,
  `clase` text COLLATE utf32_spanish_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf32 COLLATE=utf32_spanish_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `equipo`
--

CREATE TABLE `equipo` (
  `idEquipoGlobal` int(11) NOT NULL,
  `idEquipo` int(11) DEFAULT NULL,
  `marca` varchar(25) COLLATE utf32_spanish_ci NOT NULL,
  `modelo` varchar(25) COLLATE utf32_spanish_ci NOT NULL,
  `serie` varchar(25) COLLATE utf32_spanish_ci DEFAULT NULL,
  `fechaCalibracion` date DEFAULT NULL,
  `numeroInventario` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf32 COLLATE=utf32_spanish_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `equipoanalizado`
--

CREATE TABLE `equipoanalizado` (
  `idEquipoAnalizadoGlobal` int(11) NOT NULL,
  `idEquipoAnalizado` int(11) DEFAULT NULL,
  `nombre` text COLLATE utf32_spanish_ci,
  `marca` text COLLATE utf32_spanish_ci,
  `modelo` text COLLATE utf32_spanish_ci,
  `ns` text COLLATE utf32_spanish_ci,
  `ninventario` text COLLATE utf32_spanish_ci,
  `idClase` int(11) DEFAULT NULL,
  `idTipo` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf32 COLLATE=utf32_spanish_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `hospital`
--

CREATE TABLE `hospital` (
  `idHospital` int(11) NOT NULL,
  `nombre` varchar(50) COLLATE utf32_spanish_ci NOT NULL,
  `direccion` varchar(200) COLLATE utf32_spanish_ci DEFAULT NULL,
  `idMunicipio` int(11) NOT NULL,
  `seudo` varchar(25) COLLATE utf32_spanish_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf32 COLLATE=utf32_spanish_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `medicion`
--

CREATE TABLE `medicion` (
  `idMedicionGlobal` int(11) NOT NULL,
  `idMedicion` int(11) DEFAULT NULL,
  `servicioAnalizado` varchar(50) COLLATE utf32_spanish_ci DEFAULT NULL,
  `responsable` varchar(100) COLLATE utf32_spanish_ci DEFAULT NULL,
  `telefono` varchar(20) COLLATE utf32_spanish_ci DEFAULT NULL,
  `idArea` int(11) NOT NULL,
  `idUsuario` int(11) NOT NULL,
  `fecha` datetime DEFAULT CURRENT_TIMESTAMP,
  `comentario` varchar(300) COLLATE utf32_spanish_ci DEFAULT NULL,
  `fecha2` varchar(25) COLLATE utf32_spanish_ci DEFAULT NULL,
  `hora` varchar(25) COLLATE utf32_spanish_ci DEFAULT NULL,
  `fechasincro` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf32 COLLATE=utf32_spanish_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `medicionelec`
--

CREATE TABLE `medicionelec` (
  `medicionElecGlobal` int(11) NOT NULL,
  `id` int(11) DEFAULT NULL,
  `id_segelectrica` int(11) DEFAULT NULL,
  `id_bloque` int(11) DEFAULT NULL,
  `id_pregunta` int(11) DEFAULT NULL,
  `medicion` double DEFAULT NULL,
  `estandar` double DEFAULT NULL,
  `magnitud` text COLLATE utf32_spanish_ci,
  `comentario` text COLLATE utf32_spanish_ci,
  `valoracion` varchar(500) COLLATE utf32_spanish_ci DEFAULT NULL,
  `idSegElectricaGlobal` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf32 COLLATE=utf32_spanish_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `municipio`
--

CREATE TABLE `municipio` (
  `idMunicipio` int(11) NOT NULL,
  `municipio` varchar(30) COLLATE utf32_spanish_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf32 COLLATE=utf32_spanish_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `mxe`
--

CREATE TABLE `mxe` (
  `idMxeGlobal` int(11) NOT NULL,
  `idmxe` int(11) DEFAULT NULL,
  `idMedicion` int(11) NOT NULL,
  `idEquipo` int(11) NOT NULL,
  `idMedicionGlobal` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf32 COLLATE=utf32_spanish_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `segelecpreguntas`
--

CREATE TABLE `segelecpreguntas` (
  `id` int(11) NOT NULL,
  `tipo_pregunta` int(11) NOT NULL,
  `pregunta` text COLLATE utf32_spanish_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf32 COLLATE=utf32_spanish_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `segelectrica`
--

CREATE TABLE `segelectrica` (
  `idSegElectricaGlobal` int(11) NOT NULL,
  `idSegElectrica` int(11) DEFAULT NULL,
  `servicioAnalizado` text COLLATE utf32_spanish_ci,
  `responsable` text COLLATE utf32_spanish_ci,
  `idHospital` int(11) DEFAULT NULL,
  `idEquipoAnalizado` int(11) DEFAULT NULL,
  `fecha` datetime DEFAULT NULL,
  `idUsuario` int(11) DEFAULT NULL,
  `fecha2` varchar(50) COLLATE utf32_spanish_ci DEFAULT NULL,
  `hora` varchar(50) COLLATE utf32_spanish_ci DEFAULT NULL,
  `comentario` varchar(200) COLLATE utf32_spanish_ci DEFAULT NULL,
  `idEquipoAnalizadoGlobal` int(11) DEFAULT NULL,
  `fechasincro` timestamp NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf32 COLLATE=utf32_spanish_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `subvariable`
--

CREATE TABLE `subvariable` (
  `idSubVariableGlobal` int(11) NOT NULL,
  `idSubVariable` int(11) DEFAULT NULL,
  `idVariable` int(11) NOT NULL,
  `polaridad` float DEFAULT NULL,
  `vfaseneutro` float DEFAULT NULL,
  `vneutrotierra` float DEFAULT NULL,
  `vfasetierra` float DEFAULT NULL,
  `comentario` varchar(500) COLLATE utf32_spanish_ci DEFAULT NULL,
  `idVariableGlobal` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf32 COLLATE=utf32_spanish_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `sxe`
--

CREATE TABLE `sxe` (
  `idsxeGlobal` int(11) NOT NULL,
  `idsxe` int(11) DEFAULT NULL,
  `idEquipo` int(11) DEFAULT NULL,
  `idSegElectrica` int(11) DEFAULT NULL,
  `idSegElectricaGlobal` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf32 COLLATE=utf32_spanish_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tipo`
--

CREATE TABLE `tipo` (
  `idTipo` int(11) NOT NULL,
  `tipo` text COLLATE utf32_spanish_ci
) ENGINE=InnoDB DEFAULT CHARSET=utf32 COLLATE=utf32_spanish_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `universidad`
--

CREATE TABLE `universidad` (
  `idUniversidad` int(11) NOT NULL,
  `universidad` varchar(100) COLLATE utf32_spanish_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf32 COLLATE=utf32_spanish_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuario`
--

CREATE TABLE `usuario` (
  `idUsuario` int(11) DEFAULT NULL,
  `nick` varchar(15) COLLATE utf32_spanish_ci DEFAULT NULL,
  `pass` varchar(15) COLLATE utf32_spanish_ci DEFAULT NULL,
  `nombre` varchar(100) COLLATE utf32_spanish_ci DEFAULT NULL,
  `correo` varchar(100) COLLATE utf32_spanish_ci DEFAULT NULL,
  `idUniversidad` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf32 COLLATE=utf32_spanish_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `variable`
--

CREATE TABLE `variable` (
  `idVariableGlobal` int(11) NOT NULL,
  `idVariable` int(11) DEFAULT NULL,
  `idMedicion` int(11) NOT NULL,
  `valor` float DEFAULT NULL,
  `tipo` int(11) NOT NULL,
  `cumple` tinyint(4) DEFAULT NULL,
  `comentario` varchar(500) COLLATE utf32_spanish_ci DEFAULT NULL,
  `idMedicionGlobal` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf32 COLLATE=utf32_spanish_ci;

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `accesorio`
--
ALTER TABLE `accesorio`
  ADD PRIMARY KEY (`idAccesorioGlobal`);

--
-- Indices de la tabla `area`
--
ALTER TABLE `area`
  ADD PRIMARY KEY (`idArea`);

--
-- Indices de la tabla `clase`
--
ALTER TABLE `clase`
  ADD PRIMARY KEY (`idClase`);

--
-- Indices de la tabla `equipo`
--
ALTER TABLE `equipo`
  ADD PRIMARY KEY (`idEquipoGlobal`);

--
-- Indices de la tabla `equipoanalizado`
--
ALTER TABLE `equipoanalizado`
  ADD PRIMARY KEY (`idEquipoAnalizadoGlobal`);

--
-- Indices de la tabla `hospital`
--
ALTER TABLE `hospital`
  ADD PRIMARY KEY (`idHospital`);

--
-- Indices de la tabla `medicion`
--
ALTER TABLE `medicion`
  ADD PRIMARY KEY (`idMedicionGlobal`);

--
-- Indices de la tabla `medicionelec`
--
ALTER TABLE `medicionelec`
  ADD PRIMARY KEY (`medicionElecGlobal`);

--
-- Indices de la tabla `municipio`
--
ALTER TABLE `municipio`
  ADD PRIMARY KEY (`idMunicipio`);

--
-- Indices de la tabla `mxe`
--
ALTER TABLE `mxe`
  ADD PRIMARY KEY (`idMxeGlobal`);

--
-- Indices de la tabla `segelecpreguntas`
--
ALTER TABLE `segelecpreguntas`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `segelectrica`
--
ALTER TABLE `segelectrica`
  ADD PRIMARY KEY (`idSegElectricaGlobal`);

--
-- Indices de la tabla `subvariable`
--
ALTER TABLE `subvariable`
  ADD PRIMARY KEY (`idSubVariableGlobal`);

--
-- Indices de la tabla `sxe`
--
ALTER TABLE `sxe`
  ADD PRIMARY KEY (`idsxeGlobal`);

--
-- Indices de la tabla `tipo`
--
ALTER TABLE `tipo`
  ADD PRIMARY KEY (`idTipo`);

--
-- Indices de la tabla `universidad`
--
ALTER TABLE `universidad`
  ADD PRIMARY KEY (`idUniversidad`);

--
-- Indices de la tabla `variable`
--
ALTER TABLE `variable`
  ADD PRIMARY KEY (`idVariableGlobal`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `accesorio`
--
ALTER TABLE `accesorio`
  MODIFY `idAccesorioGlobal` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=67;
--
-- AUTO_INCREMENT de la tabla `area`
--
ALTER TABLE `area`
  MODIFY `idArea` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
--
-- AUTO_INCREMENT de la tabla `clase`
--
ALTER TABLE `clase`
  MODIFY `idClase` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT de la tabla `equipo`
--
ALTER TABLE `equipo`
  MODIFY `idEquipoGlobal` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=175;
--
-- AUTO_INCREMENT de la tabla `equipoanalizado`
--
ALTER TABLE `equipoanalizado`
  MODIFY `idEquipoAnalizadoGlobal` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;
--
-- AUTO_INCREMENT de la tabla `hospital`
--
ALTER TABLE `hospital`
  MODIFY `idHospital` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT de la tabla `medicion`
--
ALTER TABLE `medicion`
  MODIFY `idMedicionGlobal` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=96;
--
-- AUTO_INCREMENT de la tabla `medicionelec`
--
ALTER TABLE `medicionelec`
  MODIFY `medicionElecGlobal` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=89;
--
-- AUTO_INCREMENT de la tabla `municipio`
--
ALTER TABLE `municipio`
  MODIFY `idMunicipio` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT de la tabla `mxe`
--
ALTER TABLE `mxe`
  MODIFY `idMxeGlobal` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=129;
--
-- AUTO_INCREMENT de la tabla `segelectrica`
--
ALTER TABLE `segelectrica`
  MODIFY `idSegElectricaGlobal` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;
--
-- AUTO_INCREMENT de la tabla `subvariable`
--
ALTER TABLE `subvariable`
  MODIFY `idSubVariableGlobal` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=60;
--
-- AUTO_INCREMENT de la tabla `sxe`
--
ALTER TABLE `sxe`
  MODIFY `idsxeGlobal` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;
--
-- AUTO_INCREMENT de la tabla `tipo`
--
ALTER TABLE `tipo`
  MODIFY `idTipo` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT de la tabla `universidad`
--
ALTER TABLE `universidad`
  MODIFY `idUniversidad` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT de la tabla `variable`
--
ALTER TABLE `variable`
  MODIFY `idVariableGlobal` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=441;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
