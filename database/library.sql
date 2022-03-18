-- phpMyAdmin SQL Dump
-- version 4.9.7
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Mar 18, 2022 at 08:40 PM
-- Server version: 5.7.37
-- PHP Version: 7.3.33

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `physics1_library`
--

-- --------------------------------------------------------

--
-- Table structure for table `all_students`
--

CREATE TABLE `all_students` (
  `id` varchar(128) NOT NULL,
  `name` varchar(64) NOT NULL,
  `class` varchar(64) NOT NULL,
  `roll_no` varchar(64) NOT NULL,
  `books_pending` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `books_record`
--

CREATE TABLE `books_record` (
  `id` int(11) NOT NULL,
  `student_name` varchar(64) NOT NULL,
  `student_id` varchar(128) NOT NULL,
  `class` varchar(64) NOT NULL,
  `roll_no` varchar(64) NOT NULL,
  `book_name` varchar(128) NOT NULL,
  `issued_on` varchar(16) NOT NULL,
  `returned` varchar(4) NOT NULL,
  `returned_on` varchar(16) NOT NULL,
  `remark` varchar(256) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `enjoyers`
--

CREATE TABLE `enjoyers` (
  `username` varchar(128) NOT NULL,
  `password` varchar(128) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `enjoyers`
--

INSERT INTO `enjoyers` (`username`, `password`) VALUES
('user', '0000');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `all_students`
--
ALTER TABLE `all_students`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `books_record`
--
ALTER TABLE `books_record`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `enjoyers`
--
ALTER TABLE `enjoyers`
  ADD PRIMARY KEY (`username`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `books_record`
--
ALTER TABLE `books_record`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
