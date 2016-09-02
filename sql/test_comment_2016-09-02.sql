# ************************************************************
# Sequel Pro SQL dump
# Версия 4541
#
# http://www.sequelpro.com/
# https://github.com/sequelpro/sequelpro
#
# Адрес: 127.0.0.1 (MySQL 5.7.14-7)
# Схема: test_comment
# Время создания: 2016-09-02 15:00:00 +0000
# ************************************************************


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;


# Дамп таблицы comments
# ------------------------------------------------------------

DROP TABLE IF EXISTS `comments`;

CREATE TABLE `comments` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `tid` int(11) NOT NULL COMMENT 'Òîïèê',
  `pid` int(11) NOT NULL COMMENT 'Ðîäèòåëü',
  `level` int(11) NOT NULL,
  `name` varchar(255) NOT NULL COMMENT 'Èìÿ',
  `email` varchar(255) NOT NULL COMMENT 'E-mail',
  `text` text NOT NULL COMMENT 'Òåêñò',
  `is_published` smallint(6) NOT NULL DEFAULT '1' COMMENT 'Îïóáëèêîâàíî',
  `create_date` datetime NOT NULL COMMENT 'ÃÃ¥ÃªÃ±Ã²',
  `update_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP COMMENT 'ÃÃ¥ÃªÃ±Ã²',
  PRIMARY KEY (`id`),
  KEY `tid_key` (`tid`),
  KEY `pid_key` (`pid`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;



# Дамп таблицы migration
# ------------------------------------------------------------

DROP TABLE IF EXISTS `migration`;

CREATE TABLE `migration` (
  `version` varchar(180) NOT NULL,
  `apply_time` int(11) DEFAULT NULL,
  PRIMARY KEY (`version`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

LOCK TABLES `migration` WRITE;
/*!40000 ALTER TABLE `migration` DISABLE KEYS */;

INSERT INTO `migration` (`version`, `apply_time`)
VALUES
	('m000000_000000_base',1472725421),
	('m160901_100702_topic',1472725422),
	('m160901_101518_comments',1472725422),
	('m160902_072914_add_topic',1472801616),
	('m160902_084926_add_colum_level_comment',1472806333);

/*!40000 ALTER TABLE `migration` ENABLE KEYS */;
UNLOCK TABLES;


# Дамп таблицы topic
# ------------------------------------------------------------

DROP TABLE IF EXISTS `topic`;

CREATE TABLE `topic` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `alias` varchar(255) NOT NULL,
  `text` text NOT NULL,
  `is_published` smallint(6) DEFAULT '0',
  `author` varchar(255) NOT NULL,
  `create_date` datetime NOT NULL,
  `update_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  KEY `alias_key` (`alias`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

LOCK TABLES `topic` WRITE;
/*!40000 ALTER TABLE `topic` DISABLE KEYS */;

INSERT INTO `topic` (`id`, `name`, `alias`, `text`, `is_published`, `author`, `create_date`, `update_date`)
VALUES
	(1,'Lorem Ipsum1','topic1','<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Fusce maximus urna nibh, quis laoreet ex tincidunt mollis. Nullam mauris tellus, venenatis et urna ut, malesuada ullamcorper mi. Nulla commodo pharetra augue, sed suscipit lorem placerat at. Quisque non vehicula sapien. In eget urna ac augue placerat laoreet. Ut nec justo porta, imperdiet leo at, ultrices lacus. Aliquam pharetra ultrices mauris, sit amet faucibus urna volutpat quis. Cras posuere, ex non mollis pulvinar, lorem tellus pellentesque mauris, non varius velit risus eu nunc. Donec id vulputate dolor. Donec varius, est quis sodales dignissim, sapien lectus feugiat dolor, ac accumsan velit neque in risus. Fusce varius arcu id sem faucibus dictum. Etiam et semper justo, et feugiat sem. Nulla molestie quis felis in vestibulum. Praesent tellus tortor, lobortis vel tempus sed, blandit non purus.</p>\n                <p>Quisque mollis sem ac tortor dapibus eleifend. Pellentesque habitant morbi tristique senectus et netus et malesuada fames ac turpis egestas. Etiam non sem placerat, fermentum nisl at, lacinia nibh. Donec ac convallis nulla. Morbi hendrerit ex ac libero egestas, nec tempus felis pulvinar. Aenean ac dolor id felis congue congue non id lectus. Nam varius suscipit consectetur. Integer sit amet arcu libero. Duis massa quam, dignissim ut cursus ac, pellentesque vitae ex. Quisque molestie mollis urna, quis facilisis magna faucibus ut. Pellentesque eget lectus lacinia, tristique ipsum eu, feugiat tortor.</p>\n                <p>Aenean arcu purus, fermentum sed vehicula et, feugiat in odio. Vivamus scelerisque bibendum lacus, a efficitur magna tempus pretium. Pellentesque finibus libero nec augue dignissim, nec tincidunt urna pulvinar. Aliquam erat volutpat. Vestibulum fringilla rhoncus pretium. Proin odio ante, volutpat ut nunc ac, ornare aliquet ex. Duis porta consequat diam eget tincidunt. Mauris lacus magna, auctor finibus metus in, fringilla mattis lorem. Nunc sit amet fermentum eros. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Donec sed leo sapien. Proin sagittis dui sit amet nibh rhoncus, eget blandit metus hendrerit. Aliquam imperdiet facilisis ante at pulvinar. Morbi cursus vulputate nibh. Proin et erat convallis, blandit ante nec, sollicitudin nulla. Pellentesque at laoreet dui.</p>',1,'','2016-09-02 10:33:36','2016-09-02 10:33:36'),
	(2,'Lorem Ipsum2','topic2','<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Fusce maximus urna nibh, quis laoreet ex tincidunt mollis. Nullam mauris tellus, venenatis et urna ut, malesuada ullamcorper mi. Nulla commodo pharetra augue, sed suscipit lorem placerat at. Quisque non vehicula sapien. In eget urna ac augue placerat laoreet. Ut nec justo porta, imperdiet leo at, ultrices lacus. Aliquam pharetra ultrices mauris, sit amet faucibus urna volutpat quis. Cras posuere, ex non mollis pulvinar, lorem tellus pellentesque mauris, non varius velit risus eu nunc. Donec id vulputate dolor. Donec varius, est quis sodales dignissim, sapien lectus feugiat dolor, ac accumsan velit neque in risus. Fusce varius arcu id sem faucibus dictum. Etiam et semper justo, et feugiat sem. Nulla molestie quis felis in vestibulum. Praesent tellus tortor, lobortis vel tempus sed, blandit non purus.</p>\n                <p>Quisque mollis sem ac tortor dapibus eleifend. Pellentesque habitant morbi tristique senectus et netus et malesuada fames ac turpis egestas. Etiam non sem placerat, fermentum nisl at, lacinia nibh. Donec ac convallis nulla. Morbi hendrerit ex ac libero egestas, nec tempus felis pulvinar. Aenean ac dolor id felis congue congue non id lectus. Nam varius suscipit consectetur. Integer sit amet arcu libero. Duis massa quam, dignissim ut cursus ac, pellentesque vitae ex. Quisque molestie mollis urna, quis facilisis magna faucibus ut. Pellentesque eget lectus lacinia, tristique ipsum eu, feugiat tortor.</p>\n                <p>Aenean arcu purus, fermentum sed vehicula et, feugiat in odio. Vivamus scelerisque bibendum lacus, a efficitur magna tempus pretium. Pellentesque finibus libero nec augue dignissim, nec tincidunt urna pulvinar. Aliquam erat volutpat. Vestibulum fringilla rhoncus pretium. Proin odio ante, volutpat ut nunc ac, ornare aliquet ex. Duis porta consequat diam eget tincidunt. Mauris lacus magna, auctor finibus metus in, fringilla mattis lorem. Nunc sit amet fermentum eros. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Donec sed leo sapien. Proin sagittis dui sit amet nibh rhoncus, eget blandit metus hendrerit. Aliquam imperdiet facilisis ante at pulvinar. Morbi cursus vulputate nibh. Proin et erat convallis, blandit ante nec, sollicitudin nulla. Pellentesque at laoreet dui.</p>',1,'','2016-09-02 10:33:36','2016-09-02 10:33:36'),
	(3,'Lorem Ipsum3','topic3','<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Fusce maximus urna nibh, quis laoreet ex tincidunt mollis. Nullam mauris tellus, venenatis et urna ut, malesuada ullamcorper mi. Nulla commodo pharetra augue, sed suscipit lorem placerat at. Quisque non vehicula sapien. In eget urna ac augue placerat laoreet. Ut nec justo porta, imperdiet leo at, ultrices lacus. Aliquam pharetra ultrices mauris, sit amet faucibus urna volutpat quis. Cras posuere, ex non mollis pulvinar, lorem tellus pellentesque mauris, non varius velit risus eu nunc. Donec id vulputate dolor. Donec varius, est quis sodales dignissim, sapien lectus feugiat dolor, ac accumsan velit neque in risus. Fusce varius arcu id sem faucibus dictum. Etiam et semper justo, et feugiat sem. Nulla molestie quis felis in vestibulum. Praesent tellus tortor, lobortis vel tempus sed, blandit non purus.</p>\n                <p>Quisque mollis sem ac tortor dapibus eleifend. Pellentesque habitant morbi tristique senectus et netus et malesuada fames ac turpis egestas. Etiam non sem placerat, fermentum nisl at, lacinia nibh. Donec ac convallis nulla. Morbi hendrerit ex ac libero egestas, nec tempus felis pulvinar. Aenean ac dolor id felis congue congue non id lectus. Nam varius suscipit consectetur. Integer sit amet arcu libero. Duis massa quam, dignissim ut cursus ac, pellentesque vitae ex. Quisque molestie mollis urna, quis facilisis magna faucibus ut. Pellentesque eget lectus lacinia, tristique ipsum eu, feugiat tortor.</p>\n                <p>Aenean arcu purus, fermentum sed vehicula et, feugiat in odio. Vivamus scelerisque bibendum lacus, a efficitur magna tempus pretium. Pellentesque finibus libero nec augue dignissim, nec tincidunt urna pulvinar. Aliquam erat volutpat. Vestibulum fringilla rhoncus pretium. Proin odio ante, volutpat ut nunc ac, ornare aliquet ex. Duis porta consequat diam eget tincidunt. Mauris lacus magna, auctor finibus metus in, fringilla mattis lorem. Nunc sit amet fermentum eros. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Donec sed leo sapien. Proin sagittis dui sit amet nibh rhoncus, eget blandit metus hendrerit. Aliquam imperdiet facilisis ante at pulvinar. Morbi cursus vulputate nibh. Proin et erat convallis, blandit ante nec, sollicitudin nulla. Pellentesque at laoreet dui.</p>',1,'','2016-09-02 10:33:36','2016-09-02 10:33:36'),
	(4,'Lorem Ipsum4','topic4','<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Fusce maximus urna nibh, quis laoreet ex tincidunt mollis. Nullam mauris tellus, venenatis et urna ut, malesuada ullamcorper mi. Nulla commodo pharetra augue, sed suscipit lorem placerat at. Quisque non vehicula sapien. In eget urna ac augue placerat laoreet. Ut nec justo porta, imperdiet leo at, ultrices lacus. Aliquam pharetra ultrices mauris, sit amet faucibus urna volutpat quis. Cras posuere, ex non mollis pulvinar, lorem tellus pellentesque mauris, non varius velit risus eu nunc. Donec id vulputate dolor. Donec varius, est quis sodales dignissim, sapien lectus feugiat dolor, ac accumsan velit neque in risus. Fusce varius arcu id sem faucibus dictum. Etiam et semper justo, et feugiat sem. Nulla molestie quis felis in vestibulum. Praesent tellus tortor, lobortis vel tempus sed, blandit non purus.</p>\n                <p>Quisque mollis sem ac tortor dapibus eleifend. Pellentesque habitant morbi tristique senectus et netus et malesuada fames ac turpis egestas. Etiam non sem placerat, fermentum nisl at, lacinia nibh. Donec ac convallis nulla. Morbi hendrerit ex ac libero egestas, nec tempus felis pulvinar. Aenean ac dolor id felis congue congue non id lectus. Nam varius suscipit consectetur. Integer sit amet arcu libero. Duis massa quam, dignissim ut cursus ac, pellentesque vitae ex. Quisque molestie mollis urna, quis facilisis magna faucibus ut. Pellentesque eget lectus lacinia, tristique ipsum eu, feugiat tortor.</p>\n                <p>Aenean arcu purus, fermentum sed vehicula et, feugiat in odio. Vivamus scelerisque bibendum lacus, a efficitur magna tempus pretium. Pellentesque finibus libero nec augue dignissim, nec tincidunt urna pulvinar. Aliquam erat volutpat. Vestibulum fringilla rhoncus pretium. Proin odio ante, volutpat ut nunc ac, ornare aliquet ex. Duis porta consequat diam eget tincidunt. Mauris lacus magna, auctor finibus metus in, fringilla mattis lorem. Nunc sit amet fermentum eros. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Donec sed leo sapien. Proin sagittis dui sit amet nibh rhoncus, eget blandit metus hendrerit. Aliquam imperdiet facilisis ante at pulvinar. Morbi cursus vulputate nibh. Proin et erat convallis, blandit ante nec, sollicitudin nulla. Pellentesque at laoreet dui.</p>',1,'','2016-09-02 10:33:36','2016-09-02 10:33:36'),
	(5,'Lorem Ipsum5','topic5','<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Fusce maximus urna nibh, quis laoreet ex tincidunt mollis. Nullam mauris tellus, venenatis et urna ut, malesuada ullamcorper mi. Nulla commodo pharetra augue, sed suscipit lorem placerat at. Quisque non vehicula sapien. In eget urna ac augue placerat laoreet. Ut nec justo porta, imperdiet leo at, ultrices lacus. Aliquam pharetra ultrices mauris, sit amet faucibus urna volutpat quis. Cras posuere, ex non mollis pulvinar, lorem tellus pellentesque mauris, non varius velit risus eu nunc. Donec id vulputate dolor. Donec varius, est quis sodales dignissim, sapien lectus feugiat dolor, ac accumsan velit neque in risus. Fusce varius arcu id sem faucibus dictum. Etiam et semper justo, et feugiat sem. Nulla molestie quis felis in vestibulum. Praesent tellus tortor, lobortis vel tempus sed, blandit non purus.</p>\n                <p>Quisque mollis sem ac tortor dapibus eleifend. Pellentesque habitant morbi tristique senectus et netus et malesuada fames ac turpis egestas. Etiam non sem placerat, fermentum nisl at, lacinia nibh. Donec ac convallis nulla. Morbi hendrerit ex ac libero egestas, nec tempus felis pulvinar. Aenean ac dolor id felis congue congue non id lectus. Nam varius suscipit consectetur. Integer sit amet arcu libero. Duis massa quam, dignissim ut cursus ac, pellentesque vitae ex. Quisque molestie mollis urna, quis facilisis magna faucibus ut. Pellentesque eget lectus lacinia, tristique ipsum eu, feugiat tortor.</p>\n                <p>Aenean arcu purus, fermentum sed vehicula et, feugiat in odio. Vivamus scelerisque bibendum lacus, a efficitur magna tempus pretium. Pellentesque finibus libero nec augue dignissim, nec tincidunt urna pulvinar. Aliquam erat volutpat. Vestibulum fringilla rhoncus pretium. Proin odio ante, volutpat ut nunc ac, ornare aliquet ex. Duis porta consequat diam eget tincidunt. Mauris lacus magna, auctor finibus metus in, fringilla mattis lorem. Nunc sit amet fermentum eros. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Donec sed leo sapien. Proin sagittis dui sit amet nibh rhoncus, eget blandit metus hendrerit. Aliquam imperdiet facilisis ante at pulvinar. Morbi cursus vulputate nibh. Proin et erat convallis, blandit ante nec, sollicitudin nulla. Pellentesque at laoreet dui.</p>',1,'','2016-09-02 10:33:36','2016-09-02 10:33:36');

/*!40000 ALTER TABLE `topic` ENABLE KEYS */;
UNLOCK TABLES;



/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
