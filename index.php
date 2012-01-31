<?php
    session_start();
    header('Content-Type: text/html; charset=utf-8');    
    require_once 'config.php';
    require_once 'classes/InfosWebsite.class.php';
    require_once 'classes/User.class.php';
    require_once 'classes/DataBase.class.php';
    require_once 'classes/Languages.class.php';
    require_once 'classes/Categories.class.php';
    require_once 'classes/Vues.class.php';
    
    //insertion du moteur smarty
        require_once 'classes/SmartyYungi.class.php';

    //création d'un objet BDD
        $myDb = new DataBase();
        $myDb->link = $myDb->dataBaseConnect();
        
    //création d'un utilisateur
        $myUser = new User($myDb);
        $oUser = serialize($myUser);
        $fUser = array(
            'type' => 'hidden',
            'name' => 'oUser',
            'id' => 'oUser',
            'value' => $oUser
        );        

    //détection de la langue
        $myLanguage = new Languages($langue);
        $myLanguage->liste_langue = $myLanguage->getLangueList($myDb);

        
// <-- creation des blocks --> 
       
        //L'id_categorie 5 => block_sidebar
        $myBlocks = new Vues();
        $myBlocks->getContent(5, $myLanguage->id_langue, $myDb, $myUser);

        //Reprise des infos du site web
        $myInfosWebsite = new InfosWebsite();
        $myInfosWebsiteListe = $myInfosWebsite->getInfosWebsite($myDb);
        
// <-- fin création des blocks -->

    //Sélection du contenu
        $myCategorie = new Categories();
        $myCategorie->id_categorie = $myCategorie->getIdCategorie($page, $myLanguage->id_langue, $myDb);
        $myCategorie->nom_categorie = $myCategorie->getNomCategorie($myCategorie->id_categorie, $myLanguage->id_langue, $myDb);
        $myCategorie->liste_categorie = $myCategorie->getCategorieList($myDb, 'navigation');
        
    //Récupération de la catégorie Admin
        $myCategorieAdmin = new Categories();
        $myCategorieAdmin->liste_categorie = $myCategorieAdmin->getCategorieList($myDb, 'admin');

    //Récupération du contenu
        $myVue = new Vues();
        if($myVue->contents[0]['id_contenu'])
        {
            $myVue->getContent($myCategorie->id_categorie, $myLanguage->id_langue, $myDb, $myUser);
            $myVue->getTitleHtml($myVue->contents[0]['id_contenu'], $myLanguage->id_langue, $myDb);
        }else{
            $myVue->getContent($myCategorie->id_categorie, $myLanguage->id_langue, $myDb, $myUser);
            $myVue->getTitleHtml(1, $myLanguage->id_langue, $myDb);
        }

    //récupération des données pour le référencement
        $myInfosWebsiteTitle = $myVue->titre_html;


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
            
            //si la session n'est pas initialisée ou égal au compte par défaut on affiche le formulaire
            //sinon on fait rien
            if(!isset($_SESSION['utilisateur']) || $_SESSION['utilisateur']['login_utilisateur'] === 'anonymous')
            {
                $myUserForm = $myUser->getUserForm($myDb, $myUser);
                $t->assign('connexion_user_form', json_decode($myUserForm[0]['contenu'], true));
            }
            
            //Ces infos ont déjà été attribuée donc on décharge la mémoire de leurs valeurs
            unset ($myInfosWebsiteListe['keywords_website']);
            unset ($myInfosWebsiteListe['title_website']);
            
            //Creation du sommaire admin
            $myMenuAdmin = new Menu();
            $myMenuAdminList = $myMenuAdmin->getMenu($myCategorieAdmin, $myLanguage, $myDb, $myCategorieAdmin, $page);
            
            //création du sommaire des langues
            $myMenuLangue = new Menu();
            $myMenuLangueList = $myMenuLangue->getMenu($myLanguage, $myLanguage, $myDb, $myCategorie, $page);
            
            //Creation du sommaire principal
            $myMenu = new Menu();
            $myMenuList = $myMenu->getMenu($myCategorie, $myLanguage, $myDb, $myCategorie, $page);
            
            //méthode de gestion d'appel des templates
            $type_contenu = $myVue->getTemplate($myVue, $t);
            $type_block_sidebar = $myBlocks->getTemplate($myBlocks, $t);
            
            $t->assign('menu_admin_liste', $myMenuAdminList);
            $t->assign('menu_navigation_liste', $myMenuList);
            $t->assign('menu_langue_liste', $myMenuLangueList);

            //assignation des blocks de la sideBar
            $t->assign('blocks', $myBlocks->contentsHTML);
            $t->assign('contents_block', $myBlocks->contents);
            $t->assign("infos_website_liste", $myInfosWebsiteListe[0]);
            
            //assignation des contenus aux pages
            $t->assign('pages', $myVue->contentsHTML);
            $t->assign('contents_page', $myVue->contents);

            //passage d'une variable titre au header
            //$page = $_GET['page']
            $titre = $page;
            $t->assign('title', $titre);
            
            // test de la classe Upload
            $myUpload = new Images($_FILES, $myUser);

            $t->display('index.tpl');

            $myDb->dataBaseClose($myDb->link);
            
            $myDebug->p($_SESSION['utilisateur']);
?>