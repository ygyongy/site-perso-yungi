<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 * Structure des paramètres à envoyer à la classe form
 */

$form_parametre = array(
    'titre' => 'Ajout de contenu',
    'contenu' => array(
        'action' => $_SERVER['PHP_SELF'],
        'enctype' => 'text/plain',
        'method' => 'POST',
        'fields' => array(
            0 => array(
                'display_name' => "titre html",
                'template' => 'select',
                'class' => '',
                'id' => 'titre_html',
                'name' => 'titre_html',
                'value' => array(
                    1 => "Adresse principal",
                    2 => "Adresse d\'envoi",
                    3 => "Adresse de facturation"
                    )
                ),
            1 => array(
                'display_name' => "keywords html",
                'type' => 'input type = "text"',
                'class' => '',
                'id' => 'keywords',
                'name' => 'keywords',
                'value' => null
            ),
            2 => array(
                'display_name' => "titre de la bannière",
                'type' => 'input type = "text"',
                'class' => '',
                'id' => 'titre_banner',
                'name' => 'titre_banner',
                'value' => null
            ),
            3 => array(
                'display_name' => "sous-titre de la bannière",
                'type' => 'input type = "text" size=50',
                'class' => '',
                'id' => 'sous_titre_banner',
                'name' => 'sous_titre_banner',
                'value' => null
            ),
            4 => array(
                'type' => 'input type="submit"',
                'class' => '',
                'id' => 'submit',
                'name' => 'submit',
                'value' => 'envoyer donnees'
            )
         )

    )
);

$form_parametre = json_encode($form_parametre);
echo $form_parametre;

echo "<hr />";

var_dump(json_decode($form_parametre));
?>
