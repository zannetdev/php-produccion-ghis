-- phpMyAdmin SQL Dump
-- version 4.9.7
-- https://www.phpmyadmin.net/
--
-- Servidor: localhost:3306
-- Tiempo de generación: 10-05-2022 a las 20:14:22
-- Versión del servidor: 10.5.15-MariaDB-cll-lve
-- Versión de PHP: 7.3.33

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `mvrlvryf_production`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tm_ajuste`
--

CREATE TABLE `tm_ajuste` (
  `id_impresora` int(11) NOT NULL,
  `ruc_empresa` varchar(20) NOT NULL,
  `ip_principal` varchar(100) NOT NULL,
  `nombre_empresa` varchar(255) NOT NULL,
  `direccion` varchar(255) NOT NULL,
  `ubigeo` varchar(100) NOT NULL,
  `distrito` varchar(45) NOT NULL,
  `provincia` varchar(45) NOT NULL,
  `departamento` varchar(45) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `tm_ajuste`
--

INSERT INTO `tm_ajuste` (`id_impresora`, `ruc_empresa`, `ip_principal`, `nombre_empresa`, `direccion`, `ubigeo`, `distrito`, `provincia`, `departamento`) VALUES
(1, '00000000000', '192.168.0.1', '-', '-', '-', '-', '-', '-');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tm_area`
--

CREATE TABLE `tm_area` (
  `id_area` int(11) NOT NULL,
  `id_rol_area` int(11) NOT NULL,
  `nombre_area` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `tm_area`
--

INSERT INTO `tm_area` (`id_area`, `id_rol_area`, `nombre_area`) VALUES
(1, 1, 'CORTE'),
(2, 2, 'DEBASTADO'),
(3, 3, 'APARADO'),
(4, 4, 'ARMADO'),
(5, 5, 'PEGADO'),
(6, 6, 'ACABADO');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tm_categoria`
--

CREATE TABLE `tm_categoria` (
  `id_categoria` int(11) NOT NULL,
  `nombre` varchar(100) NOT NULL,
  `imagen` varchar(255) NOT NULL,
  `estado` varchar(2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tm_cliente`
--

CREATE TABLE `tm_cliente` (
  `id_cliente` int(11) NOT NULL,
  `id_doc` int(11) NOT NULL,
  `id_rol` int(11) NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(255) NOT NULL,
  `num_doc` varchar(40) NOT NULL,
  `nombre` varchar(100) NOT NULL,
  `apellido_paterno` varchar(100) NOT NULL,
  `apellido_materno` varchar(100) NOT NULL,
  `genero` varchar(10) NOT NULL,
  `email` varchar(100) NOT NULL,
  `telefono` varchar(45) NOT NULL,
  `estado` varchar(2) NOT NULL,
  `direccion` varchar(100) NOT NULL,
  `tk_activacion` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tm_documentos`
--

CREATE TABLE `tm_documentos` (
  `id_documento` int(11) NOT NULL,
  `nombre` varchar(45) NOT NULL,
  `pais` varchar(40) NOT NULL,
  `estado` varchar(2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `tm_documentos`
--

INSERT INTO `tm_documentos` (`id_documento`, `nombre`, `pais`, `estado`) VALUES
(1, 'RUC', 'PE', 'a'),
(2, 'DNI', 'PE', 'a');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tm_grupo`
--

CREATE TABLE `tm_grupo` (
  `id_grupo` int(11) NOT NULL,
  `fecha_creacion` datetime NOT NULL,
  `estado` varchar(2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tm_grupo_usuarios`
--

CREATE TABLE `tm_grupo_usuarios` (
  `id_grupo` int(11) NOT NULL,
  `id_usuario` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tm_impresora`
--

CREATE TABLE `tm_impresora` (
  `id_impresora` int(11) NOT NULL,
  `nombre_impresora` varchar(100) NOT NULL,
  `corte_impresora` varchar(255) NOT NULL,
  `estado` varchar(2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `tm_impresora`
--

INSERT INTO `tm_impresora` (`id_impresora`, `nombre_impresora`, `corte_impresora`, `estado`) VALUES
(1, 'NINGUNA', 'PARCIAL', 'a');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tm_insumo`
--

CREATE TABLE `tm_insumo` (
  `id_insumo` int(11) NOT NULL,
  `id_categoria` int(11) NOT NULL,
  `nombre` varchar(255) NOT NULL,
  `estado` varchar(2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tm_inventario_catg`
--

CREATE TABLE `tm_inventario_catg` (
  `id_categoria` int(11) NOT NULL,
  `nombre` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `tm_inventario_catg`
--

INSERT INTO `tm_inventario_catg` (`id_categoria`, `nombre`) VALUES
(1, 'CUEROS'),
(2, 'TELAS'),
(3, 'FORROS'),
(4, 'HILOS'),
(5, 'ESPONJAS'),
(6, 'CHAPITA\r\n'),
(7, 'PLANTA'),
(8, 'PLANTILLOS'),
(9, 'TACOS');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tm_mensajes`
--

CREATE TABLE `tm_mensajes` (
  `id_mensaje` int(11) NOT NULL,
  `id_grupo` int(11) NOT NULL,
  `mensaje` longtext NOT NULL,
  `fecha` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tm_modelo`
--

CREATE TABLE `tm_modelo` (
  `id_modelo` int(11) NOT NULL,
  `id_categoria` int(11) NOT NULL,
  `cod_design` varchar(100) NOT NULL,
  `cuero_1` varchar(100) NOT NULL,
  `cuero_2` varchar(100) NOT NULL,
  `capellado` varchar(100) NOT NULL,
  `tela` varchar(100) NOT NULL,
  `forro_1` varchar(100) NOT NULL,
  `forro_2` varchar(100) NOT NULL,
  `grabado` varchar(100) NOT NULL,
  `marcar_empalme` varchar(100) NOT NULL,
  `desuaste_1` varchar(100) NOT NULL,
  `desuaste_2` varchar(100) NOT NULL,
  `pintado_bordes` varchar(100) NOT NULL,
  `aguja_1` varchar(100) NOT NULL,
  `aguja_2` varchar(100) NOT NULL,
  `hilo_1` varchar(100) NOT NULL,
  `hilo_2` varchar(45) NOT NULL,
  `hilo_drama` varchar(100) NOT NULL,
  `esponja` varchar(100) NOT NULL,
  `chapita` varchar(100) NOT NULL,
  `sellar_marca` varchar(255) NOT NULL,
  `consumo_cierre_por_doc` varchar(100) NOT NULL,
  `consumo_cuero_por_doc` varchar(100) NOT NULL,
  `n_patron` varchar(45) NOT NULL,
  `horma` varchar(100) NOT NULL,
  `planta` varchar(100) NOT NULL,
  `falso` varchar(100) NOT NULL,
  `plantillos` varchar(100) NOT NULL,
  `latex` varchar(100) NOT NULL,
  `preimer` varchar(100) NOT NULL,
  `sombreado` varchar(100) NOT NULL,
  `imagen` varchar(255) DEFAULT NULL,
  `tm_modelocol` varchar(45) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tm_pago`
--

CREATE TABLE `tm_pago` (
  `id_pago` int(11) NOT NULL,
  `id_pedido` int(11) NOT NULL,
  `json_response` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin DEFAULT NULL CHECK (json_valid(`json_response`)),
  `transaccion_id` varchar(100) DEFAULT NULL,
  `fecha` varchar(100) NOT NULL,
  `foto` varchar(100) DEFAULT NULL,
  `estado` varchar(2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tm_pedido`
--

CREATE TABLE `tm_pedido` (
  `id_pedido` int(11) NOT NULL,
  `id_modelo` int(11) NOT NULL,
  `proceso_estado` varchar(45) NOT NULL,
  `estado` varchar(2) NOT NULL,
  `id_cliente` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tm_proceso`
--

CREATE TABLE `tm_proceso` (
  `id_proceso` int(11) NOT NULL,
  `id_pedido` int(11) NOT NULL,
  `id_encargado` int(11) NOT NULL,
  `fecha_aceptacion` datetime NOT NULL,
  `fecha_termino` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tm_reset_pwd`
--

CREATE TABLE `tm_reset_pwd` (
  `id_pwd` int(11) NOT NULL,
  `id_usuario` int(11) NOT NULL,
  `tk` varchar(100) NOT NULL,
  `expiration_time` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tm_rol`
--

CREATE TABLE `tm_rol` (
  `id_rol` int(11) NOT NULL,
  `nombre_rol` varchar(45) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `tm_rol`
--

INSERT INTO `tm_rol` (`id_rol`, `nombre_rol`) VALUES
(1, 'SUPER'),
(2, 'ADMINISTRADOR'),
(3, 'EMPLEADO'),
(4, 'CLIENTE');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tm_rol_area`
--

CREATE TABLE `tm_rol_area` (
  `id_rol` int(11) NOT NULL,
  `nombre` varchar(45) NOT NULL,
  `paso` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `tm_rol_area`
--

INSERT INTO `tm_rol_area` (`id_rol`, `nombre`, `paso`) VALUES
(1, 'CORTE', 1),
(2, 'DEBASTADO', 2),
(3, 'APARADO', 3),
(4, 'ARMADO', 4),
(5, 'PEGADO', 5),
(6, 'ACABADO', 6);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tm_usuario`
--

CREATE TABLE `tm_usuario` (
  `id_usuario` int(11) NOT NULL,
  `id_doc` int(11) NOT NULL,
  `id_rol` int(11) NOT NULL,
  `id_area` int(11) DEFAULT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(255) NOT NULL,
  `num_doc` varchar(40) NOT NULL,
  `nombre` varchar(100) NOT NULL,
  `apellido_paterno` varchar(40) NOT NULL,
  `apellido_materno` varchar(40) NOT NULL,
  `genero` varchar(2) NOT NULL,
  `email` varchar(100) NOT NULL,
  `telefono` varchar(45) NOT NULL,
  `estado` varchar(2) NOT NULL,
  `direccion` varchar(45) NOT NULL,
  `tk_activacion` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `tm_usuario`
--

INSERT INTO `tm_usuario` (`id_usuario`, `id_doc`, `id_rol`, `id_area`, `username`, `password`, `num_doc`, `nombre`, `apellido_paterno`, `apellido_materno`, `genero`, `email`, `telefono`, `estado`, `direccion`, `tk_activacion`) VALUES
(1, 1, 1, NULL, 'admin', '$2y$10$2cjjOakYamBhk20WuxGgp.JJz9.h7hnxl.Z.GkneHenqGJ8zRxE5.', '20605905367', 'Eduardo', 'González', 'González', 'M', 'randellcode@outlook.es', '4622422815', 'a', '-', '-');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `tm_ajuste`
--
ALTER TABLE `tm_ajuste`
  ADD KEY `fk_tm_ajuste_tm_impresora1_idx` (`id_impresora`);

--
-- Indices de la tabla `tm_area`
--
ALTER TABLE `tm_area`
  ADD PRIMARY KEY (`id_area`),
  ADD KEY `fk_tm_area_tm_rol_area1_idx` (`id_rol_area`);

--
-- Indices de la tabla `tm_categoria`
--
ALTER TABLE `tm_categoria`
  ADD PRIMARY KEY (`id_categoria`);

--
-- Indices de la tabla `tm_cliente`
--
ALTER TABLE `tm_cliente`
  ADD PRIMARY KEY (`id_cliente`);

--
-- Indices de la tabla `tm_documentos`
--
ALTER TABLE `tm_documentos`
  ADD PRIMARY KEY (`id_documento`);

--
-- Indices de la tabla `tm_grupo`
--
ALTER TABLE `tm_grupo`
  ADD PRIMARY KEY (`id_grupo`);

--
-- Indices de la tabla `tm_grupo_usuarios`
--
ALTER TABLE `tm_grupo_usuarios`
  ADD KEY `fk_tm_grupo_usuarios_tm_grupo1_idx` (`id_grupo`),
  ADD KEY `fk_tm_grupo_usuarios_tm_usuario1_idx` (`id_usuario`);

--
-- Indices de la tabla `tm_impresora`
--
ALTER TABLE `tm_impresora`
  ADD PRIMARY KEY (`id_impresora`);

--
-- Indices de la tabla `tm_insumo`
--
ALTER TABLE `tm_insumo`
  ADD PRIMARY KEY (`id_insumo`),
  ADD KEY `fk_tm_insumo_tm_inventario_catg1_idx` (`id_categoria`);

--
-- Indices de la tabla `tm_inventario_catg`
--
ALTER TABLE `tm_inventario_catg`
  ADD PRIMARY KEY (`id_categoria`);

--
-- Indices de la tabla `tm_mensajes`
--
ALTER TABLE `tm_mensajes`
  ADD PRIMARY KEY (`id_mensaje`),
  ADD KEY `fk_tm_mensajes_tm_grupo1_idx` (`id_grupo`);

--
-- Indices de la tabla `tm_modelo`
--
ALTER TABLE `tm_modelo`
  ADD PRIMARY KEY (`id_modelo`),
  ADD KEY `fk_tm_modelo_tm_categoria1_idx` (`id_categoria`);

--
-- Indices de la tabla `tm_pago`
--
ALTER TABLE `tm_pago`
  ADD PRIMARY KEY (`id_pago`),
  ADD KEY `fk_tm_pago_tm_pedido1_idx` (`id_pedido`);

--
-- Indices de la tabla `tm_pedido`
--
ALTER TABLE `tm_pedido`
  ADD PRIMARY KEY (`id_pedido`),
  ADD KEY `fk_tm_pedido_tm_modelo1_idx` (`id_modelo`),
  ADD KEY `fk_tm_pedido_tm_cliente1_idx` (`id_cliente`);

--
-- Indices de la tabla `tm_proceso`
--
ALTER TABLE `tm_proceso`
  ADD PRIMARY KEY (`id_proceso`),
  ADD KEY `fk_tm_proceso_tm_pedido1_idx` (`id_pedido`),
  ADD KEY `fk_tm_proceso_tm_usuario1_idx` (`id_encargado`);

--
-- Indices de la tabla `tm_reset_pwd`
--
ALTER TABLE `tm_reset_pwd`
  ADD PRIMARY KEY (`id_pwd`),
  ADD KEY `fk_tm_reset_pwd_tm_usuario1_idx` (`id_usuario`);

--
-- Indices de la tabla `tm_rol`
--
ALTER TABLE `tm_rol`
  ADD PRIMARY KEY (`id_rol`);

--
-- Indices de la tabla `tm_rol_area`
--
ALTER TABLE `tm_rol_area`
  ADD PRIMARY KEY (`id_rol`);

--
-- Indices de la tabla `tm_usuario`
--
ALTER TABLE `tm_usuario`
  ADD PRIMARY KEY (`id_usuario`),
  ADD KEY `fk_tm_usuario_tm_documentos_idx` (`id_doc`),
  ADD KEY `fk_tm_usuario_tm_rol1_idx` (`id_rol`),
  ADD KEY `fk_tm_usuario_tm_area1_idx` (`id_area`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `tm_area`
--
ALTER TABLE `tm_area`
  MODIFY `id_area` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT de la tabla `tm_cliente`
--
ALTER TABLE `tm_cliente`
  MODIFY `id_cliente` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `tm_documentos`
--
ALTER TABLE `tm_documentos`
  MODIFY `id_documento` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de la tabla `tm_grupo`
--
ALTER TABLE `tm_grupo`
  MODIFY `id_grupo` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `tm_grupo_usuarios`
--
ALTER TABLE `tm_grupo_usuarios`
  MODIFY `id_grupo` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `tm_impresora`
--
ALTER TABLE `tm_impresora`
  MODIFY `id_impresora` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de la tabla `tm_insumo`
--
ALTER TABLE `tm_insumo`
  MODIFY `id_insumo` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `tm_inventario_catg`
--
ALTER TABLE `tm_inventario_catg`
  MODIFY `id_categoria` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT de la tabla `tm_mensajes`
--
ALTER TABLE `tm_mensajes`
  MODIFY `id_mensaje` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `tm_modelo`
--
ALTER TABLE `tm_modelo`
  MODIFY `id_modelo` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `tm_pago`
--
ALTER TABLE `tm_pago`
  MODIFY `id_pago` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `tm_pedido`
--
ALTER TABLE `tm_pedido`
  MODIFY `id_pedido` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `tm_proceso`
--
ALTER TABLE `tm_proceso`
  MODIFY `id_proceso` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `tm_reset_pwd`
--
ALTER TABLE `tm_reset_pwd`
  MODIFY `id_pwd` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `tm_rol`
--
ALTER TABLE `tm_rol`
  MODIFY `id_rol` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT de la tabla `tm_rol_area`
--
ALTER TABLE `tm_rol_area`
  MODIFY `id_rol` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT de la tabla `tm_usuario`
--
ALTER TABLE `tm_usuario`
  MODIFY `id_usuario` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `tm_ajuste`
--
ALTER TABLE `tm_ajuste`
  ADD CONSTRAINT `fk_tm_ajuste_tm_impresora1` FOREIGN KEY (`id_impresora`) REFERENCES `tm_impresora` (`id_impresora`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `tm_area`
--
ALTER TABLE `tm_area`
  ADD CONSTRAINT `fk_tm_area_tm_rol_area1` FOREIGN KEY (`id_rol_area`) REFERENCES `tm_rol_area` (`id_rol`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `tm_grupo_usuarios`
--
ALTER TABLE `tm_grupo_usuarios`
  ADD CONSTRAINT `fk_tm_grupo_usuarios_tm_grupo1` FOREIGN KEY (`id_grupo`) REFERENCES `tm_grupo` (`id_grupo`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_tm_grupo_usuarios_tm_usuario1` FOREIGN KEY (`id_usuario`) REFERENCES `tm_usuario` (`id_usuario`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `tm_insumo`
--
ALTER TABLE `tm_insumo`
  ADD CONSTRAINT `fk_tm_insumo_tm_inventario_catg1` FOREIGN KEY (`id_categoria`) REFERENCES `tm_inventario_catg` (`id_categoria`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `tm_mensajes`
--
ALTER TABLE `tm_mensajes`
  ADD CONSTRAINT `fk_tm_mensajes_tm_grupo1` FOREIGN KEY (`id_grupo`) REFERENCES `tm_grupo` (`id_grupo`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `tm_modelo`
--
ALTER TABLE `tm_modelo`
  ADD CONSTRAINT `fk_tm_modelo_tm_categoria1` FOREIGN KEY (`id_categoria`) REFERENCES `tm_categoria` (`id_categoria`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `tm_pago`
--
ALTER TABLE `tm_pago`
  ADD CONSTRAINT `fk_tm_pago_tm_pedido1` FOREIGN KEY (`id_pedido`) REFERENCES `tm_pedido` (`id_pedido`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `tm_pedido`
--
ALTER TABLE `tm_pedido`
  ADD CONSTRAINT `fk_tm_pedido_tm_cliente1` FOREIGN KEY (`id_cliente`) REFERENCES `tm_cliente` (`id_cliente`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_tm_pedido_tm_modelo1` FOREIGN KEY (`id_modelo`) REFERENCES `tm_modelo` (`id_modelo`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `tm_proceso`
--
ALTER TABLE `tm_proceso`
  ADD CONSTRAINT `fk_tm_proceso_tm_pedido1` FOREIGN KEY (`id_pedido`) REFERENCES `tm_pedido` (`id_pedido`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_tm_proceso_tm_usuario1` FOREIGN KEY (`id_encargado`) REFERENCES `tm_usuario` (`id_usuario`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `tm_reset_pwd`
--
ALTER TABLE `tm_reset_pwd`
  ADD CONSTRAINT `fk_tm_reset_pwd_tm_usuario1` FOREIGN KEY (`id_usuario`) REFERENCES `tm_usuario` (`id_usuario`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `tm_usuario`
--
ALTER TABLE `tm_usuario`
  ADD CONSTRAINT `fk_tm_usuario_tm_area1` FOREIGN KEY (`id_area`) REFERENCES `tm_area` (`id_area`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_tm_usuario_tm_documentos` FOREIGN KEY (`id_doc`) REFERENCES `tm_documentos` (`id_documento`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_tm_usuario_tm_rol1` FOREIGN KEY (`id_rol`) REFERENCES `tm_rol` (`id_rol`) ON DELETE NO ACTION ON UPDATE NO ACTION;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
