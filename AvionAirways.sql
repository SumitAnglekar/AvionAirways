-- phpMyAdmin SQL Dump
-- version 4.8.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Apr 18, 2018 at 11:33 AM
-- Server version: 10.1.31-MariaDB
-- PHP Version: 7.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `avionairways`
--

-- --------------------------------------------------------

--
-- Table structure for table `airplane`
--

CREATE TABLE `airplane` (
  `PCode` int(50) NOT NULL,
  `Type` varchar(50) NOT NULL,
  `Capacity` int(50) NOT NULL,
  `RepairStatus` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `airplane`
--

INSERT INTO `airplane` (`PCode`, `Type`, `Capacity`, `RepairStatus`) VALUES
(1, 'Boeing747', 300, 'FullyRepaired'),
(2, 'Antonov500', 400, 'FullyRepaired');

-- --------------------------------------------------------

--
-- Table structure for table `airport`
--

CREATE TABLE `airport` (
  `Code` int(50) NOT NULL,
  `Name` varchar(50) NOT NULL,
  `City` varchar(50) NOT NULL,
  `State` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `airport`
--

INSERT INTO `airport` (`Code`, `Name`, `City`, `State`) VALUES
(101, 'CSIA', 'Mumbai', 'Maharashtra'),
(102, 'IGI', 'Delhi', 'Delhi');

-- --------------------------------------------------------

--
-- Table structure for table `air_hostess`
--

CREATE TABLE `air_hostess` (
  `ID` int(50) DEFAULT NULL,
  `GroomingStandard` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `air_hostess`
--

INSERT INTO `air_hostess` (`ID`, `GroomingStandard`) VALUES
(101, 'C');

-- --------------------------------------------------------

--
-- Table structure for table `books`
--

CREATE TABLE `books` (
  `AadharNo` int(50) DEFAULT NULL,
  `FlightNo` int(50) DEFAULT NULL,
  `Class` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `books`
--

INSERT INTO `books` (`AadharNo`, `FlightNo`, `Class`) VALUES
(9234934, 101, 'economy'),
(9234934, 101, 'business'),
(9234934, 101, 'business'),
(9234934, 101, 'economy'),
(9234934, 101, 'business'),
(0, 101, 'economy'),
(0, 101, 'economy'),
(0, 101, 'business');

-- --------------------------------------------------------

--
-- Table structure for table `cancels`
--

CREATE TABLE `cancels` (
  `AadharNo` int(50) DEFAULT NULL,
  `FlightNo` int(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `employee`
--

CREATE TABLE `employee` (
  `ID` int(50) NOT NULL,
  `Name` varchar(50) NOT NULL,
  `Address` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `employee`
--

INSERT INTO `employee` (`ID`, `Name`, `Address`) VALUES
(101, 'Sushma', 'ABC');

-- --------------------------------------------------------

--
-- Table structure for table `employs`
--

CREATE TABLE `employs` (
  `Code` int(50) DEFAULT NULL,
  `ID` int(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `employs`
--

INSERT INTO `employs` (`Code`, `ID`) VALUES
(101, 101);

-- --------------------------------------------------------

--
-- Table structure for table `fare`
--

CREATE TABLE `fare` (
  `FlightNo` int(50) DEFAULT NULL,
  `FareType` int(50) NOT NULL,
  `Tax` int(50) NOT NULL,
  `PaymentMethod` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `flies`
--

CREATE TABLE `flies` (
  `FlightNo` int(50) DEFAULT NULL,
  `PCode` int(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `flies`
--

INSERT INTO `flies` (`FlightNo`, `PCode`) VALUES
(101, 1),
(102, 2),
(103, 2),
(104, 1);

-- --------------------------------------------------------

--
-- Table structure for table `flight`
--

CREATE TABLE `flight` (
  `FlightNo` int(50) NOT NULL,
  `Source` varchar(50) NOT NULL,
  `Destination` varchar(50) NOT NULL,
  `DepartureDate` date NOT NULL,
  `ArrivalDate` date NOT NULL,
  `DepartureTime` time NOT NULL,
  `ArrivalTime` time NOT NULL,
  `Miles` int(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `flight`
--

INSERT INTO `flight` (`FlightNo`, `Source`, `Destination`, `DepartureDate`, `ArrivalDate`, `DepartureTime`, `ArrivalTime`, `Miles`) VALUES
(101, 'Mumbai', 'Delhi', '2018-04-18', '2018-04-18', '14:00:00', '16:35:00', 705),
(102, 'Delhi', 'Mumbai', '2018-04-26', '2018-04-26', '01:00:00', '03:00:00', 700),
(103, 'Delhi', 'Mumbai', '2018-05-10', '2018-05-10', '16:25:00', '17:55:00', 700),
(104, 'Mumbai', 'Delhi', '2018-05-23', '2018-05-23', '20:00:00', '21:30:00', 705);

-- --------------------------------------------------------

--
-- Table structure for table `ground_staff`
--

CREATE TABLE `ground_staff` (
  `ID` int(50) DEFAULT NULL,
  `Hours` int(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `lands_on`
--

CREATE TABLE `lands_on` (
  `PCode` int(50) DEFAULT NULL,
  `Code` int(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `passenger`
--

CREATE TABLE `passenger` (
  `UserName` varchar(20) NOT NULL,
  `Password` varchar(20) NOT NULL,
  `AadharNo` int(20) NOT NULL,
  `FFM` int(20) DEFAULT NULL,
  `Age` int(20) DEFAULT NULL,
  `DOB` date DEFAULT NULL,
  `ContactNo` int(20) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `passenger`
--

INSERT INTO `passenger` (`UserName`, `Password`, `AadharNo`, `FFM`, `Age`, `DOB`, `ContactNo`) VALUES
('mihirnd@gmail.com', 'mihirnd', 123456789, 0, 19, '1998-11-11', 845188512),
('harsh@gmail.com', 'harsh', 234567890, 0, 19, '0000-00-00', 55717371),
('sumegh@gmail.com', 'sumegh', 345678901, 0, 19, '0000-00-00', 685138563);

-- --------------------------------------------------------

--
-- Table structure for table `pilot`
--

CREATE TABLE `pilot` (
  `ID` int(50) DEFAULT NULL,
  `InstrumentTraining` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `airplane`
--
ALTER TABLE `airplane`
  ADD PRIMARY KEY (`PCode`);

--
-- Indexes for table `airport`
--
ALTER TABLE `airport`
  ADD PRIMARY KEY (`Code`);

--
-- Indexes for table `employee`
--
ALTER TABLE `employee`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `flight`
--
ALTER TABLE `flight`
  ADD PRIMARY KEY (`FlightNo`);

--
-- Indexes for table `passenger`
--
ALTER TABLE `passenger`
  ADD PRIMARY KEY (`AadharNo`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
