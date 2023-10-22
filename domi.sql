-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 21-10-2023 a las 14:31:44
-- Versión del servidor: 10.4.27-MariaDB
-- Versión de PHP: 8.2.0

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `domi`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `compra`
--

CREATE TABLE `compra` (
  `idcompra` int(11) NOT NULL,
  `idPaciente` int(11) NOT NULL,
  `fecha` date NOT NULL,
  `total` float NOT NULL,
  `idestadocompra` int(11) NOT NULL,
  `ideps` int(11) NOT NULL,
  `direccion` varchar(244) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `compra`
--

INSERT INTO `compra` (`idcompra`, `idPaciente`, `fecha`, `total`, `idestadocompra`, `ideps`, `direccion`) VALUES
(3, 1, '2023-10-21', 1, 1, 6, 'rosal');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `detallecompra`
--

CREATE TABLE `detallecompra` (
  `id` int(11) NOT NULL,
  `idcompra` int(11) NOT NULL,
  `idmedicamento` int(11) NOT NULL,
  `cantidad` int(11) NOT NULL,
  `preciototal` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `detallecompra`
--

INSERT INTO `detallecompra` (`id`, `idcompra`, `idmedicamento`, `cantidad`, `preciototal`) VALUES
(3, 3, 1, 1, 2000);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `eps`
--

CREATE TABLE `eps` (
  `id` int(11) NOT NULL,
  `eps` varchar(255) NOT NULL,
  `direccion` varchar(244) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `eps`
--

INSERT INTO `eps` (`id`, `eps`, `direccion`) VALUES
(1, 'EPS Sura', ''),
(2, 'EPS Sanitas', ''),
(3, 'Nueva EPS', ''),
(4, 'Compensar EPS', ''),
(5, 'Colmédica EPS', ''),
(6, 'Famisanar EPS', ''),
(7, 'Salud Total EPS', ''),
(8, 'Coomeva EPS', '');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `estadocompra`
--

CREATE TABLE `estadocompra` (
  `id` int(11) NOT NULL,
  `estado` varchar(244) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `estadocompra`
--

INSERT INTO `estadocompra` (`id`, `estado`) VALUES
(1, 'disponible'),
(2, 'asignado'),
(3, 'transito'),
(4, 'entregado');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `estadoentrega`
--

CREATE TABLE `estadoentrega` (
  `id` int(11) NOT NULL,
  `estado` varchar(244) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `estadorepartidor`
--

CREATE TABLE `estadorepartidor` (
  `id` int(11) NOT NULL,
  `estado` varchar(244) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `estadorepartidor`
--

INSERT INTO `estadorepartidor` (`id`, `estado`) VALUES
(1, 'activo'),
(2, 'desactivado');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `historialdomi`
--

CREATE TABLE `historialdomi` (
  `id` int(11) NOT NULL,
  `idcompra` int(11) NOT NULL,
  `idRepartidor` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `medicamentos`
--

CREATE TABLE `medicamentos` (
  `id` int(11) NOT NULL,
  `nombre` varchar(20) NOT NULL,
  `precio` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `medicamentos`
--

INSERT INTO `medicamentos` (`id`, `nombre`, `precio`) VALUES
(1, 'acetaminofen', 2000),
(2, 'ibuprofeno', 3000),
(3, 'paracetamol', 5000),
(4, 'omeprazol', 3500),
(5, 'aspirina', 1200),
(6, 'naproxeno', 1350),
(7, 'loratadina', 2300),
(8, 'ambroxol', 7800),
(9, 'capotril', 1200),
(10, 'salbutamol', 3000),
(11, 'amoxilina', 3300),
(12, 'bluxam', 9000),
(13, 'naproxeno', 6000),
(14, 'clonazepam', 30000);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `repartidores`
--

CREATE TABLE `repartidores` (
  `idrepartidor` int(11) NOT NULL,
  `nombre` varchar(255) DEFAULT NULL,
  `apellido` varchar(255) DEFAULT NULL,
  `contacto` bigint(244) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `documento` int(11) DEFAULT NULL,
  `idtipodocumento` int(11) DEFAULT NULL,
  `direccionresidencia` varchar(255) DEFAULT NULL,
  `datosrunt` blob DEFAULT NULL,
  `password` varchar(255) DEFAULT NULL,
  `idrol` int(11) DEFAULT NULL,
  `fechaNacimiento` date DEFAULT NULL,
  `idEstado` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `repartidores`
--

INSERT INTO `repartidores` (`idrepartidor`, `nombre`, `apellido`, `contacto`, `email`, `documento`, `idtipodocumento`, `direccionresidencia`, `datosrunt`, `password`, `idrol`, `fechaNacimiento`, `idEstado`) VALUES
(1, 'diego', 'garaviz', 3203384608, 'garaviz@gamil.com', 1117804192, 1, 'san luis', 0x255044462d312e330a25badface00a332030206f626a0a3c3c2f54797065202f506167650a2f506172656e742031203020520a2f5265736f75726365732032203020520a2f4d65646961426f78205b302030203539352e3238203834312e38395d0a2f436f6e74656e74732034203020520a3e3e0a656e646f626a0a342030206f626a0a3c3c0a2f4c656e6774682031320a3e3e0a73747265616d0a302e353720770a3020470a710a656e6473747265616d0a656e646f626a0a312030206f626a0a3c3c2f54797065202f50616765730a2f4b696473205b3320302052205d0a2f436f756e7420310a3e3e0a656e646f626a0a352030206f626a0a3c3c0a2f54797065202f466f6e740a2f42617365466f6e74202f48656c7665746963610a2f53756274797065202f54797065310a2f456e636f64696e67202f57696e416e7369456e636f64696e670a2f4669727374436861722033320a2f4c61737443686172203235350a3e3e0a656e646f626a0a362030206f626a0a3c3c0a2f54797065202f466f6e740a2f42617365466f6e74202f48656c7665746963612d426f6c640a2f53756274797065202f54797065310a2f456e636f64696e67202f57696e416e7369456e636f64696e670a2f4669727374436861722033320a2f4c61737443686172203235350a3e3e0a656e646f626a0a372030206f626a0a3c3c0a2f54797065202f466f6e740a2f42617365466f6e74202f48656c7665746963612d4f626c697175650a2f53756274797065202f54797065310a2f456e636f64696e67202f57696e416e7369456e636f64696e670a2f4669727374436861722033320a2f4c61737443686172203235350a3e3e0a656e646f626a0a382030206f626a0a3c3c0a2f54797065202f466f6e740a2f42617365466f6e74202f48656c7665746963612d426f6c644f626c697175650a2f53756274797065202f54797065310a2f456e636f64696e67202f57696e416e7369456e636f64696e670a2f4669727374436861722033320a2f4c61737443686172203235350a3e3e0a656e646f626a0a392030206f626a0a3c3c0a2f54797065202f466f6e740a2f42617365466f6e74202f436f75726965720a2f53756274797065202f54797065310a2f456e636f64696e67202f57696e416e7369456e636f64696e670a2f4669727374436861722033320a2f4c61737443686172203235350a3e3e0a656e646f626a0a31302030206f626a0a3c3c0a2f54797065202f466f6e740a2f42617365466f6e74202f436f75726965722d426f6c640a2f53756274797065202f54797065310a2f456e636f64696e67202f57696e416e7369456e636f64696e670a2f4669727374436861722033320a2f4c61737443686172203235350a3e3e0a656e646f626a0a31312030206f626a0a3c3c0a2f54797065202f466f6e740a2f42617365466f6e74202f436f75726965722d4f626c697175650a2f53756274797065202f54797065310a2f456e636f64696e67202f57696e416e7369456e636f64696e670a2f4669727374436861722033320a2f4c61737443686172203235350a3e3e0a656e646f626a0a31322030206f626a0a3c3c0a2f54797065202f466f6e740a2f42617365466f6e74202f436f75726965722d426f6c644f626c697175650a2f53756274797065202f54797065310a2f456e636f64696e67202f57696e416e7369456e636f64696e670a2f4669727374436861722033320a2f4c61737443686172203235350a3e3e0a656e646f626a0a31332030206f626a0a3c3c0a2f54797065202f466f6e740a2f42617365466f6e74202f54696d65732d526f6d616e0a2f53756274797065202f54797065310a2f456e636f64696e67202f57696e416e7369456e636f64696e670a2f4669727374436861722033320a2f4c61737443686172203235350a3e3e0a656e646f626a0a31342030206f626a0a3c3c0a2f54797065202f466f6e740a2f42617365466f6e74202f54696d65732d426f6c640a2f53756274797065202f54797065310a2f456e636f64696e67202f57696e416e7369456e636f64696e670a2f4669727374436861722033320a2f4c61737443686172203235350a3e3e0a656e646f626a0a31352030206f626a0a3c3c0a2f54797065202f466f6e740a2f42617365466f6e74202f54696d65732d4974616c69630a2f53756274797065202f54797065310a2f456e636f64696e67202f57696e416e7369456e636f64696e670a2f4669727374436861722033320a2f4c61737443686172203235350a3e3e0a656e646f626a0a31362030206f626a0a3c3c0a2f54797065202f466f6e740a2f42617365466f6e74202f54696d65732d426f6c644974616c69630a2f53756274797065202f54797065310a2f456e636f64696e67202f57696e416e7369456e636f64696e670a2f4669727374436861722033320a2f4c61737443686172203235350a3e3e0a656e646f626a0a31372030206f626a0a3c3c0a2f54797065202f466f6e740a2f42617365466f6e74202f5a61706644696e67626174730a2f53756274797065202f54797065310a2f4669727374436861722033320a2f4c61737443686172203235350a3e3e0a656e646f626a0a31382030206f626a0a3c3c0a2f54797065202f466f6e740a2f42617365466f6e74202f53796d626f6c0a2f53756274797065202f54797065310a2f4669727374436861722033320a2f4c61737443686172203235350a3e3e0a656e646f626a0a322030206f626a0a3c3c0a2f50726f63536574205b2f504446202f54657874202f496d61676542202f496d61676543202f496d616765495d0a2f466f6e74203c3c0a2f46312035203020520a2f46322036203020520a2f46332037203020520a2f46342038203020520a2f46352039203020520a2f4636203130203020520a2f4637203131203020520a2f4638203132203020520a2f4639203133203020520a2f463130203134203020520a2f463131203135203020520a2f463132203136203020520a2f463133203137203020520a2f463134203138203020520a3e3e0a2f584f626a656374203c3c0a3e3e0a3e3e0a656e646f626a0a31392030206f626a0a3c3c0a2f50726f647563657220286a7350444620312e352e33290a2f4372656174696f6e446174652028443a32303233303931383130333235332d303527303027290a3e3e0a656e646f626a0a32302030206f626a0a3c3c0a2f54797065202f436174616c6f670a2f50616765732031203020520a2f4f70656e416374696f6e205b3320302052202f46697448206e756c6c5d0a2f506167654c61796f7574202f4f6e65436f6c756d6e0a3e3e0a656e646f626a0a787265660a302032310a303030303030303030302036353533352066200a30303030303030313836203030303030206e200a30303030303032303033203030303030206e200a30303030303030303135203030303030206e200a30303030303030313234203030303030206e200a30303030303030323433203030303030206e200a30303030303030333638203030303030206e200a30303030303030343938203030303030206e200a30303030303030363331203030303030206e200a30303030303030373638203030303030206e200a30303030303030383931203030303030206e200a30303030303031303230203030303030206e200a30303030303031313532203030303030206e200a30303030303031323838203030303030206e200a30303030303031343136203030303030206e200a30303030303031353433203030303030206e200a30303030303031363732203030303030206e200a30303030303031383035203030303030206e200a30303030303031393037203030303030206e200a30303030303032323531203030303030206e200a30303030303032333337203030303030206e200a747261696c65720a3c3c0a2f53697a652032310a2f526f6f74203230203020520a2f496e666f203139203020520a2f4944205b203c46433630303743423539334334304545334434384239373439454630373643363e203c46433630303743423539334334304545334434384239373439454630373643363e205d0a3e3e0a7374617274787265660a323434310a2525454f46, '123', 1, '2023-10-01', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `reportecliente`
--

CREATE TABLE `reportecliente` (
  `id` int(11) NOT NULL,
  `idPaciente` int(11) NOT NULL,
  `idRepartidor` int(11) NOT NULL,
  `idestadoentrega` int(11) NOT NULL,
  `fechaEntrega` date NOT NULL,
  `idcompra` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `reporteestadofinal`
--

CREATE TABLE `reporteestadofinal` (
  `id` int(11) NOT NULL,
  `idrepartidor` int(11) NOT NULL,
  `idcompra` int(11) NOT NULL,
  `fechafinal` date NOT NULL,
  `imagen` varchar(244) NOT NULL,
  `idestadocompra` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `roles`
--

CREATE TABLE `roles` (
  `id` int(11) NOT NULL,
  `nombre` varchar(244) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `roles`
--

INSERT INTO `roles` (`id`, `nombre`) VALUES
(1, 'domiciliario'),
(2, 'usuario');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tipodocumento`
--

CREATE TABLE `tipodocumento` (
  `id` int(11) NOT NULL,
  `tipodocumento` varchar(244) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `tipodocumento`
--

INSERT INTO `tipodocumento` (`id`, `tipodocumento`) VALUES
(1, 'Cédula de Ciudadanía'),
(2, 'Tarjeta de Identidad'),
(3, 'Cédula de Extranjería'),
(4, 'Pasaporte'),
(5, 'Registro Civil de Nacimiento'),
(6, 'Licencia de Conducción'),
(7, 'Tarjeta Profesional');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuarios`
--

CREATE TABLE `usuarios` (
  `id` int(11) NOT NULL,
  `idrol` int(11) NOT NULL,
  `nombre` varchar(244) NOT NULL,
  `apellido` varchar(244) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `usuarios`
--

INSERT INTO `usuarios` (`id`, `idrol`, `nombre`, `apellido`) VALUES
(1, 2, 'isaias', 'caballero'),
(3, 2, 'mario', 'gomez');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `compra`
--
ALTER TABLE `compra`
  ADD PRIMARY KEY (`idcompra`),
  ADD KEY `idcompra` (`idcompra`,`idPaciente`,`idestadocompra`),
  ADD KEY `idestadocompra` (`idestadocompra`),
  ADD KEY `idPaciente` (`idPaciente`),
  ADD KEY `ideps` (`ideps`),
  ADD KEY `ideps_2` (`ideps`);

--
-- Indices de la tabla `detallecompra`
--
ALTER TABLE `detallecompra`
  ADD PRIMARY KEY (`id`),
  ADD KEY `idcompra` (`idcompra`,`idmedicamento`),
  ADD KEY `idmedicamento` (`idmedicamento`);

--
-- Indices de la tabla `eps`
--
ALTER TABLE `eps`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id` (`id`);

--
-- Indices de la tabla `estadocompra`
--
ALTER TABLE `estadocompra`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id` (`id`);

--
-- Indices de la tabla `estadoentrega`
--
ALTER TABLE `estadoentrega`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id` (`id`);

--
-- Indices de la tabla `estadorepartidor`
--
ALTER TABLE `estadorepartidor`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id` (`id`);

--
-- Indices de la tabla `historialdomi`
--
ALTER TABLE `historialdomi`
  ADD PRIMARY KEY (`id`),
  ADD KEY `idpedido` (`idcompra`,`idRepartidor`),
  ADD KEY `idRepartidor` (`idRepartidor`);

--
-- Indices de la tabla `medicamentos`
--
ALTER TABLE `medicamentos`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id` (`id`);

--
-- Indices de la tabla `repartidores`
--
ALTER TABLE `repartidores`
  ADD PRIMARY KEY (`idrepartidor`),
  ADD KEY `idtipodocumento` (`idtipodocumento`,`idrol`,`idEstado`),
  ADD KEY `idrol` (`idrol`),
  ADD KEY `idEstado` (`idEstado`);

--
-- Indices de la tabla `reportecliente`
--
ALTER TABLE `reportecliente`
  ADD PRIMARY KEY (`id`),
  ADD KEY `idPaciente` (`idPaciente`,`idRepartidor`,`idestadoentrega`),
  ADD KEY `idPaciente_2` (`idPaciente`,`idRepartidor`,`idestadoentrega`),
  ADD KEY `idestadoentrega` (`idestadoentrega`),
  ADD KEY `idcompra` (`idcompra`);

--
-- Indices de la tabla `reporteestadofinal`
--
ALTER TABLE `reporteestadofinal`
  ADD PRIMARY KEY (`id`),
  ADD KEY `idrepartidor` (`idrepartidor`,`idcompra`,`idestadocompra`),
  ADD KEY `idestadopedido` (`idestadocompra`),
  ADD KEY `idpedido` (`idcompra`);

--
-- Indices de la tabla `roles`
--
ALTER TABLE `roles`
  ADD PRIMARY KEY (`id`),
  ADD KEY `nombre` (`nombre`),
  ADD KEY `id` (`id`),
  ADD KEY `id_2` (`id`);

--
-- Indices de la tabla `tipodocumento`
--
ALTER TABLE `tipodocumento`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id` (`id`);

--
-- Indices de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id` (`id`,`idrol`),
  ADD KEY `idrol` (`idrol`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `compra`
--
ALTER TABLE `compra`
  MODIFY `idcompra` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de la tabla `detallecompra`
--
ALTER TABLE `detallecompra`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de la tabla `estadocompra`
--
ALTER TABLE `estadocompra`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT de la tabla `estadoentrega`
--
ALTER TABLE `estadoentrega`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `estadorepartidor`
--
ALTER TABLE `estadorepartidor`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de la tabla `historialdomi`
--
ALTER TABLE `historialdomi`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `medicamentos`
--
ALTER TABLE `medicamentos`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT de la tabla `repartidores`
--
ALTER TABLE `repartidores`
  MODIFY `idrepartidor` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de la tabla `reportecliente`
--
ALTER TABLE `reportecliente`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `reporteestadofinal`
--
ALTER TABLE `reporteestadofinal`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `roles`
--
ALTER TABLE `roles`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT de la tabla `tipodocumento`
--
ALTER TABLE `tipodocumento`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `compra`
--
ALTER TABLE `compra`
  ADD CONSTRAINT `compra_ibfk_1` FOREIGN KEY (`idestadocompra`) REFERENCES `estadocompra` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `compra_ibfk_3` FOREIGN KEY (`idPaciente`) REFERENCES `usuarios` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `compra_ibfk_4` FOREIGN KEY (`ideps`) REFERENCES `eps` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `detallecompra`
--
ALTER TABLE `detallecompra`
  ADD CONSTRAINT `detallecompra_ibfk_2` FOREIGN KEY (`idmedicamento`) REFERENCES `medicamentos` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `detallecompra_ibfk_3` FOREIGN KEY (`idcompra`) REFERENCES `compra` (`idcompra`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `historialdomi`
--
ALTER TABLE `historialdomi`
  ADD CONSTRAINT `historialdomi_ibfk_1` FOREIGN KEY (`idRepartidor`) REFERENCES `reporteestadofinal` (`idrepartidor`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `repartidores`
--
ALTER TABLE `repartidores`
  ADD CONSTRAINT `repartidores_ibfk_1` FOREIGN KEY (`idrol`) REFERENCES `roles` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `repartidores_ibfk_2` FOREIGN KEY (`idEstado`) REFERENCES `estadorepartidor` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `repartidores_ibfk_3` FOREIGN KEY (`idtipodocumento`) REFERENCES `tipodocumento` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `reportecliente`
--
ALTER TABLE `reportecliente`
  ADD CONSTRAINT `reportecliente_ibfk_1` FOREIGN KEY (`idestadoentrega`) REFERENCES `estadoentrega` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `reportecliente_ibfk_2` FOREIGN KEY (`id`) REFERENCES `repartidores` (`idrepartidor`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `reporteestadofinal`
--
ALTER TABLE `reporteestadofinal`
  ADD CONSTRAINT `reporteestadofinal_ibfk_1` FOREIGN KEY (`idestadocompra`) REFERENCES `estadocompra` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `reporteestadofinal_ibfk_2` FOREIGN KEY (`idcompra`) REFERENCES `historialdomi` (`idcompra`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `usuarios`
--
ALTER TABLE `usuarios`
  ADD CONSTRAINT `usuarios_ibfk_1` FOREIGN KEY (`idrol`) REFERENCES `roles` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
