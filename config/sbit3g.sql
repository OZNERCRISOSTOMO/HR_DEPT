-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Mar 01, 2023 at 04:57 AM
-- Server version: 10.4.22-MariaDB
-- PHP Version: 7.4.27

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `sbit3g`
--

-- --------------------------------------------------------

--
-- Table structure for table `employees`
--

CREATE TABLE `employees` (
  `id` int(20) NOT NULL,
  `first_name` varchar(60) NOT NULL,
  `last_name` varchar(60) NOT NULL,
  `email` varchar(60) NOT NULL,
  `department` varchar(60) NOT NULL,
  `contact` varchar(50) DEFAULT NULL,
  `date_hired` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `employees`
--

INSERT INTO `employees` (`id`, `first_name`, `last_name`, `email`, `department`, `contact`, `date_hired`) VALUES
(1, 'John', 'Smith', 'john.smith@example.com', 'sales', '09476148086', '0000-00-00'),
(2, 'Jane', 'Doe', 'jane.doe@example.com', 'inventory', '09815291195', '0000-00-00'),
(3, 'Bob', 'Johnson', 'bob.johnson@example.com', 'sales', '09205200224', '0000-00-00'),
(4, 'Sara', 'Lee', 'sara.lee@example.com', 'inventory', '09561183776', '0000-00-00'),
(5, 'Tom', 'Johnson', 'tom.johnson@example.com', 'sales', '09815690006', '0000-00-00'),
(6, 'Sarah', 'Jones', 'sarah.jones@example.com', 'inventory', '09447456420', '0000-00-00'),
(7, 'Mike', 'Brown', 'mike.brown@example.com', 'sales', '09160462210', '0000-00-00'),
(8, 'Lisa', 'Lee', 'lisa.lee@example.com', 'inventory', '0921674481', '0000-00-00'),
(9, 'David', 'Clark', 'david.clark@example.com', 'sales', '09967655529', '0000-00-00'),
(10, 'Amy', 'Miller', 'amy.miller@example.com', 'inventory', '09190385000', '0000-00-00'),
(11, 'Jason', 'Harris', 'jason.harris@example.com', 'sales', '09908415531', '0000-00-00'),
(12, 'Amy', 'Smith', 'amy.smith@example.com', 'inventory', '09546430369', '0000-00-00'),
(13, 'Mike', 'Johnson', 'mike.johnson@example.com', 'sales', '09206437510', '0000-00-00'),
(14, 'Emily', 'Lee', 'emily.lee@example.com', 'inventory', '094439653', '0000-00-00'),
(15, 'Joe', 'Davis', 'joe.davis@example.com', 'sales', '09226416103', '0000-00-00'),
(16, 'Sarah', 'Clark', 'sarah.clark@example.com', 'inventory', '09261949363', '0000-00-00');

-- --------------------------------------------------------

--
-- Table structure for table `hr_dept`
--

CREATE TABLE `hr_dept` (
  `id` int(20) NOT NULL,
  `email` varchar(60) NOT NULL,
  `password` char(60) NOT NULL,
  `first_name` varchar(50) DEFAULT NULL,
  `last_name` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `hr_dept`
--

INSERT INTO `hr_dept` (`id`, `email`, `password`, `first_name`, `last_name`) VALUES
(1, 'admin@gmail.com', 'admin123', 'renzo', 'crisostomo');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `employees`
--
ALTER TABLE `employees`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `hr_dept`
--
ALTER TABLE `hr_dept`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `employees`
--
ALTER TABLE `employees`
  MODIFY `id` int(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT for table `hr_dept`
--
ALTER TABLE `hr_dept`
  MODIFY `id` int(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
