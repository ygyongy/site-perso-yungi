<?php
/* 
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
require_once('../../PhpConsole/PhpConsole.php');
PhpConsole::start();

$dsn = "mysql:host=localhost;port=3306;dbname=site_perso_yungi";
$username = "root";
$passwd = "";

try
{

    $connect = new PDO($dsn, $username, $passwd);
    $driver = $connect->getAvailableDrivers();
    $driver = $connect->getAttribute(PDO::ATTR_SERVER_VERSION);
    $querry = "SELECT DISTINCT * FROM contenus";
    $contenu = $connect->query($querry);
    $res = $contenu->fetchAll();
}
catch (PDOException $e)
{

    die ("Echec!!!<div style='color: red;'>".$e->getMessage()."</div>");
    
}



?>
<pre>
    <?php var_dump($res); ?>
</pre>
