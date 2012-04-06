<ul id = "menu_langue_liste">
    {foreach from=$menu_liste_langues item=element_menu}
        <li><a href="{$element_menu.lien_menu}">{$element_menu.code_langue}</a></li>
    {/foreach}
</ul>