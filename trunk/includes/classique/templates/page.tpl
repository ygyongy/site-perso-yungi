<div class="wrapper">
    {section loop=$pages name=section_page}
        <h1>
            {$pages[section_page].titre}
        </h1>
        <p>
            {foreach from=$pages[section_page] item=item_contenu}
                {$item_contenu}
            {/foreach}
        </p>
        <div>
            {$pages[section_page].footer}
        </div>
    {/section}
</div>