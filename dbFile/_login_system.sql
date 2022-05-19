-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Feb 25, 2022 at 02:39 PM
-- Server version: 10.4.21-MariaDB
-- PHP Version: 7.4.24

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `@login#system`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `id` int(150) NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `code` mediumint(50) NOT NULL,
  `status` text NOT NULL,
  `adminStatus` int(11) NOT NULL,
  `registrationDate` timestamp NOT NULL DEFAULT current_timestamp(),
  `updateDate` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`id`, `name`, `email`, `password`, `code`, `status`, `adminStatus`, `registrationDate`, `updateDate`) VALUES
(1, 'admin', 'boutros.georges513@gmail.com', '$2y$10$FGMNROEYJe7f2.IpdC7uKuXn2E7IZDrQ2KoUG.VhEhc.Hv89OuSFy', 0, 'verified', 1, '2022-02-25 13:37:51', '');

-- --------------------------------------------------------

--
-- Table structure for table `user$`
--

CREATE TABLE `user$` (
  `id` bigint(150) NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `code` mediumtext NOT NULL,
  `status` text NOT NULL,
  `userStatus` int(11) NOT NULL,
  `registrationDate` timestamp NOT NULL DEFAULT current_timestamp(),
  `updateDate` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `user$`
--

INSERT INTO `user$` (`id`, `name`, `email`, `password`, `code`, `status`, `userStatus`, `registrationDate`, `updateDate`) VALUES
(1, 'georges', 'boutros.georges513@gmail.com', '$2y$10$FGMNROEYJe7f2.IpdC7uKuXn2E7IZDrQ2KoUG.VhEhc.Hv89OuSFy', '0', 'verified', 1, '2022-02-25 13:35:40', '');

-- --------------------------------------------------------

--
-- Table structure for table `userlog`
--

CREATE TABLE `userlog` (
  `id` int(150) NOT NULL,
  `userEmail` varchar(255) NOT NULL,
  `userIp` tinyint(1) NOT NULL,
  `status` text NOT NULL,
  `loginTime` timestamp NULL DEFAULT current_timestamp(),
  `logoutTime` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `userlog`
--

INSERT INTO `userlog` (`id`, `userEmail`, `userIp`, `status`, `loginTime`, `logoutTime`) VALUES
(1, 'boutros.georges513@gmail.com', 0, '1', '2022-02-25 13:36:37', '25-02-2022 03:39:02 PM');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `user$`
--
ALTER TABLE `user$`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `userlog`
--
ALTER TABLE `userlog`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin`
--
ALTER TABLE `admin`
  MODIFY `id` int(150) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `user$`
--
ALTER TABLE `user$`
  MODIFY `id` bigint(150) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `userlog`
--
ALTER TABLE `userlog`
  MODIFY `id` int(150) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
