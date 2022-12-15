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
-- Table structure for table `boardgame_image`
--

CREATE TABLE `boardgame_image` (
  `filename` varchar(225) DEFAULT NULL,
  `filetype` varchar(25) DEFAULT NULL,
  `imgid` int(11) NOT NULL,
  `gameid` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `boardgame_image`
--

INSERT INTO `boardgame_image` (`filename`, `filetype`, `imgid`, `gameid`) VALUES
('639a285fb0efbmysterium.jpg', 'image/jpeg', 78, 89),
('639a33d4a0920magic-maze.jpg', 'image/jpeg', 79, 90),
('639a348c2f757clank.jpg', 'image/jpeg', 80, 91),
('639a35a702d63architects.png', 'image/png', 81, 92),
('639a369ddab80dominion.jpg', 'image/jpeg', 82, 93),
('639a44dd7a3a6airline.jpg', 'image/jpeg', 87, 100),
('639a4586540b0catan.jpg', 'image/jpeg', 88, 101),
('639a47f1e93b2ticket.jpg', 'image/jpeg', 89, 102),
('639a48b2ca177gloomhaven.jpg', 'image/jpeg', 90, 103),
('639a497218b19ezgif.com-gif-maker.jpg', 'image/jpeg', 91, 104),
('639a4a67bc5f8terra.jpg', 'image/jpeg', 92, 105),
('639a4bb06c4ddbrass.jpg', 'image/jpeg', 93, 106),
('639a4cd7c8c94tapesrty.jpg', 'image/jpeg', 94, 107),
('639aaaafdf980pic3163924.jpg', 'image/jpeg', 95, 108),
('639aab38aa158pic5164305.jpg', 'image/jpeg', 96, 109),
('639aabe7c4b04pic1215982.jpg', 'image/jpeg', 97, 110),
('639aac8d38ec6pic4006839.jpg', 'image/jpeg', 98, 111),
('639aad197c7b7pic3476604.jpg', 'image/jpeg', 99, 112),
('639aada808bd2pic3125992.jpg', 'image/jpeg', 100, 113),
('639aae35e9757pic6137509.jpg', 'image/jpeg', 101, 114),
('639aaf058a31bpic3918905.jpg', 'image/jpeg', 102, 115),
('639aaf7557555pic4017489.jpg', 'image/jpeg', 103, 116),
('639aafebd7f21pic1534148.jpg', 'image/jpeg', 104, 117),
('639ab0b397ca4pic2007286.jpg', 'image/jpeg', 105, 118),
('639ab144ee1adpic70547.jpg', 'image/jpeg', 106, 119),
('639ab212f1de1pic1591406.jpg', 'image/jpeg', 107, 120),
('639ab270ea05epic3727516.jpg', 'image/jpeg', 108, 121);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `boardgame_image`
--
ALTER TABLE `boardgame_image`
  ADD PRIMARY KEY (`imgid`),
  ADD KEY `gameid` (`gameid`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `boardgame_image`
--
ALTER TABLE `boardgame_image`
  MODIFY `imgid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=111;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `boardgame_image`
--
ALTER TABLE `boardgame_image`
  ADD CONSTRAINT `fk_gid` FOREIGN KEY (`gameid`) REFERENCES `boardgame_catalog` (`gameid`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
