-- phpMyAdmin SQL Dump
-- version 4.0.10deb1
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Mar 07, 2017 at 05:40 PM
-- Server version: 5.5.53-0ubuntu0.14.04.1
-- PHP Version: 5.5.9-1ubuntu4.20

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";

--
-- Database: `sms`
--

-- --------------------------------------------------------

--
-- Table structure for table `user_payments`
--

CREATE TABLE IF NOT EXISTS `user_payments` (
  `payment_id` int(11) NOT NULL AUTO_INCREMENT,
  `collected_by` int(11) DEFAULT NULL,
  `user_id` int(11) NOT NULL DEFAULT '0',
  `no_of_sms` int(11) NOT NULL DEFAULT '0',
  `price` varchar(20) NOT NULL DEFAULT '0',
  `longcode_credits` int(11) DEFAULT '0',
  `shorturl_credits` int(11) DEFAULT '0',
  `amount` varchar(50) NOT NULL DEFAULT '0',
  `service_tax` bigint(20) DEFAULT NULL,
  `service_tax_percent` float NOT NULL DEFAULT '0',
  `total_amount` float NOT NULL DEFAULT '0',
  `payment_type` int(11) NOT NULL DEFAULT '0',
  `transaction_id` bigint(50) DEFAULT NULL,
  `added_by` int(11) DEFAULT '0',
  `on_date` datetime DEFAULT NULL,
  `note` tinytext,
  `invoice_id` int(11) NOT NULL DEFAULT '0',
  `Sales_exec` varchar(100) DEFAULT NULL,
  `is_display_pending` int(11) NOT NULL DEFAULT '1',
  `crm_balance` varchar(50) DEFAULT NULL,
  `price_per_pulse` varchar(50) DEFAULT NULL,
  `pulse_per_second` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`payment_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=35 ;
