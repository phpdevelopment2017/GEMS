-- Adminer 4.3.1 MySQL dump

SET NAMES utf8;
SET time_zone = '+00:00';
SET foreign_key_checks = 0;
SET sql_mode = 'NO_AUTO_VALUE_ON_ZERO';

DROP TABLE IF EXISTS `sponsor`;
CREATE TABLE `sponsor` (
  `sponsor_id` bigint(20) NOT NULL AUTO_INCREMENT,
  `sponsor_name` varchar(100) NOT NULL,
  `sponsorship_type` tinyint(1) NOT NULL,
  `address` text NOT NULL,
  `phone_number` varchar(20) NOT NULL,
  `email` varchar(100) NOT NULL,
  `website` varchar(100) NOT NULL,
  `cost_per_year` decimal(14,2) NOT NULL,
  `created_time` datetime NOT NULL,
  `updated_time` datetime NOT NULL,
  `is_delete` tinyint(1) NOT NULL,
  PRIMARY KEY (`sponsor_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

INSERT INTO `sponsor` (`sponsor_id`, `sponsor_name`, `sponsorship_type`, `address`, `phone_number`, `email`, `website`, `cost_per_year`, `created_time`, `updated_time`, `is_delete`) VALUES
(1,	'Vishal Solanki',	1,	'260, Abhaynagar',	'9726952651',	'v.a.solanki0000@gmail.com',	'',	1500.00,	'0000-00-00 00:00:00',	'0000-00-00 00:00:00',	0),
(2,	'DM',	3,	'',	'9712887017',	'dm@gmail.com',	'',	6500.00,	'0000-00-00 00:00:00',	'0000-00-00 00:00:00',	1);

DROP TABLE IF EXISTS `subscription`;
CREATE TABLE `subscription` (
  `subscription_id` bigint(20) NOT NULL AUTO_INCREMENT,
  `subscription_email` varchar(100) NOT NULL,
  `subscription_time` datetime NOT NULL,
  `is_delete` tinyint(1) NOT NULL,
  PRIMARY KEY (`subscription_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

INSERT INTO `subscription` (`subscription_id`, `subscription_email`, `subscription_time`, `is_delete`) VALUES
(1,	'v.a.solanki0000@gmail.com',	'2017-11-25 15:14:06',	0);

-- 2017-11-25 13:31:33
