-- MySQL dump 10.13  Distrib 8.0.12, for Win64 (x86_64)
--
-- Host: localhost    Database: control_stock
-- ------------------------------------------------------
-- Server version	8.0.12

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
 SET NAMES utf8 ;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

--
-- Table structure for table `detalle_venta`
--

DROP TABLE IF EXISTS `detalle_venta`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
 SET character_set_client = utf8mb4 ;
CREATE TABLE `detalle_venta` (
  `id_producto` int(11) NOT NULL,
  `id_venta` int(11) NOT NULL,
  `valor_unitario` int(11) DEFAULT NULL,
  `cantidad` int(11) DEFAULT NULL,
  `valor_total` int(11) DEFAULT NULL,
  PRIMARY KEY (`id_producto`,`id_venta`),
  KEY `FK_detalleventa_venta_idx` (`id_venta`),
  CONSTRAINT `FK_detalle_venta_producto` FOREIGN KEY (`id_producto`) REFERENCES `tb_productos` (`id_producto`) ON UPDATE CASCADE,
  CONSTRAINT `FK_detalleventa_venta` FOREIGN KEY (`id_venta`) REFERENCES `tb_ventas` (`id_venta`) ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 ;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `detalle_venta`
--

LOCK TABLES `detalle_venta` WRITE;
/*!40000 ALTER TABLE `detalle_venta` DISABLE KEYS */;
/*!40000 ALTER TABLE `detalle_venta` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tb_categoria`
--

DROP TABLE IF EXISTS `tb_categoria`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
 SET character_set_client = utf8mb4 ;
CREATE TABLE `tb_categoria` (
  `id_categoria` int(11) NOT NULL,
  `descripcion_categoria` varchar(45) NOT NULL,
  PRIMARY KEY (`id_categoria`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 ;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tb_categoria`
--

LOCK TABLES `tb_categoria` WRITE;
/*!40000 ALTER TABLE `tb_categoria` DISABLE KEYS */;
INSERT INTO `tb_categoria` VALUES (1,'normal'),(2,'zero');
/*!40000 ALTER TABLE `tb_categoria` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tb_detalle_factura`
--

DROP TABLE IF EXISTS `tb_detalle_factura`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
 SET character_set_client = utf8mb4 ;
CREATE TABLE `tb_detalle_factura` (
  `id_factura` int(11) NOT NULL,
  `id_producto` int(11) NOT NULL,
  `cantidad` varchar(45) NOT NULL,
  `valor` varchar(45) NOT NULL,
  PRIMARY KEY (`id_factura`,`id_producto`),
  KEY `FK_detalle_factura_productos_idx` (`id_producto`),
  CONSTRAINT `FK_detalle_factura_facturas` FOREIGN KEY (`id_factura`) REFERENCES `tb_facturas` (`id_factura`) ON UPDATE CASCADE,
  CONSTRAINT `FK_detalle_factura_productos` FOREIGN KEY (`id_producto`) REFERENCES `tb_productos` (`id_producto`) ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 ;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tb_detalle_factura`
--

LOCK TABLES `tb_detalle_factura` WRITE;
/*!40000 ALTER TABLE `tb_detalle_factura` DISABLE KEYS */;
INSERT INTO `tb_detalle_factura` VALUES (1,1,'20','1000'),(1,56,'30','1000');
/*!40000 ALTER TABLE `tb_detalle_factura` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tb_estado_producto`
--

DROP TABLE IF EXISTS `tb_estado_producto`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
 SET character_set_client = utf8mb4 ;
CREATE TABLE `tb_estado_producto` (
  `id_estado` int(11) NOT NULL,
  `descripcion_estado` varchar(45) NOT NULL,
  PRIMARY KEY (`id_estado`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 ;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tb_estado_producto`
--

LOCK TABLES `tb_estado_producto` WRITE;
/*!40000 ALTER TABLE `tb_estado_producto` DISABLE KEYS */;
INSERT INTO `tb_estado_producto` VALUES (1,'Activo'),(2,'Inactivo'),(3,'Eliminado');
/*!40000 ALTER TABLE `tb_estado_producto` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tb_estado_usuario`
--

DROP TABLE IF EXISTS `tb_estado_usuario`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
 SET character_set_client = utf8mb4 ;
CREATE TABLE `tb_estado_usuario` (
  `id_estado` int(11) NOT NULL,
  `descripcion_estado` varchar(45) NOT NULL,
  PRIMARY KEY (`id_estado`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 ;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tb_estado_usuario`
--

LOCK TABLES `tb_estado_usuario` WRITE;
/*!40000 ALTER TABLE `tb_estado_usuario` DISABLE KEYS */;
INSERT INTO `tb_estado_usuario` VALUES (1,'Activo'),(2,'Inactivo');
/*!40000 ALTER TABLE `tb_estado_usuario` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tb_facturas`
--

DROP TABLE IF EXISTS `tb_facturas`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
 SET character_set_client = utf8mb4 ;
CREATE TABLE `tb_facturas` (
  `id_factura` int(11) NOT NULL AUTO_INCREMENT,
  `rut_proveedor` int(11) NOT NULL,
  `numero_factura` text NOT NULL,
  `fecha_factura` date NOT NULL,
  PRIMARY KEY (`id_factura`),
  KEY `FK_tb_factura_proveedores_idx` (`rut_proveedor`),
  CONSTRAINT `FK_tb_factura_proveedores` FOREIGN KEY (`rut_proveedor`) REFERENCES `tb_proveedores` (`rut_proveedor`) ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 ;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tb_facturas`
--

LOCK TABLES `tb_facturas` WRITE;
/*!40000 ALTER TABLE `tb_facturas` DISABLE KEYS */;
INSERT INTO `tb_facturas` VALUES (1,18273352,'1','2019-01-11'),(2,20527322,'2','2019-03-12'),(3,18273352,'12344321','2019-03-14'),(4,18273352,'12344321324','2019-03-14');
/*!40000 ALTER TABLE `tb_facturas` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tb_marca`
--

DROP TABLE IF EXISTS `tb_marca`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
 SET character_set_client = utf8mb4 ;
CREATE TABLE `tb_marca` (
  `id_marca` int(11) NOT NULL DEFAULT '1',
  `nombre_marca` varchar(45) NOT NULL,
  PRIMARY KEY (`id_marca`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 ;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tb_marca`
--

LOCK TABLES `tb_marca` WRITE;
/*!40000 ALTER TABLE `tb_marca` DISABLE KEYS */;
INSERT INTO `tb_marca` VALUES (1,'cocacola');
/*!40000 ALTER TABLE `tb_marca` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tb_productos`
--

DROP TABLE IF EXISTS `tb_productos`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
 SET character_set_client = utf8mb4 ;
CREATE TABLE `tb_productos` (
  `id_producto` int(11) NOT NULL,
  `descripcion` varchar(45) NOT NULL,
  `stock_minimo` int(11) NOT NULL,
  `id_categoria` int(11) NOT NULL,
  `id_marca` int(11) NOT NULL,
  `id_estado` int(11) NOT NULL,
  PRIMARY KEY (`id_producto`),
  KEY `FK_productos_marca_idx` (`id_marca`),
  KEY `FK_produtos_categoria_idx` (`id_categoria`),
  KEY `FK_productos_estado_idx` (`id_estado`),
  CONSTRAINT `FK_productos_estado` FOREIGN KEY (`id_estado`) REFERENCES `tb_estado_producto` (`id_estado`) ON UPDATE CASCADE,
  CONSTRAINT `FK_productos_marca` FOREIGN KEY (`id_marca`) REFERENCES `tb_marca` (`id_marca`) ON UPDATE CASCADE,
  CONSTRAINT `FK_produtos_categoria` FOREIGN KEY (`id_categoria`) REFERENCES `tb_categoria` (`id_categoria`) ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 ;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tb_productos`
--

LOCK TABLES `tb_productos` WRITE;
/*!40000 ALTER TABLE `tb_productos` DISABLE KEYS */;
INSERT INTO `tb_productos` VALUES (1,'pan',100,1,1,1),(56,'buenos dias buenas tardes',200,2,1,1),(45678,'express',12,1,1,1),(45679,'retornable',12,1,1,1);
/*!40000 ALTER TABLE `tb_productos` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tb_proveedores`
--

DROP TABLE IF EXISTS `tb_proveedores`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
 SET character_set_client = utf8mb4 ;
CREATE TABLE `tb_proveedores` (
  `rut_proveedor` int(11) NOT NULL,
  `dv` varchar(1) NOT NULL,
  `razon_social` varchar(45) NOT NULL,
  `direccion` varchar(45) NOT NULL,
  `telefono` int(11) NOT NULL,
  `giro` varchar(45) NOT NULL,
  `correo` varchar(45) NOT NULL,
  PRIMARY KEY (`rut_proveedor`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 ;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tb_proveedores`
--

LOCK TABLES `tb_proveedores` WRITE;
/*!40000 ALTER TABLE `tb_proveedores` DISABLE KEYS */;
INSERT INTO `tb_proveedores` VALUES (18273352,'0','Billy ALmacenes s','los perros 123a',825372401,'Cosmeticosa','billy@billy.cll'),(18319075,'k','johnny','jojaosjoajao ',67898666,'undostres','laskdfjladlkdjfcl'),(20527322,'0','camila','cuevas',22222,'22222','22222@gmail.com');
/*!40000 ALTER TABLE `tb_proveedores` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tb_tipo_usuario`
--

DROP TABLE IF EXISTS `tb_tipo_usuario`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
 SET character_set_client = utf8mb4 ;
CREATE TABLE `tb_tipo_usuario` (
  `id_tipo_usuario` int(11) NOT NULL,
  `descripcion_tipo_usuario` varchar(45) NOT NULL,
  PRIMARY KEY (`id_tipo_usuario`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 ;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tb_tipo_usuario`
--

LOCK TABLES `tb_tipo_usuario` WRITE;
/*!40000 ALTER TABLE `tb_tipo_usuario` DISABLE KEYS */;
INSERT INTO `tb_tipo_usuario` VALUES (1,'Administrador');
/*!40000 ALTER TABLE `tb_tipo_usuario` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tb_usuarios`
--

DROP TABLE IF EXISTS `tb_usuarios`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
 SET character_set_client = utf8mb4 ;
CREATE TABLE `tb_usuarios` (
  `rut` int(11) NOT NULL,
  `digito_verificador` varchar(1) NOT NULL,
  `nombre` varchar(45) NOT NULL,
  `clave` text NOT NULL,
  `estado` int(11) NOT NULL,
  `tipo_usuario` int(11) NOT NULL,
  `correo` text NOT NULL,
  PRIMARY KEY (`rut`),
  KEY `FK_usuario_tipo_usuario_idx` (`tipo_usuario`),
  KEY `FK_usuario_estado_usuario_idx` (`estado`),
  CONSTRAINT `FK_usuario_estado_usuario` FOREIGN KEY (`estado`) REFERENCES `tb_estado_usuario` (`id_estado`) ON UPDATE CASCADE,
  CONSTRAINT `FK_usuario_tipo_usuario` FOREIGN KEY (`tipo_usuario`) REFERENCES `tb_tipo_usuario` (`id_tipo_usuario`) ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 ;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tb_usuarios`
--

LOCK TABLES `tb_usuarios` WRITE;
/*!40000 ALTER TABLE `tb_usuarios` DISABLE KEYS */;
INSERT INTO `tb_usuarios` VALUES (18319075,'k','Johnny','$2y$10$at0azrC09iVLAdu0it3Ua.DNsw1mAvlFCUqbOOWgzLPQAQ/mrNvaC',1,1,'johnny@jola.cl');
/*!40000 ALTER TABLE `tb_usuarios` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tb_ventas`
--

DROP TABLE IF EXISTS `tb_ventas`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
 SET character_set_client = utf8mb4 ;
CREATE TABLE `tb_ventas` (
  `id_venta` int(11) NOT NULL AUTO_INCREMENT,
  `total` int(11) NOT NULL,
  `fecha` datetime NOT NULL,
  PRIMARY KEY (`id_venta`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 ;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tb_ventas`
--

LOCK TABLES `tb_ventas` WRITE;
/*!40000 ALTER TABLE `tb_ventas` DISABLE KEYS */;
/*!40000 ALTER TABLE `tb_ventas` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Temporary view structure for view `vista_factura`
--

DROP TABLE IF EXISTS `vista_factura`;
/*!50001 DROP VIEW IF EXISTS `vista_factura`*/;
SET @saved_cs_client     = @@character_set_client;
SET character_set_client = utf8mb4;
/*!50001 CREATE VIEW `vista_factura` AS SELECT
 1 AS `id_factura`,
 1 AS `Codigo`,
 1 AS `Descripcion`,
 1 AS `Marca`,
 1 AS `Categoria`,
 1 AS `Cantidad`,
 1 AS `Valor`*/;
SET character_set_client = @saved_cs_client;

--
-- Temporary view structure for view `vista_usuario`
--

DROP TABLE IF EXISTS `vista_usuario`;
/*!50001 DROP VIEW IF EXISTS `vista_usuario`*/;
SET @saved_cs_client     = @@character_set_client;
SET character_set_client = utf8mb4;
/*!50001 CREATE VIEW `vista_usuario` AS SELECT
 1 AS `rut`,
 1 AS `digito_verificador`,
 1 AS `nombre`,
 1 AS `clave`,
 1 AS `estado`,
 1 AS `descripcion_estado`,
 1 AS `tipo_usuario`,
 1 AS `descripcion_tipo_usuario`,
 1 AS `correo`*/;
SET character_set_client = @saved_cs_client;

--
-- Dumping routines for database 'control_stock'
--
/*!50003 DROP PROCEDURE IF EXISTS `comprobar_usuario` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8mb4 */ ;
/*!50003 SET character_set_results = utf8mb4 */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'STRICT_TRANS_TABLES,NO_ENGINE_SUBSTITUTION' */ ;
DELIMITER ;;
CREATE DEFINER=`root`@`localhost` PROCEDURE `comprobar_usuario`(rut_par int)
BEGIN

select * from tb_usuarios where rut=rut_par;

END ;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;

--
-- Final view structure for view `vista_factura`
--

/*!50001 DROP VIEW IF EXISTS `vista_factura`*/;
/*!50001 SET @saved_cs_client          = @@character_set_client */;
/*!50001 SET @saved_cs_results         = @@character_set_results */;
/*!50001 SET @saved_col_connection     = @@collation_connection */;
/*!50001 SET character_set_client      = utf8mb4 */;
/*!50001 SET character_set_results     = utf8mb4 */;
/*!50001 CREATE ALGORITHM=UNDEFINED */
/*!50013 DEFINER=`root`@`localhost` SQL SECURITY DEFINER */
/*!50001 VIEW `vista_factura` AS select `df`.`id_factura` AS `id_factura`,`p`.`id_producto` AS `Codigo`,`p`.`descripcion` AS `Descripcion`,`m`.`nombre_marca` AS `Marca`,`c`.`descripcion_categoria` AS `Categoria`,`df`.`cantidad` AS `Cantidad`,`df`.`valor` AS `Valor` from (((`tb_detalle_factura` `df` join `tb_productos` `p` on((`p`.`id_producto` = `df`.`id_producto`))) join `tb_marca` `m` on((`p`.`id_marca` = `m`.`id_marca`))) join `tb_categoria` `c` on((`p`.`id_categoria` = `c`.`id_categoria`))) */;
/*!50001 SET character_set_client      = @saved_cs_client */;
/*!50001 SET character_set_results     = @saved_cs_results */;
/*!50001 SET collation_connection      = @saved_col_connection */;

--
-- Final view structure for view `vista_usuario`
--

/*!50001 DROP VIEW IF EXISTS `vista_usuario`*/;
/*!50001 SET @saved_cs_client          = @@character_set_client */;
/*!50001 SET @saved_cs_results         = @@character_set_results */;
/*!50001 SET @saved_col_connection     = @@collation_connection */;
/*!50001 SET character_set_client      = utf8mb4 */;
/*!50001 SET character_set_results     = utf8mb4 */;
/*!50001 CREATE ALGORITHM=UNDEFINED */
/*!50013 DEFINER=`root`@`localhost` SQL SECURITY DEFINER */
/*!50001 VIEW `vista_usuario` AS select `u`.`rut` AS `rut`,`u`.`digito_verificador` AS `digito_verificador`,`u`.`nombre` AS `nombre`,`u`.`clave` AS `clave`,`u`.`estado` AS `estado`,`eu`.`descripcion_estado` AS `descripcion_estado`,`u`.`tipo_usuario` AS `tipo_usuario`,`tu`.`descripcion_tipo_usuario` AS `descripcion_tipo_usuario`,`u`.`correo` AS `correo` from ((`tb_usuarios` `u` join `tb_estado_usuario` `eu` on((`u`.`estado` = `eu`.`id_estado`))) join `tb_tipo_usuario` `tu` on((`u`.`tipo_usuario` = `tu`.`id_tipo_usuario`))) */;
/*!50001 SET character_set_client      = @saved_cs_client */;
/*!50001 SET character_set_results     = @saved_cs_results */;
/*!50001 SET collation_connection      = @saved_col_connection */;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2019-03-18 18:32:58
