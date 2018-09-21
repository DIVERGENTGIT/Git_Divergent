-- phpMyAdmin SQL Dump
-- version 4.0.10deb1
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Mar 07, 2017 at 05:42 PM
-- Server version: 5.5.53-0ubuntu0.14.04.1
-- PHP Version: 5.5.9-1ubuntu4.20

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";

--
-- Database: `sms`
--

-- --------------------------------------------------------

--
-- Table structure for table `longcode_tmp`
--

CREATE TABLE IF NOT EXISTS `longcode_tmp` (
  `longcode_id` int(11) NOT NULL AUTO_INCREMENT,
  `service_type` varchar(50) DEFAULT NULL,
  `longcode_number` bigint(20) DEFAULT NULL,
  `longcode_type` varchar(100) DEFAULT NULL,
  `user_id` int(11) DEFAULT NULL,
  `no_of_sms` int(11) DEFAULT NULL,
  `subscription_duration` varchar(50) DEFAULT NULL,
  `no_of_keywords` varchar(50) DEFAULT NULL,
  `keywords_cost` varchar(50) DEFAULT NULL,
  `number_cost` varchar(100) DEFAULT NULL COMMENT 'longcode number cost',
  `package_cost` varchar(100) DEFAULT NULL COMMENT 'long code package cost',
  `amount` varchar(100) DEFAULT NULL,
  `total_tax` varchar(100) DEFAULT NULL,
  `total_amount` varchar(100) DEFAULT NULL,
  `price_per_long_code` varchar(100) DEFAULT NULL,
  `status` int(11) NOT NULL DEFAULT '0' COMMENT '0-deactive,1-active,2-payment_success,3-invoice_success',
  `created_on` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`longcode_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=13 ;

