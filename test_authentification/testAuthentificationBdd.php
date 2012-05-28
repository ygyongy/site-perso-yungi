<?php
    header('Content-Type: text/html; charset=UTF-8'); 
    define('KEY_MD5', 'Je ne_5ui5 pa5_un héro!');
    define('BASE', 16);
    
    require_once '../classes/DataBase.class.php';
    require_once '../classes/String.class.php';
    require_once '../classes/User.class.php';
    
    $myBdd = new Database();
    $myBdd->dataBaseConnect();
    $myBddLink = $myBdd->getLink();
    
    $myUser = new User();
    
    $oString = new String();
    
    
    //Récupération des données envoyée par POST
    if($_POST && ($_POST['login_user'] !== '' && $_POST['password_user'] !== ''))
    {
        $login_to_test = $_POST['login_user'];
        $password_to_test = $_POST['password_user'];
        
    }else{
        $login_to_test = false;
        $password_to_test = false;
    }
        
    if($oString->sanitize($login, $myBddLink))
    {
        //le password n'y passe pas, car sinon certains caractères risquent de sauter
        $login = $oString->sanitize($login, $myBddLink);
        $login = $oString->getString();
    }

    //constitution du tableau de donnée du USER
    $user = array('login' => $login,
                    'pwd' => $password
                    );

    //permet de reproduire le Hash insérer dans la Bdd
    //$password_hash = $oUser->createPasswordUser($user['login'], $user['pwd']);
    //echo $password_hash;    
    
    testLogin('ygyongy', '$à¨è`?=)(&{}]àé$è¨°§¦@#¢`^~ñ', $myBdd, $myBddLink, $myUser);
    
    
    
    function testLogin($login, $password, $oDb, $link, $oUser)
    {
        
########################### Debut de la codification en BIN ###########################        
        $pwdLength = mb_strlen($password, 'utf-8');
        echo $password."<br>";
        echo $pwdLength;
        
        for($i=0; $i<$pwdLength; $i++)
        {
            $pwd_chars_array[] = mb_substr($password, $i, 1, 'utf-8');
        }

        var_dump($pwd_chars_array);
        
        $nb_element = count($pwd_chars_array);

        for($i = 0; $i < $nb_element; $i++)
        {
            //retourne le code ASCII de chaque caractère du mdp
            $ascii_pwd_array[$i] = ord($pwd_chars[$i]);  
            $bin_pwd_string .= sprintf("%0".BASE."d", decbin($ascii_pwd_array[$i]));
        }
        
        $key_chars = (str_split(KEY_MD5));
        $nb_element = count($key_chars);
        
        for($i = 0; $i < $nb_element; $i++)
        {
            //retourne le code ASCII de chaque caractère de la clef
            $ascii_key_array[$i] = ord($key_chars[$i]);  
            $bin_key_string .= sprintf("%0".BASE."d", decbin($ascii_key_array[$i]));
        }   
########################### Fin de la codification en BIN ##############################
        
        
        

        
        
########################### Debut de l'adapatation des longueurs de chaines ###########################         
        $lpwd = strlen($bin_pwd_string);
        $lkey = strlen($bin_key_string);
        
        //Permet de tronquer ou ajouter des caractères à la clef pour qu'elle joue avec le PWD
        if($lkey > $lpwd)
        {
            $diff_char = $lpwd-$lkey;
            $bin_key_string = substr($bin_key_string, 0, $diff_char); //je soustrait la différence
        }elseif($lpwd > $lkey){
            $bin_key_string = str_pad($bin_key_string, $lpwd, $bin_key_string, STR_PAD_RIGHT);
        }
########################### Fin de l'adapatation des longueurs de chaines #############################    
        
        
        
        

        
########################### Différents tests et appels de fonction ###########################            
        $hash_test = cryptage($bin_pwd_string, $bin_key_string);
        echo "<hr>";
        echo $hash_test;
		
	$hash_test = mb_convert_encoding($hash_test, 'utf-8');
		
	
        $nb_element = strlen($hash_test)/BASE;
        $start = 0;
        $test = null;
        
        for($i = 0; $i < $nb_element; $i++)
        {            
            if($start < strlen($hash_test))
            {
                $test[] = bin2Ascii($hash_test, $start);
            }
            $start += BASE;
        }
		
	var_dump($test);
########################### Différents tests et appels de fonction ###########################   
        
        
        
        

        
        
        
############################ Reconstruction du mot de passe###################################### 
        $nb_element = strlen($tmp)/BASE;
        $start = 0;
        
        for($i = 0; $i < $nb_element; $i++)
        {            
            if($start < strlen($tmp))
            {
                $test[] = bin2Ascii($tmp, $start);
            }
            
            echo $start += BASE;
        }
        
        //var_dump($test = implode("", $test));
############################ fin de la reconstruction du mot de passe#############################        
        
        
        
        //interrogation de la BDD
        $query = array(
            'select' => '*',
            'from' => 'utilisateurs',
            'where' => "login_utilisateur = '".$user['login']."' AND pwd_utilisateur = '".$password_hash."'",
            'limit' => "0,1"
        );

        $dbAnswer = $oDb->dataBaseSelect($query);
    }
    
    
    
    function cryptage($parameter1, $parameter2)
    { 
        $length = strlen($parameter1);
        echo $parameter1."<br>".$parameter2;
        for($i=0; $i < $length; $i++)
        {
            $hash .= (bool)$parameter1[$i] ^ (bool)$parameter2[$i];
        }
        return $hash;
    }
    
    
    function bin2Ascii($chaine, $start)
    {
        $tmp = substr($chaine, $start, BASE);
        $tmp = bindec($tmp);
        $tmp = chr($tmp);
        return $tmp;
    }
?>