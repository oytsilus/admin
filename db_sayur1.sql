-- --------------------------------------------------------
-- Host:                         127.0.0.1
-- Server version:               5.5.36 - MySQL Community Server (GPL)
-- Server OS:                    Win32
-- HeidiSQL Version:             9.3.0.4984
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8mb4 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;

-- Dumping structure for table db_sayur.acl
CREATE TABLE IF NOT EXISTS `acl` (
  `ai` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `action_id` int(10) unsigned NOT NULL,
  `user_id` int(10) unsigned DEFAULT NULL,
  PRIMARY KEY (`ai`),
  KEY `action_id` (`action_id`),
  KEY `user_id` (`user_id`),
  CONSTRAINT `acl_ibfk_1` FOREIGN KEY (`action_id`) REFERENCES `acl_actions` (`action_id`) ON DELETE CASCADE,
  CONSTRAINT `acl_ibfk_2` FOREIGN KEY (`user_id`) REFERENCES `users` (`user_id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- Dumping data for table db_sayur.acl: ~0 rows (approximately)
/*!40000 ALTER TABLE `acl` DISABLE KEYS */;
/*!40000 ALTER TABLE `acl` ENABLE KEYS */;


-- Dumping structure for table db_sayur.acl_actions
CREATE TABLE IF NOT EXISTS `acl_actions` (
  `action_id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `action_code` varchar(100) NOT NULL COMMENT 'No periods allowed!',
  `action_desc` varchar(100) NOT NULL COMMENT 'Human readable description',
  `category_id` int(10) unsigned NOT NULL,
  PRIMARY KEY (`action_id`),
  KEY `category_id` (`category_id`),
  CONSTRAINT `acl_actions_ibfk_1` FOREIGN KEY (`category_id`) REFERENCES `acl_categories` (`category_id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- Dumping data for table db_sayur.acl_actions: ~0 rows (approximately)
/*!40000 ALTER TABLE `acl_actions` DISABLE KEYS */;
/*!40000 ALTER TABLE `acl_actions` ENABLE KEYS */;


-- Dumping structure for table db_sayur.acl_categories
CREATE TABLE IF NOT EXISTS `acl_categories` (
  `category_id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `category_code` varchar(100) NOT NULL COMMENT 'No periods allowed!',
  `category_desc` varchar(100) NOT NULL COMMENT 'Human readable description',
  PRIMARY KEY (`category_id`),
  UNIQUE KEY `category_code` (`category_code`),
  UNIQUE KEY `category_desc` (`category_desc`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- Dumping data for table db_sayur.acl_categories: ~0 rows (approximately)
/*!40000 ALTER TABLE `acl_categories` DISABLE KEYS */;
/*!40000 ALTER TABLE `acl_categories` ENABLE KEYS */;


-- Dumping structure for table db_sayur.auth_sessions
CREATE TABLE IF NOT EXISTS `auth_sessions` (
  `id` varchar(40) NOT NULL,
  `user_id` int(10) unsigned NOT NULL,
  `login_time` datetime DEFAULT NULL,
  `modified_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `ip_address` varchar(45) NOT NULL,
  `user_agent` varchar(60) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- Dumping data for table db_sayur.auth_sessions: 4 rows
/*!40000 ALTER TABLE `auth_sessions` DISABLE KEYS */;
INSERT INTO `auth_sessions` (`id`, `user_id`, `login_time`, `modified_at`, `ip_address`, `user_agent`) VALUES
	('548ebd7c297d5c79220e735da9ee8445d0b07a93', 592418686, '2016-07-19 06:43:12', '2016-07-19 13:52:25', '::1', 'Chrome 51.0.2704.103 on Windows 10'),
	('066905de692efd2df57d7d77c11900c57be66497', 592418686, '2016-07-19 08:58:16', '2016-07-19 14:11:08', '::1', 'Chrome 51.0.2704.103 on Windows 10'),
	('908a82f8be9d116c776fe51cd624d073a1e81d03', 592418686, '2016-07-19 09:17:48', '2016-07-19 14:17:48', '::1', 'Chrome 51.0.2704.103 on Windows 10'),
	('fc17e29b2874f57db228edf181dbc54e1f9b8a97', 592418686, '2016-07-19 09:26:34', '2016-07-19 14:37:54', '::1', 'Chrome 51.0.2704.103 on Windows 10');
/*!40000 ALTER TABLE `auth_sessions` ENABLE KEYS */;


-- Dumping structure for table db_sayur.ci_sessions
CREATE TABLE IF NOT EXISTS `ci_sessions` (
  `id` varchar(40) NOT NULL,
  `ip_address` varchar(45) NOT NULL,
  `timestamp` int(10) unsigned NOT NULL DEFAULT '0',
  `data` blob NOT NULL,
  PRIMARY KEY (`id`),
  KEY `ci_sessions_timestamp` (`timestamp`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- Dumping data for table db_sayur.ci_sessions: 0 rows
/*!40000 ALTER TABLE `ci_sessions` DISABLE KEYS */;
/*!40000 ALTER TABLE `ci_sessions` ENABLE KEYS */;


-- Dumping structure for table db_sayur.denied_access
CREATE TABLE IF NOT EXISTS `denied_access` (
  `ai` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `ip_address` varchar(45) NOT NULL,
  `time` datetime NOT NULL,
  `reason_code` tinyint(1) unsigned DEFAULT '0',
  PRIMARY KEY (`ai`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- Dumping data for table db_sayur.denied_access: 0 rows
/*!40000 ALTER TABLE `denied_access` DISABLE KEYS */;
/*!40000 ALTER TABLE `denied_access` ENABLE KEYS */;


-- Dumping structure for table db_sayur.ips_on_hold
CREATE TABLE IF NOT EXISTS `ips_on_hold` (
  `ai` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `ip_address` varchar(45) NOT NULL,
  `time` datetime NOT NULL,
  PRIMARY KEY (`ai`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

-- Dumping data for table db_sayur.ips_on_hold: 0 rows
/*!40000 ALTER TABLE `ips_on_hold` DISABLE KEYS */;
/*!40000 ALTER TABLE `ips_on_hold` ENABLE KEYS */;


-- Dumping structure for table db_sayur.login_errors
CREATE TABLE IF NOT EXISTS `login_errors` (
  `ai` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `username_or_email` varchar(255) NOT NULL,
  `ip_address` varchar(45) NOT NULL,
  `time` datetime NOT NULL,
  PRIMARY KEY (`ai`)
) ENGINE=MyISAM AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;

-- Dumping data for table db_sayur.login_errors: 3 rows
/*!40000 ALTER TABLE `login_errors` DISABLE KEYS */;
INSERT INTO `login_errors` (`ai`, `username_or_email`, `ip_address`, `time`) VALUES
	(1, 'asdf', '::1', '2016-07-16 00:12:11'),
	(2, 'asdf', '::1', '2016-07-16 00:13:54'),
	(3, 'asdf', '::1', '2016-07-16 00:16:12');
/*!40000 ALTER TABLE `login_errors` ENABLE KEYS */;


-- Dumping structure for table db_sayur.m_customer
CREATE TABLE IF NOT EXISTS `m_customer` (
  `mc_id` int(11) NOT NULL AUTO_INCREMENT,
  `mc_code` varchar(32) DEFAULT NULL,
  `mc_name` varchar(255) DEFAULT NULL,
  `mc_address` text,
  `mc_flag` smallint(6) DEFAULT NULL,
  PRIMARY KEY (`mc_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- Dumping data for table db_sayur.m_customer: ~0 rows (approximately)
/*!40000 ALTER TABLE `m_customer` DISABLE KEYS */;
/*!40000 ALTER TABLE `m_customer` ENABLE KEYS */;


-- Dumping structure for table db_sayur.m_product
CREATE TABLE IF NOT EXISTS `m_product` (
  `mp_id` bigint(20) NOT NULL AUTO_INCREMENT,
  `mu_id` bigint(20) DEFAULT NULL,
  `mp_code` varchar(128) DEFAULT NULL,
  `mp_name` varchar(255) DEFAULT NULL,
  `mp_flag` smallint(6) DEFAULT NULL,
  PRIMARY KEY (`mp_id`),
  KEY `fk_m_product_unit` (`mu_id`),
  CONSTRAINT `fk_m_product_unit` FOREIGN KEY (`mu_id`) REFERENCES `m_unit` (`mu_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- Dumping data for table db_sayur.m_product: ~0 rows (approximately)
/*!40000 ALTER TABLE `m_product` DISABLE KEYS */;
/*!40000 ALTER TABLE `m_product` ENABLE KEYS */;


-- Dumping structure for table db_sayur.m_supplier
CREATE TABLE IF NOT EXISTS `m_supplier` (
  `ms_id` int(11) NOT NULL AUTO_INCREMENT,
  `ms_code` varchar(128) DEFAULT NULL,
  `ms_name` varchar(255) DEFAULT NULL,
  `ms_address` text,
  `ms_flag` smallint(6) DEFAULT NULL,
  PRIMARY KEY (`ms_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- Dumping data for table db_sayur.m_supplier: ~0 rows (approximately)
/*!40000 ALTER TABLE `m_supplier` DISABLE KEYS */;
/*!40000 ALTER TABLE `m_supplier` ENABLE KEYS */;


-- Dumping structure for table db_sayur.m_unit
CREATE TABLE IF NOT EXISTS `m_unit` (
  `mu_id` bigint(20) NOT NULL AUTO_INCREMENT,
  `mu_code` varchar(32) DEFAULT NULL,
  `mu_name` varchar(128) DEFAULT NULL,
  `mu_flag` smallint(6) DEFAULT NULL,
  PRIMARY KEY (`mu_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- Dumping data for table db_sayur.m_unit: ~0 rows (approximately)
/*!40000 ALTER TABLE `m_unit` DISABLE KEYS */;
/*!40000 ALTER TABLE `m_unit` ENABLE KEYS */;


-- Dumping structure for table db_sayur.t_supplier_product
CREATE TABLE IF NOT EXISTS `t_supplier_product` (
  `ms_id` int(11) NOT NULL,
  `mp_id` bigint(20) NOT NULL,
  `mc_id` int(11) NOT NULL,
  `price_date` date DEFAULT NULL,
  `price_nominal` double(15,0) DEFAULT NULL,
  `input_datetime` datetime DEFAULT NULL,
  `input_user` int(11) DEFAULT NULL,
  PRIMARY KEY (`ms_id`,`mp_id`,`mc_id`),
  KEY `fk_t_supplier_product` (`mp_id`),
  KEY `fk_m_customer_product` (`mc_id`),
  CONSTRAINT `fk_m_customer_product` FOREIGN KEY (`mc_id`) REFERENCES `m_customer` (`mc_id`),
  CONSTRAINT `fk_m_supplier_product` FOREIGN KEY (`ms_id`) REFERENCES `m_supplier` (`ms_id`),
  CONSTRAINT `fk_t_supplier_product` FOREIGN KEY (`mp_id`) REFERENCES `m_product` (`mp_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- Dumping data for table db_sayur.t_supplier_product: ~0 rows (approximately)
/*!40000 ALTER TABLE `t_supplier_product` DISABLE KEYS */;
/*!40000 ALTER TABLE `t_supplier_product` ENABLE KEYS */;


-- Dumping structure for table db_sayur.username_or_email_on_hold
CREATE TABLE IF NOT EXISTS `username_or_email_on_hold` (
  `ai` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `username_or_email` varchar(255) NOT NULL,
  `time` datetime NOT NULL,
  PRIMARY KEY (`ai`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- Dumping data for table db_sayur.username_or_email_on_hold: 0 rows
/*!40000 ALTER TABLE `username_or_email_on_hold` DISABLE KEYS */;
/*!40000 ALTER TABLE `username_or_email_on_hold` ENABLE KEYS */;


-- Dumping structure for table db_sayur.users
CREATE TABLE IF NOT EXISTS `users` (
  `user_id` int(10) unsigned NOT NULL,
  `username` varchar(12) DEFAULT NULL,
  `email` varchar(255) NOT NULL,
  `auth_level` tinyint(3) unsigned NOT NULL,
  `banned` enum('0','1') NOT NULL DEFAULT '0',
  `passwd` varchar(60) NOT NULL,
  `passwd_recovery_code` varchar(60) DEFAULT NULL,
  `passwd_recovery_date` datetime DEFAULT NULL,
  `passwd_modified_at` datetime DEFAULT NULL,
  `last_login` datetime DEFAULT NULL,
  `created_at` datetime NOT NULL,
  `modified_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`user_id`),
  UNIQUE KEY `email` (`email`),
  UNIQUE KEY `username` (`username`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- Dumping data for table db_sayur.users: ~2 rows (approximately)
/*!40000 ALTER TABLE `users` DISABLE KEYS */;
INSERT INTO `users` (`user_id`, `username`, `email`, `auth_level`, `banned`, `passwd`, `passwd_recovery_code`, `passwd_recovery_date`, `passwd_modified_at`, `last_login`, `created_at`, `modified_at`) VALUES
	(592418686, 'oytsilus', 'agung.sulistyo.w@gmail.com', 9, '0', '$2y$10$f89243c770cbaa450213euH4kJogm/hVzCmD9t2VjQfddWog.OE0W', '$2y$10$09e15f8c8e5fe61144f87ur5qGQl.6LYG7/Egn2eHkTdB.b1Gay8.', '2016-07-15 23:15:12', '2016-07-12 09:21:01', '2016-07-19 09:52:56', '2016-07-12 04:14:01', '2016-07-19 14:52:56'),
	(1672043320, 'skunkbot', 'skunkbot@example.com', 1, '0', '$2y$10$0628ec093b905f33aa2baOqLRaiTSLh8HbR7F8G3bE4Swnc7GFOPa', NULL, NULL, NULL, NULL, '2016-07-12 04:23:09', '2016-07-12 09:23:09');
/*!40000 ALTER TABLE `users` ENABLE KEYS */;


-- Dumping structure for trigger db_sayur.ca_passwd_trigger
SET @OLDTMP_SQL_MODE=@@SQL_MODE, SQL_MODE='';
DELIMITER //
CREATE TRIGGER `ca_passwd_trigger` BEFORE UPDATE ON `users` FOR EACH ROW BEGIN
    IF ((NEW.passwd <=> OLD.passwd) = 0) THEN
        SET NEW.passwd_modified_at = NOW();
    END IF;
END//
DELIMITER ;
SET SQL_MODE=@OLDTMP_SQL_MODE;
/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IF(@OLD_FOREIGN_KEY_CHECKS IS NULL, 1, @OLD_FOREIGN_KEY_CHECKS) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
