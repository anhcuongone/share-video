-- phpMyAdmin SQL Dump
-- version 4.1.6
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Apr 07, 2014 at 04:45 PM
-- Server version: 5.6.16
-- PHP Version: 5.5.9

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `share-video`
--

-- --------------------------------------------------------

--
-- Table structure for table `advertisement`
--

CREATE TABLE IF NOT EXISTS `advertisement` (
  `advertisement_id` int(11) NOT NULL AUTO_INCREMENT,
  `advertisement_title` varchar(225) NOT NULL,
  `advertisement_description` text NOT NULL,
  `advertisement_url_img` varchar(255) NOT NULL,
  `advertisement_position` enum('1','2','3') NOT NULL,
  `advertisement_date_create` date NOT NULL,
  `advertisement_active` int(1) NOT NULL,
  PRIMARY KEY (`advertisement_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `comment`
--

CREATE TABLE IF NOT EXISTS `comment` (
  `comment_id` int(11) NOT NULL AUTO_INCREMENT,
  `comment_member_id` int(11) NOT NULL,
  `comment_content` text NOT NULL,
  `comment_active` int(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`comment_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `member`
--

CREATE TABLE IF NOT EXISTS `member` (
  `member_id` int(11) NOT NULL AUTO_INCREMENT,
  `member_username` varchar(255) NOT NULL,
  `member_password` varchar(255) NOT NULL,
  `member_name` varchar(255) NOT NULL,
  `member_email` varchar(255) NOT NULL,
  `member_date_create` date NOT NULL,
  `member_date_modified` date NOT NULL,
  PRIMARY KEY (`member_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `roles`
--

CREATE TABLE IF NOT EXISTS `roles` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `role_name` varchar(20) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=3 ;

--
-- Dumping data for table `roles`
--

INSERT INTO `roles` (`id`, `role_name`) VALUES
(1, 'admin'),
(2, 'user');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE IF NOT EXISTS `users` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `username` varchar(50) DEFAULT NULL,
  `password` varchar(50) DEFAULT NULL,
  `role` int(11) DEFAULT NULL,
  `created` datetime DEFAULT NULL,
  `modified` datetime DEFAULT NULL,
  `active` int(1) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=8 ;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `username`, `password`, `role`, `created`, `modified`, `active`) VALUES
(1, 'admin', '21OZ4/WxREgV.', 1, '2014-04-06 19:41:51', '2014-04-07 15:52:37', 1),
(2, 'user', '21jxeqhp4R9fM', 1, '2014-04-06 19:42:38', '2014-04-07 16:13:12', 0),
(3, 'yahoo', '21OZ4/WxREgV.', 1, '2014-04-06 20:00:07', '2014-04-07 16:13:05', 0),
(4, 'user_one', '21OZ4/WxREgV.', 2, '2014-04-06 20:00:29', '2014-04-07 12:14:03', 0),
(5, 'user', '21OZ4/WxREgV.', 1, '2014-04-06 20:00:35', '2014-04-07 05:38:08', 0),
(6, 'Skype', '21OZ4/WxREgV.', 1, '2014-04-06 20:00:42', '2014-04-07 16:38:54', 1),
(7, 'hello', '21OZ4/WxREgV.', 1, '2014-04-07 16:38:06', '2014-04-07 16:38:06', 1);

-- --------------------------------------------------------

--
-- Table structure for table `video`
--

CREATE TABLE IF NOT EXISTS `video` (
  `video_id` int(11) NOT NULL AUTO_INCREMENT,
  `video_category_id` int(11) NOT NULL,
  `video_title` varchar(255) NOT NULL,
  `video_description` text NOT NULL,
  `video_url` text NOT NULL,
  `video_image` varchar(255) NOT NULL,
  `video_total_view` int(11) NOT NULL,
  `video_date_create` datetime NOT NULL,
  `video_active` int(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`video_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `video_category`
--

CREATE TABLE IF NOT EXISTS `video_category` (
  `category_id` int(11) NOT NULL AUTO_INCREMENT,
  `category_name` varchar(40) CHARACTER SET utf8 COLLATE utf8_estonian_ci NOT NULL,
  `video_category_active` int(1) NOT NULL DEFAULT '1',
  PRIMARY KEY (`category_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=6 ;

--
-- Dumping data for table `video_category`
--

INSERT INTO `video_category` (`category_id`, `category_name`, `video_category_active`) VALUES
(1, 'Hài Hước', 1),
(2, 'Phim Ngắn', 1),
(3, 'Phim Bộ', 1),
(4, 'Âm Nhạc', 1),
(5, 'Roles Management', 1);

-- --------------------------------------------------------

--
-- Table structure for table `video_url`
--

CREATE TABLE IF NOT EXISTS `video_url` (
  `video_url_id` int(11) NOT NULL AUTO_INCREMENT,
  `video_id` int(11) NOT NULL,
  `video_url_title` varchar(255) NOT NULL,
  `video_url` text NOT NULL,
  `video_url_image` varchar(255) NOT NULL,
  `video_url_create_date` date NOT NULL,
  `video_url_active` int(1) NOT NULL DEFAULT '1',
  PRIMARY KEY (`video_url_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
