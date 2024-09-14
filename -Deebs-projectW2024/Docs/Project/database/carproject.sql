-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Apr 17, 2024 at 04:00 AM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.0.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `carproject`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `ADMIN_ID` varchar(255) NOT NULL,
  `ADMIN_PASSWORD` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`ADMIN_ID`, `ADMIN_PASSWORD`) VALUES
('ADMIN', 'ADMIN');

-- --------------------------------------------------------

--
-- Table structure for table `booking`
--

CREATE TABLE `booking` (
  `BOOK_ID` int(11) NOT NULL,
  `CAR_ID` int(11) NOT NULL,
  `EMAIL` varchar(255) NOT NULL,
  `BOOK_PLACE` varchar(255) NOT NULL,
  `BOOK_DATE` date NOT NULL,
  `DURATION` int(11) NOT NULL,
  `PHONE_NUMBER` bigint(20) NOT NULL,
  `DESTINATION` varchar(255) NOT NULL,
  `RETURN_DATE` date NOT NULL,
  `PRICE` int(11) NOT NULL,
  `BOOK_STATUS` varchar(255) NOT NULL DEFAULT 'UNDER PROCESSING'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `booking`
--

INSERT INTO `booking` (`BOOK_ID`, `CAR_ID`, `EMAIL`, `BOOK_PLACE`, `BOOK_DATE`, `DURATION`, `PHONE_NUMBER`, `DESTINATION`, `RETURN_DATE`, `PRICE`, `BOOK_STATUS`) VALUES
(94, 28, 'petersamaha10@gmail.com', 'iguugy', '2024-03-22', 4, 67788877, 'Calgary', '2024-03-28', 8000, 'RETURNED'),
(115, 28, 'projectoyinloye@gmail.com', 'Peter', '2024-04-10', 3, 3456, 'Montreal', '2024-04-23', 6000, 'RETURNED'),
(117, 28, 'george@gmail.com', 'George', '2024-04-09', 2, 342542, 'Montreal', '2024-04-17', 4000, 'RETURNED'),
(118, 35, 'george@gmail.com', 'Montreal', '2024-04-18', 2, 12341234, 'Montreal', '2024-04-23', 500, 'UNDER PROCESSING'),
(119, 28, 'projectoyinloye@gmail.com', 'Montreal', '2024-04-17', 1, 5145812665, 'Montreal', '2024-05-03', 2000, 'UNDER PROCESSING'),
(120, 28, 'george@gmail.com', 'Montreal', '2024-04-18', 2, 55555, 'Montreal', '2024-04-25', 4000, 'UNDER PROCESSING'),
(121, 35, 'george@gmail.com', 'Montreal', '2024-04-11', 2, 55555, 'Montreal', '2024-05-01', 500, 'UNDER PROCESSING'),
(122, 28, 't@t.com', 'test', '2024-04-13', 3, 12341, 'Calgary', '2024-04-24', 6000, 'RETURNED'),
(123, 28, 'petersamaha2004@gmail.com', 'peter', '2024-04-20', 3, 3452345, 'Montreal', '2024-04-24', 6000, 'RETURNED');

-- --------------------------------------------------------

--
-- Table structure for table `bookingusers`
--

CREATE TABLE `bookingusers` (
  `BOOK_ID` int(11) NOT NULL,
  `CAR_ID` int(11) NOT NULL,
  `EMAIL` varchar(255) NOT NULL,
  `BOOK_PLACE` varchar(255) NOT NULL,
  `BOOK_DATE` date NOT NULL,
  `DURATION` int(11) NOT NULL,
  `PHONE_NUMBER` bigint(20) NOT NULL,
  `DESTINATION` varchar(255) NOT NULL,
  `RETURN_DATE` date NOT NULL,
  `PRICE` int(11) NOT NULL,
  `BOOK_STATUS` varchar(255) NOT NULL DEFAULT 'UNDER PROCESSING',
  `ownername` varchar(50) NOT NULL,
  `owneremail` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `bookingusers`
--

INSERT INTO `bookingusers` (`BOOK_ID`, `CAR_ID`, `EMAIL`, `BOOK_PLACE`, `BOOK_DATE`, `DURATION`, `PHONE_NUMBER`, `DESTINATION`, `RETURN_DATE`, `PRICE`, `BOOK_STATUS`, `ownername`, `owneremail`) VALUES
(1, 0, 'projectoyinloye@gmail.com', 'Latesttesting', '2024-04-06', 2, 57895656, 'Calgary', '2024-04-23', 1000, 'UNDER PROCESSING', '', ''),
(2, 43, 'petersamaha10@gmail.com', 'Montreal', '2024-04-06', 3, 2345234, 'Toronto', '2024-04-26', 15, 'UNDER PROCESSING', 'rukky', ''),
(3, 42, 'petersamaha10@gmail.com', 'Montreal', '2024-04-06', 2, 55555, 'Montreal', '2024-04-25', 10, 'APPROVED', 'rukky', 'projectoyinloye@gmail.com'),
(4, 43, 'petersamaha10@gmail.com', 'Montreal2', '2024-04-06', 4, 6, 'Montreal', '2024-04-29', 20, 'RETURNED', 'rukky', 'projectoyinloye@gmail.com'),
(5, 42, 'petersamaha10@gmail.com', 'last', '2024-04-06', 2, 432534, 'Montreal', '2024-04-26', 10, 'RETURNED', 'rukky', 'projectoyinloye@gmail.com'),
(6, 44, 'george@gmail.com', 'George', '1970-01-01', 3, 342534, 'Montreal', '2024-04-23', 60, 'RETURNED', 'rukky', 'projectoyinloye@gmail.com'),
(7, 46, 'george@gmail.com', 'George', '1970-01-01', 2, 55555, 'Calgary', '2024-04-18', 200, 'UNDER PROCESSING', 'Peter', 'petersamaha10@gmail.com'),
(8, 46, 'george@gmail.com', 'George', '1970-01-01', 2, 3452345, 'Montreal', '2024-05-07', 200, 'RETURNED', 'Peter', 'petersamaha10@gmail.com'),
(9, 44, 'george@gmail.com', 'Montreal', '1970-01-01', 2, 5555, 'Montreal', '2024-04-18', 40, 'RETURNED', 'rukky', 'projectoyinloye@gmail.com'),
(10, 44, 'george@gmail.com', 'Georger', '1970-01-01', 2, 3452345, 'Montreal', '2024-04-24', 40, 'RETURNED', 'rukky', 'projectoyinloye@gmail.com'),
(11, 44, 'george@gmail.com', 'Peter', '1970-01-01', 2, 55555, 'Montreal', '2024-04-24', 40, 'RETURNED', 'rukky', 'projectoyinloye@gmail.com'),
(12, 44, 'george@gmail.com', 'George', '1970-01-01', 2, 5145812665, 'Montreal', '2024-04-30', 40, 'UNDER PROCESSING', 'rukky', 'projectoyinloye@gmail.com'),
(13, 46, 'george@gmail.com', 'George', '1970-01-01', 2, 32452345, 'Montreal', '2024-04-30', 200, 'UNDER PROCESSING', 'Peter', 'petersamaha10@gmail.com'),
(14, 46, 'george@gmail.com', 'George', '1970-01-01', 2, 32452345, 'Montreal', '2024-04-30', 200, 'UNDER PROCESSING', 'Peter', 'petersamaha10@gmail.com'),
(15, 46, 'george@gmail.com', 'george', '1970-01-01', 2, 5145812665, 'Montreal', '2024-04-29', 200, 'UNDER PROCESSING', 'Peter', 'petersamaha10@gmail.com'),
(16, 44, 'george@gmail.com', 'Montreal', '1970-01-01', 2, 5145812665, 'Montreal', '2024-04-30', 40, 'UNDER PROCESSING', 'rukky', 'projectoyinloye@gmail.com'),
(17, 44, 'george@gmail.com', 'Montreal', '1970-01-01', 2, 5145812665, 'Montreal', '2024-04-30', 40, 'UNDER PROCESSING', 'rukky', 'projectoyinloye@gmail.com'),
(18, 44, 'george@gmail.com', 'Montreal', '1970-01-01', 2, 5145812665, 'Montreal', '2024-04-30', 40, 'UNDER PROCESSING', 'rukky', 'projectoyinloye@gmail.com'),
(19, 44, 'george@gmail.com', 'Montreal', '1970-01-01', 2, 5145812665, 'Montreal', '2024-04-30', 40, 'UNDER PROCESSING', 'rukky', 'projectoyinloye@gmail.com'),
(20, 44, 'george@gmail.com', 'Montreal', '1970-01-01', 1, 5145812665, 'Montreal', '2024-04-17', 20, 'UNDER PROCESSING', 'rukky', 'projectoyinloye@gmail.com'),
(21, 44, 'george@gmail.com', 'Montreal', '1970-01-01', 1, 5145812665, 'Montreal', '2024-04-17', 20, 'UNDER PROCESSING', 'rukky', 'projectoyinloye@gmail.com'),
(22, 44, 'george@gmail.com', 'Montreal', '1970-01-01', 1, 5145812665, 'Montreal', '2024-04-17', 20, 'RETURNED', 'rukky', 'projectoyinloye@gmail.com'),
(23, 44, 'george@gmail.com', 'George', '1970-01-01', 2, 2345234, 'Montreal', '2024-04-30', 40, 'UNDER PROCESSING', 'rukky', 'projectoyinloye@gmail.com'),
(24, 44, 'george@gmail.com', 'George', '1970-01-01', 2, 2345234, 'Montreal', '2024-04-30', 40, 'UNDER PROCESSING', 'rukky', 'projectoyinloye@gmail.com'),
(25, 44, 'george@gmail.com', 'Montreal', '1970-01-01', 1, 5145812665, 'Montreal', '2024-04-30', 20, 'UNDER PROCESSING', 'rukky', 'projectoyinloye@gmail.com'),
(26, 44, 'george@gmail.com', 'Montreal', '1970-01-01', 1, 5145812665, 'Montreal', '2024-04-30', 20, 'UNDER PROCESSING', 'rukky', 'projectoyinloye@gmail.com'),
(27, 44, 'george@gmail.com', 'Montreal', '1970-01-01', 2, 5145812665, 'Montreal', '2024-04-30', 40, 'UNDER PROCESSING', 'rukky', 'projectoyinloye@gmail.com'),
(28, 44, 'george@gmail.com', 'Montreal', '1970-01-01', 2, 5145812665, 'Montreal', '2024-04-30', 40, 'UNDER PROCESSING', 'rukky', 'projectoyinloye@gmail.com'),
(29, 44, 'george@gmail.com', 'Montreal', '1970-01-01', 2, 5145812665, 'Montreal', '2024-04-29', 40, 'APPROVED', 'rukky', 'projectoyinloye@gmail.com'),
(30, 45, 'george@gmail.com', 'Montreal', '1970-01-01', 1, 5145812665, 'Montreal', '2024-04-29', 55, 'RETURNED', 'rukky', 'projectoyinloye@gmail.com'),
(31, 45, 'petersamaha10@gmail.com', 'Peter', '1970-01-01', 2, 345342345, 'Montreal', '2024-04-23', 110, 'RETURNED', 'rukky', 'projectoyinloye@gmail.com'),
(32, 49, 'george@gmail.com', 'boudy', '1970-01-01', 2, 5145555555, 'Montreal', '2024-04-12', 466, 'UNDER PROCESSING', 'George', 'george@gmail.com'),
(33, 49, 'george@gmail.com', 'boudy', '1970-01-01', 2, 1233333333, 'Montreal', '2024-04-12', 466, 'UNDER PROCESSING', 'George', 'george@gmail.com'),
(34, 45, 't@t.com', 'Peter', '1970-01-01', 3, 345234, 'Montreal', '2024-04-22', 165, 'RETURNED', 'rukky', 'projectoyinloye@gmail.com'),
(35, 45, 't@t.com', 'Peter', '1970-01-01', 2, 5145812665, 'Montreal', '2024-04-18', 110, 'RETURNED', 'rukky', 'projectoyinloye@gmail.com');

-- --------------------------------------------------------

--
-- Table structure for table `branch`
--

CREATE TABLE `branch` (
  `name` varchar(50) NOT NULL,
  `address` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `branch`
--

INSERT INTO `branch` (`name`, `address`) VALUES
('\0', '\0'),
('*B6BDA741F59FE8066344FE3E118291C5D7DD12AD', '*B6BDA741F59FE8066344FE3E118291C5D7DD12AD'),
('*B6BDA741F59FE8066344FE3E118291C5D7DD12AD', '*B6BDA741F59FE8066344FE3E118291C5D7DD12AD'),
('YUL airport', 'Montreal,Qc,Canada'),
('YUL airport', 'Montreal,Qc,Canada');

-- --------------------------------------------------------

--
-- Table structure for table `branches`
--

CREATE TABLE `branches` (
  `name` int(11) NOT NULL,
  `address` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `branches`
--

INSERT INTO `branches` (`name`, `address`) VALUES
(0, 0);

-- --------------------------------------------------------

--
-- Table structure for table `cars`
--

CREATE TABLE `cars` (
  `CAR_ID` int(11) NOT NULL,
  `CAR_NAME` varchar(255) NOT NULL,
  `FUEL_TYPE` varchar(255) NOT NULL,
  `CAPACITY` int(11) NOT NULL,
  `PRICE` int(11) NOT NULL,
  `CAR_IMG` varchar(255) NOT NULL,
  `AVAILABLE` varchar(255) NOT NULL,
  `branch` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `cars`
--

INSERT INTO `cars` (`CAR_ID`, `CAR_NAME`, `FUEL_TYPE`, `CAPACITY`, `PRICE`, `CAR_IMG`, `AVAILABLE`, `branch`) VALUES
(28, 'lambo', 'gas', 2, 2000, 'IMG-65fdd389d74fc2.67685293.jpg', 'Y', 'Montreal'),
(34, 'Audi', 'gas', 5, 50, 'IMG-66119a60bb8d06.93357358.png', 'Y', 'Calgary'),
(35, 'Mclaren', 'diesel', 2, 250, 'IMG-66119ab8f0f021.81028870.png', 'Y', 'Montreal'),
(36, 'PORSCHE', 'diesel', 2, 20, 'IMG-66119bf531b933.82847011.png', 'Y', 'Vancouver'),
(37, 'SWIFT', 'gas', 4, 200, 'IMG-66119c3d595783.25061686.png', 'Y', 'Toronto'),
(38, 'Dababy', 'diesel', 2, 5, 'IMG-661969e0553155.35600550.jpg', 'Y', 'Vancouver');

-- --------------------------------------------------------

--
-- Table structure for table `feedback`
--

CREATE TABLE `feedback` (
  `FED_ID` int(11) NOT NULL,
  `EMAIL` varchar(255) NOT NULL,
  `COMMENT` text NOT NULL,
  `num` int(6) NOT NULL,
  `carid` int(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `feedback`
--

INSERT INTO `feedback` (`FED_ID`, `EMAIL`, `COMMENT`, `num`, `carid`) VALUES
(12, 'petersamaha10@gmail.com', 'test', 0, 0),
(13, 'george@gmail.com', 'test feedbakc', 0, 0),
(14, 'projectoyinloye@gmail.com', 'test', 0, 0),
(15, 'george@gmail.com', 'sbsdfbg', 0, 0),
(16, 'george@gmail.com', 'dbrt', 4, 0),
(17, 'projectoyinloye@gmail.com', 'test2', 5, 28),
(18, 'projectoyinloye@gmail.com', 'rtgrtgrtg', 1, 28),
(20, 'george@gmail.com', 'Clean car!', 1, 28),
(21, 'george@gmail.com', 'Lovely car!! super clean', 5, 35),
(22, 'george@gmail.com', 'testtttttttt', 2, 35),
(23, 'george@gmail.com', 'THIS IS A  TEST', 3, 35),
(24, 't@t.com', 'Mid car', 3, 28),
(25, 'petersamaha2004@gmail.com', 'big car', 5, 28);

-- --------------------------------------------------------

--
-- Table structure for table `feedbackuser`
--

CREATE TABLE `feedbackuser` (
  `FED_ID` int(11) NOT NULL,
  `EMAIL` varchar(255) NOT NULL,
  `COMMENT` text NOT NULL,
  `num` int(6) NOT NULL,
  `carid` int(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `feedbackuser`
--

INSERT INTO `feedbackuser` (`FED_ID`, `EMAIL`, `COMMENT`, `num`, `carid`) VALUES
(1, 'george@gmail.com', 'Nice experience', 4, 0),
(2, 'george@gmail.com', 'lovely', 3, 44),
(3, 'george@gmail.com', 'Excellent car', 4, 45),
(4, 'petersamaha10@gmail.com', 'Not goood', 2, 45),
(5, 't@t.com', 'Its aight', 5, 45);

-- --------------------------------------------------------

--
-- Table structure for table `payment`
--

CREATE TABLE `payment` (
  `PAY_ID` int(11) NOT NULL,
  `BOOK_ID` int(11) NOT NULL,
  `CARD_NO` varchar(255) NOT NULL,
  `EXP_DATE` varchar(255) NOT NULL,
  `CVV` int(11) NOT NULL,
  `PRICE` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `payment`
--

INSERT INTO `payment` (`PAY_ID`, `BOOK_ID`, `CARD_NO`, `EXP_DATE`, `CVV`, `PRICE`) VALUES
(48, 94, '5555555555555555', '55555', 666, 8000),
(72, 115, '3333333333333', '33', 333, 6000),
(74, 117, '454444444444444', '44444', 444, 4000),
(75, 118, '3333333333333333', '33333', 333, 500),
(76, 119, '5555555555555555', '55', 555, 2000),
(77, 120, '343333333333333', '3333', 333, 4000),
(78, 122, '3333333333333333', '33333', 333, 6000),
(79, 123, '1326483018487', '1230', 546, 6000);

-- --------------------------------------------------------

--
-- Table structure for table `paymentuser`
--

CREATE TABLE `paymentuser` (
  `PAY_ID` int(11) NOT NULL,
  `CARD_NO` varchar(255) NOT NULL,
  `EXP_DATE` varchar(255) NOT NULL,
  `CVV` int(11) NOT NULL,
  `PRICE` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `paymentuser`
--

INSERT INTO `paymentuser` (`PAY_ID`, `CARD_NO`, `EXP_DATE`, `CVV`, `PRICE`) VALUES
(3, '444444444444', '444', 444, 2000),
(5, '766777777', '3333', 333, 2000),
(7, '44444444444444', '444', 44, 2000),
(8, '3333333333333333', '333', 33, 2000),
(9, '4444444444444444', '45545', 787, 1000),
(10, '44444444444', '44', 44, 15),
(11, '3333333333333', '3333', 333, 15),
(12, '333333333', '33', 3, 15),
(13, '44444444444', '4444', 444, 10),
(14, '3333333333333333', '333', 333, 60),
(15, '4444444444444444', '44', 4, 200),
(16, '333333333333333', '3333', 333, 40),
(17, '5666666666666666', '5555', 555, 40),
(18, '333333333333333', '333', 33, 40),
(19, '3435344444444444', '4444', 444, 20),
(20, '34444444444444', '34444', 434, 40),
(21, '3333333333333333', '33333', 333, 55),
(22, '3333333333345345', '34534', 345, 110),
(23, '1234654443221111', '1126', 344, 466),
(24, '1234574362847372', '1124', 333, 466),
(25, '3333333333333', '33333', 333, 165),
(26, '333333333333', '33333', 333, 110);

-- --------------------------------------------------------

--
-- Table structure for table `usercars`
--

CREATE TABLE `usercars` (
  `CAR_ID` int(11) NOT NULL,
  `CAR_NAME` varchar(255) NOT NULL,
  `FUEL_TYPE` varchar(255) NOT NULL,
  `CAPACITY` int(11) NOT NULL,
  `PRICE` int(11) NOT NULL,
  `CAR_IMG` varchar(255) NOT NULL,
  `AVAILABLE` varchar(255) NOT NULL,
  `branch` varchar(50) NOT NULL,
  `email` varchar(50) NOT NULL,
  `username` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `usercars`
--

INSERT INTO `usercars` (`CAR_ID`, `CAR_NAME`, `FUEL_TYPE`, `CAPACITY`, `PRICE`, `CAR_IMG`, `AVAILABLE`, `branch`, `email`, `username`) VALUES
(44, 'Honda', 'gas', 2, 20, 'IMG-6611a136860c88.52338691.jpg', 'N', 'Montreal', 'projectoyinloye@gmail.com', 'rukky'),
(45, 'Toyota', 'diesel', 4, 55, 'IMG-6611a1647eb159.59623592.jpg', 'Y', 'Montreal', 'projectoyinloye@gmail.com', 'rukky'),
(46, 'Van', 'diesel', 5, 100, 'IMG-6611a1f2a80947.54908559.jpg', 'Y', 'Montreal', 'petersamaha10@gmail.com', 'Peter'),
(47, 'ferrari', 'gas', 3, 200, 'IMG-66129297d12c07.05772299.png', 'Y', 'Quebec', 'george@gmail.com', 'George'),
(48, 'ferrari', 'diesel', 4, 300, 'IMG-661756d3efae72.89023166.jpg', 'Y', 'Calgary', 'george@gmail.com', 'George'),
(49, 'ferrariTEST', 'diesel', 3, 233, 'IMG-66175800b52539.10610701.jpg', 'Y', 'Vancouver', 'george@gmail.com', 'George');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `FNAME` varchar(255) NOT NULL,
  `LNAME` varchar(255) NOT NULL,
  `EMAIL` varchar(255) NOT NULL,
  `LIC_NUM` varchar(255) NOT NULL,
  `PHONE_NUMBER` bigint(11) NOT NULL,
  `PASSWORD` varchar(255) NOT NULL,
  `GENDER` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`FNAME`, `LNAME`, `EMAIL`, `LIC_NUM`, `PHONE_NUMBER`, `PASSWORD`, `GENDER`) VALUES
('f', 'f', 'f@f', '4555', 4, '5d049be8a46c069ba672cc6cc4e2b765', 'male'),
('George', 'clooney', 'george@gmail.com', '555', 123481555, '5d049be8a46c069ba672cc6cc4e2b765', 'male'),
('Peter', 'Samaha', 'p@p', '555', 555, '5d049be8a46c069ba672cc6cc4e2b765', 'male'),
('peter', 'samaha', 'peter@gmail.com', '567765', 514567890, '5d049be8a46c069ba672cc6cc4e2b765', 'male'),
('Peter', 'Samaha', 'petersamaha10@gmail.com', '55555555555555555', 555555555, '5d049be8a46c069ba672cc6cc4e2b765', 'male'),
('peter', 'samaha', 'petersamaha2004@gmail.com', '256432', 345543, '5d049be8a46c069ba672cc6cc4e2b765', 'male'),
('rukky', 'lab', 'projectoyinloye@gmail.com', '456554', 5145817665, '5d049be8a46c069ba672cc6cc4e2b765', 'male'),
('test', 'peter', 'samer.hasna@hotmail.com', '234123', 5145812665, '5d049be8a46c069ba672cc6cc4e2b765', 'male'),
('rukky', 'hasna', 'samer@h.com', '555', 555555, '5d049be8a46c069ba672cc6cc4e2b765', 'female'),
('test', 'test', 't@t.com', '1245241', 5145812665, '5d049be8a46c069ba672cc6cc4e2b765', 'male'),
('jjjjj', 'ojjk', 'wijcn4@gmail.com', '4555', 1234556432, '7e60e934e1b7e408bc66f2613cd5d216', 'male');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`ADMIN_ID`);

--
-- Indexes for table `booking`
--
ALTER TABLE `booking`
  ADD PRIMARY KEY (`BOOK_ID`),
  ADD KEY `CAR_ID` (`CAR_ID`),
  ADD KEY `EMAIL` (`EMAIL`);

--
-- Indexes for table `bookingusers`
--
ALTER TABLE `bookingusers`
  ADD PRIMARY KEY (`BOOK_ID`);

--
-- Indexes for table `cars`
--
ALTER TABLE `cars`
  ADD PRIMARY KEY (`CAR_ID`);

--
-- Indexes for table `feedback`
--
ALTER TABLE `feedback`
  ADD PRIMARY KEY (`FED_ID`),
  ADD KEY `TEST` (`EMAIL`);

--
-- Indexes for table `feedbackuser`
--
ALTER TABLE `feedbackuser`
  ADD PRIMARY KEY (`FED_ID`),
  ADD KEY `TEST` (`EMAIL`);

--
-- Indexes for table `payment`
--
ALTER TABLE `payment`
  ADD PRIMARY KEY (`PAY_ID`),
  ADD UNIQUE KEY `BOOK_ID` (`BOOK_ID`);

--
-- Indexes for table `paymentuser`
--
ALTER TABLE `paymentuser`
  ADD PRIMARY KEY (`PAY_ID`);

--
-- Indexes for table `usercars`
--
ALTER TABLE `usercars`
  ADD PRIMARY KEY (`CAR_ID`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`EMAIL`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `booking`
--
ALTER TABLE `booking`
  MODIFY `BOOK_ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=124;

--
-- AUTO_INCREMENT for table `bookingusers`
--
ALTER TABLE `bookingusers`
  MODIFY `BOOK_ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=36;

--
-- AUTO_INCREMENT for table `cars`
--
ALTER TABLE `cars`
  MODIFY `CAR_ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=39;

--
-- AUTO_INCREMENT for table `feedback`
--
ALTER TABLE `feedback`
  MODIFY `FED_ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;

--
-- AUTO_INCREMENT for table `feedbackuser`
--
ALTER TABLE `feedbackuser`
  MODIFY `FED_ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `payment`
--
ALTER TABLE `payment`
  MODIFY `PAY_ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=80;

--
-- AUTO_INCREMENT for table `paymentuser`
--
ALTER TABLE `paymentuser`
  MODIFY `PAY_ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=27;

--
-- AUTO_INCREMENT for table `usercars`
--
ALTER TABLE `usercars`
  MODIFY `CAR_ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=50;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `booking`
--
ALTER TABLE `booking`
  ADD CONSTRAINT `booking_ibfk_1` FOREIGN KEY (`CAR_ID`) REFERENCES `cars` (`CAR_ID`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `booking_ibfk_2` FOREIGN KEY (`EMAIL`) REFERENCES `users` (`EMAIL`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `feedback`
--
ALTER TABLE `feedback`
  ADD CONSTRAINT `TEST` FOREIGN KEY (`EMAIL`) REFERENCES `users` (`EMAIL`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `payment`
--
ALTER TABLE `payment`
  ADD CONSTRAINT `payment_ibfk_1` FOREIGN KEY (`BOOK_ID`) REFERENCES `booking` (`BOOK_ID`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
