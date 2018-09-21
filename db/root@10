-- phpMyAdmin SQL Dump
-- version 4.4.15.9
-- https://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Mar 03, 2017 at 03:46 PM
-- Server version: 5.6.35
-- PHP Version: 5.4.16

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `sms`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin_campaigns`
--

CREATE TABLE IF NOT EXISTS `admin_campaigns` (
  `admin_campaign_id` int(11) NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `sender_name` varchar(20) DEFAULT NULL,
  `sms_text` text,
  `no_of_messages` int(11) DEFAULT '0',
  `original_campaign_count` int(11) DEFAULT NULL,
  `send_through` varchar(10) DEFAULT NULL,
  `campaign_status` int(11) NOT NULL DEFAULT '0',
  `created_on` datetime DEFAULT NULL,
  `created_by` int(11) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `admin_campaigns_to`
--

CREATE TABLE IF NOT EXISTS `admin_campaigns_to` (
  `campaign_id` int(11) DEFAULT NULL,
  `to_mobile_no` bigint(20) DEFAULT NULL,
  `sent_on` datetime DEFAULT NULL,
  `dlr_status` int(11) DEFAULT NULL,
  `error_code` varchar(15) DEFAULT NULL,
  `error_text` varchar(100) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `admin_schedule_campaigns_to`
--

CREATE TABLE IF NOT EXISTS `admin_schedule_campaigns_to` (
  `campaign_id` int(11) DEFAULT NULL,
  `sms_text` tinytext,
  `to_mobile_no` bigint(20) DEFAULT NULL,
  `created_on` datetime DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `admin_table`
--

CREATE TABLE IF NOT EXISTS `admin_table` (
  `admin_id` int(11) NOT NULL,
  `user_name` varchar(45) DEFAULT NULL,
  `password` varchar(45) DEFAULT NULL,
  `name` varchar(100) NOT NULL,
  `login_time` datetime DEFAULT NULL,
  `admin_type` int(11) NOT NULL,
  `status` tinyint(4) NOT NULL DEFAULT '1',
  `email` varchar(100) NOT NULL,
  `mobile` varchar(20) NOT NULL,
  `created_on` datetime NOT NULL,
  `show_all_users` tinyint(4) NOT NULL DEFAULT '0',
  `show_assigned_users` tinyint(4) NOT NULL DEFAULT '0',
  `user_management` tinyint(4) NOT NULL DEFAULT '0',
  `add_deduct_credits` tinyint(4) NOT NULL DEFAULT '0',
  `add_delete_sender_name` tinyint(4) NOT NULL DEFAULT '0',
  `add_client` tinyint(4) NOT NULL DEFAULT '0',
  `assign_exec` tinyint(4) NOT NULL DEFAULT '0',
  `generate_report` tinyint(4) NOT NULL DEFAULT '0',
  `add_payment` tinyint(4) NOT NULL DEFAULT '0',
  `admin_campaigns` tinyint(4) NOT NULL DEFAULT '0',
  `add_delete_template` tinyint(4) NOT NULL DEFAULT '0',
  `show_resellers` tinyint(4) NOT NULL DEFAULT '0',
  `show_assigned_resellers` tinyint(4) NOT NULL DEFAULT '0',
  `manage_reseller_users` tinyint(4) NOT NULL DEFAULT '0',
  `add_delete_reseller_sender_name` tinyint(4) NOT NULL DEFAULT '0',
  `add_delete_reseller_template` tinyint(4) NOT NULL DEFAULT '0',
  `show_wresellers` tinyint(4) NOT NULL DEFAULT '0',
  `show_assigned_wresellers` tinyint(4) NOT NULL DEFAULT '0',
  `wreseller_management` tinyint(4) NOT NULL DEFAULT '0',
  `wreseller_add_deduct_credits` tinyint(4) NOT NULL DEFAULT '0',
  `manage_wreseller_users` tinyint(4) NOT NULL DEFAULT '0',
  `add_delete_wreseller_users_sender_name` tinyint(4) NOT NULL DEFAULT '0',
  `add_delete_wreseller_users_template` tinyint(4) NOT NULL DEFAULT '0',
  `add_wresellers_collections` tinyint(4) NOT NULL DEFAULT '0',
  `add_wreseller` tinyint(4) NOT NULL DEFAULT '0',
  `all_appointments` tinyint(4) NOT NULL DEFAULT '0',
  `assigned_to_appointments` tinyint(4) NOT NULL DEFAULT '0',
  `assigned_by_appointments` int(11) NOT NULL DEFAULT '0',
  `add_appointments` int(11) NOT NULL DEFAULT '0',
  `record_appointment` int(11) NOT NULL DEFAULT '0',
  `is_executive` enum('0','1','2') NOT NULL DEFAULT '0' COMMENT '0=tellecallers,1=executive,2=telecallers',
  `empcode` int(10) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `agent_numbers`
--

CREATE TABLE IF NOT EXISTS `agent_numbers` (
  `sno` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `agent_name` varchar(100) NOT NULL,
  `agent_phoneno` varchar(50) NOT NULL,
  `create_on` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `alerts_to_groups`
--

CREATE TABLE IF NOT EXISTS `alerts_to_groups` (
  `id` int(11) NOT NULL,
  `alert_id` int(11) NOT NULL,
  `group_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `allow_ip`
--

CREATE TABLE IF NOT EXISTS `allow_ip` (
  `id` int(11) NOT NULL,
  `ip` varchar(100) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `api_keys`
--

CREATE TABLE IF NOT EXISTS `api_keys` (
  `sno` bigint(20) NOT NULL,
  `user_id` int(11) NOT NULL,
  `user_keys` varchar(100) NOT NULL,
  `purpose_of_keys` varchar(200) NOT NULL,
  `create_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `appointments_history`
--

CREATE TABLE IF NOT EXISTS `appointments_history` (
  `app_history_id` int(11) NOT NULL,
  `app_id` int(11) NOT NULL,
  `created_on` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `user_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `block_listed_numbers`
--

CREATE TABLE IF NOT EXISTS `block_listed_numbers` (
  `mobile_no` bigint(20) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `business_application`
--

CREATE TABLE IF NOT EXISTS `business_application` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `customer_id` varchar(30) DEFAULT NULL,
  `name` varchar(100) DEFAULT NULL,
  `gender` enum('M','F') DEFAULT NULL,
  `address` tinytext,
  `mobile` bigint(20) DEFAULT NULL,
  `item_code` varchar(50) DEFAULT NULL,
  `item_name` varchar(100) DEFAULT NULL,
  `price` float NOT NULL DEFAULT '0',
  `no_of_items` int(11) NOT NULL DEFAULT '0',
  `bill_amount` float NOT NULL DEFAULT '0',
  `Bill_number` varchar(50) DEFAULT NULL,
  `created_on` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `call_type`
--

CREATE TABLE IF NOT EXISTS `call_type` (
  `call_id` int(11) NOT NULL,
  `agent_id` int(11) NOT NULL,
  `call_type` varchar(100) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `campaigns`
--

CREATE TABLE IF NOT EXISTS `campaigns` (
  `campaign_id` int(11) NOT NULL,
  `campaign_name` varchar(40) DEFAULT NULL,
  `user_id` int(11) DEFAULT NULL,
  `sender` varchar(100) DEFAULT NULL,
  `sender_name` varchar(15) DEFAULT NULL,
  `sms_text` text CHARACTER SET utf8 COLLATE utf8_bin,
  `sms_text_sample` text,
  `sms_count` int(11) DEFAULT NULL COMMENT '1sms=160characters',
  `phone_nos_count` int(11) DEFAULT '0' COMMENT 'total numbers count',
  `no_of_messages` int(11) DEFAULT '0',
  `is_unicode_sms` tinyint(4) NOT NULL DEFAULT '0' COMMENT '1-unicode,0-normal',
  `campaign_type` int(11) NOT NULL DEFAULT '1',
  `source_type` int(11) NOT NULL DEFAULT '0',
  `service_type` varchar(50) DEFAULT '         ',
  `longcode_numbers` text,
  `missedcall_numbers` text,
  `campaign_status` tinyint(4) NOT NULL DEFAULT '0' COMMENT '0-New,1-Process,2-completed,3-Cancel(scheduled)',
  `created_on` datetime DEFAULT NULL,
  `is_scheduled` tinyint(4) NOT NULL DEFAULT '0',
  `long_url` varchar(255) DEFAULT NULL,
  `shorturl_text` varchar(50) DEFAULT NULL,
  `scheduled_on` datetime DEFAULT NULL,
  `is_dlr_enabled` tinyint(4) NOT NULL DEFAULT '0',
  `total_numbers_count` int(11) DEFAULT '0',
  `delivered_count` int(11) DEFAULT '0',
  `expired_count` int(11) DEFAULT '0',
  `dnd_count` int(11) DEFAULT '0',
  `invalid_count` int(11) DEFAULT '0',
  `pending_dlrs_count` int(11) NOT NULL DEFAULT '0',
  `from_row` int(11) DEFAULT NULL,
  `to_row` int(11) DEFAULT NULL,
  `port_no` int(11) DEFAULT NULL,
  `resend` tinyint(4) NOT NULL DEFAULT '0' COMMENT '0-no resend,1-resend started, 2-resend completed',
  `job_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `campaigns_1`
--

CREATE TABLE IF NOT EXISTS `campaigns_1` (
  `campaign_id` int(11) NOT NULL,
  `campaign_name` varchar(40) NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `sender_name` varchar(15) DEFAULT NULL,
  `sms_text` text CHARACTER SET utf8 COLLATE utf8_bin,
  `sms_text_sample` text NOT NULL,
  `sms_count` tinyint(4) NOT NULL COMMENT '1sms=160characters',
  `phone_nos_count` int(11) NOT NULL COMMENT 'total numbers count',
  `no_of_messages` int(11) NOT NULL DEFAULT '0',
  `is_unicode_sms` tinyint(4) NOT NULL DEFAULT '0' COMMENT '1-unicode,0-normal',
  `campaign_type` int(11) NOT NULL DEFAULT '1',
  `campaign_status` tinyint(4) NOT NULL DEFAULT '0' COMMENT '0-New,1-Process,2-completed,3-Cancel(scheduled)',
  `created_on` datetime DEFAULT NULL,
  `is_scheduled` tinyint(4) NOT NULL DEFAULT '0',
  `scheduled_on` datetime DEFAULT NULL,
  `is_dlr_enabled` tinyint(4) NOT NULL DEFAULT '0',
  `total_numbers_count` int(11) DEFAULT '0',
  `delivered_count` int(11) DEFAULT '0',
  `expired_count` int(11) DEFAULT '0',
  `dnd_count` int(11) DEFAULT '0',
  `invalid_count` int(11) DEFAULT '0',
  `pending_dlrs_count` int(11) NOT NULL,
  `from_row` int(11) DEFAULT NULL,
  `to_row` int(11) DEFAULT NULL,
  `port_no` int(11) DEFAULT NULL,
  `resend` tinyint(4) NOT NULL DEFAULT '0' COMMENT '0-no resend,1-resend started, 2-resend completed'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `campaigns_to`
--

CREATE TABLE IF NOT EXISTS `campaigns_to` (
  `campaign_id` int(11) NOT NULL,
  `unique_msg_id` varchar(50) DEFAULT NULL,
  `to_mobile_no` bigint(20) DEFAULT NULL,
  `sms_text` text CHARACTER SET utf8 COLLATE utf8_bin,
  `sent_on` datetime DEFAULT NULL,
  `dlr_status` int(11) DEFAULT NULL,
  `error_code` varchar(15) DEFAULT NULL,
  `error_text` varchar(100) DEFAULT NULL,
  `short_url` varchar(100) DEFAULT NULL,
  `delivered_on` datetime DEFAULT NULL,
  `port_no` varchar(6) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `campaigns_tobackup`
--

CREATE TABLE IF NOT EXISTS `campaigns_tobackup` (
  `campaign_id` int(11) DEFAULT NULL,
  `unique_msg_id` varchar(50) NOT NULL,
  `to_mobile_no` bigint(20) DEFAULT NULL,
  `sms_text` text CHARACTER SET utf8 COLLATE utf8_bin,
  `sent_on` datetime DEFAULT NULL,
  `dlr_status` int(11) DEFAULT NULL,
  `error_code` varchar(15) DEFAULT NULL,
  `error_text` varchar(100) DEFAULT NULL,
  `delivered_on` datetime DEFAULT NULL,
  `port_no` varchar(6) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `campaigns_totest`
--

CREATE TABLE IF NOT EXISTS `campaigns_totest` (
  `campaign_id` int(11) NOT NULL,
  `unique_msg_id` varchar(50) NOT NULL,
  `to_mobile_no` varchar(20) DEFAULT NULL,
  `sms_text` text CHARACTER SET utf8 COLLATE utf8_bin,
  `sent_on` datetime DEFAULT NULL,
  `dlr_status` int(11) DEFAULT NULL,
  `error_code` varchar(15) DEFAULT NULL,
  `error_text` varchar(100) DEFAULT NULL,
  `delivered_on` datetime DEFAULT NULL,
  `port_no` varchar(6) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `campaigns_to_dlr`
--

CREATE TABLE IF NOT EXISTS `campaigns_to_dlr` (
  `campaign_id` int(11) DEFAULT NULL,
  `to_mobile_no` bigint(20) DEFAULT NULL,
  `sms_text` tinytext,
  `dlr_status` int(11) DEFAULT NULL,
  `received_on` varchar(20) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `camp_mobile_temp97`
--

CREATE TABLE IF NOT EXISTS `camp_mobile_temp97` (
  `job_id` int(11) NOT NULL,
  `mobile_no` bigint(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `camp_mobile_temp98`
--

CREATE TABLE IF NOT EXISTS `camp_mobile_temp98` (
  `job_id` int(11) NOT NULL,
  `mobile_no` bigint(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `CARE_PWDS`
--

CREATE TABLE IF NOT EXISTS `CARE_PWDS` (
  `Id` int(11) NOT NULL,
  `PWD` varchar(100) NOT NULL,
  `PWDFLAG` int(5) NOT NULL DEFAULT '0'
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `college_enquireform`
--

CREATE TABLE IF NOT EXISTS `college_enquireform` (
  `sno` int(30) NOT NULL,
  `name` varchar(100) NOT NULL,
  `course` varchar(50) NOT NULL,
  `comments` text NOT NULL,
  `phone` varchar(50) NOT NULL,
  `address` text NOT NULL,
  `date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `contacts`
--

CREATE TABLE IF NOT EXISTS `contacts` (
  `contact_id` int(11) NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `name` varchar(100) DEFAULT NULL,
  `gender` enum('Male','Female') DEFAULT NULL,
  `city_id` int(11) DEFAULT NULL,
  `mobile_no` bigint(20) DEFAULT NULL,
  `dob` varchar(50) DEFAULT NULL,
  `group_id` int(11) DEFAULT NULL,
  `address` tinytext,
  `join_date` varchar(50) DEFAULT NULL,
  `relieve_date` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `contact_form`
--

CREATE TABLE IF NOT EXISTS `contact_form` (
  `contact_id` int(11) NOT NULL,
  `name` varchar(50) NOT NULL,
  `mobile` varchar(12) NOT NULL,
  `email` varchar(100) NOT NULL,
  `message` text NOT NULL,
  `status` int(11) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `contact_groups`
--

CREATE TABLE IF NOT EXISTS `contact_groups` (
  `group_id` int(11) NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `group_name` varchar(100) DEFAULT NULL,
  `status` tinyint(4) NOT NULL DEFAULT '1',
  `created_on` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `duplicatecheck`
--

CREATE TABLE IF NOT EXISTS `duplicatecheck` (
  `datetime` datetime NOT NULL,
  `md5text` varchar(35) CHARACTER SET utf8 COLLATE utf8_bin DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `email_templates`
--

CREATE TABLE IF NOT EXISTS `email_templates` (
  `template_id` int(11) NOT NULL,
  `template` blob,
  `template_type` varchar(20) DEFAULT NULL,
  `on_date` datetime DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `Executive_Details`
--

CREATE TABLE IF NOT EXISTS `Executive_Details` (
  `Employe_name` varchar(100) DEFAULT NULL,
  `Father_name` varchar(100) NOT NULL,
  `sex` varchar(100) NOT NULL,
  `Mobile_no` varchar(20) NOT NULL,
  `Alternate_no` varchar(20) NOT NULL,
  `Date_birth` date NOT NULL,
  `Date_join` date NOT NULL,
  `Pres_addres` varchar(100) NOT NULL,
  `Perm_addres` varchar(100) NOT NULL,
  `Emp_code` int(20) NOT NULL,
  `Job_location` varchar(20) NOT NULL,
  `Designation` varchar(20) NOT NULL,
  `Personal_email` varchar(75) NOT NULL,
  `Company_email` varchar(75) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `feedback`
--

CREATE TABLE IF NOT EXISTS `feedback` (
  `name` varchar(50) NOT NULL,
  `phone_no` varchar(50) NOT NULL,
  `email` varchar(50) NOT NULL,
  `subject` longtext NOT NULL,
  `comment` longtext NOT NULL,
  `entry_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `fid` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `ftp_campaign`
--

CREATE TABLE IF NOT EXISTS `ftp_campaign` (
  `campaign_id` int(11) NOT NULL,
  `campaign_name` varchar(40) DEFAULT '',
  `campaign_type` int(11) NOT NULL DEFAULT '1',
  `sender_id` varchar(10) DEFAULT NULL,
  `user_id` int(11) DEFAULT NULL,
  `csv_file` varchar(255) DEFAULT NULL,
  `csv_file_size` int(11) DEFAULT NULL,
  `sms_text` varchar(255) DEFAULT '',
  `sms_count` int(11) DEFAULT '0',
  `no_of_messages` int(11) DEFAULT '0',
  `delivered_count` int(11) DEFAULT '0',
  `dnd_count` int(11) DEFAULT '0',
  `pending_dlrs_count` int(11) NOT NULL DEFAULT '0',
  `invalid_count` int(11) DEFAULT '0',
  `is_scheduled` tinyint(4) NOT NULL DEFAULT '0',
  `scheduled_on` datetime DEFAULT NULL,
  `expired_count` int(11) DEFAULT '0',
  `total_numbers_count` int(11) DEFAULT '0',
  `status` int(11) DEFAULT '0',
  `process_table1` varchar(255) DEFAULT NULL,
  `process_table2` varchar(255) DEFAULT NULL,
  `process_table3` varchar(255) DEFAULT NULL,
  `process_table1_status` int(11) NOT NULL DEFAULT '0',
  `process_table2_status` int(11) NOT NULL DEFAULT '0',
  `process_table3_status` int(11) NOT NULL DEFAULT '0',
  `created_date_time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `ftp_campaigns_to`
--

CREATE TABLE IF NOT EXISTS `ftp_campaigns_to` (
  `campaign_id` int(11) NOT NULL,
  `unique_msg_id` varchar(50) DEFAULT NULL,
  `acccount_num` varchar(255) DEFAULT NULL,
  `to_mobile_no` bigint(20) DEFAULT NULL,
  `sms_text` text CHARACTER SET utf8 COLLATE utf8_bin,
  `sms_count` int(11) DEFAULT NULL,
  `sent_on` datetime DEFAULT NULL,
  `dlr_status` int(11) DEFAULT NULL,
  `error_code` varchar(15) DEFAULT NULL,
  `error_text` varchar(100) DEFAULT NULL,
  `delivered_on` datetime DEFAULT NULL,
  `port_no` varchar(6) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `generate_invoice`
--

CREATE TABLE IF NOT EXISTS `generate_invoice` (
  `invoice_id` int(11) NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `transaction_id` bigint(50) DEFAULT NULL,
  `sms_type` varchar(100) DEFAULT NULL,
  `amount` varchar(50) DEFAULT NULL,
  `create_on` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `global_settings`
--

CREATE TABLE IF NOT EXISTS `global_settings` (
  `setting_id` int(11) NOT NULL,
  `setting_name` varchar(45) NOT NULL,
  `value` varchar(256) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `groups`
--

CREATE TABLE IF NOT EXISTS `groups` (
  `group_id` int(11) NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `group_name` varchar(100) NOT NULL,
  `count` int(11) NOT NULL DEFAULT '0',
  `on_date` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `group_numbers`
--

CREATE TABLE IF NOT EXISTS `group_numbers` (
  `group_id` int(11) NOT NULL DEFAULT '0',
  `mobile_no` varchar(20) NOT NULL DEFAULT '0',
  `user_id` int(11) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `invoices`
--

CREATE TABLE IF NOT EXISTS `invoices` (
  `invoice_id` int(11) NOT NULL,
  `client_id` int(11) DEFAULT NULL,
  `invoice_type` tinyint(4) DEFAULT NULL COMMENT '0 = sms 1= sms_reseller',
  `sale_ids` varchar(100) DEFAULT NULL,
  `manual_invoice_id` varchar(25) NOT NULL,
  `created_on` datetime DEFAULT NULL,
  `created_by` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `large_campaign_activities`
--

CREATE TABLE IF NOT EXISTS `large_campaign_activities` (
  `id` int(11) NOT NULL,
  `user_id` bigint(20) NOT NULL,
  `campaign_id` bigint(20) NOT NULL,
  `file_path` varchar(200) NOT NULL,
  `status` enum('0','1','2','3','4','5') NOT NULL,
  `no_of_sms` int(11) NOT NULL,
  `start_time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `mobile_no_column` int(11) NOT NULL,
  `sms_text` text NOT NULL,
  `is_schedule` int(11) NOT NULL,
  `from_row` int(11) NOT NULL,
  `to_row` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `large_campaign_activities_new`
--

CREATE TABLE IF NOT EXISTS `large_campaign_activities_new` (
  `id` int(11) NOT NULL,
  `user_id` bigint(20) NOT NULL,
  `campaign_id` bigint(20) NOT NULL,
  `file_path` varchar(200) NOT NULL,
  `status` enum('0','1','2','3','4','5') NOT NULL,
  `no_of_sms` int(11) NOT NULL,
  `start_time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `mobile_no_column` int(11) NOT NULL,
  `sms_text` text NOT NULL,
  `is_schedule` int(11) NOT NULL,
  `from_row` int(11) NOT NULL,
  `to_row` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `leads`
--

CREATE TABLE IF NOT EXISTS `leads` (
  `user_id` int(11) NOT NULL,
  `user_name` varchar(100) DEFAULT NULL,
  `password` varchar(100) DEFAULT NULL,
  `email` varchar(100) DEFAULT NULL,
  `mobile_number` bigint(20) DEFAULT NULL,
  `user_type` enum('support','sales','account','admin') DEFAULT NULL COMMENT '1-support,2-sales,3-account,4-admin',
  `created_on` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `leave_managment`
--

CREATE TABLE IF NOT EXISTS `leave_managment` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `leave_reason` text CHARACTER SET utf8 COLLATE utf8_bin NOT NULL,
  `leave_type` enum('1','2','3','4') NOT NULL COMMENT '1=sick leave,2=causal leave,3=earned leave ,4=loss of pay',
  `leave_status` enum('0','1','2') NOT NULL DEFAULT '0' COMMENT '0=pending,1=approved,2=rejected',
  `leave_fromdate` date DEFAULT NULL,
  `leave_todate` date DEFAULT NULL,
  `leave_numberof_days` int(11) NOT NULL,
  `created_on` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `loginhistory`
--

CREATE TABLE IF NOT EXISTS `loginhistory` (
  `id` bigint(20) NOT NULL,
  `user_id` bigint(20) NOT NULL,
  `designation` varchar(11) NOT NULL,
  `ip_id` bigint(20) NOT NULL,
  `login_time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `logout_time` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `login_attendance`
--

CREATE TABLE IF NOT EXISTS `login_attendance` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `login_time` datetime DEFAULT NULL,
  `logout_time` datetime DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `login_ips`
--

CREATE TABLE IF NOT EXISTS `login_ips` (
  `id` bigint(20) NOT NULL,
  `ip` varchar(100) NOT NULL,
  `country` varchar(30) NOT NULL,
  `country_code` varchar(10) NOT NULL,
  `region` int(10) NOT NULL,
  `region_code` varchar(50) NOT NULL,
  `city` varchar(70) NOT NULL,
  `zip_code` bigint(20) NOT NULL,
  `latitude` decimal(20,5) NOT NULL,
  `longitude` decimal(20,5) NOT NULL,
  `timezone` varchar(20) NOT NULL,
  `ISP` varchar(100) NOT NULL,
  `organization` varchar(100) NOT NULL,
  `as_number_name` varchar(100) NOT NULL,
  `host` varchar(100) NOT NULL,
  `user_id` bigint(20) NOT NULL,
  `created_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `longcode_config`
--

CREATE TABLE IF NOT EXISTS `longcode_config` (
  `longcode_id` int(11) NOT NULL,
  `service_type` varchar(50) DEFAULT NULL,
  `longcode_number` varchar(100) DEFAULT NULL,
  `keyword` varchar(100) DEFAULT NULL,
  `sender_id` varchar(50) DEFAULT NULL,
  `vender_alert` text,
  `vendor_number` varchar(20) DEFAULT NULL,
  `customer_alert` text,
  `api_alert` int(11) DEFAULT NULL,
  `connect_api_url` varchar(100) DEFAULT NULL,
  `phone_number` varchar(20) DEFAULT NULL,
  `service_numbers` varchar(20) DEFAULT NULL,
  `sms_time` varchar(20) DEFAULT NULL,
  `sms_status` varchar(20) DEFAULT NULL,
  `sms_text_param` varchar(20) DEFAULT NULL,
  `user_id` int(11) DEFAULT NULL,
  `created_on` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `modify_date` datetime DEFAULT NULL,
  `status` int(11) NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `longcode_keywords`
--

CREATE TABLE IF NOT EXISTS `longcode_keywords` (
  `keyword_id` int(11) NOT NULL,
  `service_type` varchar(50) DEFAULT NULL,
  `keyword_name` varchar(100) DEFAULT NULL,
  `user_id` int(11) DEFAULT NULL,
  `longcode_number` varchar(20) DEFAULT NULL,
  `start_date` datetime DEFAULT NULL,
  `expired_start` datetime DEFAULT NULL,
  `status` int(11) NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `longcode_keyword_price`
--

CREATE TABLE IF NOT EXISTS `longcode_keyword_price` (
  `price_id` int(11) NOT NULL,
  `subscription_duration` varchar(50) DEFAULT NULL,
  `amount` varchar(50) DEFAULT NULL,
  `status` int(11) DEFAULT '0',
  `created_on` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `longcode_numbers`
--

CREATE TABLE IF NOT EXISTS `longcode_numbers` (
  `longcode_id` int(11) NOT NULL,
  `longcode_number` bigint(20) DEFAULT NULL,
  `longcode_type` varchar(100) DEFAULT NULL,
  `user_id` int(11) DEFAULT NULL,
  `status` int(11) NOT NULL DEFAULT '0' COMMENT '0-available,1-not available',
  `created_on` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `longcode_packages`
--

CREATE TABLE IF NOT EXISTS `longcode_packages` (
  `package_id` int(11) NOT NULL,
  `no_of_sms` varchar(100) DEFAULT NULL COMMENT 'no_of_free_sms_with_pack',
  `price_per_long_code` varchar(100) DEFAULT NULL COMMENT 'INR',
  `subscription_duration` varchar(100) DEFAULT NULL COMMENT 'No of Months',
  `amount` varchar(100) NOT NULL,
  `activity` varchar(100) DEFAULT NULL,
  `created_on` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `longcode_plan_price`
--

CREATE TABLE IF NOT EXISTS `longcode_plan_price` (
  `plan_id` int(11) NOT NULL,
  `plan_name` varchar(100) DEFAULT NULL,
  `amount` int(11) NOT NULL,
  `created_on` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `longcode_smsmessages`
--

CREATE TABLE IF NOT EXISTS `longcode_smsmessages` (
  `id` bigint(20) NOT NULL,
  `service_number` varchar(20) NOT NULL DEFAULT '',
  `message_from` varchar(20) NOT NULL,
  `status` varchar(20) NOT NULL DEFAULT '',
  `message` text NOT NULL,
  `message_time` varchar(50) NOT NULL,
  `user_id` int(11) NOT NULL,
  `sender_id` varchar(20) DEFAULT NULL,
  `keyword` varchar(50) DEFAULT NULL,
  `count` int(11) DEFAULT NULL,
  `created_on` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `smscinfo` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `longcode_subscription`
--

CREATE TABLE IF NOT EXISTS `longcode_subscription` (
  `longcode_id` int(11) NOT NULL,
  `service_type` varchar(50) DEFAULT NULL,
  `user_id` int(11) DEFAULT NULL,
  `longcode_number` bigint(20) DEFAULT NULL,
  `no_of_keywords` varchar(50) DEFAULT NULL,
  `subscription_start` varchar(100) DEFAULT NULL,
  `subscription_end` varchar(100) DEFAULT NULL,
  `status` int(11) DEFAULT '0' COMMENT '1 - active, 0 -inactive',
  `transaction_id` varchar(25) DEFAULT NULL,
  `longcode_type` varchar(100) DEFAULT NULL,
  `no_of_sms` int(11) DEFAULT NULL,
  `subscription_duration` varchar(50) DEFAULT NULL,
  `number_cost` varchar(10) DEFAULT NULL,
  `package_cost` varchar(10) DEFAULT NULL,
  `amount` varchar(10) DEFAULT NULL,
  `total_tax` varchar(10) DEFAULT NULL,
  `total_amount` varchar(10) DEFAULT NULL,
  `price_per_long_code` varchar(10) DEFAULT NULL,
  `created_on` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `longcode_tmp`
--

CREATE TABLE IF NOT EXISTS `longcode_tmp` (
  `longcode_id` int(11) NOT NULL,
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
  `created_on` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `longcode_user_renewal_info`
--

CREATE TABLE IF NOT EXISTS `longcode_user_renewal_info` (
  `longcode_id` int(11) NOT NULL DEFAULT '0',
  `service_type` varchar(50) DEFAULT NULL,
  `user_id` int(11) DEFAULT NULL,
  `longcode_number` bigint(20) DEFAULT NULL,
  `no_of_keywords` varchar(50) DEFAULT NULL,
  `subscription_start` varchar(100) DEFAULT NULL,
  `subscription_end` varchar(100) DEFAULT NULL,
  `status` int(11) DEFAULT '0' COMMENT '1 - active, 0 -inactive',
  `transaction_id` varchar(25) DEFAULT NULL,
  `longcode_type` varchar(100) DEFAULT NULL,
  `no_of_sms` int(11) DEFAULT NULL,
  `subscription_duration` varchar(50) DEFAULT NULL,
  `number_cost` varchar(10) DEFAULT NULL,
  `package_cost` varchar(10) DEFAULT NULL,
  `amount` varchar(10) DEFAULT NULL,
  `total_tax` varchar(10) DEFAULT NULL,
  `total_amount` varchar(10) DEFAULT NULL,
  `price_per_long_code` varchar(10) DEFAULT NULL,
  `created_on` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `long_short_codes`
--

CREATE TABLE IF NOT EXISTS `long_short_codes` (
  `code_id` int(11) NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `code_type` enum('LONG','SHORT') DEFAULT NULL,
  `code_number` bigint(20) DEFAULT NULL,
  `dump_url` varchar(200) DEFAULT NULL,
  `subscribed_on` datetime DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `long_short_code_keywords`
--

CREATE TABLE IF NOT EXISTS `long_short_code_keywords` (
  `lsck_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `long_code_id` int(11) NOT NULL,
  `ls_keyword` varchar(10) NOT NULL,
  `created_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `maxfashion_data`
--

CREATE TABLE IF NOT EXISTS `maxfashion_data` (
  `campaign_id` int(11) DEFAULT NULL,
  `sms_text` text CHARACTER SET utf8 COLLATE utf8_bin,
  `to_mobile_no` bigint(20) DEFAULT NULL,
  `created_on` datetime DEFAULT NULL,
  `dlr_status` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `maxfashion_from_vendor`
--

CREATE TABLE IF NOT EXISTS `maxfashion_from_vendor` (
  `mobile` varchar(15) NOT NULL,
  `date` varchar(30) NOT NULL,
  `dlr_status` varchar(30) NOT NULL,
  `text` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `mc_billing`
--

CREATE TABLE IF NOT EXISTS `mc_billing` (
  `mcbill_id` int(11) unsigned NOT NULL,
  `service_nos` varchar(200) NOT NULL,
  `mc_quantity` int(11) NOT NULL,
  `amount` decimal(10,2) NOT NULL,
  `cust_name` varchar(200) NOT NULL,
  `user_id` varchar(100) NOT NULL,
  `company_name` varchar(200) NOT NULL,
  `mobile` varchar(13) NOT NULL,
  `email` varchar(100) NOT NULL,
  `address1` varchar(200) NOT NULL,
  `address2` varchar(200) NOT NULL,
  `address3` varchar(200) NOT NULL,
  `state` varchar(100) NOT NULL,
  `city` varchar(100) NOT NULL,
  `pincode` int(10) NOT NULL,
  `description` varchar(255) NOT NULL,
  `plan` varchar(200) NOT NULL COMMENT 'Plan Types SMS, Missed Call, Long Code',
  `plan_days` int(10) NOT NULL,
  `plan_service` varchar(50) NOT NULL,
  `user_service` varchar(50) NOT NULL,
  `sms_credits` varchar(50) NOT NULL DEFAULT '0',
  `vc_amount` varchar(50) NOT NULL DEFAULT '0',
  `billing_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `renewal_date` varchar(50) NOT NULL COMMENT 'expire date of current package',
  `transaction_id` int(11) NOT NULL,
  `status` tinyint(2) NOT NULL DEFAULT '0',
  `response_code` varchar(200) DEFAULT NULL,
  `message` varchar(255) DEFAULT NULL,
  `RRN` varchar(200) DEFAULT NULL,
  `epg_txnID` varchar(200) DEFAULT NULL,
  `authcode` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `missedcall_services`
--

CREATE TABLE IF NOT EXISTS `missedcall_services` (
  `service_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `f1` varchar(10) NOT NULL,
  `f1_title` varchar(150) NOT NULL,
  `f2` varchar(10) NOT NULL,
  `f2_title` varchar(150) NOT NULL,
  `f3` varchar(10) NOT NULL,
  `f3_title` varchar(150) NOT NULL,
  `f4` varchar(10) NOT NULL,
  `f4_title` varchar(150) NOT NULL,
  `f5` varchar(10) NOT NULL,
  `f5_title` varchar(150) NOT NULL,
  `f6` varchar(10) NOT NULL,
  `f6_title` varchar(150) NOT NULL,
  `f7` varchar(10) NOT NULL,
  `f7_title` varchar(150) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `missed_calls`
--

CREATE TABLE IF NOT EXISTS `missed_calls` (
  `id` bigint(20) NOT NULL,
  `service_number` varchar(20) NOT NULL DEFAULT '',
  `called_from` varchar(20) NOT NULL DEFAULT '',
  `called_time` datetime NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `month_wiseapi_report`
--

CREATE TABLE IF NOT EXISTS `month_wiseapi_report` (
  `id` int(11) NOT NULL,
  `day` int(11) NOT NULL,
  `month` varchar(100) NOT NULL,
  `sms_count` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `year` int(11) NOT NULL,
  `sender_name` varchar(15) NOT NULL,
  `ondate` varchar(11) NOT NULL,
  `registration_on` varchar(20) NOT NULL,
  `login_time` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `month_wise_report`
--

CREATE TABLE IF NOT EXISTS `month_wise_report` (
  `id` int(11) NOT NULL,
  `day` int(11) NOT NULL,
  `month` varchar(100) NOT NULL,
  `sms_count` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `year` int(11) NOT NULL,
  `sender_name` varchar(15) NOT NULL,
  `ondate` varchar(11) NOT NULL,
  `registration_on` varchar(20) NOT NULL,
  `login_time` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `ndnc_data`
--

CREATE TABLE IF NOT EXISTS `ndnc_data` (
  `dnc_number` bigint(20) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `news_letter`
--

CREATE TABLE IF NOT EXISTS `news_letter` (
  `n_id` int(25) NOT NULL,
  `n_name` varchar(50) NOT NULL,
  `n_email` varchar(50) NOT NULL,
  `register_on` datetime DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `new_appointments`
--

CREATE TABLE IF NOT EXISTS `new_appointments` (
  `id` bigint(20) NOT NULL,
  `appointment_date` datetime NOT NULL,
  `client_name` varchar(50) NOT NULL,
  `mobile_number` bigint(20) NOT NULL,
  `address1` text NOT NULL,
  `address2` text NOT NULL,
  `city_id` int(11) NOT NULL,
  `state_id` int(11) NOT NULL,
  `pin_code` int(11) NOT NULL,
  `email` varchar(50) NOT NULL,
  `tele_caller_id` int(11) NOT NULL,
  `assigned_to_city_id` int(11) NOT NULL,
  `added_by` bigint(20) NOT NULL,
  `appointment_status` enum('1','2','3','4') NOT NULL DEFAULT '1' COMMENT '1=new.2=pending,3=closed,4=cancel',
  `created_date` datetime NOT NULL,
  `last_update` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `te_feedback` varchar(300) NOT NULL,
  `cust_int` tinyint(4) NOT NULL,
  `app_type` tinyint(4) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `new_appointments_fb`
--

CREATE TABLE IF NOT EXISTS `new_appointments_fb` (
  `app_fb_id` int(11) NOT NULL,
  `app_id` int(11) NOT NULL COMMENT 'appointment id',
  `feedback` varchar(400) NOT NULL,
  `created_on` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `user_id` int(11) NOT NULL,
  `fb_status` int(11) NOT NULL,
  `client_id` int(11) NOT NULL,
  `call_status` varchar(200) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `new_citylist`
--

CREATE TABLE IF NOT EXISTS `new_citylist` (
  `city_id` int(5) NOT NULL,
  `city_name` varchar(50) NOT NULL,
  `latitude` varchar(10) NOT NULL,
  `longitude` varchar(10) NOT NULL,
  `state` varchar(50) NOT NULL,
  `state_id` int(10) unsigned NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `new_dvr`
--

CREATE TABLE IF NOT EXISTS `new_dvr` (
  `id` bigint(20) NOT NULL,
  `_date` datetime NOT NULL,
  `organisation_name` varchar(50) NOT NULL,
  `customer_name` varchar(50) NOT NULL,
  `sector` varchar(100) NOT NULL,
  `mobile_number` bigint(20) NOT NULL,
  `address1` text NOT NULL,
  `address2` text NOT NULL,
  `city_id` int(11) NOT NULL,
  `state_id` int(11) NOT NULL,
  `pin_code` int(11) NOT NULL,
  `location` varchar(50) NOT NULL,
  `email` varchar(50) NOT NULL,
  `customer_type` enum('1','2') NOT NULL COMMENT '1=new.2=Existing',
  `sms_type` enum('0','1','2') NOT NULL COMMENT '0=Promotional.1=Transcational,2=Both',
  `order_value` float NOT NULL,
  `product_type` enum('0','1') NOT NULL COMMENT '0=Bulk SMS.1=Long Code,2=Voice Calls,3=Audio Conference,4=IVR,5=Toll Free,6=Missed Call Alerts',
  `required_quantity` float NOT NULL,
  `expected_price` float NOT NULL,
  `competetion_current_vendor` varchar(50) NOT NULL,
  `expected_date_of_closing` varchar(100) NOT NULL,
  `support_required` varchar(50) NOT NULL,
  `feedback` text NOT NULL,
  `tele_caller_id` int(11) NOT NULL,
  `sales_exe_id` int(11) NOT NULL,
  `added_by` bigint(20) NOT NULL,
  `created_date` datetime NOT NULL,
  `last_update` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `new_dvr_`
--

CREATE TABLE IF NOT EXISTS `new_dvr_` (
  `id` bigint(20) NOT NULL,
  `_date` datetime NOT NULL,
  `organisation_name` varchar(50) NOT NULL,
  `customer _name` varchar(50) NOT NULL,
  `sector` varchar(100) NOT NULL,
  `mobile_number` bigint(20) NOT NULL,
  `address1` text NOT NULL,
  `address2` text NOT NULL,
  `city_id` int(11) NOT NULL,
  `state_id` int(11) NOT NULL,
  `pin_code` int(11) NOT NULL,
  `location` varchar(50) NOT NULL,
  `email` varchar(50) NOT NULL,
  `customer_type` enum('1','2') NOT NULL COMMENT '1=new.2=Existing',
  `sms_type` enum('0','1','2') NOT NULL COMMENT '0=Promotional.1=Transcational,2=Both',
  `order_value` float NOT NULL,
  `promotional` bigint(20) NOT NULL,
  `transcational` bigint(20) NOT NULL,
  `total_sms` float NOT NULL,
  `product_type` enum('0','1') NOT NULL COMMENT '0=Bulk SMS.1=Broadcast',
  `purchase_order` varchar(50) NOT NULL,
  `required_quantity` float NOT NULL,
  `expected_price` float NOT NULL,
  `competetion_current_vendor` varchar(50) NOT NULL,
  `expected_date_of_closing` varchar(100) NOT NULL,
  `support_required` varchar(50) NOT NULL,
  `feedback` text NOT NULL,
  `tele_caller_id` int(11) NOT NULL,
  `sales_exe_id` int(11) NOT NULL,
  `assigned_to_city_id` int(11) NOT NULL,
  `added_by` bigint(20) NOT NULL,
  `appointment_status` enum('1','2','3','4') NOT NULL DEFAULT '1' COMMENT '1=new.2=pending,3=closed,4=cancel',
  `created_date` datetime NOT NULL,
  `last_update` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `new_orderbooking`
--

CREATE TABLE IF NOT EXISTS `new_orderbooking` (
  `id` bigint(20) NOT NULL,
  `appointment_date` datetime NOT NULL,
  `organisation_name` varchar(50) NOT NULL,
  `client_name` varchar(50) NOT NULL,
  `mobile_number` bigint(20) NOT NULL,
  `address1` text NOT NULL,
  `address2` text NOT NULL,
  `city_id` int(11) NOT NULL,
  `state_id` int(11) NOT NULL,
  `pin_code` int(11) NOT NULL,
  `location` varchar(50) NOT NULL,
  `email` varchar(50) NOT NULL,
  `customer_type` enum('1','2') NOT NULL COMMENT '1=new.2=Existing',
  `order_value` float NOT NULL,
  `promotional` bigint(20) NOT NULL,
  `transcational` bigint(20) NOT NULL,
  `total_sms` float NOT NULL,
  `product_type` enum('0','1') NOT NULL COMMENT '0=Bulk SMS.1=Broadcast',
  `purchase_order` varchar(50) NOT NULL,
  `remark` varchar(500) NOT NULL,
  `tele_caller_id` int(11) NOT NULL,
  `sales_exe_id` int(11) NOT NULL,
  `assigned_to_city_id` int(11) NOT NULL,
  `added_by` bigint(20) NOT NULL,
  `appointment_status` enum('1','2','3','4','5','6','7') NOT NULL DEFAULT '1' COMMENT '1=new,2=pending,3=closed,4=cancel,5=Follow UP,6=Appointment,7=''not interested''',
  `created_date` datetime NOT NULL,
  `last_update` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `is_tax` enum('1','2') NOT NULL COMMENT '1=Yes,2=No',
  `sector` int(11) NOT NULL,
  `meetingfrom` varchar(30) NOT NULL,
  `meetingto` varchar(30) NOT NULL,
  `mobile_number_alt` varchar(30) NOT NULL,
  `isreseller` int(11) NOT NULL DEFAULT '0' COMMENT '1=yes,0=no'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `new_report_emp`
--

CREATE TABLE IF NOT EXISTS `new_report_emp` (
  `report_id` int(11) NOT NULL,
  `noofcalls` int(11) NOT NULL,
  `positive_lead` int(11) NOT NULL,
  `noofapt` int(11) NOT NULL,
  `noofopen` int(11) NOT NULL,
  `noofclose` int(11) NOT NULL,
  `noofsms` int(11) NOT NULL,
  `longcode` varchar(50) NOT NULL,
  `amount` int(11) NOT NULL,
  `is_tax` enum('1','2') NOT NULL COMMENT '1=No,2=Yes',
  `created_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `_date` datetime NOT NULL,
  `variant` varchar(50) NOT NULL,
  `subscribe` varchar(50) NOT NULL,
  `added_by` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `new_statelist`
--

CREATE TABLE IF NOT EXISTS `new_statelist` (
  `state_id` int(10) unsigned NOT NULL,
  `state` varchar(50) NOT NULL,
  `country_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `notifications`
--

CREATE TABLE IF NOT EXISTS `notifications` (
  `id` int(50) NOT NULL,
  `title` varchar(100) NOT NULL,
  `body` varchar(200) NOT NULL,
  `icon` varchar(200) NOT NULL,
  `tag` varchar(200) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `notification_users`
--

CREATE TABLE IF NOT EXISTS `notification_users` (
  `id` int(11) NOT NULL,
  `ip_add` varchar(200) NOT NULL,
  `regId` varchar(255) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00' ON UPDATE CURRENT_TIMESTAMP
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `opertor_wise`
--

CREATE TABLE IF NOT EXISTS `opertor_wise` (
  `series` int(11) NOT NULL,
  `operator` varchar(255) NOT NULL,
  `circle` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `order_details`
--

CREATE TABLE IF NOT EXISTS `order_details` (
  `id` int(11) NOT NULL,
  `product_id` int(11) DEFAULT NULL,
  `description` varchar(50) DEFAULT NULL,
  `price` decimal(10,0) DEFAULT NULL,
  `longcode_type` varchar(50) DEFAULT NULL,
  `qty_ordered` int(11) DEFAULT NULL,
  `transaction_id` varchar(25) DEFAULT NULL,
  `user_id` int(11) DEFAULT NULL,
  `longcode_number` bigint(20) DEFAULT NULL,
  `created_on` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `order_numbers`
--

CREATE TABLE IF NOT EXISTS `order_numbers` (
  `service_id` int(11) NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `did_number` varchar(100) DEFAULT NULL,
  `did_type` varchar(100) DEFAULT NULL,
  `did_plan` varchar(100) DEFAULT NULL,
  `did_price` varchar(100) DEFAULT NULL,
  `status` int(11) NOT NULL DEFAULT '0' COMMENT '0-available,1-not available,2-payment_success',
  `created_on` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `pri_rental` varchar(100) DEFAULT NULL,
  `mobile_rental` varchar(100) DEFAULT NULL,
  `tollfree_rental` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `payment_status`
--

CREATE TABLE IF NOT EXISTS `payment_status` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `callstatus` varchar(100) NOT NULL,
  `paymentstatus` varchar(50) NOT NULL,
  `schedule_time` varchar(150) NOT NULL,
  `created_on` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `price_enquery`
--

CREATE TABLE IF NOT EXISTS `price_enquery` (
  `id` int(11) NOT NULL,
  `noofsms` int(11) DEFAULT NULL,
  `price_per_sms` varchar(100) NOT NULL DEFAULT '0',
  `smstype` varchar(50) DEFAULT NULL,
  `subcription` int(1) DEFAULT NULL,
  `name` varchar(50) DEFAULT NULL,
  `mobile` varchar(20) DEFAULT NULL,
  `email` varchar(80) DEFAULT NULL,
  `otpverify` int(2) DEFAULT NULL,
  `servicetype` varchar(10) DEFAULT NULL,
  `description` varchar(100) DEFAULT NULL COMMENT 'payment type',
  `longcode_numbers` varchar(255) DEFAULT NULL,
  `noofkeywords` varchar(100) DEFAULT NULL,
  `replytype` varchar(10) DEFAULT NULL,
  `otpcode` varchar(6) DEFAULT NULL,
  `otptime` varchar(15) DEFAULT NULL,
  `noofshorturl` int(11) DEFAULT NULL,
  `registeruser_id` int(11) DEFAULT NULL,
  `payment_status` int(11) DEFAULT '0',
  `is_created` int(11) DEFAULT '0',
  `transaction_id` varchar(30) DEFAULT NULL,
  `RRN` varchar(100) DEFAULT NULL,
  `epg_txnID` varchar(100) DEFAULT NULL,
  `authcode` varchar(100) DEFAULT NULL,
  `order_status` int(11) DEFAULT '0',
  `pgresponse` varchar(50) DEFAULT NULL,
  `total_amount` varchar(50) DEFAULT NULL,
  `amount` varchar(50) DEFAULT NULL,
  `tax_amount` varchar(50) DEFAULT NULL,
  `pgresponse_code` varchar(20) DEFAULT NULL,
  `created_on` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `cartid` varchar(80) DEFAULT NULL,
  `pagetype` enum('api','bulksms','excelplugin','otp','promotional','smpp','transactional') DEFAULT NULL COMMENT '1-api,2-bulk-sms,3-excel-plug-in,4-otp,5-promotional,6-smpp,7-transactional'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `profile_images`
--

CREATE TABLE IF NOT EXISTS `profile_images` (
  `id` int(11) NOT NULL,
  `profile_img` varchar(100) NOT NULL,
  `profile_backgroundimg` varchar(100) NOT NULL,
  `user_id` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `region`
--

CREATE TABLE IF NOT EXISTS `region` (
  `id` int(10) NOT NULL,
  `region` varchar(100) NOT NULL DEFAULT '',
  `weightage` float NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `rental_payment`
--

CREATE TABLE IF NOT EXISTS `rental_payment` (
  `payment_id` int(11) NOT NULL,
  `lms_user_id` int(11) NOT NULL,
  `no_of_users` int(11) NOT NULL,
  `missedcall_rental` varchar(100) NOT NULL,
  `payment_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `user_rental` varchar(100) NOT NULL,
  `total_rental` varchar(100) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `schedule_api_campaigns_to`
--

CREATE TABLE IF NOT EXISTS `schedule_api_campaigns_to` (
  `job_id` int(11) DEFAULT NULL,
  `sender_name` varchar(10) NOT NULL,
  `sms_text` text,
  `to_mobile_no` bigint(20) DEFAULT NULL,
  `created_on` datetime DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `schedule_campaigns_to`
--

CREATE TABLE IF NOT EXISTS `schedule_campaigns_to` (
  `campaign_id` int(11) DEFAULT NULL,
  `unique_msg_id` varchar(50) DEFAULT NULL,
  `sms_text` text CHARACTER SET utf8 COLLATE utf8_bin,
  `to_mobile_no` bigint(20) DEFAULT NULL,
  `created_on` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `schedule_campaigns_to_01_03_2014`
--

CREATE TABLE IF NOT EXISTS `schedule_campaigns_to_01_03_2014` (
  `campaign_id` int(11) DEFAULT NULL,
  `sms_text` text,
  `to_mobile_no` bigint(20) DEFAULT NULL,
  `created_on` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `schedule_campaigns_to_9_1`
--

CREATE TABLE IF NOT EXISTS `schedule_campaigns_to_9_1` (
  `campaign_id` int(11) DEFAULT NULL,
  `unique_msg_id` varchar(50) DEFAULT NULL,
  `sms_text` text CHARACTER SET utf8 COLLATE utf8_bin,
  `to_mobile_no` bigint(20) DEFAULT NULL,
  `created_on` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `schedule_campaigns_to_temp`
--

CREATE TABLE IF NOT EXISTS `schedule_campaigns_to_temp` (
  `campaign_id` int(11) DEFAULT NULL,
  `sms_text` text CHARACTER SET utf8 COLLATE utf8_bin,
  `to_mobile_no` bigint(20) DEFAULT NULL,
  `created_on` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `sender_names`
--

CREATE TABLE IF NOT EXISTS `sender_names` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL DEFAULT '0',
  `firstring_userid` int(25) DEFAULT '0',
  `voicestriker_userid` int(25) DEFAULT '0',
  `sender_name` varchar(13) DEFAULT NULL,
  `status` tinyint(4) NOT NULL DEFAULT '0' COMMENT '2-reject,1-accept,0-pending',
  `on_date` datetime DEFAULT NULL,
  `added_by` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `series_wise`
--

CREATE TABLE IF NOT EXISTS `series_wise` (
  `Number_Starts_With` char(18) DEFAULT NULL,
  `Network_Operator_Code` char(21) DEFAULT NULL,
  `Service_Areas_Code` char(18) DEFAULT NULL,
  `Series` char(6) DEFAULT NULL,
  `Network_Operator_Name` varchar(100) DEFAULT NULL,
  `Service_Areas` varchar(150) DEFAULT NULL,
  `sbi_headoffice` varchar(50) DEFAULT NULL,
  `sbi_areascovered` text,
  `zonecode` varchar(10) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `service_nos`
--

CREATE TABLE IF NOT EXISTS `service_nos` (
  `service_id` int(11) unsigned NOT NULL,
  `service_no` varchar(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `status` int(11) NOT NULL,
  `isActive` varchar(50) NOT NULL DEFAULT 'No',
  `sno_type` varchar(50) NOT NULL,
  `price` decimal(10,2) NOT NULL,
  `modify_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `service_type`
--

CREATE TABLE IF NOT EXISTS `service_type` (
  `id` int(11) NOT NULL,
  `service_type` varchar(100) NOT NULL,
  `user_id` varchar(100) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `shorturl_table_info`
--

CREATE TABLE IF NOT EXISTS `shorturl_table_info` (
  `id` int(11) NOT NULL,
  `ip_address` varchar(50) NOT NULL,
  `device_type` text NOT NULL,
  `browser_type` text NOT NULL,
  `short_url` text NOT NULL,
  `created_on` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `sms_alerts`
--

CREATE TABLE IF NOT EXISTS `sms_alerts` (
  `alert_id` int(11) NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `field_id` int(11) DEFAULT NULL,
  `field_name` varchar(20) DEFAULT NULL,
  `sms_text` tinytext,
  `days_before` int(11) DEFAULT NULL,
  `on_time` time DEFAULT NULL,
  `status` enum('0','1','2') NOT NULL DEFAULT '1',
  `created_on` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `sms_api_daily_count`
--

CREATE TABLE IF NOT EXISTS `sms_api_daily_count` (
  `daily_count_id` int(11) NOT NULL,
  `on_date` date DEFAULT NULL,
  `user_id` int(11) DEFAULT NULL,
  `sender_name` varchar(13) NOT NULL,
  `sms_count` int(11) DEFAULT NULL,
  `delivered_count` int(11) DEFAULT NULL,
  `dnd_count` int(11) DEFAULT NULL,
  `expired_count` int(11) NOT NULL,
  `invalid_count` int(11) NOT NULL,
  `pending_dlrs_count` int(11) NOT NULL DEFAULT '0'
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `sms_api_job_ids`
--

CREATE TABLE IF NOT EXISTS `sms_api_job_ids` (
  `job_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `sender_name` varchar(10) DEFAULT '',
  `message` varchar(800) DEFAULT '',
  `noofmessages` tinyint(4) DEFAULT '0',
  `created_on` datetime NOT NULL,
  `is_scheduled` tinyint(4) DEFAULT '0' COMMENT '1-scheduled,0-not scheduled',
  `scheduled_on` datetime DEFAULT NULL,
  `campaign_status` tinyint(4) DEFAULT '0' COMMENT '0-new,1-scheduled,2-completed'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `sms_api_messages`
--

CREATE TABLE IF NOT EXISTS `sms_api_messages` (
  `message_id` int(11) NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `sender_name` varchar(13) DEFAULT NULL,
  `message` tinytext,
  `noofmessages` int(11) DEFAULT NULL,
  `to_mobileno` bigint(100) DEFAULT NULL,
  `ondate` datetime DEFAULT NULL,
  `dlr_status` int(11) NOT NULL DEFAULT '0',
  `delivered_on` datetime DEFAULT NULL,
  `error_code` varchar(6) DEFAULT '',
  `error_text` varchar(100) DEFAULT NULL,
  `job_id` int(11) DEFAULT NULL,
  `port_no` varchar(6) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `sms_api_messages_apsrtc`
--

CREATE TABLE IF NOT EXISTS `sms_api_messages_apsrtc` (
  `message_id` int(11) NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `sender_name` varchar(13) DEFAULT NULL,
  `message` text,
  `noofmessages` int(11) DEFAULT NULL,
  `to_mobileno` bigint(100) DEFAULT NULL,
  `ondate` datetime DEFAULT NULL,
  `dlr_status` int(11) NOT NULL DEFAULT '0',
  `delivered_on` datetime DEFAULT NULL,
  `error_code` varchar(6) NOT NULL,
  `error_text` varchar(100) DEFAULT NULL,
  `job_id` int(11) DEFAULT NULL,
  `port_no` varchar(6) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `sms_api_messages_tsrtc`
--

CREATE TABLE IF NOT EXISTS `sms_api_messages_tsrtc` (
  `message_id` int(11) NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `sender_name` varchar(13) DEFAULT NULL,
  `message` text,
  `noofmessages` int(11) DEFAULT NULL,
  `to_mobileno` bigint(100) DEFAULT NULL,
  `ondate` datetime DEFAULT NULL,
  `dlr_status` int(11) NOT NULL DEFAULT '0',
  `delivered_on` datetime DEFAULT NULL,
  `error_code` varchar(6) NOT NULL,
  `error_text` varchar(100) DEFAULT NULL,
  `job_id` int(11) DEFAULT NULL,
  `port_no` varchar(6) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `sms_inbox`
--

CREATE TABLE IF NOT EXISTS `sms_inbox` (
  `inbox_id` int(11) NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `code_id` int(11) DEFAULT NULL,
  `from_number` bigint(20) DEFAULT NULL,
  `sms_text` tinytext,
  `received_on` varchar(100) DEFAULT NULL,
  `created_on` datetime DEFAULT NULL,
  `is_dumped` tinyint(4) NOT NULL DEFAULT '0',
  `is_sms_sent` tinyint(4) NOT NULL COMMENT '1- send ,0-notsend,2-processing',
  `key_word` varchar(20) NOT NULL,
  `service_number` varchar(20) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `sms_log`
--

CREATE TABLE IF NOT EXISTS `sms_log` (
  `id` bigint(20) NOT NULL,
  `service_number` varchar(20) NOT NULL DEFAULT '',
  `log_from` varchar(20) NOT NULL DEFAULT '',
  `log_time` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `log_response` varchar(80) NOT NULL DEFAULT ''
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `sms_messages`
--

CREATE TABLE IF NOT EXISTS `sms_messages` (
  `id` bigint(20) NOT NULL,
  `service_number` varchar(20) NOT NULL DEFAULT '',
  `message_from` varchar(20) NOT NULL DEFAULT '',
  `message` varchar(200) NOT NULL DEFAULT '',
  `message_time` datetime NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `sms_price_list`
--

CREATE TABLE IF NOT EXISTS `sms_price_list` (
  `id` int(11) NOT NULL,
  `pkg_range` varchar(100) NOT NULL,
  `promotional` varchar(100) NOT NULL,
  `transactional` varchar(100) NOT NULL,
  `semitrans` varchar(100) DEFAULT NULL,
  `otp` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `sms_price_list1`
--

CREATE TABLE IF NOT EXISTS `sms_price_list1` (
  `id` int(11) NOT NULL,
  `pkg_range` varchar(100) NOT NULL,
  `promotional` varchar(100) NOT NULL,
  `transactional` varchar(100) NOT NULL,
  `semitrans` varchar(100) DEFAULT NULL,
  `otp` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `sms_queue`
--

CREATE TABLE IF NOT EXISTS `sms_queue` (
  `port_no` int(11) DEFAULT NULL,
  `sending_port_no` int(11) DEFAULT NULL,
  `queued` bigint(20) DEFAULT NULL,
  `failed` bigint(20) DEFAULT NULL,
  `sent` bigint(20) DEFAULT NULL,
  `received` bigint(20) DEFAULT NULL,
  `online` varchar(20) DEFAULT NULL,
  `priority` enum('P2','P3') DEFAULT NULL,
  `application_priority` varchar(5) DEFAULT NULL COMMENT 'OBC - ONLY BIG CAMPAIGNS',
  `comments` varchar(255) DEFAULT NULL,
  `used_for` varchar(15) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `sms_templates`
--

CREATE TABLE IF NOT EXISTS `sms_templates` (
  `template_id` int(11) NOT NULL,
  `sms_template` tinytext,
  `user_id` int(11) DEFAULT '0',
  `on_date` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `sms_types`
--

CREATE TABLE IF NOT EXISTS `sms_types` (
  `sms_type_id` int(11) NOT NULL,
  `sms_type` varchar(15) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `states`
--

CREATE TABLE IF NOT EXISTS `states` (
  `state_id` int(10) NOT NULL,
  `state` varchar(100) NOT NULL DEFAULT ''
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_books`
--

CREATE TABLE IF NOT EXISTS `tbl_books` (
  `id` int(8) NOT NULL,
  `name` varchar(100) NOT NULL,
  `author` varchar(30) NOT NULL,
  `isbn` varchar(30) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_user`
--

CREATE TABLE IF NOT EXISTS `tbl_user` (
  `id` int(11) NOT NULL,
  `username` varchar(128) NOT NULL,
  `password` varchar(128) NOT NULL,
  `email` varchar(128) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `techsupport_client_fb`
--

CREATE TABLE IF NOT EXISTS `techsupport_client_fb` (
  `app_fb_id` int(11) NOT NULL,
  `app_id` int(11) NOT NULL COMMENT 'appointment id',
  `feedback` varchar(400) NOT NULL,
  `created_on` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `user_id` int(11) NOT NULL,
  `fb_status` int(11) NOT NULL,
  `client_name` varchar(255) NOT NULL,
  `email` varchar(100) NOT NULL,
  `mobile` varchar(15) NOT NULL,
  `organization` varchar(255) NOT NULL,
  `call_status` varchar(100) NOT NULL,
  `call_type` varchar(100) NOT NULL,
  `reason` varchar(100) NOT NULL,
  `commented_by` varchar(100) NOT NULL,
  `call_duration` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `tele_callers`
--

CREATE TABLE IF NOT EXISTS `tele_callers` (
  `caller_id` int(11) NOT NULL,
  `first_name` varchar(50) NOT NULL,
  `last_name` varchar(25) NOT NULL,
  `phone_no1` varchar(12) NOT NULL,
  `city_id` int(11) NOT NULL,
  `status` int(11) NOT NULL DEFAULT '1' COMMENT '0-inactive,1-active'
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `templates`
--

CREATE TABLE IF NOT EXISTS `templates` (
  `template_id` int(11) NOT NULL,
  `template` text,
  `template_name` varchar(100) DEFAULT NULL,
  `user_id` int(11) DEFAULT '0',
  `status` varchar(10) NOT NULL,
  `added_by` int(11) NOT NULL,
  `on_date` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `templates_dup`
--

CREATE TABLE IF NOT EXISTS `templates_dup` (
  `template` text,
  `user_id` int(11) DEFAULT '0',
  `status` varchar(10) DEFAULT NULL,
  `added_by` int(11) DEFAULT NULL,
  `on_date` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `temp_sendernames`
--

CREATE TABLE IF NOT EXISTS `temp_sendernames` (
  `sno` int(11) NOT NULL,
  `sendername` varchar(30) NOT NULL,
  `email` varchar(30) NOT NULL,
  `user_id` int(20) NOT NULL,
  `on_date` varchar(100) NOT NULL,
  `status` int(25) NOT NULL DEFAULT '0'
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `transaction_history`
--

CREATE TABLE IF NOT EXISTS `transaction_history` (
  `payment_id` int(11) NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `created_on` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `payment_status` varchar(100) DEFAULT '0',
  `noofsms` int(11) DEFAULT NULL,
  `sms_price` varchar(100) DEFAULT NULL,
  `amount` int(11) DEFAULT NULL,
  `tax_amount` int(11) DEFAULT NULL,
  `total_amount` int(11) DEFAULT NULL,
  `transaction_id` int(11) DEFAULT NULL,
  `pgresponse_code` varchar(100) DEFAULT NULL,
  `RRN` varchar(100) DEFAULT NULL,
  `epg_txnID` varchar(100) DEFAULT NULL,
  `authcode` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `tran_sms`
--

CREATE TABLE IF NOT EXISTS `tran_sms` (
  `id` int(11) NOT NULL,
  `campaign_type` enum('API','CAMP') NOT NULL,
  `campaign_id` bigint(20) NOT NULL,
  `to_mobile_no` bigint(20) NOT NULL,
  `dlr` int(11) NOT NULL,
  `on_date` datetime NOT NULL,
  `status` tinyint(4) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `trn_session_log`
--

CREATE TABLE IF NOT EXISTS `trn_session_log` (
  `session_log_id` bigint(20) unsigned NOT NULL,
  `user_id` bigint(20) DEFAULT NULL,
  `user_type` varchar(30) DEFAULT NULL,
  `group_id` varchar(20) DEFAULT NULL,
  `dialer_method` varchar(20) DEFAULT NULL,
  `remote_ip` varchar(15) DEFAULT NULL,
  `session_name` varchar(50) DEFAULT NULL,
  `event` enum('LOGIN','LOGOUT','FLOGOUT','BREAK') DEFAULT NULL,
  `entry_time` datetime DEFAULT '0000-00-00 00:00:00',
  `end_time` datetime DEFAULT '0000-00-00 00:00:00',
  `update_time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `uploaddata`
--

CREATE TABLE IF NOT EXISTS `uploaddata` (
  `numbers` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `userbulkurlsmsprice`
--

CREATE TABLE IF NOT EXISTS `userbulkurlsmsprice` (
  `id` int(11) NOT NULL,
  `min_no_of_url` int(11) DEFAULT NULL,
  `max_no_of_url` int(11) DEFAULT NULL,
  `smsprice` varchar(11) DEFAULT NULL,
  `created_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE IF NOT EXISTS `users` (
  `user_id` int(11) NOT NULL,
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
  `is_ftp` int(11) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `users1`
--

CREATE TABLE IF NOT EXISTS `users1` (
  `user_id` int(11) NOT NULL,
  `username` varchar(45) NOT NULL,
  `password` varchar(64) NOT NULL,
  `first_name` varchar(45) DEFAULT NULL,
  `last_name` varchar(45) DEFAULT NULL,
  `email` varchar(60) DEFAULT NULL,
  `emailid_org` varchar(60) NOT NULL,
  `mobile` bigint(20) DEFAULT NULL,
  `mobileno_org` bigint(20) NOT NULL,
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
  `mverify` int(11) NOT NULL,
  `duplicate_content` int(11) NOT NULL,
  `max_ports` varchar(10) NOT NULL DEFAULT '10',
  `max_participants` varchar(20) NOT NULL DEFAULT '10',
  `voice_users` int(25) NOT NULL DEFAULT '0',
  `is_missedcall` int(11) NOT NULL DEFAULT '0',
  `api_key` varchar(255) NOT NULL,
  `is_obd` int(11) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `users_1`
--

CREATE TABLE IF NOT EXISTS `users_1` (
  `user_id` int(11) NOT NULL,
  `username` varchar(45) NOT NULL,
  `password` varchar(64) NOT NULL,
  `first_name` varchar(45) DEFAULT NULL,
  `last_name` varchar(45) DEFAULT NULL,
  `email` varchar(60) DEFAULT NULL,
  `mobile` bigint(20) DEFAULT NULL,
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
  `international_available_credits` int(11) NOT NULL DEFAULT '0',
  `is_blocked` tinyint(1) NOT NULL DEFAULT '0',
  `no_ndnc` tinyint(4) NOT NULL DEFAULT '0',
  `dlr_enabled` tinyint(4) NOT NULL DEFAULT '0',
  `is_reseller` tinyint(4) NOT NULL DEFAULT '0',
  `reseller_id` int(11) NOT NULL DEFAULT '0',
  `priority` enum('P2','P3') NOT NULL DEFAULT 'P3',
  `sending_percentage` int(11) NOT NULL DEFAULT '100',
  `return_ndnc_credits` tinyint(4) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `users_bkup`
--

CREATE TABLE IF NOT EXISTS `users_bkup` (
  `user_id` int(11) NOT NULL,
  `username` varchar(45) NOT NULL,
  `password` varchar(64) NOT NULL,
  `first_name` varchar(45) DEFAULT NULL,
  `last_name` varchar(45) DEFAULT NULL,
  `email` varchar(60) DEFAULT NULL,
  `emailid_org` varchar(60) NOT NULL,
  `mobile` bigint(20) DEFAULT NULL,
  `mobileno_org` bigint(20) NOT NULL,
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
  `international_available_credits` int(11) NOT NULL DEFAULT '0',
  `is_blocked` tinyint(1) NOT NULL DEFAULT '0',
  `no_ndnc` tinyint(4) NOT NULL DEFAULT '0',
  `dlr_enabled` tinyint(4) NOT NULL DEFAULT '0' COMMENT '0 = no dlr, 1 = only dnd, 2 = all dlrs',
  `is_reseller` tinyint(4) NOT NULL DEFAULT '0',
  `reseller_id` int(11) NOT NULL DEFAULT '0',
  `priority` enum('P2','P3') NOT NULL DEFAULT 'P3',
  `sending_percentage` int(11) NOT NULL DEFAULT '100',
  `return_ndnc_credits` tinyint(4) NOT NULL DEFAULT '0',
  `from_striker` tinyint(4) NOT NULL DEFAULT '0',
  `assigned_to` int(11) NOT NULL DEFAULT '0',
  `template_check` tinyint(4) NOT NULL DEFAULT '1',
  `resend_enabled` tinyint(4) NOT NULL DEFAULT '0' COMMENT '0-not enabled,1-enabled',
  `dnd_check` tinyint(4) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `users_test`
--

CREATE TABLE IF NOT EXISTS `users_test` (
  `user_id` int(11) NOT NULL,
  `username` varchar(45) NOT NULL,
  `password` varchar(64) NOT NULL,
  `first_name` varchar(45) DEFAULT NULL,
  `last_name` varchar(45) DEFAULT NULL,
  `email` varchar(60) DEFAULT NULL,
  `emailid_org` varchar(60) NOT NULL,
  `mobile` bigint(20) DEFAULT NULL,
  `mobileno_org` bigint(20) NOT NULL,
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
  `mverify` int(11) NOT NULL,
  `is_missedcall` int(11) NOT NULL DEFAULT '0',
  `voice_users` int(11) NOT NULL DEFAULT '0',
  `max_ports` int(11) NOT NULL DEFAULT '0',
  `max_participants` int(11) NOT NULL DEFAULT '10'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `user_bulk_shorturl`
--

CREATE TABLE IF NOT EXISTS `user_bulk_shorturl` (
  `url_id` int(11) NOT NULL,
  `shorturl_id` int(11) NOT NULL,
  `shorturl` varchar(100) DEFAULT NULL,
  `shortCode` varchar(40) DEFAULT NULL,
  `created_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `user_collections`
--

CREATE TABLE IF NOT EXISTS `user_collections` (
  `collection_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `amount` double NOT NULL,
  `income_tax` tinyint(4) DEFAULT NULL,
  `income_tax_percent` float NOT NULL DEFAULT '0',
  `grand_total` double NOT NULL,
  `pay_mode` int(11) DEFAULT NULL,
  `ref_no` varchar(45) DEFAULT NULL,
  `from_bank` varchar(100) DEFAULT NULL,
  `payment_status` int(11) DEFAULT NULL,
  `on_date` datetime DEFAULT NULL,
  `added_by` int(11) DEFAULT NULL,
  `last_updated_on` datetime DEFAULT NULL,
  `last_updated_by` int(11) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `user_credits_logs`
--

CREATE TABLE IF NOT EXISTS `user_credits_logs` (
  `id` int(11) NOT NULL,
  `before_campaign_credits` bigint(20) NOT NULL,
  `after_campaign_credits` bigint(20) NOT NULL,
  `current_campaign_credits` bigint(20) NOT NULL,
  `user_id` int(11) NOT NULL,
  `campaign_id` int(11) NOT NULL,
  `job_id` int(11) NOT NULL,
  `date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `user_long_code_keywords`
--

CREATE TABLE IF NOT EXISTS `user_long_code_keywords` (
  `keyword_id` int(11) NOT NULL,
  `keyword` varchar(10) NOT NULL,
  `user_id` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `user_payments`
--

CREATE TABLE IF NOT EXISTS `user_payments` (
  `payment_id` int(11) NOT NULL,
  `collected_by` int(11) DEFAULT NULL,
  `user_id` int(11) NOT NULL DEFAULT '0',
  `no_of_sms` int(11) NOT NULL DEFAULT '0',
  `price` float NOT NULL DEFAULT '0',
  `amount` float NOT NULL DEFAULT '0',
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
  `pulse_per_second` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `user_sales_executives_tracking`
--

CREATE TABLE IF NOT EXISTS `user_sales_executives_tracking` (
  `track_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `old_executive_id` int(11) NOT NULL,
  `new_executive_id` int(11) NOT NULL,
  `remarks` varchar(100) NOT NULL,
  `changed_by` int(11) NOT NULL,
  `on_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `user_shorturl`
--

CREATE TABLE IF NOT EXISTS `user_shorturl` (
  `shorturl_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `long_url` varchar(100) DEFAULT NULL,
  `number_of_url` int(11) DEFAULT NULL,
  `credits` float DEFAULT NULL,
  `created_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `user_sms_balcheck`
--

CREATE TABLE IF NOT EXISTS `user_sms_balcheck` (
  `id` int(11) NOT NULL,
  `bal` int(11) NOT NULL,
  `percent_check` varchar(20) NOT NULL,
  `user_id` int(11) NOT NULL,
  `created_on` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `reseller_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `user_types`
--

CREATE TABLE IF NOT EXISTS `user_types` (
  `id` int(11) NOT NULL,
  `user_type` varchar(100) NOT NULL,
  `no_dnc` varchar(100) NOT NULL,
  `dnd_check` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `vendordetails`
--

CREATE TABLE IF NOT EXISTS `vendordetails` (
  `sno` int(11) NOT NULL,
  `usernames` longtext NOT NULL,
  `vender_emails` longtext NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `vendordetails_test`
--

CREATE TABLE IF NOT EXISTS `vendordetails_test` (
  `sno` int(11) NOT NULL,
  `usernames` longtext NOT NULL,
  `vender_emails` longtext NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `vendor_dailybal`
--

CREATE TABLE IF NOT EXISTS `vendor_dailybal` (
  `id` int(11) NOT NULL,
  `bal` int(11) NOT NULL,
  `actype` enum('0','1','2') NOT NULL COMMENT '1=promo,0=trans,2=scrub',
  `username` varchar(20) NOT NULL,
  `vendor_name` varchar(20) NOT NULL,
  `bal_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin_campaigns`
--
ALTER TABLE `admin_campaigns`
  ADD PRIMARY KEY (`admin_campaign_id`);

--
-- Indexes for table `admin_table`
--
ALTER TABLE `admin_table`
  ADD PRIMARY KEY (`admin_id`),
  ADD UNIQUE KEY `user_name` (`user_name`);

--
-- Indexes for table `agent_numbers`
--
ALTER TABLE `agent_numbers`
  ADD PRIMARY KEY (`sno`);

--
-- Indexes for table `alerts_to_groups`
--
ALTER TABLE `alerts_to_groups`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `allow_ip`
--
ALTER TABLE `allow_ip`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `api_keys`
--
ALTER TABLE `api_keys`
  ADD PRIMARY KEY (`sno`);

--
-- Indexes for table `appointments_history`
--
ALTER TABLE `appointments_history`
  ADD PRIMARY KEY (`app_history_id`);

--
-- Indexes for table `block_listed_numbers`
--
ALTER TABLE `block_listed_numbers`
  ADD KEY `block_listed` (`mobile_no`);

--
-- Indexes for table `business_application`
--
ALTER TABLE `business_application`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `call_type`
--
ALTER TABLE `call_type`
  ADD PRIMARY KEY (`call_id`);

--
-- Indexes for table `campaigns`
--
ALTER TABLE `campaigns`
  ADD PRIMARY KEY (`campaign_id`),
  ADD KEY `user_campaigns` (`campaign_id`,`user_id`),
  ADD KEY `campaign_name` (`campaign_name`),
  ADD KEY `campaign_status` (`campaign_status`,`is_scheduled`,`scheduled_on`),
  ADD KEY `created_on` (`created_on`),
  ADD KEY `user_id` (`user_id`,`campaign_status`);

--
-- Indexes for table `campaigns_1`
--
ALTER TABLE `campaigns_1`
  ADD PRIMARY KEY (`campaign_id`),
  ADD KEY `user_campaigns` (`campaign_id`,`user_id`),
  ADD KEY `campaign_name` (`campaign_name`),
  ADD KEY `campaign_status` (`campaign_status`,`is_scheduled`,`scheduled_on`),
  ADD KEY `created_on` (`created_on`),
  ADD KEY `user_id` (`user_id`,`campaign_status`);

--
-- Indexes for table `campaigns_to`
--
ALTER TABLE `campaigns_to`
  ADD KEY `campaign_id` (`campaign_id`),
  ADD KEY `mobile_index` (`to_mobile_no`);

--
-- Indexes for table `campaigns_tobackup`
--
ALTER TABLE `campaigns_tobackup`
  ADD KEY `campaign_id` (`campaign_id`),
  ADD KEY `mobile_index` (`to_mobile_no`),
  ADD KEY `campaign` (`campaign_id`,`to_mobile_no`);

--
-- Indexes for table `campaigns_totest`
--
ALTER TABLE `campaigns_totest`
  ADD KEY `campaign_id` (`campaign_id`),
  ADD KEY `mobile_index` (`to_mobile_no`),
  ADD KEY `campaign` (`campaign_id`,`to_mobile_no`);

--
-- Indexes for table `camp_mobile_temp97`
--
ALTER TABLE `camp_mobile_temp97`
  ADD KEY `job_ind` (`job_id`),
  ADD KEY `mob_ind` (`mobile_no`);

--
-- Indexes for table `camp_mobile_temp98`
--
ALTER TABLE `camp_mobile_temp98`
  ADD KEY `job_ind` (`job_id`),
  ADD KEY `mob_ind` (`mobile_no`);

--
-- Indexes for table `CARE_PWDS`
--
ALTER TABLE `CARE_PWDS`
  ADD PRIMARY KEY (`Id`);

--
-- Indexes for table `college_enquireform`
--
ALTER TABLE `college_enquireform`
  ADD PRIMARY KEY (`sno`);

--
-- Indexes for table `contacts`
--
ALTER TABLE `contacts`
  ADD PRIMARY KEY (`contact_id`),
  ADD KEY `contacts_group_id` (`group_id`);

--
-- Indexes for table `contact_form`
--
ALTER TABLE `contact_form`
  ADD PRIMARY KEY (`contact_id`);

--
-- Indexes for table `contact_groups`
--
ALTER TABLE `contact_groups`
  ADD PRIMARY KEY (`group_id`),
  ADD KEY `group_user_id` (`user_id`);

--
-- Indexes for table `duplicatecheck`
--
ALTER TABLE `duplicatecheck`
  ADD UNIQUE KEY `unique` (`md5text`),
  ADD KEY `cIdx` (`datetime`);

--
-- Indexes for table `email_templates`
--
ALTER TABLE `email_templates`
  ADD PRIMARY KEY (`template_id`);

--
-- Indexes for table `feedback`
--
ALTER TABLE `feedback`
  ADD PRIMARY KEY (`fid`);

--
-- Indexes for table `ftp_campaign`
--
ALTER TABLE `ftp_campaign`
  ADD PRIMARY KEY (`campaign_id`);

--
-- Indexes for table `ftp_campaigns_to`
--
ALTER TABLE `ftp_campaigns_to`
  ADD KEY `campaign_id` (`campaign_id`),
  ADD KEY `mobile_index` (`to_mobile_no`),
  ADD KEY `campaign` (`campaign_id`,`to_mobile_no`),
  ADD KEY `campaign_id_2` (`campaign_id`);

--
-- Indexes for table `generate_invoice`
--
ALTER TABLE `generate_invoice`
  ADD PRIMARY KEY (`invoice_id`);

--
-- Indexes for table `global_settings`
--
ALTER TABLE `global_settings`
  ADD PRIMARY KEY (`setting_id`);

--
-- Indexes for table `groups`
--
ALTER TABLE `groups`
  ADD PRIMARY KEY (`group_id`);

--
-- Indexes for table `invoices`
--
ALTER TABLE `invoices`
  ADD PRIMARY KEY (`invoice_id`);

--
-- Indexes for table `large_campaign_activities`
--
ALTER TABLE `large_campaign_activities`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `large_campaign_activities_new`
--
ALTER TABLE `large_campaign_activities_new`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `leads`
--
ALTER TABLE `leads`
  ADD PRIMARY KEY (`user_id`);

--
-- Indexes for table `leave_managment`
--
ALTER TABLE `leave_managment`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `loginhistory`
--
ALTER TABLE `loginhistory`
  ADD PRIMARY KEY (`id`),
  ADD KEY `ip_id` (`ip_id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `login_attendance`
--
ALTER TABLE `login_attendance`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `login_ips`
--
ALTER TABLE `login_ips`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `ip` (`ip`);

--
-- Indexes for table `longcode_config`
--
ALTER TABLE `longcode_config`
  ADD PRIMARY KEY (`longcode_id`);

--
-- Indexes for table `longcode_keywords`
--
ALTER TABLE `longcode_keywords`
  ADD PRIMARY KEY (`keyword_id`);

--
-- Indexes for table `longcode_keyword_price`
--
ALTER TABLE `longcode_keyword_price`
  ADD PRIMARY KEY (`price_id`);

--
-- Indexes for table `longcode_numbers`
--
ALTER TABLE `longcode_numbers`
  ADD PRIMARY KEY (`longcode_id`);

--
-- Indexes for table `longcode_packages`
--
ALTER TABLE `longcode_packages`
  ADD PRIMARY KEY (`package_id`);

--
-- Indexes for table `longcode_plan_price`
--
ALTER TABLE `longcode_plan_price`
  ADD PRIMARY KEY (`plan_id`);

--
-- Indexes for table `longcode_smsmessages`
--
ALTER TABLE `longcode_smsmessages`
  ADD PRIMARY KEY (`id`),
  ADD KEY `created_on` (`created_on`),
  ADD KEY `message_time` (`message_time`),
  ADD KEY `message_time_2` (`message_time`),
  ADD KEY `message_from` (`message_from`);

--
-- Indexes for table `longcode_subscription`
--
ALTER TABLE `longcode_subscription`
  ADD PRIMARY KEY (`longcode_id`);

--
-- Indexes for table `longcode_tmp`
--
ALTER TABLE `longcode_tmp`
  ADD PRIMARY KEY (`longcode_id`);

--
-- Indexes for table `longcode_user_renewal_info`
--
ALTER TABLE `longcode_user_renewal_info`
  ADD PRIMARY KEY (`longcode_id`);

--
-- Indexes for table `long_short_codes`
--
ALTER TABLE `long_short_codes`
  ADD PRIMARY KEY (`code_id`);

--
-- Indexes for table `long_short_code_keywords`
--
ALTER TABLE `long_short_code_keywords`
  ADD PRIMARY KEY (`lsck_id`);

--
-- Indexes for table `maxfashion_data`
--
ALTER TABLE `maxfashion_data`
  ADD KEY `campaign_id` (`campaign_id`);

--
-- Indexes for table `mc_billing`
--
ALTER TABLE `mc_billing`
  ADD PRIMARY KEY (`mcbill_id`);

--
-- Indexes for table `missedcall_services`
--
ALTER TABLE `missedcall_services`
  ADD PRIMARY KEY (`service_id`);

--
-- Indexes for table `missed_calls`
--
ALTER TABLE `missed_calls`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `month_wiseapi_report`
--
ALTER TABLE `month_wiseapi_report`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `month_wise_report`
--
ALTER TABLE `month_wise_report`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `ndnc_data`
--
ALTER TABLE `ndnc_data`
  ADD KEY `ndnc_no` (`dnc_number`);

--
-- Indexes for table `news_letter`
--
ALTER TABLE `news_letter`
  ADD PRIMARY KEY (`n_id`);

--
-- Indexes for table `new_appointments`
--
ALTER TABLE `new_appointments`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `new_appointments_fb`
--
ALTER TABLE `new_appointments_fb`
  ADD PRIMARY KEY (`app_fb_id`);

--
-- Indexes for table `new_citylist`
--
ALTER TABLE `new_citylist`
  ADD PRIMARY KEY (`city_id`),
  ADD KEY `state_id` (`state_id`);

--
-- Indexes for table `new_dvr`
--
ALTER TABLE `new_dvr`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `new_dvr_`
--
ALTER TABLE `new_dvr_`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `new_orderbooking`
--
ALTER TABLE `new_orderbooking`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `new_report_emp`
--
ALTER TABLE `new_report_emp`
  ADD PRIMARY KEY (`report_id`);

--
-- Indexes for table `new_statelist`
--
ALTER TABLE `new_statelist`
  ADD PRIMARY KEY (`state_id`);

--
-- Indexes for table `notifications`
--
ALTER TABLE `notifications`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `notification_users`
--
ALTER TABLE `notification_users`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `opertor_wise`
--
ALTER TABLE `opertor_wise`
  ADD PRIMARY KEY (`series`),
  ADD KEY `series` (`series`);

--
-- Indexes for table `order_details`
--
ALTER TABLE `order_details`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `order_numbers`
--
ALTER TABLE `order_numbers`
  ADD PRIMARY KEY (`service_id`);

--
-- Indexes for table `payment_status`
--
ALTER TABLE `payment_status`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `price_enquery`
--
ALTER TABLE `price_enquery`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `profile_images`
--
ALTER TABLE `profile_images`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `region`
--
ALTER TABLE `region`
  ADD PRIMARY KEY (`id`),
  ADD KEY `region_idx` (`region`) USING BTREE;

--
-- Indexes for table `rental_payment`
--
ALTER TABLE `rental_payment`
  ADD PRIMARY KEY (`payment_id`);

--
-- Indexes for table `schedule_campaigns_to`
--
ALTER TABLE `schedule_campaigns_to`
  ADD KEY `campaign_id` (`campaign_id`),
  ADD KEY `to_mobile_no` (`to_mobile_no`);

--
-- Indexes for table `schedule_campaigns_to_01_03_2014`
--
ALTER TABLE `schedule_campaigns_to_01_03_2014`
  ADD KEY `campaign_id` (`campaign_id`);

--
-- Indexes for table `schedule_campaigns_to_temp`
--
ALTER TABLE `schedule_campaigns_to_temp`
  ADD KEY `campaign_id` (`campaign_id`);

--
-- Indexes for table `sender_names`
--
ALTER TABLE `sender_names`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`,`sender_name`),
  ADD KEY `user_id_2` (`user_id`),
  ADD KEY `sender_name` (`sender_name`);

--
-- Indexes for table `series_wise`
--
ALTER TABLE `series_wise`
  ADD KEY `Number_Starts_With` (`Number_Starts_With`);

--
-- Indexes for table `service_nos`
--
ALTER TABLE `service_nos`
  ADD PRIMARY KEY (`service_id`);

--
-- Indexes for table `service_type`
--
ALTER TABLE `service_type`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `shorturl_table_info`
--
ALTER TABLE `shorturl_table_info`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `sms_alerts`
--
ALTER TABLE `sms_alerts`
  ADD PRIMARY KEY (`alert_id`);

--
-- Indexes for table `sms_api_daily_count`
--
ALTER TABLE `sms_api_daily_count`
  ADD PRIMARY KEY (`daily_count_id`);

--
-- Indexes for table `sms_api_job_ids`
--
ALTER TABLE `sms_api_job_ids`
  ADD PRIMARY KEY (`job_id`),
  ADD KEY `scheduled_on` (`scheduled_on`),
  ADD KEY `campaign_status` (`campaign_status`),
  ADD KEY `is_scheduled` (`is_scheduled`),
  ADD KEY `is_scheduled_2` (`is_scheduled`,`scheduled_on`,`campaign_status`);

--
-- Indexes for table `sms_api_messages`
--
ALTER TABLE `sms_api_messages`
  ADD PRIMARY KEY (`message_id`),
  ADD KEY `on_date` (`ondate`),
  ADD KEY `on_date_user_id` (`ondate`,`user_id`),
  ADD KEY `user_index` (`user_id`),
  ADD KEY `user_ondate` (`user_id`,`ondate`);

--
-- Indexes for table `sms_api_messages_apsrtc`
--
ALTER TABLE `sms_api_messages_apsrtc`
  ADD PRIMARY KEY (`message_id`),
  ADD KEY `on_date` (`ondate`),
  ADD KEY `on_date_user_id` (`ondate`,`user_id`),
  ADD KEY `user_index` (`user_id`),
  ADD KEY `user_ondate` (`user_id`,`ondate`);

--
-- Indexes for table `sms_api_messages_tsrtc`
--
ALTER TABLE `sms_api_messages_tsrtc`
  ADD PRIMARY KEY (`message_id`),
  ADD KEY `on_date` (`ondate`),
  ADD KEY `on_date_user_id` (`ondate`,`user_id`),
  ADD KEY `user_index` (`user_id`),
  ADD KEY `user_ondate` (`user_id`,`ondate`);

--
-- Indexes for table `sms_inbox`
--
ALTER TABLE `sms_inbox`
  ADD PRIMARY KEY (`inbox_id`),
  ADD KEY `code_id` (`code_id`),
  ADD KEY `user_id` (`user_id`,`code_id`,`is_dumped`);

--
-- Indexes for table `sms_log`
--
ALTER TABLE `sms_log`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `sms_messages`
--
ALTER TABLE `sms_messages`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `sms_price_list`
--
ALTER TABLE `sms_price_list`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `sms_price_list1`
--
ALTER TABLE `sms_price_list1`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `sms_queue`
--
ALTER TABLE `sms_queue`
  ADD KEY `application_priority` (`application_priority`),
  ADD KEY `port_no` (`port_no`);

--
-- Indexes for table `sms_templates`
--
ALTER TABLE `sms_templates`
  ADD PRIMARY KEY (`template_id`),
  ADD KEY `template_id` (`template_id`,`user_id`);

--
-- Indexes for table `sms_types`
--
ALTER TABLE `sms_types`
  ADD PRIMARY KEY (`sms_type_id`),
  ADD UNIQUE KEY `sms_type` (`sms_type`);

--
-- Indexes for table `states`
--
ALTER TABLE `states`
  ADD PRIMARY KEY (`state_id`);

--
-- Indexes for table `tbl_books`
--
ALTER TABLE `tbl_books`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_user`
--
ALTER TABLE `tbl_user`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `techsupport_client_fb`
--
ALTER TABLE `techsupport_client_fb`
  ADD PRIMARY KEY (`app_fb_id`);

--
-- Indexes for table `tele_callers`
--
ALTER TABLE `tele_callers`
  ADD PRIMARY KEY (`caller_id`);

--
-- Indexes for table `templates`
--
ALTER TABLE `templates`
  ADD PRIMARY KEY (`template_id`),
  ADD KEY `template_id` (`template_id`,`user_id`);

--
-- Indexes for table `temp_sendernames`
--
ALTER TABLE `temp_sendernames`
  ADD PRIMARY KEY (`sno`);

--
-- Indexes for table `transaction_history`
--
ALTER TABLE `transaction_history`
  ADD PRIMARY KEY (`payment_id`);

--
-- Indexes for table `tran_sms`
--
ALTER TABLE `tran_sms`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `trn_session_log`
--
ALTER TABLE `trn_session_log`
  ADD PRIMARY KEY (`session_log_id`),
  ADD KEY `user_id` (`user_id`),
  ADD KEY `session_name` (`session_name`);

--
-- Indexes for table `userbulkurlsmsprice`
--
ALTER TABLE `userbulkurlsmsprice`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`user_id`),
  ADD UNIQUE KEY `username` (`username`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `users1`
--
ALTER TABLE `users1`
  ADD PRIMARY KEY (`user_id`),
  ADD UNIQUE KEY `username` (`username`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `users_1`
--
ALTER TABLE `users_1`
  ADD PRIMARY KEY (`user_id`),
  ADD UNIQUE KEY `username` (`username`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `users_bkup`
--
ALTER TABLE `users_bkup`
  ADD PRIMARY KEY (`user_id`),
  ADD UNIQUE KEY `username` (`username`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `users_test`
--
ALTER TABLE `users_test`
  ADD PRIMARY KEY (`user_id`),
  ADD UNIQUE KEY `username` (`username`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `user_bulk_shorturl`
--
ALTER TABLE `user_bulk_shorturl`
  ADD PRIMARY KEY (`url_id`),
  ADD KEY `shorturl_id` (`shorturl_id`);

--
-- Indexes for table `user_collections`
--
ALTER TABLE `user_collections`
  ADD PRIMARY KEY (`collection_id`);

--
-- Indexes for table `user_credits_logs`
--
ALTER TABLE `user_credits_logs`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `user_long_code_keywords`
--
ALTER TABLE `user_long_code_keywords`
  ADD PRIMARY KEY (`keyword_id`),
  ADD UNIQUE KEY `keyword` (`keyword`);

--
-- Indexes for table `user_payments`
--
ALTER TABLE `user_payments`
  ADD PRIMARY KEY (`payment_id`);

--
-- Indexes for table `user_sales_executives_tracking`
--
ALTER TABLE `user_sales_executives_tracking`
  ADD PRIMARY KEY (`track_id`);

--
-- Indexes for table `user_shorturl`
--
ALTER TABLE `user_shorturl`
  ADD PRIMARY KEY (`shorturl_id`);

--
-- Indexes for table `user_sms_balcheck`
--
ALTER TABLE `user_sms_balcheck`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `user_types`
--
ALTER TABLE `user_types`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `vendordetails`
--
ALTER TABLE `vendordetails`
  ADD PRIMARY KEY (`sno`);

--
-- Indexes for table `vendordetails_test`
--
ALTER TABLE `vendordetails_test`
  ADD PRIMARY KEY (`sno`);

--
-- Indexes for table `vendor_dailybal`
--
ALTER TABLE `vendor_dailybal`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin_campaigns`
--
ALTER TABLE `admin_campaigns`
  MODIFY `admin_campaign_id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `admin_table`
--
ALTER TABLE `admin_table`
  MODIFY `admin_id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `agent_numbers`
--
ALTER TABLE `agent_numbers`
  MODIFY `sno` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `alerts_to_groups`
--
ALTER TABLE `alerts_to_groups`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `allow_ip`
--
ALTER TABLE `allow_ip`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `api_keys`
--
ALTER TABLE `api_keys`
  MODIFY `sno` bigint(20) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `appointments_history`
--
ALTER TABLE `appointments_history`
  MODIFY `app_history_id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `business_application`
--
ALTER TABLE `business_application`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `call_type`
--
ALTER TABLE `call_type`
  MODIFY `call_id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `campaigns`
--
ALTER TABLE `campaigns`
  MODIFY `campaign_id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `campaigns_1`
--
ALTER TABLE `campaigns_1`
  MODIFY `campaign_id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `CARE_PWDS`
--
ALTER TABLE `CARE_PWDS`
  MODIFY `Id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `college_enquireform`
--
ALTER TABLE `college_enquireform`
  MODIFY `sno` int(30) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `contacts`
--
ALTER TABLE `contacts`
  MODIFY `contact_id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `contact_form`
--
ALTER TABLE `contact_form`
  MODIFY `contact_id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `contact_groups`
--
ALTER TABLE `contact_groups`
  MODIFY `group_id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `email_templates`
--
ALTER TABLE `email_templates`
  MODIFY `template_id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `feedback`
--
ALTER TABLE `feedback`
  MODIFY `fid` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `ftp_campaign`
--
ALTER TABLE `ftp_campaign`
  MODIFY `campaign_id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `generate_invoice`
--
ALTER TABLE `generate_invoice`
  MODIFY `invoice_id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `global_settings`
--
ALTER TABLE `global_settings`
  MODIFY `setting_id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `groups`
--
ALTER TABLE `groups`
  MODIFY `group_id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `invoices`
--
ALTER TABLE `invoices`
  MODIFY `invoice_id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `large_campaign_activities`
--
ALTER TABLE `large_campaign_activities`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `large_campaign_activities_new`
--
ALTER TABLE `large_campaign_activities_new`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `leads`
--
ALTER TABLE `leads`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `leave_managment`
--
ALTER TABLE `leave_managment`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `loginhistory`
--
ALTER TABLE `loginhistory`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `login_attendance`
--
ALTER TABLE `login_attendance`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `login_ips`
--
ALTER TABLE `login_ips`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `longcode_config`
--
ALTER TABLE `longcode_config`
  MODIFY `longcode_id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `longcode_keywords`
--
ALTER TABLE `longcode_keywords`
  MODIFY `keyword_id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `longcode_keyword_price`
--
ALTER TABLE `longcode_keyword_price`
  MODIFY `price_id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `longcode_numbers`
--
ALTER TABLE `longcode_numbers`
  MODIFY `longcode_id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `longcode_packages`
--
ALTER TABLE `longcode_packages`
  MODIFY `package_id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `longcode_plan_price`
--
ALTER TABLE `longcode_plan_price`
  MODIFY `plan_id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `longcode_smsmessages`
--
ALTER TABLE `longcode_smsmessages`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `longcode_subscription`
--
ALTER TABLE `longcode_subscription`
  MODIFY `longcode_id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `longcode_tmp`
--
ALTER TABLE `longcode_tmp`
  MODIFY `longcode_id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `long_short_codes`
--
ALTER TABLE `long_short_codes`
  MODIFY `code_id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `long_short_code_keywords`
--
ALTER TABLE `long_short_code_keywords`
  MODIFY `lsck_id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `mc_billing`
--
ALTER TABLE `mc_billing`
  MODIFY `mcbill_id` int(11) unsigned NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `missedcall_services`
--
ALTER TABLE `missedcall_services`
  MODIFY `service_id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `missed_calls`
--
ALTER TABLE `missed_calls`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `month_wiseapi_report`
--
ALTER TABLE `month_wiseapi_report`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `month_wise_report`
--
ALTER TABLE `month_wise_report`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `news_letter`
--
ALTER TABLE `news_letter`
  MODIFY `n_id` int(25) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `new_appointments`
--
ALTER TABLE `new_appointments`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `new_appointments_fb`
--
ALTER TABLE `new_appointments_fb`
  MODIFY `app_fb_id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `new_citylist`
--
ALTER TABLE `new_citylist`
  MODIFY `city_id` int(5) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `new_dvr`
--
ALTER TABLE `new_dvr`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `new_dvr_`
--
ALTER TABLE `new_dvr_`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `new_orderbooking`
--
ALTER TABLE `new_orderbooking`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `new_report_emp`
--
ALTER TABLE `new_report_emp`
  MODIFY `report_id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `new_statelist`
--
ALTER TABLE `new_statelist`
  MODIFY `state_id` int(10) unsigned NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `notifications`
--
ALTER TABLE `notifications`
  MODIFY `id` int(50) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `notification_users`
--
ALTER TABLE `notification_users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `order_details`
--
ALTER TABLE `order_details`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `order_numbers`
--
ALTER TABLE `order_numbers`
  MODIFY `service_id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `payment_status`
--
ALTER TABLE `payment_status`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `price_enquery`
--
ALTER TABLE `price_enquery`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `profile_images`
--
ALTER TABLE `profile_images`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `region`
--
ALTER TABLE `region`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `rental_payment`
--
ALTER TABLE `rental_payment`
  MODIFY `payment_id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `sender_names`
--
ALTER TABLE `sender_names`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `service_nos`
--
ALTER TABLE `service_nos`
  MODIFY `service_id` int(11) unsigned NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `service_type`
--
ALTER TABLE `service_type`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `shorturl_table_info`
--
ALTER TABLE `shorturl_table_info`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `sms_alerts`
--
ALTER TABLE `sms_alerts`
  MODIFY `alert_id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `sms_api_daily_count`
--
ALTER TABLE `sms_api_daily_count`
  MODIFY `daily_count_id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `sms_api_job_ids`
--
ALTER TABLE `sms_api_job_ids`
  MODIFY `job_id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `sms_api_messages`
--
ALTER TABLE `sms_api_messages`
  MODIFY `message_id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `sms_api_messages_apsrtc`
--
ALTER TABLE `sms_api_messages_apsrtc`
  MODIFY `message_id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `sms_api_messages_tsrtc`
--
ALTER TABLE `sms_api_messages_tsrtc`
  MODIFY `message_id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `sms_inbox`
--
ALTER TABLE `sms_inbox`
  MODIFY `inbox_id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `sms_log`
--
ALTER TABLE `sms_log`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `sms_messages`
--
ALTER TABLE `sms_messages`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `sms_price_list`
--
ALTER TABLE `sms_price_list`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `sms_price_list1`
--
ALTER TABLE `sms_price_list1`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `sms_templates`
--
ALTER TABLE `sms_templates`
  MODIFY `template_id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `sms_types`
--
ALTER TABLE `sms_types`
  MODIFY `sms_type_id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `states`
--
ALTER TABLE `states`
  MODIFY `state_id` int(10) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `tbl_books`
--
ALTER TABLE `tbl_books`
  MODIFY `id` int(8) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `tbl_user`
--
ALTER TABLE `tbl_user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `techsupport_client_fb`
--
ALTER TABLE `techsupport_client_fb`
  MODIFY `app_fb_id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `tele_callers`
--
ALTER TABLE `tele_callers`
  MODIFY `caller_id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `templates`
--
ALTER TABLE `templates`
  MODIFY `template_id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `temp_sendernames`
--
ALTER TABLE `temp_sendernames`
  MODIFY `sno` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `transaction_history`
--
ALTER TABLE `transaction_history`
  MODIFY `payment_id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `tran_sms`
--
ALTER TABLE `tran_sms`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `trn_session_log`
--
ALTER TABLE `trn_session_log`
  MODIFY `session_log_id` bigint(20) unsigned NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `userbulkurlsmsprice`
--
ALTER TABLE `userbulkurlsmsprice`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `users1`
--
ALTER TABLE `users1`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `users_bkup`
--
ALTER TABLE `users_bkup`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `users_test`
--
ALTER TABLE `users_test`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `user_bulk_shorturl`
--
ALTER TABLE `user_bulk_shorturl`
  MODIFY `url_id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `user_collections`
--
ALTER TABLE `user_collections`
  MODIFY `collection_id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `user_credits_logs`
--
ALTER TABLE `user_credits_logs`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `user_long_code_keywords`
--
ALTER TABLE `user_long_code_keywords`
  MODIFY `keyword_id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `user_payments`
--
ALTER TABLE `user_payments`
  MODIFY `payment_id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `user_sales_executives_tracking`
--
ALTER TABLE `user_sales_executives_tracking`
  MODIFY `track_id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `user_shorturl`
--
ALTER TABLE `user_shorturl`
  MODIFY `shorturl_id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `user_sms_balcheck`
--
ALTER TABLE `user_sms_balcheck`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `user_types`
--
ALTER TABLE `user_types`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `vendordetails`
--
ALTER TABLE `vendordetails`
  MODIFY `sno` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `vendordetails_test`
--
ALTER TABLE `vendordetails_test`
  MODIFY `sno` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `vendor_dailybal`
--
ALTER TABLE `vendor_dailybal`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
