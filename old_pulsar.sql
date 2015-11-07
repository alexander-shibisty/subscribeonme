-- phpMyAdmin SQL Dump
-- version 4.0.10.10
-- http://www.phpmyadmin.net
--
-- Хост: 127.0.0.1:3306
-- Время создания: Ноя 07 2015 г., 17:26
-- Версия сервера: 5.6.26
-- Версия PHP: 5.6.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- База данных: `old_pulsar`
--

-- --------------------------------------------------------

--
-- Структура таблицы `autors_blog`
--

CREATE TABLE IF NOT EXISTS `autors_blog` (
  `bl_id` int(1) NOT NULL,
  `title` varchar(50) NOT NULL,
  `text` text NOT NULL,
  `date` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Структура таблицы `base_games`
--

CREATE TABLE IF NOT EXISTS `base_games` (
  `id` int(1) NOT NULL AUTO_INCREMENT,
  `title` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=304443 ;

-- --------------------------------------------------------

--
-- Структура таблицы `posts_videos`
--

CREATE TABLE IF NOT EXISTS `posts_videos` (
  `v_id` int(1) NOT NULL AUTO_INCREMENT,
  `user_id` int(1) NOT NULL,
  `video` varchar(100) NOT NULL,
  PRIMARY KEY (`v_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=41 ;

-- --------------------------------------------------------

--
-- Структура таблицы `posts_videos_cat`
--

CREATE TABLE IF NOT EXISTS `posts_videos_cat` (
  `c_id` int(1) NOT NULL AUTO_INCREMENT,
  `v_id` int(1) NOT NULL,
  `character` varchar(150) NOT NULL,
  PRIMARY KEY (`c_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=31 ;

-- --------------------------------------------------------

--
-- Структура таблицы `posts_videos_in`
--

CREATE TABLE IF NOT EXISTS `posts_videos_in` (
  `in_id` int(1) NOT NULL AUTO_INCREMENT,
  `v_id` int(1) NOT NULL,
  `title` varchar(150) NOT NULL,
  `category` enum('vlog','review','motiondesign','letsplay','news','video') NOT NULL,
  `image` varchar(40) NOT NULL,
  `date` datetime NOT NULL,
  PRIMARY KEY (`in_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=41 ;

-- --------------------------------------------------------

--
-- Структура таблицы `users`
--

CREATE TABLE IF NOT EXISTS `users` (
  `user_id` int(1) NOT NULL AUTO_INCREMENT,
  `email` varchar(100) NOT NULL,
  `password` char(32) NOT NULL,
  PRIMARY KEY (`user_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=33 ;

-- --------------------------------------------------------

--
-- Структура таблицы `users_avatars`
--

CREATE TABLE IF NOT EXISTS `users_avatars` (
  `av_id` int(1) NOT NULL AUTO_INCREMENT,
  `user_id` int(1) NOT NULL,
  `avatar` char(32) NOT NULL,
  KEY `av_id` (`av_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=7 ;

-- --------------------------------------------------------

--
-- Структура таблицы `users_blacklists`
--

CREATE TABLE IF NOT EXISTS `users_blacklists` (
  `ban_id` int(1) NOT NULL AUTO_INCREMENT,
  `user_pioneer` int(1) NOT NULL,
  `user_other` int(1) NOT NULL,
  `all` int(1) NOT NULL,
  `comments` text NOT NULL,
  `ban_on` datetime NOT NULL,
  `ban_off` datetime NOT NULL,
  PRIMARY KEY (`ban_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Структура таблицы `users_blacklists_settings`
--

CREATE TABLE IF NOT EXISTS `users_blacklists_settings` (
  `bls_id` int(1) NOT NULL AUTO_INCREMENT,
  `ban_id` int(1) NOT NULL,
  `write_comments` int(1) NOT NULL,
  `write_message` int(1) NOT NULL,
  `wotch_content` int(1) NOT NULL,
  PRIMARY KEY (`bls_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Структура таблицы `users_blacklist_global`
--

CREATE TABLE IF NOT EXISTS `users_blacklist_global` (
  `s_id` int(1) NOT NULL AUTO_INCREMENT,
  `user_id` int(1) NOT NULL,
  `status` int(1) NOT NULL,
  KEY `s_id` (`s_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=34 ;

-- --------------------------------------------------------

--
-- Структура таблицы `users_dialogs`
--

CREATE TABLE IF NOT EXISTS `users_dialogs` (
  `d_id` int(1) NOT NULL AUTO_INCREMENT,
  `pioneer_id` int(1) NOT NULL,
  `other_id` int(1) NOT NULL,
  `date` datetime NOT NULL,
  `meter` int(1) NOT NULL,
  PRIMARY KEY (`d_id`),
  KEY `pioneer_id` (`pioneer_id`),
  KEY `other_id` (`other_id`),
  KEY `d_id` (`d_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=20 ;

-- --------------------------------------------------------

--
-- Структура таблицы `users_friends`
--

CREATE TABLE IF NOT EXISTS `users_friends` (
  `fr_id` int(1) NOT NULL,
  `user_pioneer` int(1) NOT NULL,
  `user_other` int(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Структура таблицы `users_friends_req`
--

CREATE TABLE IF NOT EXISTS `users_friends_req` (
  `req_id` int(1) NOT NULL AUTO_INCREMENT,
  `user_pioneer` int(1) NOT NULL,
  `user_other` int(1) NOT NULL,
  `date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  KEY `req_id` (`req_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=21 ;

-- --------------------------------------------------------

--
-- Структура таблицы `users_information`
--

CREATE TABLE IF NOT EXISTS `users_information` (
  `in_id` int(1) NOT NULL AUTO_INCREMENT,
  `user_id` int(1) NOT NULL,
  `nickname` varchar(100) NOT NULL,
  `category` varchar(20) NOT NULL,
  `avatar` varchar(100) NOT NULL,
  PRIMARY KEY (`in_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=33 ;

-- --------------------------------------------------------

--
-- Структура таблицы `users_information_common`
--

CREATE TABLE IF NOT EXISTS `users_information_common` (
  `ci_id` int(1) NOT NULL AUTO_INCREMENT,
  `user_id` int(1) NOT NULL,
  `first_name` varchar(50) NOT NULL,
  `last_name` varchar(50) NOT NULL,
  `country` varchar(100) NOT NULL,
  `city` varchar(100) NOT NULL,
  PRIMARY KEY (`ci_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=33 ;

-- --------------------------------------------------------

--
-- Структура таблицы `users_links`
--

CREATE TABLE IF NOT EXISTS `users_links` (
  `l_id` int(1) NOT NULL AUTO_INCREMENT,
  `user_id` int(1) NOT NULL,
  `link` varchar(50) NOT NULL,
  KEY `l_id` (`l_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=2 ;

-- --------------------------------------------------------

--
-- Структура таблицы `users_messages`
--

CREATE TABLE IF NOT EXISTS `users_messages` (
  `mes_id` int(1) NOT NULL AUTO_INCREMENT,
  `d_id` int(1) NOT NULL,
  `user_id` int(1) NOT NULL,
  `text` text NOT NULL,
  `date` datetime NOT NULL,
  PRIMARY KEY (`mes_id`),
  KEY `mes_id` (`mes_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=190 ;

-- --------------------------------------------------------

--
-- Структура таблицы `users_online`
--

CREATE TABLE IF NOT EXISTS `users_online` (
  `o_id` int(1) NOT NULL AUTO_INCREMENT,
  `user_id` int(1) NOT NULL,
  `online` enum('busy','left','offline','online','play','rest','sleep') NOT NULL,
  `date` datetime NOT NULL,
  KEY `o_id` (`o_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=33 ;

-- --------------------------------------------------------

--
-- Структура таблицы `users_rating`
--

CREATE TABLE IF NOT EXISTS `users_rating` (
  `r_id` int(1) NOT NULL AUTO_INCREMENT,
  `user_id` int(1) NOT NULL,
  `rating` int(1) NOT NULL,
  KEY `r_id` (`r_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=33 ;

-- --------------------------------------------------------

--
-- Структура таблицы `users_registration`
--

CREATE TABLE IF NOT EXISTS `users_registration` (
  `id_reg` int(1) NOT NULL AUTO_INCREMENT,
  `key_reg` varchar(50) NOT NULL,
  `password` char(32) NOT NULL,
  `email` varchar(100) NOT NULL,
  `nickname` varchar(50) NOT NULL,
  `category` enum('vloger','motiondesign','letsplay','review','user') NOT NULL,
  `rules` char(2) NOT NULL,
  PRIMARY KEY (`id_reg`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=2 ;

-- --------------------------------------------------------

--
-- Структура таблицы `users_settings`
--

CREATE TABLE IF NOT EXISTS `users_settings` (
  `se_id` int(1) NOT NULL AUTO_INCREMENT,
  `user_id` int(1) NOT NULL,
  `lang` tinyint(2) NOT NULL,
  PRIMARY KEY (`se_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Структура таблицы `users_settings_profiles`
--

CREATE TABLE IF NOT EXISTS `users_settings_profiles` (
  `ps_id` int(1) NOT NULL AUTO_INCREMENT,
  `user_id` int(1) NOT NULL,
  `backgroud` varchar(100) NOT NULL,
  PRIMARY KEY (`ps_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Структура таблицы `users_subscribes`
--

CREATE TABLE IF NOT EXISTS `users_subscribes` (
  `sub_id` int(1) NOT NULL AUTO_INCREMENT,
  `user_pioneer` int(1) NOT NULL,
  `user_other` int(1) NOT NULL,
  KEY `sub_id` (`sub_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=10 ;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
