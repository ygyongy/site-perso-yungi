<?php
/* 
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

$sleep = (isset($_POST["sleep"])) ? $_POST["sleep"] : NULL;

echo "Début de la sieste: ".date('h:i:s')."\n\n";

if($sleep)
{
    sleep($sleep);
}else{
    sleep(10);
}

echo "Fin de la sieste: ".date('h:i:s')."\n\n";

?>
