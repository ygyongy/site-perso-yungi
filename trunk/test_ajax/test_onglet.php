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
    <title>Un syst&egrave;me d'onglet en javascript</title>
    <script type="text/javascript">
        //<!--
                function change_onglet(name)
                {
                    document.getElementById('onglet_'+anc_onglet).className = 'onglet_0 onglet';
                    document.getElementById('onglet_'+name).className = 'onglet_1 onglet';
                    document.getElementById('contenu_onglet_'+anc_onglet).style.display = 'none';
                    document.getElementById('contenu_onglet_'+name).style.display = 'block';
                    anc_onglet = name;
                }
        //-->
        </script>
    <style type="text/css">
        .onglet
        {
                display:inline-block;
                margin-left:3px;
                margin-right:3px;
                padding:3px;
                border:1px solid #bbb;
                cursor:pointer;
				font-size: 16px;
        }
        .onglet_0
        {
                background:#ccc;
                border-bottom:1px solid #bbb;
        }
        .onglet_1
        {
                background:#eee;
                border-bottom:0px solid #bbb;
                padding-bottom:4px;
        }
        .contenu_onglet
        {
                background-color:#eee;
                border:1px solid #bbb;
                margin-top:-1px;
                padding:5px;
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
                <span class="onglet_0 onglet" id="onglet_intro_ajax" onclick="change_onglet('intro_ajax');">Intro Ajax</span>
                <span class="onglet_0 onglet" id="onglet_iframe_loading" onclick="change_onglet('iframe_loading');">iFrame Loading</span>
                <span class="onglet_0 onglet" id="onglet_gestion_evenement" onclick="change_onglet('gestion_evenement');">Gestion des événements</span>
            </div>
        <div class="contenu_onglets">
            <div class="contenu_onglet" id="contenu_onglet_intro_ajax">
		<?php require_once('intro_ajax.php');?>
            </div>
            <div class="contenu_onglet" id="contenu_onglet_iframe_loading">
                <?php require_once('iframe_loading.php');?>
            </div>
            <div class="contenu_onglet" id="contenu_onglet_gestion_evenement">
		<?php require_once('gestion_evenement.php');?>
            </div>
        </div>
    </div>
    <script type="text/javascript">
        //<!--
                var anc_onglet = 'intro_ajax';
                change_onglet(anc_onglet);
        //-->
        </script>
        
</body>
</html>