<div style="padding: 5px;" {if isset($page.id_fieldset) && $page.id_fieldset !== ''} id='wrapper_{$page.id_fieldset}'{/if}>
        {if is_array($page.contenu)}
            <fieldset title="{$page.titre}" {if isset($page.id_fieldset) && $page.id_fieldset !== ''} id='{$page.id_fieldset}'{/if}>
                <legend>Formulaire &laquo;{$page.titre}&raquo;</legend>
                    <form method = '{$page.contenu.method}' action = '{$page.contenu.action}' enctype = '{$page.contenu.enctype}' id='{$page.contenu.id}'                        
                          
                          {if $page.contenu.evenement_form !== '' && isset($page.contenu.evenement_form)}
                              {$page.contenu.evenement_form}
                          {/if}
                    >
                          {include file="elements_form/input.tpl" field=$fUser}
                          {foreach from=$page.contenu.fields item=field key=j}
                            
                            {if isset($field.type) && $field.type !== 'submit' && $field.type != 'reset'}
                                <div class="label_wrapper">
                                    {if isset($field.display_name)}
                                        <label for="{$field.name}" title="{$field.display_name}" id="label_{$field.id}">{$field.display_name}:</label>
                                    {/if}
                                </div>
                             {/if}
                             
                                 <!-- Ici choix des champs à afficher en fonction du type du champ -->
                                 <div class="field_wrapper {$field.class}">                                    
                                     {include file=elements_form/`$field.template`.tpl field=$field}
                                     
                                     {if isset($field.type) && $field.type !== 'submit' && $field.type != 'reset'}
                                         <!-- Si le champ est différent d'un type 'submit' ou 'reset' on ajout un tooltip pour afficher l'erreur -->
                                        <span class="tooltip" id="tooltip_field_{$field.id}">{if $field.tooltip !== ''}{$field.tooltip}{/if}</span>
                                     {/if}                                      
                                 </div>

                                {if isset($field.type) && $field.type !== 'submit' && $field.type !== 'reset'}
                                    <div class="clear">&nbsp;</div>
                                {/if}
                                <!-- Ici fin de la gestion des champs -->
                            
                        {/foreach}
                            
                        <div class="clear">&nbsp;</div>
                    </form>
            </fieldset>
        {/if}
</div>
<script type="text/javascript" src="{$ajax_path}init_ajax.js"></script>
<script type="text/javascript" src="{$ajax_path}oCheckForm.js"></script>