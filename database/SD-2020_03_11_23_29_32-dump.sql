-- MySQL dump 10.13  Distrib 5.7.29, for Linux (x86_64)
--
-- Host: 64.227.53.196    Database: superdinero
-- ------------------------------------------------------
-- Server version	5.7.29

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
-- Table structure for table `amounts`
--

DROP TABLE IF EXISTS `amounts`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `amounts` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `from` float NOT NULL,
  `until` float NOT NULL,
  `active` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `amounts`
--

LOCK TABLES `amounts` WRITE;
/*!40000 ALTER TABLE `amounts` DISABLE KEYS */;
INSERT INTO `amounts` VALUES (1,1000,50000,1,'2020-01-29 00:59:44','2020-01-28 07:30:43'),(2,10000,150000,1,'2020-01-29 01:30:57',NULL);
/*!40000 ALTER TABLE `amounts` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `categories`
--

DROP TABLE IF EXISTS `categories`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `categories` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nameES` varchar(100) NOT NULL,
  `nameEN` varchar(100) NOT NULL,
  `active` tinyint(1) NOT NULL DEFAULT '1',
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=52 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `categories`
--

LOCK TABLES `categories` WRITE;
/*!40000 ALTER TABLE `categories` DISABLE KEYS */;
INSERT INTO `categories` VALUES (42,'Compras','Shopping',1,'2020-02-26 01:13:31',NULL),(43,'Consolidar deudas','Consolidate debts',1,'2020-02-26 01:13:55',NULL),(44,'Recibos','Receipts',1,'2020-02-26 01:14:09',NULL),(45,'Emergencias','Emergencies',1,'2020-02-26 01:14:18',NULL),(46,'Proveedores','Providers',1,'2020-02-26 01:14:33',NULL),(47,'Mercancias','Merchandise',1,'2020-02-26 01:14:40',NULL),(48,'Expandir negocio','Business expansion',1,'2020-02-26 01:14:56',NULL),(49,'Comprar carro nuevo','Buy a new car',1,'2020-02-26 03:46:39',NULL),(50,'Comprar carro usado','Buy an used car',1,'2020-02-26 03:46:53','2020-02-26 05:54:26');
/*!40000 ALTER TABLE `categories` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `ci_sessions`
--

DROP TABLE IF EXISTS `ci_sessions`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `ci_sessions` (
  `id` varchar(128) NOT NULL,
  `ip_address` varchar(45) NOT NULL,
  `timestamp` int(10) unsigned NOT NULL DEFAULT '0',
  `data` blob NOT NULL,
  PRIMARY KEY (`id`),
  KEY `ci_sessions_timestamp` (`timestamp`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `ci_sessions`
--

LOCK TABLES `ci_sessions` WRITE;
/*!40000 ALTER TABLE `ci_sessions` DISABLE KEYS */;
INSERT INTO `ci_sessions` VALUES ('0f11b51bab637c5e374eb4ab0a326caa337818c4','172.19.0.1',1583978125,_binary '__ci_last_regenerate|i:1583978125;'),('1a406a2ddd65c80a629dfbd9ac782aaa1a1922ed','172.30.0.1',1583986399,_binary '__ci_last_regenerate|i:1583986399;'),('4ffe3a78b2445f70a95b29ebf5252ffc31b0bf6a','172.24.0.1',1583985053,_binary '__ci_last_regenerate|i:1583985053;logged|b:1;id|s:1:\"1\";email|s:21:\"admin@superdinero.com\";names|s:2:\"Mr\";lastnames|s:5:\"Admin\";code|s:1:\"1\";profile|s:1:\"1\";token|s:65:\"$Q5444bbBrRt9Cd8goEObasdlYJbi33dduyfDu92BaviqfWCOw6wlEYBfbkwqpj/K\";'),('b145e0013d29c298f9109c1444ccd78326cdadb5','172.29.0.1',1583986392,_binary '__ci_last_regenerate|i:1583986392;logged|b:1;id|s:1:\"1\";email|s:21:\"admin@superdinero.com\";names|s:2:\"Mr\";lastnames|s:5:\"Admin\";code|s:1:\"1\";profile|s:1:\"1\";token|s:65:\"$Q5444bbBrRt9Cd8goEObasdlYJbi33dduyfDu92BaviqfWCOw6wlEYBfbkwqpj/K\";'),('b418d77e4861d032c6afc27548c7c3d2b1614d2c','172.23.0.1',1583978502,_binary '__ci_last_regenerate|i:1583978502;logged|b:1;id|s:1:\"1\";email|s:21:\"admin@superdinero.com\";names|s:2:\"Mr\";lastnames|s:5:\"Admin\";code|s:1:\"1\";profile|s:1:\"1\";token|s:65:\"$Q5444bbBrRt9Cd8goEObasdlYJbi33dduyfDu92BaviqfWCOw6wlEYBfbkwqpj/K\";');
/*!40000 ALTER TABLE `ci_sessions` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `codes`
--

DROP TABLE IF EXISTS `codes`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `codes` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `codigo` varchar(10) DEFAULT NULL,
  `agent` int(11) DEFAULT NULL,
  `configuracion` text,
  `created_at` date DEFAULT NULL,
  `updated_at` date DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_agent` (`agent`)
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `codes`
--

LOCK TABLES `codes` WRITE;
/*!40000 ALTER TABLE `codes` DISABLE KEYS */;
INSERT INTO `codes` VALUES (2,'AC-10000',1,'{\"amount\":6,\"credit\":\"23\",\"category\":\"47\",\"document\":\"7\",\"record\":\"6\",\"state\":\"4\",\"has_car\":true,\"has_house\":false,\"earnings\":\"2001 - 2500\",\"payform\":\"Efectivo\",\"aditional_1\":\"Recibos\"}','2020-03-06',NULL);
/*!40000 ALTER TABLE `codes` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `credits`
--

DROP TABLE IF EXISTS `credits`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `credits` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nameES` varchar(100) NOT NULL,
  `nameEN` varchar(100) NOT NULL,
  `active` int(11) NOT NULL,
  `maxAmount` float NOT NULL,
  `minAmount` float DEFAULT NULL,
  `slug` varchar(100) DEFAULT NULL,
  `askAlways` int(11) NOT NULL DEFAULT '0',
  `questionES` varchar(100) DEFAULT NULL,
  `questionEN` varchar(100) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=28 DEFAULT CHARSET=latin1 ROW_FORMAT=DYNAMIC;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `credits`
--

LOCK TABLES `credits` WRITE;
/*!40000 ALTER TABLE `credits` DISABLE KEYS */;
INSERT INTO `credits` VALUES (22,'Personal','Personal',1,100000,100,'personal',1,'Tienes deudas personales','where have you been. ','2020-02-26 01:15:37','2020-03-06 12:01:51'),(23,'Negocios','Bussiness',1,500000,100,'negocios',0,'','','2020-02-26 01:16:15','2020-03-06 12:02:05'),(24,'Automotriz','Car loans',1,100000,100,'automotriz',0,'','','2020-02-26 03:48:03','2020-03-06 12:02:17');
/*!40000 ALTER TABLE `credits` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `credits_categories`
--

DROP TABLE IF EXISTS `credits_categories`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `credits_categories` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `creditId` int(11) NOT NULL,
  `categoryId` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  KEY `categoryId_cc` (`categoryId`),
  KEY `creditID_cc` (`creditId`),
  CONSTRAINT `categoryId_cc` FOREIGN KEY (`categoryId`) REFERENCES `categories` (`id`),
  CONSTRAINT `creditID_cc` FOREIGN KEY (`creditId`) REFERENCES `credits` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=128 DEFAULT CHARSET=latin1 ROW_FORMAT=DYNAMIC;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `credits_categories`
--

LOCK TABLES `credits_categories` WRITE;
/*!40000 ALTER TABLE `credits_categories` DISABLE KEYS */;
INSERT INTO `credits_categories` VALUES (119,22,42,'2020-03-06 00:01:52'),(120,22,43,'2020-03-06 00:01:52'),(121,22,44,'2020-03-06 00:01:52'),(122,22,45,'2020-03-06 00:01:52'),(123,23,46,'2020-03-06 00:02:06'),(124,23,47,'2020-03-06 00:02:06'),(125,23,48,'2020-03-06 00:02:06'),(126,24,49,'2020-03-06 00:02:17'),(127,24,50,'2020-03-06 00:02:17');
/*!40000 ALTER TABLE `credits_categories` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `documents`
--

DROP TABLE IF EXISTS `documents`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `documents` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nameES` varchar(50) NOT NULL,
  `nameEN` varchar(50) NOT NULL,
  `active` int(11) NOT NULL DEFAULT '1',
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `documents`
--

LOCK TABLES `documents` WRITE;
/*!40000 ALTER TABLE `documents` DISABLE KEYS */;
INSERT INTO `documents` VALUES (4,'ITIN','ITIN',1,'2020-02-26 01:37:34',NULL),(5,'SSN','SSN',1,'2020-02-26 01:37:43',NULL),(6,'Matricula consular','Consular registration',1,'2020-02-26 01:37:59',NULL),(7,'Pasaport','Passport',1,'2020-02-26 01:38:09',NULL);
/*!40000 ALTER TABLE `documents` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `partners`
--

DROP TABLE IF EXISTS `partners`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `partners` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nameES` varchar(50) NOT NULL,
  `nameEN` varchar(50) NOT NULL,
  `requiresCar` int(11) NOT NULL,
  `requiresHouse` int(11) NOT NULL,
  `rate` float NOT NULL,
  `onlyAgent` int(11) NOT NULL DEFAULT '0',
  `characteristicsES` varchar(500) DEFAULT NULL,
  `characteristicsEN` varchar(500) DEFAULT NULL,
  `url` varchar(500) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT NULL,
  `active` int(11) NOT NULL DEFAULT '1',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=21 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `partners`
--

LOCK TABLES `partners` WRITE;
/*!40000 ALTER TABLE `partners` DISABLE KEYS */;
INSERT INTO `partners` VALUES (10,'asdasda','qweqweqwe',0,0,4,0,'asdasd,asasd,asdasd,asdasd','qweqweqw,qweqwe,qweqweqwe,qweqwe','https://google.com','2020-02-12 23:37:00','2020-02-27 12:02:30',1),(11,'test','test',0,0,3,0,'test,test,test,test','test,test,test,test','https://google.com','2020-02-13 22:10:56',NULL,1),(16,'asdasjpoj','sadasljioj',0,0,5,0,'poj,pojpoj,pojpoj,pojop','oijioj,oij,oj,ojoij','https://google.com','2020-02-27 23:03:00',NULL,1),(17,'kjojpio','pojpoj',0,0,5,0,'jpj,poj,pojpo,jpoj','pjp,jpoj,poj,pojp','https://google.com','2020-02-27 23:11:57',NULL,1);
/*!40000 ALTER TABLE `partners` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `partners_amounts`
--

DROP TABLE IF EXISTS `partners_amounts`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `partners_amounts` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `partnerId` int(11) NOT NULL,
  `amountId` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  KEY `amount_pa` (`amountId`),
  KEY `partnerId_pa` (`partnerId`),
  CONSTRAINT `amount_pa` FOREIGN KEY (`amountId`) REFERENCES `amounts` (`id`),
  CONSTRAINT `partnerId_pa` FOREIGN KEY (`partnerId`) REFERENCES `partners` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `partners_amounts`
--

LOCK TABLES `partners_amounts` WRITE;
/*!40000 ALTER TABLE `partners_amounts` DISABLE KEYS */;
/*!40000 ALTER TABLE `partners_amounts` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `partners_categories`
--

DROP TABLE IF EXISTS `partners_categories`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `partners_categories` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `partnerId` int(11) NOT NULL,
  `categoryId` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  KEY `categoryId_pc` (`categoryId`),
  KEY `partnerId_pc` (`partnerId`),
  CONSTRAINT `categoryId_pc` FOREIGN KEY (`categoryId`) REFERENCES `categories` (`id`),
  CONSTRAINT `partnerId_pc` FOREIGN KEY (`partnerId`) REFERENCES `partners` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `partners_categories`
--

LOCK TABLES `partners_categories` WRITE;
/*!40000 ALTER TABLE `partners_categories` DISABLE KEYS */;
/*!40000 ALTER TABLE `partners_categories` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `partners_credits`
--

DROP TABLE IF EXISTS `partners_credits`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `partners_credits` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `partnerId` int(11) NOT NULL,
  `creditsId` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  KEY `fk_partnerId_pc` (`partnerId`),
  KEY `fk_creditsId_pc` (`creditsId`),
  CONSTRAINT `fk_creditsId_pc` FOREIGN KEY (`creditsId`) REFERENCES `credits` (`id`),
  CONSTRAINT `fk_partnerId_pc` FOREIGN KEY (`partnerId`) REFERENCES `partners` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=latin1 ROW_FORMAT=DYNAMIC;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `partners_credits`
--

LOCK TABLES `partners_credits` WRITE;
/*!40000 ALTER TABLE `partners_credits` DISABLE KEYS */;
/*!40000 ALTER TABLE `partners_credits` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `partners_documents`
--

DROP TABLE IF EXISTS `partners_documents`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `partners_documents` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `partnerId` int(11) NOT NULL,
  `documentId` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  KEY `fk_partnerId_pd` (`partnerId`),
  KEY `fk_documentId_pd` (`documentId`),
  CONSTRAINT `fk_documentId_pd` FOREIGN KEY (`documentId`) REFERENCES `documents` (`id`),
  CONSTRAINT `fk_partnerId_pd` FOREIGN KEY (`partnerId`) REFERENCES `partners` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=latin1 ROW_FORMAT=DYNAMIC;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `partners_documents`
--

LOCK TABLES `partners_documents` WRITE;
/*!40000 ALTER TABLE `partners_documents` DISABLE KEYS */;
/*!40000 ALTER TABLE `partners_documents` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `partners_records`
--

DROP TABLE IF EXISTS `partners_records`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `partners_records` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `partnerId` int(11) NOT NULL,
  `recordId` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  KEY `fk_partnerId_pr` (`partnerId`),
  KEY `fk_recordId_pr` (`recordId`),
  CONSTRAINT `fk_partnerId_pr` FOREIGN KEY (`partnerId`) REFERENCES `partners` (`id`),
  CONSTRAINT `fk_recordId_pr` FOREIGN KEY (`recordId`) REFERENCES `records` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=latin1 ROW_FORMAT=DYNAMIC;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `partners_records`
--

LOCK TABLES `partners_records` WRITE;
/*!40000 ALTER TABLE `partners_records` DISABLE KEYS */;
/*!40000 ALTER TABLE `partners_records` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `partners_states`
--

DROP TABLE IF EXISTS `partners_states`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `partners_states` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `partnerId` int(11) NOT NULL,
  `stateId` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  KEY `partnerId_ps` (`partnerId`),
  KEY `stateId_ps` (`stateId`),
  CONSTRAINT `partnerId_ps` FOREIGN KEY (`partnerId`) REFERENCES `partners` (`id`),
  CONSTRAINT `stateId_ps` FOREIGN KEY (`stateId`) REFERENCES `states` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `partners_states`
--

LOCK TABLES `partners_states` WRITE;
/*!40000 ALTER TABLE `partners_states` DISABLE KEYS */;
INSERT INTO `partners_states` VALUES (5,10,3,'2020-02-12 23:37:00'),(6,10,4,'2020-02-12 23:37:00'),(7,11,3,'2020-02-13 22:10:57');
/*!40000 ALTER TABLE `partners_states` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `records`
--

DROP TABLE IF EXISTS `records`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `records` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nameES` varchar(80) NOT NULL,
  `nameEN` varchar(80) NOT NULL,
  `active` int(11) NOT NULL DEFAULT '1',
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `records`
--

LOCK TABLES `records` WRITE;
/*!40000 ALTER TABLE `records` DISABLE KEYS */;
INSERT INTO `records` VALUES (5,'Excelente credito (de 680 a 850)','Excelent credit (from 680 to 850)',1,'2020-02-26 01:42:42',NULL),(6,'Buen credito (de 600 a 679)','Good credit (from 600 to 679)',1,'2020-02-26 01:43:17',NULL),(7,'Mal credito (de 599 para abajo)','Bad credit (from 599 to less)',1,'2020-02-26 01:43:50',NULL),(8,'No historial (si nunca has tenido credito)','No history (if you have never had credit)',1,'2020-02-26 01:44:22',NULL),(9,'No estoy seguro (si no has revisado o no recuerdas)','Not sure (if you have not reviewed or dont remember)',1,'2020-02-26 01:45:01','2020-02-25 07:46:56');
/*!40000 ALTER TABLE `records` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `states`
--

DROP TABLE IF EXISTS `states`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `states` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nameES` varchar(100) NOT NULL,
  `nameEN` varchar(100) NOT NULL,
  `active` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `states`
--

LOCK TABLES `states` WRITE;
/*!40000 ALTER TABLE `states` DISABLE KEYS */;
INSERT INTO `states` VALUES (3,'Nueva Jersey','New Jersey',1,'2020-01-29 00:40:28','2020-02-14 03:36:28'),(4,'Nueva York','New York',1,'2020-01-29 02:57:22','2020-02-25 05:26:58');
/*!40000 ALTER TABLE `states` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `names` varchar(100) NOT NULL,
  `lastnames` varchar(100) NOT NULL,
  `code` varchar(20) NOT NULL,
  `password` varchar(70) NOT NULL,
  `email` varchar(100) NOT NULL,
  `profile` int(11) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `users`
--

LOCK TABLES `users` WRITE;
/*!40000 ALTER TABLE `users` DISABLE KEYS */;
INSERT INTO `users` VALUES (1,'Mr','Admin','1','$2y$10$Fk2NIQ549Cd8oEOblYJbiuyfDu92BaviqfWCOw6wlEYBfbkwqpj/K','admin@superdinero.com',1,'2020-01-28 14:52:56',NULL),(2,'Mr','normal','1','$2y$10$Fk2NIQ549Cd8oEOblYJbiuyfDu92BaviqfWCOw6wlEYBfbkwqpj/K','normal@superdinero.com',2,'2020-01-28 14:52:56',NULL);
/*!40000 ALTER TABLE `users` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2020-03-11 23:29:59
