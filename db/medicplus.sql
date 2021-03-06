-- phpMyAdmin SQL Dump
-- version 5.0.3
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jun 25, 2022 at 03:59 PM
-- Server version: 10.4.14-MariaDB
-- PHP Version: 7.4.11

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `medicplus`
--
CREATE DATABASE IF NOT EXISTS `medicplus` DEFAULT CHARACTER SET utf8 COLLATE utf8_general_ci;
USE `medicplus`;

-- --------------------------------------------------------

--
-- Table structure for table `meet`
--

CREATE TABLE `meet` (
  `id` int(11) NOT NULL,
  `userid` int(11) DEFAULT NULL,
  `clientid` int(11) DEFAULT NULL,
  `clientName` varchar(255) DEFAULT NULL,
  `clientLastname` varchar(255) NOT NULL,
  `clientMail` varchar(255) DEFAULT NULL,
  `date` datetime DEFAULT NULL,
  `place` varchar(255) DEFAULT NULL,
  `resume` varchar(255) DEFAULT NULL,
  `qcm` varchar(255) DEFAULT '::;;::;;::;;::;;::',
  `validated` tinyint(1) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `meet`
--

INSERT INTO `meet` (`id`, `userid`, `clientid`, `clientName`, `clientLastname`, `clientMail`, `date`, `place`, `resume`, `qcm`, `validated`) VALUES
(2, 2, 3, 'Morike', 'Konate', 'mkonate@efficom-lille.com', '2022-06-03 00:55:00', 'Efficom', 'Probablement le covid !', 'Est-ce qu\'il va bien ?::On espère fort;;Il est positif au covid ?::Oui comme tout les jours;;A-t-il bien payé ?::Oui, très cher !', 1),
(3, 2, 1, 'Jules', 'Ladeiro', 'jladeiro@myges.fr', '2022-06-14 23:01:00', 'Efficom', 'Ca va pas vraiment, mots de têtes', '::;;::;;::;;::;;::', 1),
(4, 2, 3, 'Morike', 'Konate', 'mkonate@efficom-lille.com', '2022-06-16 08:08:00', 'Efficom Lille', 'Encore le covid, Lucas prend en charge !', '::;;::;;::;;::;;::', 0);

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `id` int(11) NOT NULL,
  `name` varchar(255) DEFAULT NULL,
  `lastname` varchar(255) NOT NULL,
  `password` varchar(255) DEFAULT NULL,
  `mail` varchar(255) DEFAULT NULL,
  `type` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id`, `name`, `lastname`, `password`, `mail`, `type`) VALUES
(1, 'Jules', 'Ladeiro', '9cf95dacd226dcf43da376cdb6cbba7035218921', 'jladeiro@myges.fr', 'sec'),
(2, 'Yan', 'Souetre', '9cf95dacd226dcf43da376cdb6cbba7035218921', 'ysouetre@myges.fr', 'med'),
(3, 'Morike', 'Konate', '9cf95dacd226dcf43da376cdb6cbba7035218921', 'mkonate@myges.fr', 'usr');
(4, 'Lucas', 'Cornelis', '9cf95dacd226dcf43da376cdb6cbba7035218921', 'lcornelis@myges.fr', 'med');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `meet`
--
ALTER TABLE `meet`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `meet`
--
ALTER TABLE `meet`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
