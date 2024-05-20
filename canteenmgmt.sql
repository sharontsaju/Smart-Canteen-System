-- phpMyAdmin SQL Dump
-- version 5.0.3
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Nov 22, 2020 at 08:13 AM
-- Server version: 10.4.14-MariaDB
-- PHP Version: 7.4.11

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `canteenmgmt`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `id` int(11) NOT NULL,
  `name` varchar(40) NOT NULL,
  `phone` varchar(20) NOT NULL,
  `address` varchar(20) NOT NULL,
  `password` varchar(255) NOT NULL,
  `is_siteadmin` tinyint(1) DEFAULT 0,
  `is_verified` tinyint(1) DEFAULT 0,
  `created_at` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`id`, `name`, `phone`, `address`, `password`, `is_siteadmin`, `is_verified`, `created_at`) VALUES
(12, 'Ram', '2121212121', 'TVPM1', 'password123', 1, 1, '2018-08-01 09:10:03'),
(16, 'Demo', '1111111111', 'TVPM3', 'password', 0, 1, '2018-08-01 15:57:25'),
(25, 'Try', '1212121212', 'TVPM2', 'password', 1, 1, '');

-- --------------------------------------------------------

--
-- Table structure for table `foods`
--

CREATE TABLE `foods` (
  `id` int(11) NOT NULL,
  `food_name` varchar(256) NOT NULL,
  `price` int(11) NOT NULL,
  `picture` varchar(255) DEFAULT NULL,
  `created_at` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `foods`
--

INSERT INTO `foods` (`id`, `food_name`, `price`, `picture`, `created_at`) VALUES
(1, 'Chicken Momo', 100, 'food menu/chicken momo.png', '2018-08-01 13:54:01'),
(3, 'Chicken Sausage', 50, 'food menu/Chicken Sausage.png', '2018-08-01 13:57:51'),
(4, 'Fried Rice', 80, 'food menu/Fried Rice.png', '2018-08-01 13:58:24'),
(5, 'Bajeko Sekuwa', 150, 'food menu/Bajeko Sekuwa.jpg', '2018-08-01 14:00:15'),
(6, 'Buff Momo', 80, 'food menu/Buff Momo.png', '2018-08-01 14:02:42'),
(7, 'Veg Momo', 70, 'food menu/Veg Momo.png', '2018-08-01 14:02:56'),
(8, 'Nepali Rice', 120, 'food menu/Nepali Rice.jpg', '2018-08-01 14:03:05'),
(9, 'Egg Omlette', 25, 'food menu/Egg Omlette.jpg', '2018-08-01 14:03:17'),
(10, 'Thukpa', 80, 'food menu/Thukpa.jpg', '2018-08-01 14:27:30'),
(11, 'Dhindo and gundhruk', 300, 'food menu/Dhindo and gundhruk.jpg', '2018-08-01 14:27:39'),
(12, 'Dry Mix', 100, 'food menu/Dry Mix.jpg', '2018-08-01 16:00:36'),
(14, 'Italian Pasta', 100, 'food menu/b4-1_zps0b44aa86.png', '2018-08-03 11:36:41');

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE `orders` (
  `id` int(11) NOT NULL,
  `ordered_by` int(11) NOT NULL,
  `given_by` int(11) NOT NULL,
  `ordered_item` int(11) NOT NULL,
  `quantity` int(11) NOT NULL,
  `has_paid` tinyint(4) NOT NULL DEFAULT 0,
  `created_at` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `orders`
--

INSERT INTO `orders` (`id`, `ordered_by`, `given_by`, `ordered_item`, `quantity`, `has_paid`, `created_at`) VALUES
(1, 1, 12, 11, 1, 1, '2018-08-01 15:42:52'),
(2, 1, 12, 5, 1, 1, '2018-08-01 15:43:03'),
(3, 2, 12, 1, 1, 0, '2018-08-01 15:44:20'),
(4, 1, 12, 4, 10, 1, '2018-08-01 15:59:14'),
(5, 1, 13, 10, 50, 1, '2018-08-01 16:07:57'),
(6, 1, 12, 5, 2, 1, '2018-08-02 10:13:09'),
(7, 1, 12, 1, 78, 1, '2018-08-02 10:13:44'),
(8, 1, 12, 5, 1, 1, '2018-08-02 10:42:09'),
(9, 1, 12, 1, 1, 0, '2018-08-02 11:14:05'),
(10, 2, 12, 5, 2, 0, '2018-08-02 11:28:27'),
(11, 1, 12, 10, 34, 0, '2018-08-03 10:35:11'),
(12, 3, 18, 2, 2, 0, '2018-08-03 11:55:59'),
(13, 1, 18, 14, 10, 0, '2018-08-03 11:59:03'),
(14, 5, 12, 1, 1, 0, '2018-08-03 17:18:21'),
(15, 1, 0, 8, 1, 0, '2018-08-08 08:28:42'),
(16, 1, 0, 1, 2, 0, '2020-11-13 05:43:22'),
(17, 1, 0, 1, 3, 0, '2020-11-13 06:23:27');

-- --------------------------------------------------------

--
-- Table structure for table `students`
--

CREATE TABLE `students` (
  `id` int(11) NOT NULL,
  `password` varchar(100) NOT NULL,
  `name` varchar(255) NOT NULL,
  `reg_no` varchar(255) NOT NULL,
  `phone` varchar(255) NOT NULL,
  `address` varchar(255) DEFAULT NULL,
  `created_at` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `students`
--

INSERT INTO `students` (`id`, `password`, `name`, `reg_no`, `phone`, `address`, `created_at`) VALUES
(1, 'password', 'Hari Krishna', '2018CS500', '9876543210', 'TVM1', '2018-08-01 15:00:37'),
(2, 'password', 'Ameer Lebba', '2018CS501', '9638527410', 'TVM2', '2018-08-01 15:00:57'),
(3, 'password', 'Ravi', '2018CS502', '9807654321', 'TVM3', '2018-08-01 15:01:40'),
(4, 'password', 'Ajay', '2018CS503', '1111122222', 'TVM4', '2018-08-03 17:16:37');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `foods`
--
ALTER TABLE `foods`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `students`
--
ALTER TABLE `students`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin`
--
ALTER TABLE `admin`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;

--
-- AUTO_INCREMENT for table `foods`
--
ALTER TABLE `foods`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `orders`
--
ALTER TABLE `orders`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT for table `students`
--
ALTER TABLE `students`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
