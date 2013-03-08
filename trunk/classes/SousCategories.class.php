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
class SousCategories {
    private $nom_sous_categorie;
    private $id_sous_categorie;
    private $categories_id_categorie;
    private $liste_sous_categorie;
    private $id_contenu_parent;

    public function SousCategories()
    {
        $this->nom_sous_categorie = null;
        $this->id_sous_categorie = null;
        $this->categories_id_categorie = null;
        $this->liste_sous_categorie = array();
        $this->id_contenu_parent = null;
    }

    public function setSousCategorieList($oDb, $id_categorie, $emplacement, $oUser)
    {        
        $parametre = array(
            'select' => 'id_sous_categorie, nom_sous_categorie, langues_id_langue, position_sous_categorie, emplacement_sous_categorie, categories_id_categorie',
            'from' => "view_".$_SESSION['utilisateur'][1]->nom_groupe."_sous_menu",
            'where' => 'emplacement_sous_categorie = "'.$emplacement.'" AND categories_id_categorie = '.$id_categorie.''
        );
        
        $this->liste_sous_categorie = $oDb->dataBaseSelect($parametre);
        
        return true;
    }
    
    public function getListeSousCategorie()
    {
        return $this->liste_sous_categorie;
    }
    
    public function getIdSousCategorie()
    {
        return $this->id_sous_categorie;
    }

        public function getContenuParent($id_contenu_parent, $id_langue, DataBase $oDb)
    {
        $arguments = array("select" => '*',
            "from" => "view_".$_SESSION['utilisateur'][1]->nom_groupe."_contenus", //concatene le nom de la vue avec celui du groupe de l'utilisateur
            'where' => "id_contenu = ".$id_contenu_parent." AND langues_id_langue = ".$id_langue.""
            );

        $record = $oDb->dataBaseSelect($arguments);
        return $record;
    }

    public function getNomSousCategorie($id, $id_langue, DataBase $oDb)
    {
        $arguments = array("select" => 'nom_sous_categorie',
            "from" => 'sous_categories sc',
            "where" => 'sc.id_sous_categorie = '.$id.' AND langues_id_langue = '.$id_langue,
            "order by" => 'id_sous_categorie DESC'
            );

        $record = $oDb->dataBaseSelect($arguments);

        if(count($record) === 1)
        {
            $this->nom_sous_categorie = $record[0]->nom_sous_categorie;
        }else{
            $this->nom_sous_categorie = false;
        }

        return $this->nom_sous_categorie;
    }

    public function setIdSousCategorie($nom, $id_langue, DataBase $oDb)
    {
        $arguments = array("select" => 'id_sous_categorie',
            "from" => 'sous_categories sc',
            "where" => 'sc.nom_sous_categorie = "'.$nom.'" AND langues_id_langue IN ('
            );
        
        $arguments2 = array("select" => 'id_langue',
            'from' => 'langues l',
            'where' => 'l.id_langue LIKE '.$id_langue.'',
            'order by' => 'l.code_langue'
        );

        $record = $oDb->dataBaseSelectImbrique($arguments, $arguments2);
        
        if(count($record) === 1)
        {
            $this->id_sous_categorie = $record[0]['id_sous_categorie'];
        }else{
            $this->id_sous_categorie = "0";
        }

        return $this->id_sous_categorie;
    }
}
?>
