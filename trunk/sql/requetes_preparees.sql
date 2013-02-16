/*
---------- COPIE DE LA BASE DE DONNEES -----------
DEPUIS LE SHELL WAMPP - LES OPTIONS SONT "-r <NOM_DU_FICHIER>"
*/
mysqldump -u root -p --add-drop-table site_perso_yungi -r site_perso_yungi.bkp_15_02_2013.sql

/*
---------- CONNEXION A MYSQL EN LIGNE DE COMMANDES -----------
*/
# mysql -u root -p

mysql> use site_perso_yungi


/*
---------- LISTE LES TABLES DE LA BDD SAUF LES VIEWS ET LES TABLES DE "TRAVAIL" -------------
*/
SHOW TABLES WHERE tables_in_site_perso_yungi NOT LIKE "view%" AND tables_in_site_perso_yungi NOT LIKE 'pays' AND tables_in_site_perso_yungi NOT LIKE 'villes' AND tables_in_site_perso_yungi NOT LIKE '%fields%' AND tables_in_site_perso_yungi NOT LIKE '%adresses%' AND tables_in_site_perso_yungi NOT LIKE '%contacts%' AND tables_in_site_perso_yungi NOT LIKE '%fichiers%'

/*
---------- LISTING DES CLES ETRANGERES D'UNE TABLE OU DE TOUTE LA BASE ----------
*/

select 
    concat(table_name, '.', column_name) as 'foreign key',  
    concat(referenced_table_name, '.', referenced_column_name) as 'references'
from
    information_schema.key_column_usage
where
    referenced_table_name is not null;
	
/*
---------- CREATION D UNE REQUETE PREPAREE MYSQL -----------
*/
PREPARE myQuery FROM 'SELECT * FROM contenus WHERE id_contenu=?';
SET @id_contenu=1;
EXECUTE myQuery USING @id_contenu;

PREPARE myQuery FROM 'SELECT * FROM contenus WHERE id_contenu=? AND langues_id_langue=?';
SET @id_contenu=1;
SET @id_langue=1;
EXECUTE myQuery USING @id_contenu, @id_langue ;

PREPARE pays FROM 'SELECT Name FROM Country WHERE Name LIKE ?';
SET @p='%fr%';
EXECUTE pays USING @p;

/*Suppresion de la proc�dure pr�par�e*/
DROP PREPARE myQuery;


/*
---------- CREATION D UNE PROCEDURE STOCKEE MYSQL -----------
*/