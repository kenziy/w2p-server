-- phpMyAdmin SQL Dump
-- version 4.7.9
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jun 22, 2018 at 08:05 PM
-- Server version: 10.1.31-MariaDB
-- PHP Version: 7.2.3

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `watchpay`
--
CREATE DATABASE IF NOT EXISTS `watchpay` DEFAULT CHARACTER SET latin1 COLLATE latin1_swedish_ci;
USE `watchpay`;

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `id` int(11) NOT NULL,
  `username` varchar(100) NOT NULL,
  `password` text NOT NULL,
  `date_created` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `points`
--

CREATE TABLE `points` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `date_created` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `points`
--

INSERT INTO `points` (`id`, `user_id`, `date_created`) VALUES
(26, 3, '2018-06-22 17:10:09'),
(27, 4, '2018-06-22 17:26:17'),
(28, 3, '2018-06-22 17:29:54'),
(29, 3, '2018-06-22 17:51:21');

-- --------------------------------------------------------

--
-- Table structure for table `redeem`
--

CREATE TABLE `redeem` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `tracking_id` varchar(100) NOT NULL,
  `points` int(11) NOT NULL,
  `request` text NOT NULL,
  `summary` varchar(225) NOT NULL,
  `status` tinyint(4) NOT NULL,
  `date_created` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `redeem`
--

INSERT INTO `redeem` (`id`, `user_id`, `tracking_id`, `points`, `request`, `summary`, `status`, `date_created`) VALUES
(3, 3, 'N-216', 10, '{\"redeem\":\"Smart 10\",\"phone\":\"123\",\"opt\":\"SMART BUDDY\",\"note\":\"asdas\"}', '', 0, '2018-06-22 10:44:53'),
(4, 3, 'N-5973', 10, '{\"redeem\":\"Globe 20\",\"phone\":\"123\",\"opt\":\"GLOBE REGULAR\",\"note\":\"asdas\"}', '', 0, '2018-06-22 10:45:00'),
(5, 3, 'N-8284', 10, '{\"redeem\":\"Smart 10\",\"phone\":\"09123456789\",\"opt\":\"TALK N TEXT\",\"note\":\"test2\"}', '', 0, '2018-06-22 17:37:23');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `username` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `password` text NOT NULL,
  `name` varchar(200) NOT NULL,
  `contact` varchar(100) NOT NULL,
  `points` int(11) NOT NULL DEFAULT '0',
  `points_update` varchar(100) NOT NULL,
  `date_created` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `username`, `email`, `password`, `name`, `contact`, `points`, `points_update`, `date_created`) VALUES
(3, 'admin', 'admin@admin.com', '$2y$10$f4LfME/08xgbulc5Qfm5ou82RtdvMjJkwGKVzJCfXXmMe1eU37fjy', 'admin', '09123456789', 47, '2018-06-23 01:51:21', '2018-06-16 10:29:45'),
(4, 'test1', 'test@test.com', '$2y$10$7rPH.bmnBnDtkCWOfKn6r.0nxzrBTCqaHQelj6NC64frvd23BwoOq', 'test', '', 1, '2018-06-23 01:26:17', '2018-06-22 17:23:27');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `points`
--
ALTER TABLE `points`
  ADD UNIQUE KEY `id` (`id`);

--
-- Indexes for table `redeem`
--
ALTER TABLE `redeem`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin`
--
ALTER TABLE `admin`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `points`
--
ALTER TABLE `points`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=30;

--
-- AUTO_INCREMENT for table `redeem`
--
ALTER TABLE `redeem`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
