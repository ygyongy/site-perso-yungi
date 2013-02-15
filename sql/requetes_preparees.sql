/*
---------- CONNEXION A MYSQL EN LIGNE DE COMMANDES -----------
*/
# mysql -u root -p

mysql> use site_perso_yungi

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

/*Suppresion de la procédure préparée*/
DROP PREPARE myQuery;


/*
---------- CREATION D UNE PROCEDURE STOCKEE MYSQL -----------
*/