-- phpMyAdmin SQL Dump
-- version 4.1.4
-- http://www.phpmyadmin.net
--
-- Client :  127.0.0.1
-- Généré le :  Ven 07 Février 2014 à 21:02
-- Version du serveur :  5.6.15-log
-- Version de PHP :  5.5.8

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Base de données :  `bdd_hopital_cfdj`
--

-- --------------------------------------------------------

--
-- Structure de la table `chambre`
--

CREATE TABLE IF NOT EXISTS `chambre` (
  `id_chambre` int(11) NOT NULL AUTO_INCREMENT,
  `nbr_lits` int(11) DEFAULT NULL,
  `nbr_lits_dispo` int(11) DEFAULT NULL,
  `id_service` int(11) DEFAULT NULL,
  `id_perso_adm` int(11) DEFAULT NULL,
  PRIMARY KEY (`id_chambre`),
  KEY `fk_id_service2` (`id_service`),
  KEY `fk_id_perso_adm` (`id_perso_adm`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=3 ;

--
-- Contenu de la table `chambre`
--

INSERT INTO `chambre` (`id_chambre`, `nbr_lits`, `nbr_lits_dispo`, `id_service`, `id_perso_adm`) VALUES
(1, 6, 6, 1, 1),
(2, 2, 2, 2, 1);

-- --------------------------------------------------------

--
-- Structure de la table `diagnostique`
--

CREATE TABLE IF NOT EXISTS `diagnostique` (
  `id_diag` int(11) NOT NULL AUTO_INCREMENT,
  `id_medecin` int(11) DEFAULT NULL,
  `exam_pratique` varchar(5000) DEFAULT NULL,
  `commentaire` varchar(5000) DEFAULT NULL,
  `date` date DEFAULT NULL,
  PRIMARY KEY (`id_diag`),
  KEY `fk_id_medecin2` (`id_medecin`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=16 ;

--
-- Contenu de la table `diagnostique`
--

INSERT INTO `diagnostique` (`id_diag`, `id_medecin`, `exam_pratique`, `commentaire`, `date`) VALUES
(12, 3, 'grave maladie infectieuse attrapee au congo', 'mise sous quarantaine ', '2014-02-05'),
(11, 1, 's''est coupe le doigt', 'un bon pansement', '2014-01-15'),
(10, 1, 'nouvel an trop arrose', 'beaucoup de repos en salle de degrisement', '2014-01-01'),
(13, 2, 'grave troubles psychomoteurs, atteint de la maladie de Parkinson en debut de phase', 'mise en place du traitement 6432a', '2014-01-18'),
(14, 2, 'narcissisme destructif', 'retirer toutes surfaces reflechissantes de ', '2014-01-05');

-- --------------------------------------------------------

--
-- Structure de la table `fiche_nettoyage`
--

CREATE TABLE IF NOT EXISTS `fiche_nettoyage` (
  `date` date DEFAULT NULL,
  `id_chambre` int(11) DEFAULT NULL,
  `id_perso_net` int(11) DEFAULT NULL,
  KEY `fk_id_chambre2` (`id_chambre`),
  KEY `fk_id_perso_net` (`id_perso_net`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Contenu de la table `fiche_nettoyage`
--

INSERT INTO `fiche_nettoyage` (`date`, `id_chambre`, `id_perso_net`) VALUES
('2014-02-05', 1, 1),
('2014-02-05', 1, 1),
('2014-02-05', 1, 1),
('2014-02-10', 1, 1);

-- --------------------------------------------------------

--
-- Structure de la table `infirmier`
--

CREATE TABLE IF NOT EXISTS `infirmier` (
  `id_infirmier` int(11) NOT NULL AUTO_INCREMENT,
  `nom_personne` varchar(50) DEFAULT NULL,
  `prenom_personne` varchar(50) DEFAULT NULL,
  `date_naissance` date DEFAULT NULL,
  `id_service` int(11) DEFAULT NULL,
  PRIMARY KEY (`id_infirmier`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=4 ;

--
-- Contenu de la table `infirmier`
--

INSERT INTO `infirmier` (`id_infirmier`, `nom_personne`, `prenom_personne`, `date_naissance`, `id_service`) VALUES
(1, 'DANIEL', 'Jacqueline', '1967-12-31', 1),
(2, 'DANIEL', 'Bernard', '0000-00-00', 2),
(3, 'DURUISSEAU', 'Charlotte', '0000-00-00', 3);

-- --------------------------------------------------------

--
-- Structure de la table `infirmier_reunion`
--

CREATE TABLE IF NOT EXISTS `infirmier_reunion` (
  `id_infirmier` int(11) DEFAULT NULL,
  `id_reunion` int(11) DEFAULT NULL,
  KEY `fk_id_infirmier` (`id_infirmier`),
  KEY `fk_id_reunion` (`id_reunion`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Structure de la table `medecin`
--

CREATE TABLE IF NOT EXISTS `medecin` (
  `id_medecin` int(11) NOT NULL AUTO_INCREMENT,
  `id_service` int(11) DEFAULT NULL,
  `pwd` varchar(50) DEFAULT NULL,
  `nom_personne` varchar(50) DEFAULT NULL,
  `prenom_personne` varchar(50) DEFAULT NULL,
  `date_naissance` date DEFAULT NULL,
  PRIMARY KEY (`id_medecin`),
  KEY `fk_id_service` (`id_service`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=4 ;

--
-- Contenu de la table `medecin`
--

INSERT INTO `medecin` (`id_medecin`, `id_service`, `pwd`, `nom_personne`, `prenom_personne`, `date_naissance`) VALUES
(1, 1, '123', 'FEITH', 'Dylan', '1993-12-17'),
(2, 2, '456', 'COMBAZ', 'Helene', '1980-08-04'),
(3, 3, '789', 'DO', 'Antoine', '1990-11-11');

-- --------------------------------------------------------

--
-- Structure de la table `medecin_reunion`
--

CREATE TABLE IF NOT EXISTS `medecin_reunion` (
  `id_medecin` int(11) DEFAULT NULL,
  `id_reunion` int(11) DEFAULT NULL,
  KEY `fk_id_medecin3` (`id_medecin`),
  KEY `fk_id_reunion2` (`id_reunion`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Contenu de la table `medecin_reunion`
--

INSERT INTO `medecin_reunion` (`id_medecin`, `id_reunion`) VALUES
(1, 1),
(1, 2);

-- --------------------------------------------------------

--
-- Structure de la table `medicament`
--

CREATE TABLE IF NOT EXISTS `medicament` (
  `id_medoc` int(11) NOT NULL AUTO_INCREMENT,
  `description` varchar(1000) DEFAULT NULL,
  PRIMARY KEY (`id_medoc`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=3 ;

--
-- Contenu de la table `medicament`
--

INSERT INTO `medicament` (`id_medoc`, `description`) VALUES
(1, 'Smecta : Utile en cas de diarrhées passagères...'),
(2, 'Vogolen : Si vous prévoyez une soirée bien arrosée, avec ça, vous n aurez pas à craindre de refaire vos toilettes');

-- --------------------------------------------------------

--
-- Structure de la table `patient`
--

CREATE TABLE IF NOT EXISTS `patient` (
  `id_patient` int(11) NOT NULL AUTO_INCREMENT,
  `nom_personne` varchar(50) DEFAULT NULL,
  `prenom_personne` varchar(50) DEFAULT NULL,
  `date_naissance` date DEFAULT NULL,
  PRIMARY KEY (`id_patient`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=5 ;

--
-- Contenu de la table `patient`
--

INSERT INTO `patient` (`id_patient`, `nom_personne`, `prenom_personne`, `date_naissance`) VALUES
(1, 'STRAUSS-KAHNN', 'Dominique', '1967-12-31'),
(2, 'COURTECUISSE', 'Gaetan', '1993-09-29'),
(3, 'DESIR', 'Jeremy', '1994-11-22'),
(4, 'aaa', 'aaa', '1993-12-12');

-- --------------------------------------------------------

--
-- Structure de la table `personnel_administratif`
--

CREATE TABLE IF NOT EXISTS `personnel_administratif` (
  `id_perso_adm` int(11) NOT NULL AUTO_INCREMENT,
  `pwd` varchar(50) DEFAULT NULL,
  `nom_personne` varchar(50) DEFAULT NULL,
  `prenom_personne` varchar(50) DEFAULT NULL,
  `date_naissance` date DEFAULT NULL,
  PRIMARY KEY (`id_perso_adm`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=3 ;

--
-- Contenu de la table `personnel_administratif`
--

INSERT INTO `personnel_administratif` (`id_perso_adm`, `pwd`, `nom_personne`, `prenom_personne`, `date_naissance`) VALUES
(1, '123', 'BINTNER', 'Wendy', '1993-01-22'),
(2, NULL, 'DESIR', 'Jeremy', '1960-02-25');

-- --------------------------------------------------------

--
-- Structure de la table `personnel_de_nettoyage`
--

CREATE TABLE IF NOT EXISTS `personnel_de_nettoyage` (
  `id_perso_net` int(11) NOT NULL AUTO_INCREMENT,
  `nom_personne` varchar(50) DEFAULT NULL,
  `prenom_personne` varchar(50) DEFAULT NULL,
  `date_naissance` date DEFAULT NULL,
  PRIMARY KEY (`id_perso_net`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=3 ;

--
-- Contenu de la table `personnel_de_nettoyage`
--

INSERT INTO `personnel_de_nettoyage` (`id_perso_net`, `nom_personne`, `prenom_personne`, `date_naissance`) VALUES
(1, 'JEAN', 'Yoann', '1994-06-15'),
(2, 'TONG', 'Patrick', '1991-05-31');

-- --------------------------------------------------------

--
-- Structure de la table `reunion`
--

CREATE TABLE IF NOT EXISTS `reunion` (
  `id_reunion` int(11) NOT NULL AUTO_INCREMENT,
  `date_reunion` date DEFAULT NULL,
  PRIMARY KEY (`id_reunion`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=3 ;

--
-- Contenu de la table `reunion`
--

INSERT INTO `reunion` (`id_reunion`, `date_reunion`) VALUES
(1, '2014-01-01'),
(2, '2014-03-10');

-- --------------------------------------------------------

--
-- Structure de la table `sejour`
--

CREATE TABLE IF NOT EXISTS `sejour` (
  `id_sejour` int(11) NOT NULL AUTO_INCREMENT,
  `id_patient` int(11) DEFAULT NULL,
  `id_diag` int(11) DEFAULT NULL,
  `date_arrivee` date DEFAULT NULL,
  `date_sortie_prev` date DEFAULT NULL,
  `date_sortie` date DEFAULT NULL,
  PRIMARY KEY (`id_sejour`),
  KEY `fk_id_patient` (`id_patient`),
  KEY `fk_id_diag` (`id_diag`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=16 ;

--
-- Contenu de la table `sejour`
--

INSERT INTO `sejour` (`id_sejour`, `id_patient`, `id_diag`, `date_arrivee`, `date_sortie_prev`, `date_sortie`) VALUES
(14, 3, 14, '2014-01-05', '2014-01-12', '2014-01-12'),
(15, 4, NULL, '2014-02-07', '0214-12-24', NULL),
(12, 2, 15, '2014-01-18', '2015-01-01', NULL),
(11, 1, 12, '2014-02-05', '2014-06-15', NULL),
(10, 1, 11, '2014-01-15', '2014-01-16', '2014-01-16'),
(9, 1, 10, '2014-01-01', '2014-01-10', '2014-01-08');

-- --------------------------------------------------------

--
-- Structure de la table `sejour_chambre`
--

CREATE TABLE IF NOT EXISTS `sejour_chambre` (
  `id_sejour` int(11) DEFAULT NULL,
  `id_chambre` int(11) DEFAULT NULL,
  `date_arrivee` date DEFAULT NULL,
  `date_sortie` date DEFAULT NULL,
  KEY `fk_id_sejour2` (`id_sejour`),
  KEY `fk_id_chambre` (`id_chambre`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Structure de la table `sejour_service`
--

CREATE TABLE IF NOT EXISTS `sejour_service` (
  `id_sejour` int(11) DEFAULT NULL,
  `id_service` int(11) DEFAULT NULL,
  KEY `fk_id_sejour` (`id_sejour`),
  KEY `fk_id_service3` (`id_service`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Contenu de la table `sejour_service`
--

INSERT INTO `sejour_service` (`id_sejour`, `id_service`) VALUES
(9, 1),
(10, 1),
(11, 3),
(12, 2),
(14, 2),
(15, 1);

-- --------------------------------------------------------

--
-- Structure de la table `service`
--

CREATE TABLE IF NOT EXISTS `service` (
  `id_service` int(11) NOT NULL AUTO_INCREMENT,
  `id_medecin` int(11) DEFAULT NULL,
  `id_perso_adm` int(11) DEFAULT NULL,
  `etage` int(11) DEFAULT NULL,
  `nom_service` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`id_service`),
  KEY `fk_id_respo_service` (`id_perso_adm`),
  KEY `fk_id_medecin` (`id_medecin`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=4 ;

--
-- Contenu de la table `service`
--

INSERT INTO `service` (`id_service`, `id_medecin`, `id_perso_adm`, `etage`, `nom_service`) VALUES
(1, 1, 1, 2, 'urgences'),
(2, 2, 2, 3, 'psychatrie'),
(3, 3, 1, 4, 'maladie infectieuse');

-- --------------------------------------------------------

--
-- Structure de la table `soin`
--

CREATE TABLE IF NOT EXISTS `soin` (
  `id_soin` int(11) NOT NULL AUTO_INCREMENT,
  `id_patient` int(11) DEFAULT NULL,
  `description` varchar(500) DEFAULT NULL,
  `date` date DEFAULT NULL,
  PRIMARY KEY (`id_soin`),
  KEY `fk_id_patient2` (`id_patient`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=12 ;

--
-- Contenu de la table `soin`
--

INSERT INTO `soin` (`id_soin`, `id_patient`, `description`, `date`) VALUES
(8, 1, 'mise en salle de degrisement', '2014-01-01'),
(9, 1, 'debut d''une therapie anti_alcool de 7 jours', '2014-01-03'),
(10, 1, 'Pose d''un pansement elastoplaste', '2014-01-15');

-- --------------------------------------------------------

--
-- Structure de la table `soin_infirmier`
--

CREATE TABLE IF NOT EXISTS `soin_infirmier` (
  `id_soin` int(11) DEFAULT NULL,
  `id_infirmier` int(11) DEFAULT NULL,
  KEY `fk_id_soin2` (`id_soin`),
  KEY `fk_id_infirmier2` (`id_infirmier`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Structure de la table `soin_medicament`
--

CREATE TABLE IF NOT EXISTS `soin_medicament` (
  `id_soin` int(11) DEFAULT NULL,
  `id_medoc` int(11) DEFAULT NULL,
  KEY `fk_id_soin` (`id_soin`),
  KEY `fk_id_medoc` (`id_medoc`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Contenu de la table `soin_medicament`
--

INSERT INTO `soin_medicament` (`id_soin`, `id_medoc`) VALUES
(9, 1),
(8, 2),
(10, 2),
(10, 1);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
