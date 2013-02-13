<div class="wrapper">
    <h3>{$title}</h3>
        <ol id="liste_{$pages.0.titre}{if isset($subtitle)}_{$subtitle}{/if}">
            <!-- Header des listes -->
            <li class="datagrid_header">
                {foreach from=$pages.0.header_list name=header item=header}
                    <span class="header_list">{$header}</span>
                {/foreach}
                <div class="clear"></div>
            </li>        
            <!-- Fin Header des listes -->
            
            <!-- Début de l'affichage de la grille -->
            {section loop=$pages name=liste_contenus}                
                {if $pages[liste_contenus] != NULL && isset($pages[liste_contenus])}
                    <li class="datagrid">
                        {foreach from=$pages[liste_contenus] item=value name=values key=label}
                            <span>{$value}</span>
                        {/foreach}
                        
                        <div>{include file=learn_more.tpl menu_liste=$menu_liste_learn_more[liste_contenus]}</div>
                        <div class="clear"></div>
                    </li>
                    <div class="clear"></div>
                {/if}
            {/section}
            <!-- Fin de l'affichage de la grille -->
        </ol>
</div>