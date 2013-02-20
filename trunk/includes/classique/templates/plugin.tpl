{section loop=$pages name=section_page}
    {*On vérifie qu'un dossier PLUGIN du nom de la sous-categorie existe*}
    {assign var="path" value="`$plugin_path``$subtitle`/"}
    
    {*si le dossier existe on affiche le plugin*}
    {if is_dir($path)}
        {include_php file=`$path``$pages[section_page].contenu`.php once=true}
    {else}
        {include file="page.tpl" once=true}
    {/if}
{/section}