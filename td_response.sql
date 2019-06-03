-- phpMyAdmin SQL Dump
-- version 4.6.6deb5
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Jun 03, 2019 at 05:05 PM
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
-- Table structure for table `td_response`
--

CREATE TABLE `td_response` (
  `response_cd` int(10) NOT NULL,
  `response` text NOT NULL,
  `society_cd` varchar(30) NOT NULL,
  `entry_dt` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `td_response`
--

INSERT INTO `td_response` (`response_cd`, `response`, `society_cd`, `entry_dt`) VALUES
(1, '{\"code\":200,\"msg\":\"Successfully Get Inward Entry Data.\",\"result\":[{\"CBSAcNo\":\"122002048529\",\"SocAcNo\":\"36003290\",\"AcHolderName\":\"Mr. SUMITRA  SOREN\",\"SocDesCA\":\"122000977970\",\"SocName\":\"RAMNAGAR BACHRA SKUS LTD.\",\"Amount\":\"260.64\",\"Remarks\":\"Others-DBT\"},{\"CBSAcNo\":\"122002556600\",\"SocAcNo\":\"4937\",\"AcHolderName\":\"Mr. LABANI  MONDAL\",\"SocDesCA\":\"122000977970\",\"SocName\":\"RAMNAGAR BACHRA SKUS LTD.\",\"Amount\":\"260.64\",\"Remarks\":\"Others-DBT\"},{\"CBSAcNo\":\"122002674078\",\"SocAcNo\":\"36004926\",\"AcHolderName\":\"Mr. REKHA  MONDAL\",\"SocDesCA\":\"122000977970\",\"SocName\":\"RAMNAGAR BACHRA SKUS LTD.\",\"Amount\":\"245.40\",\"Remarks\":\"Others-DBT\"},{\"CBSAcNo\":\"122003960884\",\"SocAcNo\":\"36005186\",\"AcHolderName\":\"Mr. SARASWATI  GHOSH\",\"SocDesCA\":\"122000977970\",\"SocName\":\"RAMNAGAR BACHRA SKUS LTD.\",\"Amount\":\"260.64\",\"Remarks\":\"Others-DBT\"}]}', '1801', '2019-05-10');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `td_response`
--
ALTER TABLE `td_response`
  ADD PRIMARY KEY (`response_cd`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
