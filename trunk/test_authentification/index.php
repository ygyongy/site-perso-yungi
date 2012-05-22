<?php
    session_start();

    function setUser($_POST)
    {
        if($_POST && ($_POST['login_user'] !== '' && $_POST['password_user'] !== ''))
        {
            $_SESSION['user']['login'] = $_POST['login_user'];
            $_SESSION['user']['passord'] = $_POST['password_user'];
            return true;
        }else{
            return false;
        }
    }

    setUser($_POST);

    require_once '../classes/DataBase.class.php';
    require_once '../classes/Form.class.php';
    require_once '../classes/User.class.php';
    require_once 'view_form.php';
?>

<!DOCTYPE html>
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <title>Test authentification</title>
        
        <!-- chargement de JQuery -->
        <script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.7/jquery.min.js"></script>
        <script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jqueryui/1.8.12/jquery-ui.min.js"></script>
        <link rel="stylesheet" href="http://code.jquery.com/ui/1.8.20/themes/base/jquery-ui.css" type="text/css" media="all">
        <link rel="stylesheet" href="http://static.jquery.com/ui/css/demo-docs-theme/ui.theme.css" type="text/css" media="all">
        <link rel="stylesheet" href="../css/form.css" />
        <style>
            body{
                background-color: #E7E6E6;
                font-family: "Georgia";
                width: 600px;
                margin: auto;
            }
            
            label{
                font-variant: normal;
                padding: 0px;
            }
            
            ul{
                margin-left: -40px;
            }
            
            li{
                display: inline-block;
                width: 150px;
                border: 1px red solid;
                padding: 3px;
                text-align: center;
                background-color: darkred;
                color: white;
            }
            
            a, a:focus, a:active, a:hover{
                text-decoration: none;
                color: white;
                font-style: italic;
                font-weight: bold;
            }
            
            #fade{
                display: none; /*--masqué par défaut--*/
                background: #000;
                position: fixed; left: 0; top: 0;
                width: 100%; height: 100%;
                opacity: .80;
                z-index: 999;
            }
            
            .fenetre{
                background: #E7E6E6;
                padding: 15px;
                border: 5px #E7E6E6 solid;
                -moz-border-radius: 5px;
                -webkit-border-radius: 5px;
            }
            
            .ui-widget-overlay {
                background: black/*{bgColorOverlay}*/ ;
                opacity: .7;
            }
            
            .ui-dialog{
                background: #E7E6E6;
                padding: 5px;
                border: 5px #E7E6E6 solid;
                -moz-border-radius: 5px;
                -webkit-border-radius: 5px;                
            }
            
        </style>
    </head>
    <body>

            <ul id="menu_user">
                <li>
                    <a href="#" id="open_authentification" class="open">Login</a>
                </li>
                <li>
                    <a href="#" id="open_edition" class="open">Créer un compte</a>
                </li>
            </ul>
        
            <div id="fenetre_authentification" style="display: none;" class="fenetre"><?php require_once 'authentification_form.php'; ?></div>
            <div id="fenetre_edition" style="display: none;" class="fenetre"><?php require_once 'create_profile.php'; ?></div>  
    <?php
            echo "<pre>";
                print_r($_SESSION);
            echo "</pre>";
    
            require_once 'scripts_footer.html';
    ?>