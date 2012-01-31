<div id="contenu_site">
    {foreach from=$contents_page item=content_element key=k}
        {include file=`$content_element.fichier_tpl`.tpl page=$pages.$k}
    {/foreach}
</div>
<div id="sidebar_right">{include file='blocks/sidebar_right.tpl'}</div>
<div class="clear"></div>