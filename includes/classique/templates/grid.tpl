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
            {section loop=$pages name=section_liste_datagrid}                
                    <tr class="datagrid">
                        {foreach from=$pages[section_liste_datagrid] item=value name=values key=label}
                            {if is_array($value)}
                                <td>
                                    {include file=menu_array.tpl menu_liste=$value}
                                </td>
                            {else}
                                <td>{$value}</td>
                            {/if}
                        {/foreach}
                    </tr>
            {/section}
            <!-- Fin de l'affichage de la grille -->
        </table>
            
        <div class="pagination">{$pagination}</div>
        <div class="clear"></div>
</div>