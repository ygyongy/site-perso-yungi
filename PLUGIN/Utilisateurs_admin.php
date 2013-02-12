<?php
    $myDb = new DataBase();
    $myDb->dataBaseConnect();
    $myDbLink = $myDb->getLink();
    
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

    $t->assign('title', 'Liste des utilisateurs');
    $t->assign('id', $id_user);
    $t->assign('header_list', $header_list);
    $t->assign('pages', $myContentHtml);
    $t->assign('pagination', $myPaginatorHtml);
    $t->display('grid.tpl');
?>