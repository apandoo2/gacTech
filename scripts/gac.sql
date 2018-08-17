-- phpMyAdmin SQL Dump
-- version 4.7.4
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1
-- Généré le :  ven. 17 août 2018 à 11:45
-- Version du serveur :  10.1.30-MariaDB
-- Version de PHP :  7.2.1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données :  `gac`
--
CREATE DATABASE IF NOT EXISTS `gac` DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci;
USE `gac`;

DELIMITER $$
--
-- Fonctions
--
CREATE DEFINER=`root`@`localhost` FUNCTION `FormatDate` (`strdate` VARCHAR(12)) RETURNS DATE NO SQL
BEGIN
     Declare Result varchar(50);
     set result := concat(substring(strdate,7,4),'-',substring(strdate,4,2),'-',substring(strdate,1,2));
     Return cast(Result as date);
END$$

DELIMITER ;

-- --------------------------------------------------------

--
-- Structure de la table `detail_appel`
--

CREATE TABLE `detail_appel` (
  `Compte_facture` varchar(11) NOT NULL,
  `Numero_facture` varchar(11) NOT NULL,
  `Numero_abonnee` varchar(11) NOT NULL,
  `Date_facturation` date NOT NULL,
  `Heure_facturation` time NOT NULL,
  `Dure_vol_reel` varchar(15) NOT NULL,
  `Dure_vol_facturee` varchar(15) NOT NULL,
  `Type_facturation` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
