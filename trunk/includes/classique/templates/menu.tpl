<ul id = "menu_nav_liste">
    {foreach from=$menu_liste_nav item=element_menu}
        <li><a href="{$element_menu.lien_menu}">{$element_menu.nom_categorie}</a></li>
    {/foreach}
</ul>