-- phpMyAdmin SQL Dump
-- version 4.8.2
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Sep 14, 2018 at 04:22 PM
-- Server version: 10.1.34-MariaDB
-- PHP Version: 7.2.8

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `phpProject`
--

-- --------------------------------------------------------

--
-- Table structure for table `Attendance`
--

CREATE TABLE `Attendance` (
  `att_id` int(11) NOT NULL,
  `emp_id` int(11) NOT NULL,
  `att_status` varchar(5) DEFAULT NULL,
  `time_in` varchar(15) DEFAULT NULL,
  `time_out` varchar(15) DEFAULT NULL,
  `day` varchar(15) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `Attendance`
--

INSERT INTO `Attendance` (`att_id`, `emp_id`, `att_status`, `time_in`, `time_out`, `day`) VALUES
(4, 6, 'A', '13:15', '13:15', '10-09-18'),
(7, 7, 'A', '18:52', '18:52', '11-09-18'),
(9, 6, 'P', '09:20', '18:00', '12-08-18'),
(10, 6, 'A', '16:08', '16:10', '14-09-18'),
(12, 7, 'A', '17:07', NULL, '14-09-18'),
(13, 8, 'A', '17:07', NULL, '14-09-18');

-- --------------------------------------------------------

--
-- Table structure for table `Department`
--

CREATE TABLE `Department` (
  `dept_id` int(11) NOT NULL,
  `dept_name` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `Department`
--

INSERT INTO `Department` (`dept_id`, `dept_name`) VALUES
(1, 'SFF'),
(2, 'SRR'),
(3, 'EKOMI'),
(4, 'FE');

-- --------------------------------------------------------

--
-- Table structure for table `Designation`
--

CREATE TABLE `Designation` (
  `desig_id` int(11) NOT NULL,
  `desig_name` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `Designation`
--

INSERT INTO `Designation` (`desig_id`, `desig_name`) VALUES
(1, 'Developer'),
(2, 'Manager'),
(3, 'HR'),
(4, 'CEO');

-- --------------------------------------------------------

--
-- Table structure for table `Employees`
--

CREATE TABLE `Employees` (
  `emp_id` int(11) NOT NULL,
  `emp_name` varchar(255) NOT NULL,
  `emp_email` varchar(255) NOT NULL,
  `emp_salary` int(11) NOT NULL,
  `emp_img` varchar(255) DEFAULT NULL,
  `emp_password` varchar(255) NOT NULL,
  `dept_id` int(11) NOT NULL,
  `desig_id` int(11) NOT NULL,
  `boss_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `Employees`
--

INSERT INTO `Employees` (`emp_id`, `emp_name`, `emp_email`, `emp_salary`, `emp_img`, `emp_password`, `dept_id`, `desig_id`, `boss_id`) VALUES
(6, 'champerrrr', 'champ@coeus.de', 50000, 'p-champ@coeus.de.jpg', 'my5h05ZeWxGhU', 1, 1, NULL),
(7, 'nauman', 'nauman@coeus.de', 50000, 'p-nauman@coeus.de.jpg', 'myIQPUsALerQw', 1, 1, NULL),
(8, 'anam', 'anam@coeus.de', 60000, 'p-anam@coeus.de.jpg', 'myIQPUsALerQw', 1, 1, NULL);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `Attendance`
--
ALTER TABLE `Attendance`
  ADD PRIMARY KEY (`att_id`),
  ADD KEY `emp_id` (`emp_id`);

--
-- Indexes for table `Department`
--
ALTER TABLE `Department`
  ADD PRIMARY KEY (`dept_id`);

--
-- Indexes for table `Designation`
--
ALTER TABLE `Designation`
  ADD PRIMARY KEY (`desig_id`);

--
-- Indexes for table `Employees`
--
ALTER TABLE `Employees`
  ADD PRIMARY KEY (`emp_id`),
  ADD KEY `dept_id` (`dept_id`),
  ADD KEY `desig_id` (`desig_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `Attendance`
--
ALTER TABLE `Attendance`
  MODIFY `att_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `Department`
--
ALTER TABLE `Department`
  MODIFY `dept_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `Designation`
--
ALTER TABLE `Designation`
  MODIFY `desig_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `Employees`
--
ALTER TABLE `Employees`
  MODIFY `emp_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `Attendance`
--
ALTER TABLE `Attendance`
  ADD CONSTRAINT `Attendance_ibfk_1` FOREIGN KEY (`emp_id`) REFERENCES `Employees` (`emp_id`);

--
-- Constraints for table `Employees`
--
ALTER TABLE `Employees`
  ADD CONSTRAINT `Employees_ibfk_1` FOREIGN KEY (`dept_id`) REFERENCES `Department` (`dept_id`),
  ADD CONSTRAINT `Employees_ibfk_2` FOREIGN KEY (`desig_id`) REFERENCES `Designation` (`desig_id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
