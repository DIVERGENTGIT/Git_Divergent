-- phpMyAdmin SQL Dump
-- version 4.0.10deb1
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Mar 07, 2017 at 05:43 PM
-- Server version: 5.5.53-0ubuntu0.14.04.1
-- PHP Version: 5.5.9-1ubuntu4.20

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";

--
-- Database: `sms`
--

-- --------------------------------------------------------

--
-- Table structure for table `order_numbers`
--

CREATE TABLE IF NOT EXISTS `order_numbers` (
  `service_id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) DEFAULT NULL,
  `did_number` varchar(100) DEFAULT NULL,
  `did_type` varchar(100) DEFAULT NULL,
  `did_plan` varchar(100) DEFAULT NULL,
  `did_price` varchar(100) DEFAULT NULL,
  `status` int(11) NOT NULL DEFAULT '0' COMMENT '0-available,1-not available,2-payment_success',
  `created_on` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `pri_rental` varchar(100) DEFAULT NULL,
  `mobile_rental` varchar(100) DEFAULT NULL,
  `tollfree_rental` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`service_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=5 ;

