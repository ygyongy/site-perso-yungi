<?php
/* 
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Categories
 *
 * @author yungiii
 */
class Contenus {
    private $id_contenu;
    private $titre_url;
    private $liste_contenu;
    private $nom_categorie;
    private $nom_sous_categorie;

    public function Contenus()
    {
        $this->id_contenu = null;
        $this->titre_html_contenu = null;
        $this->liste_contenu = null;
        !isset($_GET['categorie']) ? $this->nom_categorie  = '' : $this->nom_categorie = $_GET['categorie'];
        !isset($_GET['sous_categorie']) ? $this->nom_sous_categorie = '' : $this->nom_sous_categorie = $_GET['sous_categorie'];
    }
    
    public function getListeContenu()
    {
        return $this->liste_contenu;
    }
    
    public function getNomCategorie()
    {
        return $this->nom_categorie;
    }
    
    public function getNomSousCategorie()
    {
        return $this->nom_sous_categorie;
    }    
    
    public function getTitreUrl()
    {
        return $this->titre_url;
    } 

    public function setContenus($oDb, $emplacement, $oUser, $contents)
    {        
        $parametre = array(
            'select' => 'id_sous_categorie, nom_sous_categorie, langues_id_langue, position_sous_categorie, emplacement_sous_categorie',
            //'from' => "view_".$_SESSION['utilisateur'][1]->nom_groupe."_menu",
            "from" => "sous_categories scat",
            'where' => 'emplacement_sous_categorie = "'.$emplacement.'"'
        );
        
        $this->liste_contenu = $oDb->dataBaseSelect($parametre);
        $liste_contenu_tmp = get_object_vars($this->liste_contenu[0]);
        unset($parametre);
        
        $nb_element = count($contents);
        //boucle sur les contenus afin d'avoir accès à leurs données
        for($i=0; $i<$nb_element; $i++)
        {
            $tmp[$i] = $liste_contenu_tmp;
            $tmp[$i]['titre_url'] = $contents[$i]['titre_url'];
            $tmp[$i]['contenus_id_contenu'] = $contents[$i]['id_contenu'];
        }
        $this->liste_contenu = null;
        $this->liste_contenu = $tmp;

        return true;
    }
    
    public function getIdContenu($contenu, $id_langue, $oDb)
    {        
        if(!empty($contenu))
        {
            $this->titre_url = $contenu;
            $parametre = array(
                'select' => 'id_contenu',
                'from' => "view_".$_SESSION['utilisateur'][1]->nom_groupe."_contenus",
                'where' => 'titre_url = "'.$this->titre_url.'" AND langues_id_langue = '.$id_langue
            );             
        }else{
            $parametre = array(
                'select' => 'id_contenu',
                'from' => "view_".$_SESSION['utilisateur'][1]->nom_groupe."_contenus",
                'where' => 'id_contenu = 1 AND langues_id_langue = '.$id_langue
            );            
        }
        
        $this->id_contenu = $oDb->dataBaseSelect($parametre);
        $this->id_contenu = $this->id_contenu[0]->id_contenu;
        unset($parametre);
        
        if(!$this->id_contenu)
        {
            $this->id_contenu = '1';
        }
        
        return $this->id_contenu;
    }
}
?>
