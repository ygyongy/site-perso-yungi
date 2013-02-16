-- MySQL dump 10.13  Distrib 5.5.16, for Win32 (x86)
--
-- Host: localhost    Database: site_perso_yungi
-- ------------------------------------------------------
-- Server version	5.5.16

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

--
-- Table structure for table `adresses`
--

DROP TABLE IF EXISTS `adresses`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `adresses` (
  `id_adresse` int(11) NOT NULL AUTO_INCREMENT,
  `rue_adresse` varchar(255) NOT NULL,
  `rue_adresse_2` varchar(255) NOT NULL,
  `utilisateurs_id_utilisateur` int(11) NOT NULL,
  `villes_id_ville` int(11) NOT NULL,
  `categories_adresses_id_categorie_adresse` int(11) NOT NULL,
  `categories_adresses_langues_id_langue` int(11) NOT NULL,
  PRIMARY KEY (`id_adresse`),
  UNIQUE KEY `utilisateurs_id_utilisateur_UNIQUE` (`utilisateurs_id_utilisateur`,`rue_adresse`,`categories_adresses_id_categorie_adresse`,`categories_adresses_langues_id_langue`),
  KEY `fk_adresses_utilisateurs` (`utilisateurs_id_utilisateur`),
  KEY `fk_adresses_villes` (`villes_id_ville`),
  KEY `fk_adresses_categories_adresses` (`categories_adresses_id_categorie_adresse`,`categories_adresses_langues_id_langue`),
  CONSTRAINT `fk_adresses_categories_adresses` FOREIGN KEY (`categories_adresses_id_categorie_adresse`, `categories_adresses_langues_id_langue`) REFERENCES `categories_adresses` (`id_categorie_adresse`, `langues_id_langue`) ON DELETE CASCADE ON UPDATE NO ACTION,
  CONSTRAINT `fk_adresses_utilisateurs` FOREIGN KEY (`utilisateurs_id_utilisateur`) REFERENCES `utilisateurs` (`id_utilisateur`) ON DELETE CASCADE ON UPDATE NO ACTION,
  CONSTRAINT `fk_adresses_villes` FOREIGN KEY (`villes_id_ville`) REFERENCES `villes` (`id_ville`) ON DELETE CASCADE ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `adresses`
--

LOCK TABLES `adresses` WRITE;
/*!40000 ALTER TABLE `adresses` DISABLE KEYS */;
/*!40000 ALTER TABLE `adresses` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `categories`
--

DROP TABLE IF EXISTS `categories`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `categories` (
  `id_categorie` int(11) NOT NULL AUTO_INCREMENT,
  `titre_html_categorie` varchar(255) NOT NULL DEFAULT 'Le titre de la page n''a pas été défini...',
  `nom_categorie` varchar(100) NOT NULL,
  `emplacement_categorie` enum('navigation','admin','langue','catalogue','hidden') NOT NULL DEFAULT 'navigation',
  `actif_categorie` enum('O','1') NOT NULL DEFAULT '1',
  `position_categorie` int(3) NOT NULL DEFAULT '1',
  `droit_categorie` char(4) DEFAULT NULL,
  `langues_id_langue` int(11) NOT NULL,
  `types_contenus_id_type_contenu` int(11) NOT NULL,
  `categorie_max_par_page` int(11) DEFAULT NULL,
  PRIMARY KEY (`id_categorie`,`langues_id_langue`),
  UNIQUE KEY `nom_categorie_and_langues_id_langue_UNIQUE` (`nom_categorie`,`langues_id_langue`),
  KEY `fk_categories_langues` (`langues_id_langue`),
  KEY `fk_categories_types_contenus1_idx` (`types_contenus_id_type_contenu`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `categories`
--

LOCK TABLES `categories` WRITE;
/*!40000 ALTER TABLE `categories` DISABLE KEYS */;
INSERT INTO `categories` VALUES (1,'Bienvenue sur notre page d\'accueil.','Accueil','navigation','1',1,NULL,1,5,NULL),(1,'Wilkommen aus unsere Hause Seite','Hause','navigation','1',1,NULL,2,1,NULL),(1,'Welcome on our new homepage','Home','navigation','1',1,NULL,3,1,NULL),(2,'\"Le titre de la page n\'a pas été défini...\"','Entreprise','navigation','1',2,NULL,1,1,NULL),(2,'\"Le titre de la page n\'a pas été défini...\"','Firma','navigation','1',2,NULL,2,1,NULL),(2,'\"Le titre de la page n\'a pas été défini...\"','Entreprise','navigation','1',2,NULL,3,1,NULL),(3,'\"Le titre de la page n\'a pas été défini...\"','Catalogue','navigation','1',3,NULL,1,1,NULL),(3,'\"Le titre de la page n\'a pas été défini...\"','Katalogue','navigation','1',3,NULL,2,1,NULL),(3,'\"Le titre de la page n\'a pas été défini...\"','Collection','navigation','1',3,NULL,3,1,NULL),(4,'\"Le titre de la page n\'a pas été défini...\"','Admin','admin','1',1,NULL,1,1,NULL),(5,'\"Le titre de la page n\'a pas été défini...\"','block_user','hidden','1',1,NULL,1,1,NULL);
/*!40000 ALTER TABLE `categories` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `categories_adresses`
--

DROP TABLE IF EXISTS `categories_adresses`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `categories_adresses` (
  `id_categorie_adresse` int(11) NOT NULL,
  `nom_categorie_adresse` varchar(200) DEFAULT NULL,
  `langues_id_langue` int(11) NOT NULL,
  PRIMARY KEY (`id_categorie_adresse`,`langues_id_langue`),
  KEY `fk_categories_adresses_langues` (`langues_id_langue`),
  CONSTRAINT `fk_categories_adresses_langues` FOREIGN KEY (`langues_id_langue`) REFERENCES `langues` (`id_langue`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `categories_adresses`
--

LOCK TABLES `categories_adresses` WRITE;
/*!40000 ALTER TABLE `categories_adresses` DISABLE KEYS */;
/*!40000 ALTER TABLE `categories_adresses` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `contacts`
--

DROP TABLE IF EXISTS `contacts`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `contacts` (
  `id_contact` int(11) NOT NULL AUTO_INCREMENT,
  `type_contact` enum('tel','fax','email','mobile') NOT NULL DEFAULT 'email',
  `valeur_contact` varchar(255) NOT NULL,
  `position_contact` int(3) NOT NULL DEFAULT '1',
  `actif_contact` enum('0','1') NOT NULL DEFAULT '1',
  `utilisateurs_id_utilisateur` int(11) NOT NULL,
  PRIMARY KEY (`id_contact`),
  UNIQUE KEY `valeur_contact_UNIQUE` (`valeur_contact`,`type_contact`),
  KEY `fk_contacts_utilisateurs` (`utilisateurs_id_utilisateur`),
  CONSTRAINT `fk_contacts_utilisateurs` FOREIGN KEY (`utilisateurs_id_utilisateur`) REFERENCES `utilisateurs` (`id_utilisateur`) ON DELETE CASCADE ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `contacts`
--

LOCK TABLES `contacts` WRITE;
/*!40000 ALTER TABLE `contacts` DISABLE KEYS */;
INSERT INTO `contacts` VALUES (1,'email','ygyongy@tradiluxe.com',1,'1',1),(2,'email','anonymous@site_perso_yungi.com',1,'1',2);
/*!40000 ALTER TABLE `contacts` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `contenus`
--

DROP TABLE IF EXISTS `contenus`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `contenus` (
  `id_contenu` int(11) NOT NULL AUTO_INCREMENT,
  `titre_html` varchar(100) NOT NULL,
  `titre_url` varchar(255) NOT NULL,
  `titre` varchar(100) NOT NULL,
  `sous_titre` varchar(255) NOT NULL,
  `contenu` longtext NOT NULL,
  `position_contenu` int(11) NOT NULL,
  `actif_contenu` enum('0','1') NOT NULL DEFAULT '1',
  `droit_contenu` enum('U','UP','UPE','UPEA') DEFAULT NULL,
  `websites_id_website` int(11) NOT NULL,
  `categories_id_categorie` int(11) NOT NULL,
  `sous_categories_id_sous_categorie` int(11) DEFAULT NULL,
  `types_contenus_id_types_contenus` int(11) NOT NULL,
  `contenu_max_par_page` int(11) DEFAULT NULL,
  `utilisateurs_id_utilisateur` int(11) NOT NULL,
  `langues_id_langue` int(11) NOT NULL,
  PRIMARY KEY (`id_contenu`,`langues_id_langue`),
  UNIQUE KEY `titre_UNIQUE` (`titre`),
  KEY `fk_pages_website` (`websites_id_website`),
  KEY `fk_contenus_categories` (`categories_id_categorie`,`langues_id_langue`),
  KEY `fk_contenus_types_contenus` (`types_contenus_id_types_contenus`),
  KEY `fk_contenus_utilisateurs` (`utilisateurs_id_utilisateur`),
  KEY `fk_contenus_langues` (`langues_id_langue`),
  KEY `fk_contenus_sous_categories` (`sous_categories_id_sous_categorie`,`langues_id_langue`),
  CONSTRAINT `fk_contenus_categories` FOREIGN KEY (`categories_id_categorie`, `langues_id_langue`) REFERENCES `categories` (`id_categorie`, `langues_id_langue`) ON DELETE CASCADE ON UPDATE NO ACTION,
  CONSTRAINT `fk_contenus_langues` FOREIGN KEY (`langues_id_langue`) REFERENCES `langues` (`id_langue`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_contenus_sous_categories` FOREIGN KEY (`sous_categories_id_sous_categorie`, `langues_id_langue`) REFERENCES `sous_categories` (`id_sous_categorie`, `langues_id_langue`) ON DELETE CASCADE ON UPDATE NO ACTION,
  CONSTRAINT `fk_contenus_types_contenus` FOREIGN KEY (`types_contenus_id_types_contenus`) REFERENCES `types_contenus` (`id_type_contenu`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_contenus_utilisateurs` FOREIGN KEY (`utilisateurs_id_utilisateur`) REFERENCES `utilisateurs` (`id_utilisateur`) ON DELETE CASCADE ON UPDATE NO ACTION,
  CONSTRAINT `fk_pages_website` FOREIGN KEY (`websites_id_website`) REFERENCES `websites` (`id_website`) ON DELETE CASCADE ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=18 DEFAULT CHARSET=utf8 COMMENT='le champ contenu JSON avec le contenu récupérer';
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `contenus`
--

LOCK TABLES `contenus` WRITE;
/*!40000 ALTER TABLE `contenus` DISABLE KEYS */;
INSERT INTO `contenus` VALUES (1,'Bienvenue sur notre page d\'accueil.','bienvenue-sur-notre-page-d-accueil','Accueil','Accueil','{\"titre\":\"Accueil\",\"contenu\":\"page d\'accueil. Qui est la première\", \"footer\":\"pied de la page d\'accueil\"}',1,'1',NULL,1,1,NULL,1,NULL,1,1),(1,'Wilkommen aus unsere Hause Seite','','Hause','Hause','{\"titre\":\"Hause\", \"contenu\":\"Wilkommen zu unsere neue webiste\"}',1,'1',NULL,1,1,NULL,1,NULL,1,2),(1,'Welcome on our new homepage','','home','home','{\"titre\":\"Home\", \"contenu\":{\"1\":\"Welcome on our website\",\r\n\"2\":\"2\",\r\n\"3\":\"3\",\r\n\"4\":\"4\",\r\n\"5\":\"5\",\r\n\"6\":\"6\",\r\n\"7\":\"7\",\r\n\"8\":\"8\",\r\n\"9\":\"9\",\r\n\"10\":\"10\",\r\n\"11\":\"Welcome on our website\",\r\n\"12\":\"12\",\r\n\"13\":\"13\",\r\n\"14\":\"14\",\r\n\"15\":\"15\",\r\n\"16\":\"16\",\r\n\"17\":\"17\",\r\n\"18\":\"18\",\r\n\"19\":\"19\",\r\n\"20\":\"20\",\r\n\"21\":\"Welcome on our website\",\r\n\"22\":\"22\",\r\n\"23\":\"23\",\r\n\"24\":\"24\",\r\n\"25\":\"25\",\r\n\"26\":\"26\",\r\n\"27\":\"27\",\r\n\"28\":\"28\",\r\n\"29\":\"29\",\r\n\"30\":\"30\"}, \"footer\":\"This is the end\"}',1,'1',NULL,1,1,NULL,2,NULL,1,3),(3,'formulaire d\'ajout de contenu','','formulaire','d\'ajout de contenu','{\"titre\":\"Ajout de contenu\",\r\n	\"contenu\":{\"action\":\"\\/site_perso_yungi\\/fr\\/Admin\\/\",\r\n				\"enctype\":\"application\\/x-www-form-urlencoded\",\r\n				\"method\":\"POST\",\r\n				\"id\":\"ajout_type_page\",\r\n				\"fields\":[{\"display_name\":\"titre html\",\r\n							\"template\":\"input\",\r\n							\"type\":\"text\",\r\n							\"class\":\"\",\r\n							\"id\":\"titre_html\",\r\n							\"name\":\"titre_html\",\r\n							\"value\":\"\",\r\n						\"tooltip\":\"Doit avoir plus de 4 caractères\"\r\n						},\r\n						{\r\n							\"display_name\":\"keywords html\",\r\n							\"template\":\"input\",\r\n							\"type\":\"text\",\r\n							\"class\":\"\",\r\n							\"id\":\"keywords\",\r\n							\"name\":\"keywords\",\r\n						\"tooltip\":\"Doit avoir plus de 4 caractères\",\r\n							\"value\":\"\"\r\n						},\r\n						{\r\n							\"display_name\":\"titre de la bannière\",\r\n							\"template\":\"input\",\r\n							\"type\":\"text\",\r\n							\"class\":\"\",\r\n							\"id\":\"titre_banner\",\r\n							\"name\":\"titre_banner\",\r\n						\"tooltip\":\"Doit avoir plus de 4 caractères\",\r\n							\"value\":\"\"\r\n						},\r\n						{\r\n							\"display_name\":\"sous-titre de la bannière\",\r\n							\"template\":\"textarea\",\r\n							\"class\":\"richtext_editor\",\r\n							\"id\":\"sous_titre_banner\",\r\n							\"name\":\"sous_titre_banner\",\r\n						\"tooltip\":\"Doit avoir plus de 4 caractères\",\r\n							\"value\":\"\"\r\n						},\r\n						{\r\n							\"display_name\":\"Corps du block\",\r\n							\"template\":\"textarea\",\r\n							\"class\":\"richtext_editor\",\r\n							\"id\":\"block_content\",\r\n							\"name\":\"block_content\",\r\n						\"tooltip\":\"Doit avoir plus de 4 caractères\",\r\n							\"value\":\"\"						\r\n						},\r\n						{\r\n							\"display_name\":\"Fichier a proposer\",\r\n							\"template\":\"input\",\r\n							\"type\":\"file\",\r\n							\"class\":\"\",\r\n							\"id\":\"file_content\",\r\n							\"name\":\"file_content\",\r\n						\"tooltip\":\"Doit avoir plus de 4 caractères\",\r\n							\"value\":\"\"							\r\n						},\r\n						{\r\n							\"type\":\"submit\",\r\n							\"template\":\"input\",\r\n							\"class\":\"\",\r\n							\"id\":\"submit\",\r\n							\"name\":\"submit\",\r\n							\"value\":\"envoyer donnees\"\r\n						}]\r\n			}\r\n}',1,'1',NULL,1,4,6,3,NULL,1,1),(4,'formulaire de connexion','','connexion','des utilisateurs','{\"titre\":\"Connexion\",\r\n	\"id_fieldset\":\"fieldset_connexion_user\",\r\n	\"contenu\":{\"action\":\"\",\r\n			\"enctype\":\"application\\/x-www-form-urlencoded\",\r\n			\"method\":\"POST\",\r\n			\"id\":\"connexion_user\",\r\n			\"name_form\":\"connexion_user\",\r\n			\"evenement_form\":\"onsubmit=\\\"return requestAuthentificationUser(this, printData)\\\"\",\r\n			\"fields\":[{\"display_name\":\"login\",\r\n						\"template\":\"input\",\r\n						\"type\":\"text\",\r\n						\"class\":\"\",\r\n						\"id\":\"login\",\r\n						\"name\":\"login\",\r\n						\"tooltip\":\"Doit avoir plus de 4 caracteres\",\r\n                                                \"evenement_field\":\"\"\r\n					},\r\n					{\r\n						\"display_name\":\"password\",\r\n						\"template\":\"input\",\r\n						\"type\":\"password\",\r\n						\"class\":\"\",\r\n						\"id\":\"pwd\",\r\n						\"name\":\"pwd\",\r\n						\"tooltip\":\"Doit avoir plus de 6 caracteres\",\r\n                                                \"evenement_field\":\"\"\r\n					},\r\n					{\r\n						\"type\":\"reset\",\r\n						\"template\":\"input\",\r\n						\"class\":\"fleft\",\r\n						\"id\":\"reset_user_form\",\r\n						\"name\":\"reset_user_form\",\r\n						\"value\":\"effacer\",\r\n                                                \"evenement_field\":\"\"\r\n					},\r\n					{\r\n						\"type\":\"submit\",\r\n						\"template\":\"input\",\r\n						\"class\":\"fleft\",\r\n						\"id\":\"connexion_user\",\r\n						\"name\":\"connexion_user\",\r\n						\"value\":\"connexion\",\r\n                                                \"evenement_field\":\"\"\r\n					}]}}',1,'1',NULL,1,5,NULL,3,NULL,1,1),(5,'création de profil','','Création d\'un utilisateur','C\'est à  ce stade que vous allez définir votre prénom, et surtout votre nom d\'utilisateur ainsi que votre mot de pase','{\"titre\":\"Saisie des informations de connexion\",\r\n	\"contenu\":{\"action\":\"\",\r\n				\"enctype\":\"application\\/x-www-form-urlencoded\",\r\n				\"method\":\"POST\",\r\n				\"id\":\"create_user\",\r\n				\"evenement_form\":\"onsubmit=\\\"return requestCreateUser(<?php echo AJAX_PATH); ?>,this, printData)\\\"\",\r\n				\"fields\":[{\"display_name\":\"Prénom\",\r\n							\"template\":\"input\",\r\n							\"type\":\"text\",\r\n							\"class\":\"\",\r\n							\"id\":\"prenom_user\",\r\n						\"tooltip\":\"Doit avoir plus de 4 caractères\",\r\n							\"name\":\"prenom_user\"\r\n						},\r\n						{\r\n							\"display_name\":\"Nom\",\r\n							\"template\":\"input\",\r\n							\"type\":\"text\",\r\n							\"class\":\"\",\r\n							\"id\":\"nom_user\",\r\n						\"tooltip\":\"Doit avoir plus de 4 caractères\",\r\n							\"name\":\"nom_user\"\r\n						},\r\n						{\r\n							\"display_name\":\"Login\",\r\n							\"template\":\"input\",\r\n							\"type\":\"text\",\r\n							\"class\":\"\",\r\n							\"id\":\"login_user\",\r\n						\"tooltip\":\"Doit avoir plus de 4 caractères\",\r\n							\"name\":\"login_user\"\r\n						},\r\n						{\r\n							\"display_name\":\"Mot de passe\",\r\n							\"template\":\"input\",\r\n							\"type\":\"password\",\r\n							\"class\":\"\",\r\n							\"id\":\"pwd_user\",\r\n						\"tooltip\":\"Doit avoir plus de 4 caractères\",\r\n							\"name\":\"pwd_user\"\r\n						},	\r\n						{\r\n							\"display_name\":\"re-Saisissez votre Mot de passe\",\r\n							\"template\":\"input\",\r\n							\"type\":\"password\",\r\n							\"class\":\"\",\r\n							\"id\":\"pwd_user_2\",\r\n						\"tooltip\":\"Doit avoir plus de 4 caractères\",\r\n							\"name\":\"pwd_user_2\"\r\n						},						\r\n						{\r\n							\"type\":\"reset\",\r\n							\"template\":\"input\",\r\n							\"class\":\"fleft\",\r\n							\"id\":\"reset_createUser_form\",\r\n							\"name\":\"reset_createUser_form\",\r\n							\"value\":\"effacer\"\r\n						},\r\n						{\r\n							\"type\":\"submit\",\r\n							\"template\":\"input\",\r\n							\"class\":\"fleft\",\r\n							\"id\":\"submit_createUser_form\",\r\n							\"name\":\"submit_createUser_form\",\r\n							\"value\":\"Enregistrer\"\r\n						}]}}',2,'0',NULL,1,4,3,3,NULL,1,1),(6,'ajout_contacts','','Ajout des coordonnées de contact','Depuis ce sous-formulaire vous pouvez entrer les différentes possibilités de vous joindre','{\"titre\":\"Saisie des informations de Contact\",\r\n	\"contenu\":{\"action\":\"\",\r\n				\"enctype\":\"application\\/x-www-form-urlencoded\",\r\n				\"method\":\"POST\",\r\n				\"id\":\"create_user\",\r\n				\"evenement_form\":\"onsubmit=\\\"return requestCreateContact(<?php echo AJAX_PATH); ?>,this, printData)\\\"\",\r\n				\"fields\":[{\"display_name\":\"E-mail\",\r\n							\"template\":\"input\",\r\n							\"type\":\"text\",\r\n							\"class\":\"\",\r\n							\"id\":\"contact_0\",\r\n						\"tooltip\":\"Doit avoir plus de 4 caractères\",\r\n							\"name\":\"contact_0\"\r\n						},						\r\n						{\r\n							\"type\":\"reset\",\r\n							\"template\":\"input\",\r\n							\"class\":\"fleft\",\r\n							\"id\":\"reset_createContact_form\",\r\n							\"name\":\"reset_createContact_form\",\r\n							\"value\":\"effacer\"\r\n						},\r\n						{\r\n							\"type\":\"submit\",\r\n							\"template\":\"input\",\r\n							\"class\":\"fleft\",\r\n							\"id\":\"submit_createContact_form\",\r\n							\"name\":\"submit_createContact_form\",\r\n							\"value\":\"Enregistrer\"\r\n						}]}}',3,'0',NULL,1,4,3,3,NULL,1,1),(7,'Creation_adresse','','Création des adresses','Depuis cette emplacement vous donnerez vos informations de contact postal','{\"titre\":\"Saisie des informations de base\",\r\n	\"contenu\":{\"action\":\"\",\r\n				\"enctype\":\"application\\/x-www-form-urlencoded\",\r\n				\"method\":\"POST\",\r\n				\"id\":\"create_user\",\r\n				\"evenement_form\":\"onsubmit=\\\"return requestCreateAdresse(<?php echo AJAX_PATH); ?>,this, printData)\\\"\",\r\n				\"fields\":[{\"display_name\":\"Type d\'adresse\",\r\n							\"template\":\"select\",\r\n							\"class\":\"\",\r\n							\"id\":\"type_adresse\",\r\n							\"name\":\"type_adresse\",\r\n\"type\":\"select\",\r\n						\"tooltip\":\"Doit avoir plus de 4 caractères\",\r\n							\"value\":{\"1\":\"Adresse principal\",\r\n										\"2\":\"Adresse d\'envoi\",\r\n										\"3\":\"Adresse de facturation\"\r\n									}\r\n						},\r\n						{\"display_name\":\"Adresse\",\r\n							\"template\":\"input\",\r\n							\"type\":\"text\",\r\n							\"class\":\"\",\r\n							\"id\":\"adresse_0\",\r\n						\"tooltip\":\"Doit avoir plus de 4 caractères\",\r\n							\"name\":\"adresse_0\"\r\n						},\r\n						{\"display_name\":\"Adresse 2\",\r\n							\"template\":\"input\",\r\n							\"type\":\"text\",\r\n							\"class\":\"\",\r\n							\"id\":\"adresse_1\",\r\n						\"tooltip\":\"Doit avoir plus de 4 caractères\",\r\n							\"name\":\"adresse_1\"\r\n						},\r\n						{\"display_name\":\"NPA\",\r\n							\"template\":\"input\",\r\n							\"type\":\"text\",\r\n							\"class\":\"\",\r\n							\"id\":\"adresse_2\",\r\n						\"tooltip\":\"Doit avoir plus de 4 caractères\",\r\n							\"name\":\"adresse_2\"\r\n						},\r\n						{\"type\":\"reset\",\r\n							\"template\":\"input\",\r\n							\"class\":\"fleft\",\r\n							\"id\":\"reset_createAdresse_form\",\r\n							\"name\":\"reset_createAdresse_form\",\r\n							\"value\":\"effacer\"\r\n						},\r\n						{\"type\":\"submit\",\r\n							\"template\":\"input\",\r\n							\"class\":\"fleft\",\r\n							\"id\":\"submit_createAdresse_form\",\r\n							\"name\":\"submit_createAdresse_form\",\r\n							\"value\":\"enregistrer\"\r\n						}]}}',4,'0',NULL,1,4,3,3,NULL,1,1),(8,'้ลลดยมเ','','้ลลดยมเ','งยแดมท ลยรรย แ้ทั หวดท ้ดอย่ ้ลลใท ข รวดร','{\"titre\":\"๋ลลดยมเ\",\"contenu\":\"าย คย ทดมท แ้ท ดค ีไอว\", \"footer\":\"ดค ีไอว\"}',2,'1',NULL,1,1,NULL,1,NULL,1,1),(9,'фыва','','фывафывафыва','ыфвдладл аджф выоафжд оафадлофа фдла фдаодлвы оа','{\"titre\":\"гт учуьзду ут кгыыу\",\"contenu\":\"вфмфш зфкгылшб зкумшуе ьфдшсрлф вщикшвфт\",\"footer\":\"вщикшвф\"}',3,'1',NULL,1,1,NULL,1,NULL,1,1),(10,'test block','','Un petit block','Un Petit block sous titre','{\"titre\":\"Block de texte\",\"contenu\":\"Un petit block supplémentaire afin de tester l\'empilage de ceux-ci\"}',1,'1',NULL,1,5,NULL,4,NULL,1,1),(11,'liste utilisateurs','','Liste des utilisateurs accessibles','Depuis cette liste vous pouvez modifier les utilisateurs accessibles, les supprimer ou encore en créer un','{\"titre\":\"Liste des utilisateurs du site\", \"contenu\":\"Utilisateurs_admin\", \"footer\":\"ajout d\'utilisateur / informations\"}',1,'1',NULL,1,4,3,6,NULL,1,1),(12,'aslfj','','afjaélfj asdfjaé','aé fjasdfjfkja df','{\"titre\":\"Nouveautés 2\",\"contenu\":\"vjéklbjléajélbj\", \"footer\":\"éldfjéaéldfj\"}',2,'1',NULL,1,1,1,1,NULL,1,1),(13,'asdf','','aékdfj ad fjaéldfjkj   3','ajdfaékd jé','{\"titre\":\"Nouveautés 3\",\"contenu\":\"vjéklbjléajélbj\", \"footer\":\"éldfjéaéldfj\"}',3,'1',NULL,1,1,1,1,NULL,1,1),(17,'aslfj','','asdfasdfa','aé adfasffdsddf','{\"titre\":\"Nouveautés 4\",\"contenu\":\"vjéklbjléajélbj\", \"footer\":\"éldfjéaéldfj\"}',4,'1',NULL,1,1,1,1,NULL,1,1);
/*!40000 ALTER TABLE `contenus` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `fichiers`
--

DROP TABLE IF EXISTS `fichiers`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `fichiers` (
  `id_fichier` int(11) NOT NULL AUTO_INCREMENT,
  `nom_fichier` varchar(255) NOT NULL,
  `date_ajout` int(11) NOT NULL,
  `date_modification` int(11) NOT NULL,
  `position_fichier` int(2) NOT NULL DEFAULT '1',
  `actif_fichier` enum('0','1') NOT NULL DEFAULT '1',
  `types_fichiers_id_type_fichier` int(11) NOT NULL,
  `contenus_id_contenu` int(11) NOT NULL,
  `langues_id_langue` int(11) NOT NULL,
  PRIMARY KEY (`id_fichier`,`langues_id_langue`),
  UNIQUE KEY `nom_fichier_and_date_ajout_UNIQUE` (`date_ajout`,`nom_fichier`),
  KEY `fk_fichiers_types_fichiers` (`types_fichiers_id_type_fichier`),
  KEY `fk_fichiers_contenus` (`contenus_id_contenu`,`langues_id_langue`),
  KEY `fk_fichiers_langues` (`langues_id_langue`),
  CONSTRAINT `fk_fichiers_contenus` FOREIGN KEY (`contenus_id_contenu`, `langues_id_langue`) REFERENCES `contenus` (`id_contenu`, `langues_id_langue`) ON DELETE CASCADE ON UPDATE NO ACTION,
  CONSTRAINT `fk_fichiers_langues` FOREIGN KEY (`langues_id_langue`) REFERENCES `langues` (`id_langue`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_fichiers_types_fichiers` FOREIGN KEY (`types_fichiers_id_type_fichier`) REFERENCES `types_fichiers` (`id_type_fichier`) ON DELETE CASCADE ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `fichiers`
--

LOCK TABLES `fichiers` WRITE;
/*!40000 ALTER TABLE `fichiers` DISABLE KEYS */;
/*!40000 ALTER TABLE `fichiers` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `fields`
--

DROP TABLE IF EXISTS `fields`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `fields` (
  `id_field` int(11) NOT NULL AUTO_INCREMENT,
  `balise_field` varchar(45) NOT NULL,
  `type_field` varchar(45) NOT NULL,
  `html_id_field` varchar(255) NOT NULL,
  `nom_field` varchar(200) NOT NULL,
  `class_field` varchar(255) DEFAULT '',
  `value_field` longtext,
  `position_field` int(3) NOT NULL DEFAULT '1',
  `actif_field` enum('0','1') NOT NULL DEFAULT '1',
  `labels_id_label` int(11) NOT NULL,
  PRIMARY KEY (`id_field`),
  KEY `fk_fields_labels` (`labels_id_label`),
  CONSTRAINT `fk_fields_labels` FOREIGN KEY (`labels_id_label`) REFERENCES `labels` (`id_label`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `fields`
--

LOCK TABLES `fields` WRITE;
/*!40000 ALTER TABLE `fields` DISABLE KEYS */;
/*!40000 ALTER TABLE `fields` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `fields_has_types_contenus`
--

DROP TABLE IF EXISTS `fields_has_types_contenus`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `fields_has_types_contenus` (
  `fields_id_field` int(11) NOT NULL,
  `types_contenus_id_types_contenus` int(11) NOT NULL,
  PRIMARY KEY (`fields_id_field`,`types_contenus_id_types_contenus`),
  KEY `fk_fields_has_types_contenus_types_contenus` (`types_contenus_id_types_contenus`),
  KEY `fk_fields_has_types_contenus_fields` (`fields_id_field`),
  CONSTRAINT `fk_fields_has_types_contenus_fields` FOREIGN KEY (`fields_id_field`) REFERENCES `fields` (`id_field`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_fields_has_types_contenus_types_contenus` FOREIGN KEY (`types_contenus_id_types_contenus`) REFERENCES `types_contenus` (`id_type_contenu`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `fields_has_types_contenus`
--

LOCK TABLES `fields_has_types_contenus` WRITE;
/*!40000 ALTER TABLE `fields_has_types_contenus` DISABLE KEYS */;
/*!40000 ALTER TABLE `fields_has_types_contenus` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `groupes`
--

DROP TABLE IF EXISTS `groupes`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `groupes` (
  `id_groupe` int(11) NOT NULL AUTO_INCREMENT,
  `nom_groupe` varchar(45) NOT NULL,
  `droit_groupe` char(4) DEFAULT NULL,
  `actif_groupe` enum('0','1') NOT NULL DEFAULT '1',
  PRIMARY KEY (`id_groupe`),
  UNIQUE KEY `nom_groupe_UNIQUE` (`nom_groupe`,`droit_groupe`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `groupes`
--

LOCK TABLES `groupes` WRITE;
/*!40000 ALTER TABLE `groupes` DISABLE KEYS */;
INSERT INTO `groupes` VALUES (1,'admin','UPEA','1'),(2,'editeur','UPE','1'),(3,'pro','UP','1'),(4,'user','U','1'),(5,'anonymous',NULL,'1');
/*!40000 ALTER TABLE `groupes` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `labels`
--

DROP TABLE IF EXISTS `labels`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `labels` (
  `id_label` int(11) NOT NULL AUTO_INCREMENT,
  `nom_label` varchar(255) NOT NULL,
  `class` varchar(255) DEFAULT NULL,
  `actif_label` enum('0','1') NOT NULL DEFAULT '1',
  `langues_id_langue` int(11) NOT NULL,
  PRIMARY KEY (`id_label`,`langues_id_langue`),
  KEY `fk_labels_langues` (`langues_id_langue`),
  CONSTRAINT `fk_labels_langues` FOREIGN KEY (`langues_id_langue`) REFERENCES `langues` (`id_langue`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `labels`
--

LOCK TABLES `labels` WRITE;
/*!40000 ALTER TABLE `labels` DISABLE KEYS */;
/*!40000 ALTER TABLE `labels` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `langues`
--

DROP TABLE IF EXISTS `langues`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `langues` (
  `id_langue` int(11) NOT NULL AUTO_INCREMENT,
  `code_langue` char(2) NOT NULL DEFAULT 'fr',
  `nom_langue` varchar(45) NOT NULL DEFAULT 'français',
  `position_langue` int(3) NOT NULL DEFAULT '1',
  `actif_langue` enum('0','1') NOT NULL DEFAULT '1',
  PRIMARY KEY (`id_langue`),
  UNIQUE KEY `code_langue_UNIQUE` (`code_langue`),
  UNIQUE KEY `nom_langue_UNIQUE` (`nom_langue`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `langues`
--

LOCK TABLES `langues` WRITE;
/*!40000 ALTER TABLE `langues` DISABLE KEYS */;
INSERT INTO `langues` VALUES (1,'fr','francais',1,'1'),(2,'de','deutsch',2,'1'),(3,'en','english',3,'1');
/*!40000 ALTER TABLE `langues` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `parametres_fields`
--

DROP TABLE IF EXISTS `parametres_fields`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `parametres_fields` (
  `id_parametre_field` int(11) NOT NULL AUTO_INCREMENT,
  `nom_parametre_field` varchar(200) NOT NULL,
  `valeur_parametre_field` longtext,
  `fields_id_field` int(11) NOT NULL,
  PRIMARY KEY (`id_parametre_field`),
  KEY `fk_parametres_fields_fields1` (`fields_id_field`),
  CONSTRAINT `fk_parametres_fields_fields1` FOREIGN KEY (`fields_id_field`) REFERENCES `fields` (`id_field`) ON DELETE CASCADE ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `parametres_fields`
--

LOCK TABLES `parametres_fields` WRITE;
/*!40000 ALTER TABLE `parametres_fields` DISABLE KEYS */;
/*!40000 ALTER TABLE `parametres_fields` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `pays`
--

DROP TABLE IF EXISTS `pays`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `pays` (
  `id_pays` int(11) NOT NULL AUTO_INCREMENT,
  `nom_pays` varchar(100) NOT NULL,
  `code_pays` varchar(2) NOT NULL,
  PRIMARY KEY (`id_pays`)
) ENGINE=InnoDB AUTO_INCREMENT=238 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `pays`
--

LOCK TABLES `pays` WRITE;
/*!40000 ALTER TABLE `pays` DISABLE KEYS */;
INSERT INTO `pays` VALUES (1,'afghanistan','af'),(2,'afrique-du-sud','za'),(3,'albanie','al'),(4,'algerie','dz'),(5,'allemagne','de'),(6,'andorre','ad'),(7,'angola','ao'),(8,'anguilla','ai'),(9,'antarctique','aq'),(10,'antigua-et-barbuda','ag'),(11,'antilles-neerlandaises','an'),(12,'arabie-saoudite','sa'),(13,'argentine','ar'),(14,'armenie','am'),(15,'aruba','aw'),(16,'australie','au'),(17,'autriche','at'),(18,'azerbaidjan','az'),(19,'bahamas','bs'),(20,'bahrain','bh'),(21,'bangladesh','bd'),(22,'belgique','be'),(23,'belize','bz'),(24,'benin','bj'),(25,'bermudes-les','bm'),(26,'bhoutan','bt'),(27,'bielorussie','by'),(28,'bolivie','bo'),(29,'bosnie-herzegovine','ba'),(30,'botswana','bw'),(31,'bouvet-iles','bv'),(32,'bresil','br'),(33,'brunei','bn'),(34,'bulgarie','bg'),(35,'burkina-faso','bf'),(36,'burundi','bi'),(37,'cambodge','kh'),(38,'cameroun','cm'),(39,'canada','ca'),(40,'cap-vert','cv'),(41,'cayman-iles','ky'),(42,'chili','cl'),(43,'chine-rep-pop','cn'),(44,'christmas-ile','cx'),(45,'chypre','cy'),(46,'cocos-iles','cc'),(47,'colombie','co'),(48,'comores','km'),(49,'cook-iles','ck'),(50,'coree-du-nord','kp'),(51,'coree-sud','kr'),(52,'costa-rica','cr'),(53,'cote-divoire','ci'),(54,'croatie','hr'),(55,'cuba','cu'),(56,'danemark','dk'),(57,'djibouti','dj'),(58,'dominique','dm'),(59,'egypte','eg'),(60,'el-salvador','sv'),(61,'emirats-arabes-unis','ae'),(62,'equateur','ec'),(63,'erythree','er'),(64,'espagne','es'),(65,'estonie','ee'),(66,'etats-unis','us'),(67,'ethiopie','et'),(68,'falkland-ile','fk'),(69,'feroe-iles','fo'),(70,'fidji-republique-des','fj'),(71,'finlande','fi'),(72,'france','fr'),(73,'gabon','ga'),(74,'gambie','gm'),(75,'georgie','ge'),(76,'georgie-du-sud-et-sandwich-du-sud-iles','gs'),(77,'ghana','gh'),(78,'gibraltar','gi'),(79,'grece','gr'),(80,'grenade','gd'),(81,'groenland','gl'),(82,'guadeloupe','gp'),(83,'guam','gu'),(84,'guatemala','gt'),(85,'guinee','gn'),(86,'guinee-bissau','gw'),(87,'guinee-equatoriale','gq'),(88,'guyane','gy'),(89,'guyane-francaise','gf'),(90,'haiti','ht'),(91,'heard-et-mcdonald-iles','hm'),(92,'honduras','hn'),(93,'hong-kong','hk'),(94,'hongrie','hu'),(95,'iles-mineures-eloignees-des-etats-unis','um'),(96,'inde','in'),(97,'indonesie','id'),(98,'irak','iq'),(99,'iran','ir'),(100,'irlande','ie'),(101,'islande','is'),(102,'israel','il'),(103,'italie','it'),(104,'jamaique','jm'),(105,'japon','jp'),(106,'jordanie','jo'),(107,'kazakhstan','kz'),(108,'kenya','ke'),(109,'kirghizistan','kg'),(110,'kiribati','ki'),(111,'koweit','kw'),(112,'la-barbad','bb'),(113,'laos','la'),(114,'lesotho','ls'),(115,'lettonie','lv'),(116,'liban','lb'),(117,'liberia','lr'),(118,'libye','ly'),(119,'liechtenstein','li'),(120,'lithuanie','lt'),(121,'luxembourg','lu'),(122,'macau','mo'),(123,'macedoine','mk'),(124,'madagascar','mg'),(125,'malaisie','my'),(126,'malawi','mw'),(127,'maldives-iles','mv'),(128,'mali','ml'),(129,'malte','mt'),(130,'mariannes-du-nord-iles','mp'),(131,'maroc','ma'),(132,'marshall-iles','mh'),(133,'martinique','mq'),(134,'maurice','mu'),(135,'mauritanie','mr'),(136,'mayotte','yt'),(137,'mexique','mx'),(138,'micronesie-etats-federes-de','fm'),(139,'moldavie','md'),(140,'monaco','mc'),(141,'mongolie','mn'),(142,'montserrat','ms'),(143,'mozambique','mz'),(144,'myanmar','mm'),(145,'namibie','na'),(146,'nauru','nr'),(147,'nepal','np'),(148,'nicaragua','ni'),(149,'niger','ne'),(150,'nigeria','ng'),(151,'niue','nu'),(152,'norfolk-iles','nf'),(153,'norvege','no'),(154,'nouvelle-caledonie','nc'),(155,'nouvelle-zelande','nz'),(156,'oman','om'),(157,'ouganda','ug'),(158,'ouzbekistan','uz'),(159,'pakistan','pk'),(160,'palau','pw'),(161,'panama','pa'),(162,'papouasie-nouvelle-guinee','pg'),(163,'paraguay','py'),(164,'pays-bas','nl'),(165,'perou','pe'),(166,'philippines','ph'),(167,'pitcairn-iles','pn'),(168,'pologne','pl'),(169,'polynesie-francaise','pf'),(170,'porto-rico','pr'),(171,'portugal','pt'),(172,'qatar','qa'),(173,'rep-dem-du-congo','cg'),(174,'republique-centrafricaine','cf'),(175,'republique-dominicaine','do'),(176,'republique-tcheque','cz'),(177,'reunion-la','re'),(178,'roumanie','ro'),(179,'royaume-uni','uk'),(180,'russie','ru'),(181,'rwanda','rw'),(182,'sahara-occidental','eh'),(183,'sainte-helene','sh'),(184,'sainte-lucie','lc'),(185,'saint-kitts-et-nevis','kn'),(186,'saint-marin-rep-de','sm'),(187,'saint-pierre-et-miquelon','pm'),(188,'saint-vincent-et-les-grenadines','vc'),(189,'samoa','as'),(190,'samoa','ws'),(191,'sao-tome-et-principe-rep','st'),(192,'senegal','sn'),(193,'seychelles','sc'),(194,'sierra-leone','sl'),(195,'singapour','sg'),(196,'slovaquie','sk'),(197,'slovenie','si'),(198,'somalie','so'),(199,'soudan','sd'),(200,'sri-lanka','lk'),(201,'suede','se'),(202,'suisse','ch'),(203,'suriname','sr'),(204,'svalbard-et-jan-mayen-iles','sj'),(205,'swaziland','sz'),(206,'syrie','sy'),(207,'tadjikistan','tj'),(208,'taiwan','tw'),(209,'tanzanie','tz'),(210,'tchad','td'),(211,'territoire-britannique-de-locean-indien','io'),(212,'territoires-francais-du-sud','tf'),(213,'thailande','th'),(214,'timor','tp'),(215,'togo','tg'),(216,'tokelau','tk'),(217,'tonga','to'),(218,'trinite-et-tobago','tt'),(219,'tunisie','tn'),(220,'turkmenistan','tm'),(221,'turks-et-caiques-iles','tc'),(222,'turquie','tr'),(223,'tuvalu','tv'),(224,'ukraine','ua'),(225,'uruguay','uy'),(226,'vanuatu','vu'),(227,'vatican-etat-du','va'),(228,'venezuela','ve'),(229,'vierges-britanniques-iles','vg'),(230,'vierges-iles','vi'),(231,'vietnam','vn'),(232,'wallis-et-futuna-iles','wf'),(233,'yemen','ye'),(234,'yougoslavie','yu'),(235,'zaire','zr'),(236,'zambie','zm'),(237,'zimbabwe','zw');
/*!40000 ALTER TABLE `pays` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `sous_categories`
--

DROP TABLE IF EXISTS `sous_categories`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `sous_categories` (
  `id_sous_categorie` int(11) NOT NULL AUTO_INCREMENT,
  `nom_sous_categorie` varchar(200) NOT NULL,
  `emplacement_sous_categorie` enum('sous_navigation','sous_admin','sous_langue','sous_catalogue','sous_hidden') NOT NULL DEFAULT 'sous_navigation',
  `actif_sous_categorie` enum('0','1') NOT NULL DEFAULT '1',
  `position_sous_categorie` int(3) NOT NULL DEFAULT '1',
  `droit_sous_categorie` char(4) DEFAULT NULL,
  `categories_id_categorie` int(11) NOT NULL,
  `langues_id_langue` int(11) NOT NULL,
  `types_contenus_id_type_contenu` int(11) NOT NULL,
  `sous_categorie_max_par_page` int(11) DEFAULT NULL,
  PRIMARY KEY (`id_sous_categorie`,`langues_id_langue`),
  UNIQUE KEY `nom_sous_categorie_UNIQUE` (`nom_sous_categorie`,`langues_id_langue`),
  KEY `fk_sous_categoires_categories` (`categories_id_categorie`,`langues_id_langue`),
  KEY `fk_sous_categoires_langues` (`langues_id_langue`),
  KEY `fk_sous_categories_types_contenus1_idx` (`types_contenus_id_type_contenu`),
  CONSTRAINT `fk_sous_categoires_categories` FOREIGN KEY (`categories_id_categorie`, `langues_id_langue`) REFERENCES `categories` (`id_categorie`, `langues_id_langue`) ON DELETE CASCADE ON UPDATE NO ACTION,
  CONSTRAINT `fk_sous_categoires_langues` FOREIGN KEY (`langues_id_langue`) REFERENCES `langues` (`id_langue`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_sous_categories_types_contenus1` FOREIGN KEY (`types_contenus_id_type_contenu`) REFERENCES `types_contenus` (`id_type_contenu`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `sous_categories`
--

LOCK TABLES `sous_categories` WRITE;
/*!40000 ALTER TABLE `sous_categories` DISABLE KEYS */;
INSERT INTO `sous_categories` VALUES (1,'Nouveautes','sous_navigation','1',1,NULL,1,1,1,NULL),(3,'Utilisateurs','sous_admin','1',1,NULL,4,1,6,NULL),(4,'Categories','sous_admin','1',2,NULL,4,1,1,NULL),(5,'Templates','sous_admin','1',3,NULL,4,1,1,NULL),(6,'Contenus','sous_admin','1',4,NULL,4,1,1,NULL),(7,'Favoris','sous_admin','1',5,NULL,4,1,1,NULL),(8,'afficher le détail','sous_catalogue','1',1,NULL,5,1,1,NULL);
/*!40000 ALTER TABLE `sous_categories` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `types_contenus`
--

DROP TABLE IF EXISTS `types_contenus`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `types_contenus` (
  `id_type_contenu` int(11) NOT NULL AUTO_INCREMENT,
  `nom_type_contenu` varchar(45) NOT NULL,
  `actif_type_contenu` enum('0','1') NOT NULL DEFAULT '1',
  PRIMARY KEY (`id_type_contenu`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `types_contenus`
--

LOCK TABLES `types_contenus` WRITE;
/*!40000 ALTER TABLE `types_contenus` DISABLE KEYS */;
INSERT INTO `types_contenus` VALUES (1,'page','1'),(2,'matrice','1'),(3,'form','1'),(4,'block','1'),(5,'liste','1'),(6,'include','1'),(7,'grid','1');
/*!40000 ALTER TABLE `types_contenus` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `types_fichiers`
--

DROP TABLE IF EXISTS `types_fichiers`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `types_fichiers` (
  `id_type_fichier` int(11) NOT NULL AUTO_INCREMENT,
  `nom_type_fichier` varchar(100) NOT NULL,
  `actif` enum('0','1') NOT NULL DEFAULT '1',
  PRIMARY KEY (`id_type_fichier`),
  UNIQUE KEY `nom_type_fichier_UNIQUE` (`nom_type_fichier`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `types_fichiers`
--

LOCK TABLES `types_fichiers` WRITE;
/*!40000 ALTER TABLE `types_fichiers` DISABLE KEYS */;
/*!40000 ALTER TABLE `types_fichiers` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `utilisateurs`
--

DROP TABLE IF EXISTS `utilisateurs`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `utilisateurs` (
  `id_utilisateur` int(11) NOT NULL AUTO_INCREMENT,
  `nom_utilisateur` varchar(100) NOT NULL,
  `prenom_utilisateur` varchar(100) NOT NULL,
  `login_utilisateur` varchar(100) NOT NULL,
  `pwd_utilisateur` varchar(255) NOT NULL,
  `vernam_utilisateur` varchar(255) NOT NULL,
  `inscription_utilisateur` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `actif_utilisateur` enum('0','1') NOT NULL DEFAULT '1',
  `langues_id_langue` int(11) NOT NULL,
  `groupes_id_groupe` int(11) NOT NULL,
  PRIMARY KEY (`id_utilisateur`),
  UNIQUE KEY `login_utilisateur_UNIQUE` (`login_utilisateur`),
  KEY `fk_utilisateurs_langues` (`langues_id_langue`),
  KEY `fk_utilisateurs_groupes` (`groupes_id_groupe`),
  CONSTRAINT `fk_utilisateurs_groupes` FOREIGN KEY (`groupes_id_groupe`) REFERENCES `groupes` (`id_groupe`) ON DELETE CASCADE ON UPDATE NO ACTION,
  CONSTRAINT `fk_utilisateurs_langues` FOREIGN KEY (`langues_id_langue`) REFERENCES `langues` (`id_langue`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `utilisateurs`
--

LOCK TABLES `utilisateurs` WRITE;
/*!40000 ALTER TABLE `utilisateurs` DISABLE KEYS */;
INSERT INTO `utilisateurs` VALUES (1,'Gyongy','Yann','ygyongy','227a8126f3672f8f779a826d018b8421','testDeClef','2011-08-02 06:19:26','1',1,1),(2,'Anonymous','Anonymous','anonymous','6f8bf449c80d8fa3efa750d1c880452f','TestDuVernam','2011-08-02 18:53:12','1',1,5),(4,'Gyongy','Yann','ygyongy2','6f8bf449c80d8fa3efa750d1c880452f','un_test','2013-02-03 21:27:44','1',1,1);
/*!40000 ALTER TABLE `utilisateurs` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Temporary table structure for view `view_admin_contenus`
--

DROP TABLE IF EXISTS `view_admin_contenus`;
/*!50001 DROP VIEW IF EXISTS `view_admin_contenus`*/;
SET @saved_cs_client     = @@character_set_client;
SET character_set_client = utf8;
/*!50001 CREATE TABLE `view_admin_contenus` (
  `id_contenu` int(11),
  `titre_html` varchar(100),
  `titre` varchar(100),
  `sous_titre` varchar(255),
  `contenu` longtext,
  `position_contenu` int(11),
  `actif_contenu` enum('0','1'),
  `droit_contenu` enum('U','UP','UPE','UPEA'),
  `websites_id_website` int(11),
  `id_categorie` int(11),
  `sous_categories_id_sous_categorie` int(11),
  `id_type_contenu` int(11),
  `nom_type_contenu` varchar(45),
  `langues_id_langue` int(11)
) ENGINE=MyISAM */;
SET character_set_client = @saved_cs_client;

--
-- Temporary table structure for view `view_admin_menu`
--

DROP TABLE IF EXISTS `view_admin_menu`;
/*!50001 DROP VIEW IF EXISTS `view_admin_menu`*/;
SET @saved_cs_client     = @@character_set_client;
SET character_set_client = utf8;
/*!50001 CREATE TABLE `view_admin_menu` (
  `id_categorie` int(11),
  `titre_html_categorie` varchar(255),
  `nom_categorie` varchar(100),
  `emplacement_categorie` enum('navigation','admin','langue','catalogue','hidden'),
  `actif_categorie` enum('O','1'),
  `position_categorie` int(3),
  `droit_categorie` char(4),
  `langues_id_langue` int(11),
  `types_contenus_id_type_contenu` int(11),
  `categorie_max_par_page` int(11)
) ENGINE=MyISAM */;
SET character_set_client = @saved_cs_client;

--
-- Temporary table structure for view `view_admin_sous_menu`
--

DROP TABLE IF EXISTS `view_admin_sous_menu`;
/*!50001 DROP VIEW IF EXISTS `view_admin_sous_menu`*/;
SET @saved_cs_client     = @@character_set_client;
SET character_set_client = utf8;
/*!50001 CREATE TABLE `view_admin_sous_menu` (
  `id_sous_categorie` int(11),
  `nom_sous_categorie` varchar(200),
  `emplacement_sous_categorie` enum('sous_navigation','sous_admin','sous_langue','sous_catalogue','sous_hidden'),
  `actif_sous_categorie` enum('0','1'),
  `position_sous_categorie` int(3),
  `droit_sous_categorie` char(4),
  `categories_id_categorie` int(11),
  `langues_id_langue` int(11),
  `types_contenus_id_type_contenu` int(11),
  `sous_categorie_max_par_page` int(11)
) ENGINE=MyISAM */;
SET character_set_client = @saved_cs_client;

--
-- Temporary table structure for view `view_anonymous_contenus`
--

DROP TABLE IF EXISTS `view_anonymous_contenus`;
/*!50001 DROP VIEW IF EXISTS `view_anonymous_contenus`*/;
SET @saved_cs_client     = @@character_set_client;
SET character_set_client = utf8;
/*!50001 CREATE TABLE `view_anonymous_contenus` (
  `id_contenu` int(11),
  `titre_html` varchar(100),
  `titre_url` varchar(255),
  `titre` varchar(100),
  `sous_titre` varchar(255),
  `contenu` longtext,
  `position_contenu` int(11),
  `actif_contenu` enum('0','1'),
  `droit_contenu` enum('U','UP','UPE','UPEA'),
  `websites_id_website` int(11),
  `sous_categories_id_sous_categorie` int(11),
  `categories_id_categorie` int(11),
  `cat_type_contenu` int(11),
  `cat_max_par_page` int(11),
  `cont_type_contenu` int(11),
  `langues_id_langue` int(11)
) ENGINE=MyISAM */;
SET character_set_client = @saved_cs_client;

--
-- Temporary table structure for view `view_anonymous_menu`
--

DROP TABLE IF EXISTS `view_anonymous_menu`;
/*!50001 DROP VIEW IF EXISTS `view_anonymous_menu`*/;
SET @saved_cs_client     = @@character_set_client;
SET character_set_client = utf8;
/*!50001 CREATE TABLE `view_anonymous_menu` (
  `id_categorie` int(11),
  `titre_html_categorie` varchar(255),
  `nom_categorie` varchar(100),
  `emplacement_categorie` enum('navigation','admin','langue','catalogue','hidden'),
  `actif_categorie` enum('O','1'),
  `position_categorie` int(3),
  `droit_categorie` char(4),
  `langues_id_langue` int(11),
  `types_contenus_id_type_contenu` int(11),
  `categorie_max_par_page` int(11),
  `id_type_contenu` int(11),
  `nom_type_contenu` varchar(45),
  `actif_type_contenu` enum('0','1')
) ENGINE=MyISAM */;
SET character_set_client = @saved_cs_client;

--
-- Temporary table structure for view `view_anonymous_sous_menu`
--

DROP TABLE IF EXISTS `view_anonymous_sous_menu`;
/*!50001 DROP VIEW IF EXISTS `view_anonymous_sous_menu`*/;
SET @saved_cs_client     = @@character_set_client;
SET character_set_client = utf8;
/*!50001 CREATE TABLE `view_anonymous_sous_menu` (
  `id_sous_categorie` int(11),
  `nom_sous_categorie` varchar(200),
  `emplacement_sous_categorie` enum('sous_navigation','sous_admin','sous_langue','sous_catalogue','sous_hidden'),
  `actif_sous_categorie` enum('0','1'),
  `position_sous_categorie` int(3),
  `droit_sous_categorie` char(4),
  `categories_id_categorie` int(11),
  `langues_id_langue` int(11),
  `types_contenus_id_type_contenu` int(11),
  `sous_categorie_max_par_page` int(11)
) ENGINE=MyISAM */;
SET character_set_client = @saved_cs_client;

--
-- Temporary table structure for view `view_editeur_contenus`
--

DROP TABLE IF EXISTS `view_editeur_contenus`;
/*!50001 DROP VIEW IF EXISTS `view_editeur_contenus`*/;
SET @saved_cs_client     = @@character_set_client;
SET character_set_client = utf8;
/*!50001 CREATE TABLE `view_editeur_contenus` (
  `id_contenu` int(11),
  `titre_html` varchar(100),
  `titre` varchar(100),
  `sous_titre` varchar(255),
  `contenu` longtext,
  `position_contenu` int(11),
  `actif_contenu` enum('0','1'),
  `droit_contenu` enum('U','UP','UPE','UPEA'),
  `websites_id_website` int(11),
  `id_categorie` int(11),
  `id_type_contenu` int(11),
  `nom_type_contenu` varchar(45),
  `langues_id_langue` int(11)
) ENGINE=MyISAM */;
SET character_set_client = @saved_cs_client;

--
-- Temporary table structure for view `view_editeur_menu`
--

DROP TABLE IF EXISTS `view_editeur_menu`;
/*!50001 DROP VIEW IF EXISTS `view_editeur_menu`*/;
SET @saved_cs_client     = @@character_set_client;
SET character_set_client = utf8;
/*!50001 CREATE TABLE `view_editeur_menu` (
  `id_categorie` int(11),
  `titre_html_categorie` varchar(255),
  `nom_categorie` varchar(100),
  `emplacement_categorie` enum('navigation','admin','langue','catalogue','hidden'),
  `actif_categorie` enum('O','1'),
  `position_categorie` int(3),
  `droit_categorie` char(4),
  `langues_id_langue` int(11),
  `types_contenus_id_type_contenu` int(11),
  `categorie_max_par_page` int(11)
) ENGINE=MyISAM */;
SET character_set_client = @saved_cs_client;

--
-- Temporary table structure for view `view_editeur_sous_menu`
--

DROP TABLE IF EXISTS `view_editeur_sous_menu`;
/*!50001 DROP VIEW IF EXISTS `view_editeur_sous_menu`*/;
SET @saved_cs_client     = @@character_set_client;
SET character_set_client = utf8;
/*!50001 CREATE TABLE `view_editeur_sous_menu` (
  `id_sous_categorie` int(11),
  `nom_sous_categorie` varchar(200),
  `emplacement_sous_categorie` enum('sous_navigation','sous_admin','sous_langue','sous_catalogue','sous_hidden'),
  `actif_sous_categorie` enum('0','1'),
  `position_sous_categorie` int(3),
  `droit_sous_categorie` char(4),
  `categories_id_categorie` int(11),
  `langues_id_langue` int(11),
  `types_contenus_id_type_contenu` int(11),
  `sous_categorie_max_par_page` int(11)
) ENGINE=MyISAM */;
SET character_set_client = @saved_cs_client;

--
-- Temporary table structure for view `view_pro_contenus`
--

DROP TABLE IF EXISTS `view_pro_contenus`;
/*!50001 DROP VIEW IF EXISTS `view_pro_contenus`*/;
SET @saved_cs_client     = @@character_set_client;
SET character_set_client = utf8;
/*!50001 CREATE TABLE `view_pro_contenus` (
  `id_contenu` int(11),
  `titre_html` varchar(100),
  `titre` varchar(100),
  `sous_titre` varchar(255),
  `contenu` longtext,
  `position_contenu` int(11),
  `actif_contenu` enum('0','1'),
  `droit_contenu` enum('U','UP','UPE','UPEA'),
  `websites_id_website` int(11),
  `id_categorie` int(11),
  `id_type_contenu` int(11),
  `nom_type_contenu` varchar(45),
  `langues_id_langue` int(11)
) ENGINE=MyISAM */;
SET character_set_client = @saved_cs_client;

--
-- Temporary table structure for view `view_pro_menu`
--

DROP TABLE IF EXISTS `view_pro_menu`;
/*!50001 DROP VIEW IF EXISTS `view_pro_menu`*/;
SET @saved_cs_client     = @@character_set_client;
SET character_set_client = utf8;
/*!50001 CREATE TABLE `view_pro_menu` (
  `id_categorie` int(11),
  `titre_html_categorie` varchar(255),
  `nom_categorie` varchar(100),
  `emplacement_categorie` enum('navigation','admin','langue','catalogue','hidden'),
  `actif_categorie` enum('O','1'),
  `position_categorie` int(3),
  `droit_categorie` char(4),
  `langues_id_langue` int(11),
  `types_contenus_id_type_contenu` int(11),
  `categorie_max_par_page` int(11)
) ENGINE=MyISAM */;
SET character_set_client = @saved_cs_client;

--
-- Temporary table structure for view `view_pro_sous_menu`
--

DROP TABLE IF EXISTS `view_pro_sous_menu`;
/*!50001 DROP VIEW IF EXISTS `view_pro_sous_menu`*/;
SET @saved_cs_client     = @@character_set_client;
SET character_set_client = utf8;
/*!50001 CREATE TABLE `view_pro_sous_menu` (
  `id_sous_categorie` int(11),
  `nom_sous_categorie` varchar(200),
  `emplacement_sous_categorie` enum('sous_navigation','sous_admin','sous_langue','sous_catalogue','sous_hidden'),
  `actif_sous_categorie` enum('0','1'),
  `position_sous_categorie` int(3),
  `droit_sous_categorie` char(4),
  `categories_id_categorie` int(11),
  `langues_id_langue` int(11),
  `types_contenus_id_type_contenu` int(11),
  `sous_categorie_max_par_page` int(11)
) ENGINE=MyISAM */;
SET character_set_client = @saved_cs_client;

--
-- Temporary table structure for view `view_user_contenus`
--

DROP TABLE IF EXISTS `view_user_contenus`;
/*!50001 DROP VIEW IF EXISTS `view_user_contenus`*/;
SET @saved_cs_client     = @@character_set_client;
SET character_set_client = utf8;
/*!50001 CREATE TABLE `view_user_contenus` (
  `id_contenu` int(11),
  `titre_html` varchar(100),
  `titre` varchar(100),
  `sous_titre` varchar(255),
  `contenu` longtext,
  `position_contenu` int(11),
  `actif_contenu` enum('0','1'),
  `droit_contenu` enum('U','UP','UPE','UPEA'),
  `websites_id_website` int(11),
  `id_categorie` int(11),
  `id_type_contenu` int(11),
  `nom_type_contenu` varchar(45),
  `langues_id_langue` int(11)
) ENGINE=MyISAM */;
SET character_set_client = @saved_cs_client;

--
-- Temporary table structure for view `view_user_menu`
--

DROP TABLE IF EXISTS `view_user_menu`;
/*!50001 DROP VIEW IF EXISTS `view_user_menu`*/;
SET @saved_cs_client     = @@character_set_client;
SET character_set_client = utf8;
/*!50001 CREATE TABLE `view_user_menu` (
  `id_categorie` int(11),
  `titre_html_categorie` varchar(255),
  `nom_categorie` varchar(100),
  `emplacement_categorie` enum('navigation','admin','langue','catalogue','hidden'),
  `actif_categorie` enum('O','1'),
  `position_categorie` int(3),
  `droit_categorie` char(4),
  `langues_id_langue` int(11),
  `types_contenus_id_type_contenu` int(11),
  `categorie_max_par_page` int(11)
) ENGINE=MyISAM */;
SET character_set_client = @saved_cs_client;

--
-- Table structure for table `villes`
--

DROP TABLE IF EXISTS `villes`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `villes` (
  `id_ville` int(11) NOT NULL AUTO_INCREMENT,
  `npa_ville` int(4) NOT NULL,
  `nom_ville` varchar(200) NOT NULL,
  `code_canton` varchar(2) NOT NULL,
  `pays_id_pays` int(11) NOT NULL,
  PRIMARY KEY (`id_ville`),
  KEY `fk_villes_pays` (`pays_id_pays`),
  CONSTRAINT `fk_villes_pays` FOREIGN KEY (`pays_id_pays`) REFERENCES `pays` (`id_pays`) ON DELETE CASCADE ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `villes`
--

LOCK TABLES `villes` WRITE;
/*!40000 ALTER TABLE `villes` DISABLE KEYS */;
/*!40000 ALTER TABLE `villes` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `websites`
--

DROP TABLE IF EXISTS `websites`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `websites` (
  `id_website` int(11) NOT NULL AUTO_INCREMENT,
  `nom` varchar(45) NOT NULL,
  `adresse_1` varchar(255) DEFAULT NULL,
  `adresse_2` varchar(255) DEFAULT NULL,
  `npa` int(4) DEFAULT NULL,
  `ville` varchar(100) DEFAULT NULL,
  `tel` varchar(18) DEFAULT NULL,
  `mobile` varchar(18) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id_website`),
  UNIQUE KEY `nom_UNIQUE` (`nom`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `websites`
--

LOCK TABLES `websites` WRITE;
/*!40000 ALTER TABLE `websites` DISABLE KEYS */;
INSERT INTO `websites` VALUES (1,'Yungi_design','Rue Etraz 2',NULL,1003,'Lausanne','(0041) 77 484 31','(0041) 77 484 31','ygyongy@gmail.com');
/*!40000 ALTER TABLE `websites` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Final view structure for view `view_admin_contenus`
--

/*!50001 DROP TABLE IF EXISTS `view_admin_contenus`*/;
/*!50001 DROP VIEW IF EXISTS `view_admin_contenus`*/;
/*!50001 SET @saved_cs_client          = @@character_set_client */;
/*!50001 SET @saved_cs_results         = @@character_set_results */;
/*!50001 SET @saved_col_connection     = @@collation_connection */;
/*!50001 SET character_set_client      = utf8 */;
/*!50001 SET character_set_results     = utf8 */;
/*!50001 SET collation_connection      = utf8_general_ci */;
/*!50001 CREATE ALGORITHM=UNDEFINED */
/*!50013 DEFINER=`root`@`localhost` SQL SECURITY DEFINER */
/*!50001 VIEW `view_admin_contenus` AS select `cont`.`id_contenu` AS `id_contenu`,`cont`.`titre_html` AS `titre_html`,`cont`.`titre` AS `titre`,`cont`.`sous_titre` AS `sous_titre`,`cont`.`contenu` AS `contenu`,`cont`.`position_contenu` AS `position_contenu`,`cont`.`actif_contenu` AS `actif_contenu`,`cont`.`droit_contenu` AS `droit_contenu`,`cont`.`websites_id_website` AS `websites_id_website`,`cat`.`id_categorie` AS `id_categorie`,`cont`.`sous_categories_id_sous_categorie` AS `sous_categories_id_sous_categorie`,`t`.`id_type_contenu` AS `id_type_contenu`,`t`.`nom_type_contenu` AS `nom_type_contenu`,`cont`.`langues_id_langue` AS `langues_id_langue` from (((`categories` `cat` join `contenus` `cont`) join `langues` `l`) join `types_contenus` `t`) where ((`cat`.`id_categorie` = `cont`.`categories_id_categorie`) and (`cat`.`langues_id_langue` = `l`.`id_langue`) and (`cont`.`actif_contenu` <> '0') and (isnull(`cont`.`droit_contenu`) or (`cont`.`droit_contenu` = 'UPEA') or (`cont`.`droit_contenu` = 'UPE') or (`cont`.`droit_contenu` = 'UP') or (`cont`.`droit_contenu` = 'U')) and (`cat`.`langues_id_langue` = `cont`.`langues_id_langue`) and (`t`.`id_type_contenu` = `cont`.`types_contenus_id_types_contenus`)) order by `cont`.`position_contenu` */;
/*!50001 SET character_set_client      = @saved_cs_client */;
/*!50001 SET character_set_results     = @saved_cs_results */;
/*!50001 SET collation_connection      = @saved_col_connection */;

--
-- Final view structure for view `view_admin_menu`
--

/*!50001 DROP TABLE IF EXISTS `view_admin_menu`*/;
/*!50001 DROP VIEW IF EXISTS `view_admin_menu`*/;
/*!50001 SET @saved_cs_client          = @@character_set_client */;
/*!50001 SET @saved_cs_results         = @@character_set_results */;
/*!50001 SET @saved_col_connection     = @@collation_connection */;
/*!50001 SET character_set_client      = utf8 */;
/*!50001 SET character_set_results     = utf8 */;
/*!50001 SET collation_connection      = utf8_general_ci */;
/*!50001 CREATE ALGORITHM=UNDEFINED */
/*!50013 DEFINER=`root`@`localhost` SQL SECURITY DEFINER */
/*!50001 VIEW `view_admin_menu` AS select `c`.`id_categorie` AS `id_categorie`,`c`.`titre_html_categorie` AS `titre_html_categorie`,`c`.`nom_categorie` AS `nom_categorie`,`c`.`emplacement_categorie` AS `emplacement_categorie`,`c`.`actif_categorie` AS `actif_categorie`,`c`.`position_categorie` AS `position_categorie`,`c`.`droit_categorie` AS `droit_categorie`,`c`.`langues_id_langue` AS `langues_id_langue`,`c`.`types_contenus_id_type_contenu` AS `types_contenus_id_type_contenu`,`c`.`categorie_max_par_page` AS `categorie_max_par_page` from `categories` `c` where ((`c`.`droit_categorie` = 'UPEA') or (`c`.`droit_categorie` = 'UPE') or (`c`.`droit_categorie` = 'UP') or (`c`.`droit_categorie` = 'U') or (isnull(`c`.`droit_categorie`) and (`c`.`actif_categorie` <> '0'))) order by `c`.`position_categorie` */;
/*!50001 SET character_set_client      = @saved_cs_client */;
/*!50001 SET character_set_results     = @saved_cs_results */;
/*!50001 SET collation_connection      = @saved_col_connection */;

--
-- Final view structure for view `view_admin_sous_menu`
--

/*!50001 DROP TABLE IF EXISTS `view_admin_sous_menu`*/;
/*!50001 DROP VIEW IF EXISTS `view_admin_sous_menu`*/;
/*!50001 SET @saved_cs_client          = @@character_set_client */;
/*!50001 SET @saved_cs_results         = @@character_set_results */;
/*!50001 SET @saved_col_connection     = @@collation_connection */;
/*!50001 SET character_set_client      = utf8 */;
/*!50001 SET character_set_results     = utf8 */;
/*!50001 SET collation_connection      = utf8_general_ci */;
/*!50001 CREATE ALGORITHM=UNDEFINED */
/*!50013 DEFINER=`root`@`localhost` SQL SECURITY DEFINER */
/*!50001 VIEW `view_admin_sous_menu` AS select `sc`.`id_sous_categorie` AS `id_sous_categorie`,`sc`.`nom_sous_categorie` AS `nom_sous_categorie`,`sc`.`emplacement_sous_categorie` AS `emplacement_sous_categorie`,`sc`.`actif_sous_categorie` AS `actif_sous_categorie`,`sc`.`position_sous_categorie` AS `position_sous_categorie`,`sc`.`droit_sous_categorie` AS `droit_sous_categorie`,`sc`.`categories_id_categorie` AS `categories_id_categorie`,`sc`.`langues_id_langue` AS `langues_id_langue`,`sc`.`types_contenus_id_type_contenu` AS `types_contenus_id_type_contenu`,`sc`.`sous_categorie_max_par_page` AS `sous_categorie_max_par_page` from `sous_categories` `sc` where ((`sc`.`droit_sous_categorie` = 'UPEA') or (`sc`.`droit_sous_categorie` = 'UPE') or (`sc`.`droit_sous_categorie` = 'UP') or (`sc`.`droit_sous_categorie` = 'U') or (isnull(`sc`.`droit_sous_categorie`) and (`sc`.`actif_sous_categorie` <> '0'))) order by `sc`.`position_sous_categorie` */;
/*!50001 SET character_set_client      = @saved_cs_client */;
/*!50001 SET character_set_results     = @saved_cs_results */;
/*!50001 SET collation_connection      = @saved_col_connection */;

--
-- Final view structure for view `view_anonymous_contenus`
--

/*!50001 DROP TABLE IF EXISTS `view_anonymous_contenus`*/;
/*!50001 DROP VIEW IF EXISTS `view_anonymous_contenus`*/;
/*!50001 SET @saved_cs_client          = @@character_set_client */;
/*!50001 SET @saved_cs_results         = @@character_set_results */;
/*!50001 SET @saved_col_connection     = @@collation_connection */;
/*!50001 SET character_set_client      = utf8 */;
/*!50001 SET character_set_results     = utf8 */;
/*!50001 SET collation_connection      = utf8_general_ci */;
/*!50001 CREATE ALGORITHM=UNDEFINED */
/*!50013 DEFINER=`root`@`localhost` SQL SECURITY DEFINER */
/*!50001 VIEW `view_anonymous_contenus` AS select `cont`.`id_contenu` AS `id_contenu`,`cont`.`titre_html` AS `titre_html`,`cont`.`titre_url` AS `titre_url`,`cont`.`titre` AS `titre`,`cont`.`sous_titre` AS `sous_titre`,`cont`.`contenu` AS `contenu`,`cont`.`position_contenu` AS `position_contenu`,`cont`.`actif_contenu` AS `actif_contenu`,`cont`.`droit_contenu` AS `droit_contenu`,`cont`.`websites_id_website` AS `websites_id_website`,`cont`.`sous_categories_id_sous_categorie` AS `sous_categories_id_sous_categorie`,`cont`.`categories_id_categorie` AS `categories_id_categorie`,`cat`.`types_contenus_id_type_contenu` AS `cat_type_contenu`,`cat`.`categorie_max_par_page` AS `cat_max_par_page`,`cont`.`types_contenus_id_types_contenus` AS `cont_type_contenu`,`cont`.`langues_id_langue` AS `langues_id_langue` from (((`categories` `cat` join `contenus` `cont`) join `langues` `l`) join `types_contenus` `t`) where ((`cat`.`id_categorie` = `cont`.`categories_id_categorie`) and (`cat`.`langues_id_langue` = `l`.`id_langue`) and (`cont`.`actif_contenu` <> '0') and isnull(`cont`.`droit_contenu`) and (`cat`.`langues_id_langue` = `cont`.`langues_id_langue`) and (`t`.`id_type_contenu` = `cont`.`types_contenus_id_types_contenus`)) order by `cont`.`position_contenu` */;
/*!50001 SET character_set_client      = @saved_cs_client */;
/*!50001 SET character_set_results     = @saved_cs_results */;
/*!50001 SET collation_connection      = @saved_col_connection */;

--
-- Final view structure for view `view_anonymous_menu`
--

/*!50001 DROP TABLE IF EXISTS `view_anonymous_menu`*/;
/*!50001 DROP VIEW IF EXISTS `view_anonymous_menu`*/;
/*!50001 SET @saved_cs_client          = @@character_set_client */;
/*!50001 SET @saved_cs_results         = @@character_set_results */;
/*!50001 SET @saved_col_connection     = @@collation_connection */;
/*!50001 SET character_set_client      = utf8 */;
/*!50001 SET character_set_results     = utf8 */;
/*!50001 SET collation_connection      = utf8_general_ci */;
/*!50001 CREATE ALGORITHM=UNDEFINED */
/*!50013 DEFINER=`root`@`localhost` SQL SECURITY DEFINER */
/*!50001 VIEW `view_anonymous_menu` AS select `c`.`id_categorie` AS `id_categorie`,`c`.`titre_html_categorie` AS `titre_html_categorie`,`c`.`nom_categorie` AS `nom_categorie`,`c`.`emplacement_categorie` AS `emplacement_categorie`,`c`.`actif_categorie` AS `actif_categorie`,`c`.`position_categorie` AS `position_categorie`,`c`.`droit_categorie` AS `droit_categorie`,`c`.`langues_id_langue` AS `langues_id_langue`,`c`.`types_contenus_id_type_contenu` AS `types_contenus_id_type_contenu`,`c`.`categorie_max_par_page` AS `categorie_max_par_page`,`t`.`id_type_contenu` AS `id_type_contenu`,`t`.`nom_type_contenu` AS `nom_type_contenu`,`t`.`actif_type_contenu` AS `actif_type_contenu` from (`categories` `c` join `types_contenus` `t`) where (isnull(`c`.`droit_categorie`) and (`c`.`actif_categorie` <> '0') and (`c`.`types_contenus_id_type_contenu` = `t`.`id_type_contenu`)) order by `c`.`position_categorie` */;
/*!50001 SET character_set_client      = @saved_cs_client */;
/*!50001 SET character_set_results     = @saved_cs_results */;
/*!50001 SET collation_connection      = @saved_col_connection */;

--
-- Final view structure for view `view_anonymous_sous_menu`
--

/*!50001 DROP TABLE IF EXISTS `view_anonymous_sous_menu`*/;
/*!50001 DROP VIEW IF EXISTS `view_anonymous_sous_menu`*/;
/*!50001 SET @saved_cs_client          = @@character_set_client */;
/*!50001 SET @saved_cs_results         = @@character_set_results */;
/*!50001 SET @saved_col_connection     = @@collation_connection */;
/*!50001 SET character_set_client      = utf8 */;
/*!50001 SET character_set_results     = utf8 */;
/*!50001 SET collation_connection      = utf8_general_ci */;
/*!50001 CREATE ALGORITHM=UNDEFINED */
/*!50013 DEFINER=`root`@`localhost` SQL SECURITY DEFINER */
/*!50001 VIEW `view_anonymous_sous_menu` AS select `sc`.`id_sous_categorie` AS `id_sous_categorie`,`sc`.`nom_sous_categorie` AS `nom_sous_categorie`,`sc`.`emplacement_sous_categorie` AS `emplacement_sous_categorie`,`sc`.`actif_sous_categorie` AS `actif_sous_categorie`,`sc`.`position_sous_categorie` AS `position_sous_categorie`,`sc`.`droit_sous_categorie` AS `droit_sous_categorie`,`sc`.`categories_id_categorie` AS `categories_id_categorie`,`sc`.`langues_id_langue` AS `langues_id_langue`,`sc`.`types_contenus_id_type_contenu` AS `types_contenus_id_type_contenu`,`sc`.`sous_categorie_max_par_page` AS `sous_categorie_max_par_page` from `sous_categories` `sc` where (isnull(`sc`.`droit_sous_categorie`) and (`sc`.`actif_sous_categorie` <> '0')) order by `sc`.`position_sous_categorie` */;
/*!50001 SET character_set_client      = @saved_cs_client */;
/*!50001 SET character_set_results     = @saved_cs_results */;
/*!50001 SET collation_connection      = @saved_col_connection */;

--
-- Final view structure for view `view_editeur_contenus`
--

/*!50001 DROP TABLE IF EXISTS `view_editeur_contenus`*/;
/*!50001 DROP VIEW IF EXISTS `view_editeur_contenus`*/;
/*!50001 SET @saved_cs_client          = @@character_set_client */;
/*!50001 SET @saved_cs_results         = @@character_set_results */;
/*!50001 SET @saved_col_connection     = @@collation_connection */;
/*!50001 SET character_set_client      = utf8 */;
/*!50001 SET character_set_results     = utf8 */;
/*!50001 SET collation_connection      = utf8_general_ci */;
/*!50001 CREATE ALGORITHM=UNDEFINED */
/*!50013 DEFINER=`root`@`localhost` SQL SECURITY DEFINER */
/*!50001 VIEW `view_editeur_contenus` AS select `cont`.`id_contenu` AS `id_contenu`,`cont`.`titre_html` AS `titre_html`,`cont`.`titre` AS `titre`,`cont`.`sous_titre` AS `sous_titre`,`cont`.`contenu` AS `contenu`,`cont`.`position_contenu` AS `position_contenu`,`cont`.`actif_contenu` AS `actif_contenu`,`cont`.`droit_contenu` AS `droit_contenu`,`cont`.`websites_id_website` AS `websites_id_website`,`cat`.`id_categorie` AS `id_categorie`,`t`.`id_type_contenu` AS `id_type_contenu`,`t`.`nom_type_contenu` AS `nom_type_contenu`,`cont`.`langues_id_langue` AS `langues_id_langue` from (((`categories` `cat` join `contenus` `cont`) join `langues` `l`) join `types_contenus` `t`) where ((`cat`.`id_categorie` = `cont`.`categories_id_categorie`) and (`cat`.`langues_id_langue` = `l`.`id_langue`) and (`cont`.`actif_contenu` <> '0') and (isnull(`cont`.`droit_contenu`) or (`cont`.`droit_contenu` = 'UPE') or (`cont`.`droit_contenu` = 'UP') or (`cont`.`droit_contenu` = 'U')) and (`cat`.`langues_id_langue` = `cont`.`langues_id_langue`) and (`t`.`id_type_contenu` = `cont`.`types_contenus_id_types_contenus`)) order by `cont`.`position_contenu` */;
/*!50001 SET character_set_client      = @saved_cs_client */;
/*!50001 SET character_set_results     = @saved_cs_results */;
/*!50001 SET collation_connection      = @saved_col_connection */;

--
-- Final view structure for view `view_editeur_menu`
--

/*!50001 DROP TABLE IF EXISTS `view_editeur_menu`*/;
/*!50001 DROP VIEW IF EXISTS `view_editeur_menu`*/;
/*!50001 SET @saved_cs_client          = @@character_set_client */;
/*!50001 SET @saved_cs_results         = @@character_set_results */;
/*!50001 SET @saved_col_connection     = @@collation_connection */;
/*!50001 SET character_set_client      = utf8 */;
/*!50001 SET character_set_results     = utf8 */;
/*!50001 SET collation_connection      = utf8_general_ci */;
/*!50001 CREATE ALGORITHM=UNDEFINED */
/*!50013 DEFINER=`root`@`localhost` SQL SECURITY DEFINER */
/*!50001 VIEW `view_editeur_menu` AS select `c`.`id_categorie` AS `id_categorie`,`c`.`titre_html_categorie` AS `titre_html_categorie`,`c`.`nom_categorie` AS `nom_categorie`,`c`.`emplacement_categorie` AS `emplacement_categorie`,`c`.`actif_categorie` AS `actif_categorie`,`c`.`position_categorie` AS `position_categorie`,`c`.`droit_categorie` AS `droit_categorie`,`c`.`langues_id_langue` AS `langues_id_langue`,`c`.`types_contenus_id_type_contenu` AS `types_contenus_id_type_contenu`,`c`.`categorie_max_par_page` AS `categorie_max_par_page` from `categories` `c` where ((`c`.`droit_categorie` = 'UPE') or (`c`.`droit_categorie` = 'UP') or (`c`.`droit_categorie` = 'U') or (isnull(`c`.`droit_categorie`) and (`c`.`actif_categorie` <> '0'))) order by `c`.`position_categorie` */;
/*!50001 SET character_set_client      = @saved_cs_client */;
/*!50001 SET character_set_results     = @saved_cs_results */;
/*!50001 SET collation_connection      = @saved_col_connection */;

--
-- Final view structure for view `view_editeur_sous_menu`
--

/*!50001 DROP TABLE IF EXISTS `view_editeur_sous_menu`*/;
/*!50001 DROP VIEW IF EXISTS `view_editeur_sous_menu`*/;
/*!50001 SET @saved_cs_client          = @@character_set_client */;
/*!50001 SET @saved_cs_results         = @@character_set_results */;
/*!50001 SET @saved_col_connection     = @@collation_connection */;
/*!50001 SET character_set_client      = utf8 */;
/*!50001 SET character_set_results     = utf8 */;
/*!50001 SET collation_connection      = utf8_general_ci */;
/*!50001 CREATE ALGORITHM=UNDEFINED */
/*!50013 DEFINER=`root`@`localhost` SQL SECURITY DEFINER */
/*!50001 VIEW `view_editeur_sous_menu` AS select `sc`.`id_sous_categorie` AS `id_sous_categorie`,`sc`.`nom_sous_categorie` AS `nom_sous_categorie`,`sc`.`emplacement_sous_categorie` AS `emplacement_sous_categorie`,`sc`.`actif_sous_categorie` AS `actif_sous_categorie`,`sc`.`position_sous_categorie` AS `position_sous_categorie`,`sc`.`droit_sous_categorie` AS `droit_sous_categorie`,`sc`.`categories_id_categorie` AS `categories_id_categorie`,`sc`.`langues_id_langue` AS `langues_id_langue`,`sc`.`types_contenus_id_type_contenu` AS `types_contenus_id_type_contenu`,`sc`.`sous_categorie_max_par_page` AS `sous_categorie_max_par_page` from `sous_categories` `sc` where ((`sc`.`droit_sous_categorie` = 'UPE') or (`sc`.`droit_sous_categorie` = 'UP') or (`sc`.`droit_sous_categorie` = 'U') or (isnull(`sc`.`droit_sous_categorie`) and (`sc`.`actif_sous_categorie` <> '0'))) order by `sc`.`position_sous_categorie` */;
/*!50001 SET character_set_client      = @saved_cs_client */;
/*!50001 SET character_set_results     = @saved_cs_results */;
/*!50001 SET collation_connection      = @saved_col_connection */;

--
-- Final view structure for view `view_pro_contenus`
--

/*!50001 DROP TABLE IF EXISTS `view_pro_contenus`*/;
/*!50001 DROP VIEW IF EXISTS `view_pro_contenus`*/;
/*!50001 SET @saved_cs_client          = @@character_set_client */;
/*!50001 SET @saved_cs_results         = @@character_set_results */;
/*!50001 SET @saved_col_connection     = @@collation_connection */;
/*!50001 SET character_set_client      = utf8 */;
/*!50001 SET character_set_results     = utf8 */;
/*!50001 SET collation_connection      = utf8_general_ci */;
/*!50001 CREATE ALGORITHM=UNDEFINED */
/*!50013 DEFINER=`root`@`localhost` SQL SECURITY DEFINER */
/*!50001 VIEW `view_pro_contenus` AS select `cont`.`id_contenu` AS `id_contenu`,`cont`.`titre_html` AS `titre_html`,`cont`.`titre` AS `titre`,`cont`.`sous_titre` AS `sous_titre`,`cont`.`contenu` AS `contenu`,`cont`.`position_contenu` AS `position_contenu`,`cont`.`actif_contenu` AS `actif_contenu`,`cont`.`droit_contenu` AS `droit_contenu`,`cont`.`websites_id_website` AS `websites_id_website`,`cat`.`id_categorie` AS `id_categorie`,`t`.`id_type_contenu` AS `id_type_contenu`,`t`.`nom_type_contenu` AS `nom_type_contenu`,`cont`.`langues_id_langue` AS `langues_id_langue` from (((`categories` `cat` join `contenus` `cont`) join `langues` `l`) join `types_contenus` `t`) where ((`cat`.`id_categorie` = `cont`.`categories_id_categorie`) and (`cat`.`langues_id_langue` = `l`.`id_langue`) and (`cont`.`actif_contenu` <> '0') and (isnull(`cont`.`droit_contenu`) or (`cont`.`droit_contenu` = 'UP') or (`cont`.`droit_contenu` = 'U')) and (`cat`.`langues_id_langue` = `cont`.`langues_id_langue`) and (`t`.`id_type_contenu` = `cont`.`types_contenus_id_types_contenus`)) order by `cont`.`position_contenu` */;
/*!50001 SET character_set_client      = @saved_cs_client */;
/*!50001 SET character_set_results     = @saved_cs_results */;
/*!50001 SET collation_connection      = @saved_col_connection */;

--
-- Final view structure for view `view_pro_menu`
--

/*!50001 DROP TABLE IF EXISTS `view_pro_menu`*/;
/*!50001 DROP VIEW IF EXISTS `view_pro_menu`*/;
/*!50001 SET @saved_cs_client          = @@character_set_client */;
/*!50001 SET @saved_cs_results         = @@character_set_results */;
/*!50001 SET @saved_col_connection     = @@collation_connection */;
/*!50001 SET character_set_client      = utf8 */;
/*!50001 SET character_set_results     = utf8 */;
/*!50001 SET collation_connection      = utf8_general_ci */;
/*!50001 CREATE ALGORITHM=UNDEFINED */
/*!50013 DEFINER=`root`@`localhost` SQL SECURITY DEFINER */
/*!50001 VIEW `view_pro_menu` AS select `c`.`id_categorie` AS `id_categorie`,`c`.`titre_html_categorie` AS `titre_html_categorie`,`c`.`nom_categorie` AS `nom_categorie`,`c`.`emplacement_categorie` AS `emplacement_categorie`,`c`.`actif_categorie` AS `actif_categorie`,`c`.`position_categorie` AS `position_categorie`,`c`.`droit_categorie` AS `droit_categorie`,`c`.`langues_id_langue` AS `langues_id_langue`,`c`.`types_contenus_id_type_contenu` AS `types_contenus_id_type_contenu`,`c`.`categorie_max_par_page` AS `categorie_max_par_page` from `categories` `c` where ((`c`.`droit_categorie` = 'UP') or (`c`.`droit_categorie` = 'U') or (isnull(`c`.`droit_categorie`) and (`c`.`actif_categorie` <> '0'))) order by `c`.`position_categorie` */;
/*!50001 SET character_set_client      = @saved_cs_client */;
/*!50001 SET character_set_results     = @saved_cs_results */;
/*!50001 SET collation_connection      = @saved_col_connection */;

--
-- Final view structure for view `view_pro_sous_menu`
--

/*!50001 DROP TABLE IF EXISTS `view_pro_sous_menu`*/;
/*!50001 DROP VIEW IF EXISTS `view_pro_sous_menu`*/;
/*!50001 SET @saved_cs_client          = @@character_set_client */;
/*!50001 SET @saved_cs_results         = @@character_set_results */;
/*!50001 SET @saved_col_connection     = @@collation_connection */;
/*!50001 SET character_set_client      = utf8 */;
/*!50001 SET character_set_results     = utf8 */;
/*!50001 SET collation_connection      = utf8_general_ci */;
/*!50001 CREATE ALGORITHM=UNDEFINED */
/*!50013 DEFINER=`root`@`localhost` SQL SECURITY DEFINER */
/*!50001 VIEW `view_pro_sous_menu` AS select `sc`.`id_sous_categorie` AS `id_sous_categorie`,`sc`.`nom_sous_categorie` AS `nom_sous_categorie`,`sc`.`emplacement_sous_categorie` AS `emplacement_sous_categorie`,`sc`.`actif_sous_categorie` AS `actif_sous_categorie`,`sc`.`position_sous_categorie` AS `position_sous_categorie`,`sc`.`droit_sous_categorie` AS `droit_sous_categorie`,`sc`.`categories_id_categorie` AS `categories_id_categorie`,`sc`.`langues_id_langue` AS `langues_id_langue`,`sc`.`types_contenus_id_type_contenu` AS `types_contenus_id_type_contenu`,`sc`.`sous_categorie_max_par_page` AS `sous_categorie_max_par_page` from `sous_categories` `sc` where ((`sc`.`droit_sous_categorie` = 'UP') or (`sc`.`droit_sous_categorie` = 'U') or (isnull(`sc`.`droit_sous_categorie`) and (`sc`.`actif_sous_categorie` <> '0'))) order by `sc`.`position_sous_categorie` */;
/*!50001 SET character_set_client      = @saved_cs_client */;
/*!50001 SET character_set_results     = @saved_cs_results */;
/*!50001 SET collation_connection      = @saved_col_connection */;

--
-- Final view structure for view `view_user_contenus`
--

/*!50001 DROP TABLE IF EXISTS `view_user_contenus`*/;
/*!50001 DROP VIEW IF EXISTS `view_user_contenus`*/;
/*!50001 SET @saved_cs_client          = @@character_set_client */;
/*!50001 SET @saved_cs_results         = @@character_set_results */;
/*!50001 SET @saved_col_connection     = @@collation_connection */;
/*!50001 SET character_set_client      = utf8 */;
/*!50001 SET character_set_results     = utf8 */;
/*!50001 SET collation_connection      = utf8_general_ci */;
/*!50001 CREATE ALGORITHM=UNDEFINED */
/*!50013 DEFINER=`root`@`localhost` SQL SECURITY DEFINER */
/*!50001 VIEW `view_user_contenus` AS select `cont`.`id_contenu` AS `id_contenu`,`cont`.`titre_html` AS `titre_html`,`cont`.`titre` AS `titre`,`cont`.`sous_titre` AS `sous_titre`,`cont`.`contenu` AS `contenu`,`cont`.`position_contenu` AS `position_contenu`,`cont`.`actif_contenu` AS `actif_contenu`,`cont`.`droit_contenu` AS `droit_contenu`,`cont`.`websites_id_website` AS `websites_id_website`,`cat`.`id_categorie` AS `id_categorie`,`t`.`id_type_contenu` AS `id_type_contenu`,`t`.`nom_type_contenu` AS `nom_type_contenu`,`cont`.`langues_id_langue` AS `langues_id_langue` from (((`categories` `cat` join `contenus` `cont`) join `langues` `l`) join `types_contenus` `t`) where ((`cat`.`id_categorie` = `cont`.`categories_id_categorie`) and (`cat`.`langues_id_langue` = `l`.`id_langue`) and (`cont`.`actif_contenu` <> '0') and (isnull(`cont`.`droit_contenu`) or (`cont`.`droit_contenu` = 'U')) and (`cat`.`langues_id_langue` = `cont`.`langues_id_langue`) and (`t`.`id_type_contenu` = `cont`.`types_contenus_id_types_contenus`)) order by `cont`.`position_contenu` */;
/*!50001 SET character_set_client      = @saved_cs_client */;
/*!50001 SET character_set_results     = @saved_cs_results */;
/*!50001 SET collation_connection      = @saved_col_connection */;

--
-- Final view structure for view `view_user_menu`
--

/*!50001 DROP TABLE IF EXISTS `view_user_menu`*/;
/*!50001 DROP VIEW IF EXISTS `view_user_menu`*/;
/*!50001 SET @saved_cs_client          = @@character_set_client */;
/*!50001 SET @saved_cs_results         = @@character_set_results */;
/*!50001 SET @saved_col_connection     = @@collation_connection */;
/*!50001 SET character_set_client      = utf8 */;
/*!50001 SET character_set_results     = utf8 */;
/*!50001 SET collation_connection      = utf8_general_ci */;
/*!50001 CREATE ALGORITHM=UNDEFINED */
/*!50013 DEFINER=`root`@`localhost` SQL SECURITY DEFINER */
/*!50001 VIEW `view_user_menu` AS select `c`.`id_categorie` AS `id_categorie`,`c`.`titre_html_categorie` AS `titre_html_categorie`,`c`.`nom_categorie` AS `nom_categorie`,`c`.`emplacement_categorie` AS `emplacement_categorie`,`c`.`actif_categorie` AS `actif_categorie`,`c`.`position_categorie` AS `position_categorie`,`c`.`droit_categorie` AS `droit_categorie`,`c`.`langues_id_langue` AS `langues_id_langue`,`c`.`types_contenus_id_type_contenu` AS `types_contenus_id_type_contenu`,`c`.`categorie_max_par_page` AS `categorie_max_par_page` from `categories` `c` where ((`c`.`droit_categorie` = 'U') or (isnull(`c`.`droit_categorie`) and (`c`.`actif_categorie` <> '0'))) order by `c`.`position_categorie` */;
/*!50001 SET character_set_client      = @saved_cs_client */;
/*!50001 SET character_set_results     = @saved_cs_results */;
/*!50001 SET collation_connection      = @saved_col_connection */;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2013-02-15 13:44:18
