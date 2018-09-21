-- phpMyAdmin SQL Dump
-- version 4.0.10deb1
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Mar 07, 2017 at 05:32 PM
-- Server version: 5.5.53-0ubuntu0.14.04.1
-- PHP Version: 5.5.9-1ubuntu4.20

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";

--
-- Database: `sms`
--

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE IF NOT EXISTS `users` (
  `user_id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(45) NOT NULL,
  `password` varchar(64) NOT NULL,
  `first_name` varchar(45) DEFAULT NULL,
  `last_name` varchar(45) DEFAULT NULL,
  `email` varchar(60) DEFAULT NULL,
  `emailid_org` varchar(60) DEFAULT NULL,
  `mobile` bigint(20) DEFAULT NULL,
  `mobileno_org` bigint(20) DEFAULT NULL,
  `organization` varchar(100) DEFAULT NULL,
  `address1` varchar(255) DEFAULT NULL,
  `address2` varchar(255) DEFAULT NULL,
  `city_id` int(11) NOT NULL DEFAULT '0',
  `state_id` int(11) NOT NULL DEFAULT '0',
  `country_id` int(11) NOT NULL DEFAULT '0',
  `zipcode` int(11) DEFAULT NULL,
  `registered_on` datetime DEFAULT NULL,
  `login_time` datetime DEFAULT NULL,
  `logout_time` datetime DEFAULT NULL,
  `available_credits` int(11) NOT NULL DEFAULT '0',
  `longcode_credits` int(11) DEFAULT '0',
  `shorturl_credits` float NOT NULL DEFAULT '0',
  `international_available_credits` int(11) NOT NULL DEFAULT '0',
  `is_blocked` tinyint(1) NOT NULL DEFAULT '0',
  `no_ndnc` tinyint(4) NOT NULL DEFAULT '0' COMMENT '1-Tran,0-Promo,2-Vf Tran',
  `dlr_enabled` tinyint(4) NOT NULL DEFAULT '0' COMMENT '0 = no dlr, 1 = only dnd, 2 = all dlrs',
  `is_reseller` tinyint(4) NOT NULL DEFAULT '0',
  `reseller_id` int(11) NOT NULL DEFAULT '0',
  `priority` enum('P2','P3') NOT NULL DEFAULT 'P3',
  `sending_percentage` int(11) NOT NULL DEFAULT '100',
  `return_ndnc_credits` tinyint(4) NOT NULL DEFAULT '0',
  `from_striker` tinyint(4) NOT NULL DEFAULT '0',
  `initially_assigned_to` int(11) NOT NULL DEFAULT '0' COMMENT 'First Sales Executive ID',
  `assigned_to` int(11) NOT NULL DEFAULT '0' COMMENT 'Present Sales Executive ID',
  `tele_caller_id` tinyint(4) NOT NULL DEFAULT '0',
  `template_check` tinyint(4) NOT NULL DEFAULT '1',
  `resend_enabled` tinyint(4) NOT NULL DEFAULT '0' COMMENT '0-not enabled,1-enabled',
  `dnd_check` tinyint(4) NOT NULL DEFAULT '0',
  `detailed_dlr_report` tinyint(4) NOT NULL DEFAULT '0',
  `useracctype` int(11) NOT NULL DEFAULT '0' COMMENT '1=normal,0=demo',
  `International` tinyint(1) DEFAULT '0',
  `AllowedCountry` text,
  `mverify` int(11) DEFAULT NULL,
  `duplicate_content` int(11) DEFAULT NULL,
  `max_ports` varchar(10) NOT NULL DEFAULT '10',
  `max_participants` varchar(20) NOT NULL DEFAULT '10',
  `voice_users` int(25) NOT NULL DEFAULT '0',
  `is_missedcall` int(11) NOT NULL DEFAULT '0',
  `api_key` varchar(255) DEFAULT NULL,
  `is_obd` int(11) NOT NULL DEFAULT '0',
  `caller_id` int(11) DEFAULT NULL,
  `is_call_record` int(11) DEFAULT NULL,
  `crm_balance` varchar(50) DEFAULT NULL,
  `price_per_pulse` varchar(50) DEFAULT NULL,
  `pulse_per_second` varchar(50) DEFAULT NULL,
  `sms_price` float DEFAULT NULL,
  `is_crm` int(11) NOT NULL DEFAULT '0',
  `user_service` varchar(100) DEFAULT NULL,
  `is_longcode` int(11) DEFAULT NULL,
  `is_send` int(11) DEFAULT '0',
  `is_ftp` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`user_id`),
  UNIQUE KEY `username` (`username`),
  KEY `user_id` (`user_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=8 ;

