<?php
    function printCoreForm($infos, $action, $method, $enctype, $fields)
    {
        echo "<fieldset title=".$infos['titre']."  id='fieldset_connexion_user'>";
            echo "<legend>".$infos['titre']."</legend>";
                echo "<form action=".$action." method=".$method." enctype=".$enctype.">";      
        
                    $nb_items = count($fields);

                    for ($i = 0; $i < $nb_items; $i++) 
                    {
                        if($fields[$i]['type'] === 'input type="text"' || $fields[$i]['type'] === 'input type="password"')
                        {
                            echo "<label for=\"".$fields[$i]['name']."\" title=\"".$fields[$i]['name']."\" id=\"label_login\">".$fields[$i]['display_name']."</label>";
                            echo "<".$fields[$i]['type']." name=\"".$fields[$i]['name']."\" id=\"".$fields[$i]['id']."\" class=\"".$fields[$i]['class']."\" value=\"".$fields[$i]['value']."\" />";
                            echo "<br />";
                        }else{
                            echo "<".$fields[$i]['type']." name = \"".$fields[$i]['name']."\" id = \"".$fields[$i]['id']."\" value = \"".$fields[$i]['value']."\" />";
                        }

                    } 
        
                echo "</form>";
        echo "</fieldset>";      
    }
?>