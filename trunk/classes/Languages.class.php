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
    public $code_langue;
    public $id_langue;
    public $liste_langue = array();

    public function Languages($langue)
    {
        $this->code_langue = $langue;
        $this->id_langue = null;

        $this->initLanguage();
    }

    private function initLanguage()
    {
        $this->id_langue = $this->getIdLangue($this->code_langue);
        return true;
    }

    private function getIdLangue($code)
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
    
    public function getLangueList($db)
    {
        $parametre = array(
            'select' => 'id_langue, nom_langue, code_langue, position_langue',
            'from' => 'langues',
            'where' => "actif_langue <> '0'",
            'order by' => 'position_langue'
        );
        
        return $db->dataBaseSelect($parametre);
    }    
    
}
?>
