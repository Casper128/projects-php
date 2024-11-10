-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 26-06-2022 a las 04:53:37
-- Versión del servidor: 10.4.22-MariaDB
-- Versión de PHP: 8.0.15

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `sisevid`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `articulos`
--

CREATE TABLE `articulos` (
  `ID_ARTICULO` int(11) NOT NULL,
  `ARTICULO` varchar(45) DEFAULT NULL,
  `FK_CAPITULO_ID_ARTICULO` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `asignatura`
--

CREATE TABLE `asignatura` (
  `IDASIGNATURA` int(11) NOT NULL,
  `NOMBRE` varchar(45) DEFAULT NULL,
  `PERIODO` varchar(45) DEFAULT NULL,
  `CREDITOS` int(10) NOT NULL,
  `HRSINDEPENDIENTE` int(11) NOT NULL,
  `FK_ID_PROGRAMA_ASIGNATURA` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `asignatura`
--

INSERT INTO `asignatura` (`IDASIGNATURA`, `NOMBRE`, `PERIODO`, `CREDITOS`, `HRSINDEPENDIENTE`, `FK_ID_PROGRAMA_ASIGNATURA`) VALUES
(10213, 'Desarrollo', '2', 30, 2022, 1234);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `campus`
--

CREATE TABLE `campus` (
  `idCampus` int(11) NOT NULL,
  `NombreCampus` varchar(45) DEFAULT NULL,
  `NumEquiposComputo` int(11) DEFAULT NULL,
  `fk_Id_Facultad_Campus` int(11) NOT NULL,
  `AreasCubiertas` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `capitulo`
--

CREATE TABLE `capitulo` (
  `IDCAPITULO` int(11) NOT NULL,
  `CAPITULO` varchar(45) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `capitulo`
--

INSERT INTO `capitulo` (`IDCAPITULO`, `CAPITULO`) VALUES
(1, 'Descripcion Capitulo 1'),
(2, 'Descripcion capitulo 2');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `capitulo_evidencias`
--

CREATE TABLE `capitulo_evidencias` (
  `FK_CAPITULO_ID_EVIDENCIAS` int(11) NOT NULL,
  `FK_EVIDENCIAS_ID_CAPITULO` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `capitulo_evidencias`
--

INSERT INTO `capitulo_evidencias` (`FK_CAPITULO_ID_EVIDENCIAS`, `FK_EVIDENCIAS_ID_CAPITULO`) VALUES
(1, 1),
(1, 2),
(2, 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `egresado`
--

CREATE TABLE `egresado` (
  `idEgresados(Cc)` int(11) NOT NULL,
  `NombreEgresado` varchar(45) DEFAULT NULL,
  `ActividadProfesional` varchar(45) DEFAULT NULL,
  `FechaEgreso` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `egresado_facultad`
--

CREATE TABLE `egresado_facultad` (
  `FK_FACULTAD_ID_EGRESADO` int(11) NOT NULL,
  `FK_EGRESADO_ID_FACULTAD` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `estudiante`
--

CREATE TABLE `estudiante` (
  `CEDULA` int(11) NOT NULL,
  `NOMBRE` varchar(45) DEFAULT NULL,
  `ESTRATO` int(11) NOT NULL,
  `ICFES` varchar(45) DEFAULT NULL,
  `FECHAINGRESO` date DEFAULT NULL,
  `EMAIL` varchar(45) DEFAULT NULL,
  `Asignatura_idAsignatura` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `estudiante`
--

INSERT INTO `estudiante` (`CEDULA`, `NOMBRE`, `ESTRATO`, `ICFES`, `FECHAINGRESO`, `EMAIL`, `Asignatura_idAsignatura`) VALUES
(1017230626, 'Edwin', 2, '21885', '2022-04-05', 'manu.1022128@hotmail.es', 0),
(1017230627, 'kevin', 2, '5', '2022-05-13', 'bboy128@hotmail.com', 0),
(1017241226, 'Darwin', 2, '95', '2022-03-18', 'daoo128@hotmail.com', 0);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `estudiantes_asignaturas`
--

CREATE TABLE `estudiantes_asignaturas` (
  `FK_ESTUDIANTE_ID_ASIGNATURA` int(10) NOT NULL,
  `FK_ASIGANTURA_ID_ESTUDIANTE` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `estudiantes_evidencias`
--

CREATE TABLE `estudiantes_evidencias` (
  `FK_ESTUDIANTE_ID_EVIDENCIAS` int(11) NOT NULL,
  `FK_EVIDENCIAS_ID_ESTUDIANTE` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `estudiantes_evidencias`
--

INSERT INTO `estudiantes_evidencias` (`FK_ESTUDIANTE_ID_EVIDENCIAS`, `FK_EVIDENCIAS_ID_ESTUDIANTE`) VALUES
(1, 1017230626),
(1, 1017230627),
(1, 1017230626),
(1, 1017230627),
(2, 1017230626);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `evidencia`
--

CREATE TABLE `evidencia` (
  `IDEVIDENCIA` int(11) NOT NULL,
  `TIPOEVIDENCIA` varchar(45) DEFAULT NULL,
  `EVIDENCIA` varchar(45) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `evidencia`
--

INSERT INTO `evidencia` (`IDEVIDENCIA`, `TIPOEVIDENCIA`, `EVIDENCIA`) VALUES
(1, 'Examen 80%', 'IMG_0024.jpg'),
(2, 'Examen', 'IMG_0020(Edited).jpg');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `facultad`
--

CREATE TABLE `facultad` (
  `IDFACULTAD` int(11) NOT NULL,
  `FACULTAD` varchar(45) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `facultad`
--

INSERT INTO `facultad` (`IDFACULTAD`, `FACULTAD`) VALUES
(1, 'Floresta'),
(123, 'Robledo'),
(1234, 'Boston');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `literales`
--

CREATE TABLE `literales` (
  `idLiterales` int(11) NOT NULL,
  `Literales` varchar(45) DEFAULT NULL,
  `Articulo_idArticulo` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `numerales`
--

CREATE TABLE `numerales` (
  `idNumerales` int(11) NOT NULL,
  `Numerales` varchar(45) DEFAULT NULL,
  `FK_LITERAL_ID_NUMERAL` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `profesor`
--

CREATE TABLE `profesor` (
  `CEDULA` int(11) NOT NULL,
  `NOMBRE` varchar(45) DEFAULT NULL,
  `TITULO` varchar(45) DEFAULT NULL,
  `EMAIL` varchar(45) NOT NULL,
  `VINCULACION_IDPROFESOR` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `profesor`
--

INSERT INTO `profesor` (`CEDULA`, `NOMBRE`, `TITULO`, `EMAIL`, `VINCULACION_IDPROFESOR`) VALUES
(1015131561, 'kevin', 'Profesor de catedra', 'bboy128@hotmail.com', 2),
(1017230626, '	Darwin', 'Tecnologo Desarrollo', '	bboy128@hotmail.com', 1),
(1017230627, 'Manuela', 'Profesor', 'bboy128@hotmail.com', 1),
(1017241226, 'Manuela', 'Profesor', 'bboy128@hotmail.com', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `profesor_asignaturas`
--

CREATE TABLE `profesor_asignaturas` (
  `FK_PROFESOR_ID_ASIGNATURA` int(11) NOT NULL,
  `FK_ASIGNATURA_ID_PROFESOR` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `profesor_evidencias`
--

CREATE TABLE `profesor_evidencias` (
  `FK_PROFESOR_ID_EVIDENCIA` int(11) NOT NULL,
  `FK_EVIDENCIA_ID_PROFESOR` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `profesor_evidencias`
--

INSERT INTO `profesor_evidencias` (`FK_PROFESOR_ID_EVIDENCIA`, `FK_EVIDENCIA_ID_PROFESOR`) VALUES
(1, 1015131561),
(1, 1017230626),
(2, 1015131561);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `programa`
--

CREATE TABLE `programa` (
  `IDPROGRAMA` int(11) NOT NULL,
  `PROGRAMA` varchar(45) DEFAULT NULL,
  `NIVELEDUCATIVO` varchar(45) DEFAULT NULL,
  `FK_ID_FACULTAD_PROGRAMA` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `programa`
--

INSERT INTO `programa` (`IDPROGRAMA`, `PROGRAMA`, `NIVELEDUCATIVO`, `FK_ID_FACULTAD_PROGRAMA`) VALUES
(1234, 'Sistemas', 'Tecnologo', 1),
(12345, 'perro', 'Tecnologo', 1),
(1017230626, 'Sistemas de informacion', 'Tecnologo', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuarios`
--

CREATE TABLE `usuarios` (
  `IDUSUARIO` int(11) NOT NULL,
  `Usuario` varchar(16) NOT NULL,
  `contrasena` varchar(32) NOT NULL,
  `NivelAcceso` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `usuarios`
--

INSERT INTO `usuarios` (`IDUSUARIO`, `Usuario`, `contrasena`, `NivelAcceso`) VALUES
(1, 'admin', 'admin', 1),
(2, 'mecanico', 'carro', 2),
(3, 'produccion', 'contrasena', 3);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `vinculacion`
--

CREATE TABLE `vinculacion` (
  `IDVINCULACION` int(11) NOT NULL,
  `VINCULACION` varchar(45) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `vinculacion`
--

INSERT INTO `vinculacion` (`IDVINCULACION`, `VINCULACION`) VALUES
(1, 'Contrato termino fijo'),
(2, 'Contrato por prestacion de servicios');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `articulos`
--
ALTER TABLE `articulos`
  ADD PRIMARY KEY (`ID_ARTICULO`),
  ADD KEY `FK_CAPITULO_ID_ARTICULO` (`FK_CAPITULO_ID_ARTICULO`);

--
-- Indices de la tabla `asignatura`
--
ALTER TABLE `asignatura`
  ADD PRIMARY KEY (`IDASIGNATURA`),
  ADD KEY `fk_Id_Programa_Asignatura` (`FK_ID_PROGRAMA_ASIGNATURA`);

--
-- Indices de la tabla `campus`
--
ALTER TABLE `campus`
  ADD PRIMARY KEY (`idCampus`),
  ADD KEY `fk_Id_Facultad_Campus` (`fk_Id_Facultad_Campus`);

--
-- Indices de la tabla `capitulo`
--
ALTER TABLE `capitulo`
  ADD PRIMARY KEY (`IDCAPITULO`);

--
-- Indices de la tabla `capitulo_evidencias`
--
ALTER TABLE `capitulo_evidencias`
  ADD KEY `FK_CAPITULO_ID_EVIDENCIA` (`FK_CAPITULO_ID_EVIDENCIAS`),
  ADD KEY `FK_EVIDENCIA_ID_CAPITULO` (`FK_EVIDENCIAS_ID_CAPITULO`);

--
-- Indices de la tabla `egresado`
--
ALTER TABLE `egresado`
  ADD PRIMARY KEY (`idEgresados(Cc)`);

--
-- Indices de la tabla `egresado_facultad`
--
ALTER TABLE `egresado_facultad`
  ADD KEY `FK_EGRESADO_ID_FACULTAD` (`FK_FACULTAD_ID_EGRESADO`),
  ADD KEY `FK_FACULTAD_ID_EGRESADO` (`FK_EGRESADO_ID_FACULTAD`);

--
-- Indices de la tabla `estudiante`
--
ALTER TABLE `estudiante`
  ADD PRIMARY KEY (`CEDULA`),
  ADD KEY `fk_Estudiante_Asignatura1_idx` (`Asignatura_idAsignatura`);

--
-- Indices de la tabla `estudiantes_asignaturas`
--
ALTER TABLE `estudiantes_asignaturas`
  ADD KEY `FK_ASIGNATURA_ID_ESTUDIANTES` (`FK_ASIGANTURA_ID_ESTUDIANTE`),
  ADD KEY `FK_ESTUDIANTE_ID_ASIGNATURA` (`FK_ESTUDIANTE_ID_ASIGNATURA`);

--
-- Indices de la tabla `estudiantes_evidencias`
--
ALTER TABLE `estudiantes_evidencias`
  ADD KEY `FK_ESTUDIANTE_ID_EVIDENCIA` (`FK_ESTUDIANTE_ID_EVIDENCIAS`),
  ADD KEY `FK_EVIDENCIA_ID_ESTUDIANTE` (`FK_EVIDENCIAS_ID_ESTUDIANTE`);

--
-- Indices de la tabla `evidencia`
--
ALTER TABLE `evidencia`
  ADD PRIMARY KEY (`IDEVIDENCIA`);

--
-- Indices de la tabla `facultad`
--
ALTER TABLE `facultad`
  ADD PRIMARY KEY (`IDFACULTAD`);

--
-- Indices de la tabla `literales`
--
ALTER TABLE `literales`
  ADD PRIMARY KEY (`idLiterales`),
  ADD KEY `fk_Literales_Articulo1_idx` (`Articulo_idArticulo`);

--
-- Indices de la tabla `numerales`
--
ALTER TABLE `numerales`
  ADD PRIMARY KEY (`idNumerales`),
  ADD KEY `FK_LITERAL_ID_NUMERAL` (`FK_LITERAL_ID_NUMERAL`);

--
-- Indices de la tabla `profesor`
--
ALTER TABLE `profesor`
  ADD PRIMARY KEY (`CEDULA`,`VINCULACION_IDPROFESOR`),
  ADD KEY `fk_Profesor_Vinculacion1_idx` (`VINCULACION_IDPROFESOR`);

--
-- Indices de la tabla `profesor_asignaturas`
--
ALTER TABLE `profesor_asignaturas`
  ADD KEY `FK_ASIGNATURA_ID_ESTUDIANTE` (`FK_ASIGNATURA_ID_PROFESOR`),
  ADD KEY `FK_PROFESOR_ID_ASIGNATURA` (`FK_PROFESOR_ID_ASIGNATURA`);

--
-- Indices de la tabla `profesor_evidencias`
--
ALTER TABLE `profesor_evidencias`
  ADD KEY `FK_PROFESOR_ID_EVIDENCIA` (`FK_EVIDENCIA_ID_PROFESOR`),
  ADD KEY `FK_EVIDENCIA_ID_PROFESOR` (`FK_PROFESOR_ID_EVIDENCIA`);

--
-- Indices de la tabla `programa`
--
ALTER TABLE `programa`
  ADD PRIMARY KEY (`IDPROGRAMA`),
  ADD KEY `fk_Id_Facultad_Programa` (`FK_ID_FACULTAD_PROGRAMA`);

--
-- Indices de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  ADD PRIMARY KEY (`IDUSUARIO`);

--
-- Indices de la tabla `vinculacion`
--
ALTER TABLE `vinculacion`
  ADD PRIMARY KEY (`IDVINCULACION`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `evidencia`
--
ALTER TABLE `evidencia`
  MODIFY `IDEVIDENCIA` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  MODIFY `IDUSUARIO` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `articulos`
--
ALTER TABLE `articulos`
  ADD CONSTRAINT `articulos_ibfk_1` FOREIGN KEY (`FK_CAPITULO_ID_ARTICULO`) REFERENCES `capitulo` (`IDCAPITULO`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `asignatura`
--
ALTER TABLE `asignatura`
  ADD CONSTRAINT `fk_Id_Programa_Asignatura` FOREIGN KEY (`FK_ID_PROGRAMA_ASIGNATURA`) REFERENCES `programa` (`IDPROGRAMA`);

--
-- Filtros para la tabla `campus`
--
ALTER TABLE `campus`
  ADD CONSTRAINT `fk_Id_Facultad_Campus` FOREIGN KEY (`fk_Id_Facultad_Campus`) REFERENCES `facultad` (`IDFACULTAD`);

--
-- Filtros para la tabla `capitulo_evidencias`
--
ALTER TABLE `capitulo_evidencias`
  ADD CONSTRAINT `FK_CAPITULO_ID_EVIDENCIA` FOREIGN KEY (`FK_CAPITULO_ID_EVIDENCIAS`) REFERENCES `evidencia` (`IDEVIDENCIA`),
  ADD CONSTRAINT `FK_EVIDENCIA_ID_CAPITULO` FOREIGN KEY (`FK_EVIDENCIAS_ID_CAPITULO`) REFERENCES `capitulo` (`IDCAPITULO`);

--
-- Filtros para la tabla `egresado_facultad`
--
ALTER TABLE `egresado_facultad`
  ADD CONSTRAINT `FK_EGRESADO_ID_FACULTAD` FOREIGN KEY (`FK_FACULTAD_ID_EGRESADO`) REFERENCES `facultad` (`IDFACULTAD`),
  ADD CONSTRAINT `FK_FACULTAD_ID_EGRESADO` FOREIGN KEY (`FK_EGRESADO_ID_FACULTAD`) REFERENCES `egresado` (`idEgresados(Cc)`);

--
-- Filtros para la tabla `estudiantes_asignaturas`
--
ALTER TABLE `estudiantes_asignaturas`
  ADD CONSTRAINT `FK_ASIGNATURA_ID_ESTUDIANTES` FOREIGN KEY (`FK_ASIGANTURA_ID_ESTUDIANTE`) REFERENCES `asignatura` (`IDASIGNATURA`),
  ADD CONSTRAINT `FK_ESTUDIANTE_ID_ASIGNATURA` FOREIGN KEY (`FK_ESTUDIANTE_ID_ASIGNATURA`) REFERENCES `estudiante` (`CEDULA`);

--
-- Filtros para la tabla `estudiantes_evidencias`
--
ALTER TABLE `estudiantes_evidencias`
  ADD CONSTRAINT `FK_ESTUDIANTE_ID_EVIDENCIA` FOREIGN KEY (`FK_ESTUDIANTE_ID_EVIDENCIAS`) REFERENCES `evidencia` (`IDEVIDENCIA`),
  ADD CONSTRAINT `FK_EVIDENCIA_ID_ESTUDIANTE` FOREIGN KEY (`FK_EVIDENCIAS_ID_ESTUDIANTE`) REFERENCES `estudiante` (`CEDULA`);

--
-- Filtros para la tabla `literales`
--
ALTER TABLE `literales`
  ADD CONSTRAINT `fk_Literales_Articulo1` FOREIGN KEY (`Articulo_idArticulo`) REFERENCES `articulos` (`ID_ARTICULO`);

--
-- Filtros para la tabla `numerales`
--
ALTER TABLE `numerales`
  ADD CONSTRAINT `FK_LITERAL_ID_NUMERAL` FOREIGN KEY (`FK_LITERAL_ID_NUMERAL`) REFERENCES `literales` (`idLiterales`);

--
-- Filtros para la tabla `profesor`
--
ALTER TABLE `profesor`
  ADD CONSTRAINT `Vinculacion_idVinculacion` FOREIGN KEY (`VINCULACION_IDPROFESOR`) REFERENCES `vinculacion` (`IDVINCULACION`);

--
-- Filtros para la tabla `profesor_asignaturas`
--
ALTER TABLE `profesor_asignaturas`
  ADD CONSTRAINT `FK_ASIGNATURA_ID_PROFESOR` FOREIGN KEY (`FK_ASIGNATURA_ID_PROFESOR`) REFERENCES `profesor` (`CEDULA`),
  ADD CONSTRAINT `FK_PROFESOR_ID_ASIGNATURA ` FOREIGN KEY (`FK_PROFESOR_ID_ASIGNATURA`) REFERENCES `asignatura` (`IDASIGNATURA`);

--
-- Filtros para la tabla `profesor_evidencias`
--
ALTER TABLE `profesor_evidencias`
  ADD CONSTRAINT `FK_EVIDENCIA_ID_PROFESOR` FOREIGN KEY (`FK_EVIDENCIA_ID_PROFESOR`) REFERENCES `profesor` (`CEDULA`),
  ADD CONSTRAINT `FK_PROFESOR_ID_EVIDENCIA` FOREIGN KEY (`FK_PROFESOR_ID_EVIDENCIA`) REFERENCES `evidencia` (`IDEVIDENCIA`);

--
-- Filtros para la tabla `programa`
--
ALTER TABLE `programa`
  ADD CONSTRAINT `4	fk_Id_Facultad_Programa` FOREIGN KEY (`FK_ID_FACULTAD_PROGRAMA`) REFERENCES `facultad` (`IDFACULTAD`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
