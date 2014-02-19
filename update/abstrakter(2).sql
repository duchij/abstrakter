-- Adminer 4.0.3 MySQL dump

SET NAMES utf8;
SET foreign_key_checks = 0;
SET time_zone = '+01:00';
SET sql_mode = 'NO_AUTO_VALUE_ON_ZERO';

DELIMITER ;;

DROP EVENT IF EXISTS `delete_inaktive__resetlinks`;;
CREATE EVENT `delete_inaktive__resetlinks` ON SCHEDULE EVERY 1 HOUR STARTS '2014-02-14 14:15:51' ON COMPLETION NOT PRESERVE ENABLE COMMENT 'zmaze neaktivne linku n reset hesla' DO DELETE FROM reset_passwd WHERE FROM_UNIXTIME(valid_until) < NOW();;

DELIMITER ;

DROP TABLE IF EXISTS `kongressdata`;
CREATE TABLE `kongressdata` (
  `item_id` bigint(20) NOT NULL AUTO_INCREMENT,
  `congress_titel` longtext COLLATE utf8_slovak_ci NOT NULL,
  `congress_subtitel` longtext COLLATE utf8_slovak_ci NOT NULL,
  `congress_url` text COLLATE utf8_slovak_ci,
  `congress_venue` longtext COLLATE utf8_slovak_ci NOT NULL,
  `congress_regfrom` date NOT NULL,
  `congress_reguntil` date NOT NULL,
  `congress_from` date NOT NULL,
  `congress_until` date NOT NULL,
  `congress_created` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`item_id`),
  UNIQUE KEY `item_id` (`item_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_slovak_ci;

INSERT INTO `kongressdata` (`item_id`, `congress_titel`, `congress_subtitel`, `congress_url`, `congress_venue`, `congress_regfrom`, `congress_reguntil`, `congress_from`, `congress_until`, `congress_created`) VALUES
(1,	'Kongres 1',	'xx',	'xx',	'xx',	'2014-02-11',	'2014-02-17',	'2014-06-19',	'2014-06-21',	'2014-02-12 10:43:24'),
(11,	'Kongres 2 trauma',	'v detskom veku',	'xx',	'xx',	'2014-03-11',	'2014-04-20',	'2014-06-19',	'2014-06-21',	'2014-02-12 10:43:39'),
(13,	'VI. MedzinÃ¡rodnÃ½ kongres Trauma v detskom veku',	'Deti a truama',	'http://trauma.kdch.sk',	'Å amorÃ­n, Hotel KormorÃ¡n',	'2014-03-11',	'2014-04-20',	'2014-06-19',	'2014-06-21',	'2014-02-13 11:22:05');

DROP TABLE IF EXISTS `registration`;
CREATE TABLE `registration` (
  `item_id` bigint(20) NOT NULL AUTO_INCREMENT,
  `user_id` bigint(20) NOT NULL,
  `congress_id` bigint(20) NOT NULL,
  `participation` enum('aktiv','pasiv','visit') CHARACTER SET ascii COLLATE ascii_bin NOT NULL DEFAULT 'pasiv',
  `abstract_titul` longtext COLLATE utf8_slovak_ci,
  `abstract_main_autor` text COLLATE utf8_slovak_ci,
  `abstract_autori` longtext COLLATE utf8_slovak_ci,
  `abstract_adresy` longtext COLLATE utf8_slovak_ci,
  `abstract_text` longtext COLLATE utf8_slovak_ci,
  `abstract_created` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`item_id`),
  UNIQUE KEY `item_id_user_id_congress_id` (`item_id`,`user_id`,`congress_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_slovak_ci;

INSERT INTO `registration` (`item_id`, `user_id`, `congress_id`, `participation`, `abstract_titul`, `abstract_main_autor`, `abstract_autori`, `abstract_adresy`, `abstract_text`, `abstract_created`) VALUES
(6,	26,	13,	'aktiv',	'Sinus pilonidalis a jeho rieÅ¡enie',	'Duchaj B.,',	'OmanÃ­k P.,',	'KDCH',	'Sinus je taka hlupost ale robÃ­ chlatÃº riÅ¥',	'2014-02-13 11:54:17');

DROP TABLE IF EXISTS `reset_passwd`;
CREATE TABLE `reset_passwd` (
  `item_id` bigint(20) NOT NULL AUTO_INCREMENT,
  `email` text,
  `reset_link` longtext,
  `valid_from` int(11) DEFAULT NULL,
  `valid_until` int(11) DEFAULT NULL,
  `created` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`item_id`),
  UNIQUE KEY `email` (`email`(250))
) ENGINE=InnoDB DEFAULT CHARSET=ascii;

INSERT INTO `reset_passwd` (`item_id`, `email`, `reset_link`, `valid_from`, `valid_until`, `created`) VALUES
(6,	'bduchaj@gmail.com',	'aea0b74d0f8ead62cff4e1ff6e3cf866f8e1bb97',	1392386154,	1392472554,	'2014-02-14 14:55:54');

DROP TABLE IF EXISTS `users`;
CREATE TABLE `users` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `email` text CHARACTER SET ascii NOT NULL,
  `password` text CHARACTER SET ascii NOT NULL,
  `account` enum('admin','user') CHARACTER SET ascii NOT NULL DEFAULT 'user',
  `timestamp` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  UNIQUE KEY `email` (`email`(100))
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_slovak_ci;

INSERT INTO `users` (`id`, `email`, `password`, `account`, `timestamp`) VALUES
(10,	'bduchaj@gmail.com',	'4124bc0a9335c27f086f24ba207a4912',	'admin',	'2014-02-13 10:14:34'),
(23,	'xx@xx.sk',	'4124bc0a9335c27f086f24ba207a4912',	'user',	'2014-02-10 20:54:19'),
(24,	'zz@zz.sk',	'4124bc0a9335c27f086f24ba207a4912',	'user',	'2014-02-13 10:39:35'),
(27,	'boris.duchaj@dfnsp.sk',	'4124bc0a9335c27f086f24ba207a4912',	'user',	'2014-02-14 12:00:56');

DROP TABLE IF EXISTS `usersdata`;
CREATE TABLE `usersdata` (
  `user_id` bigint(20) NOT NULL,
  `titul_pred` text COLLATE utf8_slovak_ci,
  `meno` text COLLATE utf8_slovak_ci,
  `priezvisko` text COLLATE utf8_slovak_ci,
  `titul_za` text COLLATE utf8_slovak_ci,
  `adresa` longtext COLLATE utf8_slovak_ci,
  `contact_email` text COLLATE utf8_slovak_ci NOT NULL,
  `created` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  UNIQUE KEY `user_id` (`user_id`),
  CONSTRAINT `usersdata_ibfk_2` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_slovak_ci;

INSERT INTO `usersdata` (`user_id`, `titul_pred`, `meno`, `priezvisko`, `titul_za`, `adresa`, `contact_email`, `created`) VALUES
(10,	'MUDr.',	'Boris',	'Duchaj',	'PhD.,',	'Klinika detskej chirugie LF UK a DFNsP\r\nLimbovÃ¡ 1\r\n833 40 Bratislava',	'bduchaj@gmail.com',	'2014-02-12 14:25:37'),
(23,	'toto je husrea',	'lkjfkdjfdlk',	'nlakjdslk',	'lskjdlkjdlk',	'lsdlakjdslkdj',	'xx@xx.sk',	'2014-02-10 20:54:40'),
(27,	NULL,	NULL,	NULL,	NULL,	NULL,	'boris.duchaj@dfnsp.sk',	'2014-02-14 12:00:56');

-- 2014-02-14 15:11:27
