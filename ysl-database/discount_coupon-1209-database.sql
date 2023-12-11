-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Dec 09, 2023 at 09:26 PM
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
-- Table structure for table `discount_coupon`
--

CREATE TABLE `discount_coupon` (
  `coupon_id` int(4) NOT NULL,
  `title` varchar(50) NOT NULL,
  `coupon_code` varchar(20) NOT NULL,
  `discount_type` varchar(10) NOT NULL,
  `discount_value` int(4) NOT NULL,
  `usage_times` int(3) NOT NULL,
  `start_date` varchar(50) NOT NULL,
  `expiration_date` varchar(50) NOT NULL,
  `price_rule` int(6) NOT NULL,
  `applicable_scope` varchar(20) NOT NULL,
  `applicable_type_id` int(2) DEFAULT NULL,
  `created_at` date NOT NULL,
  `status` int(2) NOT NULL,
  `valid` int(4) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `discount_coupon`
--

INSERT INTO `discount_coupon` (`coupon_id`, `title`, `coupon_code`, `discount_type`, `discount_value`, `usage_times`, `start_date`, `expiration_date`, `price_rule`, `applicable_scope`, `applicable_type_id`, `created_at`, `status`, `valid`) VALUES
(1, '新戶註冊', 'newaccount', 'amount', 100, 1, 'user_created_at', '無期限限制', 1500, 'global', NULL, '2023-01-01', 1, 1),
(2, '1月壽星優惠', 'janbirthday', 'amount', 100, 1, '2023-01-01', '2023-01-31', 2000, 'global', NULL, '2023-01-01', 0, 1),
(3, '2月壽星優惠', 'febbirthday', 'amount', 100, 1, '2023-02-01', '2023-02-28', 2000, 'global', NULL, '2023-02-01', 0, 1),
(4, '3月壽星優惠', 'marbirthday', 'amount', 100, 1, '2023-03-01', '2023-03-31', 2000, 'global', NULL, '2023-03-01', 0, 1),
(5, '4月壽星優惠', 'aprbirthday', 'amount', 100, 1, '2023-04-01', '2023-04-30', 2000, 'global', NULL, '2023-04-01', 0, 1),
(6, '5月壽星優惠', 'maybirthday', 'amount', 100, 1, '2023-05-01', '2023-05-31', 2000, 'global', NULL, '2023-05-01', 0, 1),
(7, '6月壽星優惠', 'junebirthday', 'amount', 100, 1, '2023-06-01', '2023-06-30', 2000, 'global', NULL, '2023-06-01', 0, 1),
(8, '7月壽星優惠', 'julybirthday', 'amount', 100, 1, '2023-07-01', '2023-07-31', 2000, 'global', NULL, '2023-07-01', 0, 1),
(9, '8月壽星優惠', 'augbirthday', 'amount', 100, 1, '2023-08-01', '2023-08-31', 2000, 'global', NULL, '2023-08-01', 0, 1),
(10, '9月壽星優惠', 'sepbirthday', 'amount', 100, 1, '2023-09-01', '2023-09-30', 2000, 'global', NULL, '2023-09-01', 0, 1),
(11, '10月壽星優惠', 'octbirthday', 'amount', 100, 1, '2023-10-01', '2023-10-31', 2000, 'global', NULL, '2023-10-01', 0, 1),
(12, '11月壽星優惠', 'novbirthday', 'amount', 100, 1, '2023-11-01', '2023-11-30', 2000, 'global', NULL, '2023-11-01', 0, 1),
(13, '12月壽星優惠', 'decbirthday', 'amount', 100, 1, '2023-12-01', '2023-12-31', 2000, 'global', NULL, '2023-12-01', 1, 1),
(14, '聖誕年末優惠', '2023XMAS10off', 'percentage', 5, 1, '2023-12-01', '2023-12-31', 2500, 'global', NULL, '2023-12-01', 1, 1),
(15, '寒流來襲～快閃一週驚喜優惠', '02aXZlF2I5HYO8lbzdc7', 'amount', 50, 1, '2023-12-05', '2023-12-12', 2500, 'global', 0, '2023-12-01', 1, 1),
(16, 'RPG遊戲優惠', '3wQQdX6C80RsQtO75fA3', 'amount', 100, 1, '2023-12-15', '2024-01-05', 2500, 'type', 1, '2023-12-04', 0, 1),
(17, '春季優惠', '63lVWUPEUmQF4U4MEUzK', 'percentage', 10, 2, '2023-03-01', '2023-03-10', 3000, 'global', NULL, '2023-03-01', 0, 1),
(18, '大採購優惠', 'Bd4TnQT14aT610pSkAv6', 'amount', 200, 1, '2023-12-01', '2023-12-07', 5000, 'global', NULL, '2023-12-01', 1, 1),
(19, '冒險遊戲期間限定優惠', 'ElsXvDozKUcgha7NtnFt', 'percentage', 5, 1, '2024-01-03', '2024-01-31', 2000, 'type', 2, '2023-12-04', 0, 1),
(20, '夏季優惠', 'GUVZFPmhOStac2Q7kbq8', 'amount', 500, 2, '2024-07-01', '2024-08-31', 3000, 'global', NULL, '2023-07-01', 0, 1),
(21, '雙十一節慶優惠', 'L4FWaOVmG8QE14l8UcOI', 'amount', 30, 1, '2023-11-01', '2023-11-14', 1800, 'global', NULL, '2023-11-01', 0, 1),
(22, '雙十國慶大優惠', 'Ns1GYyUJG9Aym8bylBRE', 'percentage', 5, 1, '2023-10-05', '2023-10-12', 3000, 'global', 0, '2023-10-05', 0, 1),
(23, '策略遊戲優惠', 'PVJKVoTGd8ujPgAE6toz', 'amount', 50, 1, '2023-12-15', '2023-12-31', 2000, 'type', 10, '2023-12-04', 1, 1),
(24, '動作遊戲優惠', 'S9rojHBIYoKhctNLfIhy', 'percentage', 12, 1, '2023-12-10', '2024-01-10', 2500, 'type', 4, '2023-12-03', 1, 1),
(25, '秋季優惠 全品項可使用', 'WXzyFwj2eN5Z9tGrgxv8', 'amount', 100, 2, '2023-10-01', '2023-11-15', 3500, 'global', 0, '2023-10-01', 0, 1),
(26, '農曆年節優惠', 'Z2qNMoVt5uB1JQMwGytw', 'amount', 100, 2, '2023-02-01', '2023-02-20', 2500, 'global', NULL, '2023-02-01', 0, 1),
(27, '週年慶優惠', 'dsqEntE5cRnuqDMd2t3U', 'percentage', 15, 1, '2023-04-10', '2023-04-25', 2000, 'global', NULL, '2023-04-10', 0, 1),
(28, '電玩展優惠', 'kfHepA2hhEDT2sQFPm8F', 'amount', 100, 1, '2023-05-01', '2023-05-12', 4000, 'global', NULL, '2023-05-01', 0, 1),
(29, '颱風假優惠', 'nQw98HOTg4HjebzoHAUd', 'percentage', 5, 1, '2023-07-08', '2023-07-10', 3000, 'global', NULL, '2023-07-08', 0, 1),
(30, '格鬥遊戲優惠', 'qBiKALAHUX1hrF2xyrMg', 'amount', 100, 1, '2023-11-25', '2023-12-10', 2000, 'type', 12, '2023-11-25', 1, 1),
(31, '清明連假優惠', 'sdgBr2VsUYaNi6G4yPGp', 'amount', 100, 1, '2023-04-01', '2023-04-06', 2000, 'global', NULL, '2023-04-01', 0, 1),
(32, '端午節優惠', 'v5eUGcXITX4hUfOvqKeD', 'percentage', 15, 1, '2023-06-01', '2023-06-10', 2200, 'global', NULL, '2023-06-01', 0, 1),
(33, '情人節優惠', 'yxg7s9K5CRpIc8aVCeua', 'amount', 20, 1, '2023-02-13', '2023-02-15', 2520, 'global', NULL, '2023-02-13', 0, 1),
(34, '父親節優惠', 'GchdFwj2eN5Z9tGrgxv8', 'percentage', 12, 1, '2023-08-01', '2023-08-08', 888, 'global', NULL, '2023-08-01', 0, 1),
(35, '母親節優惠', 'welovemom520', 'percentage', 20, 1, '2024-05-04', '2024-05-12', 5200, 'global', 0, '2023-12-07', 0, 1),
(36, '祖父母節優惠', 'welovegrandparents', 'percentage', 20, 1, '2023-08-20', '2023-08-26', 2000, 'type', 11, '2023-12-07', 0, 0);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `discount_coupon`
--
ALTER TABLE `discount_coupon`
  ADD PRIMARY KEY (`coupon_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `discount_coupon`
--
ALTER TABLE `discount_coupon`
  MODIFY `coupon_id` int(4) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=37;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
