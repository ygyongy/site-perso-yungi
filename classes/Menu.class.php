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
    private $menuArray = array();
    private $menuTranslatedArray = array();
    private $menuParametres = array();
    private $translationMenuParametres = array();

    public function Menu()
    {
            $menuArray = null;
            $menuTranslatedArray = null;
            $menuParametres = null;
            $translationMenuParametres = null;
            return true;
    }
    
    public function getMenuArray()
    {
        return $this->menuArray;
    }

    public function setMenu($categorie, $oLangue, $db, $oCategorie, $page, $listeArray)
    {
        $tmp = $listeArray; // attribution du tableau de résultat à une variable
        $nb_items = count($tmp); //stock le nombre d'entrées pour chaque menu
        $tmp_id = null;

        switch(get_class($categorie))
         {
             case "Categories":
                 //permet de stocker l'id de la langue pour le test des catégories
                 $tmp_id = $oLangue->getIdLangue();
                 
                 for ($i = 0; $i < $nb_items; $i++)
                 {
                     if($tmp[$i]->langues_id_langue === $tmp_id)
                     {
                         $tmp[$i]->lien_menu = SUB_DOMAIN.$oLangue->getCodeLangue().'/'.$tmp[$i]->nom_categorie.'/'; 
                     }else{
                         unset ($tmp[$i]);
                     }
                 }
                 
                 ; break;
                 
             case "SousCategories":
                 //permet de stocker l'id de la langue pour le test des catégories
                 $tmp_id = $oLangue->getIdLangue();

                 for ($i = 0; $i < $nb_items; $i++)
                 {
                     if($tmp[$i]->langues_id_langue === $tmp_id)
                     {
                         $tmp[$i]->lien_menu = SUB_DOMAIN.$oLangue->getCodeLangue().'/';
                         
                         $tmp[$i]->lien_menu .= $oCategorie->getNomCategorie($tmp[$i]->categories_id_categorie, $oLangue->getIdLangue(), $db)."/";
                         
                         $tmp[$i]->lien_menu .= $tmp[$i]->nom_sous_categorie.'/';
                         
                     }else{
                         unset ($tmp[$i]);
                     }
                 }
                 
                 ; break;
                 
             case "Contenus":
                 //permet de stocker l'id de la langue pour le test des catégories
                 $tmp_id = $oLangue->getIdLangue();
                 
                 for ($i = 0; $i < $nb_items; $i++)
                 {
                     if($tmp[$i]['langues_id_langue'] === $tmp_id)
                     {
                         $tmp[$i]['lien_menu'] = SUB_DOMAIN.$oLangue->getCodeLangue().'/';
                         
                         $tmp[$i]['lien_menu'] .= $oCategorie->getNomCategorie($oCategorie->getIdCategorie(), $oLangue->getIdLangue(), $db)."/";
                         
                         if($categorie->getNomSousCategorie())
                         {
                             $tmp[$i]['lien_menu'] .= $categorie->getNomSousCategorie().'/';
                         }
                         
                         $tmp[$i]['lien_menu'] .= $tmp[$i]['titre_url'];
                         
                     }else{
                         unset ($tmp[$i]);
                     }
                 }
                 break;

             case "Languages":
                
                 //permet de récupérer l'id de la categorie en cours
                 $tmp_id = $oCategorie->setIdCategorie($page, $oLangue->getIdLangue(), $db);
                 
                 for ($i = 0; $i < $nb_items; $i++)
                 {
                     if(!empty($page))
                     {                         
                         $tmp[$i]->lien_menu = SUB_DOMAIN.$tmp[$i]->code_langue.'/'.$oCategorie->getNomCategorie($tmp_id, $tmp[$i]->id_langue, $db).'/';
                     }else{
                         $tmp[$i]->lien_menu = SUB_DOMAIN.$tmp[$i]->code_langue.'/'.$oCategorie->getNomCategorie(1, $tmp[$i]->id_langue, $db).'/';
                     }
                 }
                 ; break;

             default:
                 return false;
                 ; break;
         }

        $this->menuArray = $tmp;
        
        unset ($tmp);
        return true;
    }
}
?>
