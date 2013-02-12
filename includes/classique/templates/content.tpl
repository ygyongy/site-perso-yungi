<div id="contenu_site">
    {include file=`$contents_page.$index_navigation.0.fichier_tpl`.tpl pages=$contents_page.contenus}
    <div class="pagination">{$pagination}</div>
    <div class="clear"></div>    
</div>
<div id="sidebar_right">{include file='blocks/sidebar_right.tpl'}</div>
<div class="clear"></div>