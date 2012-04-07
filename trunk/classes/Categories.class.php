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
class Categories {
    public $nom_categorie;
    public $id_categorie;
    public $liste_categorie;

    public function Categories()
    {
        $this->nom_categorie = null;
        $this->id_categorie = null;
        $this->liste_categorie = array();
    }

    public function getCategorieList($oDb, $emplacement)
    {        
        $parametre = array(
            'select' => 'id_categorie, nom_categorie, langues_id_langue, position_categorie, emplacement_categorie',
            'from' => "view_".$_SESSION['utilisateur']['nom_groupe']."_menu",
            'where' => 'emplacement_categorie = "'.$emplacement.'"'
        );

        return $oDb->dataBaseSelect($parametre);
    }

    public function getNomCategorie($id, $id_langue, $db)
    {
        $arguments = array("select" => 'nom_categorie',
            "from" => 'categories c',
            "where" => 'c.id_categorie = '.$id.' AND langues_id_langue = '.$id_langue,
            "order by" => 'id_categorie DESC'
            );

        $record = $db->dataBaseSelect($arguments);
        
        if(count($record) === 1)
        {
            $this->nom_categorie = $record[0]['nom_categorie'];
        }else{
            $this->nom_categorie = false;
        }

        return $this->nom_categorie;
    }

    public function getIdCategorie($nom, $id_langue, $db)
    {
        $arguments = array("select" => 'id_categorie',
            "from" => 'categories c',
            "where" => 'c.nom_categorie = "'.$nom.'" AND langues_id_langue IN ('
            );
        
        $arguments2 = array("select" => 'id_langue',
            'from' => 'langues l',
            'where' => 'l.id_langue LIKE '.$id_langue.'',
            'order by' => 'l.code_langue'
        );

        $record = $db->dataBaseSelectImbrique($arguments, $arguments2);
        
        if(count($record) === 1)
        {
            $this->id_categorie = $record[0]['id_categorie'];
        }else{
            $this->id_categorie = 1;
        }

        return $this->id_categorie;
    }
}
?>
