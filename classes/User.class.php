<?php
/**
 * Description of User
 *
 * @author yungiii
 */
class User {
    private $login;
    private $password;
    private $email;
    private $groupe;
    private $droit;
    
    private $arborescence = array(
        'images', 'artworks', 'documents', 'scripts', 'videos', 'tmp'
    );
    
    /**
     * Constructeur de la classe
     * 
     * @return void
     */   
    function User()
    {
        $this->login = 'anonymous';
        $this->password = null;
        $this->email = null;
        $this->groupe = 'anonymous';
    }
    
    public function getDroitUser()
    {
        return $this->droit;
    }
    
    public function getUserForm($oDb, $oUser)
    {
       $parametres = array(
            'select' => '*',
            'from' => 'contenus c',
            'where' => 'c.types_contenus_id_types_contenus = 4'
        );
       
        //Attribution de la sessionUtilisateur par défaut
            $query = array(
                'select' => '*',
                'from' => 'utilisateurs',
                'where' => "login_utilisateur = 'anonymous' ",
                'limit' => "0,1"
            );

            $dbAnswer = $oDb->dataBaseSelect($query);
            unset ($query);

            $query = array(
                'select' => '*',
                'from' => 'groupes',
                'where' => "id_groupe = ".$dbAnswer[0]->groupes_id_groupe." ",
                'limit' => "0,1"
            );

            $groupe = $oDb->dataBaseSelect($query);
            $tmp = array_merge($dbAnswer, $groupe);
            
            $_SESSION['utilisateur'] = $tmp;

            $this->login = $_SESSION['utilisateur'][0]->login_utilisateur;
            $this->password = $_SESSION['utilisateur'][0]->pwd_utilisateur;
            $this->groupe = $_SESSION['utilisateur'][1]->nom_groupe;
            $this->droit = $_SESSION['utilisateur'][1]->droit_groupe;

            unset ($tmp);
            unset ($groupe);
            unset ($query);
           
        return $oDb->dataBaseSelect($parametres);
    }

    public function getUser($login, $pwd, $oLogin, $oPwd, $oDb)
    {
        //fonction qui permet de récupérer l'utilisateur
        $this->login = $login;
        $this->password = $pwd;

        $oLogin->sanitize($login, $oDb->link);
        $oPwd->sanitize($pwd, $oDb->link);
        
        //constitution du tableau de donnée du USER
        $user = array('login' => $oLogin->getString(),
                      'pwd' => $oPwd->getString()
                     );

        //interrogation de la BDD
        $query = array(
            'select' => '*',
            'from' => 'utilisateurs',
            'where' => "login_utilisateur = '".$oLogin->getString()."' ",
            'limit' => "0,1"
        );

        $dbAnswer = $oDb->dataBaseSelect($query);
        unset ($query);
        $authentificationErrors = null;

        if($dbAnswer || $dbAnswer = null && (count($dbAnswer) > 1) || isset($_SESSION['utilisateur']))
        {
            if(($dbAnswer[0]['pwd_utilisateur'] === $user['pwd']) || ($_SESSION['utilisateur'][0]['pwd_utilisateur'] === $user['pwd']))
            {
                $query = array(
                    'select' => '*',
                    'from' => 'groupes',
                    'where' => "id_groupe = ".$dbAnswer[0]->groupes_id_groupe." ",
                    'limit' => "0,1"
                );

                $groupe = $oDb->dataBaseSelect($query);

                $tmp = array_merge($dbAnswer, $groupe);

                //Session contenant toutes les informations relatives à l'utilisateur authentifié
                $_SESSION['utilisateur'] = array_merge($tmp[0], $tmp[1]);
                
                $this->login = $_SESSION['utilisateur']['login_utilisateur'];
                $this->password = $_SESSION['utilisateur']['pwd_utilisateur'];
                $this->groupe = $_SESSION['utilisateur']['nom_groupe'];
                $this->droit = $_SESSION['utilisateur']['droit'];                
                
                return json_encode($_SESSION['utilisateur'], true);
            }else{
                $authentificationErrors[] = 'Erreur de login, l\'utilisateur n\'existe pas';
                return json_encode($authentificationErrors, true);
            }
        }else{
            $authentificationErrors[] = 'DB query login error';
            return json_encode($authentificationErrors, true);
        }        
    }
    
    private function createUser($login, $pwd, $db)
    {
        
        $this->createArborescenceUser();
    }


    private function createPasswordUser($login,$pwd)
    {
        $hash = md5(KEY_MD5.$pwd.KEY_MD5.$login);
    }

    private function createArborescenceUser()
    {
        //si le répertoire existe déjà
        if(!is_dir(ATTACHMENTS_PATH.$this->login."/"))
        {//ouverture connection FTP
            foreach ($this->arborescence as $key => $folder)
            {
                //test de création du dossier
                if(mkdir(ATTACHMENTS_PATH.$this->login."/".$folder, 0777, true))
                {
                    echo "répertoire ".$folder." créé";
                    echo "<br />";
                }else{
                    echo "erreur lors de la création du ou des répertoires";
                    echo "<br />";
                }

            }//fin du foreach
        }else{
            echo "L'arborescence pour cet utilisateur a déjà été créé!";
            echo "<br />";
        }
        
    }
}
?>
