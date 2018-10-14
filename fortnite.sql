-- phpMyAdmin SQL Dump
-- version 4.7.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: Oct 14, 2018 at 08:36 AM
-- Server version: 5.7.19
-- PHP Version: 5.6.31

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `fortnite`
--

-- --------------------------------------------------------

--
-- Table structure for table `battle`
--

DROP TABLE IF EXISTS `battle`;
CREATE TABLE IF NOT EXISTS `battle` (
  `match_id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `winner_id` int(10) UNSIGNED NOT NULL,
  PRIMARY KEY (`match_id`),
  KEY `winner_id` (`winner_id`)
) ENGINE=InnoDB AUTO_INCREMENT=2018113 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `battle`
--

INSERT INTO `battle` (`match_id`, `winner_id`) VALUES
(2018111, 2018102);

-- --------------------------------------------------------

--
-- Table structure for table `battle_stats`
--

DROP TABLE IF EXISTS `battle_stats`;
CREATE TABLE IF NOT EXISTS `battle_stats` (
  `match_id` int(10) UNSIGNED NOT NULL,
  `player_id` int(10) UNSIGNED NOT NULL,
  `kills` int(10) NOT NULL DEFAULT '0',
  `stats` int(10) NOT NULL,
  PRIMARY KEY (`match_id`,`player_id`),
  KEY `player_id` (`player_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `battle_stats`
--

INSERT INTO `battle_stats` (`match_id`, `player_id`, `kills`, `stats`) VALUES
(2018111, 2018101, 4, 300),
(2018111, 2018102, 10, 750),
(2018111, 2018103, 6, 450),
(2018111, 2018104, 8, 600);

-- --------------------------------------------------------

--
-- Table structure for table `cosmetic_item`
--

DROP TABLE IF EXISTS `cosmetic_item`;
CREATE TABLE IF NOT EXISTS `cosmetic_item` (
  `item_id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `item_name` varchar(50) NOT NULL,
  `item_type` tinyint(2) UNSIGNED NOT NULL,
  `item_cost` int(10) NOT NULL DEFAULT '1000',
  PRIMARY KEY (`item_id`),
  UNIQUE KEY `name` (`item_name`)
) ENGINE=InnoDB AUTO_INCREMENT=2018126 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `cosmetic_item`
--

INSERT INTO `cosmetic_item` (`item_id`, `item_name`, `item_type`, `item_cost`) VALUES
(2018121, 'Orange Justice', 0, 1500),
(2018122, 'Skull Trooper', 3, 2000),
(2018123, 'Love Wings', 1, 1000),
(2018124, 'Pterodectyl', 2, 1200),
(2018125, 'Freestyln', 0, 1500);

-- --------------------------------------------------------

--
-- Table structure for table `cosmetic_purchases`
--

DROP TABLE IF EXISTS `cosmetic_purchases`;
CREATE TABLE IF NOT EXISTS `cosmetic_purchases` (
  `player_id` int(10) UNSIGNED NOT NULL,
  `item_id` int(10) UNSIGNED NOT NULL,
  PRIMARY KEY (`player_id`,`item_id`),
  KEY `item_id` (`item_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `cosmetic_purchases`
--

INSERT INTO `cosmetic_purchases` (`player_id`, `item_id`) VALUES
(2018101, 2018121),
(2018103, 2018122),
(2018102, 2018124),
(2018103, 2018124);

-- --------------------------------------------------------

--
-- Table structure for table `friends`
--

DROP TABLE IF EXISTS `friends`;
CREATE TABLE IF NOT EXISTS `friends` (
  `player_id` int(10) UNSIGNED NOT NULL,
  `friend_id` int(10) UNSIGNED NOT NULL,
  PRIMARY KEY (`player_id`,`friend_id`),
  KEY `friend_id` (`friend_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `friends`
--

INSERT INTO `friends` (`player_id`, `friend_id`) VALUES
(2018102, 2018101),
(2018103, 2018101),
(2018101, 2018102),
(2018104, 2018102),
(2018101, 2018103),
(2018104, 2018103),
(2018102, 2018104),
(2018103, 2018104);

-- --------------------------------------------------------

--
-- Table structure for table `player`
--

DROP TABLE IF EXISTS `player`;
CREATE TABLE IF NOT EXISTS `player` (
  `player_id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `username` varchar(50) NOT NULL,
  `name` varchar(50) NOT NULL DEFAULT 'player',
  `age` int(10) UNSIGNED NOT NULL DEFAULT '18',
  `gender` tinyint(2) NOT NULL DEFAULT '11',
  PRIMARY KEY (`player_id`),
  UNIQUE KEY `username` (`username`)
) ENGINE=InnoDB AUTO_INCREMENT=2018105 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `player`
--

INSERT INTO `player` (`player_id`, `username`, `name`, `age`, `gender`) VALUES
(2018101, 'miniflyer', 'Nilesh Jha', 20, 0),
(2018102, 'ramsibortan', 'Salman Khan', 20, 0),
(2018103, 'dark', 'Brett Hoffman', 25, 0),
(2018104, 'valkaryie', 'Rachel Marie', 23, 1);

--
-- Constraints for dumped tables
--

--
-- Constraints for table `battle`
--
ALTER TABLE `battle`
  ADD CONSTRAINT `battle_ibfk_1` FOREIGN KEY (`winner_id`) REFERENCES `player` (`player_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `battle_stats`
--
ALTER TABLE `battle_stats`
  ADD CONSTRAINT `battle_stats_ibfk_1` FOREIGN KEY (`match_id`) REFERENCES `battle` (`match_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `battle_stats_ibfk_2` FOREIGN KEY (`player_id`) REFERENCES `player` (`player_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `cosmetic_purchases`
--
ALTER TABLE `cosmetic_purchases`
  ADD CONSTRAINT `cosmetic_purchases_ibfk_1` FOREIGN KEY (`item_id`) REFERENCES `cosmetic_item` (`item_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `cosmetic_purchases_ibfk_2` FOREIGN KEY (`player_id`) REFERENCES `player` (`player_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `friends`
--
ALTER TABLE `friends`
  ADD CONSTRAINT `friends_ibfk_1` FOREIGN KEY (`player_id`) REFERENCES `player` (`player_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `friends_ibfk_2` FOREIGN KEY (`friend_id`) REFERENCES `player` (`player_id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
