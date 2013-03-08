<select name="{$field.name}" id="{$field.id}">
    <option value="choisissez votre {$field.display_name}"
     {if $field.value}
         selected="selected"
     {/if}
     >Choisissez votre {$field.display_name}</option>
    {foreach from=$field.value_liste item=list_item key=key}
        <option value="{$key}" 
        {if $field.value != {$key}}
             selected="selected"
         {/if}
        >{$list_item}</option>
    {/foreach}
</select>