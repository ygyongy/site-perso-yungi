<a href="#part_1">Introduction Ajax</a> | <a href="#part_2">L'Objet XMLHttpRequest</a> | <a href="#part_3">Premiers Exemples</a> | <a href="#part_4">Propriétés et Méthodes</a>    <a name="part_1"></a>
    <h1>Introduction à Ajax <span><a href="#">top</a></span></h1>
            <h2>Site Web traditionnels [schéma]</h2>
            <p>
                Toute la charge de travail est attribuée au serveur:
            </p>
            <div>
                <img src="image/161864.png" alt="architecture_classique" />
            </div>

            <h2>Site Web ajax [schéma]</h2>
            <p>
                Ici on répartit la charge de travail entre le server et le client. Le serveur ne recrachera pas une page web complète mais uniquement des données dans un format aléger JSON ou XML.
                Et surtout on évitera de recharger toute la page... on ne réactualise que la <u>partie nécessaire</u>.
            </p>
            <p>
                Un exemple peut être Facebook ; sur Facebook il y a la possibilité d'afficher les amis d'une personne sans recharger la page. Quand vous cliquez sur le lien Afficher les amis, une requête est envoyée au serveur, lequel renvoie la liste des amis de la personne dont vous souhaitez connaître les amis. Cette liste est alors affichée dynamiquement via JavaScript. Pas de rechargement de page, juste une requête rapide – quasi instantanée – et un confort de navigation accru.
            </p>
            <div>
                <img src="image/161865.png" alt="architecture_Ajax" />
            </div>

            <h2>Dialoguer avec le Server</h2>
            <p>Ici juste un bref paragraphe sur les différents formats possibles lors du dialogue avec notre server:</p>
            <ul>
                <li>Texte brut</li>
                <li>HTML</li>
                <li>XML</li>
                <li>JSON</li>
            </ul>

            <h2>Texte Brut</h2>
            <p>
                Format pas super intéressant, on cherche à avoir des données formatées...
            </p>
            
            <h2>HTML</h2>
            <pre>
                &lt;ul&gt;<br/>
                        &lt;li&gt;&lt;span title="a4242"&gt;Gordon&lt;/span&gt;&lt;/li&gt;<br/>
                        &lt;li&gt;&lt;span title="j3781"&gt;Barney&lt;/span&gt;&lt;/li&gt;<br/>
                        &lt;li&gt;&lt;span title="j7638"&gt;Eli&lt;/span&gt;&lt;/li&gt;<br/>
                        &lt;li&gt;&lt;span title="o7836"&gt;Chell&lt;/span&gt;&lt;/li&gt;<br/>
                        &lt;li&gt;&lt;span title="e58<31"&gt;Odessa&lt;/span&gt;&lt;/li&gt;<br/>
                &lt;/ul&gt;<br/>
            </pre>

            <h2>XML</h2>
            <p>
                Lors de l'utilistation d'objets particuliers, XMLHttpRequest, permettent le retour d'information au format XML et de l'interpréter
                comme tel. Ce qui permet de manipuler ces données via les fonctions DOM. Cependant c'est un langage très verbeux... donc pas super optimiser.
            </p>
            <pre>
                &lt;friends&gt;<br/>
                        &lt;f name="Gordon" id="a4242" /&gt;<br/>
                        &lt;f name="Barney" id="j3781" /&gt;<br/>
                        &lt;f name="Eli" id="j7638" /&gt;<br/>
                        &lt;f name="Chell" id="o7836" /&gt;<br/>
                        &lt;f name="Odessa" id="e5831" /&gt;<br/>
                &lt;/friends&gt;<br/>
            </pre>

            <h2>JSON</h2>
            <p>
                Puis il reste le JSON, qui lui utilise la syntaxe objet de JavaScript pour structurer l'information, en l'occurence des objets et des tableaux.
                Il a l'avantage d'être très léger car non verbeux. Cependant il doit être évalué pour être utilisé comme un objet. L'évaluation se fait via <i><strong>eval</strong></i> pour les navigateurs obsolètes ou via la méthode parse de l'objet natif JSON.
            </p>
            <pre>
            [<br/>
                    { "name":"Gordon", "id":"a4242" },<br/>
                    { "name":"Barney", "id":"j3781" },<br/>
                    { "name":"Eli", "id":"j7638" },<br/>
                    { "name":"Chell", "id":"o7836" },<br/>
                    { "name":"Odessa", "id":"e5831" }<br/>
            ]<br/>
            </pre>
            <p>
                Le JSON est donc le format travaillant de paire avec AJAX quand il s'agit de recevoir des données classées et structurées. Les autres formats peuvent bien évidemment servir et se révéler intéressants dans certains cas, mais d'une façon générale les grandes pointures du JavaScript, comme Douglas Crockford incitent à utiliser JSON.
            </p>

            <h2>Le principe Synchrone</h2>
            <p>
                La particularité d'Ajax et l'Asynchronisme: <strong>La fonction qui envoie une requête N'EST PAS LA MÊME que celle qui en recevra la réponse</strong>.<br /><br />
                Mais enfin plus facile de passer par l'exemple:
            </p>
            <pre>
                var plop = 0; // première instruction<br/>
                plop += 2;    // deuxième<br/>
                alert(plop);  // et troisième<br/>
            </pre>
            <p>Maintenant imaginons qu'il y aie un appel à une fonction</p>
            <pre>
                var plop = 0; // première instruction<br/>
                plop = additionner(plop, 2);    // deuxième<br/>
                alert(plop);  // et troisième<br/>
            </pre>
            <p>
                Dans ce dernier cas on est d'accord, le script appel la fonction additionner(plop, 2); <strong><i>PUIS CE MET EN PAUSE</i></strong> en attendant la réponse de la fonction.
                <br />
                On dit dans ce cas que le script est effectué de façon <strong>Synchrone</strong>!
            </p>

            <h2>Le principe Asynchrone</h2>
            <p>
                Le contraire de synchrone est asynchrone. Lorsque l'on fait un appel <strong>ASYNCHRONE</strong> le script principal n'attend pas de recevoir une réponse pour continuer à s'éxécuter.
                Bon maintenant mon exemple avec un appel de fonction marche très bien de manière SYNCHRONE, par contre pour les demandes ASYNCHRONES c'est peine perdue...
                <br />
                Imaginons alors une Requête AJAX!
                <br />
                Cheminement du script en steps:
            </p>
            <ol>
                <li>Le script s'éxécute</li>
                <li>Il rencontre une requête Ajax</li>
                <li>Elle (la requête) est envoyée de manière ASYNCHRONE</li>
                <li>Le script, sans attendre la réponse, continue tranquilement</li>
                <ul>
                    <li>Mais si la requête est envoyée et que le script n'attend pas sa réponse, comment savoir quand cette requête renvoie quelque chose ?</li>
                </ul>
                <li>Et c'est ici qu'interviennent les fonctions de <strong><i>CALLBACK</i></strong>.</li>
                <ul>
                    <li> Une fonction de callback est exécutée lorsque le requête abouti à qqch. Et cette fonction va permettre de récupérer les données renvoyées par la requête.</li>
                    <li>
                        Résumé de l'ASYNCHRONISME en Ajax selon ce schéma
                        <br />
                        <img src="image/161866.png" alt="Asynchronisme Ajax" />
                    </li>
                </ul>
            </ol>

        <a name="part_2"></a>
        <h1>L'Objet XMLHttpRequest <span><a href="#">top</a></span></h1>
            <h2>Concept de XMLHttpRequest</h2>
            <p>
                Le principe de fonctionnement de XMLHttpRequest est:
            </p>
            <ol>
                <li>Envoi d'une requête HTTP vers les serveurs</li>
                <li>Récupérer la ou les réponses du serveur</li>
            </ol>
            <p>
                Pour ce faire il faut donc disposer d'un objet ayant ce genre de fonctionnalités.
                MicroSoft a créé, historiquement parlant, ce type de contrôle ActiveX XMLHTTP pour Outlook et IE 5.5
                <br /><br />
                Puis les autres navigateurs suivirent le trend de MS_IE 5.5 et l'implémentèrent... seulement sous un
                autre nom => <strong>XMLHttpRequest</strong>.
                <br /><br />
                Puis l'objet XMLHttpRequest fut proposé au W3C pour l'imposer comme standard.
            </p>
            <table class="tab_user">
                <thead>
                    <tr>
                        <th>
                            <br>
                            Méthode
                        </th>
                        <th>
                            <img src="image/229899.png" alt="Image utilisateur"><br>
                            Internet Explorer
                        </th>
                        <th>
                            <img src="image/229896.png" alt="Image utilisateur"><br>
                            Firefox
                        </th>
                        <th>
                            <img src="image/229898.png" alt="Image utilisateur"><br>
                            Opera
                        </th><th>
                            <img src="image/229897.png" alt="Image utilisateur"><br>
                            Google Chrome
                        </th>
                        <th>
                            <img src="image/229900.png" alt="Image utilisateur"><br>
                            Safari
                        </th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td><strong>XMLHttpRequest</strong></td>
                        <td><div class="centre"><span class="vertf">Oui</span><br>
                        <span class="tpetit">avec ActiveX pour IE &lt; 7</span></div></td>
                        <td><div class="centre"><span class="vertf">Oui</span></div></td>
                        <td><div class="centre"><span class="vertf">Oui</span></div></td>
                        <td><div class="centre"><span class="vertf">Oui</span></div></td>
                        <td><div class="centre"><span class="vertf">Oui</span></div></td>
                    </tr>
                </tbody>
            </table>

            <h2>Instancier un Objet XMLHttpRequest JS</h2>
            <pre>
                var xhr = new XMLHttpRequest();
            </pre>
            <p>
                Cependant toutes les versions d'IE &lt; 7.0 nécessitent un objet ActiveX, ce qui complique l'appel:
                <br />
                <i>PS: appel toujours en JS</i>
            </p>
            <pre>
                try {
                        var xhr = new ActiveXObject("Msxml2.XMLHTTP");
                } catch(e)  {
                        var xhr = new ActiveXObject("Microsoft.XMLHTTP");
                }
            </pre>
            <p>
                Maintenant pour faire un SCRIPT homogène:
            </p>
            <pre>
                var xhr = null;
                if (window.XMLHttpRequest || window.ActiveXObject) {
                        if (window.ActiveXObject) {
                                try {
                                        xhr = new ActiveXObject("Msxml2.XMLHTTP");
                                } catch(e) {
                                        xhr = new ActiveXObject("Microsoft.XMLHTTP");
                                }
                        } else {
                                xhr = new XMLHttpRequest(); 
                        }
                } else {
                        alert("Votre navigateur ne supporte pas l'objet XMLHTTPRequest...");
                        return null;
                }
                return xhr; //retourne l'objet XMLHttpRequest
            </pre>
            <p>
                J'ai mis ce script dans un fichier externe... initAjax.js
            </p>

            <h2>Envoi d'une requête HTTP</h2>
            <p>
                Tout d'abord il faut définir la méthode d'envoi puis l'envoyer
            </p>
            <ol>
                <li>xhr.open<strong>(string Method, string Url, booléen Async)</strong>
                <br />
                - <strong>string Method</strong> -> POST ou GET
                <br />
                - <strong>string Url</strong> -> la page qui donnera suite à la requête (ASP, PHP, CFM, ...) ou (TXT, XML)
                <br />
                - <span style="color: red;"><strong>SI VOUS UTILISEZ LA METHODE POST</strong> -> vous devez ABSOLUMENT changer le type MIME de la requête!!!
                <br/>
                - ! Cette dernière ligne doit être placée après la ligne contenant la méthode open !</span>
                <pre style="width: 660px; border-color: red;">
                    xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
                </pre>
                </li>
                <li>xhr.send<strong>(string contenu)</strong></li>
            </ol>
            <pre>
                var xhr = getXMLHttpRequest(); // Voyez la fonction getXMLHttpRequest() définie dans la partie précédente

                xhr.open("GET", "handlingData.php", true);
                xhr.send(null);
            </pre>

            <h2>Passer des variables</h2>
            <p>
                On peut passer des variables au serveur. Cependant il y a une différence selon la méthode utilisée.
            </p>
            <h3>&gt; GET</h3>
            <p>
                Directement dans l'URL
            </p>
            <pre>
                xhr.open("GET", "handlingData.php?variable1=truc&variable2=bidule", true);
                xhr.send(null);
            </pre>
            <h3>&gt; POST</h3>
            <p>
                Il faut passer les variables dans la méthode send
            </p>
            <pre>
                xhr.open("POST", "handlingData.php", true);
                xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
                xhr.send("variable1=truc&amp;variable2=bidule");
            </pre>

            <h3>&gt; Protéger les caractères</h3>
            <p>
                Pour passer des variables au serveur il faut d'abord la traiter, dans le but de garder les espaces et les caractères spéciaux.
                Utilisez la fonction globale <span style="color: green">encodeURIComponent</span>.
                <br />
                Faites comme ceci:
            </p>
            <pre>
                var sVar1 = encodeURIComponent("contenu avec des espaces");
                var sVar2 = encodeURIComponent("je vois que vous êtes un bon élève... oopa !");

                xhr.open("GET", "handlingData.php?variable1=" + sVar1 + "&variable2= " + sVar2, true);
                xhr.send(null);
            </pre>

            <h2>Le traitement côté serveur</h2>
            <p>
                Dans cette exemple la page qui reçoit les infos est la page handlingData.php. En l'occurence c'est une page dynamique mais elle aurait très bien pu être statique XML ou TXT ...
            </p>
            <p>
                Cette page se comporte comme une page PHP normale.
            </p>
            <ul>
                <li>Les variables se récupèrent par $_GET[] ou $_POST[]</li>
                <li>Il ne faut pas oublier de sécuriser la page <i>éviter les accès directs</i> </li>
            </ul>
            <p>
                Petit test:
            </p>
            <pre>
                &lt;?php

                $variable1 = (isset($_GET["variable1"])) ? $_GET["variable1"] : NULL;
                $variable2 = (isset($_GET["variable2"])) ? $_GET["variable2"] : NULL;

                if ($variable1 && $variable2) {
                        // Faire quelque chose...
                        echo "OK";
                } else {
                        echo "FAIL";
                }

                ?&gt;
            </pre>
            <p>
                Cette page ne fait pas grand chose de très intéressant, elle vérifie juste que les deux valeurs soient initialisées et non-vide et affiche OK si c'est le cas.
            </p>

            <h2>Récupération des données</h2>
            <p>
                Récapitulons:
            </p>
            <ol>
                <li>On envoie la requête</li>
                <li>La requête a trouvé des réponses à récupérer [données fournies par la page PHP ou autres]</li>
            </ol>
            <h3>Le Changement d'état</h3>
            <p>
                Il faut savoir que lorsque l'on envoie une requête HTTP avec XMLHttpRequest, celle-ci passe par plusieurs états!
            </p>
            <ol start="0">
                <li> - L'objet XHR a été créé mais pas encore initialisé (La méhtode OPEN n'a pas encore été appelée)</li>
                <li> - L'objet XHR a été créé mais pas encore envoyé (La méthode SEND n'a pas encore été appelée)</li>
                <li> - La méthode SEND vient d'être appelée</li>
                <li> - Le serveur traite les informations et a commencé à renvoyé les données</li>
                <li> - Le serveur a fini son travail et toutes les données sont réceptionnées</li>
            </ol>
            <p>
                Il va donc falloir détecter les états... afin de savoir ou en est la requête.
                pour cela on va utiliser la propriété <strong>onreadystatechange</strong>, et on regardera à chaque changement d'état duquel il s'agit
            </p>
            <pre>
                var xhr = getXMLHttpRequest();

                xhr.onreadystatechange = function() {
                        if (xhr.readyState == 4 && (xhr.status == 200 || xhr.status == 0)) {
                                alert("OK"); // C'est bon \o/
                        }
                };

                xhr.open("GET", "handlingData.php", true);
                xhr.send(null);
            </pre>
                
            <script type="text/javascript">

                var xhr = getXMLHttpRequest();

                xhr.onreadystatechange = function(){
                    if(xhr.readyState == 4 && (xhr.status == 200 || xhr.status == 0))
                        {
                            var mon_paragraphe = document.createElement('pre');
                            var mon_contenu = document.createTextNode("\nStatut de la requete: "+xhr.readyState+"\n\n");
                            mon_paragraphe.style.marginLeft = '20px';
                            mon_paragraphe.style.border = '1px solid red';
                            mon_paragraphe.style.width = '630px';
                            mon_paragraphe.style.paddingLeft = '50px';
                            mon_paragraphe.appendChild(mon_contenu);
                            var output = document.getElementById('result');
                            output.appendChild(mon_paragraphe);
                        }
                };

                xhr.open('GET', 'traitement_data.php', true);
                xhr.send(null);
            </script>

            <h2>&dArr; Petit test de mise en pratique &dArr;</h2>
            <div id="result">
                <!-- contenu AJAX -->
            </div>

            <p>
                On utilise readyState pour connaître l'état de la requête. En addition, nous devons aussi vérifier le code d'état (comme le fameux code 404 pour les pages non trouvées ou le code 500 pour l'erreur de serveur) de la requête, pour vérifier si tout s'est bien passé. Pour cela, on utilise la propriété status. Si elle vaut 200 ou 0 (aucune réponse, pratique pour les tests en local, sans serveur d'évaluation), tout est OK.
            </p>

            <h3>Récupérer les données</h3>
            <p>
                Rien de plus simple il suffit d'utiliser une des deux propriétés disponibles:
            </p>
            <ul>
                <li>responseText: pour récupérer toute les données en TEXTE BRUT</li>
                <li>responseXML: pour récupérer toute les donées en ARBRE XML</li>
            </ul>
            <h3>Une alerte simple</h3>
            <pre>
                xhr.onreadystatechange = function(){
                    if(xhr.readyState == 4 && (xhr.status == 200 || xhr.status == 0))
                        {
                            alert(xhr.responseText);
                        }
                };
            </pre>

            <script type="text/javascript">
                var xhr2 = getXMLHttpRequest();

                var sVar1 = encodeURIComponent("Bonjour Gyongy Yann:\n");
                var sVar2 = encodeURIComponent(" - Je vois que vous êtes un bon élève... oopa !");

                xhr2.onreadystatechange = function(){
                    if(xhr2.readyState == 4 && (xhr2.status == 200 || xhr2.status == 0))
                        {
                            var mon_paragraphe = document.createElement('pre');
                            var mon_contenu = document.createTextNode(xhr2.responseText);
                            mon_paragraphe.style.marginLeft = '20px';
                            mon_paragraphe.style.border = '1px solid red';
                            mon_paragraphe.style.width = '630px';
                            mon_paragraphe.style.paddingLeft = '50px';
                            mon_paragraphe.appendChild(mon_contenu);
                            var output = document.getElementById('result_real');
                            output.appendChild(mon_paragraphe);
                        }
                };

                xhr2.open("GET", "traitement_data.php?variable1=" + sVar1 + "&variable2= " + sVar2, true);
                xhr2.send(null);
            </script>

            <div id="result_real">
                <h2>&dArr; Contenu Ajax avec script JS &dArr;</h2>
                <!-- Contient le résultat de la requête AJAX -->
            </div>

            <h2>Une fonction de CallBack</h2>
            <p>
                Une alerte c'est bien joli mais à part vérifier si une valeur est initialisée... c'est plus ou moins inutile. Si on s'amuse à récupérer des données c'est pour les traiter!
                <strong>Le traitement peut se faire directement dans la fonction anonyme définie DANS le ONREADYSTATECHANGE.</strong> Mais c'est plutôt moche et surtout ce n'est pas sa place!
                Il vaut mieux avoir deux petites méthodes plutôt qu'une grande qui fait tout!
            </p>
            <p>
                On va donc définir une fonction de <strong>CALLBACK</strong>. Une fonction de callback est une fonction de rappel, <strong>éxécutée normalement APRÈS qu'un script soit exécuté</strong>.
                C'est pas très clair mais c'est tout CON en fait: il s'agit de passer à une FUNCTION A le NOM D'UNE FONCTION B qui sera lancée une fois que la fonction A aie été exécutée.
            </p>
            <p>
                Exemple:
            </p>
            <pre>
                function functionA (callback)
                {
                    //instructions...
                    //instructions...
                    callback();
                }

                function functionB ()
                {
                    // On peut maintenant traiter les données sans encombrer l'objet XHR.
                    alert('Plop');
                }

                //appel
                functionA(functionB)
            </pre>

            <script type="text/javascript">

                function requestData(callback)
                {
                    var xhr3 = getXMLHttpRequest();

                    xhr3.onreadystatechange = function()
                            {
                                if(xhr3.readyState == 4 && (xhr3.status == 200 || xhr3.status == 0))
                                    {
                                        callback(xhr3.responseText);
                                    }
                            };
                    xhr3.open('GET', "traitement_data.php?variable1=Salut&variable2=Petit_con", true);
                    xhr3.send(null);
                }

                function readData(datas)
                {
                    if(datas === 'SalutPetit_con')
                    {
                        var my_wrapper = document.createElement('pre');
                            my_wrapper.style.marginLeft = '20px';
                            my_wrapper.style.border = '1px solid red';
                            my_wrapper.style.width = '630px';
                            my_wrapper.style.paddingLeft = '50px';
                        var my_content = document.createTextNode(datas);
                        var my_output = document.getElementById('result_3');

                        my_wrapper.appendChild(my_content);
                        my_output.appendChild(my_wrapper);
                    }else{
                        alert('Il y a eu un problème');
                    }
                }
            </script>

            <h2>&dArr; Il est donc facile de transposer ce genre de concept; essayons: &dArr;</h2>
            <div onClick="requestData(readData)" id="result_3">
                <h4>Petit test ajax - <i>cliquez pour voir, même plusieurs fois</i></h4>
                <!-- contenu Ajax créer en JS -->
            </div>

            <a name="part_3"></a>
            <h1>Premiers exemples <span><a href="#">top</a></span></h1>
            <p>
                Affichage d'un fichier XML dans une liste. Je vais créer un petit fichier XML pour l'exercice.
            </p>
            <pre>
                &lt;?xml version="1.0" encoding="UTF-8"?&gt;

                &lt;root&gt;
                    &lt;categorie name="Accueil" /&gt;
                    &lt;categorie name="Entreprise" /&gt;
                    &lt;categorie name="Catalogue" /&gt;
                    &lt;categorie name="Liens" /&gt;
                    &lt;categorie name="Contact" /&gt;
                    &lt;categorie name="Administration" /&gt;
                &lt;/root&gt;
            </pre>

            <p>
                Le code JS qui va nous permettre d'afficher le contenu XML dans une liste -> genre menu
            </p>
            <pre>
                function request(callback) {
                        var xhr = getXMLHttpRequest();

                        xhr.onreadystatechange = function()
                        {
                                if (xhr.readyState == 4 && (xhr.status == 200 || xhr.status == 0))
                                {
                                        callback(xhr.responseXML);
                                }
                        };

                        xhr.open("GET", "XMLHttpRequest_getXML.xml", true);
                        xhr.send(null);
                }

                function readData(oData)
                {
                        var nodes = oData.getElementsByTagName("soft");
                        var ol = document.createElement("ol"), li, cn;

                        for (var i=0, c=nodes.length; i&lt;c; i++)
                        {
                                li = document.createElement("li");
                                cn = document.createTextNode(nodes[i].getAttribute("name"));

                                li.appendChild(cn);
                                ol.appendChild(li);
                        }

                        document.getElementById("output").appendChild(ol);
                }
            </pre>

            <script type="text/javascript">
                function initXHR(callback)
                {
                    var xhr4 = getXMLHttpRequest();
                    
                    xhr4.onreadystatechange = function()
                    {   
                        if(xhr4.readyState == 4 && (xhr4.status == 200 || xhr4.status == 0))
                        {
                            callback(xhr4.responseXML);
                        }
                    };

                    xhr4.open('GET', 'liste_categories.xml', true);
                    xhr4.send(null);
                }

                function printData(datas)
                {
                    //récupération du noeud DOM
                    var nodes = datas.getElementsByTagName('categorie');
                    var ul = document.createElement('ul');
                    var number_element = nodes.length;

                    //boucle qui permet de récupérer tous les éléments XML
                    for(var i = 0; i < number_element; i++)
                        {
                            var li = document.createElement('li');
                            var contenu_li = document.createTextNode(nodes[i].getAttribute('name'));
                            li.appendChild(contenu_li);
                            ul.appendChild(li);
                        }
                        var output = document.getElementById('result_xml');
                        var pre = document.createElement('pre');
                        pre.style.marginLeft = '20px';
                        pre.style.border = '1px solid red';
                        pre.style.width = '630px';
                        pre.style.paddingLeft = '50px';
                        pre.appendChild(ul);
                        output.appendChild(pre);
                }
            </script>
            
            <h2>&dArr; Petit test de mise en pratique &dArr;</h2>
            <div id="result_xml">
                <input type="button" onClick="initXHR(printData)" value="print_XML" />
                <!-- Contenu Ajax généré par du JS -->
            </div>

            <h2>Envoi - traitement - réception</h2>
            <p>
                Cette exemple a pour but d'envoyer un un login et un pseudo.
                <br /><br />
                Exemple sans gestion des erreurs
            </p>
            <pre>
                function request(callback)
                {
                        var xhr = getXMLHttpRequest();

                        xhr.onreadystatechange = function()
                                {
                                if (xhr.readyState == 4 && (xhr.status == 200 || xhr.status == 0)) {
                                        callback(xhr.responseText);
                                }
                        };

                        var nick = encodeURIComponent(document.getElementById("nick").value);
                        var name = encodeURIComponent(document.getElementById("name").value);

                        xhr.open("GET", "XMLHttpRequest_getString.php?Nick=" + nick + "&Name=" + name, true);
                        xhr.send(null);
                }

                function readData(sData)
                {
                        alert(sData);
                }
            </pre>

            <script type="text/javascript">
                function request_pseudo(callback)
                {
                    var xhr5 = getXMLHttpRequest();

                    xhr5.onreadystatechange = function()
                    {
                        if(xhr5.readyState == 4 && (xhr5.status == 200 || xhr5.status == 0))
                            {
                                callback(xhr5.responseText)
                            }
                    };
                    var nom = encodeURIComponent(document.getElementById('nom').value);
                    var pseudo = encodeURIComponent(document.getElementById('pseudo').value);

                    //test de gestion des erreurs
                    if(nom.length > 2 && pseudo != nom)
                        {
                            if (pseudo.length > 2 && pseudo != nom)
                                {
                                    xhr5.open('post', 'traitement_form.php', true);
                                    xhr5.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
                                    xhr5.send('nom='+nom+'&pseudo='+pseudo);
                                    
                                    document.getElementById('error_pseudo').style.display = 'none';
                                }else{
                                    document.getElementById('error_pseudo').innerHTML = 'Vous devez saisir un pseudo de min. 3 lettres ET le pseudo DOIT être différent du nom!';
                                    document.getElementById('error_pseudo').style.display = 'inline';
                                }
                                document.getElementById('error_nom').style.display = 'none';
                        }else{
                            document.getElementById('error_nom').innerHTML = 'Vous devez saisir un nom de min. 3 lettres';
                            document.getElementById('error_nom').style.display = 'inline';
                        }
                }

                function readDataPrint (datas)
                {
                    var my_wrapper = document.createElement('pre');
                    my_wrapper.style.marginLeft = '20px';
                    my_wrapper.style.border = '1px solid red';
                    my_wrapper.style.width = '630px';
                    my_wrapper.style.paddingLeft = '50px';
                    var my_content = document.createTextNode(datas);
                    var output = document.getElementById('result_form');

                    my_wrapper.appendChild(my_content);
                    output.appendChild(my_wrapper);
                }
            </script>

            <fieldset>
                <legend>Saisie d'un login et d'un pseudo</legend>
                <form action="" method="post" name="form_pseudo" id="form_pseudo">
                    <p>   
                        <span style="display: block;"><label for="nom" style="width: 100px;">Nom:</label></span>
                        <input type="text" id="nom" />
                        <span id="error_nom"><!-- Contenu JS --></span>
                        <br/>
                        <span style="display: block;"><label for="pseudo">Pseudo: </label></span>
                        <input type="text" id="pseudo" tabindex="1" />
                        <span id="error_pseudo"><!-- Contenu JS --></span>
                    </p>
                    <p>
                        <input type="button" value="envoyer" id="bouton_envoyer" onClick="request_pseudo(readDataPrint)" />
                    </p>
                </form>

                <h2>&dArr; Voici la réponse &dArr;</h2>
                <div id="result_form">
                    <!-- contenu récupérer en Ajax -->
                </div>
            </fieldset>

            <h2>Contrôle d'état de la requête - en attente &rArr; ne pas déranger</h2>
            <p>
                Grâce à readyState nous pouvons savoir où en est la requête. Il est donc intéressant de dire à l'internaute où se situe la requête, genre "chargement en cours...", [...]
            </p>
            <ul style="color: darkred; border: solid darkseagreen 1px; -moz-border-radius: 10px; -webkit-border-radius: 10px; padding-bottom: 5px; padding-top: 5px;">
                <li>
                    <strong>Tant que readyState != 4</strong> &rArr; la demande est en cours de traitement, donc "loading.gif"
                </li>
                <li>
                    <strong>Dès que readyStat === 4</strong> &rArr; la demande est terminée on redonne la main à l'internaute.
                </li>
            </ul>

            <script type="text/javascript">
                function initSleep(callback)
                {
                    var xhr6 = getXMLHttpRequest();
                    var sleep = document.getElementById('sleep').value;

                    if(isNaN(parseInt(sleep)) || sleep <= 0)
                    {
                        alert('La valeur de Sleep n\'est pas un nombre valide!');
                        return false;
                    }

                    xhr6.onreadystatechange = function()
                    {
                        if(xhr6.readyState === 4 && (xhr6.status === 200 || xhr6.status === 0))
                            {
                                callback(xhr6.responseText);
                                document.getElementById('bouton_dormir').disabled = false;
                                document.getElementById('loading').style.display = 'none';
                                document.getElementById('sleep').value = '';
                            }else{
                                document.getElementById('loading').style.display = 'block';
                                document.getElementById('bouton_dormir').disabled = true;
                            }
                    };

                xhr6.open('post', 'traitement_sleep.php', true);
                xhr6.setRequestHeader("Content-Type", "application/x-www-form-urlencoded")
                xhr6.send('sleep='+sleep);
                }

                function readData(datas)
                {
                    alert(datas);
                }
            </script>

            <fieldset>
                <legend>Test de l'état de la requête</legend>
                <form action="" method="post" id="form_sleep" name="form_sleep">
                    <div>
                        <label for="sleep">Temps d'attente: </label>
                    </div>
                    <input type="text" id="sleep" />
                    <div id="loading" style="display: none;">
                        <img src="image/loader.gif" alt="wait during loading" style="margin-left: -6px;"/>
                    </div>
                    <p>
                        <input type="button" id="bouton_dormir" value="DORS!" onClick="initSleep(readData)" />
                    </p>
                </form>
            </fieldset>

            <h2>Une seule requête à la fois</h2>
            <p>
                En regardant l'exemple ci-dessus, heureusement que nous avons désactivé le bouton, sinon que se passeait-il si l'internaute clique plusieurs fois dessus?
                Et bien la réponse est simple la requête serait envoyée plusieurs fois. Donc soit on annule la requête en cours soit on annule la requête suivante si une nouvelle requête est envoyée.
            </p>
            <p>
                Pour ce faire il faut rendre l'objet XHR GLOBAL. Et pour ce faire il faut le déclarer en dehors de la fonction. Ensuite nous aurons plus qu'a tester l'état de cet objet;
                si il est actif on annule la requête que l'on vient d'envoyer sinon on l'effectue.
            </p>

            <h3>Annulation de la requête en cours</h3>
            <pre>
                var xhr = null;

                function request(callback)
                {
                        if (xhr && xhr.readyState != 0)
                        {
                                xhr.abort(); // On annule la requête en cours !
                        }

                        xhr = getXMLHttpRequest(); // plus de mot clé 'var'

                        xhr.onreadystatechange = function()
                        {
                                /* ... */
                        };

                        xhr.open("GET", "XMLHttpRequest_getSleep.php?Sleep=" + sleep, true);
                        xhr.send(null);
                }

            </pre>

            <h3>Annulation de la nouvelle requête</h3>
            <pre>
                var xhr = null;

                function request(callback)
                {
                        if (xhr && xhr.readyState != 0)
                        {
                                alert("Attendez que la requête ait abouti avant de faire joujou");
                                return;
                        }

                        xhr = getXMLHttpRequest();

                        /* ... */
                }
            </pre>

            <h2>&dArr; Contrôle d'état de la requête - en attente &rArr; ne pas déranger &rArr; Annulation de la requête en cours &dArr;</h2>
            <script type="text/javascript">

                var xhr7 = null;

                function initSleep2(callback)
                {                   
                    
                    if(xhr7 && xhr7.readyState != 0)
                    {
                        xhr7.abort(); //annule la requête en cours
                        alert('Annulation de la requête en cours!')
                    }

                    xhr7 = getXMLHttpRequest();

                    var sleep = document.getElementById('sleep2').value;

                    if(isNaN(parseInt(sleep)) || sleep <= 0)
                    {
                        alert('La valeur de Sleep n\'est pas un nombre valide!');
                        return;
                    }

                    xhr7.onreadystatechange = function()
                    {
                        if(xhr7.readyState === 4 && (xhr7.status === 200 || xhr7.status === 0))
                            {
                                callback(xhr7.responseText);
                                document.getElementById('loading2').style.display = 'none';
                            }else{
                                document.getElementById('loading2').style.display = 'block';
                            }
                    };

                xhr7.open('post', 'traitement_sleep.php', true);
                xhr7.setRequestHeader("Content-Type", "application/x-www-form-urlencoded")
                xhr7.send('sleep='+sleep);
                }

                function readData(datas)
                {
                    alert(datas);
                }
            </script>

            <fieldset>
                <legend>Test de l'état de la requête</legend>
                <form action="" method="post" id="form_sleep" name="form_sleep">
                    <div>
                        <label for="sleep2">Temps d'attente: </label>
                    </div>
                    <input type="text" id="sleep2" />
                    <div id="loading2" style="display: none;">
                        <img src="image/loader.gif" alt="wait during loading" style="margin-left: -6px;"/>
                    </div>
                    <p>
                        <input type="button" id="bouton_dormir2" value="DORS!" onClick="initSleep2(readData)" />
                    </p>
                </form>
            </fieldset>



            <h2>&dArr; Contrôle d'état de la requête - en attente &rArr; ne pas déranger &rArr; Annulation de la nouvelle requête &dArr;</h2>
            <script type="text/javascript">
                
                var xhr8 = null;
                function initSleep3(callback)
                {
                    var sleep = document.getElementById('sleep3').value;

                    if(xhr8 && xhr8.readyState != 0)
                    {
                        alert('Attendez la fin de la requête pour faire JouJou!');
                        return;
                    }

                    xhr8 = getXMLHttpRequest()

                    if(isNaN(parseInt(sleep)) || sleep <= 0)
                    {
                        alert('La valeur de Sleep n\'est pas un nombre valide!');
                        return false;
                    }

                    xhr8.onreadystatechange = function()
                    {
                        if(xhr8.readyState === 4 && (xhr8.status === 200 || xhr8.status === 0))
                            {
                                callback(xhr8.responseText);
                                document.getElementById('loading3').style.display = 'none';
                            }else{
                                document.getElementById('loading3').style.display = 'block';
                            }
                    };

                xhr8.open('post', 'traitement_sleep.php', true);
                xhr8.setRequestHeader("Content-Type", "application/x-www-form-urlencoded")
                xhr8.send('sleep='+sleep);
                }

                function readData(datas)
                {
                    alert(datas);
                }
            </script>

            <fieldset>
                <legend>Test de l'état de la requête</legend>
                <form action="" method="post" id="form_sleep" name="form_sleep">
                    <div>
                        <label for="sleep3">Temps d'attente: </label>
                    </div>
                    <input type="text" id="sleep3" />
                    <div id="loading3" style="display: none;">
                        <img src="image/loader.gif" alt="wait during loading" style="margin-left: -6px;"/>
                    </div>
                    <p>
                        <input type="button" id="bouton_dormir3" value="DORS!" onClick="initSleep3(readData)" />
                    </p>
                </form>
            </fieldset>

            <h2>Exemple de listes liées!</h2>
            <p>
                Pour faire des listes liées, il faut d'abord avoir des catégories sur deux niveaux.
                Genre Catégories/Sous-Catégories
            </p>
            <pre>
                var xhr9 = getXMLHttpRequest();

                function request(oSelect, callback)
                {
                    var value = oSelect.options[oSelect.selectedIndex].value;

                    xhr9.onreadystatechange = function()
                    {
                        if (xhr9.readyState == 4 && (xhr9.status == 200 || xhr9.status == 0))
                        {
                                callback(xhr9.responseXML);
                                document.getElementById("loading4").style.display = "none";
                        } else if (xhr9.readyState < 4)
                        {
                                document.getElementById("loading4").style.display = "inline";
                        }
                    };

                    xhr9.open('post', 'traitement_liste.php', true);
                    xhr9.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
                    xhr9.send('id_categorie='+value);
                }

                function readDataXML(oXML)
                {
                    var nodes = oXML.getElementsByTagName('item'); //me retourne un tableau
                    var nbNodes = nodes.length;
                    var oSelect = document.getElementById('sousCategorieSelector');
                    var option, content;

                    oSelect.innerHTML = ""; //nécessaire pour vider la liste à chaque appel!!!
                    oSelect.style.display = "none"; //sert à cacher la liste

                    for (i = 0; i&lt;nbNodes; i++)
                        {
                            oSelect.style.display = "block";
                            option = document.createElement('option');
                            content = document.createTextNode(nodes[i].getAttribute('name'));
                            option.value = nodes[i].getAttribute('id');

                            option.appendChild(content);
                            oSelect.appendChild(option);
                        }
                }
            </pre>

            <script type="text/javascript">

                var xhr9 = getXMLHttpRequest();
                
                function request(oSelect, callback)
                {
                    var value = oSelect.options[oSelect.selectedIndex].value;

                    xhr9.onreadystatechange = function()
                    {
                        if (xhr9.readyState == 4 && (xhr9.status == 200 || xhr9.status == 0))
                        {
                                callback(xhr9.responseXML);
                                document.getElementById("loading4").style.display = "none";
                        } else if (xhr9.readyState < 4)
                        {
                                document.getElementById("loading4").style.display = "inline";
                        }
                    };

                    xhr9.open('post', 'traitement_liste.php', true);
                    xhr9.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
                    xhr9.send('id_categorie='+value);
                }

                function readDataXML(oXML)
                {
                    var nodes = oXML.getElementsByTagName('item'); //me retourne un tableau
                    var nbNodes = nodes.length;
                    var oSelect = document.getElementById('sousCategorieSelector');
                    var option, content;                    
                    var oError = document.getElementById('error_souscategorie');
                    
                    
                    oSelect.innerHTML = ""; //nécessaire pour vider la liste à chaque appel!!!
                    oSelect.style.display = "none"; //sert à cacher la liste
                    
                    oError.innerHTML = "";//nécessaire pour vider les erreurs lors de chaque appel!!!
                    oError.style.display = "none";//sert à cacher l'erreur
                    
                    if(nbNodes > 0)
                        {
                            for (i = 0; i<nbNodes; i++)
                                {
                                    oSelect.style.display = "block";
                                    option = document.createElement('option');
                                    content = document.createTextNode(nodes[i].getAttribute('name'));
                                    option.value = nodes[i].getAttribute('id');

                                    option.appendChild(content);
                                    oSelect.appendChild(option);
                                }                            
                        }else{
                            oError.style.display = "block";
                            oError.style.marginLeft = '0px';
                            oError.style.border = '2px solid red';
                            oError.style.borderRadius = '5px';//standard
                            oError.style.MozBorderRadius = '5px';//firefox
                            oError.style.WebkitBorderRadius = '5px';//chrome
                            oError.style.width = '690px';
                            oError.style.padding = '5px';
                            
                            content = document.createTextNode("Aucune sous-catégorie n'est disponible pour votre choix!")
                            oError.appendChild(content);
                        }

                }
            </script>

            <div id="categoriesBox">
                <p id="liste_categorie">
                    <select id="categorieSelector" onChange="request(this, readDataXML)">
                        <option value="none">Sélectionnez votre catégorie</option>
                        <?php
                            $link = dataBaseConnect($host, $dbName, $user, $pwd);
                                $querry = "SELECT * FROM categories WHERE langues_id_langue=1 ORDER BY position_categorie, nom_categorie";
                                $res = mysql_query($querry);
                                
                                while ($row = mysql_fetch_array($res))
                                {
                                    echo "<option id='".$row['id_categorie']."' value='".$row['id_categorie']."'>".$row['nom_categorie']."</option>\n";
                                }
                            dataBaseClose($link);
                        ?>
                    </select>
                </p>
                <div id="loading4" style="display: none;">
                    <img src="image/loader.gif" alt="wait during loading" style="margin-left: -6px;"/>
                </div>

                <p id="liste_souscategorie">
                    <select id="sousCategorieSelector" style="display: none;">
                        <!-- contenu AJAX -->
                    </select>
                </p>
                <div id="error_souscategorie">
                    <!-- contenu JS error -->
                </div>
            </div>
            
            <a name="part_4"></a>
            <h1>Propriétés et Méthodes <span><a href="#">top</a></span></h1>
            <p>
                Pour terminer, voici une vue globale des propriétés et méthodes qui s'appliquent à l'objet XMLHttpRequest.
            </p>            
            <h2>Les propriétés de XMLHttpRequest</h2>
            <table class="tab_user" style="width: 800px;">
                <thead>
                    <tr>
                        <th>
                            Nom de la propriété
                        </th>
                        <th>
                            Disponibilité
                        </th>
                        <th>
                            Description
                        </th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td><strong>onreadystatechange</strong></td>
                        <td><strong>Tous</strong></td>
                        <td><strong>Propriété exécutée à chaque changement d'état de la requête</strong></td>
                    </tr>
                    
                    <tr>
                        <td><strong>readyState</strong></td>
                        <td><strong>Tous</strong></td>
                        <td><strong>Etat de la requête, à vérifier au sein du onreadystatechange pour savoir où en est le traitement de la requête</strong></td>
                    </tr>
                    
                    <tr>
                        <td><strong>responseText</strong></td>
                        <td><strong>Tous</strong></td>
                        <td><strong>Réponse du serveur au format texte</strong></td>
                    </tr>
                    
                    <tr>
                        <td><strong>responseXML</strong></td>
                        <td><strong>Tous</strong></td>
                        <td><strong>Réponse du serveur au format XML</strong></td>
                    </tr>
                    
                    <tr>
                        <td><strong>status</strong></td>
                        <td><strong>Tous</strong></td>
                        <td><strong>Code de réponse du serveur (200, 404, 500, ...)</strong></td>
                    </tr>             
                    
                    <tr>
                        <td><strong>statusText</strong></td>
                        <td><strong>Tous</strong></td>
                        <td><strong>Le message associé à status</strong></td>
                    </tr>    
                    
                    <tr>
                        <td><strong>timeout</strong></td>
                        <td><strong>IE8, non W3C</strong></td>
                        <td><strong>Permet de définir un timeout</strong></td>
                    </tr>                    
                </tbody>
            </table>   
            
            
            <h2>Les méthodes de XMLHttpRequest</h2>
            <table class="tab_user" style="width: 800px;">
                <thead>
                    <tr>
                        <th>
                            Nom de la méthode
                        </th>
                        <th>
                            Disponibilité
                        </th>
                        <th>
                            Description
                        </th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td><strong>abort</strong></td>
                        <td><strong>Tous</strong></td>
                        <td><strong>Annule la requête en cours d'exécution</strong></td>
                    </tr>
                    
                    <tr>
                        <td><strong>getAllResponseHeaders</strong></td>
                        <td><strong>Tous - IE 7</strong></td>
                        <td><strong>Récupère la liste complète des en-têtes de la requête</strong></td>
                    </tr>
                    
                    <tr>
                        <td><strong>getResponseHeader</strong></td>
                        <td><strong>Tous - IE 7</strong></td>
                        <td><strong>Récupère l'en-tête de la requête</strong></td>
                    </tr>
                    
                    <tr>
                        <td><strong>open</strong></td>
                        <td><strong>Tous</strong></td>
                        <td><strong>Définit les modalités d'envoi de la requête</strong></td>
                    </tr>
                    
                    <tr>
                        <td><strong>overrideMimeType</strong></td>
                        <td><strong>Tous sauf IE, non W3C</strong></td>
                        <td><strong>Permet de forcer le type Mime de la requête</strong></td>
                    </tr>             
                    
                    <tr>
                        <td><strong>send</strong></td>
                        <td><strong>Tous</strong></td>
                        <td><strong>Envoie la requête</strong></td>
                    </tr>    
                    
                    <tr>
                        <td><strong>setRequestHeader</strong></td>
                        <td><strong>Tous</strong></td>
                        <td><strong>Ajoute un en-tête HTTP manuellement</strong></td>
                    </tr>                    
                </tbody>
            </table>             
            
            <h2>Conclusion</h2>
            <p>
                XMLHttpRequest est sans conteste le système AjaX qui offre la plus grande marge de manoeuvre, cependant il se révèle lourd à déployer.
            </p>
            <h2>
                Points forts
            </h2>
            <ul>
                <li>Adapté pour envoyer une requête qui n'attend pas nécessairement de résultats</li>
                <li>Adapté pour récupérer des données textuelles ou au format XML</li>
                <li>Supporté par tous les navigateurs</li>
                <li>Possibilité d'envoyer des requêtes en POST</li>
            </ul>
            <h2>
                Points faibles
            </h2>
            <ul>
                <li>Assez lourd à manipuler</li>
                <li>L'importation des données au format JSON requiert une compilation avec <strong>eval</strong></li>
            </ul>