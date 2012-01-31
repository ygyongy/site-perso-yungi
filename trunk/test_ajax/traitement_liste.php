<?php
/* 
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
header("Content-Type: text/xml");

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

    dataBaseConnect($host, $dbName, $user, $pwd);

$selected_id_categorie = $_POST['id_categorie'];

//création de la liste XML
echo "<liste>";
    if($selected_id_categorie)
    {
        $sql = "SELECT * FROM sous_categories s WHERE categories_id_categorie = ".  mysql_real_escape_string($selected_id_categorie) ." ORDER BY position_sous_categorie, nom_sous_categorie";

        $res = mysql_query($sql);
        
        while($row = mysql_fetch_assoc($res))
        {
            echo "<item id=\"".$row['id_sous_categorie']."\" name=\"".$row['nom_sous_categorie']."\" />";
        }
    }
echo "</liste>";
?>
