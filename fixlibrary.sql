-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Jun 18, 2022 at 11:06 AM
-- Server version: 10.4.24-MariaDB
-- PHP Version: 8.1.5

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";

--
-- Database: `lib`
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
(2, 'Algorithm & DS C02.png', 'Algorithm & DS C02', '-', 'Science Technology', '1GaQHgEGrtN9XMxkV0RgD4tCZTTBLNh_s'),
(3, 'Introduction JavaScript.png', 'Introduction JavaScript', '-', 'Science Technology', '1P9E6_QtbBzuNqtj1CUb0A8QEP7Yn3uC4'),
(4, 'Software Engineering A Practitioners Approach.png', 'Software Engineering A Practitioners Approach', 'Roger S. Pressman', 'Science Technology', '103us_ucVXtLJzEZt8x9vD-BGKd0cqWta'),
(5, 'Introduction HTML Part01.png', 'Introduction HTML Part01', 'Tri Agus R', 'Technology', '1pNvO9Kz84GhnDn_PlxknrY-QS1N9ceAe'),
(6, '62acf3295ba41.png', 'Introduction HTML Part05CSS', 'Tri Agus R', 'Technology', '11Fbi8_vVo-NzoDSCTvlOzPZaALUC7SHn'),
(10, 'Introduction HTML Part03.png', 'Introduction HTML Part03', 'Tri Agus R', 'Technology', '1FN9sSLNw2xfl9FPPvFXSI09fe54KQgrE'),
(11, 'Introduction HTML Part04.png', 'Introduction HTML Part04', 'Tri Agus R', 'Technology', '11A8qPgUnxWoG7kGGTZaPm5j31KJM5iCg'),
(12, 'Introduction HTML Part06CSSExtended.png', 'Introduction HTML Part06CSSExtended', 'Tri Agus R', 'Technology', '167ciAi8L4B8aadG3uT-TbOJH7XyJ6LUK'),
(13, 'Mein Kampf.jpg', 'Mein Kampf', 'Adolf Hitler', 'Comedy', '1dETHjmV0vZu1Np6SibaDtmCkjEjQccb9'),
(15, '62acf389b27b8.png', 'Algorithm &amp; DS C01', '-', 'Science Technology', '1GgzISEDwLQKtqZ-eW1-9-f6dGiu6P4vq'),
(16, '62acf3e6b3d89.png', 'Introduction HTML Part02', 'Tri Agus R', 'Technology', '1CQmYL3A-EvutyR4WlpSz-2g1Cocc8nYo');

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
(1, 'farhan', '$2y$10$1e0Y5xRrT9dqfrxdabPFyOgJSQYB3k/KU9.PaOm4jZqOAAheVZvJa', 'farhan@farhanoktavian.tech');

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
(19, 'Adolf Hitler', 'adolfhitler@nazi.gov', '13 || Mein Kampf');

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
  MODIFY `id` int(15) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT for table `librarian`
--
ALTER TABLE `librarian`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `reqbook`
--
ALTER TABLE `reqbook`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `reqtd`
--
ALTER TABLE `reqtd`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
