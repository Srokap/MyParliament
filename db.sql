-- --------------------------------------------------------
-- Host:                         127.0.0.1
-- Server version:               5.1.33-community - MySQL Community Server (GPL)
-- Server OS:                    Win32
-- HeidiSQL version:             7.0.0.4053
-- Date/time:                    2013-01-29 10:31:28
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8 */;
/*!40014 SET FOREIGN_KEY_CHECKS=0 */;

-- Dumping database structure for ochparliament_local
CREATE DATABASE IF NOT EXISTS `ochparliament_local` /*!40100 DEFAULT CHARACTER SET utf8 */;
USE `ochparliament_local`;


-- Dumping structure for table ochparliament_local.m_users
CREATE TABLE IF NOT EXISTS `m_users` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `fb_id` bigint(20) NOT NULL DEFAULT '0',
  `name` varchar(300) COLLATE utf8_polish_ci NOT NULL,
  `first_name` varchar(200) COLLATE utf8_polish_ci NOT NULL,
  `last_name` varchar(200) COLLATE utf8_polish_ci NOT NULL,
  `link` varchar(300) COLLATE utf8_polish_ci NOT NULL,
  `username` varchar(200) COLLATE utf8_polish_ci NOT NULL,
  `gender` varchar(50) COLLATE utf8_polish_ci NOT NULL,
  `email` varchar(200) COLLATE utf8_polish_ci NOT NULL,
  `email_verified` enum('0','1','2','3','4','5') COLLATE utf8_polish_ci NOT NULL DEFAULT '0',
  `group` int(11) NOT NULL DEFAULT '0',
  `registration_time` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `update_time` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `type` enum('sm','fb') COLLATE utf8_polish_ci NOT NULL,
  `expires` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `token` char(90) CHARACTER SET ascii COLLATE ascii_bin NOT NULL,
  `login_hash` char(40) CHARACTER SET ascii COLLATE ascii_bin NOT NULL,
  `bd_date` date NOT NULL DEFAULT '0000-00-00',
  `postal_code` varchar(6) COLLATE utf8_polish_ci NOT NULL,
  `email_pass` varchar(32) COLLATE utf8_polish_ci NOT NULL,
  `remember_me` enum('0','1') COLLATE utf8_polish_ci NOT NULL DEFAULT '0',
  `reg_ip` varchar(16) COLLATE utf8_polish_ci NOT NULL,
  `cookie_load_timestamp` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `fb_app_id` bigint(20) NOT NULL,
  `pass_recover` varchar(32) COLLATE utf8_polish_ci NOT NULL,
  `pass_recover_ts` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `is_active` enum('0','1') COLLATE utf8_polish_ci NOT NULL DEFAULT '1',
  `is_deleted` enum('0','1') COLLATE utf8_polish_ci NOT NULL DEFAULT '0',
  `deleted_ts` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `api_secret` varchar(32) COLLATE utf8_polish_ci NOT NULL,
  `api_key` varchar(32) COLLATE utf8_polish_ci NOT NULL,
  `api_count` int(11) unsigned NOT NULL DEFAULT '0',
  `api_total_count` int(11) unsigned NOT NULL DEFAULT '0',
  `news_email_freq` enum('0','1','2','3') COLLATE utf8_polish_ci NOT NULL DEFAULT '2',
  PRIMARY KEY (`id`),
  UNIQUE KEY `fb_id` (`fb_id`,`email`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8 COLLATE=utf8_polish_ci;

-- Dumping data for table ochparliament_local.m_users: ~1 rows (approximately)
/*!40000 ALTER TABLE `m_users` DISABLE KEYS */;
INSERT INTO `m_users` (`id`, `fb_id`, `name`, `first_name`, `last_name`, `link`, `username`, `gender`, `email`, `email_verified`, `group`, `registration_time`, `update_time`, `type`, `expires`, `token`, `login_hash`, `bd_date`, `postal_code`, `email_pass`, `remember_me`, `reg_ip`, `cookie_load_timestamp`, `fb_app_id`, `pass_recover`, `pass_recover_ts`, `is_active`, `is_deleted`, `deleted_ts`, `api_secret`, `api_key`, `api_count`, `api_total_count`, `news_email_freq`) VALUES
	(1, 0, '', '', '', '', 'admin', '', 'admin@ochparliament.pl', '3', 2, '2013-01-22 00:00:00', '2013-01-22 00:00:00', 'sm', '0000-00-00 00:00:00', 'J0;9I>O0MS01MANYYIW0??9X95NX?WZO766GCSQ4IAZI@U>P9LYRWQBCRLTXP=RZ46@QN882UV=1D8?BTJACS31TQ3', '0bacd04db92672e14d9924bed97e960f61924d0b', '0000-00-00', '', '', '0', '', '0000-00-00 00:00:00', 0, '', '0000-00-00 00:00:00', '1', '0', '0000-00-00 00:00:00', '', '', 0, 0, '2');
/*!40000 ALTER TABLE `m_users` ENABLE KEYS */;
/*!40014 SET FOREIGN_KEY_CHECKS=1 */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
