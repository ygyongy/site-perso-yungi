<?php
    $myDb = new DataBase();
    $myDb->dataBaseConnect();
    $myDbLink = $myDb->getLink();
    
    $myUser = new User();
    
//détection de la langue
    $myLanguage = new Languages($_GET['langue']);
    $myIdLanguage = $myLanguage->getIdLangue(); 
    
//Récupération de la catégorie Admin
    $myCategorieEnCours = new Categories();
    $myIdCategorieEnCours = $myCategorieEnCours->setIdCategorie('links_datagrid', $myIdLanguage, $myDb);
    
    $myCategorieParent = new Categories();
    $myIdCategorieParent = $myCategorieParent->setIdCategorie($_GET['categorie'], $myIdLanguage, $myDb);
    
    $mySousCategorieParent = new SousCategories();
    $myIdSousCategorieParent = $mySousCategorieParent->setIdSousCategorie($_GET['sous_categorie'], $myIdLanguage, $myDb); 
    

//Récupération des sous categories Admin
    $mySousCategorieDatagrid = new SousCategories();
    $mySousCategorieDatagrid->setSousCategorieList($myDb, $myIdCategorieEnCours, 'sous_datagrid', $myUser);
    $mySousCategorieDatagridListe = $mySousCategorieDatagrid->getListeSousCategorie(); //tableau récupérant les données des sous menu Admin
    
    
    $t = new SmartyYungi();
    $t->assign('name', 'Yungiii');
    $t->assign('include_path', $t->template_dir);
    
    $myContentTmp = null;
    
    
    $parametres = array(
        "select" => 'id_utilisateur, login_utilisateur, inscription_utilisateur, actif_utilisateur, code_langue, nom_groupe',
        "from" => 'utilisateurs u, groupes g, langues l',
        "where" => 'u.groupes_id_groupe = g.id_groupe AND u.langues_id_langue = l.id_langue',
        'order by' => 'nom_utilisateur, prenom_utilisateur'
    );
    
    $header_list = array('id', 'login', 'inscription', 'activite', 'langue', 'groupe', 'type de fichier', 'edit', 'supr.');
    $myQuery = $myDb->dataBaseSelect($parametres);
    
    foreach ($myQuery as $key => $value) 
    {
        $myContentTmp['contenus'][$key] = get_object_vars($value);
        $myContentTmp['contenus'][$key]['fichier_tpl'] = 'include';
        $myContentTmp['contenus'][$key]['id_utilisateur'] = $myQuery[$key]->id_utilisateur;
    } 
    
//dans le cas d'un include me permet de modifier le lien
    $nb_contents_parent = count($this->_tpl_vars['pages']);
    
//(contenu, nbreParPage, paramètre à récupérer dans l'url)
    $myPaginator = new Paginator();
    $myPaginator->setPaginator($myContentTmp, 2, 'sous_paginator');
    $myPaginatorHtml = $myPaginator->getPaginator($nb_contents_parent);
    $myContentHtml = $myPaginator->getContentsPaginate($myPaginator->getPageEnCour(), $myPaginator->getNbMaxParPage(), $myContentTmp);
    
    $myDataGridMenu = new Menu();
    $myDataGridMenu->setMenu($mySousCategorieDatagrid, $myLanguage, $myDb, $myCategorieParent, $_GET['categorie'], $mySousCategorieDatagridListe, $mySousCategorieParent, $myPaginator);
    $myDataGridMenuList = $myDataGridMenu->getMenuArray();

    
//Ajout du menu de gestion de la grid.
//Incorporation du Numéro d'utilisateur
    foreach($myDataGridMenuList as $index=>$liste_lien_admin)
    {
        $tmp_link[] = get_object_vars($liste_lien_admin);
    }
    
    foreach($myContentHtml as $index=>$value)
    {
         $myContentHtml[$index]['liste_liens_admin'] = $tmp_link;
         
         foreach($myContentHtml[$index]['liste_liens_admin'] as $key=>$item_link)
         {
             $myContentHtml[$index]['liste_liens_admin'][$key]['lien_menu'] .= $value['id_utilisateur'];
         }
    }

    $t->assign('title', 'Liste des utilisateurs');
    $t->assign('pages', $myContentHtml);
    $t->assign('pagination', $myPaginatorHtml);
    $t->assign('datagrid_menu_cells', $myDataGridMenuList);
    $t->display('grid.tpl');
?>