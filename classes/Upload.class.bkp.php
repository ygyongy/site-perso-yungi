<?php
/* 
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Upload
 * Cette classe permet d'uploader plusieurs types de fichiers
 * @param object $user aiguille l'upload
 * @param _FILES $file contient toutes les infos pour l'upload du fichier
 * @author yungiii
 */
class Upload {
    //put your code here
    private $dest_folder;
    private $uploaded_time;
    private $state_upload = false;
    public $error_upload;

    //les deux paramètres passé sont le fichier est un objet utilisateur nécessaire pour l'aiguillage de l'upload
    public function Upload($file, $user)
    {
        //récupération du type d'upload (images videos documents artworks scripts)
        $type = array_keys($_FILES);
        $type = $type[0];     
        $this->error_upload = $file['error'];
        // si l'initialisation s'est correctement passée
        if(!($this->initUpload($type, $file, $user->login)))
        {
            $init_upload = false;
        }else{
            $init_upload = true;
            $this->state_upload = $this->initUpload($type, $file, $user->login);
            $this->state_upload = $this->uploadFile();
            if ($this->state_upload)
            {
                echo "Bravo fichier ajouté<br />";
                var_dump($file['error']);
            }
        }
    }

    private function initUpload($type, $file, $user_dir)
    {
        //si le fichier a été passé
        if(isset($file) && !is_null($file) && !empty($file))
        {
            $this->dest_folder = $this->setDestFolder($user_dir, $this->type_upload);

            //si l'extension est correcte
            if($this->getExtension(trim($file[$type]['name'])))
            {
                $this->extension = $this->getExtension(trim($file[$type]['name']));

                //si la taille n'excède pas la taille max d'upload
                if($this->testFileSize() && $this->extension != NULL)
                {
                    return true;
                }else{
                    echo "le fichier est trop lourd";
                }
            }else{
                $this->extension = NULL;
            }
            return true;
        }else{
            
            return false;
        }
    }

    private function setDestFolder($user_dir, $type_upload)
    {
        switch($type_upload)
        {

            //utilisation de la constante ATTACHMENTS_PATH définie dans la page config.php
            case 'images':
                $dir = ATTACHMENTS_PATH.$user_dir.'/images/';
                return $dir;
                break;

            case 'videos':
                $dir = ATTACHMENTS_PATH.$user_dir.'/videos/';
                return $dir;
                break;

            case 'documents':
                $dir = ATTACHMENTS_PATH.$user_dir.'/documents/';
                return $dir;
                break;

            case 'artworks':
                $dir = ATTACHMENTS_PATH.$user_dir.'/artworks/';
                return $dir;
                break;

            case 'scripts':
                $dir = ATTACHMENTS_PATH.$user_dir.'/scripts/';
                return $dir;
                break;

            default :
                return false;
                break;
        }
    }

    private function setUploadedtime($name)
    {
        $tmp = explode('_', $name);
        $tmp = explode('.', $tmp[1]);
        return $tmp[0];
    }

    private function uploadFile()
    {
        $this->filename = $this->setName();
        $this->uploaded_time = $this->setUploadedtime($this->filename);

        //si l'upload s'est bien passé
        $state = move_uploaded_file($this->filename_tmp, $this->dest_folder.$this->filename);

        return $state;
    }
}
?>
