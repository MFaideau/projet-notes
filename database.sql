-- phpMyAdmin SQL Dump
-- version 4.5.2
-- http://www.phpmyadmin.net
--
-- Client :  127.0.0.1
-- Généré le :  Mar 31 Mai 2016 à 11:22
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
  `ID_Cursus` int(5) NOT NULL,
  `Nom_Competence` varchar(55) NOT NULL,
  PRIMARY KEY (`ID_Competence`)
) ENGINE=InnoDB AUTO_INCREMENT=16 DEFAULT CHARSET=latin1;

--
-- Contenu de la table `competence`
--

INSERT INTO `competence` (`ID_Competence`, `ID_Cursus`, `Nom_Competence`) VALUES
(1, 1, 'Physique, Electronique, Nanotechnologies'),
(2, 1, 'Signaux et Systèmes'),
(3, 1, 'Informatique'),
(4, 1, 'Projet'),
(5, 1, 'Management et Développement Personnel'),
(6, 2, 'Physique,  Electronique et  Nanotechnologies'),
(7, 2, 'Signaux et  Systèmes'),
(8, 2, 'Informatique'),
(9, 2, 'Projet'),
(10, 2, 'Management et  Développement  Personnel'),
(11, 3, 'Physique, Electronique et  Nanotechnologies'),
(12, 3, 'Signaux et Systèmes'),
(13, 3, 'Informatique'),
(14, 3, 'Projet'),
(15, 3, 'Management et Développement Personnel');

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
) ENGINE=InnoDB AUTO_INCREMENT=64 DEFAULT CHARSET=latin1;

--
-- Contenu de la table `cours`
--

INSERT INTO `cours` (`ID_Cours`, `ID_Competence`, `Nom_Cours`, `Credits_Cours`, `Semestre_Cours`) VALUES
(1, 1, 'Mécanique Quantique', 2.5, 1),
(2, 1, 'Nanosciences', 2, 2),
(4, 1, 'Systèmes Electroniques', 8.5, 2),
(5, 2, 'Ateliers Préparatoires en Mathématiques', 1, 1),
(6, 2, 'Electronique Numérique', 8, 1),
(7, 2, 'Transformations', 2, 1),
(8, 2, 'Probabilités et Statistiques', 1.5, 2),
(9, 2, 'Analyse des Signaux et des Images', 3, 2),
(10, 3, 'Algorithmique, Lang. C', 10.5, 1),
(11, 3, 'Base de Données et Réseaux', 3, 2),
(12, 4, 'Projet', 6, 2),
(13, 5, 'Anglais S1', 1.5, 1),
(14, 5, 'Anglais S2', 2, 2),
(15, 5, 'Formation Humaine S1', 2, 1),
(16, 5, 'Formation Humaine S2', 1.5, 2),
(17, 5, 'Economie S1', 2.5, 1),
(18, 5, 'Economie S2', 1, 2),
(19, 5, 'Prise de  Responsabilité / Elective', 1.5, 0),
(21, 6, 'Mécanique Quantique', 2.5, 1),
(22, 6, 'Electromagnétisme S1', 2, 1),
(23, 6, 'Systèmes Electroniques', 8.5, 2),
(24, 6, 'Electromagnétisme S2', 2, 2),
(25, 6, 'Nanosciences', 2, 2),
(26, 7, 'Ateliers Préparatoires en Mathématiques', 2, 1),
(27, 7, 'Electronique Numérique', 8, 1),
(28, 7, 'Transformations', 3, 1),
(29, 7, 'Probabilités et Statistiques', 1.5, 2),
(30, 7, 'Analyse des Signaux et des Images', 3, 2),
(31, 8, 'Algorithmique, Lang. C', 10.5, 1),
(32, 8, 'Base de Données et  Réseaux', 3, 2),
(33, 9, 'Projet', 6, 2),
(34, 10, 'Anglais S1', 1.5, 1),
(35, 10, 'Anglais S2', 2, 2),
(36, 10, 'Formation Humaine S1', 2, 1),
(37, 10, 'Formation Humaine S2', 1.5, 2),
(38, 10, 'Economie S1', 2.5, 1),
(39, 10, 'Economie S2', 1, 2),
(40, 10, 'Prise de Responsabilité / Elective', 1.5, 0),
(41, 11, 'Liaisons Optiques', 1, 1),
(42, 11, 'Electronique Numérique', 4.5, 1),
(43, 11, 'Systèmes Electroniques', 8.5, 2),
(44, 11, 'Sciences Industrielles', 1, 1),
(45, 12, 'Ateliers Préparatoires en Mathématiques', 1, 1),
(46, 12, 'Mathématiques', 3.5, 1),
(47, 12, 'Calcul Numérique', 2, 1),
(48, 12, 'Transformations', 2, 1),
(50, 12, 'Probabilités et Statistiques', 1.5, 2),
(51, 12, 'Analyse des Signaux et des Images', 3, 2),
(52, 13, 'Informatique S1', 4.5, 1),
(53, 13, 'Info Pratique S1', 4.5, 1),
(54, 13, 'Informatique S2', 2.5, 2),
(55, 13, 'Info Pratique S2', 2.5, 2),
(56, 14, 'Projet ', 6, 2),
(57, 15, 'Anglais S1', 1.5, 1),
(58, 15, 'Anglais S2', 2, 2),
(59, 15, 'Formation Humaine S1', 2, 1),
(60, 15, 'Formation Humaine S2', 1.5, 2),
(61, 15, 'Economie S1', 2.5, 1),
(62, 15, 'Economie S2', 1, 2),
(63, 15, 'Prise de Responsabilité / Elective', 1.5, 0);

-- --------------------------------------------------------

--
-- Structure de la table `cursus`
--

DROP TABLE IF EXISTS `cursus`;
CREATE TABLE IF NOT EXISTS `cursus` (
  `ID_Cursus` int(5) NOT NULL AUTO_INCREMENT,
  `Nom_Cursus` varchar(55) NOT NULL,
  `Annee_Cursus` year(4) NOT NULL COMMENT '"2015" pour l''année de septembre 2015 à juin 2016 par exemple',
  PRIMARY KEY (`ID_Cursus`)
) ENGINE=InnoDB AUTO_INCREMENT=27 DEFAULT CHARSET=latin1;

--
-- Contenu de la table `cursus`
--

INSERT INTO `cursus` (`ID_Cursus`, `Nom_Cursus`, `Annee_Cursus`) VALUES
(1, 'CSI3', 2015),
(2, 'CSI-U3', 2015),
(3, 'CIR3', 2015);

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
) ENGINE=InnoDB AUTO_INCREMENT=80 DEFAULT CHARSET=latin1;

--
-- Contenu de la table `evaluation`
--

INSERT INTO `evaluation` (`ID_Eval`, `ID_Cours`, `Nom_Eval`, `Coef_Eval`) VALUES
(1, 1, 'Théorie', 1),
(2, 2, 'Théorie', 1),
(3, 4, 'Théorie', 0.6),
(4, 4, 'Pratique', 0.4),
(5, 5, 'Théorie', 1),
(6, 6, 'Théorie', 0.6),
(7, 6, 'Pratique', 0.4),
(8, 7, 'Théorie', 0.5),
(9, 7, 'Pratique', 0.5),
(10, 8, 'Théorie', 0.5),
(11, 8, 'Pratique', 0.5),
(12, 9, 'Théorie', 0.8),
(13, 9, 'Pratique', 0.2),
(14, 10, 'Théorie', 0.6),
(15, 10, 'Pratique', 0.4),
(16, 11, 'Théorie', 0.8),
(17, 11, 'Pratique', 0.2),
(18, 12, 'Théorie', 1),
(19, 13, 'Théorie', 1),
(20, 14, 'Théorie', 1),
(21, 15, 'Théorie', 1),
(22, 16, 'Théorie', 1),
(23, 17, 'Théorie', 1),
(24, 18, 'Théorie', 1),
(25, 19, 'Théorie', 1),
(26, 34, 'Théorie', 1),
(27, 35, 'Théorie', 1),
(28, 36, 'Théorie', 1),
(29, 37, 'Théorie', 1),
(30, 38, 'Théorie', 1),
(31, 39, 'Théorie', 1),
(32, 40, 'Théorie', 1),
(33, 57, 'Théorie', 1),
(34, 58, 'Théorie', 1),
(35, 59, 'Théorie', 1),
(36, 60, 'Théorie', 1),
(37, 61, 'Théorie', 1),
(38, 62, 'Théorie', 1),
(39, 63, 'Théorie', 1),
(40, 56, 'Théorie', 1),
(41, 33, 'Théorie', 1),
(42, 31, 'Théorie', 0.6),
(43, 31, 'Pratique', 0.4),
(44, 32, 'Théorie', 0.8),
(45, 32, 'Pratique', 0.2),
(46, 26, 'Théorie', 1),
(47, 27, 'Théorie', 0.6),
(48, 27, 'Pratique', 0.4),
(49, 28, 'Théorie', 1),
(50, 29, 'Théorie', 0.5),
(51, 29, 'Pratique', 0.5),
(52, 30, 'Théorie', 0.8),
(53, 30, 'Pratique', 0.2),
(54, 21, 'Théorie', 1),
(55, 22, 'Projet', 1),
(56, 23, 'Théorie', 0.6),
(57, 23, 'Pratique', 0.4),
(58, 24, 'Projet', 1),
(59, 25, 'Théorie', 1),
(60, 41, 'Théorie', 1),
(61, 44, 'Théorie', 1),
(62, 42, 'Théorie', 0.6),
(63, 43, 'Théorie', 0.6),
(64, 42, 'Pratique', 0.4),
(65, 43, 'Pratique', 0.4),
(66, 45, 'Théorie', 1),
(67, 47, 'Théorie', 1),
(68, 46, 'Théorie', 0.4),
(69, 46, 'Pratique', 0.6),
(70, 48, 'Théorie', 0.5),
(71, 50, 'Théorie', 0.5),
(72, 48, 'Pratique', 0.5),
(73, 50, 'Pratique', 0.5),
(74, 51, 'Théorie', 0.8),
(75, 51, 'Pratique', 0.2),
(76, 52, 'Théorie', 1),
(77, 53, 'Théorie', 1),
(78, 54, 'Théorie', 1),
(79, 55, 'Théorie', 1);

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
) ENGINE=InnoDB AUTO_INCREMENT=126 DEFAULT CHARSET=latin1;

--
-- Contenu de la table `type_eval`
--

INSERT INTO `type_eval` (`ID_Type`, `ID_Eval`, `Nom_Type`, `Coef_Type_Eval`) VALUES
(1, 1, 'Interrogation', 0.2),
(2, 1, 'DS', 0.3),
(3, 1, 'Partiel', 0.5),
(4, 2, 'Interrogation', 0.2),
(5, 3, 'Interrogation', 0.2),
(6, 6, 'Interrogation', 0.2),
(7, 8, 'Interrogation', 0.2),
(8, 12, 'Interrogation', 0.2),
(9, 54, 'Interrogation', 0.2),
(10, 56, 'Interrogation', 0.2),
(11, 59, 'Interrogation', 0.2),
(12, 47, 'Interrogation', 0.2),
(13, 52, 'Interrogation', 0.2),
(14, 62, 'Interrogation', 0.2),
(15, 63, 'Interrogation', 0.2),
(16, 70, 'Interrogation', 0.2),
(17, 74, 'Interrogation', 0.2),
(18, 76, 'Interrogation', 0.2),
(19, 2, 'DS', 0.3),
(20, 3, 'DS', 0.3),
(21, 6, 'DS', 0.3),
(22, 12, 'DS', 0.3),
(23, 14, 'DS', 0.5),
(24, 16, 'DS', 0.5),
(25, 19, 'DS', 1),
(26, 20, 'DS', 1),
(27, 22, 'DS', 1),
(28, 24, 'DS', 1),
(29, 26, 'DS', 1),
(30, 27, 'DS', 1),
(31, 29, 'DS', 1),
(32, 31, 'DS', 1),
(33, 33, 'DS', 1),
(34, 34, 'DS', 1),
(35, 36, 'DS', 1),
(36, 38, 'DS', 1),
(37, 2, 'Partiel', 0.5),
(38, 3, 'Partiel', 0.5),
(39, 6, 'Partiel', 0.5),
(40, 8, 'Partiel', 0.8),
(41, 10, 'Partiel', 1),
(42, 12, 'Partiel', 0.5),
(43, 14, 'Partiel', 0.5),
(44, 16, 'Partiel', 0.5),
(45, 23, 'Partiel', 0.33),
(46, 4, 'TP', 1),
(47, 5, 'Quizz', 1),
(48, 7, 'TP', 0.375),
(49, 7, 'Projet', 0.625),
(50, 9, 'TP', 1),
(51, 11, 'TP', 1),
(52, 13, 'TP', 1),
(53, 15, 'TP', 0.5),
(54, 15, 'Projet', 0.5),
(55, 17, 'TP', 1),
(56, 18, 'Evaluation', 1),
(57, 21, 'Projet', 1),
(58, 23, 'Projet', 0.67),
(59, 25, 'Evaluation', 1),
(60, 54, 'DS', 0.3),
(61, 54, 'Partiel', 0.5),
(62, 56, 'DS', 0.3),
(63, 56, 'Partiel', 0.5),
(64, 57, 'TP', 1),
(65, 58, 'Evaluation', 1),
(66, 59, 'DS', 0.3),
(67, 59, 'Partiel', 0.5),
(68, 46, 'Quizz', 0.6),
(69, 46, 'DS', 0.4),
(70, 47, 'DS', 0.3),
(71, 47, 'Partiel', 0.5),
(72, 48, 'TP', 0.375),
(73, 48, 'Projet', 0.625),
(74, 49, 'DS', 0.3),
(75, 49, 'Partiel', 0.4),
(76, 49, 'TP', 0.3),
(77, 50, 'Partiel', 1),
(78, 51, 'TP', 1),
(79, 52, 'DS', 0.3),
(80, 52, 'Partiel', 0.5),
(81, 53, 'TP', 1),
(82, 42, 'DS', 0.5),
(83, 42, 'Partiel', 0.5),
(84, 43, 'TP', 0.5),
(85, 43, 'Projet', 0.5),
(86, 44, 'DS', 0.5),
(87, 44, 'Partiel', 0.5),
(88, 45, 'TP', 1),
(89, 41, 'Evaluation', 1),
(90, 28, 'Projet', 1),
(91, 30, 'Projet', 0.67),
(92, 30, 'Partiel', 0.33),
(93, 32, 'Evaluation', 1),
(94, 60, 'DS', 1),
(95, 62, 'DS', 0.3),
(96, 62, 'Partiel', 0.5),
(97, 64, 'TP', 0.375),
(98, 64, 'Projet', 0.625),
(99, 63, 'DS', 0.3),
(100, 63, 'Partiel', 0.5),
(101, 65, 'TP', 1),
(102, 61, 'DS', 1),
(103, 66, 'Quizz', 1),
(104, 68, 'Partiel', 1),
(105, 69, 'TP', 1),
(106, 67, 'Interrogation', 0.5),
(107, 67, 'Partiel', 0.5),
(108, 70, 'Partiel', 0.8),
(109, 72, 'TP', 1),
(110, 71, 'Partiel', 1),
(111, 73, 'TP', 1),
(112, 74, 'DS', 0.3),
(113, 74, 'Partiel', 0.5),
(114, 75, 'TP', 1),
(115, 76, 'DS', 0.3),
(116, 76, 'Partiel', 0.5),
(117, 77, 'Evaluation', 1),
(118, 78, 'DS', 0.5),
(119, 78, 'Partiel', 0.5),
(120, 79, 'Evaluation', 1),
(121, 40, 'Evaluation', 1),
(122, 35, 'Projet', 1),
(123, 37, 'Partiel', 0.33),
(124, 37, 'Projet', 0.67),
(125, 39, 'Evaluation', 1);

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
('antoine.goelzer@isen-lille.fr', 1, 'Goelzer', 'Antoine'),
('baudouin.landais@isen-lille.fr', 0, 'Landais', 'Baudouin'),
('joel.guillem@isen-lille.fr', 0, 'Guillem', 'Joël'),
('maxence.faideau@isen-lille.fr', 1, 'Faideau', 'Maxence');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
