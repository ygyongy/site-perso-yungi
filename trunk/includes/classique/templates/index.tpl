    <div id="conteneur">
        <div id="info">index.tpl - {$include_path}</div>
        <div id="wrapper_menu_admin" class="menu">{include file="menu.tpl" menu_liste=$menu_liste_admin}</div>
        <div id="wrapper_sous_menu_admin" class="menu">{include file="menu.tpl" menu_liste=$sous_menu_liste_admin}</div>
        <div id="leaderboard">{include file='leaderboard.tpl'}</div>
        <div id="wrapper_menu_langue" class="menu">{include file="menu.tpl" menu_liste=$menu_liste_langues}</div>
        <div class="clear"></div>
        <div id="header">{include file='header.tpl'}</div>
        <div id="content">{include file='content.tpl'}</div>
        <div id="footer">{include file='footer.tpl'}</div>
    </div>
        
{include file='footer_html.tpl'}