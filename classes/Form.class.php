<?php
/* 
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Form
 *
 * @author yungiii
 */
class Form {
    //put your code here
    private $action;
    private $method;
    private $enctype;
    private $fields;


    function  Form()
    {
        $this->action = NULL;
        $this->method = NULL;
        $this->enctype = NULL;
        $this->fields = NULL;
    }

    function setProperties($form)
    {

        if (count($form['contenu']['fields']) <= 0)
        {
            $this->action = $form['contenu']['action'];
            $this->method = $form['contenu']['method'];
            $this->enctype = $form['contenu']['enctype'];   

            foreach ($form['contenu']['fields'] as $key => $properties)
            { 
                $this->fields[] = $properties;
            }

            return $this;
        }else{
            return false;
        }
    }
}
?>
