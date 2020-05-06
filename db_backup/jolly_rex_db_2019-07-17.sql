# ************************************************************
# Sequel Pro SQL dump
# Version 4541
#
# http://www.sequelpro.com/
# https://github.com/sequelpro/sequelpro
#
# Host: 127.0.0.1 (MySQL 5.5.5-10.1.36-MariaDB)
# Database: jolly_rex_db
# Generation Time: 2019-07-17 10:18:37 +0000
# ************************************************************


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;


# Dump of table tbl_admin
# ------------------------------------------------------------

DROP TABLE IF EXISTS `tbl_admin`;

CREATE TABLE `tbl_admin` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) DEFAULT NULL,
  `first_name` varchar(100) DEFAULT NULL,
  `last_name` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

LOCK TABLES `tbl_admin` WRITE;
/*!40000 ALTER TABLE `tbl_admin` DISABLE KEYS */;

INSERT INTO `tbl_admin` (`id`, `user_id`, `first_name`, `last_name`)
VALUES
	(1,1,'Lanna','Grigoryan');

/*!40000 ALTER TABLE `tbl_admin` ENABLE KEYS */;
UNLOCK TABLES;


# Dump of table tbl_customer
# ------------------------------------------------------------

DROP TABLE IF EXISTS `tbl_customer`;

CREATE TABLE `tbl_customer` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) DEFAULT NULL,
  `first_name` varchar(100) DEFAULT NULL,
  `last_name` varchar(100) DEFAULT NULL,
  `description` text,
  `postal_code` varchar(20) DEFAULT NULL,
  `address` text,
  `phone_number` varchar(30) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

LOCK TABLES `tbl_customer` WRITE;
/*!40000 ALTER TABLE `tbl_customer` DISABLE KEYS */;

INSERT INTO `tbl_customer` (`id`, `user_id`, `first_name`, `last_name`, `description`, `postal_code`, `address`, `phone_number`)
VALUES
	(3,3,'Marcus','Pizzeli',NULL,NULL,NULL,NULL),
	(4,104,'Customer','Customer',NULL,NULL,NULL,NULL);

/*!40000 ALTER TABLE `tbl_customer` ENABLE KEYS */;
UNLOCK TABLES;


# Dump of table tbl_entertainer
# ------------------------------------------------------------

DROP TABLE IF EXISTS `tbl_entertainer`;

CREATE TABLE `tbl_entertainer` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
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
  `phone_number` varchar(30) DEFAULT NULL,
  `video` text,
  `first_line_address` text,
  `post_code` varchar(30) DEFAULT NULL,
  `area` text,
  `city` text,
  `support_mileage` tinyint(1) DEFAULT NULL,
  `mileage_price` double DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

LOCK TABLES `tbl_entertainer` WRITE;
/*!40000 ALTER TABLE `tbl_entertainer` DISABLE KEYS */;

INSERT INTO `tbl_entertainer` (`id`, `user_id`, `name`, `first_name`, `last_name`, `support_instant_booking`, `short_description`, `description`, `price_description`, `package_description`, `rating`, `phone_number`, `video`, `first_line_address`, `post_code`, `area`, `city`, `support_mileage`, `mileage_price`)
VALUES
	(2,2,'Cat Cust','Steven','Fisher',1,'<p>Cat Cust company oraganizes birthdays, parties, New Years party.k</p>\r\n','<p>Cat Cust company oraganizes birthdays, parties, New Years party.</p>\r\n','<p><strong>Magic Show</strong></p>\r\n\r\n<p>45 mins &pound;155 (inc. VAT)</p>\r\n\r\n<p>1hr &pound;165 (inc. VAT)</p>\r\n\r\n<p><strong>Entertainers/Magicians</strong></p>\r\n\r\n<p>1hr&pound; 165 (inc. VAT)</p>\r\n\r\n<p>1.5hr &pound;200 (inc. VAT)</p>\r\n\r\n<p>2hrs &pound;230 (inc. VAT)</p>\r\n\r\n<p>Each additional hour&pound;65 (inc. VAT)<br />\r\n&nbsp;</p>\r\n\r\n<p><strong>Themes</strong></p>\r\n\r\n<p>1hr&nbsp;&nbsp; &nbsp;&pound;185 (inc. VAT)<br />\r\n1.5hr&nbsp;&nbsp; &nbsp;&pound;220 (inc. VAT)<br />\r\n2hrs&nbsp;&nbsp; &nbsp;&pound;255 (inc. VAT)<br />\r\nEach additional hour&nbsp;&nbsp; &nbsp;&pound;65 (inc. VAT)<br />\r\nBalloon-green</p>\r\n\r\n<p><br />\r\n<strong>Froggle the Clown</strong></p>\r\n\r\n<p>1hr&nbsp;&nbsp; &nbsp;&pound;175 (inc. VAT)<br />\r\n1.5hr&nbsp;&nbsp; &nbsp;&pound;215 (inc. VAT)<br />\r\n2hrs&nbsp;&nbsp; &nbsp;&pound;245 (inc. VAT)<br />\r\nEach additional hour&nbsp;&nbsp; &nbsp;&pound;65 (inc. VAT)<br />\r\n&nbsp;</p>\r\n\r\n<p><strong>Disco Party</strong></p>\r\n\r\n<p>2hrs&nbsp;&nbsp; &nbsp;&pound;275 (inc. VAT)<br />\r\nEach additional hour&nbsp;&nbsp; &nbsp;&pound;65 (inc. VAT)<br />\r\n&nbsp;</p>\r\n\r\n<p><strong>Face Painting</strong></p>\r\n\r\n<p>2hrs (min 2 hrs)&nbsp;&nbsp; &nbsp; &nbsp; &nbsp;&pound;150 (inc. VAT)<br />\r\ngirl with balloon</p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<p><strong>Babies and Toddlers</strong></p>\r\n\r\n<p>45 mins&nbsp;&nbsp; &nbsp;&pound;150 (inc. VAT)<br />\r\n&nbsp;</p>\r\n\r\n<p><strong>2 Year Old Parties</strong></p>\r\n\r\n<p>1hr&nbsp;&nbsp; &nbsp;&pound;165 (inc. VAT)<br />\r\nMax recommended no. of kids &ndash; 20<br />\r\nWe don&rsquo;t recommend more than 20 children for this party. If however you have more than 20 children, please be aware more time is needed to do balloon models for every child.<br />\r\n&nbsp;</p>\r\n\r\n<p><strong>Bubble and Activity Party</strong></p>\r\n\r\n<p>2hrs&nbsp;&nbsp; &nbsp;&pound;280 (inc. VAT)<br />\r\nEach additional hour&nbsp;&nbsp; &nbsp;&pound;65 (inc. VAT)<br />\r\n&nbsp;</p>\r\n\r\n<p><strong>Games and Dancing Party</strong></p>\r\n\r\n<p>1hr&nbsp;&nbsp; &nbsp;&pound;170 (inc. VAT)<br />\r\n1.5hrs&nbsp;&nbsp; &nbsp;&pound;200 (inc. VAT)<br />\r\n2hrs&nbsp;&nbsp; &nbsp;&pound;235 (inc. VAT)<br />\r\n&nbsp;</p>\r\n\r\n<p><strong>Drama Party</strong></p>\r\n\r\n<p>1hr&nbsp;&nbsp; &nbsp;&pound;185 (inc. VAT)<br />\r\n1.5hr&nbsp;&nbsp; &nbsp;&pound;220 (inc. VAT)<br />\r\n2hrs&nbsp;&nbsp; &nbsp;&pound;255 (inc. VAT)<br />\r\nEach additional hour&nbsp;&nbsp; &nbsp;&pound;65 (inc. VAT)<br />\r\n&nbsp;</p>\r\n\r\n<p><strong>Balloon Modelling Workshops</strong></p>\r\n\r\n<p>1hr&nbsp;&nbsp; &nbsp;&pound;165 (inc. VAT)<br />\r\n1.5hr&nbsp;&nbsp; &nbsp;&pound;200 (inc. VAT)<br />\r\n2hrs&nbsp;&nbsp; &nbsp;&pound;230 (inc. VAT)<br />\r\nEach additional hour&nbsp;&nbsp; &nbsp;&pound;65 (inc. VAT)<br />\r\nThis is for teaching a maximum of 35 people per session.<br />\r\n&nbsp;</p>\r\n\r\n<p><strong>Deluxe Party Package</strong></p>\r\n\r\n<p>2hrs&nbsp;&nbsp; &nbsp;&pound;265 (inc. VAT)<br />\r\nEach additional hour&nbsp;&nbsp; &nbsp;&pound;65 (inc. VAT)<br />\r\n&nbsp;</p>\r\n\r\n<p><strong>Science Party Package</strong></p>\r\n\r\n<p>1hr&nbsp;&nbsp; &nbsp;&pound;200 (inc. VAT)<br />\r\n1.5hrs&nbsp;&nbsp; &nbsp;&pound;235 (inc. VAT)<br />\r\n2hrs&nbsp;&nbsp; &nbsp;&pound;275 (inc. VAT)<br />\r\nEach additional hour&nbsp;&nbsp; &nbsp;&pound;65 (Inc. VAT)</p>\r\n\r\n<p><strong>Santa/ Elf Appearance</strong></p>\r\n\r\n<p>30 mins&nbsp;&nbsp; &nbsp;&pound;150 (inc. VAT)</p>\r\n','<p><strong><span style=\"color:#3498db\">Bronze 550</span></strong></p>\r\n\r\n<p><strong><span style=\"color:#3498db\">Great value for money with everything included!</span></strong></p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<p>This is ideal if you&#39;re looking for a package which covers everything at a great price! With a dedicated party planner, you&#39;ll have everything done for you while you can be safe in the</p>\r\n\r\n<p>knowledge that we are busy creating a fantastic party!</p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<p><span style=\"color:#9b59b6\">Package includes:</span></p>\r\n\r\n<ul>\r\n	<li>\r\n	<p><span style=\"color:#9b59b6\">Dedicated Party Planner to arrange your party</span></p>\r\n	</li>\r\n	<li>\r\n	<p><span style=\"color:#9b59b6\">Party Entertainer (1.5 hours)</span></p>\r\n	</li>\r\n	<li>\r\n	<p><span style=\"color:#9b59b6\">Catering- party food packs for each child including selection of sandwiches, crisps, vegetable crudites, fruit, chocolate mini rolls, juice pack, water</span></p>\r\n	</li>\r\n	<li>\r\n	<p><span style=\"color:#9b59b6\">Birthday balloons and decorations</span></p>\r\n	</li>\r\n	<li>\r\n	<p><span style=\"color:#9b59b6\">Birthday cake saying &#39;Happy Birthday&#39; (will feed a party of 28&nbsp;or less), made by our resident Artisan Cakemaker &#39;Valerie Rose Cupcakes&#39;</span></p>\r\n	</li>\r\n	<li>\r\n	<p><span style=\"color:#9b59b6\">Music throughout</span></p>\r\n	</li>\r\n	<li>\r\n	<p><span style=\"color:#9b59b6\">Special Party certificates for each child</span></p>\r\n	</li>\r\n</ul>\r\n\r\n<p><strong><span style=\"color:#3498db\">Silver&nbsp;650</span></strong></p>\r\n\r\n<p><strong><span style=\"color:#3498db\">An amazing fully themed party!</span></strong></p>\r\n\r\n<p>Do you have a troupe of daring Pirates? An elegant soiree of Princesses? Or a group of Space Explorers? Poppy&#39;s will theme everything in the party from the decorations to cake, making it a really special option and transporting all of your guests to an amazing world! This option also features a wider range of food and venues to choose from.</p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<p><span style=\"color:#9b59b6\">Package includes:</span></p>\r\n\r\n<ul>\r\n	<li>\r\n	<p><span style=\"color:#9b59b6\">Dedicated Party Planner to arrange your party</span></p>\r\n	</li>\r\n	<li>\r\n	<p><span style=\"color:#9b59b6\">Party Entertainer (1.5 hours)</span></p>\r\n	</li>\r\n	<li>\r\n	<p><span style=\"color:#9b59b6\">Catering- Themed Party food packs for each child including selection of sandwiches, sausage rolls/mozerella sticks/&nbsp;mini pizzas/chicken goujons/fish fingers,&nbsp;vegetable goujons, fruit, mini chocolate rolls, juice pack, water</span></p>\r\n	</li>\r\n	<li>\r\n	<p><span style=\"color:#9b59b6\">Themed birthday balloons and decorations</span></p>\r\n	</li>\r\n	<li>\r\n	<p><span style=\"color:#9b59b6\">Themed birthday cake with personalisation&nbsp;(will feed a party of 28&nbsp;or less), made&nbsp;by our resident Artisan Cakemaker &#39;Valerie Rose Cupcakes&#39;</span></p>\r\n	</li>\r\n	<li>\r\n	<p><span style=\"color:#9b59b6\">Music throughout</span></p>\r\n	</li>\r\n	<li>\r\n	<p><span style=\"color:#9b59b6\">Special Party Certificate for each child</span></p>\r\n	</li>\r\n</ul>\r\n\r\n<p><strong><span style=\"color:#3498db\">Gold</span></strong></p>\r\n\r\n<p><strong><span style=\"color:#3498db\">Looking for something unique?</span></strong></p>\r\n\r\n<p><span style=\"color:#9b59b6\">Want to have a princess party in a real castle? Recreate the Wild West for your Cowboys? Or turn your garden into a fairy wonderland? With Poppy&#39;s, nothing is too imaginative! We can make any birthday dream come true, from a full Mad Hatter Tea Party to an underwater palace. Just give us an idea to start from and we&#39;ll do the rest!</span></p>\r\n\r\n<p><span style=\"color:#9b59b6\">​</span></p>\r\n\r\n<p><span style=\"color:#9b59b6\">This package of course still includes the Party Entertainer, decorations, cake and catering, but everything is down to you- the only limit is your imagination!</span></p>\r\n',5,'','https://www.youtube.com/embed/ufySzCCBoaA','Egerton 12','W138HQ','Ealing','London',0,NULL),
	(9,88,'Cute Girl','Sally','Brown',1,NULL,'','',NULL,4,NULL,'https://www.youtube.com/embed/21RVgBu5o2c',NULL,NULL,NULL,NULL,0,NULL),
	(18,102,'Entertainer 2','Michael','Adams',0,'<p>Entertainer2&nbsp;company oraganizes birthdays, parties...</p>\r\n','<p>Entertainer2&nbsp;company oraganizes birthdays, parties, New Years parties. You will like it</p>\r\n','<p><strong>Magic Show</strong></p>\r\n\r\n<p>45 mins &pound;155 (inc. VAT)</p>\r\n\r\n<p>1hr &pound;165 (inc. VAT)</p>\r\n\r\n<p><strong>Entertainers/Magicians</strong></p>\r\n\r\n<p>1hr&pound; 165 (inc. VAT)</p>\r\n\r\n<p>1.5hr &pound;200 (inc. VAT)</p>\r\n\r\n<p>2hrs &pound;230 (inc. VAT)</p>\r\n\r\n<p>Each additional hour&pound;65 (inc. VAT)<br />\r\n&nbsp;</p>\r\n\r\n<p><strong>Themes</strong></p>\r\n\r\n<p>1hr&nbsp;&nbsp; &nbsp;&pound;185 (inc. VAT)<br />\r\n1.5hr&nbsp;&nbsp; &nbsp;&pound;220 (inc. VAT)<br />\r\n2hrs&nbsp;&nbsp; &nbsp;&pound;255 (inc. VAT)<br />\r\nEach additional hour&nbsp;&nbsp; &nbsp;&pound;65 (inc. VAT)<br />\r\nBalloon-green</p>\r\n\r\n<p><br />\r\n<strong>Froggle the Clown</strong></p>\r\n\r\n<p>1hr&nbsp;&nbsp; &nbsp;&pound;175 (inc. VAT)<br />\r\n1.5hr&nbsp;&nbsp; &nbsp;&pound;215 (inc. VAT)<br />\r\n2hrs&nbsp;&nbsp; &nbsp;&pound;245 (inc. VAT)<br />\r\nEach additional hour&nbsp;&nbsp; &nbsp;&pound;65 (inc. VAT)<br />\r\n&nbsp;</p>\r\n\r\n<p><strong>Disco Party</strong></p>\r\n\r\n<p>2hrs&nbsp;&nbsp; &nbsp;&pound;275 (inc. VAT)<br />\r\nEach additional hour&nbsp;&nbsp; &nbsp;&pound;65 (inc. VAT)<br />\r\n&nbsp;</p>\r\n\r\n<p><strong>Face Painting</strong></p>\r\n\r\n<p>2hrs (min 2 hrs)&nbsp;&nbsp; &nbsp; &nbsp; &nbsp;&pound;150 (inc. VAT)<br />\r\ngirl with balloon</p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<p><strong>Babies and Toddlers</strong></p>\r\n\r\n<p>45 mins&nbsp;&nbsp; &nbsp;&pound;150 (inc. VAT)<br />\r\n&nbsp;</p>\r\n\r\n<p><strong>2 Year Old Parties</strong></p>\r\n\r\n<p>1hr&nbsp;&nbsp; &nbsp;&pound;165 (inc. VAT)<br />\r\nMax recommended no. of kids &ndash; 20<br />\r\nWe don&rsquo;t recommend more than 20 children for this party. If however you have more than 20 children, please be aware more time is needed to do balloon models for every child.<br />\r\n&nbsp;</p>\r\n\r\n<p><strong>Bubble and Activity Party</strong></p>\r\n\r\n<p>2hrs&nbsp;&nbsp; &nbsp;&pound;280 (inc. VAT)<br />\r\nEach additional hour&nbsp;&nbsp; &nbsp;&pound;65 (inc. VAT)<br />\r\n&nbsp;</p>\r\n\r\n<p><strong>Games and Dancing Party</strong></p>\r\n\r\n<p>1hr&nbsp;&nbsp; &nbsp;&pound;170 (inc. VAT)<br />\r\n1.5hrs&nbsp;&nbsp; &nbsp;&pound;200 (inc. VAT)<br />\r\n2hrs&nbsp;&nbsp; &nbsp;&pound;235 (inc. VAT)<br />\r\n&nbsp;</p>\r\n\r\n<p><strong>Drama Party</strong></p>\r\n\r\n<p>1hr&nbsp;&nbsp; &nbsp;&pound;185 (inc. VAT)<br />\r\n1.5hr&nbsp;&nbsp; &nbsp;&pound;220 (inc. VAT)<br />\r\n2hrs&nbsp;&nbsp; &nbsp;&pound;255 (inc. VAT)<br />\r\nEach additional hour&nbsp;&nbsp; &nbsp;&pound;65 (inc. VAT)<br />\r\n&nbsp;</p>\r\n\r\n<p><strong>Balloon Modelling Workshops</strong></p>\r\n\r\n<p>1hr&nbsp;&nbsp; &nbsp;&pound;165 (inc. VAT)<br />\r\n1.5hr&nbsp;&nbsp; &nbsp;&pound;200 (inc. VAT)<br />\r\n2hrs&nbsp;&nbsp; &nbsp;&pound;230 (inc. VAT)<br />\r\nEach additional hour&nbsp;&nbsp; &nbsp;&pound;65 (inc. VAT)<br />\r\nThis is for teaching a maximum of 35 people per session.<br />\r\n&nbsp;</p>\r\n\r\n<p><strong>Deluxe Party Package</strong></p>\r\n\r\n<p>2hrs&nbsp;&nbsp; &nbsp;&pound;265 (inc. VAT)<br />\r\nEach additional hour&nbsp;&nbsp; &nbsp;&pound;65 (inc. VAT)<br />\r\n&nbsp;</p>\r\n\r\n<p><strong>Science Party Package</strong></p>\r\n\r\n<p>1hr&nbsp;&nbsp; &nbsp;&pound;200 (inc. VAT)<br />\r\n1.5hrs&nbsp;&nbsp; &nbsp;&pound;235 (inc. VAT)<br />\r\n2hrs&nbsp;&nbsp; &nbsp;&pound;275 (inc. VAT)<br />\r\nEach additional hour&nbsp;&nbsp; &nbsp;&pound;65 (Inc. VAT)</p>\r\n\r\n<p><strong>Santa/ Elf Appearance</strong></p>\r\n\r\n<p>30 mins&nbsp;&nbsp; &nbsp;&pound;150 (inc. VAT)</p>\r\n','<p><strong>Bronze 550</strong></p>\r\n\r\n<p><strong>Great value for money with everything included!</strong></p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<p>This is ideal if you&#39;re looking for a package which covers everything at a great price! With a dedicated party planner, you&#39;ll have everything done for you while you can be safe in the</p>\r\n\r\n<p>knowledge that we are busy creating a fantastic party!</p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<p>Package includes:</p>\r\n\r\n<ul>\r\n	<li>\r\n	<p>Dedicated Party Planner to arrange your party</p>\r\n	</li>\r\n	<li>\r\n	<p>Party Entertainer (1.5 hours)</p>\r\n	</li>\r\n	<li>\r\n	<p>Catering- party food packs for each child including selection of sandwiches, crisps, vegetable crudites, fruit, chocolate mini rolls, juice pack, water</p>\r\n	</li>\r\n	<li>\r\n	<p>Birthday balloons and decorations</p>\r\n	</li>\r\n	<li>\r\n	<p>Birthday cake saying &#39;Happy Birthday&#39; (will feed a party of 28&nbsp;or less), made by our resident Artisan Cakemaker &#39;Valerie Rose Cupcakes&#39;</p>\r\n	</li>\r\n	<li>\r\n	<p>Music throughout</p>\r\n	</li>\r\n	<li>\r\n	<p>Special Party certificates for each child</p>\r\n	</li>\r\n</ul>\r\n\r\n<p><strong>Silver&nbsp;650</strong></p>\r\n\r\n<p><strong>An amazing fully themed party!</strong></p>\r\n\r\n<p>Do you have a troupe of daring Pirates? An elegant soiree of Princesses? Or a group of Space Explorers? Poppy&#39;s will theme everything in the party from the decorations to cake, making it a really special option and transporting all of your guests to an amazing world! This option also features a wider range of food and venues to choose from.</p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<p>Package includes:</p>\r\n\r\n<ul>\r\n	<li>\r\n	<p>Dedicated Party Planner to arrange your party</p>\r\n	</li>\r\n	<li>\r\n	<p>Party Entertainer (1.5 hours)</p>\r\n	</li>\r\n	<li>\r\n	<p>Catering- Themed Party food packs for each child including selection of sandwiches, sausage rolls/mozerella sticks/&nbsp;mini pizzas/chicken goujons/fish fingers,&nbsp;vegetable goujons, fruit, mini chocolate rolls, juice pack, water</p>\r\n	</li>\r\n	<li>\r\n	<p>Themed birthday balloons and decorations</p>\r\n	</li>\r\n	<li>\r\n	<p>Themed birthday cake with personalisation&nbsp;(will feed a party of 28&nbsp;or less), made&nbsp;by our resident Artisan Cakemaker &#39;Valerie Rose Cupcakes&#39;</p>\r\n	</li>\r\n	<li>\r\n	<p>Music throughout</p>\r\n	</li>\r\n	<li>\r\n	<p>Special Party Certificate for each child</p>\r\n	</li>\r\n</ul>\r\n\r\n<p><strong>Gold</strong></p>\r\n\r\n<p><strong>Looking for something unique?</strong></p>\r\n\r\n<p>Want to have a princess party in a real castle? Recreate the Wild West for your Cowboys? Or turn your garden into a fairy wonderland? With Poppy&#39;s, nothing is too imaginative! We can make any birthday dream come true, from a full Mad Hatter Tea Party to an underwater palace. Just give us an idea to start from and we&#39;ll do the rest!</p>\r\n\r\n<p>​</p>\r\n\r\n<p>This package of course still includes the Party Entertainer, decorations, cake and catering, but everything is down to you- the only limit is your imagination!</p>\r\n',4,'','','12 Egertion','W138HQ','Ealing','London',1,0.1);

/*!40000 ALTER TABLE `tbl_entertainer` ENABLE KEYS */;
UNLOCK TABLES;


# Dump of table tbl_entertainer_branches
# ------------------------------------------------------------

DROP TABLE IF EXISTS `tbl_entertainer_branches`;

CREATE TABLE `tbl_entertainer_branches` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `first_line_address` text,
  `post_code` varchar(30) DEFAULT NULL,
  `area` text,
  `city` text,
  `note` text,
  `entertainer_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

LOCK TABLES `tbl_entertainer_branches` WRITE;
/*!40000 ALTER TABLE `tbl_entertainer_branches` DISABLE KEYS */;

INSERT INTO `tbl_entertainer_branches` (`id`, `first_line_address`, `post_code`, `area`, `city`, `note`, `entertainer_id`)
VALUES
	(1,'W1W 6SQ, Great Titchfield St, London','W1W6SQ','Greater London','London','',18),
	(2,'1 Kew Rd, Richmond, London TW9 2NQ','TW92NA','Richmond','London','',18),
	(3,'10 Fleet Pl, Farringdon','EC4M7RB','Farringdon','London','',18);

/*!40000 ALTER TABLE `tbl_entertainer_branches` ENABLE KEYS */;
UNLOCK TABLES;


# Dump of table tbl_entertainer_busy_schedule
# ------------------------------------------------------------

DROP TABLE IF EXISTS `tbl_entertainer_busy_schedule`;

CREATE TABLE `tbl_entertainer_busy_schedule` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `entertainer_id` int(11) DEFAULT NULL,
  `busy_date` date DEFAULT NULL,
  `busy_start_time` time DEFAULT NULL,
  `busy_end_time` time DEFAULT NULL,
  `reason` tinyint(1) DEFAULT NULL,
  `order_id` int(11) DEFAULT '0',
  `note` text,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

LOCK TABLES `tbl_entertainer_busy_schedule` WRITE;
/*!40000 ALTER TABLE `tbl_entertainer_busy_schedule` DISABLE KEYS */;

INSERT INTO `tbl_entertainer_busy_schedule` (`id`, `entertainer_id`, `busy_date`, `busy_start_time`, `busy_end_time`, `reason`, `order_id`, `note`)
VALUES
	(46,2,'2019-02-02','13:00:00','15:00:00',3,0,NULL),
	(47,2,'2019-02-06','14:00:00','15:30:00',4,0,NULL),
	(50,2,'2019-02-28','19:06:00','20:06:00',2,0,NULL),
	(65,2,'2019-03-07','16:15:00','17:45:00',2,0,NULL),
	(66,2,'2019-02-27','17:30:00','19:30:00',2,0,NULL),
	(67,2,'2019-03-14','01:33:00','02:33:00',NULL,0,NULL),
	(69,2,'2019-03-18','08:00:00','09:00:00',2,0,NULL),
	(70,2,'2019-03-18','16:15:00','17:30:00',2,0,NULL),
	(71,2,'2019-03-13',NULL,NULL,2,0,NULL),
	(72,2,'2019-03-18','14:00:00','16:00:00',2,0,NULL),
	(74,2,'2019-03-18','19:30:00','20:30:00',4,0,NULL),
	(76,2,'2019-03-13',NULL,NULL,2,0,NULL),
	(77,2,'2019-03-18','18:00:00','19:15:00',2,0,NULL),
	(78,2,'0000-00-00','11:00:00','12:00:00',2,0,NULL),
	(79,2,'2019-03-18','09:30:00','10:45:00',4,0,NULL),
	(80,2,'2019-03-18','08:00:00','09:00:00',2,0,NULL),
	(81,2,'2019-03-18','11:00:00','13:00:00',2,0,NULL),
	(82,2,'2019-03-18','14:00:00','20:00:00',2,0,NULL),
	(83,2,'2019-03-23','11:00:00','13:00:00',2,0,NULL),
	(84,2,'2019-03-23','11:00:00','13:00:00',4,0,NULL),
	(85,2,'2019-03-23','16:00:00','16:30:00',2,0,NULL),
	(86,2,'2019-03-18','20:30:00','22:00:00',4,0,NULL),
	(87,2,'2019-03-30','08:00:00','20:00:00',2,0,NULL),
	(88,2,'2019-04-04','10:00:00','11:00:00',4,0,NULL),
	(89,2,'2019-04-04','18:30:00','19:30:00',4,0,NULL),
	(90,2,'2019-04-04','18:30:00','19:00:00',2,0,NULL),
	(91,2,'2019-04-04','11:30:00','13:00:00',2,0,NULL),
	(92,18,'2019-06-02','12:30:00','13:30:00',2,0,NULL),
	(93,18,'2019-06-02','16:15:00','17:00:00',2,0,NULL),
	(94,18,'2019-06-19','13:45:00','15:30:00',4,0,NULL),
	(95,18,'2019-06-03','12:00:00','13:00:00',4,0,NULL),
	(96,2,'2019-06-14','18:00:00','20:00:00',2,0,NULL),
	(97,2,'2019-06-02',NULL,NULL,2,0,NULL),
	(98,2,'2019-06-01','08:00:00','12:00:00',2,0,NULL),
	(99,2,'2019-06-01','13:45:00','14:15:00',2,0,NULL),
	(100,18,'2019-06-02','08:00:00','11:00:00',2,0,NULL),
	(101,18,'2019-06-05',NULL,NULL,4,0,NULL),
	(102,2,'2019-06-26','18:00:00','19:00:00',4,0,NULL),
	(103,2,'2019-07-18','11:00:00','12:00:00',2,0,NULL);

/*!40000 ALTER TABLE `tbl_entertainer_busy_schedule` ENABLE KEYS */;
UNLOCK TABLES;


# Dump of table tbl_entertainer_busy_schedule_staff
# ------------------------------------------------------------

DROP TABLE IF EXISTS `tbl_entertainer_busy_schedule_staff`;

CREATE TABLE `tbl_entertainer_busy_schedule_staff` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `busy_schedule_id` int(11) DEFAULT NULL,
  `entertainer_staff_id` int(11) DEFAULT NULL,
  `creator_id` int(11) DEFAULT NULL,
  `created_date` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

LOCK TABLES `tbl_entertainer_busy_schedule_staff` WRITE;
/*!40000 ALTER TABLE `tbl_entertainer_busy_schedule_staff` DISABLE KEYS */;

INSERT INTO `tbl_entertainer_busy_schedule_staff` (`id`, `busy_schedule_id`, `entertainer_staff_id`, `creator_id`, `created_date`)
VALUES
	(1,71,1,NULL,NULL),
	(2,71,2,NULL,NULL),
	(3,76,2,NULL,NULL),
	(4,76,3,NULL,NULL),
	(5,69,1,NULL,NULL),
	(6,72,1,NULL,NULL),
	(7,70,1,NULL,NULL),
	(8,77,3,NULL,NULL),
	(9,78,1,NULL,NULL),
	(10,79,3,NULL,NULL),
	(11,80,2,NULL,NULL),
	(12,81,2,NULL,NULL),
	(13,81,3,NULL,NULL),
	(14,82,3,NULL,NULL),
	(15,83,1,NULL,NULL),
	(16,84,2,NULL,NULL),
	(17,85,1,NULL,NULL),
	(18,86,2,NULL,NULL),
	(19,86,3,NULL,NULL),
	(20,87,2,NULL,NULL),
	(21,87,1,NULL,NULL),
	(22,88,2,NULL,NULL),
	(23,89,2,NULL,NULL),
	(24,90,3,NULL,NULL),
	(25,91,3,NULL,NULL),
	(26,92,5,NULL,NULL),
	(27,93,5,NULL,NULL),
	(28,94,4,NULL,NULL),
	(29,95,4,NULL,NULL),
	(30,96,3,NULL,NULL),
	(31,97,3,NULL,NULL),
	(32,98,3,NULL,NULL),
	(33,99,3,NULL,NULL),
	(34,100,5,NULL,NULL),
	(35,101,5,NULL,NULL),
	(36,102,1,NULL,NULL),
	(37,103,1,NULL,NULL);

/*!40000 ALTER TABLE `tbl_entertainer_busy_schedule_staff` ENABLE KEYS */;
UNLOCK TABLES;


# Dump of table tbl_entertainer_enquiries
# ------------------------------------------------------------

DROP TABLE IF EXISTS `tbl_entertainer_enquiries`;

CREATE TABLE `tbl_entertainer_enquiries` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `customer_id` int(11) DEFAULT NULL,
  `entertainer_id` int(11) DEFAULT NULL,
  `option1_date` date DEFAULT NULL,
  `option1_start_time` time DEFAULT NULL,
  `option1_end_time` time DEFAULT NULL,
  `option2_date` date DEFAULT NULL,
  `option2_start_time` time DEFAULT NULL,
  `option2_end_time` time DEFAULT NULL,
  `option3_date` date DEFAULT NULL,
  `option3_start_time` time DEFAULT NULL,
  `option3_end_time` time DEFAULT NULL,
  `party_type_id` int(11) DEFAULT NULL,
  `price` double DEFAULT NULL,
  `host_child_name` varchar(50) DEFAULT NULL,
  `host_child_age` int(11) DEFAULT NULL,
  `host_child_gender` varchar(10) DEFAULT NULL,
  `special_requests` text,
  `title` varchar(10) DEFAULT NULL,
  `name` varchar(30) DEFAULT NULL,
  `email` varchar(100) DEFAULT NULL,
  `telephone_number` varchar(30) DEFAULT NULL,
  `mobile_number` varchar(30) DEFAULT NULL,
  `entertainers_count` tinyint(2) DEFAULT NULL,
  `first_line_address` text,
  `post_code` varchar(30) DEFAULT NULL,
  `area` text,
  `city` text,
  `status` varchar(30) DEFAULT '',
  `theme_service_id` int(11) DEFAULT NULL,
  `extra_option` int(11) DEFAULT NULL,
  `additional_service_id` int(11) DEFAULT NULL,
  `youngest_age` int(11) DEFAULT NULL,
  `oldest_age` int(11) DEFAULT NULL,
  `order_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

LOCK TABLES `tbl_entertainer_enquiries` WRITE;
/*!40000 ALTER TABLE `tbl_entertainer_enquiries` DISABLE KEYS */;

INSERT INTO `tbl_entertainer_enquiries` (`id`, `customer_id`, `entertainer_id`, `option1_date`, `option1_start_time`, `option1_end_time`, `option2_date`, `option2_start_time`, `option2_end_time`, `option3_date`, `option3_start_time`, `option3_end_time`, `party_type_id`, `price`, `host_child_name`, `host_child_age`, `host_child_gender`, `special_requests`, `title`, `name`, `email`, `telephone_number`, `mobile_number`, `entertainers_count`, `first_line_address`, `post_code`, `area`, `city`, `status`, `theme_service_id`, `extra_option`, `additional_service_id`, `youngest_age`, `oldest_age`, `order_id`)
VALUES
	(1,3,18,'2019-05-02','14:15:00','16:15:00','2019-05-01','14:00:00','16:00:00','2019-05-02','18:00:00','20:00:00',1,NULL,'Alex',2,'male','blah',NULL,NULL,NULL,'+443247831764',NULL,4,'first line address','W13H8Q','W13','Earling','to_confirm',NULL,NULL,NULL,NULL,NULL,NULL),
	(2,2,18,'2019-04-21','11:30:00','12:30:00','2019-04-22','11:30:00','12:30:00','2019-04-23','11:30:00','12:30:00',3,NULL,'Andrea',5,'female','test test',NULL,NULL,NULL,'+44312434388',NULL,2,'12 Egerton Gardens ','W13 8HQ','Earling','London','to_confirm',NULL,NULL,NULL,NULL,NULL,NULL),
	(3,3,18,'2019-04-30','14:00:00','15:00:00','2019-05-08','16:00:00','17:00:00','2019-05-02','14:30:00','15:30:00',1,NULL,'Jennifer',6,'female','test',NULL,NULL,NULL,'+44935348753475',NULL,1,'12 Egertone','W138HQ','Ealing','Lodon','to_confirm',NULL,NULL,NULL,NULL,NULL,NULL),
	(4,3,18,'2019-04-27','15:00:00','17:00:00','2019-05-09','16:00:00','18:00:00','2019-05-08','17:00:00','19:00:00',1,NULL,'Terry',2,'male','blah blah blah',NULL,NULL,NULL,'+443334433988',NULL,1,'','','','','to_confirm',NULL,NULL,NULL,NULL,NULL,NULL),
	(5,3,18,'2019-04-26','17:00:00','19:00:00','2019-05-03','17:00:00','19:00:00','2019-05-10','17:00:00','19:00:00',1,NULL,'Natali',2,'female','blah blah blah',NULL,NULL,NULL,'+443312343988',NULL,1,'','','','','to_confirm',NULL,NULL,NULL,NULL,NULL,NULL),
	(6,3,18,'2019-04-26','17:00:00','19:00:00','2019-05-03','17:00:00','19:00:00','2019-05-10','17:00:00','19:00:00',1,NULL,'Natali',2,'female','blah blah blah',NULL,NULL,NULL,'+443312343988',NULL,1,'','','','','to_confirm',NULL,NULL,NULL,NULL,NULL,NULL),
	(7,3,18,'2019-05-11','13:00:00','14:00:00','2019-05-11','14:00:00','15:00:00','2019-05-19','12:00:00','13:00:00',1,NULL,'Terry',3,'male','blah blah blh','Mrs','','kate.smith@gamil.com','+4457645987623','+443312343988',1,'12 Egerton',NULL,'Ealing','London','to_confirm',3,1,NULL,NULL,NULL,NULL),
	(8,3,18,'2019-05-24','16:00:00','17:00:00','2019-05-08','13:00:00','16:00:00','2019-05-30','17:00:00','18:00:00',1,NULL,'Alex',6,'male','blah','Mrs','Evelina','eva.makarevich@gmail.com','+441231313189','+443334433988',1,'12 Egertons',NULL,'Ealing','London','to_confirm',8,NULL,NULL,NULL,NULL,NULL),
	(9,3,18,'2019-05-24','16:00:00','17:00:00','2019-05-08','13:00:00','16:00:00','2019-05-30','17:00:00','18:00:00',1,NULL,'Alex',6,'male','blah','Mrs','Evelina','eva.makarevich@gmail.com','+441231313189','+443334433988',1,'12 Egertons',NULL,'Ealing','London','to_confirm',8,NULL,0,NULL,NULL,NULL),
	(10,3,18,'2019-05-24','16:00:00','17:00:00','2019-05-08','13:00:00','16:00:00','2019-05-30','17:00:00','18:00:00',1,NULL,'Alex',6,'male','blah','Mrs','Evelina','eva.makarevich@gmail.com','+441231313189','+443334433988',1,'12 Egertons',NULL,'Ealing','London','to_confirm',8,NULL,0,NULL,NULL,NULL),
	(11,3,18,'2019-05-24','16:00:00','17:00:00','2019-05-08','13:00:00','16:00:00','2019-05-30','17:00:00','18:00:00',1,NULL,'Alex',6,'male','blah','Mrs','Evelina','eva.makarevich@gmail.com','+441231313189','+443334433988',1,'12 Egertons',NULL,'Ealing','London','to_confirm',8,NULL,NULL,NULL,NULL,NULL),
	(12,3,18,'2019-05-24','16:00:00','17:00:00','2019-05-08','13:00:00','16:00:00','2019-05-30','17:00:00','18:00:00',1,NULL,'Alex',6,'male','blah','Mrs','Evelina','eva.makarevich@gmail.com','+441231313189','+443334433988',1,'12 Egertons',NULL,'Ealing','London','to_confirm',8,NULL,NULL,NULL,NULL,NULL),
	(13,3,18,'2019-05-24','16:00:00','17:00:00','2019-05-08','13:00:00','16:00:00','2019-05-30','17:00:00','18:00:00',1,NULL,'Alex',6,'male','blah','Mrs','Evelina','eva.makarevich@gmail.com','+441231313189','+443334433988',1,'12 Egertons',NULL,'Ealing','London','to_confirm',8,NULL,NULL,NULL,NULL,NULL),
	(14,3,18,'2019-05-24','16:00:00','17:00:00','2019-05-08','13:00:00','16:00:00','2019-05-30','17:00:00','18:00:00',1,NULL,'Alex',6,'male','blah','Mrs','Evelina','eva.makarevich@gmail.com','+441231313189','+443334433988',1,'12 Egertons',NULL,'Ealing','London','to_confirm',NULL,NULL,NULL,NULL,NULL,NULL),
	(15,3,18,'2019-05-24','16:00:00','17:00:00','2019-05-08','13:00:00','16:00:00','2019-05-30','17:00:00','18:00:00',1,NULL,'Alex',6,'male','blah','Mrs','Evelina','eva.makarevich@gmail.com','+441231313189','+443334433988',1,'12 Egertons',NULL,'Ealing','London','to_confirm',NULL,NULL,NULL,NULL,NULL,NULL),
	(16,3,18,'2019-06-06','13:00:00','14:00:00','2019-05-09','16:00:00','17:00:00','2019-05-31','18:00:00','19:00:00',2,NULL,'Terry',2,'male','FSSFSDFSDF','Mr','Steven','steven.gerard@gmail.com','+443498758937','+443334433988',1,'12 Egertons',NULL,'Ealing','London','to_confirm',NULL,NULL,NULL,NULL,NULL,NULL),
	(17,3,18,'2019-06-06','13:00:00','14:00:00','2019-05-09','16:00:00','17:00:00','2019-05-31','18:00:00','19:00:00',2,NULL,'Terry',2,'male','FSSFSDFSDF','Mr','Steven','steven.gerard@gmail.com','+443498758937','+443334433988',1,'12 Egertons',NULL,'Ealing','London','to_confirm',NULL,NULL,NULL,NULL,NULL,NULL),
	(22,3,18,'2019-05-09','18:00:00','20:00:00','2019-05-24','13:00:00','18:00:00','2019-05-17','13:00:00','14:00:00',1,365,'Niki',7,'male','blah','Mrs','Brown','brown@gmail.com','+448723472947','+449587394875',1,'12 Egertons',NULL,'Ealing','London','confirmed',8,1,14,NULL,NULL,219),
	(23,3,18,'2019-05-20','16:00:00','17:00:00','2019-05-21','16:00:00','17:00:00','2019-06-05','17:00:00','18:00:00',1,50.54,'Terry',4,'male','test test','Mr','James Harisson','james.harisson@gmail.com','+444274932874','+44984724723',1,'17 Egerton street',NULL,'Ealing','London','being_discussed',8,NULL,NULL,NULL,NULL,NULL),
	(24,3,18,'2019-05-24','12:00:00','15:00:00','2019-05-25','12:00:00','15:00:00','2019-05-28','12:00:00','15:00:00',1,90.54,'James',3,'male','blah blah blah','Mr','James major','james.cameron@gmail.com','+44234623964','+44234623964',2,'25 Egertons',NULL,'Ealing','London','confirmed',8,NULL,NULL,NULL,NULL,220),
	(25,3,18,'2019-06-04','14:00:00','15:00:00','2019-06-05','14:00:00','15:00:00','2019-06-06','14:00:00','15:00:00',1,155.54,'Terry',2,'male','ddsfsfdsf','Mr','Sally Brown','sally.brown@gmail.com','+44375834787345','+44375834787345',2,'',NULL,'','','confirmed',8,1,NULL,NULL,NULL,222),
	(26,3,18,'2019-06-10','13:00:00','14:00:00','2019-06-11','14:00:00','16:00:00','2019-06-12','15:00:00','16:30:00',1,101.14,'Ann',4,'female','Birthday','Mr','Sally','saly.jones@gmail.com','+4453407543097','+443334433988',1,'Egerton 12',NULL,'Ealing','London','being_discussed',3,NULL,NULL,NULL,NULL,NULL);

/*!40000 ALTER TABLE `tbl_entertainer_enquiries` ENABLE KEYS */;
UNLOCK TABLES;


# Dump of table tbl_entertainer_enquiry_notifications
# ------------------------------------------------------------

DROP TABLE IF EXISTS `tbl_entertainer_enquiry_notifications`;

CREATE TABLE `tbl_entertainer_enquiry_notifications` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `customer_id` int(11) DEFAULT NULL,
  `entertainer_id` int(11) DEFAULT NULL,
  `enquiry_id` int(11) DEFAULT NULL,
  `note` text,
  `creator_id` int(11) DEFAULT NULL,
  `created_date` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `status` varchar(20) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

LOCK TABLES `tbl_entertainer_enquiry_notifications` WRITE;
/*!40000 ALTER TABLE `tbl_entertainer_enquiry_notifications` DISABLE KEYS */;

INSERT INTO `tbl_entertainer_enquiry_notifications` (`id`, `customer_id`, `entertainer_id`, `enquiry_id`, `note`, `creator_id`, `created_date`, `status`)
VALUES
	(2,3,18,22,'Entertainer chose the final date: 2019-05-17 13:00:00 - 14:00:00',NULL,'2019-05-12 21:20:18','active'),
	(3,3,18,22,'fssfsdfsf',NULL,'2019-05-19 18:11:42','pending'),
	(4,3,18,22,'test test test',102,'2019-05-19 18:14:14','pending'),
	(5,3,18,23,' Hi,\n\nIt is not convenient for us selected date times both.\n Our entertainers are busy all these date times.\nLet us share all convenient dates for us:\nMay 20, 2019, 17 : 30 - 18:30\nMay 22, 2019, 16 : 00 - 18: 30\n June 05, 2019, at 16:30 - 18:30\n\nRegards,\nEntertainer 2 Team\n                                ',NULL,'2019-05-19 18:45:12','pending'),
	(6,3,18,23,'OK no problem',102,'2019-05-19 18:55:33','pending'),
	(7,3,18,24,'Entertainer chose the final date: 2019-05-25 12:00:00 - 15:00:00',NULL,'2019-05-20 01:03:55','active'),
	(8,3,18,25,'Entertainer chose the final date: 2019-06-06 14:00:00 - 15:00:00',NULL,'2019-06-03 22:39:52','active'),
	(9,3,18,26,'                                Hi,\n                                It is not convenient for us selected date times both.\n                                Our entertainers are busy all these date times.\n                                Let us share all convenient dates for us:\n                                June 20, 2019, 17 : 30 - 18:30\n                                June 22, 2019, 16 : 00 - 18: 30\n                                June 05, 2019, at 16:30 - 18:30\n\n                                Regards,\n                                Entertainer 2 Team\n                                ',NULL,'2019-06-10 03:37:48','pending'),
	(10,3,18,26,'Hello',102,'2019-06-10 03:38:41','pending');

/*!40000 ALTER TABLE `tbl_entertainer_enquiry_notifications` ENABLE KEYS */;
UNLOCK TABLES;


# Dump of table tbl_entertainer_enquiry_prices
# ------------------------------------------------------------

DROP TABLE IF EXISTS `tbl_entertainer_enquiry_prices`;

CREATE TABLE `tbl_entertainer_enquiry_prices` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `entertainer_id` int(11) DEFAULT NULL,
  `customer_id` int(11) DEFAULT NULL,
  `enquiry_id` int(11) DEFAULT NULL,
  `entertainer_service_id` int(11) DEFAULT '0',
  `extra_guest_count` tinyint(3) NOT NULL,
  `service_type` varchar(100) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

LOCK TABLES `tbl_entertainer_enquiry_prices` WRITE;
/*!40000 ALTER TABLE `tbl_entertainer_enquiry_prices` DISABLE KEYS */;

INSERT INTO `tbl_entertainer_enquiry_prices` (`id`, `entertainer_id`, `customer_id`, `enquiry_id`, `entertainer_service_id`, `extra_guest_count`, `service_type`)
VALUES
	(1,18,3,1,12,0,'theme'),
	(2,18,2,2,12,0,'theme'),
	(3,18,3,3,28,0,'theme'),
	(4,18,3,4,12,0,'theme'),
	(5,18,3,5,12,0,'theme'),
	(6,18,3,6,12,0,'theme'),
	(7,18,3,21,13,0,'theme'),
	(8,18,3,21,26,0,'extra_theme'),
	(9,18,3,21,30,0,'additional_product'),
	(10,18,3,21,29,0,'additional_product'),
	(11,18,3,21,20,0,'additional_product'),
	(12,18,3,22,12,0,'theme'),
	(13,18,3,22,26,0,'extra_theme'),
	(14,18,3,22,30,0,'additional_product'),
	(15,18,3,22,29,0,'additional_product'),
	(16,18,3,22,20,0,'additional_product'),
	(17,18,3,23,12,0,'theme'),
	(18,18,3,23,30,0,'additional_product'),
	(19,18,3,23,29,0,'additional_product'),
	(20,18,3,23,20,0,'additional_product'),
	(21,18,3,24,14,0,'theme'),
	(22,18,3,24,30,0,'additional_product'),
	(23,18,3,24,29,0,'additional_product'),
	(24,18,3,24,20,0,'additional_product'),
	(25,18,3,25,14,0,'theme'),
	(26,18,3,25,26,0,'extra_theme'),
	(27,18,3,25,30,0,'additional_product'),
	(28,18,3,25,29,0,'additional_product'),
	(29,18,3,25,20,0,'additional_product'),
	(30,18,3,26,19,0,'theme'),
	(31,18,3,26,30,0,'additional_product'),
	(32,18,3,26,29,0,'additional_product'),
	(33,18,3,26,20,0,'additional_product');

/*!40000 ALTER TABLE `tbl_entertainer_enquiry_prices` ENABLE KEYS */;
UNLOCK TABLES;


# Dump of table tbl_entertainer_order_notifications
# ------------------------------------------------------------

DROP TABLE IF EXISTS `tbl_entertainer_order_notifications`;

CREATE TABLE `tbl_entertainer_order_notifications` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `entertainer_id` int(11) DEFAULT NULL,
  `customer_id` int(11) DEFAULT NULL,
  `entertainer_order_id` int(11) DEFAULT NULL,
  `to_admin` tinyint(1) DEFAULT NULL,
  `message` text,
  `confirmed_by_admin` int(11) DEFAULT NULL,
  `sent_by_entertainer` tinyint(1) DEFAULT NULL,
  `sent_by_customer` tinyint(1) DEFAULT NULL,
  `created_date` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

LOCK TABLES `tbl_entertainer_order_notifications` WRITE;
/*!40000 ALTER TABLE `tbl_entertainer_order_notifications` DISABLE KEYS */;

INSERT INTO `tbl_entertainer_order_notifications` (`id`, `entertainer_id`, `customer_id`, `entertainer_order_id`, `to_admin`, `message`, `confirmed_by_admin`, `sent_by_entertainer`, `sent_by_customer`, `created_date`)
VALUES
	(1,18,18,46,NULL,'czczxczcz',NULL,1,NULL,'2019-06-17 21:40:50');

/*!40000 ALTER TABLE `tbl_entertainer_order_notifications` ENABLE KEYS */;
UNLOCK TABLES;


# Dump of table tbl_entertainer_order_prices
# ------------------------------------------------------------

DROP TABLE IF EXISTS `tbl_entertainer_order_prices`;

CREATE TABLE `tbl_entertainer_order_prices` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `entertainer_id` int(11) DEFAULT NULL,
  `customer_id` int(11) DEFAULT NULL,
  `order_id` int(11) DEFAULT NULL,
  `entertainer_service_id` int(11) DEFAULT '0',
  `extra_guest_count` tinyint(3) NOT NULL,
  `service_type` varchar(100) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

LOCK TABLES `tbl_entertainer_order_prices` WRITE;
/*!40000 ALTER TABLE `tbl_entertainer_order_prices` DISABLE KEYS */;

INSERT INTO `tbl_entertainer_order_prices` (`id`, `entertainer_id`, `customer_id`, `order_id`, `entertainer_service_id`, `extra_guest_count`, `service_type`)
VALUES
	(1,2,3,10,1,0,'theme'),
	(2,2,3,10,5,0,'theme'),
	(3,2,3,188,8,0,'theme'),
	(4,2,3,189,8,0,'theme'),
	(5,2,3,190,8,0,'theme'),
	(6,2,3,191,8,0,'theme'),
	(7,2,3,192,8,0,'theme'),
	(8,2,3,193,8,0,'theme'),
	(9,2,3,194,8,0,'theme'),
	(10,2,3,195,8,0,'theme'),
	(11,2,3,199,8,0,'theme'),
	(12,2,3,200,2,0,'theme'),
	(13,2,3,201,2,0,'theme'),
	(14,2,3,202,2,0,'theme'),
	(15,2,3,203,2,0,'theme'),
	(16,2,3,204,2,0,'theme'),
	(17,2,3,205,2,0,'theme'),
	(18,2,3,206,2,0,'theme'),
	(19,2,3,207,2,0,'theme'),
	(20,2,3,208,2,0,'theme'),
	(21,2,3,209,2,0,'theme'),
	(22,2,3,210,1,0,'theme'),
	(23,2,3,210,2,0,'theme'),
	(24,2,3,211,8,0,'theme'),
	(25,2,3,212,8,0,'theme'),
	(26,2,3,213,3,0,'theme'),
	(27,2,3,214,2,0,'theme'),
	(28,2,3,214,4,0,'theme'),
	(29,2,3,214,5,0,'additional_service'),
	(30,2,3,215,8,0,'theme'),
	(36,18,3,219,12,0,'theme'),
	(37,18,3,219,26,0,'extra_theme'),
	(38,18,3,219,30,0,'additional_product'),
	(39,18,3,219,29,0,'additional_product'),
	(40,18,3,219,20,0,'additional_product'),
	(41,18,3,220,14,0,'theme'),
	(42,18,3,220,30,0,'additional_product'),
	(43,18,3,220,29,0,'additional_product'),
	(44,18,3,220,20,0,'additional_product'),
	(45,2,3,221,3,0,'theme'),
	(46,18,3,222,14,0,'theme'),
	(47,18,3,222,26,0,'extra_theme'),
	(48,18,3,222,30,0,'additional_product'),
	(49,18,3,222,29,0,'additional_product'),
	(50,18,3,222,20,0,'additional_product'),
	(51,2,3,223,3,0,'theme'),
	(52,2,3,224,3,0,'theme'),
	(53,2,3,225,4,0,'theme'),
	(54,2,3,226,4,0,'theme'),
	(55,2,3,227,4,0,'theme'),
	(56,2,3,228,4,0,'theme'),
	(57,2,3,230,3,0,'theme');

/*!40000 ALTER TABLE `tbl_entertainer_order_prices` ENABLE KEYS */;
UNLOCK TABLES;


# Dump of table tbl_entertainer_orders
# ------------------------------------------------------------

DROP TABLE IF EXISTS `tbl_entertainer_orders`;

CREATE TABLE `tbl_entertainer_orders` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `entertainer_id` int(11) DEFAULT NULL,
  `order_id` int(11) DEFAULT NULL,
  `party_type_id` int(11) DEFAULT NULL,
  `theme_service_id` int(11) NOT NULL DEFAULT '0',
  `additional_service_id` int(11) DEFAULT '0',
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
  `city` varchar(255) DEFAULT NULL,
  `note` text,
  `entertainer_name` varchar(50) DEFAULT NULL,
  `message` text,
  `status` varchar(50) DEFAULT NULL,
  `customer_id` int(11) DEFAULT NULL,
  `info_status` varchar(50) DEFAULT NULL,
  `enquiry_id` int(11) DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

LOCK TABLES `tbl_entertainer_orders` WRITE;
/*!40000 ALTER TABLE `tbl_entertainer_orders` DISABLE KEYS */;

INSERT INTO `tbl_entertainer_orders` (`id`, `entertainer_id`, `order_id`, `party_type_id`, `theme_service_id`, `additional_service_id`, `entertainer_package_id`, `event_date`, `start_time`, `end_time`, `entertainers_count`, `special_requests`, `price`, `price_type`, `host_child_age`, `host_child_gender`, `host_child_name`, `telephone_number`, `venue_address`, `post_code`, `city`, `note`, `entertainer_name`, `message`, `status`, `customer_id`, `info_status`, `enquiry_id`)
VALUES
	(14,2,10,1,8,14,NULL,'2019-02-18','15:30:00','16:30:00',2,'Birthday party, I wanna to make my son day awesome! ',200,'service',2,'male','Terry','+443334433988','London Bakery street','NW','London','<p>Test test test</p>\n\n<p>test test test</p>\n\n<p>test test test</p>\n','John','fdsfsfsf','Pending',3,'Acknowledged',NULL),
	(15,2,188,1,3,NULL,NULL,'2019-01-31','18:16:00','19:16:00',2,'test',200,NULL,2,'male','Tom','+443334433988','27th Bairon street',NULL,'London',NULL,NULL,NULL,'Pending',3,'Unacknowledged',NULL),
	(16,2,189,1,3,NULL,NULL,'2019-01-31','18:16:00','19:16:00',2,'test',200,NULL,2,'male','Tom','+443334433988','27th Bairon street',NULL,'London',NULL,NULL,NULL,'Pending',3,'Unacknowledged',NULL),
	(17,2,190,1,3,NULL,NULL,'2019-01-31','18:16:00','19:16:00',2,'test',200,NULL,2,'male','Tom','+443334433988','27th Bairon street',NULL,'London',NULL,NULL,NULL,'Pending',3,'Unacknowledged',NULL),
	(18,2,191,1,3,NULL,NULL,'2019-01-31','18:16:00','19:16:00',2,'test',200,NULL,2,'male','Tom','+443334433988','27th Bairon street',NULL,'London',NULL,NULL,NULL,'Pending',3,'Unacknowledged',NULL),
	(19,2,192,1,3,NULL,NULL,'2019-01-31','18:16:00','19:16:00',2,'test',200,NULL,2,'male','Tom','+443334433988','27th Bairon street',NULL,'London',NULL,NULL,NULL,'Pending',3,'Unacknowledged',NULL),
	(20,2,193,1,3,NULL,NULL,'2019-01-31','18:16:00','19:16:00',2,'test',200,NULL,2,'male','Tom','+443334433988','27th Bairon street',NULL,'London',NULL,NULL,NULL,'Pending',3,'Unacknowledged',NULL),
	(21,2,194,1,3,NULL,NULL,'2019-01-31','18:16:00','19:16:00',2,'test',200,NULL,2,'male','Tom','+443334433988','27th Bairon street',NULL,'London',NULL,NULL,NULL,'Pending',3,'Unacknowledged',NULL),
	(22,2,195,5,3,NULL,NULL,'2019-02-21','20:16:00','21:16:00',2,'blah blah blah\nblah blah blah\nblah blah blah\n',380,NULL,2,'male','Tom','+443334433988','27th Bairon street',NULL,'London',NULL,NULL,NULL,'Pending',3,'Unacknowledged',NULL),
	(23,2,199,4,3,NULL,NULL,'2019-02-18','16:00:00','17:00:00',1,'test',200,NULL,0,'male','5','+443334433988','27th Bairon street',NULL,'London',NULL,NULL,NULL,'Pending',3,'Unacknowledged',NULL),
	(24,2,200,4,8,NULL,NULL,'2019-02-18','16:00:00','17:00:00',1,'test',165,NULL,0,'female','3','+443334433988','27th Bairon street',NULL,'London',NULL,NULL,NULL,'Pending',3,'Unacknowledged',NULL),
	(25,2,201,4,8,NULL,NULL,'2019-02-18','16:00:00','17:00:00',1,'test',165,NULL,0,'female','3','+443334433988','27th Bairon street',NULL,'London',NULL,NULL,NULL,'Pending',3,'Unacknowledged',NULL),
	(26,2,202,4,8,NULL,NULL,'2019-02-27','16:00:00','17:00:00',1,'test',165,NULL,0,'female','3','+443334433988','27th Bairon street','','London',NULL,NULL,NULL,'Pending',3,'Unacknowledged',NULL),
	(27,2,203,4,8,NULL,NULL,'2019-02-18','16:00:00','17:00:00',1,'test',165,NULL,0,'female','3','+443334433988','27th Bairon street',NULL,'London',NULL,NULL,NULL,'Pending',3,'Unacknowledged',NULL),
	(28,2,204,4,8,NULL,NULL,'2019-02-18','16:00:00','17:00:00',1,'test',165,NULL,0,'female','3','+443334433988','27th Bairon street',NULL,'London',NULL,NULL,NULL,'Pending',3,'Unacknowledged',NULL),
	(29,2,205,4,8,NULL,NULL,'2019-02-18','16:00:00','17:00:00',1,'test',165,NULL,0,'female','3','+443334433988','27th Bairon street',NULL,'London',NULL,NULL,NULL,'Pending',3,'Unacknowledged',NULL),
	(30,2,206,4,8,NULL,NULL,'2019-02-18','16:00:00','17:00:00',1,'test',165,NULL,0,'female','3','+443334433988','27th Bairon street',NULL,'London',NULL,NULL,NULL,'Pending',3,'Unacknowledged',NULL),
	(31,2,207,4,8,NULL,NULL,'2019-02-27','16:00:00','17:00:00',1,'test',165,NULL,0,'female','3','+443334433988','27th Bairon street',NULL,'London',NULL,NULL,NULL,'Pending',3,'Unacknowledged',NULL),
	(32,2,208,4,8,NULL,NULL,'2019-02-18','16:00:00','17:00:00',1,'test',165,NULL,0,'female','3','+443334433988','27th Bairon street',NULL,'London',NULL,NULL,NULL,'Pending',3,'Unacknowledged',NULL),
	(33,2,209,4,8,NULL,NULL,'2019-02-27','16:00:00','17:00:00',1,'test',165,NULL,0,'female','3','+443334433988','27th Bairon street',NULL,'London',NULL,NULL,NULL,'Pending',3,'Unacknowledged',NULL),
	(34,2,210,1,8,NULL,NULL,'2019-04-04','17:30:00','18:30:00',2,'2',245,NULL,2,'male','Terry','+443334433988',NULL,NULL,NULL,NULL,NULL,NULL,'Pending',NULL,'Unacknowledged',NULL),
	(35,2,211,1,3,NULL,NULL,'2019-03-18','16:00:00','17:00:00',2,'test',200,NULL,2,'male','Terry','+443334433988',NULL,NULL,NULL,NULL,NULL,NULL,'Pending',NULL,'Unacknowledged',NULL),
	(36,2,212,1,3,NULL,NULL,'2019-03-18','11:00:00','13:00:00',2,'test',200,NULL,5,'male','Terry','+443334433988',NULL,NULL,NULL,NULL,NULL,NULL,'Pending',NULL,'Unacknowledged',NULL),
	(37,2,213,1,8,NULL,NULL,'2019-03-30','14:00:00','15:00:00',2,'I want 2 entertainers for organizing my son birthday!',75,NULL,2,'male','Terry','+443334433988','Bakery Street','North London','London',NULL,NULL,NULL,'Pending',3,'Unacknowledged',NULL),
	(38,2,214,1,8,14,NULL,'2019-04-26','11:04:00','12:04:00',1,'test test ',675,NULL,0,'female','4','+443376431854','test venue address','000787','london',NULL,NULL,NULL,NULL,NULL,NULL,NULL),
	(39,2,215,1,3,NULL,NULL,'2019-04-23','19:48:00','20:48:00',2,'test',200,NULL,2,'male','Danny','+4434982374893274',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL),
	(43,18,219,1,8,0,NULL,'2019-05-17','13:00:00','14:00:00',1,'blah',NULL,NULL,7,'male','Niki',NULL,NULL,NULL,NULL,NULL,NULL,NULL,'Pending',3,'Unacknowledged',22),
	(44,18,220,1,8,0,NULL,'2019-05-25','12:00:00','15:00:00',2,'blah blah blah',NULL,NULL,3,'male','James',NULL,NULL,NULL,NULL,NULL,NULL,NULL,'Pending',3,'Unacknowledged',24),
	(45,2,221,1,8,NULL,NULL,'2019-05-23','02:01:00','03:01:00',2,'fsdfd',75,NULL,2,'male','Terry','+42342432432',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,0),
	(46,18,222,1,8,0,NULL,'2019-06-06','14:00:00','15:00:00',2,'ddsfsfdsf',NULL,NULL,2,'male','Terry',NULL,NULL,NULL,NULL,'1. First line of plan\n2. Second line of the plan',NULL,'czczxczcz','Pending',3,'Acknowledged',25),
	(47,2,223,2,8,NULL,NULL,'2019-06-05','12:00:00','13:00:00',2,'test',75,NULL,2,'male','Terry','+44534542532',NULL,NULL,NULL,'1. To arrive at the venue on the 11:30\n2. To bring fireworks\n3. Before 15 minutes from finish remind venue manager to burn candles.',NULL,NULL,'Pending',3,'Unacknowledged',0),
	(48,2,224,2,8,NULL,NULL,'2019-06-06','15:00:00','17:00:00',2,'test',75,NULL,2,'male','Terry','+44534542532',NULL,NULL,NULL,NULL,NULL,NULL,'Pending',3,'Unacknowledged',0),
	(49,2,225,2,8,NULL,NULL,'2019-06-14','11:30:00','14:00:00',2,'test',240,NULL,2,'male','Terry','+44534542532',NULL,NULL,NULL,NULL,NULL,NULL,'Pending',NULL,'Unacknowledged',0),
	(50,2,226,2,8,NULL,NULL,'2019-06-14','15:30:00','17:30:00',1,'test',240,NULL,2,'male','Terry','+44534542532',NULL,NULL,NULL,NULL,NULL,NULL,'Pending',3,'Unacknowledged',0),
	(51,2,227,2,8,NULL,NULL,'2019-06-26','12:30:00','17:30:00',1,'test',240,NULL,2,'male','Terry','+44534542532',NULL,NULL,NULL,NULL,NULL,NULL,'Pending',3,'Unacknowledged',0),
	(52,2,228,2,8,NULL,NULL,'2019-06-26','08:30:00','11:30:00',1,'test',240,NULL,2,'male','Terry','+44534542532',NULL,NULL,NULL,'jkhdasdsajkhdajksh\ndadkhasdksakhdas',NULL,'test test','Pending',3,'Acknowledged',0),
	(53,2,230,NULL,8,NULL,NULL,'2019-07-18','20:10:00','21:10:00',2,'dfdsfdsf',75,NULL,2,'male','Terry','+444623432468',NULL,NULL,NULL,NULL,NULL,NULL,'Pending',3,'Unacknowledged',0);

/*!40000 ALTER TABLE `tbl_entertainer_orders` ENABLE KEYS */;
UNLOCK TABLES;


# Dump of table tbl_entertainer_orders_staff
# ------------------------------------------------------------

DROP TABLE IF EXISTS `tbl_entertainer_orders_staff`;

CREATE TABLE `tbl_entertainer_orders_staff` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `entertainer_order_id` int(11) DEFAULT NULL,
  `entertainer_staff_id` int(11) DEFAULT NULL,
  `creator_id` int(11) DEFAULT NULL,
  `created_date` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

LOCK TABLES `tbl_entertainer_orders_staff` WRITE;
/*!40000 ALTER TABLE `tbl_entertainer_orders_staff` DISABLE KEYS */;

INSERT INTO `tbl_entertainer_orders_staff` (`id`, `entertainer_order_id`, `entertainer_staff_id`, `creator_id`, `created_date`)
VALUES
	(1,35,1,NULL,'0000-00-00 00:00:00'),
	(2,35,2,NULL,NULL),
	(3,36,1,NULL,NULL),
	(4,36,3,NULL,NULL),
	(5,28,1,NULL,NULL),
	(6,28,2,NULL,NULL),
	(7,28,3,NULL,NULL),
	(8,30,2,NULL,NULL),
	(9,34,2,NULL,NULL),
	(10,34,3,NULL,NULL),
	(13,46,5,102,NULL),
	(14,47,2,2,NULL),
	(15,47,1,2,NULL),
	(16,48,3,2,NULL),
	(17,51,1,2,NULL),
	(18,51,3,2,NULL),
	(19,52,1,2,NULL),
	(20,51,2,2,NULL);

/*!40000 ALTER TABLE `tbl_entertainer_orders_staff` ENABLE KEYS */;
UNLOCK TABLES;


# Dump of table tbl_entertainer_packages
# ------------------------------------------------------------

DROP TABLE IF EXISTS `tbl_entertainer_packages`;

CREATE TABLE `tbl_entertainer_packages` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `entertainer_id` int(11) DEFAULT NULL,
  `name` varchar(255) DEFAULT NULL,
  `price` double DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

LOCK TABLES `tbl_entertainer_packages` WRITE;
/*!40000 ALTER TABLE `tbl_entertainer_packages` DISABLE KEYS */;

INSERT INTO `tbl_entertainer_packages` (`id`, `entertainer_id`, `name`, `price`)
VALUES
	(1,2,'Bronze',550),
	(2,2,'Silver',650),
	(3,2,'Gold',1000);

/*!40000 ALTER TABLE `tbl_entertainer_packages` ENABLE KEYS */;
UNLOCK TABLES;


# Dump of table tbl_entertainer_party_themes
# ------------------------------------------------------------

DROP TABLE IF EXISTS `tbl_entertainer_party_themes`;

CREATE TABLE `tbl_entertainer_party_themes` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `entertainer_id` int(11) DEFAULT NULL,
  `party_theme_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

LOCK TABLES `tbl_entertainer_party_themes` WRITE;
/*!40000 ALTER TABLE `tbl_entertainer_party_themes` DISABLE KEYS */;

INSERT INTO `tbl_entertainer_party_themes` (`id`, `entertainer_id`, `party_theme_id`)
VALUES
	(19,2,1),
	(24,2,3),
	(25,2,10),
	(26,2,12),
	(27,2,13),
	(28,88,2),
	(29,88,3),
	(30,88,4),
	(31,88,10),
	(32,88,11),
	(33,2,4),
	(34,18,1),
	(35,18,3),
	(36,18,10),
	(37,18,12),
	(38,18,13),
	(39,18,4);

/*!40000 ALTER TABLE `tbl_entertainer_party_themes` ENABLE KEYS */;
UNLOCK TABLES;


# Dump of table tbl_entertainer_photos
# ------------------------------------------------------------

DROP TABLE IF EXISTS `tbl_entertainer_photos`;

CREATE TABLE `tbl_entertainer_photos` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `entertainer_id` int(11) DEFAULT NULL,
  `photo` varchar(255) DEFAULT NULL,
  `type` varchar(10) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

LOCK TABLES `tbl_entertainer_photos` WRITE;
/*!40000 ALTER TABLE `tbl_entertainer_photos` DISABLE KEYS */;

INSERT INTO `tbl_entertainer_photos` (`id`, `entertainer_id`, `photo`, `type`)
VALUES
	(1,2,'d17860859681309ddc9af1ba159731c2.jpg','main'),
	(2,2,'632dbf9e4cfcde0756d30ac9aabcbed9.jpg','other'),
	(3,2,'ce81c8b541b296789d849ed4b4d3d544.jpg','other'),
	(4,3,'584a65344b1d1418d03b36444a269b7f.jpg','main');

/*!40000 ALTER TABLE `tbl_entertainer_photos` ENABLE KEYS */;
UNLOCK TABLES;


# Dump of table tbl_entertainer_postal_codes
# ------------------------------------------------------------

DROP TABLE IF EXISTS `tbl_entertainer_postal_codes`;

CREATE TABLE `tbl_entertainer_postal_codes` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `entertainer_id` int(11) NOT NULL,
  `postal_code_id` int(11) NOT NULL,
  `creator_id` int(11) DEFAULT NULL,
  `created_date` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

LOCK TABLES `tbl_entertainer_postal_codes` WRITE;
/*!40000 ALTER TABLE `tbl_entertainer_postal_codes` DISABLE KEYS */;

INSERT INTO `tbl_entertainer_postal_codes` (`id`, `entertainer_id`, `postal_code_id`, `creator_id`, `created_date`)
VALUES
	(1,2,39,1,NULL),
	(2,2,17,1,NULL),
	(3,2,61,1,NULL),
	(4,18,39,1,NULL),
	(5,18,17,1,NULL),
	(6,18,61,1,NULL);

/*!40000 ALTER TABLE `tbl_entertainer_postal_codes` ENABLE KEYS */;
UNLOCK TABLES;


# Dump of table tbl_entertainer_services
# ------------------------------------------------------------

DROP TABLE IF EXISTS `tbl_entertainer_services`;

CREATE TABLE `tbl_entertainer_services` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `entertainer_id` int(11) DEFAULT NULL,
  `service_id` int(11) DEFAULT NULL,
  `duration` varchar(255) DEFAULT NULL,
  `count_of_guests` varchar(50) DEFAULT NULL,
  `price` double DEFAULT NULL,
  `extra_guest_count` int(11) DEFAULT NULL,
  `entertainers_count` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

LOCK TABLES `tbl_entertainer_services` WRITE;
/*!40000 ALTER TABLE `tbl_entertainer_services` DISABLE KEYS */;

INSERT INTO `tbl_entertainer_services` (`id`, `entertainer_id`, `service_id`, `duration`, `count_of_guests`, `price`, `extra_guest_count`, `entertainers_count`)
VALUES
	(1,2,1,'45 min','1-10',40,NULL,NULL),
	(2,2,1,'1 hour','1-10',165,NULL,NULL),
	(3,2,2,'1 hour','1-5',75,NULL,NULL),
	(4,2,2,'2 hour','1-10',165,NULL,NULL),
	(5,2,5,'1 hour','1-15',180,NULL,NULL),
	(6,2,6,'2','1-15',150,NULL,NULL),
	(7,2,3,'1','1-15',500,NULL,NULL),
	(8,2,7,'1','1-20',200,NULL,NULL),
	(9,2,8,'1 hour','1-10',100,NULL,NULL),
	(10,2,9,'30 min','7',160,NULL,NULL),
	(12,18,1,'45 min','1-10',50,5,2),
	(13,18,1,'1 hour','1-10',180,5,2),
	(14,18,2,'1 hour','1-5',90,10,3),
	(15,18,2,'2 hour','1-10',185,10,3),
	(16,18,5,'1 hour','1-15',200,NULL,NULL),
	(17,18,6,'2','1-15',150,NULL,NULL),
	(18,18,3,'1','1-15',500,5,4),
	(19,18,7,'2','1-15',100,NULL,NULL),
	(20,18,9,'30','7',155,NULL,NULL),
	(22,18,11,'30 min','1-10',50,5,2),
	(23,18,12,'30 min','1-15',45,5,2),
	(24,18,13,'30 min','1-10',55,5,2),
	(25,18,14,'30 min','1-15',40,5,2),
	(26,18,15,'30 min','1-10',65,5,2),
	(27,NULL,NULL,NULL,NULL,NULL,NULL,NULL),
	(28,18,16,'1 hour','1-20',150,NULL,NULL),
	(29,18,17,'','15',50,NULL,NULL),
	(30,18,18,'','10',40,NULL,NULL);

/*!40000 ALTER TABLE `tbl_entertainer_services` ENABLE KEYS */;
UNLOCK TABLES;


# Dump of table tbl_entertainer_staff
# ------------------------------------------------------------

DROP TABLE IF EXISTS `tbl_entertainer_staff`;

CREATE TABLE `tbl_entertainer_staff` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `first_name` varchar(100) DEFAULT NULL,
  `last_name` varchar(255) DEFAULT NULL,
  `photo` text,
  `entertainer_id` int(11) DEFAULT NULL,
  `date` date DEFAULT NULL,
  `start_time` time DEFAULT NULL,
  `end_time` time DEFAULT NULL,
  `day` varchar(20) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

LOCK TABLES `tbl_entertainer_staff` WRITE;
/*!40000 ALTER TABLE `tbl_entertainer_staff` DISABLE KEYS */;

INSERT INTO `tbl_entertainer_staff` (`id`, `first_name`, `last_name`, `photo`, `entertainer_id`, `date`, `start_time`, `end_time`, `day`)
VALUES
	(1,'Robert','Fisher','f42da6647c8b8c559afa967302e25bcd.jpg',2,NULL,NULL,NULL,'Monday'),
	(2,'John','Smith',NULL,2,NULL,NULL,NULL,NULL),
	(3,'Alex','Body',NULL,2,NULL,NULL,NULL,NULL),
	(4,'Alan','Smith','4204b7b3952733a71bc25b49748871d2.png',18,NULL,NULL,NULL,''),
	(5,'Margaret','Brown','7f453b928765fde3edf2e2600e398de9.jpg',18,NULL,NULL,NULL,'');

/*!40000 ALTER TABLE `tbl_entertainer_staff` ENABLE KEYS */;
UNLOCK TABLES;


# Dump of table tbl_food
# ------------------------------------------------------------

DROP TABLE IF EXISTS `tbl_food`;

CREATE TABLE `tbl_food` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) DEFAULT NULL,
  `name` varchar(255) DEFAULT NULL,
  `description` text,
  `delivery` tinyint(1) DEFAULT NULL,
  `rating` tinyint(1) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

LOCK TABLES `tbl_food` WRITE;
/*!40000 ALTER TABLE `tbl_food` DISABLE KEYS */;

INSERT INTO `tbl_food` (`id`, `user_id`, `name`, `description`, `delivery`, `rating`)
VALUES
	(1,93,'M & S','<p>Cakes, Sandwitches, Sweet treats, Cookies</p>\r\n',1,5);

/*!40000 ALTER TABLE `tbl_food` ENABLE KEYS */;
UNLOCK TABLES;


# Dump of table tbl_food_item_photos
# ------------------------------------------------------------

DROP TABLE IF EXISTS `tbl_food_item_photos`;

CREATE TABLE `tbl_food_item_photos` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `food_item_id` int(11) DEFAULT NULL,
  `photo` varchar(255) DEFAULT NULL,
  `type` varchar(5) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

LOCK TABLES `tbl_food_item_photos` WRITE;
/*!40000 ALTER TABLE `tbl_food_item_photos` DISABLE KEYS */;

INSERT INTO `tbl_food_item_photos` (`id`, `food_item_id`, `photo`, `type`)
VALUES
	(1,1,'c44976eb2a00f994e88046b824ca3909.jpg','other'),
	(2,1,'a493111c2ec22d297a1fddefc91c1130.jpg','main'),
	(3,1,'d0e3b97acfc677dc51705aab3a7d1d9b.jpg','other'),
	(4,1,'b3156c45432304efb3845ef8512523ff.jpg','main'),
	(5,1,'c05b96a7ed36c373d019c581eccba3c7.jpg','main');

/*!40000 ALTER TABLE `tbl_food_item_photos` ENABLE KEYS */;
UNLOCK TABLES;


# Dump of table tbl_food_items
# ------------------------------------------------------------

DROP TABLE IF EXISTS `tbl_food_items`;

CREATE TABLE `tbl_food_items` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `food_id` int(11) DEFAULT NULL,
  `name` varchar(255) DEFAULT NULL,
  `price` double DEFAULT NULL,
  `image` varchar(500) DEFAULT NULL,
  `description` text,
  `view_count` int(11) DEFAULT NULL,
  `in_stock` tinyint(1) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

LOCK TABLES `tbl_food_items` WRITE;
/*!40000 ALTER TABLE `tbl_food_items` DISABLE KEYS */;

INSERT INTO `tbl_food_items` (`id`, `food_id`, `name`, `price`, `image`, `description`, `view_count`, `in_stock`)
VALUES
	(1,1,'Cake',80,'c05b96a7ed36c373d019c581eccba3c7.jpg','This is a cake',NULL,1),
	(2,1,'Desert',120,'6401d18fd44832fe3fb85473cfbb3d30.jpg','This a desert',NULL,1);

/*!40000 ALTER TABLE `tbl_food_items` ENABLE KEYS */;
UNLOCK TABLES;


# Dump of table tbl_food_photos
# ------------------------------------------------------------

DROP TABLE IF EXISTS `tbl_food_photos`;

CREATE TABLE `tbl_food_photos` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `food_id` int(11) DEFAULT NULL,
  `photo` varchar(255) DEFAULT NULL,
  `type` varchar(10) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

LOCK TABLES `tbl_food_photos` WRITE;
/*!40000 ALTER TABLE `tbl_food_photos` DISABLE KEYS */;

INSERT INTO `tbl_food_photos` (`id`, `food_id`, `photo`, `type`)
VALUES
	(4,1,'6401d18fd44832fe3fb85473cfbb3d30.jpg','main'),
	(5,1,'75f5b64899b64abb8e83258af0a6d44b.jpg','main'),
	(6,1,'1e5435c1eb4942e9ac137a2017a89916.jpg','main'),
	(7,1,'64dcb601375bd051201d383f324e076c.jpg','main'),
	(8,1,'e9031f17c169caff794d4f1415a7a2b9.jpg','other'),
	(9,1,'fbd786ee69cb3b65057b788d93cb78df.jpg','main'),
	(10,1,'a0318c2623ce7d027cffb05a646454ca.jpg','main'),
	(11,1,'1a46fee593a02c2ce36abf7a44aa167e.jpg','other');

/*!40000 ALTER TABLE `tbl_food_photos` ENABLE KEYS */;
UNLOCK TABLES;


# Dump of table tbl_order_food_items
# ------------------------------------------------------------

DROP TABLE IF EXISTS `tbl_order_food_items`;

CREATE TABLE `tbl_order_food_items` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `order_id` int(11) DEFAULT NULL,
  `food_id` int(11) DEFAULT NULL,
  `food_item_id` int(11) DEFAULT NULL,
  `count` tinyint(5) DEFAULT NULL,
  `price` double DEFAULT NULL,
  `size` varchar(20) DEFAULT NULL,
  `people_count` int(11) DEFAULT NULL,
  `message_on` text,
  `color_message_on` varchar(20) DEFAULT NULL,
  `font_message_on` varchar(20) DEFAULT NULL,
  `note` text,
  `when_will_be_ready` date DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

LOCK TABLES `tbl_order_food_items` WRITE;
/*!40000 ALTER TABLE `tbl_order_food_items` DISABLE KEYS */;

INSERT INTO `tbl_order_food_items` (`id`, `order_id`, `food_id`, `food_item_id`, `count`, `price`, `size`, `people_count`, `message_on`, `color_message_on`, `font_message_on`, `note`, `when_will_be_ready`)
VALUES
	(1,10,1,1,1,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL),
	(2,10,1,2,1,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL);

/*!40000 ALTER TABLE `tbl_order_food_items` ENABLE KEYS */;
UNLOCK TABLES;


# Dump of table tbl_order_product_items
# ------------------------------------------------------------

DROP TABLE IF EXISTS `tbl_order_product_items`;

CREATE TABLE `tbl_order_product_items` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `order_id` int(11) DEFAULT NULL,
  `product_id` int(11) DEFAULT NULL,
  `product_item_id` int(11) DEFAULT NULL,
  `price` double DEFAULT NULL,
  `count` tinyint(5) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

LOCK TABLES `tbl_order_product_items` WRITE;
/*!40000 ALTER TABLE `tbl_order_product_items` DISABLE KEYS */;

INSERT INTO `tbl_order_product_items` (`id`, `order_id`, `product_id`, `product_item_id`, `price`, `count`)
VALUES
	(1,10,1,2,NULL,1);

/*!40000 ALTER TABLE `tbl_order_product_items` ENABLE KEYS */;
UNLOCK TABLES;


# Dump of table tbl_orders
# ------------------------------------------------------------

DROP TABLE IF EXISTS `tbl_orders`;

CREATE TABLE `tbl_orders` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `customer_id` int(11) DEFAULT NULL,
  `status` varchar(50) DEFAULT NULL,
  `price` double DEFAULT NULL,
  `entertainer_id` int(11) DEFAULT NULL,
  `venue_id` int(11) DEFAULT NULL,
  `food_id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `creator_id` int(11) DEFAULT NULL,
  `created_date` datetime DEFAULT CURRENT_TIMESTAMP,
  `order_type` varchar(30) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

LOCK TABLES `tbl_orders` WRITE;
/*!40000 ALTER TABLE `tbl_orders` DISABLE KEYS */;

INSERT INTO `tbl_orders` (`id`, `customer_id`, `status`, `price`, `entertainer_id`, `venue_id`, `food_id`, `product_id`, `creator_id`, `created_date`, `order_type`)
VALUES
	(10,3,'Unacknowledged',500,2,0,0,0,3,'2018-02-18 03:51:27','order'),
	(187,3,'non_answered',700,0,6,0,0,3,'2019-02-27 13:22:28','enquiry'),
	(195,3,'Unacknowledged',200,2,NULL,0,0,3,'2019-02-10 20:17:12','order'),
	(196,3,'Unacknowledged',200,2,NULL,0,0,3,'2019-02-10 15:58:06','order'),
	(197,3,'Unacknowledged',200,2,NULL,0,0,3,'2019-02-10 16:00:14','order'),
	(198,3,'Unacknowledged',200,2,NULL,0,0,3,'2019-02-10 16:00:40','order'),
	(199,3,'Unacknowledged',200,2,NULL,0,0,3,'2019-02-10 16:01:33','order'),
	(200,3,'Unacknowledged',165,2,NULL,0,0,3,'2019-02-10 16:02:47','order'),
	(201,3,'Unacknowledged',165,2,NULL,0,0,3,'2019-02-10 16:05:01','order'),
	(202,3,'Unacknowledged',165,2,NULL,0,0,3,'2019-02-10 16:05:01','order'),
	(203,3,'Unacknowledged',165,2,NULL,0,0,3,'2019-02-10 16:05:02','order'),
	(204,3,'Unacknowledged',165,2,NULL,0,0,3,'2019-02-10 16:05:02','order'),
	(205,3,'Unacknowledged',165,2,NULL,0,0,3,'2019-02-10 16:05:03','order'),
	(206,3,'Unacknowledged',165,2,NULL,0,0,3,'2019-02-10 16:05:03','order'),
	(207,3,'Unacknowledged',165,2,NULL,0,0,3,'2019-02-10 16:05:03','order'),
	(208,3,'Unacknowledged',165,2,NULL,0,0,3,'2019-02-10 16:05:04','order'),
	(209,3,'Unacknowledged',165,2,NULL,0,0,3,'2019-02-10 16:05:04','order'),
	(210,3,'Unacknowledged',245,2,NULL,0,0,3,'2019-03-03 02:03:34','order'),
	(211,3,'Unacknowledged',200,2,NULL,0,0,3,'2019-03-07 03:19:57','order'),
	(212,3,'Unacknowledged',200,2,NULL,0,0,3,'2019-03-10 01:31:01','order'),
	(213,3,'Unacknowledged',75,2,NULL,0,0,3,'2019-03-30 01:48:17','order'),
	(214,3,'Unacknowledged',675,2,NULL,0,0,3,'2019-04-13 11:05:45','order'),
	(215,3,'Unacknowledged',200,2,NULL,0,0,3,'2019-04-13 19:49:21','order'),
	(219,3,'Unacknowledged',365,18,NULL,0,0,NULL,'2019-05-12 21:20:18',NULL),
	(220,3,'Unacknowledged',90.54,18,NULL,0,0,NULL,'2019-05-20 01:03:55',NULL),
	(221,3,'Unacknowledged',75,2,NULL,0,0,3,'2019-05-20 02:02:26','order'),
	(222,3,'Acknowledged',155.54,18,NULL,0,0,NULL,'2019-06-03 22:39:52',NULL),
	(223,3,'Unacknowledged',75,2,NULL,0,0,3,'2019-06-10 00:14:54','order'),
	(224,3,'Unacknowledged',75,2,NULL,0,0,3,'2019-06-10 00:29:43','order'),
	(225,3,'Unacknowledged',240,2,NULL,0,0,3,'2019-06-10 00:41:32','order'),
	(226,3,'Unacknowledged',240,2,NULL,0,0,3,'2019-06-10 00:45:06','order'),
	(227,3,'Unacknowledged',240,2,NULL,0,0,3,'2019-06-10 02:02:36','order'),
	(228,3,'Acknowledged',240,2,NULL,0,0,3,'2019-06-10 02:17:46','order'),
	(229,3,'Unacknowledged',NULL,18,NULL,0,0,NULL,'2019-06-10 03:33:33',NULL),
	(230,3,'Unacknowledged',75,2,NULL,0,0,3,'2019-07-16 20:24:44','order');

/*!40000 ALTER TABLE `tbl_orders` ENABLE KEYS */;
UNLOCK TABLES;


# Dump of table tbl_party_theme
# ------------------------------------------------------------

DROP TABLE IF EXISTS `tbl_party_theme`;

CREATE TABLE `tbl_party_theme` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) DEFAULT NULL,
  `type` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

LOCK TABLES `tbl_party_theme` WRITE;
/*!40000 ALTER TABLE `tbl_party_theme` DISABLE KEYS */;

INSERT INTO `tbl_party_theme` (`id`, `name`, `type`)
VALUES
	(1,'Cars','theme'),
	(2,'Clowns','theme'),
	(3,'Disco','theme'),
	(4,'Disney','theme'),
	(5,'Film-making','theme'),
	(6,'Harry Potter','theme'),
	(7,'Laser Tag','theme'),
	(8,'Magic show','theme'),
	(9,'Popular Cartoon/Superhero Characters','theme'),
	(10,'Princesses/Pirates','theme'),
	(11,'Science','theme'),
	(12,'Sports (football, swimming, cricket)','theme'),
	(13,'Star Wars','theme'),
	(14,'Face painting','additional_services'),
	(15,'Froggle the Clown','theme'),
	(16,'Party bags','additional_products'),
	(17,'Slinky Slime','extra_services'),
	(18,'Food Technology','extra_services'),
	(19,'Dry ice','extra_services'),
	(20,'Cosmetic Beauty','extra_services'),
	(21,'Apollo Space','extra_services'),
	(22,'Dry ice','additional_products'),
	(23,'Balloons','additional_products');

/*!40000 ALTER TABLE `tbl_party_theme` ENABLE KEYS */;
UNLOCK TABLES;


# Dump of table tbl_party_type
# ------------------------------------------------------------

DROP TABLE IF EXISTS `tbl_party_type`;

CREATE TABLE `tbl_party_type` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) DEFAULT NULL,
  `type` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

LOCK TABLES `tbl_party_type` WRITE;
/*!40000 ALTER TABLE `tbl_party_type` DISABLE KEYS */;

INSERT INTO `tbl_party_type` (`id`, `name`, `type`)
VALUES
	(1,'Birthday',NULL),
	(2,'Christmas',NULL),
	(3,'Easter',NULL),
	(4,'Christening',NULL),
	(5,'Just for fun',NULL);

/*!40000 ALTER TABLE `tbl_party_type` ENABLE KEYS */;
UNLOCK TABLES;


# Dump of table tbl_photographer
# ------------------------------------------------------------

DROP TABLE IF EXISTS `tbl_photographer`;

CREATE TABLE `tbl_photographer` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) DEFAULT NULL,
  `first_name` varchar(100) DEFAULT NULL,
  `last_name` varchar(100) DEFAULT NULL,
  `price` double DEFAULT NULL,
  `photo` varchar(100) DEFAULT NULL,
  `created_date` datetime DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

LOCK TABLES `tbl_photographer` WRITE;
/*!40000 ALTER TABLE `tbl_photographer` DISABLE KEYS */;

INSERT INTO `tbl_photographer` (`id`, `user_id`, `first_name`, `last_name`, `price`, `photo`, `created_date`)
VALUES
	(1,100,'Tom','Bright',30,NULL,'2018-09-21 13:06:43');

/*!40000 ALTER TABLE `tbl_photographer` ENABLE KEYS */;
UNLOCK TABLES;


# Dump of table tbl_postal_code_directions
# ------------------------------------------------------------

DROP TABLE IF EXISTS `tbl_postal_code_directions`;

CREATE TABLE `tbl_postal_code_directions` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

LOCK TABLES `tbl_postal_code_directions` WRITE;
/*!40000 ALTER TABLE `tbl_postal_code_directions` DISABLE KEYS */;

INSERT INTO `tbl_postal_code_directions` (`id`, `name`)
VALUES
	(1,'North London'),
	(2,'South London'),
	(3,'East London'),
	(4,'West London'),
	(5,'South West London'),
	(6,'South East London'),
	(7,'Central London'),
	(8,'Greater London'),
	(9,'Richmand');

/*!40000 ALTER TABLE `tbl_postal_code_directions` ENABLE KEYS */;
UNLOCK TABLES;


# Dump of table tbl_postal_codes
# ------------------------------------------------------------

DROP TABLE IF EXISTS `tbl_postal_codes`;

CREATE TABLE `tbl_postal_codes` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `abbr` varchar(5) DEFAULT NULL,
  `name` varchar(300) DEFAULT NULL,
  `postal_code_direction_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

LOCK TABLES `tbl_postal_codes` WRITE;
/*!40000 ALTER TABLE `tbl_postal_codes` DISABLE KEYS */;

INSERT INTO `tbl_postal_codes` (`id`, `abbr`, `name`, `postal_code_direction_id`)
VALUES
	(1,'E1','Whitechapel, Stepney, Mile End',3),
	(2,'E1W','Wapping',3),
	(3,'E2','Bethnal Green, Shoreditch',3),
	(4,'E3','Bow, Bromley-by-Bow',3),
	(5,'E4','Chingford, Highams Park',3),
	(6,'E5','Clapton',NULL),
	(7,'E6','East Ham',NULL),
	(8,'E7','Forest Gate, Upton Park',NULL),
	(9,'E8','Hackney, Dalston',NULL),
	(10,'E9','Hackney, Homerton',NULL),
	(11,'E10','Leyton',NULL),
	(12,'E11','Leytonstone',NULL),
	(13,'E12','Manor Park',NULL),
	(14,'E13','Plaistow',NULL),
	(15,'E14','Poplar, Millwall, Isle of Dogs, Docklands',NULL),
	(16,'E15','Stratford, West Ham',NULL),
	(17,'E16','Canning Town, North Woolwich, Docklands',3),
	(18,'E17','Walthamstow',NULL),
	(19,'E18','South Woodford',NULL),
	(20,'E20','Olympic Park',NULL),
	(21,'WC1','Bloomsbury, Grays Inn',NULL),
	(22,'WC2','Covent Garden, Holborn, Strand',NULL),
	(23,'EC1','Clerkenwell, Finsbury, Barbican',NULL),
	(24,'EC2','Moorgate, Liverpool Street',NULL),
	(25,'EC3','Monument, Tower Hill, Aldgate',NULL),
	(26,'EC4','Fleet Street, St. Pauls',NULL),
	(27,'N1','Islington, Barnsbury, Canonbury',NULL),
	(28,'N2','East Finchley',NULL),
	(29,'N3','Finchley Central',NULL),
	(30,'N4','Finsbury Park, Manor House',NULL),
	(31,'N5','Highbury',NULL),
	(32,'N6','Highgate',NULL),
	(33,'N7','Holloway',NULL),
	(34,'N8','Hornsey, Crouch End',NULL),
	(35,'N9','Lower Edmonton',NULL),
	(36,'N10','Muswell Hill',NULL),
	(37,'N11','Friern Barnet, New Southgate',NULL),
	(38,'N12','North Finchley, Woodside Park',NULL),
	(39,'N13',' Palmers Green',1),
	(40,'N14','Southgate',NULL),
	(41,'N15','Seven Sisters',NULL),
	(42,'N16','Stoke Newington, Stamford Hill',NULL),
	(43,'N17','Tottenham',NULL),
	(44,'N18','Upper Edmonton',NULL),
	(45,'N19','Archway, Tufnell Park',NULL),
	(46,'N20','Whetstone, Totteridge',NULL),
	(47,'N21','Winchmore Hill',NULL),
	(48,'N22','Wood Green, Alexandra Palace',NULL),
	(49,'NW1','Regents Park, Camden Town',NULL),
	(50,'NW2','Cricklewood, Neasden',NULL),
	(51,'NW3','Hampstead, Swiss Cottage',NULL),
	(52,'NW4','Hendon, Brent Cross',NULL),
	(53,'NW5','Kentish Town',NULL),
	(54,'NW6','West Hampstead, Kilburn, Queens Park',NULL),
	(55,'NW7','Mill Hill',NULL),
	(56,'NW8','St Johns Wood',NULL),
	(57,'NW9','Kinsbury, Colindale',NULL),
	(58,'NW10','Willesden, Harlesden, Kensal Green',NULL),
	(59,'NW11','Golders Green, Hampstead Gdn Suburb',NULL),
	(60,'SE1','Waterloo, Bermondsey, Southwark,B',NULL),
	(61,'SE2','Abbey Wood',2),
	(62,'SE3','Blackheath, Westcombe Park',NULL),
	(63,'SE4','Brockley, Crofton Park, Honor Oak',NULL),
	(64,'SE5','Camberwell',NULL),
	(65,'SE6','Catford, Hither Green, Bellingham',NULL),
	(66,'SE7','Charlton',NULL),
	(67,'SE8','Deptford',NULL),
	(68,'SE9','Eltham, Mottingham',NULL),
	(69,'SE10','Greenwich',NULL),
	(70,'SE11','Lambeth',NULL),
	(71,'SE12','Lee, Grove Park',NULL),
	(72,'SE13','Lewisham, Hither Green',NULL),
	(73,'SE14','New Cross, New Cross Gate',NULL),
	(74,'SE15','Peckham, Nunhead',NULL),
	(75,'SE16','Rotherhithe, South Bermonsey, Su',NULL),
	(76,'SE17','Walworth, Elephant & Castle',NULL),
	(77,'SE18','Woolwich, Plumstead',NULL),
	(78,'SE19','Upper Norwood, Crystal Palace',NULL),
	(79,'SE20','Penge, Anerley',NULL),
	(80,'SE21','Dulwich',NULL),
	(81,'SE22','East Dulwich',NULL),
	(82,'SE23','Forest Hill',NULL),
	(83,'SE24','Herne Hill',NULL),
	(84,'SE25','South Norwood',NULL),
	(85,'SE26','Sydenham',NULL),
	(86,'SE27','West Norwood, Tulse Hill',NULL),
	(87,'SE28','Thamesmead',NULL),
	(88,'SW1','Westminster, Belgravia, Pimlico',NULL),
	(89,'SW2','Brixton, Streatham Hill',NULL),
	(90,'SW3','Chelsea, Brompton',NULL),
	(91,'SW4','Clapham',NULL),
	(92,'SW5','Earls Court',NULL),
	(93,'SW6','Fulham, Parsons Green',NULL),
	(94,'SW7','South Kensington',NULL),
	(95,'SW8','South Lambeth, Nine Elms',NULL),
	(96,'SW9','Stockwell, Brixton',NULL),
	(97,'SW10','West Brompton, Worlds End',NULL),
	(98,'SW11','Battersea, Clapham Junction',NULL),
	(99,'SW12','Balham',NULL),
	(100,'SW13','Barnes, Castelnau',NULL),
	(101,'SW14','Mortlake, East Sheen',NULL),
	(102,'SW15','Putney, Roehampton',NULL),
	(103,'SW16','Streatham, Norbury',NULL),
	(104,'SW17','Streatham, Norbury',NULL),
	(105,'SW18','Wandsworth, Earlsfield',NULL),
	(106,'SW19','Wimbledon, Merton',NULL),
	(107,'SW20','South Wimbledon, Raynes Park',NULL),
	(108,'W1','Mayfair, Marylebone, Soho',NULL),
	(109,'W2','Bayswater, Paddington',NULL),
	(110,'W3','Acton',NULL),
	(111,'W4','Chiswick',NULL),
	(112,'W5','Ealing',NULL),
	(113,'W6','Hammersmith',NULL),
	(114,'W7','Hanwell',NULL),
	(115,'W8','Kensington',NULL),
	(116,'W9','Maida Vale, Warwick Avenue',NULL),
	(117,'W10','Ladbroke Grove, North Kensington',NULL),
	(118,'W11','Notting Hill, Holland Park',NULL),
	(119,'W12','Shepherds Bush',NULL),
	(120,'W13','West Ealing',NULL),
	(121,'W14','West Kensington',NULL);

/*!40000 ALTER TABLE `tbl_postal_codes` ENABLE KEYS */;
UNLOCK TABLES;


# Dump of table tbl_product
# ------------------------------------------------------------

DROP TABLE IF EXISTS `tbl_product`;

CREATE TABLE `tbl_product` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) DEFAULT NULL,
  `name` varchar(255) DEFAULT NULL,
  `description` text,
  `delivery` tinyint(4) DEFAULT NULL,
  `rating` tinyint(1) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

LOCK TABLES `tbl_product` WRITE;
/*!40000 ALTER TABLE `tbl_product` DISABLE KEYS */;

INSERT INTO `tbl_product` (`id`, `user_id`, `name`, `description`, `delivery`, `rating`)
VALUES
	(1,94,'Product Service 1','<p>This is Product Provider</p>\r\n',1,5);

/*!40000 ALTER TABLE `tbl_product` ENABLE KEYS */;
UNLOCK TABLES;


# Dump of table tbl_product_item_photos
# ------------------------------------------------------------

DROP TABLE IF EXISTS `tbl_product_item_photos`;

CREATE TABLE `tbl_product_item_photos` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `product_item_id` int(11) DEFAULT NULL,
  `photo` varchar(255) DEFAULT NULL,
  `type` varchar(5) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

LOCK TABLES `tbl_product_item_photos` WRITE;
/*!40000 ALTER TABLE `tbl_product_item_photos` DISABLE KEYS */;

INSERT INTO `tbl_product_item_photos` (`id`, `product_item_id`, `photo`, `type`)
VALUES
	(1,2,'2d05d7b990adbce2a991097758359fa1.jpg','main'),
	(2,2,'783cf7f130f81aafa55dcf7ceed82147.jpg','main'),
	(3,2,'f747041cc22536f60df4c0be7914e7b5.jpg','main'),
	(4,2,'e9b774f3b31a19f3b5fc6d29c4a24ac2.jpg','main'),
	(5,2,'','main'),
	(6,2,'','main');

/*!40000 ALTER TABLE `tbl_product_item_photos` ENABLE KEYS */;
UNLOCK TABLES;


# Dump of table tbl_product_items
# ------------------------------------------------------------

DROP TABLE IF EXISTS `tbl_product_items`;

CREATE TABLE `tbl_product_items` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `product_id` int(11) DEFAULT NULL,
  `name` varchar(255) DEFAULT NULL,
  `price` double DEFAULT NULL,
  `image` varchar(500) DEFAULT NULL,
  `description` text,
  `view_count` int(11) DEFAULT NULL,
  `in_stock` tinyint(1) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

LOCK TABLES `tbl_product_items` WRITE;
/*!40000 ALTER TABLE `tbl_product_items` DISABLE KEYS */;

INSERT INTO `tbl_product_items` (`id`, `product_id`, `name`, `price`, `image`, `description`, `view_count`, `in_stock`)
VALUES
	(2,1,'Decoration 1',120,'e9b774f3b31a19f3b5fc6d29c4a24ac2.jpg','This is a decoration\r\nThis is a decoration\r\nThis is a decoration\r\nThis is a decoration\r\nThis is a decoration\r\nThis is a decoration',NULL,1),
	(3,1,'Decoration 2',50,'ad2dd188e5b395aa9a011f8140b4c884.jpg','This is a decoration',NULL,NULL);

/*!40000 ALTER TABLE `tbl_product_items` ENABLE KEYS */;
UNLOCK TABLES;


# Dump of table tbl_product_photos
# ------------------------------------------------------------

DROP TABLE IF EXISTS `tbl_product_photos`;

CREATE TABLE `tbl_product_photos` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `product_id` int(11) DEFAULT NULL,
  `photo` varchar(255) DEFAULT NULL,
  `type` varchar(10) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

LOCK TABLES `tbl_product_photos` WRITE;
/*!40000 ALTER TABLE `tbl_product_photos` DISABLE KEYS */;

INSERT INTO `tbl_product_photos` (`id`, `product_id`, `photo`, `type`)
VALUES
	(1,1,'d156de90e50224bab81ae88b53d2588a.jpg','main'),
	(2,2,'125b8e448bcec1ff3e07f6cb67252445.jpg','main'),
	(3,2,'460fcf2e7eb9df46b6056f516a8ace6f.jpg','other');

/*!40000 ALTER TABLE `tbl_product_photos` ENABLE KEYS */;
UNLOCK TABLES;


# Dump of table tbl_reviews
# ------------------------------------------------------------

DROP TABLE IF EXISTS `tbl_reviews`;

CREATE TABLE `tbl_reviews` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `customer_id` int(11) DEFAULT NULL,
  `supplier_id` int(11) DEFAULT NULL,
  `comment` text,
  `order_id` int(11) DEFAULT NULL,
  `entertainers_point` double DEFAULT NULL,
  `overall_program_point` double DEFAULT NULL,
  `keep_anonymous` tinyint(1) DEFAULT NULL,
  `admin_id` int(11) DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

LOCK TABLES `tbl_reviews` WRITE;
/*!40000 ALTER TABLE `tbl_reviews` DISABLE KEYS */;

INSERT INTO `tbl_reviews` (`id`, `customer_id`, `supplier_id`, `comment`, `order_id`, `entertainers_point`, `overall_program_point`, `keep_anonymous`, `admin_id`)
VALUES
	(7,5,2,'Thank you, amazing!',NULL,NULL,NULL,NULL,NULL),
	(8,3,2,'Thank you',NULL,NULL,NULL,NULL,NULL),
	(9,3,2,'Awesome party!',10,4.5,5,1,0),
	(10,4,2,'Everything was fine! The next time we definitely will take services from Cat Cast!',201,5,5,0,0),
	(11,NULL,2,'You are welcome! Everytime we are ready to support you wth hight level.',NULL,NULL,NULL,0,1),
	(12,NULL,NULL,NULL,NULL,NULL,NULL,0,0),
	(13,3,2,'sfdsfsfdsf',10,4.5,5,1,0);

/*!40000 ALTER TABLE `tbl_reviews` ENABLE KEYS */;
UNLOCK TABLES;


# Dump of table tbl_services
# ------------------------------------------------------------

DROP TABLE IF EXISTS `tbl_services`;

CREATE TABLE `tbl_services` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `party_theme_id` int(11) DEFAULT NULL,
  `name` text,
  `entertainers_number` int(11) DEFAULT '0',
  `base_extra_price` double DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

LOCK TABLES `tbl_services` WRITE;
/*!40000 ALTER TABLE `tbl_services` DISABLE KEYS */;

INSERT INTO `tbl_services` (`id`, `party_theme_id`, `name`, `entertainers_number`, `base_extra_price`)
VALUES
	(1,8,'Entertainers/Magicians - 1 entertainer',1,15),
	(2,8,'Entertainers/Magicians - 2 entertainers',2,30),
	(3,8,'Entertainers/Magicians - 3 entertainers',3,15),
	(4,15,'Froggle the Clown - 1 entertainer',1,20),
	(5,14,'Face Painting',0,10),
	(6,15,'Froggle the Clown - 2 entertainer',2,20),
	(7,3,'Disco',1,5),
	(8,10,'Princesses/Pirates - 1 entertainer',0,10),
	(9,16,'Party bags',0,5),
	(11,17,'Slinky Slime',0,5),
	(12,18,'Food Technology',0,5),
	(13,19,'Dry Ice',0,5),
	(14,20,'Cosmetic Beauty',0,5),
	(15,21,'Apollo Space',0,5),
	(16,11,'Science',1,5),
	(17,22,'Dry Ice',0,NULL),
	(18,23,'Ballons',0,NULL);

/*!40000 ALTER TABLE `tbl_services` ENABLE KEYS */;
UNLOCK TABLES;


# Dump of table tbl_user
# ------------------------------------------------------------

DROP TABLE IF EXISTS `tbl_user`;

CREATE TABLE `tbl_user` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `email` varchar(200) DEFAULT NULL,
  `password` varchar(32) DEFAULT NULL,
  `status` varchar(20) DEFAULT NULL,
  `user_type_id` int(11) DEFAULT NULL,
  `support_instant_booking` tinyint(1) DEFAULT NULL,
  `rating` int(1) DEFAULT NULL,
  `username` varchar(100) DEFAULT NULL,
  `postal_code` varchar(20) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

LOCK TABLES `tbl_user` WRITE;
/*!40000 ALTER TABLE `tbl_user` DISABLE KEYS */;

INSERT INTO `tbl_user` (`id`, `email`, `password`, `status`, `user_type_id`, `support_instant_booking`, `rating`, `username`, `postal_code`)
VALUES
	(1,'admin@gmail.com','4297f44b13955235245b2497399d7a93','Active',6,NULL,NULL,'admin',NULL),
	(2,'entertainer@gmail.com','4297f44b13955235245b2497399d7a93','Active',2,1,5,'fisher',''),
	(3,'customer@gmail.com','4297f44b13955235245b2497399d7a93','Active',1,NULL,NULL,'marcus',NULL),
	(6,'venue1@gmail.com','4297f44b13955235245b2497399d7a93','Active',3,NULL,NULL,'sally.brown',NULL),
	(7,'katelight@gmail.com','4297f44b13955235245b2497399d7a93','Active',5,NULL,NULL,'katelight',NULL),
	(8,'abram.castrol@yahoo.com','4297f44b13955235245b2497399d7a93','Active',4,NULL,NULL,'abram.castrol',NULL),
	(9,'food2@gmail.com','4297f44b13955235245b2497399d7a93','Active',5,NULL,1,'michael.adams',NULL),
	(88,'sally@gmail.com','4297f44b13955235245b2497399d7a93','Active',2,1,4,NULL,'12345678'),
	(93,'food_1@gmail.com','63ee451939ed580ef3c4b6f0109d1fd0','Active',5,NULL,NULL,NULL,NULL),
	(94,'product_1@gmail.com','4297f44b13955235245b2497399d7a93','Active',5,NULL,NULL,NULL,NULL),
	(95,'entertainer1@gmail.com','4297f44b13955235245b2497399d7a93','Active',5,NULL,NULL,NULL,NULL),
	(96,'venue_001@gmail.com','4297f44b13955235245b2497399d7a93','Active',5,NULL,NULL,NULL,NULL),
	(97,'venue_002@gmail.com','4297f44b13955235245b2497399d7a93','Active',5,NULL,NULL,NULL,NULL),
	(98,'venue_003@gmail.com','4297f44b13955235245b2497399d7a93','Active',5,NULL,NULL,NULL,NULL),
	(99,'venue_005@gmail.com','4297f44b13955235245b2497399d7a93','Active',5,NULL,NULL,NULL,NULL),
	(100,'photographer@gmail.com','4297f44b13955235245b2497399d7a93',NULL,NULL,NULL,NULL,NULL,NULL),
	(102,'entertainer2@gmail.com','4297f44b13955235245b2497399d7a93','Active',2,NULL,NULL,NULL,NULL),
	(103,'venue2@gmail.com','4297f44b13955235245b2497399d7a93','Active',3,NULL,NULL,NULL,NULL),
	(104,'customer2@gmail.com','4297f44b13955235245b2497399d7a93','Active',1,NULL,NULL,NULL,NULL);

/*!40000 ALTER TABLE `tbl_user` ENABLE KEYS */;
UNLOCK TABLES;


# Dump of table tbl_user_photos
# ------------------------------------------------------------

DROP TABLE IF EXISTS `tbl_user_photos`;

CREATE TABLE `tbl_user_photos` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) DEFAULT NULL,
  `photo` varchar(255) DEFAULT NULL,
  `type` varchar(10) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `user_photos_user_foreign_key` (`user_id`),
  CONSTRAINT `user_photos_user_foreign_key` FOREIGN KEY (`user_id`) REFERENCES `tbl_user` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

LOCK TABLES `tbl_user_photos` WRITE;
/*!40000 ALTER TABLE `tbl_user_photos` DISABLE KEYS */;

INSERT INTO `tbl_user_photos` (`id`, `user_id`, `photo`, `type`)
VALUES
	(2,2,'c9bb1500cc21fe9942796dc38af70ed8.jpg','main'),
	(45,NULL,'547d8ee69dbf3965bd2f843b6d719518.jpg','main'),
	(46,NULL,'312351bff07989769097660a56395065.jpg','other'),
	(47,NULL,'ea6b2efbdd4255a9f1b3bbc6399b58f4.jpg','other'),
	(48,NULL,'3d188212dfa7dac14311dcb5bee75fc5.jpg','main'),
	(49,NULL,'5531a5834816222280f20d1ef9e95f69.jpg','other'),
	(50,NULL,'07811dc6c422334ce36a09ff5cd6fe71.jpg','other');

/*!40000 ALTER TABLE `tbl_user_photos` ENABLE KEYS */;
UNLOCK TABLES;


# Dump of table tbl_user_types
# ------------------------------------------------------------

DROP TABLE IF EXISTS `tbl_user_types`;

CREATE TABLE `tbl_user_types` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

LOCK TABLES `tbl_user_types` WRITE;
/*!40000 ALTER TABLE `tbl_user_types` DISABLE KEYS */;

INSERT INTO `tbl_user_types` (`id`, `name`)
VALUES
	(1,'Customer'),
	(2,'Entertainer'),
	(3,'Venue Provider'),
	(4,'Party Product Provider'),
	(5,'Food Provider'),
	(6,'Sys Admin'),
	(7,'Photographer');

/*!40000 ALTER TABLE `tbl_user_types` ENABLE KEYS */;
UNLOCK TABLES;


# Dump of table tbl_venue
# ------------------------------------------------------------

DROP TABLE IF EXISTS `tbl_venue`;

CREATE TABLE `tbl_venue` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) DEFAULT NULL,
  `name` varchar(255) DEFAULT NULL,
  `short_description` text,
  `description` text,
  `rating` tinyint(1) DEFAULT NULL,
  `price` double DEFAULT NULL,
  `postal_code` varchar(20) DEFAULT NULL,
  `support_instant_booking` tinyint(1) DEFAULT NULL,
  `address` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

LOCK TABLES `tbl_venue` WRITE;
/*!40000 ALTER TABLE `tbl_venue` DISABLE KEYS */;

INSERT INTO `tbl_venue` (`id`, `user_id`, `name`, `short_description`, `description`, `rating`, `price`, `postal_code`, `support_instant_booking`, `address`)
VALUES
	(1,6,'London Star','This is Venue','<p>Hall &pound;300/1 hour</p>\r\n\r\n<p>Main room &pound;500/1 hour</p>\r\n\r\n<p>Small room &pound;200/1 hour<img alt=\"\" src=\"C:\\Users\\Public\\Pictures\\Sample Pictures\\Desert.jpg\" /></p>\r\n\r\n<p>One room &pound;500/1 hour</p>\r\n\r\n<p>Second room &pound;700/1 hour</p>\r\n\r\n<hr />\r\n<p><strong>Catering</strong></p>\r\n\r\n<p>&nbsp;In-house catering <s>Allows external catering</s></p>\r\n\r\n<p>Approved caterers only BYO alcohol allowed</p>\r\n\r\n<p>&nbsp;Can provide alcohol&nbsp;Kitchen facilities available</p>\r\n\r\n<p>Can provide halal <s>Can provide kosher</s></p>\r\n\r\n<p>Complimentary water&nbsp;&nbsp;Extensive vegan menu</p>\r\n\r\n<p>&nbsp;Extensive gluten-free menu <s>Complimentary tea and coffee</s></p>\r\n\r\n<p>Buyout fee for external catering</p>\r\n',5,100,'',1,NULL),
	(6,103,'Venue 2','','',5,50,'',0,NULL);

/*!40000 ALTER TABLE `tbl_venue` ENABLE KEYS */;
UNLOCK TABLES;


# Dump of table tbl_venue_options
# ------------------------------------------------------------

DROP TABLE IF EXISTS `tbl_venue_options`;

CREATE TABLE `tbl_venue_options` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) DEFAULT NULL,
  `price` double DEFAULT NULL,
  `description` text,
  `hour` int(11) DEFAULT NULL,
  `venue_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

LOCK TABLES `tbl_venue_options` WRITE;
/*!40000 ALTER TABLE `tbl_venue_options` DISABLE KEYS */;

INSERT INTO `tbl_venue_options` (`id`, `name`, `price`, `description`, `hour`, `venue_id`)
VALUES
	(1,'Hall',300,'',1,1),
	(2,'Main room',500,'',1,1),
	(3,'Small room',200,'blah blah blah',1,1),
	(4,'One room',500,'',1,1),
	(5,'Second room',700,'',1,1),
	(6,'Hall',700,'',1,6),
	(7,'1 room',100,'',1,6),
	(8,'2 room',320,'',2,6);

/*!40000 ALTER TABLE `tbl_venue_options` ENABLE KEYS */;
UNLOCK TABLES;


# Dump of table tbl_venue_orders
# ------------------------------------------------------------

DROP TABLE IF EXISTS `tbl_venue_orders`;

CREATE TABLE `tbl_venue_orders` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `venue_id` int(11) DEFAULT NULL,
  `order_id` int(11) DEFAULT NULL,
  `price` double DEFAULT NULL,
  `event_date` date DEFAULT NULL,
  `start_time` time DEFAULT NULL,
  `end_time` time DEFAULT NULL,
  `customer_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

LOCK TABLES `tbl_venue_orders` WRITE;
/*!40000 ALTER TABLE `tbl_venue_orders` DISABLE KEYS */;

INSERT INTO `tbl_venue_orders` (`id`, `venue_id`, `order_id`, `price`, `event_date`, `start_time`, `end_time`, `customer_id`)
VALUES
	(1,6,10,700,'2019-01-31','10:30:00','11:30:00',3);

/*!40000 ALTER TABLE `tbl_venue_orders` ENABLE KEYS */;
UNLOCK TABLES;


# Dump of table tbl_venue_photos
# ------------------------------------------------------------

DROP TABLE IF EXISTS `tbl_venue_photos`;

CREATE TABLE `tbl_venue_photos` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `venue_id` int(11) DEFAULT NULL,
  `photo` varchar(255) DEFAULT NULL,
  `type` varchar(10) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

LOCK TABLES `tbl_venue_photos` WRITE;
/*!40000 ALTER TABLE `tbl_venue_photos` DISABLE KEYS */;

INSERT INTO `tbl_venue_photos` (`id`, `venue_id`, `photo`, `type`)
VALUES
	(1,1,'b5578785160d26bca1d2b7c99c44a5ca.jpg','main');

/*!40000 ALTER TABLE `tbl_venue_photos` ENABLE KEYS */;
UNLOCK TABLES;



/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
