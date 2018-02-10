-- phpMyAdmin SQL Dump
-- version 4.7.2
-- https://www.phpmyadmin.net/
--
-- Host: localhost:8889
-- Generation Time: Feb 10, 2018 at 09:23 AM
-- Server version: 5.6.35
-- PHP Version: 7.1.6

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";

--
-- Database: `pscsorg_3.0`
--

-- --------------------------------------------------------

--
-- Table structure for table `admins`
--

CREATE TABLE `admins` (
  `user_id` int(11) NOT NULL,
  `full_name` varchar(32) NOT NULL,
  `email` text NOT NULL,
  `priv` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `admins`
--

INSERT INTO `admins` (`user_id`, `full_name`, `email`, `priv`) VALUES
(1, 'Tim Ichien', 'tim@pscs.org', 3);

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
-- Table structure for table `current`
--

CREATE TABLE `current` (
  `student_id` int(11) NOT NULL,
  `status_id` int(11) NOT NULL,
  `info` text NOT NULL,
  `return_time` time NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `current`
--

INSERT INTO `current` (`student_id`, `status_id`, `info`, `return_time`) VALUES
(2, 1, '', '00:00:00'),
(3, 1, '', '00:00:00'),
(4, 1, '', '00:00:00'),
(5, 3, '', '00:00:00'),
(6, 1, '', '00:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `facilitators`
--

CREATE TABLE `facilitators` (
  `facilitator_id` int(11) NOT NULL,
  `facilitator_name` varchar(32) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `history`
--

CREATE TABLE `history` (
  `event_id` int(11) NOT NULL,
  `student_id` int(11) NOT NULL,
  `timestamp` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `status_id` int(11) NOT NULL,
  `info` text NOT NULL,
  `return_time` time NOT NULL,
  `offsite_hrs_used` float NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `holidays`
--

CREATE TABLE `holidays` (
  `holiday_id` int(11) NOT NULL,
  `holiday_name` varchar(32) NOT NULL,
  `holiday_date` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `login`
--

CREATE TABLE `login` (
  `login_year` year(4) NOT NULL,
  `login_password` varchar(32) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `offsite_locations`
--

CREATE TABLE `offsite_locations` (
  `location_id` int(11) NOT NULL,
  `location_name` varchar(32) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `status_data`
--

CREATE TABLE `status_data` (
  `status_id` int(11) NOT NULL,
  `status_name` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `status_data`
--

INSERT INTO `status_data` (`status_id`, `status_name`) VALUES
(0, 'Not checked in'),
(1, 'Present'),
(2, 'Offsite'),
(3, 'Field Trip'),
(4, 'Checked Out'),
(5, 'Late'),
(6, 'Independent study'),
(7, 'Absent');

-- --------------------------------------------------------

--
-- Table structure for table `student_data`
--

CREATE TABLE `student_data` (
  `student_id` int(11) NOT NULL,
  `full_name` varchar(50) NOT NULL,
  `first_name` text NOT NULL,
  `last_name` text NOT NULL,
  `imgurl` varchar(255) NOT NULL,
  `grad_year` int(11) NOT NULL,
  `veteran_year` int(11) NOT NULL,
  `current_offsite_hours` float NOT NULL,
  `current_is_hours` float NOT NULL,
  `priv` int(11) NOT NULL DEFAULT '1',
  `user_id` int(11) NOT NULL,
  `active` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `student_data`
--

INSERT INTO `student_data` (`student_id`, `full_name`, `first_name`, `last_name`, `imgurl`, `grad_year`, `veteran_year`, `current_offsite_hours`, `current_is_hours`, `priv`, `user_id`, `active`) VALUES
(2, 'Samuel Boerner', 'Samuel', 'Boerner', 'https://google.com', 2020, 5, 1000, 300, 1, 0, 1),
(3, 'Jack Notorangelo', 'Jack', 'Notorangelo', 'https://google.com', 2022, 2, 1000, 100, 1, 0, 1),
(4, 'Angus Breon', 'Angus', 'Breon', 'https://google.com', 2019, 6, 1000, 300, 1, 0, 1),
(5, 'Eli Kimchi', 'Eli', 'Kimchi', 'https://lh4.googleusercontent.com/-T-2d2KmgW88/AAAAAAAAAAI/AAAAAAAAAoo/w1hLreHAS8Y/s96-c/photo.jpg', 2021, 4, 1000, 200, 2, 0, 1),
(6, 'Anthony Reyes', 'Anthony', 'Reyes', '', 2018, 6, 1000, 20, 1, 0, 1);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admins`
--
ALTER TABLE `admins`
  ADD PRIMARY KEY (`user_id`);

--
-- Indexes for table `facilitators`
--
ALTER TABLE `facilitators`
  ADD PRIMARY KEY (`facilitator_id`);

--
-- Indexes for table `history`
--
ALTER TABLE `history`
  ADD PRIMARY KEY (`event_id`);

--
-- Indexes for table `holidays`
--
ALTER TABLE `holidays`
  ADD PRIMARY KEY (`holiday_id`);

--
-- Indexes for table `login`
--
ALTER TABLE `login`
  ADD PRIMARY KEY (`login_year`);

--
-- Indexes for table `offsite_locations`
--
ALTER TABLE `offsite_locations`
  ADD PRIMARY KEY (`location_id`);

--
-- Indexes for table `status_data`
--
ALTER TABLE `status_data`
  ADD PRIMARY KEY (`status_id`);

--
-- Indexes for table `student_data`
--
ALTER TABLE `student_data`
  ADD PRIMARY KEY (`student_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admins`
--
ALTER TABLE `admins`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `facilitators`
--
ALTER TABLE `facilitators`
  MODIFY `facilitator_id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `history`
--
ALTER TABLE `history`
  MODIFY `event_id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `holidays`
--
ALTER TABLE `holidays`
  MODIFY `holiday_id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `offsite_locations`
--
ALTER TABLE `offsite_locations`
  MODIFY `location_id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `student_data`
--
ALTER TABLE `student_data`
  MODIFY `student_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;