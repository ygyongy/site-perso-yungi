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
    private $titre;
    private $id_fieldset;
    private $name_form;
    private $action;
    private $method;
    private $enctype;
    private $id_form;
    private $evenement_form;
    private $class_form;
    private $fields;


    function  Form($titre_fieldset='Test admin', $id_fieldset='default_admin', $name_form='default_admin', $param_action='#', $param_method='POST', $param_enctype='application/x-www-form-urlencoded', $param_id_form='admin_form',$param_evenement_form='onsubmit=\'return false\'', $param_class='default_admin_form')
    {
        $this->titre = $titre_fieldset;
        $this->id_fieldset = $id_fieldset;
        $this->name_form = $name_form;
        $this->action = $param_action;
        $this->method = $param_method;
        $this->enctype = $param_enctype;
        $this->id_form = $param_id_form;
        $this->evenement_form = $param_evenement_form;
        $this->class_form = $param_class;
        $this->fields = NULL;
    }
    
    function getAction()
    {
        return $this->action;
    }
    
    function getMethod()
    {
        return $this->method;
    }
    
    function getEnctype()
    {
        return $this->enctype;
    }
    
    function getFields()
    {
        return $this->fields;
    }
    
    function getFormatedContent(array $aForm, DataBase $oDb, $nom_sous_categorie, $nom_ok='ok', $nom_cancel='cancel')
    {
        //formater le contenu au format du formulaire
            $tableau_retour = null;
            $test = null;
            $test2 = null;
            $select_values = null;
            
            $tableau_retour = array(
                'titre' => '',
                'id_fieldset' => '',
                'contenu' => array(
                    'action' => '',
                    'enctype' => '',
                    'method' => '',
                    'id' => '',
                    'evenement_form' => '',
                    'class' => ''
                )
            );
            
            //retourne un tableau avec tous les champs de la table
            //me permettra ensuite de définir quel type de champ j'ai besoin
            $fields_table_db = $oDb->getFieldsTable($nom_sous_categorie);
            foreach ($fields_table_db as $index => $infos)
            {
                //permet d'aiguiller les champs en fonction du type
                //la bdd
                $test = explode('(', $infos->Type);
                $test2 = explode(')', $test[1]);
                
                //on test pour savoir si c'est un type ENUM
                //afin de récupérer un tableau de valeur a passer au formulaire
                if(strtolower($test[0]) === 'enum' && strpbrk($test2[0], ','))
                {
                    $select_values = explode(',', $test2[0]);
                }
                
                $test[1] = $test2[0];
                $field_restriction[] = $test;
            }
            
            //construction du contenu de type formulaire
            //en tenant compte des colonnes de la table
            $form_array = null;
            
            $tableau_retour['titre'] = $this->titre;
            $tableau_retour['id_fieldset'] = $this->id_fieldset;            
            $tableau_retour['contenu']['action'] = $this->action;
            $tableau_retour['contenu']['enctype'] = $this->enctype;
            $tableau_retour['contenu']['method'] = $this->method;
            $tableau_retour['contenu']['id'] = $this->id_form;
            $tableau_retour['contenu']['name_form'] = $this->name_form;
            $tableau_retour['contenu']['evenement_form'] = $this->evenement_form; 
            $tableau_retour['contenu']['class'] = $this->class_form;
            
            foreach($aForm as $key => $liste_fields)
            {
                 $aForm[$key]->nom_ok = $nom_ok;
                 $aForm[$key]->nom_cancel = $nom_cancel;

                if(is_object($liste_fields))
                {
                    $form_array[$key] = get_object_vars($liste_fields);
                }else{
                    $form_array[$key] = $liste_fields;
                }

                // $form_array[$key] Contient la réponse SQL au format array
                // Il nous faut maintenant distribuer ce contenu dans les bons
                // champs du tableau de contenu formulaire
                !isset($form_array[$key]['action']) ? $this->action = $this->action : $this->action = $form_array[$key]['action'];
                !isset($form_array[$key]['enctype']) ? $this->enctype = $this->enctype : $this->enctype = $form_array[$key]['enctype'];
                !isset($form_array[$key]['method']) ? $this->method = $this->method : $this->method = $form_array[$key]['method'];
                !isset($form_array[$key]['id']) ? $this->id_form = $this->id_form : $this->id_form = $form_array[$key]['id'];
                !isset($form_array[$key]['evenement_form']) ? $this->evenement_form = $this->evenement_form : $this->evenement_form = $form_array[$key]['evenement_form'];
                
                //je créé le tableaux contenant les informaions sur les colonnes
                //des tables. Le compteur "$i" me permet de tourner dans le tableau de type de champ
                $field_tmp = null;
                $value_liste = null;
                $i = 0;
                
                foreach($form_array[$key] as $name_field => $field)
                { 
                    switch($field_restriction[$i][0])
                    {
                        case 'int':
                                $field_tmp[$name_field]['template'] = 'input';
                                $field_tmp[$name_field]['type'] = 'text';
                            ; break;
                        
                        case 'varchar':
                                if($field_restriction[$i][1] <= '100')
                                {
                                    $field_tmp[$name_field]['template'] = 'input';
                                    $field_tmp[$name_field]['type'] = 'text'; 
                                }else{
                                    $field_tmp[$name_field]['template'] = 'textarea';
                                    $field_tmp[$name_field]['type'] = 'text';
                                }                     
                            ; break;
                        
                        case 'longtext':
                                $field_tmp[$name_field]['template'] = 'textarea';
                                $field_tmp[$name_field]['type'] = 'text';
                            ; break;
                        
                        case 'enum':
                                $field_tmp[$name_field]['template'] = 'select';
                                //ajouter le tableau de valeur
                                //$select_values
                                $value_liste = $select_values;
                                $field_tmp[$name_field]['type'] = 'text';
                            ; break;
                        
                        case 'timestamp':
                                $field_tmp[$name_field]['template'] = 'input';
                                $field_tmp[$name_field]['type'] = 'text';                            
                            ; break;
                        
                        default :
                                $field_tmp[$name_field]['template'] = 'input';
                                $field_tmp[$name_field]['type'] = 'text';
                            ; break;
                    }
                    
                    if($name_field === 'nom_ok' || $name_field === 'nom_cancel')
                    {
                        $field_tmp[$name_field]['template'] = 'input';
                        
                        if($name_field === 'nom_cancel')
                        {
                            $field_tmp[$name_field]['type'] = 'reset';
                        }else{
                            $field_tmp[$name_field]['type'] = 'submit';
                        }
                    }
                    
                    $tableau_retour['contenu']['fields'][$i] = array(
                                                        'display_name' => (ucfirst(str_replace('_', ' ', $name_field))),
                                                        'template' => $field_tmp[$name_field]['template'],
                                                        'type' => $field_tmp[$name_field]['type'],
                                                        'class' => '',
                                                        'id' => $name_field."_".trim($form_array[$key]['id_utilisateur']),
                                                        'tooltip' => '',
                                                        'name' => $name_field,
                                                        'value_liste' => $value_liste,
                                                        'value' => $field
                                                    );
                    
                    $i++;
                }
            }

            if(count($tableau_retour) !== 0)
            {
                return $tableau_retour;
            }else{
                return false;
            }          
    }

    function setProperties(array $aForm, DataBase $oDb = null, $nom_sous_categorie = 0, $nom_ok = 0, $nom_cancel = 0)
    {
        //Ici on fait un test pour savoir si le contenu est déjà encodé
        //en JSON type "formulaire" SINON on le génère
        if (count($aForm['contenu']['fields']) > 0)
        {
            $this->action = $aForm['contenu']['action'];
            $this->method = $aForm['contenu']['method'];
            $this->enctype = $aForm['contenu']['enctype'];   

            foreach ($aForm['contenu']['fields'] as $key => $properties)
            { 
                $this->fields[] = $properties;
            }

            return $this;
            
        }elseif (count($aForm) > 0 && count($aForm) < 2){
            $test = $this->getFormatedContent($aForm, $oDb, $nom_sous_categorie, $nom_ok, $nom_cancel);
            $this->fields = $test['contenu'];
            return $this;
        }else{
            return false;
        }
        return $this;
    }
}
?>
