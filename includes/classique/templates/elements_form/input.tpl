<input type="{$field.type}" name = '{$field.name}' id = '{$field.id}' {if isset($field.display_name) && $field.type !== 'reset' && $field.type !== 'submit' && $field.type !== 'button'}title = '{$field.display_name}'{/if}
    {if isset($field.value)}
        value = '{$field.value}'
    {/if}
    {if isset($field.evenement_field) && $field.evenement_field !== ''}
        {$field.evenement_field}
    {/if}
    {if isset($field.class) && $field.class !== ''}
        class="{$field.class}"
    {/if}
/>