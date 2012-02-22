        <a href="#part_9">Introduction aux Evénements</a> | <a href="#part_10">Les Evénements est le DOM</a> | <a href="#part_11">L'objet &quot;Event&quot;</a> | <a href="#part_12">Déclencher soi-même les Evénements</a>
        
        <a name="part_9"></a>
        <h1>Introduction: &quot;Que sont les événements?&quot; <span><a href="#">top</a></span></h1>
            <p>
                Les événements, comme son nom l'indique, permettent de déclencher des fonctions selon le statut d'une action <span style="color: dodgerblue; font-weight: 600;">[REALISEE ou NON-REALISEE]</span>. Autrement dit, on peut par exemple, faire appel à une fenêtre alert() lorsque l'utilisateur survol une zone de notre page web.                </p>
            <p>&quot;Une zone&quot; est un terme un peu vague, il vaut mieux parler d'un élément (<em>en général un élément HTML</em>). Ainsi, vous pouvez très bien ajouter un événement à n'importe quel éléments de votre page web afin de déclencher une portion de code JS. En récapitulant lorsque l'utilisateur fera une action souris ou clavier on intéragit.</p>
            <h2>
                La Théorie
            </h2>
            <h3>
            	Liste des événements
            </h3>
            <p>
           	Il existe de nombreux événements, tous plus ou moins utiles, pour autant que l'on sache les différencier. Voici une liste exhaustive de ceux-ci ainsi que les actions nécessaires à leurs déclenchements:</p>
            <table cellspacing="2">
              <tr>
                <th scope="col"><div align="left">Nom de l'événement</div></th>
                <th scope="col" style="border: none; background: none;">&nbsp;</th>
                <th scope="col"><div align="left">Action pour le déclencher</div></th>
              </tr>
              <tr>
                <td ><div align="center" class="style4">click</div></td>
                <td style="border: none; background: none;">&nbsp;</td>
                <td ><span class="style6">Cliquer sur l'élément</span></td>
              </tr>
              <tr>
                <td ><div align="center" class="style4">dblclick</div></td>
                <td style="border: none; background: none;">&nbsp;</td>
                <td ><span class="style6">Double-clique sur l'élément</span></td>
              </tr>
              <tr>
                <td ><div align="center" class="style4">mouseover</div></td>
                <td style="border: none; background: none;">&nbsp;</td>
                <td ><span class="style6">Faire entrer le curseur sur l'élément</span></td>
              </tr>
              <tr>
                <td ><div align="center" class="style4">mouseout</div></td>
                <td style="border: none; background: none;">&nbsp;</td>
                <td ><span class="style6">Faire sortir le curseur sur l'élément</span></td>
              </tr>
              <tr>
                <td ><div align="center" class="style4">mousedown</div></td>
                <td style="border: none; background: none;">&nbsp;</td>
                <td ><span class="style6">Appuyer (sans relâcher) sur le bouton gauche de la souris sur l'élément</span></td>
              </tr>
              <tr>
                <td ><div align="center" class="style4">mouseup</div></td>
                <td style="border: none; background: none;">&nbsp;</td>
                <td ><span class="style6">Relâcher le bouton gauche de la souris sur l'élément</span></td>
              </tr>
              <tr>
                <td ><div align="center" class="style4">mousemove</div></td>
                <td style="border: none; background: none;">&nbsp;</td>
                <td ><span class="style6">Faire se déplacer le curseur sur l'élément</span></td>
              </tr>
              <tr>
                <td ><div align="center" class="style4">keydown</div></td>
                <td style="border: none; background: none;">&nbsp;</td>
                <td ><span class="style6">Appuyer (sans relâcher) sur une touche du clavier sur l'élément</span></td>
              </tr>
              <tr>
                <td ><div align="center" class="style4">keyup</div></td>
                <td style="border: none; background: none;">&nbsp;</td>
                <td ><span class="style6">Relâcher une touche du clavier sur l'élément</span></td>
              </tr>
              <tr>
                <td ><div align="center" class="style4">keypress</div></td>
                <td style="border: none; background: none;">&nbsp;</td>
                <td ><span class="style6">Frapper une touche du clavier sur l'élément</span></td>
              </tr>
              <tr>
                <td ><div align="center" class="style4">focus</div></td>
                <td style="border: none; background: none;">&nbsp;</td>
                <td ><span class="style6">&quot;Cibler&quot; l'élément</span></td>
              </tr>
              <tr>
                <td ><div align="center" class="style4">change</div></td>
                <td style="border: none; background: none;">&nbsp;</td>
                <td ><span class="style6">Annuler la &quot;Cible&quot; de l'élément</span></td>
              </tr>
              <tr>
                <td ><div align="center" class="style4">select</div></td>
                <td style="border: none; background: none;">&nbsp;</td>
                <td ><span class="style6">Sélectionner le contenu d'un champ texte (input, textarea, ...)</span></td>
              </tr>
            </table>
            <table>
              <tr>
                <th colspan="3"><div align="left"><strong>Evénements spécifique au formulaire</strong></div></th>
              </tr>
              <tr>
                <td width="170"><div align="center" class="style4">submit</div></td>
                <td style="border: none; background: none;">&nbsp;</td>
                <td ><span class="style6">Envoyer le formulaire</span></td>
              </tr>
              <tr>
                <td ><div align="center" class="style4">reset</div></td>
                <td style="border: none; background: none;">&nbsp;</td>
                <td ><span class="style6">Réinitialiser le formulaire</span></td>
              </tr>
            </table>
            <p>Tout cela est pour le moment très théorique, je ne fais que lister quelques événements existants mais nous allons rapidement apprendre à les utiliser après un dernier petit passage concernant le <em>focus</em>.</p>
            <h3>Retour sur le focus</h3>
            <p>Lorsqu'un élément est ciblé, il va recevoir tous les événements de votre clavier, un exemple en est la balise <strong>input </strong>type <strong>text</strong>, si vous cliquez dans le champs il possède le focus, ce qui vous permet de taper des caractères sur votre clavier, vous allez les voir s'afficher <em><strong>dans </strong></em>l'input en question.</p>
            <p>Le focus peut s'appliquer à de nombreux éléments, un lien, lorsqu'il possède le focus vous emménera vers l'url contenue dans celui-ci.</p>
            <h2>Un petit coup de pratique</h2>
            <h3>Utiliser les événements</h3>
            <p>Tout d'abord un petit exemple simple, sans intéraction avec le DOM</p>
            <pre>
&lt;span onclick&quot;=alert('Hello!');&quot;&gt;Cliquez-moi!&lt;/span&gt;
            </pre>
            
<h2>⇓ Petit test de mise en pratique ⇓</h2>
            
            <p style="border: dodgerblue 1px solid; padding: 5px; cursor: pointer;" onClick="alert('Hello Léo!');">
            Cliquez-moi<br />
            <em>Cet élément n'est plus présent dans les normes W3C du xHTML, cependant il fait son grand retour en AJAX! Car il peut s'avérer très utiles pour y faire transiter des données.
              Le meilleur exemple est le cas d'upload en AJAX: un upload de fichier sans rechargement de la page, intéressant :-) !!!              </em>
            </p>
            <p>
            	Comme vous pouver le constater, il suffit de cliquer sur le texte pour que la boîte de dialogue s'affiche. Afin d'obtenir ce résultat nous avons ajouté à notre balise <em><strong>p </strong></em>un attribut contenant les deux lettres <em><strong>&quot;on&quot; </strong></em>et le nom de l'événement. Cet attribut possède une valeur qui est une code JS, vous pouvez y écrire pratiquement tout ce que vous voulez mais tout doit tenir dans les guillemets de l'attribut.</p>
            <h3>La propriété THIS</h3>
            <p>Cette propriété n'est pas censée vous être utile dès maintenant, cependant il est toujours bon de la connaître pour les événements sans l'utilisation du DOM.</p>
            <pre>
&lt;span onclick="alert('Voici le contenu de l\'élément que vous avez cliqué:\n\n' + this.innerHTML)"&gt;Cliquez-moi!&lt;/span&gt
            </pre>
<h2> ⇓ Petit test de mise en pratique ⇓ </h2>
            <span onClick="alert('Voici le contenu de l\'élément que vous avez cliqué:\n\n' + this.innerHTML)">Cliquez-moi!</span> 
            
            <h3>
            	Retour sur le focus
            </h3>
            
            <p>
           	Afin de bien vous montrer ce qu'est le focus, voici un exemple qui vous montrera ce que ça donne sur un input classique et un lien:
            </p>
            <pre>
&lt;input id=&quot;input&quot; type=&quot;text&quot; size=&quot;50&quot; value=&quot;Cliquez ici!&quot;<br>onfocus=&quot;this.value='Appuyez maintenant la touche TAB...';&quot;
onblur=&quot;this.value='Cliquez ici!';&quot; /&gt;
&lt;br /&gt;<br>&lt;br /&gt;
&lt;a href=&quot;#&quot;
onfocus=&quot;document.getElementById('input').value='Vous avez maintenant le focus sur le lien, Bravo!'; return false;&quot;&gt;un lien&lt;/a&gt;
            </pre>
<h2> ⇓ Petit test de mise en pratique ⇓ </h2>
            <p>
              <input id="input" type="text" size="50" value="Cliquez ici!"
            onfocus="this.value='Appuyez maintenant sur la touche TAB...';"
            onblur="this.value='Cliquez ici!';" />
              <a href="#"
            onfocus="document.getElementById('input').value='Vous avez maintenant le focus sur le lien, Bravo!';">Un Lien</a>
</p>
            <p><span class="style9">&quot;</span><em>Comme vous pouvez le constater nous passons par trois états. Lors du click dans le champ texte on déclenche l'événement <strong>click</strong> ce qui change le texte de l'input. Ce texte vous demande en appuyant sur la touche TAB, en clair il vous demande de changer le <strong>focus</strong> et de le passer au lien, il déclenche alors l'événement <strong>blur</strong>. Puis le lien déclenche son événement.</em> <span class="style9">&quot;</span></p>
            <h3>Bloquer l'action par défaut de certains événements</h3>
            <p>Passons maintenant à un petit problème: Lorsque vous souhaitez appliquez un événement <strong>click</strong> sur un lien, que ce passe-t-il...?</p>
            <pre>
&lt;a href=&quot;http://www.siteduzero.com&quot;<br>onclick=&quot;alert('vous allez quitter le site...');&quot;&gt;Cliquez moi!&lt;/a&gt;<br>
</pre>
            <p><em>Vous avez bien compris qu'en testant ce morceau de code... vous serez redirigé sur le site source de ces exemples et textes. Mais alors comment contrer ce phénomène.</em></p>
            <p>Pour palier à ce problème nous allons utiliser le mot réservé <strong><em>return </em></strong><em><strong>false; </strong></em>pour mettre cours aux agissements de notre événement par défaut:</p>
            <pre>&lt;a href=&quot;http://www.siteduzero.com&quot;<br>onclick=&quot;alert('vous allez quitter le site...'); return false;&quot;&gt;Cliquez moi!&lt;/a&gt;<br>
</pre>
<h2> ⇓ Petit test de mise en pratique ⇓ </h2>
            <p>
            <a href="#"
            onclick="alert('Vous avez cliqué mais pas suivi le liens...'); return false;">Un Lien</a>            </p>
            <p><em>A noter que si j'avais mis le <strong>return</strong> à <strong>true</strong> il aurait déclenché l'événement par défaut... et donc suivi le lien.</em></p>
            <h3>L'utilisation de &quot;javascript:&quot; dans les liens est à proscrire</h3>
            <p>Dans certains cas vous allez devoir créer un lien juste pour leur attribuer un événement <strong>click</strong> et non pas pour leur fournir un lien vers lequel rediriger.</p>
            
            
            <a name="part_10"></a>
            <h1>Les événements au travers du DOM <span><a href="#">top</a></span></h1>
            <p>Bien, maintenant que nous avons vu l'utilisation du des événements sans le <strong>DOM</strong>, nous allons passer à leur utilisation au travers de l'interface implémentée par <em><strong>Netscape</strong></em> que l'on appelle le <strong>DOM-0</strong> puis au standard de base actuel: le <strong>DOM-2</strong>.</p>
            <h2>Le DOM-0</h2>
            <p>Cette interface est vielle, je ne vais donc vous en montrer que les bases. Commençons par créer un simple code avec l'événement <em><strong>click</strong></em>.</p>
            <pre>
&lt;span id=&quot;clickme&quot;&gt;Cliquez-moi!&lt;/span&gt;

&lt;scrip type=&quot;text/javascript&quot;&gt;

    var el = document.getElementById('clickme');
    el.onclick = function()
                        {
                             alert('Vous m'avez cliqué!');
                        };

&lt;/script&gt;<br>
</pre>
<p>Comme vous le voyez, on définit maintenant les événements non plus dans le code HTML mais directement en JS. Chanque événement standard possède donc un attribut dont le nom est, àà nouveau. prédédé par les deux lettres de &quot;on&quot;. Cet attribut ne prend plus pour valeur un code Javascript Brut mais:</p>
            <ol>
              <li>le nom d'une fonction</li>
              <li>une fonction anonyme</li>
            </ol>
            <p>Bref dans tout les cas il faudra lui fournir une fonction qui contiendra le code JS a exécuté en cas de déclenchement de l'événement.<br>
            Pour supprimer un événement avec le DOM-0, il suffira de lui attribuer une fonction anonyme vide!</p>
            <pre>
el.onclick = function()
                    {
                    };

</pre>

<p>Voilà tout pour les événements DOM-O, nous pouvons maintenant attaquer le coeur des événements: <em><strong>DOM-2 </strong></em>&amp;&amp; l'objet <em><strong>Event</strong></em>.</p>
            <h2>Le DOM-2</h2>
            <p>Nous y voilà enfin! Alors pourquoi le DOM-2 et non pas le DOM-0 ou pas de DOM du tout?</p>
            <ul>
              <li>Sans le DOM:<br>
              <span class="style10">On ne peut pas y utiliser l'objet Event qui est pourtant un mine d'informations sur l'événement déclenché, et donc je vous conseille de mettre cette méthode de côté dès maintenant. L'important est de la reconnaître.</span></li>
              <li>DOM-0:<br>
              <span class="style10">Il a dexu problèmes majeurs: il est vieux, et il ne permet pas de créer plusieurs fois le même événement.</span></li>
              <li><strong>DOM-2:<br>
              </strong><span class="style11">Il permet la création multiple d'un même événement et gère aussi l'objet <strong>Event</strong>. Autrement dit le DOM-2 c'est bien alors mangez-en!</span></li>
            </ul>
            <p>Attention il ne faut pas constamment utiliser le DOM-2, car il est plus long est compliqué à mettre en place le DOM-0, si nous n'avons besoin que d'un seul événement se révèle fort efficace et rapide en déploiement.</p>
            <h3>Le DOM-2 selon les standards du WEB</h3>
            <p>Comme pour les autres interfaes événementielles, voici un exemple de l'événement <em><strong>click</strong></em>:</p>
            <pre>
&lt;span id=&quot;clickme&quot;&gt;Cliquez-moi!&lt;/span&gt;

&lt;script type=&quot;text/javascript&quot;&gt;

var el = document.getElementById('clickme');
el.addEventListener('click', function(){
                                            alert('Vous m'avez cliqué!');
                                        },
false);

&lt;/script&gt;
</pre>
            <p><em>Alors tout d'abord nous utilisons une méthode nommée <strong>addEventListener()</strong>.<br>
            Cette méthode prend 3 paramètres:</em></p>
            <ol>
              <li>Le nom de l'événement, <em>sans le &quot;<strong>on</strong>&quot;</em></li>
              <li>La fonction a exécuter, et si on utilise une variable... ça veut dire que c'est une <strong>FONCTION DE CALLBACK</strong></li>
              <li>Un booléen pour spécifier si l'on souhaite utiliser la phase de <em><strong>capture</strong></em> ou de <em><strong>bouillonnement</strong></em>. Je reviendrais dessus bientôt, retenez juste que dans la majeure partie des cas on utilisera le <em><strong>bouillonnement</strong></em> donc <em><strong>false</strong></em>.</li>
</ol>
            <p>Maintenant une façon plus propre d'écrire ce code:</p>
            <pre>
&lt;span id=&quot;clickme&quot;&gt;Cliquez-moi!&lt;/span&gt;

&lt;script type=&quot;text/javascript&quot;&gt;

var el = document.getElementById('clickme');

var myFunction = function()
				{
					alert('Vous m'avez cliqué!');
				};

el.addEventListener('click', myFunction, false); //Fonction de CALLBACK &rArr; pas besoin de passer le paramètre!!!

&lt;/script&gt;
            </pre>
            
<h2> ⇓ Petit test de mise en pratique ⇓ </h2>
            <p><span id="clickme2" style="cursor: pointer;">Cliquez-moi!</span>
              
                <script type="text/javascript">
				var el = document.getElementById('clickme2');
				
				var myFunction = function(){
					alert('Vous m\'avez cliqué!');
				};
				
				el.addEventListener('click', myFunction, false);
			  </script>
</p>
            <h3>Plusieurs mêmes événements</h3>
            <pre>
&lt;span id=&quot;clickme&quot;&gt;Cliquez-moi!&lt;/span&gt;

&lt;script type=&quot;text/javascript&quot;&gt;

var el = document.getElementById('clickme');

var myFunction = function()
				{
					alert('Vous m'avez cliqué 1x!');
				};
                
var myFunction2 = function()
				{
					alert('Vous m'avez cliqué 2x!');
				};                

el.addEventListener('click', myFunction,false); //ou directement avec des fonctions anonymes
el.addEventListener('click', myFunction2,false);

&lt;/script&gt;
            </pre>
            
<h2> ⇓ Petit test de mise en pratique ⇓ </h2>
<p>
<em>Je vais réaliser cet exemple avec des fonctions anonymes comme celà les deux exemples seront présents.</em>
</p>
<h4>Fonctions anonymes</h4>
<span id="clickme3" style="cursor: pointer;">Cliquez-moi...!</span>

<script type="text/javascript">
	var el = document.getElementById('clickme3');
	
	el.addEventListener('click', function(){
		alert('Vous avez cliqué 1x...');
	}, false);
	
	el.addEventListener('click', function(){
		alert('et de 2x !');
	}, false);
</script>
<div>&nbsp;</div>
<h4>Fonctions définies dans des variables</h4>
<span id="clickme4" style="cursor: pointer;">Cliquez-moi...!</span>
  
    <script type="text/javascript">
	var el = document.getElementById('clickme4');
	
	var myFunction1 = function()
	{
		alert('1x...');
	};
	
	var myFunction2 = function()
	{
		alert('et de 2x !!!');
	};
	
	el.addEventListener('click', myFunction1, false);
	el.addEventListener('click', myFunction2, false);
    </script>
</p>
<h2 style="padding-top:0px;">Fin exemple</h2>
<h3>Supprimer un événement avec le DOM-2</h3>
<p>Venons-en maintenant à la suppression des événements! Celle-ci s'opère avec la méthode <em><strong>removeEventListener()</strong></em> et se fait de manière très simple... Elle doit comporter <span class="style13">exactement</span> les mêmes paramètres que lors de la création de l'événement.</p>
<p><em><span class="style12">Attention cependant un événement généré avec une<strong> fonction anonyme</strong> ne peut plus être supprimé...!</span></em></p>
<pre>
el.addEventListener('click', myFunction, false);
el.removeEventListener('click', myFunction, false);
</pre>

<h3>Le DOM-2, selon IE</h3>
<p>On ne déroge pas à la tradition, IE n'utilisant pas les standards avant le verion 9 de celui-ci il est obligatoire de revoir sa méthode de capture et de suppression des événements:</p>
<pre>
el.attachEvent('onclick', function(){...blabla...});

el.detachEvent('onclick', function(){...blabla...});
</pre>
<p>Pour cette raison nous mettrons en place une fonction qui choisira pour nous quelle méthode utilisée:</p>
<pre style="background-color:#E0BEBE;">
&lt;script type = &quot;text/javascript&quot;&gt;
    function addEvent(el, event, func)
    {
        if(el.addEventListener)
        {
            el.addEventListener(event, func, false);
        }else{
            el.attachEvent('on'+event, func);
        }
    }
	
    addEvent(element, 'click', function(){...blabla...}); // ou une variable contenant une fonction
&lt;/script&gt;
</pre>

<a name="part_11"></a>
<h1>L'objet Event <span><a href="#">top</a></span></h1>
<p>Maintenant que nous avons vu comment créer et supprimer des événements, nous pouvons finalement passer à l'objet &quot;<strong>Event&quot;</strong></p>
<h2>Généralité sur l'objet Event</h2>
<p>Tout d'abord à quoi sert cet objet? A vous fournir une multitude d'informations sur l'événement en cours. Par exemple, vous pouvez récupérer quelles sont les touches actuellement enfoncées, les coordonnées du curseur, l'élément qui a déclenché l'événement, etc... Les possibilités sont nombreuses!</p>
<p>Cet objet est bien particulier dans le sens où il n'est accessible que lorsqu'un événement est déclenché. Son accès ne peut se faire que dans une fonction exécutée par un événement...</p>
<p>Cela se fait de la manière suivante selon DOM-0</p>
<pre>
el.onclick = function(e)
                    {
                        alert(e.type);
                    }
</pre>

<p>Selon le DOM-2</p>
<pre>
el.addEventListener('click', function(e){alert(e.type);}, false);
</pre>

<h2> ⇓ Petit test de mise en pratique ⇓ </h2>
<span id="clickme5" style="cursor: pointer;">Cliquez-moi...!</span>

<script type="text/javascript">
	var el = document.getElementById('clickme5');
	
	el.addEventListener('click', function(e){
		alert('L\'événement est de type: \n\n'+e.type);
	}, false);
</script>

<p>Il est important de bien comprendre que le paramètre transmettant l'événement à la fonction ne doit pas obligatoirement s'appeler <em><strong>e</strong></em> ! Vous pouvez lui donner tout autre nom. L'objet <em><strong>Event</strong></em> est passé par référence à l'argument de votre fonction.</p>
<p>Concernant <em><strong>IE</strong></em>, une fois n'est pas coutûme, dans ses versions antérieures à la 9ème... Dès lors, si vous souhaitez utiliser du DOM-0, vous remarquerez que l'objet <strong>Event</strong> n'est accessible qu'en utilisant <em><strong>window.event</strong></em>. Ce qui signife que vous n'êtes pas obligé de passer un argument à la fonction exécutée par l'événement. A contrario, si vous utilisez DOM-2, vous n'êtes pas obligés d'utiliser <em><strong>window.event</strong></em>.</p>
<p>Afin de garder une compatibilité maximum entre les navigateurs, on utilisera généralement ce code dans la fonction exécutée par l'événement:<cite>e = e || window.event</cite></p>           

<h2>Les fonctionnalités de l'objet Event</h2>
<p>
    Vous avez déjà découvert ce-dessus l'attribut <strong>type</strong> qui permet de savoir quel type d'événement a été déclenché. Passons maintenant à la découverte d'autres attributs et méthodes de cet objet.
    <br />
    <em style="color: darkred;">Attention tout n'est pas présenté seulement les bases.</em>
</p>

<h3>Récupérer l'élément de l'événement actuel</h3>
<p>
    Un des plus important attributs de notre objet se nomme <strong>TARGET</strong>. Celui-ci permet de récupérer une référence vers l'élément dont l'événement a été déclenché (comme le <strong>this</strong> pour les événements sans le DOM ou DOM-0). Par cette attribut on peut très facilement modifier le contenu d'un élément qui a été cliqué:
</p>
  
<pre>
&lt;span id="clickme"&gt;Cliquez-moi!&lt;/span&gt;

&lt;script type="text/javascript"&gt;
    var clickme = document.getElementById('clickme');

    clickme.addEventListener('click', function(e)
                                                {
                                                    e.target.innerHTML = 'Vous avez cliqué!';
                                                }, false);
&lt;/script&gt;
</pre>

<p>
    Comme il y a toujours un problème qque part, voilà qu'IE(sauf la version 9) ne supporte pas cette propriété. Ou disons plutôt qu'il la supporte à sa manière... avec <strong>srcElement</strong>, donc lors de l'utilisation de ce genre d'attribut il est préférable de passer par une variable.
</p>

<pre>
&lt;span id="clickme"&gt;Cliquez-moi!&lt;/span&gt;

&lt;script type="text/javascript"&gt;
    var clickme = document.getElementById('clickme');

    clickme.addEventListener('click', function(e)
                                                {
                                                    var target = e.target || e.srcElement <span style="color: darkred;">//ici nous attribuons
                                                                                          //une variable de manière
                                                                                          //conditionnelle!</span>
                                                    target.innerHTML = 'Vous avez cliqué!';
                                                }, false);
&lt;/script&gt;
</pre>

<h2>&dArr; Un petit test de la fonctionnalité de l'attribut &dArr;</h2>
<span id="clickme6">Cliquez-moi!</span>

<script type="text/javascript">
    el = document.getElementById('clickme6');
    
    el.addEventListener('click', function(e)
                                        {
                                            var target = e.srcElement || e.target;

                                            target.innerHTML = "Vous avez cliqué petit malin...";
                                        }, false);
</script>

<cite>
    A noter qu'ici j'ai effectué un code compatible avec IE. Enfin pas totalement, puisqu'il faudrait encore faire une condition pour la gestion de l'événement (addEventListener VS attachEvent). Il et important de faire attention aux problèmes de compatibilité inter-navigateurs.
</cite>

<h3>Récupérer l'élément à l'origine du déclenchement de l'événemet</h3>
<p>
    <em>Ce n'est pas un peu la même chose que le poste précédent...?</em>
</p>
<p>
    Eh bien non! Pour expliquer ceci de façon simple, certains événements appliqués à un élément <strong>parent</strong> peuvent se propager d'eux-mêmes aux éléments <strong>enfants</strong>...
    C'est, par exemple, le cas des événements <strong><em>mouseover, mouseout et mousemove</em></strong>. Explicitons ceci par un exemple:
</p>

<pre>
&lt;p id="result"&gt;&lt;/p&gt;
&lt;div id="parent"&gt;
    Parent
    &lt;div id="child1"&gt;Enfant N°1&lt;/div&gt;
    &lt;div id="child2"&gt;Enfant N°2&lt;/div&gt;
&lt;/div&gt;

&lt;script type="text/javascript"&gt;
    var parent = document.getElementById('parent');
    var result = document.getElementById('result');

    parent.addEventListener('mouseover', function(e)
                                                {
                                                    result.innerHTML = 'L\'élément déclencheur de l\'événement \"mouseover\" possède l\'ID:\n'+e.target.id;
                                                }, false);
&lt;/script&gt;
</pre>

<h2>&dArr; Rien ne vaut la pratique &dArr;</h2>
<p style="color: orange; font-style: italic;">Survolez les différents textes ci-dessous afin de voir comment le système réagit</p>
<p id="result3">&nbsp;</p>
<div id="parent" style="width: 150px; height: 150px; background-color: dodgerblue; border: 1px #666 solid; color: whitesmoke;">
    Parent
    <div id="child1" style="width: 73px; height: 73px; background-color: green; border: 1px whitesmoke solid; color: whitesmoke; float: right;">Enfant N°1</div>
    <div style="clear: right;"></div>
    <div id="child2" style="width: 73px; height: 73px; background-color: orange; border: 1px whitesmoke solid; color: whitesmoke; float: left;">Enfant N°2</div>
    <div style="clear: left;"></div>
</div>

<script type="text/javascript">
    var parent = document.getElementById('parent');
    var result = document.getElementById('result3');

    parent.addEventListener('mouseover', function(e)
                                                {
                                                   result.innerHTML = 'L\'élément déclencheur de l\'événement \"mouseover\" possède l\'ID:\n<span style="color: orange; font-weight: bold;>">'+ e.target.id +"</span>";
                                                }, false);
                                                
    parent.addEventListener('mouseout', function(){
                                                    result.innerHTML = '&nbsp;';
                                               }, false);
</script>

<cite>
    On observe clairement que l'événement s'est propagé aux éléments enfants. Pour palier à ce problème, nous pouvons utiliser un autre attribut magique... <strong>currentTarget</strong>!!!
</cite>

<h2>&dArr; Rien ne vaut la pratique &dArr;</h2>
<p style="color: orange; font-style: italic;">Survolez les différents textes ci-dessous afin de voir comment le système réagit</p>
<p id="result2">&nbsp;</p>
<div id="parent2" style="width: 150px; height: 150px; background-color: dodgerblue; border: 1px #666 solid; color: whitesmoke;">
    Parent
    <div id="child12" style="width: 73px; height: 73px; background-color: green; border: 1px whitesmoke solid; color: whitesmoke; float: right;">Enfant N°1</div>
    <div style="clear: right;"></div>
    <div id="child22" style="width: 73px; height: 73px; background-color: orange; border: 1px whitesmoke solid; color: whitesmoke; float: left;">Enfant N°2</div>
        <div style="clear: left;"></div>
</div>

<script type="text/javascript">
    var parent2 = document.getElementById('parent2');
    var result2 = document.getElementById('result2');

    parent2.addEventListener('mouseover', function(e)
                                                {
                                                    result2.innerHTML = 'L\'élément déclencheur de l\'événement \"mouseover\" possède l\'ID:\n<span style="color: orange; font-weight: bold;>">'+ e.currentTarget.id +"</span>";
                                                }, false);
                                                
    parent2.addEventListener('mouseout', function(){
                                                    result2.innerHTML = '&nbsp;';
                                               }, false);
</script>

<cite>
Comme habituellement IE avant la version 9 ne gre pas cette propriété et il n'y a pas d'alternative (mise  part l'utilisation du mot-clé <strong>this</strong>)
</cite>

<h3>Récupérer la position du curseur</h3>
<p>
La position du curseur est une information très importante, beaucoup de monde s'en sert pour de nombreux scripts comme le Drag N' Drop. Généralement, on récupère la position du curseur par rapport au coin supérieur gauche de la page web, cela dit il est aussi possible de récupérer sa position par rapport au coin supérieur gauche de <strong>l'écran</strong>. Toutefois, dans ce tuto, nous allons nous limiter à la page web, regardez donc la doc de l'objet Event si vous souhaitez en apprendre plus.
</p>

<p>
Pour récupérer la position de notre curseur, il existe deux attributs: <strong>clientX</strong> pour la position horizontale et <strong>clientY</strong>. Vu  pour la position verticale. Vu que la position du curseur change à chaque déplacement de la souris, il est donc logique de dire que l'événement le plus adapté  la majorité des cas est <strong>mousemove</strong>.
</p>
<p>
Je vous déconseille très fortement d'essayer d'exécuter la fontion <strong>alert()</strong> dans un événement <strong>mousemove</strong> ou bien vous allez rapidement être submergé de fenêtres!
</p>

<p>
Comme d'habitude, voici un petit exemple pour que vous compreniez bien:
</p>

<pre>
&lt;p id="position"&gt;&lt;/p&gt;

&lt;script type="text/javascript"&gt;
    var position = document.getElementById('position');
    
    document.addEventListener('mousemove', function(e)
                                                    {
                                                        position.innertHTML = 'Position X: ' + e.clientX
                                                        + '\nPosition Y: ' + e.clientY;
                                                    }, false);
&lt;/script&gt;
</pre>

<h2>&dArr; Rien ne vaut la pratique &dArr;</h2>

<div id="position"></div>

<script type="text/javascript">
    var position = document.getElementById('position');

    document.addEventListener('mousemove', function(e)
                                                    {
                                                        position.innerHTML = 'Position X: ' + e.clientX + 
														'Position Y: ' + e.clientY;
                                                    }, false);
</script>
<p>
Pas très compliqué n'est-ce pas? Bon, là je peux comprendre que vous trouviez l'intérêt de ce code assez limité, mais lorsque vous saurez manipuler le CSS des éléments vous pourrez par exemple faire en sorte que des éléments HTML suivent votre curseur...!
</p>

<h2>&dArr; Rien ne vaut la pratique &dArr;</h2>

<div id="position2"></div>

<div id="surface" style="width: 300px; height: 300px;  border: 1px #333 solid; overflow: hidden;"></div>

<script type="text/javascript">
    var position2 = document.getElementById('position2');
    var surface = document.getElementById('surface');
        
        surface.addEventListener('mousemove', function(e)
                                                    {
                                                        //position2.innerHTML = 'Position X: ' + e.clientX + 
														//'Position Y: ' + e.clientY;
                                                        
                                                        var parent = surface.offsetParent;
                                                        var top = surface.offsetTop + parent.offsetTop;
                                                        var left = surface.offsetLeft + parent.offsetLeft;
                                                        //alert(top + "et" + left);
                                                        var test = document.createElement('div');
                                                            test.style.top = (e.clientY)+'px';
                                                            test.style.left = (e.clientX)+'px';
                                                            test.style.backgroundColor = 'black';
                                                            test.style.width = '2px';
                                                            test.style.height = '2px';
                                                            test.style.position = 'fixed';

                                                            document.getElementById('surface').appendChild(test);
                                                    }, false);
</script>

<h3>Récupérer un événement avec la souris</h3>
<p>
Cette fois nous allons étudier un attribut un peu plus "exotique" qui est assez peu utilisé mais peut pourtant se révéler très utile! Il s'agit de <strong>relatedTarget</strong> et il ne s'utilise qu'avec les événements <strong>mouseout</strong> et <strong>mouseover</strong>.
</p>
<p>
Cet attribut remplit deux fonctions différentes selon l'événement utilisé. Avec l'événement <strong>mouseout</strong>, il vous fournira l'objet de l'élément sur lequel votre curseur <em><strong>vient d'entrer</strong></em>; avec l'événement <strong>mouseover</strong>, il vous donnera l'objet de l'élément dont le curseur <strong><em>vient de sortir</em></strong>.
</p>
<p>
Voici un exemple qui illustre son fonctionnement:
</p>

<pre>
&lt;p id=&quot;result&quot;&gt;&lt;/p&gt;

&lt;div id=&quot;parent1&quot;&gt;
	Parent N°1<br>	mouseover sur l'enfant
	&lt;div id=&quot;child1&quot;&gt;Enfant N°1&lt;/div&gt;
&lt;/div&gt;

&lt;div id=&quot;parent2&quot;&gt;
	Parent N°2<br>	mouseover sur l'enfant
	&lt;div id=&quot;child2&quot;&gt;Enfant N°2&lt;/div&gt;
&lt;/div&gt;

&lt;script type=&quot;text/javascript&quot;&gt;
	var child1 = document.getElementById('child1');
	var child2 = document.getElementById('child2');
	var result = document.getElementById('result');

	child1.addEventListener('mouseover', function(e)
                                        {
                                            result.innerHTML = 'L'élément quitté juste avant que le curseur
                                                                n\'entre sur l\'enfant N°1 est: '
                                                                + e.relatedTarget.id;
                                        }, false);
                                        
	child2.addEventListener('mouseout', function(e)
                                        {
                                            result.innerHTML = 'L'élément survolé juste avant que le curseur
                                                                n\'ait quitté sur l\'enfant N°2 est: '
                                                                + e.relatedTarget.id;
                                        }, false);	                                        

&lt;/script&gt;
</pre>

<h2>&dArr; Rien ne vaut la pratique &dArr;</h2>

<p id="result_relatedTarget"></p>

<div id="parent10" style="width: 150px; height: 150px; background-color: dodgerblue; border: 1px #666 solid; color: whitesmoke;">
	Parent N°10
	mouseover sur l'enfant
	<div id="child10" style="width: 73px; height: 73px; background-color: green; border: 1px whitesmoke solid; color: whitesmoke; float: right;">Enfant N°10</div>
</div>
<div style="clear: both;">&nbsp;</div>
<div id="parent20" style="width: 150px; height: 150px; background-color: dodgerblue; border: 1px #666 solid; color: whitesmoke;">
	Parent N°20
	mouseover sur l'enfant
	<div id="child20" style="width: 73px; height: 73px; background-color: green; border: 1px whitesmoke solid; color: whitesmoke; float: right;">Enfant N°20</div>
</div>
<div style="clear: both;">&nbsp;</div>

<script type="text/javascript">
	var child10 = document.getElementById('child10');
	var child20 = document.getElementById('child20');
	var result_relatedTarget = document.getElementById('result_relatedTarget');
	
	child10.addEventListener('mouseover', function(e)
                                        {
                                            result_relatedTarget.innerHTML = 'L\'élément quitté juste avant que le curseur n\'entre sur l\'enfant N°1 est: ' + e.relatedTarget.id;
                                        }, false);
                                        
	child20.addEventListener('mouseout', function(e)
                                        {
                                            result_relatedTarget.innerHTML = 'L\'élément survolé juste avant que le curseur n\'ait quitté sur l\'enfant N°2 est: ' + e.relatedTarget.id;
                                        }, false);	                                        

</script>

<cite>Comme d'hab IE ne gère pas cet attribut... il faut dès lors utiliser les attributs <strong>fromElement</strong> &amp; <strong>toElement</strong></cite>

<h3>Récupérer les touches frappées par l'utilisateur</h3>
<p>
Tout comme la postion du curseur, il est possible de récupérer les touches frappées par l'utilisateur. Pour celà, nous allons utiliser les attributs <strong>keyCode</strong> &amp; <strong>which</strong> qui contiennent chacun un pour chaque caractère frappé.
</p>

<p><em>Mais pourquoi deux attributs?</em></p>

<p>Tout simplement parce qu'ils ont tout les deux une utilisation spécifique:</p>

<ul>
    <li style="padding-bottom: 10px;">
    	Les événements <strong>keyup</strong> &amp; <strong>keydown</strong> se déclenchent à chaque touche. Ainsi, si on prend l'exemple de l'événement <strong>keydown</strong> et que vous souhaitez faire une combinaison de touches telle que <strong>ctrl+s</strong> vous déclencherez deux fois l'événement. Pour ce deux événements, vous pouvez utiliser soit l'attribut <strong>keyCode</strong> soit <strong>which</strong>. Ils récupèrent tout les deux le code de chaque touche frappée. Cependant, <strong>l'attribut <em>which</em> n'est pas supporté par IE</strong>, je conseille donc l'utilisation de <strong>keyCode</strong>.
    </li>
	<li>
    	Concernant l'événement <strong>keypress</strong>, celui-ci aussi se déclenche à chaque touche MAIS il est aussi capable de détecter les <strong>combinaisons</strong> de touches. Cela veut dire que si vous appuyez simultanément sur <strong><em>shift+p</em></strong>, il va analyser la combinaison effectuée et en déduire un code adéquat, dans notre cas il va comprendre et imprimer <strong>P</strong><em>[imprimer en majuscule]</em>.
        <br />
		Pour récupérer le code obtenu par <strong>keypress</strong>, il vous faut utiliser l'attribut <strong>which</strong>. Cependant, pour les touches dont la représentation écrite n'est pas possible (comme les touches fléchées par exemple), il vous faudra utiliser l'attribut <strong>keyCode</strong>!!!
        <br /><br />
		Concernant <em><strong>IE</strong></em> dans ces versions antérieures à la 9, il vous faudra utiliser <em><strong>keyCode</strong></em> dans tout les cas.
    </li>
</ul>

<pre>
&lt;p id=&quot;keyCode&quot;&gt;&lt;/p&gt;<br>&lt;p id=&quot;which1&quot;&gt;&lt;/p&gt;<br>&lt;p id=&quot;which2&quot;&gt;&lt;/p&gt;

&lt;script type=&quot;text/javascript&quot;&gt;
	var keyCode = document.getElementById('keyCode');
	var which1 = document.getElementById('which1');
	var which2 = document.getElementById('which2');

	document.addEvenetListener('keyup', function(e){
		keyCode.innerHTML = &quot;keyCode: &quot; + e.keyCode;
	}, false);

	document.addEventListener('keyup, function(e){
		which1.innerHTML = &quot;which avec keyup: &quot; + e.which;
	}, false);

	document.addEventListener('keypress', function(e){
		which2.innerHTML = &quot;which avec keyup: &quot; + e.which;
	}, false);
&lt;/script&gt;
</pre>

<h2>&dArr; Rien ne vaut la pratique &dArr;</h2>
<p id="keyCode"></p>
<p id="which1"></p>
<p id="which2"></p>

<script type="text/javascript">
	var keyCode = document.getElementById('keyCode');
	var which1 = document.getElementById('which1');
	var which2 = document.getElementById('which2');

	document.addEventListener('keyup', function(e){
		keyCode.innerHTML = "keyCode: " + e.keyCode;
	}, false);

	document.addEventListener('keyup', function(e){
		which1.innerHTML = "which1 avec keyup: " + e.which;
	}, false);

	document.addEventListener('keypress', function(e){
		which2.innerHTML = "which2 avec keyup: " + e.which;
	}, false);
</script>

<h2>&dArr; Avec appel de fonction au lieu de fonction anonyme &dArr;</h2>
<p id="keyCode2"></p>

<script type="text/javascript">
	var keyCode2 = document.getElementById('keyCode2');
	
	function lectureFrappe(oEvent)
	{
		keyCode2.innerHTML = 'KeyUp avec keyCode: ' + oEvent.keyCode;	
	}

	document.addEventListener('keyup', lectureFrappe, false);
</script>

<h3>Bloquer l'action par défaut de certains événements</h3>
<p>
    Eh oui, on y revient! Nous avons vu qu'il est possible de bloquer l'action par défaut de certains événements, comme la redirection d'un lien vers une page web. Sans le DOM-2, cette opération était très simple vu qu'il suffisait de jouer avec le <strong>return</strong>. Avec l'objet <strong>Event</strong>, c'est tout aussi simple vu qu'il suffit juste d'appeler la méthode <strong>preventDefault()</strong>!
</p>
<p>
    Reprenons l'exemple que nous avions utilisé pour les événements sans le DOM et utilisons cette méthode
</p>

<pre>
&lt;a id=&quot;testLink&quot; href=&quot;http://www.lesiteduzero&quot;&gt;Cliquez-moi!&lt;/a&gt;

&lt;script type=&quot;text/javascript&quot;&gt;
    var testLink = document.getElementById('testLink');

    testLink.addEventListener('click', function(e){
                        e.preventDefault();//annule l'événement par défaut
                        alert('Vous avez cliqué sur:' + e.target.id);
                    }, false);
&lt;/script&gt;
</pre>

<h2>&dArr; Rien ne vaut la pratique &dArr;</h2>
<a id="testLink" href="http://www.lesiteduzero">Cliquez-moi!</a>

<script type="text/javascript">
    var testLink = document.getElementById('testLink');

    testLink.addEventListener('click', function(e){
                        e.preventDefault();//annule l'événement par défaut
                        alert('Vous avez cliqué sur: "' + e.target.innerHTML + '"');
                    }, false);
</script>

<cite>
    IE < v.9, comme d'hab...!!! Pour IE, il va falloir utiliser la propriété <strong>returnValue</strong> et lui attribuer la valeur <span style="color: green; font-weight: bold;">false;</span> pour bloquer l'action par défaut.
</cite>
<p>
    Pour avoir donc un code compatible entre tous les navigateurs, utilisez donc ceci:
</p>

<pre>
e.returnValue = false;
if(e.preventDefault)
{
    e.preventDefault();
}
</pre>

<a name="part_12"></a>
<h1>Déclencher soi-même les événements <span><a href="#">top</a></span></h1>
<p>
    Nous allons aborder ici une partie assez avancée sur l'utilisation des événements: leur déclenchement manuel, sans intervention de l'utilisateur! Enfin nous allons surtout aborder leur déclenchement quand on les utilise avec le DOM-2.
</p>
<p>
    En effet, alors qu'il est plutôt simple d'exéuter manuellement un événement DOM-0 en écrivant, par exemple <em>el.onclick();</em>, il est plus compliqué de le faire en DOM-2 pour la simple et bonne raison qu'il faut gérer les valeurs à passer à l'objet <strong>Event</strong> lors de l'exécution de l'événement.
</p>
<h2>La procédure standard</h2>
<p>
    Alors comment s'y prendre avec le DOM-2? Tout d'abord il nous faut deux méthodes: <strong>createEvent()</strong> et <strong>dispatchEvent()</strong>. La première permet, comme son nom l'indique, à créer l'événement fictif. La seconde quant à elle, l'applique à un élément HTML.
</p>
<p>
    Comme vous le savez déjà, certains événements possèdent des attributs dans l'objet <strong>Event</strong> qui sont spécifiques à leur propre utilisation, par exemple, l'événement <strong>kepress</strong> qui possède l'attribut <strong>keyCode</strong> et <strong>which</strong>. Afin de gérer des différences entre chaque événement, ceux-ci sont classés par modules, ainsi nous retrouvons le événements <strong>keypress, keyup ou keydown</strong> dans un seul et même modules puisque ces trois événements ont des attributs et méthodes identiques.
</p>
<p>
    Ces modules sont au nombre de 5, mais nous n'allons en étudier que 4, ci-après:
</p>
<ol>
    <li style="padding-bottom: 10px;">
        <u>Events</u>:
        <br/>
        Module général. Il englobe tous les événements existants mais ne permet pas de gestion affinée pour les événements possédant des caractéristiques particulières.
    </li>
    <li style="padding-bottom: 10px;">
        <u>HTMLEvents</u>:
        <br/>
        Sous-modules de <strong>Events</strong>, il est dédié aux modifications HTML. Nous y trouverons les événements <strong>abort, blur, focus, change, error, load, reset, resize, scroll, select, submit, unload</strong>.
    </li>
    <li style="padding-bottom: 10px;">
        <u>UIEvents</u>:
        <br/>
        Sous-module de <strong>Events</strong>, il est dédié à l'interface utilisateur. Il gère les événements <strong>DOMActivate, DOMFocusIn, DOMFocusOut</strong> et, par extension, les événements <strong>keypress, keyup, et keydown</strong>. Ces trois derniers événements possèdent un module qui leur est propre dans les spécifications du DOM-3 mais pas dans le DOM-2, donc par défaut ils sont accesibles depuis le module UIEvents.
    </li>
    <ul>
        <li style="list-style: square;">
            <u>MouseEvents</u>:
            <br/>
            Sous-module de <strong>UIEvents</strong>, il est dédié à la gestion de la souris. Il gère les événements <strong>click, mouseout, mouseover, mousemove, mousedown et mouseup</strong>. L'événement <strong>dblclick</strong> n'est pas supporté.
        </li>
    </ul>
</ol>
<p>
    Le cinquième module se nomme <strong>MutationEvents</strong> mais il reste un peu inutile en raison de son implémentation hasardeuse et de son utilisation extrêmement faible.
</p>
<cite>
    <span style="padding-left: 5px; font-weight: 600; font-style: normal;">Très bien, je sais qu'il existe des modules, mais ils servent à quoi?</span>
    <br/>
    <span style="padding-left: 5px;">&rArr; Chacun de ses modules peut être passé en paramètre à la méthode <strong>createEvent()</strong>, de cette manière:</span>
</cite>
<pre>
<span style="color: darkred;">//On crée un événement classé dans le module Events et on le renvoie dans la variable <span style="font-weight: 600;">fakeEvent</span>:</span>
    var fakeEvent = document.createEvent('Events');
</pre>

<p>
    Une fois l'événement créé, nous allons pouvoir l'initialiser de la manière suivante:
</p>

<pre>
    fakeEvent.initEvent('focus', false, false);
</pre>

<p>
    Comme vous pouvez le contater, nous avons ici utilisé la méthode <strong>initEvent()</strong>, celle-ci est associée au modules <strong>Events</strong> et <strong>HTMLEvents</strong>. Chaque module possède sa propre méthode d'initialisation, voici un tableau récapitualtif avec les liens vers la documentation de Mozilla:
</p>
<table> 
        <tr> 
            <th>Module</th> 
            <th>Méthode associée</th> 
        </tr>

        <tr> 
            <td class="style4">Events</td> 
            <td><a href="https://developer.mozilla.org/en/DOM/event.initEvent">initEvent()</a></td> 
        </tr>
        <tr> 
            <td class="style4">HTMLEvents</td> 
            <td><a href="https://developer.mozilla.org/en/DOM/event.initEvent">initEvent()</a></td> 
        </tr>
        <tr> 
            <td class="style4">UIEvents</td> 
            <td><a href="https://developer.mozilla.org/en/DOM/event.initUIEvent">initUIEvent()</a></td> 
        </tr>
        <tr> 
            <td class="style4">MouseEvents</td> 
            <td><a href="https://developer.mozilla.org/en/DOM/event.initMouseEvent">initMouseEvent()</a></td> 
        </tr>
</table>

<cite>
    Si vous avez consulté les liens que j'ai fourni ci-dessus, vous constaterez que chacune de ces méthodes possède des arguments différents, ces arguments sont, pour la plupart d'entre eux, les attributs que vous retrouverez dans l'objet <strong>Event</strong> lorsque votre événement sera exécuté.
    Ainsi pour la méthode <strong>initMouseEvent</strong> nous voyons qu'il existe des arguments nommés <strong>clientX</strong> et <strong>clientY</strong>! Oui ce sont bien les attributs de l'objet <strong>Event</strong> qui définissent la position du curseur.
    Si vous avez bien suivi, vous pouvez maintenant en déduire qu'un événement fictif, en plus de déclencher l'événement souhaité, permet de faire passer des informations personnalisées comme la position du curseur ou d'autres choses.
</cite>

<p>
    Bien maintenant détaillons l'utilisation de chacune de ces méthodes:
</p>

<h2>initEvent</h2>
<pre>
initEvent(<span style="color: darkgreen;">1</span> type, <span style="color: darkred;">2</span> canBubble, <span style="color: darkviolet;">3</span> cancelable);
</pre>

<ol>
    <li>
        Le type d'événement <em>[fous, blur, ...]</em>
    </li>
    <li>
        Si la phase de bouillonnement doit se déclencher
    </li>
    <li>
        Si l'événement peut être annulé ou non <em>[preventDefault()]</em>
    </li>
</ol>
<cite>
    Cette méthode peut servir à initialiser tous les événements existants, mais vous ne pourrez pas personnaliser certaines valeurs spécifiques à quelques événements comme la position du curseur par exemple.
    <br />
    Au passage NOTEZ bien que cette méthode s'utilise avec DEUX modules différents: <strong>Events</strong> et <strong>HTMLEvents</strong>.
</cite>

<h2>initUIEvent</h2>

<pre>
initUIEvent(<span style="color: darkgreen;">1</span> type, <span style="color: darkred;">2</span> canBubble, <span style="color: darkviolet;">3</span> cancelable, <span style="color: darkolivegreen;">4</span> view, <span style="color: darkorchid;">5</span> detail);
</pre>

<ol>
    <li>
        Le type d'événement <em>[fous, blur, ...]</em>
    </li>
    <li>
        Si la phase de bouillonnement doit se déclencher
    </li>
    <li>
        Si l'événement peut être annulé ou non <em>[preventDefault()]</em>
    </li>
    <li>
        Il s'agit de lui fournir l'objet associé à notre objet <strong>document</strong>, dans les navigateurs web il s'agit toujours de l'objet <strong>window</strong> et RIEN d'autre.
    </li>
    <li>
        Nous devons normalement lui fournir le nombre de clics effectués par la souris au moment de l'événement, celà paraît stupide mais vu que le module <strong>MouseEvents</strong> est un sous-module de <strong>UIEvents</strong> cela explique la présence de cet argument. Bref pour cet argument contentez-vous de le mettre CONSTAMMENT à <strong>1</strong> (<em>même pour la méthode <strong>initMouseEvent()</strong></em>).
    </li>    
</ol>

<h2>initMouseEvent</h2>
<pre>
initMouseEvent(<span style="color: darkgreen;">1</span> type, <span style="color: darkred;">2</span> canBubble, <span style="color: darkviolet;">3</span> cancelable, <span style="color: darkolivegreen;">4</span> view, <span style="color: darkorchid;">5</span> detail,  <span style="color: darkcyan;">6</span> screenX,  <span style="color: darkgreen;">7</span> screenY,  <span style="color: darkblue;">8</span> clientX,
               <span style="color: darkcyan;">9</span> clientY,  <span style="color: darkgreen;">10</span> ctrlKey,  <span style="color: darkslategrey;">11</span> altKey,  <span style="color: darkred;">12</span> shiftKey,  <span style="color: whitesmoke;">13</span> metaKey,  <span style="color: darkorchid;">14</span> button,  <span style="color: darkorange;">15</span> relatedTarget);
</pre>

<p>
    <strong>Les différents arguments supplémentaires ne SONT PAS FACULTATIFS!</strong>
</p>

<ol>
    <li>
        Le type d'événement <em>[fous, blur, ...]</em>
    </li>
    <li>
        Si la phase de bouillonnement doit se déclencher
    </li>
    <li>
        Si l'événement peut être annulé ou non <em>[preventDefault()]</em>
    </li>
    <li>
        Il s'agit de lui fournir l'objet associé à notre objet <strong>document</strong>, dans les navigateurs web il s'agit toujours de l'objet <strong>window</strong> et RIEN d'autre.
    </li>
    <li>
        Nous devons normalement lui fournir le nombre de clics effectués par la souris au moment de l'événement, celà paraît stupide mais vu que le module <strong>MouseEvents</strong> est un sous-module de <strong>UIEvents</strong> cela explique la présence de cet argument. Bref pour cet argument contentez-vous de le mettre CONSTAMMENT à <strong>1</strong> (<em>même pour la méthode <strong>initMouseEvent()</strong></em>).
    </li>
    <li>
        screenX &amp; screenY définissent la position du curseur par rapport au coin <em><u>suppérieur gauche de l'écran</u></em>
    </li>
    <li>
        clientX &amp; clientY position du curseur par rapport au coin <em><u>suppérieur gauche de la page</u></em>
    </li>
    <li>
        Les quatres éléments suivants sont des booléens et définissent si les touches:
        <ul>
            <li>
                Ctrl
            </li>
            <li>
                Alt
            </li>
            <li>
                Shift
            </li>
            <li>
                "Meta"
            </li>
        </ul>
        Ont été enfoncées.
    </li>
    <li>
        L'argument <strong>button</strong> qui définit quel bouton a été cliqué, la valeur habituelle est à 1
    </li>
    <li>
        L'argument <strong>relatedTarget</strong> dont je ne ré-expliquerai pas le fontionnement, si vous n'en avez pas besoin mettez-le à <span style="color: green;"><strong>null</strong></span>.
    </li>
</ol>

<cite>
    Comme vous avez pu le constater il n'existe aucun argument du style <strong>keyCode</strong> ou <strong>which</strong> dans aucune des méthodes présentées. Cela est dû au fait que les événements liés aux appuis des touches ne sont pas entièrement supportés par le DOM-2.
</cite>

<h3>Revenons à notre événement fictif <strong>fakeEvent</strong></h3>
<pre>
var fakeEvent = document.createEvent('Events');
fakeEvent.initEvent('focus', false, false);
</pre>

<p>
    Maintenant que notre événement est créé ET initialisé, il ne nous reste plus qu'à l'appliquer à un élément HTML qui possède un événement <strong>focus</strong> avec la méthode <strong>dispatchEvent()</strong>:
</p>

<pre>
el.dispatchEvent(fakeEvent); //On applique l'événement fictif nommé "fakeEvent" sur l'élément el
</pre>

<p>
    Et voilà!!!
</p>

<h2>&dArr; Allez à la pratique... &dArr;</h2>
<p>
    Présentation du cas
</p>
<pre>
&lt;input id=&quot;text&quot; type=&quot;text&quot;
value=&quot;Faites moi croire que vous me cliquez avec un curseur en-dehors de la pages =)&quot; 
size = &quot;80&quot;/&gt;

&lt;input type=&quot;button&quot;
value=&quot;Activer l'événement du clique en faisant croire à une position absurde du curseur!&quot; 
onclick = &quot;applyEvent();&quot; /&gt;

&lt;script type=&quot;text/javascript&quot;&gt;
	var text = document.getElementById('text');

	text.addEventListener('click', function(e){
		e.target.value = "La position du curseur par rapport à la page est:\nX = " + e.screenX + "px\n
                Y = " + e.screenY + "px";
	}, false);

        function applyEvent()
        {
            var fakeEvent = document.createEvent('MouseEvents'); //on créé un event du module

            fakeEvent.initMouseEvent('click', false, false, window, 1,
            0, 0, -10000, -10000, false, false, false, false, 0, null);

            text.dispatchEvent(fakeEvent);
        }

&lt;/script&gt;
</pre>


<h3 style="padding-bottom: 5px;">&dArr;Testez le &dArr;</h3>
<p>
  <input id="text" type="text"
value="Faites moi croire que vous me cliquez avec un curseur en-dehors de la pages =)" 
size = "80"/>
  
  <input type="button"
value="Activer l'événement du clique en faisant croire à une position absurde du curseur!" 
onclick = "applyEvent();" />
</p>
<script type="text/javascript">
	var text = document.getElementById('text');

	text.addEventListener('click', function(e){
		e.target.value = "La position du curseur par rapport à la page est:\nX = " + e.clientX + "px\nY = " + e.clientY + "px";
	}, false);

        function applyEvent()
        {
            var fakeEvent = document.createEvent('MouseEvents');

            fakeEvent.initMouseEvent('click', false, false, window, 1, 0, 0, -10000, -10000, false, false, false, false, 0, null);

            text.dispatchEvent(fakeEvent);
        }

</script>

<p>Et voilà! J'admets que mon exemple n'a rien d'incroyable cependant il est relativement explicite et vous suffira pour comprendre les événements fictifs.</p>
<p>Si vous avez testé ce code vous aurez sûrement remarqué que lorsque vous cliquez sur le champs texte le focus lui est donné, en revanche ce n'est pas le cas lorsque vous déclenchez l'événement fictif. Pourquoi? Cela fait parti de la sécurité, si vous déclenchez manuellement un événement (avec un événement fictif bien sûr) alors l'action par défaut de l'événement ne s'exécutera pas... Il est donc, par exemple, impossible de simuler un clique sur un champ de file ou autre.</p>
<cite>La suite présente la procédure selon IE &lt; v9... car encore une fois il faut gérer l'exception &quot;Internet Explorer&quot;. Cependant la façon de faire d'IE n'est pas mauvaise non plus, la méthode qu'il utilise n'exige pas une flopée d'arguments pour pouvoir fonctionner.</cite>