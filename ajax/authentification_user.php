<?php
session_start();

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 * 
 * 
 * la procedure d'authentificaiton doit commencer comme suit:
 * - réception du hash du mot de passe JS
 * - rechercher du mot de passe dans la BDD
 * - création de l'empreinte avec PHP md5($pwd_trouve)
 * - comparaison des empreintes si OK
 * - comparaison des empreintes suivant l'algorithme
 * 
 */
require_once '../classes/DataBase.class.php';
require_once '../classes/String.class.php';
require_once '../classes/User.class.php';

//connexion BDD
$myDb = new DataBase();
$myDb->link = $myDb->dataBaseConnect();

//récupération des infos du formulaire de login
$login = $_POST['login'];
$pwd = $_POST['pwd'];

$oLogin = new String();
$oPwd = new String();

$myUser = $_POST['oUser'];
$myUser = unserialize($myUser);

$myUserInfos = $myUser->getUser($login, $pwd, $oLogin, $oPwd, $myDb);

echo json_encode($myUserInfos);

$myDb->dataBaseClose($myDb->link);

if (!headers_sent())
{
    header('Content-type: application/json');
}

?>
