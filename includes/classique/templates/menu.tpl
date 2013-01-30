<ul id = "{if isset($menu_liste[0]->emplacement_categorie)}menu_{$menu_liste[0]->emplacement_categorie}{elseif isset($menu_liste[0]->emplacement_sous_categorie)}menu_{$menu_liste[0]->emplacement_sous_categorie}{elseif isset($menu_liste[0]->emplacement_langue)}menu_{$menu_liste[0]->emplacement_langue}{/if}">
    {foreach from=$menu_liste item=element_menu}
        <li><a href="{$element_menu->lien_menu}">{if isset($element_menu->code_langue)}{$element_menu->code_langue}{else}{if isset($element_menu->nom_categorie)}{$element_menu->nom_categorie}{else}{$element_menu->nom_sous_categorie}{/if}{/if}</a></li>
    {/foreach}
</ul>