{php}
    require_once 'classes/Debug.class.php';
    require_once 'classes/Menu.class.php';
    require_once 'classes/Matrice.class.php';
    require_once 'classes/Files.class.php';
    require_once 'classes/Images.class.php';
    require_once 'classes/Upload.class.php';
    require_once 'classes/Form.class.php';
    require_once 'classes/String.class.php';
    require_once 'classes/Paginator.class.php';
{/php}

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN"
        "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
        
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="{$langue}" lang="{$langue}">
    <head>
        
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
        <meta name="keywords" content="{*$keywords_website*}" />
        <meta name="description" content="{*$description_website*}" />
        <title>{$title_website}</title>
        
        <link rel="stylesheet" type="text/css" href="{$css_path}admin.css" /> 
        <link rel="stylesheet" type="text/css" href="{$css_path}main.css" />
        <link rel="stylesheet" type="text/css" href="{$css_path}form.css" />
        <link rel="stylesheet" type="text/css" href="{$css_path}{$template}.css" /> 
        <script type="text/javascript" src="{$js_path}md5.js"></script>
        <script type="text/javascript" src="{$ckeditor_path}ckeditor.js"></script>
    </head>