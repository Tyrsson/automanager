-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3307
-- Generation Time: Nov 02, 2023 at 05:36 AM
-- Server version: 10.10.2-MariaDB
-- PHP Version: 8.2.0

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `automanager`
--

-- --------------------------------------------------------

--
-- Table structure for table `owner`
--

DROP TABLE IF EXISTS `owner`;
CREATE TABLE IF NOT EXISTS `owner` (
  `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `userId` int(10) UNSIGNED NOT NULL,
  `vehicleId` int(10) UNSIGNED NOT NULL,
  PRIMARY KEY (`id`),
  KEY `FK_user_table_userId` (`userId`),
  KEY `FK_vehicle_table_id` (`vehicleId`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci COMMENT='lookup table between user and vehicle';

-- --------------------------------------------------------

--
-- Table structure for table `manufacturer`
--

DROP TABLE IF EXISTS `manufacturer`;
CREATE TABLE IF NOT EXISTS `manufacturer` (
  `manufacturerId` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `manufacturerName` varchar(100) NOT NULL,
  `country` varchar(100) NOT NULL,
  PRIMARY KEY (`manufacturerId`),
  KEY `manu_country` (`country`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci COMMENT='Manufacturer Data';

-- --------------------------------------------------------

--
-- Table structure for table `model`
--

DROP TABLE IF EXISTS `model`;
CREATE TABLE IF NOT EXISTS `model` (
  `modelId` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `manufacturerId` int(11) NOT NULL,
  `modelName` varchar(100) NOT NULL,
  `year` int(4) NOT NULL,
  PRIMARY KEY (`modelId`),
  KEY `FK_manufacturerId` (`manufacturerId`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci COMMENT='Model table with FK to manufacturer table';

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

DROP TABLE IF EXISTS `user`;
CREATE TABLE IF NOT EXISTS `user` (
  `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `email` varchar(350) NOT NULL,
  `password` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `vehicle`
--

DROP TABLE IF EXISTS `vehicle`;
CREATE TABLE IF NOT EXISTS `vehicle` (
  `vehicleId` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `manufacturerId` int(10) UNSIGNED NOT NULL,
  `modelId` int(10) UNSIGNED NOT NULL,
  `vin` varchar(17) NOT NULL,
  PRIMARY KEY (`vehicleId`),
  KEY `FK_manufacturerId` (`manufacturerId`),
  KEY `FK_modeltable_id` (`modelId`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci COMMENT='Holds individual vehicle records';

--
-- Indexes for dumped tables
--

--
-- Indexes for table `manufacturer`
--
ALTER TABLE `manufacturer` ADD FULLTEXT KEY `name_index` (`manufacturerName`);

--
-- Indexes for table `model`
--
ALTER TABLE `model` ADD FULLTEXT KEY `model_name` (`modelName`);

--
-- Indexes for table `vehicle`
--
ALTER TABLE `vehicle` ADD FULLTEXT KEY `vehicle_vin` (`vin`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
