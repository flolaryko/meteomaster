-- --------------------------------------------------------
-- Hôte:                         127.0.0.1
-- Version du serveur:           5.7.33 - MySQL Community Server (GPL)
-- SE du serveur:                Win64
-- HeidiSQL Version:             11.2.0.6213
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8 */;
/*!50503 SET NAMES utf8mb4 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;


-- Listage de la structure de la base pour meteoscan
DROP DATABASE IF EXISTS `meteoscan`;
CREATE DATABASE IF NOT EXISTS `meteoscan` /*!40100 DEFAULT CHARACTER SET latin1 */;
USE `meteoscan`;

-- Listage de la structure de la table meteoscan. lieu
DROP TABLE IF EXISTS `lieu`;
CREATE TABLE IF NOT EXISTS `lieu` (
  `id_lieu` int(11) NOT NULL AUTO_INCREMENT,
  `libelle_lieu` varchar(50) DEFAULT NULL,
  `longitude` double DEFAULT NULL,
  `latitude` double DEFAULT NULL,
  PRIMARY KEY (`id_lieu`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=latin1;

-- Listage des données de la table meteoscan.lieu : ~3 rows (environ)
DELETE FROM `lieu`;
/*!40000 ALTER TABLE `lieu` DISABLE KEYS */;
INSERT INTO `lieu` (`id_lieu`, `libelle_lieu`, `longitude`, `latitude`) VALUES
	(1, 'Prado', 5.3875508308410645, 43.27064514160156),
	(2, 'Vieux Port', 5.365148067474365, 43.29530715942383),
	(3, 'La Treille', 5.509387016296387, 43.31562805175781),
	(5, 'toto', 12, 12);
/*!40000 ALTER TABLE `lieu` ENABLE KEYS */;

-- Listage de la structure de la table meteoscan. mesure
DROP TABLE IF EXISTS `mesure`;
CREATE TABLE IF NOT EXISTS `mesure` (
  `id_mesure` int(11) NOT NULL AUTO_INCREMENT,
  `temperature` float DEFAULT NULL,
  `temperature_res` float DEFAULT NULL,
  `pression` float DEFAULT NULL,
  `humidite` int(3) DEFAULT NULL,
  `vitesse_vent` float DEFAULT NULL,
  `direction_vent` float DEFAULT NULL,
  `rafale_vent` float DEFAULT NULL,
  `nebulosite` float DEFAULT NULL,
  `visibilite` int(11) DEFAULT NULL,
  `pluie_h` float DEFAULT '0',
  `pluie_3h` float DEFAULT '0',
  `leve_soleil` time DEFAULT NULL,
  `couche_soleil` time DEFAULT NULL,
  `date_mesure` date DEFAULT NULL,
  `heure_mesure` time DEFAULT NULL,
  `id_lieu` int(11) DEFAULT NULL,
  `id_meteo` int(11) DEFAULT NULL,
  PRIMARY KEY (`id_mesure`),
  KEY `FK_mesure_lieu` (`id_lieu`),
  KEY `FK_mesure_meteo` (`id_meteo`),
  CONSTRAINT `FK_mesure_lieu` FOREIGN KEY (`id_lieu`) REFERENCES `lieu` (`id_lieu`),
  CONSTRAINT `FK_mesure_meteo` FOREIGN KEY (`id_meteo`) REFERENCES `meteo` (`id_meteo`)
) ENGINE=InnoDB AUTO_INCREMENT=57 DEFAULT CHARSET=latin1;

-- Listage des données de la table meteoscan.mesure : ~22 rows (environ)
DELETE FROM `mesure`;
/*!40000 ALTER TABLE `mesure` DISABLE KEYS */;
INSERT INTO `mesure` (`id_mesure`, `temperature`, `temperature_res`, `pression`, `humidite`, `vitesse_vent`, `direction_vent`, `rafale_vent`, `nebulosite`, `visibilite`, `pluie_h`, `pluie_3h`, `leve_soleil`, `couche_soleil`, `date_mesure`, `heure_mesure`, `id_lieu`, `id_meteo`) VALUES
	(30, 8.95, 7.07, 1026, 61, 3.3, 335, 3.86, 0, 10000, 0, 0, '07:00:12', '16:41:27', '2022-01-26', '17:31:44', 1, 2),
	(31, 9.03, 8.5, 1026, 57, 1.54, 0, 0, 0, 10000, 0, 0, '07:00:22', '16:41:28', '2022-01-26', '17:31:44', 2, 2),
	(32, 7.45, 7.45, 1026, 62, 1.3, 5, 1.43, 0, 10000, 0, 0, '06:59:50', '16:40:50', '2022-01-26', '17:31:45', 3, 2),
	(33, 8.4, 8.4, 1027, 78, 0.89, 360, 1.69, 11, 10000, 0, 0, '06:59:19', '16:42:46', '2022-01-27', '09:56:31', 1, 3),
	(34, 0, 7.38, 1027, 79, 1.54, 360, 0, 11, 9000, 0, 0, '06:59:28', '16:42:48', '2022-01-27', '09:56:31', 2, 3),
	(35, 1, 8.19, 1027, 78, 0.43, 105, 1.21, 17, 10000, 0, 0, '06:58:57', '16:42:10', '2022-01-27', '09:56:31', 3, 3),
	(36, 6.97, 4.53, 1026, 80, 3.55, 341, 3.79, 45, 10000, 0, 0, '06:58:24', '16:44:07', '2022-01-28', '10:00:26', 1, 5),
	(37, 6.88, 6.04, 1027, 73, 1.54, 300, 0, 0, 10000, 0, 0, '06:58:33', '16:44:09', '2022-01-28', '10:00:27', 2, 1),
	(38, 21, 4.95, 1026, 80, 1.8, 347, 2.12, 44, 10000, 0, 0, '06:58:01', '16:43:31', '2022-01-28', '10:00:28', 3, 5),
	(39, 22.6, 7.51, 1026, 70, 3.09, 346, 3.5, 37, 10000, 0, 0, '06:58:24', '16:44:07', '2022-01-25', '10:48:17', 1, 5),
	(40, 16, 9.09, 1027, 64, 0.51, 0, 0, 0, 10000, 0, 0, '06:58:33', '16:44:09', '2022-01-25', '10:48:17', 2, 1),
	(41, 23.4, 8.26, 1026, 70, 1.43, 353, 2.13, 36, 10000, 0, 0, '06:58:01', '16:43:31', '2022-01-25', '10:48:18', 3, 5),
	(45, 2.03, -0.94, 1028, 56, 2.85, 1, 2.94, 10, 10000, 0, 0, '06:58:24', '16:44:07', '2022-01-28', '22:26:35', 1, 2),
	(46, 2.29, 2.29, 1030, 80, 1.03, 0, 0, 0, 10000, 0, 0, '06:58:33', '16:44:09', '2022-01-28', '22:26:36', 2, 2),
	(47, 0.5, -1.94, 1029, 51, 2, 30, 1.89, 13, 10000, 0, 0, '06:58:01', '16:43:31', '2022-01-28', '22:26:36', 3, 4),
	(48, 11.37, 9.69, 1019, 43, 9.83, 293, 14.31, 0, 10000, 0, 0, '06:53:19', '16:50:53', '2022-02-02', '08:11:22', 1, 1),
	(49, 11.38, 9.85, 1019, 49, 9.83, 293, 14.31, 0, 10000, 0, 0, '06:53:28', '16:50:55', '2022-02-02', '08:11:23', 2, 1),
	(50, 22, 8.85, 1017, 55, 9.83, 293, 14.31, 0, 10000, 0, 0, '06:52:56', '16:50:17', '2022-02-02', '08:11:23', 3, 1),
	(51, 12, 10.35, 1019, 42, 5.81, 319, 16.99, 0, 10000, 0, 0, '06:53:19', '16:50:53', '2022-02-02', '09:39:12', 1, 1),
	(52, 12.02, 10.53, 1019, 48, 5.81, 319, 16.99, 0, 10000, 0, 0, '06:53:28', '16:50:55', '2022-02-02', '09:40:12', 2, 1),
	(53, 10.94, 9.5, 1017, 54, 5.81, 319, 16.99, 0, 10000, 0, 0, '06:52:56', '16:50:17', '2022-02-02', '09:40:13', 3, 1),
	(54, 13.82, 12.75, 1017, 57, 9.39, 323, 20.56, 1, 10000, 0, 0, '06:53:19', '16:50:53', '2022-02-02', '10:34:53', 1, 1),
	(55, 13.82, 12.75, 1018, 57, 9.39, 323, 20.56, 0, 10000, 0, 0, '06:53:28', '16:50:55', '2022-02-02', '10:34:53', 2, 1),
	(56, 13.02, 12, 1017, 62, 9.39, 323, 20.56, 1, 10000, 0, 0, '06:52:56', '16:50:17', '2022-02-02', '10:34:54', 3, 1);
/*!40000 ALTER TABLE `mesure` ENABLE KEYS */;

-- Listage de la structure de la table meteoscan. meteo
DROP TABLE IF EXISTS `meteo`;
CREATE TABLE IF NOT EXISTS `meteo` (
  `id_meteo` int(11) NOT NULL AUTO_INCREMENT,
  `icon` varchar(10) NOT NULL DEFAULT 'default',
  `libelle_meteo` varchar(50) DEFAULT NULL,
  `description` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`id_meteo`)
) ENGINE=InnoDB AUTO_INCREMENT=19 DEFAULT CHARSET=latin1;

-- Listage des données de la table meteoscan.meteo : ~18 rows (environ)
DELETE FROM `meteo`;
/*!40000 ALTER TABLE `meteo` DISABLE KEYS */;
INSERT INTO `meteo` (`id_meteo`, `icon`, `libelle_meteo`, `description`) VALUES
	(1, '01d', NULL, 'Ciel clair'),
	(2, '01n', NULL, 'Ciel clair'),
	(3, '02d', NULL, 'Quelques nuages'),
	(4, '02n', NULL, 'Quelques nuages'),
	(5, '03d', NULL, 'Nuages dispersés'),
	(6, '03n', NULL, 'Nuages dispersés'),
	(7, '04d', NULL, 'Nuages orageux'),
	(8, '04n', NULL, 'Nuages orageux'),
	(9, '09d', NULL, 'Pluie forte'),
	(10, '09n', NULL, 'Pluie forte'),
	(11, '10d', NULL, 'Pluie'),
	(12, '10n', NULL, 'Pluie'),
	(13, '11d', NULL, 'Orage'),
	(14, '11n', NULL, 'Orage'),
	(15, '13d', NULL, 'Neige'),
	(16, '13n', NULL, 'Neige'),
	(17, '50d', NULL, 'Brume'),
	(18, '50n', NULL, 'Brume');
/*!40000 ALTER TABLE `meteo` ENABLE KEYS */;

/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IFNULL(@OLD_FOREIGN_KEY_CHECKS, 1) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40111 SET SQL_NOTES=IFNULL(@OLD_SQL_NOTES, 1) */;
