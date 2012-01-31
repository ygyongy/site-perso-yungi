-- phpMyAdmin SQL Dump
-- version 3.2.4
-- http://www.phpmyadmin.net
--
-- Serveur: localhost
-- Généré le : Sam 05 Février 2011 à 18:14
-- Version du serveur: 5.1.41
-- Version de PHP: 5.3.1

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Base de données: `site_perso_yungi`
--

-- --------------------------------------------------------

--
-- Structure de la table `adresses`
--

CREATE TABLE IF NOT EXISTS `adresses` (
  `id_adresse` int(11) NOT NULL AUTO_INCREMENT,
  `rue_adresse` varchar(255) NOT NULL,
  `rue_adresse_2` varchar(255) NOT NULL,
  `utilisateurs_id_utilisateur` int(11) NOT NULL,
  `villes_id_ville` int(11) NOT NULL,
  PRIMARY KEY (`id_adresse`),
  KEY `fk_adresses_utilisateurs1` (`utilisateurs_id_utilisateur`),
  KEY `fk_adresses_villes1` (`villes_id_ville`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

--
-- Contenu de la table `adresses`
--


-- --------------------------------------------------------

--
-- Structure de la table `categories`
--

CREATE TABLE IF NOT EXISTS `categories` (
  `id_categorie` int(11) NOT NULL AUTO_INCREMENT,
  `nom_categorie` varchar(100) NOT NULL,
  `principal` enum('0','1') NOT NULL DEFAULT '0',
  `actif` enum('O','1') NOT NULL DEFAULT '1',
  `position` int(3) NOT NULL DEFAULT '1',
  `langues_id_langue` int(11) NOT NULL,
  PRIMARY KEY (`id_categorie`),
  KEY `fk_categories_langues1` (`langues_id_langue`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=10 ;

--
-- Contenu de la table `categories`
--

INSERT INTO `categories` (`id_categorie`, `nom_categorie`, `principal`, `actif`, `position`, `langues_id_langue`) VALUES
(1, 'Accueil', '1', '1', 1, 1),
(2, 'Entreprise', '1', '1', 2, 1),
(3, 'Catalogue', '1', '1', 3, 1),
(4, 'Home', '1', '1', 1, 2),
(5, 'Firm', '1', '1', 2, 2),
(6, 'Catalogue', '1', '1', 3, 2),
(7, 'Hause', '1', '1', 1, 3),
(8, 'Firma', '1', '1', 2, 3),
(9, 'Katalog', '1', '1', 3, 3);

-- --------------------------------------------------------

--
-- Structure de la table `contacts`
--

CREATE TABLE IF NOT EXISTS `contacts` (
  `id_contact` int(11) NOT NULL AUTO_INCREMENT,
  `type_contact` enum('tel','fax','email','mobile') NOT NULL DEFAULT 'email',
  `valeur_contact` varchar(255) NOT NULL,
  `position_contact` int(3) NOT NULL DEFAULT '1',
  `actif` enum('0','1') NOT NULL DEFAULT '1',
  `utilisateurs_id_utilisateur` int(11) NOT NULL,
  PRIMARY KEY (`id_contact`),
  KEY `fk_contacts_utilisateurs1` (`utilisateurs_id_utilisateur`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

--
-- Contenu de la table `contacts`
--


-- --------------------------------------------------------

--
-- Structure de la table `contenus`
--

CREATE TABLE IF NOT EXISTS `contenus` (
  `id_contenu` int(11) NOT NULL AUTO_INCREMENT,
  `titre` varchar(100) NOT NULL,
  `sous_titre` varchar(255) NOT NULL,
  `contenu` longtext NOT NULL,
  `position` int(11) NOT NULL,
  `actif` enum('0','1') NOT NULL DEFAULT '1',
  `protege` enum('0','1') NOT NULL DEFAULT '0',
  `websites_id_website` int(11) NOT NULL,
  `categories_id_categorie` int(11) NOT NULL,
  `types_contenus_id_types_contenus` int(11) NOT NULL,
  `utilisateurs_id_utilisateur` int(11) NOT NULL,
  `langues_id_langue` int(11) NOT NULL,
  PRIMARY KEY (`id_contenu`),
  UNIQUE KEY `titre_UNIQUE` (`titre`),
  KEY `fk_pages_website1` (`websites_id_website`),
  KEY `fk_contenus_categories1` (`categories_id_categorie`),
  KEY `fk_contenus_types_contenus1` (`types_contenus_id_types_contenus`),
  KEY `fk_contenus_utilisateurs1` (`utilisateurs_id_utilisateur`),
  KEY `fk_contenus_langues1` (`langues_id_langue`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COMMENT='le champ contenu JSON avec le contenu récupérer' AUTO_INCREMENT=14 ;

--
-- Contenu de la table `contenus`
--

INSERT INTO `contenus` (`id_contenu`, `titre`, `sous_titre`, `contenu`, `position`, `actif`, `protege`, `websites_id_website`, `categories_id_categorie`, `types_contenus_id_types_contenus`, `utilisateurs_id_utilisateur`, `langues_id_langue`) VALUES
(8, 'Accueil', 'Bienvenue sur la nouvelle version du site Tradiluxe. J''espère que vous aurez du plaisir à parcourir nos nouvelles pages. Surtout n''hésitez pas à nous envoyer vos commentaires', '{"titre":"Accueil","contenu":"<div class=\\"fleft\\" id=\\"cell_1\\" style=\\"width:173.5px; margin-right: 2px;\\">1<\\/div><div class=\\"fleft\\" id=\\"cell_2\\" style=\\"width:173.5px; margin-right: 2px;\\">2<\\/div><div class=\\"fleft\\" id=\\"cell_3\\" style=\\"width:173.5px; margin-right: 2px;\\">3<\\/div><div class=\\"fleft\\" id=\\"cell_4\\" style=\\"width:173.5px; margin-right: 2px;\\">4<\\/div><div class=''clear''>&nbsp<\\/div><div class=\\"fleft\\" id=\\"cell_5\\" style=\\"width:173.5px; margin-right: 2px;\\">5<\\/div><div class=\\"fleft\\" id=\\"cell_6\\" style=\\"width:173.5px; margin-right: 2px;\\">6<\\/div><div class=\\"fleft\\" id=\\"cell_7\\" style=\\"width:173.5px; margin-right: 2px;\\">7<\\/div><div class=\\"fleft\\" id=\\"cell_8\\" style=\\"width:173.5px; margin-right: 2px;\\">8<\\/div><div class=''clear''>&nbsp<\\/div><div class=\\"fleft\\" id=\\"cell_9\\" style=\\"width:173.5px; margin-right: 2px;\\">9<\\/div><div class=\\"fleft\\" id=\\"cell_10\\" style=\\"width:173.5px; margin-right: 2px;\\">10<\\/div><div class=''clear''>&nbsp<\\/div>"}', 1, '1', '0', 2, 1, 1, 1, 1),
(9, 'Entreprise', 'page élajflk fkajf jhfj àlsjfkd féljdgfkajsldf', '{"titre":"Entreprise","contenu":"Je suis la page entreprise"}', 1, '1', '0', 2, 2, 1, 1, 1),
(10, 'Hause', 'asdlkjflkajfélk jsfjfkaj flksajd', '{"titre":"Hause","contenu":"Ich bin des Huus Zettel"}', 1, '1', '0', 2, 7, 1, 1, 3),
(13, 'Home', 'page home jélsakdjfélajfsa djsa fla', '{"titre":"Home","contenu":"Welcome Home"}', 1, '1', '0', 2, 4, 1, 1, 2);

-- --------------------------------------------------------

--
-- Structure de la table `fichiers`
--

CREATE TABLE IF NOT EXISTS `fichiers` (
  `id_fichiers` int(11) NOT NULL AUTO_INCREMENT,
  `nom_fichier` varchar(255) NOT NULL,
  `date_ajout` int(11) NOT NULL,
  `date_modification` int(11) NOT NULL,
  `position` int(2) NOT NULL DEFAULT '1',
  `actif` enum('0','1') NOT NULL DEFAULT '1',
  `types_fichiers_id_type_fichier` int(11) NOT NULL,
  `contenus_id_contenu` int(11) NOT NULL,
  `langues_id_langue` int(11) NOT NULL,
  PRIMARY KEY (`id_fichiers`),
  KEY `fk_fichiers_types_fichiers1` (`types_fichiers_id_type_fichier`),
  KEY `fk_fichiers_contenus1` (`contenus_id_contenu`),
  KEY `fk_fichiers_langues1` (`langues_id_langue`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

--
-- Contenu de la table `fichiers`
--


-- --------------------------------------------------------

--
-- Structure de la table `fields`
--

CREATE TABLE IF NOT EXISTS `fields` (
  `id_field` int(11) NOT NULL AUTO_INCREMENT,
  `balise_field` varchar(45) NOT NULL,
  `type_field` varchar(45) NOT NULL,
  `html_id_field` varchar(255) NOT NULL,
  `nom_field` varchar(200) NOT NULL,
  `class_field` varchar(255) DEFAULT '',
  `valeur_defaut` longtext,
  `position` int(2) NOT NULL DEFAULT '1',
  `actif` enum('0','1') NOT NULL DEFAULT '1',
  `labels_id_label` int(11) NOT NULL,
  `type_valeur_field` varchar(45) DEFAULT NULL,
  PRIMARY KEY (`id_field`),
  KEY `fk_fields_labels1` (`labels_id_label`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=2 ;

--
-- Contenu de la table `fields`
--

INSERT INTO `fields` (`id_field`, `balise_field`, `type_field`, `html_id_field`, `nom_field`, `class_field`, `valeur_defaut`, `position`, `actif`, `labels_id_label`, `type_valeur_field`) VALUES
(1, 'input', 'text', 'titre_page', 'titre_page', NULL, 'entrez le titre', 1, '1', 1, 'string');

-- --------------------------------------------------------

--
-- Structure de la table `fields_has_types_contenus`
--

CREATE TABLE IF NOT EXISTS `fields_has_types_contenus` (
  `fields_id_field` int(11) NOT NULL,
  `types_contenus_id_types_contenus` int(11) NOT NULL,
  PRIMARY KEY (`fields_id_field`,`types_contenus_id_types_contenus`),
  KEY `fk_fields_has_types_contenus_types_contenus1` (`types_contenus_id_types_contenus`),
  KEY `fk_fields_has_types_contenus_fields1` (`fields_id_field`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Contenu de la table `fields_has_types_contenus`
--


-- --------------------------------------------------------

--
-- Structure de la table `groupes`
--

CREATE TABLE IF NOT EXISTS `groupes` (
  `id_groupe` int(11) NOT NULL AUTO_INCREMENT,
  `nom_groupe` varchar(45) NOT NULL,
  `droit` int(11) NOT NULL,
  PRIMARY KEY (`id_groupe`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=6 ;

--
-- Contenu de la table `groupes`
--

INSERT INTO `groupes` (`id_groupe`, `nom_groupe`, `droit`) VALUES
(1, 'administration', 1111),
(2, 'editeur', 111),
(3, 'user_pro', 11),
(4, 'user', 1),
(5, 'unregister', 0);

-- --------------------------------------------------------

--
-- Structure de la table `labels`
--

CREATE TABLE IF NOT EXISTS `labels` (
  `id_label` int(11) NOT NULL AUTO_INCREMENT,
  `nom_label` varchar(255) NOT NULL,
  `class` varchar(255) DEFAULT '',
  `langues_id_langue` int(11) NOT NULL,
  PRIMARY KEY (`id_label`),
  KEY `fk_labels_langues1` (`langues_id_langue`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=2 ;

--
-- Contenu de la table `labels`
--

INSERT INTO `labels` (`id_label`, `nom_label`, `class`, `langues_id_langue`) VALUES
(1, 'Titre de la page', NULL, 1);

-- --------------------------------------------------------

--
-- Structure de la table `langues`
--

CREATE TABLE IF NOT EXISTS `langues` (
  `id_langue` int(11) NOT NULL AUTO_INCREMENT,
  `code_langue` char(2) NOT NULL DEFAULT 'fr',
  `nom_langue` varchar(45) NOT NULL DEFAULT 'français',
  `position` int(3) NOT NULL DEFAULT '1',
  `actif` enum('0','1') NOT NULL DEFAULT '1',
  PRIMARY KEY (`id_langue`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=4 ;

--
-- Contenu de la table `langues`
--

INSERT INTO `langues` (`id_langue`, `code_langue`, `nom_langue`, `position`, `actif`) VALUES
(1, 'fr', 'français', 1, '1'),
(2, 'en', 'english', 2, '1'),
(3, 'de', 'deutsch', 3, '1');

-- --------------------------------------------------------

--
-- Structure de la table `pays`
--

CREATE TABLE IF NOT EXISTS `pays` (
  `id_pays` int(11) NOT NULL AUTO_INCREMENT,
  `nom_pays` varchar(100) NOT NULL,
  PRIMARY KEY (`id_pays`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

--
-- Contenu de la table `pays`
--


-- --------------------------------------------------------

--
-- Structure de la table `sous_categoires`
--

CREATE TABLE IF NOT EXISTS `sous_categoires` (
  `id_sous_categorie` int(11) NOT NULL AUTO_INCREMENT,
  `nom_sous_categorie` varchar(200) NOT NULL,
  `principal` enum('0','1') NOT NULL DEFAULT '0',
  `actif` enum('0','1') NOT NULL DEFAULT '1',
  `position` int(3) NOT NULL DEFAULT '1',
  `categories_id_categorie` int(11) NOT NULL,
  `langues_id_langue` int(11) NOT NULL,
  PRIMARY KEY (`id_sous_categorie`),
  KEY `fk_sous_categoires_categories1` (`categories_id_categorie`),
  KEY `fk_sous_categoires_langues1` (`langues_id_langue`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

--
-- Contenu de la table `sous_categoires`
--


-- --------------------------------------------------------

--
-- Structure de la table `types_contenus`
--

CREATE TABLE IF NOT EXISTS `types_contenus` (
  `id_types_contenus` int(11) NOT NULL AUTO_INCREMENT,
  `nom_type_contenu` varchar(45) NOT NULL,
  `actif` enum('0','1') NOT NULL DEFAULT '1',
  PRIMARY KEY (`id_types_contenus`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=2 ;

--
-- Contenu de la table `types_contenus`
--

INSERT INTO `types_contenus` (`id_types_contenus`, `nom_type_contenu`, `actif`) VALUES
(1, 'pages', '1');

-- --------------------------------------------------------

--
-- Structure de la table `types_fichiers`
--

CREATE TABLE IF NOT EXISTS `types_fichiers` (
  `id_type_fichier` int(11) NOT NULL AUTO_INCREMENT,
  `nom_type_fichier` varchar(100) NOT NULL,
  `actif` enum('0','1') NOT NULL DEFAULT '1',
  PRIMARY KEY (`id_type_fichier`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=6 ;

--
-- Contenu de la table `types_fichiers`
--

INSERT INTO `types_fichiers` (`id_type_fichier`, `nom_type_fichier`, `actif`) VALUES
(1, 'image', '1'),
(2, 'vidéos', '1'),
(3, 'artwork', '1'),
(4, 'document', '1'),
(5, 'script', '1');

-- --------------------------------------------------------

--
-- Structure de la table `utilisateurs`
--

CREATE TABLE IF NOT EXISTS `utilisateurs` (
  `id_utilisateur` int(11) NOT NULL AUTO_INCREMENT,
  `nom_utilisateur` varchar(100) NOT NULL,
  `prenom_utilisateur` varchar(100) NOT NULL,
  `login_utilisateur` varchar(100) NOT NULL,
  `pwd_utilisateur` varchar(255) NOT NULL,
  `langues_id_langue` int(11) NOT NULL,
  PRIMARY KEY (`id_utilisateur`),
  KEY `fk_utilisateurs_langues1` (`langues_id_langue`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=2 ;

--
-- Contenu de la table `utilisateurs`
--

INSERT INTO `utilisateurs` (`id_utilisateur`, `nom_utilisateur`, `prenom_utilisateur`, `login_utilisateur`, `pwd_utilisateur`, `langues_id_langue`) VALUES
(1, 'Gyongy', 'Yann', 'ygyongy', 'test', 1);

-- --------------------------------------------------------

--
-- Structure de la table `utilisateurs_has_groupes`
--

CREATE TABLE IF NOT EXISTS `utilisateurs_has_groupes` (
  `utilisateurs_id_utilisateur` int(11) NOT NULL,
  `groupes_id_groupe` int(11) NOT NULL,
  PRIMARY KEY (`utilisateurs_id_utilisateur`,`groupes_id_groupe`),
  KEY `fk_utilisateurs_has_groupes_groupes1` (`groupes_id_groupe`),
  KEY `fk_utilisateurs_has_groupes_utilisateurs1` (`utilisateurs_id_utilisateur`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Contenu de la table `utilisateurs_has_groupes`
--

INSERT INTO `utilisateurs_has_groupes` (`utilisateurs_id_utilisateur`, `groupes_id_groupe`) VALUES
(1, 1),
(1, 2),
(1, 3);

-- --------------------------------------------------------

--
-- Structure de la table `villes`
--

CREATE TABLE IF NOT EXISTS `villes` (
  `id_ville` int(11) NOT NULL AUTO_INCREMENT,
  `npa_ville` int(4) NOT NULL,
  `nom_ville` varchar(45) NOT NULL,
  `pays_id_pays` int(11) NOT NULL,
  PRIMARY KEY (`id_ville`),
  KEY `fk_villes_pays1` (`pays_id_pays`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

--
-- Contenu de la table `villes`
--


-- --------------------------------------------------------

--
-- Structure de la table `websites`
--

CREATE TABLE IF NOT EXISTS `websites` (
  `id_website` int(11) NOT NULL AUTO_INCREMENT,
  `nom` varchar(45) NOT NULL,
  `adresse_1` varchar(255) DEFAULT NULL,
  `adresse_2` varchar(255) DEFAULT NULL,
  `npa` int(4) DEFAULT NULL,
  `ville` varchar(100) DEFAULT NULL,
  `tel` varchar(16) DEFAULT NULL,
  `mobile` varchar(16) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id_website`),
  UNIQUE KEY `nom_UNIQUE` (`nom`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=3 ;

--
-- Contenu de la table `websites`
--

INSERT INTO `websites` (`id_website`, `nom`, `adresse_1`, `adresse_2`, `npa`, `ville`, `tel`, `mobile`, `email`) VALUES
(2, 'Yungi_design', 'Rue Etraz 2', NULL, 1003, 'Lausanne', '+41 78 769 00 80', '+41 78 769 00 80', 'ygyongy@tradiluxe.com');

--
-- Contraintes pour les tables exportées
--

--
-- Contraintes pour la table `adresses`
--
ALTER TABLE `adresses`
  ADD CONSTRAINT `fk_adresses_utilisateurs1` FOREIGN KEY (`utilisateurs_id_utilisateur`) REFERENCES `utilisateurs` (`id_utilisateur`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_adresses_villes1` FOREIGN KEY (`villes_id_ville`) REFERENCES `villes` (`id_ville`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Contraintes pour la table `categories`
--
ALTER TABLE `categories`
  ADD CONSTRAINT `fk_categories_langues1` FOREIGN KEY (`langues_id_langue`) REFERENCES `langues` (`id_langue`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Contraintes pour la table `contacts`
--
ALTER TABLE `contacts`
  ADD CONSTRAINT `fk_contacts_utilisateurs1` FOREIGN KEY (`utilisateurs_id_utilisateur`) REFERENCES `utilisateurs` (`id_utilisateur`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Contraintes pour la table `contenus`
--
ALTER TABLE `contenus`
  ADD CONSTRAINT `fk_contenus_categories1` FOREIGN KEY (`categories_id_categorie`) REFERENCES `categories` (`id_categorie`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_contenus_langues1` FOREIGN KEY (`langues_id_langue`) REFERENCES `langues` (`id_langue`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_contenus_types_contenus1` FOREIGN KEY (`types_contenus_id_types_contenus`) REFERENCES `types_contenus` (`id_types_contenus`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_contenus_utilisateurs1` FOREIGN KEY (`utilisateurs_id_utilisateur`) REFERENCES `utilisateurs` (`id_utilisateur`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_pages_website1` FOREIGN KEY (`websites_id_website`) REFERENCES `websites` (`id_website`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Contraintes pour la table `fichiers`
--
ALTER TABLE `fichiers`
  ADD CONSTRAINT `fk_fichiers_contenus1` FOREIGN KEY (`contenus_id_contenu`) REFERENCES `contenus` (`id_contenu`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_fichiers_langues1` FOREIGN KEY (`langues_id_langue`) REFERENCES `langues` (`id_langue`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_fichiers_types_fichiers1` FOREIGN KEY (`types_fichiers_id_type_fichier`) REFERENCES `types_fichiers` (`id_type_fichier`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Contraintes pour la table `fields`
--
ALTER TABLE `fields`
  ADD CONSTRAINT `fk_fields_labels1` FOREIGN KEY (`labels_id_label`) REFERENCES `labels` (`id_label`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Contraintes pour la table `fields_has_types_contenus`
--
ALTER TABLE `fields_has_types_contenus`
  ADD CONSTRAINT `fk_fields_has_types_contenus_fields1` FOREIGN KEY (`fields_id_field`) REFERENCES `fields` (`id_field`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_fields_has_types_contenus_types_contenus1` FOREIGN KEY (`types_contenus_id_types_contenus`) REFERENCES `types_contenus` (`id_types_contenus`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Contraintes pour la table `labels`
--
ALTER TABLE `labels`
  ADD CONSTRAINT `fk_labels_langues1` FOREIGN KEY (`langues_id_langue`) REFERENCES `langues` (`id_langue`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Contraintes pour la table `sous_categoires`
--
ALTER TABLE `sous_categoires`
  ADD CONSTRAINT `fk_sous_categoires_categories1` FOREIGN KEY (`categories_id_categorie`) REFERENCES `categories` (`id_categorie`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_sous_categoires_langues1` FOREIGN KEY (`langues_id_langue`) REFERENCES `langues` (`id_langue`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Contraintes pour la table `utilisateurs`
--
ALTER TABLE `utilisateurs`
  ADD CONSTRAINT `fk_utilisateurs_langues1` FOREIGN KEY (`langues_id_langue`) REFERENCES `langues` (`id_langue`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Contraintes pour la table `utilisateurs_has_groupes`
--
ALTER TABLE `utilisateurs_has_groupes`
  ADD CONSTRAINT `fk_utilisateurs_has_groupes_groupes1` FOREIGN KEY (`groupes_id_groupe`) REFERENCES `groupes` (`id_groupe`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_utilisateurs_has_groupes_utilisateurs1` FOREIGN KEY (`utilisateurs_id_utilisateur`) REFERENCES `utilisateurs` (`id_utilisateur`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Contraintes pour la table `villes`
--
ALTER TABLE `villes`
  ADD CONSTRAINT `fk_villes_pays1` FOREIGN KEY (`pays_id_pays`) REFERENCES `pays` (`id_pays`) ON DELETE NO ACTION ON UPDATE NO ACTION;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
