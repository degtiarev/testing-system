
-- phpMyAdmin SQL Dump
-- version 2.11.4
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Dec 24, 2014 at 08:17 AM
-- Server version: 5.1.57
-- PHP Version: 5.2.17

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";

--
-- Database: `a9646121_1`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `login` varchar(30) CHARACTER SET utf8 NOT NULL,
  `password` varchar(32) CHARACTER SET utf8 NOT NULL,
  `email` varchar(30) CHARACTER SET utf8 NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `id` (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci AUTO_INCREMENT=5 ;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` VALUES(4, '123', '202cb962ac59075b964b07152d234b70', '123@mail.ru');

-- --------------------------------------------------------

--
-- Table structure for table `questions`
--

CREATE TABLE `questions` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `date` date NOT NULL,
  `question` varchar(200) CHARACTER SET utf8 NOT NULL,
  `id_admin` int(11) NOT NULL,
  `r_answer` varchar(50) CHARACTER SET utf8 NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=cp1251 AUTO_INCREMENT=46 ;

--
-- Dumping data for table `questions`
--

INSERT INTO `questions` VALUES(45, '2014-12-15', 'a b c d ', 4, 'b');
INSERT INTO `questions` VALUES(44, '2014-12-14', 'What date is today? a)15 b)16 c)17', 4, 'a');

-- --------------------------------------------------------

--
-- Table structure for table `results`
--

CREATE TABLE `results` (
  `id_user` int(11) NOT NULL,
  `id_question` int(11) NOT NULL,
  `answer` varchar(50) CHARACTER SET utf8 NOT NULL,
  KEY `id_user` (`id_user`),
  KEY `id_question` (`id_question`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci;

--
-- Dumping data for table `results`
--

INSERT INTO `results` VALUES(40, 45, 'b');
INSERT INTO `results` VALUES(39, 44, 'a');
INSERT INTO `results` VALUES(40, 44, 'b');
INSERT INTO `results` VALUES(41, 44, 'c');
INSERT INTO `results` VALUES(42, 44, 'a');
INSERT INTO `results` VALUES(43, 44, 'c');
INSERT INTO `results` VALUES(39, 45, 'a');

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `login` varchar(20) CHARACTER SET utf8 NOT NULL,
  `password` varchar(32) CHARACTER SET utf8 NOT NULL,
  `email` varchar(20) CHARACTER SET utf8 NOT NULL,
  `id_admin` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `login` (`login`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci AUTO_INCREMENT=44 ;

--
-- Dumping data for table `user`
--

INSERT INTO `user` VALUES(43, '5', '5', '5@mail.ru', 4);
INSERT INTO `user` VALUES(42, '4', '4', '4@mail.ru', 4);
INSERT INTO `user` VALUES(41, '3', '3', '3@mail.ru', 4);
INSERT INTO `user` VALUES(40, '2', '2', '2@mail.ru', 4);
INSERT INTO `user` VALUES(39, '1', '1', '1@mail.ru', 4);
