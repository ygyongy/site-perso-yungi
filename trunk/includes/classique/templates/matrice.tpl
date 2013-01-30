<div class="wrapper">
            <h1>{$page.titre}</h1>
            {if is_array($page.contenu)}
                {foreach from=$page.contenu item=element key=k name=matrice}
                    <div class="fleft" id="cell_{$k}" style="width:{$width}px; margin-right: 0.1em; border: 1px red solid;">
                        {$element}
                    </div>

                    {*Si c'est la fin d'une ligne ou la fin de la matrice}
                    {k+1 parce que l'index commence à 0*}
                    {if (($k+1) % $nb_colonnes === 0) || (($k+1) === $smarty.foreach.matrice.total)}
                        <div class='clear'>
                            &nbsp
                        </div>
                    {/if}
                 {/foreach}

            {else}
                <div class="fleft" id="cell_1" style="float: none;margin-right: 0.5em;">
                    {$page.contenu}
                </div>
                <div class="fleft" id="cell_1" style="float: none;margin-right: 0.5em;">
                    {$page.footer}
                </div>                
            {/if}
</div>