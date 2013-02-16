<?php
    !isset($_GET['langue']) ? $langue = '' : $langue = $_GET['langue'];
    !isset($_GET['categorie']) ? $categorie = '' : $categorie = $_GET['categorie'];
    !isset($_GET['sous_categorie']) ? $sous_categorie = '' : $sous_categorie = $_GET['sous_categorie'];
    !isset($_GET['article']) ? $article = '' : $article = $_GET['article'];
    !isset($_GET['id_article']) ? $id_article = '' : $id_article = $_GET['id_article'];
    
    
    $myDb = new DataBase();
    $myDb->dataBaseConnect();
    $myDbLink = $myDb->getLink();
    
    $myUser = new User();
    
//détection de la langue
    $myLanguage = new Languages($langue);
    $myLanguage->setListeLangue($myDb); //tableau récupérant les données des menus langues
    $myIdLanguage = $myLanguage->getIdLangue(); 
    
//Récupération de la catégorie Admin
    $myCategorieEnCours = new Categories();
    $myIdCategorieEnCours = $myCategorieEnCours->setIdCategorie('links_datagrid', $myIdLanguage, $myDb);
    
    $myCategorieParent = new Categories();
    $myIdCategorieParent = $myCategorieParent->setIdCategorie($categorie, $myIdLanguage, $myDb);
    
    $mySousCategorieParent = new SousCategories();
    $myIdSousCategorieParent = $mySousCategorieParent->setIdSousCategorie($sous_categorie, $myIdLanguage, $myDb);
    
    $idToEdit = $sous_categorie;
    $idToEdit = strtolower(trim($idToEdit));
    $idToEdit = str_split($idToEdit);
    $nb_element = count($idToEdit);

    unset($idToEdit[$nb_element-1]);//on supprime le 's'
    $idToEdit = implode('', $idToEdit);
    
    $parametres = array(
        "select" => '*',
        "from" => ''.$sous_categorie.'',
        "where" => 'id_'.$idToEdit.'='.$id_article
    );
    
    $dataToAdmin = $myDb->dataBaseSelect($parametres);
    var_dump($dataToAdmin);
    
    $t = new SmartyYungi();
    $t->assign('name', 'Yungiii');
    $t->assign('include_path', $t->template_dir);
    
    $myContentTmp = null;    
?>