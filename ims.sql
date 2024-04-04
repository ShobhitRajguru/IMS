-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Apr 04, 2024 at 04:18 PM
-- Server version: 10.4.28-MariaDB
-- PHP Version: 8.2.4

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
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `id` int(11) NOT NULL,
  `username` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `lab_no` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`id`, `username`, `password`, `lab_no`) VALUES
(2, 'kshirsagar', '$2y$10$CNMaEW3FWS4C76GvH1Em1OkcNTcu5NZaND7iTSh2TfKfapkfx9n.q', '204');

-- --------------------------------------------------------

--
-- Table structure for table `components`
--

CREATE TABLE `components` (
  `id` int(11) NOT NULL,
  `sr_no` varchar(100) DEFAULT NULL,
  `name` varchar(255) NOT NULL,
  `category` varchar(100) DEFAULT NULL,
  `last_entry_date` timestamp NOT NULL DEFAULT current_timestamp(),
  `origin_lab` int(11) DEFAULT NULL,
  `location` varchar(255) DEFAULT NULL,
  `_status_` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `components`
--

INSERT INTO `components` (`id`, `sr_no`, `name`, `category`, `last_entry_date`, `origin_lab`, `location`, `_status_`) VALUES
(1, 'CN-0CH5KX-FCCOO-8BNJGHN62', 'CPU_01', 'CPU', '2024-04-04 14:08:37', 209, '201', 'WORKING'),
(2, 'CN-0CH5KX-FCCOO-8BNJGHNXJ2', 'CPU-02', 'CPU', '2024-04-04 14:08:48', 209, '201', 'WORKING'),
(3, 'CN-0CH5KX-FCCOO-8BASERTAer5E35', 'CPU-03', 'CPU', '2024-04-04 14:09:06', 209, '201', 'WORKING'),
(4, 'CN-0CH5KX-FCCOO-ZDRYArE2', 'CPU-04', 'CPU', '2024-04-04 14:09:14', 209, '201', 'WORKING'),
(5, 'CN-0CH5KX-FCCOO-8FYGSZFZFZ', 'CPU-05', 'CPU', '2024-04-04 14:09:22', 209, '201', 'WORKING'),
(6, '3452352', 'DMM-01', 'DMM', '2024-04-04 14:09:29', 209, '201', 'WORKING'),
(7, '1350780', 'DMM-02', 'DMM', '2024-04-04 14:09:38', 209, '201', 'WORKING'),
(8, '7890780', 'DMM-03', 'DMM', '2024-04-04 14:10:36', 209, '201', 'WORKING'),
(9, '124152375', 'DMM-04', 'DMM', '2024-04-04 14:10:44', 209, '201', 'WORKING'),
(10, '3542896780', 'DMM-05', 'DMM', '2024-04-04 14:10:55', 209, '201', 'WORKING'),
(11, '12580', 'DMM-06', 'DMM', '2024-04-04 14:11:00', 209, '201', 'WORKING'),
(12, 'HOD5323456262', 'FUNCTION_GEN-01', 'FUNCTION_GENERATOR', '2024-04-04 14:11:08', 209, '201', 'WORKING'),
(13, 'STSE5A5RTE', 'FUNCTION_GEN-02', 'FUNCTION_GENERATOR', '2024-04-04 14:11:16', 209, '201', 'WORKING'),
(14, 'C6C-1441255', 'KIT-01', 'KIT', '2024-04-04 14:11:23', 209, '201', 'WORKING'),
(15, 'C6C-14584', 'KIT-02', 'KIT', '2024-04-04 14:11:29', 209, '201', 'WORKING'),
(16, 'C6C-1547345855', 'KIT-03', 'KIT', '2024-04-04 14:11:36', 209, '201', 'WORKING'),
(17, 'CN-0CH5KX-FCCOO-8BNDDWB-A05', 'MONITOR-01', 'MONITOR', '2024-04-04 14:11:43', 209, '201', 'WORKING'),
(18, 'CN-0CH5KX-FCCOO-8BNDEOB-A05', 'MONITOR-02', 'MONITOR', '2024-04-04 14:11:50', 209, '201', 'WORKING'),
(19, 'CN-0CH5KX-FCCOO-8BFTASTHATH-A05', 'MONITOR-03', 'MONITOR', '2024-04-04 14:12:01', 209, '201', 'WORKING'),
(20, 'CN-0CH5KX-FCCOO-8STAERHZDH-A05', 'MONITOR-04', 'MONITOR', '2024-04-04 14:12:08', 209, '201', 'WORKING'),
(21, 'CN-0CH5KX-FCCOO-FSRTHHAST6-A05', 'MONITOR-05', 'MONITOR', '2024-04-04 14:12:15', 209, '201', 'WORKING'),
(22, 'HOD11325ERYER1000065464', 'POWER_SUPPLY-01', 'POWER_SUPPLY', '2024-04-04 14:12:21', 209, '201', 'WORKING'),
(23, 'HOD11325ERYER1000065464', 'POWER_SUPPLY-02', 'POWER_SUPPLY', '2024-04-04 14:12:30', 209, '201', 'WORKING'),
(24, 'HOD11325ESTDAETHZDETHJz5', 'POWER_SUPPLY-03', 'POWER_SUPPLY', '2024-04-04 14:12:37', 209, '201', 'WORKING'),
(25, 'HOD1SaweEWTwetWER1000065464', 'POWER_SUPPLY-04', 'POWER_SUPPLY', '2024-04-04 14:12:45', 209, '201', 'WORKING');

-- --------------------------------------------------------

--
-- Table structure for table `students`
--

CREATE TABLE `students` (
  `id` int(11) NOT NULL,
  `component_id` varchar(100) DEFAULT NULL,
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
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`id`);

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
-- AUTO_INCREMENT for table `admin`
--
ALTER TABLE `admin`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `components`
--
ALTER TABLE `components`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;

--
-- AUTO_INCREMENT for table `students`
--
ALTER TABLE `students`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=34;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(6) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
