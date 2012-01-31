<select name="{$field.name}" id="{$field.id}">
    <option value="choisissez votre {$field.display_name}" selected="selected">Choisissez votre {$field.display_name}</option>
    {foreach from=$field.value item=list_item key=key}
        <option value="key">{$list_item}</option>
    {/foreach}
</select>