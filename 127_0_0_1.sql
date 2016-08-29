-- phpMyAdmin SQL Dump
-- version 4.5.5.1
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Aug 16, 2016 at 11:13 AM
-- Server version: 5.7.11
-- PHP Version: 5.6.19

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `monitoring`
--
CREATE DATABASE IF NOT EXISTS `monitoring` DEFAULT CHARACTER SET latin1 COLLATE latin1_swedish_ci;
USE `monitoring`;

-- --------------------------------------------------------

--
-- Table structure for table `accountdetails`
--

CREATE TABLE `accountdetails` (
  `AccID` int(10) UNSIGNED NOT NULL,
  `AccName` varchar(45) NOT NULL DEFAULT '0',
  `SecretKey` varchar(45) NOT NULL DEFAULT '0',
  `AccessKey` varchar(45) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `accountdetails`
--

INSERT INTO `accountdetails` VALUES
(102401, 'S MICHAEL', 'KYNHGE56', 'NHEATY58'),
(102402, 'N PAUL', 'JRHGK78', 'KSDDJKGR78'),
(102403, 'K SINHA', 'KJF78', 'MKJ78'),
(102404, 'M GHOSH', 'LAFIJL78', 'JHUFQE58'),
(102405, 'KJK KUPTA', 'EW89', 'EW589'),
(102406, 'H AGARWAL', 'EKFJIG78', 'KJWJG78'),
(102407, 'N SRIVASTAVA', 'KKJAFUIU', 'QDYT89'),
(102408, 'R SHARMA', 'AWRR78', 'EWEG58'),
(102409, 'A SINHA', 'DFEE78', 'AV969'),
(102410, 'G VARSHNEY', 'DFWRG', 'QWRF58'),
(102411, 'S VAIDYA', 'ADASF78', 'FQEBB589'),
(102412, 'A RAJ', 'SCANCJKJ7', 'DSSV89'),
(102413, 'R SAXENA', 'QQE89', 'WDQWF58'),
(102414, 'S GUPTA', 'HWQDU78', 'DWQF87'),
(102415, 'P SINGH', 'JDAWI78', 'FWQF58'),
(102416, 'S NAKUL', 'SDW78', 'FWF87'),
(102417, 'G RAHUL', 'DQW8', 'DWQF58'),
(102418, 'R DILSHAD', 'WDWF87', 'QWD78'),
(102419, 'M KHAN', 'SAWF78', 'DWF58'),
(102420, 'G HUSSAIN', '8789', '5699'),
(102421, 'A RAJA', 'DQWD87', '0');

-- --------------------------------------------------------

--
-- Table structure for table `cpu_util`
--

CREATE TABLE `cpu_util` (
  `TimeStamp` datetime NOT NULL DEFAULT '2000-01-01 00:00:00',
  `CPU_util` int(10) UNSIGNED NOT NULL,
  `InstanceID` varchar(45) NOT NULL,
  `SSID` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `cpu_util`
--

INSERT INTO `cpu_util` VALUES
('2016-07-01 05:00:00', 30, 'i-41201601', 1),
('2016-07-01 05:05:00', 38, 'i-41201601', 2),
('2016-07-01 05:10:00', 26, 'i-41201601', 3),
('2016-07-01 05:15:00', 42, 'i-41201601', 4),
('2016-07-01 05:20:00', 46, 'i-41201601', 5),
('2016-07-01 05:25:00', 51, 'i-41201601', 6),
('2016-07-01 05:30:00', 38, 'i-41201601', 7),
('2016-07-01 05:40:00', 26, 'i-41201601', 8),
('2016-07-01 05:00:00', 36, 'i-478906', 9),
('2016-07-01 05:05:00', 34, 'i-691235', 11),
('2016-07-01 05:10:00', 38, 'i-478906', 12),
('2016-07-01 05:15:00', 40, 'i-478906', 13),
('2016-07-01 05:20:00', 30, 'i-478906', 14),
('2016-07-01 05:25:00', 32, 'i-478906', 15),
('2016-07-01 05:30:00', 28, 'i-478906', 16),
('2016-07-01 05:35:00', 24, 'i-478906', 17),
('2016-07-01 05:40:00', 36, 'i-478906', 18),
('2016-07-01 05:00:00', 30, 'i-87459', 19),
('2016-07-01 05:05:00', 32, 'i-87459', 20),
('2016-07-01 05:10:00', 31, 'i-87459', 21),
('2016-07-01 05:15:00', 26, 'i-87459', 22),
('2016-07-01 05:20:00', 36, 'i-87459', 23),
('2016-07-01 05:25:00', 31, 'i-87459', 24),
('2016-07-01 05:30:00', 28, 'i-87459', 25),
('2016-07-01 05:35:00', 42, 'i-87459', 26);

-- --------------------------------------------------------

--
-- Table structure for table `instances`
--

CREATE TABLE `instances` (
  `InstanceID` varchar(45) NOT NULL DEFAULT '0',
  `Type` varchar(45) NOT NULL,
  `Zone` varchar(45) NOT NULL,
  `Status` varchar(45) NOT NULL DEFAULT 'RUNNING',
  `CompanyIP` varchar(45) NOT NULL,
  `PrivateIP` varchar(45) NOT NULL,
  `AccID` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `instances`
--

INSERT INTO `instances` VALUES
('i-41201601', 't2.small', 'ap-south-1', 'RUNNING', '127.62.0.0', '192.168.1.1', 102401),
('i-478906', 'm2.small', 'ap-south-1', 'RUNNING', '129.45.3.1', '192.168.2.3', 102401),
('i-691235', 'm1.small', 'sp-east-1', 'RUNNING', '127.168.1.1', '192.124.1.1', 102402),
('i-87459', 't3.large', 'ap-south-2', 'RUNNING', '127.15.0.1', '192.168.1.5', 102401),
('i-879658', 'm2.small', 'ap-south-2', 'RUNNING', '126.14.0.1', '192.168.3.2', 102401),
('i-986589', 't2.large', 'ap-north-2', 'RUNNING', '132.32.0.1', '192.169.1.1', 102401),
('i-98769', 't1.small', 'ap-north-1', 'RUNNING', '127.36.0.1', '192.168.1.1', 102401);

-- --------------------------------------------------------

--
-- Table structure for table `loginmaster`
--

CREATE TABLE `loginmaster` (
  `LoginID` int(10) UNSIGNED NOT NULL DEFAULT '0',
  `Name` varchar(45) NOT NULL DEFAULT '',
  `Password` varchar(45) NOT NULL DEFAULT '',
  `Privilege` varchar(45) NOT NULL DEFAULT 'CUSTOMER',
  `EmailID` varchar(45) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `loginmaster`
--

INSERT INTO `loginmaster` VALUES
(201601, 'Abhinav Sinha', 'adminadmin', 'ADMIN', 'av9abby@gmail.com'),
(201602, 'Gaurav Varshney', 'adminadmin', 'ADMIN', 'gauravvarshney221@gmail.com');

-- --------------------------------------------------------

--
-- Table structure for table `networkdetails`
--

CREATE TABLE `networkdetails` (
  `TimeStamp` datetime NOT NULL DEFAULT '2000-01-01 00:00:00',
  `NWin` int(10) UNSIGNED NOT NULL,
  `NWout` int(10) UNSIGNED NOT NULL,
  `InstanceID` varchar(45) NOT NULL DEFAULT '0',
  `SSID` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `networkdetails`
--

INSERT INTO `networkdetails` VALUES
('2016-07-01 05:00:00', 20000, 90000, 'i-41201601', 1),
('2016-07-01 05:05:00', 25000, 92000, 'i-41201601', 2),
('2016-07-01 05:10:00', 26000, 96000, 'i-41201601', 3),
('2016-07-01 05:15:00', 30000, 91000, 'i-41201601', 4),
('2016-07-01 05:20:00', 18000, 70000, 'i-41201601', 5),
('2016-07-01 05:25:00', 26000, 80000, 'i-41201601', 6),
('2016-07-01 05:30:00', 22500, 60000, 'i-41201601', 7),
('2016-07-01 05:35:00', 12000, 45000, 'i-41201601', 8);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `accountdetails`
--
ALTER TABLE `accountdetails`
  ADD PRIMARY KEY (`AccID`);

--
-- Indexes for table `cpu_util`
--
ALTER TABLE `cpu_util`
  ADD PRIMARY KEY (`SSID`),
  ADD KEY `InstanceID` (`InstanceID`);

--
-- Indexes for table `instances`
--
ALTER TABLE `instances`
  ADD PRIMARY KEY (`InstanceID`),
  ADD KEY `AccID` (`AccID`);

--
-- Indexes for table `loginmaster`
--
ALTER TABLE `loginmaster`
  ADD PRIMARY KEY (`LoginID`) USING BTREE;

--
-- Indexes for table `networkdetails`
--
ALTER TABLE `networkdetails`
  ADD PRIMARY KEY (`SSID`) USING BTREE,
  ADD KEY `NW_Instances` (`InstanceID`) USING BTREE;

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `accountdetails`
--
ALTER TABLE `accountdetails`
  MODIFY `AccID` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=102422;
--
-- AUTO_INCREMENT for table `cpu_util`
--
ALTER TABLE `cpu_util`
  MODIFY `SSID` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=27;
--
-- AUTO_INCREMENT for table `networkdetails`
--
ALTER TABLE `networkdetails`
  MODIFY `SSID` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;
--
-- Constraints for dumped tables
--

--
-- Constraints for table `cpu_util`
--
ALTER TABLE `cpu_util`
  ADD CONSTRAINT `InstanceID` FOREIGN KEY (`InstanceID`) REFERENCES `instances` (`InstanceID`);

--
-- Constraints for table `instances`
--
ALTER TABLE `instances`
  ADD CONSTRAINT `AccID` FOREIGN KEY (`AccID`) REFERENCES `accountdetails` (`AccID`);

--
-- Constraints for table `networkdetails`
--
ALTER TABLE `networkdetails`
  ADD CONSTRAINT `NW_Instances` FOREIGN KEY (`InstanceID`) REFERENCES `instances` (`InstanceID`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
