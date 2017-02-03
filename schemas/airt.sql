-- phpMyAdmin SQL Dump
-- version 4.0.10deb1
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Feb 03, 2017 at 03:20 PM
-- Server version: 5.5.54-0ubuntu0.14.04.1
-- PHP Version: 5.5.9-1ubuntu4.20

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `airt`
--

-- --------------------------------------------------------

--
-- Table structure for table `company`
--

CREATE TABLE IF NOT EXISTS `company` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(70) NOT NULL,
  `telephone` varchar(30) NOT NULL,
  `address` varchar(40) NOT NULL,
  `city` varchar(40) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=4 ;

--
-- Dumping data for table `company`
--

INSERT INTO `company` (`id`, `name`, `telephone`, `address`, `city`) VALUES
(1, 'Asentria Corp.', '206.344.8800', '1200 N. 96th St. Seattle WA 98103', 'Seattle'),
(2, 'Seattle 123', '206.344.8800', '1200 N. 96th St. Seattle WA 98103', 'Seattle'),
(3, 'Acme Inc', '+44 564612345', 'Guildhall, PO Box 270, London', 'London');


-- --------------------------------------------------------

--
-- Table structure for table `project`
--

CREATE TABLE IF NOT EXISTS `project` (
  `id` int(32) NOT NULL AUTO_INCREMENT,
  `company_id` int(10) unsigned NOT NULL,
  `name` varchar(80) NOT NULL,
  `project_id` varchar(32) NOT NULL,
  `active` enum('Y','N') NOT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_project_company_idx` (`company_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=12 ;

--
-- Dumping data for table `project`
--

INSERT INTO `project` (`id`, `company_id`, `name`, `project_id`, `active`) VALUES
(1, 3, 'Seattle Site', '98103123', 'Y'),
(2, 3, 'Tacoma Site', '98408123', 'Y'),
(3, 2, 'Federal Way Site', '1234567890', 'Y'),
(4, 2, 'Lakewood Site', '9876543210', 'Y'),
(5, 2, 'Tacoma Dome Site', '3265778', 'Y'),
(6, 2, 'Seattle Convention Center Site', '217835457', 'Y'),
(7, 3, 'Project Atlanta 123456', '098765', 'Y'),
(8, 2, 'Project Chicago', '23746', 'Y'),
(9, 2, 'Houston', '1313543', 'Y'),
(10, 2, 'Project 100', '100', 'Y'),
(11, 2, 'Project 101', '101', 'Y');

-- --------------------------------------------------------

--
-- Table structure for table `siteboss`
--

CREATE TABLE IF NOT EXISTS `siteboss` (
  `id` int(32) NOT NULL AUTO_INCREMENT,
  `project_id` int(32) NOT NULL,
  `SiteName` varchar(50) NOT NULL,
  `ProjectCode` varchar(50) NOT NULL,
  `VendorCode` varchar(6) NOT NULL,
  `VendorPonum` varchar(25) NOT NULL,
  `VendorInvoicenum` varchar(25) NOT NULL,
  `SiteID` varchar(20) NOT NULL,
  `EquipmentRelease` varchar(50) NOT NULL,
  `Switch` varchar(50) NOT NULL,
  `CellNumber` varchar(50) NOT NULL,
  `Latitude` varchar(50) NOT NULL,
  `Longitude` varchar(50) NOT NULL,
  `Address` varchar(50) NOT NULL,
  `City` varchar(50) NOT NULL,
  `State` varchar(50) NOT NULL,
  `ZIP` varchar(50) NOT NULL,
  `County` varchar(50) NOT NULL,
  `CellTech` varchar(50) NOT NULL,
  `PhoneNumber` varchar(50) NOT NULL,
  `Email` varchar(50) NOT NULL,
  `SiteBossIP` varchar(50) NOT NULL,
  `Subnet` varchar(50) NOT NULL,
  `Gateway` varchar(50) NOT NULL,
  `RouterPort` varchar(50) NOT NULL,
  `AccessDirections` varchar(50) NOT NULL,
  `SiteNotes` blob NOT NULL,
  `PowerPlant` varchar(50) NOT NULL,
  `PowerPlantMonitored` varchar(10) NOT NULL,
  `PowerPlantIP` varchar(50) NOT NULL,
  `PowerPlantComment` varchar(250) NOT NULL,
  `HVAC` varchar(50) NOT NULL,
  `HVACMonitored` varchar(10) NOT NULL,
  `HVACIP` varchar(50) NOT NULL,
  `HVACComment` varchar(250) NOT NULL,
  `ATSType` varchar(50) NOT NULL,
  `ATSComment` varchar(250) NOT NULL,
  `GeneratorRunSchedule` varchar(50) NOT NULL,
  `GenType` varchar(50) NOT NULL,
  `GenModel` varchar(50) NOT NULL,
  `FuelType` varchar(50) NOT NULL,
  `FuelGaugeType` varchar(50) NOT NULL,
  `FuseorBreaker` varchar(50) NOT NULL,
  `CompletionDate` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `CompletionName` varchar(50) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_siteboss_project_idx` (`project_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=3 ;

--
-- Dumping data for table `siteboss`
--

INSERT INTO `siteboss` (`id`, `project_id`, `SiteName`, `ProjectCode`, `VendorCode`, `VendorPonum`, `VendorInvoicenum`, `SiteID`, `EquipmentRelease`, `Switch`, `CellNumber`, `Latitude`, `Longitude`, `Address`, `City`, `State`, `ZIP`, `County`, `CellTech`, `PhoneNumber`, `Email`, `SiteBossIP`, `Subnet`, `Gateway`, `RouterPort`, `AccessDirections`, `SiteNotes`, `PowerPlant`, `PowerPlantMonitored`, `PowerPlantIP`, `PowerPlantComment`, `HVAC`, `HVACMonitored`, `HVACIP`, `HVACComment`, `ATSType`, `ATSComment`, `GeneratorRunSchedule`, `GenType`, `GenModel`, `FuelType`, `FuelGaugeType`, `FuseorBreaker`, `CompletionDate`, `CompletionName`) VALUES
(1, 5, 'Alvin SiteBoss', '45265778', '145322', '4354334565', '243245324366', '4343567685', 'Equipment Release', 'Switch', '253-999-8888', '10''20''45''', '10''20''20''', '99 Nevermind St.', 'Tacoma', 'WA', '98408', 'USA', 'Bob Celltech', '253-765-4321', 'alvin@asentria.com', '192.168.100.246', '255.255.255.0', '192.168.23.123', '192.222.111', 'Follow', '', 'There is a power plant', '2134AJ', '10.10.5.13', 'No comment for the power plant', 'HVAC FIELD', 'Monitored', '10.10.2.32', 'No comment for hvac.', 'ATS Type OKAY', 'No comment for ATS', 'M W TH F SAT SUN', 'GAS', '123-876XP', 'GAS', 'Analog', 'F', '2017-02-03 22:16:15', 'Alvin'),
(2, 4, 'Alvin 2 SiteBoss', '45265778', '145322', '4354334565', '243245324366', '4343567685', 'Equipment Release', 'Switch', '253-999-8888', '10''20''45''', '10''20''20''', '99 Nevermind St.', 'Tacoma', 'WA', '98408', 'USA', 'Bob Celltech', '253-765-4321', 'alvin@asentria.com', '192.168.100.246', '255.255.255.0', '192.168.23.123', '192.222.111', 'Follow', '', 'There is a power plant', '2134AJ', '10.10.5.13', 'No comment for the power plant', 'HVAC FIELD', 'Monitored', '10.10.2.32', 'No comment for hvac.', 'ATS Type OKAY', 'No comment for ATS', 'M W TH F SAT SUN', 'GAS', '123-876XP', 'GAS', 'Analog', 'F', '2017-01-27 07:43:56', 'Alvin');

-- --------------------------------------------------------

--
-- Table structure for table `test`
--

CREATE TABLE IF NOT EXISTS `test` (
  `id` int(10) unsigned NOT NULL,
  `name` varchar(10) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `test`
--

INSERT INTO `test` (`id`, `name`) VALUES
(1, 'one'),
(2, 'two');

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE IF NOT EXISTS `user` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `username` varchar(32) NOT NULL,
  `password` char(255) NOT NULL,
  `name` varchar(120) NOT NULL,
  `email` varchar(70) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `active` char(1) NOT NULL,
  `role` enum('U','A') NOT NULL DEFAULT 'U',
  `company_id` int(10) unsigned NOT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_user_company_idx` (`company_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=16 ;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id`, `username`, `password`, `name`, `email`, `created_at`, `active`, `role`, `company_id`) VALUES
(1, 'demo', '$2y$10$rxr/9Rdl2i4JzlBDiYyfSef4zL3Om2nh3bLlqToFwoopcxqhugCZe', 'Phalcon Demo', 'demo@phalconphp.com', '2012-04-11 10:53:03', 'Y', 'U', 3),
(2, 'alvin', '$2y$10$rxr/9Rdl2i4JzlBDiYyfSef4zL3Om2nh3bLlqToFwoopcxqhugCZe', 'Alvin Bee', 'alvin@bee.com', '2017-01-24 02:18:51', 'Y', 'A', 1),
(3, 'simon', '2y$10$rxr/9Rdl2i4JzlBDiYyfSef4zL3Om2nh3bLlqToFwoopcxqhugCZe', 'Simon Bee', 'simon@phalconphp.com', '2012-04-11 10:53:03', 'Y', 'U', 3),
(4, 'theodore', '$2y$10$rxr/9Rdl2i4JzlBDiYyfSef4zL3Om2nh3bLlqToFwoopcxqhugCZe', 'Theodore Bee', 'theodore@bee.com', '2017-01-24 02:18:51', 'Y', 'U', 2),
(5, 'sydney', '$2y$10$X2PEfDT7lWwZ9FfYcVkADeRAs2aptA3L0rlTWlJ1VEIu82hB/KheK', 'Sydney Bee', 'sydney@bee.com', '2017-01-25 03:43:40', 'Y', 'U', 3),
(6, 'corn', '$2y$10$ljyizSr3LKjuoscQDrkdreoJj7fyPXPiFu2G23c4qDjX3l48Y1qEa', 'Corn Bee', 'corn@bee.com', '2017-01-25 05:18:54', 'Y', 'U', 2),

--
-- Constraints for dumped tables
--

--
-- Constraints for table `project`
--
ALTER TABLE `project`
  ADD CONSTRAINT `fk_project_company` FOREIGN KEY (`company_id`) REFERENCES `company` (`id`);

--
-- Constraints for table `siteboss`
--
ALTER TABLE `siteboss`
  ADD CONSTRAINT `fk_siteboss_project` FOREIGN KEY (`project_id`) REFERENCES `project` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
