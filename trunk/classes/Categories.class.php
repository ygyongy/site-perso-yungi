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
    private $nom_categorie;
    private $id_categorie;
    private $liste_categorie;

    public function Categories()
    {
        $this->nom_categorie = null;
        $this->id_categorie = null;
        $this->liste_categorie = array();
    }
    
    public function getListeCategorie()
    {
        return $this->liste_categorie;
    }
    
    public function getIdCategorie()
    {
        return $this->id_categorie;
    }    

    public function setCategorieList(DataBase $oDb, $emplacement, User $oUser)
    {        
        $parametre = array(
            'select' => 'id_categorie, nom_categorie, langues_id_langue, position_categorie, emplacement_categorie',
            'from' => "view_".$_SESSION['utilisateur'][1]->nom_groupe."_menu",
            'where' => 'emplacement_categorie = "'.$emplacement.'"'
        );
        
        $tmp = $oDb->dataBaseSelect($parametre);
        
        if(is_array($tmp))
        {
            $this->liste_categorie = $tmp;
        }else{
            $this->liste_categorie = null;
        }
        
        return true;
    }

    public function getNomCategorie($id, $id_langue, DataBase $oDb)
    {
        $arguments = array("select" => 'nom_categorie',
            "from" => 'categories c',
            "where" => 'c.id_categorie = '.$id.' AND langues_id_langue = '.$id_langue,
            "order by" => 'id_categorie DESC'
            );

        $record = $oDb->dataBaseSelect($arguments);

        if(count($record) === 1)
        {
            $this->nom_categorie = $record[0]->nom_categorie;
        }else{
            $this->nom_categorie = false;
        }

        return $this->nom_categorie;
    }

    public function setIdCategorie($nom, $id_langue, DataBase $oDb)
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

        $record = $oDb->dataBaseSelectImbrique($arguments, $arguments2);
        
        if(count($record) === 1)
        {
            if(is_int($record[0]['id_categorie']))
            {
                $this->id_categorie = (int)$record[0]['id_categorie'];
            }else{
                $this->id_categorie = 1;
            }
            
        }else{
            $this->id_categorie = 1;
        }

        return $this->id_categorie;
    }
}
?>
