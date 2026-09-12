-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Sep 12, 2026 at 10:42 AM
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
-- Table structure for table `admin_info`
--

CREATE TABLE `admin_info` (
  `admin_id` int(11) NOT NULL,
  `username` varchar(100) NOT NULL,
  `password` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `admin_info`
--

INSERT INTO `admin_info` (`admin_id`, `username`, `password`) VALUES
(1, 'admin', 'admin123');

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
(11, 'State Library', 'Near Firayalal, Sharda Babu Lane, Mahatma Gandhi Main Road, Ranchi - 834001', 'A well-known public library providing reading, reference and study facilities for students and readers.', '9000001001', 'p1.jpeg', '', '', '09:00 AM', '08:00 PM', 'Monday - Saturday', 200, '500/month', 'Public Library', 'statelibrary01@example.com', '4.4'),
(12, 'Future Library', 'S Samaj Street, New Barhi Toli, Ranchi - 834001', 'A student-friendly study library designed for focused self-study and competitive examination preparation.', '9000001002', 'p2.jpeg', '', '', '06:00 AM', '10:00 PM', 'Monday - Sunday', 150, '600/month', 'Study Library', 'futurelibrary02@example.com', '4.7'),
(13, 'Buddha Library', 'Gosai Toli Road, Near Ram Mandir, Upper Chutia, Ranchi - 834001', 'A peaceful study space suitable for students, competitive exam preparation and individual reading.', '9000001003', 'p12.jpg', '', '', '07:00', '10:00', 'Monday - Sunday', 100, '500/month', 'Study Library', 'buddhalibrary03@example.com', '4.9'),
(14, 'Ranchi Library', 'Opp. Srilok Complex, Old Hazaribagh Road, Tharpakhna, Firayalal, Ranchi - 834001', 'A convenient reading and self-study library located in the central Ranchi area.', '9000001004', 'p4.jpg', '', '', '05:30 AM', '09:00 PM', 'Monday - Saturday', 200, '600/month', 'Public Library', 'ranchilibrary04@example.com', '4.6'),
(15, 'International Library & Cultural Centre', 'Club Road, Opp. Gossner College, New Garden, Kanka, Ranchi - 834001', 'A community-oriented library providing reading resources, study materials and a suitable environment for students.', '9000001005', 'p5.jpg', '', '', '10:00 AM', '08:00 PM', 'Monday - Saturday', 150, '500/month', 'Public Library', 'ilcc05@example.com', '4.2'),
(16, 'Vedanta Library', '1st Floor, Rathore Tower, Behind Bajrangi Book Shop, Circular Road, Lalpur, Ranchi - 834001', 'A comfortable study library providing a quiet environment for students and readers.', '9000001006', 'p11.webp', '', '', '07:00', '10:00', 'Monday - Sunday', 100, '600/month', 'Study Library', 'vedantalibrary06@example.com', '4.9'),
(17, 'Mindspace Library', 'Hazaribagh Road, Opp. Vijayvargia Complex, Kokar, Ranchi - 834009', 'A study-focused library offering a calm environment for long hours of individual study.', '9000001007', 'p7.jpg', '', '', '08:00 AM', '11:00 PM', 'Monday - Sunday', 200, '500/month', 'Study Library', 'mindspace07@example.com', '4.9'),
(18, 'Officer Library', '1st Floor, Bimla Enclave, F-12, Antu Chowk, Morabadi, Ranchi - 834008', 'A dedicated study space providing a comfortable and peaceful environment for students and competitive exam aspirants.', '9000001008', 'library_18_1_1789150837.jpg', '', '', '08:00', '12:00', 'Monday - Sunday', 150, '600/month', 'Study Library', 'officerlibrary08@example.com', '4.9'),
(19, 'PAGE1 Library & CoWork', '4th Floor, Devi Kripa Complex, Hazaribagh Road, Opp. Best Photo Lab, Ranchi - 834001', 'A modern study and co-working space suitable for self-study, academic work and focused learning.', '9000001009', 'p9.jpg', '', '', '06:00 AM', '10:00 PM', 'Monday - Sunday', 200, '500/month', 'Private Library', 'page1library09@example.com', '4.9'),
(20, 'Reader\'s Junction Library', '601, RS Tower, Lalpur, Ranchi - 834001', 'A reading and self-study space designed for students and regular readers.', '9000001010', 'library_20_1_1789150890.jpg', '', '', '07:00', '11:00', 'Monday - Saturday', 100, '600/month', 'Study Library', 'readersjunction10@example.com', '4.3'),
(21, 'Diksha Library', 'Dr. Usha Rani Gali, Opp. Amrawati Complex, Lalpur, Ranchi - 834001', 'A student-oriented library providing a peaceful environment for reading, self-study and examination preparation.', '9000001011', 'p6.jpg', '', '', '08:00', '11:00', 'Monday - Sunday', 150, '500/month', 'Public Library', 'dikshalibrary11@example.com', '4.7'),
(22, 'GoodWorks Library', '7th Floor, Shree Sai Tower, Circular Road, P&T Colony, Lalpur, Ranchi - 834001', 'A long-hour study library providing a focused environment for students and individual learners.', '9000001012', 'p3.jpeg', '', '', '06:00', '10:00', 'Monday - Sunday', 200, '600/month', 'Study Library', 'goodworkslibrary12@example.com', '4.6');

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
(9, 'amr@gmail.com', '1111', 'ravi steel', 'Nia', '5678435677');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin_info`
--
ALTER TABLE `admin_info`
  ADD PRIMARY KEY (`admin_id`),
  ADD UNIQUE KEY `username` (`username`);

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
-- AUTO_INCREMENT for table `admin_info`
--
ALTER TABLE `admin_info`
  MODIFY `admin_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `hostel_details`
--
ALTER TABLE `hostel_details`
  MODIFY `library_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- AUTO_INCREMENT for table `user_info`
--
ALTER TABLE `user_info`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
