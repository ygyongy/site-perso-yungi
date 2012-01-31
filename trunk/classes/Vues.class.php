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
    public $nom_categorie;
    public $nom_sous_categorie;
    public $contents = array();
    public $contentsHTML = array();
    public $titre_html;
    private $fichiers = array();

    public function Vues()
    {
        $this->categorie_id = NULL;
        $this->sous_categorie_id = NULL;
        $this->nom_categorie = NULL;
        $this->nom_sous_categorie = NULL;
        $this->contents = null;
        $this->titre_html = null;
    }

    public function getContent($id_categorie, $langue, $db, $oUser)
    {
        switch ($oUser->droit)
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
            $parametre = array(
                'select' => '*',
                'from' => "view_".$_SESSION['utilisateur']['nom_groupe']."_contenus", //concatene le nom de la vue avec celui du groupe de l'utilisateur
                'where' => "id_categorie = ".$id_categorie." AND langues_id_langue = ".$langue.""
            );            
        }else{
            $parametre = array(
                'select' => '*',
                'from' => "view_".$_SESSION['utilisateur']['nom_groupe']."_contenus",
                'where' => "id_categorie = 1 AND langues_id_langue = ".$langue.""
            );            
        }

        $contenus = $db->dataBaseSelect($parametre);

        //on gère la multiplicité des contenus possible
        if(!is_null($contenus))
        {
            for($i = 0; $i < count($contenus); $i++)
            {
                if(isset($contenus[$i]['contenu']) && !empty($contenus[$i]['contenu']))
                {
                    // le contenus est serialisez dans un objet JSON
                    //le paramètre TRUE => permet de renvoyer un tableau!!!
                    $contents_page[$i] = json_decode($contenus[$i]['contenu'], TRUE);
                    $contents_page[$i]['fichier_tpl'] = $contenus[$i]['nom_type_contenu'];
                    $contents_page[$i]['id_contenu'] = $contenus[$i]['id_contenu'];
                }else{
                    $contents_page[] = array('titre' => "Contenu vide!!!", 'contenu' => 'contenus par défaut', 'fichier_tpl' => 'page');
                }
            }
        }else{
            switch ($langue)
            {
                case 1:
                    $contents_page[] = array('titre' => "Contenu vide!!!", 'contenu' => 'contenus par défaut', 'fichier_tpl' => 'page');
                    ; break;
                case 2:
                    $contents_page[] = array('titre' => "Diese Seite ist leer!", 'contenu' => 'Default Seite', 'fichier_tpl' => 'page');
                    ; break;
                case 3:
                    $contents_page[] = array('titre' => "Empty content!!!", 'contenu' => 'Default content', 'fichier_tpl' => 'page');
                    ; break;
            }
        }

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

    public function getTemplate($oPage, $oSmarty)
    {
        foreach ($oPage->contents as $key => $value)
        {
            switch($value['fichier_tpl'])
            {
                case 'matrice' :
                    $myMatrice = new Matrice();
                    $tmp[$key] = $myMatrice->setMatrice(4, 10, 20, $value, 694, $oSmarty);
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

    public function getTitleHtml($id, $langue, $db)
    {
        if($id)
        {
            $parametre = array(
                'select' => 'titre_html',
                'from' => 'contenus',
                'where' => 'id_contenu = '.$id.' AND langues_id_langue = '.$langue
            );

            $tmp = $db->dataBaseSelect($parametre);
            $this->titre_html = $tmp[0]['titre_html'];

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