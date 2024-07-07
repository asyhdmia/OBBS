-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jul 07, 2024 at 10:22 AM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `bloodbank`
--

-- --------------------------------------------------------

--
-- Table structure for table `donor_signup`
--

CREATE TABLE `donor_signup` (
  `id_signup` int(11) NOT NULL,
  `username` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `remember_me` int(11) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `donor_signup`
--

INSERT INTO `donor_signup` (`id_signup`, `username`, `email`, `password`, `created_at`, `updated_at`, `remember_me`) VALUES
(7, 'nrasdmia', 'nrasdmia@gmail.com', '000000', '2024-07-05 05:40:15', '2024-07-05 05:40:15', 0),
(8, 'mia', '333@gmail.com', '777', '2024-07-05 06:17:40', '2024-07-07 08:08:07', 1),
(9, 'syifa', 'kelantan@gmail.com', '777', '2024-07-07 08:09:34', '2024-07-07 08:10:14', 1);

-- --------------------------------------------------------

--
-- Table structure for table `registration`
--

CREATE TABLE `registration` (
  `id` int(11) NOT NULL,
  `fullName` varchar(255) NOT NULL,
  `IC_No` varchar(255) NOT NULL,
  `Phone` varchar(255) NOT NULL,
  `Address` text NOT NULL,
  `maritalStatus` varchar(255) NOT NULL,
  `iAgree` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `registration`
--

INSERT INTO `registration` (`id`, `fullName`, `IC_No`, `Phone`, `Address`, `maritalStatus`, `iAgree`) VALUES
(1, 'Nur Aisyah Damia Binti Abdul Rahim', '020703-10-0314', '011-39070245', 'Alam Impian', 'Single', 1),
(2, 'Damia', '0307', '0245', 'Shah Alam', 'Single', 1),
(3, 'Aisyah', '333', '777', 'SA', 'Single', 1),
(4, 'syifa', '777', '777', 'Kelantan', 'Married', 1);

-- --------------------------------------------------------

--
-- Table structure for table `users_login`
--

CREATE TABLE `users_login` (
  `id_login` varchar(255) NOT NULL,
  `username` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `role` enum('donor','admin') NOT NULL DEFAULT 'donor',
  `remember_me` tinyint(1) DEFAULT 0,
  `verifyLogin` tinyint(1) DEFAULT 0,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users_login`
--

INSERT INTO `users_login` (`id_login`, `username`, `password`, `role`, `remember_me`, `verifyLogin`, `created_at`, `updated_at`) VALUES
('1', 'hospitaladmin', '666', 'admin', 1, 0, '2024-07-05 07:51:54', '2024-07-07 08:07:16');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `donor_signup`
--
ALTER TABLE `donor_signup`
  ADD PRIMARY KEY (`id_signup`),
  ADD UNIQUE KEY `email` (`email`);

--
-- Indexes for table `registration`
--
ALTER TABLE `registration`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users_login`
--
ALTER TABLE `users_login`
  ADD PRIMARY KEY (`id_login`),
  ADD UNIQUE KEY `username` (`username`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `donor_signup`
--
ALTER TABLE `donor_signup`
  MODIFY `id_signup` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `registration`
--
ALTER TABLE `registration`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
