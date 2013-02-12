<div class="wrapper">
    {section loop=$pages name=section_page}
        <h1>
            {$pages[section_page].titre}
        </h1>
            {if $pages[section_page].fichier_tpl == 'form'}
                {include file=form.tpl pages=$pages[section_page]}
            {else}
                <p>
                    {foreach from=$pages[section_page] item=item_contenu}
                        {$item_contenu}
                    {/foreach}
                </p>
             {/if}
        <div>
            {$pages[section_page].footer}
        </div>
    {/section}
</div>