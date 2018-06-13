-- phpMyAdmin SQL Dump
-- version 4.8.0.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Jun 07, 2018 at 02:33 PM
-- Server version: 10.0.34-MariaDB
-- PHP Version: 5.5.14

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `ses`
--

-- --------------------------------------------------------

--
-- Table structure for table `employee`
--

CREATE TABLE `employee` (
  `ID` int(11) NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `fullname` varchar(50) DEFAULT NULL,
  `surname` varchar(50) DEFAULT NULL,
  `position_id` int(11) DEFAULT NULL,
  `employed_date` date DEFAULT NULL,
  `birthday` date DEFAULT NULL,
  `tell` varchar(50) DEFAULT NULL,
  `email` varchar(50) DEFAULT NULL,
  `ACTIVE` tinyint(1) NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `employee`
--

INSERT INTO `employee` (`ID`, `user_id`, `fullname`, `surname`, `position_id`, `employed_date`, `birthday`, `tell`, `email`, `ACTIVE`) VALUES
(1, 1, 'Admin', 'Admin', 1, '2018-01-01', '2018-01-01', '0123456789', 'admin@admin.admin', 1),
(2, 2, 'Sir', 'Pauley', 2, '2018-01-01', '1991-06-06', '0713396180', 'sirpauley@gmail.com', 1),
(3, 3, 'John', 'Lennon', 3, '2001-06-01', '2001-06-02', '0123456789', 'test@mail.com', 1),
(4, 4, 'Ad', 'Min 2', 1, '2014-06-07', '1995-06-07', '0123456789', 'admin@here.com', 1),
(5, 5, 'Bob', 'Marley', 6, '2018-05-09', '1992-06-09', '0123456789', 'me@me.me', 1);

-- --------------------------------------------------------

--
-- Table structure for table `joblevel`
--

CREATE TABLE `joblevel` (
  `ID` int(11) NOT NULL,
  `level` int(11) DEFAULT NULL,
  `description` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `joblevel`
--

INSERT INTO `joblevel` (`ID`, `level`, `description`) VALUES
(1, 1, 'super admin'),
(2, 2, 'DBA'),
(3, 3, 'TECHY'),
(4, 4, 'CEO'),
(5, 5, 'Clerk'),
(6, 99, 'cleaner');

-- --------------------------------------------------------

--
-- Table structure for table `likes`
--

CREATE TABLE `likes` (
  `ID` int(11) NOT NULL,
  `employee_id` int(11) DEFAULT NULL,
  `employee_liked_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `likes`
--

INSERT INTO `likes` (`ID`, `employee_id`, `employee_liked_id`) VALUES
(1, 1, 1),
(2, 1, 2),
(3, 1, 3),
(4, 2, 2),
(5, 2, 1),
(6, 3, 3),
(7, 3, 2),
(8, 4, 2),
(9, 4, 4);

-- --------------------------------------------------------

--
-- Table structure for table `review`
--

CREATE TABLE `review` (
  `ID` int(11) NOT NULL,
  `employee_id` int(11) DEFAULT NULL,
  `reviewer_id` int(11) DEFAULT NULL,
  `comment` varchar(1000) DEFAULT NULL,
  `comment_date` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `review`
--

INSERT INTO `review` (`ID`, `employee_id`, `reviewer_id`, `comment`, `comment_date`) VALUES
(1, 2, 4, 'you are the best mate !\n', '2018-06-07'),
(2, 2, 3, 'Rock on !!', '2018-06-07'),
(3, 2, 5, 'I love you man!!', '2018-06-07');

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `ID` int(11) NOT NULL,
  `user` varchar(50) DEFAULT NULL,
  `password` varchar(60) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`ID`, `user`, `password`) VALUES
(1, 'admin', '21232f297a57a5a743894a0e4a801fc3'),
(2, 'sirpauley', '21232f297a57a5a743894a0e4a801fc3'),
(3, 'johnLennon', '21232f297a57a5a743894a0e4a801fc3'),
(4, 'admin2', '21232f297a57a5a743894a0e4a801fc3'),
(5, 'bob', '21232f297a57a5a743894a0e4a801fc3');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `employee`
--
ALTER TABLE `employee`
  ADD PRIMARY KEY (`ID`),
  ADD KEY `user_id` (`user_id`),
  ADD KEY `position_id` (`position_id`);

--
-- Indexes for table `joblevel`
--
ALTER TABLE `joblevel`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `likes`
--
ALTER TABLE `likes`
  ADD PRIMARY KEY (`ID`),
  ADD KEY `employee_id` (`employee_id`),
  ADD KEY `employee_liked_id` (`employee_liked_id`);

--
-- Indexes for table `review`
--
ALTER TABLE `review`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`ID`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `employee`
--
ALTER TABLE `employee`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `joblevel`
--
ALTER TABLE `joblevel`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `likes`
--
ALTER TABLE `likes`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `review`
--
ALTER TABLE `review`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `employee`
--
ALTER TABLE `employee`
  ADD CONSTRAINT `employee_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `user` (`ID`),
  ADD CONSTRAINT `employee_ibfk_2` FOREIGN KEY (`position_id`) REFERENCES `joblevel` (`ID`);

--
-- Constraints for table `likes`
--
ALTER TABLE `likes`
  ADD CONSTRAINT `likes_ibfk_1` FOREIGN KEY (`employee_id`) REFERENCES `employee` (`ID`),
  ADD CONSTRAINT `likes_ibfk_2` FOREIGN KEY (`employee_liked_id`) REFERENCES `employee` (`ID`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
