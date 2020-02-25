-- MySQL dump 10.13  Distrib 5.7.29, for Linux (x86_64)
--
-- Host: localhost    Database: monitoring_db
-- ------------------------------------------------------
-- Server version	5.7.29-0ubuntu0.18.04.1

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
-- Table structure for table `attendance_logs`
--

DROP TABLE IF EXISTS `attendance_logs`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `attendance_logs` (
  `atl_id` int(11) NOT NULL AUTO_INCREMENT,
  `atl_occupant_id` int(11) DEFAULT NULL,
  `atl_date_in` date DEFAULT NULL,
  `atl_date_out` date DEFAULT NULL,
  `atl_time_in` time DEFAULT NULL,
  `atl_time_out` time DEFAULT NULL,
  `atl_status` varchar(50) DEFAULT NULL COMMENT 'ongoing/done',
  `modified_at` datetime DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `created_by` int(11) DEFAULT NULL,
  PRIMARY KEY (`atl_id`),
  KEY `FK_attendance_logs_occupants` (`atl_occupant_id`),
  KEY `FK_attendance_logs_users` (`created_by`),
  CONSTRAINT `FK_attendance_logs_users` FOREIGN KEY (`created_by`) REFERENCES `users` (`use_id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=40 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `attendance_logs`
--

LOCK TABLES `attendance_logs` WRITE;
/*!40000 ALTER TABLE `attendance_logs` DISABLE KEYS */;
INSERT INTO `attendance_logs` VALUES (1,1,'2020-02-10','2020-02-10','16:28:40','17:14:53','done','2020-02-10 17:14:53','2020-02-10 16:28:40',1),(2,4,'2020-02-10','2020-02-10','16:38:08','17:33:03','done','2020-02-10 17:33:03','2020-02-10 16:38:08',1),(3,3,'2020-02-10','2020-02-10','17:18:11','17:19:10','done','2020-02-10 17:19:10','2020-02-10 17:18:11',1),(4,2,'2020-02-10','2020-02-10','17:19:21','19:01:28','done','2020-02-10 19:01:28','2020-02-10 17:19:21',1),(5,6,'2020-02-10','2020-02-10','18:01:29','18:02:17','done','2020-02-10 18:02:17','2020-02-10 18:01:29',3),(6,1,'2020-02-10','2020-02-10','18:27:16','20:51:29','done','2020-02-10 20:51:29','2020-02-10 18:27:16',3),(7,3,'2020-02-10','2020-02-10','19:03:38','20:50:43','done','2020-02-10 20:50:43','2020-02-10 19:03:38',3),(8,10,'2020-02-10','2020-02-10','20:26:38','20:49:26','done','2020-02-10 20:49:26','2020-02-10 20:26:38',3),(9,2,'2020-02-10','2020-02-10','20:28:14','20:47:58','done','2020-02-10 20:47:58','2020-02-10 20:28:14',3),(10,7,'2020-02-10','2020-02-10','20:31:04','20:47:35','done','2020-02-10 20:47:35','2020-02-10 20:31:04',3),(11,8,'2020-02-10','2020-02-10','20:31:16','20:47:20','done','2020-02-10 20:47:20','2020-02-10 20:31:16',3),(12,6,'2020-02-10','2020-02-10','20:31:26','20:46:55','done','2020-02-10 20:46:55','2020-02-10 20:31:26',3),(13,9,'2020-02-10','2020-02-10','20:31:37','20:46:26','done','2020-02-10 20:46:26','2020-02-10 20:31:37',3),(14,5,'2020-02-10','2020-02-10','20:31:51','20:45:56','done','2020-02-10 20:45:56','2020-02-10 20:31:51',3),(15,4,'2020-02-10','2020-02-10','20:32:02','20:45:16','done','2020-02-10 20:45:16','2020-02-10 20:32:02',3),(16,5,'2020-02-10','2020-02-10','20:47:50','20:49:03','done','2020-02-10 20:49:03','2020-02-10 20:47:50',3),(17,4,'2020-02-10','2020-02-10','20:49:20','20:49:43','done','2020-02-10 20:49:43','2020-02-10 20:49:20',3),(18,10,'2020-02-10','2020-02-10','20:49:43','20:50:23','done','2020-02-10 20:50:23','2020-02-10 20:49:43',3),(19,7,'2020-02-10','2020-02-10','21:09:50','21:34:42','done','2020-02-10 21:34:42','2020-02-10 21:09:50',1),(20,8,'2020-02-10','2020-02-10','21:10:03','21:55:43','done','2020-02-10 21:55:43','2020-02-10 21:10:03',1),(21,9,'2020-02-10','2020-02-10','21:39:14','21:41:03','done','2020-02-10 21:41:03','2020-02-10 21:39:14',1),(22,6,'2020-02-10','2020-02-10','21:44:42','21:44:50','done','2020-02-10 21:44:50','2020-02-10 21:44:42',1),(23,1,'2020-02-10','2020-02-10','21:50:15','21:50:36','done','2020-02-10 21:50:36','2020-02-10 21:50:15',1),(24,6,'2020-02-10','2020-02-10','21:53:01','21:53:03','done','2020-02-10 21:53:03','2020-02-10 21:53:01',1),(25,5,'2020-02-10','2020-02-10','21:55:12','22:05:00','done','2020-02-10 22:05:00','2020-02-10 21:55:12',1),(26,1,'2020-02-10','2020-02-10','22:02:06','22:02:12','done','2020-02-10 22:02:12','2020-02-10 22:02:06',1),(27,10,'2020-02-10','2020-02-11','22:03:48','23:06:46','done','2020-02-11 23:06:46','2020-02-10 22:03:48',3),(28,11,'2020-02-11','2020-02-11','10:08:15','10:09:47','done','2020-02-11 10:09:47','2020-02-11 10:08:15',1),(29,7,'2020-02-11','2020-02-11','10:10:07','10:11:19','done','2020-02-11 10:11:19','2020-02-11 10:10:07',1),(30,8,'2020-02-11','2020-02-11','10:39:39','10:46:38','done','2020-02-11 10:46:38','2020-02-11 10:39:39',1),(31,18,'2020-02-11','2020-02-11','14:06:34','14:32:40','done','2020-02-11 14:32:40','2020-02-11 14:06:34',1),(32,22,'2020-02-11','2020-02-11','14:31:19','17:01:09','done','2020-02-11 17:01:09','2020-02-11 14:31:19',1),(33,7,'2020-02-11','2020-02-11','17:01:51','23:06:34','done','2020-02-11 23:06:34','2020-02-11 17:01:51',3),(34,36,'2020-02-12','2020-02-13','11:32:24','22:06:34','done','2020-02-13 22:06:34','2020-02-12 11:32:24',1),(35,1,'2020-02-12','2020-02-12','11:34:14','16:28:40','done','2020-02-12 16:28:40','2020-02-12 11:34:14',3),(36,6,'2020-02-13','2020-02-13','22:07:37','22:07:38','done','2020-02-13 22:07:38','2020-02-13 22:07:37',1),(37,1,'2020-02-18','2020-02-19','23:38:59','00:21:18','done','2020-02-19 00:21:18','2020-02-18 23:38:59',1),(38,5,'2020-02-22',NULL,'10:23:35',NULL,'ongoing',NULL,'2020-02-22 10:23:35',3),(39,2,'2020-02-22','2020-02-22','10:31:28','10:32:21','done','2020-02-22 10:32:21','2020-02-22 10:31:28',1);
/*!40000 ALTER TABLE `attendance_logs` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `global_variables`
--

DROP TABLE IF EXISTS `global_variables`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `global_variables` (
  `glv_id` int(11) NOT NULL AUTO_INCREMENT,
  `glv_name` varchar(50) DEFAULT NULL,
  `glv_value` int(11) DEFAULT NULL COMMENT 'for time please use military time',
  `created_at` datetime DEFAULT NULL,
  `modified_at` datetime DEFAULT NULL,
  `created_by` int(11) DEFAULT NULL,
  PRIMARY KEY (`glv_id`),
  KEY `FK_global_variables_users` (`created_by`),
  CONSTRAINT `FK_global_variables_users` FOREIGN KEY (`created_by`) REFERENCES `users` (`use_id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `global_variables`
--

LOCK TABLES `global_variables` WRITE;
/*!40000 ALTER TABLE `global_variables` DISABLE KEYS */;
INSERT INTO `global_variables` VALUES (1,'PARKING_SLOT_COUNT',2,'2020-01-28 20:50:40','2020-02-22 10:31:06',1),(2,'PARKING_LOT_CLOSING_TIME',2200,'2020-02-07 13:07:38','2020-02-22 10:31:06',1),(3,'ENABLE_EMAIL',1,'2020-02-07 17:41:42','2020-02-22 10:31:06',1),(4,'ENABLE_SMS',1,'2020-02-07 17:41:57','2020-02-22 10:31:06',1),(5,'RESERVATION_TIME_LIMIT',15,'2020-02-07 19:32:56','2020-02-22 10:31:06',1),(6,'ENABLE_AUTOMATIC_CLOSING_SMS_BLAST',1,'2020-02-08 00:23:15','2020-02-22 10:31:06',1),(7,'ENABLE_AUTOMATIC_DISABLING_OF_GUEST',1,'2020-02-08 00:24:36','2020-02-22 10:31:06',1);
/*!40000 ALTER TABLE `global_variables` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `incident_reports`
--

DROP TABLE IF EXISTS `incident_reports`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `incident_reports` (
  `icr_id` int(11) NOT NULL AUTO_INCREMENT,
  `icr_occupant_id` int(11) DEFAULT NULL,
  `icr_datetime` datetime DEFAULT NULL,
  `icr_description` text,
  `icr_status` varchar(50) DEFAULT NULL COMMENT 'ongoing/done/cancel',
  `icr_notes` text,
  `created_at` datetime DEFAULT NULL,
  `modified_at` datetime DEFAULT NULL,
  `created_by` int(11) DEFAULT NULL,
  PRIMARY KEY (`icr_id`),
  KEY `FK_incident_reports_users` (`created_by`),
  KEY `FK_incident_reports_occupants` (`icr_occupant_id`),
  CONSTRAINT `FK_incident_reports_occupants` FOREIGN KEY (`icr_occupant_id`) REFERENCES `occupants` (`occ_id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `FK_incident_reports_users` FOREIGN KEY (`created_by`) REFERENCES `users` (`use_id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `incident_reports`
--

LOCK TABLES `incident_reports` WRITE;
/*!40000 ALTER TABLE `incident_reports` DISABLE KEYS */;
INSERT INTO `incident_reports` VALUES (1,1,'2020-02-10 16:59:47','sinipa nya yung tambucho ko. nasira tuloy','done','nabayaran na ni rey si gerard ng tatlong pung dulyares. maraming salamat sa pagtangkilik ng aming produkto at serbisyong walang kinikilingan, walang pinoprotektahan, walang kasinungalingan. serbisyong totoo lamang.','2020-02-10 16:59:47','2020-02-10 17:02:24',1),(2,2,'2020-02-10 20:36:56','Accidentally scratch the motorcyle of Mr. Rey Galaneda.','done','Ms. Shy sto. domingo pay Mr. Rey Galaneda base on the damages.','2020-02-10 20:36:56','2020-02-10 20:39:13',1),(3,4,'2020-02-10 20:39:58','Mr. Bucaloy broke the side mirror of Mr. Villamor.','cancel','dont have an evidence on cctv .','2020-02-10 20:39:58','2020-02-10 20:41:14',1),(4,7,'2020-02-10 21:13:43','scratch motorcycle of mr. datuin.','cancel','both dead','2020-02-10 21:13:43','2020-02-10 21:17:51',1),(5,8,'2020-02-10 21:16:12','Deflate motorctcle tire of mr.Guillermo.','done','already clear each other','2020-02-10 21:16:12','2020-02-10 21:17:18',1);
/*!40000 ALTER TABLE `incident_reports` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `occupant_guardians`
--

DROP TABLE IF EXISTS `occupant_guardians`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `occupant_guardians` (
  `ocg_id` int(11) NOT NULL AUTO_INCREMENT,
  `ocg_occupant_id` int(11) DEFAULT NULL,
  `ocg_name` varchar(150) DEFAULT NULL,
  `ocg_occupation` varchar(150) DEFAULT NULL,
  `ocg_contact` varchar(150) DEFAULT NULL,
  PRIMARY KEY (`ocg_id`),
  KEY `FK__occupants` (`ocg_occupant_id`),
  CONSTRAINT `FK__occupants` FOREIGN KEY (`ocg_occupant_id`) REFERENCES `occupants` (`occ_id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=112 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `occupant_guardians`
--

LOCK TABLES `occupant_guardians` WRITE;
/*!40000 ALTER TABLE `occupant_guardians` DISABLE KEYS */;
INSERT INTO `occupant_guardians` VALUES (1,1,'Ramil T. Galaneda','Building Maintenance','09153889262'),(2,2,'',NULL,NULL),(3,3,'Juliet Guillermo','Housewife','09151234567'),(4,4,'Joan Bendal','cashier/secretary','09457531048'),(5,5,'',NULL,NULL),(6,6,'Angel Loh Cantillo','Call Center Agents','09296166460'),(7,7,'',NULL,NULL),(8,8,'','teacher',NULL),(9,9,'Wacky Tari','Consultant',NULL),(10,10,'',NULL,NULL),(11,11,'',NULL,NULL),(12,12,'',NULL,NULL),(13,13,'',NULL,NULL),(14,14,'',NULL,NULL),(15,15,'',NULL,NULL),(16,16,'',NULL,NULL),(17,17,'',NULL,NULL),(18,18,'',NULL,NULL),(19,19,'',NULL,NULL),(20,20,'',NULL,NULL),(21,21,'',NULL,NULL),(22,22,'',NULL,NULL),(23,23,'',NULL,NULL),(24,24,'',NULL,NULL),(25,25,'',NULL,NULL),(26,26,'',NULL,NULL),(27,27,'',NULL,NULL),(28,28,'',NULL,NULL),(29,29,'',NULL,NULL),(30,30,'',NULL,NULL),(31,31,'',NULL,NULL),(32,32,'',NULL,NULL),(33,33,'',NULL,NULL),(34,34,'',NULL,NULL),(36,36,'',NULL,NULL),(39,39,'',NULL,NULL),(40,40,'',NULL,NULL),(41,41,'',NULL,NULL),(42,42,'',NULL,NULL),(43,43,'',NULL,NULL),(44,44,'',NULL,NULL),(45,45,'',NULL,NULL),(46,46,'',NULL,NULL),(47,47,'',NULL,NULL),(48,48,'Shiela Marie Ibanez','site engr.','09174369084'),(49,49,'Jose Banzuela',NULL,'09497841919'),(50,50,'Gemma Saunar','hosewife','09954682701'),(51,51,'',NULL,NULL),(52,52,'',NULL,NULL),(53,53,'',NULL,NULL),(54,54,'Lulu Condes','hosewife',NULL),(55,55,'Hilario Sapa','govt employee',NULL),(56,56,'',NULL,NULL),(57,57,'',NULL,NULL),(58,58,'',NULL,NULL),(59,59,'',NULL,NULL),(60,60,'Susan O. Anteja',NULL,NULL),(61,61,'',NULL,NULL),(62,62,'',NULL,NULL),(63,63,'',NULL,NULL),(64,64,'',NULL,NULL),(65,65,'',NULL,NULL),(66,66,'',NULL,NULL),(67,67,'',NULL,NULL),(68,68,'',NULL,NULL),(69,69,'',NULL,NULL),(70,70,'',NULL,NULL),(71,71,'',NULL,NULL),(72,72,'',NULL,NULL),(73,73,'',NULL,NULL),(74,74,'',NULL,NULL),(75,75,'',NULL,NULL),(76,76,'',NULL,NULL),(77,77,'',NULL,NULL),(78,78,'',NULL,NULL),(79,79,'',NULL,NULL),(80,80,'',NULL,NULL),(81,81,'',NULL,NULL),(82,82,'',NULL,NULL),(83,83,'',NULL,NULL),(84,84,'',NULL,NULL),(85,85,'',NULL,NULL),(86,86,'',NULL,NULL),(87,87,'',NULL,NULL),(88,88,'',NULL,NULL),(89,89,'',NULL,NULL),(90,90,'',NULL,NULL),(91,91,'',NULL,NULL),(92,92,'',NULL,NULL),(93,93,'',NULL,NULL),(94,94,'',NULL,NULL),(95,95,'',NULL,NULL),(96,96,'',NULL,NULL),(97,97,'',NULL,NULL),(98,98,'',NULL,NULL),(99,99,'',NULL,NULL),(100,100,'',NULL,NULL),(101,101,'',NULL,NULL),(102,102,'',NULL,NULL),(103,103,'',NULL,NULL),(104,104,'',NULL,NULL),(105,105,'',NULL,NULL),(106,106,'',NULL,NULL),(107,107,'',NULL,NULL),(108,108,'',NULL,NULL),(109,109,'',NULL,NULL),(110,110,'',NULL,NULL),(111,111,'',NULL,NULL);
/*!40000 ALTER TABLE `occupant_guardians` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `occupant_motorcycle_info`
--

DROP TABLE IF EXISTS `occupant_motorcycle_info`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `occupant_motorcycle_info` (
  `omi_id` int(11) NOT NULL AUTO_INCREMENT,
  `omi_occupant_id` int(11) DEFAULT NULL,
  `omi_or_number` varchar(150) DEFAULT NULL,
  `omi_cr_number` varchar(150) DEFAULT NULL,
  `omi_plate_number` varchar(150) DEFAULT NULL,
  `omi_brand` varchar(150) DEFAULT NULL,
  `omi_model` varchar(150) DEFAULT NULL,
  PRIMARY KEY (`omi_id`),
  KEY `FK_occupant_motorcycle_info_occupants` (`omi_occupant_id`)
) ENGINE=InnoDB AUTO_INCREMENT=112 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `occupant_motorcycle_info`
--

LOCK TABLES `occupant_motorcycle_info` WRITE;
/*!40000 ALTER TABLE `occupant_motorcycle_info` DISABLE KEYS */;
INSERT INTO `occupant_motorcycle_info` VALUES (1,1,'0ffc14Lr3c31pt','r3g4str4t1i0n','9046 DA','SUZUKI','Raider J110'),(2,2,'9009','009','XXY5656','YAMAHA','MXI'),(3,3,'SJ08909','ALPHA1243567','EO0078','Suzuki','Gixxer'),(4,4,'898989','9898','xxy454','kawasaki','fury'),(5,5,'1827319','19283719','1821','Ducatti','X1'),(6,6,'123456','789101112','LLY 3017','Honda','Scoopy'),(7,7,'010101010','122313123','LLY123','Yamaha','Mio Soul 2'),(8,8,'0090','09090','fgh789','BMW','yui90'),(9,9,'SA2353','SA8878809','BD2162','Honda','Click'),(10,10,'djekke378272','dhjwhjhe3627637','XNXX 18','KAWASAKI','FURY 2020'),(11,11,'898','989','xxy444','suzuki','raider 250'),(12,12,'1426142gg','djeg3ty3t','7745 FD','jdjejdhej','ejejdeje'),(13,13,'923756810','152378548','AE 0504','Yamaha','2019 N MAX'),(14,14,'869354721','897542154','108k JC','suzuki','gril 2020'),(15,15,'18235698','324630036','1380000001','Yamaha','2018 mio'),(16,16,'021902114','141021902','1401NS','YAMAHA','mio125'),(17,17,'779253467','958123459','0523-ja','honda','click 125i'),(18,18,'108153902','209351801','2001JC','Yamaha','Mi0i125'),(19,19,'226995675','153684782','3861-de','yahama','sniper 2018'),(20,20,'912364921','32199421','1368-hi','suzuki','fi 2009'),(21,21,'135976224','318796321','1067 HO','Yamaha','Mio'),(22,22,'391684321','134676598','6301-dg','honda','2009'),(23,23,'8988989898','98999898','0802 DH','suzuki','step'),(24,24,'321689321','468932101','3672-me','honda','xrm 125fi'),(25,25,'132469802','123896321','we3899','honda','xrm'),(26,26,'123469013','321045693','13010542787','Yamaha','2018 mio'),(27,27,'3674892103','213010031','9031-ml','honda','tmx'),(28,28,'3210987652','321046903','3648 xy','suzuki','raider 150'),(29,29,'134800001','0000001134','1357 TN','Rusi','2005'),(30,30,'486701391','134876513','3045-xn','rusi','2007'),(31,31,'1863400001','3210000011','GR08 LT','Yamaha','NMAX 2019'),(32,32,'148632100','001348963','3210-mv','honda','2008'),(33,33,'124162418','126516255','3452 FG','SUZUKI','FI 2001'),(34,34,'134876321','148976213','0031 LG','YAMAHA','Mio'),(36,36,'134875611','113000079','3321lq','yamaha','mio'),(39,39,'816321000','138000193','3366-mp','suzuki','rider 150'),(40,40,'367001313','44844004','4401 lm','euro','euro sports 110'),(41,41,'187693200','1876532100','3001 ZM','Rusi','2015'),(42,42,'160100313','163006739','0100 ab','YAMAHA','soul i 2009'),(43,43,'876543210','321006541','PH 0013','Honda XRM','2009'),(44,44,'800100654','137006321','3601 md','YAMAHA','nmax 2018'),(45,45,'063004831','399906343','3631 gh','Honda','2018'),(46,46,'367451100','001122334','6310 EF','MotoStar','2003'),(47,47,'361100489','4900655431','0013 IJ','Yamaha Xmax','2019'),(48,48,'100010032','333440011','iy-9234','kawasaki','ninja'),(49,49,'632100871','963201131','2013OD','Susuki Badja','2013'),(50,50,'632100113','321006589','3296 mn','Honda 125','2009'),(51,51,'336044183','98652103','1106 qr','suzuki','2015'),(52,52,'123498765','321001234','XWYCD','Susuki','2007'),(53,53,'336001321','009871321','123o kl','suzuki','2011'),(54,54,'001347611','013486300','1303-0477476','luzonramcyle','sigma rusi 250'),(55,55,'387621001','0013476541','1343 st','honda','wave 125'),(56,56,'634008913','364881341','1364 AG','Suzuki','2012'),(57,57,'1368748311','001130181','AC 0013','Honda','2007'),(58,58,'610030012','300903210','0014 df','honda','2016'),(59,59,'246001393','369320089','3692 dm','kawasaki','fury 2010'),(60,60,'347810521','102788468','04201175','honda','tmx'),(61,61,'163480011','321001633','3001 mv','rusi','2009'),(62,62,'621009832','983210019','9630 bd','yamaha','nmax'),(63,63,'582190295','295219000','1003 ce','SUZUKI','2018'),(64,64,'324896512','80387124','0892 CF','Yamaha','Sniper'),(65,65,'567452310','693210018','4923 ym','honda','click'),(66,66,'000138976','560012435','3891 AB','Suzuki','Raider 150'),(67,67,'18458110','112218','1168 ba','Rusi','2008'),(68,68,'173887001','23189','1057 AB','KAWASAKI','2019'),(69,69,'630110931','176301001','0632LB','YAMAHA','2016'),(70,70,'132124827','002157281','3220 WD','Honda','Dash'),(71,71,'630100321','630110021','9760PT','YAMAHA','2017'),(72,72,'630432100','063201001','6301 MP','Suzuki','Raider R 150'),(73,73,'1472190011','13074','9046 da','honda','2018'),(74,74,'360013213','768392113','1138 QR','Suzuki','2016'),(75,75,'811110111','30011319','8012 ac','honda','2002'),(76,76,'3001433671','400713181','7001 GO','Honda','2011'),(77,77,'3001911817','819617812','3001 ga','honda','2001'),(78,78,'239867543','45177','1045wd','RUSI','2007'),(79,79,'6300117890','673411001','7018 LB','Yamaha','2018'),(80,80,'100134689','361776891','4001 GC','Suzuki','2008'),(81,81,'618132118','913865181','cac 138','suzuki','raider'),(82,82,'34810118','11445','5674bb','honda','2000'),(83,83,'000564599','05987641','4359 xe','kawasaki','rooser'),(84,84,'311467819','56456711','5112 AG','kawasaki','2002'),(85,85,'090456781','004527763','5983 AT','SUZUKI','smash'),(86,86,'321102321','132188199','5832 WW','Honda','click'),(87,87,'1630013210','106321993','0401-572008','Suzuki','GD 110'),(88,88,'918663183','81312218861','at 1311','yamaha','mio'),(89,89,'297981122','24187','1156AA','yamaha','2008'),(90,90,'963210054','673210021','0420-2286321','Suzuki','Raider R 150'),(91,91,'420111451','818214150','5714 AV','Yamaha','Mio'),(92,92,'136870011','13076','1054AD','kawasaki','2019'),(93,93,'963201003','100306321','6321 LZ','Yamaha','sniper 150'),(94,94,'432718183','143215988','2011 BD','Yamaha','Mio'),(95,95,'618192558','613812331','Ba1614','Rusi','150'),(96,96,'321145633','114516181','4403 XL','Honda','Beat'),(97,97,'631001987','783001345','1634 FM','Honda','2011'),(98,98,'861377618','1139748192','1062','Suzuki','smash'),(99,99,'06374341','1003711321','9632 ls','yamaha','mio 2012'),(100,100,'51321522','813221350','3207 XD','Honda','Beat'),(101,101,'913528716','1012188319','ME 4002','Kawasaki','Fury'),(102,102,'631001031','321009673','6305 LQ','kawasaki','2009'),(103,103,'32019833','018113259','0387 ck','honda','dash'),(104,104,'681227611','816134679','0213 OB','Yamaha','Mio'),(105,105,'701118911','361888110','600 OB','Honda','2007'),(106,106,'697321891','100153219','4337 cb','suzuki','raider'),(107,107,'200177811','333668111','7013 AI','Yamaha','2018'),(108,108,'014578398','777654310','4566 XE','kawasaki','Fury'),(109,109,'361300100','109875312','1983 EG','Suzuki','2006'),(110,110,'6321001321','632100193','6319 LV','Rusi','Neptune 125'),(111,111,'10630132100','1630210013','OY20-461997','Yamaha','Mio Soul');
/*!40000 ALTER TABLE `occupant_motorcycle_info` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `occupant_type`
--

DROP TABLE IF EXISTS `occupant_type`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `occupant_type` (
  `oct_id` int(11) NOT NULL AUTO_INCREMENT,
  `oct_name` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`oct_id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `occupant_type`
--

LOCK TABLES `occupant_type` WRITE;
/*!40000 ALTER TABLE `occupant_type` DISABLE KEYS */;
INSERT INTO `occupant_type` VALUES (1,'Student'),(2,'Teacher'),(3,'Guest');
/*!40000 ALTER TABLE `occupant_type` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `occupants`
--

DROP TABLE IF EXISTS `occupants`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `occupants` (
  `occ_id` int(11) NOT NULL AUTO_INCREMENT,
  `occ_lastname` varchar(50) DEFAULT NULL,
  `occ_firstname` varchar(50) DEFAULT NULL,
  `occ_middlename` varchar(50) DEFAULT NULL,
  `occ_date_of_birth` date DEFAULT NULL,
  `occ_address` varchar(250) DEFAULT NULL,
  `occ_student_number` varchar(100) DEFAULT NULL,
  `occ_course` varchar(150) DEFAULT NULL,
  `occ_email_address` varchar(100) DEFAULT NULL,
  `occ_telephone` varchar(50) DEFAULT NULL,
  `occ_phone_number` varchar(50) DEFAULT NULL,
  `occ_qr_code` text,
  `occ_user_id` int(11) DEFAULT NULL,
  `occ_type` int(11) DEFAULT NULL,
  `occ_account_status` varchar(50) DEFAULT 'active',
  `modified_at` datetime DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `created_by` int(11) DEFAULT NULL,
  PRIMARY KEY (`occ_id`),
  KEY `FK_occupants_users` (`occ_user_id`),
  KEY `FK_occupants_users_2` (`created_by`),
  KEY `FK_occupants_user_type` (`occ_type`),
  CONSTRAINT `FK_occupants_user_type` FOREIGN KEY (`occ_type`) REFERENCES `occupant_type` (`oct_id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `FK_occupants_users` FOREIGN KEY (`occ_user_id`) REFERENCES `users` (`use_id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `FK_occupants_users_2` FOREIGN KEY (`created_by`) REFERENCES `users` (`use_id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=112 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `occupants`
--

LOCK TABLES `occupants` WRITE;
/*!40000 ALTER TABLE `occupants` DISABLE KEYS */;
INSERT INTO `occupants` VALUES (1,'Galaneda','Rey','Langga','1995-12-10','#38 Santol St. Ipil Site Barangay BF Homes Paranaque City','ICA6180181','BSIT-LAD 4','rgalaneda@gmail.com','123-4567','9097679256','db803e3e88adde45266e441bbf763d8692f72e3a',4,1,'active',NULL,'2020-02-10 16:26:07',1),(2,'Sto.domingo','Shy','Penaverde','1987-12-04','Bf Almanza Uno, Las Pinas City','ICA67676767','BSBA','stodomingoshy@gmail.com','12321-452142-124','9217758700','ce0f1f122dfc916a50f0489c13a86c3541f6adda',5,1,'active','2020-02-10 16:37:37','2020-02-10 16:34:15',2),(3,'Guillermo','Joseph','Cardino','1992-08-19','Alabang, Muntinlupa City','ICA1230006','BSIT','jagtcdc@gmail.com',NULL,'9493127122','02d80d448eb297e3d6516dcc930e15282fa4311d',6,1,'active','2020-02-10 16:38:39','2020-02-10 16:36:48',2),(4,'BUCALOY','REYMART','DACASIN','1993-02-04','BAYANAN MUNTINLUPA CITY','ICA10151','BSIT','rbucaloy20733@gmail.com','88029956','9488029456','8c3da4fc717eb0043dc84907df17a619b7679c6c',7,1,'active',NULL,'2020-02-10 16:37:20',1),(5,'Datuin','Gerard','Ocampo','1999-05-13','Talon V Las Pinas City','ICA16800628','BSIT','gerarddatuinn28@gmail.com','8019260','9752900745','7cec57bfe0087eba45345442878e97df18beb478',8,1,'active','2020-02-10 16:42:51','2020-02-10 16:41:20',1),(6,'Villamor','Robert Claude','','1999-07-17','Alabang, Muntinlupa City',NULL,NULL,'robertvillamor_17@yahoo.com','123-456-789','9066366691','877884e268e1afa92e40db269016e21794f2115a',9,2,'active','2020-02-14 02:27:24','2020-02-10 17:24:36',2),(7,'Mendoza','Alejandro','Dela cruz','1989-09-09','Las Pinas City',NULL,NULL,'luismendoza@gmail.com','123-123-123-','0296166460','d7bbe9c9abd079a35be4bcf09792622a73f6c768',NULL,3,'deactivated','2020-02-23 07:59:02','2020-02-10 17:50:18',1),(8,'Idio','Rodolfo','SUDAN','1988-02-06','Pasay City',NULL,NULL,'allansaldivar@gmail.com',NULL,'9488029456','dc385b6f849c4c2535d5a89803afe243067fefcb',10,2,'active','2020-02-10 20:19:12','2020-02-10 17:51:08',1),(9,'Guillermo','Lawliet','Car','1994-07-23','Rizal, Rizal','ICA1240076','CPE','jaguillermo94@gmail.com',NULL,'9173279415','2d3288ceb1e77155953b3ee9626fe84c3ea62220',11,1,'active',NULL,'2020-02-10 17:54:55',2),(10,'Japone','Krysella','Mae','1996-12-02','Isabela City','ICA16800629','BSCPE','reygalaneda@gmail.com','123-5678','9153882962','b6ed72d14b5717890afb2b23638951ab02c9a346',12,1,'active',NULL,'2020-02-10 19:54:50',1),(11,'Ranario','Allan','Vesina','1960-09-08','Alabang Muntinlupa City',NULL,NULL,'alanvranario@gmail.com',NULL,'9988849710','361cc9de3eb1203810f9daee79955199616d615a',13,2,'active',NULL,'2020-02-11 10:00:44',1),(12,'Mariquina','Erwin','Anain',NULL,'Muntilupa City',NULL,NULL,'emariquina@yahoo.com',NULL,'9201203990','937976c85037c460afe934a48dbc34adf9276fa7',14,2,'active',NULL,'2020-02-11 10:38:07',2),(13,'Cuevas','Nel mark','Mananquil','2002-05-04','Muntinlupa City',NULL,NULL,'nelmarkcuevas2002@gmail.com',NULL,'9182394987','1942e9c10168152df2a116c85860f5bfcf97d663',NULL,3,'deactivated','2020-02-23 07:59:02','2020-02-11 11:21:01',2),(14,'Gilua','James Carl','Cainoy','2001-10-18','Muntinlupa City',NULL,NULL,'giluajames0@gmail.com',NULL,'9296086529','49d69d49f2a7d5c97cc45be1e95f313ee6320921',NULL,3,'deactivated','2020-02-23 07:59:02','2020-02-11 11:24:44',2),(15,'Ostonal','Reniel','','2001-01-22','Muntinlupa City','13689907l075','ICT','reniel@gmail.com',NULL,'9501316918','b6dc87af9b39a0e67234d70ff7bed95060ab125a',18,1,'active','2020-02-11 11:28:59','2020-02-11 11:27:52',2),(16,'CATAPANG','NEIL STEPHEN','PAGUYO','2001-07-14','Taguig City','ALA318006','IA12','neilstephen014@gmail.com','0918-409-4170','9184094170','188f19d9c36060fb93d1aea0d8411134d33acf5f',19,1,'active',NULL,'2020-02-11 13:40:23',2),(17,'Garcia','Justine lois','Montillano','2002-03-02','Muntinlupa City','ala3180050','IA','justine@gmail.com',NULL,'9053390389','81eff5db357785a7e1f09141bce8faa0b8b913e6',20,1,'active',NULL,'2020-02-11 13:42:34',2),(18,'CATAPANG','JAPHET','PAGUYO','2001-07-14','Bicutan Taguig City','ALA3180091','IA12','catapangjaphet8@gmail.com',NULL,'9451225910','bb92bdfba63c6043e40489a50120932095d7aae2',21,1,'active',NULL,'2020-02-11 13:43:23',2),(19,'Osias','Marc janssen','Saavedra','2001-09-20','Taguig City',NULL,NULL,'jabssenosias@gmail.com',NULL,'920561843','5df37bf1686891a4c95d48bdc17ff9c6c86b1426',NULL,3,'deactivated','2020-02-23 07:59:02','2020-02-11 13:47:11',2),(20,'Gamayon','Rogelio','Obrero','2001-12-09','Muntinlupa City',NULL,NULL,'rogelio@gmail.com',NULL,'9565231134','e2b3eb2e87ef674fbdac651fae6658299835f8ca',NULL,3,'deactivated','2020-02-23 07:59:02','2020-02-11 13:50:52',2),(21,'ARCUENO','RENARD','BUJAUE','1993-07-24','Taguig City','ICA6130049','BSIT','RENARDARCUENO@yahoo.com',NULL,'9300135764','7414508dc43ce525816272b4f359ac107c480382',22,1,'active',NULL,'2020-02-11 14:23:19',2),(22,'Alcostero','Jeliean','Joson','1994-07-11','Alabang, Muntinlupa City','ica6130085','bsit','jelianalalcostero94@gmail.com','800-92-85','9267964198','d4b7b392af0de0a119b8c51a34895c4851c6ccfb',23,1,'active',NULL,'2020-02-11 14:26:04',2),(23,'JACINTO','JAPHET JAN','RICABLANCA','1992-12-05','Muntinlupa City','ICA6160046','BSIT','jap69jacinto@gmail.com',NULL,'9976018185','551e6cbb181aa23bb6c3ffc1cbb6cdc9e7bf82ad',24,1,'active',NULL,'2020-02-11 14:29:22',2),(24,'Edang','Emman','Maganua','1992-09-14','Sucat','ica6170015','bsit','emman.edang@yahoo.com',NULL,'9954879281','a6b43fa613d4b1a3979f6ee7d579be77848d0b83',25,1,'active',NULL,'2020-02-11 14:30:34',2),(25,'ENRICOSO','JEFREY','OLIGO','1991-09-30','Las Pinas City','ICA6160004','BSIT','jeffrey.enrico@gmail.com',NULL,'9054087174','21b860401fd8c4191fab6933cfedf08b3e682727',26,1,'active',NULL,'2020-02-11 15:02:07',2),(26,'DE GUIA','REYMART','CAINONG','2001-10-22','ParanaqueCity','109331070298','HE-A12','Reymartdeguia@gmail.com',NULL,'9954536447','bd7d7f8e77bb0329540fe9da989a461349ab74a7',27,1,'active',NULL,'2020-02-11 16:37:16',2),(27,'Landrito jr.','Bernard','D','2000-03-13','Alabang, Muntinlupa City','1148881060022','he-12a','landrito@gmail.com',NULL,'9979033778','e1a018c0e9ef58a23e670e94cfaee7528ddfb497',28,1,'active',NULL,'2020-02-11 16:40:09',2),(28,'Capalihan','Reyster','Delos Santos','2001-09-22','Muntinlupa City',NULL,NULL,'reyster.nahilapac@yahoo.com',NULL,'9101395314','4256489281ce3cd5523b8c9ca747ff49aba3bcf0',NULL,3,'deactivated','2020-02-23 07:59:02','2020-02-11 16:40:46',2),(29,'Soberano','Mat Riester','Villa','2000-10-18','Muntinlupa City',NULL,NULL,'matchusoberano@yahoo.com',NULL,'9397361841','1e344c3ff92d827ba60b5d3ec7c7b605f9f4e862',NULL,3,'deactivated','2020-02-23 07:59:02','2020-02-11 16:43:02',2),(30,'Montiagodo','Gino carlo','R','2000-04-04','Putatan, Muntinlupa City','13691105137','he-12a','gino@gmail.com',NULL,'9565232498','c275a64ede3944503b8665b350aef524f260d653',29,1,'active',NULL,'2020-02-11 16:43:32',2),(31,'Recto','John Ivan','Binalla','1999-11-19','Taguig City',NULL,NULL,'arecto34@gmail.com',NULL,'9281756945','273a7c481f5971c888571145c8023afdf77ff7c8',NULL,3,'deactivated','2020-02-23 07:59:02','2020-02-11 16:55:37',2),(32,'Ballas','Laurence','B','1988-11-13','Bayanan, Muntinlupa',NULL,NULL,'smithybrazil@gmail.com',NULL,'9773626579','2f0f709255b5f5dc9b7af53433609a2fd16b408d',NULL,3,'deactivated','2020-02-23 07:59:02','2020-02-11 17:02:55',2),(33,'Cangas','Ronalyn','P.','1996-01-12','Muntinlupa City','ICA1092830121','BSIT LAD 4','ronalyncangas@gmail.com','123-2345','9664458437','815840850122a7acc8a8b5ed4b9d69c8b1b239fe',30,1,'active','2020-02-11 17:16:40','2020-02-11 17:06:44',2),(34,'Calumpiano','Ul','Milano','2000-07-22','Muntinlupa City',NULL,NULL,'calumpianoul@gmail.com',NULL,'0909834613','adb88623d3615129dbc982fe441cd3318168bb45',NULL,3,'deactivated','2020-02-23 07:59:02','2020-02-12 11:24:30',2),(36,'Villegas','Fauzi','Seguma','1997-10-16','Muntinlupa City',NULL,NULL,'fauziv08@gmail.com',NULL,'9630070321','d9eaa7a873787587d23989c78d936969db788086',32,2,'active',NULL,'2020-02-12 11:29:20',2),(39,'Prolo','Jimcey','Mabait','2002-09-12','Muntinlupa City',NULL,NULL,'jimcey@gmail.com',NULL,'9168321001','69600a3a53dc19725c16e526c209149991d6473b',NULL,3,'deactivated','2020-02-23 07:59:02','2020-02-12 11:36:37',2),(40,'Maurico jr','Gilbert','Candelario','1997-12-04','Buli,muntilupa City','ica6160101','bsit','lebronjameesmau23@gmail.com','779-8716','9973667616','52a925cb437b627232b641c22ce94c2ec3616b49',33,1,'active',NULL,'2020-02-12 13:58:51',2),(41,'Salibio','Rodnie','Dionisio','1967-08-25','Pasay City',NULL,NULL,'rodnie@gmail.com',NULL,'9480895370','6965ddcab0fa8970811d37a1b7345e3b1bc4e25e',NULL,3,'deactivated','2020-02-23 07:59:02','2020-02-12 14:00:30',2),(42,'Alcalde','Laurrie anne','Senobio','1995-12-08','331 Almazor St. Maricaban Pasay City','ica6190091','it','laurrie_alcalde@gmail.com',NULL,'9777692369','2ca63bf1f455609fb6e62f546bd0f742d905f24b',34,1,'active',NULL,'2020-02-12 14:02:22',2),(43,'Begino','Mary Coulin','Lacaba','1996-10-31','Blk 7 610 Bagong Silang Sucat Muntinlupa City','ICA6190197','BSIT','marycoulin@gmail.com',NULL,'9125068183','49253a5bf2b66ea48f1dc9379fdf115c275628e3',35,1,'active',NULL,'2020-02-12 14:05:14',2),(44,'Obo','Jerrymae','Patron','1998-07-14','Pasay City','ica6190017','bsit 3 ladd','jmobo14@gmail.com',NULL,'9999739332','dbd8fa1a9fc9b2310565c345f1569955a24f852a',36,1,'active',NULL,'2020-02-12 14:06:49',2),(45,'Naldo','Hector','Palman','1993-09-03','Makati City','ica6190209','bsit','hectronaldo@yahoo.com',NULL,'9666846808','71a0ac99076951ce014fd584b15c573eb1358f9d',37,1,'active',NULL,'2020-02-12 14:10:20',2),(46,'Red','Dave Andrew','Fidelino','1998-02-11','Binan Laguna','ICA6190065','BSIT','andrewred1998@gmail.com',NULL,'9267107348','9327a1ebd0f48863a1da60b06662e97bb50c068e',38,1,'active',NULL,'2020-02-12 14:10:41',2),(47,'Realda','Nouland','Marayag','1995-11-17','Blk 287 Lot 15 Paboreal St. Brgy. Rizal, Makati City','ICA6190058','BSIT','landrealda17@gmail.com',NULL,'9462809732','a6c7414ec62d515ff780af11e366fbb8d04198f8',39,1,'active',NULL,'2020-02-12 14:14:50',2),(48,'Hernandez','Ace xavier','Histcrillo','1995-09-14','Blk 2. Lot 15, Salinas, Rosario, Cavite',NULL,NULL,'acexavier2706@gmail.com',NULL,'9208462287','e89026eecff6a6dc6d5b5ab9d3c661edb3b740b4',NULL,3,'deactivated','2020-02-23 07:59:02','2020-02-12 14:15:11',2),(49,'Banzuela','Isaiah John','Escoto','1997-02-21','Samson St., Sucat, Muntinlupa City','ICA5130212','BSIT','banzuelaisaiah@gmail.com',NULL,'9194834191','5a0f0710ca98e2b2c6d82c6326eb39c81f46be0c',40,1,'active',NULL,'2020-02-12 14:18:29',2),(50,'Saunar','Gerald','Valderama','1995-07-04','Kelly Navaro Compd, Alabang , Muntinlupa City','ica5130111','bsit','saunargerald@gmail.com',NULL,'0939290788','334b1abe3729e0bcf6729311cf57c37298db23d3',41,1,'active',NULL,'2020-02-12 14:18:45',2),(51,'Esuga','Alex','Hay','1991-08-28','Blk 2 Lot 5 & 7 Kanebo F De Castro Gma Cavite',NULL,NULL,'abokacy@gmail.com',NULL,'9296166460','b8cd9a699db8bbc053c5b9fae0c0d5fc2491ebbe',NULL,3,'deactivated','2020-02-23 07:59:02','2020-02-12 14:21:03',2),(52,'Suganob','Edward','Eustaquio','1991-11-28','Blk 14 Lot 7 10th St., Golden Gate, Las Pinas City','ICA6190040','BSIT','tenderbetlog@gmail.com',NULL,'9164235940','4d322baeb7f3835c41c27c5d1b0214d214f8d6d6',42,1,'active',NULL,'2020-02-12 14:21:19',2),(53,'Cortes','Clarisse marie','Jamero','1989-03-13','Binan, Laguna',NULL,NULL,'cmjc89@gmail.com',NULL,'9551482539','56abd13895c0a1495c5518fb4494c7555ebcce66',NULL,3,'deactivated','2020-02-23 07:59:02','2020-02-12 14:23:19',2),(54,'Condes','Ericson','Bautista','1982-04-06','81-D 1st Ave, East Remo Makati City','ica6180333','bsit','rainmaker2891@gmail.com',NULL,'955753409','4a056cf0039b533a777c330bc22ab453cc1940cf',43,1,'active',NULL,'2020-02-12 17:15:57',2),(55,'Sapa','Jose lemuel','Cerbito','1989-05-01','Valley, San Isidro, Paranaque City','ica6180353','bsti','lemuel_08@yahoo.com',NULL,'9096984866','7d67d10251ddc2c3e1574506d7ad5f8431c5a3fc',44,1,'active',NULL,'2020-02-12 17:33:04',2),(56,'Barrios','John Floyd','Ibarra','1998-06-01','Las Pinas City',NULL,NULL,'johnfloydbarrios@gmail.com',NULL,'9366369811','bde2ed9ca8411cd4f175f3f2451e1e2676366aa2',NULL,3,'deactivated','2020-02-23 07:59:02','2020-02-13 21:25:39',2),(57,'Dejumo','Roberto','Alipin','1964-08-17','Bagong Bayan Taguig City',NULL,NULL,'robdej23@gmail.com',NULL,'9391869078','7fad6bf4a9b70fd1bda9d523dd29cc40ec93b921',NULL,3,'deactivated','2020-02-23 07:59:02','2020-02-13 21:33:02',2),(58,'Nava','Reynold','Escubin','1971-11-19','Bacoor City',NULL,NULL,'reynold@gmail.com',NULL,'9206254211','bcec6df3340b9a29ca93879a78b34712d2cab9aa',NULL,3,'deactivated','2020-02-23 07:59:02','2020-02-13 21:45:34',2),(59,'Hayao','Jhanelyn','Dizon','1995-09-28','965 Mc Villanueva 3rd St Almanza Uno Las Pinas City','ica60038','bsit','jhanelynhayao@gmail.com','7506985','0929616646','12406ad1deeb078bf23d43795894bede1b0d4721',45,1,'active',NULL,'2020-02-13 21:50:14',2),(60,'Antaje','John','Paul','1994-08-28','33 Png Blk 1 Lot 20 Pacita I San Pedro Laguna','ica6180113','bsit','ampolanteja@gmail.com',NULL,'9321073174','6cf8e48dac32d9c888604ced48e174292dd47457',46,1,'active','2020-02-13 22:14:01','2020-02-13 21:55:57',2),(61,'Dahan','Jan webster','Ellevera','1986-01-25','Blk 69 Lot 12 Zone 5 Fp Housing Bulihan Silang','ica6180106','BSIT LAD 4','djanweb2370@gmail.com',NULL,'9475718403','c55d09e7f8a3b171c8a5821fc37ae9cf5b541297',47,1,'active','2020-02-13 22:15:31','2020-02-13 22:00:12',2),(62,'Martinez','Vince aaron','Sta. ana','1998-03-13','475 Purok 3 Int Cupang Muntinlupa',NULL,NULL,'vinceaaron.martinez@gmail.com',NULL,'9300321424','0246ccd69b657bd51799563db7dbdde4d678c6bb',NULL,3,'deactivated','2020-02-23 07:59:02','2020-02-13 22:03:35',2),(63,'Repol','Ma. christina','Tugarin','1996-12-05','Paranaque City',NULL,NULL,'ma.christinarepol@gmail.com',NULL,'9291585295','6791466673dcab37fc2c1efc6e76ee6a5702e1d6',NULL,3,'deactivated','2020-02-23 07:59:02','2020-02-13 22:06:15',2),(64,'Mangcupang','Brian','T','2002-08-10','Alabang Muntinlupa City','ica600519','HE B','brian@gmail.com',NULL,'9075212048','ea36ad32a95eda06a7dd4048f7c13c2648027b7a',48,1,'active',NULL,'2020-02-14 01:16:27',2),(65,'Tacardan','Jhon ryan','P','2003-04-04','Muntinlupa City','ica00013','hea','jryan@gmail.com',NULL,'9457531049','71c34b9a8fe7bfaa4399115209ff0b54b72e91b4',49,1,'active',NULL,'2020-02-14 01:18:00',2),(66,'Mangcupang','Brix','','2001-06-10','Las Piñas City','ICA000514','HE B','brixmangcupang@gmail.com',NULL,'9095673421','f7b975c56e09ed96e20e5458a886027874b7cf3a',50,1,'active',NULL,'2020-02-14 01:18:35',2),(67,'Garay','Joshua','M','1998-08-09','Calamba Laguna',NULL,NULL,'joshuagaray_09@yahoo.com',NULL,'9258629772','cc7dc28a7a3c5e74ea87b4e80d27aa369d24f311',NULL,3,'deactivated','2020-02-23 07:59:02','2020-02-14 01:20:01',2),(68,'Villamor','Gilbert','S','1998-09-09','Muntinlupa City',NULL,NULL,'villamor09@gmail.com',NULL,'9296166460','1c1cc3c15535e7331d5d446a1d83cd0901b4c535',NULL,3,'deactivated','2020-02-23 07:59:02','2020-02-14 01:22:52',2),(69,'Abiog','Rodiri','C','1997-01-07','Muntinlupa City','ICA00136743','BSIT 1B','abiog@gmail.com',NULL,'9306732109','1c1cc3c15535e7331d5d446a1d83cd0901b4c535',51,1,'active',NULL,'2020-02-14 01:22:52',2),(70,'Gomez','Michael Allan','Evangelista','2001-12-23','Carmona Cavite',NULL,NULL,'michaelgomez@gmail.com',NULL,'9173224732','220bba2dc59d3f8ca628891c1622c8b5968e4c71',NULL,3,'deactivated','2020-02-23 07:59:02','2020-02-14 01:24:28',2),(71,'Escalamado','Rachel ann','B','2000-06-03','Muntinlupa City','ICA0367401','bscpe','rachel@gmail.com',NULL,'9306730013','87bf21ffcd36d824887d1ef578dce374c6948d73',52,1,'active',NULL,'2020-02-14 01:27:50',2),(72,'Dungca','Paul William','Baldo','1993-11-21','Muntinlupa City',NULL,NULL,'paul.dungca@gmail.com',NULL,'9427835551','08d5f8dcc96211110bebd539656e95f950ed3cd4',NULL,3,'deactivated','2020-02-23 07:59:02','2020-02-14 01:28:11',2),(73,'Villamor','Robertc claude','','1999-07-17','Las Pinas',NULL,NULL,'_robertvillamor_17@gmail.com',NULL,'9066366691','c9149dc84531ac0102c8958a2867ad3a0e85af7f',NULL,3,'deactivated','2020-02-23 07:59:02','2020-02-14 01:28:31',2),(74,'Boniel','Bench','','1979-06-08','Muntinlupa City',NULL,NULL,'boniel@gmail.com',NULL,'9306703211','7e4e07969229ae69c3d9b8528ad880aa2fcb16df',53,2,'active',NULL,'2020-02-14 01:29:27',2),(75,'Idio jr.','Rodolfo','C','1992-10-06','Muntinlupa City',NULL,NULL,'ridio@gmail.com',NULL,'9317581019','88468535f45370f458d9edbd32d3921af60a7cbe',NULL,3,'deactivated','2020-02-23 07:59:02','2020-02-14 01:30:33',2),(76,'Fadriquilla','Arnold','','1975-12-08','Laguna','ICA5001367','BSIT-Lad4','arnoldfadriquilla@gmail.com',NULL,'921289701','5349ba8ff72ec190d133a9e4c9f230a0173ddcb2',54,1,'active',NULL,'2020-02-14 01:31:33',2),(77,'Sto domingo','Eddieson','P','1977-01-19','Las Pinas City',NULL,NULL,'eddesonstodomingo@gmail.com',NULL,'9193377510','25420ce4a4b14d0b2fbddc6c24ae3fdc39324cc9',NULL,3,'deactivated','2020-02-23 07:59:02','2020-02-14 01:32:51',2),(78,'Villegas','Jahreil','','1999-12-12','Laguna','ICA6195326','bsit','villegasjahreil12@yahoo.com',NULL,'9108978910','fab37c5798c8dc7ac066b8cc1b9e580a31aac582',55,1,'active',NULL,'2020-02-14 01:32:57',2),(79,'Valdez','Allan','Raniel','1973-03-06','Las Piñas City',NULL,NULL,'allan@gmail.com',NULL,'9630732100','41d76f01ba92fe585448a90bcbc260f718f03ed2',56,2,'active',NULL,'2020-02-14 01:34:53',2),(80,'Balahadia','Kenneth','','1986-08-17','Pacita, Laguna','ICA1034567','BSIT','kennethbalahadia@gmail.com',NULL,'0959317810','5d4e6f4938e40ca1e203b09972b926ba4add90af',57,1,'active',NULL,'2020-02-14 01:35:01',2),(81,'Acosta','Joshua','Sison','1999-06-21','Las Pinas City',NULL,NULL,'acostajoshua@gmail.com','8613311','9178612516','a3672bb772415e1979314bd6122190a006eb6993',NULL,3,'deactivated','2020-02-23 07:59:02','2020-02-14 01:35:20',2),(82,'Bartolabao','John eirol','M','2000-09-09','Makati City','ica6185548','bsit','johneirol@gmail.com',NULL,'9358629772','4eb3c40577f46773994ea1a41c88f9bbb222d5d4',58,1,'active',NULL,'2020-02-14 01:37:16',2),(83,'Palisoc','Sherwin','Macaranas','1995-01-06','Taguig City',NULL,NULL,'sherwin06@gmail.com',NULL,'9488029457','0bd0af8292926ba0eac7406b6c616989faaaba03',NULL,3,'deactivated','2020-02-23 07:59:02','2020-02-14 01:37:45',2),(84,'Jagonoy','Jeric','','1996-05-17','Muntinlupa City','ICA6007367','BSIT - LAD3','jjagonoy@gmail.com',NULL,'9218891910','14b42c18f2939b7f747784b880ba957ef8235403',59,1,'active',NULL,'2020-02-14 01:38:01',2),(85,'Balderama','Francis','Solis','1996-03-05','Muntinlupa City',NULL,NULL,'balderama.francis@yahoo.com',NULL,'9309463032','8c83e2c15c12f0c771f06d1afb518189c2854900',NULL,3,'deactivated','2020-02-23 07:59:02','2020-02-14 01:39:58',2),(86,'Angeles','Sherwin','','2002-03-27','Putatan,Muntinlupa City','ICA3200132','IA 11','sangeles@gmail.com',NULL,'9327231123','80b04f4e7c164e729b8142beeff0d930a4ec517a',60,1,'active',NULL,'2020-02-14 01:40:05',2),(87,'Quiruz','Marky','Barameda','1996-08-06','Muntinlupa City',NULL,NULL,'m.quiruz@gmail.com',NULL,'9099927723','d17bf7c3ca315ca5f9aedfc9e720428fb1855224',NULL,3,'deactivated','2020-02-23 07:59:02','2020-02-14 01:41:27',2),(88,'Tiambeng','Renz michael','Cortez','1999-05-16','Cavite',NULL,NULL,'renzmichealtiambeng@gmail.com',NULL,'9328816312','ad79bbd830519f4af03ab833a12ccfe6c0da3e52',NULL,3,'deactivated','2020-02-23 07:59:02','2020-02-14 01:42:34',2),(89,'Gavino','Caro','M','1999-12-07','Cavite City','ica6180548','bsit','caro_gavino@yahoo.com',NULL,'910986922','66d4c9c1353a51c2e210da5d629dd6f10f13155c',61,1,'active',NULL,'2020-02-14 01:42:57',2),(90,'Mendoza','Mark','Anthony','1997-11-14','Las Pinas City',NULL,NULL,'anthonymendoza@gmail.com',NULL,'9327218504','1d81202077bbd9caa584182b2c1f9e5cd94683a2',NULL,3,'deactivated','2020-02-23 07:59:02','2020-02-14 01:44:03',2),(91,'Zuhan','Kyle Chyno','M','0004-04-14','Talon Singko, Las Piñas City','ICA2330215','IA 11','kczuhan1404@gmail.com',NULL,'9174527021','1112af7d41952f305d2b701eb61dab7fcf6a67bb',62,1,'active',NULL,'2020-02-14 01:45:05',2),(92,'Magay','Jammick ramiel','','2000-09-08','Pasay City','ica6180937','bsit','magay.ramiel@gmail.com',NULL,'9296166460','ff3c1b786f5226bba7a33ad75bf9c3a3399f84cd',63,1,'active',NULL,'2020-02-14 01:48:58',2),(93,'Gamboa','Jerico','Lebya','1995-10-11','Muntilupa City',NULL,NULL,'jeric@gmail.com',NULL,'9317585121','572a2f6943a1323e387414d90c5bfc89bd24da27',NULL,3,'deactivated','2020-02-23 07:59:02','2020-02-14 01:49:22',2),(94,'Torres','Kenneth','','2003-09-18','Almanza Uno, Las Piñas City','ICA17320113','IA 11','kennethtorres@gmail.com',NULL,'9183217231','b2d8a77fcc6f9cf2976dad55d422a5620b48610f',64,1,'active',NULL,'2020-02-14 01:50:11',2),(95,'Jews','Mico','Villanueva','2000-04-06','Muntinlupa City','ICA1703147','HE12','micodews@gmail.com',NULL,'9752188625','d3b5e92ba3df9616d1b7e89e53b7d55d7c4ea375',65,1,'active',NULL,'2020-02-14 01:51:44',2),(96,'Bemejo','Ronie','B','2001-04-18','Alabang Muntinlupa','ICA310211','IA-II','roniebermejo@gmail.com',NULL,'0945325111','a0029657bcc976582066cdac5194e23d5a3e0d0e',66,1,'active',NULL,'2020-02-14 01:53:56',2),(97,'Pelobello','JP','','2000-04-16','Muntinlupa City','ICA0013681','BSIT-1B','jp@gmail.com',NULL,'9630130531','6c60eb79e9c07b0048b985533826f5314017c82a',67,1,'active',NULL,'2020-02-14 01:54:24',2),(98,'Lazaro','Mark jay','O','1997-01-20','Muntinlupa City','ICA16912811','BSIT 1','markjay@gmail.com',NULL,'9128816138','f9a850b40966a927a59df6ee94f247e3de42583b',68,1,'active',NULL,'2020-02-14 01:54:31',2),(99,'Miarino','Roldan','Roy','1995-06-18','Paranaque City',NULL,NULL,'roldanroy@gmail.com',NULL,'9306734321','23ebad61870bd0248a30671203b803febffa9a0c',NULL,3,'deactivated','2020-02-23 07:59:02','2020-02-14 01:55:58',2),(100,'Villegas','Jan Riel','E','2000-06-11','Carmona, Cavite','ICA6307015','ICT','janrielvillegas@gmail.com',NULL,'0917337218','639a77ee356fb9b81f4e2972ec2697154d3ddc5b',69,1,'active',NULL,'2020-02-14 01:56:41',2),(101,'Ordonia','Vincent','C','1999-01-16','Alabang, Muntinlupa City','ICA1701631','BSBA 3','ovincent@gmail.com',NULL,'9321288618','4ee6fbb982afed10f9b8e87e1d4cf5625b32a227',70,1,'active',NULL,'2020-02-14 01:57:20',2),(102,'Del bano','Aldrin','','2001-06-20','Muntinlupa City','ICA1003013','BSIT-1B','delbano@gmail.com',NULL,'9630013451','89af24a024c4dc1707a322ceb92509c303060f41',71,1,'active',NULL,'2020-02-14 01:57:38',2),(103,'Guevarra','Robert','Aguilar','1990-08-19','San Pedro Laguna',NULL,NULL,'raguerana@gmail.com',NULL,'9321173298','d45b033522ce6594412cb79b619dfbbb514b5254',NULL,3,'deactivated','2020-02-23 07:59:02','2020-02-14 01:58:12',2),(104,'Osena','Jericho','','2000-01-19','Muntinlupa City','ICA16810981','HE12','josena@gmail.com',NULL,'9174188614','7f03f4e690e9c1985dc653c6c8d1bcb323822607',72,1,'active',NULL,'2020-02-14 01:59:28',2),(105,'Tuando','Jade','','1999-04-04','Muntinlupa City','ICA6005017','BSIT','jadetuando@gmail.com',NULL,'9987791017','78638f5f27596efd202db6042fa51591f1ee56be',73,1,'active',NULL,'2020-02-14 02:00:28',2),(106,'Tuliao','Jed aldrin','Tejano','1998-01-11','Paranaque City',NULL,NULL,'tulianojedaldrin198@gmail.com',NULL,'995324037','baa2fb7a43c252690bc3f48b8fb4a979af91905f',NULL,3,'deactivated','2020-02-23 07:59:02','2020-02-14 02:00:53',2),(107,'Calonia','Billy joe','','1998-12-08','Las Pinas City','ICA0010765','BSIT','bjcalonia@gmail.com',NULL,'9207711801','fda2256771f58af216ecc2d83b5795678da70518',74,1,'active',NULL,'2020-02-14 02:02:47',2),(108,'Ancajas','John','Andrei','2004-03-12','Muntinlupa City','ICA00012','ICT A','jdriancajas@gmail.com',NULL,'9094751923','4153c3dc34d3086c645037b7cb5780d433b07ba8',75,1,'active',NULL,'2020-02-14 02:02:53',2),(109,'Solomon','Rjay','','1994-01-21','Muntinlupa City','ICA0016813','ABM','solomon@gmail.com',NULL,'9306742131','1b8fadaf4a13d14f8e355a78fe1f182b9ed56773',76,1,'active',NULL,'2020-02-14 02:05:25',2),(110,'Morillo','Danie','Gonzales','1997-10-26','Binan City',NULL,NULL,'morillodanie2826@gmail.com',NULL,'9272896591','ae933a7c8e64748a124f56bc24c60a1a6745dc81',NULL,3,'deactivated','2020-02-23 07:59:02','2020-02-14 02:06:15',2),(111,'Fuentes','Markven','Hadjaram','1995-08-30','San Pedro Laguna',NULL,NULL,'markven_fuentes@gmail.com',NULL,'9235679018','ebc0a0e587e6bbf818cae218024ebc34f25fac93',NULL,3,'deactivated','2020-02-23 07:59:02','2020-02-14 02:11:20',2);
/*!40000 ALTER TABLE `occupants` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `reservations`
--

DROP TABLE IF EXISTS `reservations`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `reservations` (
  `rsv_id` int(11) NOT NULL AUTO_INCREMENT,
  `rsv_occupant_id` int(11) DEFAULT NULL,
  `rsv_datetime` datetime DEFAULT NULL,
  `rsv_notify_ctr` int(11) DEFAULT '0',
  `rsv_expected_timein` datetime DEFAULT NULL,
  `rsv_timein_datetime` datetime DEFAULT NULL,
  `rsv_status` varchar(50) DEFAULT 'pending' COMMENT 'pending, done, cancelled',
  `modified_at` datetime DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `created_by` int(11) DEFAULT NULL,
  PRIMARY KEY (`rsv_id`),
  KEY `FK_reservation_users` (`created_by`),
  KEY `FK_reservation_occupants` (`rsv_occupant_id`),
  CONSTRAINT `FK_reservation_occupants` FOREIGN KEY (`rsv_occupant_id`) REFERENCES `occupants` (`occ_id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `FK_reservation_users` FOREIGN KEY (`created_by`) REFERENCES `users` (`use_id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=78 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `reservations`
--

LOCK TABLES `reservations` WRITE;
/*!40000 ALTER TABLE `reservations` DISABLE KEYS */;
INSERT INTO `reservations` VALUES (1,3,'2020-02-10 16:43:29',0,NULL,NULL,'cancelled','2020-02-10 17:00:29','2020-02-10 16:43:29',6),(2,2,'2020-02-10 17:00:16',0,NULL,NULL,'cancelled','2020-02-10 17:00:57','2020-02-10 17:00:16',5),(3,5,'2020-02-10 17:00:38',0,NULL,NULL,'cancelled','2020-02-10 17:09:50','2020-02-10 17:00:38',1),(4,2,'2020-02-10 17:01:23',0,NULL,NULL,'cancelled','2020-02-10 17:06:40','2020-02-10 17:01:23',5),(5,3,'2020-02-10 17:02:54',0,NULL,NULL,'cancelled','2020-02-10 17:09:56','2020-02-10 17:02:54',6),(6,2,'2020-02-10 17:08:02',0,NULL,NULL,'cancelled','2020-02-10 17:11:31','2020-02-10 17:08:02',5),(7,5,'2020-02-10 17:10:21',0,NULL,NULL,'cancelled','2020-02-10 17:11:10','2020-02-10 17:10:21',8),(8,3,'2020-02-10 17:10:30',0,NULL,NULL,'cancelled','2020-02-10 17:11:48','2020-02-10 17:10:30',6),(9,5,'2020-02-10 17:11:14',0,NULL,NULL,'cancelled','2020-02-10 17:11:37','2020-02-10 17:11:14',8),(10,2,'2020-02-10 17:11:34',1,'2020-02-10 17:24:53',NULL,'cancelled','2020-02-10 17:15:47','2020-02-10 17:11:34',1),(11,5,'2020-02-10 17:11:42',0,NULL,NULL,'cancelled','2020-02-10 17:17:07','2020-02-10 17:11:42',1),(12,3,'2020-02-10 17:11:50',0,NULL,NULL,'cancelled','2020-02-10 17:13:03','2020-02-10 17:11:50',1),(13,3,'2020-02-10 17:14:18',0,NULL,'2020-02-10 17:18:11','done','2020-02-10 17:18:11','2020-02-10 17:14:18',1),(14,3,'2020-02-10 17:19:27',1,'2020-02-10 17:43:03',NULL,'cancelled','2020-02-10 17:35:00','2020-02-10 17:19:27',6),(15,6,'2020-02-10 17:31:08',0,NULL,NULL,'cancelled','2020-02-10 17:53:44','2020-02-10 17:31:08',9),(16,8,'2020-02-10 17:51:48',0,NULL,NULL,'cancelled','2020-02-10 17:56:17','2020-02-10 17:51:48',10),(17,4,'2020-02-10 17:52:55',0,NULL,NULL,'cancelled','2020-02-10 17:54:57','2020-02-10 17:52:55',7),(18,6,'2020-02-10 18:28:09',1,'2020-02-10 19:11:28',NULL,'cancelled','2020-02-10 19:02:21','2020-02-10 18:28:09',1),(19,8,'2020-02-10 18:28:16',0,NULL,NULL,'cancelled','2020-02-10 18:58:58','2020-02-10 18:28:16',1),(20,5,'2020-02-10 18:28:45',1,'2020-02-10 19:12:21',NULL,'cancelled','2020-02-10 19:02:58','2020-02-10 18:28:45',1),(21,3,'2020-02-10 18:29:09',2,'2020-02-10 19:13:24','2020-02-10 19:03:38','done','2020-02-10 19:03:38','2020-02-10 18:29:09',1),(22,6,'2020-02-10 19:04:30',0,NULL,NULL,'cancelled','2020-02-10 19:04:47','2020-02-10 19:04:30',9),(23,6,'2020-02-10 19:05:00',0,NULL,NULL,'cancelled','2020-02-10 19:05:05','2020-02-10 19:05:00',9),(24,10,'2020-02-10 20:16:47',0,NULL,'2020-02-10 20:26:38','done','2020-02-10 20:26:38','2020-02-10 20:16:47',3),(25,6,'2020-02-10 21:10:39',0,NULL,NULL,'cancelled','2020-02-10 21:32:12','2020-02-10 21:10:39',9),(26,1,'2020-02-10 21:10:50',1,'2020-02-10 21:44:42',NULL,'cancelled','2020-02-10 21:35:32','2020-02-10 21:10:50',4),(27,9,'2020-02-10 21:11:27',0,NULL,'2020-02-10 21:39:14','done','2020-02-10 21:39:14','2020-02-10 21:11:27',1),(28,5,'2020-02-10 21:11:54',0,NULL,NULL,'cancelled','2020-02-10 21:33:26','2020-02-10 21:11:54',8),(29,4,'2020-02-10 21:12:17',1,'2020-02-10 21:49:55',NULL,'cancelled','2020-02-10 21:39:55','2020-02-10 21:12:17',1),(30,2,'2020-02-10 21:12:33',0,NULL,NULL,'cancelled','2020-02-10 21:33:59','2020-02-10 21:12:33',5),(31,6,'2020-02-10 21:33:11',0,NULL,NULL,'cancelled','2020-02-10 21:33:15','2020-02-10 21:33:11',9),(32,6,'2020-02-10 21:33:19',0,NULL,NULL,'cancelled','2020-02-10 21:34:03','2020-02-10 21:33:19',9),(33,5,'2020-02-10 21:33:36',0,NULL,NULL,'cancelled','2020-02-10 21:34:10','2020-02-10 21:33:36',8),(34,5,'2020-02-10 21:40:03',1,'2020-02-10 21:51:03',NULL,'cancelled','2020-02-10 21:44:07','2020-02-10 21:40:03',8),(35,6,'2020-02-10 21:40:07',0,NULL,'2020-02-10 21:44:42','done','2020-02-10 21:44:42','2020-02-10 21:40:07',1),(36,1,'2020-02-10 21:40:21',1,'2020-02-10 21:54:50','2020-02-10 21:50:15','done','2020-02-10 21:50:15','2020-02-10 21:40:21',1),(37,2,'2020-02-10 21:40:31',1,'2020-02-10 22:00:36',NULL,'cancelled','2020-02-10 21:51:45','2020-02-10 21:40:31',5),(38,6,'2020-02-10 21:50:17',0,NULL,'2020-02-10 21:53:01','done','2020-02-10 21:53:01','2020-02-10 21:50:17',1),(39,9,'2020-02-10 21:50:20',1,'2020-02-10 22:03:03',NULL,'cancelled','2020-02-10 21:54:18','2020-02-10 21:50:20',11),(40,5,'2020-02-10 21:50:21',0,NULL,'2020-02-10 21:55:12','done','2020-02-10 21:55:12','2020-02-10 21:50:21',1),(41,3,'2020-02-10 21:55:18',1,'2020-02-10 22:05:43',NULL,'cancelled','2020-02-10 22:01:07','2020-02-10 21:55:18',6),(42,1,'2020-02-10 21:55:25',1,'2020-02-10 22:11:07','2020-02-10 22:02:06','done','2020-02-10 22:02:06','2020-02-10 21:55:25',1),(43,2,'2020-02-10 21:55:32',1,'2020-02-10 22:12:12',NULL,'cancelled','2020-02-10 22:02:30','2020-02-10 21:55:32',5),(44,9,'2020-02-10 22:02:09',1,'2020-02-10 22:12:30',NULL,'cancelled','2020-02-10 22:02:42','2020-02-10 22:02:09',11),(45,6,'2020-02-10 22:03:55',1,'2020-02-10 22:15:00',NULL,'cancelled','2020-02-10 22:05:17','2020-02-10 22:03:55',9),(46,9,'2020-02-10 22:04:08',1,'2020-02-10 22:15:17',NULL,'cancelled','2020-02-10 22:05:27','2020-02-10 22:04:08',11),(47,1,'2020-02-10 22:04:10',1,'2020-02-10 22:15:27',NULL,'cancelled','2020-02-10 22:05:50','2020-02-10 22:04:10',4),(48,2,'2020-02-10 22:04:13',0,NULL,NULL,'cancelled','2020-02-10 22:04:38','2020-02-10 22:04:13',5),(49,2,'2020-02-10 22:04:45',1,'2020-02-10 22:15:50',NULL,'cancelled','2020-02-10 22:06:03','2020-02-10 22:04:45',5),(50,11,'2020-02-11 10:10:36',1,'2020-02-11 10:21:19',NULL,'cancelled','2020-02-11 10:25:09','2020-02-11 10:10:36',13),(51,12,'2020-02-11 10:45:21',2,'2020-02-11 10:57:49',NULL,'cancelled','2020-02-11 10:48:03','2020-02-11 10:45:21',1),(52,6,'2020-02-11 10:46:13',1,'2020-02-11 10:58:03',NULL,'cancelled','2020-02-11 14:06:17','2020-02-11 10:46:13',1),(53,7,'2020-02-11 14:43:33',0,NULL,'2020-02-11 17:01:51','done','2020-02-11 17:01:51','2020-02-11 14:43:33',1),(54,5,'2020-02-12 11:34:21',0,NULL,NULL,'cancelled','2020-02-12 11:48:20','2020-02-12 11:34:21',8),(55,5,'2020-02-12 16:17:17',2,'2020-02-12 16:40:02',NULL,'cancelled','2020-02-12 16:30:26','2020-02-12 16:17:17',1),(56,6,'2020-02-12 16:21:36',1,'2020-02-12 16:40:26','2020-02-13 22:07:37','done','2020-02-13 22:07:37','2020-02-12 16:21:36',1),(57,5,'2020-02-18 23:39:01',0,NULL,NULL,'cancelled','2020-02-18 23:41:02','2020-02-18 23:39:01',8),(58,6,'2020-02-19 00:05:45',0,NULL,NULL,'cancelled','2020-02-19 00:05:51','2020-02-19 00:05:45',9),(59,6,'2020-02-19 00:05:57',0,NULL,NULL,'cancelled','2020-02-19 00:06:04','2020-02-19 00:05:57',9),(60,6,'2020-02-19 00:06:11',0,NULL,NULL,'cancelled','2020-02-19 00:06:39','2020-02-19 00:06:11',9),(61,6,'2020-02-19 00:06:41',0,NULL,NULL,'cancelled','2020-02-19 00:06:42','2020-02-19 00:06:41',9),(62,6,'2020-02-19 00:06:43',0,NULL,NULL,'cancelled','2020-02-19 00:06:47','2020-02-19 00:06:43',9),(63,6,'2020-02-19 00:06:48',0,NULL,NULL,'cancelled','2020-02-19 00:06:49','2020-02-19 00:06:48',9),(64,6,'2020-02-19 00:06:49',0,NULL,NULL,'cancelled','2020-02-19 00:06:55','2020-02-19 00:06:49',9),(65,6,'2020-02-19 00:06:57',0,NULL,NULL,'cancelled','2020-02-19 00:07:05','2020-02-19 00:06:57',9),(66,6,'2020-02-19 00:07:06',0,NULL,NULL,'cancelled','2020-02-19 00:07:06','2020-02-19 00:07:06',9),(67,6,'2020-02-19 00:07:12',0,NULL,NULL,'cancelled','2020-02-19 00:07:13','2020-02-19 00:07:12',9),(68,6,'2020-02-19 00:07:13',0,NULL,NULL,'cancelled','2020-02-19 00:07:28','2020-02-19 00:07:13',9),(69,6,'2020-02-19 00:07:33',0,NULL,NULL,'cancelled','2020-02-19 00:07:34','2020-02-19 00:07:33',9),(70,6,'2020-02-19 00:07:34',0,NULL,NULL,'cancelled','2020-02-19 00:07:34','2020-02-19 00:07:34',9),(71,6,'2020-02-19 00:07:37',0,NULL,NULL,'cancelled','2020-02-19 00:07:38','2020-02-19 00:07:37',9),(72,6,'2020-02-19 00:07:44',0,NULL,NULL,'cancelled','2020-02-19 00:07:45','2020-02-19 00:07:44',9),(73,6,'2020-02-19 00:07:47',0,NULL,NULL,'cancelled','2020-02-19 00:07:47','2020-02-19 00:07:47',9),(74,6,'2020-02-19 00:10:07',1,'2020-02-19 00:23:18',NULL,'cancelled','2020-02-19 00:24:02','2020-02-19 00:10:07',1),(75,5,'2020-02-19 00:13:47',1,'2020-02-19 00:24:02',NULL,'cancelled','2020-02-19 00:24:24','2020-02-19 00:13:47',8),(76,3,'2020-02-22 10:31:52',1,'2020-02-22 10:47:21',NULL,'cancelled','2020-02-22 10:34:55','2020-02-22 10:31:52',1),(77,6,'2020-02-22 10:32:05',1,'2020-02-22 10:48:02',NULL,'cancelled','2020-02-22 10:49:02','2020-02-22 10:32:05',9);
/*!40000 ALTER TABLE `reservations` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `user_details`
--

DROP TABLE IF EXISTS `user_details`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `user_details` (
  `usd_id` int(11) NOT NULL AUTO_INCREMENT,
  `usd_user_id` int(11) DEFAULT NULL,
  `usd_firstname` varchar(50) DEFAULT NULL,
  `usd_lastname` varchar(50) DEFAULT NULL,
  `usd_middlename` varchar(50) DEFAULT NULL,
  `usd_email` varchar(50) DEFAULT NULL,
  `usd_contact_number` varchar(50) DEFAULT NULL,
  `modified_at` datetime DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `created_by` int(11) DEFAULT NULL,
  PRIMARY KEY (`usd_id`),
  KEY `FK__users` (`usd_user_id`),
  KEY `FK_user_details_users` (`created_by`),
  CONSTRAINT `FK__users` FOREIGN KEY (`usd_user_id`) REFERENCES `users` (`use_id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `FK_user_details_users` FOREIGN KEY (`created_by`) REFERENCES `users` (`use_id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `user_details`
--

LOCK TABLES `user_details` WRITE;
/*!40000 ALTER TABLE `user_details` DISABLE KEYS */;
INSERT INTO `user_details` VALUES (1,1,'Super','Datuin','Admin','ietialabangmpls@gmail.com','09123456789','2020-01-30 14:09:51','2020-01-30 20:44:34',1),(2,2,'Admin','ALastname','Admin','gerarddatuinn28@gmail.com','9751900745','2020-02-07 12:45:14','2020-02-06 21:23:36',1),(3,3,'Guard','LAttendant','Attendant','attendant_parkinglogssystem@gmail.com','09123123123',NULL,'2020-02-06 21:24:33',1);
/*!40000 ALTER TABLE `user_details` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `user_type`
--

DROP TABLE IF EXISTS `user_type`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `user_type` (
  `ust_id` int(11) NOT NULL AUTO_INCREMENT,
  `ust_type` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`ust_id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `user_type`
--

LOCK TABLES `user_type` WRITE;
/*!40000 ALTER TABLE `user_type` DISABLE KEYS */;
INSERT INTO `user_type` VALUES (1,'Admin'),(2,'Occupant'),(3,'Super Admin'),(4,'Attendant');
/*!40000 ALTER TABLE `user_type` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `users` (
  `use_id` int(11) NOT NULL AUTO_INCREMENT,
  `use_username` varchar(50) DEFAULT NULL,
  `use_password` varchar(150) DEFAULT NULL,
  `use_status` varchar(150) DEFAULT 'active' COMMENT 'active/deactivated',
  `use_user_type` int(11) DEFAULT NULL,
  PRIMARY KEY (`use_id`),
  KEY `FK_users_user_type` (`use_user_type`),
  CONSTRAINT `FK_users_user_type` FOREIGN KEY (`use_user_type`) REFERENCES `user_type` (`ust_id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=77 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `users`
--

LOCK TABLES `users` WRITE;
/*!40000 ALTER TABLE `users` DISABLE KEYS */;
INSERT INTO `users` VALUES (1,'superadmin','$2y$10$he0Spx/JgXgMMDJnGiGzLuYM0inv3QHaPLykai0ebfxoTYnlJa3EG','active',3),(2,'admin','$2y$10$QYvuDB02oXe9inDNInhZduAEoUc/LVlJDYi0S/NbapT6MPKdsiJRm','active',1),(3,'attendant','$2y$10$hdrLmwZEMraY68Q3gPhz6OioEXvvZ1sli4neCJty6CeTLi3efxSnm','active',4),(4,'rgalaneda@gmail.com','09097679256','active',2),(5,'stodomingoshy@gmail.com','shyshy','active',2),(6,'jagtcdc@gmail.com','password','active',2),(7,'rbucaloy20733@gmail.com','12345678','active',2),(8,'gerarddatuinn28@gmail.com','12345678','active',2),(9,'robertvillamor_17@yahoo.com','asdfghjkl','active',2),(10,'allansaldivar@gmail.com','U9e9WZdi','active',2),(11,'jaguillermo94@gmail.com','password','active',2),(12,'reygalaneda@gmail.com','09097679256','active',2),(13,'alanvranario@gmail.com','TFjBAka1','active',2),(14,'emariquina@yahoo.com','W22KMG2x','active',2),(18,'reniel@gmail.com','h8T4Ojnv','active',2),(19,'neilstephen014@gmail.com','CHCDkCMN','active',2),(20,'justine@gmail.com','kmESgvF4','active',2),(21,'catapangjaphet8@gmail.com','2thoUoDF','active',2),(22,'RENARDARCUENO@yahoo.com','Wr8s8QVs','active',2),(23,'jelianalalcostero94@gmail.com','FXpKr0zB','active',2),(24,'jap69jacinto@gmail.com','GO84A9cS','active',2),(25,'emman.edang@yahoo.com','Ym3iUgfx','active',2),(26,'jeffrey.enrico@gmail.com','AHkPC5Nu','active',2),(27,'Reymartdeguia@gmail.com','pea9od6b','active',2),(28,'landrito@gmail.com','m9R71Exd','active',2),(29,'gino@gmail.com','T8qL3PSo','active',2),(30,'ronalyncangas@gmail.com','GuTMGxZo','active',2),(32,'fauziv08@gmail.com','Gh8HyDuG','active',2),(33,'lebronjameesmau23@gmail.com','H4B9UuUJ','active',2),(34,'laurrie_alcalde@gmail.com','XQb5AWE6','active',2),(35,'marycoulin@gmail.com','eJrZfqs4','active',2),(36,'jmobo14@gmail.com','qrkewG1y','active',2),(37,'hectronaldo@yahoo.com','k230fbXh','active',2),(38,'andrewred1998@gmail.com','MvriX92E','active',2),(39,'landrealda17@gmail.com','KLdlgwFx','active',2),(40,'banzuelaisaiah@gmail.com','En4nKGkr','active',2),(41,'saunargerald@gmail.com','vl1ecGhj','active',2),(42,'tenderbetlog@gmail.com','tjEHJ5W3','active',2),(43,'rainmaker2891@gmail.com','LdTRYwOK','active',2),(44,'lemuel_08@yahoo.com','mRexra3C','active',2),(45,'jhanelynhayao@gmail.com','jYkjGUOR','active',2),(46,'ampolanteja@gmail.com','fUCfO9AU','active',2),(47,'djanweb2370@gmail.com','bdawLzjk','active',2),(48,'brian@gmail.com','qUxU689S','active',2),(49,'jryan@gmail.com','FPa4Jmpm','active',2),(50,'brixmangcupang@gmail.com','nAkSS2V0','active',2),(51,'abiog@gmail.com','T6OZBHfP','active',2),(52,'rachel@gmail.com','f7TfeIXz','active',2),(53,'boniel@gmail.com','MUYKnTUr','active',2),(54,'arnoldfadriquilla@gmail.com','lvUdyRS0','active',2),(55,'villegasjahreil12@yahoo.com','rrWX4Ejw','active',2),(56,'allan@gmail.com','LbYV2c41','active',2),(57,'kennethbalahadia@gmail.com','FI68l4ic','active',2),(58,'johneirol@gmail.com','Q1NO2u2Q','active',2),(59,'jjagonoy@gmail.com','m0jjNsEB','active',2),(60,'sangeles@gmail.com','UIuWBZlB','active',2),(61,'caro_gavino@yahoo.com','6FRYSCIh','active',2),(62,'kczuhan1404@gmail.com','eP4C2vqi','active',2),(63,'magay.ramiel@gmail.com','fw3dJK7k','active',2),(64,'kennethtorres@gmail.com','2IPSSy47','active',2),(65,'micodews@gmail.com','o7jkeDDm','active',2),(66,'roniebermejo@gmail.com','eBHCstPG','active',2),(67,'jp@gmail.com','ERBLMEiu','active',2),(68,'markjay@gmail.com','B59qlmNT','active',2),(69,'janrielvillegas@gmail.com','lcXf8zs7','active',2),(70,'ovincent@gmail.com','3xHzox32','active',2),(71,'delbano@gmail.com','dDkfabgd','active',2),(72,'josena@gmail.com','IpRMNtfq','active',2),(73,'jadetuando@gmail.com','pGPZnPgd','active',2),(74,'bjcalonia@gmail.com','uEuhNN8B','active',2),(75,'jdriancajas@gmail.com','YJLtt8ux','active',2),(76,'solomon@gmail.com','R07FGmNv','active',2);
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

-- Dump completed on 2020-02-25 15:08:11
