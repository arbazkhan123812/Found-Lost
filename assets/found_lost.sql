-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Feb 27, 2026 at 08:40 AM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.0.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `found&lost`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `admin_id` int(11) NOT NULL,
  `username` varchar(100) NOT NULL,
  `email` varchar(150) NOT NULL,
  `password` varchar(255) NOT NULL,
  `role` enum('superadmin','admin') DEFAULT 'admin',
  `status` tinyint(1) DEFAULT 1 COMMENT '1=active, 0=inactive',
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`admin_id`, `username`, `email`, `password`, `role`, `status`, `created_at`) VALUES
(1, 'baguqaraze', 'higa@mailinator.com', '$2y$10$zV0aXo2cNt/sgHfoGHdy1uChIqRXxeH4O6Qnc3hX7k/rMQo.u7eWq', 'admin', 1, '2025-09-28 06:35:45'),
(2, 'jyjegotaq', 'qicot@mailinator.com', '$2y$10$/Ualq3iX8Slp/XYfF/ydj.ZqEGoMx9z4HikeaxuObCDdA.SKhGUuW', 'admin', 1, '2025-09-28 06:38:48'),
(3, 'admin', 'admin@gmail.com', '$2y$10$iYTK/TFK2VRYsjNMmD/RfeESCew5Zn/56sQqxXi3eSPXAPkHYYuUu', 'admin', 1, '2025-09-28 06:44:38');

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

CREATE TABLE `categories` (
  `id` int(11) NOT NULL,
  `category_name` varchar(100) NOT NULL,
  `status` tinyint(1) DEFAULT 1,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT NULL ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`id`, `category_name`, `status`, `created_at`, `updated_at`) VALUES
(1, 'Watches', 1, '2025-09-28 08:49:40', NULL),
(2, 'Mobile Phone', 1, '2025-09-28 09:04:40', '2025-09-28 09:04:40'),
(3, 'Wallet', 1, '2025-09-28 09:04:40', '2025-09-28 09:04:40'),
(4, 'Bag', 1, '2025-09-28 09:04:40', '2025-09-28 09:04:40'),
(5, 'Jewelry', 1, '2025-09-28 09:04:40', '2025-09-28 09:04:40'),
(6, 'Keys', 1, '2025-09-28 09:04:40', '2025-09-28 09:04:40'),
(7, 'Documents', 1, '2025-09-28 09:04:40', '2025-09-28 09:04:40'),
(8, 'Electronics', 1, '2025-09-28 09:04:40', '2025-09-28 09:04:40'),
(9, 'Clothing', 1, '2025-09-28 09:04:40', '2025-09-28 09:04:40');

-- --------------------------------------------------------

--
-- Table structure for table `claims`
--

CREATE TABLE `claims` (
  `id` int(11) NOT NULL,
  `lost_item_id` int(11) NOT NULL,
  `full_name` varchar(150) NOT NULL,
  `email` varchar(150) NOT NULL,
  `phone` varchar(20) DEFAULT NULL,
  `proof_of_ownership` varchar(255) DEFAULT NULL,
  `additional_details` text DEFAULT NULL,
  `status` enum('Pending','Approved','Rejected') DEFAULT 'Pending',
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `claims`
--

INSERT INTO `claims` (`id`, `lost_item_id`, `full_name`, `email`, `phone`, `proof_of_ownership`, `additional_details`, `status`, `created_at`, `updated_at`) VALUES
(8, 32, 'Dummmy found ', 'dummyfound@gmail.com', '03132232322', '1d4a15e2654d45d12a10f5ae805e0e20.jpg', 'Same thing which is lost', 'Pending', '2025-10-09 14:24:29', '2025-10-09 14:24:29');

-- --------------------------------------------------------

--
-- Table structure for table `lost_items`
--

CREATE TABLE `lost_items` (
  `id` int(11) NOT NULL,
  `item_name` varchar(150) NOT NULL,
  `category_id` int(11) DEFAULT NULL,
  `description` text DEFAULT NULL,
  `date_lost` date NOT NULL,
  `location_lost` varchar(255) NOT NULL,
  `image` varchar(255) DEFAULT NULL,
  `status` enum('Pending','Found','Returned') DEFAULT 'Pending',
  `created_by` int(11) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `user_name` varchar(100) DEFAULT NULL,
  `user_email` varchar(255) DEFAULT NULL,
  `user_phone` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `lost_items`
--

INSERT INTO `lost_items` (`id`, `item_name`, `category_id`, `description`, `date_lost`, `location_lost`, `image`, `status`, `created_by`, `created_at`, `updated_at`, `user_name`, `user_email`, `user_phone`) VALUES
(32, 'iPhone 14 Pro', 2, '<p>\r\n	Lost near mall parking area. Black color with transparent case.</p>\r\n', '2025-09-20', 'City Mall Parking', '7115c-download.jpg', 'Found', 1, '2025-10-09 05:03:22', '2025-10-09 05:29:43', 'Ali Khan', 'ali@example.com', '03001234567'),
(33, 'Leather Wallet', 3, '<p>\r\n	Brown leather wallet containing CNIC and few cards.</p>\r\n', '2025-09-22', 'Liberty Market', '61bbe-download.jpg', 'Pending', 1, '2025-10-09 05:03:22', '2025-10-09 05:05:47', 'Ahmed Raza', 'ahmed@example.com', '03111234567'),
(34, 'Apple Watch', 1, '<p>\r\n	Black Apple Watch Series 8 lost near gym.</p>\r\n', '2025-09-25', 'BodyFit Gym, Lahore', 'b8828-download.jpg', 'Pending', 1, '2025-10-09 05:03:22', '2025-10-09 05:06:27', 'Sara Malik', 'sara@example.com', '03221234567'),
(35, 'Laptop Bag', 4, '<p>\r\n	Black laptop bag with HP logo and documents inside.</p>\r\n', '2025-09-27', 'University Campus Gate', '75200-download.jpg', 'Pending', 1, '2025-10-09 05:03:22', '2025-10-09 05:06:57', 'Hamza Ali', 'hamza@example.com', '03331234567'),
(37, 'Laptop', 8, 'Laptop Lost Some scratches on lcd ', '2025-10-08', 'Play Area ', '5c19a3c959ae93511d1165e13f3e4084.jpg', 'Pending', NULL, '2025-10-09 14:21:32', '2025-10-09 14:21:32', 'Dummy', 'xigex35ge3@wyoxafp.com', '031231322322');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`admin_id`),
  ADD UNIQUE KEY `email` (`email`);

--
-- Indexes for table `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `category_name` (`category_name`);

--
-- Indexes for table `claims`
--
ALTER TABLE `claims`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `lost_items`
--
ALTER TABLE `lost_items`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin`
--
ALTER TABLE `admin`
  MODIFY `admin_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `categories`
--
ALTER TABLE `categories`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `claims`
--
ALTER TABLE `claims`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `lost_items`
--
ALTER TABLE `lost_items`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=38;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
