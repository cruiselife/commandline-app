-- --------------------------------------------------------
-- Host:                         127.0.0.1
-- Server versie:                10.4.10-MariaDB - mariadb.org binary distribution
-- Server OS:                    Win32
-- HeidiSQL Versie:              11.0.0.5919
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8 */;
/*!50503 SET NAMES utf8mb4 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;

-- Structuur van  tabel planning.activities wordt geschreven
CREATE TABLE IF NOT EXISTS `activities` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `code` varchar(50) NOT NULL,
  `activity` varchar(50) NOT NULL,
  `duration` int(5) NOT NULL DEFAULT 0 COMMENT 'in minuten',
  `wanneer` varchar(45) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

-- Dumpen data van tabel planning.activities: 3 rows
/*!40000 ALTER TABLE `activities` DISABLE KEYS */;
REPLACE INTO `activities` (`id`, `code`, `activity`, `duration`, `wanneer`) VALUES
	(1, 'stz', 'Stofzuigen ', 21, 'Tuesday,Thursday'),
	(2, 'rala', 'Ramen lappen', 35, 'last day month'),
	(3, 'kosch', 'Koelkast schoonmaken', 50, 'first day month');
/*!40000 ALTER TABLE `activities` ENABLE KEYS */;

/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IF(@OLD_FOREIGN_KEY_CHECKS IS NULL, 1, @OLD_FOREIGN_KEY_CHECKS) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
