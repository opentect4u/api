-- phpMyAdmin SQL Dump
-- version 4.6.6deb5
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Jun 03, 2019 at 05:04 PM
-- Server version: 5.7.26-0ubuntu0.18.04.1
-- PHP Version: 7.2.17-0ubuntu0.18.04.1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `api`
--

-- --------------------------------------------------------

--
-- Table structure for table `td_rep_detailes`
--

CREATE TABLE `td_rep_detailes` (
  `sl_no` int(11) NOT NULL,
  `response_cd` int(10) NOT NULL,
  `CBSAcNo` varchar(50) NOT NULL,
  `SocAcNo` varchar(50) NOT NULL,
  `AcHolderName` varchar(60) NOT NULL,
  `SocDesCA` varchar(50) NOT NULL,
  `SocName` varchar(75) NOT NULL,
  `Amount` decimal(10,2) NOT NULL,
  `Remarks` tinytext NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `td_rep_detailes`
--

INSERT INTO `td_rep_detailes` (`sl_no`, `response_cd`, `CBSAcNo`, `SocAcNo`, `AcHolderName`, `SocDesCA`, `SocName`, `Amount`, `Remarks`) VALUES
(1, 1, '122002048529', '36003290', 'Mr. SUMITRA  SOREN', '122000977970', 'RAMNAGAR BACHRA SKUS LTD.', '260.64', 'Others-DBT'),
(2, 1, '122002556600', '4937', 'Mr. LABANI  MONDAL', '122000977970', 'RAMNAGAR BACHRA SKUS LTD.', '260.64', 'Others-DBT'),
(3, 1, '122002674078', '36004926', 'Mr. REKHA  MONDAL', '122000977970', 'RAMNAGAR BACHRA SKUS LTD.', '245.40', 'Others-DBT'),
(4, 1, '122003960884', '36005186', 'Mr. SARASWATI  GHOSH', '122000977970', 'RAMNAGAR BACHRA SKUS LTD.', '260.64', 'Others-DBT');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `td_rep_detailes`
--
ALTER TABLE `td_rep_detailes`
  ADD PRIMARY KEY (`sl_no`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `td_rep_detailes`
--
ALTER TABLE `td_rep_detailes`
  MODIFY `sl_no` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
