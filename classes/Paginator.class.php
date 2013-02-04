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

    public function getContentsPaginate($currentPage, $nbMaxParPage)
    {
        $nb_element = $this->nb_contenus;
        $dernier_element = $currentPage * $nbMaxParPage;
        $premier_element = $dernier_element - ($nbMaxParPage-1);
        
        for($i = $premier_element-1; $i <= $dernier_element-1; $i++)
        {
            $tmp_content['contenu'][$i] = $this->contenus_list[$i];
        }
        
        echo $premier_element;
        echo $dernier_element;
        print_r($tmp_content);
        return $tmp_content;
    }

    public function setPaginator($contenus, $nbMaxParPage, $string)
    {
        $this->contenus_list = $contenus['contenu'];
        $this->nb_max_par_page = $nbMaxParPage;
        $this->_getName = $string;
        
        $this->nb_contenus = count($this->contenus_list);
        
        //la fonction "ceil()" de PHP arrondi à l'entier suppérieur
        $this->nb_pages = ceil($this->nb_contenus/$this->nb_max_par_page);
        $this->last_page = (int)$this->nb_pages;
    }
    
    public function getPaginator()
    {
        if(isset($this->_getName) && $_GET[$this->_getName])
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
                $msg .= "<li><a href='".$this->first_page."' id=''>|&lt;</a></li>";
                $msg .= "<li><a href='".$this->previous_page."' id=''>prev.</a></li>";
            }
            
            $msg .= "<li><a href='".$i."' id='page_".$i."'>".$i."</a></li>";
            
            if($i === $this->last_page)
            {
                $msg .= "<li><a href='".$this->next_page."' id='tgests'>next</a></li>";
                $msg .= "<li><a href='".$this->last_page."' id='tests'>&gt;|</a></li>";
            }
        }
        $msg .= "</ul>";
        
        $this->output = $msg;
        
        return $this->output;
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
