-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jul 08, 2024 at 08:58 AM
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
-- Table structure for table `appointments`
--

CREATE TABLE `appointments` (
  `id` int(11) NOT NULL,
  `date` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `appointments`
--

INSERT INTO `appointments` (`id`, `date`) VALUES
(1, '2024-07-02'),
(2, '2024-07-03'),
(3, '2024-07-04'),
(4, '2024-07-05');

-- --------------------------------------------------------

--
-- Table structure for table `bloodgroup`
--

CREATE TABLE `bloodgroup` (
  `id` int(255) NOT NULL,
  `bloodType` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci DEFAULT NULL,
  `postingDate` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `donors`
--

CREATE TABLE `donors` (
  `id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `ic_no` varchar(20) NOT NULL,
  `phone` varchar(20) NOT NULL,
  `address` varchar(255) NOT NULL,
  `marital_status` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `donors`
--

INSERT INTO `donors` (`id`, `name`, `ic_no`, `phone`, `address`, `marital_status`) VALUES
(6, 'Ahmad Ali', '010816030456', '0197874634', 'Segamat,Terengganu', 'Married'),
(7, 'Hussain Mohammed', '020917038796', '012783642', 'Kuching,Sarawak', 'Married');

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
(9, 'syifa', 'kelantan@gmail.com', '777', '2024-07-07 08:09:34', '2024-07-07 16:34:04', 1);

-- --------------------------------------------------------

--
-- Table structure for table `recipients`
--

CREATE TABLE `recipients` (
  `ID` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `phoneNum` varchar(20) DEFAULT NULL,
  `Descrip` varchar(200) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `recipients`
--

INSERT INTO `recipients` (`ID`, `name`, `phoneNum`, `Descrip`) VALUES
(4, 'Rahman Deraman', '017383832', '35-year-old male with a diagnosis of severe anemia due to chronic kidney disease.Blood type is O-negative.'),
(5, 'Siti Sarah', '098376754', 'A 28-year-old female with sickle cell anemia.Blood type is A-positive, and she has had multiple transfusions in the past without any complications.'),
(6, 'Robert Johnson', '0123906744', 'A 65-year-old male undergoing chemotherapy for leukemia. Robert needs frequent blood transfusions due to his treatment, about once every two weeks.Blood type is AB-positive.'),
(7, 'Emily Brown', '019788465', 'A 5-year-old girl with thalassemia major.Blood type is B-negative, and she has been receiving transfusions since infancy.');

-- --------------------------------------------------------

--
-- Table structure for table `registration`
--

CREATE TABLE `registration` (
  `id` int(11) NOT NULL,
  `fullName` varchar(14) DEFAULT NULL,
  `IC_No` varchar(200) DEFAULT NULL,
  `Phone` varchar(200) DEFAULT NULL,
  `Address` varchar(200) DEFAULT NULL,
  `maritalStatus` varchar(200) DEFAULT NULL,
  `iAgree` varchar(200) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `registration`
--

INSERT INTO `registration` (`id`, `fullName`, `IC_No`, `Phone`, `Address`, `maritalStatus`, `iAgree`) VALUES
(3, 'Siti', '190406017869', '016575788', 'Seksyen 12,Shah Alam,Selangor', 'Divorced', '1'),
(4, 'Khairul Aming', '020314038967', '0123456677', 'Kampung Hey Wassup Guys', 'Widowed', '1'),
(5, 'Anis Maisarah', '010243690674', '019785653', 'Bangi', 'Married', '1'),
(8, 'Ahmad Ali', '031105067869', '0126486326', 'Puchong,Selangor', 'Married', '1'),
(9, 'Robert Johnson', '990214036758', '0164848676', 'Kuala Terengganu', 'Married', '1');

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
('1', 'hospitaladmin', '666', 'admin', 1, 0, '2024-07-05 07:51:54', '2024-07-08 06:56:26');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `appointments`
--
ALTER TABLE `appointments`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `bloodgroup`
--
ALTER TABLE `bloodgroup`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `donors`
--
ALTER TABLE `donors`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `recipients`
--
ALTER TABLE `recipients`
  ADD PRIMARY KEY (`ID`);

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
-- AUTO_INCREMENT for table `appointments`
--
ALTER TABLE `appointments`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `bloodgroup`
--
ALTER TABLE `bloodgroup`
  MODIFY `id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `donors`
--
ALTER TABLE `donors`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `recipients`
--
ALTER TABLE `recipients`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `registration`
--
ALTER TABLE `registration`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
