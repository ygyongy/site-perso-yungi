SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0;
SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0;
SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='TRADITIONAL';

DROP SCHEMA IF EXISTS `site_perso_yungi` ;
CREATE SCHEMA IF NOT EXISTS `site_perso_yungi` DEFAULT CHARACTER SET utf8 COLLATE utf8_general_ci ;
USE `site_perso_yungi` ;

-- -----------------------------------------------------
-- Table `site_perso_yungi`.`websites`
-- -----------------------------------------------------
CREATE  TABLE IF NOT EXISTS `site_perso_yungi`.`websites` (
  `id_website` INT(11) NOT NULL AUTO_INCREMENT ,
  `nom` VARCHAR(45) NOT NULL ,
  `adresse_1` VARCHAR(255) NULL DEFAULT NULL ,
  `adresse_2` VARCHAR(255) NULL DEFAULT NULL ,
  `npa` INT(4) NULL DEFAULT NULL ,
  `ville` VARCHAR(100) NULL DEFAULT NULL ,
  `tel` VARCHAR(16) NULL DEFAULT NULL ,
  `mobile` VARCHAR(16) NULL DEFAULT NULL ,
  `email` VARCHAR(255) NULL DEFAULT NULL ,
  PRIMARY KEY (`id_website`) )
ENGINE = InnoDB
AUTO_INCREMENT = 2
DEFAULT CHARACTER SET = utf8
COLLATE = utf8_general_ci;

CREATE UNIQUE INDEX `nom_UNIQUE` ON `site_perso_yungi`.`websites` (`nom` ASC) ;


-- -----------------------------------------------------
-- Table `site_perso_yungi`.`langues`
-- -----------------------------------------------------
CREATE  TABLE IF NOT EXISTS `site_perso_yungi`.`langues` (
  `id_langue` INT(11) NOT NULL AUTO_INCREMENT ,
  `code_langue` CHAR(2) NOT NULL DEFAULT 'fr' ,
  `nom_langue` VARCHAR(45) NOT NULL DEFAULT 'français' ,
  `position` INT(3) NOT NULL DEFAULT 1 ,
  `actif` ENUM('0','1') NOT NULL DEFAULT '1' ,
  PRIMARY KEY (`id_langue`) )
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8
COLLATE = utf8_general_ci;


-- -----------------------------------------------------
-- Table `site_perso_yungi`.`categories`
-- -----------------------------------------------------
CREATE  TABLE IF NOT EXISTS `site_perso_yungi`.`categories` (
  `id_categorie` INT(11) NOT NULL AUTO_INCREMENT ,
  `nom_categorie` VARCHAR(100) NOT NULL ,
  `principal` ENUM('0', '1') NOT NULL DEFAULT '0' ,
  `actif` ENUM('O', '1') NOT NULL DEFAULT '1' ,
  `position` INT(3) NOT NULL DEFAULT 1 ,
  `langues_id_langue` INT(11) NOT NULL ,
  PRIMARY KEY (`id_categorie`) ,
  CONSTRAINT `fk_categories_langues1`
    FOREIGN KEY (`langues_id_langue` )
    REFERENCES `site_perso_yungi`.`langues` (`id_langue` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8
COLLATE = utf8_general_ci;

CREATE INDEX `fk_categories_langues1` ON `site_perso_yungi`.`categories` (`langues_id_langue` ASC) ;


-- -----------------------------------------------------
-- Table `site_perso_yungi`.`types_contenus`
-- -----------------------------------------------------
CREATE  TABLE IF NOT EXISTS `site_perso_yungi`.`types_contenus` (
  `id_types_contenus` INT NOT NULL AUTO_INCREMENT ,
  `nom_type_contenu` VARCHAR(45) NOT NULL ,
  `actif` ENUM('0','1') NOT NULL DEFAULT '1' ,
  PRIMARY KEY (`id_types_contenus`) )
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8
COLLATE = utf8_general_ci;


-- -----------------------------------------------------
-- Table `site_perso_yungi`.`utilisateurs`
-- -----------------------------------------------------
CREATE  TABLE IF NOT EXISTS `site_perso_yungi`.`utilisateurs` (
  `id_utilisateur` INT(11) NOT NULL AUTO_INCREMENT ,
  `nom_utilisateur` VARCHAR(100) NOT NULL ,
  `prenom_utilisateur` VARCHAR(100) NOT NULL ,
  `login_utilisateur` VARCHAR(100) NOT NULL ,
  `pwd_utilisateur` VARCHAR(255) NOT NULL ,
  `langues_id_langue` INT(11) NOT NULL ,
  PRIMARY KEY (`id_utilisateur`) ,
  CONSTRAINT `fk_utilisateurs_langues1`
    FOREIGN KEY (`langues_id_langue` )
    REFERENCES `site_perso_yungi`.`langues` (`id_langue` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8
COLLATE = utf8_general_ci;

CREATE INDEX `fk_utilisateurs_langues1` ON `site_perso_yungi`.`utilisateurs` (`langues_id_langue` ASC) ;


-- -----------------------------------------------------
-- Table `site_perso_yungi`.`contenus`
-- -----------------------------------------------------
CREATE  TABLE IF NOT EXISTS `site_perso_yungi`.`contenus` (
  `id_contenu` INT(11) NOT NULL AUTO_INCREMENT ,
  `titre` VARCHAR(100) NOT NULL ,
  `sous_titre` VARCHAR(255) NOT NULL ,
  `contenu` LONGTEXT NOT NULL ,
  `position` INT(11) NOT NULL ,
  `actif` ENUM('0', '1') NOT NULL DEFAULT '1' ,
  `protege` ENUM('0','1') NOT NULL DEFAULT '0' ,
  `websites_id_website` INT(11) NOT NULL ,
  `categories_id_categorie` INT NOT NULL ,
  `types_contenus_id_types_contenus` INT NOT NULL ,
  `utilisateurs_id_utilisateur` INT(11) NOT NULL ,
  `langues_id_langue` INT(11) NOT NULL ,
  PRIMARY KEY (`id_contenu`) ,
  CONSTRAINT `fk_pages_website1`
    FOREIGN KEY (`websites_id_website` )
    REFERENCES `site_perso_yungi`.`websites` (`id_website` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_contenus_categories1`
    FOREIGN KEY (`categories_id_categorie` )
    REFERENCES `site_perso_yungi`.`categories` (`id_categorie` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_contenus_types_contenus1`
    FOREIGN KEY (`types_contenus_id_types_contenus` )
    REFERENCES `site_perso_yungi`.`types_contenus` (`id_types_contenus` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_contenus_utilisateurs1`
    FOREIGN KEY (`utilisateurs_id_utilisateur` )
    REFERENCES `site_perso_yungi`.`utilisateurs` (`id_utilisateur` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_contenus_langues1`
    FOREIGN KEY (`langues_id_langue` )
    REFERENCES `site_perso_yungi`.`langues` (`id_langue` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB
AUTO_INCREMENT = 8
DEFAULT CHARACTER SET = utf8
COLLATE = utf8_general_ci
COMMENT = 'le champ contenu -> recevra un tableau de type JSON avec le contenu récupérer';

CREATE UNIQUE INDEX `titre_UNIQUE` ON `site_perso_yungi`.`contenus` (`titre` ASC) ;

CREATE INDEX `fk_pages_website1` ON `site_perso_yungi`.`contenus` (`websites_id_website` ASC) ;

CREATE INDEX `fk_contenus_categories1` ON `site_perso_yungi`.`contenus` (`categories_id_categorie` ASC) ;

CREATE INDEX `fk_contenus_types_contenus1` ON `site_perso_yungi`.`contenus` (`types_contenus_id_types_contenus` ASC) ;

CREATE INDEX `fk_contenus_utilisateurs1` ON `site_perso_yungi`.`contenus` (`utilisateurs_id_utilisateur` ASC) ;

CREATE INDEX `fk_contenus_langues1` ON `site_perso_yungi`.`contenus` (`langues_id_langue` ASC) ;


-- -----------------------------------------------------
-- Table `site_perso_yungi`.`sous_categoires`
-- -----------------------------------------------------
CREATE  TABLE IF NOT EXISTS `site_perso_yungi`.`sous_categoires` (
  `id_sous_categorie` INT(11) NOT NULL AUTO_INCREMENT ,
  `nom_sous_categorie` VARCHAR(200) NOT NULL ,
  `principal` ENUM('0', '1') NOT NULL DEFAULT '0' ,
  `actif` ENUM('0', '1') NOT NULL DEFAULT '1' ,
  `position` INT(3) NOT NULL DEFAULT 1 ,
  `categories_id_categorie` INT NOT NULL ,
  `langues_id_langue` INT(11) NOT NULL ,
  PRIMARY KEY (`id_sous_categorie`) ,
  CONSTRAINT `fk_sous_categoires_categories1`
    FOREIGN KEY (`categories_id_categorie` )
    REFERENCES `site_perso_yungi`.`categories` (`id_categorie` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_sous_categoires_langues1`
    FOREIGN KEY (`langues_id_langue` )
    REFERENCES `site_perso_yungi`.`langues` (`id_langue` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8
COLLATE = utf8_general_ci;

CREATE INDEX `fk_sous_categoires_categories1` ON `site_perso_yungi`.`sous_categoires` (`categories_id_categorie` ASC) ;

CREATE INDEX `fk_sous_categoires_langues1` ON `site_perso_yungi`.`sous_categoires` (`langues_id_langue` ASC) ;


-- -----------------------------------------------------
-- Table `site_perso_yungi`.`types_fichiers`
-- -----------------------------------------------------
CREATE  TABLE IF NOT EXISTS `site_perso_yungi`.`types_fichiers` (
  `id_type_fichier` INT(11) NOT NULL AUTO_INCREMENT ,
  `nom_type_fichier` VARCHAR(100) NOT NULL ,
  `actif` ENUM('0','1') NOT NULL ,
  PRIMARY KEY (`id_type_fichier`) )
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8
COLLATE = utf8_general_ci;


-- -----------------------------------------------------
-- Table `site_perso_yungi`.`fichiers`
-- -----------------------------------------------------
CREATE  TABLE IF NOT EXISTS `site_perso_yungi`.`fichiers` (
  `id_fichiers` INT(11) NOT NULL AUTO_INCREMENT ,
  `nom_fichier` VARCHAR(255) NOT NULL ,
  `date_ajout` INT NOT NULL ,
  `date_modification` INT NOT NULL ,
  `position` INT(2) NOT NULL DEFAULT 01 ,
  `actif` ENUM('0', '1') NOT NULL DEFAULT '1' ,
  `types_fichiers_id_type_fichier` INT NOT NULL ,
  `contenus_id_contenu` INT(11) NOT NULL ,
  `langues_id_langue` INT(11) NOT NULL ,
  PRIMARY KEY (`id_fichiers`) ,
  CONSTRAINT `fk_fichiers_types_fichiers1`
    FOREIGN KEY (`types_fichiers_id_type_fichier` )
    REFERENCES `site_perso_yungi`.`types_fichiers` (`id_type_fichier` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_fichiers_contenus1`
    FOREIGN KEY (`contenus_id_contenu` )
    REFERENCES `site_perso_yungi`.`contenus` (`id_contenu` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_fichiers_langues1`
    FOREIGN KEY (`langues_id_langue` )
    REFERENCES `site_perso_yungi`.`langues` (`id_langue` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8
COLLATE = utf8_general_ci;

CREATE INDEX `fk_fichiers_types_fichiers1` ON `site_perso_yungi`.`fichiers` (`types_fichiers_id_type_fichier` ASC) ;

CREATE INDEX `fk_fichiers_contenus1` ON `site_perso_yungi`.`fichiers` (`contenus_id_contenu` ASC) ;

CREATE INDEX `fk_fichiers_langues1` ON `site_perso_yungi`.`fichiers` (`langues_id_langue` ASC) ;


-- -----------------------------------------------------
-- Table `site_perso_yungi`.`labels`
-- -----------------------------------------------------
CREATE  TABLE IF NOT EXISTS `site_perso_yungi`.`labels` (
  `id_label` INT(11) NOT NULL AUTO_INCREMENT ,
  `nom_label` VARCHAR(255) NOT NULL ,
  `class` VARCHAR(255) NULL DEFAULT '' ,
  `langues_id_langue` INT(11) NOT NULL ,
  PRIMARY KEY (`id_label`) ,
  CONSTRAINT `fk_labels_langues1`
    FOREIGN KEY (`langues_id_langue` )
    REFERENCES `site_perso_yungi`.`langues` (`id_langue` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8
COLLATE = utf8_general_ci;

CREATE INDEX `fk_labels_langues1` ON `site_perso_yungi`.`labels` (`langues_id_langue` ASC) ;


-- -----------------------------------------------------
-- Table `site_perso_yungi`.`fields`
-- -----------------------------------------------------
CREATE  TABLE IF NOT EXISTS `site_perso_yungi`.`fields` (
  `id_field` INT(11) NOT NULL AUTO_INCREMENT ,
  `balise_field` VARCHAR(45) NOT NULL ,
  `type_field` VARCHAR(45) NOT NULL ,
  `html_id_field` VARCHAR(255) NOT NULL ,
  `nom_field` VARCHAR(200) NOT NULL ,
  `class_field` VARCHAR(255) NULL DEFAULT '' ,
  `valeur_defaut` LONGTEXT NULL ,
  `position` INT(2) NOT NULL DEFAULT 1 ,
  `actif` ENUM('0','1') NOT NULL DEFAULT '1' ,
  `labels_id_label` INT(11) NOT NULL ,
  `type_valeur_field` VARCHAR(45) NULL ,
  PRIMARY KEY (`id_field`) ,
  CONSTRAINT `fk_fields_labels1`
    FOREIGN KEY (`labels_id_label` )
    REFERENCES `site_perso_yungi`.`labels` (`id_label` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8
COLLATE = utf8_general_ci;

CREATE INDEX `fk_fields_labels1` ON `site_perso_yungi`.`fields` (`labels_id_label` ASC) ;


-- -----------------------------------------------------
-- Table `site_perso_yungi`.`fields_has_types_contenus`
-- -----------------------------------------------------
CREATE  TABLE IF NOT EXISTS `site_perso_yungi`.`fields_has_types_contenus` (
  `fields_id_field` INT(11) NOT NULL ,
  `types_contenus_id_types_contenus` INT NOT NULL ,
  PRIMARY KEY (`fields_id_field`, `types_contenus_id_types_contenus`) ,
  CONSTRAINT `fk_fields_has_types_contenus_fields1`
    FOREIGN KEY (`fields_id_field` )
    REFERENCES `site_perso_yungi`.`fields` (`id_field` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_fields_has_types_contenus_types_contenus1`
    FOREIGN KEY (`types_contenus_id_types_contenus` )
    REFERENCES `site_perso_yungi`.`types_contenus` (`id_types_contenus` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8
COLLATE = utf8_general_ci;

CREATE INDEX `fk_fields_has_types_contenus_types_contenus1` ON `site_perso_yungi`.`fields_has_types_contenus` (`types_contenus_id_types_contenus` ASC) ;

CREATE INDEX `fk_fields_has_types_contenus_fields1` ON `site_perso_yungi`.`fields_has_types_contenus` (`fields_id_field` ASC) ;


-- -----------------------------------------------------
-- Table `site_perso_yungi`.`contacts`
-- -----------------------------------------------------
CREATE  TABLE IF NOT EXISTS `site_perso_yungi`.`contacts` (
  `id_contact` INT NOT NULL AUTO_INCREMENT ,
  `type_contact` ENUM('tel', 'fax', 'email', 'mobile') NOT NULL DEFAULT 'email' ,
  `valeur_contact` VARCHAR(255) NOT NULL ,
  `position_contact` INT(3) NOT NULL DEFAULT 1 ,
  `actif` ENUM('0', '1') NOT NULL DEFAULT '1' ,
  `utilisateurs_id_utilisateur` INT(11) NOT NULL ,
  PRIMARY KEY (`id_contact`) ,
  CONSTRAINT `fk_contacts_utilisateurs1`
    FOREIGN KEY (`utilisateurs_id_utilisateur` )
    REFERENCES `site_perso_yungi`.`utilisateurs` (`id_utilisateur` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8
COLLATE = utf8_general_ci;

CREATE INDEX `fk_contacts_utilisateurs1` ON `site_perso_yungi`.`contacts` (`utilisateurs_id_utilisateur` ASC) ;


-- -----------------------------------------------------
-- Table `site_perso_yungi`.`pays`
-- -----------------------------------------------------
CREATE  TABLE IF NOT EXISTS `site_perso_yungi`.`pays` (
  `id_pays` INT NOT NULL AUTO_INCREMENT ,
  `nom_pays` VARCHAR(100) NOT NULL ,
  PRIMARY KEY (`id_pays`) )
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8
COLLATE = utf8_general_ci;


-- -----------------------------------------------------
-- Table `site_perso_yungi`.`villes`
-- -----------------------------------------------------
CREATE  TABLE IF NOT EXISTS `site_perso_yungi`.`villes` (
  `id_ville` INT NOT NULL AUTO_INCREMENT ,
  `npa_ville` INT(4) NOT NULL ,
  `nom_ville` VARCHAR(45) NOT NULL ,
  `pays_id_pays` INT NOT NULL ,
  PRIMARY KEY (`id_ville`) ,
  CONSTRAINT `fk_villes_pays1`
    FOREIGN KEY (`pays_id_pays` )
    REFERENCES `site_perso_yungi`.`pays` (`id_pays` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8
COLLATE = utf8_general_ci;

CREATE INDEX `fk_villes_pays1` ON `site_perso_yungi`.`villes` (`pays_id_pays` ASC) ;


-- -----------------------------------------------------
-- Table `site_perso_yungi`.`adresses`
-- -----------------------------------------------------
CREATE  TABLE IF NOT EXISTS `site_perso_yungi`.`adresses` (
  `id_adresse` INT NOT NULL AUTO_INCREMENT ,
  `rue_adresse` VARCHAR(255) NOT NULL ,
  `rue_adresse_2` VARCHAR(255) NOT NULL ,
  `utilisateurs_id_utilisateur` INT(11) NOT NULL ,
  `villes_id_ville` INT NOT NULL ,
  PRIMARY KEY (`id_adresse`) ,
  CONSTRAINT `fk_adresses_utilisateurs1`
    FOREIGN KEY (`utilisateurs_id_utilisateur` )
    REFERENCES `site_perso_yungi`.`utilisateurs` (`id_utilisateur` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_adresses_villes1`
    FOREIGN KEY (`villes_id_ville` )
    REFERENCES `site_perso_yungi`.`villes` (`id_ville` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8
COLLATE = utf8_general_ci;

CREATE INDEX `fk_adresses_utilisateurs1` ON `site_perso_yungi`.`adresses` (`utilisateurs_id_utilisateur` ASC) ;

CREATE INDEX `fk_adresses_villes1` ON `site_perso_yungi`.`adresses` (`villes_id_ville` ASC) ;


-- -----------------------------------------------------
-- Table `site_perso_yungi`.`groupes`
-- -----------------------------------------------------
CREATE  TABLE IF NOT EXISTS `site_perso_yungi`.`groupes` (
  `id_groupe` INT NOT NULL AUTO_INCREMENT ,
  `nom_groupe` VARCHAR(45) NOT NULL ,
  `droit` INT NOT NULL ,
  PRIMARY KEY (`id_groupe`) )
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8
COLLATE = utf8_general_ci;


-- -----------------------------------------------------
-- Table `site_perso_yungi`.`utilisateurs_has_groupes`
-- -----------------------------------------------------
CREATE  TABLE IF NOT EXISTS `site_perso_yungi`.`utilisateurs_has_groupes` (
  `utilisateurs_id_utilisateur` INT(11) NOT NULL ,
  `groupes_id_groupe` INT NOT NULL ,
  PRIMARY KEY (`utilisateurs_id_utilisateur`, `groupes_id_groupe`) ,
  CONSTRAINT `fk_utilisateurs_has_groupes_utilisateurs1`
    FOREIGN KEY (`utilisateurs_id_utilisateur` )
    REFERENCES `site_perso_yungi`.`utilisateurs` (`id_utilisateur` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_utilisateurs_has_groupes_groupes1`
    FOREIGN KEY (`groupes_id_groupe` )
    REFERENCES `site_perso_yungi`.`groupes` (`id_groupe` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8
COLLATE = utf8_general_ci;

CREATE INDEX `fk_utilisateurs_has_groupes_groupes1` ON `site_perso_yungi`.`utilisateurs_has_groupes` (`groupes_id_groupe` ASC) ;

CREATE INDEX `fk_utilisateurs_has_groupes_utilisateurs1` ON `site_perso_yungi`.`utilisateurs_has_groupes` (`utilisateurs_id_utilisateur` ASC) ;



SET SQL_MODE=@OLD_SQL_MODE;
SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS;
SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS;

-- -----------------------------------------------------
-- Data for table `site_perso_yungi`.`websites`
-- -----------------------------------------------------
SET AUTOCOMMIT=0;
USE `site_perso_yungi`;
INSERT INTO `site_perso_yungi`.`websites` (`id_website`, `nom`, `adresse_1`, `adresse_2`, `npa`, `ville`, `tel`, `mobile`, `email`) VALUES (NULL, 'Yungi_design', 'Rue Etraz 2', NULL, 1003, 'Lausanne', '+41 78 769 00 80', '+41 78 769 00 80', 'ygyongy@tradiluxe.com');

COMMIT;

-- -----------------------------------------------------
-- Data for table `site_perso_yungi`.`langues`
-- -----------------------------------------------------
SET AUTOCOMMIT=0;
USE `site_perso_yungi`;
INSERT INTO `site_perso_yungi`.`langues` (`id_langue`, `code_langue`, `nom_langue`, `position`, `actif`) VALUES (NULL, 'fr', 'français', 1, '1');

COMMIT;

-- -----------------------------------------------------
-- Data for table `site_perso_yungi`.`categories`
-- -----------------------------------------------------
SET AUTOCOMMIT=0;
USE `site_perso_yungi`;
INSERT INTO `site_perso_yungi`.`categories` (`id_categorie`, `nom_categorie`, `principal`, `actif`, `position`, `langues_id_langue`) VALUES (NULL, 'Accueil', '1', '1', 1, 1);
INSERT INTO `site_perso_yungi`.`categories` (`id_categorie`, `nom_categorie`, `principal`, `actif`, `position`, `langues_id_langue`) VALUES (NULL, 'Entreprise', '1', '1', 2, 1);
INSERT INTO `site_perso_yungi`.`categories` (`id_categorie`, `nom_categorie`, `principal`, `actif`, `position`, `langues_id_langue`) VALUES (NULL, 'Catalogue', '1', '1', 3, 1);

COMMIT;

-- -----------------------------------------------------
-- Data for table `site_perso_yungi`.`types_contenus`
-- -----------------------------------------------------
SET AUTOCOMMIT=0;
USE `site_perso_yungi`;
INSERT INTO `site_perso_yungi`.`types_contenus` (`id_types_contenus`, `nom_type_contenu`, `actif`) VALUES (NULL, 'pages', '1');

COMMIT;

-- -----------------------------------------------------
-- Data for table `site_perso_yungi`.`utilisateurs`
-- -----------------------------------------------------
SET AUTOCOMMIT=0;
USE `site_perso_yungi`;
INSERT INTO `site_perso_yungi`.`utilisateurs` (`id_utilisateur`, `nom_utilisateur`, `prenom_utilisateur`, `login_utilisateur`, `pwd_utilisateur`, `langues_id_langue`) VALUES (NULL, 'Gyongy', 'Yann', 'ygyongy', 'test', 1);

COMMIT;

-- -----------------------------------------------------
-- Data for table `site_perso_yungi`.`contenus`
-- -----------------------------------------------------
SET AUTOCOMMIT=0;
USE `site_perso_yungi`;
INSERT INTO `site_perso_yungi`.`contenus` (`id_contenu`, `titre`, `sous_titre`, `contenu`, `position`, `actif`, `protege`, `websites_id_website`, `categories_id_categorie`, `types_contenus_id_types_contenus`, `utilisateurs_id_utilisateur`, `langues_id_langue`) VALUES (NULL, 'Accueil', 'Bienvenue sur la nouvelle version du site Tradiluxe. J\'espère que vous aurez du plaisir à parcourir nos nouvelles pages. Surtout n\'hésitez pas à nous envoyer vos commentaires', '{\"titre\":\"Accueil\",\"contenu\":\"<div class=\\\"fleft\\\" id=\\\"cell_1\\\" style=\\\"width:173.5px; margin-right: 2px;\\\">1<\\/div><div class=\\\"fleft\\\" id=\\\"cell_2\\\" style=\\\"width:173.5px; margin-right: 2px;\\\">2<\\/div><div class=\\\"fleft\\\" id=\\\"cell_3\\\" style=\\\"width:173.5px; margin-right: 2px;\\\">3<\\/div><div class=\\\"fleft\\\" id=\\\"cell_4\\\" style=\\\"width:173.5px; margin-right: 2px;\\\">4<\\/div><div class=\'clear\'>&nbsp<\\/div><div class=\\\"fleft\\\" id=\\\"cell_5\\\" style=\\\"width:173.5px; margin-right: 2px;\\\">5<\\/div><div class=\\\"fleft\\\" id=\\\"cell_6\\\" style=\\\"width:173.5px; margin-right: 2px;\\\">6<\\/div><div class=\\\"fleft\\\" id=\\\"cell_7\\\" style=\\\"width:173.5px; margin-right: 2px;\\\">7<\\/div><div class=\\\"fleft\\\" id=\\\"cell_8\\\" style=\\\"width:173.5px; margin-right: 2px;\\\">8<\\/div><div class=\'clear\'>&nbsp<\\/div><div class=\\\"fleft\\\" id=\\\"cell_9\\\" style=\\\"width:173.5px; margin-right: 2px;\\\">9<\\/div><div class=\\\"fleft\\\" id=\\\"cell_10\\\" style=\\\"width:173.5px; margin-right: 2px;\\\">10<\\/div><div class=\'clear\'>&nbsp<\\/div>\"}', 1, '1', '0', 1, 1, 1, 1, 1);

COMMIT;

-- -----------------------------------------------------
-- Data for table `site_perso_yungi`.`types_fichiers`
-- -----------------------------------------------------
SET AUTOCOMMIT=0;
USE `site_perso_yungi`;
INSERT INTO `site_perso_yungi`.`types_fichiers` (`id_type_fichier`, `nom_type_fichier`, `actif`) VALUES (1, 'image', NULL);
INSERT INTO `site_perso_yungi`.`types_fichiers` (`id_type_fichier`, `nom_type_fichier`, `actif`) VALUES (2, 'vidéos', NULL);
INSERT INTO `site_perso_yungi`.`types_fichiers` (`id_type_fichier`, `nom_type_fichier`, `actif`) VALUES (3, 'artwork', NULL);
INSERT INTO `site_perso_yungi`.`types_fichiers` (`id_type_fichier`, `nom_type_fichier`, `actif`) VALUES (4, 'document', NULL);
INSERT INTO `site_perso_yungi`.`types_fichiers` (`id_type_fichier`, `nom_type_fichier`, `actif`) VALUES (5, 'script', NULL);

COMMIT;

-- -----------------------------------------------------
-- Data for table `site_perso_yungi`.`labels`
-- -----------------------------------------------------
SET AUTOCOMMIT=0;
USE `site_perso_yungi`;
INSERT INTO `site_perso_yungi`.`labels` (`id_label`, `nom_label`, `class`, `langues_id_langue`) VALUES (NULL, 'Titre de la page', NULL, 1);

COMMIT;

-- -----------------------------------------------------
-- Data for table `site_perso_yungi`.`fields`
-- -----------------------------------------------------
SET AUTOCOMMIT=0;
USE `site_perso_yungi`;
INSERT INTO `site_perso_yungi`.`fields` (`id_field`, `balise_field`, `type_field`, `html_id_field`, `nom_field`, `class_field`, `valeur_defaut`, `position`, `actif`, `labels_id_label`, `type_valeur_field`) VALUES (NULL, 'input', 'text', 'titre_page', 'titre_page', NULL, 'entrez le titre', 1, '1', 1, 'string');

COMMIT;

-- -----------------------------------------------------
-- Data for table `site_perso_yungi`.`groupes`
-- -----------------------------------------------------
SET AUTOCOMMIT=0;
USE `site_perso_yungi`;
INSERT INTO `site_perso_yungi`.`groupes` (`id_groupe`, `nom_groupe`, `droit`) VALUES (NULL, 'administration', 1111);
INSERT INTO `site_perso_yungi`.`groupes` (`id_groupe`, `nom_groupe`, `droit`) VALUES (NULL, 'editeur', 111);
INSERT INTO `site_perso_yungi`.`groupes` (`id_groupe`, `nom_groupe`, `droit`) VALUES (NULL, 'user_pro', 11);
INSERT INTO `site_perso_yungi`.`groupes` (`id_groupe`, `nom_groupe`, `droit`) VALUES (NULL, 'user', 1);
INSERT INTO `site_perso_yungi`.`groupes` (`id_groupe`, `nom_groupe`, `droit`) VALUES (NULL, 'unregister', 0);

COMMIT;

-- -----------------------------------------------------
-- Data for table `site_perso_yungi`.`utilisateurs_has_groupes`
-- -----------------------------------------------------
SET AUTOCOMMIT=0;
USE `site_perso_yungi`;
INSERT INTO `site_perso_yungi`.`utilisateurs_has_groupes` (`utilisateurs_id_utilisateur`, `groupes_id_groupe`) VALUES (1, 1);
INSERT INTO `site_perso_yungi`.`utilisateurs_has_groupes` (`utilisateurs_id_utilisateur`, `groupes_id_groupe`) VALUES (1, 2);
INSERT INTO `site_perso_yungi`.`utilisateurs_has_groupes` (`utilisateurs_id_utilisateur`, `groupes_id_groupe`) VALUES (1, 3);

COMMIT;
