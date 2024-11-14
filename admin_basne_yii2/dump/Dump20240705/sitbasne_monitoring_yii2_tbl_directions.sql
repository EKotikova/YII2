CREATE DATABASE  IF NOT EXISTS `sitbasne_monitoring_yii2` /*!40100 DEFAULT CHARACTER SET utf8 COLLATE utf8_general_ci */;
USE `sitbasne_monitoring_yii2`;
-- MySQL dump 10.13  Distrib 5.7.17, for Win64 (x86_64)
--
-- Host: 127.0.0.1    Database: sitbasne_monitoring_yii2
-- ------------------------------------------------------
-- Server version	5.5.5-10.4.32-MariaDB

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

--
-- Table structure for table `tbl_directions`
--

DROP TABLE IF EXISTS `tbl_directions`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tbl_directions` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `number` varchar(50) DEFAULT NULL,
  `name` text DEFAULT NULL,
  `note` text DEFAULT NULL,
  `program_id` int(11) unsigned NOT NULL,
  PRIMARY KEY (`id`),
  KEY `program_id` (`program_id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tbl_directions`
--

LOCK TABLES `tbl_directions` WRITE;
/*!40000 ALTER TABLE `tbl_directions` DISABLE KEYS */;
INSERT INTO `tbl_directions` VALUES (1,'1','Разработка технологий применения, проектной документации и создание экспериментальной аппаратуры  контроля и диагностики для проведения натурных экспериментов по отработке надёжности, работоспособности и живучести маломассогабаритных специальных и обеспечивающих систем космических средств в условиях воздействия факторов космического пространства.','',2),(2,'2','Создание малогабаритной бортовой специальной и научной аппаратуры, материалов и элементной базы с улучшенными характеристиками, средств и технологий обработки качественно меняющейся космической информации, получаемой от перспективной аппаратуры наблюдения.','',2),(3,'1','разработка и экспериментальная отработка технических решений в интересах создания новых образцов бортового служебного оборудования и узлов унифицированной маломассогабаритной платформы, входящей в состав космических аппаратов, предназначенных для решения задач наблюдения поверхности Земли и исследования околоземного космического пространства','',3),(4,'2','разработка и экспериментальная отработка технических решений для создания образцов бортовых специальных комплексов нового поколения для оснащения космических аппаратов малой размерности, обеспечивающих решение задач наблюдения земной поверхности и околоземного космического пространства','',3),(5,'3','разработка экспериментальных аппаратно-программных комплексов, реализующих новые технологии управления, планирования применения, приема, обработки и распределения данных многоспутниковых орбитальных группировок малоразмерных КА','',3),(6,'4','создание экспериментальных (технологических) образцов малоразмерного космического аппарата и наноспутников для отработки ключевых технологий функционирования многоспутниковых космических систем наблюдения поверхности Земли и околоземного космического пространства','',3);
/*!40000 ALTER TABLE `tbl_directions` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2024-07-05 17:00:03
