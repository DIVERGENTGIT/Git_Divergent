

//created tables:

1.table name : longcode_keywords

CREATE TABLE IF NOT EXISTS `longcode_keywords` (
  `keyword_id` int(11) NOT NULL,
  `keyword_name` varchar(100) DEFAULT NULL,
  `user_id` int(11) DEFAULT NULL,
  `longcode_number` bigint(20) DEFAULT NULL,
  `start_date` datetime DEFAULT NULL,
  `expired_start` datetime DEFAULT NULL,
  `status` int(11) NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

2.table name : longcode_config

CREATE TABLE IF NOT EXISTS `longcode_config` (
  `longcode_id` int(11) NOT NULL,
  `longcode_number` varchar(100) DEFAULT NULL,
  `keyword` varchar(100) DEFAULT NULL,
  `sender_id` varchar(50) DEFAULT NULL,
  `vender_alert` text,
  `customer_alert` text,
  `user_id` int(11) DEFAULT NULL,
  `created_on` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `modify_date` datetime DEFAULT NULL,
  `status` int(11) NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

3.table name : longcode_packages

CREATE TABLE IF NOT EXISTS `longcode_packages` (
  `package_id` int(11) NOT NULL,
  `no_of_sms` varchar(100) DEFAULT NULL COMMENT 'no_of_free_sms_with_pack',
  `price_per_long_code` varchar(100) DEFAULT NULL COMMENT 'INR',
  `subscription_duration` varchar(100) DEFAULT NULL COMMENT 'No of Months',
  `amount` varchar(100) NOT NULL,
  `activity` varchar(100) DEFAULT NULL,
  `created_on` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=latin1;

4.table name : longcode_packages

CREATE TABLE IF NOT EXISTS `longcode_plan` (
  `longcode_id` int(11) NOT NULL,
  `longcode_number` bigint(20) DEFAULT NULL,
  `longcode_type` varchar(100) DEFAULT NULL,
  `user_id` int(11) DEFAULT NULL,
  `status` int(11) NOT NULL DEFAULT '0',
  `created_on` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

5.table name : longcode_subscription

CREATE TABLE IF NOT EXISTS `longcode_subscription` (
  `longcode_id` int(11) NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `longcode_number` int(11) DEFAULT NULL,
  `subscription_start` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `subscription_end` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `status` int(11) DEFAULT '0'
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

6.table name : longcode_smsmessages

CREATE TABLE IF NOT EXISTS `longcode_smsmessages` (
  `id` bigint(20) NOT NULL,
  `service_number` varchar(20) NOT NULL DEFAULT '',
  `message_from` varchar(20) NOT NULL,
  `status` varchar(20) NOT NULL DEFAULT '',
  `message` text NOT NULL,
  `message_time` varchar(50) NOT NULL,
  `user_id` int(11) NOT NULL,
  `count` int(11) NOT NULL,
  `created_on` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `smscinfo` varchar(100) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=44 DEFAULT CHARSET=utf8;


