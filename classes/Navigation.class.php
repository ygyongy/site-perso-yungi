<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Navigation
 *
 * @author ygyongy
 */
class Navigation {
    //put your code here
    private $index_navigation = array();
        
    
    public function Navigation()
    {
        $this->index_navigation = null;
    }
    
    public function setNavigation($categorie, $sous_categorie, $detail)
    {
        //définition de la profondeur de la navigation
        $index_navigation_tmp = null;

        if(!empty($categorie))
        {
            $index_navigation_tmp[] = 'categorie';
            if(!empty($detail))
            {
                $index_navigation_tmp[] = 'contenus';
            }            
            
            if(!empty($sous_categorie))
            {
                $index_navigation_tmp[] = 'sous_categorie';
                if(!empty($detail))
                {
                    $index_navigation_tmp[] = 'contenus';
                }
            }
        }

        $this->index_navigation = $index_navigation_tmp;
        
        return true;
    }
    
    public function getIndex()
    {
        $tmp = null;
        $tmp = count($this->index_navigation);
        
        $index = $tmp - 1;
        return $this->index_navigation[$index];
    }
}

?>
