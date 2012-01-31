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

CREATE UNIQUE INDEX `code_langue_UNIQUE` ON `site_perso_yungi`.`langues` (`code_langue` ASC) ;

CREATE UNIQUE INDEX `nom_langue_UNIQUE` ON `site_perso_yungi`.`langues` (`nom_langue` ASC) ;


-- -----------------------------------------------------
-- Table `site_perso_yungi`.`categories`
-- -----------------------------------------------------
CREATE  TABLE IF NOT EXISTS `site_perso_yungi`.`categories` (
  `id_categorie` INT(11) NOT NULL AUTO_INCREMENT ,
  `nom_categorie` VARCHAR(100) NOT NULL ,
  `principal` ENUM('0', '1') NOT NULL DEFAULT '0' ,
  `actif` ENUM('O', '1') NOT NULL DEFAULT '1' ,
  `position` INT(3) NOT NULL DEFAULT 1 ,
  `droit_categorie` CHAR(4) NULL DEFAULT NULL ,
  `langues_id_langue` INT(11) NOT NULL ,
  PRIMARY KEY (`id_categorie`, `langues_id_langue`) ,
  CONSTRAINT `fk_categories_langues`
    FOREIGN KEY (`langues_id_langue` )
    REFERENCES `site_perso_yungi`.`langues` (`id_langue` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8
COLLATE = utf8_general_ci;

CREATE INDEX `fk_categories_langues` ON `site_perso_yungi`.`categories` (`langues_id_langue` ASC) ;

CREATE UNIQUE INDEX `nom_categorie_and_langues_id_langue_UNIQUE` ON `site_perso_yungi`.`categories` (`nom_categorie` ASC, `langues_id_langue` ASC) ;


-- -----------------------------------------------------
-- Table `site_perso_yungi`.`types_contenus`
-- -----------------------------------------------------
CREATE  TABLE IF NOT EXISTS `site_perso_yungi`.`types_contenus` (
  `id_type_contenu` INT NOT NULL AUTO_INCREMENT ,
  `nom_type_contenu` VARCHAR(45) NOT NULL ,
  `actif` ENUM('0','1') NOT NULL DEFAULT '1' ,
  PRIMARY KEY (`id_type_contenu`) )
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8
COLLATE = utf8_general_ci;


-- -----------------------------------------------------
-- Table `site_perso_yungi`.`groupes`
-- -----------------------------------------------------
CREATE  TABLE IF NOT EXISTS `site_perso_yungi`.`groupes` (
  `id_groupe` INT NOT NULL AUTO_INCREMENT ,
  `nom_groupe` VARCHAR(45) NOT NULL ,
  `droit` CHAR(4) NOT NULL ,
  PRIMARY KEY (`id_groupe`) )
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8
COLLATE = utf8_general_ci;

CREATE UNIQUE INDEX `nom_groupe_UNIQUE` ON `site_perso_yungi`.`groupes` (`nom_groupe` ASC, `droit` ASC) ;


-- -----------------------------------------------------
-- Table `site_perso_yungi`.`utilisateurs`
-- -----------------------------------------------------
CREATE  TABLE IF NOT EXISTS `site_perso_yungi`.`utilisateurs` (
  `id_utilisateur` INT(11) NOT NULL AUTO_INCREMENT ,
  `nom_utilisateur` VARCHAR(100) NOT NULL ,
  `prenom_utilisateur` VARCHAR(100) NOT NULL ,
  `login_utilisateur` VARCHAR(100) NOT NULL ,
  `pwd_utilisateur` VARCHAR(255) NOT NULL ,
  `inscription_utilisateur` TIMESTAMP NOT NULL ,
  `langues_id_langue` INT(11) NOT NULL ,
  `groupes_id_groupe` INT NOT NULL ,
  PRIMARY KEY (`id_utilisateur`) ,
  CONSTRAINT `fk_utilisateurs_langues`
    FOREIGN KEY (`langues_id_langue` )
    REFERENCES `site_perso_yungi`.`langues` (`id_langue` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_utilisateurs_groupes`
    FOREIGN KEY (`groupes_id_groupe` )
    REFERENCES `site_perso_yungi`.`groupes` (`id_groupe` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8
COLLATE = utf8_general_ci;

CREATE INDEX `fk_utilisateurs_langues` ON `site_perso_yungi`.`utilisateurs` (`langues_id_langue` ASC) ;

CREATE INDEX `fk_utilisateurs_groupes` ON `site_perso_yungi`.`utilisateurs` (`groupes_id_groupe` ASC) ;

CREATE UNIQUE INDEX `login_utilisateur_UNIQUE` ON `site_perso_yungi`.`utilisateurs` (`login_utilisateur` ASC) ;


-- -----------------------------------------------------
-- Table `site_perso_yungi`.`sous_categories`
-- -----------------------------------------------------
CREATE  TABLE IF NOT EXISTS `site_perso_yungi`.`sous_categories` (
  `id_sous_categorie` INT(11) NOT NULL AUTO_INCREMENT ,
  `nom_sous_categorie` VARCHAR(200) NOT NULL ,
  `principal` ENUM('0', '1') NOT NULL DEFAULT '0' ,
  `actif` ENUM('0', '1') NOT NULL DEFAULT '1' ,
  `position` INT(3) NOT NULL DEFAULT 1 ,
  `droit_sous_categorie` CHAR(4) NULL DEFAULT NULL ,
  `categories_id_categorie` INT NOT NULL ,
  `langues_id_langue` INT(11) NOT NULL ,
  PRIMARY KEY (`id_sous_categorie`, `langues_id_langue`) ,
  CONSTRAINT `fk_sous_categoires_categories`
    FOREIGN KEY (`categories_id_categorie` )
    REFERENCES `site_perso_yungi`.`categories` (`id_categorie` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_sous_categoires_langues`
    FOREIGN KEY (`langues_id_langue` )
    REFERENCES `site_perso_yungi`.`langues` (`id_langue` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8
COLLATE = utf8_general_ci;

CREATE INDEX `fk_sous_categoires_categories` ON `site_perso_yungi`.`sous_categories` (`categories_id_categorie` ASC) ;

CREATE INDEX `fk_sous_categoires_langues` ON `site_perso_yungi`.`sous_categories` (`langues_id_langue` ASC) ;

CREATE UNIQUE INDEX `nom_sous_categorie_UNIQUE` ON `site_perso_yungi`.`sous_categories` (`nom_sous_categorie` ASC, `langues_id_langue` ASC) ;


-- -----------------------------------------------------
-- Table `site_perso_yungi`.`contenus`
-- -----------------------------------------------------
CREATE  TABLE IF NOT EXISTS `site_perso_yungi`.`contenus` (
  `id_contenu` INT(11) NOT NULL AUTO_INCREMENT ,
  `titre_html` VARCHAR(100) NOT NULL ,
  `titre` VARCHAR(100) NOT NULL ,
  `sous_titre` VARCHAR(255) NOT NULL ,
  `contenu` LONGTEXT NOT NULL ,
  `position` INT(11) NOT NULL ,
  `actif` ENUM('0', '1') NOT NULL DEFAULT '1' ,
  `protege` ENUM('U','UE','UEA') NULL DEFAULT NULL ,
  `websites_id_website` INT(11) NOT NULL ,
  `categories_id_categorie` INT NOT NULL ,
  `sous_categories_id_sous_categorie` INT(11) NULL ,
  `types_contenus_id_types_contenus` INT NOT NULL ,
  `utilisateurs_id_utilisateur` INT(11) NOT NULL ,
  `langues_id_langue` INT(11) NOT NULL ,
  PRIMARY KEY (`id_contenu`, `langues_id_langue`) ,
  CONSTRAINT `fk_pages_website`
    FOREIGN KEY (`websites_id_website` )
    REFERENCES `site_perso_yungi`.`websites` (`id_website` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_contenus_categories`
    FOREIGN KEY (`categories_id_categorie` )
    REFERENCES `site_perso_yungi`.`categories` (`id_categorie` )
    ON DELETE CASCADE
    ON UPDATE NO ACTION,
  CONSTRAINT `k_contenus_types_contenus`
    FOREIGN KEY (`types_contenus_id_types_contenus` )
    REFERENCES `site_perso_yungi`.`types_contenus` (`id_type_contenu` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_contenus_utilisateurs`
    FOREIGN KEY (`utilisateurs_id_utilisateur` )
    REFERENCES `site_perso_yungi`.`utilisateurs` (`id_utilisateur` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_contenus_langues`
    FOREIGN KEY (`langues_id_langue` )
    REFERENCES `site_perso_yungi`.`langues` (`id_langue` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_contenus_sous_categoires`
    FOREIGN KEY (`sous_categories_id_sous_categorie` )
    REFERENCES `site_perso_yungi`.`sous_categories` (`id_sous_categorie` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB
AUTO_INCREMENT = 8
DEFAULT CHARACTER SET = utf8
COLLATE = utf8_general_ci
COMMENT = 'le champ contenu JSON avec le contenu récupérer' ;

CREATE UNIQUE INDEX `titre_UNIQUE` ON `site_perso_yungi`.`contenus` (`titre` ASC) ;

CREATE INDEX `fk_pages_website` ON `site_perso_yungi`.`contenus` (`websites_id_website` ASC) ;

CREATE INDEX `fk_contenus_categories` ON `site_perso_yungi`.`contenus` (`categories_id_categorie` ASC) ;

CREATE INDEX `fk_contenus_types_contenus` ON `site_perso_yungi`.`contenus` (`types_contenus_id_types_contenus` ASC) ;

CREATE INDEX `fk_contenus_utilisateurs` ON `site_perso_yungi`.`contenus` (`utilisateurs_id_utilisateur` ASC) ;

CREATE INDEX `fk_contenus_langues` ON `site_perso_yungi`.`contenus` (`langues_id_langue` ASC) ;

CREATE INDEX `fk_contenus_sous_categoires` ON `site_perso_yungi`.`contenus` (`sous_categories_id_sous_categorie` ASC) ;


-- -----------------------------------------------------
-- Table `site_perso_yungi`.`types_fichiers`
-- -----------------------------------------------------
CREATE  TABLE IF NOT EXISTS `site_perso_yungi`.`types_fichiers` (
  `id_type_fichier` INT(11) NOT NULL AUTO_INCREMENT ,
  `nom_type_fichier` VARCHAR(100) NOT NULL ,
  `actif` ENUM('0','1') NOT NULL DEFAULT '1' ,
  PRIMARY KEY (`id_type_fichier`) )
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8
COLLATE = utf8_general_ci;

CREATE UNIQUE INDEX `nom_type_fichier_UNIQUE` ON `site_perso_yungi`.`types_fichiers` (`nom_type_fichier` ASC) ;


-- -----------------------------------------------------
-- Table `site_perso_yungi`.`fichiers`
-- -----------------------------------------------------
CREATE  TABLE IF NOT EXISTS `site_perso_yungi`.`fichiers` (
  `id_fichiers` INT(11) NOT NULL AUTO_INCREMENT ,
  `nom_fichier` VARCHAR(255) NOT NULL ,
  `date_ajout` INT NOT NULL ,
  `date_modification` INT NOT NULL ,
  `position` INT(2) NOT NULL DEFAULT 1 ,
  `actif` ENUM('0', '1') NOT NULL DEFAULT '1' ,
  `types_fichiers_id_type_fichier` INT NOT NULL ,
  `contenus_id_contenu` INT(11) NOT NULL ,
  `langues_id_langue` INT(11) NOT NULL ,
  PRIMARY KEY (`id_fichiers`, `langues_id_langue`) ,
  CONSTRAINT `fk_fichiers_types_fichiers`
    FOREIGN KEY (`types_fichiers_id_type_fichier` )
    REFERENCES `site_perso_yungi`.`types_fichiers` (`id_type_fichier` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_fichiers_contenus`
    FOREIGN KEY (`contenus_id_contenu` )
    REFERENCES `site_perso_yungi`.`contenus` (`id_contenu` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_fichiers_langues`
    FOREIGN KEY (`langues_id_langue` )
    REFERENCES `site_perso_yungi`.`langues` (`id_langue` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8
COLLATE = utf8_general_ci;

CREATE INDEX `fk_fichiers_types_fichiers` ON `site_perso_yungi`.`fichiers` (`types_fichiers_id_type_fichier` ASC) ;

CREATE INDEX `fk_fichiers_contenus` ON `site_perso_yungi`.`fichiers` (`contenus_id_contenu` ASC) ;

CREATE INDEX `fk_fichiers_langues` ON `site_perso_yungi`.`fichiers` (`langues_id_langue` ASC) ;

CREATE UNIQUE INDEX `nom_fichier_and_date_ajout_UNIQUE` ON `site_perso_yungi`.`fichiers` (`date_ajout` ASC, `nom_fichier` ASC) ;


-- -----------------------------------------------------
-- Table `site_perso_yungi`.`labels`
-- -----------------------------------------------------
CREATE  TABLE IF NOT EXISTS `site_perso_yungi`.`labels` (
  `id_label` INT(11) NOT NULL AUTO_INCREMENT ,
  `nom_label` VARCHAR(255) NOT NULL ,
  `class` VARCHAR(255) NULL DEFAULT '' ,
  `langues_id_langue` INT(11) NOT NULL ,
  PRIMARY KEY (`id_label`, `langues_id_langue`) ,
  CONSTRAINT `fk_labels_langues`
    FOREIGN KEY (`langues_id_langue` )
    REFERENCES `site_perso_yungi`.`langues` (`id_langue` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8
COLLATE = utf8_general_ci;

CREATE INDEX `fk_labels_langues` ON `site_perso_yungi`.`labels` (`langues_id_langue` ASC) ;


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
  `value_field` LONGTEXT NULL ,
  `position` INT(2) NOT NULL DEFAULT 1 ,
  `actif` ENUM('0','1') NOT NULL DEFAULT '1' ,
  `labels_id_label` INT(11) NOT NULL ,
  PRIMARY KEY (`id_field`) ,
  CONSTRAINT `fk_fields_labels`
    FOREIGN KEY (`labels_id_label` )
    REFERENCES `site_perso_yungi`.`labels` (`id_label` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8
COLLATE = utf8_general_ci;

CREATE INDEX `fk_fields_labels` ON `site_perso_yungi`.`fields` (`labels_id_label` ASC) ;


-- -----------------------------------------------------
-- Table `site_perso_yungi`.`fields_has_types_contenus`
-- -----------------------------------------------------
CREATE  TABLE IF NOT EXISTS `site_perso_yungi`.`fields_has_types_contenus` (
  `fields_id_field` INT(11) NOT NULL ,
  `types_contenus_id_types_contenus` INT NOT NULL ,
  PRIMARY KEY (`fields_id_field`, `types_contenus_id_types_contenus`) ,
  CONSTRAINT `fk_fields_has_types_contenus_fields`
    FOREIGN KEY (`fields_id_field` )
    REFERENCES `site_perso_yungi`.`fields` (`id_field` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_fields_has_types_contenus_types_contenus`
    FOREIGN KEY (`types_contenus_id_types_contenus` )
    REFERENCES `site_perso_yungi`.`types_contenus` (`id_type_contenu` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8
COLLATE = utf8_general_ci;

CREATE INDEX `fk_fields_has_types_contenus_types_contenus` ON `site_perso_yungi`.`fields_has_types_contenus` (`types_contenus_id_types_contenus` ASC) ;

CREATE INDEX `fk_fields_has_types_contenus_fields` ON `site_perso_yungi`.`fields_has_types_contenus` (`fields_id_field` ASC) ;


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
  CONSTRAINT `fk_contacts_utilisateurs`
    FOREIGN KEY (`utilisateurs_id_utilisateur` )
    REFERENCES `site_perso_yungi`.`utilisateurs` (`id_utilisateur` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8
COLLATE = utf8_general_ci;

CREATE INDEX `fk_contacts_utilisateurs` ON `site_perso_yungi`.`contacts` (`utilisateurs_id_utilisateur` ASC) ;

CREATE UNIQUE INDEX `valeur_contact_UNIQUE` ON `site_perso_yungi`.`contacts` (`valeur_contact` ASC, `type_contact` ASC) ;


-- -----------------------------------------------------
-- Table `site_perso_yungi`.`pays`
-- -----------------------------------------------------
CREATE  TABLE IF NOT EXISTS `site_perso_yungi`.`pays` (
  `id_pays` INT NOT NULL AUTO_INCREMENT ,
  `nom_pays` VARCHAR(100) NOT NULL ,
  `code_pays` VARCHAR(2) NOT NULL ,
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
  `nom_ville` VARCHAR(200) NOT NULL ,
  `code_canton` VARCHAR(2) NOT NULL ,
  `pays_id_pays` INT NOT NULL ,
  PRIMARY KEY (`id_ville`) ,
  CONSTRAINT `fk_villes_pays`
    FOREIGN KEY (`pays_id_pays` )
    REFERENCES `site_perso_yungi`.`pays` (`id_pays` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8
COLLATE = utf8_general_ci;

CREATE INDEX `fk_villes_pays` ON `site_perso_yungi`.`villes` (`pays_id_pays` ASC) ;


-- -----------------------------------------------------
-- Table `site_perso_yungi`.`categories_adresses`
-- -----------------------------------------------------
CREATE  TABLE IF NOT EXISTS `site_perso_yungi`.`categories_adresses` (
  `id_categorie_adresse` INT NOT NULL ,
  `nom_categorie_adresse` VARCHAR(200) NULL ,
  `langues_id_langue` INT(11) NOT NULL ,
  PRIMARY KEY (`id_categorie_adresse`, `langues_id_langue`) ,
  CONSTRAINT `fk_categories_adresses_langues`
    FOREIGN KEY (`langues_id_langue` )
    REFERENCES `site_perso_yungi`.`langues` (`id_langue` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8
COLLATE = utf8_general_ci;

CREATE INDEX `fk_categories_adresses_langues` ON `site_perso_yungi`.`categories_adresses` (`langues_id_langue` ASC) ;


-- -----------------------------------------------------
-- Table `site_perso_yungi`.`adresses`
-- -----------------------------------------------------
CREATE  TABLE IF NOT EXISTS `site_perso_yungi`.`adresses` (
  `id_adresse` INT NOT NULL AUTO_INCREMENT ,
  `rue_adresse` VARCHAR(255) NOT NULL ,
  `rue_adresse_2` VARCHAR(255) NOT NULL ,
  `utilisateurs_id_utilisateur` INT(11) NOT NULL ,
  `villes_id_ville` INT NOT NULL ,
  `categories_adresses_id_categorie_adresse` INT NOT NULL ,
  `categories_adresses_langues_id_langue` INT(11) NOT NULL ,
  PRIMARY KEY (`id_adresse`) ,
  CONSTRAINT `fk_adresses_utilisateurs`
    FOREIGN KEY (`utilisateurs_id_utilisateur` )
    REFERENCES `site_perso_yungi`.`utilisateurs` (`id_utilisateur` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_adresses_villes`
    FOREIGN KEY (`villes_id_ville` )
    REFERENCES `site_perso_yungi`.`villes` (`id_ville` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_adresses_categories_adresses`
    FOREIGN KEY (`categories_adresses_id_categorie_adresse` , `categories_adresses_langues_id_langue` )
    REFERENCES `site_perso_yungi`.`categories_adresses` (`id_categorie_adresse` , `langues_id_langue` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8
COLLATE = utf8_general_ci;

CREATE INDEX `fk_adresses_utilisateurs` ON `site_perso_yungi`.`adresses` (`utilisateurs_id_utilisateur` ASC) ;

CREATE INDEX `fk_adresses_villes` ON `site_perso_yungi`.`adresses` (`villes_id_ville` ASC) ;

CREATE INDEX `fk_adresses_categories_adresses` ON `site_perso_yungi`.`adresses` (`categories_adresses_id_categorie_adresse` ASC, `categories_adresses_langues_id_langue` ASC) ;

CREATE UNIQUE INDEX `utilisateurs_id_utilisateur_UNIQUE` ON `site_perso_yungi`.`adresses` (`utilisateurs_id_utilisateur` ASC, `rue_adresse` ASC, `categories_adresses_id_categorie_adresse` ASC, `categories_adresses_langues_id_langue` ASC) ;



SET SQL_MODE=@OLD_SQL_MODE;
SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS;
SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS;

-- -----------------------------------------------------
-- Data for table `site_perso_yungi`.`types_fichiers`
-- -----------------------------------------------------
START TRANSACTION;
USE `site_perso_yungi`;
INSERT INTO `site_perso_yungi`.`types_fichiers` (`id_type_fichier`, `nom_type_fichier`, `actif`) VALUES (1, 'image', '1');
INSERT INTO `site_perso_yungi`.`types_fichiers` (`id_type_fichier`, `nom_type_fichier`, `actif`) VALUES (2, 'vidéos', '1');
INSERT INTO `site_perso_yungi`.`types_fichiers` (`id_type_fichier`, `nom_type_fichier`, `actif`) VALUES (3, 'artwork', '1');
INSERT INTO `site_perso_yungi`.`types_fichiers` (`id_type_fichier`, `nom_type_fichier`, `actif`) VALUES (4, 'document', '1');
INSERT INTO `site_perso_yungi`.`types_fichiers` (`id_type_fichier`, `nom_type_fichier`, `actif`) VALUES (5, 'script', '1');

COMMIT;
