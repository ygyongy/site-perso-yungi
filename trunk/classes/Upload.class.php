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
    private $dest_folder_tmp;
    private $dest_folder;
    private $uploaded_time;
    private $state_upload = false;
    public $error_upload;

    //les deux paramètres passé sont le fichier est un objet utilisateur nécessaire pour l'aiguillage de l'upload
    public function Upload($file, $user)
    {   
        //$this->error_upload = $file['error'];
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
                echo "Bravo fichier ajouté";
            }
        }
    }

    private function initUpload($type, $file, $user_dir)
    {
        //si le fichier a été passé
        if(isset($file) && !is_null($file) && !empty($file))
        {
            $this->dest_folder = $this->setDestFolder($user_dir, $file->type_file);
            //on test si le répertoire de destination a bien été setter
            if (!is_null($this->dest_folder) && !empty($this->dest_folder) && isset($this->dest_folder))
            {
                $this->uploadFile($file);
            }else{
                return false;
            }

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
                $dir = ATTACHMENTS_PATH.$user_dir.'/images/originals/';
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

    private function uploadFile($file)
    {
        $this->uploaded_time = $this->setUploadedtime($file->filename);

        //si l'upload s'est bien passé
        $state = move_uploaded_file($file->filename_tmp, $this->dest_folder.$file->filename);
        return $state;
    }
}
?>
