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

-- Volcando estructura para tabla test.docente_retroalimentacion
CREATE TABLE IF NOT EXISTS `docente_retroalimentacion` (
  `tipo_aprendizaje` text NOT NULL,
  `retreoalimentacion` varchar(800) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- Volcando datos para la tabla test.docente_retroalimentacion: ~8 rows (aproximadamente)
/*!40000 ALTER TABLE `docente_retroalimentacion` DISABLE KEYS */;
INSERT INTO `docente_retroalimentacion` (`tipo_aprendizaje`, `retreoalimentacion`) VALUES
	('Visual', 'Sucede cuando uno tiende a pensar en imágenes y a relacionarlas con ideas y conceptos, por ejemplo, cuando se recurre a mapas conceptuales. Este sistema tiende a ser el sistema dominante en la mayoría de personas.'),
	('Sensorial', 'Le permite al lector conocer acerca de la experiencia que trabaja los sistemas sensoriales, facilitando una mejor percepcion , al exponer los sentidos a la luz, sonido, sabores, olores, tacto y movimiento entre otros.'),
	('Activo', 'Alumnos con estilo activo son: novedoso, participativo, lanzado, protagonista, conversador, divertido, líder, innovador, creativo, novedoso, inventor, deseoso de aprender, solucionador de problemas, vividor de la experiencia, vital, generador de ideas, competitivo, voluntarioso, chocante, aventurero y renovador.'),
	('Reflectivo', 'A los reflexivos les gusta considerar las experiencias y observarlas desde diferentes perspectivas. Recogen datos, analizándolos con detenimiento antes de llegar a alguna conclusión. Su filosofía consiste en ser prudente, no dejar piedra sin mover, mirar bien antes de pasar.'),
	('Intutivo', 'Los estudiantes intuitivos prefieren a menudo el descubrir posibilidades y relaciones. · Los estudiantes intuitivos les gusta la innovación y tienen una aversión a la repetición. Para ser eficaz como estudiante y resolver un problema, se necesita poder funcionar de esta manera.'),
	('Verbal', 'Aprendizaje verbal es el proceso por el cual se aprende a responder de forma apropiada a los mensajes verbales. Requiere la emisión de una respuesta hablada o conductual ante un material verbal.'),
	('Global', 'Integral en lo relativo a los contenidos y a los metodos. Se centra en el aprendizaje participativo, en la acción y la adquisición de competencias para que las personas puedan orientarse y llevar una vida responsable.'),
	('Secuencial', 'Es la capacidad de calcular, cuantificar y de llevar a cabo operaciones matemáticas completa, nos permite percibir las relaciones, conexiones  y utilizar el pensamiento abstracto y simbólico. Habilidades de razonamiento secuencial y los patrones de pensamiento inductivo y deductivo.');
/*!40000 ALTER TABLE `docente_retroalimentacion` ENABLE KEYS */;

-- Volcando estructura para procedimiento test.PS_MOSTRAR_RETROALIMENTACION
DELIMITER //
CREATE PROCEDURE `PS_MOSTRAR_RETROALIMENTACION`()
SELECT *from docente_retroalimentacion//
DELIMITER ;

-- Volcando estructura para procedimiento test.SP_ACTIVO_REFLECTIVO
DELIMITER //
CREATE PROCEDURE `SP_ACTIVO_REFLECTIVO`()
SELECT * FROM tblrespuestas WHERE codestudiante='71444762'//
DELIMITER ;

-- Volcando estructura para procedimiento test.SP_BUSQUEDA_ESTUDIANTES
DELIMITER //
CREATE PROCEDURE `SP_BUSQUEDA_ESTUDIANTES`()
SELECT * FROM tblconsulta WHERE codestudiante NOT LIKE '' ORDER By codestudiante LIMIT 25//
DELIMITER ;

-- Volcando estructura para procedimiento test.SP_BUSQUEDA_SALON
DELIMITER //
CREATE PROCEDURE `SP_BUSQUEDA_SALON`()
SELECT * FROM tblconsultasalon WHERE NRC NOT LIKE '' ORDER By NRC LIMIT 25//
DELIMITER ;

-- Volcando estructura para procedimiento test.SP_MOSTRAR_RESULTADO
DELIMITER //
CREATE PROCEDURE `SP_MOSTRAR_RESULTADO`(
	IN `codigo` VARCHAR(27)
)
SELECT * FROM tblresultados WHERE `codestudiante`=codigo  ORDER BY idresultado DESC LIMIT 1//
DELIMITER ;

-- Volcando estructura para procedimiento test.SP_REPORTE_AULA_AR
DELIMITER //
CREATE PROCEDURE `SP_REPORTE_AULA_AR`(IN `estiloC` VARCHAR(15), IN `NRCC` INT(6))
SELECT COUNT(activoreflexivo) AS NESTUDIANTES FROM `tblresultados` WHERE codestudiante IN(SELECT codestudiante FROM `tblconsulta` WHERE NRC=NRCC) AND activoreflexivo=estiloC//
DELIMITER ;

-- Volcando estructura para procedimiento test.SP_REPORTE_AULA_SG
DELIMITER //
CREATE PROCEDURE `SP_REPORTE_AULA_SG`(IN `estiloC` VARCHAR(15), IN `NRCC` INT(6))
SELECT COUNT(secuencialglobal) AS NESTUDIANTES FROM `tblresultados` WHERE codestudiante IN(SELECT codestudiante FROM `tblconsulta` WHERE NRC=NRCC) AND secuencialglobal=estiloC//
DELIMITER ;

-- Volcando estructura para tabla test.tblconsulta
CREATE TABLE IF NOT EXISTS `tblconsulta` (
  `codestudiante` int(8) NOT NULL,
  `nombreest` varchar(80) NOT NULL,
  `NRC` int(6) NOT NULL,
  PRIMARY KEY (`codestudiante`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- Volcando datos para la tabla test.tblconsulta: ~5 rows (aproximadamente)
/*!40000 ALTER TABLE `tblconsulta` DISABLE KEYS */;
INSERT INTO `tblconsulta` (`codestudiante`, `nombreest`, `NRC`) VALUES
	(71444762, 'Delgadillo Lazaro Tania', 8555),
	(72889436, 'Vilca Cumbrera Gabriela', 8555),
	(72969241, 'Espiritu Campos Juan Carlos', 8549),
	(72969242, 'Espiritu Campos Alejadro', 8549),
	(76927894, 'Ubaldo Porras Enrique', 8555);
/*!40000 ALTER TABLE `tblconsulta` ENABLE KEYS */;

-- Volcando estructura para tabla test.tblconsultasalon
CREATE TABLE IF NOT EXISTS `tblconsultasalon` (
  `NRC` int(8) NOT NULL,
  `Nombreasignatura` varchar(50) NOT NULL,
  PRIMARY KEY (`NRC`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- Volcando datos para la tabla test.tblconsultasalon: ~4 rows (aproximadamente)
/*!40000 ALTER TABLE `tblconsultasalon` DISABLE KEYS */;
INSERT INTO `tblconsultasalon` (`NRC`, `Nombreasignatura`) VALUES
	(8549, 'DESARROLLO DE SOLUCIONES MÓVILES '),
	(8555, 'TALLER DE PROYECTOS DE INGENIERÍA I '),
	(9588, 'AUDITORÍA DE SISTEMAS '),
	(12906, 'TALLER DE INVESTIGACIÓN I ');
/*!40000 ALTER TABLE `tblconsultasalon` ENABLE KEYS */;

-- Volcando estructura para tabla test.tblestudiante
CREATE TABLE IF NOT EXISTS `tblestudiante` (
  `CodEstudiante` int(8) NOT NULL,
  `ApellidosNombres` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- Volcando datos para la tabla test.tblestudiante: ~31 rows (aproximadamente)
/*!40000 ALTER TABLE `tblestudiante` DISABLE KEYS */;
INSERT INTO `tblestudiante` (`CodEstudiante`, `ApellidosNombres`) VALUES
	(72889436, 'VILCA CUMBRERA GABRIELA MAYTE'),
	(78945612, 'ALONSO BECERRA JOSE'),
	(76887472, 'BERNABE CASANOVA FRANCISCO CESAR'),
	(71258465, 'CACERES CONTRERAS MARIA DEL MAR '),
	(74445725, 'CUETO AVELLANEDA RAFAEL'),
	(73225874, 'DIAZ SEGURA MARIA BELEN'),
	(78789578, 'FERNANDEZ LOPEZ MARIA DOLORES'),
	(71458596, 'FERNANDEZ SEGUIN HUGO'),
	(79638547, 'GALVEZ IBARRA ALICIA'),
	(71449783, 'GARCIA FERNANDEZ MARIA MERCEDES'),
	(73558747, 'GODOY GARCIA JOSE EULOGIO '),
	(78457813, 'GONZÁLEZ DÍAZ	ROCIO'),
	(78475871, 'GONZALEZ MANZANO CRISTINA MARIA'),
	(77897423, 'GONZALEZ NAVAS JORGE'),
	(68745230, 'IGLESIAS PASTOR FRANCISCO JAVIER '),
	(66002145, 'LATORRE CUEVAS FRANCISCO JAVIER'),
	(78997400, 'LOPEZ GARCIA CRISTINA LUCIA'),
	(74112500, 'LORENTE MESAS RAFAEL '),
	(78978012, 'MAGAÑA HERNANDEZ LUIS '),
	(78227452, 'MANZANO RAMOS JESUS FRANK'),
	(70289752, 'MARIN SANCHEZ JOSE MARIA '),
	(69875241, 'MEDINA DELGAGO FRANCISCO JAVIER '),
	(63258741, 'MORALES GARCIA JUAN JOSE '),
	(78968712, 'MORALES SANCHEZ BELINDA'),
	(70142587, 'MORALES SANCHEZ MARIA JESUS'),
	(70889710, 'ORTEGA CASERO ANA '),
	(78475970, 'TORTOSA MARTINEZ ALVARO '),
	(70114963, 'VAZQUEZ SANCHEZ JAVIER '),
	(77889544, 'VICENTE CASTILLO VANESA'),
	(71203652, 'SANCHEZ RAMOS JOSE MARIA '),
	(72336589, 'GARCIA CRESPO MARIA DEL CARMEN ');
/*!40000 ALTER TABLE `tblestudiante` ENABLE KEYS */;

-- Volcando estructura para tabla test.tblpreguntas
CREATE TABLE IF NOT EXISTS `tblpreguntas` (
  `idpregunta` int(2) NOT NULL,
  `enunciado` varchar(200) NOT NULL,
  `opcion1` varchar(200) NOT NULL,
  `opcion2` varchar(200) NOT NULL,
  `tipo_pregunta` varchar(20) NOT NULL,
  PRIMARY KEY (`idpregunta`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- Volcando datos para la tabla test.tblpreguntas: ~44 rows (aproximadamente)
/*!40000 ALTER TABLE `tblpreguntas` DISABLE KEYS */;
INSERT INTO `tblpreguntas` (`idpregunta`, `enunciado`, `opcion1`, `opcion2`, `tipo_pregunta`) VALUES
	(1, 'Entiendo mejor algo:', 'Si lo practico.', 'Si pienso en ello.', 'Act-Ref'),
	(2, 'Me considero:', 'Realista.', 'Innovador.', 'Sen-Int'),
	(3, 'Cuando pienso acerca de lo que hice ayer, es más probable que lo haga sobre la base de:', 'Una imagen.', 'Palabras.', 'Vis-Ver'),
	(4, 'Tengo tendencia a:', 'Entender los detalles de un tema pero no ver claramente su estructura completa.', 'Entender la estructura completa pero no ver claramente los detalles.', 'Sec-Glo'),
	(5, 'Cuando estoy aprendiendo algo nuevo, me ayuda:', 'Hablar de ello.', 'Pensar en ello.', 'Act-Ref'),
	(6, 'Si yo fuera profesor, yo preferiría dar un curso:', 'Que trate sobre hechos y situaciones reales de la vida.', 'Que trate con ideas y teorías.', 'Sen-Int'),
	(7, 'Prefiero obtener información nueva de:', 'Imágenes, diagramas, gráficas o mapas.', 'Instrucciones escritas o información verbal.', 'Vis-Ver'),
	(8, 'Una vez que entiendo:', 'Todas las partes, entiendo el total.', 'El total de algo, entiendo como encajan sus partes.', 'Sec-Glo'),
	(9, 'En un grupo de estudio que trabaja con un material difícil, es más probable que:', 'Participe y contribuya con ideas.', 'No participe y solo escuche.', 'Act-Ref'),
	(10, 'Es más fácil para mí:', 'Aprender hechos.', 'Aprender conceptos.', 'Sen-Int'),
	(11, 'En un libro con muchas imágenes y gráficas es más probable que:', 'Revise cuidadosamente las imágenes y las gráficas.', 'Me concentre en el texto escrito.', 'Vis-Ver'),
	(12, 'Cuando resuelvo problemas de matemáticas:', 'Generalmente trabajo sobre las soluciones con un paso a la vez.', 'Frecuentemente sé cuales son las soluciones, pero luego tengo dificultad  para imaginarme los pasos para llegar a ellas.', 'Sec-Glo'),
	(13, 'En las clases a las que he asistido:', 'He llegado a saber como son muchos de los estudiantes.', 'Raramente he llegado a saber como son muchos estudiantes.', 'Act-Ref'),
	(14, 'Cuando leo temas que no son de ficción, prefiero:', 'Algo que me enseñe nuevos hechos o me diga como hacer algo.', 'Algo que me dé nuevas ideas en que pensar.', 'Sen-Int'),
	(15, 'Me gustan los maestros:', 'Que utilizan muchos esquemas en el pizarrón.', 'Que toman mucho tiempo para explicar.', 'Vis-Ver'),
	(16, 'Cuando estoy analizando un cuento o una novela:', 'Pienso en los incidentes y trato de acomodarlos para configurar los temas.', 'Me doy cuenta de cuales son los temas cuando termino de leer y luego tengo que regresar y encontrar los incidentes que los demuestran.', 'Sec-Glo'),
	(17, 'Cuando comienzo a resolver un problema de tarea, es más probable que:', 'Comience a trabajar en su solución inmediatamente.', 'Primero trate de entender completamente el problema.', 'Act-Ref'),
	(18, 'Prefiero la idea de:', 'Certeza.', 'Teoría.', 'Sen-Int'),
	(19, 'Recuerdo mejor:', 'Lo que veo.', 'Lo que oigo.', 'Vis-Ver'),
	(20, 'Es más importante para mí que un profesor:', 'Exponga el material en pasos secuenciales claros.', 'Me dé un panorama general y relacione el material con otros temas.', 'Sec-Glo'),
	(21, 'Prefiero estudiar:', 'En un grupo de estudio.', 'Solo.', 'Act-Ref'),
	(22, 'Me considero:', 'Cuidadoso en los detalles de mi trabajo.', 'Creativo en la forma en la que hago mi trabajo.', 'Sen-Int'),
	(23, 'Cuando alguien me da direcciones de nuevos lugares, prefiero:', 'Un mapa.', 'Instrucciones escritas.', 'Vis-Ver'),
	(24, 'Aprendo:', 'A un paso constante. Si estudio con ahínco consigo lo que deseo.', 'En inicios y pausas. Me llego a confundir y súbitamente lo entiendo.', 'Sec-Glo'),
	(25, 'Prefiero primero:', 'Hacer algo y ver que sucede.', 'Pensar como voy a hacer algo.', 'Act-Ref'),
	(26, 'Cuando leo por diversión, me gustan los escritores que:', 'Dicen claramente los que desean dar a entender.', 'Dicen las cosas en forma creativa e interesante.', 'Sen-Int'),
	(27, 'Cuando veo un esquema o bosquejo en clase, es más probable que recuerde:', 'La imagen.', 'Lo que el profesor dijo acerca de ella.', 'Vis-Ver'),
	(28, 'Cuando me enfrento a un cuerpo de información:', 'Me concentro en los detalles y pierdo de vista el total de la misma.', 'Trato de entender el todo antes de ir a los detalles.', 'Sec-Glo'),
	(29, 'Recuerdo más fácilmente:', 'Algo que he hecho.', 'Algo en lo que he pensado mucho.', 'Act-Ref'),
	(30, 'Cuando tengo que hacer un trabajo, prefiero:', 'Dominar una forma de hacerlo.', 'Intentar nuevas formas de hacerlo.', 'Sen-Int'),
	(31, 'Cuando alguien me enseña datos, prefiero:', 'Gráficas.', 'Resúmenes con texto.', 'Vis-Ver'),
	(32, 'Cuando escribo un trabajo, es más probable que:', 'Lo haga (piense o escriba) desde el principio y avance.', 'Lo haga (piense o escriba) en diferentes partes y luego las ordene.', 'Sec-Glo'),
	(33, 'Cuando tengo que trabajar en un proyecto de grupo, primero quiero:', 'Realizar una "tormenta de ideas" donde cada uno contribuye con ideas.', 'Realizar la "tormenta de ideas" en forma personal y luego juntarme con el grupo para comparar las ideas.', 'Act-Ref'),
	(34, 'Considero que es mejor elogio llamar a alguien:', 'Sensible.', 'Imaginativo.', 'Sen-Int'),
	(35, 'Cuando conozco gente en una fiesta, es más probable que recuerde:', 'Cómo es su apariencia.', 'Lo que dicen de sí mismos.', 'Vis-Ver'),
	(36, 'Cuando estoy aprendiendo un tema, prefiero:', 'Mantenerme concentrado en ese tema, aprendiendo lo más que pueda de él.', 'Hacer conexiones entre ese tema y temas relacionados.', 'Sec-Glo'),
	(37, 'Me considero:', 'Abierto.', 'Reservado.', 'Act-Ref'),
	(38, 'Prefiero cursos que dan más importancia a:', 'Material concreto (hechos, datos).', 'Material abstracto (conceptos, teorías).', 'Sen-Int'),
	(39, 'Para divertirme, prefiero:', 'Ver televisión.', 'Leer un libro.', 'Vis-Ver'),
	(40, 'Algunos profesores inician sus clases haciendo un bosquejo de lo que enseñarán. Esos bosquejos son:', 'Algo útiles para mí.', 'Muy útiles para mí.', 'Sec-Glo'),
	(41, 'La idea de hacer una tarea en grupo con una sola calificación para todos:', 'Me parece bien.', 'No me parece bien.', 'Act-Ref'),
	(42, 'Cuando hago grandes cálculos:', 'Tiendo a repetir todos mis pasos y revisar cuidadosamente mi trabajo.', 'Me cansa hacer su revisión y tengo que esforzarme para hacerlo.', 'Sen-Int'),
	(43, 'Tiendo a recordar lugares en los que he estado:', 'Fácilmente y con bastante exactitud.', 'Con dificultad y sin mucho detalle.', 'Vis-Ver'),
	(44, 'Cuando resuelvo problemas en grupo, es más probable que yo:', 'Piense en los pasos para la solución de los problemas.', 'Piense en las posibles consecuencias o aplicaciones de la solución en un amplio rango de campos.', 'Sec-Glo');
/*!40000 ALTER TABLE `tblpreguntas` ENABLE KEYS */;

-- Volcando estructura para tabla test.tblprueba
CREATE TABLE IF NOT EXISTS `tblprueba` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `codigo_estudiante` varchar(27) NOT NULL,
  `pregunta` int(2) NOT NULL,
  `respuesta` varchar(1) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `tblprueba_ibfk_1` (`pregunta`),
  CONSTRAINT `tblprueba_ibfk_1` FOREIGN KEY (`pregunta`) REFERENCES `tblpreguntas` (`idpregunta`)
) ENGINE=InnoDB AUTO_INCREMENT=441 DEFAULT CHARSET=latin1;

-- Volcando datos para la tabla test.tblprueba: ~175 rows (aproximadamente)
/*!40000 ALTER TABLE `tblprueba` DISABLE KEYS */;
INSERT INTO `tblprueba` (`id`, `codigo_estudiante`, `pregunta`, `respuesta`) VALUES
	(1, '', 1, '2'),
	(2, '', 2, '2'),
	(3, '', 3, '2'),
	(4, '', 4, ''),
	(5, '', 5, ''),
	(6, '', 6, ''),
	(7, '', 7, ''),
	(8, '', 8, ''),
	(9, '', 9, ''),
	(10, '', 10, ''),
	(11, '', 11, ''),
	(12, '', 12, ''),
	(13, '', 13, ''),
	(14, '', 14, ''),
	(15, '', 15, ''),
	(16, '', 16, ''),
	(17, '', 17, ''),
	(18, '', 18, ''),
	(19, '', 19, ''),
	(20, '', 20, ''),
	(21, '', 21, ''),
	(22, '', 22, ''),
	(23, '', 23, ''),
	(24, '', 24, ''),
	(25, '', 25, ''),
	(26, '', 26, ''),
	(27, '', 27, ''),
	(28, '', 28, ''),
	(29, '', 29, ''),
	(30, '', 30, ''),
	(31, '', 31, ''),
	(32, '', 32, ''),
	(33, '', 33, ''),
	(34, '', 34, ''),
	(35, '', 35, ''),
	(36, '', 36, ''),
	(37, '', 37, ''),
	(38, '', 38, ''),
	(39, '', 39, ''),
	(40, '', 40, ''),
	(41, '', 41, ''),
	(42, '', 42, ''),
	(43, '', 43, ''),
	(44, '', 44, ''),
	(45, '76927894@continental.edu.pe', 1, '2'),
	(46, '76927894@continental.edu.pe', 2, '2'),
	(47, '76927894@continental.edu.pe', 3, '2'),
	(48, '76927894@continental.edu.pe', 4, '2'),
	(49, '76927894@continental.edu.pe', 5, '2'),
	(50, '76927894@continental.edu.pe', 6, '1'),
	(51, '76927894@continental.edu.pe', 7, '2'),
	(52, '76927894@continental.edu.pe', 8, '1'),
	(53, '76927894@continental.edu.pe', 9, '2'),
	(54, '76927894@continental.edu.pe', 10, '1'),
	(55, '76927894@continental.edu.pe', 11, '1'),
	(56, '76927894@continental.edu.pe', 12, '2'),
	(57, '76927894@continental.edu.pe', 13, '2'),
	(58, '76927894@continental.edu.pe', 14, '2'),
	(59, '76927894@continental.edu.pe', 15, '1'),
	(60, '76927894@continental.edu.pe', 16, '2'),
	(61, '76927894@continental.edu.pe', 17, '2'),
	(62, '76927894@continental.edu.pe', 18, '1'),
	(63, '76927894@continental.edu.pe', 19, '2'),
	(64, '76927894@continental.edu.pe', 20, '2'),
	(65, '76927894@continental.edu.pe', 21, '1'),
	(66, '76927894@continental.edu.pe', 22, '1'),
	(67, '76927894@continental.edu.pe', 23, '2'),
	(68, '76927894@continental.edu.pe', 24, '2'),
	(69, '76927894@continental.edu.pe', 25, '1'),
	(70, '76927894@continental.edu.pe', 26, '1'),
	(71, '76927894@continental.edu.pe', 27, '2'),
	(72, '76927894@continental.edu.pe', 28, '2'),
	(73, '76927894@continental.edu.pe', 29, '1'),
	(74, '76927894@continental.edu.pe', 30, '1'),
	(75, '76927894@continental.edu.pe', 31, '2'),
	(76, '76927894@continental.edu.pe', 32, '2'),
	(77, '76927894@continental.edu.pe', 33, '1'),
	(78, '76927894@continental.edu.pe', 34, '1'),
	(79, '76927894@continental.edu.pe', 35, '2'),
	(80, '76927894@continental.edu.pe', 36, '2'),
	(81, '76927894@continental.edu.pe', 37, '1'),
	(82, '76927894@continental.edu.pe', 38, '1'),
	(83, '76927894@continental.edu.pe', 39, '2'),
	(84, '76927894@continental.edu.pe', 40, '2'),
	(85, '76927894@continental.edu.pe', 41, '1'),
	(86, '76927894@continental.edu.pe', 42, '2'),
	(87, '76927894@continental.edu.pe', 43, '1'),
	(88, '76927894@continental.edu.pe', 44, '2'),
	(89, 'asd@hot.com', 1, '1'),
	(90, 'asd@hot.com', 2, '1'),
	(91, 'asd@hot.com', 3, ''),
	(92, 'asd@hot.com', 4, ''),
	(93, 'asd@hot.com', 5, '2'),
	(94, 'asd@hot.com', 6, ''),
	(95, 'asd@hot.com', 7, ''),
	(96, 'asd@hot.com', 8, ''),
	(97, 'asd@hot.com', 9, ''),
	(98, 'asd@hot.com', 10, ''),
	(99, 'asd@hot.com', 11, ''),
	(100, 'asd@hot.com', 12, ''),
	(101, 'asd@hot.com', 13, ''),
	(102, 'asd@hot.com', 14, ''),
	(103, 'asd@hot.com', 15, ''),
	(104, 'asd@hot.com', 16, ''),
	(105, 'asd@hot.com', 17, ''),
	(106, 'asd@hot.com', 18, ''),
	(107, 'asd@hot.com', 19, ''),
	(108, 'asd@hot.com', 20, ''),
	(109, 'asd@hot.com', 21, ''),
	(110, 'asd@hot.com', 22, ''),
	(111, 'asd@hot.com', 23, ''),
	(112, 'asd@hot.com', 24, ''),
	(113, 'asd@hot.com', 25, ''),
	(114, 'asd@hot.com', 26, ''),
	(115, 'asd@hot.com', 27, ''),
	(116, 'asd@hot.com', 28, ''),
	(117, 'asd@hot.com', 29, ''),
	(118, 'asd@hot.com', 30, ''),
	(119, 'asd@hot.com', 31, ''),
	(120, 'asd@hot.com', 32, ''),
	(121, 'asd@hot.com', 33, ''),
	(122, 'asd@hot.com', 34, ''),
	(123, 'asd@hot.com', 35, ''),
	(124, 'asd@hot.com', 36, ''),
	(125, 'asd@hot.com', 37, ''),
	(126, 'asd@hot.com', 38, ''),
	(127, 'asd@hot.com', 39, ''),
	(128, 'asd@hot.com', 40, ''),
	(129, 'asd@hot.com', 41, ''),
	(130, 'asd@hot.com', 42, ''),
	(131, 'asd@hot.com', 43, ''),
	(132, 'asd@hot.com', 44, ''),
	(398, 'prueba@hotmail.com', 1, '1'),
	(399, 'prueba@hotmail.com', 2, '2'),
	(400, 'prueba@hotmail.com', 3, '1'),
	(401, 'prueba@hotmail.com', 4, '2'),
	(402, 'prueba@hotmail.com', 5, '1'),
	(403, 'prueba@hotmail.com', 6, '1'),
	(404, 'prueba@hotmail.com', 7, '1'),
	(405, 'prueba@hotmail.com', 8, '2'),
	(406, 'prueba@hotmail.com', 9, '2'),
	(407, 'prueba@hotmail.com', 10, '2'),
	(408, 'prueba@hotmail.com', 11, '2'),
	(409, 'prueba@hotmail.com', 12, '2'),
	(410, 'prueba@hotmail.com', 13, '2'),
	(411, 'prueba@hotmail.com', 14, '2'),
	(412, 'prueba@hotmail.com', 15, '2'),
	(413, 'prueba@hotmail.com', 16, '2'),
	(414, 'prueba@hotmail.com', 17, '2'),
	(415, 'prueba@hotmail.com', 18, '2'),
	(416, 'prueba@hotmail.com', 19, '1'),
	(417, 'prueba@hotmail.com', 20, '2'),
	(418, 'prueba@hotmail.com', 21, '2'),
	(419, 'prueba@hotmail.com', 22, '2'),
	(420, 'prueba@hotmail.com', 23, '2'),
	(421, 'prueba@hotmail.com', 24, '2'),
	(422, 'prueba@hotmail.com', 25, '2'),
	(423, 'prueba@hotmail.com', 26, '1'),
	(424, 'prueba@hotmail.com', 27, '2'),
	(425, 'prueba@hotmail.com', 28, '2'),
	(426, 'prueba@hotmail.com', 29, '2'),
	(427, 'prueba@hotmail.com', 30, '2'),
	(428, 'prueba@hotmail.com', 31, '2'),
	(429, 'prueba@hotmail.com', 32, '2'),
	(430, 'prueba@hotmail.com', 33, '2'),
	(431, 'prueba@hotmail.com', 34, '1'),
	(432, 'prueba@hotmail.com', 35, '2'),
	(433, 'prueba@hotmail.com', 36, '1'),
	(434, 'prueba@hotmail.com', 37, '2'),
	(435, 'prueba@hotmail.com', 38, '2'),
	(436, 'prueba@hotmail.com', 39, '1'),
	(437, 'prueba@hotmail.com', 40, '1'),
	(438, 'prueba@hotmail.com', 41, '2'),
	(439, 'prueba@hotmail.com', 42, '2'),
	(440, 'prueba@hotmail.com', 43, '2');
/*!40000 ALTER TABLE `tblprueba` ENABLE KEYS */;

-- Volcando estructura para tabla test.tblrespuestas
CREATE TABLE IF NOT EXISTS `tblrespuestas` (
  `codestudiante` int(8) NOT NULL,
  `idpregunta` int(2) NOT NULL,
  `respuesta1` int(1) NOT NULL,
  `respuesta2` int(1) NOT NULL,
  PRIMARY KEY (`codestudiante`),
  KEY `idpregunta` (`idpregunta`),
  CONSTRAINT `tblrespuestas_ibfk_1` FOREIGN KEY (`idpregunta`) REFERENCES `tblpreguntas` (`idpregunta`) ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- Volcando datos para la tabla test.tblrespuestas: ~5 rows (aproximadamente)
/*!40000 ALTER TABLE `tblrespuestas` DISABLE KEYS */;
INSERT INTO `tblrespuestas` (`codestudiante`, `idpregunta`, `respuesta1`, `respuesta2`) VALUES
	(71444762, 1, 0, 1),
	(72889436, 1, 0, 0),
	(72969241, 1, 0, 1),
	(72969242, 1, 0, 1),
	(76927894, 1, 1, 0);
/*!40000 ALTER TABLE `tblrespuestas` ENABLE KEYS */;

-- Volcando estructura para tabla test.tblresultados
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
) ENGINE=InnoDB AUTO_INCREMENT=62 DEFAULT CHARSET=latin1;

-- Volcando datos para la tabla test.tblresultados: ~15 rows (aproximadamente)
/*!40000 ALTER TABLE `tblresultados` DISABLE KEYS */;
INSERT INTO `tblresultados` (`idresultado`, `codestudiante`, `nivelactref`, `nivelsenint`, `nivelvisver`, `nivelsecglo`) VALUES
	(30, '76927894@continental.edu.pe', 27, 36, 54, 81),
	(31, '76927894@continental.edu.pe', 27, 36, 54, 90),
	(32, '76927894', 0, 0, 0, 0),
	(33, '76927894', 0, 0, 0, 0),
	(51, '76927894@continental.edu.pe', 27, 36, 54, 90),
	(52, '76927894@continental.edu.pe', 27, 36, 54, 90),
	(53, '76927894@continental.edu.pe', 27, 36, 54, 90),
	(54, '76927894@continental.edu.pe', 27, 36, 64, 82),
	(55, '76927894@continental.edu.pe', 27, 36, 64, 82),
	(56, '76927894@continental.edu.pe', 27, 36, 64, 82),
	(57, '76927894@continental.edu.pe', 27, 36, 64, 82),
	(58, '76927894@continental.edu.pe', 27, 36, 64, 82),
	(61, 'prueba@hotmail.com', 82, 73, 64, 73);
/*!40000 ALTER TABLE `tblresultados` ENABLE KEYS */;

-- Volcando estructura para tabla test.users
CREATE TABLE IF NOT EXISTS `users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `email` varchar(200) NOT NULL,
  `password` varchar(200) NOT NULL,
  `id_rol` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `email` (`email`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=latin1;

-- Volcando datos para la tabla test.users: ~6 rows (aproximadamente)
/*!40000 ALTER TABLE `users` DISABLE KEYS */;
INSERT INTO `users` (`id`, `email`, `password`, `id_rol`) VALUES
	(1, '123@gmail.com', 'e10adc3949ba59abbe56e057f20f883e', 1),
	(2, '76927894', 'e10adc3949ba59abbe56e057f20f883e', 0),
	(3, '76927894@continental.edu.pe', 'e10adc3949ba59abbe56e057f20f883e', 0),
	(4, 'asd@hot.com', 'e10adc3949ba59abbe56e057f20f883e', 1),
	(5, 'gabu@gmail.com', 'e10adc3949ba59abbe56e057f20f883e', 0),
	(6, 'pedro@gmail.com', 'e10adc3949ba59abbe56e057f20f883e', 0),
	(7, 'prueba@hotmail.com', '202cb962ac59075b964b07152d234b70', 0);
/*!40000 ALTER TABLE `users` ENABLE KEYS */;

/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IFNULL(@OLD_FOREIGN_KEY_CHECKS, 1) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40111 SET SQL_NOTES=IFNULL(@OLD_SQL_NOTES, 1) */;
