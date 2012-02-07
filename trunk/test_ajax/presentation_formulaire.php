<a href="#part_29">Les Attributs</a> | <a href="#part_30">Retour sur quelques évènements</a>
        <cite>
            Les formulaires sont simples a utiliser, cependant il faut d'abord mémoriser quelques attributs de base. Comme vous le savez déjà. il es possible d'accéder à 'importe quel attribut d'un élément HTML, et ceci, juste en tapant son nom, il en va donc de même pour des attributs spécifiques aux éléments d'un formulaire comme <strong>value, disabled, checked, et autres...</strong> Nous allons voir ici comment utiliser ces attributs spécifiques aux formulaires.
        </cite>
<a name="part_29"></a>
        <h1>Les Attributs<span><a href="#">top</a></span></h1>
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