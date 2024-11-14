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
-- Table structure for table `tbl_participants`
--

DROP TABLE IF EXISTS `tbl_participants`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tbl_participants` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `user_id` int(11) unsigned NOT NULL,
  `participants_type_id` int(11) unsigned NOT NULL,
  `program_id` int(11) unsigned NOT NULL,
  PRIMARY KEY (`id`),
  KEY `participants_type_id` (`participants_type_id`),
  KEY `user_id` (`user_id`),
  CONSTRAINT `fk_participant_type_participant` FOREIGN KEY (`participants_type_id`) REFERENCES `tbl_participants_type` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_user_participant` FOREIGN KEY (`user_id`) REFERENCES `tbl_user` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=251 DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tbl_participants`
--

LOCK TABLES `tbl_participants` WRITE;
/*!40000 ALTER TABLE `tbl_participants` DISABLE KEYS */;
INSERT INTO `tbl_participants` VALUES (6,3,2,2),(7,4,2,2),(8,5,2,2),(9,6,2,2),(10,7,2,2),(11,8,2,2),(13,9,2,2),(14,10,2,2),(15,11,2,2),(16,12,2,2),(17,13,2,2),(19,15,2,2),(20,16,2,2),(21,17,2,2),(22,18,2,2),(23,19,2,2),(24,20,2,2),(25,21,2,2),(26,22,2,2),(27,23,2,2),(28,24,2,2),(29,25,2,2),(30,26,2,2),(31,27,1,3),(32,28,1,2),(33,29,1,2),(34,30,1,2),(36,32,2,2),(37,33,2,2),(38,34,2,2),(39,35,2,2),(40,36,2,2),(41,37,2,2),(42,38,4,2),(43,39,2,2),(44,40,2,2),(45,41,4,2),(46,42,2,2),(47,43,2,2),(48,44,2,2),(49,45,2,2),(50,46,2,2),(51,47,2,2),(52,48,2,2),(53,49,2,2),(54,50,2,2),(55,51,4,2),(56,52,4,2),(57,53,4,2),(58,54,2,2),(59,55,2,2),(60,56,2,2),(61,29,1,1),(62,28,1,1),(63,57,1,1),(64,58,1,1),(65,59,1,1),(66,42,2,1),(67,60,2,1),(68,61,2,1),(69,17,2,1),(70,25,2,1),(71,38,2,1),(72,62,2,1),(73,63,2,1),(74,37,2,1),(75,64,2,1),(76,65,2,1),(77,9,2,1),(78,15,2,1),(79,35,2,1),(80,33,2,1),(81,66,2,1),(82,67,2,1),(83,18,2,1),(84,68,2,1),(85,69,2,1),(86,3,2,1),(87,70,2,1),(88,71,2,1),(89,48,2,1),(90,72,2,1),(91,46,2,1),(92,73,2,1),(93,6,2,1),(94,74,2,1),(95,75,2,1),(96,76,2,1),(97,77,2,1),(98,45,2,1),(99,36,2,1),(100,78,2,1),(101,21,2,1),(102,79,2,1),(103,10,2,1),(104,20,2,1),(105,80,2,1),(106,81,2,1),(107,82,2,1),(108,5,2,1),(109,14,2,1),(110,83,2,1),(111,84,2,1),(112,85,2,1),(113,41,2,1),(114,51,2,1),(115,86,2,1),(116,87,2,1),(117,22,2,1),(118,39,2,1),(119,88,2,1),(120,89,2,1),(121,90,2,1),(130,12,2,2),(131,16,2,2),(133,92,1,2),(134,60,2,2),(135,93,2,2),(136,94,2,2),(137,95,2,2),(139,97,2,2),(140,98,2,2),(141,99,2,2),(142,100,2,2),(143,101,2,2),(144,102,2,2),(145,103,2,2),(146,104,2,2),(147,60,2,2),(148,105,2,2),(149,106,2,2),(150,107,2,2),(151,108,2,2),(152,109,2,2),(153,1,2,2),(156,111,4,2),(158,113,3,2),(160,31,2,2),(164,115,3,2),(165,116,3,2),(166,117,2,2),(167,117,2,2),(168,118,2,2),(169,119,2,2),(170,120,2,2),(171,121,2,2),(172,34,3,2),(173,38,3,2),(174,39,3,2),(175,49,3,2),(176,98,3,2),(178,125,3,2),(179,126,3,2),(180,127,3,2),(181,128,3,2),(182,129,3,2),(183,126,3,2),(184,130,2,2),(185,131,2,2),(186,132,3,2),(187,133,3,2),(188,134,3,2),(189,135,3,2),(190,136,3,2),(191,60,2,2),(192,60,2,2),(193,137,2,2),(194,138,3,2),(195,138,3,2),(196,138,3,2),(200,138,1,2),(201,138,1,2),(202,138,2,2),(203,92,1,3),(204,19,2,3),(205,52,4,3),(209,146,3,2),(210,147,1,3),(211,148,1,3),(212,16,2,3),(213,37,2,3),(214,3,2,3),(215,149,2,3),(217,150,2,3),(218,25,2,3),(219,151,2,3),(220,46,2,3),(221,116,2,3),(222,5,2,3),(223,95,2,3),(224,152,2,3),(225,47,2,3),(226,153,2,3),(227,154,2,3),(228,71,2,3),(229,155,2,3),(230,156,2,3),(231,157,2,3),(232,158,2,3),(233,159,2,3),(234,92,4,3),(235,148,4,3),(236,160,4,3),(237,161,4,3),(238,162,2,2),(239,163,2,2),(241,138,1,3),(242,138,1,1),(244,165,4,2),(245,165,1,3);
/*!40000 ALTER TABLE `tbl_participants` ENABLE KEYS */;
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
