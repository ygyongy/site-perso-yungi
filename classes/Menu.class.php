<?php
/* 
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Menu
 *
 * @author yungiii
 */
class Menu {
    public $menuArray = array();
    public $menuTranslatedArray = array();
    public $menuParametres = array();
    public $translationMenuParametres = array();

    public function Menu()
    {
            $menuArray = null;
            $menuTranslatedArray = null;
            $menuParametres = null;
            $translationMenuParametres = null;
            return true;
    }

    public function getMenu($categorie, $langue, $db, $oCategorie, $page)
    {     

        switch(get_class($categorie))
         {
             case "Categories":
                 $tmp = $categorie->liste_categorie;
                 for ($i = 0; $i < count($categorie->liste_categorie); $i++)
                 {
                     if($categorie->liste_categorie[$i]->langues_id_langue === $langue->id_langue)
                     {
                         $tmp[$i]->lien_menu = SUB_DOMAIN.$langue->code_langue.'/'.$categorie->liste_categorie[$i]->nom_categorie.'/'; 
                     }else{
                         unset ($tmp[$i]);
                     }
                     
                 }
                 ; break;

             case "Languages":
                 $tmp = $categorie->liste_langue;
                 //permet de récupérer l'id de la categorie en cours
                 
                 $tmp_id = $oCategorie->getIdCategorie($page, $langue->id_langue, $db);
                 
                 for ($i = 0; $i < count($tmp); $i++)
                 {
                     if(!empty($page))
                     {                         
                         $tmp[$i]->lien_menu = SUB_DOMAIN.$tmp[$i]->code_langue.'/'.$oCategorie->getNomCategorie($tmp_id, $langue->liste_langue[$i]->id_langue, $db).'/';
                     }else{
                         $tmp[$i]->lien_menu = SUB_DOMAIN.$tmp[$i]->code_langue.'/'.$oCategorie->getNomCategorie(1, $langue->liste_langue[$i]->id_langue, $db).'/';
                     }
                 }
                 ; break;

             default:
                 return false;
                 ; break;
         }

        $this->menuArray = $tmp;
        unset ($tmp);
        return $this->menuArray;
    }
}
?>
