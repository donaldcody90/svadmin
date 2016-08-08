-- phpMyAdmin SQL Dump
-- version 4.5.1
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Aug 08, 2016 at 01:12 PM
-- Server version: 10.1.13-MariaDB
-- PHP Version: 5.6.23

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `server`
--

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
(2, 'Billing', 13, 1),
(3, 'Billing', 14, 1),
(4, 'Billing', 24, 1),
(5, 'General', 18, 1),
(6, 'General', 20, 1),
(7, 'General', 15, 1);

-- --------------------------------------------------------

--
-- Table structure for table `conversation`
--

CREATE TABLE `conversation` (
  `cid` int(11) NOT NULL,
  `uid` int(11) NOT NULL,
  `type` int(20) NOT NULL,
  `title` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `message` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `openingdate` datetime NOT NULL,
  `status` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `conversation`
--

INSERT INTO `conversation` (`cid`, `uid`, `type`, `title`, `message`, `openingdate`, `status`) VALUES
(33, 1002, 4, 'Day la subject', 'eeeeeeeeeeeeeeeeeeeeeeeeeeeeeeee', '2016-07-15 07:25:27', '0'),
(34, 1004, 3, 'please help me!!!!', 'aaaaaaaaaaaaaaaaaaaaa', '2016-07-15 07:25:27', '0'),
(35, 1003, 2, 'Hello!!!!!!!!!!!!!!!!!!!!!!!!!', 'aaaaaaaaaaaaaa', '2016-07-15 07:25:27', '1'),
(36, 1001, 1, 'cho hỏi cái', 'aaaaaaaaaaaa', '2016-08-01 04:20:11', '1'),
(37, 1002, 5, 'test lan 3:45 ', 'success', '2016-08-05 15:46:13', '0'),
(38, 1002, 7, 'test lan 3:46', 'success', '2016-08-05 15:46:39', '1'),
(39, 1002, 6, 'test 3:26 6/8', 'success', '2016-08-06 15:26:48', '1');

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
(1001, 'asdfas', 'name', 'ba3253876aed6bc22d4a6ff53d8406c6ad864195ed144ab5c87621b6c233b548baeae6956df346ec8c17f5ea10f35ee3cbc514797ed7ddd3145464e2a0bab413', 'asdf@gmail.com'),
(1002, 'viet', 'viet', 'ba3253876aed6bc22d4a6ff53d8406c6ad864195ed144ab5c87621b6c233b548baeae6956df346ec8c17f5ea10f35ee3cbc514797ed7ddd3145464e2a0bab413', 'tran@gmail.com'),
(1003, 'asdf', 'asdfsd', 'ba3253876aed6bc22d4a6ff53d8406c6ad864195ed144ab5c87621b6c233b548baeae6956df346ec8c17f5ea10f35ee3cbc514797ed7ddd3145464e2a0bab413', 'asdfsdf@gmail.com'),
(1004, 'viet', 'vo', 'ba3253876aed6bc22d4a6ff53d8406c6ad864195ed144ab5c87621b6c233b548baeae6956df346ec8c17f5ea10f35ee3cbc514797ed7ddd3145464e2a0bab413', 'vo@gmail.com'),
(1006, 'adfaaf', 'customer', 'ba3253876aed6bc22d4a6ff53d8406c6ad864195ed144ab5c87621b6c233b548baeae6956df346ec8c17f5ea10f35ee3cbc514797ed7ddd3145464e2a0bab413', 'cu2@gmail.com'),
(1007, 'vietnam', 'vietnam', 'ba3253876aed6bc22d4a6ff53d8406c6ad864195ed144ab5c87621b6c233b548baeae6956df346ec8c17f5ea10f35ee3cbc514797ed7ddd3145464e2a0bab413', 'vn@gmail.com'),
(1010, 'taasfd', 'test4', 'ba3253876aed6bc22d4a6ff53d8406c6ad864195ed144ab5c87621b6c233b548baeae6956df346ec8c17f5ea10f35ee3cbc514797ed7ddd3145464e2a0bab413', 'lkj@g.com');

-- --------------------------------------------------------

--
-- Table structure for table `datacenters`
--

CREATE TABLE `datacenters` (
  `id` bigint(20) NOT NULL,
  `cuid` int(11) NOT NULL,
  `ip` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `svkey` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `svpass` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `datacenters`
--

INSERT INTO `datacenters` (`id`, `cuid`, `ip`, `svkey`, `svpass`) VALUES
(1, 1001, '47.2.3.6', 'yvpuctwv6sdyymgagxsga4pedom1rwte', 'igrdzwnadpxzx18xevlmktw178ybrksc'),
(3, 1002, '89.255.222.25', 'toanyvpucfhdfhbfgfhsga4pedom1rwte', '123456'),
(4, 1003, '97.25.43.74', 'yvpuctasdfsfsfhfrthrhrhom1rwte', '123456'),
(5, 1004, '12.79.143.123', 'yvpucdfgdvvdfvfga4pedom1rwte', '123456'),
(6, 1001, '79.41.85.76', 'yvpukuilkhjkhkhkhnrhegem1rwte', '123456'),
(7, 1006, '45.11.231.68', 'yvfsdafsfsdfscscscscm1rwte', '123456'),
(20, 1001, '52.155.146.124', 'vvvyvpuctasdfsfsfsfsxsga4pedom1rwte', '123456'),
(22, 1007, '1.2.3.4', 'adasdkjfal', '123456'),
(23, 1010, '123.13.13.123', 'daylakey', 'daylapass'),
(24, 1010, '14.14.14.14', 'aldfkajs', 'sladkfjasl');

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
(30, 39, 1002, 'asdfasfasdf', '2016-08-06 17:30:44');

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
(1, 'Toan', 'toan123', '5775887ce6300c00191d4e797b296fe37520aeb941999f6b0db3f1ab4dbec2420054f8eaf11be2f6a08ec3b71b101546add38526f8492b0cdd929f7aec68b7db', 'abdew@gmail.com', '0'),
(2, '888888888', 'Toan', 'ba3253876aed6bc22d4a6ff53d8406c6ad864195ed144ab5c87621b6c233b548baeae6956df346ec8c17f5ea10f35ee3cbc514797ed7ddd3145464e2a0bab413', 'sdfgsdfg@gmail.com', '0'),
(5, 'nam', 'viet', '5775887ce6300c00191d4e797b296fe37520aeb941999f6b0db3f1ab4dbec2420054f8eaf11be2f6a08ec3b71b101546add38526f8492b0cdd929f7aec68b7db', 'asdftoanadfa@gmail.com', '0'),
(11, 'Happy', 'happypola', 'ba3253876aed6bc22d4a6ff53d8406c6ad864195ed144ab5c87621b6c233b548baeae6956df346ec8c17f5ea10f35ee3cbc514797ed7ddd3145464e2a0bab413', 'happypola@gmail.com', '0'),
(13, 'tran', 'tranducnam', 'ba3253876aed6bc22d4a6ff53d8406c6ad864195ed144ab5c87621b6c233b548baeae6956df346ec8c17f5ea10f35ee3cbc514797ed7ddd3145464e2a0bab413', 'asdfasdfasf@gmail.com', '0'),
(14, 'Leo', 'silun', 'ba3253876aed6bc22d4a6ff53d8406c6ad864195ed144ab5c87621b6c233b548baeae6956df346ec8c17f5ea10f35ee3cbc514797ed7ddd3145464e2a0bab413', 'asfasdfasf@outlook.com', '0'),
(15, 'Zlatan', 'ibrahimovic', 'ba3253876aed6bc22d4a6ff53d8406c6ad864195ed144ab5c87621b6c233b548baeae6956df346ec8c17f5ea10f35ee3cbc514797ed7ddd3145464e2a0bab413', 'asdfasdf@asdfadl.com', '0'),
(18, 'Toan', 'tienbeo', 'ba3253876aed6bc22d4a6ff53d8406c6ad864195ed144ab5c87621b6c233b548baeae6956df346ec8c17f5ea10f35ee3cbc514797ed7ddd3145464e2a0bab413', 'asdfasn@asdfasdf.com', '0'),
(19, 'conmeo', 'meo', 'ba3253876aed6bc22d4a6ff53d8406c6ad864195ed144ab5c87621b6c233b548baeae6956df346ec8c17f5ea10f35ee3cbc514797ed7ddd3145464e2a0bab413', 'conmeo@gmail.com', '0'),
(20, 'david', 'beckham', 'ba3253876aed6bc22d4a6ff53d8406c6ad864195ed144ab5c87621b6c233b548baeae6956df346ec8c17f5ea10f35ee3cbc514797ed7ddd3145464e2a0bab413', 'asdfan@hotasdfas.csdfm.vn', '0'),
(24, 'admin', 'admin', 'ba3253876aed6bc22d4a6ff53d8406c6ad864195ed144ab5c87621b6c233b548baeae6956df346ec8c17f5ea10f35ee3cbc514797ed7ddd3145464e2a0bab413', 'asdfa@hoasdfl.sdf.vn', '0'),
(25, 'koco', 'admin1', 'ba3253876aed6bc22d4a6ff53d8406c6ad864195ed144ab5c87621b6c233b548baeae6956df346ec8c17f5ea10f35ee3cbc514797ed7ddd3145464e2a0bab413', 'admin1@gmail.com', '0'),
(26, 'vietnam', 'vietnam', 'ba3253876aed6bc22d4a6ff53d8406c6ad864195ed144ab5c87621b6c233b548baeae6956df346ec8c17f5ea10f35ee3cbc514797ed7ddd3145464e2a0bab413', 'vn@gmail.com', '0'),
(29, '2323', 'admin2w32', '5323b9fabdc99686c4e2e25aeaeb66bc68b64d6bc1f61f4aa0249708de7238076b883e825fb0f150383d3a263f4eee394ff07261c2db39122fd6222f5ccae1bc', 'toa23232@gmail.com', '0');

--
-- Indexes for dumped tables
--

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
-- Indexes for table `customers`
--
ALTER TABLE `customers`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `datacenters`
--
ALTER TABLE `datacenters`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `message`
--
ALTER TABLE `message`
  ADD PRIMARY KEY (`mid`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `categories`
--
ALTER TABLE `categories`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;
--
-- AUTO_INCREMENT for table `conversation`
--
ALTER TABLE `conversation`
  MODIFY `cid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=40;
--
-- AUTO_INCREMENT for table `customers`
--
ALTER TABLE `customers`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=1011;
--
-- AUTO_INCREMENT for table `datacenters`
--
ALTER TABLE `datacenters`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;
--
-- AUTO_INCREMENT for table `message`
--
ALTER TABLE `message`
  MODIFY `mid` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=31;
--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=30;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
