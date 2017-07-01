-- phpMyAdmin SQL Dump
-- version 4.0.10.12
-- http://www.phpmyadmin.net
--
-- Хост: oiseauou.mysql.ukraine.com.ua
-- Время создания: Июл 01 2017 г., 17:24
-- Версия сервера: 5.7.16-10-log
-- Версия PHP: 5.6.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- База данных: `oiseauou_db`
--

-- --------------------------------------------------------

--
-- Структура таблицы `categories`
--

CREATE TABLE IF NOT EXISTS `categories` (
  `category_id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(50) NOT NULL,
  `active` tinyint(4) NOT NULL,
  PRIMARY KEY (`category_id`),
  KEY `category_id` (`category_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=5 ;

--
-- Дамп данных таблицы `categories`
--

INSERT INTO `categories` (`category_id`, `name`, `active`) VALUES
(1, 'Промышленные швейные нитки', 1),
(2, 'Нитки для розничной торговли', 1),
(3, 'Фурнитура', 1),
(4, 'Прочее', 1);

-- --------------------------------------------------------

--
-- Структура таблицы `contacts`
--

CREATE TABLE IF NOT EXISTS `contacts` (
  `contact_id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(50) NOT NULL,
  `email` varchar(50) NOT NULL,
  `text` text NOT NULL,
  `create_date` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `replied` int(11) NOT NULL,
  `replied_date` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`contact_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=7 ;

--
-- Дамп данных таблицы `contacts`
--

INSERT INTO `contacts` (`contact_id`, `name`, `email`, `text`, `create_date`, `replied`, `replied_date`) VALUES
(2, 'Шишик Юлия', 'oiseua@gmail.com', 'Hello!', '2017-07-01 00:00:00', 0, '2017-07-01 00:00:00'),
(3, 'Julia', 'rest@gmail.com', 'Yes!', '2017-07-01 00:00:00', 0, '2017-07-01 00:00:00'),
(4, 'Luda', 'oiseua@gmail.com', 'Way!', '2017-07-01 00:00:00', 0, '2017-07-01 00:00:00'),
(5, 'Julia', 'rest@gmail.com', 'Я рада!', '2017-07-01 00:00:00', 0, '2017-07-01 00:00:00'),
(6, 'Иван', 'ivan@gmail.com', 'Все работает!', '2017-07-01 16:34:30', 0, '2017-07-01 16:34:30');

-- --------------------------------------------------------

--
-- Структура таблицы `groups`
--

CREATE TABLE IF NOT EXISTS `groups` (
  `group_id` int(11) NOT NULL AUTO_INCREMENT,
  `number_of_users` int(11) NOT NULL,
  `number_of_users_in_group` int(11) NOT NULL,
  PRIMARY KEY (`group_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=3 ;

--
-- Дамп данных таблицы `groups`
--

INSERT INTO `groups` (`group_id`, `number_of_users`, `number_of_users_in_group`) VALUES
(1, 1, 0),
(2, 7, 0);

-- --------------------------------------------------------

--
-- Структура таблицы `home_items`
--

CREATE TABLE IF NOT EXISTS `home_items` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(50) NOT NULL,
  `taketo` varchar(50) NOT NULL,
  `image` varchar(50) NOT NULL,
  `homeItems_id` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Структура таблицы `home_slider`
--

CREATE TABLE IF NOT EXISTS `home_slider` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `image` varchar(50) NOT NULL,
  `welcome` varchar(50) NOT NULL,
  `shop` varchar(50) NOT NULL,
  `slider_id` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=4 ;

--
-- Дамп данных таблицы `home_slider`
--

INSERT INTO `home_slider` (`id`, `image`, `welcome`, `shop`, `slider_id`) VALUES
(1, '1.jpg', 'Прекрасное начало', 'Бутик на Островского', 1),
(2, '2.jpg', 'Мы стараемся для Вас!', 'Крестик', 2),
(3, '3.jpg', 'Все в Ваших руках!', 'Вязание и рукоделие', 3);

-- --------------------------------------------------------

--
-- Структура таблицы `items`
--

CREATE TABLE IF NOT EXISTS `items` (
  `item_id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(50) NOT NULL,
  `description` text NOT NULL,
  `image` varchar(100) NOT NULL,
  `price` decimal(10,0) NOT NULL,
  `active` int(11) NOT NULL,
  `create_date` datetime NOT NULL,
  `fk_category_id` int(11) NOT NULL,
  `fk_sub_category_id` int(11) NOT NULL,
  PRIMARY KEY (`item_id`),
  KEY `fk_category_id` (`fk_category_id`),
  KEY `fk_sub_category_id` (`fk_sub_category_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=4 ;

--
-- Дамп данных таблицы `items`
--

INSERT INTO `items` (`item_id`, `title`, `description`, `image`, `price`, `active`, `create_date`, `fk_category_id`, `fk_sub_category_id`) VALUES
(1, 'OMEGA 36 (Джинсовая) ', 'Используется для стачных и декоративных швов, мягкой мебели, кожгалантереи, сумок, рюкзаков, палаток, тентов, одежды из кожи и декоративных швов в верхней одежде.', '1.jpg', '69', 1, '2017-06-26 00:00:00', 1, 1),
(2, 'Стрейч 160', 'Одежда из трикотажа, спортивная одежда, оверлок, корсетные изделия, нижнее белье, купальные костюмы.\r\n', '2.jpg', '60', 1, '2017-06-26 00:00:00', 2, 2),
(3, 'Бисер графит', 'Для оформления розничного заказа необходимо выбрать нужное количество товара', '', '25', 1, '0000-00-00 00:00:00', 3, 3);

-- --------------------------------------------------------

--
-- Структура таблицы `items_to_purchases`
--

CREATE TABLE IF NOT EXISTS `items_to_purchases` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `fk_purchase_id` int(11) NOT NULL,
  `fk_item_id` int(11) NOT NULL,
  `number` int(11) NOT NULL,
  `price` decimal(10,0) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_purchase_id` (`fk_purchase_id`),
  KEY `fk_item_id` (`fk_item_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=25 ;

--
-- Дамп данных таблицы `items_to_purchases`
--

INSERT INTO `items_to_purchases` (`id`, `fk_purchase_id`, `fk_item_id`, `number`, `price`) VALUES
(5, 2, 1, 1, '69'),
(6, 2, 1, 1, '69'),
(7, 3, 1, 1, '69'),
(8, 3, 1, 1, '69'),
(9, 4, 1, 1, '69'),
(10, 4, 1, 1, '69'),
(11, 5, 1, 1, '69'),
(12, 5, 1, 1, '69'),
(13, 6, 1, 1, '69'),
(14, 6, 1, 1, '69'),
(15, 7, 3, 1, '25'),
(16, 7, 3, 1, '25'),
(17, 7, 1, 1, '69'),
(18, 7, 1, 1, '69'),
(19, 7, 1, 1, '69'),
(20, 8, 3, 1, '25'),
(21, 8, 3, 1, '25'),
(22, 8, 1, 1, '69'),
(23, 8, 1, 1, '69'),
(24, 8, 1, 1, '69');

-- --------------------------------------------------------

--
-- Структура таблицы `pages`
--

CREATE TABLE IF NOT EXISTS `pages` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `page` int(11) NOT NULL,
  `title` varchar(50) NOT NULL,
  `description` text NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Структура таблицы `purchases`
--

CREATE TABLE IF NOT EXISTS `purchases` (
  `purchase_id` int(11) NOT NULL AUTO_INCREMENT,
  `fk_user_id` int(11) NOT NULL,
  `amount` int(11) NOT NULL,
  `purchase_date` date NOT NULL,
  `sent_date` date NOT NULL,
  `total_price` int(11) NOT NULL,
  `status` int(11) NOT NULL,
  PRIMARY KEY (`purchase_id`),
  KEY `fk_user_id` (`fk_user_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=9 ;

--
-- Дамп данных таблицы `purchases`
--

INSERT INTO `purchases` (`purchase_id`, `fk_user_id`, `amount`, `purchase_date`, `sent_date`, `total_price`, `status`) VALUES
(1, 7, 4, '0000-00-00', '0000-00-00', 276, 0),
(2, 1, 2, '0000-00-00', '0000-00-00', 138, 0),
(3, 1, 2, '0000-00-00', '0000-00-00', 138, 0),
(4, 1, 2, '0000-00-00', '0000-00-00', 138, 0),
(5, 1, 2, '0000-00-00', '0000-00-00', 138, 0),
(6, 1, 2, '0000-00-00', '0000-00-00', 138, 0),
(7, 5, 5, '0000-00-00', '0000-00-00', 257, 0),
(8, 5, 5, '0000-00-00', '0000-00-00', 257, 0);

-- --------------------------------------------------------

--
-- Структура таблицы `sub_categories`
--

CREATE TABLE IF NOT EXISTS `sub_categories` (
  `sub_category_id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(50) NOT NULL,
  `active` tinyint(4) NOT NULL,
  `fk_category_id` int(11) NOT NULL,
  PRIMARY KEY (`sub_category_id`),
  KEY `fk_category_id` (`fk_category_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=5 ;

--
-- Дамп данных таблицы `sub_categories`
--

INSERT INTO `sub_categories` (`sub_category_id`, `name`, `active`, `fk_category_id`) VALUES
(1, 'Arianna', 1, 1),
(2, 'LUTS', 1, 2),
(3, 'Бисер', 1, 3),
(4, 'Мулине', 1, 3);

-- --------------------------------------------------------

--
-- Структура таблицы `users`
--

CREATE TABLE IF NOT EXISTS `users` (
  `user_id` int(11) NOT NULL AUTO_INCREMENT,
  `login` varchar(30) NOT NULL,
  `password` varchar(50) NOT NULL,
  `first_name` varchar(30) NOT NULL,
  `last_name` varchar(30) NOT NULL,
  `email` text NOT NULL,
  `address` text NOT NULL,
  `phone` char(15) NOT NULL,
  `registration_date` date NOT NULL,
  `active` tinyint(4) NOT NULL,
  `email_code` varchar(11111) NOT NULL,
  `fk_group_id` int(11) NOT NULL,
  PRIMARY KEY (`user_id`),
  KEY `fk_group_id` (`fk_group_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=8 ;

--
-- Дамп данных таблицы `users`
--

INSERT INTO `users` (`user_id`, `login`, `password`, `first_name`, `last_name`, `email`, `address`, `phone`, `registration_date`, `active`, `email_code`, `fk_group_id`) VALUES
(1, 'Oiseau', 'e10adc3949ba59abbe56e057f20f883e', 'Juli', 'Shishik', 'myworkmyrest@gmail.com', 'Bucha', '0507380560', '2017-07-01', 1, 'a4bf2', 1),
(5, 'Ali', 'e10adc3949ba59abbe56e057f20f883e', 'Али', 'Салех', 'oiseua@gmail.com', 'Буча', '11111111111', '2017-07-01', 1, '2d70e', 2),
(6, 'Люда', 'e10adc3949ba59abbe56e057f20f883e', 'Luda', 'Luda', 'Luda@gmail.com', 'Kiev', '0666666666', '2017-07-01', 1, 'c0325', 2),
(7, 'Ivan', 'e10adc3949ba59abbe56e057f20f883e', 'Иван', 'Шишик', 'ivan@gmail.com', 'Днепр', '0667778899', '0000-00-00', 1, 'cf76d', 2);

--
-- Ограничения внешнего ключа сохраненных таблиц
--

--
-- Ограничения внешнего ключа таблицы `items_to_purchases`
--
ALTER TABLE `items_to_purchases`
  ADD CONSTRAINT `items_to_purchases_ibfk_1` FOREIGN KEY (`fk_item_id`) REFERENCES `items` (`item_id`),
  ADD CONSTRAINT `items_to_purchases_ibfk_2` FOREIGN KEY (`fk_purchase_id`) REFERENCES `purchases` (`purchase_id`);

--
-- Ограничения внешнего ключа таблицы `purchases`
--
ALTER TABLE `purchases`
  ADD CONSTRAINT `purchases_ibfk_1` FOREIGN KEY (`fk_user_id`) REFERENCES `users` (`user_id`);

--
-- Ограничения внешнего ключа таблицы `sub_categories`
--
ALTER TABLE `sub_categories`
  ADD CONSTRAINT `sub_categories_ibfk_1` FOREIGN KEY (`fk_category_id`) REFERENCES `categories` (`category_id`);

--
-- Ограничения внешнего ключа таблицы `users`
--
ALTER TABLE `users`
  ADD CONSTRAINT `users_ibfk_1` FOREIGN KEY (`fk_group_id`) REFERENCES `groups` (`group_id`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
