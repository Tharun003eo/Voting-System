-- phpMyAdmin SQL Dump
-- version 4.2.7.1
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: May 20, 2015 at 11:05 AM
-- Server version: 5.5.39
-- PHP Version: 5.4.31

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";

-- --------------------------------------------------------

--
-- Database: `db_evoting`
--

-- --------------------------------------------------------

--
-- Table structure for table `tbl_admin`
--

CREATE TABLE IF NOT EXISTS `tbl_admin` (
  `aid` int(11) NOT NULL AUTO_INCREMENT,
  `admin_username` varchar(30) NOT NULL,
  `admin_password` varchar(30) NOT NULL,
  PRIMARY KEY (`aid`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_admin`
--

INSERT INTO `tbl_admin` (`aid`, `admin_username`, `admin_password`) VALUES
(1, 'admin', '_admin');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_users`
--
-- Table structure for table `tbl_users`
CREATE TABLE IF NOT EXISTS `tbl_users` (
  `id` int(6) UNSIGNED NOT NULL AUTO_INCREMENT PRIMARY KEY,
  `voterName` varchar(50) NOT NULL,
  `voterEmail` varchar(50) NOT NULL,
  `voterID` varchar(255) NOT NULL,
  `photo` varchar(255) NOT NULL,
  UNIQUE KEY `voterID_UNIQUE` (`voterID`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;




--
-- Dumping data for table `tbl_users`
--

-- --------------------------------------------------------
CREATE TABLE IF NOT EXISTS `tbl_aadhar` (
    `aadhar_number` BIGINT(12) PRIMARY KEY,
    `mobile_number` BIGINT(10)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;


INSERT INTO `tbl_aadhar` (`aadhar_number`, `mobile_number`) VALUES
(660258133229, 7448959467),
(660258133227, 8778815021);


-- Table structure for table `tbl_votes`
--

-- Table structure for table `tbl_votes`
CREATE TABLE IF NOT EXISTS `tbl_votes` (
  `voteID` int(6) UNSIGNED NOT NULL AUTO_INCREMENT,
  `voterID` varchar(255) NOT NULL,
  `candidate` varchar(255) NOT NULL,
  PRIMARY KEY (`voteID`),
  UNIQUE KEY `voter_key` (`voterID`), -- Define voterID as a key
  CONSTRAINT `fk_voter` FOREIGN KEY (`voterID`) REFERENCES `tbl_users` (`voterID`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;


/*!40101 SET character_set_client = 'utf8' */;
