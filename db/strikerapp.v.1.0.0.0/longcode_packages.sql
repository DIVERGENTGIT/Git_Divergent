-- phpMyAdmin SQL Dump
-- version 4.0.10deb1
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Mar 20, 2017 at 02:41 PM
-- Server version: 5.5.53-0ubuntu0.14.04.1
-- PHP Version: 5.5.9-1ubuntu4.20

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";

--
-- Database: `sms`
--

-- --------------------------------------------------------

--
-- Table structure for table `longcode_packages`
--

CREATE TABLE IF NOT EXISTS `longcode_packages` (
  `package_id` int(11) NOT NULL AUTO_INCREMENT,
  `no_of_sms` varchar(100) DEFAULT NULL COMMENT 'no_of_free_sms_with_pack',
  `price_per_long_code` varchar(100) DEFAULT NULL COMMENT 'INR',
  `subscription_duration` varchar(100) DEFAULT NULL COMMENT 'No of Months',
  `no_of_months` int(11) DEFAULT '0',
  `amount` varchar(100) NOT NULL,
  `activity` varchar(100) DEFAULT NULL,
  `created_on` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`package_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=13 ;

--
-- Dumping data for table `longcode_packages`
--

INSERT INTO `longcode_packages` (`package_id`, `no_of_sms`, `price_per_long_code`, `subscription_duration`, `no_of_months`, `amount`, `activity`, `created_on`) VALUES
(1, '30000', '0.08', '1 Month', 1, '3000', 'Demo', '2017-03-18 05:21:10'),
(2, '30000', '0.08', '3 Months', 3, '8100', 'Demo', '2017-03-18 05:21:10'),
(3, '30000', '0.08', '6 Months', 6, '15300', 'Demo', '2017-03-18 05:21:10'),
(4, '30000', '0.08', '1 Year', 12, '28800', 'Demo', '2017-03-18 05:21:11'),
(5, '60000', '0.06', '1 Month', 1, '5000', 'Demo', '2017-03-18 05:21:11'),
(6, '60000', '0.06', '3 Months', 3, '13500', 'Demo', '2017-03-18 05:21:11'),
(7, '60000', '0.06', '6 Months', 6, '25500', 'Demo', '2017-03-18 05:21:11'),
(8, '60000', '0.06', '1 Year', 12, '48000', 'Demo', '2017-03-18 05:21:11'),
(9, '100000', '0.04', '1 Month', 1, '7500', 'Demo', '2017-03-18 05:21:11'),
(10, '100000', '0.04', '3 Months', 3, '20250', 'Demo', '2017-03-18 05:21:11'),
(11, '100000', '0.04', '6 Months', 6, '38250', 'Demo', '2017-03-18 05:21:11'),
(12, '100000', '0.04', '1 Year', 12, '72000', 'Demo', '2017-03-18 05:21:11');

