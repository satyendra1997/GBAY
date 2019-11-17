-- phpMyAdmin SQL Dump
-- version 3.3.9
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Sep 01, 2019 at 09:54 AM
-- Server version: 5.5.8
-- PHP Version: 5.3.5

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `gbay2`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE IF NOT EXISTS `admin` (
  `email` varchar(25) NOT NULL,
  `password` varchar(30) NOT NULL,
  UNIQUE KEY `email` (`email`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`email`, `password`) VALUES
('admin@gmail.com', '123456');

-- --------------------------------------------------------

--
-- Table structure for table `broker`
--

CREATE TABLE IF NOT EXISTS `broker` (
  `bid` int(255) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `mob` varchar(255) NOT NULL,
  `dor` date NOT NULL,
  `pan` varchar(255) NOT NULL,
  `bankAc` varchar(255) NOT NULL,
  `refid` int(10) NOT NULL,
  PRIMARY KEY (`bid`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=5 ;

--
-- Dumping data for table `broker`
--

INSERT INTO `broker` (`bid`, `name`, `email`, `mob`, `dor`, `pan`, `bankAc`, `refid`) VALUES
(1, 'vimal', 'anshu.patel7897@gmail.com', '9598472582', '2019-08-31', 'bhu232132', 'sbi', 123),
(2, 'hemant', 'anshu.patel7897@gmail.com', '7052056658', '2019-08-31', '456777', 'alld', 1),
(3, 'satyendra', 'umsi@umich.edu', '7897125982', '2019-08-31', 'qwwee', '12222', 123),
(4, 'vikas', 'vikas.patel7897@gmail.com', '9598472582', '2019-08-31', '345', '', 2);

-- --------------------------------------------------------

--
-- Table structure for table `fullpaymentdetail`
--

CREATE TABLE IF NOT EXISTS `fullpaymentdetail` (
  `payid` int(11) NOT NULL AUTO_INCREMENT,
  `propid` varchar(255) NOT NULL,
  `amt` varchar(255) NOT NULL,
  `mode` varchar(255) NOT NULL,
  `paymentdetail` varchar(255) NOT NULL,
  `dop` date NOT NULL,
  `flag` int(8) NOT NULL DEFAULT '1',
  PRIMARY KEY (`payid`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

--
-- Dumping data for table `fullpaymentdetail`
--


-- --------------------------------------------------------

--
-- Table structure for table `futurepayments`
--

CREATE TABLE IF NOT EXISTS `futurepayments` (
  `fpid` int(8) NOT NULL AUTO_INCREMENT,
  `plotid` varchar(10) NOT NULL,
  `amt` int(8) NOT NULL,
  `tillpaid` int(8) NOT NULL,
  `date` date NOT NULL,
  PRIMARY KEY (`fpid`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

--
-- Dumping data for table `futurepayments`
--


-- --------------------------------------------------------

--
-- Table structure for table `owners`
--

CREATE TABLE IF NOT EXISTS `owners` (
  `plotid` varchar(15) NOT NULL,
  `aname1` varchar(255) NOT NULL,
  `wname1` varchar(255) NOT NULL,
  `dob1` date NOT NULL,
  `occupation1` varchar(30) NOT NULL,
  `resident status1` varchar(30) NOT NULL,
  `mailadd1` varchar(255) NOT NULL,
  `pemaadd1` varchar(255) NOT NULL,
  `mobileno1` varchar(15) NOT NULL,
  `email1` varchar(50) NOT NULL,
  `maritalstatus1` varchar(15) NOT NULL,
  `pan1` varchar(30) NOT NULL,
  `identity1` varchar(20) NOT NULL,
  `aname2` varchar(255) NOT NULL,
  `wname2` varchar(255) NOT NULL,
  `dob2` date NOT NULL,
  `occupation2` varchar(30) NOT NULL,
  `resident status2` varchar(30) NOT NULL,
  `mailadd2` varchar(255) NOT NULL,
  `pemaadd2` varchar(255) NOT NULL,
  `mobileno2` varchar(15) NOT NULL,
  `email2` varchar(50) NOT NULL,
  `maritalstatus2` varchar(15) NOT NULL,
  `pan2` varchar(30) NOT NULL,
  `identity2` varchar(20) NOT NULL,
  `dor` date NOT NULL,
  PRIMARY KEY (`plotid`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `owners`
--


-- --------------------------------------------------------

--
-- Table structure for table `payment`
--

CREATE TABLE IF NOT EXISTS `payment` (
  `plotid` varchar(20) NOT NULL,
  `saname1` varchar(255) NOT NULL,
  `saname2` varchar(255) NOT NULL,
  `paid` int(255) NOT NULL,
  `remaining` int(255) NOT NULL,
  `date_of_lastpayment` date NOT NULL,
  `bid` int(8) NOT NULL,
  PRIMARY KEY (`plotid`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `payment`
--


-- --------------------------------------------------------

--
-- Table structure for table `price_list`
--

CREATE TABLE IF NOT EXISTS `price_list` (
  `plot_name` varchar(255) NOT NULL,
  `area(in_sqft)` int(100) NOT NULL,
  `Notation_plot_id` varchar(10) NOT NULL,
  `basic_sell_price` int(100) NOT NULL,
  `subsidy` int(100) NOT NULL,
  `total_price` int(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `price_list`
--

INSERT INTO `price_list` (`plot_name`, `area(in_sqft)`, `Notation_plot_id`, `basic_sell_price`, `subsidy`, `total_price`) VALUES
('GANGA', 600, 'G', 390000, 45000, 345000),
('YAMUNA', 900, 'Y', 585000, 68000, 517500),
('SARASWATI', 1350, 'S', 877500, 101250, 776250),
('GODAWARI', 1800, 'GO', 1440000, 165600, 1274400);

-- --------------------------------------------------------

--
-- Table structure for table `selldetail`
--

CREATE TABLE IF NOT EXISTS `selldetail` (
  `pid` varchar(100) NOT NULL,
  `saname1` varchar(255) NOT NULL,
  `saname2` varchar(255) NOT NULL,
  `plan` varchar(20) NOT NULL,
  `plc` varchar(100) NOT NULL,
  `discount` int(10) NOT NULL,
  `brokerid` varchar(10) NOT NULL,
  `Brokerage` varchar(11) NOT NULL,
  `sellthrough` varchar(30) NOT NULL,
  PRIMARY KEY (`pid`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `selldetail`
--

