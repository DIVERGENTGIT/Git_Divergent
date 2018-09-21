phpMyAdmin SQL Dump
-- version 4.0.10deb1
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Mar 07, 2017 at 05:38 PM
-- Server version: 5.5.53-0ubuntu0.14.04.1
-- PHP Version: 5.5.9-1ubuntu4.20

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";

--
-- Database: `sms`
--

-- --------------------------------------------------------

--
-- Table structure for table `transaction_history`
--

CREATE TABLE IF NOT EXISTS `transaction_history` (
  `payment_id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) DEFAULT NULL,
  `created_on` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `payment_status` varchar(100) DEFAULT '0',
  `noofsms` int(11) DEFAULT NULL,
  `sms_price` varchar(100) DEFAULT NULL,
  `longcode_credits` int(11) DEFAULT '0',
  `shorturl_credits` int(11) DEFAULT '0',
  `amount` int(11) DEFAULT NULL,
  `tax_amount` int(11) DEFAULT NULL,
  `total_amount` int(11) DEFAULT NULL,
  `transaction_id` int(11) DEFAULT NULL,
  `pgresponse_code` varchar(100) DEFAULT NULL,
  `RRN` varchar(100) DEFAULT NULL,
  `epg_txnID` varchar(100) DEFAULT NULL,
  `authcode` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`payment_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=70 ;

