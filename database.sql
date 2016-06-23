-- phpMyAdmin SQL Dump
-- version 4.5.2
-- http://www.phpmyadmin.net
--
-- Client :  127.0.0.1
-- Généré le :  Mer 22 Juin 2016 à 15:29
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
(1, 1, 'Physique, Electronique et Nanotechnologies'),
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
-- Structure de la table `consultation`
--

DROP TABLE IF EXISTS `consultation`;
CREATE TABLE IF NOT EXISTS `consultation` (
  `ID_Etudiant` int(5) NOT NULL,
  `Mail_Consultant` varchar(55) NOT NULL,
  `Nombre_Vues_Etudiant` int(5) NOT NULL,
  PRIMARY KEY (`ID_Etudiant`,`Mail_Consultant`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Contenu de la table `consultation`
--

INSERT INTO `consultation` (`ID_Etudiant`, `Mail_Consultant`, `Nombre_Vues_Etudiant`) VALUES
(1291167, 'maxence.faideau@isen-lille.fr', 39),
(1292315, 'maxence.faideau@isen-lille.fr', 8),
(1292336, 'maxence.faideau@isen-lille.fr', 6),
(1292562, 'maxence.faideau@isen-lille.fr', 44);

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
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

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
  `ID_Epreuve_Session2` int(5) NOT NULL,
  `ID_Epreuve_Substitution` int(11) NOT NULL,
  `Nom_Epreuve` varchar(255) NOT NULL,
  `Coef_Epreuve` float NOT NULL,
  `Date_Epreuve` date NOT NULL,
  `Evaluateur_Epreuve` varchar(255) NOT NULL,
  PRIMARY KEY (`ID_Epreuve`),
  KEY `ID_Type` (`ID_Type`)
) ENGINE=InnoDB AUTO_INCREMENT=178 DEFAULT CHARSET=latin1;

--
-- Contenu de la table `epreuve`
--

INSERT INTO `epreuve` (`ID_Epreuve`, `ID_Type`, `ID_Epreuve_Session2`, `ID_Epreuve_Substitution`, `Nom_Epreuve`, `Coef_Epreuve`, `Date_Epreuve`, `Evaluateur_Epreuve`) VALUES
(20, 53, 0, 0, 'Evaluation de TP de Langage C', 1, '2015-09-16', ''),
(21, 54, 0, 0, 'Evaluation de Projet', 1, '2016-02-02', ''),
(22, 23, 0, 23, 'Devoir Surveillé d''informatique', 0.5, '2015-11-17', ''),
(23, 43, 24, 24, 'Partiel d''informatique', 1, '2015-12-16', ''),
(24, 43, 0, 0, '2ème session d''informatique', 1, '2016-02-25', ''),
(25, 55, 0, 0, 'TP de Bases de Données/Réseaux', 1, '2016-02-28', ''),
(26, 44, 0, 0, '2ème session d''informatique - Base de données et réseaux', 0.5, '2016-05-11', ''),
(27, 44, 26, 0, 'Partiel d''informatique - Base de données et réseaux', 0.5, '2016-05-11', ''),
(28, 24, 0, 27, 'Devoir surveillé d''informatique - Base de données et réseaux', 1, '2016-03-22', ''),
(30, 56, 0, 0, 'Evaluation de Projet', 1, '2016-06-29', ''),
(31, 25, 0, 0, 'Evaluation CSI3 Anglais S1', 1, '2015-12-15', ''),
(32, 26, 0, 0, 'Evaluation CSI3 Anglais S2', 1, '2016-06-30', ''),
(33, 57, 0, 0, 'Evaluation CSI3 Projet Communication', 1, '2016-01-08', ''),
(34, 58, 0, 0, 'Jeu d''entreprise', 1, '2016-01-08', ''),
(35, 45, 0, 0, 'Partiel de Gestion de Projet', 1, '2015-12-15', ''),
(36, 47, 0, 0, 'Evaluation des APM', 1, '2015-10-19', ''),
(37, 6, 0, 0, 'Interrogation CSI3 Electronique Numérique et Analogique ', 1, '2015-11-03', ''),
(38, 21, 0, 39, 'Devoir surveillé CSI3 Electronique Numérique et Analogique ', 1, '2015-12-01', ''),
(39, 39, 40, 40, 'Partiel CSI3 Electronique Numérique et Analogique ', 0.5, '2015-12-18', ''),
(40, 39, 0, 0, '2ème session CSI3 Electronique Numérique et Analogique ', 0.5, '2016-03-03', ''),
(41, 48, 0, 0, 'TP FPGA', 0.3, '2016-02-02', ''),
(42, 48, 0, 0, 'TP MICROCONTROLEURS', 0.7, '2016-01-03', ''),
(43, 49, 0, 0, 'Projet Electronique CSI3 Semestre 1', 1, '2016-01-18', ''),
(44, 7, 0, 0, 'Interrogation CSI3 Transformations', 1, '2015-11-24', ''),
(45, 40, 46, 46, 'Partiel CSI3 Transformations', 0.5, '2015-12-14', ''),
(46, 40, 0, 0, '2ème session CSI3 Transformations', 0.5, '2015-12-14', ''),
(47, 50, 0, 0, 'Travaux Pratiques CSI3 Transformations', 0.5, '2015-11-17', ''),
(48, 41, 49, 49, 'Partiel Probabilités', 0.5, '2016-03-11', ''),
(49, 41, 0, 0, '2ème session Probabilités', 0.5, '2016-03-11', ''),
(50, 51, 0, 0, 'Travaux Pratiques', 1, '2016-03-08', ''),
(51, 8, 0, 0, 'Interrogation d''analyse des signaux et des images ', 1, '2016-03-29', ''),
(52, 22, 0, 53, 'Devoir surveillé d''analyse des signaux et des images ', 1, '2016-04-26', ''),
(53, 42, 54, 54, 'Partiel d''analyse des signaux et des images ', 0.5, '2016-05-12', ''),
(54, 42, 0, 0, '2ème session d''analyse des signaux et des images ', 0.5, '2016-05-12', ''),
(55, 52, 0, 0, 'Travaux Pratiques d''analyse des signaux et des images ', 1, '2016-05-09', ''),
(56, 129, 0, 0, 'Interrogation CSI3 Ondes et mecanique quantique', 1, '2015-11-03', ''),
(57, 131, 0, 0, '2ème session CSI3 Ondes et mecanique quantique', 0.5, '2016-02-11', ''),
(58, 131, 57, 57, 'Partiel CSI3 Ondes et mecanique quantique', 0.5, '2015-12-17', ''),
(59, 130, 0, 58, 'Devoir surveillé CSI3 Ondes et mecanique quantique', 1, '2015-11-10', ''),
(60, 132, 0, 0, 'Interrogation de Physique Nanosciences ', 1, '2016-03-01', ''),
(61, 133, 0, 62, 'Devoir surveillé de Physique Nanosciences ', 1, '2016-04-01', ''),
(62, 134, 63, 63, 'Partiel de Physique Nanosciences ', 0.5, '2016-05-09', ''),
(63, 134, 0, 0, '2ème session de Physique Nanosciences ', 0.5, '2016-05-09', ''),
(64, 135, 0, 0, 'Interrogation de Systèmes Electroniques', 0.5, '2016-03-01', ''),
(65, 135, 0, 0, 'Interrogation2 de Systèmes Electroniques ( a modiifier)', 0.5, '2016-03-01', ''),
(66, 136, 0, 67, 'Devoir surveillé de Systèmes Electroniques ', 1, '2016-04-18', ''),
(67, 137, 68, 68, 'Partiel de Systèmes Electroniques ', 0.5, '2016-05-10', ''),
(68, 137, 0, 0, '2ème session de Systèmes Electroniques ', 0.5, '2016-05-10', ''),
(69, 89, 0, 0, 'Evaluation de Projet', 1, '2016-06-30', ''),
(70, 100, 71, 71, 'Partiel de Systèmes Electroniques', 0.5, '2016-06-21', ''),
(71, 100, 0, 0, '2ème session de Systèmes Electroniques', 0.5, '2016-06-21', ''),
(72, 99, 0, 70, 'Devoir surveillé de Systèmes Electroniques', 1, '2016-06-21', ''),
(73, 15, 0, 0, 'Interrogation de Systèmes Electroniques', 0.5, '2016-06-21', ''),
(74, 15, 0, 0, 'Interrogation 2 de Systèmes Electroniques', 0.5, '2016-06-21', ''),
(75, 101, 0, 0, 'Travaux Pratiques', 1, '2016-06-21', ''),
(76, 102, 0, 0, 'Devoir Surveillé CIR3 sciences industrielles', 1, '2016-06-21', ''),
(77, 97, 0, 0, 'CIR3 TP Electronique ', 1, '2016-06-21', ''),
(78, 98, 0, 0, 'Projet Electronique CIR3 ', 1, '2016-06-21', ''),
(79, 14, 0, 0, 'Interrogation CIR3 Electronique Numérique et Analogique', 1, '2016-06-21', ''),
(80, 96, 81, 81, 'Partiel CIR3 Electronique Numérique et Analogique', 0.5, '2016-06-21', ''),
(81, 96, 0, 0, '2ème session CIR3 Electronique Numérique et Analogique', 0.5, '2016-06-21', ''),
(82, 95, 0, 80, 'Devoir surveillé CIR3 Electronique Numérique et Analogique', 1, '2016-06-21', ''),
(83, 94, 0, 0, 'Devoir surveillé CIR3 Liaisons optiques', 1, '2016-06-21', ''),
(84, 103, 0, 0, 'Evaluation des Ateliers Préparatoires de Mathématiques', 1, '2016-06-21', ''),
(85, 104, 0, 0, 'Examen CIR3 mathématiques', 1, '2016-06-21', ''),
(86, 105, 0, 0, 'TP1: courbes de Bézier', 0.5, '2016-06-21', ''),
(87, 105, 0, 0, 'TP2: B-splines', 0.5, '2016-06-21', ''),
(88, 106, 0, 0, 'Interrogation CIR3 Calcul Numérique', 0.5, '2016-06-21', ''),
(89, 106, 0, 0, 'Interrogation n°2 CIR3 Calcul Numérique', 0.5, '2016-06-21', ''),
(90, 107, 91, 91, 'Partiel CIR3 Calcul Numérique', 0.5, '2016-06-21', ''),
(91, 107, 0, 0, '2ème session CIR3 Calcul Numérique', 0.5, '2016-06-21', ''),
(92, 16, 0, 0, 'Interrogation CIR3 transformations', 1, '2016-06-21', ''),
(93, 108, 94, 94, 'Partiel CIR3 Transformations', 0.5, '2016-06-21', ''),
(94, 108, 0, 0, '2ème session CIR3 Transformations', 0.5, '2016-06-21', ''),
(95, 109, 0, 0, 'Travaux Pratiques CIR3 Transformations', 1, '2016-06-21', ''),
(96, 110, 97, 97, 'Partiel CIR3 Probabilités', 0.5, '2016-06-21', ''),
(97, 110, 0, 0, '2ème session CIR3 Probabilités', 0.5, '2016-06-21', ''),
(98, 111, 0, 0, 'TP CIR3 Probabilités', 1, '2016-06-21', ''),
(99, 17, 0, 0, 'Interrogation CIR3 ASN', 1, '2016-06-21', ''),
(100, 113, 101, 101, 'Partiel CIR3 ASN', 0.5, '2016-06-21', ''),
(101, 113, 0, 0, '2ème session CIR3 ASN', 0.5, '2016-06-21', ''),
(102, 112, 0, 100, 'Devoir surveillé CIR3 ASN', 1, '2016-06-21', ''),
(103, 18, 0, 0, 'Interrogation n°1 Informatique', 0.5, '2016-06-21', ''),
(104, 18, 0, 0, 'Interrogation n°2 Informatique', 0.5, '2016-06-21', ''),
(105, 115, 0, 106, 'Devoir surveillé CIR3 Informatique', 1, '2016-06-21', ''),
(106, 116, 107, 107, 'Partiel CIR3 Informatique', 0.5, '2016-06-21', ''),
(107, 116, 0, 0, '2ème session CIR3 Informatique', 0.5, '2016-06-21', ''),
(108, 117, 0, 0, 'TP JAVA (à verifier)', 0.5, '2016-06-21', ''),
(109, 117, 0, 0, 'Projet JAVA (à verifier)', 0.5, '2016-06-21', ''),
(110, 118, 0, 111, 'Devoir surveillé CIR3 informatique S2', 1, '2016-06-21', ''),
(111, 119, 112, 112, 'Partiel CIR3 informatique S2', 0.5, '2016-06-21', ''),
(112, 119, 0, 0, '2ème session CIR3 informatique S2', 0.5, '2016-06-21', ''),
(113, 121, 0, 0, 'Evaluation de Projet', 1, '2016-06-21', ''),
(114, 125, 0, 0, 'Evaluation module elective', 0.5, '2016-06-21', ''),
(115, 125, 0, 114, 'Evaluation PR', 0.5, '2016-06-21', ''),
(116, 33, 0, 0, 'Evaluation CIR3 Anglais S1', 1, '2016-06-21', ''),
(117, 34, 0, 0, 'Evaluation CIR3 Anglais S2', 1, '2016-06-21', ''),
(118, 122, 0, 0, 'Evaluation CIR3 Projet Communication', 1, '2016-06-21', ''),
(119, 123, 0, 0, 'Partiel CIR3 Gestion de Projet', 1, '2016-06-21', ''),
(120, 124, 0, 0, 'Jeu d''entreprise', 1, '2016-06-21', ''),
(121, 29, 0, 0, 'Evaluation CSIU3 Anglais S1', 1, '2016-06-21', ''),
(122, 30, 0, 0, 'Evaluation CSIU3 Anglais S2', 1, '2016-06-21', ''),
(123, 90, 0, 0, 'Evaluation CSIU3 Projet Communication ', 1, '2016-06-21', ''),
(124, 91, 0, 0, 'Evaluation CSIU3 Projet Jeu d''entreprise ', 1, '2016-06-21', ''),
(125, 92, 0, 0, 'Partiel CSIU3 Gestion de Projet', 1, '2016-06-21', ''),
(126, 32, 0, 0, 'Devoir surveillé de Macro Economie ', 1, '2016-06-21', ''),
(127, 83, 128, 128, 'Partiel d''informatique - Algorithmique et Lang C', 0.5, '2016-06-21', ''),
(128, 83, 0, 0, '2ème session d''informatique - Algorithmique et Lang C', 0.5, '2016-06-21', ''),
(129, 82, 0, 127, 'Devoir surveillé d''informatique - Algorithmique et Lang C', 1, '2016-06-21', ''),
(130, 84, 0, 0, 'Travaux pratiques de bases de Lang C', 1, '2016-06-21', ''),
(131, 85, 0, 0, 'Evaluation de Projet d''informatique ', 1, '2016-06-21', ''),
(132, 86, 0, 133, 'Devoir surveillé de BDD', 1, '2016-06-21', ''),
(133, 87, 134, 134, 'Partiel CSIU3 BDD', 0.5, '2016-06-21', ''),
(134, 87, 0, 0, '2ème session CSIU3 BDD', 0.5, '2016-06-21', ''),
(135, 88, 0, 0, 'Travaux Pratiques de BDD ', 1, '2016-06-21', ''),
(136, 68, 0, 0, 'Evaluation des Ateliers Préparatoires de Mathématiques', 1, '2016-06-21', ''),
(137, 69, 0, 0, 'Devoir surveillé des Ateliers Préparatoires de Mathématiques', 1, '2016-06-21', ''),
(138, 12, 0, 0, 'Interrogation U3 Electronique numérique et analogique ', 1, '2016-06-21', ''),
(139, 70, 0, 140, 'Devoir surveillé U3 Electronique numérique et analogique ', 1, '2016-06-21', ''),
(140, 71, 141, 141, 'Partiel U3 Electronique numérique et analogique ', 0.5, '2016-06-21', ''),
(141, 71, 0, 0, '2ème session U3 Electronique numérique et analogique ', 0.5, '2016-06-21', ''),
(142, 72, 0, 0, 'TP FPGA', 0.3, '2016-06-21', ''),
(143, 72, 0, 0, 'TP MICROCONTROLEURS', 0.7, '2016-06-21', ''),
(144, 73, 0, 0, 'Projet Electronique CSIU3', 1, '2016-06-21', ''),
(145, 74, 0, 146, 'Devoir surveillé CSIU3 Transformations', 1, '2016-06-21', ''),
(146, 75, 147, 147, 'Partiel CSIU3 Transformations', 0.5, '2016-06-21', ''),
(147, 75, 0, 0, '2ème session CSIU3 Transformations', 0.5, '2016-06-21', ''),
(148, 76, 0, 0, 'Travaux Pratiques CSIU3 Transformations', 1, '2016-06-21', ''),
(149, 77, 150, 150, 'Partiel CSIU3 Probabilités', 0.5, '2016-06-21', ''),
(150, 77, 0, 0, '2ème session CSIU3 Probabilités', 0.5, '2016-06-21', ''),
(151, 78, 0, 0, 'Travaux Pratiques CSIU3 Probabilités', 1, '2016-06-21', ''),
(152, 13, 0, 0, 'Interrogation CSIU3 ASN', 1, '2016-06-21', ''),
(153, 79, 0, 154, 'Devoir surveillé CSIU3 ASN', 1, '2016-06-21', ''),
(154, 80, 155, 155, 'Partiel CSIU3 ASN', 0.5, '2016-06-21', ''),
(155, 80, 0, 0, '2ème session CSIU3 ASN', 0.5, '2016-06-21', ''),
(156, 81, 0, 0, 'Travaux Pratiques CSIU3 ASN', 1, '2016-06-21', ''),
(157, 138, 0, 0, 'Evaluation Semestre 1 ', 1, '2016-06-21', ''),
(158, 65, 0, 0, 'CC Electromagnétisme', 1, '2016-06-21', ''),
(159, 140, 0, 0, 'Projet Electromagnétisme', 1, '2016-06-21', ''),
(160, 10, 0, 0, 'Interrogation de systèmes Electroniques', 0.5, '2016-06-21', ''),
(161, 10, 0, 0, 'Interrogation 2 de systèmes Electroniques', 0.5, '2016-06-21', ''),
(162, 62, 0, 163, 'Devoir surveillé de systèmes Electroniques', 1, '2016-06-21', ''),
(163, 63, 164, 164, 'Partiel de systèmes Electroniques', 0.5, '2016-06-21', ''),
(164, 63, 0, 0, '2ème session de systèmes Electroniques', 0.5, '2016-06-21', ''),
(165, 64, 0, 0, 'Travaux Pratiques de Systèmes Electroniques', 1, '2016-06-21', ''),
(166, 11, 0, 0, 'Interrogation de Nanosciences', 1, '2016-06-21', ''),
(167, 66, 0, 168, 'Devoir surveillé de Nanosciences', 1, '2016-06-21', ''),
(168, 67, 169, 169, 'Partiel de Nanosciences', 0.5, '2016-06-21', ''),
(169, 67, 0, 0, '2ème session de Nanosciences', 0.5, '2016-06-21', ''),
(170, 9, 0, 0, 'Interrogation de Mécanique Quantique', 1, '2016-06-21', ''),
(171, 60, 0, 172, 'Devoir surveillé de Mécanique Quantique', 1, '2016-06-21', ''),
(172, 61, 173, 173, 'Partiel de Mécanique Quantique', 0.5, '2016-06-21', ''),
(173, 61, 0, 0, '2ème session de Mécanique Quantique', 0.5, '2016-06-21', ''),
(174, 114, 0, 0, 'Travaux pratiques CIR3 ASN', 1, '2016-06-21', ''),
(175, 36, 0, 0, 'Devoir surveillé de macro economie ', 1, '2016-06-21', ''),
(176, 46, 0, 0, 'Travaux Pratiques de Systèmes Electronique', 1, '2016-06-21', ''),
(177, 28, 0, 0, 'Devoir surveillé de Macro économie', 1, '2016-06-21', '');

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
('1291167', 1, 'antoine.goelzer@isen-lille.fr'),
('1292315', 1, 'baudouin.landais@isen-lille.fr'),
('1292336', 1, 'joel.guillem@isen-lille.fr'),
('1292562', 1, 'maxence.faideau@isen-lille.fr');

-- --------------------------------------------------------

--
-- Structure de la table `etudiantnote`
--

DROP TABLE IF EXISTS `etudiantnote`;
CREATE TABLE IF NOT EXISTS `etudiantnote` (
  `ID_Epreuve` int(5) NOT NULL,
  `ID_Etudiant` int(5) NOT NULL,
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
(20, 1291167, 18.11, -1, 0),
(20, 1292315, 16.33, -1, 0),
(20, 1292336, 18.11, -1, 0),
(20, 1292562, 17.34, -1, 0),
(21, 1291167, 18.5, -1, 0),
(21, 1292315, 15, -1, 0),
(21, 1292336, 18.5, -1, 0),
(21, 1292562, 18.5, -1, 0),
(22, 1291167, 14.25, -1, 0),
(22, 1292315, 9.5, -1, 0),
(22, 1292336, 4.75, -1, 0),
(22, 1292562, 7, -1, 0),
(23, 1291167, 18.5, -1, 0),
(23, 1292315, 17.5, -1, 0),
(23, 1292336, 11, -1, 0),
(23, 1292562, 9.5, -1, 0),
(24, 1292336, 14.5, -1, 0),
(24, 1292562, 9, -1, 0),
(25, 1291167, 20, -1, 0),
(25, 1292315, 19, -1, 0),
(25, 1292336, 18, -1, 0),
(25, 1292562, 15, -1, 0),
(26, 1292562, -1, 20, 0),
(27, 1291167, 14, -1, 0),
(27, 1292315, 10.4, -1, 0),
(27, 1292336, 6.7, -1, 0),
(27, 1292562, 0, -1, 1),
(28, 1291167, 7.8, -1, 0),
(28, 1292315, 14.1, -1, 0),
(28, 1292336, 6.2, -1, 0),
(28, 1292562, 12.9, -1, 0),
(31, 1291167, 14, -1, 0),
(31, 1292315, 14, -1, 0),
(31, 1292562, 7.75, -1, 0),
(33, 1291167, 15, -1, 0),
(33, 1292315, 12, -1, 0),
(33, 1292562, 0, -1, 1),
(34, 1291167, 14.1, -1, 0),
(34, 1292315, 12.3, -1, 0),
(34, 1292562, 14.1, -1, 0),
(35, 1291167, 12, -1, 0),
(35, 1292315, 10.5, -1, 0),
(35, 1292562, 13.5, -1, 0),
(36, 1291167, 12.9, -1, 0),
(36, 1292315, 14.7, -1, 0),
(36, 1292562, 14.3, -1, 0),
(37, 1291167, 13, -1, 0),
(37, 1292315, 9.5, -1, 0),
(37, 1292562, 8.5, -1, 0),
(38, 1291167, 15, -1, 0),
(38, 1292315, 15.5, -1, 0),
(38, 1292562, 6, -1, 0),
(39, 1291167, 10, -1, 0),
(39, 1292315, 12.2, -1, 0),
(39, 1292562, 8.7, -1, 0),
(40, 1292562, 6.9, -1, 0),
(41, 1291167, 16.5, -1, 0),
(41, 1292315, 16.5, -1, 0),
(41, 1292562, 15, -1, 0),
(42, 1291167, 18, -1, 0),
(42, 1292315, 16, -1, 0),
(42, 1292562, 14, -1, 0),
(43, 1291167, 10, -1, 0),
(43, 1292315, 12.5, -1, 0),
(43, 1292562, 13.5, -1, 0),
(44, 1291167, 15.7, -1, 0),
(44, 1292315, 15.7, -1, 0),
(44, 1292562, 10.9, -1, 0),
(45, 1291167, 18.8, -1, 0),
(45, 1292315, 12, -1, 0),
(45, 1292562, 8.3, -1, 0),
(47, 1291167, 17.3, -1, 0),
(47, 1292315, 19, -1, 0),
(47, 1292562, 15.3, -1, 0),
(48, 1291167, 16.9, -1, 0),
(48, 1292315, 15, -1, 0),
(48, 1292562, 13.1, -1, 0),
(50, 1291167, 14.4, -1, 0),
(50, 1292315, 20, -1, 0),
(50, 1292562, 16.5, -1, 0),
(51, 1291167, 18, -1, 0),
(51, 1292315, 9.6, -1, 0),
(51, 1292562, 7.2, -1, 0),
(52, 1291167, 20, -1, 0),
(52, 1292315, 13.5, -1, 0),
(52, 1292562, 7, -1, 0),
(53, 1291167, 20, -1, 0),
(53, 1292315, 16.5, -1, 0),
(53, 1292562, 0, -1, 1),
(54, 1292562, -1, 20, 0),
(55, 1291167, 9.6, -1, 0),
(55, 1292315, 14.4, -1, 0),
(55, 1292562, 0, -1, 1),
(56, 1291167, 12.6, -1, 0),
(56, 1292315, 13.3, -1, 0),
(56, 1292562, 6.3, -1, 0),
(57, 1292562, 10, -1, 0),
(58, 1291167, 15, -1, 0),
(58, 1292315, 16.5, -1, 0),
(58, 1292562, 14, -1, 0),
(59, 1291167, 17.5, -1, 0),
(59, 1292315, 20, -1, 0),
(59, 1292562, 12, -1, 0),
(60, 1291167, 6, -1, 0),
(60, 1292315, 12, -1, 0),
(60, 1292562, 11, -1, 0),
(61, 1291167, 20, -1, 0),
(61, 1292315, 14, -1, 0),
(61, 1292562, 10, -1, 0),
(62, 1291167, 18.5, -1, 0),
(62, 1292315, 16, -1, 0),
(62, 1292562, 15.5, -1, 0),
(64, 1291167, 11.5, -1, 0),
(64, 1292315, 12.5, -1, 0),
(64, 1292562, 8, -1, 0),
(65, 1291167, 9.5, -1, 0),
(65, 1292315, 7.5, -1, 0),
(65, 1292562, 0, -1, 1),
(66, 1291167, 11.1, -1, 0),
(66, 1292315, 12.7, -1, 0),
(66, 1292562, 11.8, -1, 0),
(67, 1291167, 16.9, -1, 0),
(67, 1292315, 12.4, -1, 0),
(67, 1292562, 0, -1, 1),
(68, 1292562, -1, 20, 0);

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
) ENGINE=InnoDB AUTO_INCREMENT=81 DEFAULT CHARSET=latin1;

--
-- Contenu de la table `evaluation`
--

INSERT INTO `evaluation` (`ID_Eval`, `ID_Cours`, `Nom_Eval`, `Coef_Eval`) VALUES
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
(79, 55, 'Théorie', 1),
(80, 1, 'Théorie', 1);

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
) ENGINE=InnoDB AUTO_INCREMENT=141 DEFAULT CHARSET=latin1;

--
-- Contenu de la table `type_eval`
--

INSERT INTO `type_eval` (`ID_Type`, `ID_Eval`, `Nom_Type`, `Coef_Type_Eval`) VALUES
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
(65, 58, 'Contrôle Continu', 0.5),
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
(125, 39, 'Evaluation', 1),
(129, 80, 'Interrogation', 0.2),
(130, 80, 'DS', 0.3),
(131, 80, 'Partiel', 0.5),
(132, 2, 'Interrogation', 0.2),
(133, 2, 'DS', 0.3),
(134, 2, 'Partiel', 0.5),
(135, 3, 'Interrogation', 0.2),
(136, 3, 'DS', 0.3),
(137, 3, 'Partiel', 0.5),
(138, 55, 'Evaluation', 1),
(140, 58, 'Projet', 0.5);

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
('maxence.faideau@isen-lille.fr', 1, 'Faideau', 'Maxence'),
('mikael.morelle@isen-lille.fr', 1, 'Morelle', 'Mikael');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;