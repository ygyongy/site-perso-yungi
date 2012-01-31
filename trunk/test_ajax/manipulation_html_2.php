<a href="#part_23">Naviguer entre les noeuds</a> | <a href="#part_24">Créer et insérer des éléments</a> | <a href="#part_25">Notions sur les références</a> | <a href="#part_26">Cloner, remplacer, supprimer...</a> | <a href="#part_27">Autres actions</a> | <a href="#part_28">Mini TP</a>
        <cite>
            Dans ce deuxième chapitre dédié à la manipulation du contenu, nous allons aborder la modification via DOM. On l'a déjà fait dans le premier chapitre, avec notamment <strong>setAttribute()</strong>, mais ici, il va s'agir de créer, supprimer et déplacer des éléments HTML.
            C'est un gros morceau du Javascript, pas toujours facile. Mais alors pourquoi si on peut utiliser <strong>innerHTML</strong>... Et bien parce qu'avec ces méthodes on pourra manipuler du XML.
        </cite>
<a name="part_23"></a>
        <h1>Naviguer entre les noeuds <span><a href="#">top</a></span></h1>
            <p>
                Nous avons vu dernièrement les méthodes <strong>getElementById()</strong> et <strong>getElementsByTagName()</strong> pour accèder au HTML.
                Une fois qu'on a atteint un élément, il est possible de se déplacer de façon un peu plus précise, avec toute une série de méthodes et de propriétés que nous allons étudier ici.
            </p>
         <h2>La propriété parentNode</h2>
        <cite>
            La propriété <strong>parentNode</strong> permet d'accéder à l'élément parent d'un élément.
            <br />
            Regardez plutôt:
        </cite>
<pre>
&lt;blockquote&gt;
    &lt;p id = "myParagraph"&gt;Un peu de texte&lt;a&gt;et un lien&lt;/a&gt;&lt;/p&gt;
&lt;/blockquote&gt;
</pre>
            
            <p>
            	Admettons qu'on doive accéder à <strong>myParagraph</strong>, et que pour une autre raison on doive aussi accéder à l'élément <strong>&lt;blockquote&gt;</strong>, qui est le parent de <strong>myParagraph</strong>, il suffirait donc d'accéder à <strong>myP</strong> puis à son <strong>parent</strong>... Avec <strong>parentNode</strong>!
            </p>
            
            <pre>
var paragraph = document.getElementById('myParagraph');
var blockquote = paragraph.parentNode;
            </pre>
            
            <h3>&dArr; La preuve... &dArr;</h3>
            <blockquote id="myBlock">
            	Je suis le papa
                <br />
            	<input type="button" id="parentNodeShow" value="afficher mon papa" />
            </blockquote>
            <script type="text/javascript">
				var myButton = document.getElementById('parentNodeShow');
				var myBlockquote = myButton.parentNode;
				
				myButton.addEventListener('click', showParent, false);
				
				function showParent()
				{
					alert(myBlockquote);
				}
			</script>
            <cite>
            	Comme vu dans le test, cette propriété permet d'accéder un <strong>objet</strong> parent de type <strong>objectHTMLBlockquoteElement</strong>
            </cite>
            
            <h2>nodeType &amp; nodeName</h2>
            <p>
            	<strong>nodeType</strong> et <strong>nodeName</strong> servent respectivement à vérifier le type d'un noeud et le nom d'un noeud.
            </p>
            
            <h3>nodeType</h3>
            <p>
            	Retourne un nombre, qui correspond à un type de noeud. Voici un tableau qui liste les types possible, ainsi que leurs numéros.
            </p>
            <table class="tab_user" style="width: 350px;">
                <thead>
                    <tr style="text-align:center;">
                        <th>Numéro</th>
                        <th>Type de noeud</th>
                  </tr>
                </thead>
                <tbody>
                    <tr>
                        <td><strong>1</strong></td>
                        <td><div class="centre"><strong><span class="vertf">Noeud élément</span><span class="tpetit"></span></strong></div></td>
                    </tr>
                    <tr>
                      <td><strong>2</strong></td>
                      <td><strong>Noeud attribut</strong></td>
                    </tr>
                    <tr>
                      <td><strong>3</strong></td>
                      <td><strong>Noeud texte</strong></td>
                    </tr>
                    <tr>
                      <td><strong>4</strong></td>
                      <td><strong>Noeud pour passage CDATA</strong> [relatif au XML]</td>
                    </tr>
                    <tr>
                      <td><strong>5</strong></td>
                      <td>Noeud pour référence d'entité</td>
                    </tr>
                    <tr>
                      <td><strong>6</strong></td>
                      <td>Noeud pour entité</td>
                    </tr>
                    <tr>
                      <td><strong>7</strong></td>
                      <td>Noeud pour instruction de traitement</td>
                    </tr>
                    <tr>
                      <td><strong>8</strong></td>
                      <td>Noeud pour commentaires</td>
                    </tr>
                    <tr>
                      <td><strong>9</strong></td>
                      <td>Noeud pour docuement</td>
                    </tr>
                    <tr>
                      <td><strong>10</strong></td>
                      <td>Noeud type de document</td>
                    </tr>
                    <tr>
                      <td><strong>11</strong></td>
                      <td>Noeud de fragment de document</td>
                    </tr>
                    <tr>
                      <td><strong>12</strong></td>
                      <td>Noeud pour notation</td>
                    </tr>
                </tbody>
            </table>
            
            
            <h3>nodeName</h3>
            <p>
            	<strong>nodeName</strong> quant à lui, retourne simplement le nom de l'élément, en majuscule. Il est toutefois conseillé d'utiliser <strong>toLowerCase()</strong> ou <strong>toUpperCase()</strong> pour forcer un format de cass!
            </p>
            
            
            <h3>&dArr; Testons gaiement &dArr;</h3>
            <input type="button" id="showNodeInfos" value="montrez-moi :-)" />
            <script type="text/javascript">
                var myButton = document.getElementById('showNodeInfos');
                var nodeElement = document.getElementById('myBlock');

                myButton.addEventListener('click', showNodeInfos, false);

                function showNodeInfos()
                {
                        alert(nodeElement.nodeType + "\n\n" + nodeElement.nodeName.toLowerCase());
                }			
            </script>
            
            <h2>Lister et parcourir les noeuds enfants</h2>
            <h3>firstChild &amp; lastChild</h3>
            <p>
            	Comme leur nom laisse présager, <strong>firstChild</strong> et <strong>lastChild</strong> servent respectivement à accéder au premier et au dernier enfant d'un noeud.
            </p>
            
            <pre>
&lt;html&gt;
&lt;head&gt;
    &lt;title&gt;Le titre de la page&lt;/title&gt;
    &lt;meta charset=&quot;utf-8&quot; /&gt;
&lt;/head&gt;

&lt;body&gt;
&lt;div&gt;
    &lt;p id=&quot;myP&quot;&gt;
        Un peu de texte et un &lt;a&gt;lien&lt;/a&gt; &lt;strong&gt; et un texte en emphase&lt;/strong&gt;.
    &lt;/p&gt;
&lt;/div&gt;
&lt;/body&gt;

&lt;/html&gt;

&lt;script type=&quot;text/javascript&quot;&gt;
   var myP = document.getElementById('myP');
   var first = myP.firstChild;
   var last = myP.lastChild;
&lt;/script&gt;
            </pre>
            
            <h3>&dArr; Comme d'hab. un petit test &dArr;</h3>
            <div>
                <p id="childInfos">Un peu de texte et un <a>lien</a> <strong>et un texte en emphase</strong></p>
                <p>
                    <input type="button" id="showChildInfos" value="Montre-moi les enfants" />
                </p>
            </div>
            <script type="text/javascript">
                var childInfos = document.getElementById('childInfos');
                var first = childInfos.firstChild;
                var last = childInfos.lastChild;
                var showChildInfo = document.getElementById('showChildInfos');

                showChildInfo.addEventListener('click', showChildInfos, false);

                function showChildInfos()
                {
                        alert("firstChild: " + first.nodeName.toLowerCase() + "\n\n" + "lastChild: " + last.nodeName.toLowerCase());
                        alert("firstChild: " + first + "\n\n" + "lastChild: " + last);
                }
            </script>
            
            <cite>
            	En schématisant l'élément <strong>myP</strong> ci-dessus on obtient:
                <br />
                Enfin pas tout à fait car les retour à la ligne DANS LA SOURCE est considéré par JavaScript comme étant des noeuds de type <strong>#text</strong>
            </cite>
            <p>
            	<img src="image/274198.png" />
            </p>
            
            <h3>nodeValue et data</h3>
            <p>
                Changeons de problème: il faut récupérer le texte du premier enfant, et le texte contenu dans l'élément <strong>&lt;strong&gt;</strong>, mais comment faire?
            </p>
            <p>
                Il faut soit utiliser la propriété <strong>nodeValue</strong> soit la propriété <strong>data</strong>. Si on recode le script ci-dessus, ça nous donne ceci:
            </p>
            
            <pre>
var para = document.getElementById('myP');
var first = para.firsChild;
var last = para.lastChild;

alert(first.nodeValue);
alert(last.data);
            </pre>
            
            <h3>&dArr; Allez on ré-affiche &dArr;</h3>
            <div>
                <p id="childInfos2">Un peu de texte et un <a>lien</a> <strong>et un texte en emphase</strong></p>
                <p>
                    <input type="button" id="showChildInfos2" value="Montre-moi les enfants" />
                </p>
            </div>
            <script type="text/javascript">
                var childInfos = document.getElementById('childInfos2');
                var first = childInfos.firstChild;
                var last = childInfos.lastChild;
                var showChildInfo = document.getElementById('showChildInfos2');

                showChildInfo.addEventListener('click', showChildInfos2, false);

                function showChildInfos2()
                {
                    alert("firstChild: " + first.nodeValue + "\n\n" + "lastChild: " + last.data);
                }
            </script>
            <cite>
                Comme vous avez pu le constater, le lastChild contient une valeur <strong>undefined</strong>... Ehhh oui vu que les valeurs <strong>nodeValue</strong> &amp; <strong>data</strong>
                ne s'applique QUE sur des noeuds de type <strong>#text</strong>. Dès lors il nous faut accéder premièrement au noeud <strong>#text</strong>, c'est-à-dire <strong>son enfant</strong>!
                <br/>
                Donc:
            </cite>
            <pre>
var para = document.getElementById('myP');
var first = para.firsChild;
var last = para.lastChild;

alert(first.nodeValue);
alert(last.firstChild.data);
            </pre>
            
            <h3>&dArr; Allez on ré-affiche &dArr;</h3>
            <div>
                <p id="childInfos3">Un peu de texte et un <a>lien</a> <strong>et un texte en emphase</strong></p>
                <p>
                    <input type="button" id="showChildInfos3" value="Montre-moi les enfants" />
                </p>
            </div>
            <script type="text/javascript">
                var childInfos = document.getElementById('childInfos3');
                var first = childInfos.firstChild;
                var last = childInfos.lastChild;
                var showChildInfo = document.getElementById('showChildInfos3');

                showChildInfo.addEventListener('click', showChildInfos3, false);

                function showChildInfos3()
                {
                    alert("firstChild: " + first.nodeValue + "\n\n" + "lastChild: " + last.firstChild.data);
                }
            </script>
            <cite>
                Et cette fois... c'est bon
                <br />
                <img src="image/1318514938_6.png" />
            </cite>
            
            <h3>childNodes</h3>
            <p>
                La propriété <strong>childNodes</strong> retourne un tableau contenant la liste des enfants d'un élément. L'exemple suivant illustre le fonctionnement de cette propriété, de manière à récupérer le contenu des éléments enfants:
            </p>
            <pre>
&lt;body&gt;
    &lt;div&gt;
        &lt;p id=&quot;myP&quot;&gt;
            Un peu de texte et un &lt;a&gt;lien&lt;/a&gt; &lt;strong&gt; et un texte en emphase&lt;/strong&gt;.
        &lt;/p&gt;
    &lt;/div&gt;
&lt;/body&gt;

&lt;/html&gt;

&lt;script type=&quot;text/javascript&quot;&gt;
   var myP = document.getElementById('myP');
   var children = myP.childNodes;

    for(i = 0, c = children.length; i < c; i++)
    {
        if(children[i].nodeType === 1)<span style="color: #008000;">//C'est un élément HTML</span>
        {
            alert(children[i].firstChild.data);<span style="color: #008000;">//On accède à l'enfant pour afficher le texte</span>
        }else{<span style="color: #008000;">//C'est certainement un noeud #text</span>
            alert(children[i].data);
        }
    }
&lt;/script&gt;
            </pre>
            
            <h3>&dArr; Un petit aperçu &dArr;</h3>
            <div>
                <p id="childInfos4">Un peu de texte et un <a>lien</a> <strong>et un texte en emphase</strong></p>
                <p>
                    <input type="button" id="showChildInfos4" value="Montre-moi les enfants" />
                </p>
            </div>
            <script type="text/javascript">
                var childInfos = document.getElementById('childInfos4');
                var children = childInfos.childNodes;
                var txt = '';
                
                var showChildInfo = document.getElementById('showChildInfos4');

                showChildInfo.addEventListener('click', showChildInfos4, false);

                function showChildInfos4()
                {
                    for(i = 0, c = children.length; i < c; i++)
                    {
                        if(children[i].nodeType === 1)//on test si c'est un noeud de type HTML... car il demande un traitement supplémentaire
                        {
                            txt += (i+1) + ": " + children[i].firstChild.data+'\n';
                        }else{//directement un noeud de type #text
                            txt += (i+1) + ": " + children[i].data+'\n';
                        }
                    }
                    txt += "\n\"Les espaces comptent entre les tags...!\"\n  Raison pour laquelle le noeud N° 3 est un ' ' ";
                    alert(txt);
                }
            </script>
            <cite>
                Attention les espaces entre les tags HTML sont accéder comme des noeuds!
            </cite>
            
            <h3>nextSibling et previousSibling</h3>
            <p>
                <strong>nextSibling</strong> et <strong>previousSibling</strong> sont deux attributs qui permettent d'accéder respectivement au noeud suivant et au noeud précédent.
            </p>
            
            <pre>
&lt;body&gt;
    &lt;div&gt;
        &lt;p id=&quot;myP&quot;&gt;
            Un peu de texte et un &lt;a&gt;lien&lt;/a&gt; &lt;strong&gt; et un texte en emphase&lt;/strong&gt;.
        &lt;/p&gt;
    &lt;/div&gt;
&lt;/body&gt;

&lt;/html&gt;

&lt;script type=&quot;text/javascript&quot;&gt;
   var myP = document.getElementById('myP');
   var first = myP.firstChild;
   var next = first.nextSibling;

   alert(next.firstChild.data);
&lt;/script&gt;
            </pre>
            <h3>&dArr; Test... &dArr;</h3>
            <div>
                <p id="childInfos5">Un peu de texte et un <a>lien</a> <strong>et un texte en emphase</strong></p>
                <p>
                    <input type="button" id="showChildInfos5" value="Montre-moi les enfants" />
                </p>
            </div>

            <script type="text/javascript">
                var childInfos = document.getElementById('childInfos5');
                var first = childInfos.firstChild;
                var next = first.nextSibling;
                var nexts = childInfos.nextSibling;
                
                var showChildInfo = document.getElementById('showChildInfos5');

                showChildInfo.addEventListener('click', showChildInfos5, false);

                function showChildInfos5()
                {
                    alert("nextSibling: "+next.nodeName+"\nnextSibling > premier enfant > data: "+next.firstChild.data);
                }
            </script>
            <cite>
                Dans l'exemple ci-dessus, on récupère le premier enfant de <strong>myP</strong>, et sur ce premier enfant, on n'utilise <strong>nextSibling</strong>, qui permet de récupérer l'élément <strong>&lt;a&gt;</strong>.
                Avec cet algorithme, il serait même possible de parcourir les enfants d'un élément, en utilisant un boucle <strong>while</strong>.
            </cite>
            <p>
                Voyons maintenant comment parcourir les enfants d'un élément à l'aide d'une boucle de type <strong>while</strong>.
            </p>
            
            <pre>
&lt;body&gt;
    &lt;div&gt;
        &lt;p id=&quot;myP&quot;&gt;
            Un peu de texte et un &lt;a&gt;lien&lt;/a&gt; &lt;strong&gt; et un texte en emphase&lt;/strong&gt;.
        &lt;/p&gt;
    &lt;/div&gt;
&lt;/body&gt;

&lt;script type=&quot;text/javascript&quot;&gt;
    var myP = document.getElementById('myP');
    var child = myP.lastChild; <span style="color: #008000;">//On accède au dernier enfant</span>

    while(child)
    {
        if(child.nodeType === 1) <span style="color: #008000;">//Si cet un élément HTML</span>
        {
            alert(child.firstChild.data);
        }
        
        child = child.previousChild; <span style="color: #008000;">//A chaque tour de boucle, on accède à l'enfant précédent</span>
    }
&lt;/script&gt;
            </pre>
            
            <h3>&dArr; Ce n'est pas super clair... testons &dArr;</h3>
            <div>
                <p id="childInfos6">Un peu de texte et un <a>lien</a> <strong>et un texte en emphase</strong></p>
                <p>
                    <input type="button" id="showChildInfos6" value="Montre-moi les enfants" />
                </p>
            </div>
            
            <script type="text/javascript">
                var childInfos = document.getElementById('childInfos6');
                var child = childInfos.lastChild;
                
                var showChildInfo = document.getElementById('showChildInfos6');

                showChildInfo.addEventListener('click', showChildInfos6, false);

                function showChildInfos6()
                {
                    while(child)
                    {
                        if(child.nodeType === 1)
                        {
                            alert(child.firstChild.data)
                        }else{
                            alert(child.data);
                        }

                        child = child.previousSibling;
                    }
                }                
                
            </script>
            
            <cite>
                Pour changer un peu, la boucle "tourne" à l'envers afin de remonter les différents enfants. On part du dernier et on remonte à reculons.
            </cite>
            
            <h2>Attention aux noeuds vides</h2>
            <p>
                En re-considérant le HTML suivant, on peut penser que l'élément <strong>&lt;div&gt;</strong> ne contient que 3 enfants <strong>&lt;p&gt;</strong>
            </p>
            <pre>
&lt;div&gt;
    &lt;p&gt;Paragraphe 1&lt;/p&gt;
    &lt;p&gt;Paragraphe 2&lt;/p&gt;
    &lt;p&gt;Paragraphe 3&lt;/p&gt;
&lt;/div&gt;
            </pre>
            <p>
                Mais attention, car ce code est radicalement différent de celui présenté ci-dessous:
            </p>
            <pre>
&lt;div&gt;&lt;p&gt;Paragraphe 1&lt;/p&gt;&lt;p&gt;Paragraphe 2&lt;/p&gt;&lt;p&gt;Paragraphe 3&lt;/p&gt;&lt;/div&gt;
            </pre>
            <p>
                En fait, les espaces blancs entre les éléments, tout comme les CL/RL sont considérés comme des noeuds de type <em>#text</em> (enfin cela dépend encore des navigateurs)! Ainsi donc, si l'on schématise le premier code, on obtient ceci:
            </p>
            <h3>Schéma de l'exemple 1</h3>
            <p>
                <img src="image/274218.png"/>
            </p>
            
            <h3>Schéma de l'exemple 2</h3>
            <p>
                <img src="image/274217.png"/>
            </p>
            <p>
                Heureusement, il existe une solution à ce problème! Les attributs <strong>firstElementChild, lastElementChild, nextElementSibling</strong>et <strong>previousElementSibling</strong> ne retournent que des éléments HTML!
                Cependant, ces attributs ne sont pas supportés par... <span style="color: darkred;">IE 8 et ses versions antérieures</span>! Et surtout il n'existe pas d'alternative.
            </p>
            
            <a name="part_24"></a>
            <h1>Créer &AMP; insérer des éléments <span><a href="#">top</a></span></h1>
            <h2>Ajouter des éléments HTML</h2>
            <p>
                Avec DOM, l'ajout d'un élément HTML se fait en 3 parties:
            </p>
            <ol>
                <li>on crée l'élément</li>
                <li>on lui affecte des attributs</li>
                <li>on l'insère dans le document, et ce n'est qu'à ce moment là qu'il sera véritablement ajouté</li>
            </ol>
            <h3>Création de l'élément</h3>
            <p>
                La création de l'élément se fait avec la méthode <strong>createElement()</strong>, un sous-objet de l'objet racine, c'est-à-dire <strong>document</strong> (dans la majorité des cas).
            </p>
            <pre>
var newLink = document.createElement('a');
            </pre>
            <h3>Affectation des attributs</h3>
            <p>
                Ici, c'est comme nous avons vu précédemment: on définit les attributs, soit avec <strong>setAttribute()</strong>, soit directement avec les propriétés adéquates:
            </p>
            <pre>
newLink.id = 'newLink';
newLink.href = 'http://www.google.ch';
newLink.title = 'Un nouveau lien';
newLink.setAttribute('tabindex', '10');
            </pre>
            <h3>Insertion de l'élément</h3>
            <p>
                On utilisera la méthode <strong>appendChild()</strong> pour insérer l'élément. Ce qui signifie que l'on doit connaître l'élément auquel on va ajouter l'élément créé.
            </p>
            <pre>
&lt;div&gt;
    &lt;p id="myP" &gt;Paragraphe 1&lt;/p&gt;
    &lt;p&gt;Paragraphe 2&lt;/p&gt;
    &lt;p&gt;Paragraphe 3&lt;/p&gt;
&lt;/div&gt;
            </pre>
            <p>
                On va dès lors, ajouter notre lien créé par JS dans un des paragraphes...
            </p>
            <pre>
document.getElementById('myP').appendChild(newLink);
            </pre>
            
            <h2>Ajouter des noeuds textuels</h2>
            <p>
                L'élément a été inséré, seulement, il manque quelque chose: le contenu <em>textuel</em>! La méthode <strong>createTextNode()</strong> sert à créer un noeud textuel (de type <em>#text</em>), qu'il nous suffira d'ajouter à notre élément fraîchement inséré, comme ceci:
            </p>
            <pre>
var newLinkText = document.createTextNode('Tutorial JS');
newLink.appendChild(newLinkText);
            </pre>
            <cite>
                Il y a une chose à savoir: Le fait d'insérer, via <strong>appendChild()</strong>, n'a aucune incidence sur l'ordre d'exécution des instructions. On peut donc commencer par créer les Node, puis les insérer les uns dans les autres!
            </cite>
            <pre>
var newLink = document.createElement('a');
var newLinkText = document.createTextNode('google');
var el = document.getElementById('myP');
    newLink.href = 'http://www.google.ch';
    newLink.id = 'newLink';

    //assemblage
    newLink.appendChild(newLinkText);
    el.appendChild(newLink);

    //ou
    el.appendChild(newLink).appendChild(newLinkText);    
            </pre>
            
            <h3>&dArr; Un petit test pratique &dArr;</h3>
            <div>
                <p id="myPAppendChild">Paragraphe 1 </p>
                <p>Paragraphe 2</p>
                <p>Paragraphe 3</p>
            </div>
            
            <script type="text/javascript">
                var el = document.getElementById('myPAppendChild');
                var newLink = document.createElement('a');
                var newLinkText = document.createTextNode('Tutorial JavaScript');
                    newLink.id = 'myAddedLink';
                    newLink.href = 'http://www.google.ch';
                    newLink.target = '_blank';
                
                //insertion
                el.appendChild(newLink).appendChild(newLinkText);
            </script>
            
            <cite>
                Attention tout élément créé via JavaScript ne sera pas visible via un "view source" classique... Par contre si vous utilisez l'outil <strong>inspecter l'élément</strong> vous pourrez inspecter le contenu de votre élément créé... Spécialement utile pour le debug.
            </cite>
            
            <a name="part_25"></a>
            <h1>Notions sur les références <span><a href="#">top</a></h1>
            <p>
                En JavaScript et comme dans beaucoup de langages, le contenu des variables est passé par "valeur". Cela veut donc dire que si une variable <strong>nick1</strong> contient le prénom <strong>Clarisse</strong> et qu'on affecte cette valeur à une autre variable, la valeur est <u>"copiée"</u> dans la nouvelle. On obtient alors deux variables distinctes, contenant la même valeur!
            </p>
            <pre>
var nick1 = "Clarisse";
var nick2 = nick1;
            </pre>
            <cite>
                Si on modifie la valeur de <strong>nick2</strong>, la valeur de <strong>nick1</strong> reste inchangée: normal, les deux variables sont bien distinctes!
            </cite>
            
            <h2>Les références</h2>
            <p>
                Outre le "passage par valeur", JavaScript possède un "passage par référence". En fait, quand une variable est créée, sa valeur est mise en mémoire par l'ordinateur. Pour pouvoir retrouver cette valeur, elle est associée à une adresse que seul l'ordinateur connaît et manipule.
            </p>
            <p>
                Quand on passe une valeur par référence, on transmet l'adresse mémoire de la variable, ce qui va permettre d'avoir deux variables qui possèdent une même valeur!!!
            </p>
            <p>
                Malheureusement, un exemple théorique d'un passage par référence n'est pas vraiment envisageable à ce stade du tutorial, il faudra attendre le chapitre sur la création des objets. Cela dit, quand on manipule une page WEB avec le DOM, on est confronté à des références, tout comme dans le chapitre suivant sur les événements.
            </p>
            
            <h2>Les références avec le DOM</h2>
            <p>
                Schématiser le concept de référence avec le DOM est assez simple: deux variables peuvent accéder au même élément. Regardez l'exemple:
            </p>
            <pre>
var newLink = document.createElement('a');
var newLinkText = document.createTextNode('un lien');

    newLink.id = 'newLink';
    newLink.src = 'http://www.google.ch';

    newLink.appendChild(newLinkText);
    document.getElementById('myP').appendChild(newLink);

//On récupère, via son ID, l'élément fraîchement inséré
<div style="background-color: #F7CF07; padding: 2px;">var myNewLink = document.getElementById('newLink');</div>
<div style="background-color: #F7CF07; padding: 2px;">var myNewLink.src = "http://www.tradiluxe.com";</div>
//myNewLink.src affiche bien la nouvelle URL:
<span style="background-color: #F7CF07; padding: 2px;">alert(myNewLink.src);</span>
            </pre>
            <p>
            	La variable <strong>newLink</strong> contient en réalité une référence vers l'élément <strong>&lt;a&gt;</strong> qui a été créé. <strong>newLink</strong> ne contient pas l'élément, il contient une adresse qui pointe vers le fameux <strong>&lt;a&gt;</strong>
            </p>
            <p>
            	Une fois que l'élément est inséré dans la page, on peut y accéder de nombreuses façons, comme avec <strong>getElementById()</strong>.
            </p>
            <cite>
            	Quand on accède à un élément grâce à <strong>getElementById()</strong>, on le fait aussi au moyen d'une référence.
            </cite>            
            <h3>Pas compris? Un autre exemple</h3>
            <pre>
var div_1 = document.createElement('div');
var div_2 = div_1;            
            </pre>
            <cite>
                Et oui, si vous avez tout suivi, <strong>newDiv2</strong> contient une référence qui pointe vers le même <strong>&lt;div&gt;</strong> que <strong>newDiv1</strong>. Mais comment duppliquer un élément alors? Et Bien il faut le cloner, et c'est ce que nous allons voir maintenant!
            </cite>
            
            <a name="part_26"></a>
            <h1>Cloner, remplacer, supprimer...<span><a href="#">top</a></h1>
            <h2>Cloner un élément</h2>
            <p>
            	Pour cloner un élément, rien de plus simple: <strong>cloneNode()!</strong>
                <br />
		Cette méthode accepte un paramètre un booléen (<strong>true</strong> ou <strong>false</strong>) <span style="font-size:18px;"><strong>&rArr;</strong></span> si vous désirez cloner un élément <strong>avec</strong> ou <strong>sans</strong> ses petits enfants!!!
            </p>
            
            <p>
            	Un premier petit exemple très simple: on créé un élément <strong>&lt;hr /&gt;</strong>, et on n'en veut un deuxième:
            </p>
            <pre>
//Ici on va cloner un élément créé:
var hr1 = document.createElement('hr');
var hr2 = hr1.cloneNode(false);

//Ici, on clone un élément existant:
var myP = document.getElementById('myP');
var myP2 = myP.cloneNode(true); <span style="color: darkgreen;">//Il possède des enfants</span>

//Attention l'élément est cloner mais pas encore insérer:
myP.parentNode.appendChild(myP2);
myP2.appendChild(hr2);
            </pre>
            
			<h3>&dArr; On test! &dArr;</h3>
            <div id="receptacleClone">
                <p id="pACloner">
                    Je ne suis pas un héro mais cette image me colle à le peau.
                    <br />
                    J'aurais voulu être une artiste, avec un petit lien sur le <a href="http://www.mjf.com" target="_blank">MJF</a>.
                </p>
            </div>
            
            <div>
            	<input type="button" id="actionClonage" value="Commencez le clonage" />
            </div>
            
            <script type="text/javascript">
                var el = document.getElementById('actionClonage');
                el.addEventListener('click', actionClone, false);

                function actionClone(e)
                {			
                    var hr1 = document.createElement('hr');
                    var hr2 = hr1.cloneNode(false);

                    var pACloner = document.getElementById('pACloner');
                    var pCloner = pACloner.cloneNode(true);

                    //insertion des éléments clonés
                    pACloner.parentNode.appendChild(pCloner);
                    if(pACloner.getElementsByTagName('hr')[0] === undefined)
                    {
                            pACloner.appendChild(hr1);
                            pCloner.appendChild(hr2);
                    }
                }
            </script>
            
            <cite>
            	<strong>cloneNode()</strong> peut être utiliséé tant pour cloner des <strong>#text</strong> que des <strong>HTMLElementObject</strong>
            </cite>
            
            <h2>Remplacer un élément par un autre</h2>
            <p>
            	Pour remplacer un élément par un autre, rien de plus simple, il y a <strong>replaceChild()</strong>. Cette méthode accepte deux paramètres: les premier est le nouvel élément, et le deuxième est l'élément à remplacer. Tout comme <strong>cloneNode()</strong>, cette méthode s'utilise sur tout type de noeud.
            </p>
            <pre>
&lt;div&gt;
    &lt;p id=&quot;myP&quot;&gt;Un peu de texte et un &lt;a&gt;lien&lt;/a&gt;
&lt;/div&gt;

&lt;script type=&quot;text/javascript&quot;&gt;
    var myLink = document.getElementsByTagName('a);
    var newLabel = document.createTextNode('LE LABEL A CHANGE');

    myLink[0].replaceChild(newLabe, myLink.firstChild);
&lt;/script&gt;
            </pre>
            
            <h3>&dArr; Comme d'hab... in real life &dArr;</h3>            
            <p id="pAChanger">
                Un petit lien sur le <a href="http://www.mjf.com" target="_blank">MJF</a>.
            </p>
            
            <div>
            	<input type="button" id="actionChanger" value="Commencez le remplacement" />
            </div>
            
            <script type="text/javascript">
                var myLink_1 = document.getElementById('pAChanger').getElementsByTagName('a');
                var newLabel = document.createTextNode('LE LABEL A CHANGER');

                var el = document.getElementById('actionChanger');
                el.addEventListener('click', changerLink, false);

                function changerLink(e)
                {
                    e.preventDefault();
                    myLink_1[0].replaceChild(newLabel, myLink_1[0].firstChild);
                }
             </script>
            
            
            
                        
            <h2>Supprimer un élément</h2>
            <p>
            	Pour insérer un élément, on utilise <strong>appendChild()</strong> et pour en supprimer un on utilise <strong>removeChild</strong>. Cette méthode prend en paramètre le noeud enfant à retirer. Si on se calque sur le code HTML de l'exemple précédent:
            </p>
            <pre>
&lt;div&gt;
    &lt;p id=&quot;myP&quot;&gt;Un peu de texte et un &lt;a&gt;lien&lt;/a&gt;
&lt;/div&gt;

&lt;script type=&quot;text/javascript&quot;&gt;
    var myLink = document.getElementsByTagName('a');

    myLink[0].parentNode.removeChild(myLink);
&lt;/script&gt;
            </pre>
            <h3>&dArr; [...] et encore un [...] &dArr;</h3>
            <p id="pASupprimer">
                Un petit lien sur le <a href="http://www.mjf.com" target="_blank">MJF</a>.
            </p>
            
            <div>
            	<input type="button" id="actionSupprimer" value="Commencez la Suppression" />
            </div>            
            
            <script type="text/javascript">
                var el = document.getElementById('actionSupprimer');
                var myLink = document.getElementById('pASupprimer').getElementsByTagName('a');

                el.addEventListener('click', actionSupprimer, false);

                function actionSupprimer(e)
                {
                    e.preventDefault();
                    alert(myLink[0]);
                    if(myLink[0] !== undefined)
                    {
                        myLink[0].parentNode.removeChild(myLink[0]);
                    }
                    return true;
                }
            </script>
            
            <cite>
            	Il n'y a pas besoin de passer par un <strong>getElementById('myP')</strong>... Mieux vaut passer par la manipulation du DOM &rArr; <strong>parentNode</strong>
            </cite>
            
            
            <a name="part_27"></a>
            <h1>Autres actions <span><a href="#">top</a></span></h1>
            <h2>Vérifier la présence d'éléments enfants</h2>
            <p>
            Rien de plus facile pour vérifier la présence d'éléments enfants: <strong>hasChildNodes()</strong>. Il suffit d'utiliser cette méthode sur l'élément de votre choix: si cet élément possède au moins un enfant, la méthode reverra <strong>true</strong>.
            </p>
            <pre>
&lt;div&gt;
    &lt;p id=&quot;myP&quot;&gt;Un peu de texte et un &lt;a&gt;lien&lt;/a&gt;
&lt;/div&gt;

&lt;script type=&quot;text/javascript&quot;&gt;
    var myP = document.getElementsByTagName('p');

    alert(myP.hasChildNodes());
&lt;/script&gt;            
            </pre>
            <h3>&dArr; On regarde &dArr;</h3>
            <p id="pHasChild">
                Un petit lien sur le <a href="http://www.mjf.com" target="_blank">MJF</a>.
            </p>
            
            <div>
            	<input type="button" id="actionChildNodes" value="A-t-il des enfants" />
            </div>            
            
            <script type="text/javascript">
                var el = document.getElementById('actionChildNodes');
                var myP = document.getElementById('pHasChild');

                el.addEventListener('click', actionChildNodes, false);

                function actionChildNodes(e)
                {
                        e.preventDefault();
                        alert(myP.hasChildNodes());
                }
            </script>
            
            <h2>Insérer à la bonne place: insertBefore()</h2>
            <p>
                La méthode <strong>insertBefore()</strong> permet d'insérer un élément avant un autre. Elle reçoit deux paramètres: le premier est l'élément à insérer, tandis que le deuxième est l'élément avant lequel l'élément avant lequel l'élément va être insérer.
            </p>
            <pre>
&lt;div&gt;
    &lt;p id=&quot;myP&quot;&gt;Un peu de texte et un &lt;a&gt;lien&lt;/a&gt;
&lt;/div&gt;

&lt;script type=&quot;text/javascript&quot;&gt;
    var myP = document.getElementById('myP');
    var emphasis = document.createElement('em');
    emphasisText = document.createTextNode(' en emphase légère[...]');

    emphasis.appendChild(emphasisText);

    myP.insertBefore(emphasis, myP.lastChild);
&lt;/script&gt;    
            </pre>
            
            <h3>&dArr; Et... on test! &dArr;</h3>
            <p id="pInsertBefore">
                Un petit lien sur le <a href="http://www.mjf.com" target="_blank">MJF</a>.
            </p>
            
            <div>
                <input type="button" id="actionInsertBefore" value="On insére &laquo;avant&raquo;" />
            </div>
            
            <script type="text/javascript">
                var myP = document.getElementById('pInsertBefore');
                var el = document.getElementById('actionInsertBefore');
                var emphasis = document.createElement('em');
                    emphasisText = document.createTextNode(' \"un petit ajout en emphase\"');
                
                    emphasis.appendChild(emphasisText);
                    el.addEventListener('click', actionInsertBefore, false);
                    
                    function actionInsertBefore(e)
                    {
                        e.preventDefault();
                        myP.insertBefore(emphasis, myP.lastChild);
                    }
            </script>
            <cite>
                Comme pour la méthode <strong>appendChild()</strong>, cette méthode s'applique sur l'élément parent.
            </cite>
            
            <h2>Une bonne astuce: insertAfter()</h2>
            <p>
                JS mes à disposition <strong>insertBefore()</strong>, mais pas <strong>insertAfter()</strong>. C'est dommage, car parfois assez utile. Qu'à cela ne tienne, créons donc cette fonction!
            </p>
            <p>
                Malheureusement, il ne nous est pas possible à ce stade du tutorial, de créer une méthode, qui s'appliquerait comme ceci:
            </p>
            <pre>
element.insertAfter();
            </pre>
            <p>
                Nous devrons donc nous contenter d'une simple fonction:
            </p>
            <pre>
insertAfter(newElement, afterElement);
            </pre>
            <h3>Algorithme de construction</h3>
            <ol>
                <li>Pour insérer après un élément, on va débuter par la récupération de l'élément parent.
                    <br/>
                    <em>C'est logique puisque l'insertion va se faire soit via <strong>appendChild()</strong> soit via <strong>insertBefore()</strong></em>
                </li>
                <li>
                    Déterminer si notre élément doit être ajouté après le <strong>dernier</strong> enfant ou non:
                    <ul>
                        <li>Dernier: <strong>appendChild()</strong></li>
                        <li>!Dernier: <strong>insertBefore()</strong> &amp; <strong>nextSibling</strong></li>
                    </ul>
                </li>
            </ol>
            <pre>
function insertAfter(new, afterElement)
{
    var parent = afterElement.parentNode();
    
    if(parent.lastChild === afterElement)
    {
        //si le dernier élément est le même que celui passé en paramètre appendChild()
        parent.appendChild(new);
    }else{
        //sinon on insère AVANT l'élément suivant
        parent.insertBefore(new, afterElement.nextSibling);
    }
}
            </pre>
            <h3>&dArr; On va la tester... &dArr;</h3>
            <p id="pInsertAfter">
                Un petit lien sur le <a href="http://www.mjf.com" target="_blank">MJF</a>.
            </p>
            
            <div>
                <input type="button" id="actionInsertAfter" value="On insére &laquo;après&raquo;" />
            </div>
            
            <script type="text/javascript">
				var el = document.getElementById('actionInsertAfter');
				var myLinkAfter = document.getElementById('pInsertAfter').getElementsByTagName('a')[0];
				var newElement = document.createElement('strong');
				var	newElementText = document.createTextNode(' AJOUTER APRÈS...');
				
				el.addEventListener('click', initInsertAfter, false);
				
				function initInsertAfter (e)
				{
						e.preventDefault();

						newElement.appendChild(newElementText);

						//appel de la fonction d'insertion
						insertAfter(newElement, myLinkAfter);
				}
				
				function insertAfter (newElement, elementBefore)
				{
					var parent = elementBefore.parentNode;

					if(parent.lastChild === elementBefore)
					{
						//signifie que l'on veut ajouter après le dernier élément
						parent.appendChild(newElement);
					}else{
						//signifie que ce n'est pas le dernier enfant
						//ce qui signifie qu'on reprend le prochain element [nextSibling] et que l'on insère avant celui-ci [insertBefore()]
						parent.insertBefore(newElement, elementBefore.nextSibling);
					}
				}
			</script>
            
            <a name="part_28"></a>
            <h1>C'est l'heure des TP</h1>
            <h2>Exercice 1</h2>
            <p>
            Pour ce premier exercice, nous vous proposons de recréer "du texte" mélangé à divers éléments tels des <strong>&lt;a&gt;</strong> et des <strong>&lt;strong&gt;</strong>. C'est assez simple, mais pensez bien à ne pas vous emmêlez les pinceaux avec tous les noeuds textuels!
            </p>
            <pre>
&lt;div id=&quot;divTP1&quot;&gt;
	Le &lt;strong&gt;World Wide Web&lt;/strong&gt;, abrégé par le sigle &lt;strong&gt;W3C&lt;/strong&gt;, est un
	&lt;a href=&quot;http://fr.wikipedia.org/wiki/Organisme_de_normalisation&quot; title=&quot;Organisme de Normalisation&quot;&gt;
	Organisme de stadardisation&lt;/a&gt; à but non-lucratif chargé de promouvoir la compatibilité des technologies du
	&lt;a href=&quot;http://fr.wikipedia.org/wiki/World_Wide_Web&quot; title=&quot;World Wide Web&quot;&gt;World Wide Web&lt;/a&gt;
&lt;/div&gt;
            </pre>
            <h3>&dArr; Passons à la pratique &dArr;</h3>
            <div style="margin-top:10px;" id="divBouton">
            	<input type="button" id="TP1" value="Print TP_1" />
            </div>
            
            <script type="text/javascript">
				var elTP = document.getElementById('TP1');
					elTP.addEventListener('click', printTp1, false);
					
					function printTp1(e)
					{
						e.preventDefault();
						
						var elements = {
							div : {
								id : 'divTP1',
								create : document.createElement('div')
							},
							strong : {
								create : document.createElement('strong')
							},
							a : {
								create : document.createElement('a'),
								href : 'http://fr.wikipedia.org/wiki/Organisme_de_normalisation',
								title : 'Organisme de normalisation',
                                                                target : '_blank'
							},
							a_2 : {
								create : document.createElement('a'),
								href : 'http://fr.wikipedia.org/wiki/World_Wide_Web',
								title : 'World Wide Web',
                                                                target : '_blank'
							},
							text : {
								txt_1 : document.createTextNode('Le '),
								txt_2 : document.createTextNode('World Wide Web Consortium'),
								txt_3 : document.createTextNode(', abrégé par le sigle '),
								txt_4 : document.createTextNode('W3C'),
								txt_5 : document.createTextNode(', est un '),
								txt_6 : document.createTextNode('Organisme de stadardisation'),
								txt_7 : document.createTextNode(' à but non-lucratif chargé de promouvoir la compatibilité des technologies du '),
								txt_8 : document.createTextNode('World Wide Web'),
								txt_9 : document.createTextNode('.')
							}
						}
						
						mainDiv = elTP.parentNode;
						mainDiv = mainDiv.appendChild(elements.div.create);
						mainDiv.id = elements.div.id;
						
						mainDiv.appendChild(elements.text.txt_1);
						
						mainDiv.appendChild(elements.strong.create).appendChild(elements.text.txt_2);
						
						mainDiv.appendChild(elements.text.txt_3);
						
						//je dois le cloner puisque createElement retourne une REFERENCE
						//strong2 = elements.strong.create.cloneNode(false);
						mainDiv.appendChild(elements.strong.create.cloneNode(false)).appendChild(elements.text.txt_4);
                                                
                                                mainDiv.appendChild(elements.text.txt_5);
                                                
                                                tmp_link = elements.a.create;
                                                tmp_link.href = elements.a.href;
                                                tmp_link.title = elements.a.title;
                                                tmp_link.target = elements.a.target;
                                                
                                                mainDiv.appendChild(tmp_link).appendChild(elements.text.txt_6);
                                                
                                                mainDiv.appendChild(elements.text.txt_7);
                                                
                                                tmp_link = null;
                                                tmp_link = elements.a_2.create;
                                                tmp_link.href = elements.a_2.href;
                                                tmp_link.title = elements.a_2.title;
                                                tmp_link.target = elements.a_2.target;
                                                
                                                mainDiv.appendChild(tmp_link).appendChild(elements.text.txt_8);
					}
			</script>
                        
           <h2>Exercice 2</h2>
           <p>
               Voici l'énoncé:
           </p>
           <pre>
&lt;div id = "div_td_2"&gt;
    &lt;p&gt; Langages basés sur ECMAScript: &lt;/p&gt;
    
    &lt;ul&gt;
        &lt;li&gt; JavaScript &lt;/li&gt;
        &lt;li&gt; JScript &lt;/li&gt;
        &lt;li&gt; ActionScript &lt;/li&gt;
        &lt;li&gt; EX4 &lt;/li&gt;
    &lt;/ul&gt;

&lt;/div&gt;
           </pre>
           
           <h3>&dArr; On test... &dArr;</h3>
            <div style="margin-top:10px;" id="divBouton2">
            	<input type="button" id="TP2" value="Print TP_2" />
            </div>
           
           <script type="text/javascript">
               var elTP2 = document.getElementById('TP2');
                   elTP2.addEventListener('click', printTP2, false);
                   
                   
               function printTP2(e)
               {
                   e.preventDefault();
                   
                   var elements = {
                       div : {
                           create : document.createElement('div'),
                           id : 'mainDiv2'
                       },
                       
                       text : [
                           document.createTextNode('Langages basés sur ECMAScript: '),
                           document.createTextNode('Javascript'),
                           document.createTextNode('JScript'),
                           document.createTextNode('ActionScript'),
                           document.createTextNode('EX4')
                       ],
                       
                       p : {
                           create : document.createElement('p')
                       },
                       
                       ul : {
                           create : document.createElement('ul')
                       },
                       
                       li : {
                           create : document.createElement('li')
                       }
                   }
                   
                   var wrapper = elTP2.parentNode;
                       wrapper = wrapper.appendChild(elements.div.create);
                       wrapper.id = elements.div.id;
                   
                       wrapper.appendChild(elements.p.create).appendChild(elements.text[0]);
                       
                       wrapper.appendChild(elements.ul.create);
                       
                       //on fait une boucle pour les éléments LI
                       //sert de compteur pour le clonage
                       
                       for(i = 1, c = elements.text.length; i < c; i++)
                       {   
                           if(i === 1)
                           {
                               wrapper.appendChild(elements.li.create).appendChild(elements.text[i]);
                           } else {
                               wrapper.appendChild(elements.li.create.cloneNode(false)).appendChild(elements.text[i]);
                           }  
                       }
               }
           </script>
           
     <h2>Exercice 3</h2>
                        
           <p>
               Voici l'énoncé:
           </p>
           <pre>
&lt;div id = "div_td_3"&gt;
    &lt;form enctype="multipart/form-data" method="post" action="upload.php"&gt;
    
    &lt;fieldset&gt;
    &lt;legend&gt; Uploader une image &lt;/legend&gt;

        &lt;div style="text-align: center"&gt;
            &lt;label for="inputUpload"&gt; Image à uploader: &lt;/label&gt;
            &lt;input type="file" name="inputUpload" id="inputUpload" /&gt;
            &lt;br /&gt; &lt;br/&gt;
            &lt;input type="submit" value="envoyer" /&gt;
        &lt;/div&gt;

    &lt;/fieldset&gt;

    &lt;/form&gt;
&lt;/div&gt;
           </pre>
           
           <h3>&dArr; On test... &dArr;</h3>
           <div style="margin-top:10px;" id="divBouton3">
               <input type="button" id="TP3" value="Print TP_3" />
           </div>
           
           <script type="text/javascript">
               var elTP3 = document.getElementById('TP3');
                   elTP3.addEventListener('click', printTP3, false);
                   
               function printTP3(e)
               {
                   e.preventDefault();
                   
                   var elements = {
                       div : {
                           create : document.createElement('div'),
                           id : 'mainDiv3'
                       },
                       
                       form : {
                           create : document.createElement('form'),
                           enctype : 'multipart/form-data',
                           method : 'post',
                           action : 'upload.php'
                       },
                       
                       fieldset : {
                           create : document.createElement('fieldset')
                       },
                       
                       legend : {
                           create: document.createElement('legend'),
                           text : document.createTextNode('Uploader une image')
                       },
                       
                       input : {
                           create : function (type, name, id, value, label, labelFor)
                           {
                               var tmp = document.createElement('input');
                               tmp.setAttribute('type', type);
                               
                               if (name != undefined)
                                   {
                                       tmp.name = name;
                                   }
                                   
                               if (id != undefined)
                                   {
                                       tmp.id = id;
                                   }
                                   
                               if (value != undefined && value !== '')
                                   {
                                       tmp.setAttribute('value', value);
                                   }
                               
                               if (label != undefined && labelFor != undefined)
                                   {
                                       var tmpWrapper = document.createElement('div');

                                       var tmpLabel = document.createElement('label');
                                       var tmpLabelTxt = document.createTextNode(label);
                                       tmpLabel.setAttribute('for', labelFor);
                                       tmpWrapper.appendChild(tmpLabel);
                                       tmpLabel.appendChild(tmpLabelTxt);
                                       tmpLabel.parentNode.appendChild(tmp);
                                       
                                       return tmpWrapper;
                                   }
                                   
                               return tmp;
                           }
                       }
                   };
                   
                   var formField = elements.form.create;
                       formField.action = elements.form.action;
                       formField.enctype = elements.form.enctype;
                       formField.method = elements.form.method;
                   
                   var fieldset = elements.fieldset.create;
                       fieldset.setAttribute('style', 'border: 1px black solid;');
                   var legendFieldset  = elements.legend.create;
                   var textFieldset = elements.legend.text;
                   
                       fieldset.appendChild(legendFieldset).appendChild(textFieldset);
                   
                   var uploadField = elements.input.create('file', 'test', 'test', '' ,'test a uploader', 'test');
                   var submitField = elements.input.create('submit', 'sub', 'sub', 'uploader');
                   
                   var wrapperForm = elTP3.parentNode;

                       wrapperForm = wrapperForm.appendChild(formField);
                       wrapperForm = wrapperForm.appendChild(fieldset);
                       wrapperForm = wrapperForm.appendChild(elements.div.create);
                       wrapperForm.id = elements.div.id;   
                   
                       wrapperForm.appendChild(uploadField);
                       wrapperForm.appendChild(submitField);
                   
               }
           </script>