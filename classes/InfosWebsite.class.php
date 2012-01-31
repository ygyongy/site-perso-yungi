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
    public $infosWebsiteListe = array();

    public function InfosWebsite()
    {
        $this->infosWebsiteListe = null;
        return true;
    }

    public function getInfosWebsite($db)
    {
        $parametres = array(
            'select' => '*',
            'from' => 'websites w'
        );

        return $db->dataBaseSelect($parametres);
    }
}
?>
