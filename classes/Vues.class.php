<?php
/* 
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Pages
 *
 * @author yungiii
 */
class Vues{
    private $categorie_id;
    private $sous_categorie_id;
    private $nom_categorie;
    private $nom_sous_categorie;
    private $oContents = array();
    private $contentsHTML = array();
    private $type_contenu;
    private $nb_contents;
    private $titre_html_categorie;
    private $contents = array();
    private $fichiers = array();

    public function Vues()
    {
        $this->categorie_id = NULL;
        $this->sous_categorie_id = NULL;
        $this->nom_categorie = NULL;
        $this->nom_sous_categorie = NULL;
        $this->oContents = null;
        $this->contentsHTML = null;
        $this->type_contenu = null;
        $this->nb_contents = null;
        $this->titre_html_categorie = null;
        $this->contents = null;
        $this->fichiers = null;
        
    }

    public function getTitreHtml()
    {
        return $this->titre_html_categorie;
    }
    
    public function getNomCategorie()
    {
        return $this->nom_categorie;
    }
    
    public function getNomSousCategorie()
    {
        return $this->nom_sous_categorie;
    }    
    
    public function getOContents()
    {
        return $this->oContents;
    }
    
    public function getContents()
    {
        return $this->contents;
    }
    
    public function getTypeContenu()
    {
        return $this->type_contenu;
    }


    public function getContentsHTML()
    {
        return $this->contentsHTML;
    }
    
    public function getNbContents()
    {
        return $this->nb_contents;
    }

    public function getContentById($id, $langue, $db, $oUser)
    {
        switch ($oUser->getDroitUser())
        {
            case 'UPEA' : $view = 'view_admin_contenus';
                break;
            
            case 'UPE' : $view = 'view_editeur_contenus';
                break;
            
            case 'UP': $view = 'view_pro_contenus';
                break;
            
            case 'U': $view = 'view_user_contenus';
                break;
            
            default: $view = 'view_anonymous_contenus';
                break;
        }
        
        if($id)
        {
            $parametre = array(
                    'select' => '*',
                    'from' => "view_".$_SESSION['utilisateur'][1]->nom_groupe."_contenus", //concatene le nom de la vue avec celui du groupe de l'utilisateur
                    'where' => "id_contenu = ".$id." AND langues_id_langue = ".$langue.""
             );
        }
        
        //récupération du contenu
        $contents_page = $this->querryContent($parametre, $db, $langue);
        
        $this->nb_contents = count($contents_page);
        $this->contents = $contents_page;
        
        if($this->nb_contents === 1)
            return true;
        else{
            return false;
        }
    }
    
    public function setContents($id_categorie, $id_langue, $oDb, $oUser, $id_sous_categorie)
    {        
        switch ($oUser->getDroitUser())
        {
            case 'UPEA' : $view = 'view_admin_contenus';
                break;
            
            case 'UPE' : $view = 'view_editeur_contenus';
                break;
            
            case 'UP': $view = 'view_pro_contenus';
                break;
            
            case 'U': $view = 'view_user_contenus';
                break;
            
            default: $view = 'view_anonymous_contenus';
                break;
        }        

        if($id_categorie)
        {
            if($id_sous_categorie != '0')
            {
                $parametre = array(
                    'select' => '*',
                    'from' => "view_".$_SESSION['utilisateur'][1]->nom_groupe."_contenus", //concatene le nom de la vue avec celui du groupe de l'utilisateur
                    'where' => "categories_id_categorie = ".$id_categorie." AND sous_categories_id_sous_categorie = ".$id_sous_categorie." AND langues_id_langue = ".$id_langue.""
                );
            }else{
                $parametre = array(
                    'select' => '*',
                    'from' => "view_".$_SESSION['utilisateur'][1]->nom_groupe."_contenus", //concatene le nom de la vue avec celui du groupe de l'utilisateur
                    'where' => "categories_id_categorie = ".$id_categorie." AND sous_categories_id_sous_categorie IS NULL AND langues_id_langue = ".$id_langue.""
                );                
            }            
        }else{
            $parametre = array(
                'select' => '*',
                'from' => "view_".$_SESSION['utilisateur'][1]->nom_groupe."_contenus",
                'where' => "categories_id_categorie = 1 AND langues_id_langue = ".$id_langue.""
            );            
        }
        
        if($id_categorie)
        {
            $parametreListe = null;
            $parametreListe = array(
                'select' => 'id_categorie, langues_id_langue, types_contenus_id_type_contenu, categorie_max_par_page',
                'from' => "view_".$_SESSION['utilisateur'][1]->nom_groupe."_menu",
                'where' => 'id_categorie = '.$id_categorie.' AND langues_id_langue = '.$id_langue
            );
            
            $contents_page['categorie'] = $oDb->dataBaseSelect($parametreListe, $oDb, $id_langue);
            $contents_page['categorie'][0] = get_object_vars($contents_page['categorie'][0]);
            
            if($id_sous_categorie)
            {
                $parametreListe = null;
                $parametreListe = array(
                    'select' => 'id_sous_categorie, langues_id_langue, types_contenus_id_type_contenu, sous_categorie_max_par_page',
                    'from' => "view_".$_SESSION['utilisateur'][1]->nom_groupe."_sous_menu",
                    'where' => 'id_sous_categorie = '.$id_sous_categorie.' AND langues_id_langue = '.$id_langue
                );
                
                $contents_page['sous_categorie'] = $oDb->dataBaseSelect($parametreListe, $oDb, $id_langue);
                $contents_page['sous_categorie'][0] = get_object_vars($contents_page['sous_categorie'][0]);
            }
        }
        
        //récupération du contenu
        $contents_page['contenus'] = $this->querryContent($parametre, $oDb, $id_langue);
        
        //attribution des contenus à oContents
        $this->oContents = $contents_page;

        /*
         * TO DO
         * Ajouter des regexs pour parser le contenu!!!!
         *  - Les liens #^(http://)?(www\.)?([-\w.]*)\.([a-z0-9]{2,})$#iU
         *  - Les emails
         *  - Les alt sur les images
         */
        
        
        $pattern_links = '#^(http://)?(www\.)?([-\w.]*)\.([a-z0-9]{2,})#iU';

        foreach($contents_page['contenus'] as $value)
        {
            //Si ce n'est pas un formulaire
            if(!is_array($value['contenu']))
            {
                $value['contenu'] = preg_replace($pattern_links, '<a href="$1$2$3.$4" target="_blank" title="$2$3.$4">$2$3.$4</a>', $value['contenu']);
            }
        }

        $this->contents = $contents_page;
        return true;
    }
    
    private function querryContent($aParametres, $oDb, $id_langue)
    {
        $tmp_contents = $oDb->dataBaseSelect($aParametres);
        
        //on gère la multiplicité des contenus possible
        if(!is_null($tmp_contents))
        {
            foreach($tmp_contents as $key => $contenu)
            {                
                if(isset($contenu->contenu) && !empty($contenu->contenu))
                {
                    // le contenus est serialisez dans un objet JSON
                    //le paramètre TRUE => permet de renvoyer un tableau!!!
                    $contents_page[$key] = json_decode($contenu->contenu, TRUE);
                    $contents_page[$key]['types_contenus_id_type_contenu'] = $contenu->cont_type_contenu;
                    $contents_page[$key]['id_contenu'] = $contenu->id_contenu;
                }else{
                    switch ($id_langue)
                    {
                        case 1:
                            $contents_page[] = array('titre' => "Contenu vide!!!", 'contenu' => 'contenus par défaut', 'footer' => 'Pied de page non-présent', 'types_contenus_id_type_contenu' => 1, 'id_contenu' => '12', 'fichier_tpl' => 'page');
                            ; break;
                        case 2:
                            $contents_page[] = array('titre' => "Diese Seite ist leer!", 'contenu' => 'Default Seite', 'footer' => 'Füssen des Seite leer', 'types_contenus_id_type_contenu' => 1, 'id_contenu' => '12', 'fichier_tpl' => 'page');
                            ; break;
                        case 3:
                            $contents_page[] = array('titre' => "Empty content!!!", 'contenu' => 'Default content', 'footer' => 'Footer doesn\'t exist', 'types_contenus_id_type_contenu' => 1, 'id_contenu' => '12', 'fichier_tpl' => 'page');
                            ; break;
                    }
                }
            }
        }else{
            switch ($id_langue)
            {
                case 1:
                    $contents_page[] = array('titre' => "Contenu vide!!!", 'contenu' => 'contenus par défaut', 'footer' => 'Pied de page non-présent', 'types_contenus_id_type_contenu' => 1, 'id_contenu' => '12', 'fichier_tpl' => 'page');
                    ; break;
                case 2:
                    $contents_page[] = array('titre' => "Diese Seite ist leer!", 'contenu' => 'Default Seite', 'footer' => 'Füssen des Seite leer', 'types_contenus_id_type_contenu' => 1, 'id_contenu' => '12', 'fichier_tpl' => 'page');
                    ; break;
                case 3:
                    $contents_page[] = array('titre' => "Empty content!!!", 'contenu' => 'Default content', 'footer' => 'Footer doesn\'t exist', 'types_contenus_id_type_contenu' => 1, 'id_contenu' => '12', 'fichier_tpl' => 'page');
                    ; break;
            }
        }    
        
        return $contents_page;
    }
    
    public function getNameTemplate($id_type_contenu, $oDb)
    {
        $tmp = null;
        $parametres = array(
            "select" => "*",
            "from" => "types_contenus",
            "where" => "id_type_contenu = ".$id_type_contenu." AND actif_type_contenu = '1'"
        );

        $tmp = $oDb->dataBaseSelect($parametres);
        
        if(!empty($tmp[0]->nom_type_contenu))
        {
            return $tmp[0]->nom_type_contenu;
        }else{
            return false;
        }
    }

    public function getTemplate($oPage, $index, $oSmarty, $oDb)
    {
        $name_tpl = null;
        
        foreach($oPage->contents as $key=>$valeurs)
        {
            $myPageHtml[$key]=$valeurs;
        }

        foreach($myPageHtml as $key => $valeur)
        {
            $nb_elements = count($myPageHtml[$index]);

            for($i=0; $i < $nb_elements; $i++)
            {
                $myPageHtml[$index][$i]['fichier_tpl'] = $oPage->getNameTemplate($myPageHtml[$index][$i]['types_contenus_id_type_contenu'], $oDb);
                $nom_template = $oPage->getNameTemplate($myPageHtml[$index][$i]['types_contenus_id_type_contenu'], $oDb);
                
                switch ($nom_template)
                {
                   case 'matrice' :
                       $myMatrice = new Matrice();
                       $tmp[$key] = $myMatrice->setMatrice(4, 10, 20, $myPageHtml[$index][$i], 694*0.99, $oSmarty);
                       break;
                   case 'page' :

                       break;
                   case 'form' :
                       $myForm = new Form();
                       $tmp[$key] = $myForm->setProperties($myPageHtml[$index][$i]);

                       break;
                   case 'liste' : 

                       break;
                   case 'include' :

                       break;

                   case 'grid':

                       break;

                   default :

                       break;                
                }                
            }
        }

        //j attribue le contenu HTML à mon objet
        if(isset($myPageHtml) && !empty($myPageHtml))
        {            
            $this->contentsHTML = $myPageHtml;
            return $nom_template;
        }else{
            $this->contentsHTML = 'error';
            return false;
        }
    }

    private function getKeywords($chaine)
    {
        $tmp = $chaine;
        $mot_exclu = array('un', 'une', 'de', 'du', 'des', 'l\'', 'le', 'la', 'les', 'mon', 'ton', 'son', 'dans');
    }

    public function setTitleHtml($id, $langue, $db)
    {
        if($id)
        {
            $parametre = array(
                'select' => 'titre_html_categorie',
                'from' => 'categories',
                'where' => 'id_categorie = '.$id.' AND langues_id_langue = '.$langue
            );

            $tmp = $db->dataBaseSelect($parametre);
            $this->titre_html_categorie = $tmp[0]->titre_html_categorie;

            return TRUE;
        }else{
            return FALSE;
        }
    }
    
    public function getJson($content)
    {
        if($content && !empty($content) && isset($content))
        {
            $tmp = json_encode($content);
            if($tmp && !empty($tmp) && isset($tmp))
            {
                return $tmp;
            }else{
                return false;
            }
        }else{
            return false;
        }
    }
}


?>