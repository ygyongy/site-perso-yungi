<?php
        $host = "localhost";
        $dbName = "site_perso_yungi";
        $user = "root";
        $pwd = "";

    function dataBaseConnect($host, $dbName, $user, $pwd)
    {
        if(mysql_connect($host, $user, $pwd))
        {
            $link = mysql_connect($host, $user, $pwd);
            $res = mysql_select_db($dbName);

            //permet de parametrer les connections entre la base est PHP en UTF-8
            $querry = "SET NAMES UTF8";
            if(mysql_query($querry))
            {
                $res = mysql_query($querry);
            }else{
                $res = false;
            }
        }else{
            $link = "Erreur de connection";
        }
            return $link;
    }

    function dataBaseClose($link)
    {
        $res = mysql_close($link);
        return $res;
    }
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <title>Un système d'onglet en JavaScript</title>
    <link rel="stylesheet" href="style_ajax.css" type="text/css" />
    <script type="text/javascript">
        //<!--
            function printContenu(id)
            {
                var id = id;
                el = document.getElementById(''+id+'');

                //Le parametre name passe le nom de l'onglet cliqué
                //old_onglet reçoit || garde le nom de l'ancien onglet
                document.getElementById(old_onglet).className = 'onglet_0 onglet';
                el.className = 'onglet_1 onglet';

                document.getElementById('contenu_' + old_onglet).style.display = 'none';
                document.getElementById('contenu_' + id).style.display = 'block';
                
                old_onglet = id;
            }

        //-->
    </script>
    
    <style type="text/css">
        .onglets
        {
            margin-bottom: -8px;
            margin-left: 5px;
            border-bottom: 1px #bbb solid;
        }
        
        .onglet
        {
                display:inline-block;
                margin-left:3px;
                margin-right:3px;
                padding:3px;
                border:1px solid #bbb;
                cursor:pointer;
		font-size: 11px;
                color: #8f8f73;
                font-family: Georgia;
        }
        
        .onglet_0
        {
                background:#ccc;
                border-bottom:1px solid #bbb;
        }
		
        .onglet_1
        {
                background:#eee;
                border-bottom: none;
                font-size: 12px;
                font-weight: bold;
                font-style: italic;
                padding-top: 14px;
                padding-bottom: 10px;
                color: dodgerblue;
                -moz-border-radius: 5px;
                -webkit-border-radius: 5px;
                text-decoration: underline;
                background: -webkit-gradient(linear, left top, left bottom, color-stop(0%,#ccc), color-stop(80%,#eee))            
        }
		
        .contenu_onglet
        {
                background-color:#eee;
                border:1px solid #bbb;
                margin-top:-1px;
                padding:15px;
                display:none;
        }
		
        ul
        {
                margin-top:0px;
                margin-bottom:0px;
                margin-left:-10px
        }

    </style>
    <script src="initAjax.js" type="text/javascript"></script>        
</head>
<body>
    <div class="systeme_onglets">
        <div class="onglets">
            <span class="onglet_0 onglet" id="intro_ajax" onclick="printContenu('intro_ajax');">Intro Ajax</span><span class="onglet_0 onglet" id="iframe_loading" onclick="printContenu('iframe_loading');">iFrame Loading</span><span class="onglet_0 onglet" id="array_object" onclick="printContenu('array_object');">Tableaux &amp; Objets</span><span class="onglet_0 onglet" id="manipulation_html" onclick="printContenu('manipulation_html');">Manipulation HTML 1</span><span class="onglet_0 onglet" id="manipulation_html_2" onclick="printContenu('manipulation_html_2');">Manipulation HTML 2</span><span class="onglet_0 onglet" id="gestion_evenement" onclick="printContenu('gestion_evenement');">Gestion Événements</span><span class="onglet_0 onglet" id="presentation_formulaire" onclick="printContenu('presentation_formulaire');">Présentation Formulaires</span><span class="onglet_0 onglet" id="manipulation_css" onclick="printContenu('manipulation_css');">Manipuler les CSS</span><span class="onglet_0 onglet" id="form_interactif" onclick="printContenu('form_interactif');">Mon 1er formulaire JS</span>
        </div>
        <div class="contenu_onglets">
            <div class="contenu_onglet" id="contenu_intro_ajax">
                <?php require_once('intro_ajax.php');?>
            </div>
            <div class="contenu_onglet" id="contenu_iframe_loading">
                <?php require_once('iframe_loading.php');?>
            </div>
            <div class="contenu_onglet" id="contenu_array_object">
                <?php require_once('array_and_object.php');?>
            </div>
            <div class="contenu_onglet" id="contenu_manipulation_html">
                <?php require_once('manipulation_html.php');?>
            </div>
            <div class="contenu_onglet" id="contenu_manipulation_html_2">
                <?php require_once('manipulation_html_2.php');?>
            </div>                  
            <div class="contenu_onglet" id="contenu_gestion_evenement">
		<?php require_once('gestion_evenement.php');?>
            </div>
            <div class="contenu_onglet" id="contenu_presentation_formulaire">
		<?php require_once('presentation_formulaire.php');?>
            </div>
            <div class="contenu_onglet" id="contenu_manipulation_css">
		<?php require_once('manipuler_les_css.php');?>
            </div>
            <div class="contenu_onglet" id="contenu_form_interactif">
		<?php require_once('form_interactif.php');?>
            </div> 
        </div>
    </div>
    <script type="text/javascript">
        //<!--
            //n'est chargé qu'une seule fois, lors du chargement de la page
            var old_onglet = 'form_interactif';
            printContenu(old_onglet);
        //-->
    </script>
        
</body>
</html>