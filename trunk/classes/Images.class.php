<?php
ini_set ( "memory_limit", "100M" );
/* 
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Images
 *
 * @author yungiii
 */
class Images extends Files {
    //put your code here
    //10 Mo max
    private $max_file_size;
    private $state_image;
    private $width;
    private $height;
    private $ratio_size;
    private $size_thumb;
    private $width_mini;
    private $height_mini;


    public function Images($file, $user)
    {
        parent::Files($file, $user);
        $this->state_image = $this->initImage($file, $user);
    }

    private function initImage($file, $user)
    {
        $this->size_thumb = 200;    //définit la taille max d'une miniature
        $this->max_file_size = 10*1000000;

        //si la taille n'excède pas la taille max d'upload
        if($this->testFileSize() && $this->extension != NULL)
        {
            $this->state_image = $this->resizeImages($user);
            if ($this->state_image)
            {
                return true;
            }else{
                return false;
            }
        }else{
            return false;
        }        
    }


    private function testFileSize()
    {
        if ($this->file_size <= $this->max_file_size && $this->file_size != NULL && !empty($this->file_size) && $this->file_size > 0)
        {
            return true;
        }else{
            return false;
        }
    }

    private function setRatio($width, $height)
    {
        $ratio = null;

        //il faut juste une condition qui divise par le còté le plus grand
        //portrait ou paysage
        if ($width >= $height)
        {
            $ratio = $this->size_thumb/$width;
        }else{
            $ratio = $this->size_thumb/$height;
        }
        return $ratio;
    }

    private function resizeImages($user)
    {
        $image = null;
        echo ATTACHMENTS_PATH.$user->login.'/images/originals/'.$this->filename;
        switch ($this->extension)
        {
            case 'jpg' :
            case 'jpeg' :
                $image = imagecreatefromjpeg(ATTACHMENTS_PATH.$user->login.'/images/originals/'.$this->filename);
                break;
            case 'gif':
                $image = imagecreatefromgif(ATTACHMENTS_PATH.$user->login.'/images/originals/'.$this->filename);
                break;
            case 'png':
                $image = imagecreatefrompng(ATTACHMENTS_PATH.$user->login.'/images/originals/'.$this->filename);
                break;
            default :
                $image = imagecreatefromjpeg(ATTACHMENTS_PATH.$user->login.'/images/originals/'.$this->filename);
                break;
        }
        //récupération de la taille de l'image originale
        $largeur_image = imagesx($image);
        $hauteur_image = imagesy($image);
        
        $this->width = $largeur_image;
        $this->height = $hauteur_image;

        $this->ratio_size = $this->setRatio($this->width, $this->height);
        $this->width_mini = round($largeur_image * $this->ratio_size);
        $this->height_mini = round($hauteur_image * $this->ratio_size);
        
        //création de la ressource miniature
        $destination = imagecreatetruecolor($this->width_mini, $this->height_mini);

        imagecopyresampled($destination, $image, 0, 0, 0, 0, $this->width_mini, $this->height_mini, $this->width, $this->height);
        
        switch ($this->extension)
        {
            case 'jpg' :
            case 'jpeg' :
                $image = imagejpeg($destination, ATTACHMENTS_PATH.$user->login.'/images/thumbnails/'.$this->filename);
                break;
            case 'gif':
                $image = imagegif($destination, ATTACHMENTS_PATH.$user->login.'/images/thumbnails/'.$this->filename);
                break;
            case 'png':
                $image = imagepng($destination, ATTACHMENTS_PATH.$user->login.'/images/thumbnails/'.$this->filename);
                break;
            default :
                $image = imagejpeg($destination, ATTACHMENTS_PATH.$user->login.'/images/thumbnails/'.$this->filename);
                break;
        }

    }

}
?>
