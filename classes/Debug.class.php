<?php
/* 
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Debug
 *
 * @author yungiii
 */
class Debug {
    public $printDebug;

    function Debug()
    {
        $this->printDebug = null;
        return true;
    }

    function p ($var)
    {
        echo "<pre>";
            var_dump($var);
        echo "</pre>";
    }
}
?>
