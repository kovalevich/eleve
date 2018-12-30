-- phpMyAdmin SQL Dump
-- version 4.0.10.4
-- http://www.phpmyadmin.net
--
-- Хост: localhost
-- Время создания: Окт 27 2014 г., 00:43
-- Версия сервера: 5.5.40-MariaDB
-- Версия PHP: 5.3.29

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- База данных: `eleve`
--

-- --------------------------------------------------------

--
-- Структура таблицы `articles`
--

CREATE TABLE IF NOT EXISTS `articles` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `category_id` varchar(20) NOT NULL,
  `meta_title` varchar(500) DEFAULT NULL,
  `meta_keywords` text,
  `meta_description` text,
  `title` text NOT NULL,
  `text` text NOT NULL,
  `created` datetime NOT NULL,
  `modified` datetime NOT NULL,
  `views` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=cp1251 AUTO_INCREMENT=3 ;

--
-- Дамп данных таблицы `articles`
--

INSERT INTO `articles` (`id`, `category_id`, `meta_title`, `meta_keywords`, `meta_description`, `title`, `text`, `created`, `modified`, `views`) VALUES
(1, '2', 'Lorem Ipsum', 'Lorem Ipsum', 'Lorem Ipsum', 'Lorem Ipsum', '<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum</p>\r\n\r\n<hr />\r\n<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.</p>\r\n', '2014-02-08 10:06:56', '2014-02-08 10:59:41', 0),
(2, '2', 'Lorem Ipsum', 'Lorem Ipsum', 'Lorem Ipsum', 'Lorem Ipsum', '<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.</p>\r\n\r\n<hr />\r\n<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.</p>\r\n\r\n<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.</p>\r\n', '2014-02-08 11:52:15', '2014-02-08 11:52:15', 0);

-- --------------------------------------------------------

--
-- Структура таблицы `castings`
--

CREATE TABLE IF NOT EXISTS `castings` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `category_id` int(11) NOT NULL,
  `title` varchar(100) NOT NULL,
  `text` text NOT NULL,
  `created` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=2 ;

--
-- Дамп данных таблицы `castings`
--

INSERT INTO `castings` (`id`, `category_id`, `title`, `text`, `created`) VALUES
(1, 14, 'Name', '<p>TDI Group &ndash; группа рекламных компаний, которая занимает первое место согласно рейтингу креативности &laquo;Ассоциации рекламных организаций&raquo; (АРО) за 2011, 2012 и 2013 гг.</p>\r\n\r\n<p>В состав TDI Group входят 5 специализированных рекламных агентств, расположенных в центре Минска. В штате TDI Group более 80 профессионалов.</p>\r\n\r\n<p>В портфолио TDI Group &ndash; уникальные проекты, реализованные для крупнейших белорусских и мировых производителей, награды важнейших международных рекламных фестивалей, бесценный опыт в сфере маркетинговых услуг.&nbsp;</p>\r\n', '2014-09-07 03:45:05');

-- --------------------------------------------------------

--
-- Структура таблицы `categories`
--

CREATE TABLE IF NOT EXISTS `categories` (
  `id` int(20) NOT NULL AUTO_INCREMENT,
  `description` text NOT NULL,
  `title` varchar(200) NOT NULL,
  `type` varchar(50) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=cp1251 AUTO_INCREMENT=16 ;

--
-- Дамп данных таблицы `categories`
--

INSERT INTO `categories` (`id`, `description`, `title`, `type`) VALUES
(1, '', 'Неделя моды', 'communications'),
(2, 'Публикация новостей проекта', 'Новости', 'articles'),
(5, 'SPA &amp; Wellness', 'Салоны красоты', 'discounts'),
(8, 'SPA &amp; Wellness', 'Фитнес-центры', 'discounts'),
(9, 'SPA &amp; Wellness', 'SPA-салоны', 'discounts'),
(10, 'SPA &amp; Wellness', 'Сауны, бани', 'discounts'),
(11, 'SPA &amp; Wellness', 'Солярии', 'discounts'),
(12, 'Shopping', 'Косметика и парфюмерия', 'discounts'),
(13, 'Shopping', 'Одежда', 'discounts'),
(14, '', 'Кастинги', 'castings'),
(15, '', 'Рекламное агенство', 'communications');

-- --------------------------------------------------------

--
-- Структура таблицы `communications`
--

CREATE TABLE IF NOT EXISTS `communications` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `category_id` varchar(20) NOT NULL,
  `meta_title` varchar(500) DEFAULT NULL,
  `meta_keywords` text,
  `meta_description` text,
  `title` text NOT NULL,
  `text` text NOT NULL,
  `created` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=cp1251 AUTO_INCREMENT=6 ;

--
-- Дамп данных таблицы `communications`
--

INSERT INTO `communications` (`id`, `category_id`, `meta_title`, `meta_keywords`, `meta_description`, `title`, `text`, `created`) VALUES
(5, '15', 'TDI Group', 'TDI Group', 'TDI Group', 'TDI Group', '<p>TDI Group &ndash; группа рекламных компаний, которая занимает первое место согласно рейтингу креативности &laquo;Ассоциации рекламных организаций&raquo; (АРО) за 2011, 2012 и 2013 гг.</p>\r\n\r\n<p><span style="line-height:1.6">В состав TDI Group входят 5 специализированных рекламных агентств, расположенных в центре Минска. В штате TDI Group более 80 профессионалов.</span></p>\r\n\r\n<p>В портфолио TDI Group &ndash; уникальные проекты, реализованные для крупнейших белорусских и мировых производителей, награды важнейших международных рекламных фестивалей, бесценный опыт в сфере маркетинговых услуг.&nbsp;</p>\r\n\r\n<p>Контакты:<br />\r\n220 034, Минск,<br />\r\nул. Краснозвездная 18Б,<br />\r\nПомещение 4,<br />\r\n+375 (17) 296-67-83,<br />\r\n<a href="mailto:info@tdi.by">info@tdi.by</a></p>\r\n', '2014-05-30 16:37:24');

-- --------------------------------------------------------

--
-- Структура таблицы `discounts`
--

CREATE TABLE IF NOT EXISTS `discounts` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `category_id` int(11) NOT NULL,
  `title` varchar(150) NOT NULL,
  `text` text NOT NULL,
  `created` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Структура таблицы `files`
--

CREATE TABLE IF NOT EXISTS `files` (
  `id` varchar(20) NOT NULL,
  `name` varchar(100) DEFAULT NULL,
  `loadet` datetime DEFAULT NULL,
  `description` text,
  `extension` varchar(5) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=cp1251;

--
-- Дамп данных таблицы `files`
--

INSERT INTO `files` (`id`, `name`, `loadet`, `description`, `extension`) VALUES
('12evihth33c', ' малого д 2013с.docx', '2013-11-28 21:30:42', NULL, 'docx'),
('2eapq4x2mii', ' и ан эксп им оп д 2013.doc', '2013-11-28 21:49:36', NULL, 'doc'),
('3969k25eh6g', ' труда д 2013с.doc', '2013-11-28 20:50:59', NULL, 'doc'),
('3a4yaqcbbii', ' к оформлению.zip', '2013-11-29 15:27:02', NULL, 'zip'),
('4uwrslcewaa', '.rar', '2013-12-03 15:34:25', NULL, 'rar'),
('58udfg2iyt2', 'preview.rar', '2013-11-28 17:16:35', NULL, 'rar'),
('618a8chf7zm', '. указ.ОП ЗО ДЗ.docx', '2013-12-07 16:35:31', NULL, 'docx'),
('68lb68u46gs', 'Сайт.docx', '2013-12-13 20:23:13', NULL, 'docx'),
('6cg22yjrz7h', ' РАБОТА №7162 (последняя доробтка).docx', '2013-12-03 19:20:52', NULL, 'docx'),
('712c42lpzov', ' №107688.docx', '2013-12-03 19:12:51', NULL, 'docx'),
('7zabgkjxssf', ' труда д 2013.zip', '2013-11-28 21:16:57', NULL, 'zip'),
('91frzis9zlv', ' ЧАСТЬ.doc', '2013-12-02 16:02:11', NULL, 'doc'),
('9iei8t12s88', ' №5976.docx', '2013-12-03 19:28:51', NULL, 'docx'),
('a010dpuw7yq', ' Волкова Евгения Владимировна.doc', '2013-12-02 15:26:50', NULL, 'doc'),
('bb1o4nvefhq', ' государственный технический университет имени исправленное.docx', '2013-11-27 10:15:08', NULL, 'docx'),
('bi4yaufbxm2', ' Культурология.docx', '2013-12-03 19:20:52', NULL, 'docx'),
('bsraig0fwdy', '.docx', '2013-11-26 22:10:43', NULL, 'docx'),
('cr4c9cz61xo', ' труда д 2013с.docx', '2013-11-28 21:16:57', NULL, 'docx'),
('dnek5dugpfk', 'Dorabotka_po_TZ.doc', '2013-12-12 12:50:14', NULL, 'doc'),
('dut57pkgprh', ' предметов.doc', '2013-12-06 17:22:42', NULL, 'doc'),
('e19tjm98huq', ' РЕФЕРАТ.docx', '2013-12-03 19:12:51', NULL, 'docx'),
('elbmkveysrh', ' Налоги.docx', '2013-12-03 19:28:51', NULL, 'docx'),
('feom3kuazp1', ' труда 20.06.2013.rar', '2013-11-28 17:16:35', NULL, 'rar'),
('g8vlznm9bkq', 'Obschestvennye_organizatsii_i_obschestvennoe_dvizheni.doc', '2013-11-28 21:42:34', NULL, 'doc'),
('gk6i53tl73x', 'Grazhdanskoe_obschestvo_i_pravovoe_gosudarstvo.doc', '2013-11-28 21:47:45', NULL, 'doc'),
('hcd0ayy3f9s', ' труда д 2013.zip', '2013-11-28 20:50:59', NULL, 'zip'),
('hwuemjjem6y', '.docx', '2013-12-07 11:13:58', NULL, 'docx'),
('i102eaxlwzr', 'Doc1.doc', '2013-12-03 14:30:10', NULL, 'doc'),
('igrx9mprftb', ' малого д 2013.zip', '2013-11-28 21:30:42', NULL, 'zip'),
('iy3iji17bup', '.docx', '2013-11-28 21:47:45', NULL, 'docx'),
('mjweams0qa', ' и ан эксп им оп д2013с.docx', '2013-11-28 21:49:37', NULL, 'docx');

-- --------------------------------------------------------

--
-- Структура таблицы `files-users`
--

CREATE TABLE IF NOT EXISTS `files-users` (
  `file_id` varchar(20) NOT NULL,
  `user_id` varchar(20) NOT NULL,
  PRIMARY KEY (`file_id`)
) ENGINE=InnoDB DEFAULT CHARSET=cp1251;

--
-- Дамп данных таблицы `files-users`
--

INSERT INTO `files-users` (`file_id`, `user_id`) VALUES
('4uwrslcewaa', 'bmpsq3wdzjw'),
('a010dpuw7yq', 'bmpsq3wdzjw'),
('bsraig0fwdy', '3hfn1z0mf79'),
('dnek5dugpfk', 'iks4pt90veg'),
('dut57pkgprh', '72wzfmdy1cg'),
('g8vlznm9bkq', 'ipke9vbje11'),
('i102eaxlwzr', '4jzipy28hng');

-- --------------------------------------------------------

--
-- Структура таблицы `images`
--

CREATE TABLE IF NOT EXISTS `images` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` varchar(100) NOT NULL,
  `name` varchar(200) NOT NULL,
  `description` text NOT NULL,
  `is_primary` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=8 ;

--
-- Дамп данных таблицы `images`
--

INSERT INTO `images` (`id`, `user_id`, `name`, `description`, `is_primary`) VALUES
(1, 'evgen', 'photo-c8xl6h6fg8k.jpg', '', 0),
(2, 'evgen', 'photo-664gr69rk9a.jpg', '', 0),
(3, 'evgen', 'photo-3bkt1v45tyc.jpg', '', 0),
(4, 'ae435qxbo7v', 'photo-fxql0hn2mmo.jpg', '', 0),
(5, 'spooqx55n7', 'photo-ji8gl8t2hwh.jpg', '', 0),
(6, '32jryxqtr0y', 'photo-4edo11a9846.png', '', 0),
(7, '32jryxqtr0y', 'photo-apn6i7isceg.png', '', 0);

-- --------------------------------------------------------

--
-- Структура таблицы `subscription`
--

CREATE TABLE IF NOT EXISTS `subscription` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` varchar(100) NOT NULL,
  `casting_id` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=7 ;

--
-- Дамп данных таблицы `subscription`
--

INSERT INTO `subscription` (`id`, `user_id`, `casting_id`) VALUES
(1, 'evgen', 1),
(2, 'ae435qxbo7v', 1),
(3, 'ae435qxbo7v', 2),
(4, 'ae435qxbo7v', 3),
(5, 'evgen', 3),
(6, '9h8fqnw4cq5', 1);

-- --------------------------------------------------------

--
-- Структура таблицы `users`
--

CREATE TABLE IF NOT EXISTS `users` (
  `id` varchar(50) NOT NULL,
  `language_1_level` int(11) NOT NULL,
  `language_2_level` int(11) NOT NULL,
  `name` varchar(50) NOT NULL,
  `email` varchar(100) NOT NULL,
  `phone` varchar(50) DEFAULT NULL,
  `address` varchar(300) DEFAULT NULL,
  `password` varchar(32) CHARACTER SET utf8 NOT NULL,
  `about` text,
  `role` varchar(11) NOT NULL,
  `passport` varchar(150) NOT NULL,
  `date_passport` varchar(50) NOT NULL,
  `date_brit` datetime NOT NULL,
  `created` datetime NOT NULL,
  `modified` datetime DEFAULT NULL,
  `growth` int(5) DEFAULT NULL,
  `volumes` varchar(20) DEFAULT NULL,
  `volumes_shoes` int(4) NOT NULL,
  `status` int(1) NOT NULL DEFAULT '1',
  `education` varchar(30) NOT NULL,
  `language_1` varchar(50) NOT NULL,
  `language_2` varchar(50) NOT NULL,
  `goals` varchar(500) NOT NULL,
  `goal_1` int(11) NOT NULL,
  `goal_2` int(11) NOT NULL,
  `goal_3` int(11) NOT NULL,
  `goal_4` int(11) NOT NULL,
  `goal_5` int(11) NOT NULL,
  `goal_6` int(11) NOT NULL,
  `goal_7` int(11) NOT NULL,
  `goal_8` int(11) NOT NULL,
  `goal_9` int(11) NOT NULL,
  `goal_10` int(11) NOT NULL,
  `goal_11` int(11) NOT NULL,
  `experience` text NOT NULL,
  `prof_1` int(11) NOT NULL,
  `prof_2` int(11) NOT NULL,
  `prof_3` int(11) NOT NULL,
  `prof_4` int(11) NOT NULL,
  `prof_5` int(11) NOT NULL,
  `prof_6` int(11) NOT NULL,
  `prof_7` int(11) NOT NULL,
  `prof_8` int(11) NOT NULL,
  `prof_9` int(11) NOT NULL,
  `prof_10` int(11) NOT NULL,
  `style` text NOT NULL,
  `getnews` int(1) NOT NULL,
  `quality` varchar(200) NOT NULL,
  `account_status` int(11) NOT NULL,
  `forgotpass_code` varchar(20) NOT NULL,
  `account_type` int(11) NOT NULL,
  `account_type1` int(11) NOT NULL,
  `public_id` varchar(100) NOT NULL,
  `ref` varchar(100) NOT NULL,
  `account_type_discount` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=cp1251;

--
-- Дамп данных таблицы `users`
--

INSERT INTO `users` (`id`, `language_1_level`, `language_2_level`, `name`, `email`, `phone`, `address`, `password`, `about`, `role`, `passport`, `date_passport`, `date_brit`, `created`, `modified`, `growth`, `volumes`, `volumes_shoes`, `status`, `education`, `language_1`, `language_2`, `goals`, `goal_1`, `goal_2`, `goal_3`, `goal_4`, `goal_5`, `goal_6`, `goal_7`, `goal_8`, `goal_9`, `goal_10`, `goal_11`, `experience`, `prof_1`, `prof_2`, `prof_3`, `prof_4`, `prof_5`, `prof_6`, `prof_7`, `prof_8`, `prof_9`, `prof_10`, `style`, `getnews`, `quality`, `account_status`, `forgotpass_code`, `account_type`, `account_type1`, `public_id`, `ref`, `account_type_discount`) VALUES
('1oq6gqjc9nu', 0, 0, '34324234234', 'mshnek4545454545454545454545454545454545454545454@inbox.ru', '+375339039445', 'b-r Priberznskiy, d. 28, kv. 24.', 'bd8f03d3a489567e63d8b1a54010e305', NULL, 'user', '345423', '324324', '0000-00-00 00:00:00', '2014-10-26 22:42:21', NULL, NULL, NULL, 0, 1, '', '', '', '', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, '', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, '', 0, '', 0, '', 1, 1, '1oq6gqjc9nu', '', 0),
('2zrm9whsmmd', 0, 0, 'Maksim Aleksandrovich Shnek', 'shnekmax@mail.ru', '375339039445', 'b-r Priberznskiy, d. 28, kv. 24.', '987d4cbeeb8cd94949b8862cc4611780', NULL, 'user', '', '', '0000-00-00 00:00:00', '2014-10-26 22:40:26', NULL, NULL, NULL, 0, 1, '', '', '', '', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, '', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, '', 0, '', 1, '', 0, 0, '2zrm9whsmmd', '', 0),
('5g3xept8o18', 0, 0, 'Елена Азовская555', 'shnekm45454ax@mail.ru', '5435435435', '43543534543', '9dc79d2052520110e6090fdb4309c57c', NULL, 'user', '345423', '43543543534', '0000-00-00 00:00:00', '2014-09-15 22:21:12', NULL, NULL, NULL, 0, 1, '', '', '', '', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, '', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, '', 0, '', 1, '', 2, 0, '5g3xept8o18', '', 0),
('9h8fqnw4cq5', 0, 0, 'Maksim Shnek', 'shnekmax@gmail.com', '+375444903491', 'г. Бобруйск, б-р Приберезинский, д.28, кв. 24.', 'c47c38017f2fa60cefd73b6b0489ec7f', NULL, 'admin', 'MP2008874', 'Октябрьское РОВД г. Минск', '1970-01-01 00:00:00', '2014-05-30 12:40:05', NULL, 0, '', 0, 1, '', '', '', '', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, '', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, '', 0, '', 1, '', 0, 0, '9h8fqnw4cq5', '', 0),
('a2lf5qv9o7v', 0, 0, 'dfdsfds', 'e.s.koghyro@gmail.com', '+375294458', 'b-r Priberznskiy, d. 28, kv. 24.', 'e09ab059960ea68043204ebb93cf52a6', NULL, 'user', 'mp234123222', 'Октябрьское РОВД', '0000-00-00 00:00:00', '2014-10-26 22:36:33', NULL, NULL, NULL, 0, 1, '', '', '', '', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, '', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, '', 0, '', 1, '', 0, 0, 'a2lf5qv9o7v', '', 0),
('g8bdpctjtcd', 0, 0, '34324234234', '23423432@34343.ru', '432432432432', '32432432432', 'fe8dbfd8f8f18d3d9f83a80864304682', NULL, 'user', '324324234', '324324', '0000-00-00 00:00:00', '2014-09-11 06:55:57', NULL, NULL, NULL, 0, 1, '', '', '', '', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, '', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, '', 0, '', 1, '', 0, 0, 'g8bdpctjtcd', '', 0),
('wz9j7w5o4f', 0, 0, '34324234234', 'mshnek@inbox.ru', '432432432432', 'b-r Priberznskiy, d. 28, kv. 24.', '0c4eeb3e120f767179bba8c633991d15', NULL, 'user', '345423', '4324324', '0000-00-00 00:00:00', '2014-10-26 22:41:21', NULL, NULL, NULL, 0, 1, '', '', '', '', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, '', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, '', 0, '', 1, '', 0, 0, 'wz9j7w5o4f', '', 0);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
