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
-- Table structure for table `tbl_arangements`
--

DROP TABLE IF EXISTS `tbl_arangements`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tbl_arangements` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `number` varchar(50) DEFAULT NULL,
  `name` text DEFAULT NULL,
  `note` text DEFAULT NULL,
  `direction_id` int(11) unsigned NOT NULL,
  PRIMARY KEY (`id`),
  KEY `direction_id` (`direction_id`),
  CONSTRAINT `fk_direction_id` FOREIGN KEY (`direction_id`) REFERENCES `tbl_directions` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=23 DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tbl_arangements`
--

LOCK TABLES `tbl_arangements` WRITE;
/*!40000 ALTER TABLE `tbl_arangements` DISABLE KEYS */;
INSERT INTO `tbl_arangements` VALUES (1,'1.1','Создание программно-аппаратных моделирующих комплексов для лабораторной отработки маломассогабаритных космических средств, в том числе имитирующих параметры негативного воздействия факторов космического пространства на элементы бортового оборудования и аппаратуры.','',1),(2,'1.2','Создание экспериментальной аппаратуры контроля и диагностики для натурной отработки безотказного функционирования бортовой аппаратуры с заданными характеристиками в течение не менее  10 лет. ','',1),(3,'1.3','Создание экспериментальной аппаратуры  для  оценки качества материалов космической съемки, обеспечивающей повышение достоверности получаемой информации на 15-20 процентов.','',1),(4,'1.4','Создание аппаратуры для комплексной оценки воздействия факторов открытого космического пространства на элементы и модули бортовых средств маломассогабаритных космических аппаратов.','',1),(5,'2.1','Создание малогабаритной бортовой  специальной аппаратуры космических средств дистанционного зондирования Земли (ДЗЗ) с улучшенными характеристиками, с малыми энергопотреблением (до 300 Вт) и массой (до 80 кг).','',2),(6,'2.2','Создание малогабаритных бортовых  приборов ориентации и навигации с порогом чувствительности 5×10-10 g и радиационностойких солнечных батарей с к.п.д. 30-40 %. ','',2),(7,'2.3','Создание малогабаритных бортовых научных  приборов радиотомографии ионосферы, портативных спектрометров, датчиков потока космической плазмы для проведения исследований околоземного космического пространства. ','',2),(8,'2.4','Создание аппаратуры автоматизации логического проектирования микросхем, малогабаритного энергоконцентратора мощностью не менее 60 Вт, триботехнических материалов, разработка технологий защиты бортовых систем от факторов космического пространства и высокоплотной коммутации подвижных частей космической микроэлектронной аппаратуры. ','',2),(9,'2.5','Разработка программно-технических средств и технологий обработки космической информации дистанционного зондирования Земли (ДЗЗ), получаемой от мультиспектральной, радиолокационной и гиперспектральной аппаратуры наблюдения.','',2),(10,'1.1','Создание базовых элементов бортового оборудования систем управления движением унифицированной маломассогабаритной космической платформы, включая двигатель малой тяги 10-25 Н на экологически чистых компонентах топлива.','',3),(11,'1.2','Создание базовых элементов бортового оборудования системы электропитания унифицированной маломассогабаритной космической платформы, в том числе малогабаритного интеллектуального источника питания мощностью 300Вт.','',3),(12,'1.3','Создание композиционных материалов, узлов и элементов коммутации унифицированной маломассогабаритной космической платформы для КА различного целевого назначения в интересах решения задач терморегулирования,  обеспечения несущей способности платформы не менее 1,0 и локальной радиационной защиты электронных компонентов бортовой аппаратуры. ','',3),(13,'2.1','Разработка и экспериментальная отработка базовых элементов малогабаритной бортовой целевой  и служебной аппаратуры, предназначенной для  контроля околоземного пространства и наблюдения земной поверхности с решением задач ДЗЗ, в том числе в ИК-диапазоне с пространственным разрешением от 30 м до 100 м и температурным разрешением не хуже 1 (0-градус).','',4),(14,'2.2','Разработка и экспериментальная отработка технических решений для создания образцов базовых элементов малогабаритной бортовой научной аппаратуры мониторинга атмосферы, в том числе элементов газоанализатора космического базирования для определения выбросов метана, обеспечивающего спектральное разрешение  не менее – 0,5 нм.','',4),(15,'3.1','Создание экспериментальных образцов аппаратно-программных комплексов, реализующих управление многоспутниковыми группировками малоразмерных КА на основе нейросетевых технологий и искусственного интеллекта.','',5),(16,'3.2','Создание экспериментальных образцов аппаратно-программных комплексов, реализующих новые технологии обеспечения планирования, обработки и распределения данных от многоспутниковых космических систем наблюдения с использованием мультисервисных сетей и искусственного интеллекта.','',5),(17,'3.3','Создание экспериментальных образцов аппаратно-программных комплексов, реализующих новые технологии повышения качества данных мониторинга поверхности Земли и околоземного пространства, получения данных по космической погоде и детектирования аномальных ситуаций на территории государств-участников.','',5),(18,'4.1','Разработка проектных решений, технической документации, изготовление и наземная отработка экспериментального (технологического) образца малоразмерного космического аппарата (массой до 250 кг), оснащенного целевой аппаратурой наблюдения земной поверхности и околоземного космического пространства.','',6),(19,'4.2','Разработка проектных решений, технической документации, изготовление и наземная отработка экспериментальных (технологических) образцов наноспутников (массой до 10 кг), оснащённых аппаратурой передачи информации (борт КА - борт КА), целевой аппаратурой для решения задач исследования околоземного космического пространства.','',6),(20,'4.3','Разработка принципов построения и технических решений по созданию многоцелевой космической системы с использованием многоспутниковых группировок космических аппаратов малой размерности.','',6),(22,'4.5','названініе меропріятія_шршгршг','прімечаніе',6);
/*!40000 ALTER TABLE `tbl_arangements` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2024-07-05 17:00:00