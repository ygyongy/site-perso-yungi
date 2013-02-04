<div class="wrapper">
        <h3>{$title}</h3>
        <ol id="liste_{$title}{if isset($subtitle)}_{$subtitle}{/if}">
            {foreach from=$page.contenu item=element key=k name=liste}
                {if $element != NULL && isset($element)}
                    {if $k == 0}
                        <li class="datagrid_header">
                            {foreach from=$header_list name=header item=header}
                                <span class="header_list">{$header}</span>
                            {/foreach}
                            <div class="clear"></div>
                        </li>
                    {/if}
                    <li class="datagrid">
                        {foreach from=$element item=value name=values key=label}
                            <span>{$value}</span>
                        {/foreach}
                        
                    </li>
                    <div class="clear"></div>
                {/if}
            {/foreach}
        </ol>
        <div class="pagination">{$pagination}</div>
        <div class="clear"></div>
</div>