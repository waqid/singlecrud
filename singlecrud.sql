-- Adminer 4.3.1 MySQL dump

SET NAMES utf8;
SET time_zone = '+07:00';

DROP DATABASE IF EXISTS `singlecrud`;
CREATE DATABASE `singlecrud` /*!40100 DEFAULT CHARACTER SET latin1 */;
USE `singlecrud`;

SET NAMES utf8mb4;

DROP TABLE IF EXISTS `todo`;
CREATE TABLE `todo` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `task` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;


-- 2018-03-23 12:45:00
