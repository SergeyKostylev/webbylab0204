-- phpMyAdmin SQL Dump
-- version 4.7.4
-- https://www.phpmyadmin.net/
--
-- Хост: 127.0.0.1
-- Время создания: Апр 02 2018 г., 17:07
-- Версия сервера: 10.1.29-MariaDB
-- Версия PHP: 7.2.0

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- База данных: `webbylab`
--

-- --------------------------------------------------------

--
-- Структура таблицы `actor`
--

CREATE TABLE `actor` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `actor`
--

INSERT INTO `actor` (`id`, `name`) VALUES
(109, 'Mel Brooks'),
(110, 'Clevon Little'),
(111, 'Harvey Korman'),
(112, 'Gene Wilder'),
(113, 'Slim Pickens'),
(114, 'Madeline Kahn'),
(115, 'Humphrey Bogart'),
(116, 'Ingrid Bergman'),
(117, 'Claude Rains'),
(118, 'Peter Lorre'),
(119, 'Audrey Hepburn'),
(120, 'Cary Grant'),
(121, 'Walter Matthau'),
(122, 'James Coburn'),
(123, 'George Kennedy'),
(124, 'Paul Newman'),
(125, 'Strother Martin'),
(126, 'Robert Redford'),
(127, 'Katherine Ross'),
(128, 'Robert Shaw'),
(129, 'Charles Durning'),
(130, 'Jim Henson'),
(131, 'Frank Oz'),
(132, 'Dave Geolz'),
(133, 'Austin Pendleton'),
(134, 'John Travolta'),
(135, 'Danny DeVito'),
(136, 'Renne Russo'),
(137, 'Gene Hackman'),
(138, 'Dennis Farina'),
(139, 'Joe Pesci'),
(140, 'Marrisa Tomei'),
(141, 'Fred Gwynne'),
(142, 'Lane Smith'),
(143, 'Ralph Macchio'),
(144, 'Russell Crowe'),
(145, 'Joaquin Phoenix'),
(146, 'Connie Nielson'),
(147, 'Harrison Ford'),
(148, 'Mark Hamill'),
(149, 'Carrie Fisher'),
(150, 'Alec Guinness'),
(151, 'James Earl Jones'),
(152, 'Karen Allen'),
(153, 'Nathan Fillion'),
(154, 'Alan Tudyk'),
(155, 'Adam Baldwin'),
(156, 'Ron Glass'),
(157, 'Jewel Staite'),
(158, 'Gina Torres'),
(159, 'Morena Baccarin'),
(160, 'Sean Maher'),
(161, 'Summer Glau'),
(162, 'Chiwetel Ejiofor'),
(163, 'Barbara Hershey'),
(164, 'Dennis Hopper'),
(165, 'Matthew Broderick'),
(166, 'Ally Sheedy'),
(167, 'Dabney Coleman'),
(168, 'John Wood'),
(169, 'Barry Corbin'),
(170, 'Bill Pullman'),
(171, 'John Candy'),
(172, 'Rick Moranis'),
(173, 'Daphne Zuniga'),
(174, 'Joan Rivers'),
(175, 'Kenneth Mars'),
(176, 'Terri Garr'),
(177, 'Peter Boyle'),
(178, 'Val Kilmer'),
(179, 'Gabe Jarret'),
(180, 'Michelle Meyrink'),
(181, 'William Atherton'),
(182, 'Tom Cruise'),
(183, 'Kelly McGillis'),
(184, 'Anthony Edwards'),
(185, 'Tom Skerritt'),
(186, 'Donald Sutherland'),
(187, 'Elliot Gould'),
(188, 'Sally Kellerman'),
(189, 'Robert Duvall'),
(190, 'Carl Reiner'),
(191, 'Eva Marie Saint'),
(192, 'Alan Arkin'),
(193, 'Brian Keith'),
(194, 'Roy Scheider'),
(195, 'Richard Dreyfuss'),
(196, 'Lorraine Gary '),
(197, 'Keir Dullea'),
(198, 'Gary Lockwood'),
(199, 'William Sylvester'),
(200, 'Douglas Rain'),
(201, 'James Stewart'),
(202, 'Josephine Hull'),
(203, 'Peggy Dow'),
(204, 'Charles Drake'),
(205, 'Seth Rogen'),
(206, 'Katherine Heigl'),
(207, 'Paul Rudd'),
(208, 'Leslie Mann'),
(209, 'Ð²Ð°'),
(210, 'Ð°'),
(211, 'Ð²Ñ–'),
(212, 'Ð¹'),
(213, 'Ñ–Ð²'),
(214, 'Ð°Ð°Ð°'),
(215, 'Ñ'),
(216, '1'),
(217, 'az'),
(218, 'a'),
(219, 'Ñ„'),
(220, 'Ñ‹Ð°');

-- --------------------------------------------------------

--
-- Структура таблицы `film`
--

CREATE TABLE `film` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `year` int(4) UNSIGNED NOT NULL,
  `format_id` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `film`
--

INSERT INTO `film` (`id`, `name`, `year`, `format_id`) VALUES
(453, 'Ð°Ð°', 2018, 1),
(454, 'Ñ—', 2018, 1),
(455, 'az', 2018, 1),
(456, 'aaz', 2018, 1),
(457, '1', 2018, 1),
(458, 'ÑÑŠ', 2018, 1),
(459, 'Ð°ÑŠ', 2018, 1);

-- --------------------------------------------------------

--
-- Структура таблицы `film_actor`
--

CREATE TABLE `film_actor` (
  `film_id` int(10) UNSIGNED NOT NULL,
  `actor_id` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `film_actor`
--

INSERT INTO `film_actor` (`film_id`, `actor_id`) VALUES
(453, 213),
(454, 213),
(455, 217),
(456, 218),
(457, 216),
(458, 219),
(459, 220);

-- --------------------------------------------------------

--
-- Структура таблицы `format`
--

CREATE TABLE `format` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `format`
--

INSERT INTO `format` (`id`, `name`) VALUES
(1, 'VHS'),
(2, 'DVD'),
(3, 'Blu-Ray');

--
-- Индексы сохранённых таблиц
--

--
-- Индексы таблицы `actor`
--
ALTER TABLE `actor`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `film`
--
ALTER TABLE `film`
  ADD PRIMARY KEY (`id`),
  ADD KEY `format_id` (`format_id`);

--
-- Индексы таблицы `film_actor`
--
ALTER TABLE `film_actor`
  ADD PRIMARY KEY (`film_id`,`actor_id`),
  ADD KEY `film_actor_ibfk_2` (`actor_id`);

--
-- Индексы таблицы `format`
--
ALTER TABLE `format`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT для сохранённых таблиц
--

--
-- AUTO_INCREMENT для таблицы `actor`
--
ALTER TABLE `actor`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=221;

--
-- AUTO_INCREMENT для таблицы `film`
--
ALTER TABLE `film`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=460;

--
-- AUTO_INCREMENT для таблицы `format`
--
ALTER TABLE `format`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- Ограничения внешнего ключа сохраненных таблиц
--

--
-- Ограничения внешнего ключа таблицы `film`
--
ALTER TABLE `film`
  ADD CONSTRAINT `film_ibfk_1` FOREIGN KEY (`format_id`) REFERENCES `format` (`id`);

--
-- Ограничения внешнего ключа таблицы `film_actor`
--
ALTER TABLE `film_actor`
  ADD CONSTRAINT `film_actor_ibfk_1` FOREIGN KEY (`film_id`) REFERENCES `film` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `film_actor_ibfk_2` FOREIGN KEY (`actor_id`) REFERENCES `actor` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
