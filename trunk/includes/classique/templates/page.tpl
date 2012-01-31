<div class="wrapper">
    <h1>
        {$page.titre}
    </h1>
    <p>
        {foreach from=$page.contenu item=contenu}
            {$contenu}
        {/foreach}
    </p>
    <div>
        {$page.footer}
    </div>
</div>