-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Apr 01, 2023 at 02:13 AM
-- Server version: 10.4.27-MariaDB
-- PHP Version: 8.2.0

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";

DROP DATABASE IF EXISTS brainster_db;
CREATE DATABASE brainster_db;
USE brainster_db;
--
-- Database: `brainster_db`
--

-- --------------------------------------------------------

--
-- Table structure for table `academies`
--

CREATE TABLE `academies` (
  `id` int(11) NOT NULL,
  `academy_name` varchar(35) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `academies`
--

INSERT INTO `academies` (`id`, `academy_name`) VALUES
(1, 'Академија за Mаркетинг'),
(2, 'Академија за Програмирање'),
(3, 'Академија за Data Science'),
(4, 'Академија за Дизајн');

-- --------------------------------------------------------

--
-- Table structure for table `clients`
--

CREATE TABLE `clients` (
  `id` int(11) NOT NULL,
  `full_name` varchar(35) NOT NULL,
  `company_name` varchar(35) NOT NULL,
  `email` varchar(35) NOT NULL,
  `phone` varchar(35) NOT NULL,
  `academies_id` int(11) NOT NULL,
  `time` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `clients`
--

INSERT INTO `clients` (`id`, `full_name`, `company_name`, `email`, `phone`, `academies_id`, `time`) VALUES
(1, 'Vladimir Nachevski', 'Studio N', 'nacevski.v@gmail.com', '38970826500', 2, '2023-04-01 00:02:11'),
(2, 'John Doe', 'Microsoft', 'john@live.com', '277744488965', 3, '2023-04-01 00:09:19'),
(3, 'Jane James', 'Adobe', 'jane@adobe.com', '357788996655', 4, '2023-04-01 00:10:17'),
(4, 'Петар Петровски', 'xXx', 'petar@marketing.com', '38977555999', 1, '2023-04-01 00:12:06');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `academies`
--
ALTER TABLE `academies`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `clients`
--
ALTER TABLE `clients`
  ADD PRIMARY KEY (`id`),
  ADD KEY `academies_id` (`academies_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `academies`
--
ALTER TABLE `academies`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `clients`
--
ALTER TABLE `clients`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `clients`
--
ALTER TABLE `clients`
  ADD CONSTRAINT `form_input_ibfk_1` FOREIGN KEY (`academies_id`) REFERENCES `academies` (`id`);
COMMIT;
