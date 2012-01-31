<a href="#part_19">Le Document Object Model</a> | <a href="#part_20">Naviguer dans le Document</a> | <a href="#part_21">Editer les éléments HTML</a> | <a href="#part_22">InnerText &amp; textContent</a>
        <cite>
            Nous allons voir le concept du DOM et comprendre comment naviguer entre les différents noeuds qui composent une page HTML. Il sera aussi question d'éditer le contenu et les attributs des éléments HTML, avant la deuxième partie.
        </cite>
<a name="part_19"></a>
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
            	Petite note de vacabulaire: dans un cours sur le HTML, on parlera de balises HTML. Ici nous parlerons <em>éléments HTML</em>, pour la simple et bonne raison que chaque paire de balises est vue comme un objet.
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
            <h2>Le Document</h2>
            <p>
            	L'objet <strong>document</strong> est un sous-objet de <strong>window</strong>, et surtout l'un des plus utilisés. Et pour cause il représente la page <em>Web</em>, ce que l'internaute voit dans son navigateur.
                C'est grâce à cet élément là que nous allons pouvoir accéder aux éléments HTLM et les modifier. Voyons donc comment y naviguer.
            </p>
            
		<a name="part_20"></a>
        <h1>Naviguer dans le document<span><a href="#">top</a></span></h1>
            <h2>La structure du document</h2>
            <p>
                Comme il a été dit précédemment, le DOM pose comme concept que la page web est vue comme un arbre. On peut doc schématiser une page web simple comme ceci:
                <br />
                <img src="image/261648.png" title="arbre de document" alt="arbre de document" />
            </p>
            <h3>Voici le code de ce schéma</h3>
            <pre>
&lt;!doctype html&gt;
&lt;html&gt;
    &lt;head&gt;
        &lt;meta charset=&quot;utf-8&quot; /&gt;
        &lt;title&gt;Le titre de la page&lt;/title&gt;
    &lt;/head&gt;

    &lt;body&gt;
        &lt;div&gt;
            &lt;p&gt;Un peu de texte&lt;a&gt;et un lien&lt;/a&gt;&lt;/p&gt;
        &lt;/div&gt;
    &lt;/body&gt;
&lt;/html&gt;           	
            </pre>
            
<p>
            	Le schéma est plutôt simple: l'élément &lt;HTML&gt; contient deux élément appelés <strong>enfants</strong>: <strong>&lt;head&gt;, &lt;body&gt;</strong>. Pour ces deux enfants <strong>&lt;html&gt;</strong> est un <strong>parent</strong>. Chaque élément est appelé <strong>noeud</strong>. L'élément <strong>head</strong> contient lui aussi deux enfants: <strong>&lt;meta&gt;, &lt;title&gt;</strong>. <strong>Meta</strong> ne contient pas d'enfant tandis que <strong>title</strong> oui, et il s'appel <strong>#text</strong>.
</p>
            <cite>
            	C'est important de bien saisir cette notion: le texte présent dans une page web est vu par le DOM comme un <strong>node</strong> ou <strong>noeud</strong> de type <em>#text</em>. Dans l'exemple ci-dessus le paragraphe montre bien qu'il contient aussi un noeud de type #text <strong>&amp;</strong> un <strong>lien</strong>.
            </cite>
            <pre>&lt;p&gt;<br />	Un peu de texte<br />	&lt;a&gt;<br />		un lien<br />	&lt;/a&gt;<br />&lt;/p&gt;
            </pre>
            <h2>Accéder aux éléments</h2>
            
			<p>L'accès aux éléments HTML via le DOM est assez simple, mais demeurre, actuellement, plutôt limité. L'objet document possède deux méthodes principales: <strong>getElementById()</strong> et <strong>getElementsByTagName()</strong>.</p>
			<cite>Faîtes très attention à cette méthode: il y a un <strong>s</strong> à <strong>Elements</strong></cite>
            <p>
            	Cette méthode permet de récupérer, sous la forme d'un tableau tous les éléments de la famille. Si dans une page on veut récupérer tous les <strong>&lt;div&gt;</strong>, il suffit de faire comme ceci:</p>
            <pre>var divs = document.getElementsByTagName('div');
for(i = 0, c = divs.length; i &lt; c; i++)
{
	alert('Element n° '+ (i + 1) +':'+ divs[i]);
}

</pre>
<cite>Deux petites astuces:<br />
1/ Cette méthode est accessible sur n'importe quel élément HTML, et non pas seulement sur le document.<br />
2/ En paramètre de cette méthode vous pouvez mettre une chaîne de caractères contenant une astérisque "*" qui récupérera tous les éléments HTML.
</cite>
<h2>&dArr; Un petit exemple de '*'</h2>
<div id="liste_elementHTML" style="cursor: pointer;">
	Cliquez ici!
</div>
<script type="text/javascript">
	var liste_elementHTML = document.getElementById('liste_elementHTML');
	liste_elementHTML.addEventListener('click', printHTML, false);
	
	function printHTML()
	{
		elements = document.getElementsByTagName('*');
		var element = '';
		for(i = 0, c = elements.length; i < c; i++)
		{
			if (i < 20)
			{
				element += "Element N° : " + (i+1) + ":" + elements[i] + "\n";
			}else{
				element += '...';
				break;
			}
		}
		
		alert(element);
	}
</script>

<h3>
getElementsByName
</h3>
<p>
	Cette méthode est semblable à <strong>getElmentsBy<u>Tag</u>Name</strong> et permet de ne récupérer que les éléments qui possèdent un attribut name que vous spécifiez. L'attribut name n'est utilisé qu'au sein des formulaires. et est déprécié depuis la spécification HTML 5 dans tout autre élément que celui d'un formulaire. Par exemple, vous pouvez vous en servir pour un élément <strong>&lt;input&gt;</strong> mais par pour un élément <strong>&lt;map&gt;</strong>.
</p>

<h2>Accéder aux éléments grâce aux technologies récentes</h2>
<p>
	Ces dernières années, le Javascript a beaucoup évolué pour faciliter les développement web. Les deux méthodes que nous allons étudier ci-dessous sont récentes et ne sont pas supportées par les vieilles versions des navigateurs, attendez-vous donc à ne pas pouvoir vous en servir aussi souvent que vous le souhaiteriez malgré leur côté pratique. vous pouvez consulter le tableaux des compatibilités sur le MDN.
</p>
<p>
	Ces deux méthodes sont <strong>querySelector()</strong> et <strong>querySelectorAll()</strong> et ont pour particularité de grandement simplifier la sélection d'éléments dans l'arbre DOM grâce à leur mode de fonctionnement. Ces deux méthodes prennent pour paramètre un seul argument: <u>"une chaîne de caractères!"</u>
</p>

<p>
	Cette chaîne doit être un sélecteur CSS comme ceux que vous utilisez dans vos feuilles de style. Exemple: <em>#men</em> <strong>.item span</strong>
</p>

<p>
	Voyons maintenant les particularités de ces deux méthodes. La première <strong>querySelector()</strong>, renvoie le 1er élément trouvé correspondant au sélecteur CSS, tandis que la deuxième nous renvoie <u>tous</u> les éléments sous forme de tableau.
</p>
<pre>
&lt;div id=&quot;menu&quot;&gt;

	&lt;div class=&quot;item&quot;&gt;
		&lt;span&gt;Elément_1&lt;/span&gt;
		&lt;span&gt;Elément_2&lt;/span&gt;
	&lt;/div&gt;

	&lt;div class=&quot;publicite&quot;&gt;
		&lt;span&gt;Elément_3&lt;/span&gt;
		&lt;span&gt;Elément_4&lt;/span&gt;
	&lt;/div&gt;
&lt;/div&gt;

</pre>

<p>
	Maintenant, essayons le sélecteur CSS présenté plus haut: <em>#menu</em> <strong>.item span</strong>.
</p>
<pre>
var query = document.querySelector('#menu .item span');
	queryAll = document.querySelectorAll('#menu .item span');
    
    alert(query.innerHTML);
    
    alert(queryAll.length);
    alert(queryAll[0].innerHTML + ' - ' + queryAll[1].innerHTML);
    
</pre>
<p>
	Nous obtenons bien les résultats escomptés! Je vous conseille de bien vous rappelez de ces deux méthodes. Elles sont déjà utiles sur des projets voués à tourner sur des navigateurs récents, et d'ici quelques années elles risquent bien de devenir habituelles (le temps que les vieilles versions d'IE disparaissent pour de bons).
</p>

<h2>&dArr; Testons... &dArr;</h2>
<div id="menu">

	<div class="item">
		<span>Elément_1</span>
		<span>Elément_2</span>
	</div>

	<div class="publicite">
		<span>Elément_3</span>
		<span>Elément_4</span>
	</div>
</div>

<input type="button" id="showMenu" value="show menu" />

<script type="text/javascript">
	var el = document.getElementById('showMenu');
	
	el.addEventListener('click', showMenu, false);
	
	function showMenu()
	{
		var query = document.querySelector('#menu .item span');
			queryAll = document.querySelectorAll('#menu .item span');
			
			alert("querySelector: " + query.innerHTML);
			
			alert("querySelectorAll length: " + queryAll.length);
			alert("querySelectorAll items: \n - " + queryAll[0].innerHTML + '\n - ' + queryAll[1].innerHTML);	
	}
</script>

<h2>L'héritage des propriétés et des méthodes</h2>
<p>
	Javascript voit les éléments HTML comme étant des objets, cela veut dire que chaque élément HTML possède des propriétés et des méthodes. Cependant faites bien attention parce que tous ne possèdent pas les mêmes propriétés et méthodes. Certaines sont néanmoins communes à tous les éléments HTML, car tous les éléments HTML sont d'un même type: le type <strong>Node</strong>.
</p>
<h3>Notion d'héritage</h3>
<p>
	On a vu qu'un élément <strong>&lt;div&gt;</strong> est un objet <strong>HTMLDivElement</strong>, mais un objet, en Javascript, peut appartenir à différents groupes. Ainsi, notre <strong>&lt;div&gt;</strong> est un élément <strong>HTMLDivElement</strong>, qui est un sous-objet d'<strong>HTMLElement</strong> qui est lui-même un sous-objet d'<strong>Element</strong>. <strong>Element</strong> est enfin un sous-objet de <strong>Node</strong>.
</p>
<p style="text-align: center;">
	<img src="image/263780.png" />
</p>
<p>
	L'objet <strong>Node</strong> apporte un certain nombre de propriétés et de méthodes qui pourront être utilisées depuis un de ses sous-objets. En clair, les sous-objets <u>héritent</u> des propriétés et méthodes de leurs objets parents.
</p>

<a name="part_21"></a>
<h1>Editer les éléments HTML <span><a href="#">top</a></span></h1>
<p>
	Maintenant que nous avons vu comment accéder à un élément, nous allons voir comment l'éditer. Les éléments HTML sont souvent composés d'attributs (l'attribut href d'un <strong>&lt;a&gt;</strong> par exemple), et d'un contenu, qui est de type <em>#text</em>. Le contenu peut aussi être un autre élément HTML.
</p>

<h2>Les Attributs</h2>

<h3>Via l'objet Element</h3>
<p>
	Pour intéragir avec les attributs, l'objet <strong>Element</strong> nous fournit deux méthodes, <strong>getAttribute()</strong> et <strong>setAttribute()</strong> permettant respectivement de récupérer et d'éditer un attribut. Le premier paramètre est le nom de l'attribut, le deuxième, dans le cas de <strong>setAttribute()</strong> uniquement, est la nouvelle valeur donner à l'attribut. Petit exemple:
</p>
<pre>
&lt;body&gt;
	&lt;a id=&quot;myLink&quot; href=&quot;http://www.cucul.com&quot;&gt; Un lien modifié dynamiquement&lt;/a&gt;

&lt;script type=&quot;text/javascript&quot;&gt;
	var link = document.getElementById('myLink');
	var href = link.getAttribute('href');

	alert(href);

	link.setAttribute('href', 'http://www.tradiluxe.com');
	link.setAttribute('target', '_blank');
&lt;/script&gt;
</pre>
<h2>&dArr; On test... &dArr;</h2>
<a id="myLink" href="http://cucul.com">Un lien changé dynamiquement</a>

<script type="text/javascript">
	var link = document.getElementById('myLink');
	var href = link.getAttribute('href');
	
	link.addEventListener('click', changeHref, false);
	
	
	function changeHref()
	{
		alert(href);
		
		link.setAttribute('href', 'http://www.tradiluxe.com');
		link.setAttribute('target', '_blank');
	}
</script>

<h3>Les attributs accessibles</h3>
<p>
	En fait pour la plupart des éléments courants comme <strong>&lt;a&gt;</strong>, il est possible d'accéder à un attribut via une propriété. Ainsi, si on veut modifier la destination d'un lien, on peut utiliser la propriété <strong>href</strong>, comme ceci:
<pre>
&lt;body&gt;  	
	&lt;a id=&quot;myLink2&quot; href=&quot;http://www.cucul.com&quot;&gt; Un lien modifié dynamiquement&lt;/a&gt;

   
	&lt;script type=&quot;text/javascript&quot;&gt;
	 	var link = document.getElementById('myLink');  	
		var href = link.getAttribute('href');    	

		alert(href);    	
		
		link.href = 'http://www.tradiluxe.com';
	&lt;/script&gt;
    
</pre>

<h3>La classe</h3>
<p>
	On peut penser que pour modifier l'attribut <strong>class</strong> d'un élément HTML, il suffit d'utiliser <strong style="text-decoration: line-through;">element.class</strong>. Malheureusement ce n'est pas possible, car le mot-clé <strong style="text-decoration: line-through;">class</strong> est réservé en JavaScript. A la place de <strong style="text-decoration: line-through;">class</strong>, il faudra utiliser <strong>className</strong>.
</p>
<pre>
&lt;style type="text/css"&gt;
	.red
    {
    	background-color: darkred;
        color: white;
    }
&lt;/style&gt;

&lt;div id=&quot;myColoredDiv&quot;&gt;
	&lt;p&gt;
		Un peu de texte et &lt;a href=&quot;#&quot; onclick=&quot;return:false;&quot;&gt;un lien&lt;/a&gt;
	&lt;/p&gt;
&lt;/div&gt;

&lt;script type=&quot;text/javascript&quot;&gt;
	document.getElementById('myColoredDiv').className = 'red';
&lt;/script&gt;
</pre>

<h2>&dArr; On applique &dArr;</h2>

<style type="text/css">
	.red
    {
    	background-color: darkred;
        color: white;
		padding: 5px;
		border: 3px #FFCC00 solid;
    }
</style>

<div id="myColoredDiv" style="height: 20px;">
	Un petit peu de texte et <a href="#" id="myLinkChange">Cliquez-moi...</a>
</div>

<script type="text/javascript">
	var div = document.getElementById('myLinkChange');
	
	div.addEventListener('click', changeClass, false);
	
	function changeClass(e)
	{
		e.preventDefault();
		document.getElementById('myColoredDiv').className = 'red';
	}
</script>

<p>
	Faites attention: si votre élément comporte plusieurs classes (exemple: &lt;a class="external red u"&gt;) et que vous récupérez la classe avec <strong>className</strong>, cette propriété ne retournera pas un tableau avec les différentes classes, mais bien la chaîne de caractères... <em>"external red u"</em>.
    Il vous faudra alors couper cette chaîne, avec la méthode <strong>split()</strong> pour obtenir un tableau, comme ceci:
</p>
<pre>
var classes = document.getElementById('myLink').className;
var classesNew = [];

classes = classes.split(' ');

    for(i = 0, c = classes.length; i < c; i++)
    {
        if(classes[i])
        {
            classesNew.push(classes[i]); // on stocke toutes les classes dispos dans classesNew
        }
    }

alert(classesNew);

</pre>

<p>
    Ici, on récupère les classes, on découpe la chaîne, mais comme il se peut que plusieurs espaces soient présents entre chaque nom de classe, on vérifie chaque éléments pour voir s'il contient quelque chose (s'il n'est pas vide). On en profite pour créer un nouveau tableau, <strong>classNew</strong>, qui contiendra les noms des classes, sans "parasites".
</p>

<h2>Le contenu: innerHTML</h2>
<p>
    La propriété <strong>innerHTML</strong> est spéciale et demande une petite introduction. Elle a été créée par Microsoft pur les besoins d'IE. Cette propriété vient tout juste d'être standardisée au sein du <em>HTML 5</em>. Bien que non-standard pendant des années. Elle est devenue standard parce que tous les navigateurs supportaient déjà cette propriété, et pas l'inverse comme c'est également le cas.
</p>
<h3>Récupérer du HTML</h3>
<p>
    <strong>InnerHTML</strong>, permet de récupérer le code HTML enfant d'un élément sous forme de texte. Ainsi, si des balises sont présentes, <strong>innerHTML</strong> les retournera sous forme de texte:
</p>
<pre>
&lt;!doctype html&gt;
    &lt;html&gt;
        &lt;head&gt;
            &lt;meta charset=&quot;utf-8&quot;&gt;
            &lt;title&gt;Le titre de la page&lt;/title&gt;
        &lt;/head&gt;

        &lt;body&gt;
            &lt;div id=&quot;myDiv&quot;&gt;
                &lt;p&gt;Un peu de texte... et un &lt;a&gt;lien&lt;/a&gt;
            &lt;/div&gt;

        &lt;script type=&quot;text/javascript&quot;&gt;
            var div = document.getElementById('myDiv');
            alert(div.innerHTML);
        &lt;/script&gt;

        &lt;/body&gt;

</pre>
<h2>&dArr; On test &dArr;</h2>
<div id="myDivInnerHtml">
    <p>Un peu de texte... et un <a id="myLinkInner" href="#">lien</a>
</div>

<script type="text/javascript">
    var div = document.getElementById('myDivInnerHtml');
    var linkInner = document.getElementById('myLinkInner');
    linkInner.addEventListener('click', printInner, false);

    function printInner(e)
    {
        e.preventDefault();
        alert('innerHTML:\n' + div.innerHTML);
    }
</script>

<h3>Ajouter ou éditer du HTML</h3>
<p>
	Pour éditer ou ajouter du contenu HTML, il suffit de faire l'inverse, c-à-d de définir un nouveau contenu:
</p>
<pre>
document.getElementById('divAddCitation').innerHTML = "&lt;blockquote&gt;
							Je mets une citation à la place du paragraphe
							&lt;/blockquote&gt;";

</pre>
<h2>&dArr; on test &dArr;</h2>
<div id="divAddCitation" style="cursor: pointer;">
    Un peu de texte dans un div, mais survolez-moi et vous verrez ce qui arrive...
</div>
<script type="text/javascript">
    var div2 = document.getElementById('divAddCitation');
    div2.addEventListener('mouseover', showCitation, false);
    div2.addEventListener('mouseout', removeCitation, false);

    function showCitation()
    {
        div2.innerHTML += "<cite>Je rajoute cette petite citation, lors du survol grâce au \"+=\"</cite>";
    }

    function removeCitation()
    {
        div2.innerHTML = "Un peu de texte dans un div, mais survolez-moi et vous verrez ce qui arrive...";
    }
</script>

<a name="part_22"></a>
<h1>innerText et textContent <span><a href="#">top</a></span></h1>
<p>
    Penchons-nous maintenant sur deux propriétés analogues à <strong>innerHTML</strong>: <strong>innerText</strong> pour Internet Explorer et <strong>textContent</strong>
    pour les autres navigateurs.
</p>

<h2>innerText</h2>
<p>
    <strong>innerText</strong> a aussi été introduite dans Internet Explorer, mais à la différence de sa propriété soeur <strong>innerHTML</strong>, elle n'a jamais été standardisée
    et n'est pas supportée par tous les navigateurs. Internet Explorer [Pour toute version antérieure à la 9] ne supporte QUE cette propriété et non pas la version standardisée que
    nous verrons par la suite.
</p>
<p>
    Le fonctionnement d'<strong>innerText</strong> est le même que <strong>innerHTML</strong> excepté le fait que seul le texte est récupéré, et non les balises. C'est pratique pour
    récupérer du contenu sans le balisage... Exemple:
</p>
<pre>
&lt;!doctype html&gt;
    &lt;html&gt;
        &lt;head&gt;
            &lt;meta charset=&quot;utf-8&quot;&gt;
            &lt;title&gt;Le titre de la page&lt;/title&gt;
        &lt;/head&gt;

        &lt;body&gt;
            &lt;div id=&quot;myDiv3&quot;&gt;
                &lt;p&gt;Un peu de texte... et un &lt;a&gt;lien&lt;/a&gt;
                &lt;p&gt;
                    &lt;input type="button" value="click to see" id="viewInnerText" /&gt;
                &lt;/p&gt;
            &lt;/div&gt;

        &lt;script type=&quot;text/javascript&quot;&gt;
            var div = document.getElementById('myDiv3');
            alert(div.innerText);
        &lt;/script&gt;

        &lt;/body&gt;

</pre>

<h2>&dArr; On test... &dArr;</h2>
        <div id="myDiv3">
            <p>Un peu de texte... et un <a>lien</a></p>
            <p>
                <input type="button" value="click to see" id="viewInnerText" />
            </p>
        </div>
        
        <script type="text/javascript">
            var div = document.getElementById('myDiv3');
            var bouton = document.getElementById('viewInnerText');
            bouton.addEventListener('click', showInnerText, false);
          
            function showInnerText(e)
            {
                e.preventDefault();
                alert(div.innerText);
            }
        </script>

        <cite>
            Comme vous pouvez le constater le <strong>input</strong> de type <strong>button</strong> ainsi que le balisage du lien... n'apparaissent pas!
            Cette propriété ne récupère que du <em>#text</em>&nbsp;&nbsp;&nbsp;&nbsp;
            <img src="image/1318514938_6.png" />
        </cite>
        
        <h2>textContent</h2>
        <p>
            <strong>textContent</strong> est la version standardisée d'<strong>innerText</strong> que bien entendu tout les navigateurs reconnaissent à l'exception d'Internet Explorer.
            Il nous reste à voir maintenant comment faire un code compatible:
        </p>
        <pre>
&lt;!doctype html&gt;
    &lt;html&gt;
        &lt;head&gt;
            &lt;meta charset=&quot;utf-8&quot;&gt;
            &lt;title&gt;Le titre de la page&lt;/title&gt;
        &lt;/head&gt;

        &lt;body&gt;
            &lt;div id=&quot;myDiv3&quot;&gt;
                &lt;p&gt;Un peu de texte... et un &lt;a&gt;lien&lt;/a&gt;
                &lt;p&gt;
                    &lt;input type="button" value="click to see" id="viewInnerText" /&gt;
                &lt;/p&gt;
            &lt;/div&gt;

        &lt;script type=&quot;text/javascript&quot;&gt;
            var div = document.getElementById('myDiv3');
            var txt = '';
            
            function recupText()
            {
                if(div.textContent)
                {
                    txt = div.textContent + '[via !IE]';
                }else if(div.innerText){
                    txt = div.innerText + '[via IE]';
                }else{
                    txt = ''; // il n'y a pas de contenu texte
                }
            }
        &lt;/script&gt;

        &lt;/body&gt;

        </pre>
        <cite>
            Seulement ce code est un peu long... dès lors on peut le faire de la façon suivante:
        </cite>
        <pre>
            var txt = div.textContent || div.innerText || '';
        </pre>
        <p>
            Ce qui est plus simple tout de même et plus concis!
        </p>
        <h3>Voilà c'est la fin de la première partie de la manipulation du HTML</h3>