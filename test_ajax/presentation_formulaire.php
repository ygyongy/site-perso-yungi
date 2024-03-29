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
            
            <h3>&dArr; Alors testons &dArr;</h3>
            <div id="radioButton">
                <label><input type="radio" name="check" value="1" /> Case n° 1</label>
                <label><input type="radio" name="check" value="2" /> Case n° 2</label>
                <label><input type="radio" name="check" value="3" /> Case n° 3</label>
                <label><input type="radio" name="check" value="4" /> Case n° 4</label>
                <br /><br />
                <input type="button" value="Vérifier la valeur" onclick="check()" />
                
                <script type="text/javascript">
                    function check()
                    {
                        var inputs = document.getElementById('radioButton').getElementsByTagName('input');
                        var inputsLength = inputs.length;
 
                        for (var i = 0; i < inputsLength; i++)
                        {
                            if (inputs[i].type === 'radio' && inputs[i].checked)
                            {
                                alert('La case cochée est la N° ' + inputs[i].value);
                            }
                        }
                        
                    }
                </script>
            </div>
            
            <h2>Les listes déroulantes avec: <strong>selectedIndex</strong> et <strong>options</strong></h2>
            <p>
                Les listes déroulantes possèdent elle aussi leurs propres attributs. Nous allons en retenir seulement deux parmi tous ceux qui existent: <strong>selectedIndex</strong>, qui nous donne l'index (l'identifiant) de la valeur sélectionné, et <strong>options</strong> qui liste dans un tableau les éléments <strong style="color: orange;">&lt;option&gt;</strong> de notre liste déroulante. Leur principe de fonctionnement est on ne peut plus classique:
            </p>
            <pre>
&lt;select id="list"&gt;
    &lt;option&gt;Sélectionnez votre sexe&lt;/option&gt;
    &lt;option&gt;Homme&lt;/option&gt;
    &lt;option&gt;Femme&lt;/option&gt;
&lt;/select&gt;

&lt;script type="text/javascript"&gt;
    var list = document.getElementById('list');

    list.addEventListener('change', function(){
        <span style="color: hotpink;">//On affiche le contenu de l'élément &lt;option&gt; ciblé par la propriété selectedIndex
        //On passe par la collection "OPTIONS" en lui spécifiant un index de tableau</span>
        alert(list.options[list.selectedIndex].value);
    }, true);

&lt;/script&gt;
            </pre>
            <h3>&dArr; Allez on vérifie &dArr;</h3>
            <div>
                <br />
                <select id="list_test">
                    <option>Sélectionnez votre sexe</option>
                    <option>Homme</option>
                    <option>Femme</option>
                </select>

                <script type="text/javascript">
                    var list = document.getElementById('list_test');
                    var message = document.createElement('span');
                        message.setAttribute('style', 'border: green 2px solid; padding-left: 5px; padding-right: 5px; -webkit-border-radius: 5px; margin-left: 1px; margin-top: 7px;');
                    var txt_content = document.createTextNode('');
                    var txt_strong = document.createElement('strong');
                    
                    list.addEventListener('change', function(){
                        //On affiche le contenu de l'élément <option> ciblé par la propriété selectedIndex
                        //On passe par la collection "OPTIONS" en lui spécifiant un index de tableau
                        txt_content.data = list.options[list.selectedIndex].value + ' ';
                        
                        list.parentNode.appendChild(message).appendChild(txt_strong).appendChild(txt_content);
                    }, true);

                </script>            
            </div>


<a name="part_30"></a>
        <h1>Les méthodes et un retour sur quelques évènements <span><a href="#">top</a></span></h1>
            <p>
                Les formulaires ne possèdent pas que des attributs mais aussi des méthodes dont certaines sont bien pratiques! Tout en abordant leur utilisations, nous en profiterons pour revenir sur certains évènements étudiés au chapitre précédent.
            </p>
            
            <h2>Les méthodes spécifiques à l'élément <strong>&lt;form&gt;</strong></h2>
            <p>
                Un formulaire, ou plus exactement l'élément <strong>form</strong>, possède deux méthodes intéressantes. La première, <strong>submit()</strong>, permet d'effectuer l'envoi du formulaire sans l'intervention de l'utilisateur. La deuxième, <strong>reset()</strong>, permet de réinitialiser tous les champs d'un formulaire.
            </p>
            <p>
                Si vous êtes un habitué des formulaire HTML, vous aurez deviné que ce deux méthodes ont le même rôle que les éléments <strong>input</strong> de type <strong>submit</strong> ou <strong>reset</strong>.
            </p>
            <p>
                L'utilisation de ces deux méthodes es simple comme bonjour, il vous suffit juste de les appeler sans aucun paramètre (elles n'en ont pas) et c'est fini:
            </p>
            
            <pre>
var element = document.getElementById('un_id_formulaire');

    element.submit(); //Le formulaire est expédié
    element.reset(); //Le formulaire est réinitialisé
            </pre>
            
            <p>
                Maintenant revenons sur deux évènements: <strong>submit</strong> et <strong>reset</strong>, encore les mêmes noms! Je suppose qu'il n'y a pas besoin de vous expliquer quand est-ce que l'un et l'autre se déclenchent, cela paraît évident. Cependant, il eset important de préciser une chose: envoyer un formulaire avec <u>la méthode <strong>submit()</strong> de JavaScript ne déclenchera jamais l'évènement <strong>submit</strong></u>! Mais, dans le doute, voici un exemple complet dans le cas où vous n'auriez pas tout compris:
            </p>
            
            <pre>
&lt;form id="myForm"&gt;
    &lt;input type="text" value="Entrez un texte..." /&gt;
    &lt;br/&gt;&lt;br/&gt;
    &lt;input type="submit" value="Submit!"/&gt;
    &lt;input type="reset" value="Reset !"/&gt;
&lt;/form&gt;

&lt;script type="text/javascript"&gt;
    var myForm = document.getElementById('myForm');
    
    myForm.addEventListener('submit', function(e){
        alert('Vous avez envoyé le formulaire!\n\nMais celui-ci a été bloqué pour que vous ne changiez pas de page.');
        e.preventDefault();
    }, true);
    
    myForm = document.addEventListener('reset', function(e){
        alert('Vous avez réinitialisé le formulaire!');
    }, true);
&lt;/script&gt;    
            </pre>
            
            <h3>&dArr; Essayons &dArr;</h3>
            <div>
                <form id="myForm" style="margin-top: 10px; margin-left: 15px;">
                    <input type="text" value="Entrez un texte..." />
                    <br/><br/>
                    <input type="submit" value="Submit!"/>
                    <input type="reset" value="Reset !"/>
                </form>

                <script type="text/javascript">
                    var myForm = document.getElementById('myForm');

                    myForm.addEventListener('submit', function(e){
                        alert('Vous avez envoyé le formulaire!\n\nMais celui-ci a été bloqué pour que vous ne changiez pas de page.');
                        e.preventDefault();
                    }, true);

                    myForm = document.addEventListener('reset', function(e){
                        alert('Vous avez réinitialisé le formulaire!');
                    }, true);
                </script>                   
            </div>
            
            <h2>La gestion du focus et de la sélection</h2>
            <p>
                Vous vous souvenez des évènements pour détecter l'activation ou la désactivation du focus sur un élément? Eh bien il existe aussi deux méthodes, <strong>focus()</strong> et <strong>blur()</strong>, permettant respectivement de donner et retirer le focus à un élément. Leur utilisation est très simple:
            </p>
            <pre>
&lt;input id="text_focus" type="text" value="Entrez un texte" /&gt;

&lt;input type="button" value="Donner le focus" onclick="document.getElementById('text_focus').focus()" /&gt;
&lt;input type="button" value="Retirer le focus" onclick="document.getElementById('text_focus').blur()" /&gt;
            </pre>
            
            <h3>&dArr; Le test... :-) &dArr;</h3>
            <div>
                <form id="myForm" style="margin-top: 10px; margin-left: 15px;">
                    <input id="text_focus" type="text" value="Entrez un texte..." />
                    <br/><br/>
                    <input type="button" value="Donnez le focus!" onclick="document.getElementById('text_focus').focus()"/>
                    <input type="button" value="Retirez le focus!" onclick="document.getElementById('text_focus').blur()"/>
                </form>                  
            </div>
            
            <cite>
                Dans le même genre, il existe la méthode <strong>select()</strong> qui, en plus de donner le focus à l'élément, sélectionne le texte de celui-ci si cela est possible:
            </cite>
            
            <pre>
&lt;input type="text" id="text_focus_2" value="Entrez un texte" /&gt;

&lt;input type="button" value="Sélectionner le texte" onclick="document.getElementById('text_focus_2').select()" /&gt;
            </pre>
            
            <h3>&dArr; Testons gaiement... &dArr;</h3>
            <div>
                <form id="myForm" style="margin-top: 10px; margin-left: 15px;">
                    <input id="text_focus_2" type="text" value="Entrez un texte..." />
                    <br/><br/>
                    <input type="button" value="Sélectionnez le texte" onclick="document.getElementById('text_focus_2').select()"/>
                </form>                  
            </div>
            <cite>
                Bien sûr cette méthode ne fonctionne QUE sur des champs de texte comme un <strong>input</strong> de type <strong>texte</strong> ou bien en <strong>textarea</strong>!
            </cite>
            
            <h2>Explication sur l'évènement <strong>&laquo; change &raquo;</strong></h2>
            <p>
                Je pense qu'il est important de revenir sur cet événement afin de clarifier quelques petits problèmes que vous pourrez rencontrer en l'utilisant.
                Tout d'abord, il est bon de savoir que cet événement attend que l'élément auquel il est rattaché perde le <strong>focus</strong> avant de se déclencher (si il a eu modification du contenu de l'élément). Donc, si vous souhaitez vérifier l'état d'un input à chacune de ses modifications sans attendre la perte de <strong>focus</strong>, il vous faudra plutôt utiliser d'autres événements du style <strong>keyup</strong> (et ses variantes) ou <strong>click</strong>, cela dépend du type d'élément vérifié.
                <br/>
                Et, deuxième et dernier point, cet événement est bien entendu utilisable sur n'importe quel <strong>input</strong> dont l'état peut changer, par exemple une <strong>checkbox</strong> ou un <strong>input file</strong>, n'allez surtout pas croire que cet événement est réservé seulement aux champs texte!
            </p>