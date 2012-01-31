<?php
/* 
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

header("Content-Type: text/plain");

$variable1 = (isset($_GET["variable1"])) ? $_GET["variable1"] : NULL;
$variable2 = (isset($_GET["variable2"])) ? $_GET["variable2"] : NULL;

if ($variable1 && $variable2) {
        // Faire quelque chose...
        echo $variable1.$variable2;
} else {
        echo "FAIL";
}

?>
