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
CREATE DATABASE IF NOT EXISTS `test` /*!40100 DEFAULT CHARACTER SET latin1 */;
USE `test`;

-- Volcando estructura para tabla test.tblrespuestas_ml
CREATE TABLE IF NOT EXISTS `tblrespuestas_ml` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `codigo_estudiante` varchar(27) NOT NULL,
  `pregunta` int(2) NOT NULL,
  `respuesta` varchar(1) NOT NULL,
  PRIMARY KEY (`id`) USING BTREE,
  KEY `tblrespuestas_ibfk_1` (`pregunta`) USING BTREE,
  CONSTRAINT `tblrespuestas_ml_ibfk_1` FOREIGN KEY (`pregunta`) REFERENCES `tblpreguntas` (`idpregunta`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=380 DEFAULT CHARSET=latin1 ROW_FORMAT=DYNAMIC;

-- Volcando datos para la tabla test.tblrespuestas_ml: ~20 rows (aproximadamente)
/*!40000 ALTER TABLE `tblrespuestas_ml` DISABLE KEYS */;
INSERT INTO `tblrespuestas_ml` (`id`, `codigo_estudiante`, `pregunta`, `respuesta`) VALUES
	(360, '76927894@continental.edu.pe', 1, '2'),
	(361, '76927894@continental.edu.pe', 2, '1'),
	(362, '76927894@continental.edu.pe', 8, '1'),
	(363, '76927894@continental.edu.pe', 14, '2'),
	(364, '76927894@continental.edu.pe', 15, '2'),
	(365, '76927894@continental.edu.pe', 16, '2'),
	(366, '76927894@continental.edu.pe', 17, '0'),
	(367, '76927894@continental.edu.pe', 20, '0'),
	(368, '76927894@continental.edu.pe', 22, '0'),
	(369, '76927894@continental.edu.pe', 24, '0'),
	(370, '76927894@continental.edu.pe', 26, '2'),
	(371, '76927894@continental.edu.pe', 27, '0'),
	(372, '76927894@continental.edu.pe', 30, '2'),
	(373, '76927894@continental.edu.pe', 31, '0'),
	(374, '76927894@continental.edu.pe', 33, '0'),
	(375, '76927894@continental.edu.pe', 35, '2'),
	(376, '76927894@continental.edu.pe', 36, '2'),
	(377, '76927894@continental.edu.pe', 37, '0'),
	(378, '76927894@continental.edu.pe', 39, '0'),
	(379, '76927894@continental.edu.pe', 41, '0');
/*!40000 ALTER TABLE `tblrespuestas_ml` ENABLE KEYS */;

-- Volcando estructura para tabla test.tblresultados_ml
CREATE TABLE IF NOT EXISTS `tblresultados_ml` (
  `idresultado` int(10) NOT NULL AUTO_INCREMENT,
  `codestudiante` varchar(27) NOT NULL,
  `fullnombre` varchar(50) DEFAULT NULL,
  `nivelactref` int(3) NOT NULL,
  `nivelsenint` int(3) NOT NULL,
  `nivelvisver` int(3) NOT NULL,
  `nivelsecglo` int(3) NOT NULL,
  `curso` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`idresultado`) USING BTREE,
  KEY `codestudiante` (`codestudiante`) USING BTREE,
  KEY `FK_tblresultados_users_2` (`curso`) USING BTREE,
  CONSTRAINT `tblresultados_ml_ibfk_1` FOREIGN KEY (`codestudiante`) REFERENCES `users` (`email`),
  CONSTRAINT `tblresultados_ml_ibfk_2` FOREIGN KEY (`curso`) REFERENCES `users` (`curso`)
) ENGINE=InnoDB AUTO_INCREMENT=27 DEFAULT CHARSET=latin1 ROW_FORMAT=DYNAMIC;

-- Volcando datos para la tabla test.tblresultados_ml: ~0 rows (aproximadamente)
/*!40000 ALTER TABLE `tblresultados_ml` DISABLE KEYS */;
INSERT INTO `tblresultados_ml` (`idresultado`, `codestudiante`, `fullnombre`, `nivelactref`, `nivelsenint`, `nivelvisver`, `nivelsecglo`, `curso`) VALUES
	(24, '76927894@continental.edu.pe', NULL, 29, 43, 30, 33, 'TALLER DE PROYEC DE ING I'),
	(25, '76927894@continental.edu.pe', NULL, 29, 45, 30, 33, 'TALLER DE PROYEC DE ING I'),
	(26, '76927894@continental.edu.pe', NULL, 29, 45, 30, 33, 'TALLER DE PROYEC DE ING I');
/*!40000 ALTER TABLE `tblresultados_ml` ENABLE KEYS */;

/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IFNULL(@OLD_FOREIGN_KEY_CHECKS, 1) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40111 SET SQL_NOTES=IFNULL(@OLD_SQL_NOTES, 1) */;
