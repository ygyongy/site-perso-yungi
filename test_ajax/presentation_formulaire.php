<a href="#part_29">Les Attributs</a> | <a href="#part_30">Retour sur quelques évènements</a>
        <cite>
            Les formulaires sont simples a utiliser, cependant il faut d'abord mémoriser quelques attributs de base. Comme vous le savez déjà. il es possible d'accéder à 'importe quel attribut d'un élément HTML, et ceci, juste en tapant son nom, il en va donc de même pour des attributs spécifiques aux éléments d'un formulaire comme <strong>value, disabled, checked, et autres...</strong> Nous allons voir ici comment utiliser ces attributs spécifiques aux formulaires.
        </cite>
<a name="part_29"></a>
        <h1>Les Attributs<span><a href="#">top</a></span></h1>
            <p>
                Commençons par l'attribut le pus connu et le plus utilisé: <strong>value</strong>! Pour ceux qui ne se souviennent pas, cet attribut permet de définir une valeur à différents éléments d'un formulaire comme les <strong>input</strong>, les <strong>button</strong>, etc...
            </p>
            <p>
                Son fonctionnement est simple comme bonjour, on lui assigne une valeur (un nombre ou une chaîne de caractères) et elle est immédiatement affichée sur votre élément HTML, exemple:
            </p>            
            <pre>
&lt;input id="text" type="text" size="60" value="Vous n'avez pas le focus!" /&gt;

&lt;script type="text/javascript"&gt;
    var text = document.getElementById('text');

    text.addEventListener('focus', function(e){
                            e.target.value = "Vous avez le focus!";
                        }, true);

    text.addEventListener('blur', function(e){
                            e.target.value = "Vous n'avez plus le focus!";
                        }, true);
&lt;/script&gt;
            </pre>
            
            <h3>&dArr; La preuve... &dArr;</h3>
            <blockquote id="myBlock2">
            	<input type="text" id="sansFocus" value="Vous n'avez pas le focus!" size="60"/>
            </blockquote>
            <script type="text/javascript">
                var text = document.getElementById('sansFocus');
                
                text.addEventListener('focus', function(e){
                    e.target.value = "Vous avez le focus!";
                    e.target.setAttribute('style', 'border: 3px green solid;');
                }, true);
                
                text.addEventListener('blur', function(e){
                    e.target.value = "Vous n'avez plus le focus!";
                    e.target.setAttribute('style', 'border: 1px red solid;');
                }, true);                
            </script>
            
            <cite>
                Alors par contre, une petite précision! Cet attribut s'utilise aussi avec un <strong>textarea</strong>! En effet, en HTML, on prend souvent l'habitude de mettre du texte dans un textarea en écrivant:
            </cite>
            
            <pre>
&lt;textarea&gt;Et voilà du texte!!!&lt;/textarea&gt;
            </pre>
            
            <p>
                Du coup, en Javascript, on est souvent tenté d'utiliser <strong>innerHTML</strong> pour récupérer le contenu de notre textarea, cependant cela ne fonctionne pas: IL FAUT UTILISER <strong>value</strong> à la place.
            </p>
            
            
            <h2>Les booléens avec: disabled, checked et readonly</h2>
            <p>
                Contrairement à l'attribut <strong>value</strong>, les trois attributs <strong>disabled, cheecked et readonly</strong> ne s'utilisent pas de la même manière qu'en xHTML... où il vous suffit d'écrire, par exemple:<br />
                &CircleDot; <strong>&lt;input type="text" disabled="<span style="color: red;">disabled</span>"&gt;</strong><br />
                En JavaScript, ces trois attributs deviennent des <i>booléens</i>. Ainsi, il vous suffit de faire comme ceci pour désactiver un champ de texte:<br />
            </p>
            <pre>
&lt;input type="text" id="text"&gt;

&lt;script&gt;
    var text = document.getElementById('text');
        text.disabled = true;
&lt;/script&gt;
            </pre>
            <p>
                Je ne pense pas qu'il soit nécessaire de vous expliquer comment fonctionne l'attribut <strong>checked</strong> avec  une checkbox, il suffit d'opérer de la même manière qu'avec l'attribut <strong>disabled</strong> ci-dessus. En revanche, je préfère détaillé son utilisation avec les boutons de type <strong>radio</strong>. Chaque bouton radio coché se verra attribuer la valeur <strong style="color: green;">true</strong> à son attribut <strong>checked</strong>, il va donc nous falloir utiliser une boucle <strong style="color: green;">for</strong> pour vérifier quel bouton <strong>radio</strong> a été sélectionné:
            </p>
            <pre>
&lt;label&gt;&lt;input type="radio" name="check" value="1" /&gt; Case n° 1&lt;/label&gt;
&lt;label&gt;&lt;input type="radio" name="check" value="2" /&gt; Case n° 2&lt;/label&gt;
&lt;label&gt;&lt;input type="radio" name="check" value="3" /&gt; Case n° 3&lt;/label&gt;
&lt;label&gt;&lt;input type="radio" name="check" value="4" /&gt; Case n° 4&lt;/label&gt;

&lt;script&gt;
    function check()
    {
        var inputs = document.getElementsByTagName('input');
            inputsLength = inputs.length;

            for(var i = 0; i < inputsLength; i++)
            {
                if(inputs[i].type === 'radio' && inputs[i].checked)
                {
                    alert('La case cochée est la N° ' + inputs[i].value);
                }
            }
    }
&lt;/script&gt;
            </pre>
            <cite>
            	Puisqu'il n'est pas nécessaire de mentionner l'objet <strong>window</strong>, on ne le fait généralement pas sauf si cela est nécessaire, par exemple dans la manipulation des <em>frames</em>.
            </cite>



<a name="part_30"></a>
        <h1>Le Document Object Model <span><a href="#">top</a></span></h1>
            <p>
                le DOM est une interface de programmation pour les documents XML et HTML.
            </p>
            <cite>
                Une interface de programmation, qu'on appelle aussi une API (Appllication Programming Interface), est un ensemble d'outils qui permettent de faire communiquer entre eux plusieurs programmes ou, dans le cas présent, différents langages. Le terme API reviendra souvent, quel que soit le langage de programmation que vous apprendrez.
            </cite>
            <p>
                Le DOM est donc une <strong>API</strong> qui s'utilise avec les documents XML et HTML, et qui va nous permettre, via JS, d'accéder au code XML et/ou HTML d'un document. C'est grâce au DOM que nous allons pouvoir modifier les <em>éléments HTML</em> [afficher ou masquer un DIV par exemple], en ajouter, en déplacer ou même en supprimer.
            </p>
            <p>
            	Petite note de vocabulaire: dans un cours sur le HTML, on parlera de balises HTML. Ici nous parlerons <em>éléments HTML</em>, pour la simple et bonne raison que chaque paire de balises est vue comme un objet.
            </p>
            <p>
            	Un document HTML est représenté sous la forme d'un arbre, ou d'une structure hiérarchique. Ainsi l'élément <strong>&lt;html&gt;</strong> contient DEUX éléments <strong>&lt;head&gt;, &lt;body&gt;</strong>, qui eux alors tour contiennent des éléments HTML.
            </p>
            <p>
            	Puis le DOM 2 est arrivé, la grande nouveauté de cette nouvelle version est l'arrivée de la méthode <strong>getElementById()</strong> qui permet de récupérer soit du XML soit du HTML.
            </p>
            
            <h2>L'objet <strong>Window</strong></h2>
<p>
            	Avant de véritablement parler du <strong>document</strong>, c-à-d la page Web, nous allons parler de l'objet <strong>window</strong>. Cet objet est ce que l'on appel un objet global qui représente <u>la fenêtre du navigateur</u>. C'est depuis l'objet <strong>window</strong> que le JavaScript est exécuté.<br />
				<br/>
                Contrairement à ce qui a été dit dans ce cours, <strong>alert()</strong> n'est pas vraiment une fonction. Il s'agit en réalité d'une méthode appartenant à l'objet <strong>window</strong>. Mais l'objet <strong>window</strong> est dit implicite, c-à-d qu'il n'y a généralment pas besoin de l'appeler.
</p>
            <cite>
            	Puisqu'il n'est pas nécessaire de mentionner l'objet <strong>window</strong>, on ne le fait généralement pas sauf si cela est nécessaire, par exemple dans la manipulation des <em>frames</em>.
            </cite>