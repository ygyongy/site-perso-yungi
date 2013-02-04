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
        $this->titre_html_categorie = null;
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
    
    public function getContentsHTML()
    {
        return $this->contentsHTML;
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
        
        $this->contents = $contents_page;
        
        return true;
    }
    
    public function getContent($id_categorie, $langue, $db, $oUser, $id_sous_categorie)
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
                    'where' => "id_categorie = ".$id_categorie." AND sous_categories_id_sous_categorie = ".$id_sous_categorie." AND langues_id_langue = ".$langue.""
                );
            }else{
                $parametre = array(
                    'select' => '*',
                    'from' => "view_".$_SESSION['utilisateur'][1]->nom_groupe."_contenus", //concatene le nom de la vue avec celui du groupe de l'utilisateur
                    'where' => "id_categorie = ".$id_categorie." AND sous_categories_id_sous_categorie IS NULL AND langues_id_langue = ".$langue.""
                );                
            }            
        }else{
            $parametre = array(
                'select' => '*',
                'from' => "view_".$_SESSION['utilisateur'][1]->nom_groupe."_contenus",
                'where' => "id_categorie = 1 AND langues_id_langue = ".$langue.""
            );            
        }
        
        
        //récupération du contenu
        $contents_page = $this->querryContent($parametre, $db, $langue);

        /*
         * TO DO
         * Ajouter des regexs pour parser le contenu!!!!
         *  - Les liens #^(http://)?(www\.)?([-\w.]*)\.([a-z0-9]{2,})$#iU
         *  - Les emails
         *  - Les alt sur les images
         */
        
        
        $pattern_links = '#^(http://)?(www\.)?([-\w.]*)\.([a-z0-9]{2,})#iU';

        foreach($contents_page as $value)
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
    
    private function querryContent($parametre, $db, $langue)
    {
        $this->oContents = $db->dataBaseSelect($parametre);

        //on gère la multiplicité des contenus possible
        if(!is_null($this->oContents))
        {
            foreach($this->oContents as $key => $contenu)
            {                
                if(isset($contenu->contenu) && !empty($contenu->contenu))
                {
                    // le contenus est serialisez dans un objet JSON
                    //le paramètre TRUE => permet de renvoyer un tableau!!!
                    $contents_page[$key] = json_decode($contenu->contenu, TRUE);
                    $contents_page[$key]['fichier_tpl'] = $contenu->nom_type_contenu;
                    $contents_page[$key]['id_contenu'] = $contenu->id_contenu;
                }else{
                    switch ($langue)
                    {
                        case 1:
                            $contents_page[] = array('titre' => "Contenu vide!!!", 'contenu' => 'contenus par défaut', 'footer' => 'Pied de page non-présent', 'fichier_tpl' => 'page');
                            ; break;
                        case 2:
                            $contents_page[] = array('titre' => "Diese Seite ist leer!", 'contenu' => 'Default Seite', 'footer' => 'Füssen des Seite leer', 'fichier_tpl' => 'page');
                            ; break;
                        case 3:
                            $contents_page[] = array('titre' => "Empty content!!!", 'contenu' => 'Default content', 'footer' => 'Footer doesn\'t exist', 'fichier_tpl' => 'page');
                            ; break;
                    }
                }
            }
        }else{
            switch ($langue)
            {
                case 1:
                    $contents_page[] = array('titre' => "Contenu vide!!!", 'contenu' => 'contenus par défaut', 'footer' => 'Pied de page non-présent', 'fichier_tpl' => 'page');
                    ; break;
                case 2:
                    $contents_page[] = array('titre' => "Diese Seite ist leer!", 'contenu' => 'Default Seite', 'footer' => 'Füssen des Seite leer', 'fichier_tpl' => 'page');
                    ; break;
                case 3:
                    $contents_page[] = array('titre' => "Empty content!!!", 'contenu' => 'Default content', 'footer' => 'Footer doesn\'t exist', 'fichier_tpl' => 'page');
                    ; break;
            }
        }
        
        return $contents_page;
    }

    public function getTemplate($oPage, $oSmarty)
    {
        foreach ($oPage->contents as $key => $value)
        {
            switch($value['fichier_tpl'])
            {
                case 'matrice' :
                    $myMatrice = new Matrice();
                    $tmp[$key] = $myMatrice->setMatrice(4, 10, 20, $value, 694*0.99, $oSmarty);
                    $myPageHtml[] = $value;
                    break;
                case 'page' :
                    $myPageHtml[] = $value;
                    break;
                case 'form' :
                    $myForm = new Form();
                    $tmp[$key] = $myForm->setProperties($value);
                    $myPageHtml[] = $value;
                    break;
                case 'liste' : 
                    $myPageHtml[] = $value;                    
                    break;
                case 'include' :
                    $myPageHtml[] = $value;
                    break;
                
                default :
                    $myPageHtml[] = $value;
                    break;
            }
            $nom_template = $value['fichier_tpl'];
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