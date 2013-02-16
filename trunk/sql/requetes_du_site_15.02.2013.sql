SELECT * FROM utilisateurs WHERE login_utilisateur = 'anonymous' LIMIT 0,1;

SELECT * FROM groupes WHERE id_groupe = 5 LIMIT 0,1;

SELECT * FROM contenus c WHERE c.types_contenus_id_types_contenus = 4;

SELECT id_langue, nom_langue, code_langue, position_langue FROM langues WHERE actif_langue <> '0' ORDER BY position_langue;

SELECT id_categorie, langues_id_langue, types_contenus_id_type_contenu, categorie_max_par_page FROM view_anonymous_menu WHERE id_categorie = 5 AND langues_id_langue = 1;

SELECT * FROM view_anonymous_contenus WHERE categories_id_categorie = 5 AND sous_categories_id_sous_categorie IS NULL AND langues_id_langue = 1;

SELECT * FROM websites w;

SELECT nom_categorie FROM categories c WHERE c.id_categorie = 1 AND langues_id_langue = 1 ORDER BY id_categorie DESC;

SELECT id_categorie, nom_categorie, langues_id_langue, position_categorie, emplacement_categorie FROM view_anonymous_menu WHERE emplacement_categorie = "navigation";

SELECT nom_sous_categorie FROM sous_categories sc WHERE sc.id_sous_categorie = 0 AND langues_id_langue = 1 ORDER BY id_sous_categorie DESC;

SELECT id_sous_categorie, nom_sous_categorie, langues_id_langue, position_sous_categorie, emplacement_sous_categorie, categories_id_categorie FROM view_anonymous_sous_menu WHERE emplacement_sous_categorie = "sous_navigation" AND categories_id_categorie = 1;

SELECT id_categorie, nom_categorie, langues_id_langue, position_categorie, emplacement_categorie FROM view_anonymous_menu WHERE emplacement_categorie = "admin";

SELECT id_sous_categorie, nom_sous_categorie, langues_id_langue, position_sous_categorie, emplacement_sous_categorie, categories_id_categorie FROM view_anonymous_sous_menu WHERE emplacement_sous_categorie = "sous_admin" AND categories_id_categorie = 1;

SELECT id_categorie, langues_id_langue, types_contenus_id_type_contenu, categorie_max_par_page FROM view_anonymous_menu WHERE id_categorie = 1 AND langues_id_langue = 1;

SELECT * FROM view_anonymous_contenus WHERE categories_id_categorie = 1 AND sous_categories_id_sous_categorie IS NULL AND langues_id_langue = 1;

SELECT titre_html_categorie FROM categories WHERE id_categorie = 1 AND langues_id_langue = 1;

SELECT nom_categorie FROM categories c WHERE c.id_categorie = 1 AND langues_id_langue = 1 ORDER BY id_categorie DESC;

SELECT nom_categorie FROM categories c WHERE c.id_categorie = 1 AND langues_id_langue = 2 ORDER BY id_categorie DESC;

SELECT nom_categorie FROM categories c WHERE c.id_categorie = 1 AND langues_id_langue = 3 ORDER BY id_categorie DESC;

SELECT nom_categorie FROM categories c WHERE c.id_categorie = 1 AND langues_id_langue = 1 ORDER BY id_categorie DESC;

SELECT * FROM types_contenus WHERE id_type_contenu = 5 AND actif_type_contenu = '1';

SELECT * FROM types_contenus WHERE id_type_contenu = 5 AND actif_type_contenu = '1';

SELECT * FROM types_contenus WHERE id_type_contenu = 1 AND actif_type_contenu = '1';

SELECT * FROM types_contenus WHERE id_type_contenu = 1 AND actif_type_contenu = '1';

SELECT * FROM types_contenus WHERE id_type_contenu = 1 AND actif_type_contenu = '1';

SELECT * FROM types_contenus WHERE id_type_contenu = 1 AND actif_type_contenu = '1';

SELECT * FROM types_contenus WHERE id_type_contenu = 1 AND actif_type_contenu = '1';

SELECT * FROM types_contenus WHERE id_type_contenu = 1 AND actif_type_contenu = '1';

SELECT * FROM types_contenus WHERE id_type_contenu = 1 AND actif_type_contenu = '1';

SELECT * FROM types_contenus WHERE id_type_contenu = 1 AND actif_type_contenu = '1';

SELECT * FROM types_contenus WHERE id_type_contenu = 3 AND actif_type_contenu = '1';

SELECT * FROM types_contenus WHERE id_type_contenu = 3 AND actif_type_contenu = '1';

SELECT * FROM types_contenus WHERE id_type_contenu = 4 AND actif_type_contenu = '1';

SELECT * FROM types_contenus WHERE id_type_contenu = 4 AND actif_type_contenu = '1';

SELECT id_sous_categorie, nom_sous_categorie, langues_id_langue, position_sous_categorie, emplacement_sous_categorie FROM sous_categories scat WHERE emplacement_sous_categorie = "sous_catalogue";

SELECT nom_categorie FROM categories c WHERE c.id_categorie = 1 AND langues_id_langue = 1 ORDER BY id_categorie DESC;

SELECT nom_categorie FROM categories c WHERE c.id_categorie = 1 AND langues_id_langue = 1 ORDER BY id_categorie DESC;