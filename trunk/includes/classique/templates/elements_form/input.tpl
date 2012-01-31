<input type="{$field.type}" name = '{$field.name}' id = '{$field.id}' title = '{$field.display_name}'
    {if isset($field.value)}
        value = '{$field.value}'
    {/if}
    {if $field.evenement_field !== '' && isset($field.evenement_field)}
        {$field.evenement_field}
    {/if}
    {if $field.class !== '' && isset($field.class)}
        class="{$field.class}"
    {/if}
/>