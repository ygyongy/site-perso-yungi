<?php
header('Content-Type: text/html; charset=utf-8');
/* 
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
//require_once('../../PhpConsole/PhpConsole.php');
//PhpConsole::start();
 
$dsn = "mysql:host=localhost;port=3306;dbname=site_perso_yungi";
$username = "root";
$passwd = "";

try
{

    $connect = new PDO($dsn, $username, $passwd);
    $driver = $connect->getAvailableDrivers();
    $driver = $connect->getAttribute(PDO::ATTR_SERVER_VERSION);
    $connect->exec('Set Names UTF8');
    $querry = "SELECT DISTINCT * FROM contenus";
    $contenu = $connect->query($querry);
    $res = $contenu->fetchAll();
}
catch (PDOException $e)
{

    die ("Echec!!!<div style='color: red;'>".$e->getMessage()."</div>");
    
}



?>

<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="fr" lang="fr">
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
        <meta name="keywords" content="{*$keywords_website*}" />
        <meta name="description" content="{*$description_website*}" />
        <title></title>
        
        <link rel="stylesheet" type="text/css" href="{$css_path}main.css" />
        <link rel="stylesheet" type="text/css" href="{$css_path}form.css" />
        <link rel="stylesheet" type="text/css" href="{$css_path}{$template}.css" /> 
        <script type="text/javascript" src="{$js_path}md5.js"></script>
        <script type="text/javascript" src="{$ckeditor_path}ckeditor.js"></script>
    </head>
    <body>
<pre>
    <?php var_dump($res); ?>
</pre>
    </body>
</html>
