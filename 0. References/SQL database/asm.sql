-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Sep 14, 2021 at 08:34 AM
-- Server version: 10.4.19-MariaDB
-- PHP Version: 8.0.7

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `asm`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `adminid` varchar(10) NOT NULL,
  `password` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`adminid`, `password`) VALUES
('Admin', 'Admin');

-- --------------------------------------------------------

--
-- Table structure for table `cart`
--

CREATE TABLE `cart` (
  `Cart` int(11) NOT NULL,
  `Quantity` int(11) NOT NULL,
  `EventID` varchar(255) CHARACTER SET latin1 NOT NULL,
  `StudentID` varchar(35) CHARACTER SET latin1 NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `cart`
--

INSERT INTO `cart` (`Cart`, `Quantity`, `EventID`, `StudentID`) VALUES
(31, 3, 'ET6', '20PMD12346'),
(32, 4, 'ET3', '20PMD12346'),
(33, 4, 'ET5', '20PMD12346'),
(36, 4, 'ET1', '20PMD12346'),
(39, 1, 'ET3', '20PMD12347'),
(40, 4, 'ET7', '20PMD12347'),
(71, 6, 'ET1', '20PMD12345'),
(72, 3, 'ET4', '20PMD12345'),
(73, 7, 'ET7', '20PMD12345'),
(74, 3, 'ET3', '20PMD12345');

-- --------------------------------------------------------

--
-- Table structure for table `event`
--

CREATE TABLE `event` (
  `ETid` varchar(255) NOT NULL,
  `ETtitle` varchar(300) NOT NULL,
  `ETinfo` varchar(1000) NOT NULL,
  `ETday` date NOT NULL,
  `ETtime` time NOT NULL,
  `ETnum` int(5) NOT NULL,
  `ETvenue` varchar(300) NOT NULL,
  `ETprice` double(5,2) NOT NULL,
  `images` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `event`
--

INSERT INTO `event` (`ETid`, `ETtitle`, `ETinfo`, `ETday`, `ETtime`, `ETnum`, `ETvenue`, `ETprice`, `images`) VALUES
('ET1', 'National Under 18 Championships 2021 ', 'International Challenge', '2021-09-30', '14:40:00', 50, 'Google meet', 5.00, 'badminton-association-of-maldives.png'),
('ET2', 'VICTOR MALAYSIA INTERNATIONAL SERIES 2021', 'International Series', '2021-09-07', '19:20:00', 20, 'Meet', 2.00, 'osaka-international-challenge-2019-logo2.jpg'),
('ET3', 'YONEX OSAKA INTERNATIONAL CHALLENGE 2021', 'International Challenge', '2021-10-18', '10:30:00', 50, 'Discord', 2.00, 'pembangunan-jaya-raya-2019.png'),
('ET4', 'YONEX OSAKA INTERNATIONAL CHALLENGE 2021', 'International Challenge', '2021-09-07', '22:50:00', 30, 'Discord', 5.00, 'picture1.png'),
('ET5', 'CELCOM AXIATA MALAYSIA INTERNATIONAL JUNIOR OPEN 2021', 'Junior International Challenge', '2021-09-07', '23:53:00', 10, 'Meet', 2.00, 'screen-shot-2011-12-02-at-09-16-58-274x300.png'),
('ET6', '100PLUS Badminton Junior Elite Tour 2021', 'Junior Elite', '2021-09-23', '12:00:00', 8, 'Discord', 7.00, 'badminton-india-bai-lable.jpg'),
('ET7', 'The Double Trouble', 'Badminton friendly match', '2021-09-08', '10:00:00', 20, 'Discord', 2.00, 'vietnam-badminton-federation-1.png'),
('ET8', 'The Worlds Strongest Bird', 'Badminton competition', '2021-09-08', '13:00:00', 20, 'Discord', 5.00, 'mongolia-badminton-copy.jpg'),
('ET9', 'Refuse to Lose', 'Badminton friendly match', '2021-09-08', '15:00:00', 30, 'Meet', 1.00, 'badminton_4.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `studentid` varchar(35) NOT NULL,
  `gender` varchar(2) NOT NULL,
  `name` varchar(35) NOT NULL,
  `tel` varchar(20) NOT NULL,
  `email` varchar(50) NOT NULL,
  `programme` varchar(20) NOT NULL,
  `password` varchar(35) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`studentid`, `gender`, `name`, `tel`, `email`, `programme`, `password`) VALUES
('20PMD12345', 'M', 'Alex Lim', '012-3245321', 'sample@gmail.com', 'DFT', 'qwertyuiop'),
('20PMD12346', 'M', 'Lukas Tan', '012-3245321', 'sample2@gmail.com', 'DFT', '12345678'),
('20PMD12347', 'M', 'Alvin Lim', '014-2424123', 'sample3@gmail.com', 'DFT', 'abcd1234');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`adminid`);

--
-- Indexes for table `cart`
--
ALTER TABLE `cart`
  ADD PRIMARY KEY (`Cart`),
  ADD KEY `test` (`EventID`),
  ADD KEY `student` (`StudentID`);

--
-- Indexes for table `event`
--
ALTER TABLE `event`
  ADD PRIMARY KEY (`ETid`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`studentid`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `cart`
--
ALTER TABLE `cart`
  MODIFY `Cart` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=75;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `cart`
--
ALTER TABLE `cart`
  ADD CONSTRAINT `student` FOREIGN KEY (`StudentID`) REFERENCES `users` (`studentid`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `test` FOREIGN KEY (`EventID`) REFERENCES `event` (`ETid`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
