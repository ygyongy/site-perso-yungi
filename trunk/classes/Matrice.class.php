<?php
/* 
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Matrice
 * La taille de la matrice est définie par le contenu
 * Pour le moment il n'y pas encore de pagination
 * @author yungiii
 */
class Matrice {
    private  $nb_colonnes = NULL;
    private  $nb_lignes = NULL;
    private $max_per_page = NULL;
    private $content = array();
    private  $width = NULL;

    function Matrice()
    {
        $this->nb_colonnes = NULL;
        $this->nb_lignes = NULL;
        $this->max_per_page = NULL;
        $this->content = NULL;
    }

    function setMatrice($cols, $lignes, $max, $content, $width, $smartyObject)
    {
        
        $this->nb_colonnes = $cols;
        $this->nb_lignes = $lignes;
        $this->max_per_page = $max;
        $this->content = $content;
        $this->width = $width;

        $smartyObject->assign('width', $this->width/$this->nb_colonnes);
        $smartyObject->assign('nb_colonnes', $this->nb_colonnes);

        return $this;
    }
}
?>
