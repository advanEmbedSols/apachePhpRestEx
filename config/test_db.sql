-- phpMyAdmin SQL Dump
-- version 4.9.5deb2
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Jan 21, 2021 at 09:27 AM
-- Server version: 8.0.22-0ubuntu0.20.04.3
-- PHP Version: 7.4.3

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `test_db`
--

-- --------------------------------------------------------

--
-- Table structure for table `18_img`
--

CREATE TABLE `18_img` (
  `ID` int NOT NULL,
  `PIC_LOCATION` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `18_img`
--

INSERT INTO `18_img` (`ID`, `PIC_LOCATION`) VALUES
(1, '/img/products/computer1.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `20_img`
--

CREATE TABLE `20_img` (
  `ID` int NOT NULL,
  `PIC_LOCATION` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `20_img`
--

INSERT INTO `20_img` (`ID`, `PIC_LOCATION`) VALUES
(1, '/img/products/phone1.jpg'),
(2, '/img/products/computer1.jpg'),
(3, '/img/products/computer1.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `27_img`
--

CREATE TABLE `27_img` (
  `ID` int NOT NULL,
  `PIC_LOCATION` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `27_img`
--

INSERT INTO `27_img` (`ID`, `PIC_LOCATION`) VALUES
(1, '/img/products/computer1.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `28_img`
--

CREATE TABLE `28_img` (
  `ID` int NOT NULL,
  `PIC_LOCATION` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `28_img`
--

INSERT INTO `28_img` (`ID`, `PIC_LOCATION`) VALUES
(1, '/img/products/computer1.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `29_img`
--

CREATE TABLE `29_img` (
  `ID` int NOT NULL,
  `PIC_LOCATION` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `29_img`
--

INSERT INTO `29_img` (`ID`, `PIC_LOCATION`) VALUES
(1, '/img/products/computer2.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `30_img`
--

CREATE TABLE `30_img` (
  `ID` int NOT NULL,
  `PIC_LOCATION` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `30_img`
--

INSERT INTO `30_img` (`ID`, `PIC_LOCATION`) VALUES
(1, '/img/products/computer3.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `31_img`
--

CREATE TABLE `31_img` (
  `ID` int NOT NULL,
  `PIC_LOCATION` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `31_img`
--

INSERT INTO `31_img` (`ID`, `PIC_LOCATION`) VALUES
(1, '/img/products/computer3.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `32_img`
--

CREATE TABLE `32_img` (
  `ID` int NOT NULL,
  `PIC_LOCATION` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `32_img`
--

INSERT INTO `32_img` (`ID`, `PIC_LOCATION`) VALUES
(1, '/img/products/phone1.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE `products` (
  `id` int NOT NULL,
  `name` varchar(100) NOT NULL,
  `short_description` varchar(100) DEFAULT NULL,
  `description` varchar(256) DEFAULT NULL,
  `price` double DEFAULT NULL,
  `rating` double DEFAULT NULL,
  `num_in_stock` double DEFAULT NULL,
  `cat` int DEFAULT NULL,
  `pic_location` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`id`, `name`, `short_description`, `description`, `price`, `rating`, `num_in_stock`, `cat`, `pic_location`) VALUES
(28, 'IT Support', 'Windows Support', 'IT Support for Windows', 50, 3.9, 50, 1, '28_img'),
(29, 'IT Support', 'Linux Support', 'IT Support for Linux', 50, 4.8, 50, 1, '29_img'),
(30, 'C++ Coding', 'Coding for C++ and C. ', 'Coding support. Our experts can code in both Linux and Windows. The code can be either low level drivers or high level app code.', 80, 4.3, 50, 2, '30_img'),
(31, 'PHP Coding', 'Coding for PHP Web Dev.', 'Coding support for web development in PHP. ', 70, 3.9, 50, 2, '31_img'),
(32, 'IT Support', '30 Min IT Support', 'IT Support for Android and IOS phones. ', 55, 4.1, 50, 1, '32_img');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `18_img`
--
ALTER TABLE `18_img`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `20_img`
--
ALTER TABLE `20_img`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `27_img`
--
ALTER TABLE `27_img`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `28_img`
--
ALTER TABLE `28_img`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `29_img`
--
ALTER TABLE `29_img`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `30_img`
--
ALTER TABLE `30_img`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `31_img`
--
ALTER TABLE `31_img`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `32_img`
--
ALTER TABLE `32_img`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `18_img`
--
ALTER TABLE `18_img`
  MODIFY `ID` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `20_img`
--
ALTER TABLE `20_img`
  MODIFY `ID` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `27_img`
--
ALTER TABLE `27_img`
  MODIFY `ID` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `28_img`
--
ALTER TABLE `28_img`
  MODIFY `ID` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `29_img`
--
ALTER TABLE `29_img`
  MODIFY `ID` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `30_img`
--
ALTER TABLE `30_img`
  MODIFY `ID` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `31_img`
--
ALTER TABLE `31_img`
  MODIFY `ID` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `32_img`
--
ALTER TABLE `32_img`
  MODIFY `ID` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=33;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
