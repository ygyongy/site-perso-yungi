<?php
    $myDb = new DataBase();
    $myDb->dataBaseConnect();
    $myDbLink = $myDb->getLink();
    
    $t = new SmartyYungi();
    $t->assign('name', 'Yungiii');
    $t->assign('include_path', $t->template_dir);   
    
    $parametres = array(
        "select" => 'id_utilisateur, login_utilisateur, inscription_utilisateur, actif_utilisateur, langues_id_langue, groupes_id_groupe',
        "from" => 'utilisateurs u',
        'order by' => 'nom_utilisateur, prenom_utilisateur'
    );
    
    $header_list = array('id', 'login', 'inscription', 'activite', 'langue', 'groupe');
    $myQuery['contenu'] = $myDb->dataBaseSelect($parametres);
    
    foreach ($myQuery['contenu'] as $key => $value) 
    {
        $myQuery['contenu'][$key] = get_object_vars($value);
        $id_user[] = $myQuery['contenu'][$key]['id_utilisateur'];
    }
    
    $myPaginator = new Paginator();
    $myPaginator->setPaginator($myQuery, 1, 'paginator');
    $myPaginatorHtml = $myPaginator->getPaginator();
    $myQuery = $myPaginator->getContentsPaginate($myPaginator->getPageEnCour(), $myPaginator->getNbMaxParPage());
    
    $t->assign('title', 'Liste des utilisateurs');
    $t->assign('id', $id_user);
    $t->assign('header_list', $header_list);
    $t->assign('page', $myQuery);
    $t->assign('pagination', $myPaginatorHtml);
    $t->display('liste.tpl');
?>