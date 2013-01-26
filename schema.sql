CREATE DATABASE videowars;

CREATE TABLE `videowars`.`videos` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `youtube_id` int(10) unsigned NOT NULL,
  `topic_id` int(10) unsigned NOT NULL,
  `name` varchar(512) NOT NULL,
  `created` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `created_by` int(10) unsigned NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

CREATE TABLE `videowars`.`topics` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(512) NOT NULL,
  `category_id` int(10) unsigned NOT NULL,
  `allow_skips` tinyint(1) unsigned NOT NULL DEFAULT 1,
  `allow_additions` tinyint(1) unsigned NOT NULL DEFAULT 1,
  `allow_leaderboard` tinyint(1) unsigned NOT NULL DEFAULT 1,
  `visibility` tinyint(1) unsigned NOT NULL DEFAULT 1,
  `created` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

CREATE TABLE `videowars`.`votes` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `win_video_id` int(10) unsigned NOT NULL,
  `lose_video_id` int(10) unsigned NOT NULL,
  `timestamp` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

CREATE TABLE `videowars`.`views` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `video_id` int(10) unsigned NOT NULL,
  `timestamp` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

CREATE TABLE `videowars`.`categories` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(512) NOT NULL,
  `timestamp` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;
