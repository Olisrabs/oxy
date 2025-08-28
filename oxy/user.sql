-- phpMyAdmin SQL Dump
-- version 3.4.9
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Aug 28, 2025 at 10:00 PM
-- Server version: 5.5.20
-- PHP Version: 5.3.9

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `wetinde3_olisrab`
--

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE IF NOT EXISTS `user` (
  `id` int(225) unsigned NOT NULL AUTO_INCREMENT,
  `timestamp` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `uin` varchar(500) DEFAULT NULL,
  `fullname` varchar(500) DEFAULT NULL,
  `email` varchar(500) DEFAULT NULL,
  `phone` varchar(500) DEFAULT NULL,
  `gender` varchar(500) DEFAULT NULL,
  `state` varchar(500) DEFAULT NULL,
  `lga` varchar(500) DEFAULT NULL,
  `password` varchar(500) DEFAULT NULL,
  `passport` varchar(500) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=3 ;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id`, `timestamp`, `uin`, `fullname`, `email`, `phone`, `gender`, `state`, `lga`, `password`, `passport`) VALUES
(1, '2025-08-13 16:16:50', 'OXY-2508135631', 'Abimbola Olajide', 'olisrab@gmail.com', '09069230487', 'male', 'Lagos State', 'Amuo-Odofin', '*6F952BF479F0B8655060BCD239A4520BB368293A', 'OXY-2508135631pix.jpg'),
(2, '2025-08-14 07:40:21', 'OXY-2508145173', 'Olajide Israel', 'youngsterpsisrael01@gmail.com', '09014169255', 'male', 'Ogun', 'Ijebu North', '*2BD14D0F4EE806090A7D5C22AAF1D48EA9848D9B', 'OXY-2508145173pix.jpg');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
