    <?php
    $myFormUser = new Form();

    $form_parametre = array(
    'titre' => 'Formulaire de votre profil',
    'contenu' => array(
        'action' => $_SERVER['PHP_SELF'],
        'enctype' => 'text/plain',
        'method' => 'POST',
        'fields' => array(
            0 => array(
                'display_name' => "Login :",
                'type' => 'input type="text"',
                'id' => 'create_login_user',
                'name' => 'create_login_user',
                'value' => null
            ),
            1 => array(
                'display_name' => "Password :",
                'type' => 'input type="text"',
                'id' => 'create_password_user',
                'name' => 'create_password_user',
                'value' => null
            ),
            2 => array(
                'display_name' => "Vérification Password :",
                'type' => 'input type="text"',
                'id' => 'verif_password_user',
                'name' => 'verif_password_user',
                'value' => null
            ),
            3 => array(
                'type' => 'input type="submit"',
                'id' => 'submit',
                'name' => 'submit',
                'value' => 's\'enregistrer'
            ),
            4 => array(
                'type' => 'input type="reset"',
                'class' => '',
                'id' => 'reset',
                'name' => 'reset',
                'value' => 'annuler'
            )            
         )

    )
);
    
$myFormUser = $myFormUser->setProperties($form_parametre);
$action = $myFormUser->getAction();
$method = $myFormUser->getMethod();
$enctype = $myFormUser->getEnctype();
$fields = $myFormUser->getFields();
?>

<?php
    printCoreForm($form_parametre, $action, $method, $enctype, $fields);
?>