-- MariaDB dump 10.19  Distrib 10.4.24-MariaDB, for Win64 (AMD64)
--
-- Host: localhost    Database: speedservice
-- ------------------------------------------------------
-- Server version	10.4.24-MariaDB

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

--
-- Table structure for table `categorias`
--

DROP TABLE IF EXISTS `categorias`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `categorias` (
  `idCategoria` int(11) NOT NULL AUTO_INCREMENT,
  `categoria` varchar(250) NOT NULL,
  `descripcionCategoria` varchar(250) NOT NULL,
  `imgCategoria` varchar(250) NOT NULL,
  `bajaCategoria` tinyint(4) NOT NULL,
  PRIMARY KEY (`idCategoria`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `categorias`
--

LOCK TABLES `categorias` WRITE;
/*!40000 ALTER TABLE `categorias` DISABLE KEYS */;
INSERT INTO `categorias` VALUES (1,'flete','Dejá tu carga en buenas manos.','FLETE_MOVIMIENTO.jpg',0),(2,'Mandados','Prueba','fondoin.jpg',0),(3,'remis','Si querés moverte, nosotros te llevamos.','fondo1.jpg',0),(4,'electricista','Prueba','fondo.jpg',1);
/*!40000 ALTER TABLE `categorias` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `estado_servicio`
--

DROP TABLE IF EXISTS `estado_servicio`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `estado_servicio` (
  `idEstadoServicio` int(11) NOT NULL AUTO_INCREMENT,
  `estadoServicio` varchar(250) NOT NULL,
  PRIMARY KEY (`idEstadoServicio`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `estado_servicio`
--

LOCK TABLES `estado_servicio` WRITE;
/*!40000 ALTER TABLE `estado_servicio` DISABLE KEYS */;
INSERT INTO `estado_servicio` VALUES (1,'Pendiente de aprobación'),(2,'Aprobado'),(3,'Rechazado');
/*!40000 ALTER TABLE `estado_servicio` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `fotos_vehiculo`
--

DROP TABLE IF EXISTS `fotos_vehiculo`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `fotos_vehiculo` (
  `idFoto` int(11) NOT NULL AUTO_INCREMENT,
  `urlFoto` varchar(250) NOT NULL,
  `idVehiculo` int(11) NOT NULL,
  PRIMARY KEY (`idFoto`),
  KEY `FK_vehiculo` (`idVehiculo`),
  CONSTRAINT `relacion_foto_vehiculo` FOREIGN KEY (`idVehiculo`) REFERENCES `vehiculos` (`idVehiculo`)
) ENGINE=InnoDB AUTO_INCREMENT=54 DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `fotos_vehiculo`
--

LOCK TABLES `fotos_vehiculo` WRITE;
/*!40000 ALTER TABLE `fotos_vehiculo` DISABLE KEYS */;
INSERT INTO `fotos_vehiculo` VALUES (52,'alumbrado.png',23),(53,'animales.png',23);
/*!40000 ALTER TABLE `fotos_vehiculo` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `notificaciones`
--

DROP TABLE IF EXISTS `notificaciones`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `notificaciones` (
  `idNotificacion` int(11) NOT NULL AUTO_INCREMENT,
  `descripcion` varchar(250) NOT NULL,
  `idUsuarioNotificado` int(11) NOT NULL,
  `idSolicitud` int(11) NOT NULL,
  `idProveedor` int(11) NOT NULL,
  `visto` tinyint(4) NOT NULL,
  PRIMARY KEY (`idNotificacion`),
  KEY `FK_usuarioNotificado` (`idUsuarioNotificado`),
  KEY `FK_usuarioProveedor` (`idProveedor`),
  KEY `FK_solicitud` (`idSolicitud`),
  CONSTRAINT `relacion_notificacion_proveedor` FOREIGN KEY (`idProveedor`) REFERENCES `usuarios` (`idUsuario`),
  CONSTRAINT `relacion_notificacion_solicitud` FOREIGN KEY (`idSolicitud`) REFERENCES `solicitud_servicio` (`idSolicitud`),
  CONSTRAINT `relacion_notificacion_usuario_notificado` FOREIGN KEY (`idUsuarioNotificado`) REFERENCES `usuarios` (`idUsuario`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `notificaciones`
--

LOCK TABLES `notificaciones` WRITE;
/*!40000 ALTER TABLE `notificaciones` DISABLE KEYS */;
INSERT INTO `notificaciones` VALUES (1,'asdasda',2,9,3,0);
/*!40000 ALTER TABLE `notificaciones` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `rol`
--

DROP TABLE IF EXISTS `rol`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `rol` (
  `idRol` int(11) NOT NULL AUTO_INCREMENT,
  `rol` varchar(100) NOT NULL,
  PRIMARY KEY (`idRol`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `rol`
--

LOCK TABLES `rol` WRITE;
/*!40000 ALTER TABLE `rol` DISABLE KEYS */;
INSERT INTO `rol` VALUES (1,'usuario'),(2,'proveedor'),(3,'administrador');
/*!40000 ALTER TABLE `rol` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `servicios`
--

DROP TABLE IF EXISTS `servicios`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `servicios` (
  `idServicio` int(11) NOT NULL AUTO_INCREMENT,
  `nombreServicio` varchar(250) NOT NULL,
  `descripcionServicio` text NOT NULL,
  `horarioServicio` varchar(300) NOT NULL,
  `idCategoria` int(11) NOT NULL,
  `idVehiculo` int(11) NOT NULL,
  `fechaAltaServicio` datetime NOT NULL DEFAULT current_timestamp(),
  `alcance` text NOT NULL,
  `likes` int(11) DEFAULT NULL,
  `idEstadoServicio` int(11) NOT NULL,
  `idUsuario` int(11) NOT NULL,
  `precioServicio` decimal(10,2) NOT NULL,
  PRIMARY KEY (`idServicio`),
  KEY `FK_Estado_Servicio` (`idEstadoServicio`),
  KEY `FK_categoria` (`idCategoria`),
  KEY `FK_vehiculo` (`idVehiculo`),
  KEY `FK_usuario` (`idUsuario`),
  CONSTRAINT `relacion_servicio_categoria` FOREIGN KEY (`idCategoria`) REFERENCES `categorias` (`idCategoria`),
  CONSTRAINT `relacion_servicio_estado` FOREIGN KEY (`idEstadoServicio`) REFERENCES `estado_servicio` (`idEstadoServicio`),
  CONSTRAINT `relacion_servicio_usuario` FOREIGN KEY (`idUsuario`) REFERENCES `usuarios` (`idUsuario`),
  CONSTRAINT `relacion_servicio_vehiculo` FOREIGN KEY (`idVehiculo`) REFERENCES `vehiculos` (`idVehiculo`)
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `servicios`
--

LOCK TABLES `servicios` WRITE;
/*!40000 ALTER TABLE `servicios` DISABLE KEYS */;
INSERT INTO `servicios` VALUES (9,'Fletes Mario Perez','Fletes y Mudanzas.','09 a 20',1,23,'2022-09-26 12:38:46','500km',NULL,2,3,500.00);
/*!40000 ALTER TABLE `servicios` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `solicitud_servicio`
--

DROP TABLE IF EXISTS `solicitud_servicio`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `solicitud_servicio` (
  `idSolicitud` int(11) NOT NULL AUTO_INCREMENT,
  `fecha` date NOT NULL,
  `hora` varchar(250) NOT NULL,
  `descripcion` text NOT NULL,
  `precioServicio` decimal(10,2) NOT NULL,
  `idCliente` int(11) NOT NULL,
  `idEstado` int(11) NOT NULL,
  `idServicio` int(11) NOT NULL,
  PRIMARY KEY (`idSolicitud`),
  KEY `FK_Cliente` (`idCliente`),
  KEY `FK_estado` (`idEstado`),
  KEY `FK_servicio` (`idServicio`),
  CONSTRAINT `relacion_solicitud_cliente` FOREIGN KEY (`idCliente`) REFERENCES `usuarios` (`idUsuario`),
  CONSTRAINT `relacion_solicitud_estado` FOREIGN KEY (`idEstado`) REFERENCES `estado_servicio` (`idEstadoServicio`),
  CONSTRAINT `relacion_solicitud_servicio` FOREIGN KEY (`idServicio`) REFERENCES `servicios` (`idServicio`)
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `solicitud_servicio`
--

LOCK TABLES `solicitud_servicio` WRITE;
/*!40000 ALTER TABLE `solicitud_servicio` DISABLE KEYS */;
INSERT INTO `solicitud_servicio` VALUES (1,'2022-10-20','16 horas.','Flete para Av. San Martin 334 a Repulica 1029',500.00,3,1,9),(2,'2022-12-20','15:30 hs.','Flete de Av. La Plata 123 a Repulica 3309',500.00,2,1,9),(3,'2022-12-20','15:30 hs.','Flete de Av. La Plata 123 a Repulica 3309',500.00,2,1,9),(4,'2022-12-20','15:30 hs.','Flete de Av. La Plata 123 a Repulica 3309',500.00,2,1,9),(5,'2022-12-20','15:30 hs.','Flete de Av. La Plata 123 a Repulica 3309',500.00,2,1,9),(6,'2022-12-20','15:30 hs.','Flete de Av. La Plata 123 a Repulica 3309',500.00,2,1,9),(7,'2022-12-20','15:30 hs.','Flete de Av. La Plata 123 a Repulica 3309',500.00,2,1,9),(8,'2022-10-15','asddas','asdasda',500.00,2,1,9),(9,'2022-10-15','asddas','asdasda',500.00,2,1,9);
/*!40000 ALTER TABLE `solicitud_servicio` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tipo_vehiculo`
--

DROP TABLE IF EXISTS `tipo_vehiculo`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tipo_vehiculo` (
  `idTipo` int(11) NOT NULL AUTO_INCREMENT,
  `tipo` varchar(250) NOT NULL,
  PRIMARY KEY (`idTipo`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tipo_vehiculo`
--

LOCK TABLES `tipo_vehiculo` WRITE;
/*!40000 ALTER TABLE `tipo_vehiculo` DISABLE KEYS */;
INSERT INTO `tipo_vehiculo` VALUES (1,'bicicleta'),(2,'moto'),(3,'auto'),(4,'camion'),(5,'camioneta');
/*!40000 ALTER TABLE `tipo_vehiculo` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `usuarios`
--

DROP TABLE IF EXISTS `usuarios`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `usuarios` (
  `idUsuario` int(11) NOT NULL AUTO_INCREMENT,
  `imgUsuario` varchar(250) NOT NULL,
  `nombreCompleto` varchar(250) NOT NULL,
  `correo` varchar(250) NOT NULL,
  `password` varchar(400) NOT NULL,
  `telefono` varchar(100) NOT NULL,
  `dni` varchar(8) NOT NULL,
  `direccion` varchar(250) NOT NULL,
  `fechaNacimiento` date NOT NULL,
  `fechaDeAlta` datetime NOT NULL DEFAULT current_timestamp(),
  `idRol` int(11) NOT NULL,
  `verificado` varchar(255) NOT NULL,
  PRIMARY KEY (`idUsuario`),
  KEY `FK_rol` (`idRol`),
  CONSTRAINT `relacion_usuario_rol` FOREIGN KEY (`idRol`) REFERENCES `rol` (`idRol`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `usuarios`
--

LOCK TABLES `usuarios` WRITE;
/*!40000 ALTER TABLE `usuarios` DISABLE KEYS */;
INSERT INTO `usuarios` VALUES (1,'flan.jpg','Manuel Diaz','manu@gmail.com','','4564564654','32659879','asdasdasd 123','1990-05-02','2022-09-01 20:19:36',1,''),(2,'20220613_190301.jpg','Florencia Perez','prueba@gmail.com','$2y$10$0edUJAL5N4074mHvM..YJuNhRwnWgMbvVo1OJlYrt7siCZZYhihiq','4564-654546','35989656','Av. san martin 334','2006-09-04','2022-09-05 11:22:17',1,'TRUE'),(3,'team-4.jpg','Federico Paez','fede@gmail.com','$2y$10$9x/7rZyYPAvQt0G7UVm51.XtkkpIvergqhlsNrOMsOnYoCcKK4Vtq','2364-569865','32656989','Av. Libertador 335','2006-02-02','2022-09-05 12:28:02',1,'TRUE'),(4,'team-4.jpg','Fran Perez','fran@gmail.com','$2y$10$nVxe6Px/FDVwNBd/ddiNZufV9bIgwxWS1TpAkOaINQCvt2YZR69x2','2365-659865','32656989','Av. Suipacha 32','2000-02-02','2022-09-05 12:32:30',3,'TRUE');
/*!40000 ALTER TABLE `usuarios` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `vehiculos`
--

DROP TABLE IF EXISTS `vehiculos`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `vehiculos` (
  `idVehiculo` int(11) NOT NULL AUTO_INCREMENT,
  `patente` varchar(12) DEFAULT NULL,
  `img_seguro` varchar(250) DEFAULT NULL,
  `img_vtv` varchar(250) DEFAULT NULL,
  `capacidad` text NOT NULL,
  `descripcionVehiculo` varchar(250) NOT NULL,
  `idTipo` int(11) NOT NULL,
  `idUsuario` int(11) NOT NULL,
  PRIMARY KEY (`idVehiculo`),
  KEY `FK_tipo` (`idTipo`),
  KEY `FK_usuario` (`idUsuario`),
  CONSTRAINT `relacion_vehiculo_tipo` FOREIGN KEY (`idTipo`) REFERENCES `tipo_vehiculo` (`idTipo`),
  CONSTRAINT `relacion_vehiculo_usuario` FOREIGN KEY (`idUsuario`) REFERENCES `usuarios` (`idUsuario`)
) ENGINE=InnoDB AUTO_INCREMENT=24 DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `vehiculos`
--

LOCK TABLES `vehiculos` WRITE;
/*!40000 ALTER TABLE `vehiculos` DISABLE KEYS */;
INSERT INTO `vehiculos` VALUES (23,'730asd','alumbrado.png','alumbrado.png','8000 kg.','Camioneta 0 km.',5,3);
/*!40000 ALTER TABLE `vehiculos` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2022-10-13 20:54:45
