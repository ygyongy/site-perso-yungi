{foreach from=$contents_block item=content_element key=k}
    <div class="wrapper_sidebar">
        {include file=`$content_element.fichier_tpl`.tpl page=$blocks.$k}
    </div>
{/foreach}

{include file='blocks/block_info_website.tpl'}