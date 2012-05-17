<?php
/* 
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of InfosWebsite
 *
 * @author yungiii
 */
class InfosWebsite {
    private $infosWebsiteListe = array();

    public function InfosWebsite()
    {
        $this->infosWebsiteListe = null;
        return true;
    }
    
    public function getInfosWebsite()
    {
        return $this->infosWebsiteListe;
    }

    public function setInfosWebsite($db)
    {
        $parametres = array(
            'select' => '*',
            'from' => 'websites w'
        );
        
        $this->infosWebsiteListe = $db->dataBaseSelect($parametres);
        return true;
    }
}
?>
