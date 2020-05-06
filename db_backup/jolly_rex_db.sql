-- phpMyAdmin SQL Dump
-- version 4.8.3
-- https://www.phpmyadmin.net/
--
-- Хост: localhost
-- Время создания: Ноя 25 2018 г., 20:43
-- Версия сервера: 10.1.36-MariaDB
-- Версия PHP: 7.2.11

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- База данных: `jolly_rex_db`
--

-- --------------------------------------------------------

--
-- Структура таблицы `tbl_admin`
--

CREATE TABLE `tbl_admin` (
  `id` int(11) NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `first_name` varchar(100) DEFAULT NULL,
  `last_name` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `tbl_admin`
--

INSERT INTO `tbl_admin` (`id`, `user_id`, `first_name`, `last_name`) VALUES
(1, 1, 'Lanna', 'Grigoryan');

-- --------------------------------------------------------

--
-- Структура таблицы `tbl_customer`
--

CREATE TABLE `tbl_customer` (
  `id` int(11) NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `first_name` varchar(100) DEFAULT NULL,
  `last_name` varchar(100) DEFAULT NULL,
  `description` text,
  `postal_code` varchar(20) DEFAULT NULL,
  `address` text,
  `phone_number` varchar(30) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `tbl_customer`
--

INSERT INTO `tbl_customer` (`id`, `user_id`, `first_name`, `last_name`, `description`, `postal_code`, `address`, `phone_number`) VALUES
(1, 3, 'Marcus', 'Pizzeli', NULL, NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Структура таблицы `tbl_entertainer`
--

CREATE TABLE `tbl_entertainer` (
  `id` int(11) NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `name` varchar(255) DEFAULT NULL,
  `first_name` varchar(100) DEFAULT NULL,
  `last_name` varchar(100) DEFAULT NULL,
  `support_instant_booking` tinyint(1) DEFAULT NULL,
  `short_description` text,
  `description` text,
  `price_description` text,
  `package_description` text,
  `rating` tinyint(1) DEFAULT NULL,
  `address` text,
  `phone_number` varchar(30) DEFAULT NULL,
  `video` text,
  `postal_code` varchar(20) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `tbl_entertainer`
--

INSERT INTO `tbl_entertainer` (`id`, `user_id`, `name`, `first_name`, `last_name`, `support_instant_booking`, `short_description`, `description`, `price_description`, `package_description`, `rating`, `address`, `phone_number`, `video`, `postal_code`) VALUES
(2, 2, 'Cat Cust', 'Steven', 'Fisher', 1, '<p>Cat Cust company oraganizes birthdays, parties, New Years party.k</p>', '<p>Cat Cust company oraganizes birthdays, parties, New Years party.</p>', '<p><strong>Magic Show</strong></p>\r\n\r\n<p>45 mins &pound;155 (inc. VAT)</p>\r\n\r\n<p>1hr &pound;165 (inc. VAT)</p>\r\n\r\n<p><strong>Entertainers/Magicians</strong></p>\r\n\r\n<p>1hr&pound; 165 (inc. VAT)</p>\r\n\r\n<p>1.5hr &pound;200 (inc. VAT)</p>\r\n\r\n<p>2hrs &pound;230 (inc. VAT)</p>\r\n\r\n<p>Each additional hour&pound;65 (inc. VAT)<br />\r\n&nbsp;</p>\r\n\r\n<p><strong>Themes</strong></p>\r\n\r\n<p>1hr&nbsp;&nbsp; &nbsp;&pound;185 (inc. VAT)<br />\r\n1.5hr&nbsp;&nbsp; &nbsp;&pound;220 (inc. VAT)<br />\r\n2hrs&nbsp;&nbsp; &nbsp;&pound;255 (inc. VAT)<br />\r\nEach additional hour&nbsp;&nbsp; &nbsp;&pound;65 (inc. VAT)<br />\r\nBalloon-green</p>\r\n\r\n<p><br />\r\n<strong>Froggle the Clown</strong></p>\r\n\r\n<p>1hr&nbsp;&nbsp; &nbsp;&pound;175 (inc. VAT)<br />\r\n1.5hr&nbsp;&nbsp; &nbsp;&pound;215 (inc. VAT)<br />\r\n2hrs&nbsp;&nbsp; &nbsp;&pound;245 (inc. VAT)<br />\r\nEach additional hour&nbsp;&nbsp; &nbsp;&pound;65 (inc. VAT)<br />\r\n&nbsp;</p>\r\n\r\n<p><strong>Disco Party</strong></p>\r\n\r\n<p>2hrs&nbsp;&nbsp; &nbsp;&pound;275 (inc. VAT)<br />\r\nEach additional hour&nbsp;&nbsp; &nbsp;&pound;65 (inc. VAT)<br />\r\n&nbsp;</p>\r\n\r\n<p><strong>Face Painting</strong></p>\r\n\r\n<p>2hrs (min 2 hrs)&nbsp;&nbsp; &nbsp; &nbsp; &nbsp;&pound;150 (inc. VAT)<br />\r\ngirl with balloon</p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<p><strong>Babies and Toddlers</strong></p>\r\n\r\n<p>45 mins&nbsp;&nbsp; &nbsp;&pound;150 (inc. VAT)<br />\r\n&nbsp;</p>\r\n\r\n<p><strong>2 Year Old Parties</strong></p>\r\n\r\n<p>1hr&nbsp;&nbsp; &nbsp;&pound;165 (inc. VAT)<br />\r\nMax recommended no. of kids &ndash; 20<br />\r\nWe don&rsquo;t recommend more than 20 children for this party. If however you have more than 20 children, please be aware more time is needed to do balloon models for every child.<br />\r\n&nbsp;</p>\r\n\r\n<p><strong>Bubble and Activity Party</strong></p>\r\n\r\n<p>2hrs&nbsp;&nbsp; &nbsp;&pound;280 (inc. VAT)<br />\r\nEach additional hour&nbsp;&nbsp; &nbsp;&pound;65 (inc. VAT)<br />\r\n&nbsp;</p>\r\n\r\n<p><strong>Games and Dancing Party</strong></p>\r\n\r\n<p>1hr&nbsp;&nbsp; &nbsp;&pound;170 (inc. VAT)<br />\r\n1.5hrs&nbsp;&nbsp; &nbsp;&pound;200 (inc. VAT)<br />\r\n2hrs&nbsp;&nbsp; &nbsp;&pound;235 (inc. VAT)<br />\r\n&nbsp;</p>\r\n\r\n<p><strong>Drama Party</strong></p>\r\n\r\n<p>1hr&nbsp;&nbsp; &nbsp;&pound;185 (inc. VAT)<br />\r\n1.5hr&nbsp;&nbsp; &nbsp;&pound;220 (inc. VAT)<br />\r\n2hrs&nbsp;&nbsp; &nbsp;&pound;255 (inc. VAT)<br />\r\nEach additional hour&nbsp;&nbsp; &nbsp;&pound;65 (inc. VAT)<br />\r\n&nbsp;</p>\r\n\r\n<p><strong>Balloon Modelling Workshops</strong></p>\r\n\r\n<p>1hr&nbsp;&nbsp; &nbsp;&pound;165 (inc. VAT)<br />\r\n1.5hr&nbsp;&nbsp; &nbsp;&pound;200 (inc. VAT)<br />\r\n2hrs&nbsp;&nbsp; &nbsp;&pound;230 (inc. VAT)<br />\r\nEach additional hour&nbsp;&nbsp; &nbsp;&pound;65 (inc. VAT)<br />\r\nThis is for teaching a maximum of 35 people per session.<br />\r\n&nbsp;</p>\r\n\r\n<p><strong>Deluxe Party Package</strong></p>\r\n\r\n<p>2hrs&nbsp;&nbsp; &nbsp;&pound;265 (inc. VAT)<br />\r\nEach additional hour&nbsp;&nbsp; &nbsp;&pound;65 (inc. VAT)<br />\r\n&nbsp;</p>\r\n\r\n<p><strong>Science Party Package</strong></p>\r\n\r\n<p>1hr&nbsp;&nbsp; &nbsp;&pound;200 (inc. VAT)<br />\r\n1.5hrs&nbsp;&nbsp; &nbsp;&pound;235 (inc. VAT)<br />\r\n2hrs&nbsp;&nbsp; &nbsp;&pound;275 (inc. VAT)<br />\r\nEach additional hour&nbsp;&nbsp; &nbsp;&pound;65 (Inc. VAT)</p>\r\n\r\n<p><strong>Santa/ Elf Appearance</strong></p>\r\n\r\n<p>30 mins&nbsp;&nbsp; &nbsp;&pound;150 (inc. VAT)</p>\r\n', '<p><strong><span style=\"color:#3498db\">Bronze 550</span></strong></p>\r\n\r\n<p><strong><span style=\"color:#3498db\">Great value for money with everything included!</span></strong></p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<p>This is ideal if you&#39;re looking for a package which covers everything at a great price! With a dedicated party planner, you&#39;ll have everything done for you while you can be safe in the</p>\r\n\r\n<p>knowledge that we are busy creating a fantastic party!</p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<p><span style=\"color:#9b59b6\">Package includes:</span></p>\r\n\r\n<ul>\r\n	<li>\r\n	<p><span style=\"color:#9b59b6\">Dedicated Party Planner to arrange your party</span></p>\r\n	</li>\r\n	<li>\r\n	<p><span style=\"color:#9b59b6\">Party Entertainer (1.5 hours)</span></p>\r\n	</li>\r\n	<li>\r\n	<p><span style=\"color:#9b59b6\">Catering- party food packs for each child including selection of sandwiches, crisps, vegetable crudites, fruit, chocolate mini rolls, juice pack, water</span></p>\r\n	</li>\r\n	<li>\r\n	<p><span style=\"color:#9b59b6\">Birthday balloons and decorations</span></p>\r\n	</li>\r\n	<li>\r\n	<p><span style=\"color:#9b59b6\">Birthday cake saying &#39;Happy Birthday&#39; (will feed a party of 28&nbsp;or less), made by our resident Artisan Cakemaker &#39;Valerie Rose Cupcakes&#39;</span></p>\r\n	</li>\r\n	<li>\r\n	<p><span style=\"color:#9b59b6\">Music throughout</span></p>\r\n	</li>\r\n	<li>\r\n	<p><span style=\"color:#9b59b6\">Special Party certificates for each child</span></p>\r\n	</li>\r\n</ul>\r\n\r\n<p><strong><span style=\"color:#3498db\">Silver&nbsp;650</span></strong></p>\r\n\r\n<p><strong><span style=\"color:#3498db\">An amazing fully themed party!</span></strong></p>\r\n\r\n<p>Do you have a troupe of daring Pirates? An elegant soiree of Princesses? Or a group of Space Explorers? Poppy&#39;s will theme everything in the party from the decorations to cake, making it a really special option and transporting all of your guests to an amazing world! This option also features a wider range of food and venues to choose from.</p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<p><span style=\"color:#9b59b6\">Package includes:</span></p>\r\n\r\n<ul>\r\n	<li>\r\n	<p><span style=\"color:#9b59b6\">Dedicated Party Planner to arrange your party</span></p>\r\n	</li>\r\n	<li>\r\n	<p><span style=\"color:#9b59b6\">Party Entertainer (1.5 hours)</span></p>\r\n	</li>\r\n	<li>\r\n	<p><span style=\"color:#9b59b6\">Catering- Themed Party food packs for each child including selection of sandwiches, sausage rolls/mozerella sticks/&nbsp;mini pizzas/chicken goujons/fish fingers,&nbsp;vegetable goujons, fruit, mini chocolate rolls, juice pack, water</span></p>\r\n	</li>\r\n	<li>\r\n	<p><span style=\"color:#9b59b6\">Themed birthday balloons and decorations</span></p>\r\n	</li>\r\n	<li>\r\n	<p><span style=\"color:#9b59b6\">Themed birthday cake with personalisation&nbsp;(will feed a party of 28&nbsp;or less), made&nbsp;by our resident Artisan Cakemaker &#39;Valerie Rose Cupcakes&#39;</span></p>\r\n	</li>\r\n	<li>\r\n	<p><span style=\"color:#9b59b6\">Music throughout</span></p>\r\n	</li>\r\n	<li>\r\n	<p><span style=\"color:#9b59b6\">Special Party Certificate for each child</span></p>\r\n	</li>\r\n</ul>\r\n\r\n<p><strong><span style=\"color:#3498db\">Gold</span></strong></p>\r\n\r\n<p><strong><span style=\"color:#3498db\">Looking for something unique?</span></strong></p>\r\n\r\n<p><span style=\"color:#9b59b6\">Want to have a princess party in a real castle? Recreate the Wild West for your Cowboys? Or turn your garden into a fairy wonderland? With Poppy&#39;s, nothing is too imaginative! We can make any birthday dream come true, from a full Mad Hatter Tea Party to an underwater palace. Just give us an idea to start from and we&#39;ll do the rest!</span></p>\r\n\r\n<p><span style=\"color:#9b59b6\">​</span></p>\r\n\r\n<p><span style=\"color:#9b59b6\">This package of course still includes the Party Entertainer, decorations, cake and catering, but everything is down to you- the only limit is your imagination!</span></p>\r\n', 5, '', '', 'https://www.youtube.com/embed/ufySzCCBoaA', NULL),
(3, 9, 'Entertainer 2', 'Michael', 'Adams', NULL, NULL, 'Donec eget orci non erat scelerisque hendrerit non sed mi. Cras id fermentum erat. Proin non bibendum mauris. Pellentesque sit amet augue in lorem malesuada congue ac id est.', NULL, NULL, 1, NULL, NULL, NULL, NULL),
(4, 12, 'Entertainer 3', NULL, NULL, NULL, NULL, 'Donec eget orci non erat scelerisque hendrerit non sed mi. Cras id fermentum erat. Proin non bibendum mauris. Pellentesque sit amet augue in lorem malesuada congue ac id est.', NULL, NULL, 3, NULL, NULL, NULL, NULL),
(5, 13, 'Entertainer 4', NULL, NULL, NULL, NULL, 'Donec eget orci non erat scelerisque hendrerit non sed mi. Cras id fermentum erat. Proin non bibendum mauris. Pellentesque sit amet augue in lorem malesuada congue ac id est.', NULL, NULL, 3, NULL, NULL, NULL, NULL),
(6, 16, 'Entertainer 5', NULL, NULL, NULL, NULL, 'Donec eget orci non erat scelerisque hendrerit non sed mi. Cras id fermentum erat. Proin non bibendum mauris. Pellentesque sit amet augue in lorem malesuada congue ac id est.', NULL, NULL, 4, NULL, NULL, NULL, NULL),
(7, 27, 'Entertainer 6', NULL, NULL, NULL, NULL, 'Donec eget orci non erat scelerisque hendrerit non sed mi. Cras id fermentum erat. Proin non bibendum mauris. Pellentesque sit amet augue in lorem malesuada congue ac id est.', NULL, NULL, 4, NULL, NULL, NULL, NULL),
(9, 88, 'Cute Girl', 'Sally', 'Brown', 1, NULL, '', '', NULL, 4, NULL, NULL, 'https://www.youtube.com/embed/21RVgBu5o2c', NULL),
(16, 95, 'Sorento', 'Paul', 'Mcbright', 1, '<p>Sorento</p>\r\n', '<p><strong>Sorento</strong></p>\r\n', '<p><strong>Sorento</strong></p>\r\n', '<p><strong>Sorento</strong></p>\r\n', 3, '', '', '', NULL);

-- --------------------------------------------------------

--
-- Структура таблицы `tbl_entertainer_busy_schedule`
--

CREATE TABLE `tbl_entertainer_busy_schedule` (
  `id` int(11) NOT NULL,
  `entertainer_id` int(11) DEFAULT NULL,
  `busy_date` date DEFAULT NULL,
  `busy_start_time` time DEFAULT NULL,
  `busy_end_time` time DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `tbl_entertainer_busy_schedule`
--

INSERT INTO `tbl_entertainer_busy_schedule` (`id`, `entertainer_id`, `busy_date`, `busy_start_time`, `busy_end_time`) VALUES
(1, 2, '2018-09-24', '13:30:00', '14:30:00'),
(2, 2, '2018-09-23', NULL, NULL),
(3, 2, '2018-09-26', '16:30:00', '17:30:00'),
(7, 2, '2018-09-29', NULL, NULL),
(8, 2, '2018-09-30', '19:30:00', '20:30:00');

-- --------------------------------------------------------

--
-- Структура таблицы `tbl_entertainer_orders`
--

CREATE TABLE `tbl_entertainer_orders` (
  `id` int(11) NOT NULL,
  `entertainer_id` int(11) DEFAULT NULL,
  `order_id` int(11) DEFAULT NULL,
  `party_type_id` int(11) DEFAULT NULL,
  `theme_service_id` int(11) NOT NULL DEFAULT '0',
  `additional_service_id` int(11) NOT NULL DEFAULT '0',
  `entertainer_package_id` int(11) DEFAULT NULL,
  `event_date` date DEFAULT NULL,
  `start_time` time DEFAULT NULL,
  `end_time` time DEFAULT NULL,
  `entertainers_count` tinyint(4) DEFAULT NULL,
  `special_requests` text,
  `price` double DEFAULT NULL,
  `price_type` varchar(10) DEFAULT NULL,
  `host_child_age` tinyint(2) DEFAULT NULL,
  `host_child_gender` varchar(10) DEFAULT NULL,
  `host_child_name` varchar(50) DEFAULT NULL,
  `telephone_number` varchar(30) DEFAULT NULL,
  `venue_address` text,
  `post_code` varchar(30) DEFAULT NULL,
  `city` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `tbl_entertainer_orders`
--

INSERT INTO `tbl_entertainer_orders` (`id`, `entertainer_id`, `order_id`, `party_type_id`, `theme_service_id`, `additional_service_id`, `entertainer_package_id`, `event_date`, `start_time`, `end_time`, `entertainers_count`, `special_requests`, `price`, `price_type`, `host_child_age`, `host_child_gender`, `host_child_name`, `telephone_number`, `venue_address`, `post_code`, `city`) VALUES
(14, 2, 10, 1, 8, 14, NULL, '2018-10-18', '15:30:00', '16:30:00', 2, NULL, NULL, 'service', 2, 'male', 'Terry', '+443334433988', 'London Bakery street', 'NW', 'London'),
(15, 2, 58, 3, 0, 0, NULL, '2018-10-19', '16:00:00', '17:00:00', 1, NULL, NULL, 'package', NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(16, 2, 93, 2, 0, 0, NULL, '2018-10-20', '02:46:00', '03:46:00', 3, 'fsd', 255, 'service', 3, 'male', 'Terry', '234', NULL, NULL, NULL),
(17, 2, 94, 1, 0, 0, NULL, '2018-10-24', '21:26:00', '22:26:00', 2, 'test', 720, 'service', 3, 'male', 'Terry', '234', 'Madam Tiuso street', '4236423864', 'London'),
(18, 2, 95, 2, 0, 0, NULL, '2018-10-25', '21:30:00', '22:30:00', 3, 'dfgdg', 415, 'service', 2, 'male', 'Test', '234', NULL, NULL, NULL),
(19, 2, 96, 1, 0, 0, NULL, '2018-10-26', '23:17:00', '00:17:00', 2, 'test', 345, NULL, 3, 'male', 'Terry', '1234', 'test', '462387423684', 'London'),
(20, 2, 97, 3, 0, 0, NULL, '2018-10-26', '23:50:00', '00:50:00', 1, 'Test', 345, NULL, 2, 'male', 'Terry', '234', NULL, NULL, NULL),
(21, 2, 98, 1, 0, 0, NULL, '2018-10-27', '16:41:00', '17:41:00', 2, 'fjhsdjkfh', 345, NULL, 3, 'male', 'Terry', '234', 'Big Bek street', '23562356', 'London'),
(22, 2, 99, 4, 0, 0, NULL, '2018-10-29', '16:46:00', '17:46:00', 1, 'test', 750, NULL, 2, 'male', 'Terry', '234', NULL, NULL, NULL),
(23, 2, 100, 2, 0, 0, NULL, '2018-11-03', '07:25:00', '08:25:00', 2, 'test', 540, NULL, 3, 'male', 'Terry', '234', NULL, NULL, NULL),
(24, 2, 101, 1, 0, 0, NULL, '2018-11-30', '14:00:00', '15:00:00', 2, 'I need entertainer before 15 minutes starting party.', 295, NULL, 3, 'male', 'Terry', '123456789', NULL, NULL, NULL),
(25, 2, 102, 1, 0, 0, NULL, '2018-11-15', '18:29:00', '19:29:00', 1, 'test ', 295, NULL, 3, 'male', 'Terry', '12344', NULL, NULL, NULL),
(26, 2, 103, 1, 0, 0, NULL, '2018-11-22', '19:35:00', '20:35:00', 1, 'trttrttr', 380, NULL, 5, 'male', 'Terry', '12344', NULL, NULL, NULL),
(27, 2, 104, 1, 0, 0, NULL, '2018-11-17', '04:22:00', '05:22:00', 2, 'test', 220, NULL, 2, 'male', 'Terry', '1234535', NULL, NULL, NULL),
(28, 2, 105, 1, 0, 0, NULL, '2018-11-23', '04:40:00', '05:40:00', 1, 'test', 720, NULL, 1, 'male', 'Tom', '123123', 'test address', '004435', 'Yerevan'),
(29, 2, 106, 1, 0, 0, NULL, '2018-11-23', '04:42:00', '05:42:00', 3, 'test', 220, NULL, 2, 'male', 'Tom', '123123', 'test', 'test', 'London'),
(30, 2, 107, 1, 0, 0, NULL, '2018-11-30', '04:47:00', '05:47:00', 3, 'test', 40, NULL, 1, 'male', 'dd', '123123', 'test', '333', 'London'),
(31, 2, 108, 2, 0, 0, NULL, '2018-11-30', '04:51:00', '05:51:00', 1, 'test', 220, NULL, 1, 'male', 'Tom', '1321313', 'test', '322', 'London'),
(32, 2, 109, 1, 0, 0, NULL, '2018-11-18', '04:58:00', '05:58:00', 1, 'test', 170, NULL, 1, 'male', 'Tom', '123123', NULL, NULL, NULL),
(33, 2, 110, 1, 0, 0, NULL, '2018-11-24', '05:05:00', '06:05:00', 2, 'testtest', 345, NULL, 1, 'male', 'Terry', '123123', NULL, NULL, NULL),
(34, 2, 111, 1, 0, 0, NULL, '2018-11-24', '05:05:00', '06:05:00', 2, 'testtest', 345, NULL, 1, 'male', 'Terry', '123123', NULL, NULL, NULL),
(35, 2, 112, 1, 0, 0, NULL, '2018-11-24', '05:05:00', '06:05:00', 2, 'testtest', 345, NULL, 1, 'male', 'Terry', '123123', NULL, NULL, NULL),
(36, 2, 113, 3, 8, 14, NULL, '2018-11-23', '22:24:00', '23:24:00', 2, 'test', 180, NULL, 1, 'male', 'Terry', '+44555667775', NULL, NULL, NULL),
(37, 2, 114, 3, 8, 14, NULL, '2018-11-23', '22:24:00', '23:24:00', 2, 'test', 180, NULL, 1, 'male', 'Terry', '+44555667775', NULL, NULL, NULL),
(38, 2, 120, 3, 8, 14, NULL, '2018-11-24', '22:58:00', '23:58:00', 2, 'test', 180, NULL, 1, 'male', 'Tom', '12322', NULL, NULL, NULL),
(39, 2, 121, 3, 8, 14, NULL, '2018-11-24', '22:58:00', '23:58:00', 2, 'test', 180, NULL, 1, 'male', 'Tom', '12322', NULL, NULL, NULL),
(40, 2, 122, 3, 8, 14, NULL, '2018-11-24', '22:58:00', '23:58:00', 2, 'test', 180, NULL, 1, 'male', 'Tom', '12322', NULL, NULL, NULL),
(41, 2, 123, 3, 8, 14, NULL, '2018-11-24', '22:58:00', '23:58:00', 2, 'test', 180, NULL, 1, 'male', 'Tom', '12322', NULL, NULL, NULL),
(42, 2, 124, 3, 8, 14, NULL, '2018-11-24', '22:58:00', '23:58:00', 2, 'test', 180, NULL, 1, 'male', 'Tom', '12322', NULL, NULL, '');

-- --------------------------------------------------------

--
-- Структура таблицы `tbl_entertainer_order_prices`
--

CREATE TABLE `tbl_entertainer_order_prices` (
  `id` int(11) NOT NULL,
  `entertainer_id` int(11) DEFAULT NULL,
  `customer_id` int(11) DEFAULT NULL,
  `order_id` int(11) DEFAULT NULL,
  `entertainer_service_id` int(11) DEFAULT '0',
  `extra_guest_count` tinyint(3) NOT NULL,
  `service_type` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `tbl_entertainer_order_prices`
--

INSERT INTO `tbl_entertainer_order_prices` (`id`, `entertainer_id`, `customer_id`, `order_id`, `entertainer_service_id`, `extra_guest_count`, `service_type`) VALUES
(1, 2, 3, 10, 1, 0, 'theme'),
(2, 2, 3, 10, 5, 0, 'theme'),
(10, 2, 3, 62, 1, 0, ''),
(11, 2, 3, 62, 8, 0, ''),
(12, 2, 3, 63, 7, 0, ''),
(13, 2, 3, 63, 8, 0, ''),
(14, 2, 3, 64, 7, 0, ''),
(15, 2, 3, 65, 3, 0, ''),
(16, 2, 3, 66, 1, 0, ''),
(17, 2, 3, 66, 8, 0, ''),
(18, 2, 3, 67, 1, 0, ''),
(19, 2, 3, 68, 1, 0, ''),
(20, 2, 3, 68, 9, 0, ''),
(21, 2, 3, 69, 2, 0, ''),
(22, 2, 3, 69, 8, 0, ''),
(23, 2, 3, 69, 9, 0, ''),
(24, 2, 3, 70, 2, 0, ''),
(25, 2, 3, 70, 9, 0, ''),
(26, 2, 3, 71, 2, 0, ''),
(27, 2, 3, 71, 9, 0, ''),
(28, 2, 3, 72, 1, 0, ''),
(29, 2, 3, 72, 9, 0, ''),
(30, 2, 3, 73, 1, 0, ''),
(31, 2, 3, 73, 9, 0, ''),
(32, 2, 3, 74, 7, 0, ''),
(33, 2, 3, 74, 9, 0, ''),
(34, 2, 3, 75, 1, 0, ''),
(35, 2, 3, 76, 1, 0, ''),
(36, 2, 3, 77, 4, 0, ''),
(37, 2, 3, 78, 1, 0, ''),
(38, 2, 3, 78, 5, 0, ''),
(39, 2, 3, 81, 7, 0, ''),
(40, 2, 3, 81, 8, 0, ''),
(41, 2, 3, 82, 7, 0, ''),
(42, 2, 3, 83, 1, 0, ''),
(43, 2, 3, 83, 6, 0, ''),
(44, 2, 3, 84, 7, 0, ''),
(45, 2, 3, 85, 1, 0, ''),
(46, 2, 3, 85, 9, 0, ''),
(47, 2, 3, 86, 1, 0, ''),
(48, 2, 3, 87, 1, 0, ''),
(49, 2, 3, 87, 9, 0, ''),
(50, 2, 3, 88, 9, 0, ''),
(51, 2, 3, 112, 2, 0, ''),
(52, 2, 3, 124, 1, 1, 'theme'),
(53, 2, 3, 124, 5, 0, 'additional_service');

-- --------------------------------------------------------

--
-- Структура таблицы `tbl_entertainer_packages`
--

CREATE TABLE `tbl_entertainer_packages` (
  `id` int(11) NOT NULL,
  `entertainer_id` int(11) DEFAULT NULL,
  `name` varchar(255) DEFAULT NULL,
  `price` double DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `tbl_entertainer_packages`
--

INSERT INTO `tbl_entertainer_packages` (`id`, `entertainer_id`, `name`, `price`) VALUES
(1, 2, 'Bronze', 550),
(2, 2, 'Silver', 650),
(3, 2, 'Gold', 1000);

-- --------------------------------------------------------

--
-- Структура таблицы `tbl_entertainer_party_themes`
--

CREATE TABLE `tbl_entertainer_party_themes` (
  `id` int(11) NOT NULL,
  `entertainer_id` int(11) DEFAULT NULL,
  `party_theme_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `tbl_entertainer_party_themes`
--

INSERT INTO `tbl_entertainer_party_themes` (`id`, `entertainer_id`, `party_theme_id`) VALUES
(19, 2, 1),
(24, 2, 3),
(25, 2, 10),
(26, 2, 12),
(27, 2, 13),
(28, 88, 2),
(29, 88, 3),
(30, 88, 4),
(31, 88, 10),
(32, 88, 11),
(33, 2, 4);

-- --------------------------------------------------------

--
-- Структура таблицы `tbl_entertainer_photos`
--

CREATE TABLE `tbl_entertainer_photos` (
  `id` int(11) NOT NULL,
  `entertainer_id` int(11) DEFAULT NULL,
  `photo` varchar(255) DEFAULT NULL,
  `type` varchar(10) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `tbl_entertainer_photos`
--

INSERT INTO `tbl_entertainer_photos` (`id`, `entertainer_id`, `photo`, `type`) VALUES
(1, 2, 'd17860859681309ddc9af1ba159731c2.jpg', 'main'),
(2, 2, '632dbf9e4cfcde0756d30ac9aabcbed9.jpg', 'other'),
(3, 2, 'ce81c8b541b296789d849ed4b4d3d544.jpg', 'other'),
(4, 3, '584a65344b1d1418d03b36444a269b7f.jpg', 'main');

-- --------------------------------------------------------

--
-- Структура таблицы `tbl_entertainer_services`
--

CREATE TABLE `tbl_entertainer_services` (
  `id` int(11) NOT NULL,
  `entertainer_id` int(11) DEFAULT NULL,
  `service_id` int(11) DEFAULT NULL,
  `duration` varchar(255) DEFAULT NULL,
  `count_of_guests` varchar(50) DEFAULT NULL,
  `price` double DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `tbl_entertainer_services`
--

INSERT INTO `tbl_entertainer_services` (`id`, `entertainer_id`, `service_id`, `duration`, `count_of_guests`, `price`) VALUES
(1, 2, 1, '45 min', '1-5', 40),
(2, 2, 1, '1 hour', '1-10', 165),
(3, 2, 2, '1 hour', '1-5', 75),
(4, 2, 2, '2 hour', '1-10', 165),
(5, 2, 5, '1 hour', '1-15', 180),
(6, 2, 6, '2', '1-15', 150),
(7, 2, 3, '1', '1-15', 500),
(8, 2, 7, '1', '1-20', 200),
(9, 2, 8, '1 hour', '1-10', 100),
(10, 2, 9, '30 min', '7', 160),
(11, 2, 10, '1 hour', '>15', 250);

-- --------------------------------------------------------

--
-- Структура таблицы `tbl_entertainer_staff`
--

CREATE TABLE `tbl_entertainer_staff` (
  `id` int(11) NOT NULL,
  `first_name` varchar(100) DEFAULT NULL,
  `last_name` varchar(255) DEFAULT NULL,
  `photo` text,
  `entertainer_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `tbl_entertainer_staff`
--

INSERT INTO `tbl_entertainer_staff` (`id`, `first_name`, `last_name`, `photo`, `entertainer_id`) VALUES
(1, 'Robert', 'Fisher', 'f42da6647c8b8c559afa967302e25bcd.jpg', 2),
(2, 'John', 'Smith', NULL, 2),
(3, 'Alex', 'Body', NULL, 2);

-- --------------------------------------------------------

--
-- Структура таблицы `tbl_food`
--

CREATE TABLE `tbl_food` (
  `id` int(11) NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `name` varchar(255) DEFAULT NULL,
  `description` text,
  `delivery` tinyint(1) DEFAULT NULL,
  `rating` tinyint(1) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `tbl_food`
--

INSERT INTO `tbl_food` (`id`, `user_id`, `name`, `description`, `delivery`, `rating`) VALUES
(1, 93, 'Food Service 1', '<p>This is a Food Service</p>\r\n', 1, 5);

-- --------------------------------------------------------

--
-- Структура таблицы `tbl_food_items`
--

CREATE TABLE `tbl_food_items` (
  `id` int(11) NOT NULL,
  `food_id` int(11) DEFAULT NULL,
  `name` varchar(255) DEFAULT NULL,
  `price` double DEFAULT NULL,
  `image` varchar(500) DEFAULT NULL,
  `description` text,
  `view_count` int(11) DEFAULT NULL,
  `in_stock` tinyint(1) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `tbl_food_items`
--

INSERT INTO `tbl_food_items` (`id`, `food_id`, `name`, `price`, `image`, `description`, `view_count`, `in_stock`) VALUES
(1, 1, 'Cake', 80, 'c05b96a7ed36c373d019c581eccba3c7.jpg', 'This is a cake', NULL, 1),
(2, 1, 'Desert', 120, '6401d18fd44832fe3fb85473cfbb3d30.jpg', 'This a desert', NULL, 1);

-- --------------------------------------------------------

--
-- Структура таблицы `tbl_food_item_photos`
--

CREATE TABLE `tbl_food_item_photos` (
  `id` int(11) NOT NULL,
  `food_item_id` int(11) DEFAULT NULL,
  `photo` varchar(255) DEFAULT NULL,
  `type` varchar(5) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `tbl_food_item_photos`
--

INSERT INTO `tbl_food_item_photos` (`id`, `food_item_id`, `photo`, `type`) VALUES
(1, 1, 'c44976eb2a00f994e88046b824ca3909.jpg', 'other'),
(2, 1, 'a493111c2ec22d297a1fddefc91c1130.jpg', 'main'),
(3, 1, 'd0e3b97acfc677dc51705aab3a7d1d9b.jpg', 'other'),
(4, 1, 'b3156c45432304efb3845ef8512523ff.jpg', 'main'),
(5, 1, 'c05b96a7ed36c373d019c581eccba3c7.jpg', 'main');

-- --------------------------------------------------------

--
-- Структура таблицы `tbl_food_photos`
--

CREATE TABLE `tbl_food_photos` (
  `id` int(11) NOT NULL,
  `food_id` int(11) DEFAULT NULL,
  `photo` varchar(255) DEFAULT NULL,
  `type` varchar(10) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `tbl_food_photos`
--

INSERT INTO `tbl_food_photos` (`id`, `food_id`, `photo`, `type`) VALUES
(4, 1, '6401d18fd44832fe3fb85473cfbb3d30.jpg', 'main'),
(5, 1, '75f5b64899b64abb8e83258af0a6d44b.jpg', 'main'),
(6, 1, '1e5435c1eb4942e9ac137a2017a89916.jpg', 'main'),
(7, 1, '64dcb601375bd051201d383f324e076c.jpg', 'main'),
(8, 1, 'e9031f17c169caff794d4f1415a7a2b9.jpg', 'other'),
(9, 1, 'fbd786ee69cb3b65057b788d93cb78df.jpg', 'main'),
(10, 1, 'a0318c2623ce7d027cffb05a646454ca.jpg', 'main'),
(11, 1, '1a46fee593a02c2ce36abf7a44aa167e.jpg', 'other');

-- --------------------------------------------------------

--
-- Структура таблицы `tbl_orders`
--

CREATE TABLE `tbl_orders` (
  `id` int(11) NOT NULL,
  `customer_id` int(11) DEFAULT NULL,
  `status` varchar(50) DEFAULT NULL,
  `price` double DEFAULT NULL,
  `entertainer_id` int(11) DEFAULT NULL,
  `venue_id` int(11) DEFAULT NULL,
  `food_id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `creator_id` int(11) DEFAULT NULL,
  `created_date` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `tbl_orders`
--

INSERT INTO `tbl_orders` (`id`, `customer_id`, `status`, `price`, `entertainer_id`, `venue_id`, `food_id`, `product_id`, `creator_id`, `created_date`) VALUES
(10, 3, 'current', 220, 2, 1, 0, 0, NULL, '2018-10-18 03:51:27'),
(58, 3, 'current', 550, 2, NULL, 0, 0, NULL, '2018-10-17 03:51:34'),
(93, 3, 'current', 255, 2, NULL, 0, 0, NULL, NULL),
(94, 3, 'current', 720, 2, NULL, 0, 0, NULL, NULL),
(95, 3, 'current', 415, 2, NULL, 0, 0, NULL, NULL),
(96, 3, 'current', 345, 2, NULL, 0, 0, NULL, NULL),
(97, 3, 'current', 345, 2, NULL, 0, 0, NULL, NULL),
(98, 3, 'current', 345, 2, NULL, 0, 0, NULL, NULL),
(99, 3, 'current', 6000, 2, 1, 0, 0, NULL, NULL),
(100, 3, 'current', 540, 2, NULL, 0, 0, NULL, NULL),
(101, 3, 'current', 1720, 2, 1, 0, 0, NULL, NULL),
(102, 3, 'current', 1180, 2, 1, 0, 0, NULL, NULL),
(103, 3, 'current', 380, 2, NULL, 0, 0, NULL, NULL),
(104, 3, 'current', 220, 2, NULL, 0, 0, NULL, NULL),
(105, 3, 'current', 720, 2, NULL, 0, 0, NULL, NULL),
(106, 3, 'current', 220, 2, NULL, 0, 0, NULL, NULL),
(107, 3, 'current', 40, 2, NULL, 0, 0, NULL, NULL),
(108, 3, 'current', 220, 2, NULL, 0, 0, NULL, NULL),
(109, 3, 'current', 170, 2, NULL, 0, 0, NULL, NULL),
(110, 3, 'current', 345, 2, NULL, 0, 0, NULL, NULL),
(111, 3, 'current', 345, 2, NULL, 0, 0, NULL, NULL),
(112, 3, 'current', 345, 2, NULL, 0, 0, NULL, NULL),
(113, 3, 'current', 180, 2, NULL, 0, 0, NULL, NULL),
(114, 3, 'current', 180, 2, NULL, 0, 0, NULL, NULL),
(115, 3, 'current', 250, 2, NULL, 0, 0, NULL, NULL),
(116, 3, 'current', 250, 2, NULL, 0, 0, NULL, NULL),
(117, 3, 'current', 250, 2, NULL, 0, 0, NULL, NULL),
(118, 3, 'current', 250, 2, NULL, 0, 0, NULL, NULL),
(119, 3, 'current', 180, 2, NULL, 0, 0, NULL, NULL),
(120, 3, 'current', 180, 2, NULL, 0, 0, NULL, NULL),
(121, 3, 'current', 180, 2, NULL, 0, 0, NULL, NULL),
(122, 3, 'current', 180, 2, NULL, 0, 0, NULL, NULL),
(123, 3, 'current', 180, 2, NULL, 0, 0, NULL, NULL),
(124, 3, 'active', 180, 2, 1, 0, 0, NULL, NULL);

-- --------------------------------------------------------

--
-- Структура таблицы `tbl_order_food_items`
--

CREATE TABLE `tbl_order_food_items` (
  `id` int(11) NOT NULL,
  `order_id` int(11) DEFAULT NULL,
  `food_id` int(11) DEFAULT NULL,
  `food_item_id` int(11) DEFAULT NULL,
  `count` tinyint(5) DEFAULT NULL,
  `price` double DEFAULT NULL,
  `created_date` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `tbl_order_food_items`
--

INSERT INTO `tbl_order_food_items` (`id`, `order_id`, `food_id`, `food_item_id`, `count`, `price`, `created_date`) VALUES
(1, 10, 1, 1, 1, NULL, NULL),
(2, 10, 1, 2, 1, NULL, NULL);

-- --------------------------------------------------------

--
-- Структура таблицы `tbl_order_product_items`
--

CREATE TABLE `tbl_order_product_items` (
  `id` int(11) NOT NULL,
  `order_id` int(11) DEFAULT NULL,
  `product_id` int(11) DEFAULT NULL,
  `product_item_id` int(11) DEFAULT NULL,
  `price` double DEFAULT NULL,
  `count` tinyint(5) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `tbl_order_product_items`
--

INSERT INTO `tbl_order_product_items` (`id`, `order_id`, `product_id`, `product_item_id`, `price`, `count`) VALUES
(1, 10, 1, 2, NULL, 1);

-- --------------------------------------------------------

--
-- Структура таблицы `tbl_party_theme`
--

CREATE TABLE `tbl_party_theme` (
  `id` int(11) NOT NULL,
  `name` varchar(255) DEFAULT NULL,
  `type` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `tbl_party_theme`
--

INSERT INTO `tbl_party_theme` (`id`, `name`, `type`) VALUES
(1, 'Cars', 'theme'),
(2, 'Clowns', 'theme'),
(3, 'Disco', 'theme'),
(4, 'Disney', 'theme'),
(5, 'Film-making', 'theme'),
(6, 'Harry Potter', 'theme'),
(7, 'Laser Tag', 'theme'),
(8, 'Magic show', 'theme'),
(9, 'Popular Cartoon/Superhero Characters', 'theme'),
(10, 'Princesses/Pirates', 'theme'),
(11, 'Science', 'theme'),
(12, 'Sports (football, swimming, cricket)', 'theme'),
(13, 'Star Wars', 'theme'),
(14, 'Face painting', 'additional_services'),
(15, 'Froggle the Clown', 'theme'),
(16, 'Party bags', 'additional_services');

-- --------------------------------------------------------

--
-- Структура таблицы `tbl_party_type`
--

CREATE TABLE `tbl_party_type` (
  `id` int(11) NOT NULL,
  `name` varchar(255) DEFAULT NULL,
  `type` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `tbl_party_type`
--

INSERT INTO `tbl_party_type` (`id`, `name`, `type`) VALUES
(1, 'Birthday', NULL),
(2, 'Christmas', NULL),
(3, 'Easter', NULL),
(4, 'Christening', NULL),
(5, 'Just for fun', NULL);

-- --------------------------------------------------------

--
-- Структура таблицы `tbl_photographer`
--

CREATE TABLE `tbl_photographer` (
  `id` int(11) NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `first_name` varchar(100) DEFAULT NULL,
  `last_name` varchar(100) DEFAULT NULL,
  `price` double DEFAULT NULL,
  `photo` varchar(100) DEFAULT NULL,
  `created_date` datetime DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `tbl_photographer`
--

INSERT INTO `tbl_photographer` (`id`, `user_id`, `first_name`, `last_name`, `price`, `photo`, `created_date`) VALUES
(1, 100, 'Tom', 'Bright', 30, NULL, '2018-09-21 13:06:43');

-- --------------------------------------------------------

--
-- Структура таблицы `tbl_product`
--

CREATE TABLE `tbl_product` (
  `id` int(11) NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `name` varchar(255) DEFAULT NULL,
  `description` text,
  `delivery` tinyint(4) DEFAULT NULL,
  `rating` tinyint(1) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `tbl_product`
--

INSERT INTO `tbl_product` (`id`, `user_id`, `name`, `description`, `delivery`, `rating`) VALUES
(1, 94, 'Product Service 1', '<p>This is Product Provider</p>\r\n', 1, 5);

-- --------------------------------------------------------

--
-- Структура таблицы `tbl_product_items`
--

CREATE TABLE `tbl_product_items` (
  `id` int(11) NOT NULL,
  `product_id` int(11) DEFAULT NULL,
  `name` varchar(255) DEFAULT NULL,
  `price` double DEFAULT NULL,
  `image` varchar(500) DEFAULT NULL,
  `description` text,
  `view_count` int(11) DEFAULT NULL,
  `in_stock` tinyint(1) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `tbl_product_items`
--

INSERT INTO `tbl_product_items` (`id`, `product_id`, `name`, `price`, `image`, `description`, `view_count`, `in_stock`) VALUES
(2, 1, 'Decoration 1', 120, 'e9b774f3b31a19f3b5fc6d29c4a24ac2.jpg', 'This is a decoration\r\nThis is a decoration\r\nThis is a decoration\r\nThis is a decoration\r\nThis is a decoration\r\nThis is a decoration', NULL, 1),
(3, 1, 'Decoration 2', 50, 'ad2dd188e5b395aa9a011f8140b4c884.jpg', 'This is a decoration', NULL, NULL);

-- --------------------------------------------------------

--
-- Структура таблицы `tbl_product_item_photos`
--

CREATE TABLE `tbl_product_item_photos` (
  `id` int(11) NOT NULL,
  `product_item_id` int(11) DEFAULT NULL,
  `photo` varchar(255) DEFAULT NULL,
  `type` varchar(5) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `tbl_product_item_photos`
--

INSERT INTO `tbl_product_item_photos` (`id`, `product_item_id`, `photo`, `type`) VALUES
(1, 2, '2d05d7b990adbce2a991097758359fa1.jpg', 'main'),
(2, 2, '783cf7f130f81aafa55dcf7ceed82147.jpg', 'main'),
(3, 2, 'f747041cc22536f60df4c0be7914e7b5.jpg', 'main'),
(4, 2, 'e9b774f3b31a19f3b5fc6d29c4a24ac2.jpg', 'main'),
(5, 2, '', 'main'),
(6, 2, '', 'main');

-- --------------------------------------------------------

--
-- Структура таблицы `tbl_product_photos`
--

CREATE TABLE `tbl_product_photos` (
  `id` int(11) NOT NULL,
  `product_id` int(11) DEFAULT NULL,
  `photo` varchar(255) DEFAULT NULL,
  `type` varchar(10) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `tbl_product_photos`
--

INSERT INTO `tbl_product_photos` (`id`, `product_id`, `photo`, `type`) VALUES
(1, 1, 'd156de90e50224bab81ae88b53d2588a.jpg', 'main'),
(2, 2, '125b8e448bcec1ff3e07f6cb67252445.jpg', 'main'),
(3, 2, '460fcf2e7eb9df46b6056f516a8ace6f.jpg', 'other');

-- --------------------------------------------------------

--
-- Структура таблицы `tbl_reviews`
--

CREATE TABLE `tbl_reviews` (
  `id` int(11) NOT NULL,
  `customer_id` int(11) DEFAULT NULL,
  `supplier_id` int(11) DEFAULT NULL,
  `comment` text
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `tbl_reviews`
--

INSERT INTO `tbl_reviews` (`id`, `customer_id`, `supplier_id`, `comment`) VALUES
(7, 5, 2, 'Thank you, amazing!'),
(8, 3, 2, 'Thank you');

-- --------------------------------------------------------

--
-- Структура таблицы `tbl_services`
--

CREATE TABLE `tbl_services` (
  `id` int(11) NOT NULL,
  `party_theme_id` int(11) DEFAULT NULL,
  `name` text,
  `entertainers_number` int(11) DEFAULT '0',
  `base_extra_price` double DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `tbl_services`
--

INSERT INTO `tbl_services` (`id`, `party_theme_id`, `name`, `entertainers_number`, `base_extra_price`) VALUES
(1, 8, 'Entertainers/Magicians - 1 entertainer', 1, 30),
(2, 8, 'Entertainers/Magicians - 2 entertainers', 2, 30),
(3, 8, 'Entertainers/Magicians - 3 entertainers', 3, 15),
(4, 15, 'Froggle the Clown - 1 entertainer', 1, 20),
(5, 14, 'Face Painting', 0, 10),
(6, 15, 'Froggle the Clown - 2 entertainer', 2, 20),
(7, 3, 'Disco', 0, 5),
(8, 10, 'Princesses/Pirates - 1 entertainer', 0, 10),
(9, 16, 'Party bags', 0, 5),
(10, 14, 'Face painting - 2', 0, 10);

-- --------------------------------------------------------

--
-- Структура таблицы `tbl_user`
--

CREATE TABLE `tbl_user` (
  `id` int(11) NOT NULL,
  `email` varchar(200) DEFAULT NULL,
  `password` varchar(32) DEFAULT NULL,
  `status` varchar(20) DEFAULT NULL,
  `user_type_id` int(11) DEFAULT NULL,
  `support_instant_booking` tinyint(1) DEFAULT NULL,
  `rating` int(1) DEFAULT NULL,
  `username` varchar(100) DEFAULT NULL,
  `postal_code` varchar(20) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `tbl_user`
--

INSERT INTO `tbl_user` (`id`, `email`, `password`, `status`, `user_type_id`, `support_instant_booking`, `rating`, `username`, `postal_code`) VALUES
(1, 'admin@gmail.com', '4297f44b13955235245b2497399d7a93', 'Active', 6, NULL, NULL, 'admin', NULL),
(2, 'entertainer@gmail.com', '4297f44b13955235245b2497399d7a93', 'Active', 2, 1, 5, 'fisher', ''),
(3, 'customer@gmail.com', '4297f44b13955235245b2497399d7a93', 'Active', 1, NULL, NULL, 'marcus', NULL),
(4, 'alex.body@gmail.com', '4297f44b13955235245b2497399d7a93', 'Active', 2, NULL, 1, 'alex.body', NULL),
(6, 'venue1@gmail.com', '33421da058b740a997cf427102e59e5c', 'Active', 3, NULL, NULL, 'sally.brown', NULL),
(7, 'katelight@gmail.com', '4297f44b13955235245b2497399d7a93', 'Active', 5, NULL, NULL, 'katelight', NULL),
(8, 'abram.castrol@yahoo.com', '4297f44b13955235245b2497399d7a93', 'Active', 4, NULL, NULL, 'abram.castrol', NULL),
(9, 'michael.adams@gmail.com', '4297f44b13955235245b2497399d7a93', 'Active', 2, NULL, 1, 'michael.adams', NULL),
(88, 'sally@gmail.com', '63ee451939ed580ef3c4b6f0109d1fd0', 'Active', 2, 1, 4, NULL, '12345678'),
(93, 'food_1@gmail.com', '4297f44b13955235245b2497399d7a93', 'Active', 5, NULL, NULL, NULL, NULL),
(94, 'product_1@gmail.com', '4297f44b13955235245b2497399d7a93', 'Active', 5, NULL, NULL, NULL, NULL),
(95, 'entertainer1@gmail.com', '4297f44b13955235245b2497399d7a93', 'Active', 5, NULL, NULL, NULL, NULL),
(96, 'venue_001@gmail.com', '4297f44b13955235245b2497399d7a93', 'Active', 5, NULL, NULL, NULL, NULL),
(97, 'venue_002@gmail.com', '4297f44b13955235245b2497399d7a93', 'Active', 5, NULL, NULL, NULL, NULL),
(98, 'venue_003@gmail.com', '4297f44b13955235245b2497399d7a93', 'Active', 5, NULL, NULL, NULL, NULL),
(99, 'venue_005@gmail.com', '4297f44b13955235245b2497399d7a93', 'Active', 5, NULL, NULL, NULL, NULL),
(100, 'photographer@gmail.com', '4297f44b13955235245b2497399d7a93', NULL, NULL, NULL, NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Структура таблицы `tbl_user_photos`
--

CREATE TABLE `tbl_user_photos` (
  `id` int(11) NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `photo` varchar(255) DEFAULT NULL,
  `type` varchar(10) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `tbl_user_photos`
--

INSERT INTO `tbl_user_photos` (`id`, `user_id`, `photo`, `type`) VALUES
(2, 2, 'c9bb1500cc21fe9942796dc38af70ed8.jpg', 'main'),
(45, NULL, '547d8ee69dbf3965bd2f843b6d719518.jpg', 'main'),
(46, NULL, '312351bff07989769097660a56395065.jpg', 'other'),
(47, NULL, 'ea6b2efbdd4255a9f1b3bbc6399b58f4.jpg', 'other'),
(48, NULL, '3d188212dfa7dac14311dcb5bee75fc5.jpg', 'main'),
(49, NULL, '5531a5834816222280f20d1ef9e95f69.jpg', 'other'),
(50, NULL, '07811dc6c422334ce36a09ff5cd6fe71.jpg', 'other');

-- --------------------------------------------------------

--
-- Структура таблицы `tbl_user_types`
--

CREATE TABLE `tbl_user_types` (
  `id` int(11) NOT NULL,
  `name` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `tbl_user_types`
--

INSERT INTO `tbl_user_types` (`id`, `name`) VALUES
(1, 'Customer'),
(2, 'Entertainer'),
(3, 'Venue Provider'),
(4, 'Party Product Provider'),
(5, 'Food Provider'),
(6, 'Sys Admin'),
(7, 'Photographer');

-- --------------------------------------------------------

--
-- Структура таблицы `tbl_venue`
--

CREATE TABLE `tbl_venue` (
  `id` int(11) NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `name` varchar(255) DEFAULT NULL,
  `short_description` text,
  `description` text,
  `rating` tinyint(1) DEFAULT NULL,
  `price` double DEFAULT NULL,
  `postal_code` varchar(20) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `tbl_venue`
--

INSERT INTO `tbl_venue` (`id`, `user_id`, `name`, `short_description`, `description`, `rating`, `price`, `postal_code`) VALUES
(1, 6, 'London Star', 'This is Venue', '<p>Hall &pound;300/1 hour</p>\r\n\r\n<p>Main room &pound;500/1 hour</p>\r\n\r\n<p>Small room &pound;200/1 hour<img alt=\"\" src=\"C:\\Users\\Public\\Pictures\\Sample Pictures\\Desert.jpg\" /></p>\r\n\r\n<p>One room &pound;500/1 hour</p>\r\n\r\n<p>Second room &pound;700/1 hour</p>\r\n\r\n<hr />\r\n<p><strong>Catering</strong></p>\r\n\r\n<p>&nbsp;In-house catering <s>Allows external catering</s></p>\r\n\r\n<p>Approved caterers only BYO alcohol allowed</p>\r\n\r\n<p>&nbsp;Can provide alcohol&nbsp;Kitchen facilities available</p>\r\n\r\n<p>Can provide halal <s>Can provide kosher</s></p>\r\n\r\n<p>Complimentary water&nbsp;&nbsp;Extensive vegan menu</p>\r\n\r\n<p>&nbsp;Extensive gluten-free menu <s>Complimentary tea and coffee</s></p>\r\n\r\n<p>Buyout fee for external catering</p>\r\n', 5, 100, ''),
(2, 96, 'Venue 001', '', '', 4, 120, '0046'),
(3, 97, 'Venue 002', '', '', 4, 130, ''),
(4, 98, 'Venue 003', '', '', 5, 140, ''),
(5, 99, 'Venue 005', '', '', NULL, NULL, '');

-- --------------------------------------------------------

--
-- Структура таблицы `tbl_venue_options`
--

CREATE TABLE `tbl_venue_options` (
  `id` int(11) NOT NULL,
  `name` varchar(255) DEFAULT NULL,
  `price` double DEFAULT NULL,
  `description` text,
  `hour` int(11) DEFAULT NULL,
  `venue_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `tbl_venue_options`
--

INSERT INTO `tbl_venue_options` (`id`, `name`, `price`, `description`, `hour`, `venue_id`) VALUES
(1, 'Hall', 300, '', 1, 1),
(2, 'Main room', 500, '', 1, 1),
(3, 'Small room', 200, 'blah blah blah', 1, 1),
(4, 'One room', 500, '', 1, 1),
(5, 'Second room', 700, '', 1, 1);

-- --------------------------------------------------------

--
-- Структура таблицы `tbl_venue_orders`
--

CREATE TABLE `tbl_venue_orders` (
  `id` int(11) NOT NULL,
  `venue_id` int(11) DEFAULT NULL,
  `order_id` int(11) DEFAULT NULL,
  `price` double DEFAULT NULL,
  `event_date` date DEFAULT NULL,
  `start_time` time DEFAULT NULL,
  `end_time` time DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `tbl_venue_orders`
--

INSERT INTO `tbl_venue_orders` (`id`, `venue_id`, `order_id`, `price`, `event_date`, `start_time`, `end_time`) VALUES
(1, 1, 124, 200, '2018-11-30', '20:07:00', '21:07:00'),
(2, 1, 10, 130, '2018-11-23', '16:00:00', '17:00:00');

-- --------------------------------------------------------

--
-- Структура таблицы `tbl_venue_photos`
--

CREATE TABLE `tbl_venue_photos` (
  `id` int(11) NOT NULL,
  `venue_id` int(11) DEFAULT NULL,
  `photo` varchar(255) DEFAULT NULL,
  `type` varchar(10) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `tbl_venue_photos`
--

INSERT INTO `tbl_venue_photos` (`id`, `venue_id`, `photo`, `type`) VALUES
(1, 1, 'b5578785160d26bca1d2b7c99c44a5ca.jpg', 'main');

--
-- Индексы сохранённых таблиц
--

--
-- Индексы таблицы `tbl_admin`
--
ALTER TABLE `tbl_admin`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `tbl_customer`
--
ALTER TABLE `tbl_customer`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `tbl_entertainer`
--
ALTER TABLE `tbl_entertainer`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `tbl_entertainer_busy_schedule`
--
ALTER TABLE `tbl_entertainer_busy_schedule`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `tbl_entertainer_orders`
--
ALTER TABLE `tbl_entertainer_orders`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `tbl_entertainer_order_prices`
--
ALTER TABLE `tbl_entertainer_order_prices`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `tbl_entertainer_packages`
--
ALTER TABLE `tbl_entertainer_packages`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `tbl_entertainer_party_themes`
--
ALTER TABLE `tbl_entertainer_party_themes`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `tbl_entertainer_photos`
--
ALTER TABLE `tbl_entertainer_photos`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `tbl_entertainer_services`
--
ALTER TABLE `tbl_entertainer_services`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `tbl_entertainer_staff`
--
ALTER TABLE `tbl_entertainer_staff`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `tbl_food`
--
ALTER TABLE `tbl_food`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `tbl_food_items`
--
ALTER TABLE `tbl_food_items`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `tbl_food_item_photos`
--
ALTER TABLE `tbl_food_item_photos`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `tbl_food_photos`
--
ALTER TABLE `tbl_food_photos`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `tbl_orders`
--
ALTER TABLE `tbl_orders`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `tbl_order_food_items`
--
ALTER TABLE `tbl_order_food_items`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `tbl_order_product_items`
--
ALTER TABLE `tbl_order_product_items`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `tbl_party_theme`
--
ALTER TABLE `tbl_party_theme`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `tbl_party_type`
--
ALTER TABLE `tbl_party_type`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `tbl_photographer`
--
ALTER TABLE `tbl_photographer`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `tbl_product`
--
ALTER TABLE `tbl_product`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `tbl_product_items`
--
ALTER TABLE `tbl_product_items`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `tbl_product_item_photos`
--
ALTER TABLE `tbl_product_item_photos`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `tbl_product_photos`
--
ALTER TABLE `tbl_product_photos`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `tbl_reviews`
--
ALTER TABLE `tbl_reviews`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `tbl_services`
--
ALTER TABLE `tbl_services`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `tbl_user`
--
ALTER TABLE `tbl_user`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `tbl_user_photos`
--
ALTER TABLE `tbl_user_photos`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_photos_user_foreign_key` (`user_id`);

--
-- Индексы таблицы `tbl_user_types`
--
ALTER TABLE `tbl_user_types`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `tbl_venue`
--
ALTER TABLE `tbl_venue`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `tbl_venue_options`
--
ALTER TABLE `tbl_venue_options`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `tbl_venue_orders`
--
ALTER TABLE `tbl_venue_orders`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `tbl_venue_photos`
--
ALTER TABLE `tbl_venue_photos`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT для сохранённых таблиц
--

--
-- AUTO_INCREMENT для таблицы `tbl_admin`
--
ALTER TABLE `tbl_admin`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT для таблицы `tbl_customer`
--
ALTER TABLE `tbl_customer`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT для таблицы `tbl_entertainer`
--
ALTER TABLE `tbl_entertainer`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT для таблицы `tbl_entertainer_busy_schedule`
--
ALTER TABLE `tbl_entertainer_busy_schedule`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT для таблицы `tbl_entertainer_orders`
--
ALTER TABLE `tbl_entertainer_orders`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=43;

--
-- AUTO_INCREMENT для таблицы `tbl_entertainer_order_prices`
--
ALTER TABLE `tbl_entertainer_order_prices`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=54;

--
-- AUTO_INCREMENT для таблицы `tbl_entertainer_packages`
--
ALTER TABLE `tbl_entertainer_packages`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT для таблицы `tbl_entertainer_party_themes`
--
ALTER TABLE `tbl_entertainer_party_themes`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=34;

--
-- AUTO_INCREMENT для таблицы `tbl_entertainer_photos`
--
ALTER TABLE `tbl_entertainer_photos`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT для таблицы `tbl_entertainer_services`
--
ALTER TABLE `tbl_entertainer_services`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT для таблицы `tbl_entertainer_staff`
--
ALTER TABLE `tbl_entertainer_staff`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT для таблицы `tbl_food`
--
ALTER TABLE `tbl_food`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT для таблицы `tbl_food_items`
--
ALTER TABLE `tbl_food_items`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT для таблицы `tbl_food_item_photos`
--
ALTER TABLE `tbl_food_item_photos`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT для таблицы `tbl_food_photos`
--
ALTER TABLE `tbl_food_photos`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT для таблицы `tbl_orders`
--
ALTER TABLE `tbl_orders`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=125;

--
-- AUTO_INCREMENT для таблицы `tbl_order_food_items`
--
ALTER TABLE `tbl_order_food_items`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT для таблицы `tbl_order_product_items`
--
ALTER TABLE `tbl_order_product_items`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT для таблицы `tbl_party_theme`
--
ALTER TABLE `tbl_party_theme`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT для таблицы `tbl_party_type`
--
ALTER TABLE `tbl_party_type`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT для таблицы `tbl_photographer`
--
ALTER TABLE `tbl_photographer`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT для таблицы `tbl_product`
--
ALTER TABLE `tbl_product`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT для таблицы `tbl_product_items`
--
ALTER TABLE `tbl_product_items`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT для таблицы `tbl_product_item_photos`
--
ALTER TABLE `tbl_product_item_photos`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT для таблицы `tbl_product_photos`
--
ALTER TABLE `tbl_product_photos`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT для таблицы `tbl_reviews`
--
ALTER TABLE `tbl_reviews`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT для таблицы `tbl_services`
--
ALTER TABLE `tbl_services`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT для таблицы `tbl_user`
--
ALTER TABLE `tbl_user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=101;

--
-- AUTO_INCREMENT для таблицы `tbl_user_photos`
--
ALTER TABLE `tbl_user_photos`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=51;

--
-- AUTO_INCREMENT для таблицы `tbl_user_types`
--
ALTER TABLE `tbl_user_types`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT для таблицы `tbl_venue`
--
ALTER TABLE `tbl_venue`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT для таблицы `tbl_venue_options`
--
ALTER TABLE `tbl_venue_options`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT для таблицы `tbl_venue_orders`
--
ALTER TABLE `tbl_venue_orders`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT для таблицы `tbl_venue_photos`
--
ALTER TABLE `tbl_venue_photos`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- Ограничения внешнего ключа сохраненных таблиц
--

--
-- Ограничения внешнего ключа таблицы `tbl_user_photos`
--
ALTER TABLE `tbl_user_photos`
  ADD CONSTRAINT `user_photos_user_foreign_key` FOREIGN KEY (`user_id`) REFERENCES `tbl_user` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
