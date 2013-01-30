<div id="title">
    <h1>{$title}</h1>
    {if isset($subtitle)}
        {$subtitle}
    {/if}
</div>
<div id="wrapper_menu_navigation" class="menu">
    {include file="menu.tpl" menu_liste=$menu_liste_nav}
</div>
<div id="wrapper_sous_menu_navigation" class="menu">
    {include file="menu.tpl" menu_liste=$sous_menu_liste_nav}
</div>