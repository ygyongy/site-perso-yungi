CREATE TRIGGER insert_users
	BEFORE INSERT ON utilisateurs
	FOR EACH ROW
		INSERT INTO utilisateurs
		VALUES (new.id_utilisateur, new.nom_utilisateur, new.prenom_utilisateur, new.login_utilisateur, new.pwd_utilisateur, new.vernam_utilisateur, new.inscription_utilisateur, new.actif_utilisateur, new.langues_id_langue, new.groupes_id_groupe)
		
		
		
 delimiter $$
 create trigger insert_users
 before insert on utilisateurs
 for each row
 BEGIN
          INSERT INTO utilisateurs
          VALUES (new.id_utilisateur, new.nom_utilisateur, new.prenom_utilisateur, new.login_utilisateur, new.pwd_utilisateur, new.vernam_utilisateur, new.inscription_utilisateur, new.actif_utilisateur, new.langues_id_langue, new.groupes_id_groupe);
 END;
 $$
 
 delimiter ;























		