<?php
/* 
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Files
 *
 * @author yungiii
 */
class Files {
    //put your code here
    public $filename;
    public $filename_tmp;
    protected $extension;
    protected $file_size;
    public $type_file;

    //extensions authorisée
    protected $authorized_extensions = array(
        'images' => array(
            'jpg', 'jpeg', 'gif', 'png'
        ),
        'videos' => array(
            'avi', 'flv', 'mpg', 'mpeg', 'swf'
        ),
        'documents' => array(
            'txt', 'htm', 'html', 'pdf', 'doc', 'docx', 'dot', 'xls', 'xlsx', 'calc', 'ppt', 'pptx'  // y compris les format openOffice
        ),
        'artworks' => array(
            'ai', 'psd', 'eps', 'fla'
        ),
        'scripts' => array(
             'php', 'js', 'css', 'xml'
        )
    );

    public function Files(array $oFile, User $oUser)
    {   
        if ($this->getTypeFile($oFile))
        {
            $this->type_file = $this->getTypeFile($oFile);
        }else{
            $this->type_file = NULL;
        }
        
        // si l'initialisation s'est correctement passée
        if(!($this->initFile($this->type_file, $oFile, $oUser)))
        {
            $init_upload = false;
        }else{
            $init_upload = true;
            $this->state_upload = $this->initFile($this->type_file, $oFile, $oUser);
            //$this->state_upload = $this->uploadFile();
            if ($this->state_upload)
            {
                echo "Bravo fichier a bien été créé: ".$this->filename;
            }
        }
    }

    protected function initFile($type, array $aFile, User $oUser)
    {
        //si le fichier a été passé
        if(isset($aFile) && !is_null($aFile) && !empty($aFile))
        {
            $this->filename_tmp = trim($aFile[$type]['tmp_name']);
            $this->type_file = trim($type);
            $this->file_size = trim($aFile[$type]['size']);

            //si l'extension est correcte
            if($this->getExtension(trim($aFile[$type]['name'])))
            {
                $this->extension = $this->getExtension(trim($aFile[$type]['name']));
                $this->filename = $this->setName();
                
                $myUploader = new Upload($this, $oUser);
            }else{
                $this->extension = NULL;
            }
            //retour de initFile
            return true;
        }else{
            return false;
        }
    }

    private function getTypeFile(array $aFile)
    {
        //récupération du type d'upload (images videos documents artworks scripts)
        $type = array_keys($aFile);

        if(isset($type) && !empty($type))
        {
            $type = $type[0];
            if ($type && isset($type) && !empty($type))
            {
                return strtolower($type);
            }else{
                return false;
            }
        }

    }


    private function getExtension($fileName)
    {
        $tmp = explode('.', $fileName);

        //si le nom contient des points
        if(count($tmp) == 2)
        {
            //on test que l'extension soit prise en charge
            if(in_array(strtolower(trim($tmp[1])), $this->authorized_extensions[$this->type_file]))
            {
                return strtolower(trim($tmp[1]));
            }else{
                echo "Type de fichier non authorisé";
                return false;
            }
        }else{
            echo "Le nom du fichier n'est pas valable";
            return false;
        }
    }

    protected function setName()
    {
        //nom du fichier type_upload_microtime*100.extension
        $name = $this->type_file;
        $name .= "_".mktime();
        $name .= ".".$this->extension;
        return $name;
    }


}
?>
