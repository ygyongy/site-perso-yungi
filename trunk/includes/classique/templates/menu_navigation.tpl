<ul id = "menu_navigation_liste">
    {foreach from=$menu_liste item=element_menu}
        <li><a href="{$element_menu.lien_menu}">{$element_menu.nom_categorie}</a></li>
    {/foreach}
</ul>