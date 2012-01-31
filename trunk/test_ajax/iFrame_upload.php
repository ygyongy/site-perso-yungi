<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
session_start();

    $error = null;
    $_SESSION['filename'];

        if(isset($_FILES['uploadFile']) && $_FILES['uploadFile']['error'] === 0)
        {
            $targetPath = getcwd().'/imageUpload/'.$_FILES['uploadFile']['name']; //la fonction GETCWD() => retourne le répertoire courant
            $_SESSION['filename'][] = "imageUpload/".$_FILES['uploadFile']['name'];

            if(move_uploaded_file($_FILES['uploadFile']['tmp_name'], $targetPath))
            {
                $error = 'OK';

            }else{
                $error = 'Upload Failed!';
            }
        }else{
            $error = 'Input error!';
        }
        echo $error;
        $filenames = json_encode($_SESSION['filename']);     
?>

<script type="text/javascript">
    window.top.window.uploadEnd("<?php echo $error; ?>", '<?php echo $filenames; ?>');
</script>
