<div class="wrapper_sidebar" id="block_infos_website">
    <div style="padding: 5px;">
        <h3>Carte de visite</h3>
        <ul id="infos_website">
            {foreach from=$infos_website_liste item=element_website_list key=k}
                {if $element_website_list != NULL && isset($element_website_list)}
                    {if $k === 'id_website'}
                        <li style="display: none;">{$element_website_list}</li>
                    {else}    
                        <li>{$element_website_list}</li>
                    {/if}
                {/if}
            {/foreach}
        </ul>
    </div>
</div>