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

-- Dumping data for table db_sayur.auth_sessions: 2 rows
/*!40000 ALTER TABLE `auth_sessions` DISABLE KEYS */;
INSERT INTO `auth_sessions` (`id`, `user_id`, `login_time`, `modified_at`, `ip_address`, `user_agent`) VALUES
	('592b3937171bb1fa94d21f2aaf34666c121206c4', 592418686, '2016-08-26 05:09:40', '2016-08-26 03:58:46', '::1', 'Chrome 52.0.2743.116 on Windows 10'),
	('b21c28ebd013df6fc16d4bb31bbb0ec39b2c7bea', 592418686, '2016-08-26 10:58:46', '2016-08-26 09:41:41', '::1', 'Chrome 52.0.2743.116 on Windows 10');
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
) ENGINE=MyISAM AUTO_INCREMENT=6 DEFAULT CHARSET=utf8;

-- Dumping data for table db_sayur.login_errors: 1 rows
/*!40000 ALTER TABLE `login_errors` DISABLE KEYS */;
INSERT INTO `login_errors` (`ai`, `username_or_email`, `ip_address`, `time`) VALUES
	(5, 'admin', '::1', '2016-08-20 09:25:19');
/*!40000 ALTER TABLE `login_errors` ENABLE KEYS */;


-- Dumping structure for table db_sayur.m_customer
CREATE TABLE IF NOT EXISTS `m_customer` (
  `mc_id` bigint(20) NOT NULL AUTO_INCREMENT,
  `mc_code` varchar(32) DEFAULT NULL,
  `mc_name` varchar(255) DEFAULT NULL,
  `mc_address` text,
  `mc_phone1` varchar(32) DEFAULT NULL,
  `mc_fax` varchar(32) DEFAULT NULL,
  `mc_email` varchar(128) DEFAULT NULL,
  `mc_pic` varchar(128) DEFAULT NULL,
  `mc_flag` smallint(6) DEFAULT NULL,
  PRIMARY KEY (`mc_id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;

-- Dumping data for table db_sayur.m_customer: ~3 rows (approximately)
/*!40000 ALTER TABLE `m_customer` DISABLE KEYS */;
INSERT INTO `m_customer` (`mc_id`, `mc_code`, `mc_name`, `mc_address`, `mc_phone1`, `mc_fax`, `mc_email`, `mc_pic`, `mc_flag`) VALUES
	(2, 'AT', 'Ibu Atie', 'Pasar Kramat Djati', '021 123456', '021 555666', 'ati@email.com', 'Qadar', 1),
	(3, 'TBM', 'Toko Bang Madun', 'Pasar Kramat Djati', '', '', '', 'Madun', 1),
	(4, 'C3', 'Customer 3', 'Kranji', '', '', '', '', 1);
/*!40000 ALTER TABLE `m_customer` ENABLE KEYS */;


-- Dumping structure for table db_sayur.m_price
CREATE TABLE IF NOT EXISTS `m_price` (
  `mbp_id` bigint(20) NOT NULL AUTO_INCREMENT,
  `mp_id` bigint(20) DEFAULT NULL,
  `ms_id` int(11) DEFAULT '0',
  `mp_code` varchar(32) DEFAULT NULL,
  `mp_category` varchar(128) DEFAULT NULL,
  `mp_name` varchar(255) DEFAULT NULL,
  `mbp_datetime` datetime DEFAULT NULL,
  `ms_code` varchar(128) DEFAULT NULL,
  `ms_name` varchar(255) DEFAULT NULL,
  `mu_code` varchar(32) DEFAULT NULL,
  `mu_name` varchar(128) DEFAULT NULL,
  `mbp_buy_price` decimal(15,0) DEFAULT '0',
  `mbp_sell_price` decimal(15,0) DEFAULT '0',
  `mbp_sell_price2` decimal(15,0) DEFAULT '0',
  `mbp_sell_price3` decimal(15,0) DEFAULT '0',
  `mbp_disc` decimal(10,2) DEFAULT '0.00',
  `mbp_disc_nominal` decimal(15,0) DEFAULT '0',
  `mbp_flag` smallint(6) DEFAULT NULL,
  PRIMARY KEY (`mbp_id`),
  KEY `fk_reference_9` (`mp_id`),
  KEY `fk_mbp2` (`ms_id`),
  CONSTRAINT `fk_mbp2` FOREIGN KEY (`ms_id`) REFERENCES `m_supplier` (`ms_id`),
  CONSTRAINT `fk_reference_9` FOREIGN KEY (`mp_id`) REFERENCES `m_product` (`mp_id`)
) ENGINE=InnoDB AUTO_INCREMENT=33 DEFAULT CHARSET=latin1;

-- Dumping data for table db_sayur.m_price: ~30 rows (approximately)
/*!40000 ALTER TABLE `m_price` DISABLE KEYS */;
INSERT INTO `m_price` (`mbp_id`, `mp_id`, `ms_id`, `mp_code`, `mp_category`, `mp_name`, `mbp_datetime`, `ms_code`, `ms_name`, `mu_code`, `mu_name`, `mbp_buy_price`, `mbp_sell_price`, `mbp_sell_price2`, `mbp_sell_price3`, `mbp_disc`, `mbp_disc_nominal`, `mbp_flag`) VALUES
	(1, 1, 1, 'S001', 'SAYUR', 'Buncis Super', '2016-07-01 21:32:14', 'TBM', 'Toko Berkah Makmur', 'KG', 'Kg', 10000, 11000, 0, 0, 0.00, 0, 1),
	(2, 1, 1, 'S001', 'SAYUR', 'Buncis Super', '2016-07-25 21:37:30', 'TBM', 'Toko Berkah Makmur', 'KG', 'Kg', 10500, 11500, 0, 0, 1.25, 0, 1),
	(5, 52, 1, 'S052', 'SAYUR', 'Asem Mentah', '2016-07-26 12:07:30', 'TBM', 'Toko Berkah Makmur', 'KG', 'Kg', 10500, 12500, 0, 0, 0.00, 0, 1),
	(6, 50, 1, 'S050', 'SAYUR', 'Bawang Merah Biasa', '2016-07-26 12:07:30', 'TBM', 'Toko Berkah Makmur', 'KG', 'Kg', 4500, 5000, 0, 0, 0.00, 0, 1),
	(7, 51, 1, 'S051', 'SAYUR', 'Bawang Merah Super', '2016-07-26 12:07:30', 'TBM', 'Toko Berkah Makmur', 'KG', 'Kg', 5000, 5500, 0, 0, 0.00, 0, 1),
	(8, 48, 1, 'S048', 'SAYUR', 'Bawang Putih Biasa', '2016-07-26 12:07:30', 'TBM', 'Toko Berkah Makmur', 'KG', 'Kg', 6000, 7000, 0, 0, 0.00, 0, 1),
	(9, 49, 1, 'S049', 'SAYUR', 'Bawang Putih Super', '2016-07-26 12:07:30', 'TBM', 'Toko Berkah Makmur', 'KG', 'Kg', 10000, 12000, 0, 0, 0.00, 1500, 1),
	(10, 1, 1, 'S001', 'SAYUR', 'Buncis Super', '2016-07-26 12:07:30', 'TBM', 'Toko Berkah Makmur', 'KG', 'Kg', 10500, 11500, 0, 0, 1.25, 0, 1),
	(11, 52, 2, 'S052', 'SAYUR', 'Asem Mentah', '2016-07-27 10:01:29', 'PA', 'Pak Ali', 'KG', 'Kg', 9000, 10000, 0, 0, 0.00, 0, 1),
	(12, 50, 2, 'S050', 'SAYUR', 'Bawang Merah Biasa', '2016-07-27 10:01:29', 'PA', 'Pak Ali', 'KG', 'Kg', 12000, 12500, 0, 0, 0.00, 0, 1),
	(13, 52, 2, 'S052', 'SAYUR', 'Asem Mentah', '2016-07-28 00:07:08', 'PA', 'Pak Ali', 'KG', 'Kg', 10000, 11000, 0, 0, 0.00, 0, 1),
	(14, 50, 2, 'S050', 'SAYUR', 'Bawang Merah Biasa', '2016-07-28 00:07:08', 'PA', 'Pak Ali', 'KG', 'Kg', 12000, 12500, 0, 0, 0.00, 0, 1),
	(15, 51, 2, 'S051', 'SAYUR', 'Bawang Merah Super', '2016-07-28 00:07:08', 'PA', 'Pak Ali', 'KG', 'Kg', 5000, 5500, 0, 0, 0.00, 0, 1),
	(16, 52, 1, 'S052', 'SAYUR', 'Asem Mentah', '2016-07-30 03:18:11', 'TBM', 'Toko Berkah Makmur', 'KG', 'Kg', 10500, 12500, 0, 0, 0.00, 0, 1),
	(17, 50, 1, 'S050', 'SAYUR', 'Bawang Merah Biasa', '2016-07-30 03:18:11', 'TBM', 'Toko Berkah Makmur', 'KG', 'Kg', 4500, 5000, 0, 0, 0.00, 0, 1),
	(18, 51, 1, 'S051', 'SAYUR', 'Bawang Merah Super', '2016-07-30 03:18:11', 'TBM', 'Toko Berkah Makmur', 'KG', 'Kg', 5000, 5500, 0, 0, 0.00, 0, 1),
	(19, 48, 1, 'S048', 'SAYUR', 'Bawang Putih Biasa', '2016-07-30 03:18:11', 'TBM', 'Toko Berkah Makmur', 'KG', 'Kg', 6000, 7000, 0, 0, 0.00, 0, 1),
	(20, 49, 1, 'S049', 'SAYUR', 'Bawang Putih Super', '2016-07-30 03:18:11', 'TBM', 'Toko Berkah Makmur', 'KG', 'Kg', 10000, 12000, 0, 0, 0.00, 1500, 1),
	(21, 56, 1, 'S056', 'SAYUR', 'Bayam', '2016-07-30 03:18:11', 'TBM', 'Toko Berkah Makmur', 'GABUNG', 'Gabung (20Pcs)', 20000, 25000, 0, 0, 0.00, 0, 1),
	(22, 34, 1, 'S034', 'SAYUR', 'Brokoli Biasa', '2016-07-30 03:18:11', 'TBM', 'Toko Berkah Makmur', 'KG', 'Kg', 3000, 4000, 0, 0, 0.00, 0, 1),
	(23, 33, 1, 'S033', 'SAYUR', 'Brokoli Super', '2016-07-30 03:18:11', 'TBM', 'Toko Berkah Makmur', 'KG', 'Kg', 10000, 11000, 0, 0, 0.00, 0, 1),
	(24, 25, 1, 'S025', 'SAYUR', 'Buah Asem', '2016-07-30 03:18:11', 'TBM', 'Toko Berkah Makmur', 'KG', 'Kg', 50000, 55000, 0, 0, 0.00, 0, 1),
	(25, 23, 1, 'S023', 'SAYUR', 'Buah Melinjo', '2016-07-30 03:18:11', 'TBM', 'Toko Berkah Makmur', 'KG', 'Kg', 23500, 25000, 0, 0, 0.00, 0, 1),
	(26, 2, 1, 'S002', 'SAYUR', 'Buncis Biasa', '2016-07-30 03:18:11', 'TBM', 'Toko Berkah Makmur', 'KG', 'Kg', 20000, 25000, 0, 0, 0.00, 0, 1),
	(27, 1, 1, 'S001', 'SAYUR', 'Buncis Super', '2016-07-30 03:18:11', 'TBM', 'Toko Berkah Makmur', 'KG', 'Kg', 10500, 11500, 0, 0, 1.25, 0, 1),
	(28, 3, 1, 'S003', 'SAYUR', 'Cabe Kriting Merah Super', '2016-07-30 03:18:11', 'TBM', 'Toko Berkah Makmur', 'KG', 'Kg', 30000, 35000, 0, 0, 0.00, 0, 1),
	(29, 47, 1, 'S047', 'SAYUR', 'Cabe Rawit Hijau Biasa', '2016-07-30 03:18:11', 'TBM', 'Toko Berkah Makmur', 'KG', 'Kg', 34000, 36000, 0, 0, 0.00, 0, 1),
	(30, 46, 1, 'S046', 'SAYUR', 'Cabe Rawit Hijau Super', '2016-07-30 03:18:11', 'TBM', 'Toko Berkah Makmur', 'KG', 'Kg', 40000, 45000, 0, 0, 0.00, 0, 1),
	(31, 45, 1, 'S045', 'SAYUR', 'Cabe Rawit Merah Biasa', '2016-07-30 03:18:11', 'TBM', 'Toko Berkah Makmur', 'KG', 'Kg', 40000, 43000, 0, 0, 0.00, 0, 1),
	(32, 52, 3, 'S052', 'SAYUR', 'Asem Mentah', '2016-08-22 13:36:12', 'PB', 'Pak Badu', 'KG', 'Kg', 10000, 12000, 0, 0, 0.00, 0, 1);
/*!40000 ALTER TABLE `m_price` ENABLE KEYS */;


-- Dumping structure for table db_sayur.m_product
CREATE TABLE IF NOT EXISTS `m_product` (
  `mp_id` bigint(20) NOT NULL AUTO_INCREMENT,
  `mu_id` bigint(20) DEFAULT NULL,
  `mp_code` varchar(32) DEFAULT NULL,
  `mu_code` varchar(32) DEFAULT NULL,
  `mu_name` varchar(128) DEFAULT NULL,
  `mp_category` varchar(128) DEFAULT NULL,
  `mp_name` varchar(255) DEFAULT NULL,
  `mp_flag` smallint(6) DEFAULT NULL,
  PRIMARY KEY (`mp_id`),
  KEY `fk_m_product_unit` (`mu_id`),
  CONSTRAINT `fk_m_product_unit` FOREIGN KEY (`mu_id`) REFERENCES `m_unit` (`mu_id`)
) ENGINE=InnoDB AUTO_INCREMENT=63 DEFAULT CHARSET=latin1;

-- Dumping data for table db_sayur.m_product: ~62 rows (approximately)
/*!40000 ALTER TABLE `m_product` DISABLE KEYS */;
INSERT INTO `m_product` (`mp_id`, `mu_id`, `mp_code`, `mu_code`, `mu_name`, `mp_category`, `mp_name`, `mp_flag`) VALUES
	(1, 1, 'S001', 'KG', 'Kg', 'SAYUR', 'Buncis Super', 1),
	(2, 1, 'S002', 'KG', 'Kg', 'SAYUR', 'Buncis Biasa', 1),
	(3, 1, 'S003', 'KG', 'Kg', 'SAYUR', 'Cabe Kriting Merah Super', 1),
	(4, 1, 'S004', 'KG', 'Kg', 'SAYUR', 'Kol Kupas Super', 1),
	(5, 1, 'S005', 'KG', 'Kg', 'SAYUR', 'Kol Kupas Biasa', 1),
	(6, 1, 'S006', 'KG', 'Kg', 'SAYUR', 'Jagung Manis Super', 1),
	(7, 1, 'S007', 'KG', 'Kg', 'SAYUR', 'Jagung Manis Biasa', 1),
	(8, 1, 'S008', 'KG', 'Kg', 'SAYUR', 'Putren', 1),
	(9, 1, 'S009', 'KG', 'Kg', 'SAYUR', 'Kacang Panjang Super', 1),
	(10, 1, 'S010', 'KG', 'Kg', 'SAYUR', 'Kacang Panjang Biasa', 1),
	(11, 2, 'S011', 'PCS', 'Pcs', 'SAYUR', 'Labu Siem Besar (50)', 1),
	(12, 1, 'S012', 'KG', 'Kg', 'SAYUR', 'Labu Siem Kecil', 1),
	(13, 1, 'S013', 'KG', 'Kg', 'SAYUR', 'Oyong', 1),
	(14, 1, 'S014', 'KG', 'Kg', 'SAYUR', 'Pare', 1),
	(15, 1, 'S015', 'KG', 'Kg', 'SAYUR', 'Sawi Super', 1),
	(16, 1, 'S016', 'KG', 'Kg', 'SAYUR', 'Sawi Biasa', 1),
	(17, 1, 'S017', 'KG', 'Kg', 'SAYUR', 'Ketimun', 1),
	(18, 1, 'S018', 'KG', 'Kg', 'SAYUR', 'Tomat A', 1),
	(19, 1, 'S019', 'KG', 'Kg', 'SAYUR', 'Tomat AB', 1),
	(20, 1, 'S020', 'KG', 'Kg', 'SAYUR', 'Terong Bulat Lalap', 1),
	(21, 1, 'S021', 'KG', 'Kg', 'SAYUR', 'Terong Ungu', 1),
	(22, 1, 'S022', 'KG', 'Kg', 'SAYUR', 'Sawi Hijau/Caisin', 1),
	(23, 1, 'S023', 'KG', 'Kg', 'SAYUR', 'Buah Melinjo', 1),
	(24, 1, 'S024', 'KG', 'Kg', 'SAYUR', 'Daun Melinjo', 1),
	(25, 1, 'S025', 'KG', 'Kg', 'SAYUR', 'Buah Asem', 1),
	(26, 1, 'S026', 'KG', 'Kg', 'SAYUR', 'Daun Bawang Super', 1),
	(27, 1, 'S027', 'KG', 'Kg', 'SAYUR', 'Daun Bawang Biasa', 1),
	(28, 1, 'S028', 'KG', 'Kg', 'SAYUR', 'Toge', 1),
	(29, 1, 'S029', 'KG', 'Kg', 'SAYUR', 'Daun Sledri', 1),
	(30, 1, 'S030', 'KG', 'Kg', 'SAYUR', 'Kembang Kol', 1),
	(31, 1, 'S031', 'KG', 'Kg', 'SAYUR', 'Wortel Super', 1),
	(32, 1, 'S032', 'KG', 'Kg', 'SAYUR', 'Wortel Biasa', 1),
	(33, 1, 'S033', 'KG', 'Kg', 'SAYUR', 'Brokoli Super', 1),
	(34, 1, 'S034', 'KG', 'Kg', 'SAYUR', 'Brokoli Biasa', 1),
	(35, 1, 'S035', 'KG', 'Kg', 'SAYUR', 'Pock Coy Super', 1),
	(36, 1, 'S036', 'KG', 'Kg', 'SAYUR', 'Pock Coy Biasa', 1),
	(37, 1, 'S037', 'KG', 'Kg', 'SAYUR', 'Kentang Bandung DN', 1),
	(38, 1, 'S038', 'KG', 'Kg', 'SAYUR', 'Kentang Bandung AL', 1),
	(39, 1, 'S039', 'KG', 'Kg', 'SAYUR', 'Kentang Bandung Super', 1),
	(40, 1, 'S040', 'KG', 'Kg', 'SAYUR', 'Cabe TW Merah Super', 1),
	(41, 1, 'S041', 'KG', 'Kg', 'SAYUR', 'Cabe TW Merah Biasa', 1),
	(42, 1, 'S042', 'KG', 'Kg', 'SAYUR', 'Cabe TW Hijau Super', 1),
	(43, 1, 'S043', 'KG', 'Kg', 'SAYUR', 'Cabe TW Hijau Biasa', 1),
	(44, 1, 'S044', 'KG', 'Kg', 'SAYUR', 'Cabe Rawit Merah Super', 1),
	(45, 1, 'S045', 'KG', 'Kg', 'SAYUR', 'Cabe Rawit Merah Biasa', 1),
	(46, 1, 'S046', 'KG', 'Kg', 'SAYUR', 'Cabe Rawit Hijau Super', 1),
	(47, 1, 'S047', 'KG', 'Kg', 'SAYUR', 'Cabe Rawit Hijau Biasa', 1),
	(48, 1, 'S048', 'KG', 'Kg', 'SAYUR', 'Bawang Putih Biasa', 1),
	(49, 1, 'S049', 'KG', 'Kg', 'SAYUR', 'Bawang Putih Super', 1),
	(50, 1, 'S050', 'KG', 'Kg', 'SAYUR', 'Bawang Merah Biasa', 1),
	(51, 1, 'S051', 'KG', 'Kg', 'SAYUR', 'Bawang Merah Super', 1),
	(52, 1, 'S052', 'KG', 'Kg', 'SAYUR', 'Asem Mentah', 1),
	(53, 1, 'S053', 'KG', 'Kg', 'SAYUR', 'Ketimun Jepang', 1),
	(54, 1, 'S054', 'KG', 'Kg', 'SAYUR', 'Terong Hijau', 1),
	(55, 3, 'S055', 'GABUNG', 'Gabung (20Pcs)', 'SAYUR', 'Kangkung', 1),
	(56, 3, 'S056', 'GABUNG', 'Gabung (20Pcs)', 'SAYUR', 'Bayam', 1),
	(57, 3, 'S057', 'GABUNG', 'Gabung (20Pcs)', 'SAYUR', 'Daun Singkong', 1),
	(58, 2, 'S058', 'PCS', 'Pcs', 'SAYUR', 'Kelapa', 1),
	(59, 2, 'B001', 'PCS', 'Pcs', 'BUAH', 'Naga Merah', 1),
	(60, 1, 'B002', 'KG', 'Kg', 'BUAH', 'Jeruk', 1),
	(61, 1, 'B003', 'KG', 'Kg', 'BUAH', 'Pisang Ambon Sedang', 1),
	(62, 1, 'B004', 'KG', 'Kg', 'BUAH', 'Pisang Ambon Besar', 1);
/*!40000 ALTER TABLE `m_product` ENABLE KEYS */;


-- Dumping structure for table db_sayur.m_sell_price
CREATE TABLE IF NOT EXISTS `m_sell_price` (
  `msp_id` bigint(20) NOT NULL AUTO_INCREMENT,
  `mp_id` bigint(20) DEFAULT NULL,
  `mp_code` varchar(32) DEFAULT NULL,
  `mp_category` varchar(128) DEFAULT NULL,
  `mp_name` varchar(255) DEFAULT NULL,
  `msp_datetime` datetime DEFAULT NULL,
  `msp_price` decimal(15,0) DEFAULT NULL,
  `msp_flag` smallint(6) DEFAULT NULL,
  PRIMARY KEY (`msp_id`),
  KEY `fk_reference_8` (`mp_id`),
  CONSTRAINT `fk_reference_8` FOREIGN KEY (`mp_id`) REFERENCES `m_product` (`mp_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- Dumping data for table db_sayur.m_sell_price: ~0 rows (approximately)
/*!40000 ALTER TABLE `m_sell_price` DISABLE KEYS */;
/*!40000 ALTER TABLE `m_sell_price` ENABLE KEYS */;


-- Dumping structure for table db_sayur.m_supplier
CREATE TABLE IF NOT EXISTS `m_supplier` (
  `ms_id` int(11) NOT NULL AUTO_INCREMENT,
  `ms_code` varchar(128) DEFAULT NULL,
  `ms_name` varchar(255) DEFAULT NULL,
  `ms_address` text,
  `ms_phone1` varchar(64) DEFAULT NULL,
  `ms_fax` varchar(64) DEFAULT NULL,
  `ms_email` varchar(128) DEFAULT NULL,
  `ms_pic` varchar(255) DEFAULT NULL,
  `ms_flag` smallint(6) DEFAULT NULL,
  PRIMARY KEY (`ms_id`)
) ENGINE=InnoDB AUTO_INCREMENT=29 DEFAULT CHARSET=latin1;

-- Dumping data for table db_sayur.m_supplier: ~8 rows (approximately)
/*!40000 ALTER TABLE `m_supplier` DISABLE KEYS */;
INSERT INTO `m_supplier` (`ms_id`, `ms_code`, `ms_name`, `ms_address`, `ms_phone1`, `ms_fax`, `ms_email`, `ms_pic`, `ms_flag`) VALUES
	(1, 'TBM', 'Toko Berkah Makmur', 'Pasar Baru', '021 1234567', '021 234567', 'email@email.com', 'Bpk Tigor', 1),
	(2, 'PA', 'Pak Ali', 'Pasar Kramat Djati', '021 2345678', NULL, '', NULL, 1),
	(3, 'PB', 'Pak Badu', NULL, NULL, NULL, NULL, NULL, 1),
	(4, 'IC', 'Ibu Chomsah', 'Jl. Embun Pagi No. 10', '021 999888', NULL, 'chomsah@email.com', NULL, 1),
	(5, 'IL', 'Ibu Lili', NULL, NULL, NULL, NULL, NULL, 1),
	(24, '', 'Ibu Hanah', NULL, NULL, NULL, NULL, NULL, 1),
	(27, '', 'Toko Budi Jaya', NULL, NULL, NULL, NULL, NULL, 1),
	(28, 'BD', 'Bpk Danang', 'Garut', '081233334444', '021-123456', 'danang.ngawur@gmail.com', NULL, 1);
/*!40000 ALTER TABLE `m_supplier` ENABLE KEYS */;


-- Dumping structure for table db_sayur.m_unit
CREATE TABLE IF NOT EXISTS `m_unit` (
  `mu_id` bigint(20) NOT NULL AUTO_INCREMENT,
  `mu_code` varchar(32) DEFAULT NULL,
  `mu_name` varchar(128) DEFAULT NULL,
  `mu_flag` smallint(6) DEFAULT NULL,
  PRIMARY KEY (`mu_id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

-- Dumping data for table db_sayur.m_unit: ~3 rows (approximately)
/*!40000 ALTER TABLE `m_unit` DISABLE KEYS */;
INSERT INTO `m_unit` (`mu_id`, `mu_code`, `mu_name`, `mu_flag`) VALUES
	(1, 'KG', 'Kg', 1),
	(2, 'PCS', 'Pcs', 1),
	(3, 'GABUNG', 'Gabung (20Pcs)', 1);
/*!40000 ALTER TABLE `m_unit` ENABLE KEYS */;


-- Dumping structure for table db_sayur.t_config
CREATE TABLE IF NOT EXISTS `t_config` (
  `tc_id` int(11) NOT NULL AUTO_INCREMENT,
  `tc_tipe` varchar(128) DEFAULT NULL,
  `tc_value` varchar(128) DEFAULT NULL,
  `tc_flag` smallint(6) DEFAULT '0',
  PRIMARY KEY (`tc_id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

-- Dumping data for table db_sayur.t_config: ~1 rows (approximately)
/*!40000 ALTER TABLE `t_config` DISABLE KEYS */;
INSERT INTO `t_config` (`tc_id`, `tc_tipe`, `tc_value`, `tc_flag`) VALUES
	(1, 'PPN', '10', 1);
/*!40000 ALTER TABLE `t_config` ENABLE KEYS */;


-- Dumping structure for table db_sayur.t_delivery
CREATE TABLE IF NOT EXISTS `t_delivery` (
  `td_id` bigint(20) NOT NULL AUTO_INCREMENT,
  `mc_id` bigint(20) DEFAULT NULL,
  `mc_name` varchar(255) DEFAULT NULL,
  `mc_code` varchar(32) DEFAULT NULL,
  `mc_address` text,
  `mc_email` varchar(128) DEFAULT NULL,
  `mc_phone1` varchar(32) DEFAULT NULL,
  `mc_fax` varchar(32) DEFAULT NULL,
  `to_id` bigint(20) DEFAULT '0',
  `to_no` varchar(32) DEFAULT NULL,
  `to_pic` varchar(128) DEFAULT NULL,
  `td_no` varchar(32) DEFAULT NULL,
  `td_date` date DEFAULT NULL,
  `td_datetime_input` datetime DEFAULT NULL,
  `td_desc` text,
  `td_driver_name` text,
  `td_car_no` varchar(50) DEFAULT NULL,
  `td_flag` smallint(6) DEFAULT NULL,
  PRIMARY KEY (`td_id`),
  KEY `fk_reference_28` (`mc_id`),
  CONSTRAINT `fk_reference_28` FOREIGN KEY (`mc_id`) REFERENCES `m_customer` (`mc_id`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=latin1;

-- Dumping data for table db_sayur.t_delivery: ~2 rows (approximately)
/*!40000 ALTER TABLE `t_delivery` DISABLE KEYS */;
INSERT INTO `t_delivery` (`td_id`, `mc_id`, `mc_name`, `mc_code`, `mc_address`, `mc_email`, `mc_phone1`, `mc_fax`, `to_id`, `to_no`, `to_pic`, `td_no`, `td_date`, `td_datetime_input`, `td_desc`, `td_driver_name`, `td_car_no`, `td_flag`) VALUES
	(4, 2, 'Ibu Atie', 'AT', 'Pasar Kramat Djati', 'ati@email.com', '021 123456', NULL, 2, NULL, 'Badu', 'SJ001/VIII/16', '2016-08-25', '2016-08-25 16:53:15', 'ets', 'Kundil', 'B1010IO', 1),
	(5, 2, 'Ibu Atie', 'AT', 'Pasar Kramat Djati', 'ati@email.com', '021 123456', NULL, 2, NULL, 'Qadar', 'SJ002/VIII/16', '2016-08-25', '2016-08-26 16:18:22', 'kekurangan Order sebelumnya', 'Dedi', 'B 070 KU', 0),
	(6, 2, 'Ibu Atie', 'AT', 'Pasar Kramat Djati', 'ati@email.com', '021 123456', NULL, 2, NULL, 'Qadar', 'SJ002/VIII/16', '2016-08-26', '2016-08-26 16:36:09', 'Kekurangan di SJ001', 'Buluk', 'B 9090 KU', 0),
	(7, 3, 'Toko Bang Madun', 'TBM', 'Pasar Kramat Djati', '', '', NULL, 3, NULL, 'Madun', 'SJ002/VIII/16', '2016-08-26', '2016-08-26 16:43:09', 'tes', 'sera', 'B123', 1),
	(8, 2, 'Ibu Atie', 'AT', 'Pasar Kramat Djati', 'ati@email.com', '021 123456', NULL, 2, NULL, 'Qadar', 'SJ003/VIII/16', '2016-08-26', '2016-08-26 16:44:04', 'kekurangan', 'Dedi', 'B 070 KU', 1);
/*!40000 ALTER TABLE `t_delivery` ENABLE KEYS */;


-- Dumping structure for table db_sayur.t_delivery_detail
CREATE TABLE IF NOT EXISTS `t_delivery_detail` (
  `tdd_id` bigint(20) NOT NULL AUTO_INCREMENT,
  `td_id` bigint(20) DEFAULT NULL,
  `mp_id` bigint(20) DEFAULT NULL,
  `mp_category` varchar(128) DEFAULT NULL,
  `mp_code` varchar(32) DEFAULT NULL,
  `mp_name` varchar(255) DEFAULT NULL,
  `mu_code` varchar(32) DEFAULT NULL,
  `mu_name` varchar(128) DEFAULT NULL,
  `mbp_price` decimal(15,0) DEFAULT '0',
  `msp_price` decimal(15,0) DEFAULT '0',
  `to_id` bigint(20) DEFAULT '0',
  `tod_id` bigint(20) DEFAULT '0',
  `to_no` varchar(32) DEFAULT NULL,
  `tod_qty` decimal(10,2) DEFAULT '0.00',
  `tdd_qty` decimal(10,2) DEFAULT '0.00',
  `tdd_status` varchar(50) DEFAULT NULL,
  `tdd_flag` smallint(6) DEFAULT '0',
  PRIMARY KEY (`tdd_id`),
  KEY `fk_reference_29` (`td_id`),
  KEY `fk_reference_30` (`mp_id`),
  CONSTRAINT `fk_reference_29` FOREIGN KEY (`td_id`) REFERENCES `t_delivery` (`td_id`),
  CONSTRAINT `fk_reference_30` FOREIGN KEY (`mp_id`) REFERENCES `m_product` (`mp_id`)
) ENGINE=InnoDB AUTO_INCREMENT=16 DEFAULT CHARSET=latin1;

-- Dumping data for table db_sayur.t_delivery_detail: ~7 rows (approximately)
/*!40000 ALTER TABLE `t_delivery_detail` DISABLE KEYS */;
INSERT INTO `t_delivery_detail` (`tdd_id`, `td_id`, `mp_id`, `mp_category`, `mp_code`, `mp_name`, `mu_code`, `mu_name`, `mbp_price`, `msp_price`, `to_id`, `tod_id`, `to_no`, `tod_qty`, `tdd_qty`, `tdd_status`, `tdd_flag`) VALUES
	(1, 4, 50, 'SAYUR', 'S050', 'Bawang Merah Biasa', 'KG', 'Kg', 0, 5000, 2, 1, 'SO001/VIII/16', 12.00, 6.00, 'PENDING', 1),
	(2, 4, 51, 'SAYUR', 'S051', 'Bawang Merah Super', 'KG', 'Kg', 0, 5500, 2, 2, 'SO001/VIII/16', 12.00, 6.00, 'PENDING', 1),
	(3, 4, 48, 'SAYUR', 'S048', 'Bawang Putih Biasa', 'KG', 'Kg', 0, 7000, 2, 3, 'SO001/VIII/16', 12.00, 12.00, 'CLOSED', 1),
	(4, 4, 49, 'SAYUR', 'S049', 'Bawang Putih Super', 'KG', 'Kg', 0, 12000, 2, 4, 'SO001/VIII/16', 12.00, 12.00, 'CLOSED', 1),
	(5, 4, 52, 'SAYUR', 'S052', 'Asem Mentah', 'KG', 'Kg', 0, 12000, 2, 5, 'SO001/VIII/16', 12.00, 12.00, 'CLOSED', 1),
	(6, 5, 50, 'SAYUR', 'S050', 'Bawang Merah Biasa', 'KG', 'Kg', 0, 5000, 2, 1, 'SO001/VIII/16', 6.00, 6.00, 'CLOSED', 0),
	(7, 5, 51, 'SAYUR', 'S051', 'Bawang Merah Super', 'KG', 'Kg', 0, 5500, 2, 2, 'SO001/VIII/16', 6.00, 6.00, 'CLOSED', 0),
	(8, 6, 50, 'SAYUR', 'S050', 'Bawang Merah Biasa', 'KG', 'Kg', 0, 5000, 2, 1, 'SO001/VIII/16', 6.00, 6.00, 'CLOSED', 0),
	(9, 6, 51, 'SAYUR', 'S051', 'Bawang Merah Super', 'KG', 'Kg', 0, 5500, 2, 2, 'SO001/VIII/16', 6.00, 6.00, 'CLOSED', 0),
	(10, 7, 50, 'SAYUR', 'S050', 'Bawang Merah Biasa', 'KG', 'Kg', 4500, 5000, 3, 6, 'SO002/VIII/16', 5.00, 5.00, 'CLOSED', 1),
	(11, 7, 51, 'SAYUR', 'S051', 'Bawang Merah Super', 'KG', 'Kg', 5000, 5500, 3, 7, 'SO002/VIII/16', 5.00, 5.00, 'CLOSED', 1),
	(12, 7, 48, 'SAYUR', 'S048', 'Bawang Putih Biasa', 'KG', 'Kg', 6000, 7000, 3, 8, 'SO002/VIII/16', 5.00, 5.00, 'CLOSED', 1),
	(13, 7, 52, 'SAYUR', 'S052', 'Asem Mentah', 'KG', 'Kg', 10000, 12000, 3, 9, 'SO002/VIII/16', 5.00, 5.00, 'CLOSED', 1),
	(14, 8, 50, 'SAYUR', 'S050', 'Bawang Merah Biasa', 'KG', 'Kg', 0, 5000, 2, 1, 'SO001/VIII/16', 6.00, 6.00, 'CLOSED', 1),
	(15, 8, 51, 'SAYUR', 'S051', 'Bawang Merah Super', 'KG', 'Kg', 0, 5500, 2, 2, 'SO001/VIII/16', 6.00, 6.00, 'CLOSED', 1);
/*!40000 ALTER TABLE `t_delivery_detail` ENABLE KEYS */;


-- Dumping structure for table db_sayur.t_invoice
CREATE TABLE IF NOT EXISTS `t_invoice` (
  `ti_id` bigint(20) NOT NULL AUTO_INCREMENT,
  `mc_id` bigint(20) DEFAULT NULL,
  `ti_no` varchar(32) DEFAULT NULL,
  `ti_date` date DEFAULT NULL,
  `mc_code` varchar(32) DEFAULT NULL,
  `mc_name` varchar(255) DEFAULT NULL,
  `mc_address` text,
  `mc_phone1` varchar(32) DEFAULT NULL,
  `mc_email` varchar(128) DEFAULT NULL,
  `ti_datetime_input` datetime DEFAULT NULL,
  `ti_flag` smallint(6) DEFAULT NULL,
  PRIMARY KEY (`ti_id`),
  KEY `fk_reference_18` (`mc_id`),
  CONSTRAINT `fk_reference_18` FOREIGN KEY (`mc_id`) REFERENCES `m_customer` (`mc_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- Dumping data for table db_sayur.t_invoice: ~0 rows (approximately)
/*!40000 ALTER TABLE `t_invoice` DISABLE KEYS */;
/*!40000 ALTER TABLE `t_invoice` ENABLE KEYS */;


-- Dumping structure for table db_sayur.t_invoice_detail
CREATE TABLE IF NOT EXISTS `t_invoice_detail` (
  `tid_id` bigint(20) NOT NULL AUTO_INCREMENT,
  `ti_id` bigint(20) DEFAULT NULL,
  `mp_id` bigint(20) DEFAULT NULL,
  `mp_category` varchar(128) DEFAULT NULL,
  `mp_code` varchar(32) DEFAULT NULL,
  `mp_name` varchar(255) DEFAULT NULL,
  `mbp_sell_price` decimal(15,0) DEFAULT NULL,
  `tid_qty` decimal(10,2) DEFAULT NULL,
  `tid_expected_date` date DEFAULT NULL,
  `mu_code` varchar(32) DEFAULT NULL,
  `mu_name` varchar(128) DEFAULT NULL,
  `tid_flag` smallint(6) DEFAULT NULL,
  PRIMARY KEY (`tid_id`),
  KEY `fk_reference_10` (`ti_id`),
  KEY `fk_reference_11` (`mp_id`),
  CONSTRAINT `fk_reference_10` FOREIGN KEY (`ti_id`) REFERENCES `t_invoice` (`ti_id`),
  CONSTRAINT `fk_reference_11` FOREIGN KEY (`mp_id`) REFERENCES `m_product` (`mp_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- Dumping data for table db_sayur.t_invoice_detail: ~0 rows (approximately)
/*!40000 ALTER TABLE `t_invoice_detail` DISABLE KEYS */;
/*!40000 ALTER TABLE `t_invoice_detail` ENABLE KEYS */;


-- Dumping structure for table db_sayur.t_invoice_payment
CREATE TABLE IF NOT EXISTS `t_invoice_payment` (
  `tip_id` bigint(20) NOT NULL AUTO_INCREMENT,
  `ti_id` bigint(20) DEFAULT NULL,
  `tip_date` date DEFAULT NULL,
  `tip_nominal` decimal(15,0) DEFAULT NULL,
  `tip_recipient` text,
  `tip_note` text,
  `tip_flag` smallint(6) DEFAULT NULL,
  PRIMARY KEY (`tip_id`),
  KEY `fk_reference_17` (`ti_id`),
  CONSTRAINT `fk_reference_17` FOREIGN KEY (`ti_id`) REFERENCES `t_invoice` (`ti_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- Dumping data for table db_sayur.t_invoice_payment: ~0 rows (approximately)
/*!40000 ALTER TABLE `t_invoice_payment` DISABLE KEYS */;
/*!40000 ALTER TABLE `t_invoice_payment` ENABLE KEYS */;


-- Dumping structure for table db_sayur.t_order
CREATE TABLE IF NOT EXISTS `t_order` (
  `to_id` bigint(20) NOT NULL AUTO_INCREMENT,
  `mc_id` bigint(20) DEFAULT NULL,
  `mc_name` varchar(255) DEFAULT NULL,
  `mc_address` text,
  `mc_email` varchar(128) DEFAULT NULL,
  `mc_code` varchar(32) DEFAULT NULL,
  `mc_phone1` varchar(32) DEFAULT NULL,
  `mc_fax` varchar(32) DEFAULT NULL,
  `to_no` varchar(32) DEFAULT NULL,
  `to_date` date DEFAULT NULL,
  `to_pic` varchar(128) DEFAULT NULL,
  `to_down_payment` decimal(15,0) DEFAULT NULL,
  `to_deadline_payment` date DEFAULT NULL,
  `to_description` text,
  `to_disc` decimal(10,2) DEFAULT NULL,
  `to_disc_nominal` decimal(10,0) DEFAULT NULL,
  `to_ppn` decimal(10,2) DEFAULT NULL,
  `to_ppn_nominal` decimal(15,0) DEFAULT NULL,
  `to_subtotal` decimal(15,0) DEFAULT NULL,
  `to_total` decimal(15,0) DEFAULT NULL,
  `to_datetime_input` datetime DEFAULT NULL,
  `to_status` varchar(128) DEFAULT NULL,
  `to_status_payment` varchar(128) DEFAULT NULL,
  `to_full_delivery_date` date DEFAULT NULL,
  `to_paid_date` date DEFAULT NULL,
  `to_desc` text,
  `toi_no` varchar(32) DEFAULT NULL,
  `toi_date` date DEFAULT NULL,
  `toi_due_date` date DEFAULT NULL,
  `to_flag` smallint(6) DEFAULT NULL,
  PRIMARY KEY (`to_id`),
  KEY `fk_reference_25` (`mc_id`),
  CONSTRAINT `fk_reference_25` FOREIGN KEY (`mc_id`) REFERENCES `m_customer` (`mc_id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

-- Dumping data for table db_sayur.t_order: ~1 rows (approximately)
/*!40000 ALTER TABLE `t_order` DISABLE KEYS */;
INSERT INTO `t_order` (`to_id`, `mc_id`, `mc_name`, `mc_address`, `mc_email`, `mc_code`, `mc_phone1`, `mc_fax`, `to_no`, `to_date`, `to_pic`, `to_down_payment`, `to_deadline_payment`, `to_description`, `to_disc`, `to_disc_nominal`, `to_ppn`, `to_ppn_nominal`, `to_subtotal`, `to_total`, `to_datetime_input`, `to_status`, `to_status_payment`, `to_full_delivery_date`, `to_paid_date`, `to_desc`, `toi_no`, `toi_date`, `toi_due_date`, `to_flag`) VALUES
	(2, 2, 'Ibu Atie', 'Pasar Kramat Djati', 'ati@email.com', 'AT', '021 123456', NULL, 'SO001/VIII/16', '2016-08-25', 'Qadar', NULL, NULL, 'tes', 0.00, 0, 0.00, 0, 498000, 498000, '2016-08-25 16:46:36', 'CLOSED', 'UNPAID', '2016-08-26', NULL, NULL, 'INV001/VIII/16', '2016-08-25', '0000-00-00', 1),
	(3, 3, 'Toko Bang Madun', 'Pasar Kramat Djati', '', 'TBM', '', NULL, 'SO002/VIII/16', '2016-08-26', 'Madun', NULL, NULL, '', 0.00, 0, 0.00, 0, 147500, 147500, '2016-08-26 16:42:24', 'CLOSED', 'UNPAID', '2016-08-26', NULL, NULL, 'INV001//16', '2016-08-26', '0000-00-00', 1);
/*!40000 ALTER TABLE `t_order` ENABLE KEYS */;


-- Dumping structure for table db_sayur.t_order_detail
CREATE TABLE IF NOT EXISTS `t_order_detail` (
  `tod_id` bigint(20) NOT NULL AUTO_INCREMENT,
  `to_id` bigint(20) DEFAULT NULL,
  `mp_id` bigint(20) DEFAULT NULL,
  `mp_category` varchar(128) DEFAULT NULL,
  `mp_code` varchar(32) DEFAULT NULL,
  `mp_name` varchar(255) DEFAULT NULL,
  `mbp_price` decimal(15,0) DEFAULT NULL,
  `msp_price` decimal(15,0) DEFAULT NULL,
  `tod_qty` decimal(10,2) DEFAULT NULL,
  `mu_code` varchar(32) DEFAULT NULL,
  `mu_name` varchar(128) DEFAULT NULL,
  `td_qty` decimal(10,2) DEFAULT NULL,
  `td_outstanding` decimal(10,2) DEFAULT NULL,
  `td_status` varchar(32) DEFAULT NULL,
  `td_delivery_date` date DEFAULT NULL,
  `tod_flag` smallint(6) DEFAULT NULL,
  PRIMARY KEY (`tod_id`),
  KEY `fk_reference_26` (`to_id`),
  KEY `fk_reference_27` (`mp_id`),
  CONSTRAINT `fk_reference_26` FOREIGN KEY (`to_id`) REFERENCES `t_order` (`to_id`),
  CONSTRAINT `fk_reference_27` FOREIGN KEY (`mp_id`) REFERENCES `m_product` (`mp_id`)
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=latin1;

-- Dumping data for table db_sayur.t_order_detail: ~5 rows (approximately)
/*!40000 ALTER TABLE `t_order_detail` DISABLE KEYS */;
INSERT INTO `t_order_detail` (`tod_id`, `to_id`, `mp_id`, `mp_category`, `mp_code`, `mp_name`, `mbp_price`, `msp_price`, `tod_qty`, `mu_code`, `mu_name`, `td_qty`, `td_outstanding`, `td_status`, `td_delivery_date`, `tod_flag`) VALUES
	(1, 2, 50, 'SAYUR', 'S050', 'Bawang Merah Biasa', NULL, 5000, 12.00, 'KG', 'Kg', 12.00, 0.00, 'CLOSED', NULL, 1),
	(2, 2, 51, 'SAYUR', 'S051', 'Bawang Merah Super', NULL, 5500, 12.00, 'KG', 'Kg', 12.00, 0.00, 'CLOSED', NULL, 1),
	(3, 2, 48, 'SAYUR', 'S048', 'Bawang Putih Biasa', NULL, 7000, 12.00, 'KG', 'Kg', 12.00, 0.00, 'CLOSED', NULL, 1),
	(4, 2, 49, 'SAYUR', 'S049', 'Bawang Putih Super', NULL, 12000, 12.00, 'KG', 'Kg', 12.00, 0.00, 'CLOSED', NULL, 1),
	(5, 2, 52, 'SAYUR', 'S052', 'Asem Mentah', NULL, 12000, 12.00, 'KG', 'Kg', 12.00, 0.00, 'CLOSED', NULL, 1),
	(6, 3, 50, 'SAYUR', 'S050', 'Bawang Merah Biasa', 4500, 5000, 5.00, 'KG', 'Kg', 5.00, 0.00, 'CLOSED', NULL, 1),
	(7, 3, 51, 'SAYUR', 'S051', 'Bawang Merah Super', 5000, 5500, 5.00, 'KG', 'Kg', 5.00, 0.00, 'CLOSED', NULL, 1),
	(8, 3, 48, 'SAYUR', 'S048', 'Bawang Putih Biasa', 6000, 7000, 5.00, 'KG', 'Kg', 5.00, 0.00, 'CLOSED', NULL, 1),
	(9, 3, 52, 'SAYUR', 'S052', 'Asem Mentah', 10000, 12000, 5.00, 'KG', 'Kg', 5.00, 0.00, 'CLOSED', NULL, 1);
/*!40000 ALTER TABLE `t_order_detail` ENABLE KEYS */;


-- Dumping structure for table db_sayur.t_order_payment
CREATE TABLE IF NOT EXISTS `t_order_payment` (
  `top_id` bigint(20) NOT NULL AUTO_INCREMENT,
  `mc_id` bigint(20) DEFAULT NULL,
  `mc_name` varchar(255) DEFAULT NULL,
  `mc_code` varchar(32) DEFAULT NULL,
  `mc_address` text,
  `mc_email` varchar(128) DEFAULT NULL,
  `mc_phone1` varchar(32) DEFAULT NULL,
  `mc_fax` varchar(32) DEFAULT NULL,
  `top_no` varchar(32) DEFAULT NULL,
  `top_date` date DEFAULT NULL,
  `top_datetime_input` datetime DEFAULT NULL,
  `top_total` decimal(15,0) DEFAULT NULL,
  `to_id` bigint(20) DEFAULT NULL,
  `to_no` varchar(32) DEFAULT NULL,
  `top_payee` text,
  `top_desc` text,
  `top_flag` smallint(6) DEFAULT NULL,
  PRIMARY KEY (`top_id`),
  KEY `fk_reference_31` (`mc_id`),
  CONSTRAINT `fk_reference_31` FOREIGN KEY (`mc_id`) REFERENCES `m_customer` (`mc_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- Dumping data for table db_sayur.t_order_payment: ~0 rows (approximately)
/*!40000 ALTER TABLE `t_order_payment` DISABLE KEYS */;
/*!40000 ALTER TABLE `t_order_payment` ENABLE KEYS */;


-- Dumping structure for table db_sayur.t_order_payment_detail
CREATE TABLE IF NOT EXISTS `t_order_payment_detail` (
  `topd_id` bigint(20) NOT NULL AUTO_INCREMENT,
  `top_id` bigint(20) DEFAULT NULL,
  `to_id` bigint(20) DEFAULT NULL,
  `to_no` varchar(32) DEFAULT NULL,
  `mc_id` bigint(20) DEFAULT NULL,
  `mc_name` varchar(255) DEFAULT NULL,
  `mc_code` varchar(32) DEFAULT NULL,
  `topd_date` date DEFAULT NULL,
  `topd_deadline_payment` date DEFAULT NULL,
  `to_total` decimal(15,0) DEFAULT NULL,
  `to_outstanding` decimal(15,0) DEFAULT NULL,
  `topd_payment_amount` decimal(15,0) DEFAULT NULL,
  `topd_flag` smallint(6) DEFAULT NULL,
  PRIMARY KEY (`topd_id`),
  KEY `fk_reference_32` (`top_id`),
  CONSTRAINT `fk_reference_32` FOREIGN KEY (`top_id`) REFERENCES `t_order_payment` (`top_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- Dumping data for table db_sayur.t_order_payment_detail: ~0 rows (approximately)
/*!40000 ALTER TABLE `t_order_payment_detail` DISABLE KEYS */;
/*!40000 ALTER TABLE `t_order_payment_detail` ENABLE KEYS */;


-- Dumping structure for table db_sayur.t_purchase
CREATE TABLE IF NOT EXISTS `t_purchase` (
  `tp_id` bigint(20) NOT NULL AUTO_INCREMENT,
  `ms_id` int(11) NOT NULL,
  `tp_no` varchar(32) DEFAULT NULL,
  `tp_date` date DEFAULT NULL,
  `ms_code` varchar(128) DEFAULT NULL,
  `ms_name` varchar(255) DEFAULT NULL,
  `ms_address` text,
  `ms_phone1` varchar(64) DEFAULT NULL,
  `ms_fax` varchar(64) DEFAULT NULL,
  `ms_email` varchar(128) DEFAULT NULL,
  `mc_address` text,
  `tp_pic` varchar(128) DEFAULT NULL,
  `tp_down_payment` decimal(15,0) DEFAULT '0',
  `tp_deadline_payment` date DEFAULT NULL,
  `tp_description` text,
  `tp_subtotal` decimal(15,0) DEFAULT '0',
  `tp_disc` decimal(10,2) DEFAULT '0.00',
  `tp_disc_nominal` decimal(15,0) DEFAULT '0',
  `tp_ppn` decimal(10,2) DEFAULT '0.00',
  `tp_ppn_nominal` decimal(15,0) DEFAULT '0',
  `tp_total` decimal(15,0) DEFAULT '0',
  `tp_datetime_input` datetime DEFAULT NULL,
  `tp_status` varchar(128) DEFAULT NULL,
  `tp_status_payment` varchar(128) DEFAULT NULL,
  `tp_full_receive_date` date DEFAULT NULL,
  `tpi_no` varchar(32) DEFAULT NULL,
  `tpi_date` date DEFAULT NULL,
  `tpi_due_date` date DEFAULT NULL,
  `tp_paid_date` date DEFAULT NULL,
  `tp_flag` smallint(6) DEFAULT '0',
  PRIMARY KEY (`tp_id`),
  KEY `fk_t_purchase` (`ms_id`),
  CONSTRAINT `fk_t_purchase` FOREIGN KEY (`ms_id`) REFERENCES `m_supplier` (`ms_id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

-- Dumping data for table db_sayur.t_purchase: ~3 rows (approximately)
/*!40000 ALTER TABLE `t_purchase` DISABLE KEYS */;
INSERT INTO `t_purchase` (`tp_id`, `ms_id`, `tp_no`, `tp_date`, `ms_code`, `ms_name`, `ms_address`, `ms_phone1`, `ms_fax`, `ms_email`, `mc_address`, `tp_pic`, `tp_down_payment`, `tp_deadline_payment`, `tp_description`, `tp_subtotal`, `tp_disc`, `tp_disc_nominal`, `tp_ppn`, `tp_ppn_nominal`, `tp_total`, `tp_datetime_input`, `tp_status`, `tp_status_payment`, `tp_full_receive_date`, `tpi_no`, `tpi_date`, `tpi_due_date`, `tp_paid_date`, `tp_flag`) VALUES
	(1, 1, 'PO001/VIII/16', '2016-08-01', 'TBM', 'Toko Berkah Makmur', 'Pasar Baru', '021 1234567', NULL, 'email@email.com', NULL, 'Bpk Tigor', 0, NULL, 'tes aja', 360000, 0.00, 0, 10.00, 36000, 396000, '2016-08-01 22:50:26', 'OPEN', 'LUNAS', NULL, '', '0000-00-00', '0000-00-00', '2016-08-20', 1),
	(2, 1, 'PO002/VIII/16', '2016-08-11', 'TBM', 'Toko Berkah Makmur', 'Pasar Baru', '021 1234567', NULL, 'email@email.com', 'Jembatan 3', 'Bpk Tigor', 0, NULL, 'tes catatan', 200000, 10.00, 20000, 10.00, 18000, 198000, '2016-08-11 15:58:28', 'OPEN', 'OPEN', '2016-08-11', 'INV0001', '2016-08-11', '2016-08-12', NULL, 1),
	(3, 1, 'PO003/VIII/16', '2016-08-11', 'TBM', 'Toko Berkah Makmur', 'Pasar Baru', '021 1234567', NULL, 'email@email.com', '', 'Bpk Tigor', 0, NULL, 'tes', 1002000, 0.00, 0, 10.00, 100200, 1102200, '2016-08-12 15:02:30', 'OPEN', 'UNPAID', NULL, '', '0000-00-00', '0000-00-00', NULL, 1);
/*!40000 ALTER TABLE `t_purchase` ENABLE KEYS */;


-- Dumping structure for table db_sayur.t_purchase_detail
CREATE TABLE IF NOT EXISTS `t_purchase_detail` (
  `tpd_id` bigint(20) NOT NULL AUTO_INCREMENT,
  `tp_id` bigint(20) DEFAULT NULL,
  `mp_id` bigint(20) DEFAULT NULL,
  `mp_category` varchar(128) DEFAULT NULL,
  `mp_code` varchar(32) DEFAULT NULL,
  `mp_name` varchar(255) DEFAULT NULL,
  `mbp_price` decimal(15,0) DEFAULT NULL,
  `tpd_qty` decimal(10,2) DEFAULT '0.00',
  `tpd_delivery_date` date DEFAULT NULL,
  `mu_code` varchar(32) DEFAULT NULL,
  `mu_name` varchar(128) DEFAULT NULL,
  `trd_qty` decimal(10,2) DEFAULT '0.00',
  `tpd_outstanding` decimal(10,2) DEFAULT '0.00',
  `trd_status` varchar(128) DEFAULT NULL,
  `tpd_flag` smallint(6) DEFAULT NULL,
  PRIMARY KEY (`tpd_id`),
  KEY `fk_reference_6` (`tp_id`),
  KEY `fk_reference_7` (`mp_id`),
  CONSTRAINT `fk_reference_6` FOREIGN KEY (`tp_id`) REFERENCES `t_purchase` (`tp_id`),
  CONSTRAINT `fk_reference_7` FOREIGN KEY (`mp_id`) REFERENCES `m_product` (`mp_id`)
) ENGINE=InnoDB AUTO_INCREMENT=14 DEFAULT CHARSET=latin1;

-- Dumping data for table db_sayur.t_purchase_detail: ~13 rows (approximately)
/*!40000 ALTER TABLE `t_purchase_detail` DISABLE KEYS */;
INSERT INTO `t_purchase_detail` (`tpd_id`, `tp_id`, `mp_id`, `mp_category`, `mp_code`, `mp_name`, `mbp_price`, `tpd_qty`, `tpd_delivery_date`, `mu_code`, `mu_name`, `trd_qty`, `tpd_outstanding`, `trd_status`, `tpd_flag`) VALUES
	(1, 1, 52, 'SAYUR', 'S052', 'Asem Mentah', 10500, 10.00, '2016-08-03', 'KG', 'Kg', 10.00, 0.00, 'CLOSED', 1),
	(2, 1, 50, 'SAYUR', 'S050', 'Bawang Merah Biasa', 4500, 10.00, '2016-08-03', 'KG', 'Kg', 10.00, 0.00, 'CLOSED', 1),
	(3, 1, 51, 'SAYUR', 'S051', 'Bawang Merah Super', 5000, 10.00, '2016-08-03', 'KG', 'Kg', 10.00, 0.00, 'CLOSED', 1),
	(4, 1, 48, 'SAYUR', 'S048', 'Bawang Putih Biasa', 6000, 10.00, '2016-08-03', 'KG', 'Kg', 10.00, 0.00, 'CLOSED', 1),
	(5, 1, 49, 'SAYUR', 'S049', 'Bawang Putih Super', 10000, 10.00, '2016-08-03', 'KG', 'Kg', 5.00, 5.00, 'PENDING', 1),
	(6, 2, 52, 'SAYUR', 'S052', 'Asem Mentah', 10500, 10.00, '2016-08-12', 'KG', 'Kg', 0.00, 10.00, NULL, 1),
	(7, 2, 50, 'SAYUR', 'S050', 'Bawang Merah Biasa', 4500, 10.00, '2016-08-12', 'KG', 'Kg', 0.00, 10.00, NULL, 1),
	(8, 2, 51, 'SAYUR', 'S051', 'Bawang Merah Super', 5000, 10.00, '2016-08-12', 'KG', 'Kg', 0.00, 10.00, NULL, 1),
	(9, 2, 48, 'SAYUR', 'S048', 'Bawang Putih Biasa', 6000, 10.00, '2016-08-12', 'KG', 'Kg', 0.00, 10.00, NULL, 0),
	(10, 2, 49, 'SAYUR', 'S049', 'Bawang Putih Super', 10000, 0.00, '2016-08-12', 'KG', 'Kg', 0.00, 10.00, NULL, 0),
	(11, 3, 33, 'SAYUR', 'S033', 'Brokoli Super', 10000, 12.00, '2016-08-12', 'KG', 'Kg', 0.00, 12.00, NULL, 1),
	(12, 3, 25, 'SAYUR', 'S025', 'Buah Asem', 50000, 12.00, '2016-08-12', 'KG', 'Kg', 0.00, 12.00, NULL, 1),
	(13, 3, 23, 'SAYUR', 'S023', 'Buah Melinjo', 23500, 12.00, NULL, 'KG', 'Kg', 0.00, 12.00, NULL, 1);
/*!40000 ALTER TABLE `t_purchase_detail` ENABLE KEYS */;


-- Dumping structure for table db_sayur.t_purchase_payment
CREATE TABLE IF NOT EXISTS `t_purchase_payment` (
  `tpi_id` bigint(20) NOT NULL AUTO_INCREMENT,
  `ms_id` int(11) DEFAULT NULL,
  `ms_name` varchar(255) DEFAULT NULL,
  `ms_code` varchar(128) DEFAULT NULL,
  `ms_address` text,
  `ms_phone1` varchar(128) DEFAULT NULL,
  `ms_email` varchar(128) DEFAULT NULL,
  `ms_fax` varchar(128) DEFAULT NULL,
  `tpi_date` date DEFAULT NULL,
  `tpi_datetime_input` datetime DEFAULT NULL,
  `tpi_no` varchar(64) DEFAULT NULL,
  `tpi_total` decimal(15,0) DEFAULT '0',
  `tp_id` bigint(20) DEFAULT '0',
  `tp_no` varchar(50) DEFAULT NULL,
  `tpi_desc` text,
  `tpi_payee` text,
  `tpi_flag` smallint(6) DEFAULT '0',
  PRIMARY KEY (`tpi_id`),
  KEY `fk_reference_22` (`ms_id`),
  CONSTRAINT `fk_reference_22` FOREIGN KEY (`ms_id`) REFERENCES `m_supplier` (`ms_id`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=latin1;

-- Dumping data for table db_sayur.t_purchase_payment: ~4 rows (approximately)
/*!40000 ALTER TABLE `t_purchase_payment` DISABLE KEYS */;
INSERT INTO `t_purchase_payment` (`tpi_id`, `ms_id`, `ms_name`, `ms_code`, `ms_address`, `ms_phone1`, `ms_email`, `ms_fax`, `tpi_date`, `tpi_datetime_input`, `tpi_no`, `tpi_total`, `tp_id`, `tp_no`, `tpi_desc`, `tpi_payee`, `tpi_flag`) VALUES
	(1, 1, 'Toko Berkah Makmur', 'TBM', 'Pasar Baru', '021 1234567', 'email@email.com', NULL, '2016-08-19', '2016-08-20 21:20:10', 'PP004/VIII/16', 396000, 1, 'PO001/VIII/16', '', 'Agung', 1),
	(2, 1, 'Toko Berkah Makmur', 'TBM', 'Pasar Baru', NULL, NULL, NULL, '2016-08-19', '2016-08-19 15:49:38', 'PP002/VIII/16', 396000, 1, 'PO001/VIII/16', 'Pelunasan', 'Agung', 0),
	(6, 1, 'Toko Berkah Makmur', 'TBM', 'Pasar Baru', '021 1234567', 'email@email.com', '021 234567', '2016-08-19', '2016-08-20 21:52:32', 'PP004/VIII/16', 100000, 2, 'PO002/VIII/16', 'Lunas', 'Agung SW', 1),
	(7, 1, 'Toko Berkah Makmur', 'TBM', 'Pasar Baru', '021 1234567', 'email@email.com', NULL, '2016-08-19', '2016-08-20 21:19:44', 'PP004/VIII/16', 196000, 1, 'PO001/VIII/16', 'belum lunas', 'Agung SW', 1);
/*!40000 ALTER TABLE `t_purchase_payment` ENABLE KEYS */;


-- Dumping structure for table db_sayur.t_purchase_payment_detail
CREATE TABLE IF NOT EXISTS `t_purchase_payment_detail` (
  `tpid_id` bigint(20) NOT NULL AUTO_INCREMENT,
  `tpi_id` bigint(20) DEFAULT NULL,
  `tp_id` bigint(20) DEFAULT '0',
  `tp_no` varchar(32) DEFAULT NULL,
  `ms_id` bigint(20) DEFAULT '0',
  `ms_name` varchar(255) DEFAULT NULL,
  `ms_code` varchar(32) DEFAULT NULL,
  `tp_date` date DEFAULT NULL,
  `tp_deadline_payment` date DEFAULT NULL,
  `tp_total` decimal(15,0) DEFAULT '0',
  `tp_paid_amount` decimal(15,0) DEFAULT '0',
  `tp_outstanding` decimal(15,0) DEFAULT '0',
  `tpid_payment_amount` decimal(15,0) DEFAULT '0',
  `tpid_flag` smallint(6) DEFAULT '0',
  PRIMARY KEY (`tpid_id`),
  KEY `fk_reference_23` (`tpi_id`),
  CONSTRAINT `fk_reference_23` FOREIGN KEY (`tpi_id`) REFERENCES `t_purchase_payment` (`tpi_id`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=latin1;

-- Dumping data for table db_sayur.t_purchase_payment_detail: ~4 rows (approximately)
/*!40000 ALTER TABLE `t_purchase_payment_detail` DISABLE KEYS */;
INSERT INTO `t_purchase_payment_detail` (`tpid_id`, `tpi_id`, `tp_id`, `tp_no`, `ms_id`, `ms_name`, `ms_code`, `tp_date`, `tp_deadline_payment`, `tp_total`, `tp_paid_amount`, `tp_outstanding`, `tpid_payment_amount`, `tpid_flag`) VALUES
	(1, 1, 1, 'PO001/VIII/16', 1, 'Toko Berkah Makmur', 'TBM', '2016-08-01', '0000-00-00', 396000, 0, 0, 396000, 1),
	(2, 2, 1, 'PO001/VIII/16', 1, 'Toko Berkah Makmur', 'TBM', '2016-08-01', NULL, 196000, 0, 0, 196000, 0),
	(6, 6, 2, 'PO002/VIII/16', 1, 'Toko Berkah Makmur', 'TBM', '2016-08-11', '2016-08-12', 198000, 0, 98000, 100000, 1),
	(7, 7, 1, 'PO001/VIII/16', 1, 'Toko Berkah Makmur', 'TBM', '2016-08-01', '0000-00-00', 196000, 0, 0, 196000, 0);
/*!40000 ALTER TABLE `t_purchase_payment_detail` ENABLE KEYS */;


-- Dumping structure for table db_sayur.t_receiving
CREATE TABLE IF NOT EXISTS `t_receiving` (
  `tr_id` bigint(20) NOT NULL AUTO_INCREMENT,
  `ms_id` int(11) DEFAULT NULL,
  `tp_id` bigint(20) DEFAULT '0',
  `tp_no` varchar(32) DEFAULT NULL,
  `tr_no` varchar(32) DEFAULT NULL,
  `tr_date` date DEFAULT NULL,
  `tr_ship_date` date DEFAULT NULL,
  `tr_ship_no` varchar(128) DEFAULT NULL,
  `ms_name` varchar(255) DEFAULT NULL,
  `ms_code` varchar(128) DEFAULT NULL,
  `ms_address` text,
  `ms_phone1` varchar(32) DEFAULT NULL,
  `ms_fax` varchar(32) DEFAULT NULL,
  `ms_email` varchar(128) DEFAULT NULL,
  `tr_desc` text,
  `tr_datetime_input` datetime DEFAULT NULL,
  `tr_flag` smallint(6) DEFAULT '0',
  PRIMARY KEY (`tr_id`),
  KEY `fk_reference_19` (`ms_id`),
  CONSTRAINT `fk_reference_19` FOREIGN KEY (`ms_id`) REFERENCES `m_supplier` (`ms_id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

-- Dumping data for table db_sayur.t_receiving: ~3 rows (approximately)
/*!40000 ALTER TABLE `t_receiving` DISABLE KEYS */;
INSERT INTO `t_receiving` (`tr_id`, `ms_id`, `tp_id`, `tp_no`, `tr_no`, `tr_date`, `tr_ship_date`, `tr_ship_no`, `ms_name`, `ms_code`, `ms_address`, `ms_phone1`, `ms_fax`, `ms_email`, `tr_desc`, `tr_datetime_input`, `tr_flag`) VALUES
	(1, 1, 1, NULL, 'RI001/VIII/16', '2016-08-17', '2016-08-17', 'SJ001', 'Toko Berkah Makmur', 'TBM', 'Pasar Baru', '021 1234567', NULL, 'email@email.com', '', '2016-08-17 01:27:03', 1),
	(2, 1, 1, NULL, 'RI003/VIII/16', '2016-08-17', '2016-08-17', 'sj002', 'Toko Berkah Makmur', 'TBM', 'Pasar Baru', '021 1234567', NULL, 'email@email.com', '', '2016-08-17 01:30:28', 0),
	(3, 1, 1, NULL, 'RI002/VIII/16', '2016-08-18', '2016-08-18', '', 'Toko Berkah Makmur', 'TBM', 'Pasar Baru', '021 1234567', NULL, 'email@email.com', '', '2016-08-18 17:47:04', 0);
/*!40000 ALTER TABLE `t_receiving` ENABLE KEYS */;


-- Dumping structure for table db_sayur.t_receiving_detail
CREATE TABLE IF NOT EXISTS `t_receiving_detail` (
  `trd_id` bigint(20) NOT NULL AUTO_INCREMENT,
  `tr_id` bigint(20) DEFAULT NULL,
  `mp_id` bigint(20) DEFAULT NULL,
  `mp_code` varchar(32) DEFAULT NULL,
  `mp_category` varchar(128) DEFAULT NULL,
  `mp_name` varchar(255) DEFAULT NULL,
  `mu_code` varchar(128) DEFAULT NULL,
  `mu_name` varchar(255) DEFAULT NULL,
  `tp_id` bigint(20) DEFAULT '0',
  `tpd_id` bigint(20) DEFAULT '0',
  `tp_no` varchar(32) DEFAULT NULL,
  `mbp_price` decimal(15,0) DEFAULT '0',
  `tpd_qty` decimal(10,2) DEFAULT '0.00',
  `trd_qty` decimal(10,2) DEFAULT '0.00',
  `trd_status` varchar(32) DEFAULT NULL,
  `trd_flag` smallint(6) DEFAULT '0',
  PRIMARY KEY (`trd_id`),
  KEY `fk_reference_20` (`tr_id`),
  KEY `fk_reference_21` (`mp_id`),
  CONSTRAINT `fk_reference_20` FOREIGN KEY (`tr_id`) REFERENCES `t_receiving` (`tr_id`),
  CONSTRAINT `fk_reference_21` FOREIGN KEY (`mp_id`) REFERENCES `m_product` (`mp_id`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=latin1;

-- Dumping data for table db_sayur.t_receiving_detail: ~7 rows (approximately)
/*!40000 ALTER TABLE `t_receiving_detail` DISABLE KEYS */;
INSERT INTO `t_receiving_detail` (`trd_id`, `tr_id`, `mp_id`, `mp_code`, `mp_category`, `mp_name`, `mu_code`, `mu_name`, `tp_id`, `tpd_id`, `tp_no`, `mbp_price`, `tpd_qty`, `trd_qty`, `trd_status`, `trd_flag`) VALUES
	(1, 1, 52, 'S052', 'SAYUR', 'Asem Mentah', 'KG', 'Kg', 1, 1, 'PO001/VIII/16', 10500, 10.00, 10.00, 'CLOSED', 1),
	(2, 1, 50, 'S050', 'SAYUR', 'Bawang Merah Biasa', 'KG', 'Kg', 1, 2, 'PO001/VIII/16', 4500, 10.00, 10.00, 'CLOSED', 1),
	(3, 1, 51, 'S051', 'SAYUR', 'Bawang Merah Super', 'KG', 'Kg', 1, 3, 'PO001/VIII/16', 5000, 10.00, 10.00, 'CLOSED', 1),
	(4, 1, 48, 'S048', 'SAYUR', 'Bawang Putih Biasa', 'KG', 'Kg', 1, 4, 'PO001/VIII/16', 6000, 10.00, 10.00, 'CLOSED', 1),
	(5, 1, 49, 'S049', 'SAYUR', 'Bawang Putih Super', 'KG', 'Kg', 1, 5, 'PO001/VIII/16', 10000, 10.00, 5.00, 'PENDING', 1),
	(6, 2, 49, 'S049', 'SAYUR', 'Bawang Putih Super', 'KG', 'Kg', 1, 5, 'PO001/VIII/16', 10000, 5.00, 5.00, 'CLOSED', 0),
	(7, 3, 49, 'S049', 'SAYUR', 'Bawang Putih Super', 'KG', 'Kg', 1, 5, 'PO001/VIII/16', 10000, 5.00, 5.00, 'CLOSED', 0);
/*!40000 ALTER TABLE `t_receiving_detail` ENABLE KEYS */;


-- Dumping structure for table db_sayur.t_surat_jalan
CREATE TABLE IF NOT EXISTS `t_surat_jalan` (
  `tsj_id` bigint(20) NOT NULL,
  `ms_id` int(11) DEFAULT NULL,
  `mc_id` bigint(20) DEFAULT NULL,
  `ms_code` varchar(128) DEFAULT NULL,
  `ms_name` varchar(255) DEFAULT NULL,
  `ms_address` text,
  `ms_phone1` varchar(32) DEFAULT NULL,
  `ms_email` varchar(128) DEFAULT NULL,
  `mc_code` varchar(32) DEFAULT NULL,
  `mc_name` varchar(255) DEFAULT NULL,
  `mc_address` text,
  `mc_phone1` varchar(32) DEFAULT NULL,
  `mc_email` varchar(128) DEFAULT NULL,
  `tsj_no` varchar(32) DEFAULT NULL,
  `tsj_date` date DEFAULT NULL,
  `tsj_driver` text,
  `tsj_car_no` varchar(32) DEFAULT NULL,
  `tsj_datetime_input` datetime DEFAULT NULL,
  `tsj_flag` smallint(6) DEFAULT NULL,
  PRIMARY KEY (`tsj_id`),
  KEY `fk_reference_12` (`ms_id`),
  KEY `fk_reference_15` (`mc_id`),
  CONSTRAINT `fk_reference_12` FOREIGN KEY (`ms_id`) REFERENCES `m_supplier` (`ms_id`),
  CONSTRAINT `fk_reference_15` FOREIGN KEY (`mc_id`) REFERENCES `m_customer` (`mc_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- Dumping data for table db_sayur.t_surat_jalan: ~0 rows (approximately)
/*!40000 ALTER TABLE `t_surat_jalan` DISABLE KEYS */;
/*!40000 ALTER TABLE `t_surat_jalan` ENABLE KEYS */;


-- Dumping structure for table db_sayur.t_surat_jalan_detail
CREATE TABLE IF NOT EXISTS `t_surat_jalan_detail` (
  `tsjd_id` bigint(20) NOT NULL AUTO_INCREMENT,
  `tsj_id` bigint(20) DEFAULT NULL,
  `mp_id` bigint(20) DEFAULT NULL,
  `mp_code` varchar(32) DEFAULT NULL,
  `mp_category` varchar(128) DEFAULT NULL,
  `mp_name` varchar(255) DEFAULT NULL,
  `tsjd_qty` decimal(10,2) DEFAULT NULL,
  `mu_code` varchar(32) DEFAULT NULL,
  `mu_name` varchar(128) DEFAULT NULL,
  `tsjd_flag` smallint(6) DEFAULT NULL,
  PRIMARY KEY (`tsjd_id`),
  KEY `fk_reference_13` (`tsj_id`),
  KEY `fk_reference_14` (`mp_id`),
  CONSTRAINT `fk_reference_13` FOREIGN KEY (`tsj_id`) REFERENCES `t_surat_jalan` (`tsj_id`),
  CONSTRAINT `fk_reference_14` FOREIGN KEY (`mp_id`) REFERENCES `m_product` (`mp_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- Dumping data for table db_sayur.t_surat_jalan_detail: ~0 rows (approximately)
/*!40000 ALTER TABLE `t_surat_jalan_detail` DISABLE KEYS */;
/*!40000 ALTER TABLE `t_surat_jalan_detail` ENABLE KEYS */;


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
  `full_name` text NOT NULL,
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
INSERT INTO `users` (`user_id`, `username`, `email`, `full_name`, `auth_level`, `banned`, `passwd`, `passwd_recovery_code`, `passwd_recovery_date`, `passwd_modified_at`, `last_login`, `created_at`, `modified_at`) VALUES
	(592418686, 'admin', 'agung.sulistyo.w@gmail.com', 'Agung SW', 9, '0', '$2y$10$f89243c770cbaa450213euH4kJogm/hVzCmD9t2VjQfddWog.OE0W', '$2y$10$09e15f8c8e5fe61144f87ur5qGQl.6LYG7/Egn2eHkTdB.b1Gay8.', '2016-07-15 23:15:12', '2016-07-12 09:21:01', '2016-08-26 10:58:46', '2016-07-12 04:14:01', '2016-08-26 08:58:46'),
	(1672043320, 'skunkbot', 'skunkbot@example.com', 'Ibu Atie', 1, '0', '$2y$10$0628ec093b905f33aa2baOqLRaiTSLh8HbR7F8G3bE4Swnc7GFOPa', NULL, NULL, NULL, NULL, '2016-07-12 04:23:09', '2016-08-07 06:53:35');
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
