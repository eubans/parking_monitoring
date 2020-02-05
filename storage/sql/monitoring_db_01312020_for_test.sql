-- --------------------------------------------------------
-- Host:                         127.0.0.1
-- Server version:               5.5.35 - MySQL Community Server (GPL)
-- Server OS:                    Win32
-- HeidiSQL Version:             8.2.0.4675
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;

-- Dumping database structure for monitoring_db
DROP DATABASE IF EXISTS `monitoring_db`;
CREATE DATABASE IF NOT EXISTS `monitoring_db` /*!40100 DEFAULT CHARACTER SET latin1 */;
USE `monitoring_db`;


-- Dumping structure for table monitoring_db.attendance_logs
DROP TABLE IF EXISTS `attendance_logs`;
CREATE TABLE IF NOT EXISTS `attendance_logs` (
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
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

-- Dumping data for table monitoring_db.attendance_logs: ~1 rows (approximately)
/*!40000 ALTER TABLE `attendance_logs` DISABLE KEYS */;
INSERT INTO `attendance_logs` (`atl_id`, `atl_occupant_id`, `atl_date_in`, `atl_date_out`, `atl_time_in`, `atl_time_out`, `atl_status`, `modified_at`, `created_at`, `created_by`) VALUES
	(1, 1, '2020-01-30', '2020-01-30', '20:50:46', '20:51:03', 'done', '2020-01-30 20:51:03', '2020-01-30 20:50:46', 2),
	(2, 1, '2020-02-01', '2020-02-01', '03:51:53', '03:51:55', 'done', '2020-02-01 03:51:55', '2020-02-01 03:51:53', 1);
/*!40000 ALTER TABLE `attendance_logs` ENABLE KEYS */;


-- Dumping structure for table monitoring_db.global_variables
DROP TABLE IF EXISTS `global_variables`;
CREATE TABLE IF NOT EXISTS `global_variables` (
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

-- Dumping data for table monitoring_db.global_variables: ~1 rows (approximately)
/*!40000 ALTER TABLE `global_variables` DISABLE KEYS */;
INSERT INTO `global_variables` (`glv_id`, `glv_name`, `glv_value`, `created_at`, `modified_at`, `created_by`) VALUES
	(1, 'PARKING_SLOT_COUNT', 16, '2020-01-28 20:50:40', '2020-01-30 20:41:52', 1);
/*!40000 ALTER TABLE `global_variables` ENABLE KEYS */;


-- Dumping structure for table monitoring_db.occupants
DROP TABLE IF EXISTS `occupants`;
CREATE TABLE IF NOT EXISTS `occupants` (
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
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

-- Dumping data for table monitoring_db.occupants: ~1 rows (approximately)
/*!40000 ALTER TABLE `occupants` DISABLE KEYS */;
INSERT INTO `occupants` (`occ_id`, `occ_lastname`, `occ_firstname`, `occ_middlename`, `occ_date_of_birth`, `occ_address`, `occ_student_number`, `occ_course`, `occ_email_address`, `occ_telephone`, `occ_phone_number`, `occ_qr_code`, `occ_user_id`, `occ_type`, `occ_account_status`, `modified_at`, `created_at`, `created_by`) VALUES
	(1, 'Mcdonnell', 'Zachary', 'Hensley', '1997-01-30', 'Blk 18 lot 24 Kalayaan Village Pasay City', '14005001200', 'BSIT', 'mcdonnell@gmail.com', '123-1245', '09412331244', '0f9ebe08a0cddd4c983b80822184406c00a891f3', 3, 1, 'active', '2020-01-30 20:50:27', '2020-01-30 20:49:51', 2);
/*!40000 ALTER TABLE `occupants` ENABLE KEYS */;


-- Dumping structure for table monitoring_db.occupant_guardians
DROP TABLE IF EXISTS `occupant_guardians`;
CREATE TABLE IF NOT EXISTS `occupant_guardians` (
  `ocg_id` int(11) NOT NULL AUTO_INCREMENT,
  `ocg_occupant_id` int(11) DEFAULT NULL,
  `ocg_name` varchar(150) DEFAULT NULL,
  `ocg_occupation` varchar(150) DEFAULT NULL,
  `ocg_contact` varchar(150) DEFAULT NULL,
  PRIMARY KEY (`ocg_id`),
  KEY `FK__occupants` (`ocg_occupant_id`),
  CONSTRAINT `FK__occupants` FOREIGN KEY (`ocg_occupant_id`) REFERENCES `occupants` (`occ_id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

-- Dumping data for table monitoring_db.occupant_guardians: ~1 rows (approximately)
/*!40000 ALTER TABLE `occupant_guardians` DISABLE KEYS */;
INSERT INTO `occupant_guardians` (`ocg_id`, `ocg_occupant_id`, `ocg_name`, `ocg_occupation`, `ocg_contact`) VALUES
	(1, 1, 'Jose Rizal', 'IT', '09123123123');
/*!40000 ALTER TABLE `occupant_guardians` ENABLE KEYS */;


-- Dumping structure for table monitoring_db.occupant_motorcycle_info
DROP TABLE IF EXISTS `occupant_motorcycle_info`;
CREATE TABLE IF NOT EXISTS `occupant_motorcycle_info` (
  `omi_id` int(11) NOT NULL AUTO_INCREMENT,
  `omi_occupant_id` int(11) DEFAULT NULL,
  `omi_or_number` varchar(150) DEFAULT NULL,
  `omi_cr_number` varchar(150) DEFAULT NULL,
  `omi_plate_number` varchar(150) DEFAULT NULL,
  `omi_brand` varchar(150) DEFAULT NULL,
  `omi_model` varchar(150) DEFAULT NULL,
  PRIMARY KEY (`omi_id`),
  KEY `FK_occupant_motorcycle_info_occupants` (`omi_occupant_id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

-- Dumping data for table monitoring_db.occupant_motorcycle_info: ~1 rows (approximately)
/*!40000 ALTER TABLE `occupant_motorcycle_info` DISABLE KEYS */;
INSERT INTO `occupant_motorcycle_info` (`omi_id`, `omi_occupant_id`, `omi_or_number`, `omi_cr_number`, `omi_plate_number`, `omi_brand`, `omi_model`) VALUES
	(1, 1, '11361366', '4215125', 'GHJ 123', 'Honda', 'Click 125i');
/*!40000 ALTER TABLE `occupant_motorcycle_info` ENABLE KEYS */;


-- Dumping structure for table monitoring_db.occupant_type
DROP TABLE IF EXISTS `occupant_type`;
CREATE TABLE IF NOT EXISTS `occupant_type` (
  `oct_id` int(11) NOT NULL AUTO_INCREMENT,
  `oct_name` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`oct_id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

-- Dumping data for table monitoring_db.occupant_type: ~3 rows (approximately)
/*!40000 ALTER TABLE `occupant_type` DISABLE KEYS */;
INSERT INTO `occupant_type` (`oct_id`, `oct_name`) VALUES
	(1, 'Student'),
	(2, 'Professor'),
	(3, 'Guest');
/*!40000 ALTER TABLE `occupant_type` ENABLE KEYS */;


-- Dumping structure for table monitoring_db.reservations
DROP TABLE IF EXISTS `reservations`;
CREATE TABLE IF NOT EXISTS `reservations` (
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

-- Dumping data for table monitoring_db.reservations: ~0 rows (approximately)
/*!40000 ALTER TABLE `reservations` DISABLE KEYS */;
/*!40000 ALTER TABLE `reservations` ENABLE KEYS */;


-- Dumping structure for table monitoring_db.users
DROP TABLE IF EXISTS `users`;
CREATE TABLE IF NOT EXISTS `users` (
  `use_id` int(11) NOT NULL AUTO_INCREMENT,
  `use_username` varchar(50) DEFAULT NULL,
  `use_password` varchar(150) DEFAULT NULL,
  `use_status` varchar(150) DEFAULT 'active' COMMENT 'active/deactivated',
  `use_user_type` int(11) DEFAULT NULL,
  PRIMARY KEY (`use_id`),
  KEY `FK_users_user_type` (`use_user_type`),
  CONSTRAINT `FK_users_user_type` FOREIGN KEY (`use_user_type`) REFERENCES `user_type` (`ust_id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=latin1;

-- Dumping data for table monitoring_db.users: ~5 rows (approximately)
/*!40000 ALTER TABLE `users` DISABLE KEYS */;
INSERT INTO `users` (`use_id`, `use_username`, `use_password`, `use_status`, `use_user_type`) VALUES
	(1, 'admin', '$2y$10$xE3HqN1vLhrCHJET4TXExet4eMU/OpRmE4EH4noddBzJUzUKZxHKe', 'active', 3),
	(2, 'admin_1', '$2y$10$Gijj9HzLqzsVasgM/MGdwOuHH9WWkBx/pc3jutW3Gpa0N/wt4quf.', 'active', 1),
	(3, 'mcdonnell@gmail.com', 'password', 'active', 2),
	(4, 'markivaneubans@gmail.com', 'ILmqAHjG', 'active', 2),
	(5, 'hilsoftinc@gmail.com', 'fOqikQeb', 'active', 2);
/*!40000 ALTER TABLE `users` ENABLE KEYS */;


-- Dumping structure for table monitoring_db.user_details
DROP TABLE IF EXISTS `user_details`;
CREATE TABLE IF NOT EXISTS `user_details` (
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
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

-- Dumping data for table monitoring_db.user_details: ~2 rows (approximately)
/*!40000 ALTER TABLE `user_details` DISABLE KEYS */;
INSERT INTO `user_details` (`usd_id`, `usd_user_id`, `usd_firstname`, `usd_lastname`, `usd_middlename`, `usd_email`, `usd_contact_number`, `modified_at`, `created_at`, `created_by`) VALUES
	(1, 1, 'Gerard', 'Datuin', 'Ocampo', 'gerarddatuin@gmail.com', '09123456789', '2020-01-30 14:09:51', '2020-01-30 20:44:34', 1),
	(2, 2, 'Jose', 'Rizal', 'Gonzales', 'joserizal@gmail.com', '09412331244', NULL, '2020-01-30 20:47:38', 1);
/*!40000 ALTER TABLE `user_details` ENABLE KEYS */;


-- Dumping structure for table monitoring_db.user_type
DROP TABLE IF EXISTS `user_type`;
CREATE TABLE IF NOT EXISTS `user_type` (
  `ust_id` int(11) NOT NULL AUTO_INCREMENT,
  `ust_type` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`ust_id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

-- Dumping data for table monitoring_db.user_type: ~3 rows (approximately)
/*!40000 ALTER TABLE `user_type` DISABLE KEYS */;
INSERT INTO `user_type` (`ust_id`, `ust_type`) VALUES
	(1, 'Admin'),
	(2, 'Occupant'),
	(3, 'Super Admin');
/*!40000 ALTER TABLE `user_type` ENABLE KEYS */;
/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IF(@OLD_FOREIGN_KEY_CHECKS IS NULL, 1, @OLD_FOREIGN_KEY_CHECKS) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
