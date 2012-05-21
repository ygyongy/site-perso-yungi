<?php
    //session_start();
    header('Content-Type: text/html; charset=utf-8');    
    require_once 'config.php';
    require_once 'classes/InfosWebsite.class.php';
    require_once 'classes/User.class.php';
    require_once 'classes/DataBase.class.php';
    require_once 'classes/Languages.class.php';
    require_once 'classes/Categories.class.php';
    require_once 'classes/Vues.class.php';
    
    //Classe qui permet de charger une extension Chrome pour debugg PHP
        require_once 'classes/PhpConsole/PhpConsole.php';
    
    //Extension Chrome pour Debuggage PHP
        PhpConsole::start();
    
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

        
// <-creation des blocks --> 
       
        //L'id_categorie 5 => block_sidebar
        $myBlocks = new Vues();
        $myBlocks->getContent(5, $myLanguage->getIdLangue(), $myDb, $myUser);

        //Reprise des infos du site web
        $myInfosWebsite = new InfosWebsite();
        $myInfosWebsite->setInfosWebsite($myDb);
        $myInfosWebsiteListe = $myInfosWebsite->getInfosWebsite();
        
// <-fin création des blocks -->

    //Sélection du contenu
        $myCategorie = new Categories();
        $myIdCategorie = $myCategorie->getIdCategorie($page, $myLanguage->getIdLangue(), $myDb);
        $myNomCategorie = $myCategorie->getNomCategorie($myCategorie->getIdCategorie($page, $myLanguage->getIdLangue(), $myDb), $myLanguage->getIdLangue(), $myDb);
        $myCategorie->setCategorieList($myDb, 'navigation', $myUser);
        $myListeCategorie = $myCategorie->getListeCategorie(); //tableau récupérant les données des menus navigation
       
        
    //Récupération de la catégorie Admin
        $myCategorieAdmin = new Categories();
        $myCategorieAdmin->setCategorieList($myDb, 'admin', $myUser);
        $myListeCategorieAdmin = $myCategorieAdmin->getListeCategorie(); //tableau récupérant les données des menus admin

        
    //Récupération du contenu
        $myVue = new Vues();
        $myVueObjectContent = $myVue->getOContents();
        
        if($myVueObjectContent[0]['id_contenu'])
        {
            $myVue->getContent($myCategorie->getIdCategorie($page, $myLanguage->getIdLangue(), $myDb), $myLanguage->getIdLangue(), $myDb, $myUser);
            $myVue->getTitleHtml($myVueObjectContent[0]['id_contenu'], $myLanguage->getIdLangue(), $myDb);
        }else{
            $myVue->getContent($myCategorie->getIdCategorie($page, $myLanguage->getIdLangue(), $myDb), $myLanguage->getIdLangue(), $myDb, $myUser);
            $myVue->setTitleHtml($myCategorie->getIdCategorie($page, $myLanguage->getIdLangue(), $myDb), $myLanguage->getIdLangue(), $myDb);
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
            
            
            //Ces infos ont déjà été attribuée donc on décharge la mémoire de leurs valeurs
            unset ($myInfosWebsiteListe['keywords_website']);
            unset ($myInfosWebsiteListe['title_website']);
            
            //Creation du sommaire admin
            $myMenuAdmin = new Menu();
            $myMenuAdmin->setMenu($myCategorieAdmin, $myLanguage, $myDb, $myCategorieAdmin, $page, $myListeCategorieAdmin);
            $myMenuAdminList = $myMenuAdmin->getMenuArray();
                    
            //création du sommaire des langues
            $myMenuLangue = new Menu();
            $myMenuLangue->setMenu($myLanguage, $myLanguage, $myDb, $myCategorie, $page, $myListeLanguage);
            $myMenuLangueList = $myMenuLangue->getMenuArray();
            
            //Creation du sommaire principal
            $myMenu = new Menu();
            $myMenu->setMenu($myCategorie, $myLanguage, $myDb, $myCategorie, $page, $myListeCategorie);
            $myMenuList = $myMenu->getMenuArray();
            
            //méthode de gestion d'appel des templates
            $type_contenu = $myVue->getTemplate($myVue, $t);
            $type_block_sidebar = $myBlocks->getTemplate($myBlocks, $t);
            
            $t->assign('menu_liste_admin', $myMenuAdminList);
            $t->assign('menu_liste_nav', $myMenuList);
            $t->assign('menu_liste_langues', $myMenuLangueList);

            //assignation des blocks de la sideBar
            $t->assign('blocks', $myBlocks->getContentsHTML());
            $t->assign('contents_block', $myBlocks->getContents());
            $t->assign('connexion_user_form', json_decode($myUserForm[0]['contenu'], true));
            $t->assign("infos_website_liste", $myInfosWebsiteListe[0]);
            
            //assignation des contenus aux pages
            $t->assign('pages', $myVue->getContentsHTML());
            $t->assign('contents_page', $myVue->getContents());

            //passage d'une variable titre au header
            $titre = $page;
            $t->assign('title', $titre);
            
            // test de la classe Upload
            $myUpload = new Images($_FILES, $myUser);

            $t->display('index.tpl');

            $myDb->dataBaseClose($myDbLink);
?>