-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Dec 10, 2023 at 02:18 PM
-- Server version: 10.4.28-MariaDB
-- PHP Version: 8.0.28

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `ysl_db`
--

-- --------------------------------------------------------

--
-- Table structure for table `member_coupon`
--

CREATE TABLE `member_coupon` (
  `id` int(4) NOT NULL,
  `coupon_id` int(4) NOT NULL,
  `member_id` int(4) NOT NULL,
  `status_id` int(4) NOT NULL,
  `order_id` int(4) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `member_coupon`
--

INSERT INTO `member_coupon` (`id`, `coupon_id`, `member_id`, `status_id`, `order_id`) VALUES
(1, 1, 1, 1, 0),
(2, 1, 2, 2, 0),
(3, 1, 3, 2, 0),
(4, 1, 4, 1, 0),
(5, 1, 5, 1, 0),
(6, 1, 6, 2, 0),
(7, 1, 7, 2, 0),
(8, 1, 8, 1, 0),
(9, 1, 9, 1, 0),
(10, 1, 10, 1, 0),
(11, 1, 11, 2, 0),
(12, 1, 12, 1, 0),
(13, 1, 13, 1, 0),
(14, 1, 14, 2, 0),
(15, 1, 15, 2, 0),
(16, 1, 16, 1, 0),
(17, 1, 17, 1, 0),
(18, 1, 18, 2, 0),
(19, 1, 19, 1, 0),
(20, 1, 20, 1, 0),
(21, 1, 21, 2, 0),
(22, 1, 22, 2, 0),
(23, 1, 23, 1, 0),
(24, 1, 24, 1, 0),
(25, 1, 25, 2, 0),
(26, 1, 26, 2, 0),
(27, 1, 27, 2, 0),
(28, 1, 28, 2, 0),
(29, 1, 29, 1, 0),
(30, 1, 30, 1, 0);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `member_coupon`
--
ALTER TABLE `member_coupon`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `member_coupon`
--
ALTER TABLE `member_coupon`
  MODIFY `id` int(4) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=31;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
