-- phpMyAdmin SQL Dump
-- version 4.5.2
-- http://www.phpmyadmin.net
--
-- Client :  127.0.0.1
-- Généré le :  Lun 23 Mai 2016 à 15:18
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
-- Structure de la table `competence`
--

DROP TABLE IF EXISTS `competence`;
CREATE TABLE IF NOT EXISTS `competence` (
  `ID_competence` int(11) NOT NULL AUTO_INCREMENT,
  `Nom_competence` int(11) NOT NULL COMMENT 'Exemple : Signaux et systèmes',
  PRIMARY KEY (`ID_competence`),
  UNIQUE KEY `ID_competence` (`ID_competence`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Structure de la table `competencecursus`
--

DROP TABLE IF EXISTS `competencecursus`;
CREATE TABLE IF NOT EXISTS `competencecursus` (
  `ID_Cursus` int(3) NOT NULL,
  `ID_Competence` int(3) NOT NULL,
  PRIMARY KEY (`ID_Cursus`,`ID_Competence`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Structure de la table `cours`
--

DROP TABLE IF EXISTS `cours`;
CREATE TABLE IF NOT EXISTS `cours` (
  `ID_cours` int(4) NOT NULL AUTO_INCREMENT,
  `ID_competence` int(3) NOT NULL,
  `Nom_cours` varchar(55) NOT NULL COMMENT 'Exemple : Transformations',
  `Credits_Cours` float NOT NULL DEFAULT '0',
  PRIMARY KEY (`ID_cours`),
  UNIQUE KEY `ID_cours` (`ID_cours`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Structure de la table `cursus`
--

DROP TABLE IF EXISTS `cursus`;
CREATE TABLE IF NOT EXISTS `cursus` (
  `ID_Cursus` int(3) NOT NULL AUTO_INCREMENT COMMENT 'Exemple : 0 = CIR3 / 1 = CSI-U3 / 2 = CSI3',
  `Nom_Cursus` varchar(55) NOT NULL COMMENT 'Exemple : CSI3',
  PRIMARY KEY (`ID_Cursus`),
  UNIQUE KEY `ID_Cursus` (`ID_Cursus`)
) ENGINE=MyISAM AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

--
-- Contenu de la table `cursus`
--

INSERT INTO `cursus` (`ID_Cursus`, `Nom_Cursus`) VALUES
(1, 'CIR3'),
(2, 'CSI-U3'),
(3, 'CSI3');

-- --------------------------------------------------------

--
-- Structure de la table `epreuve`
--

DROP TABLE IF EXISTS `epreuve`;
CREATE TABLE IF NOT EXISTS `epreuve` (
  `ID_epreuve` int(5) NOT NULL AUTO_INCREMENT,
  `Nom_type` varchar(55) NOT NULL,
  `ID_etudiant` varchar(55) NOT NULL,
  `Note` float NOT NULL,
  `Coeff_epreuve` float NOT NULL,
  PRIMARY KEY (`ID_epreuve`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Structure de la table `etudiant`
--

DROP TABLE IF EXISTS `etudiant`;
CREATE TABLE IF NOT EXISTS `etudiant` (
  `ID_etudiant` varchar(55) NOT NULL,
  `ID_cursus` int(3) NOT NULL,
  PRIMARY KEY (`ID_etudiant`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Structure de la table `evaluation`
--

DROP TABLE IF EXISTS `evaluation`;
CREATE TABLE IF NOT EXISTS `evaluation` (
  `Nom_eval` varchar(100) NOT NULL COMMENT 'Exemple : Théorie',
  `ID_cours` int(4) NOT NULL,
  `Coef_eval` float NOT NULL,
  PRIMARY KEY (`Nom_eval`),
  UNIQUE KEY `Nom_eval` (`Nom_eval`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Structure de la table `type_eval`
--

DROP TABLE IF EXISTS `type_eval`;
CREATE TABLE IF NOT EXISTS `type_eval` (
  `Nom_type` varchar(55) NOT NULL COMMENT 'Exemple : Interrogation',
  `Nom_eval` varchar(55) NOT NULL,
  `Coeff_type_eval` float NOT NULL,
  PRIMARY KEY (`Nom_type`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Structure de la table `utilisateur`
--

DROP TABLE IF EXISTS `utilisateur`;
CREATE TABLE IF NOT EXISTS `utilisateur` (
  `Mail` varchar(55) NOT NULL,
  `ID_etudiant` varchar(55) NOT NULL,
  `Autorité` int(1) NOT NULL,
  `Nom` varchar(55) NOT NULL,
  `Prénom` varchar(55) NOT NULL,
  PRIMARY KEY (`Mail`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
