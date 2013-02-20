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
    
    //L'affectation du dernier paramètre directement dans la déclaration permet de le rendre optionnel...
    public function setMenu($oListeMenu, $oLangue, $oDb, $oCategorieParent, $nom_categorie, $listeArray, $oSousCategorieParent = 0, $oPaginator = 0)
    {
        $tmp = $listeArray; // attribution du tableau de résultat à une variable
        $nb_items = count($tmp); //stock le nombre d'entrées pour chaque menu
        $tmp_id = null;

        switch(get_class($oListeMenu))
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

                         $tmp[$i]->lien_menu .= $nom_categorie."/";
                         
                         //condition en fonction de la profondeur du lien
                         //Si le dernier paramètre != 0, c'est que c'est un objet
                         if($oSousCategorieParent !== 0)
                         {
                             $test = get_class($oSousCategorieParent);
                             if($test === 'SousCategories')
                             {
                                 $tmp[$i]->lien_menu .= $oSousCategorieParent->getNomSousCategorie($oSousCategorieParent->getIdSousCategorie(), $oLangue->getIdLangue(), $oDb)."/";
                             }  
                         }
                         
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
                         
                         $tmp[$i]['lien_menu'] .= $oCategorieParent->getNomCategorie($oCategorieParent->getIdCategorie(), $oLangue->getIdLangue(), $oDb)."/";
                         var_dump($oListeMenu->getNomSousCategorie());
                         if($oListeMenu->getNomSousCategorie())
                         {
                             $tmp[$i]['lien_menu'] .= $oListeMenu->getNomSousCategorie().'/';
                         }
                         
                         $tmp[$i]['lien_menu'] .= $tmp[$i]['titre_url'];
                         
                     }else{
                         unset ($tmp[$i]);
                     }
                 }
                 break;

             case "Languages":
                
                 //permet de récupérer l'id de la categorie en cours
                 $tmp_id = $oCategorieParent->setIdCategorie($nom_categorie, $oLangue->getIdLangue(), $oDb);
                 
                 for ($i = 0; $i < $nb_items; $i++)
                 {
                     if(!empty($nom_categorie))
                     {                         
                         $tmp[$i]->lien_menu = SUB_DOMAIN.$tmp[$i]->code_langue.'/'.$oCategorieParent->getNomCategorie($tmp_id, $tmp[$i]->id_langue, $oDb).'/';
                     }else{
                         $tmp[$i]->lien_menu = SUB_DOMAIN.$tmp[$i]->code_langue.'/'.$oCategorieParent->getNomCategorie(1, $tmp[$i]->id_langue, $oDb).'/';
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
