<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of String
 *
 * @author Yann
 */
class String {
    //put your code here
    private $string;
    
    public function String()
    {
        $this->string = null;
    }

    public function sanitize($s, $link)
    {
        $output = mysql_real_escape_string(trim($s), $link);
        $this->string = $output;
        return true;
    }
    
    public function getString()
    {
        return $this->string;
    }
    
    public function string2url($chaine) { 
        $chaine = trim($chaine); 
        $chaine = strtolower($chaine);
        $chaine = strtr($chaine, "ÀÁÂÃÄÅàáâãäåÒÓÔÕÖØòóôõöøÈÉÊËèéêëÇçÌÍÎÏìíîïÙÚÛÜùúûüÿÑñ", "aaaaaaaaaaaaooooooooooooeeeeeeeecciiiiiiiiuuuuuuuuynn"); 
        $chaine = preg_replace('#([^a-z0-9]+)#i', '-', $chaine); 
               $chaine = preg_replace('#-{2,}#','-',$chaine); 
               $chaine = preg_replace('#-$#','',$chaine); 
               $chaine = preg_replace('#^-#','',$chaine); 
        return $chaine; 
    }    
}

?>
