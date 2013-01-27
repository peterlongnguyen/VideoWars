CREATE DATABASE videowars;
USE videowars;

-- phpMyAdmin SQL Dump
-- version 3.5.1
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Jan 27, 2013 at 02:14 AM
-- Server version: 5.5.25
-- PHP Version: 5.4.4

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";

--
-- Database: `videowars`
--

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

CREATE TABLE `categories` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(512) NOT NULL,
  `timestamp` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=11 ;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`id`, `name`, `timestamp`) VALUES
(1, 'Awe', '2013-01-27 00:17:04'),
(2, 'Sports', '2013-01-27 00:17:04'),
(3, 'Fail', '2013-01-27 00:17:04'),
(4, 'Comedy', '2013-01-27 00:17:04'),
(5, 'Music', '2013-01-27 00:17:04'),
(6, 'Politics', '2013-01-27 00:17:04'),
(7, 'Other', '2013-01-27 00:17:04'),
(8, 'WTF', '2013-01-27 00:17:04'),
(9, 'Scary', '2013-01-27 00:17:04'),
(10, 'Art', '2013-01-27 00:17:04');

-- --------------------------------------------------------

--
-- Table structure for table `topics`
--

CREATE TABLE `topics` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(512) NOT NULL,
  `category_id` int(10) unsigned NOT NULL,
  `allow_skips` tinyint(1) unsigned NOT NULL DEFAULT '1',
  `allow_additions` tinyint(1) unsigned NOT NULL DEFAULT '1',
  `allow_leaderboard` tinyint(1) unsigned NOT NULL DEFAULT '1',
  `visibility` tinyint(1) unsigned NOT NULL DEFAULT '1',
  `created` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=6 ;

--
-- Dumping data for table `topics`
--

INSERT INTO `topics` (`id`, `name`, `category_id`, `allow_skips`, `allow_additions`, `allow_leaderboard`, `visibility`, `created`) VALUES
(1, 'Cats', 1, 1, 1, 1, 1, '2013-01-26 23:46:01'),
(2, 'Superbowl Ads', 2, 1, 1, 1, 1, '2013-01-27 00:20:55'),
(3, 'Best NBA Slam Dunks', 2, 1, 1, 1, 1, '2013-01-27 00:20:55'),
(4, 'Best Rap Battle', 5, 1, 1, 1, 1, '2013-01-27 00:20:55'),
(5, 'Best Guitar Solos', 5, 1, 1, 1, 1, '2013-01-27 00:20:55');

-- --------------------------------------------------------

--
-- Table structure for table `videos`
--

CREATE TABLE `videos` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `youtube_id` varchar(256) NOT NULL,
  `topic_id` int(10) unsigned NOT NULL,
  `name` varchar(512) NOT NULL,
  `created` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=15 ;

--
-- Dumping data for table `videos`
--

INSERT INTO `videos` (`id`, `youtube_id`, `topic_id`, `name`, `created`) VALUES
(1, 'q1dpQKntj_w', 1, '10 Cutest Cat Moments', '2013-01-26 23:47:45'),
(2, 'ctJJrBw7e-c', 1, 'Cats 1', '2013-01-27 00:28:00'),
(3, 'J---aiyznGQ', 1, 'Cats 2', '2013-01-27 00:28:00'),
(4, 'IytNBm8WA1c', 1, 'Cats 3', '2013-01-27 00:28:00'),
(5, '2XID_W4neJo', 1, 'Cats 4', '2013-01-27 00:28:00'),
(6, 'wf_IIbT8HGk', 1, 'Cats 5', '2013-01-27 00:28:00'),
(7, 'NfCm9P8naDQ', 2, 'Superbowl 1', '2013-01-27 00:29:43'),
(8, 'cidAbexlHTE', 2, 'Superbowl 2', '2013-01-27 00:29:43'),
(9, 'PK9s6vVPCSo', 2, 'Superbowl 3', '2013-01-27 00:29:43'),
(10, '6uFQAqwbwSg', 2, 'Superbowl 4', '2013-01-27 00:29:43'),
(11, 'QAwnhlGud6w', 2, 'Superbowl 5', '2013-01-27 00:29:43'),
(12, 'idlYCrgDjX4', 3, 'Dunks 1', '2013-01-27 00:31:00'),
(13, '5BrkmIqUXck', 4, 'Rap 1', '2013-01-27 00:31:00'),
(14, 'x_2tSGxGnJQ', 5, 'Guitar Solo 1', '2013-01-27 00:31:31');

-- --------------------------------------------------------

--
-- Table structure for table `views`
--

CREATE TABLE `views` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `video_id` int(10) unsigned NOT NULL,
  `timestamp` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `votes`
--

CREATE TABLE `votes` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `win_video_id` int(10) unsigned NOT NULL,
  `lose_video_id` int(10) unsigned NOT NULL,
  `timestamp` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

