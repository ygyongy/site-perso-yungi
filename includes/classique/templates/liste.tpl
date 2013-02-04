<div class="wrapper">
    <h3>{$title}</h3>
        <ol id="liste_{$title}{if isset($subtitle)}_{$subtitle}{/if}">
            <!-- Header des listes -->
            <li class="datagrid_header">
                {foreach from=$header_list name=header item=header}
                    <span class="header_list">{$header}</span>
                {/foreach}
                <div class="clear"></div>
            </li>        
            <!-- Fin Header des listes -->
            
            <!-- Début de l'affichage de la grille -->
            {foreach from=$page.contenu item=element key=k name=liste}                
                {if $element != NULL && isset($element)}
                    <li class="datagrid">
                        {foreach from=$element item=value name=values key=label}
                            <span>{$value}</span>
                        {/foreach}
                        
                    </li>
                    <div class="clear"></div>
                {/if}
            {/foreach}
            <!-- Fin de l'affichage de la grille -->
            
        </ol>
        <div class="pagination">{$pagination}</div>
        <div class="clear"></div>
</div>