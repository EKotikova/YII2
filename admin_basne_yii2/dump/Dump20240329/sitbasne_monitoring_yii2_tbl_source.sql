CREATE DATABASE  IF NOT EXISTS `sitbasne_monitoring_yii2` /*!40100 DEFAULT CHARACTER SET utf8 COLLATE utf8_general_ci */;
USE `sitbasne_monitoring_yii2`;
-- MySQL dump 10.13  Distrib 5.7.17, for Win64 (x86_64)
--
-- Host: 127.0.0.1    Database: sitbasne_monitoring_yii2
-- ------------------------------------------------------
-- Server version	5.5.5-10.4.28-MariaDB

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
-- Table structure for table `tbl_source`
--

DROP TABLE IF EXISTS `tbl_source`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tbl_source` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(250) DEFAULT NULL,
  `value` varchar(250) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=64 DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tbl_source`
--

LOCK TABLES `tbl_source` WRITE;
/*!40000 ALTER TABLE `tbl_source` DISABLE KEYS */;
INSERT INTO `tbl_source` VALUES (1,'degree','не имею'),(2,'degree','доктор наук'),(3,'academic_title','не имею'),(4,'academic_title','профессор1'),(5,'form_participation','очная'),(6,'form_participation','заочная'),(7,'payment_method','б/н расчет'),(8,'payment_method','на месте'),(9,'reservation','нет'),(10,'reservation','да'),(11,'science_branch','Технические науки'),(12,'science_branch','Физико-математические науки'),(13,'degree','кандидат наук'),(14,'academic_title','доцент'),(15,'city','Минск'),(16,'city','Гродно'),(17,'city','Гомель'),(18,'city','Могилев'),(19,'city','Брест'),(20,'city','Витебск'),(21,'country','Беларусь'),(22,'country','Россия'),(23,'country','Украина'),(24,'city','Жодино'),(25,'city','Самара'),(26,'science_branch','Химические науки'),(27,'science_branch','Биологические науки'),(28,'science_branch','Сельскохозяйственные науки'),(29,'science_branch','Исторические науки'),(30,'science_branch','Экономические науки'),(31,'science_branch','Философские науки'),(32,'science_branch','Филологические науки'),(33,'science_branch','Юридические науки'),(34,'science_branch','Педагогические науки'),(35,'science_branch','Медицинские науки'),(36,'science_branch','Искусствоведение'),(37,'science_branch','Психологические науки'),(38,'science_branch','Военные науки. Национальная безопасность'),(39,'science_branch','Социологические науки'),(40,'science_branch','Политология'),(41,'science_branch','Культурология'),(42,'science_branch','Науки о Земле'),(43,'subject_congress','1. Перспективные материалы и элементная база для космической техники'),(44,'subject_congress','2. Инновационные программы, проекты и технологии в ракетно-космической отрасли'),(45,'subject_congress','3. Космические аппараты, целевая и научная аппаратура'),(46,'subject_congress','4. Средства и методы обработки и отображения данных дистанционного зондирования Земли'),(47,'subject_congress','5. Технологии обучения и подготовки кадров для космической отрасли'),(48,'subject_congress','6. Проблемы и средства обеспечения надежности, работоспособности и живучести космических систем и аппаратов'),(49,'subject_congress','7. Системы навигационно-временного обеспечения, спутниковой связи и вещания'),(50,'subject_congress','8. Использование результатов космической деятельности в интересах различных отраслей экономики'),(51,'form_participation','слушатель'),(52,'subject_congress8','1. Инновационные программы, проекты и технологии в ракетно-космической отрасли. \r\nИспользование результатов космической деятельности в интересах различных отраслей экономики.\r\n'),(54,'subject_congress8','2. Космические аппараты, целевая и научная аппаратура. Системы навигационно-временного обеспечения, спутниковой связи и вещания.'),(56,'subject_congress8','3. Средства, технологии и методы обработки и отображения данных дистанционного зондирования Земли, геосервисы на их основе. Искусственный интеллект в космических технологиях.'),(58,'subject_congress8','4. Технологии обучения и подготовки кадров для космической отрасли.'),(60,'subject_congress8','5. Теплофизические аспекты практической космонавтики, перспективные материалы, элементы и устройства для космической техники.'),(61,'form_participation8','очная'),(62,'form_participation8','слушатель'),(63,'subject_congress8','Пленарные доклады.');
/*!40000 ALTER TABLE `tbl_source` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2024-03-29 17:30:39
