-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jun 28, 2025 at 05:12 PM
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
-- Database: `getform`
--

-- --------------------------------------------------------

--
-- Table structure for table `contact_form`
--

CREATE TABLE `contact_form` (
  `id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `email` varchar(255) NOT NULL,
  `subject` varchar(255) DEFAULT NULL,
  `message` text DEFAULT NULL,
  `submitted_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `contact_form`
--

INSERT INTO `contact_form` (`id`, `name`, `email`, `subject`, `message`, `submitted_at`) VALUES
(1, 'asdasdsad', 'subhanj873@gmail.com', 'asdasdasd', 'asdasdasd', '2025-06-26 18:43:31');

-- --------------------------------------------------------

--
-- Table structure for table `getform`
--

CREATE TABLE `getform` (
  `id` int(11) NOT NULL,
  `name` varchar(50) NOT NULL,
  `email` varchar(254) NOT NULL,
  `password` varchar(255) NOT NULL,
  `cnic` varchar(13) NOT NULL,
  `select_program` varchar(50) NOT NULL,
  `program_preference_1` varchar(50) NOT NULL,
  `program_preference_2` varchar(50) NOT NULL,
  `program_preference_3` varchar(50) NOT NULL,
  `hobbies` varchar(50) NOT NULL,
  `session` varchar(50) NOT NULL,
  `file_path` varchar(255) NOT NULL,
  `test_date` date NOT NULL,
  `test_time` time NOT NULL,
  `ageRange` int(11) NOT NULL,
  `joinUni` varchar(250) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `getform`
--

INSERT INTO `getform` (`id`, `name`, `email`, `password`, `cnic`, `select_program`, `program_preference_1`, `program_preference_2`, `program_preference_3`, `hobbies`, `session`, `file_path`, `test_date`, `test_time`, `ageRange`, `joinUni`) VALUES
(30, 'Muhammad Subhan Saeed', 'subhanj873@gmail.com', 'ftXQnH6eM5ym6ZnVvEEU33d@', '6110174104129', '1', '2', '3', '4', 'Photography', 'Morning', 'upload/685da72d203cf_Screenshot 2025-06-19 005111.png', '2025-06-28', '05:05:00', 25, 'Changedasdasdasd');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `contact_form`
--
ALTER TABLE `contact_form`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `getform`
--
ALTER TABLE `getform`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `contact_form`
--
ALTER TABLE `contact_form`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `getform`
--
ALTER TABLE `getform`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=31;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
