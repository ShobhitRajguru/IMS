-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Mar 22, 2024 at 07:33 AM
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
-- Database: `ims`
--

-- --------------------------------------------------------

--
-- Table structure for table `components`
--

CREATE TABLE `components` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `category` varchar(100) DEFAULT NULL,
  `last_entry_date` timestamp NOT NULL DEFAULT current_timestamp(),
  `lab_no` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `components`
--

INSERT INTO `components` (`id`, `name`, `category`, `last_entry_date`, `lab_no`) VALUES
(158, 'PC_03', 'PC', '2024-03-16 05:17:47', '201'),
(313, 'FAN_04_202', 'FANS', '2024-03-16 10:08:55', '202'),
(509, 'CRO_02_202', 'CRO', '2024-03-16 10:07:25', '202'),
(912, 'DMM_02', 'DMM', '2024-03-16 05:18:09', '201'),
(1064, 'PC_04', 'PC', '2024-03-16 05:17:53', '201'),
(2251, 'CRO_01_202', 'CRO', '2024-03-16 10:07:09', '202'),
(2744, 'FPGA_01', 'FPGA_BOARD', '2024-03-16 05:32:21', '201'),
(3022, 'PC_02', 'PC', '2024-03-16 05:17:42', '201'),
(3122, 'PC_01', 'PC', '2024-03-16 05:17:28', '201'),
(3946, 'DMM_01', 'DMM', '2024-03-16 05:18:03', '201'),
(5300, 'PC_02_202', 'PC', '2024-03-16 09:24:14', '202'),
(5772, 'FAN_03_202', 'FANS', '2024-03-16 10:08:33', '202'),
(5987, 'FAN_01', 'FANS', '2024-03-16 05:35:18', '201'),
(6020, 'PC_01_202', 'PC', '2024-03-16 06:57:05', '202'),
(6907, 'FPGA_02', 'FPGA_BOARD', '2024-03-16 05:36:57', '201'),
(6997, 'FPGA_02_202', 'FPGA_BOARD', '2024-03-16 07:17:06', '202'),
(7322, 'FPGA_01_202', 'FPGA_BOARD', '2024-03-16 07:16:49', '202'),
(7618, 'FAN_01_202', 'FANS', '2024-03-16 07:19:28', '202'),
(7667, 'FAN_02_202', 'FANS', '2024-03-16 10:08:23', '202'),
(8031, 'PC_03_202', 'PC', '2024-03-16 10:10:10', '202'),
(8502, 'FAN_05_202', 'FANS', '2024-03-16 10:09:07', '202'),
(8797, 'FPGA_03', 'FPGA_BOARD', '2024-03-16 05:37:06', '201'),
(8860, 'CRO_03_202', 'CRO', '2024-03-16 10:07:40', '202'),
(9625, 'DMM_03', 'DMM', '2024-03-17 15:16:33', '201'),
(9811, 'FAN_03_202', 'FANS', '2024-03-16 10:08:45', '202');

-- --------------------------------------------------------

--
-- Table structure for table `students`
--

CREATE TABLE `students` (
  `id` int(11) NOT NULL,
  `component_id` int(11) DEFAULT NULL,
  `student_id` int(11) DEFAULT NULL,
  `gmail` varchar(255) DEFAULT NULL,
  `contact` varchar(20) DEFAULT NULL,
  `classs` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(6) UNSIGNED NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(255) NOT NULL,
  `birth_year` int(4) NOT NULL,
  `lab_no` varchar(255) NOT NULL,
  `gmail` varchar(255) DEFAULT NULL,
  `contact` varchar(20) DEFAULT NULL,
  `class` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `username`, `password`, `birth_year`, `lab_no`, `gmail`, `contact`, `class`) VALUES
(1, 'yash', '$2y$10$abq1rOHxkPeC5wLosCqE4u7KX7qMXXI7q/ubZBOWa/uY2csROc502', 2003, '201', NULL, NULL, NULL),
(2, 'mayur', '$2y$10$lFr53YyXrlrUG2GPWu2YQeaZVXiF7qzoALXVollXJiG6yohSiIfP2', 2003, '202', NULL, NULL, NULL),
(3, 'shobhit', '$2y$10$o6R303aG0iSffhYE9CyIF.wk8GXVKnS5tVatZsUJbDHRq2LOGJ3iu', 2003, '203', NULL, NULL, NULL),
(4, 'kshirsagar', '$2y$10$9o3bVF1NdCwFIc/pD9DZuO.e2geKUhJ1jdRB9ONJPMCMHnOj2Af0S', 1974, '204', NULL, NULL, NULL);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `components`
--
ALTER TABLE `components`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `students`
--
ALTER TABLE `students`
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
-- AUTO_INCREMENT for table `components`
--
ALTER TABLE `components`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9940;

--
-- AUTO_INCREMENT for table `students`
--
ALTER TABLE `students`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(6) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
