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
            {foreach from=$page.contenu item=element key=k name=liste}                
                {if $element != NULL && isset($element)}
                    <tr class="datagrid">
                        {foreach from=$element item=value name=values key=label}
                            <td>{$value}</td>
                        {/foreach}
                        <td class="edit">edit</td>
                        <td class="delete">delete</td>
                    </tr>
                {/if}
            {/foreach}
            <!-- Fin de l'affichage de la grille -->
            
        </table>
        <div class="pagination">{$pagination}</div>
        <div class="clear"></div>
</div>