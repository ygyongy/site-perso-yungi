<?php
    $myDb = new DataBase();
    $myDb->dataBaseConnect();
    $myDbLink = $myDb->getLink();
    
    $t = new SmartyYungi();
    $t->assign('name', 'Yungiii');
    $t->assign('include_path', $t->template_dir);   
    
    $parametres = array(
        "select" => 'id_utilisateur, login_utilisateur, inscription_utilisateur, actif_utilisateur, code_langue, nom_groupe',
        "from" => 'utilisateurs u, groupes g, langues l',
        "where" => 'u.groupes_id_groupe = g.id_groupe AND u.langues_id_langue = l.id_langue',
        'order by' => 'nom_utilisateur, prenom_utilisateur'
    );
    
    $header_list = array('id', 'login', 'inscription', 'activite', 'langue', 'groupe', 'edit', 'supr.');
    $myQuery['contenu'] = $myDb->dataBaseSelect($parametres);
    
    foreach ($myQuery['contenu'] as $key => $value) 
    {
        $myQuery['contenu'][$key] = get_object_vars($value);
        $id_user[] = $myQuery['contenu'][$key]['id_utilisateur'];
    }
    
    $intervalList = array(1,2,3,5,10,20,30,50,100);
    
    $myFormContent = array("titre"=>"Saisie des informations de Contact",
	"contenu"=>array("action"=>"",
				"enctype"=>"application\/x-www-form-urlencoded",
				"method"=>"GET",
				"id"=>"myIntervalList",
				"evenement_form"=>"onsubmit=\"return requestCreateContact(<?php echo AJAX_PATH); ?>,this, printData)\"",
				"fields"=>array("display_name"=>"",
							"template"=>"select",
							"type"=>"select",
							"class"=>"",
							"id"=>"myInterval",
                                                        "tooltip"=>"",
							"name"=>"myInterval"
						)));
    
    
    $myPaginator = new Paginator();
    $myPaginator->setPaginator($myQuery, 2, 'paginator');
    $myPaginatorHtml = $myPaginator->getPaginator();
    
    $myQuery = $myPaginator->getContentsPaginate($myPaginator->getPageEnCour(), $myPaginator->getNbMaxParPage());
    
    $t->assign('title', 'Liste des utilisateurs');
    $t->assign('test', $myFormContent);
    $t->assign('id', $id_user);
    $t->assign('header_list', $header_list);
    $t->assign('page', $myQuery);
    $t->assign('pagination', $myPaginatorHtml);
    $t->display('grid.tpl');
?>