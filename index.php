<?php
    //session_start();
    header('Content-Type: text/html; charset=utf-8');    
    require_once 'config.php';
    require_once 'classes/InfosWebsite.class.php';
    require_once 'classes/User.class.php';
    require_once 'classes/DataBase.class.php';
    require_once 'classes/Languages.class.php';
    require_once 'classes/Categories.class.php';
    require_once 'classes/SousCategories.class.php';
    require_once 'classes/Contenus.class.php';
    require_once 'classes/Vues.class.php';
    require_once 'classes/Paginator.class.php';
   
    //Classe qui permet de charger une extension Chrome pour debugg PHP
        require_once 'classes/PhpConsole/PhpConsole.php';
    
    //Extension Chrome pour Debuggage PHP
        //PhpConsole::start();
    
    //insertion du moteur smarty
        require_once 'classes/SmartyYungi.class.php';

    //création d'un objet BDD
        $myDb = new DataBase();
        $myDb->dataBaseConnect();
        $myDbLink = $myDb->getLink();
        
    //création d'un utilisateur
        $myUser = new User($myDb);
        $oUser = serialize($myUser);
        $fUser = array(
            'type' => 'hidden',
            'name' => 'oUser',
            'id' => 'oUser',
            'value' => $oUser
        );
        
        //si la session n'est pas initialisée ou égal au compte par défaut on affiche le formulaire
        //sinon on fait rien
        
        if(!isset($_SESSION['utilisateur']) || $_SESSION['utilisateur'][0]->login_utilisateur === 'anonymous')
        {
            $myUserForm = $myUser->getUserForm($myDb, $myUser);
        }        

    //détection de la langue
        $myLanguage = new Languages($langue);
        $myLanguage->setListeLangue($myDb); //tableau récupérant les données des menus langues
        $myListeLanguage = $myLanguage->getListeLangue();
        $myIdLanguage = $myLanguage->getIdLangue();
        
   //Création d'un paginateur afin de gérer le contenu
        $myPaginator = new Paginator();
        
// <-creation des blocks --> 
       
        //L'id_categorie 5 => block_sidebar
            $myBlocks = new Vues();
            $myBlocks->setContents(5, 1, $myDb, $myUser, 0, null);
            
        //Reprise des infos du site web
            $myInfosWebsite = new InfosWebsite();
            $myInfosWebsite->setInfosWebsite($myDb);
            $myInfosWebsiteListe = $myInfosWebsite->getInfosWebsite();
        
// <-fin création des blocks -->

    //Récupération de la navigation principale
        $myCategorie = new Categories();
        $myIdCategorie = $myCategorie->setIdCategorie($categorie, $myIdLanguage, $myDb);
        $myNomCategorie = $myCategorie->getNomCategorie($myCategorie->setIdCategorie($categorie, $myIdLanguage, $myDb), $myIdLanguage, $myDb);
        $myCategorie->setCategorieList($myDb, 'navigation', $myUser);
        $myListeCategorie = $myCategorie->getListeCategorie(); //tableau récupérant les données des menus navigation

    //Récupération de la sous_navigation
        $mySousCategorie = new SousCategories();
        $myIdSousCategorie = $mySousCategorie->getIdSousCategorie($sous_categorie, $myIdLanguage, $myDb);
        $myNomSousCategorie = $mySousCategorie->getNomSousCategorie($mySousCategorie->getIdSousCategorie($sous_categorie, $myIdLanguage, $myDb), $myIdLanguage, $myDb);
        $mySousCategorie->setSousCategorieList($myDb, $myIdCategorie, 'sous_navigation', $myUser);
        $myListeSousCategorie = $mySousCategorie->getListeSousCategorie(); //tableau récupérant les données des menus navigation    

    //Récupération de la catégorie Admin
        $myCategorieAdmin = new Categories();
        $myIdCategorieAdmin = $myCategorieAdmin->setIdCategorie($categorie, $myIdLanguage, $myDb);
        $myCategorieAdmin->setCategorieList($myDb, 'admin', $myUser);
        $myListeCategorieAdmin = $myCategorieAdmin->getListeCategorie(); //tableau récupérant les données des menus admin
        
   //Récupération des sous categories Admin
        $mySousCategorieAdmin = new SousCategories();
        $mySousCategorieAdmin->setSousCategorieList($myDb, $myIdCategorieAdmin,'sous_admin', $myUser);
        $myListeSousCategorieAdmin = $mySousCategorieAdmin->getListeSousCategorie(); //tableau récupérant les données des sous menu Admin       

    //Récupération du contenu
        $myVue = new Vues();
        $myVueObjectContent = $myVue->getOContents();

    //me permet d'attribuer les contenus à la vue
        if($myVueObjectContent[0]['id_contenu'])
        {
            $myVue->setContents($myCategorie->setIdCategorie($categorie, $myIdLanguage, $myDb), $myIdLanguage, $myDb, $myUser, $mySousCategorie->getIdSousCategorie($sous_categorie, $myIdLanguage, $myDb), $article);
            $myVue->getTitleHtml($myVueObjectContent[0]['id_contenu'], $myIdLanguage, $myDb);
        }else{
            $myVue->setContents($myCategorie->setIdCategorie($categorie, $myIdLanguage, $myDb), $myIdLanguage, $myDb, $myUser, $mySousCategorie->getIdSousCategorie($sous_categorie, $myIdLanguage, $myDb), $article);
            $myVue->setTitleHtml($myCategorie->setIdCategorie($categorie, $myIdLanguage, $myDb), $myIdLanguage, $myDb);
        }

    //récupération des données pour le référencement
        $myInfosWebsiteTitle = $myVue->getTitreHtml();


    //création d'un objet avec la classe Smarty + attribution des variables nécessaires
        $t = new SmartyYungi();
        $t->assign('name', 'Yungiii');
        $t->assign('include_path', $t->template_dir);

    //assignation des variables nécessaires au Header_Html
        $t->assign('langue', $langue);
        $t->assign('title_website', $myInfosWebsiteTitle);
        $t->assign('css_path', CSS_PATH);
        $t->assign('ajax_path', AJAX_PATH);
        $t->assign('template', $template);
        $t->assign('js_path', JS_PATH);
        $t->assign('ckeditor_path', CKEDITOR_PATH);
        $t->assign('fUser', $fUser);

        $t->display('header_html.tpl');
?>

    <body>
        <?php
            //création d'un objet debug pour tester les variables
                $myDebug = new Debug();
                //$myDebug->p();
            
            //Ces infos ont déjà été attribuée donc on décharge la mémoire de leurs valeurs
                unset ($myInfosWebsiteListe['keywords_website']);
                unset ($myInfosWebsiteListe['title_website']);
            
            //Creation du sommaire admin
                $myMenuAdmin = new Menu();
                $myMenuAdmin->setMenu($myCategorieAdmin, $myLanguage, $myDb, $myCategorieAdmin, $categorie, $myListeCategorieAdmin);
                $myMenuAdminList = $myMenuAdmin->getMenuArray();
            
           //Creation du sous_menu admin
                $mySousMenuAdmin = new Menu();
                $mySousMenuAdmin->setMenu($mySousCategorieAdmin, $myLanguage, $myDb, $myCategorieAdmin, $categorie, $myListeSousCategorieAdmin);
                $mySousMenuAdminList = $mySousMenuAdmin->getMenuArray();

            //création du sommaire des langues
                $myMenuLangue = new Menu();
                $myMenuLangue->setMenu($myLanguage, $myLanguage, $myDb, $myCategorie, $categorie, $myListeLanguage);
                $myMenuLangueList = $myMenuLangue->getMenuArray();
            
            //Creation du sommaire principal
                $myMenu = new Menu();
                $myMenu->setMenu($myCategorie, $myLanguage, $myDb, $myCategorie, $categorie, $myListeCategorie);
                $myMenuList = $myMenu->getMenuArray();
                
            //Creation du sous_menu principal    
                $mySousMenu = new Menu();
                $mySousMenu->setMenu($mySousCategorie, $myLanguage, $myDb, $myCategorie, $categorie, $myListeSousCategorie);
                $mySousMenuList = $mySousMenu->getMenuArray();                
                
            //Creation de la navigation (gestion de la profondeur de la navigation cat/scat/details/...)
                $myNavigation = new Navigation();
                $myNavigation->setNavigation($categorie, $sous_categorie, $article);
                $myIndexNavigation = $myNavigation->getIndex();

            //méthode de gestion d'appel des templates
                $type_contenu = $myVue->getTemplate($myVue, $myIndexNavigation, $t, $myDb);
                $type_block_sidebar = $myBlocks->getTemplate($myBlocks, 'contenus', $t, $myDb);

           //assignation des menus 
                $t->assign('menu_liste_admin', $myMenuAdminList);
                $t->assign('sous_menu_liste_admin', $mySousMenuAdminList);
                $t->assign('menu_liste_nav', $myMenuList);
                $t->assign('sous_menu_liste_nav', $mySousMenuList);
                $t->assign('menu_liste_langues', $myMenuLangueList);

            //assignation des blocks de la sideBar
                $myBlocksContentsHtml = $myBlocks->getContentsHTML();
                $myBlocksContentsHtml['contenus'][0]['fichier_tpl'] = $type_block_sidebar;

                $t->assign('contents_block', $myBlocksContentsHtml);
                $t->assign('index_navigation_blocks', 'contenus');

                $t->assign('connexion_user_form', json_decode($myUserForm[0]->contenu, true));
                $t->assign("infos_website_liste", $myInfosWebsiteListe[0]);
                
            
            //assignation des contenus aux pages avec paginateur
                $myContentsHtml = $myVue->getContentsHTML();

                $nb_element_parent_HTML = count($myContentsHtml); 
                
                //(contenu, nbreParPage, paramètre à récupérer dans l'url)     
                $myPaginator2 = new Paginator();
                $myPaginator2->setPaginator($myContentsHtml, 2, 'paginator');
                $myPaginatorHtml = $myPaginator2->getPaginator($nb_element_parent_HTML);

                $myContentsHtml['contenus'] = $myPaginator2->getContentsPaginate($myPaginator2->getPageEnCour(), $myPaginator2->getNbMaxParPage(), $myContentsHtml);
                
                $nb_contents = $myVue->getNbContents();                
                $myContentsHtml[$myIndexNavigation][0]['fichier_tpl'] = $type_contenu;

           //On prépare les liens pour les learn more
                $myContenu = new Contenus();
                $myContenu->setContenus($myDb, 'sous_catalogue', $myUser, $myContentsHtml['contenus']);
                $myContenuList = $myContenu->getListeContenu();
                
                $myContenuMenu = new Menu();
                $myContenuMenu->setMenu($myContenu, $myLanguage, $myDb, $myCategorie, $article, $myContenuList);
                $myContenuListMenu = $myContenuMenu->getMenuArray();
                
                $t->assign('contents_page', $myContentsHtml);
                $t->assign('menu_liste_learn_more', $myContenuListMenu);
                $t->assign('index_navigation', $myIndexNavigation);
                $t->assign('pagination', $myPaginatorHtml); 

            //passage d'une variable titre au header
                $sous_titre = $sous_categorie;
                $titre = $categorie;

                $t->assign('title', $titre);
                $t->assign('subtitle', $sous_titre);
                
            // test de la classe Upload
                $myUpload = new Images($_FILES, $myUser);

                $t->display('index.tpl');

                $myDb->dataBaseClose($myDbLink);
?>