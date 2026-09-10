-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Sep 06, 2026 at 05:48 AM
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
-- Database: `project_batch`
--

-- --------------------------------------------------------

--
-- Table structure for table `hostel_details`
--

CREATE TABLE `hostel_details` (
  `library_id` int(11) NOT NULL,
  `hn` varchar(500) NOT NULL,
  `ha` varchar(500) NOT NULL,
  `abt` varchar(500) NOT NULL,
  `hm` varchar(500) NOT NULL,
  `hp1` varchar(500) NOT NULL,
  `hp2` varchar(500) NOT NULL,
  `hp3` varchar(500) NOT NULL,
  `opening_time` varchar(20) DEFAULT NULL,
  `closing_time` varchar(20) DEFAULT NULL,
  `working_days` varchar(100) DEFAULT NULL,
  `seating_capacity` int(11) DEFAULT NULL,
  `fee` varchar(100) DEFAULT NULL,
  `library_type` varchar(255) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `rating` varchar(10) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `hostel_details`
--

INSERT INTO `hostel_details` (`library_id`, `hn`, `ha`, `abt`, `hm`, `hp1`, `hp2`, `hp3`, `opening_time`, `closing_time`, `working_days`, `seating_capacity`, `fee`, `library_type`, `email`, `rating`) VALUES
(1, 'Argus library', 'circular road', 'The Argus library is open ', '9031285370', 'hp1.webp', 'hp2.jpg', 'hp3.webp', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(2, 'Vidya Library', 'Lalpur ranchi', 'The  library is open ', '9031285370', 'hp3.webp', '', '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(3, 'kd Library', 'Lalpur ranchi', 'The  library is open ', '9031285370', 'pi.avif', '', '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(4, 'One Step Library', 'Lalpur ranchi', 'The  library is open ', '9031285370', 'pi3.jpg', '', '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(5, ' Library Hub', 'Lalpur ranchi', 'The  library is open ', '9031285370', 'pi4.jpg', '', '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(6, 'Read&Feel Library ', 'Lalpur ranchi', 'The  library is open ', '9031285370', 'pi5.jpg', '', '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(7, 'Book Buddy Library ', 'Lalpur ranchi', 'The  library is open ', '9031285370', 'pi6.jpg', '', '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(8, 'Divine Library', 'Lalpur ranchi', 'The  library is open ', '9031285370', 'pi7.webp', '', '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(9, 'argus library', 'circular road', 'gg', '5465676567', '', '', '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(10, 'Future Library', 'S Samaj St,New Barhi Toli,Ranchi - 834001.', 'Highly rated study space offering high speed wifi,daily newspapers,dedicated locker ,boxes,an internal cafeteriaa and robust power backup systems.', '9234567865', 'pi2.webp', 'hp3.webp', 'pi7.webp', '06:00', '10:00', 'Monday to Sunday', 100, '600/month', 'Public Library', 'future129@gmail.com', '');

-- --------------------------------------------------------

--
-- Table structure for table `user_info`
--

CREATE TABLE `user_info` (
  `user_id` int(11) NOT NULL,
  `email` varchar(50) NOT NULL,
  `pass` varchar(20) NOT NULL,
  `address` varchar(1000) NOT NULL,
  `uname` varchar(20) NOT NULL,
  `mobile` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `user_info`
--

INSERT INTO `user_info` (`user_id`, `email`, `pass`, `address`, `uname`, `mobile`) VALUES
(1, 'amritavishwakarma129@gmail.com', '123456', 'deep nagar', 'Amrita kumari', '9031285370'),
(2, 'amritavishwakarma129@gmail.com', '1234', 'deep nagar', 'amrita', '9031285370'),
(3, '', '1234', 'deep nagar', 'amrita', '9031285370'),
(4, '', '1234', 'deep nagar', 'amrita', '9031285370'),
(5, '', '1234', 'deep nagar', 'amrita', '9031285370'),
(6, '', '1234', 'deep nagar', 'amrita', '9031285370'),
(7, 'amritavishwakarma129@gmail.com', '1234', 'deep nagar', 'mausami', '9031285370');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `hostel_details`
--
ALTER TABLE `hostel_details`
  ADD PRIMARY KEY (`library_id`);

--
-- Indexes for table `user_info`
--
ALTER TABLE `user_info`
  ADD PRIMARY KEY (`user_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `hostel_details`
--
ALTER TABLE `hostel_details`
  MODIFY `library_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `user_info`
--
ALTER TABLE `user_info`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
