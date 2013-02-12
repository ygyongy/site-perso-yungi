<div class="wrapper">
        <h3>{$title}</h3>
        <table id="grid" style="width: 100%;">
            <!-- Header des listes -->
            <tr class="datagrid_header">
                {foreach from=$header_list name=header item=header}
                    <th class="header_list">{$header}</th>
                {/foreach}
            </tr>        
            <!-- Fin Header des listes -->
            
            <!-- Début de l'affichage de la grille -->
            {section loop=$pages name=section_liste_utilisateur}                
                    <tr class="datagrid">
                        {foreach from=$pages[section_liste_utilisateur] item=value name=values key=label}
                            <td>{$value}</td>
                        {/foreach}
                        <td class="edit">edit</td>
                        <td class="delete">delete</td>
                    </tr>
            {/section}
            <!-- Fin de l'affichage de la grille -->
        </table>
            
        <div class="pagination">{$pagination}</div>
        <div class="clear"></div>
</div>