-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: dbserver.crngxvhkbvzx.ap-southeast-3.rds.amazonaws.com
-- Generation Time: Nov 05, 2022 at 10:37 PM
-- Server version: 10.6.8-MariaDB
-- PHP Version: 7.4.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `elib`
--

-- --------------------------------------------------------

--
-- Table structure for table `lib`
--

CREATE TABLE `lib` (
  `id` int(15) NOT NULL,
  `img` varchar(250) NOT NULL,
  `judul` varchar(250) NOT NULL,
  `penulis` varchar(50) NOT NULL,
  `genre` varchar(100) NOT NULL,
  `link` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `lib`
--

INSERT INTO `lib` (`id`, `img`, `judul`, `penulis`, `genre`, `link`) VALUES
(3, 'Introduction JavaScript.png', 'Introduction JavaScript', '-', 'Science Technology', '1P9E6_QtbBzuNqtj1CUb0A8QEP7Yn3uC4'),
(6, '62acf3295ba41.png', 'Introduction HTML Part05CSS', 'Tri Agus R', 'Technology', '11Fbi8_vVo-NzoDSCTvlOzPZaALUC7SHn'),
(11, 'Introduction HTML Part04.png', 'Introduction HTML Part04', 'Tri Agus R', 'Technology', '11A8qPgUnxWoG7kGGTZaPm5j31KJM5iCg'),
(12, 'Introduction HTML Part06CSSExtended.png', 'Introduction HTML Part06CSS', 'Tri Agus R', 'Technology', '167ciAi8L4B8aadG3uT-TbOJH7XyJ6LUK'),
(13, 'Mein Kampf.jpg', 'Mein Kampf', 'Adolf Hitler', 'Comedy', '1dETHjmV0vZu1Np6SibaDtmCkjEjQccb9'),
(16, '62acf3e6b3d89.png', 'Introduction HTML Part02', 'Tri Agus R', 'Technology', '1CQmYL3A-EvutyR4WlpSz-2g1Cocc8nYo'),
(18, '636490da24688.jpg', 'Software Engineer A Practitioner Approach', 'Roger S Pressman', 'Tech', '103us_ucVXtLJzEZt8x9vD-BGKd0cqWta');

-- --------------------------------------------------------

--
-- Table structure for table `librarian`
--

CREATE TABLE `librarian` (
  `id` int(11) NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(255) NOT NULL,
  `email` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `librarian`
--

INSERT INTO `librarian` (`id`, `username`, `password`, `email`) VALUES
(1, 'farhan', '$2y$10$Fro8wyzylnQKp.BqMODNA.LEB7lS.vacGdCtTdeQhnHqB1c2/0uhi', 'farhan@farhanoktavian.tech');

-- --------------------------------------------------------

--
-- Table structure for table `reqbook`
--

CREATE TABLE `reqbook` (
  `id` int(11) NOT NULL,
  `name` varchar(50) NOT NULL,
  `email` varchar(100) NOT NULL,
  `bookreq` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `reqbook`
--

INSERT INTO `reqbook` (`id`, `name`, `email`, `bookreq`) VALUES
(11, 'Farhan Dwi O', 'itsme@farhand.tech', 'PHP Tutorial');

-- --------------------------------------------------------

--
-- Table structure for table `reqtd`
--

CREATE TABLE `reqtd` (
  `id` int(11) NOT NULL,
  `name` varchar(50) NOT NULL,
  `email` varchar(100) NOT NULL,
  `booktdreq` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `reqtd`
--

INSERT INTO `reqtd` (`id`, `name`, `email`, `booktdreq`) VALUES
(20, 'Farhan Dwi O', 'itsme@farhand.tech', '13 || Mein Kampf');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `lib`
--
ALTER TABLE `lib`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `librarian`
--
ALTER TABLE `librarian`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `reqbook`
--
ALTER TABLE `reqbook`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `reqtd`
--
ALTER TABLE `reqtd`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `lib`
--
ALTER TABLE `lib`
  MODIFY `id` int(15) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT for table `librarian`
--
ALTER TABLE `librarian`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `reqbook`
--
ALTER TABLE `reqbook`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `reqtd`
--
ALTER TABLE `reqtd`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
