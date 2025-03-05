-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Mar 05, 2025 at 09:14 AM
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
-- Database: `list`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `id` int(11) NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`id`, `username`, `password`) VALUES
(1, 'admin', '0192023a7bbd73250516f069df18b500');

-- --------------------------------------------------------

--
-- Table structure for table `illnesses`
--

CREATE TABLE `illnesses` (
  `id` int(11) NOT NULL,
  `child_name` varchar(255) NOT NULL,
  `birthdate` date NOT NULL,
  `current_age` int(11) NOT NULL,
  `illness` varchar(255) NOT NULL,
  `medication` varchar(255) DEFAULT NULL,
  `dose` varchar(100) DEFAULT NULL,
  `frequency` varchar(100) DEFAULT NULL,
  `duration` varchar(100) DEFAULT NULL,
  `start_date` date DEFAULT NULL,
  `end_date` date DEFAULT NULL,
  `date_added` timestamp NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `medications`
--

CREATE TABLE `medications` (
  `id` int(11) NOT NULL,
  `patient_group` varchar(50) NOT NULL,
  `patient_name` varchar(100) NOT NULL,
  `prescribed_by` varchar(100) NOT NULL,
  `medicine_name` varchar(100) NOT NULL,
  `strength` varchar(50) NOT NULL,
  `mg_kg_day` varchar(50) NOT NULL,
  `dose` varchar(50) NOT NULL,
  `frequency` varchar(50) NOT NULL,
  `duration` varchar(50) NOT NULL,
  `day` varchar(10) DEFAULT NULL,
  `week` varchar(10) DEFAULT NULL,
  `month` varchar(10) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `medications`
--

INSERT INTO `medications` (`id`, `patient_group`, `patient_name`, `prescribed_by`, `medicine_name`, `strength`, `mg_kg_day`, `dose`, `frequency`, `duration`, `day`, `week`, `month`) VALUES
(1, 'Group 1', 'Kim Grijalde', 'Jessie', 'Almuranas', 'Bicep', '50/10/3', '12', 'every night at bed time', '6', '3', '', '');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `first_name` varchar(50) NOT NULL,
  `last_name` varchar(50) NOT NULL,
  `sex` enum('Male','Female','Other') NOT NULL,
  `date_of_birth` date NOT NULL,
  `date_of_admission` date NOT NULL,
  `age_of_admission` int(11) NOT NULL,
  `current_age` int(11) NOT NULL,
  `children_category` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `first_name`, `last_name`, `sex`, `date_of_birth`, `date_of_admission`, `age_of_admission`, `current_age`, `children_category`) VALUES
(1, 'Jessie', 'Besa', 'Male', '2004-02-10', '2005-03-13', 1, 21, ''),
(2, 'Hanns12312', 'De Guzman', 'Male', '2020-06-16', '2025-03-18', 5, 5, ''),
(3, 'Elmar', 'Panganiban', 'Male', '2000-01-14', '2011-12-25', 11, 25, 'Pre-School'),
(4, 'Justin', 'Taneo', 'Male', '2001-07-14', '2009-11-19', 8, 24, 'Nursery 1');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `username` (`username`);

--
-- Indexes for table `illnesses`
--
ALTER TABLE `illnesses`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `medications`
--
ALTER TABLE `medications`
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
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `illnesses`
--
ALTER TABLE `illnesses`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `medications`
--
ALTER TABLE `medications`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
