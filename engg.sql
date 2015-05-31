-- phpMyAdmin SQL Dump
-- version 4.2.9
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Mar 08, 2015 at 11:01 AM
-- Server version: 5.6.20
-- PHP Version: 5.5.19

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `engg`
--

-- --------------------------------------------------------

--
-- Table structure for table `Chats`
--

CREATE TABLE IF NOT EXISTS `Chats` (
`id` int(5) unsigned NOT NULL,
  `message` text NOT NULL,
  `time` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `files`
--

CREATE TABLE IF NOT EXISTS `files` (
`file_id` int(10) unsigned NOT NULL,
  `file_name` varchar(255) COLLATE latin1_general_ci NOT NULL,
  `file_orig_name` varchar(255) COLLATE latin1_general_ci NOT NULL,
  `file_path` varchar(255) COLLATE latin1_general_ci NOT NULL,
  `upload_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `membership`
--

CREATE TABLE IF NOT EXISTS `membership` (
`id` int(11) NOT NULL,
  `firstname` varchar(30) NOT NULL,
  `lastname` varchar(30) NOT NULL,
  `state` varchar(30) NOT NULL,
  `city` varchar(30) NOT NULL,
  `country` varchar(30) NOT NULL,
  `zip` int(6) NOT NULL,
  `address` varchar(500) NOT NULL,
  `email` varchar(30) NOT NULL,
  `mobileno` varchar(10) NOT NULL,
  `landlineno` varchar(15) NOT NULL,
  `username` varchar(30) NOT NULL,
  `password` varchar(100) NOT NULL,
  `date` date NOT NULL,
  `admin_id` varchar(100) NOT NULL,
  `status` int(1) NOT NULL
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `membership`
--

INSERT INTO `membership` (`id`, `firstname`, `lastname`, `state`, `city`, `country`, `zip`, `address`, `email`, `mobileno`, `landlineno`, `username`, `password`, `date`, `admin_id`, `status`) VALUES
(1, '', '', '', '', '', 0, '', '', '', '', 'admin', '0192023a7bbd73250516f069df18b500', '0000-00-00', '', 0);

-- --------------------------------------------------------

--
-- Table structure for table `student_list`
--

CREATE TABLE IF NOT EXISTS `student_list` (
`id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `address` varchar(100) NOT NULL,
  `year` varchar(100) NOT NULL,
  `gender` varchar(100) NOT NULL,
  `interest` varchar(100) NOT NULL,
  `status` int(11) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `student_list`
--

INSERT INTO `student_list` (`id`, `name`, `address`, `year`, `gender`, `interest`, `status`) VALUES
(1, 'admin', 'address', '201', 'male', 'music', 1);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `Chats`
--
ALTER TABLE `Chats`
 ADD PRIMARY KEY (`id`);

--
-- Indexes for table `files`
--
ALTER TABLE `files`
 ADD PRIMARY KEY (`file_id`);

--
-- Indexes for table `membership`
--
ALTER TABLE `membership`
 ADD PRIMARY KEY (`id`);

--
-- Indexes for table `student_list`
--
ALTER TABLE `student_list`
 ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `Chats`
--
ALTER TABLE `Chats`
MODIFY `id` int(5) unsigned NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `files`
--
ALTER TABLE `files`
MODIFY `file_id` int(10) unsigned NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `membership`
--
ALTER TABLE `membership`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `student_list`
--
ALTER TABLE `student_list`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=2;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
