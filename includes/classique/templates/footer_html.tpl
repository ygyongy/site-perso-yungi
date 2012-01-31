       <!-- appel ajax -->
            <script type="text/javascript" src="{$ajax_path}init_ajax.js"></script>
            <script type='text/javascript' src='{$ajax_path}authentification_user.js'></script>
        <!-- fin des appels ajax -->
        
        <script type="text/javascript">
            {literal}
                CKEDITOR.config.language = 'fr';
                CKEDITOR.config.uiColor = 'lightgrey';
                CKEDITOR.config.toolbar = [
                                              ['Source', '-', 'Bold', 'Italic', 'Underline', '-', 'Find', 'Replace', '-', 'Image', '-', 'Link']
                                          ];
                CKEDITOR.replaceAll('richtext_editor');
            {/literal}
        </script>         
    </body>
</html>