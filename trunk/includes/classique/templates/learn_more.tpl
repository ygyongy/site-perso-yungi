{$menu_liste.0|var_dump}
<ul id = "{if isset($menu_liste.0.emplacement_categorie)}menu_{$menu_liste.0.emplacement_categorie}{elseif isset($menu_liste.0.emplacement_sous_categorie)}menu_{$menu_liste.0.emplacement_sous_categorie}{elseif isset($menu_liste.0.emplacement_langue)}menu_{$menu_liste.0.emplacement_langue}{/if}">
        <li><a href="{$menu_liste.lien_menu}">{if isset($menu_liste.code_langue)}{$menu_liste.code_langue}{else}{if isset($menu_liste.nom_categorie)}{$menu_liste.nom_categorie}{else}{$menu_liste.nom_sous_categorie}{/if}{/if}</a></li>
</ul>