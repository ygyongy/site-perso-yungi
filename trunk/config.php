<?php
/* 
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

//Definitions des parametres PHP
error_reporting(E_ALL);
ini_set('display_errors', 1);

//Definitions des variables du site
!isset($_SESSION['template']) ? $template = 'classique' : $template = $_SESSION['template'];
!isset($_GET['langue']) ? $langue = '' : $langue = $_GET['langue'];
!isset($_GET['categorie']) ? $categorie = '' : $categorie = $_GET['categorie'];
!isset($_GET['article']) ? $article = '' : $article = $_GET['article'];
!isset($_GET['sous_categorie']) ? $sous_categorie = '' : $sous_categorie = $_GET['sous_categorie'];
!isset($site) ? $site = "/google_code_3/trunk/" : $site = "/google_code_3/trunk/";

//Definitions des constantes du site
define('SUB_DOMAIN', $site);
define ('TEMPLATE', $template);
define('INCLUDE_PATH', $_SERVER['DOCUMENT_ROOT'].SUB_DOMAIN.'includes/'.TEMPLATE.'/');
define('CSS_PATH', SUB_DOMAIN.'css/');
define('AJAX_PATH', SUB_DOMAIN.'ajax/');
define('IMG_PATH', $_SERVER['DOCUMENT_ROOT'].SUB_DOMAIN.'images/'.TEMPLATE.'/');
define('ATTACHMENTS_PATH', $_SERVER['DOCUMENT_ROOT'].SUB_DOMAIN.'includes/'.TEMPLATE.'/attachments/');
define('JS_PATH', SUB_DOMAIN.'lib/js/');

//Definitions des constantes SMARTY
define('SMARTY_DIR', './lib/php/smarty/');

//Definitions des constantes CKEDITOR
define('CKEDITOR_PATH', SUB_DOMAIN.'lib/js/ckeditor/');

//Gestion de la sécurité - constante a ajouté au hash MD5
define('KEY_MD5', 'Je ne_5ui5 pa5_un héro!');

//Gestion de la redirection au début
if (empty($langue) && empty($page))
{
    header('location: '.SUB_DOMAIN.'fr/Accueil/');
}

?>
