
-- -----------------------------------------------------
-- Placeholder table for view `site_perso_yungi`.`view_admin_menu`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `site_perso_yungi`.`view_admin_menu` (`id_categorie` INT, `nom_categorie` INT, `emplacement_categorie` INT, `actif_categorie` INT, `position_categorie` INT, `droit_categorie` INT, `langues_id_langue` INT);

-- -----------------------------------------------------
-- Placeholder table for view `site_perso_yungi`.`view_editeur_menu`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `site_perso_yungi`.`view_editeur_menu` (`id_categorie` INT, `nom_categorie` INT, `emplacement_categorie` INT, `actif_categorie` INT, `position_categorie` INT, `droit_categorie` INT, `langues_id_langue` INT);

-- -----------------------------------------------------
-- Placeholder table for view `site_perso_yungi`.`view_pro_menu`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `site_perso_yungi`.`view_pro_menu` (`id_categorie` INT, `nom_categorie` INT, `emplacement_categorie` INT, `actif_categorie` INT, `position_categorie` INT, `droit_categorie` INT, `langues_id_langue` INT);

-- -----------------------------------------------------
-- Placeholder table for view `site_perso_yungi`.`view_user_menu`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `site_perso_yungi`.`view_user_menu` (`id_categorie` INT, `nom_categorie` INT, `emplacement_categorie` INT, `actif_categorie` INT, `position_categorie` INT, `droit_categorie` INT, `langues_id_langue` INT);

-- -----------------------------------------------------
-- Placeholder table for view `site_perso_yungi`.`view_anonymous_menu`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `site_perso_yungi`.`view_anonymous_menu` (`id_categorie` INT, `nom_categorie` INT, `emplacement_categorie` INT, `actif_categorie` INT, `position_categorie` INT, `droit_categorie` INT, `langues_id_langue` INT);

-- -----------------------------------------------------
-- Placeholder table for view `site_perso_yungi`.`view_anonymous_contenus`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `site_perso_yungi`.`view_anonymous_contenus` (`id_contenu` INT, `titre_html` INT, `titre` INT, `sous_titre` INT, `contenu` INT, `position_contenu` INT, `actif_contenu` INT, `droit_contenu` INT, `websites_id_website` INT, `id_categorie` INT, `id_type_contenu` INT, `nom_type_contenu` INT, `langues_id_langue` INT);

-- -----------------------------------------------------
-- Placeholder table for view `site_perso_yungi`.`view_admin_contenus`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `site_perso_yungi`.`view_admin_contenus` (`id_contenu` INT, `titre_html` INT, `titre` INT, `sous_titre` INT, `contenu` INT, `position_contenu` INT, `actif_contenu` INT, `droit_contenu` INT, `websites_id_website` INT, `id_categorie` INT, `id_type_contenu` INT, `nom_type_contenu` INT, `langues_id_langue` INT);

-- -----------------------------------------------------
-- Placeholder table for view `site_perso_yungi`.`view_editeur_contenus`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `site_perso_yungi`.`view_editeur_contenus` (`id_contenu` INT, `titre_html` INT, `titre` INT, `sous_titre` INT, `contenu` INT, `position_contenu` INT, `actif_contenu` INT, `droit_contenu` INT, `websites_id_website` INT, `id_categorie` INT, `id_type_contenu` INT, `nom_type_contenu` INT, `langues_id_langue` INT);

-- -----------------------------------------------------
-- Placeholder table for view `site_perso_yungi`.`view_pro_contenus`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `site_perso_yungi`.`view_pro_contenus` (`id_contenu` INT, `titre_html` INT, `titre` INT, `sous_titre` INT, `contenu` INT, `position_contenu` INT, `actif_contenu` INT, `droit_contenu` INT, `websites_id_website` INT, `id_categorie` INT, `id_type_contenu` INT, `nom_type_contenu` INT, `langues_id_langue` INT);

-- -----------------------------------------------------
-- Placeholder table for view `site_perso_yungi`.`view_user_contenus`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `site_perso_yungi`.`view_user_contenus` (`id_contenu` INT, `titre_html` INT, `titre` INT, `sous_titre` INT, `contenu` INT, `position_contenu` INT, `actif_contenu` INT, `droit_contenu` INT, `websites_id_website` INT, `id_categorie` INT, `id_type_contenu` INT, `nom_type_contenu` INT, `langues_id_langue` INT);

-- -----------------------------------------------------
-- View `site_perso_yungi`.`view_admin_menu`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `site_perso_yungi`.`view_admin_menu`;
CREATE  OR REPLACE VIEW `site_perso_yungi`.`view_admin_menu` AS
SELECT *
FROM categories c
WHERE droit_categorie = 'UPEA' 
        || droit_categorie = 'UPE' 
        || droit_categorie = 'UP' 
        || droit_categorie = 'U' 
        || droit_categorie IS NULL 
        AND actif_categorie <> '0'
ORDER BY c.position_categorie
;

-- -----------------------------------------------------
-- View `site_perso_yungi`.`view_editeur_menu`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `site_perso_yungi`.`view_editeur_menu`;
CREATE  OR REPLACE VIEW `site_perso_yungi`.`view_editeur_menu` AS
SELECT *
FROM categories c
WHERE droit_categorie = 'UPE' 
        || droit_categorie = 'UP'
        || droit_categorie = 'U'
        || droit_categorie IS NULL 
        AND actif_categorie <> '0'
ORDER BY c.position_categorie

;

-- -----------------------------------------------------
-- View `site_perso_yungi`.`view_pro_menu`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `site_perso_yungi`.`view_pro_menu`;
CREATE  OR REPLACE VIEW `site_perso_yungi`.`view_pro_menu` AS
SELECT *
FROM categories c
WHERE droit_categorie = 'UP' 
        || droit_categorie = 'U' 
        || droit_categorie IS NULL 
        AND actif_categorie <> '0'
ORDER BY c.position_categorie;

-- -----------------------------------------------------
-- View `site_perso_yungi`.`view_user_menu`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `site_perso_yungi`.`view_user_menu`;
CREATE  OR REPLACE VIEW `site_perso_yungi`.`view_user_menu` AS
SELECT *
FROM categories c
WHERE droit_categorie = 'U' 
        || droit_categorie IS NULL 
        AND actif_categorie <> '0'
ORDER BY c.position_categorie;

-- -----------------------------------------------------
-- View `site_perso_yungi`.`view_anonymous_menu`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `site_perso_yungi`.`view_anonymous_menu`;
CREATE  OR REPLACE VIEW `site_perso_yungi`.`view_anonymous_menu` AS
SELECT *
FROM categories c
WHERE droit_categorie IS NULL 
        AND actif_categorie <> '0'
ORDER BY c.position_categorie
;

-- -----------------------------------------------------
-- View `site_perso_yungi`.`view_anonymous_contenus`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `site_perso_yungi`.`view_anonymous_contenus`;
CREATE  OR REPLACE VIEW `site_perso_yungi`.`view_anonymous_contenus` AS
SELECT cont.id_contenu, cont.titre_html, cont.titre, cont.sous_titre, cont.contenu, cont.position_contenu, cont.actif_contenu, cont.droit_contenu, cont.websites_id_website, cat.id_categorie, t.id_type_contenu, t.nom_type_contenu, cont.langues_id_langue
FROM categories cat, contenus cont, langues l, types_contenus t 
WHERE cat.id_categorie = cont.categories_id_categorie 
        AND cat.langues_id_langue = l.id_langue 
        AND cont.actif_contenu <> '0' 
        AND cont.droit_contenu IS NULL 
        AND cat.langues_id_langue = cont.langues_id_langue 
        AND t.id_type_contenu = cont.types_contenus_id_types_contenus
ORDER BY cont.position_contenu;

-- -----------------------------------------------------
-- View `site_perso_yungi`.`view_admin_contenus`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `site_perso_yungi`.`view_admin_contenus`;
CREATE  OR REPLACE VIEW `site_perso_yungi`.`view_admin_contenus` AS
SELECT cont.id_contenu, cont.titre_html, cont.titre, cont.sous_titre, cont.contenu, cont.position_contenu, cont.actif_contenu, cont.droit_contenu, cont.websites_id_website, cat.id_categorie, t.id_type_contenu, t.nom_type_contenu, cont.langues_id_langue
FROM categories cat, contenus cont, langues l, types_contenus t 
WHERE cat.id_categorie = cont.categories_id_categorie 
        AND cat.langues_id_langue = l.id_langue 
        AND cont.actif_contenu <> '0' 
        AND 
            (droit_contenu IS NULL
                || droit_contenu = 'UPEA' 
                || droit_contenu = 'UPE' 
                || droit_contenu = 'UP' 
                || droit_contenu = 'U'            
            )
        AND cat.langues_id_langue = cont.langues_id_langue 
        AND t.id_type_contenu = cont.types_contenus_id_types_contenus
ORDER BY cont.position_contenu ;

-- -----------------------------------------------------
-- View `site_perso_yungi`.`view_editeur_contenus`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `site_perso_yungi`.`view_editeur_contenus`;
CREATE  OR REPLACE VIEW `site_perso_yungi`.`view_editeur_contenus` AS
SELECT cont.id_contenu, cont.titre_html, cont.titre, cont.sous_titre, cont.contenu, cont.position_contenu, cont.actif_contenu, cont.droit_contenu, cont.websites_id_website, cat.id_categorie, t.id_type_contenu, t.nom_type_contenu, cont.langues_id_langue
FROM categories cat, contenus cont, langues l, types_contenus t 
WHERE cat.id_categorie = cont.categories_id_categorie 
        AND cat.langues_id_langue = l.id_langue 
        AND cont.actif_contenu <> '0' 
        AND 
            (droit_contenu IS NULL
                || droit_contenu = 'UPE' 
                || droit_contenu = 'UP' 
                || droit_contenu = 'U'            
            )
        AND cat.langues_id_langue = cont.langues_id_langue 
        AND t.id_type_contenu = cont.types_contenus_id_types_contenus
ORDER BY cont.position_contenu ;

-- -----------------------------------------------------
-- View `site_perso_yungi`.`view_pro_contenus`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `site_perso_yungi`.`view_pro_contenus`;
CREATE  OR REPLACE VIEW `site_perso_yungi`.`view_pro_contenus` AS
SELECT cont.id_contenu, cont.titre_html, cont.titre, cont.sous_titre, cont.contenu, cont.position_contenu, cont.actif_contenu, cont.droit_contenu, cont.websites_id_website, cat.id_categorie, t.id_type_contenu, t.nom_type_contenu, cont.langues_id_langue
FROM categories cat, contenus cont, langues l, types_contenus t 
WHERE cat.id_categorie = cont.categories_id_categorie 
        AND cat.langues_id_langue = l.id_langue 
        AND cont.actif_contenu <> '0' 
        AND 
            (droit_contenu IS NULL
                || droit_contenu = 'UP' 
                || droit_contenu = 'U'            
            )
        AND cat.langues_id_langue = cont.langues_id_langue 
        AND t.id_type_contenu = cont.types_contenus_id_types_contenus
ORDER BY cont.position_contenu ;

-- -----------------------------------------------------
-- View `site_perso_yungi`.`view_user_contenus`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `site_perso_yungi`.`view_user_contenus`;
CREATE  OR REPLACE VIEW `site_perso_yungi`.`view_user_contenus` AS
SELECT cont.id_contenu, cont.titre_html, cont.titre, cont.sous_titre, cont.contenu, cont.position_contenu, cont.actif_contenu, cont.droit_contenu, cont.websites_id_website, cat.id_categorie, t.id_type_contenu, t.nom_type_contenu, cont.langues_id_langue
FROM categories cat, contenus cont, langues l, types_contenus t 
WHERE cat.id_categorie = cont.categories_id_categorie 
        AND cat.langues_id_langue = l.id_langue 
        AND cont.actif_contenu <> '0' 
        AND 
            (droit_contenu IS NULL 
                || droit_contenu = 'U'            
            )
        AND cat.langues_id_langue = cont.langues_id_langue 
        AND t.id_type_contenu = cont.types_contenus_id_types_contenus
ORDER BY cont.position_contenu ;