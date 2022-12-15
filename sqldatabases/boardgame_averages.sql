-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Dec 15, 2022 at 12:02 AM
-- Server version: 10.4.27-MariaDB
-- PHP Version: 7.4.33

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `jhemming1_dmit2025`
--

-- --------------------------------------------------------

--
-- Table structure for table `boardgame_averages`
--

CREATE TABLE `boardgame_averages` (
  `gameid` int(11) NOT NULL,
  `playtime` varchar(11) DEFAULT '1',
  `playtimeinput` int(11) DEFAULT 1,
  `weight` varchar(11) DEFAULT '2.5',
  `weightinput` int(11) DEFAULT 1,
  `age` varchar(11) DEFAULT '3',
  `ageinput` int(11) DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `boardgame_averages`
--

INSERT INTO `boardgame_averages` (`gameid`, `playtime`, `playtimeinput`, `weight`, `weightinput`, `age`, `ageinput`) VALUES
(89, '42', 1, '2.5', 1, '10', 1),
(90, '15', 1, '2.5', 1, '8', 1),
(91, '60', 1, '2.5', 1, '12', 1),
(92, '80', 1, '2.5', 1, '12', 1),
(93, '30', 1, '2.5', 1, '13', 1),
(100, '75', 1, '2.5', 1, '10', 1),
(101, '120', 1, '2.5', 1, '10', 1),
(102, '60', 1, '1.84', 1, '8', 1),
(103, '120', 1, '3.89', 1, '14', 1),
(104, '180', 1, '3.76', 1, '12', 1),
(105, '60', 1, '2.92', 1, '14', 1),
(106, '120', 1, '3.91', 1, '14', 1),
(107, '120', 1, '2.91', 1, '12', 1),
(108, '115', 1, '3.43', 1, '14', 1),
(109, '45', 1, '1.68', 1, '13', 1),
(110, '60', 1, '1.82', 1, '10', 1),
(111, '120', 1, '2.76', 1, '12', 1),
(112, '60', 1, '2.38', 1, '12', 1),
(113, '75', 1, '2.5', 1, '13', 1),
(114, '45', 1, '1.94', 1, '10', 1),
(115, '80', 1, '2.8', 1, '13', 1),
(116, '120', 1, '2.5', 1, '10', 1),
(117, '45', 1, '2.4', 1, '8', 1),
(118, '25', 1, '1.7', 1, '8', 1),
(119, '80', 1, '2.57', 1, '10', 1),
(120, '200', 1, '3.54', 1, '14', 1),
(121, '480', 1, '4.28', 1, '14', 1);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `boardgame_averages`
--
ALTER TABLE `boardgame_averages`
  ADD KEY `game_id` (`gameid`);

--
-- Constraints for dumped tables
--

--
-- Constraints for table `boardgame_averages`
--
ALTER TABLE `boardgame_averages`
  ADD CONSTRAINT `game_id` FOREIGN KEY (`gameid`) REFERENCES `boardgame_catalog` (`gameid`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
