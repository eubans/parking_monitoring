-- MySQL dump 10.13  Distrib 5.5.35, for Win32 (x86)
--
-- Host: localhost    Database: monitoring_db
-- ------------------------------------------------------
-- Server version	5.5.35

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
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `attendance_logs`
--

LOCK TABLES `attendance_logs` WRITE;
/*!40000 ALTER TABLE `attendance_logs` DISABLE KEYS */;
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
  `glv_value` int(11) DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `modified_at` datetime DEFAULT NULL,
  `created_by` int(11) DEFAULT NULL,
  PRIMARY KEY (`glv_id`),
  KEY `FK_global_variables_users` (`created_by`),
  CONSTRAINT `FK_global_variables_users` FOREIGN KEY (`created_by`) REFERENCES `users` (`use_id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `global_variables`
--

LOCK TABLES `global_variables` WRITE;
/*!40000 ALTER TABLE `global_variables` DISABLE KEYS */;
INSERT INTO `global_variables` VALUES (1,'PARKING_SLOT_COUNT',16,'2020-01-28 20:50:40','2020-02-06 18:36:10',1);
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
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `incident_reports`
--

LOCK TABLES `incident_reports` WRITE;
/*!40000 ALTER TABLE `incident_reports` DISABLE KEYS */;
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
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `occupant_guardians`
--

LOCK TABLES `occupant_guardians` WRITE;
/*!40000 ALTER TABLE `occupant_guardians` DISABLE KEYS */;
INSERT INTO `occupant_guardians` VALUES (1,1,'Jose Rizal','IT','09123123123'),(2,2,'Jose Rizal','IT','09123123123'),(3,3,NULL,NULL,NULL);
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
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `occupant_motorcycle_info`
--

LOCK TABLES `occupant_motorcycle_info` WRITE;
/*!40000 ALTER TABLE `occupant_motorcycle_info` DISABLE KEYS */;
INSERT INTO `occupant_motorcycle_info` VALUES (1,1,'11361366','4215125','GHJ 123','Honda','Click 125i'),(2,2,'11361366','42151251','ASD-123','Honda','Click'),(3,3,'123422222','444444444','XCC-321','Honda','Click 125i');
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
INSERT INTO `occupant_type` VALUES (1,'Student'),(2,'Professor'),(3,'Guest');
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
  CONSTRAINT `FK_occupants_users` FOREIGN KEY (`occ_user_id`) REFERENCES `users` (`use_id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `FK_occupants_users_2` FOREIGN KEY (`created_by`) REFERENCES `users` (`use_id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `FK_occupants_user_type` FOREIGN KEY (`occ_type`) REFERENCES `occupant_type` (`oct_id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `occupants`
--

LOCK TABLES `occupants` WRITE;
/*!40000 ALTER TABLE `occupants` DISABLE KEYS */;
INSERT INTO `occupants` VALUES (1,'Datuin','Gerard','Gonzales','1998-12-30','1084 Tramo St. E. Aldana Las Pinas City','14000500200','BSIT','gerard_datuin@gmail.com','123-1245','09412331244','e58a72f5a2b20eeaff392ac52f694ea784169959',4,1,'active',NULL,'2020-02-06 21:29:09',1),(2,'Eubans','Mark Ivan','Galarosa','1998-02-06','Blk 18 lot 24 Kalayaan Village Pasay City',NULL,NULL,'markivaneubans@gmail.com','123-4567','09412331244','05f0d3416e9f5e2d1cd7d8a3f257876e15edd1f3',5,2,'active',NULL,'2020-02-06 21:30:05',1),(3,'MC','Donald','J','2020-02-05','55 Bulusan Street, Mandaluyong City',NULL,NULL,'mcdonald@gmail.com',NULL,'09059033184','bbf5624933eab14be81f564662c93d39eb3c651d',NULL,3,'active',NULL,'2020-02-06 21:31:21',1);
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
  `rsv_timein_datetime` datetime DEFAULT NULL,
  `rsv_notify_ctr` int(11) DEFAULT '0',
  `rsv_status` varchar(50) DEFAULT 'pending' COMMENT 'pending, done, cancelled',
  `modified_at` datetime DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `created_by` int(11) DEFAULT NULL,
  PRIMARY KEY (`rsv_id`),
  KEY `FK_reservation_users` (`created_by`),
  KEY `FK_reservation_occupants` (`rsv_occupant_id`),
  CONSTRAINT `FK_reservation_occupants` FOREIGN KEY (`rsv_occupant_id`) REFERENCES `occupants` (`occ_id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `FK_reservation_users` FOREIGN KEY (`created_by`) REFERENCES `users` (`use_id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `reservations`
--

LOCK TABLES `reservations` WRITE;
/*!40000 ALTER TABLE `reservations` DISABLE KEYS */;
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
  CONSTRAINT `FK_user_details_users` FOREIGN KEY (`created_by`) REFERENCES `users` (`use_id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `FK__users` FOREIGN KEY (`usd_user_id`) REFERENCES `users` (`use_id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `user_details`
--

LOCK TABLES `user_details` WRITE;
/*!40000 ALTER TABLE `user_details` DISABLE KEYS */;
INSERT INTO `user_details` VALUES (1,1,'Gerard','Datuin','Ocampo','markivaneubans@gmail.com','09123456789','2020-01-30 14:09:51','2020-01-30 20:44:34',1),(2,2,'AFirstname','ALastname','AMiddlename','admin_parkinglogs@gmail.com','09123123123',NULL,'2020-02-06 21:23:36',1),(3,3,'FAttendant','LAttendant','MAttendant','attendant_parkinglogssystem@gmail.com','09123123123',NULL,'2020-02-06 21:24:33',1);
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
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `users`
--

LOCK TABLES `users` WRITE;
/*!40000 ALTER TABLE `users` DISABLE KEYS */;
INSERT INTO `users` VALUES (1,'superadmin','$2y$10$xjco2hHscnvpNWSfVmXvC.SYw6kA8cuvKEUYxxXHkmftgaIizQ4dm','active',3),(2,'admin','$2y$10$dS3teoO3Rsv3K0nxJFt.Ruc3OzvBCXo2dJq4VIZI2I5k1QvS0ZVaW','active',1),(3,'attendant','$2y$10$gRCUWAe62OxrTx6.GwQ2r.8RL/YcPGoGQ98s5iIryaB2gMVhe2fOS','active',4),(4,'gerard_datuin@gmail.com','password','active',2),(5,'markivaneubans@gmail.com','password','active',2);
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

-- Dump completed on 2020-02-06 21:43:50
