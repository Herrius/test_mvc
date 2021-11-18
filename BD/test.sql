-- --------------------------------------------------------
-- Host:                         127.0.0.1
-- Versión del servidor:         5.7.33 - MySQL Community Server (GPL)
-- SO del servidor:              Win64
-- HeidiSQL Versión:             11.2.0.6213
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8 */;
/*!50503 SET NAMES utf8mb4 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;


-- Volcando estructura de base de datos para test
DROP DATABASE IF EXISTS `test`;
CREATE DATABASE IF NOT EXISTS `test` /*!40100 DEFAULT CHARACTER SET latin1 */;
USE `test`;

-- Volcando estructura para tabla test.docente_retroalimentacion
DROP TABLE IF EXISTS `docente_retroalimentacion`;
CREATE TABLE IF NOT EXISTS `docente_retroalimentacion` (
  `tipo_aprendizaje` text NOT NULL,
  `retreoalimentacion` varchar(800) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- La exportación de datos fue deseleccionada.

-- Volcando estructura para procedimiento test.PS_MOSTRAR_RETROALIMENTACION
DROP PROCEDURE IF EXISTS `PS_MOSTRAR_RETROALIMENTACION`;
DELIMITER //
CREATE PROCEDURE `PS_MOSTRAR_RETROALIMENTACION`()
SELECT *from docente_retroalimentacion//
DELIMITER ;

-- Volcando estructura para procedimiento test.SP_ACTIVO_REFLECTIVO
DROP PROCEDURE IF EXISTS `SP_ACTIVO_REFLECTIVO`;
DELIMITER //
CREATE PROCEDURE `SP_ACTIVO_REFLECTIVO`()
SELECT * FROM tblrespuestas WHERE codestudiante='71444762'//
DELIMITER ;

-- Volcando estructura para procedimiento test.SP_BUSQUEDA_ESTUDIANTES
DROP PROCEDURE IF EXISTS `SP_BUSQUEDA_ESTUDIANTES`;
DELIMITER //
CREATE PROCEDURE `SP_BUSQUEDA_ESTUDIANTES`()
SELECT * FROM tblconsulta WHERE codestudiante NOT LIKE '' ORDER By codestudiante LIMIT 25//
DELIMITER ;

-- Volcando estructura para procedimiento test.SP_BUSQUEDA_SALON
DROP PROCEDURE IF EXISTS `SP_BUSQUEDA_SALON`;
DELIMITER //
CREATE PROCEDURE `SP_BUSQUEDA_SALON`()
SELECT * FROM tblconsultasalon WHERE NRC NOT LIKE '' ORDER By NRC LIMIT 25//
DELIMITER ;

-- Volcando estructura para procedimiento test.SP_MOSTRAR_RESULTADO
DROP PROCEDURE IF EXISTS `SP_MOSTRAR_RESULTADO`;
DELIMITER //
CREATE PROCEDURE `SP_MOSTRAR_RESULTADO`(IN `codigo` VARCHAR(27))
SELECT * FROM tblresultados WHERE `codestudiante`=codigo LIMIT 1//
DELIMITER ;

-- Volcando estructura para procedimiento test.SP_REPORTE_AULA_AR
DROP PROCEDURE IF EXISTS `SP_REPORTE_AULA_AR`;
DELIMITER //
CREATE PROCEDURE `SP_REPORTE_AULA_AR`(IN `estiloC` VARCHAR(15), IN `NRCC` INT(6))
SELECT COUNT(activoreflexivo) AS NESTUDIANTES FROM `tblresultados` WHERE codestudiante IN(SELECT codestudiante FROM `tblconsulta` WHERE NRC=NRCC) AND activoreflexivo=estiloC//
DELIMITER ;

-- Volcando estructura para procedimiento test.SP_REPORTE_AULA_SG
DROP PROCEDURE IF EXISTS `SP_REPORTE_AULA_SG`;
DELIMITER //
CREATE PROCEDURE `SP_REPORTE_AULA_SG`(IN `estiloC` VARCHAR(15), IN `NRCC` INT(6))
SELECT COUNT(secuencialglobal) AS NESTUDIANTES FROM `tblresultados` WHERE codestudiante IN(SELECT codestudiante FROM `tblconsulta` WHERE NRC=NRCC) AND secuencialglobal=estiloC//
DELIMITER ;

-- Volcando estructura para tabla test.tblconsulta
DROP TABLE IF EXISTS `tblconsulta`;
CREATE TABLE IF NOT EXISTS `tblconsulta` (
  `codestudiante` int(8) NOT NULL,
  `nombreest` varchar(80) NOT NULL,
  `NRC` int(6) NOT NULL,
  PRIMARY KEY (`codestudiante`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- La exportación de datos fue deseleccionada.

-- Volcando estructura para tabla test.tblconsultasalon
DROP TABLE IF EXISTS `tblconsultasalon`;
CREATE TABLE IF NOT EXISTS `tblconsultasalon` (
  `NRC` int(8) NOT NULL,
  `Nombreasignatura` varchar(50) NOT NULL,
  PRIMARY KEY (`NRC`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- La exportación de datos fue deseleccionada.

-- Volcando estructura para tabla test.tblestudiante
DROP TABLE IF EXISTS `tblestudiante`;
CREATE TABLE IF NOT EXISTS `tblestudiante` (
  `CodEstudiante` int(8) NOT NULL,
  `ApellidosNombres` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- La exportación de datos fue deseleccionada.

-- Volcando estructura para tabla test.tblpreguntas
DROP TABLE IF EXISTS `tblpreguntas`;
CREATE TABLE IF NOT EXISTS `tblpreguntas` (
  `idpregunta` int(2) NOT NULL,
  `enunciado` varchar(200) NOT NULL,
  `opcion1` varchar(200) NOT NULL,
  `opcion2` varchar(200) NOT NULL,
  `tipo_pregunta` varchar(20) NOT NULL,
  PRIMARY KEY (`idpregunta`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- La exportación de datos fue deseleccionada.

-- Volcando estructura para tabla test.tblprueba
DROP TABLE IF EXISTS `tblprueba`;
CREATE TABLE IF NOT EXISTS `tblprueba` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `codigo_estudiante` varchar(27) NOT NULL,
  `pregunta` int(2) NOT NULL,
  `respuesta` varchar(1) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `tblprueba_ibfk_1` (`pregunta`),
  CONSTRAINT `tblprueba_ibfk_1` FOREIGN KEY (`pregunta`) REFERENCES `tblpreguntas` (`idpregunta`)
) ENGINE=InnoDB AUTO_INCREMENT=221 DEFAULT CHARSET=latin1;

-- La exportación de datos fue deseleccionada.

-- Volcando estructura para tabla test.tblrespuestas
DROP TABLE IF EXISTS `tblrespuestas`;
CREATE TABLE IF NOT EXISTS `tblrespuestas` (
  `codestudiante` int(8) NOT NULL,
  `idpregunta` int(2) NOT NULL,
  `respuesta1` int(1) NOT NULL,
  `respuesta2` int(1) NOT NULL,
  PRIMARY KEY (`codestudiante`),
  KEY `idpregunta` (`idpregunta`),
  CONSTRAINT `tblrespuestas_ibfk_1` FOREIGN KEY (`idpregunta`) REFERENCES `tblpreguntas` (`idpregunta`) ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- La exportación de datos fue deseleccionada.

-- Volcando estructura para tabla test.tblresultados
DROP TABLE IF EXISTS `tblresultados`;
CREATE TABLE IF NOT EXISTS `tblresultados` (
  `idresultado` int(10) NOT NULL AUTO_INCREMENT,
  `codestudiante` varchar(27) NOT NULL,
  `nivelactref` int(3) NOT NULL,
  `nivelsenint` int(3) NOT NULL,
  `nivelvisver` int(3) NOT NULL,
  `nivelsecglo` int(3) NOT NULL,
  PRIMARY KEY (`idresultado`),
  KEY `codestudiante` (`codestudiante`),
  CONSTRAINT `tblresultados_ibfk_1` FOREIGN KEY (`codestudiante`) REFERENCES `users` (`email`)
) ENGINE=InnoDB AUTO_INCREMENT=59 DEFAULT CHARSET=latin1;

-- La exportación de datos fue deseleccionada.

-- Volcando estructura para tabla test.users
DROP TABLE IF EXISTS `users`;
CREATE TABLE IF NOT EXISTS `users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `email` varchar(200) NOT NULL,
  `password` varchar(200) NOT NULL,
  `id_rol` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `email` (`email`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=latin1;

-- La exportación de datos fue deseleccionada.

/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IFNULL(@OLD_FOREIGN_KEY_CHECKS, 1) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40111 SET SQL_NOTES=IFNULL(@OLD_SQL_NOTES, 1) */;
