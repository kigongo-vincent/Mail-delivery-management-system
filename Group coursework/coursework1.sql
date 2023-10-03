-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: Oct 03, 2023 at 11:27 AM
-- Server version: 8.0.31
-- PHP Version: 8.0.26

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `coursework1`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

DROP TABLE IF EXISTS `admin`;
CREATE TABLE IF NOT EXISTS `admin` (
  `adminID` int NOT NULL DEFAULT '0',
  `username` varchar(20) DEFAULT NULL,
  `password` varchar(255) DEFAULT NULL,
  `email` varchar(50) DEFAULT NULL,
  `gender` varchar(10) DEFAULT NULL,
  `dob` date DEFAULT NULL,
  PRIMARY KEY (`adminID`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`adminID`, `username`, `password`, `email`, `gender`, `dob`) VALUES
(0, 'Kajumba', '$2y$10$s/9d4jWmFZ37aWFZj/EI4O/BwkHCSPpMH.2JqVWcm0F1ePBRVmmde', 'kajumbajeremiahivan@gmail.com', 'male', '2023-07-12');

-- --------------------------------------------------------

--
-- Table structure for table `admin_inbox`
--

DROP TABLE IF EXISTS `admin_inbox`;
CREATE TABLE IF NOT EXISTS `admin_inbox` (
  `msg_id` int NOT NULL AUTO_INCREMENT,
  `body` varchar(255) NOT NULL,
  `date` date NOT NULL,
  `staffID` int NOT NULL,
  `admnID` int NOT NULL DEFAULT '0',
  PRIMARY KEY (`msg_id`)
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=utf8mb3;

--
-- Dumping data for table `admin_inbox`
--

INSERT INTO `admin_inbox` (`msg_id`, `body`, `date`, `staffID`, `admnID`) VALUES
(1, 'hey', '2023-07-23', 1, 0),
(2, 'Muwanguzi is not there', '2023-07-23', 1, 0),
(3, 'How are you', '2023-07-23', 2, 0),
(4, 'i can not find joan', '2023-07-23', 2, 0),
(5, 'please send the correct location', '2023-07-23', 2, 0),
(6, 'Hello everyone', '2023-07-25', 11, 0),
(7, 'Mail has been successfully delivered', '2023-07-25', 5, 0),
(8, 'Pending mails', '2023-07-25', 3, 0),
(9, 'hey', '2023-10-03', 4, 0),
(10, 'this is me', '2023-10-03', 4, 0),
(11, 'hello from this side, how is the going', '2023-10-03', 4, 0);

-- --------------------------------------------------------

--
-- Table structure for table `mail`
--

DROP TABLE IF EXISTS `mail`;
CREATE TABLE IF NOT EXISTS `mail` (
  `p_o_box` varchar(50) DEFAULT NULL,
  `mail_status` int DEFAULT '0',
  `date_Delivered` date DEFAULT NULL,
  `date_Added` date DEFAULT NULL,
  `adminID` int DEFAULT '1',
  `staffID` int DEFAULT NULL,
  `mailID` int NOT NULL AUTO_INCREMENT,
  `client_name` varchar(255) NOT NULL,
  `contact` varchar(15) NOT NULL,
  PRIMARY KEY (`mailID`),
  KEY `adminID` (`adminID`),
  KEY `staffID` (`staffID`)
) ENGINE=MyISAM AUTO_INCREMENT=10 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `mail`
--

INSERT INTO `mail` (`p_o_box`, `mail_status`, `date_Delivered`, `date_Added`, `adminID`, `staffID`, `mailID`, `client_name`, `contact`) VALUES
('1289, lumumba avenue', 1, '2023-07-24', '2023-07-24', 1, 11, 1, 'katumba kevinie', '8989855599'),
('1289, lumumba ', 1, '2023-07-24', '2023-07-24', 1, 11, 2, 'katende', '89898555555'),
('24567, Nasser', 1, '2023-07-25', '2023-07-24', 1, 4, 3, 'Muwonge Isaac', '0774536382'),
('345, Nansana', 1, '2023-07-24', '2023-07-24', 1, 4, 4, 'kato kenzo', '07513246273'),
('647,Kawempe', 1, '2023-07-24', '2023-07-24', 1, 5, 5, 'Zaake ', '0774536382'),
('786, Kasangati', 1, '2023-07-25', '2023-07-24', 1, 4, 6, 'Nantume', '89898555555'),
('7829, KASANGATI', 1, '2023-07-25', '2023-07-24', 1, 4, 7, 'Kafeero', '0774536382'),
('1289, lumumba avenue', 1, '2023-07-24', '2023-07-24', 1, 5, 8, 'Hamis Kigundu', '07033184928'),
('1289, lumumba avenue', 0, NULL, '2023-07-25', 1, NULL, 9, 'katumba kevinie', '07656575675');

-- --------------------------------------------------------

--
-- Table structure for table `staff`
--

DROP TABLE IF EXISTS `staff`;
CREATE TABLE IF NOT EXISTS `staff` (
  `password` varchar(255) DEFAULT NULL,
  `staffID` int NOT NULL AUTO_INCREMENT,
  `email` varchar(50) DEFAULT NULL,
  `gender` varchar(10) DEFAULT NULL,
  `username` varchar(255) NOT NULL,
  `dob` date DEFAULT NULL,
  PRIMARY KEY (`staffID`)
) ENGINE=MyISAM AUTO_INCREMENT=12 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `staff`
--

INSERT INTO `staff` (`password`, `staffID`, `email`, `gender`, `username`, `dob`) VALUES
('$2y$10$HjM./FhumIw8adZvsx4ZXeeNnLPeHsQOMbQAk5kPdhPRP5VV4dDfm', 3, 'Kagoya@hotmail.com', 'female', 'Jemimah', '2008-05-08'),
('$2y$10$IOmcMGvp9CNMkly.yt/ewueE0OB9QvN6emowj1suCB10R2U6PUK32', 4, 'mariam@gmail.com', 'female', 'Mariam', '2003-07-08'),
('$2y$10$QQGqUmYcSFpn/0nMkM2HtubnvK0Vje3zpg85Ra0.ba05ZDldRVr9a', 5, 'priscilla@gmail.com', 'female', 'Priscilla', '2013-05-23'),
('$2y$10$q3oOJEL2YbMPwi/cuhsLneD7Bc1bBDAvzRfJgkwe3eD.Hhg4t78xa', 6, 'ramzi@icloud.com', 'male', 'Ramzi', '2011-01-05'),
('$2y$10$58mlZKLvVpB.y2lWu.1OXu3IVllaLyg5N9rfOGNNQGx5Gsl3c7gOe', 7, 'isaac@yahoo.com', NULL, 'Isaac', NULL),
('$2y$10$W8njb9ke3kgj1Aiz9R2VK.DnpOlhDk5JT8VkbPOXFU1qA0Wyw4/.q', 8, 'ssenyonjo@gmail.com', NULL, 'Sssenyonjo jovan', NULL),
('$2y$10$yMmd3Egg4W52uEJZq8HZEOTpvuG5sOJKV0OE8ra1wFBBUkevobF4S', 9, 'gloria@gmail.com', NULL, 'Gloria', NULL),
('$2y$10$bqD0by9RUMEVvdUSY1lQluQudFnVz4CaZv6XquSpJdzJMPrssEa7O', 10, 'katengwa@icloud.com', NULL, 'Hope', NULL),
('$2y$10$aStQW6pAVBdBIeNGqZbf8.6tZe7N14icy25n8yNxvJMOPOroiEHDa', 11, 'jjdon@gmail.com', NULL, 'Ivan', NULL);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
