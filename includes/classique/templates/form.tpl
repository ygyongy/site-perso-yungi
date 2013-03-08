<div style="padding: 5px;" {if isset($pages.id_fieldset) && $pages.id_fieldset !== ''} id='wrapper_{$pages.id_fieldset}'{/if}>
        {if is_array($pages.contenu)}
            <fieldset title="{$pages.titre}" {if isset($pages.id_fieldset) && $pages.id_fieldset !== ''} id='{$pages.id_fieldset}'{/if}>
                <legend>Formulaire &laquo;{$pages.titre}&raquo;</legend>
                
                    <form method = '{$pages.contenu.method}' action = '{$pages.contenu.action}' enctype = '{$pages.contenu.enctype}' id='{$pages.contenu.id}' class='{$pages.contenu.class}'                        
                          
                          {if $pages.contenu.evenement_form !== '' && isset($pages.contenu.evenement_form)}
                              {$pages.contenu.evenement_form}
                          {/if}
                    >
                          {include file="elements_form/input.tpl" field=$fUser}

                          {section loop=$pages.contenu.fields name=section_fields}
                              
                            {if isset($pages.contenu.fields[section_fields].type) && $pages.contenu.fields[section_fields].type !== 'submit' && $pages.contenu.fields[section_fields].type != 'reset'}
                                <div class="label_wrapper">
                                    {if isset($pages.contenu.fields[section_fields].display_name)}
                                        <label for="{$pages.contenu.fields[section_fields].id}" title="{$pages.contenu.fields[section_fields].display_name}" id="label_{$pages.contenu.fields[section_fields].id}">{$pages.contenu.fields[section_fields].display_name}:</label>
                                    {/if}
                                </div>
                             {/if}
                             
                                 <!-- Ici choix des champs à afficher en fonction du type du champ -->
                                 <div class="field_wrapper {$pages.contenu.fields[section_fields].class}">                                    
                                     {include file=elements_form/`$pages.contenu.fields[section_fields].template`.tpl field=$pages.contenu.fields[section_fields]}
                                     
                                     {if isset($pages.contenu.fields[section_fields].type) && $pages.contenu.fields[section_fields].type !== 'submit' && $pages.contenu.fields[section_fields].type != 'reset'}
                                         <!-- Si le champ est différent d'un type 'submit' ou 'reset' on ajout un tooltip pour afficher l'erreur -->
                                        <span class="tooltip" id="tooltip_field_{$pages.contenu.fields[section_fields].id}">{if $pages.contenu.fields[section_fields].tooltip !== ''}{$pages.contenu.fields[section_fields].tooltip}{/if}</span>
                                     {/if}                                      
                                 </div>

                                {if isset($pages.contenu.fields[section_fields].type) && $pages.contenu.fields[section_fields].type !== 'submit' && $pages.contenu.fields[section_fields].type !== 'reset'}
                                    <div class="clear">&nbsp;</div>
                                {/if}
                                <!-- Ici fin de la gestion des champs -->
                            
                        {/section}
                            
                        <div class="clear">&nbsp;</div>
                    </form>
            </fieldset>
        {/if}
</div>
<script type="text/javascript" src="{$ajax_path}init_ajax.js"></script>
<script type="text/javascript" src="{$ajax_path}oCheckForm.js"></script>