{section loop=$contents_block.$index_navigation_blocks name=section_blocks}
        {include file=`$contents_block.$index_navigation_blocks[section_blocks].fichier_tpl`.tpl pages=$contents_block.$index_navigation_blocks}
{/section}

{include file='blocks/block_info_website.tpl'}