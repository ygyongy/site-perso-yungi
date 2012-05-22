<?php
    define('KEY_MD5', 'Je ne_5ui5 pa5_un héro!');
    require_once '../classes/DataBase.class.php';
    require_once '../classes/String.class.php';
    require_once '../classes/User.class.php';
    
    $myBdd = new Database();
    $myBdd->dataBaseConnect();
    $myBddLink = $myBdd->getLink();
    
    $myUser = new User();
    
    if($_POST && ($_POST['login_user'] !== '' && $_POST['password_user'] !== ''))
    {
        $login_to_test = $_POST['login_user'];
        $password_to_test = $_POST['password_user'];
        
    }else{
        $login_to_test = false;
        $password_to_test = false;
    }
    testLogin('ygyongy', 'AlienWare', $myBdd, $myBddLink, $myUser);
    
    function testLogin($login, $password, $oDb, $link, $oUser)
    {
        $oString = new String();
        
        if($oString->sanitize($login, $link))
        {
            //le password n'y passe pas, car sinon certains caractères risquent de sauter
            $login = $oString->sanitize($login, $oDb->getLink());
            $login = $oString->getString();
        }
        
        //constitution du tableau de donnée du USER
        $user = array('login' => $login,
                      'pwd' => $password
                     );
        
        //permet de reproduire le Hash insérer dans la Bdd
        $password_hash = $oUser->createPasswordUser($user['login'], $user['pwd']);
        echo $password_hash;
        
        $pwd_chars = (str_split($user['pwd']));
        $nb_element = count($pwd_chars);
        
        for($i = 0; $i < $nb_element; $i++)
        {
            //retourne le code ASCII de chaque caractère du mdp
            $ascii_pwd_array[$i] = ord($pwd_chars[$i]);  
            $bin_pwd_array[$i] = sprintf("%08d", decbin($ascii_pwd_array[$i]));
            $bin_pwd_string .= sprintf("%08d", decbin($ascii_pwd_array[$i]));
        }       
        var_dump($bin_pwd_string);
        
        $key_chars = (str_split(KEY_MD5));
        $nb_element = count($key_chars);
        
        for($i = 0; $i < $nb_element; $i++)
        {
            //retourne le code ASCII de chaque caractère du mdp
            $ascii_key_array[$i] = ord($key_chars[$i]);  
            $bin_key_array[$i] = sprintf("%08d", decbin($ascii_key_array[$i]));
            $bin_key_string .= sprintf("%08d", decbin($ascii_key_array[$i]));
        }        
        var_dump($bin_key_string);
        
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
        
        $hash_test = cryptage($bin_pwd_string, $bin_key_string);
        
        echo "valeur de retour: ";
        var_dump($hash_test);
        echo "<hr>";
        
        $tmp = cryptage($hash_test, $bin_key_string);
        var_dump($tmp === $bin_pwd_string);
        
        //test de reconstruction à l'envers
        $nb_element = strlen($tmp)/8;
        
        $start = 0;
        
        for($i = 0; $i < $nb_element; $i++)
        {            
            if($start < strlen($tmp))
            {
                $test[] = bin2Ascii($tmp, $start);
            }
            
            echo $start += 8;
        }
        
        var_dump($test = implode("", $test));
        
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
        $hash = $parameter1 XOR $parameter2;
        return $hash;
    }
    
    function bin2Ascii($chaine, $start)
    {
        $tmp = substr($chaine, $start, 8);
        $tmp = bindec($tmp);
        $tmp = chr($tmp);
        return $tmp;
    }
?>
