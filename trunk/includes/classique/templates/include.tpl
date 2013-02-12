{section loop=$pages name=section_page}
    {include_php file=PLUGIN/`$pages[section_page].contenu`.php once=true}
{/section}