<?php
/**
 * Description of DataBase
 * classe permettant de faire abstraction de la gestion de la BDD
 * connection, fermeture, select, insert, update, delete
 * @author yungiii
 */
class DataBase {
    private $host;
    private $dbName;
    private $user;
    private $pwd;
    public $link;
    public $sql = array();

    function DataBase()
    {
        $this->host = "localhost";
        $this->dbName = "site_perso_yungi";
        $this->user = "root";
        $this->pwd = "";
    }

    function dataBaseConnect()
    {
        if(mysql_connect($this->host, $this->user, $this->pwd))
        {
            $link = mysql_connect($this->host, $this->user, $this->pwd);
            $res = mysql_select_db($this->dbName);

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

    function dataBaseSelect($arguments)
    {
        //construction de la requete
        $query = "SELECT ".$arguments['select']." FROM ".$arguments['from']."";

        if(isset($arguments['where']) && !is_null($arguments['where']) && !empty($arguments['where']))
        {
            $query .=  " WHERE ".$arguments['where'];
        }

        if(isset($arguments['order by']) && !is_null($arguments['order by']) && !empty($arguments['order by']))
        {
            $query .=  " ORDER BY ".$arguments['order by'];
        }

        if(isset($arguments['limit']) && !is_null($arguments['limit']) && !empty($arguments['limit']))
        {
            $query .= " LIMIT ".$arguments['limit'];
        }

        if(mysql_query($query))
        {
            $res = mysql_query($query);

            while($line = mysql_fetch_assoc($res))
            {
                $tmp[] = $line;
            }


            if(isset($tmp) && count($tmp)> 0)
            {
                mysql_free_result($res);
                return $tmp;
            }
        }else{
            return false;
        }
    }

    function dataBaseSelectImbrique($arguments, $arguments2)
    {
        //construction de la requete
        $query = "SELECT ".$arguments['select']." FROM ".$arguments['from']." WHERE ".$arguments['where']."";
            $query .= "SELECT ".$arguments2['select']. " FROM ".$arguments2['from']." WHERE ".$arguments2['where'].""; //requete imbriquée
        $query .= ")";

        if(isset($arguments['order by']) && !is_null($arguments['order by']) && !empty($arguments['order by']))
        {
            $query .= "ORDER BY ".$arguments['order by']."";
        }

        if(isset($arguments['limit']) && !is_null($arguments['limit']) && !empty($arguments['limit']))
        {
            $query .= " LIMIT ".$arguments['limit']."";
        }

        if(mysql_query($query))
        {
            $res = mysql_query($query);
			$tmp = NULL;
			
            while($line = mysql_fetch_assoc($res))
            {
                $tmp[] = $line;
            }

            if(count($tmp)> 0)
            {
                mysql_free_result($res);
                return $tmp;
            }
        }else{
            return false;
        }
    }
    
    function dataBaseInsert($arguments)
    {
        $query = NULL;
        $query = "INSERT INTO ".$arguments['table']."";
        $query .= "";
    }
    
    function dataBaseUpdate($arguments)
    {
        $query = NULL;
        $query = "UPDATE ".$arguments['table']." ";
        $query .= "SET ";
        
            $query .= $arguments['id_field'];
            $query .= " = ";
            $query .= "'".$arguments['value']."'";
        
        $query .= "WHERE ";
        $query .= $arguments['id_field']['id'];
        $query .= " = ";
        $query .= $arguments['value']['id'];
        $query .= " AND ";
        $query .= $arguments['id_field']['langues_id_langue'];
        $query .= " = ";
        $query .= $arguments['value']['langues_id_langue'];
    }


    
}
?>
