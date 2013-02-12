    {section loop=$pages name=section_page}
        <div class="wrapper">
            <h1>
                {$pages[section_page].titre}
            </h1>
                {if $pages[section_page].fichier_tpl == 'form'}
                    {include file=form.tpl pages=$pages[section_page]}
                {else}
                    <p class="contenus">
                        {foreach from=$pages[section_page] item=item_contenu}
                            {$item_contenu}
                        {/foreach}
                    </p>
                 {/if}
            <div class="footer">
                {$pages[section_page].footer}
            </div>
        </div>
    {/section}