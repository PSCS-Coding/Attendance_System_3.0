-- phpMyAdmin SQL Dump
-- version 4.7.3
-- https://www.phpmyadmin.net/
--
-- Host: localhost:8889
-- Generation Time: Jan 29, 2018 at 10:34 PM
-- Server version: 5.6.35
-- PHP Version: 7.1.8

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `attendance_new`
--

-- --------------------------------------------------------

--
-- Table structure for table `allotted_hours`
--

CREATE TABLE `allotted_hours` (
  `veteran_year` int(11) NOT NULL,
  `default_offsite` float NOT NULL,
  `default_is` float NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `current_stati`
--

CREATE TABLE `current_stati` (
  `student_id` int(11) NOT NULL,
  `status_id` int(11) NOT NULL,
  `info` text NOT NULL,
  `return_time` time NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `current_stati`
--

INSERT INTO `current_stati` (`student_id`, `status_id`, `info`, `return_time`) VALUES
(2, 2, '', '00:00:00'),
(3, 2, '', '00:00:00'),
(4, 2, '', '00:00:00'),
(5, 2, '', '00:00:00'),
(6, 2, '', '00:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `history`
--

CREATE TABLE `history` (
  `event_id` int(11) NOT NULL,
  `student_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `timestamp` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `status_id` int(11) NOT NULL,
  `info` text NOT NULL,
  `return_time` time NOT NULL,
  `offsite_hrs_used` float NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `status`
--

CREATE TABLE `status` (
  `status_id` int(11) NOT NULL,
  `status_name` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `status`
--

INSERT INTO `status` (`status_id`, `status_name`) VALUES
(0, 'Not checked in'),
(1, 'Late'),
(2, 'Present'),
(3, 'Offsite'),
(4, 'Field trip'),
(5, 'Signed out'),
(6, 'Independant study'),
(7, 'Absent');

-- --------------------------------------------------------

--
-- Table structure for table `students`
--

CREATE TABLE `students` (
  `student_id` int(11) NOT NULL,
  `first_name` text NOT NULL,
  `last_name` text NOT NULL,
  `grad_year` int(11) NOT NULL,
  `veteran_year` int(11) NOT NULL,
  `current_offsite_hours` float NOT NULL,
  `current_is_hours` float NOT NULL,
  `user_id` int(11) NOT NULL,
  `active` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `students`
--

INSERT INTO `students` (`student_id`, `first_name`, `last_name`, `grad_year`, `veteran_year`, `current_offsite_hours`, `current_is_hours`, `user_id`, `active`) VALUES
(2, 'Samuel', 'Boerner', 2020, 5, 1000, 300, 0, 1),
(3, 'Jack', 'Notorangelo', 2022, 2, 1000, 100, 0, 1),
(4, 'Angus', 'Breon', 2019, 6, 1000, 300, 0, 1),
(5, 'Eli', 'Kimchi', 2021, 4, 1000, 200, 0, 1),
(6, 'Anthony', 'Reyes', 2018, 6, 1000, 20, 0, 1);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `user_id` int(11) NOT NULL,
  `email` text NOT NULL,
  `priveleges` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `history`
--
ALTER TABLE `history`
  ADD PRIMARY KEY (`event_id`);

--
-- Indexes for table `students`
--
ALTER TABLE `students`
  ADD PRIMARY KEY (`student_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`user_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `history`
--
ALTER TABLE `history`
  MODIFY `event_id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `students`
--
ALTER TABLE `students`
  MODIFY `student_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
