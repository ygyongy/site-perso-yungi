<?php
/* 
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
header('Content-Type: text/html; charset=utf-8');
$charset = "UTF-8";
require_once '../config.php';
require_once '../classes/DataBase.class.php';

$myDB = new DataBase();
$myDB->link = $myDB->dataBaseConnect();



$text = "je ne suis pas un héro's \" mais c'ette image me colle à la ^peau!
        SELECT * FROM users WHERE id_user = '' OR 1
        <script>alert('salut');</script>";

echo "<xmp>";
    echo $text;
echo "</xmp>";

echo "<xmp>";
    $output = htmlentities($text, ENT_QUOTES, $charset);
    echo $output;
echo "</xmp>";

echo "<xmp>";
    echo html_entity_decode($output);
echo "</xmp>";

echo "<xmp>";
    $output = addslashes($text);
    echo $output;
echo "</xmp>";

echo "<xmp>";
    $output = htmlspecialchars($text, ENT_QUOTES);
    echo $output;
echo "</xmp>";

echo "<xmp>";
    $output = mysql_real_escape_string($text);
    echo $output;
echo "</xmp>";

$myDB->dataBaseClose($myDB->link);
?>