-- phpMyAdmin SQL Dump
-- version 4.5.2
-- http://www.phpmyadmin.net
--
-- Client :  127.0.0.1
-- Généré le :  Mar 24 Mai 2016 à 09:11
-- Version du serveur :  5.7.9
-- Version de PHP :  5.6.16

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données :  `projet_notes`
--

-- --------------------------------------------------------

--
-- Structure de la table `utilisateur`
--

DROP TABLE IF EXISTS `utilisateur`;
CREATE TABLE IF NOT EXISTS `utilisateur` (
  `Mail` varchar(55) NOT NULL,
  `Autorite` int(5) NOT NULL,
  `Nom` varchar(55) NOT NULL,
  `Prenom` varchar(55) NOT NULL,
  PRIMARY KEY (`Mail`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Contenu de la table `utilisateur`
--

INSERT INTO `utilisateur` (`Mail`, `Autorite`, `Nom`, `Prenom`) VALUES
('antoine.goelzer@isen-lille.fr', 0, 'Goelzer', 'Antoine'),
('baudouin.landais@isen-lille.fr', 0, 'Landais', 'Baudouin'),
('joel.guillem@isen-lille.fr', 0, 'Guillem', 'Joël'),
('maxence.faideau@isen-lille.fr', 0, 'Faideau', 'Maxence');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
