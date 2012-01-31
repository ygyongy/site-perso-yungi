<?php
    header('Content-Type: text/html; charset=utf-8');
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<html>
	<head>
            <meta http-equiv="content-type" content="text/html; charset=utf-8" />
		<?php
			function changePage($affiche)
			{
				switch($affiche)
				{
					case 'presentation' : include 'presentation_jQuery.htm'; break;
					case 'dansez' : include 'dansez_jquery.htm'; break;
					
					
					default : include 'presentation_jQuery.htm'; break;
				}
				return;
			}
		?>
                <script type="text/javascript" src="js/jquery-1.4.4.js"></script>
		<script type="text/javascript" src="js/jQuery.easing.1.3.js"></script>
		<script type="text/javascript" src="js/fadeOutIn.js"></script>
                <link rel="stylesheet" type="text/css" href="css/main.css" />
	</head>
	
	<body>
            <div style="width: 800px; margin-right: auto; margin-left: auto; text-align: justify;">
                    <div id="sommaire">
                            <a href="?page=presentation" title="notions de bases">Présentation de jQuery</a>
                            |
                            <a href="?page=dansez" title="notions de bases">jQuery: Dansez maintenant</a>
                    </div>
                    <?php
                            if(is_null($page = $_GET['page']))
                            {
                                    $page = "presentation";
                                    changePage($page);
                            }else{
                                    changePage($page);
                            }
                    ?>
            </div>
	</body>
</html>