        <a href="#part_5">Introduction iFrame</a> | <a href="#part_6">Accéder au contenu</a> | <a href="#part_7">Chargement de contenu</a> | <a href="#part_8">Récupérer du contenu</a>
        <a name="part_5"></a>
        <h1>Introduction, rappel syntaxe iFrame <span><a href="#">top</a></span></h1>
            <p>
                L'élément <span style="color: dodgerblue; font-weight: 600;"> &lt;iframe&gt; </span>, pour ceux qui ne le connaisse pas, sert à insérer une page web dans une autre.
                Cette méthode faisait partie des spécifications HTML, cependant elle a été abandonnée lors de la mise en place du xHTML en raison de sa mauvaise accessibilité...
                Cette méthode avait largement été remplacée par les fameux <span style="color: red; font-weight: 600;">include: '...nom_du_fichier...';</span> de PHP.
            </p>
            <p>
                Voici un petit rappel de la syntaxe d'une iFrame:
            </p>
            <pre>
&lt;iframe src="nom_du_fichier.htm" width="500" height="600" name="myFrame" id="myFrame"&gt;&lt;/iframe&gt;
            </pre>
            <p>
                Cet élément n'est plus présent dans les normes W3C du xHTML, cependant il fait son grand retour en AJAX! Car il peut s'avérer très utiles pour y faire transiter des données.
                Le meilleur exemple est le cas d'upload en AJAX: un upload de fichier sans rechargement de la page, intéressant :-) !!!
            </p>
            <p>
                Mais tout d'abord nous allons voir dans la prochaine section comment manipuler les iFrames afin de récupérer leur contenu.
            </p>
            
            
        <a name="part_6"></a>
        <h1>Accéder au contenu de l'iFrame <span><a href="#top">top</a></span></h1>
            <p>
                Une iFrame est symbolisée comme un document dans un document. Pour accéder à son contenu il faut donc d'abord dans un premier lieu accéder à l'iFrame puis à son contenu.
            </p>
            <p>
                Il y a trois manières d'accéder à une iFrame:
            </p>
            <ol>
                <li>Avec l'ID de celle-ci</li>
                <li>Avec son NOM</li>
                <li>Avec l'objet global FRAMES</li>
            </ol>
            <p style="font-weight: 600;">
                On ne va pas utiliser la méthode de récupération par ID car elle va nous obliger à utiliser <span style="font-variant: small-caps">contentDocument</span> pour FireFox
                cependant IE ne la gère pas... Il ne nous reste donc en fait que deux méthodes soit via NAME, soit via FRAMES.
            </p>
            <p>
                Voici les deux méthodes en action:
            </p>
            <pre>
var oFrame = window.myFrame; //directement avec son "name"
var oFrame = window.frames['myFrame']; //avec l'objet global "frames"
            </pre>
            <p>
                Une fois l'iFrame atteinte on peut s'occuper de son contenu et y accéder.
                <span style="font-style: italic;">N'oubliez pas qu'une iFrame est considérée comme un document dans un document</span> donc pour accéder à son contenu nous allons avoir
                deux appels à l'objet <span style="color: green;">document</span>.
            </p>
            <pre>
var oFrame = window.myFrame.document; //via l'attribut "name"
var oFrame = window.frames['myFrame'].document // via l'objet global "frames"
            </pre>
            <p>
                Une fois que vous êtes au bon endroit les méthodes usuelles sont accessibles, telles que:
            </p>
            <ul>
                <li>getElementsByTagName('a');</li>
                <li>getElementById('myFrame');</li>
            </ul>
            <pre>
var oFrame = window.myFrame.document.getElementByTagName('a').length; //récupére le nombre de liens
var oFrame = window.frames['myFrame'].document.getElementById('myID').innerHTML // injecte du HTML
            </pre>      
            
            
        <a name="part_7"></a>
        <h1>Chargement de contenu <span><a href="#">top</a></span></h1>
            <p>
                Pour charger un fichier dans une iFrame il y a trois façons:
            </p>            
            <ol>
                <li>En remplissant directement l'attribut <strong>src</strong> en HTML. Le fichier est alors chargé à l'ouverture de la page contenant l'iFrame</li>
                <li>En modifiant, grâce à JavaScript l'attribut <strong>src</strong>.</li>
                <li>En ouvrant un lien dans l'iFrame avec l'attribut <strong>target</strong>, lui aussi INVALIDE aux yeux du W3C</li>
            </ol>
            <p>
                Les deux dernières méthodes sont assez efficace dans le cas d'une utilisation AJAX. Bien qu'invalide la méthode avec le target peut se révéler diablement
                pratique!
            </p>
            
            <h2>L'événement onLoad</h2>
            <p>
                Les iFrames possèdent un événement onLoad, qui se déclenche lorsque le contenu de l'iFrame vient d'être chargé. A chaque chargement de contenu, onLoad est
                alors déclenché. C'est un moyen efficace de savoir si le document est correctement chargé, et ainsi pouvoir le récupérer.
            </p>
            <p>
                Un petit exemple:
            </p>
            <pre>
&lt;iframe src="nom_du_fichier.htm" width="500" height="600" name="myFrame" id="myFrame" onload="trigger"&gt;&lt;/iframe&gt;

&lt;script type="text/javascript"&gt;
    function trigger()
    {
        alert('Contenu Chargé!');
    }

&lt;/script&gt;
            </pre>
            <h3>
                Exemple:
                <br />
                <a href="#part_3" onclick="popup('iframes/iframe_onload.xhtml', 320, 430)">Test de l'événement</a>
            </h3>
            
            <h2>L'inverse de onLaod, le CallBack</h2>
            <p>
                Lorsqu'un document est chargé dans une iFrame le code est directement exécuté. Cela veut donc dire que si c'est un fichier qui contient du JavaScript, il est possible
                de déclencher une fonction pour dire que le document est chargé. La fonction a exécuter, garante du bon chargement de la page, peut se trouver dans le fichier chargé au
                sein de l'iFrame, ou alors dans une page Web qui contient l'iFrame.
            </p>
            <cite>Ce qui veut dire qu'un script se trouvant dans l'iFrame peut appeler une fonction se trouvant dans la page HÔTE de l'iFrame!</cite>
            <p>
                L'appel de la fonction peut alors s'écrire de la sorte:
            </p>
            <pre>
window.top.window.nomDeLaFonction(); //remarquez le double appel à l'objet "window"
            </pre>
            
            <a name="callback"></a>
            <h3>
                Exemple:<br />
                <a href="#callback" onclick="popup('iframes/iframe_loading_callback.html', 320, 410)">tester la méthode de callback</a>
            </h3>
            
            <h4>Source du fichier: iframe_loading_callback.html</h4>
            <pre>
&lt;!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd"&gt;
&lt;html xmlns="http://www.w3.org/1999/xhtml"&gt;
&lt;head&gt;
&lt;title&gt;Techniques AJAX - iFrame Loading - callback&lt;/title&gt;
&lt;script type="text/javascript"&gt;
&lt;!--
        function callback() {
                alert("Fichier chargé !");
        }
//--&gt;
&lt;/script&gt;
&lt;/head&gt;
&lt;body&gt;
&lt;p&gt;
        &lt;iframe src="contenu_iframe_loading_callback.html" style="width: 280px; height: 380px;"&gt;&lt;/iframe&gt;
&lt;/p&gt;
&lt;/body&gt;
&lt;/html&gt;
            </pre>
            
            <h4>Source du fichier: iframe_loading_callback_contenu.html</h4>
            <pre>
&lt;!DOCTYPE html&gt;
&lt;html&gt;
    &lt;head&gt;
        &lt;title&gt;&lt;/title&gt;
        &lt;meta http-equiv="Content-Type" content="text/html; charset=UTF-8"&gt;
    &lt;/head&gt;
    &lt;body&gt;
        &lt;div&gt;
            &lt;p&gt;
                Appel de la fonction de callback du document parent:
                &lt;br /&gt;
                Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nam sit amet nisi nibh, et consequat velit. Fusce bibendum volutpat urna, ut facilisis mauris ullamcorper in. Suspendisse lacinia elit eget diam vehicula vitae auctor sapien vestibulum. Sed id lorem sit amet erat lacinia pellentesque. Suspendisse eget malesuada est. Morbi sollicitudin, ante egestas mollis mattis, quam odio tincidunt nisi, et mollis eros mi vitae odio. Proin nec tellus odio. Duis ut suscipit mi. Vestibulum ante ipsum primis in faucibus orci luctus et ultrices posuere cubilia Curae; Maecenas neque purus, auctor ac cursus nec, vulputate et dui. Lorem ipsum dolor sit amet, consectetur adipiscing elit.
            &lt;/p&gt;
            
            &lt;script type="text/javascript"&gt;
                <span style="color: red;">window.top.window.callback();</span>//remarquez le double appel à l'0bjet window
            &lt;/script&gt;
        &lt;/div&gt;
    &lt;/body&gt;
&lt;/html&gt;
            </pre>
            
            <cite>
                Ces deux techniques (onload && callback) peuvent donc être utilisées pour vérifier si le document est chargé.
                <br />
                Dans le cas de la deuxième technique, elle peut-être utilisée pour transmettre des données sous forme:
                <ul>
                    <li>objets JSON</li>
                    <li>variables STRING</li>
                    <li>variables Array</li>
                    <li>etc [...]</li>
                </ul>
            </cite>
            
            
            <h2>L'attribut SRC</h2>
            <p>
                Pour changer l'URL du fichier à charger dans l'iFrame quoi de plus aisé que de changer l'attribut src:
            </p>
            <pre>
document.getElementsById('myFrame').src = 'autreFichier.html';
            </pre>
            
            <a name="changeSrc"></a>
            <h3>
                Exemple:
                <br />
                <a href="#changeSrc" onclick="changeSrc()">changer la source de l'iframe</a>
                <br /><br />
            </h3>
            
            <div>
                <iframe src="image/229897.png" width="70" height="50" name="myFrame" id="myFrame">
                    <?php
                        header('Content-Type: image/png');
                    ?>
                </iframe>
            </div>
            
            <h2>Le Target</h2>
            <p>
                Comme iframe, l'attribut target est délaissé en xHTML pour des raisons d'accessibilité. C'est un attribut utilisé sur les balises &lt;a&gt;
                et &lt;form&gt; qui sert à définir l'endroit où le liens va s'ouvrir (nouvelle fenêtre ou fenêtre parente). Cet attribut était couramment
                utilisé à l'époque ou les framesets étaient encore utilisés.
            </p>
            
            <p>
                Nous allons utiliser TARGET pour charger un lien dans l'iframe. Cet attribut n'est pas vraiment intéressant pour &laquo;juste&raquo; charger
                une page. Nous nous en servirons avec les balises FORM, dans le cas d'un upload de fichier par exemple &rArr; Dire au formulaire d'envoyer
                ces données dans l'iFrame choisie.
            </p>
            
            <cite>
                Voici tout de même un petit exemple avec un lien
            </cite>
            
            <pre>
&lt;iframe src="#" name="nameFrame" id="idFrame" width=200 height=200&gt;&lt;/iframe&gt;
&lt;a target="nameFrame" href="http://www.google.ch"&gt;Chargez Google.ch&lt;/a&gt;
            </pre>
            
            <h3>
               Exemple:
               <br />
               <a href="http://www.google.ch/maps" target="nameFrame">Chargez Google Maps</a>
               <br /><br />
            </h3>
            
            <div>
                <iframe src="iframes/contenu_iframe.html" name="nameFrame" id="idFrame" width=830 height=400></iframe>                
            </div>
            
            
            <a name="part_8"></a>
            <h1>Récupérer du contenu <span><a href="#">top</a></span></h1>
            <p>
                La récupération de contenu d'une iFrame est assez simple. J'ai déjà montré comment accéder à l'iFrame, il n'y a plus qu'à ajouter quelques points supplémentaires.
            </p>
            
            <h2>Données structurées: arbre XML</h2>
            <p>
                Si vous chargez un document XML ou HTML, vous pouvez récupérer vos données en utilisant les méthodes du DOM (getElementById, getElementByTagName, ...).
            </p>
            
            <h2>Données textuelles: HTML et TXT</h2>
            <p>
                En revanche, si vous voulez récupérer les données au format txt, vous devez utiliser <strong>innerHTML</strong>.
                Un document chargé dans l'iFrame possède un élément <strong>body</strong>. Même si c'est un fichier texte, un élément <strong>body</strong> est présent
                virtuellement: c'est lui qui englobe la totalité des informations disponibles
            </p>
            
            <p>
                Ainsi vous devez passer par le body pour utiliser <strong>innerHTML</strong> <strong>(!! Car il est impossible de faire innerHTML directement sur l'objet <span style="color: red">document</span> !!)</strong>
            </p>
            
            <pre>
var sContent = window.frames['myFrame'].document.body.innerHTML;
            </pre>
            
            <a name="loadFrame"></a>
            <h3>
                Exemple:
                <br />
                <a href="#loadFrame" onclick="loadFrameContent()">Charger le contenu d'un iFrame</a>
            </h3>
            <div id="output">&nbsp;</div>
            
            <h1>Upload de fichiers <span><a href="#">top</a></span></h1>
            <p>
                On va maintenant voir une utilisation pratique du système d'iFrame Loading: l'upload de fichiers.
                Le fichier a uploadé est bien sûre sur le HDD.
            </p>
            
            <h2>Côté HTML</h2>
            <p>
                Le problème de l'upload c'est qu'il faut utiliser un encodage <i>multipart/form-data</i> pour envoyer le formulaire d'upload de fichier.
                S'il suffisait d'utiliser une bête requête POST, on l'aurait fait avec XMLHttpRequest. Mais XHR ne permet pas de spécifier l'encodage du formulaire.
            </p>
            
            <p>
                Le principe consiste tout simplement à envoyer le formulaire dans une iFrame. Le traitement du formulaire se fait alors via PHP et le résultat de l'upload
                est renvoyé par le biais de l'iFrame via un système de <strong>callback</strong>.
            </p>
            
            <h3>Le Formulaire d'upload:</h3>
            <div style="padding: 10px; border: 1px dodgerblue solid; margin-top: 10px; float: left; width: 370px; height: 130px;">
                <form id="uploadForm" enctype="multipart/form-data" action="iFrame_upload.php" target="uploadFrame" method="POST" onSubmit="uploadRun()">
                    <input type="file" id="uploadFile" name="uploadFile" />
                    <br />
                    <br />
                    <input type="submit" id="uploadSubmit" value="Upload!" />
                </form>
            </div>
            <div style="float: right; margin-top: 10px;">
                <iframe name="uploadFrame" id="uploadFrame" src="#" width="400" style="border: dodgerblue 1px solid;"></iframe>
            </div>
            <div style="clear: both;"></div>
            <cite id="uploadStatus">
                No Upload Yet!
            </cite>
            
            <h2>Le script PHP</h2>
            <p>
                Le script PHP s'occuppe juste de l'upload. Une fois le script exécuté, les variables <i>$error</i> &amp; <i>$filename</i> sont écrites
                dans le code JS qui va se charger d'appeler la fonction <strong>uploadEnd</strong>. Cette dernière se chargera d'avertir le client
                du statut de l'upload, et si il est réussi, lui retournera l'url du fichier uploadé <strong>$filename</strong>.
            </p>
            
            
            
            <script type="text/javascript">

                function uploadRun()
                {
                    document.getElementById('uploadStatus').innerHTML = "<img src=\"image/loader.gif\" title=\"Upload en cours\" />";
                    document.getElementById('uploadSubmit').disabled = true;
                    return true;
                }
                
                
                function uploadEnd(sError, sFilenames)
                {
                    var oFilenames = JSON.parse(sFilenames);
                    var imgList = new Array();
                    
                    for(i = 0; i<oFilenames.length; i++)
                        {   
                            if(sError === 'OK')
                                {                                    
                                    var img = document.createElement('img');
                                    img.setAttribute('src', oFilenames[i]);
                                    img.setAttribute('title', oFilenames[i]);
                                    imgList.push(img);
                                    document.getElementById('uploadStatus').innerHTML = "";
                                    for(j = 0; imgList.length > j; j++)
                                        {
                                            document.getElementById('uploadStatus').appendChild(imgList[j]);
                                            document.getElementById('uploadSubmit').disabled = false;
                                        }
                                }else{
                                    document.getElementById('uploadStatus').innerHTML = sError;
                                    document.getElementById('uploadSubmit').disabled = false;
                                    return false;
                                }                                    

                        }
                }
                
                function loadFrameContent()
                {
                    var sContent = "";
                    sContent = window.frames['nameFrame'].document.body.innerHTML;
                    var node = document.createElement('p');
                    node.setAttribute('id', 'iframeContent');
                    
                    var wrapper = document.getElementById('output');                    
                    sContent = sContent.substring(32, sContent.length - 5);//supprime le P de départ ainsi que la balise fermante.
                    node.innerHTML = sContent;
                   
                    if(document.getElementById('iframeContent'))
                        {
                            return false;
                        }else{
                            wrapper.appendChild(node);
                        }
                    
                }
                
                function changeSrc()
                {
                    if (document.getElementById('myFrame').src === 'http://yungi.com/site_perso_yungi/test_ajax/image/229897.png')
                        {
                            document.getElementById('myFrame').src = 'image/229896.png';
                        }else{
                            document.getElementById('myFrame').src = 'image/229897.png';
                        }
                }

                function popup(page, largeur, hauteur)
                {
                        var margin_gauche;
                        margin_gauche = screen.width;
                        margin_gauche = margin_gauche/2;
                        margin_gauche -= largeur/2;

                        var margin_haut;
                        margin_haut = screen.height;
                        margin_haut = margin_haut/2;
                        margin_haut -= hauteur/2;

                        window.open(page, 'test_ajax_iframe','menubar=no, status=no, scrollbars=no, menubar=no, width='+largeur+', height='+hauteur+', left='+margin_gauche+', top='+margin_haut+'');
                }                
            </script>        
    </body>
</html>
