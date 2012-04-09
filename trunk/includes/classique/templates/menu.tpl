<ul id = "menu_{if isset($menu_liste[0]->emplacement_categorie)}{$menu_liste[0]->emplacement_categorie}{/if}">
    {foreach from=$menu_liste item=element_menu}
        <li><a href="{$element_menu->lien_menu}">{if isset($element_menu->code_langue)}{$element_menu->code_langue}{else}{$element_menu->nom_categorie}{/if}</a></li>
    {/foreach}
</ul>