<?php
/* 
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of SmartyYungi
 *
 * @author yungiii
 */

require_once SMARTY_DIR.'Smarty.class.php';


class SmartyYungi extends Smarty {

    function SmartyYungi()
    {
        $this->Smarty();
        $this->template_dir = INCLUDE_PATH.'templates/';
        $this->compile_dir = INCLUDE_PATH.'templates_c/';
        $this->config_dir = INCLUDE_PATH.'configs/';
        $this->cache_dir = INCLUDE_PATH.'cache/';

        $this->caching = FALSE;
        $this->assign('app_name', 'site_perso_yungi');
    }
    
}
?>
