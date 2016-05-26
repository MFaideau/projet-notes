-- phpMyAdmin SQL Dump
-- version 4.5.2
-- http://www.phpmyadmin.net
--
-- Client :  127.0.0.1
-- Généré le :  Jeu 26 Mai 2016 à 17:24
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
-- Structure de la table `absence`
--

DROP TABLE IF EXISTS `absence`;
CREATE TABLE IF NOT EXISTS `absence` (
  `ID_Absence` int(5) NOT NULL AUTO_INCREMENT,
  `ID_Etudiant` varchar(55) NOT NULL,
  `Date_Absence` date NOT NULL,
  `Nombre_Heures_Absence` float NOT NULL,
  `Excusee` int(1) NOT NULL COMMENT '0 = Non excusée // 1 = Excusée',
  PRIMARY KEY (`ID_Absence`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Structure de la table `competence`
--

DROP TABLE IF EXISTS `competence`;
CREATE TABLE IF NOT EXISTS `competence` (
  `ID_Competence` int(5) NOT NULL AUTO_INCREMENT,
  `Nom_Competence` varchar(55) NOT NULL,
  PRIMARY KEY (`ID_Competence`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

--
-- Contenu de la table `competence`
--

INSERT INTO `competence` (`ID_Competence`, `Nom_Competence`) VALUES
(1, 'Physique, Electronique, Nanotechnologies'),
(2, 'Signaux & Systèmes');

-- --------------------------------------------------------

--
-- Structure de la table `competencecursus`
--

DROP TABLE IF EXISTS `competencecursus`;
CREATE TABLE IF NOT EXISTS `competencecursus` (
  `ID_Cursus` int(5) NOT NULL,
  `ID_Competence` int(5) NOT NULL,
  PRIMARY KEY (`ID_Cursus`,`ID_Competence`),
  KEY `ID_Competence` (`ID_Competence`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Contenu de la table `competencecursus`
--

INSERT INTO `competencecursus` (`ID_Cursus`, `ID_Competence`) VALUES
(1, 1),
(1, 2);

-- --------------------------------------------------------

--
-- Structure de la table `cours`
--

DROP TABLE IF EXISTS `cours`;
CREATE TABLE IF NOT EXISTS `cours` (
  `ID_Cours` int(5) NOT NULL AUTO_INCREMENT,
  `ID_Competence` int(5) NOT NULL,
  `Nom_Cours` varchar(55) NOT NULL,
  `Credits_Cours` float NOT NULL,
  `Semestre_Cours` int(1) NOT NULL COMMENT '0 = 2 semestres ; 1 = Semestre 1 ; 2 = Semestre 2',
  PRIMARY KEY (`ID_Cours`),
  KEY `ID_Competence` (`ID_Competence`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

--
-- Contenu de la table `cours`
--

INSERT INTO `cours` (`ID_Cours`, `ID_Competence`, `Nom_Cours`, `Credits_Cours`, `Semestre_Cours`) VALUES
(1, 1, 'Mécanique Quantique - Laser', 2.5, 1),
(2, 1, 'Physique des solides - Nanosciences', 2, 2);

-- --------------------------------------------------------

--
-- Structure de la table `cursus`
--

DROP TABLE IF EXISTS `cursus`;
CREATE TABLE IF NOT EXISTS `cursus` (
  `ID_Cursus` int(5) NOT NULL AUTO_INCREMENT,
  `Nom_Cursus` varchar(55) NOT NULL,
  `Cursus_Annee` year(4) NOT NULL COMMENT '"2015" pour l''année de septembre 2015 à juin 2016 par exemple',
  PRIMARY KEY (`ID_Cursus`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

--
-- Contenu de la table `cursus`
--

INSERT INTO `cursus` (`ID_Cursus`, `Nom_Cursus`, `Cursus_Annee`) VALUES
(1, 'CSI3', 0000),
(2, 'CSI-U3', 0000),
(3, 'CIR3', 0000);

-- --------------------------------------------------------

--
-- Structure de la table `epreuve`
--

DROP TABLE IF EXISTS `epreuve`;
CREATE TABLE IF NOT EXISTS `epreuve` (
  `ID_Epreuve` int(5) NOT NULL AUTO_INCREMENT,
  `ID_Type` int(5) NOT NULL,
  `Nom_Epreuve` varchar(255) NOT NULL,
  `Coef_Epreuve` float NOT NULL,
  `Date_Epreuve` date NOT NULL,
  `Evaluateur_Epreuve` varchar(255) NOT NULL,
  PRIMARY KEY (`ID_Epreuve`),
  KEY `ID_Type` (`ID_Type`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=latin1;

--
-- Contenu de la table `epreuve`
--

INSERT INTO `epreuve` (`ID_Epreuve`, `ID_Type`, `Nom_Epreuve`, `Coef_Epreuve`, `Date_Epreuve`, `Evaluateur_Epreuve`) VALUES
(5, 1, 'Interrogation CSI3 Ondes et Mécanique Quantique (partie Ondes)', 1, '0000-00-00', 'Xavier Wallart');

-- --------------------------------------------------------

--
-- Structure de la table `epreuvesession`
--

DROP TABLE IF EXISTS `epreuvesession`;
CREATE TABLE IF NOT EXISTS `epreuvesession` (
  `ID_Epreuve_Session1` int(5) NOT NULL,
  `ID_Epreuve_Session_2` int(5) NOT NULL,
  PRIMARY KEY (`ID_Epreuve_Session1`,`ID_Epreuve_Session_2`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Structure de la table `etudiant`
--

DROP TABLE IF EXISTS `etudiant`;
CREATE TABLE IF NOT EXISTS `etudiant` (
  `ID_Etudiant` varchar(55) NOT NULL,
  `ID_Cursus` int(5) NOT NULL,
  `Mail` varchar(55) NOT NULL,
  PRIMARY KEY (`ID_Etudiant`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Contenu de la table `etudiant`
--

INSERT INTO `etudiant` (`ID_Etudiant`, `ID_Cursus`, `Mail`) VALUES
('p59051', 1, 'maxence.faideau@isen-lille.fr'),
('p59060', 1, 'antoine.goelzer@isen-lille.fr'),
('p59062', 1, 'joel.guillem@isen-lille.fr'),
('p59080', 1, 'baudouin.landais@isen-lille.fr');

-- --------------------------------------------------------

--
-- Structure de la table `etudiantnote`
--

DROP TABLE IF EXISTS `etudiantnote`;
CREATE TABLE IF NOT EXISTS `etudiantnote` (
  `ID_Epreuve` int(5) NOT NULL,
  `ID_Etudiant` varchar(55) NOT NULL,
  `Note_Finale` float NOT NULL,
  `Note_Prevue` float NOT NULL,
  `Absence_Epreuve` int(1) NOT NULL COMMENT '0 = Pas d''absence // 1 = Absence excusée // 2 = Absence non excusee',
  PRIMARY KEY (`ID_Epreuve`,`ID_Etudiant`),
  KEY `ID_Epreuve` (`ID_Epreuve`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Contenu de la table `etudiantnote`
--

INSERT INTO `etudiantnote` (`ID_Epreuve`, `ID_Etudiant`, `Note_Finale`, `Note_Prevue`, `Absence_Epreuve`) VALUES
(5, 'p59051', 6.3, 7, 0),
(5, 'p59060', 12.6, 10, 0),
(5, 'p59062', 11.9, 6, 0),
(5, 'p59080', 13.3, 9, 0);

-- --------------------------------------------------------

--
-- Structure de la table `evaluation`
--

DROP TABLE IF EXISTS `evaluation`;
CREATE TABLE IF NOT EXISTS `evaluation` (
  `ID_Eval` int(5) NOT NULL AUTO_INCREMENT,
  `ID_Cours` int(5) NOT NULL,
  `Nom_Eval` varchar(55) NOT NULL,
  `Coef_Eval` float NOT NULL,
  PRIMARY KEY (`ID_Eval`),
  KEY `ID_Cours` (`ID_Cours`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

--
-- Contenu de la table `evaluation`
--

INSERT INTO `evaluation` (`ID_Eval`, `ID_Cours`, `Nom_Eval`, `Coef_Eval`) VALUES
(1, 1, 'Théorie', 1);

-- --------------------------------------------------------

--
-- Structure de la table `type_eval`
--

DROP TABLE IF EXISTS `type_eval`;
CREATE TABLE IF NOT EXISTS `type_eval` (
  `ID_Type` int(5) NOT NULL AUTO_INCREMENT,
  `ID_Eval` int(5) NOT NULL,
  `Nom_Type` varchar(55) NOT NULL,
  `Coef_Type_Eval` float NOT NULL,
  PRIMARY KEY (`ID_Type`),
  KEY `ID_Eval` (`ID_Eval`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

--
-- Contenu de la table `type_eval`
--

INSERT INTO `type_eval` (`ID_Type`, `ID_Eval`, `Nom_Type`, `Coef_Type_Eval`) VALUES
(1, 1, 'Interrogation', 0.2),
(2, 1, 'DS', 0.3),
(3, 1, 'Partiel', 0.5);

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
