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
    private $link;
    private $sql = array();

    function DataBase()
    {
        $this->host = "localhost";
        $this->dbName = "site_perso_yungi";
        $this->user = "root";
        $this->pwd = "";
    }
    
    public function getLink()
    {
        return $this->link;
    }
    
    public function getSql()
    {
        return $this->sql;
    }
    
    private function getPDOObject()
    {
        $dsn = "mysql:host=".$this->host.";port=3306;dbname=".$this->dbName."";
        $parametres = array(PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8");
        $username = $this->user;
        $passwd = $this->pwd;

        try
        {
            $PDOObject = new PDO($dsn, $username, $passwd);
            $driver = $PDOObject->getAvailableDrivers();
            $driver = $PDOObject->getAttribute(PDO::ATTR_SERVER_VERSION);
            $PDOObject->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            return $PDOObject;
        }
        catch (PDOException $e)
        {
            die ("Echec!!!<div style='color: red;'>".$e->getMessage()."</div>");
            return false;
        }        
    }

    public function dataBaseConnect()
    {
        $bdd = $this->getPDOObject();
        
        $link = mysql_connect($this->host, $this->user, $this->pwd);
        $res = mysql_select_db($this->dbName);

        if($res !== false)
        {
            unset ($bdd);
        }else{
            return false;
        }
        $this->link = $link;
        
        return true;
    }

    public function dataBaseClose($link)
    {
        $res = mysql_close($link);
        return $res;
    }

    public function dataBaseSelect($arguments)
    {
        //création de l'objet PDO
        $bdd = $this->getPDOObject();

        //permet de parametrer les connections entre la base est PHP en UTF-8
        $query = "Set Names utf8";
        $bdd->exec($query);        

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
//echo $query."<br><br><br><br><br><br>";
        try{
            $res = $bdd->query($query);
            $res->setFetchMode(PDO::FETCH_OBJ);            
        }  catch (Exception $e){
            echo "<h1>Une erreur est survenue lors de la récupération des données</h1>";
            die ($e->getMessage());
            
        }
        
        if($res)
        {
            $tmp = array();
            while($line = $res->fetch())
            {
                $tmp[] = $line;
            }         

            if(isset($tmp) && count($tmp)> 0)
            {
                unset ($bdd);
                return $tmp;
            }
        }else{
            unset ($bdd);
            return false;
        }
    }

    public function dataBaseSelectImbrique($arguments, $arguments2)
    {
        //création de l'objet PDO
        $bdd = $this->getPDOObject();       

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
            $tmp = null;
			
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
    
    public function getFieldsTable($table)
    {
        //création de l'objet PDO
        $bdd = $this->getPDOObject();

        //permet de parametrer les connections entre la base est PHP en UTF-8
        $query = "SHOW COLUMNS FROM ".$table;
        
        try{
            $res = $bdd->query($query);
            $res->setFetchMode(PDO::FETCH_OBJ);            
        }  catch (Exception $e){
            echo "<h1>Une erreur est survenue lors de la récupération des données</h1>";
            die ($e->getMessage());
            
        }
        
        if($res)
        {
            $tmp = array();
            while($line = $res->fetch())
            {
                $tmp[] = $line;
            }         
            var_dump($tmp);
            if(isset($tmp) && count($tmp)> 0)
            {
                unset ($bdd);
                return $tmp;
            }
        }else{
            unset ($bdd);
            return false;
        }       
    }
    
    public function dataBaseInsert($arguments)
    {
        $query = NULL;
        $query = "INSERT INTO ".$arguments['table']."";
        $query .= "";
    }
    
    public function dataBaseUpdate($arguments)
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
