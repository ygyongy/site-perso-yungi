<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 * 
 * Le but de cette classe est de pouvoir ségmenter du contenu
 * avec un nombre défini par page et plus si affinités... ;-)
 */


class Paginator {
    //put your code here
    private $contenus_list = array(); //type array
    private $nb_contenus;
    private $nb_max_par_page;
    private $nb_pages;
    private $_getName; //permet de spécifier la variable a récupérer dans l'url
    private $page_en_cours;
    private $next_page;
    private $previous_page;
    private $first_page;
    private $last_page;
    private $output; //contenu HTML


    public function Paginator()
    {
        $this->contenus_list = null;
        $this->nb_max_par_page = 0;
        $this->nb_pages = 0;
        $this->_getName = null;
        $this->page_en_cours = 0;
        $this->next_page = 0;
        $this->previous_page = 0;
        $this->first_page = 1;
        $this->last_page = 0;
    }
    
    public function getPageEnCour()
    {
        return $this->page_en_cours;
    }
    
    public function getNbMaxParPage()
    {
        return $this->nb_max_par_page;
    }

    public function setPaginator($contenu_to_paginate, $nbMaxParPage, $string)
    {
        
        $this->contenus_list = $contenu_to_paginate['contenus'];
        $this->nb_max_par_page = $nbMaxParPage;
        $this->_getName = $string;
        
        $this->nb_contenus = count($this->contenus_list);
        
        //la fonction "ceil()" de PHP arrondi à l'entier suppérieur
        $this->nb_pages = (int)ceil($this->nb_contenus/$this->nb_max_par_page);
        $this->last_page = (int)$this->nb_pages;
    }
    
    public function getContentsPaginate($currentPage, $nbMaxParPage, $contents)
    {
        $nb_element = count($contents['contenus']);

        $dernier_element = $currentPage * $nbMaxParPage;
        $premier_element = $dernier_element - ($nbMaxParPage-1);

        for($i = $premier_element-1; $i <= $dernier_element-1; $i++)
        {
            $tmp_content[] = $contents['contenus'][$i];

            if($i >= $nb_element-1)
            {
               break;
            }            
        }

        return $tmp_content;
    }    
    
    public function getPaginator($nb_element_parent)
    {
        if(isset($this->_getName) && !empty($_GET[$this->_getName]))
        {
            $pageEnCours = $_GET[$this->_getName];
        }else{
            $pageEnCours = 1;
        }
        
        $this->page_en_cours = (int)$pageEnCours;
        $this->setFirstLast($this->page_en_cours);

        //initialisation de la liste de liens
        $msg = null;
        $msg = "<ul>";

        for ($i = 1; $i <= $this->nb_pages; $i++)
        {
            if($i === $this->first_page)
            {
                //condition vitale qui me permet de savoir si je dois passer une sous-pagination ou non.
                //Dans le cas d'un "include" par exemple je n'ai qu'un contenu... je dois donc modifier le le liens
                if($nb_element_parent === 1 || $this->_getName === 'sous_paginator')
                {
                    $msg .= "<li><a href='".SUB_DOMAIN."".$_GET['langue']."/".$_GET['categorie'];
                    if(!empty($_GET['sous_categorie']))
                    {
                        $msg .= "/".$_GET['sous_categorie'];
                    }   
                    $msg .= "/1/".$this->first_page."' id=''>|&lt;</a></li>";
                    
                    $msg .= "<li><a href='".SUB_DOMAIN."".$_GET['langue']."/".$_GET['categorie'];
                    if(!empty($_GET['sous_categorie']))
                    {
                        $msg .= "/".$_GET['sous_categorie'];
                    }   
                    $msg .= "/1/".$this->previous_page."' id=''>prev.</a></li>";
                }else{
                    $msg .= "<li><a href='".SUB_DOMAIN."".$_GET['langue']."/".$_GET['categorie'];
                    if(!empty($_GET['sous_categorie']))
                    {
                        $msg .= "/".$_GET['sous_categorie'];
                    } 
                    $msg .= "/".$this->first_page."' id=''>|&lt;</a></li>";
                    
                    $msg .= "<li><a href='".SUB_DOMAIN."".$_GET['langue']."/".$_GET['categorie'];
                    if(!empty($_GET['sous_categorie']))
                    {
                        $msg .= "/".$_GET['sous_categorie'];
                    }
                    $msg .= "/".$this->previous_page."' id=''>prev.</a></li>";                    
                }
            }
            
            
            if($nb_element_parent === 1 || $this->_getName === 'sous_paginator')
            {
                $msg .= "<li><a href='".SUB_DOMAIN."".$_GET['langue']."/".$_GET['categorie'];
                if(!empty($_GET['sous_categorie']))
                {
                    $msg .= "/".$_GET['sous_categorie'];
                }                 
                $msg .= "/1/".$i."' id='page_".$i."'>".$i."</a></li>";
            }else{
                $msg .= "<li><a href='".SUB_DOMAIN."".$_GET['langue']."/".$_GET['categorie'];
                if(!empty($_GET['sous_categorie']))
                {
                    $msg .= "/".$_GET['sous_categorie'];
                }                 
                $msg .= "/".$i."' id='page_".$i."'>".$i."</a></li>";
            }
            
            if($i === $this->last_page)
            {
                if($nb_element_parent === 1 || $this->_getName === 'sous_paginator')
                {
                    $msg .= "<li><a href='".SUB_DOMAIN."".$_GET['langue']."/".$_GET['categorie'];
                    if(!empty($_GET['sous_categorie']))
                    {
                        $msg .= "/".$_GET['sous_categorie'];
                    }                     
                    $msg .= "/1/".$this->next_page."' id='tgests'>next</a></li>";
                    
                    $msg .= "<li><a href='".SUB_DOMAIN."".$_GET['langue']."/".$_GET['categorie'];
                    if(!empty($_GET['sous_categorie']))
                    {
                        $msg .= "/".$_GET['sous_categorie'];
                    }                     
                    $msg .= "/1/".$this->last_page."' id='tests'>&gt;|</a></li>";                
                }else{
                    $msg .= "<li><a href='".SUB_DOMAIN."".$_GET['langue']."/".$_GET['categorie'];
                    if(!empty($_GET['sous_categorie']))
                    {
                        $msg .= "/".$_GET['sous_categorie'];
                    }                     
                    $msg .= "/".$this->next_page."' id='tgests'>next</a></li>";
                    
                    $msg .= "<li><a href='".SUB_DOMAIN."".$_GET['langue']."/".$_GET['categorie'];
                    if(!empty($_GET['sous_categorie']))
                    {
                        $msg .= "/".$_GET['sous_categorie'];
                    }                     
                    $msg .= "/".$this->last_page."' id='tests'>&gt;|</a></li>";                    
                }

            }
        }
        $msg .= "</ul>";
        
        $this->output = $msg;
  
        if($this->nb_pages === 1)
        {
            return false;
        }else{
            return $this->output;
        }
        
    }
    
    function setFirstLast($pageEnCours)
    {

        if(is_int((int)$pageEnCours))
        {
            switch ($pageEnCours)
            {
                case $pageEnCours >= $this->last_page:
                    $this->next_page = $this->first_page;
                    if($this->last_page !== $this->first_page)
                    {
                        $this->previous_page = $this->last_page - 1;
                    }else{
                        $this->previous_page = $this->first_page;
                    }   
                    ; break;
                
                case $pageEnCours <= $this->first_page:
                    $this->previous_page = $this->last_page;
                    if($this->first_page !== $this->last_page)
                    {
                        $this->next_page = $this->first_page + 1;
                    }else{
                        $this->next_page = $this->first_page;
                    }
                    ; break;
                
                default :
                    
                    if($this->first_page !== $this->last_page)
                    {
                        $this->next_page = $pageEnCours + 1;
                    }else{
                        $this->next_page = $pageEnCours;
                    }

                    if($this->last_page !== $this->first_page)
                    {
                        $this->previous_page = $pageEnCours - 1;
                    }else{
                        $this->previous_page = $pageEnCours;
                    }
                    ; break;
            }
        }        
    }
}
?>
