<?php
/* 
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Languages
 *
 * @author yungiii
 */
class Languages {
    //put your code here
    private $code_langue;
    private $id_langue;
    private $liste_langue = array();
    private $emplacement_langue;

    public function Languages($langue)
    {
        $this->code_langue = $langue;
        $this->id_langue = null;

        $this->initLanguage();
    }
    
    public function getListeLangue()
    {
        return $this->liste_langue;        
    }
    
    public function getIdLangue()
    {
        return $this->id_langue;
    }
    
    public function getCodeLangue()
    {
        return $this->code_langue;
    }
    
    public function getEmplacementLangue()
    {
        return $this->emplacement_langue;
    }


    private function initLanguage()
    {
        $this->id_langue = $this->setIdLangue($this->code_langue);
        return true;
    }

    private function setIdLangue($code)
    {
        $sql = "SELECT * FROM langues WHERE code_langue = '".$code."' AND actif_langue <> '0'";
        $res = mysql_query($sql);

        if(count($res) > 0 && count($res) < 2)
        {
            while($row = mysql_fetch_array($res))
            {
                return $row['id_langue'];
            }
        }else{
            return false;
        }
    }
    
    public function setListeLangue($db)
    {
        $parametre = array(
            'select' => 'id_langue, nom_langue, code_langue, position_langue',
            'from' => 'langues',
            'where' => "actif_langue <> '0'",
            'order by' => 'position_langue'
        );
        
        $this->liste_langue = $db->dataBaseSelect($parametre);
        
        foreach($this->liste_langue as $key => $value)
        {
            $value->emplacement_langue = "langue";
        }
        
        return true;
    }    
    
}
?>
