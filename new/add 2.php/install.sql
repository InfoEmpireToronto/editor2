CREATE TABLE `articles` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(245) COLLATE utf8mb4_general_ci NOT NULL,
  `body` longtext COLLATE utf8mb4_general_ci NOT NULL,
  `metaTitle` varchar(245) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `metaDesc` varchar(245) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `category` varchar(145) COLLATE utf8mb4_general_ci DEFAULT '0',
  `type` varchar(45) COLLATE utf8mb4_general_ci NOT NULL,
  `pubDate` varchar(45) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `active` varchar(45) COLLATE utf8mb4_general_ci DEFAULT '1',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;



