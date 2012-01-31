<?php
	//header ("Content-type: image/png");

	//$image = imagecreatefromjpeg('includes/classique/attachments/ygyongy/images/images_1294310752.jpg');
	$image = imagecreate(200,100);
	$image2 = imagecreate(200,100);
	$image3 = imagecreate(200,100);
	
	//imagejpeg($image, 'includes/classique/attachments/ygyongy/images/test.jpg'); //on enregistre notre image dans le dossier image
	
	//couleur de fond
	$orange = imagecolorallocate($image, 255, 128, 0);
	$bleuclair = imagecolorallocate($image, 156, 227, 254);
        $bleu = imagecolorallocate($image2, 0, 0, 255);
        $noir = imagecolorallocate($image2, 0, 0, 0);
	$noir2 = imagecolorallocate($image3, 0, 0, 0);
	$gris = imagecolorallocate($image3, 100, 100, 100);

	//ajouter un texte (ressource_image[imagecreate()], taille_police, position_x, position_y, texte_a_imprimer, ressource_couleur[imagecolorallocate()])
	imagestring($image, 5, 20, 5, 'Accueil', $bleuclair);
	
	//meme que image string mais �crit de bas en haut
	imagestringup($image2, 3, 5, 94, 'Copyright', $noir);
	
	//crée une image avec un fond de couleur transparente!
	imagecolortransparent($image3, $noir2);
	imagestringup($image3, 3, 5, 94, 'Copyright', $gris);
	
	imagepng($image, 'images/test1.png');
	imagepng($image2, 'images/test2.png');
	imagepng($image3, 'images/test3.png');


        //fusion de deux images
        //1. Charger les deux ressources nécessaires
        $logo = imagecreatefrompng('images/icone.png');
        
        $destination = imagecreatefromjpeg('images/photo.jpg');

        //2. Les fonctions imagesx et imagesy renvoient la largeur et la hauteur d'une image
        $largeur_logo = imagesx($logo);
        $hauteur_logo = imagesy($logo);

        $largeur_destination = imagesx($destination);
        $hauteur_destination = imagesy($destination);

        //3. On place le logo sur l'image de destination
        $destination_x = ($largeur_destination/2)-($largeur_logo/2);
        $destination_y = ($hauteur_destination/2)-($hauteur_logo/2);

        //4. On ajoute le logo sur l'image de destination avec imagecopymerge(ressource_destination, ressource_logo, int_dest_x, int_dest_y, 0, 0, int_x_logo, int_y_logo, int_logo_transparence)
        //   Cette fonction A BESOIN de deux images => on colle la source sur l'image de destination (ici photo.jpg)
        imagecopymerge($destination, $logo, $destination_x, $destination_y, 0, 0, $largeur_logo, $hauteur_logo, 60);

        //5. On sauve l'image comme auparavant > le dernier parametre spécifie la compression (ici == 100% [1-9])
        imagepng($destination, 'images/merge.png');


        $liste_images = array('images/test1.png', 'images/test2.png', 'images/test3.png', 'images/merge.png');

        echo "<ol>";
            foreach ($liste_images as $value)
            {
                echo "<li><img src='".$value."' /></li>";
            }
        echo "</ol>";
?>