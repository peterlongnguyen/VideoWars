CREATE DATABASE videowars;
USE videowars;
-- phpMyAdmin SQL Dump
-- version 3.5.1
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Jan 27, 2013 at 10:11 AM
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
) ENGINE=MyISAM DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

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
) ENGINE=MyISAM DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `videos`
--

CREATE TABLE `videos` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `youtube_id` varchar(256) NOT NULL,
  `topic_id` int(10) unsigned NOT NULL,
  `name` varchar(512) NOT NULL,
  `votes` int(10) unsigned NOT NULL DEFAULT '0',
  `views` int(10) unsigned NOT NULL DEFAULT '0',
  `created` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
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

-- --------------------------------------------------------

--
-- Data for table `categories`
--

INSERT INTO `categories` (`id`, `name`, `timestamp`) VALUES (NULL, 'Uncategorized', CURRENT_TIMESTAMP), (NULL, 'Art & Design', CURRENT_TIMESTAMP), (NULL, 'Animals', CURRENT_TIMESTAMP), (NULL, 'Cars', CURRENT_TIMESTAMP), (NULL, 'Celebrities', CURRENT_TIMESTAMP), (NULL, 'Comedy', CURRENT_TIMESTAMP), (NULL, 'Commercials', CURRENT_TIMESTAMP), (NULL, 'Education', CURRENT_TIMESTAMP), (NULL, 'Family', CURRENT_TIMESTAMP), (NULL, 'Fashion', CURRENT_TIMESTAMP), (NULL, 'Food & Fitness', CURRENT_TIMESTAMP), (NULL, 'Gaming', CURRENT_TIMESTAMP), (NULL, 'Life Hacks', CURRENT_TIMESTAMP), (NULL, 'Movies & Film', CURRENT_TIMESTAMP), (NULL, 'Nature', CURRENT_TIMESTAMP), (NULL, 'News', CURRENT_TIMESTAMP), (NULL, 'Science', CURRENT_TIMESTAMP), (NULL, 'Sports', CURRENT_TIMESTAMP), (NULL, 'Technology', CURRENT_TIMESTAMP), (NULL, 'WTF', CURRENT_TIMESTAMP);
