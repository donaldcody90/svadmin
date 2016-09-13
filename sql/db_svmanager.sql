-- phpMyAdmin SQL Dump
-- version 4.5.1
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Sep 13, 2016 at 04:02 AM
-- Server version: 10.1.13-MariaDB
-- PHP Version: 5.6.23

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `db_svmanager`
--

-- --------------------------------------------------------

--
-- Table structure for table `balance`
--

CREATE TABLE `balance` (
  `cid` int(11) NOT NULL,
  `amount` decimal(11,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `balance`
--

INSERT INTO `balance` (`cid`, `amount`) VALUES
(1001, '29978.34'),
(1002, '38055.27');

-- --------------------------------------------------------

--
-- Table structure for table `billing_history`
--

CREATE TABLE `billing_history` (
  `id` bigint(18) NOT NULL,
  `cid` bigint(18) DEFAULT NULL,
  `description` varchar(255) DEFAULT NULL,
  `created_date` varchar(255) DEFAULT NULL,
  `amount` decimal(18,2) DEFAULT NULL,
  `balance` decimal(18,2) DEFAULT NULL,
  `type` int(1) DEFAULT '0' COMMENT '0, Invoice, 1 Nap tien',
  `ref_id` bigint(18) DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `billing_history`
--

INSERT INTO `billing_history` (`id`, `cid`, `description`, `created_date`, `amount`, `balance`, `type`, `ref_id`) VALUES
(1, 1002, 'Invoice#123456', '2016-09-01', '12.00', '10.00', 0, 1),
(2, 1002, '123456', '2016-09-09', '22.14', '38105.04', 1, 1),
(3, 1002, 'Invoice#123456', '2016-09-09', '0.00', '38105.04', 0, 1),
(4, 1002, 'Invoice#123456', '2016-09-09', '0.42', '38103.57', 0, 1),
(5, 1002, 'Invoice#123456', '2016-09-12', '8.58', '38057.91', 0, 1),
(6, 1001, 'Invoice#324596', '2016-09-12', '0.44', '29978.35', 0, 3),
(7, 1002, 'Invoice#123456', '2016-09-12', '5.06', '38055.49', 0, 1),
(9, 1001, 'Invoice#301278', '2016-09-12', '0.00', '29978.35', 0, 4),
(10, 1002, 'Invoice#123789', '2016-09-12', '0.00', '38055.49', 0, 2),
(12, 1001, 'Invoice#301278', '2016-09-13', '0.02', '29978.34', 0, 4),
(13, 1002, 'Invoice#123789', '2016-09-13', '0.23', '38055.27', 0, 2);

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

CREATE TABLE `categories` (
  `id` int(11) NOT NULL,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `uid` int(11) NOT NULL,
  `status` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`id`, `name`, `uid`, `status`) VALUES
(1, 'Billing', 2, 1),
(5, 'General', 24, 1),
(9, 'Technique', 5, 0),
(13, 'abc', 18, 0),
(14, '455555555555', 5, 0);

-- --------------------------------------------------------

--
-- Table structure for table `conversation`
--

CREATE TABLE `conversation` (
  `cid` int(11) NOT NULL,
  `uid` int(11) NOT NULL,
  `caid` int(20) NOT NULL,
  `vpsid` int(11) NOT NULL,
  `title` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `message` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `openingdate` datetime NOT NULL,
  `status` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `conversation`
--

INSERT INTO `conversation` (`cid`, `uid`, `caid`, `vpsid`, `title`, `message`, `openingdate`, `status`) VALUES
(33, 1002, 5, 0, 'Day la subject', 'eeeeeeeeeeeeeeeeeeeeeeeeeeeeeeee', '2016-07-15 07:25:27', '0'),
(34, 1004, 5, 0, 'please help me!!!!', 'aaaaaaaaaaaaaaaaaaaaa', '2016-07-15 07:25:27', '0'),
(35, 1003, 5, 0, 'Hello!!!!!!!!!!!!!!!!!!!!!!!!!', 'aaaaaaaaaaaaaa', '2016-07-15 07:25:27', '1'),
(36, 1001, 1, 0, 'cho hỏi cái', 'aaaaaaaaaaaa', '2016-08-01 04:20:11', '1'),
(37, 1002, 5, 0, 'test lan 3:45 ', 'success', '2016-08-05 15:46:13', '0'),
(38, 1002, 9, 0, 'test lan 3:46', 'success', '2016-08-05 15:46:39', '1'),
(39, 1002, 13, 0, 'test 3:26 6/8', 'success', '2016-08-06 15:26:48', '1');

-- --------------------------------------------------------

--
-- Table structure for table `crypto_payments`
--

CREATE TABLE `crypto_payments` (
  `paymentID` int(11) UNSIGNED NOT NULL,
  `boxID` int(11) UNSIGNED NOT NULL DEFAULT '0',
  `boxType` enum('paymentbox','captchabox') NOT NULL,
  `orderID` varchar(50) NOT NULL DEFAULT '',
  `userID` varchar(50) NOT NULL DEFAULT '',
  `countryID` varchar(3) NOT NULL DEFAULT '',
  `coinLabel` varchar(6) NOT NULL DEFAULT '',
  `amount` double(20,8) NOT NULL DEFAULT '0.00000000',
  `amountUSD` double(20,8) NOT NULL DEFAULT '0.00000000',
  `unrecognised` tinyint(1) UNSIGNED NOT NULL DEFAULT '0',
  `addr` varchar(34) NOT NULL DEFAULT '',
  `txID` char(64) NOT NULL DEFAULT '',
  `txDate` datetime DEFAULT NULL,
  `txConfirmed` tinyint(1) UNSIGNED NOT NULL DEFAULT '0',
  `txCheckDate` datetime DEFAULT NULL,
  `processed` tinyint(1) UNSIGNED NOT NULL DEFAULT '0',
  `processedDate` datetime DEFAULT NULL,
  `recordCreated` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 ROW_FORMAT=DYNAMIC;

-- --------------------------------------------------------

--
-- Table structure for table `customers`
--

CREATE TABLE `customers` (
  `id` int(11) NOT NULL,
  `fullname` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `username` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `password` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `email` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `customers`
--

INSERT INTO `customers` (`id`, `fullname`, `username`, `password`, `email`) VALUES
(1001, 'donal', 'name', 'f1ecb37cc45de7b5e816917b042f258e37bd81e95a4352723c172d20095418d82e3c05838912b8801f4f0d215969c0188509868f26735eddc5293880ef0a4c06', 'toandx90@gmail.com'),
(1002, 'viet', 'viet', 'ba3253876aed6bc22d4a6ff53d8406c6ad864195ed144ab5c87621b6c233b548baeae6956df346ec8c17f5ea10f35ee3cbc514797ed7ddd3145464e2a0bab413', 'tran@gmail.com'),
(1003, 'asdf', 'asdfsd', 'ba3253876aed6bc22d4a6ff53d8406c6ad864195ed144ab5c87621b6c233b548baeae6956df346ec8c17f5ea10f35ee3cbc514797ed7ddd3145464e2a0bab413', 'asdfsdf@gmail.com'),
(1004, 'viet', 'vo', 'ba3253876aed6bc22d4a6ff53d8406c6ad864195ed144ab5c87621b6c233b548baeae6956df346ec8c17f5ea10f35ee3cbc514797ed7ddd3145464e2a0bab413', 'vo@gmail.com'),
(1006, 'adfaaf', 'customer', 'ba3253876aed6bc22d4a6ff53d8406c6ad864195ed144ab5c87621b6c233b548baeae6956df346ec8c17f5ea10f35ee3cbc514797ed7ddd3145464e2a0bab413', 'cu2@gmail.com'),
(1007, 'vietnam', 'vietnam', 'ba3253876aed6bc22d4a6ff53d8406c6ad864195ed144ab5c87621b6c233b548baeae6956df346ec8c17f5ea10f35ee3cbc514797ed7ddd3145464e2a0bab413', 'vn@gmail.com');

-- --------------------------------------------------------

--
-- Table structure for table `invoices`
--

CREATE TABLE `invoices` (
  `id` bigint(18) NOT NULL,
  `cid` bigint(18) NOT NULL,
  `invoiceid` varchar(255) DEFAULT NULL,
  `month` int(18) DEFAULT NULL,
  `year` int(18) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `invoices`
--

INSERT INTO `invoices` (`id`, `cid`, `invoiceid`, `month`, `year`) VALUES
(1, 1002, '123456', 8, 2016),
(2, 1002, '123789', 9, 2016),
(3, 1001, '324596', 8, 2016),
(4, 1001, '301278', 9, 2016);

-- --------------------------------------------------------

--
-- Table structure for table `message`
--

CREATE TABLE `message` (
  `mid` bigint(20) NOT NULL,
  `cid` bigint(20) NOT NULL,
  `uid` int(11) NOT NULL,
  `content` varchar(1000) COLLATE utf8_unicode_ci NOT NULL,
  `date` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `message`
--

INSERT INTO `message` (`mid`, `cid`, `uid`, `content`, `date`) VALUES
(1, 33, 2, '2aaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaa', '2016-05-31 12:12:12'),
(2, 33, 1002, '2aaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaa', '2016-05-30 12:12:12'),
(3, 35, 2, '3aaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaa', '2016-05-29 12:12:12'),
(4, 35, 1003, '3aaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaa', '2016-05-28 12:12:12'),
(5, 34, 2, '4aaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaa', '2016-05-27 12:12:12'),
(6, 34, 1004, '4aaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaa', '2016-05-26 12:12:12'),
(7, 36, 2, '1aaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaa', '2016-05-25 12:12:12'),
(8, 36, 1001, '1aaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaa', '2016-05-24 12:12:12'),
(9, 36, 24, 'asdfsafsdfs', '2016-08-03 23:43:47'),
(10, 36, 24, 'adsfsfasfdsdfasf', '2016-08-04 00:36:45'),
(11, 36, 24, 'afsafsadfsafsaf\r\nafsadfsdf\r\nasdfsdfasdfasf', '2016-08-04 00:37:27'),
(12, 36, 24, 'asdfasfsfd', '2016-08-04 00:37:43'),
(13, 36, 24, 'asasfdasdf<br>\r\nadfasfasd<br>adfasdfafd', '2016-08-04 01:01:27'),
(14, 33, 1002, 'test lan 1', '2016-08-04 09:26:02'),
(15, 33, 24, 'reply lan 1', '2016-08-04 09:35:37'),
(16, 33, 24, 'adadf', '2016-08-04 17:21:49'),
(17, 33, 1002, 'message 5/8/2016', '2016-08-05 12:09:20'),
(18, 33, 1002, 'asdfasdfa', '2016-08-05 14:11:52'),
(19, 33, 1002, 'test', '2016-08-05 14:14:16'),
(20, 33, 1002, 'adfasfdasf', '2016-08-05 14:35:30'),
(21, 33, 1002, 'success', '2016-08-05 15:33:30'),
(22, 37, 1002, 'success', '2016-08-05 15:46:13'),
(23, 38, 1002, 'success', '2016-08-05 15:46:39'),
(24, 37, 24, 'test 10:51\r\ndone', '2016-08-06 10:51:26'),
(25, 37, 24, 'sdfgsd', '2016-08-06 10:52:17'),
(26, 38, 1002, 'test lần n', '2016-08-06 11:24:16'),
(27, 38, 24, 'đã nhận', '2016-08-06 11:24:50'),
(28, 38, 24, '23e23232323', '2016-08-06 14:47:44'),
(29, 39, 1002, 'success', '2016-08-06 15:26:48'),
(30, 39, 1002, 'asdfasfasdf', '2016-08-06 17:30:44'),
(31, 38, 1002, 'test', '2016-08-12 16:40:15'),
(32, 38, 1002, 'test lan 2', '2016-08-12 16:40:29'),
(33, 39, 24, 'kjhjk', '2016-08-19 16:12:32'),
(34, 35, 24, 'ddddddddddd', '2016-08-23 11:06:41'),
(35, 35, 24, 'aaaaaaaaaaaaa', '2016-08-23 11:06:47'),
(36, 35, 24, 'ssssssss', '2016-08-23 11:06:59');

-- --------------------------------------------------------

--
-- Table structure for table `os`
--

CREATE TABLE `os` (
  `id` int(11) NOT NULL,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `version` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `type` int(11) NOT NULL COMMENT '1: 32bit   2: 64bit'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `os`
--

INSERT INTO `os` (`id`, `name`, `version`, `type`) VALUES
(1, 'CentOS', '7', 2),
(2, 'CentOS', '6', 2),
(3, 'CentOS', '5', 2),
(4, 'CoreOS', 'Stable', 2),
(5, 'Debian', '8', 2),
(6, 'Debian', '7', 2),
(7, 'Fedora', '24', 2),
(8, 'FreeBSD', '10', 2),
(9, 'Ubuntu', '16.04', 2),
(10, 'Ubuntu', '14.04', 2),
(11, 'Ubuntu', '12.04', 2),
(12, 'Windows', '2012 R2', 2);

-- --------------------------------------------------------

--
-- Table structure for table `plans`
--

CREATE TABLE `plans` (
  `id` bigint(18) NOT NULL,
  `name` varchar(255) DEFAULT NULL,
  `os` varchar(255) DEFAULT NULL,
  `price` float(18,0) DEFAULT NULL,
  `cpu_core` bigint(18) DEFAULT NULL,
  `disk_space` bigint(18) DEFAULT NULL,
  `ram` bigint(18) DEFAULT NULL,
  `bandwidth` bigint(18) DEFAULT NULL,
  `status` int(1) DEFAULT '1' COMMENT '1 : Enable  0 Disable'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `plans`
--

INSERT INTO `plans` (`id`, `name`, `os`, `price`, `cpu_core`, `disk_space`, `ram`, `bandwidth`, `status`) VALUES
(2, '15 GB SSD', 'CentOS', 5, 1, 15, 768, 1000, 1),
(3, '20 GB SSD', NULL, 10, 1, 20, 1024, 2000, 1),
(4, '45 GB SSD', NULL, 20, 2, 45, 2048, 3000, 1),
(5, '90 GB SSD', NULL, 40, 4, 90, 4096, 4000, 1),
(6, '150 GB SSD', NULL, 80, 6, 150, 8192, 5000, 1),
(7, '300 GB SSD', NULL, 160, 8, 300, 16384, 6000, 1),
(8, '600 GB SSD', NULL, 320, 16, 600, 32768, 10000, 1);

-- --------------------------------------------------------

--
-- Table structure for table `recharge`
--

CREATE TABLE `recharge` (
  `id` int(11) NOT NULL,
  `cid` int(11) NOT NULL,
  `type` int(11) NOT NULL COMMENT '1:Paypal 2:Credit 3:Banktransfer',
  `amount` decimal(18,2) NOT NULL,
  `transaction_id` int(18) DEFAULT NULL,
  `status` int(18) NOT NULL COMMENT '0:uncompleted   1:completed'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `recharge`
--

INSERT INTO `recharge` (`id`, `cid`, `type`, `amount`, `transaction_id`, `status`) VALUES
(1, 1001, 1, '2000.00', NULL, 1),
(2, 1002, 1, '3000.00', NULL, 1),
(3, 1003, 1, '4000.00', NULL, 1),
(4, 1004, 1, '5000.00', NULL, 1),
(5, 1006, 1, '6000.00', NULL, 1),
(7, 1001, 1, '21.00', NULL, 1),
(8, 1002, 1, '194.00', NULL, 1);

-- --------------------------------------------------------

--
-- Table structure for table `servers`
--

CREATE TABLE `servers` (
  `id` bigint(20) NOT NULL,
  `label` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `ip` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `svkey` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `svpass` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `location` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `servers`
--

INSERT INTO `servers` (`id`, `label`, `description`, `ip`, `svkey`, `svpass`, `location`) VALUES
(25, 'Tokyo', '', '188.166.221.247', 'gvubeiwa4enzdbai4gwidpzjgujj7f6a', 'gvubeiwa4enzdbai4gwidpzjgujj7f6a', 'Japan'),
(26, 'Amsterdam', '', '123.124.234.189', 'aksdfvnaikfdcnalefdjalksj', 'aolfdjjowieksdnlaskjfoialskfj', 'Netherlands'),
(27, 'Frankfurt', '', '56.136.149.98', 'skfnasivhdnhwdnksd', 'lasdkfjalsdfjlasfosfldkfjalskdj', 'Germany'),
(28, 'Paris', '', '78.56.12.34', 'oislkdafjoisfslkjfls', 'alkdfjalsdfkvnasdlsfkdoafkl', 'France'),
(29, 'London', '', '74.56.125.89', 'asdklvnadlknldnvkdknlkn', 'laskdfjoienvhsldkjoiasfdnoj', 'United Kingdom'),
(30, 'Los Angeles', '', '78.32.16.96', 'alsdkfjasfknasvlskdjfoaiewofv', 'alkdjfaoiejfnoilksdjojfowijdf', 'United States'),
(31, 'Sydney', '', '78.23.45.25', 'asldkfjsaofivnosldfolenfvoia', 'lakdfjoweinvoilkdsfieoidfkao', 'Australia'),
(32, 'Ha Noi', 'server test', '188.166.221.247', '6jktgaffibb7prf37iotrtqsn1dgmfz5', 'sygf0v1mf1meotn1qyt9uqzw3hyhft3e', 'VietNam');

-- --------------------------------------------------------

--
-- Table structure for table `settings`
--

CREATE TABLE `settings` (
  `id` int(11) NOT NULL,
  `meta_key` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `meta_value` longtext COLLATE utf8_unicode_ci
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `settings`
--

INSERT INTO `settings` (`id`, `meta_key`, `meta_value`) VALUES
(1, 'paypal', 'adminvultr@gmail.com'),
(2, 'vietcombank', '12345141111111133311');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `fullname` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `username` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `password` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `email` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `role` varchar(20) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `fullname`, `username`, `password`, `email`, `role`) VALUES
(1, 'Toan', 'toan123', '1392379478c88443c458ed72e88c72522d3a9ac1b93764c71383969a352d1c84a90f9b3230d04d0ef627954224e44df761757922506b92c1f9baf4460230ba44', 'abdew@gmail.com', '0'),
(2, '888888888', 'Toan', 'ba3253876aed6bc22d4a6ff53d8406c6ad864195ed144ab5c87621b6c233b548baeae6956df346ec8c17f5ea10f35ee3cbc514797ed7ddd3145464e2a0bab413', 'sdfgsdfg@gmail.com', '0'),
(5, 'nam', 'viet', 'ba3253876aed6bc22d4a6ff53d8406c6ad864195ed144ab5c87621b6c233b548baeae6956df346ec8c17f5ea10f35ee3cbc514797ed7ddd3145464e2a0bab413', 'asdftoanadfa@gmail.com', '1'),
(11, 'dddddddd', 'happypola', 'cf83e1357eefb8bdf1542850d66d8007d620e4050b5715dc83f4a921d36ce9ce47d0d13c5d85f2b0ff8318d2877eec2f63b931bd47417a81a538327af927da3e', 'happypol1a@gmail.com', '1'),
(13, 'tran', 'tranducnam', 'ba3253876aed6bc22d4a6ff53d8406c6ad864195ed144ab5c87621b6c233b548baeae6956df346ec8c17f5ea10f35ee3cbc514797ed7ddd3145464e2a0bab413', 'asdfasdfasf@gmail.com', '0'),
(14, 'Leo', 'silun', 'ba3253876aed6bc22d4a6ff53d8406c6ad864195ed144ab5c87621b6c233b548baeae6956df346ec8c17f5ea10f35ee3cbc514797ed7ddd3145464e2a0bab413', 'asfasdfasf@outlook.com', '1'),
(15, 'Zlatan', 'ibrahimovic', 'ba3253876aed6bc22d4a6ff53d8406c6ad864195ed144ab5c87621b6c233b548baeae6956df346ec8c17f5ea10f35ee3cbc514797ed7ddd3145464e2a0bab413', 'asdfasdf@asdfadl.com', '1'),
(18, 'Toan', 'tienbeo', 'ba3253876aed6bc22d4a6ff53d8406c6ad864195ed144ab5c87621b6c233b548baeae6956df346ec8c17f5ea10f35ee3cbc514797ed7ddd3145464e2a0bab413', 'asdfasn@asdfasdf.com', '0'),
(19, 'conmeo', 'meo', 'ba3253876aed6bc22d4a6ff53d8406c6ad864195ed144ab5c87621b6c233b548baeae6956df346ec8c17f5ea10f35ee3cbc514797ed7ddd3145464e2a0bab413', 'conmeo@gmail.com', '1'),
(20, 'david', 'beckham', 'ba3253876aed6bc22d4a6ff53d8406c6ad864195ed144ab5c87621b6c233b548baeae6956df346ec8c17f5ea10f35ee3cbc514797ed7ddd3145464e2a0bab413', 'asdfan@hotasdfas.csdfm.vn', '1'),
(24, 'admin', 'admin', 'ba3253876aed6bc22d4a6ff53d8406c6ad864195ed144ab5c87621b6c233b548baeae6956df346ec8c17f5ea10f35ee3cbc514797ed7ddd3145464e2a0bab413', 'asdfa@hoasdfl.sdf.vn', '0'),
(25, 'koco', 'admin1', 'ba3253876aed6bc22d4a6ff53d8406c6ad864195ed144ab5c87621b6c233b548baeae6956df346ec8c17f5ea10f35ee3cbc514797ed7ddd3145464e2a0bab413', 'admin1@gmail.com', '1'),
(26, 'vietnam', 'vietnam', 'ba3253876aed6bc22d4a6ff53d8406c6ad864195ed144ab5c87621b6c233b548baeae6956df346ec8c17f5ea10f35ee3cbc514797ed7ddd3145464e2a0bab413', 'vn@gmail.com', '1'),
(29, '2323', 'admin2w32', '5323b9fabdc99686c4e2e25aeaeb66bc68b64d6bc1f61f4aa0249708de7238076b883e825fb0f150383d3a263f4eee394ff07261c2db39122fd6222f5ccae1bc', 'toa23232@gmail.com', '1');

-- --------------------------------------------------------

--
-- Table structure for table `vps`
--

CREATE TABLE `vps` (
  `id` bigint(18) NOT NULL,
  `cid` bigint(18) DEFAULT NULL,
  `pid` int(11) NOT NULL,
  `svid` bigint(18) DEFAULT NULL,
  `vps_label` varchar(255) DEFAULT NULL,
  `vps_ip` varchar(255) DEFAULT NULL,
  `rootpass` varchar(255) DEFAULT NULL,
  `create_date` varchar(255) DEFAULT NULL,
  `status` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `vps`
--

INSERT INTO `vps` (`id`, `cid`, `pid`, `svid`, `vps_label`, `vps_ip`, `rootpass`, `create_date`, `status`) VALUES
(1, 1001, 2, 30, 'vps 1', '1.3.2.4', 'qwertyhgfd', '2016-6-12', 1),
(2, 1002, 3, 26, 'vps 2', '1.2.3.7', 'xcvbnfesdg', '2016-8-2', 1),
(3, 1002, 5, 27, 'vps 3', '8.2.0.6', 'ikolghncse', '2016-8-3', 1),
(4, 1002, 4, 28, 'vps 4', '6.1.4.3', 'qwvbnhgdfe', '2016-8-5', 1),
(5, 1001, 2, 29, 'vps 5', '8.4.6.1', 'dcfvgrwkln', '2016-8-9', 1),
(6, 1002, 6, 25, 'DHQC', '1.1.1.1', 'ykhtgbfddpab165xcplvmrqfob68vu', '2016-08-25 03:46:54', 0),
(7, 1002, 2, 25, 'pppppppppppppppp', '1.1.1.1', 'yk73sfcyqzraz3fnb3t4vuvcfn4d7f', '2016-08-25 05:17:27', 0),
(8, 1002, 2, 25, 'toantest', '4.4.4.4', 'mybdj7hpsaa8sbwskw1rj4yzpjdsia', '2016-08-26 18:13:20', 0);

-- --------------------------------------------------------

--
-- Table structure for table `vps_lifetime`
--

CREATE TABLE `vps_lifetime` (
  `cid` bigint(18) NOT NULL,
  `vps_id` bigint(18) NOT NULL,
  `month` int(11) NOT NULL,
  `year` int(11) NOT NULL,
  `start_date` varchar(255) DEFAULT NULL,
  `end_date` varchar(255) DEFAULT NULL,
  `amount` decimal(18,2) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `vps_lifetime`
--

INSERT INTO `vps_lifetime` (`cid`, `vps_id`, `month`, `year`, `start_date`, `end_date`, `amount`) VALUES
(1001, 1, 9, 2016, '2016-09-13 04:01:06', '2016-09-13 04:01:06', '0.00'),
(1001, 5, 9, 2016, '2016-09-13 04:01:06', '2016-09-13 04:01:06', '0.00'),
(1002, 2, 9, 2016, '2016-09-13 04:01:06', '2016-09-13 04:01:06', '0.00'),
(1002, 3, 9, 2016, '2016-09-13 04:01:06', '2016-09-13 04:01:06', '0.00'),
(1002, 4, 9, 2016, '2016-09-13 04:01:06', '2016-09-13 04:01:06', '0.00'),
(1002, 6, 9, 2016, '2016-09-13 04:01:06', '2016-09-13 04:01:06', '0.00'),
(1002, 7, 9, 2016, '2016-09-13 04:01:06', '2016-09-13 04:01:06', '0.00'),
(1002, 8, 9, 2016, '2016-09-13 04:01:06', '2016-09-13 04:01:06', '0.00');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `balance`
--
ALTER TABLE `balance`
  ADD PRIMARY KEY (`cid`);

--
-- Indexes for table `billing_history`
--
ALTER TABLE `billing_history`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `conversation`
--
ALTER TABLE `conversation`
  ADD PRIMARY KEY (`cid`),
  ADD KEY `fk_u_id_customers` (`uid`);

--
-- Indexes for table `crypto_payments`
--
ALTER TABLE `crypto_payments`
  ADD PRIMARY KEY (`paymentID`),
  ADD KEY `boxID` (`boxID`),
  ADD KEY `boxType` (`boxType`),
  ADD KEY `userID` (`userID`),
  ADD KEY `countryID` (`countryID`),
  ADD KEY `orderID` (`orderID`),
  ADD KEY `amount` (`amount`),
  ADD KEY `amountUSD` (`amountUSD`),
  ADD KEY `coinLabel` (`coinLabel`),
  ADD KEY `unrecognised` (`unrecognised`),
  ADD KEY `addr` (`addr`),
  ADD KEY `txID` (`txID`),
  ADD KEY `txDate` (`txDate`),
  ADD KEY `txConfirmed` (`txConfirmed`),
  ADD KEY `txCheckDate` (`txCheckDate`),
  ADD KEY `processed` (`processed`),
  ADD KEY `processedDate` (`processedDate`),
  ADD KEY `recordCreated` (`recordCreated`),
  ADD KEY `key1` (`boxID`,`orderID`),
  ADD KEY `key2` (`boxID`,`orderID`,`userID`),
  ADD KEY `key3` (`boxID`,`orderID`,`userID`,`txID`);

--
-- Indexes for table `customers`
--
ALTER TABLE `customers`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `invoices`
--
ALTER TABLE `invoices`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `message`
--
ALTER TABLE `message`
  ADD PRIMARY KEY (`mid`);

--
-- Indexes for table `os`
--
ALTER TABLE `os`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `plans`
--
ALTER TABLE `plans`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `recharge`
--
ALTER TABLE `recharge`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `servers`
--
ALTER TABLE `servers`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `settings`
--
ALTER TABLE `settings`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `vps`
--
ALTER TABLE `vps`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `vps_lifetime`
--
ALTER TABLE `vps_lifetime`
  ADD PRIMARY KEY (`cid`,`vps_id`,`month`,`year`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `billing_history`
--
ALTER TABLE `billing_history`
  MODIFY `id` bigint(18) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;
--
-- AUTO_INCREMENT for table `categories`
--
ALTER TABLE `categories`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;
--
-- AUTO_INCREMENT for table `conversation`
--
ALTER TABLE `conversation`
  MODIFY `cid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=40;
--
-- AUTO_INCREMENT for table `crypto_payments`
--
ALTER TABLE `crypto_payments`
  MODIFY `paymentID` int(11) UNSIGNED NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `customers`
--
ALTER TABLE `customers`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=1008;
--
-- AUTO_INCREMENT for table `invoices`
--
ALTER TABLE `invoices`
  MODIFY `id` bigint(18) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT for table `message`
--
ALTER TABLE `message`
  MODIFY `mid` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=37;
--
-- AUTO_INCREMENT for table `os`
--
ALTER TABLE `os`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;
--
-- AUTO_INCREMENT for table `plans`
--
ALTER TABLE `plans`
  MODIFY `id` bigint(18) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;
--
-- AUTO_INCREMENT for table `recharge`
--
ALTER TABLE `recharge`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;
--
-- AUTO_INCREMENT for table `servers`
--
ALTER TABLE `servers`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=33;
--
-- AUTO_INCREMENT for table `settings`
--
ALTER TABLE `settings`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=30;
--
-- AUTO_INCREMENT for table `vps`
--
ALTER TABLE `vps`
  MODIFY `id` bigint(18) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
