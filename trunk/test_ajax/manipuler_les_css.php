<a href="#part_31">Éditer les propriétés CSS</a> | <a href="#part_32">Récupérer les propriétés CSS</a> | <a href="#part_33">Votre premier script intéractif</a>
        <cite>
            Le JavaScript est un langage permettant de rendre une page web dynamique du côté client. Seulement, quand on pense à "dynamique", on pense aussi à "animations". Or, pour faire des animations, il faut savoir accéder au CSS ainsi que le modifier. C'est ce que nous allons étudier dans ce chapitre.
            <br/><br/>
            Au programme, l'édition du CSS et son analyse. Initialement, il était aussi prévu d'étudier les feuilles de style mais comme leurs méthodes de manipulations changent d'un navigateurs à un autre... et surtout qu'en JavaScript elles ne servent pas réellement à grand chose.
            <br/><br/>
            Enfin, pour terminer le chapitre, nous étudierons comment réaliser un petit système de <strong>Drag N' Drop</strong>: Enfin un sujet intéressant!
        </cite>
<a name="part_31"></a>
        <h1>Éditer les propriétés CSS<span><a href="#">top</a></span></h1>
            <p>
                Avant de s'attaquer immédiatement à la manipulation du CSS, rafraîchissons-nous un peu la mémoire:
            </p>
            
            <h2>
                Quelques rappels sur le CSS
            </h2>
            <p>
                CSS est l'abréviation de <strong>Cascading Style Sheets</strong>, c'est un langage qui permet d'éditer l'aspect graphique des éléments HTML et XML. Il est possible d'éditer le CSS d'un seul élément comme on le ferait en HTML de la manière suivante:
            </p>
            <pre>
&lt;div style="color: red;"&gt;
    Le CSS de cet élément a été modifié avec l'attribut STYLE. Il n'y a donc que lui qui possède un texte de couleur rouge...
&lt;/div&gt;
            </pre>
            
            <p>
                Mais on peut tout aussi bien éditer les feuilles de style qui se présentent de la manière suivante:
            </p>
            <pre>
div{
    color: red; // Ici je modifie la couleur de tous les éléments DIV
}
            </pre>
            <p>
                Je pense qu'il est de bon ton de vous rappeler: &laquo;Les propriétés CSS de l'attribut <strong>style</strong> sont <u>prioritaires</u> sur les propriétés de la feuille de style!&raquo; Ainsi, dans l'exemple ci-dessous, le texte ne sera pas rouge mais bleu.
            </p>
            <pre>
&lt;style type="text/css"&gt;
    div {
        color: red;
    }
&lt;/style&gt;

&lt;div style="color: blue;"&gt;Un petit texte en bleu&lt;/div&gt;
            </pre>
            
            <p>
                Voilà tout pour les rappels sur le CSS. Oui, c'était très rapide, mais je voulais simplement insister sur cette histoire de priorité des styles CSS, parce que ça va vous servir!
            </p>
            
            <h2>Éditer les styles CSS d'un élément</h2>
            <p>
                Comme dit ci-dessus, il y a deux manières de modifier le CSS d'un élément HTML, nous allons ici aborder la méthode la plus simple et la plus utilisée: L'utilisation de l'attribut <strong>style</strong>. L'édition des feuilles de style ne <u>sera pas abordée</u> car elle est complétement inutile en plus d'être mal gérée par de nombreux navigateurs.
            </p>
            <p>
                Alors comment accéder à l'attribut <strong>style</strong> de notre élément? Eh bien de la même manière que pour accéder à n'importe quel attribut de notre élément:
            </p>
            <pre>
el.style //on accède à l'attribut "style" de l'élément "el"
            </pre>
            
            <p>
                Une fois que l'on a accédé à notre attribut, comment en modifier les propriétés CSS? Ehh bien, tout simplement en écrivant leur nom et en leur attribuant une valeur, <strong>width</strong> (pour la largeur par exemple).
            </p>
            <pre>
el.style.width = '150px'; //On a modifié la largeur grâce JavaScript
            </pre>
            
            <p>
                Pensez bien à écrire l'unité de votre valeur, il est fréquent que moi-même je l'oublie et généralement ça pose de nombreux problème dans un code...!
            </p>
            <p>
                Maintenant, j'ai une questions pour vous: &laquo;Comme accède-t-on à une propriété CSS qui possède un nom composé?&raquo;
                <br/><br/>
                En JS, les tirets sont interdits dans les noms des propriétés. Ce qui nous amène à répondre:
                <br/>
                - <strong>el.style.backgroundColor</strong> et non pas <strong>background-color</strong>
            <pre>
el.style.background-color = 'red';//Ce code ne fonctionnera pas...

el.style.backgroundColor = 'red';//Ce code fonctionne parfaitement!
            </pre>
            </p>
            
            
            <p>
                Comme vous pouvez le constater, l'édition du CSS d'lun élément n'est pas bien compliqué. Cependant, il y a une limitation de taille: la <u>lecture</u> des propriété CSS!
            </p>
            <p>
                Un exemple:
            </p>
            <pre>
&lt;style type="text/css"&gt;
    #myDiv{
        background-color: orange;
    }
&lt;/style&gt;

&lt;div id="myDiv"&gt;
    Je possède un fond orange!
&lt;/div&gt;

&lt;script type="text/javascript"&gt;
    var myDiv = document.getElementById('myDiv');
    alert('Selon JavaScript, la couleur de fond de ce div est: '+myDiv.style.backgroundColor);
&lt;/script&gt;
            </pre>
            
            <h3>&dArr; Essayons...! &dArr;</h3>
            <style type="text/css">
                #myDiv{
                    background-color: orange;
                    margin-top: 15px;
                    padding: 5px;
                    -webkit-border-radius: 5px;
                    width: 1075px;
                }
            </style>

            <div id="myDiv">
                Je possède un fond orange!
                <br/>
                <input type="button" value="affiche la couleur" onclick="printColor()"/>
            </div>

            <script type="text/javascript">
                function printColor()
                {
                    var myDiv = document.getElementById('myDiv');
                    alert('Selon JavaScript, la couleur de fond de ce div est: '+myDiv.style.backgroundColor);                    
                }
            </script>
            
            <cite>
                C'est gênant comme résultat...? Malheureusement, on ne peut pas y faire grand chose à partir de l'attribut <strong>style</strong>, pour cela nous allons devoir utiliser la méthode <strong>getComutedStyle()</strong>!
                <br/><br/>
                Je vous présente juste un petit exemple ci-dessous... Cependant, la méthode vous sera présentée dans le chapitre suivant &rArr;
            </cite>
            
            <h3>&dArr; Alors re-testons cette nouvelle méthode &dArr;</h3>
            <style type="text/css">
                #myDiv2{
                    background-color: orange;
                    margin-top: 15px;
                    padding: 5px;
                    -webkit-border-radius: 5px;
                    width: 1075px;
                }
            </style>

            <div id="myDiv2">
                Je possède un fond orange!
                <br/>
                <input type="button" value="affiche la couleur" onclick="printColor()"/>
            </div>

            <script type="text/javascript">
                function printColor()
                {
                    var myDiv2 = document.getElementById('myDiv2');
                    alert('Selon JavaScript, la couleur de fond de ce div est: \n- ' + getComputedStyle(myDiv2, null).backgroundColor);                    
                }
            </script>            
            
<a name="part_32"></a>
        <h1>Récupérer les propriétés du CSS<span><a href="#">top</a></span></h1>
        
        <h2>La fonction <strong>getComputedStyle()</strong></h2>
            <p>
                Comme vous avez pu le constater, il n'est pas possible de récupérer les valeurs des propriétés CSS d'un élément par le biais de l'attribut <strong>style</strong> vu que celui-ci n'intègre pas les propriétés CSS des feuilles de style, ce qui nous limite énormément dans nos possibilités d'analyse...
                Heureusement il existe une fonction permettant de remédier à ce problème: <strong>getComputedStyle()</strong>!
            </p>
            <p>
                Cette fonction va se charger de récupérer, à notre place, la valeur de n'importe quelle propriété CSS! Que la propriété soit déclaré dans l'attribut <strong>style</strong>, une feuille de style ou bien même encore calculée automatiquement, cela importe peu: <strong>getComputedStyle()</strong> la récupérera sans problème.
            </p>
            <p>
                Son fonctionnement est très simple et se fait de cette manière:
            </p>
            <pre>
&lt;style type="text/css"&gt;
    #myDiv{
        background-color: orange;
    }
&lt;/style&gt;

&lt;div id="myDiv"&gt;
    Je possède un fond orange!
&lt;/div&gt;

&lt;script type="text/javascript"&gt;
    var myDiv = document.getElementById('myDiv');
    var bgColor = getComputedStyle(myDiv, <span style="font-family: courrier; color: green;">null</span>).backgroundColor;

    alert(bgColor);
&lt;/script&gt;
            </pre>
            
            <h3>&dArr; Testons notre nouvelle méthode &dArr;</h3>

            <style type="text/css">
                #myDiv3{
                    background-color: orange;
                    margin-top: 15px;
                    padding: 5px;
                    -webkit-border-radius: 5px;
                    width: 1075px;                    
                }
            </style>

            <div id="myDiv3">
                Je possède un fond orange!
                <br/>
                <input type="button" value="affiche le style" onclick="printCSS()"/>
            </div>

            <script type="text/javascript">
                function printCSS()
                {
                    var myDiv3 = document.getElementById('myDiv3');
                    var bgColor = getComputedStyle(myDiv, null).backgroundColor;

                    alert("Couleur de Fond: " + bgColor);
                }
                
            </script>
            
            <cite>
                <strong>- Mais alors à quoi sert ce deuxième argument que tu as mis à <span style="font-family: courrier; color: green;">null</span>?</strong>
                <br/><br/>
                Il s'agit en fait d'un argument facultatif qui permet de spécifier une pseudo-classe à notre élément, je ne vais cependant pas m'y attarder plus longtemps car on ne s'en servira pas. En effet, Internet Explorer ( IE < 9.0 ) ne supporte pas l'utilisation de la méthode <strong>getComputedStyle</strong> et utilise à la place l'attribut <strong>currentStyle</strong> qui, lui, ne supporte pas l'utilisation des pseudo-classes.
                <br/><br/>
                J'ai dit qu'il s'agissait d'un argument <u>facultatif</u> alor pourquoi l'a-t-on spécifié?
                <br/>
                Il ne s'agit pas d'une erreur de ma part mais tout simplement parce que cette fois c'est FireFox qui nous embête: <strong>Il considère cet argument comme obligatoire.</strong> Ce comportement perdure &rArr; version 4.0 de FireFox.
            </cite>
            
            <h2>L'alternative <strong>currentStyle</strong> pour IE &LT; 9.0</h2>
            <p>
                Pour Internet Explorer, il existe encore une petite différence car la méthode <strong>getComputedStyle()</strong> n'existe pas! À la place on va se servir de <strong>currentStyle</strong>:
            </p>
            
            <pre>
&lt;style type="text/css"&gt;
    #myDiv{
        background-color: orange;
    }
&lt;/style&gt;

&lt;div id="myDiv"&gt;
    Je possède un fond orange!
&lt;/div&gt;

&lt;script type="text/javascript"&gt;
    var myDiv = document.getElementById('myDiv');
    var bgColor = myDiv.currentStyle.backgroundColor;

    alert(bgColor);
&lt;/script&gt;
            </pre>
            
            <h3>&dArr; Testons cette nouvelle méthode <i style="color: darkred;">[attention cette méthode ne fonctionne qu'avec IE]</i> &dArr;</h3>
            <style type="text/css">
                #myDiv4{
                    background-color: orange;
                    margin-top: 15px;
                    padding: 5px;
                    -webkit-border-radius: 5px;
                    width: 1075px;
                }
            </style>

            <div id="myDiv4">
                Je possède un fond orange!
                <br/>
                <input type="button" value="affiche la couleur" onclick="printCSS2()"/>
            </div>

            <script type="text/javascript">
                function printCSS2()
                {
                    var myDiv4 = document.getElementById('myDiv4');
                    var bgColor = myDiv4.currentStyle.backgroundColor;
                    
                    alert(bgColor);
                }
            </script>
            
            <cite>
                <h3>Toutes les valeurs obtenues par le biais de <strong>getComputedStyle()</strong> ou <strong>currentStyle</strong> sont en lecture seule!!! </h3>
            </cite>
          
            <h2>Les attributs de type "offset"</h2>
            <p>
                Certaines valeurs de positionnement ou de taille des éléments ne pourront pas être obtenues de façon "simple" avec getComputedStyle(), pour pallier à ce problème il existe les attributs "offset" qui sont, dans notre cas, au nombre de cinq:
            </p>
            <div id="tableInfos">
                <table id="myTableInfo">
                    <thead>
                        <tr>
                            <th style="text-align: center;">
                                L'attribut
                            </th>
                            <th style="text-align: center;">
                                Contient [...]
                            </th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <th>
                                offsetWidth
                            </th>
                            <td>
                                Contient la largeur complète <u>[width + padding + border]</u> de l'élément
                            </td>
                        </tr>
                        <tr>
                            <th>
                                offsetHeight
                            </th>
                            <td>
                                Contient la hauteur complète <u>[height + padding + border]</u> de l'élément
                            </td>
                        </tr>
                        <tr>
                            <th>
                                offsetLeft
                            </th>
                            <td>
                                Surtout utile pour les éléments en position <strong>absolue</strong>.
                                <br/>
                                Contient la position de l'élément par rapport au <strong>bord gauche</strong> de son élément parent.
                            </td>
                        </tr>
                        <tr>
                            <th>
                                offsetTop
                            </th>
                            <td>
                                Surtout utile pour les éléments en position <strong>absolue</strong>.
                                <br/>
                                Contient la position de l'élément par rapport au <strong>bord supérieur</strong> de son élément parent.
                            </td>
                        </tr>
                        <tr>
                            <th>
                                offsetParent
                            </th>
                            <td>
                                Utile que pour un élément en position <strong>absolue</strong> ou <strong>relative</strong>!
                                <br/>
                                Contient l'<strong>objet de l'élément parent</strong> par rapport auquel est positionné l'élément actuel.
                            </td>
                        </tr>                    
                    </tbody>
                </table>                
            </div>

            
            <cite>
                Leur utilisation ne se fait pas de la même manière que n'importe quelle propriété CSS tout d'abord parce que <u>ce ne sont pas des propriétés CSS</u>! Ce sont juste des attributs (en lecture seule) mis à jour dynamiquement. Ils concernent certains états physiques de notre élément!
                <br/><br/>
                Pour les utiliser, on oublie l'attribut <strong>style</strong> vu qu'il ne s'agit pas de propriétés CSS. On les lit <u>directement</u> sur l'objet de notre élément HTML:
            </cite>
            <pre>
&lt;input type="button" value="Print Table Size" onclick="printSize()"/&gt;

&lt;script type="text/javascript"&gt;
    function printSize()
    {
        //On va voir ce que l'on peut obtenir comme infos sur notre table ci-dessus
        var myTable = document.getElementById('myTableInfo');

        alert("Taille du tableau d'info ci-dessus [H x L]:\n" + myTable.offsetHeight +" * "+ myTable.offsetWidth);        
    }
&lt;/script&gt;
            </pre>
            <h3>&dArr; Voyons voir... &dArr;</h3>
            <div id="myDivSize" style="margin-top: 15px;">
                <input type="button" value="Print Table Size" onclick="printSize()"/>

                <script type="text/javascript">
                    var txtNode = document.createTextNode('');
                    var txtNode2 = txtNode.cloneNode(false);
                    var txtNode3 = txtNode.cloneNode(false);
                    
                    var infoSpan = document.createElement('span');
                        infoSpan.setAttribute('style', 'border: dodgerblue 2px solid; -webkit-border-radius: 5px; padding: 3px; width: 1085px; margin-right: 5px;');
                        
                    var infoSpan2 = infoSpan.cloneNode(false);
                    var infoSpan3 = infoSpan.cloneNode(false);
                        
                    var myTable = document.getElementById('myTableInfo');
                    var myDivSize = document.getElementById('myDivSize');                        
                        
                    function printSize()
                    {
                        //On va voir ce que l'on peut obtenir comme infos sur notre table ci-dessus
                        txtNode.data = 'Taille du tableau d\'info ci-dessus [H x L]: ' + myTable.offsetHeight +" * "+ myTable.offsetWidth;
                        txtNode2.data = 'Position du tableau [G x H]: ' + myTable.offsetLeft +" & "+ myTable.offsetTop;
                        txtNode3.data = 'Objet parent du  tableau: ' + myTable.offsetParent + " comme aucun élément absolu";//Comme aucun élément n'est défini en absolu c'est l'élément <body>...
                        
                        myDivSize.appendChild(infoSpan).appendChild(txtNode);
                        myDivSize.appendChild(infoSpan2).appendChild(txtNode2);
                        myDivSize.appendChild(infoSpan3).appendChild(txtNode3);
                    }
                </script>
            </div>
            <cite>
                Faites bien attention: Les valeurs contenues dans ces attributs (a part <strong>offsetParent</strong>) sont exprimées en pixels et sont donc de type <strong>Integer</strong>, pas comme les propriétés CSS qui sont de type <strong>String</strong> et pour lesquelles les unités sont spécifiées (px, cm, em, etc.).
            </cite>
            
            <h2>L'attribut <strong>offsetParent</strong></h2>
            <p>
                Concernant l'attribut <strong>offsetParent</strong>, celui-ci contient l'objet de l'élément parent par rapport auquel est positionné votre élément actuel. C'est bien, mais qu'est-ce que ça veut dire?!?
            </p>
            <p>
                Ce que je vais vous expliquer concerne les connaissances HTML &amp; CSS et non pas JavaScript! Seulement, je pense que certains d'entre vous ne connaissent pas ce fonctionnement particulier du positionnement absolu, je préfère donc vous le rappeler.
            </p>
            <p>
                Lorsque vous décidez de mettre un de vos éléments HTML en positionnement absolu, celui-ci est sorti du positionnement par défaut des éléments HTML et va aller se placer tout en haut à gauche de votre page web, par dessus tous les autres éléments. Seulement ce principe est applicable que lorsque votre élément n'est pas déjà lui-même placé dans un élément en positionnement absolu. Si cela arrive, alors votre élément se positionnera non plus par rapport au coin suppérieur gauche de la page web, <u>mais par rapport au coin supérieur gauche du précédent élément placé en positionnement absolu</u> [ou relatif ou fixe].
                <br/><br/>
                <em>
                    &bull; Étudiez ce cas, si ce n'est pas clair: <a href="#" onclick="window.open('popup.html', 'Essai css', 'width=300px, height=300px, left=710px, top=390px'); return false;">Positionnement Absolu</a>
                </em>
            </p>
            <p>
                Ce système de positionnement est clair? Bon, nous pouvons à présent revenir à notre attribut <strong>offsetParent</strong>! S'il existe, c'est parce que les attributs <strong>offsetLeft</strong> et <strong>offsetTop</strong> contiennent les positionnement de votre élément <u>par rapport à son précédent élément parent</u> et non pas par rapport à la page! Si on veut obtenir son positionnement par rapport à la page, il faudra alors aussi ajouter les valeurs de positionnement de son (ses) élément(s) parent(s).
            </p>
            <p>
                Voici le problème mis en pratique ainsi que sa solution:
            </p>
            
            <pre>
&lt;style type="text/css"&gt;
    #parentExemple
    {
        position: absolute;
        top: 4350px;
        left: 100px;
    }
    
    #parentExemple
    {
        width: 200px;
        height: 200px;
        background-color: dodgerblue;
    }
    
    #childExemple
    {
        position: absolute;
        left: 75px;
        top: 75px;
        width: 50px;
        height: 50px;
        background-color: orange;
    }
&lt;/style&gt;

&lt;div id="parentExemple"&gt;
    &lt;div id="childExemple"&gt;
        &lt;a href="#" onclick="getPosition(); return false;"&gt;Sans Calcul&lt;/a&gt;
        &lt;br/&gt;
        &lt;a href="#" onclick="getRealPosition(this.parentNode); return false;"&gt;Avec calcul&lt;/a&gt;
    &lt;/div&gt;
&lt;/div&gt;

&lt;script type="text/javascript"&gt;
    
    var parentEx = document.getElementById('parentExemple');
    var childEx = document.getElementById('childExemple');
    
    function getPosition()
    {
        alert('Sans la fonction de calcul, la position de l\'élément enfant est: \n\n' + 'offsetTop: ' + childEx.offsetTop + "px \n" + "offsetLeft: " + childEx.offsetLeft + "px");
    }
    
    function getRealPosition(el)
    {
        alert('Avec la fonction de calcul, la position de l\'élément enfant est: \n\n' + 'offsetTop: ' + getOffset(el).top + "px \n" + "offsetLeft: " + getOffset(el).left + "px");
    }
    
    function getOffset(el)
    {
        //fonction qui calcule la position compète de notre élément enfant
        var top=0, left=0;
        
        do
        {
            left += el.offsetLeft;
            top += el.offsetTop;
        } while(el = el.offsetParent); // tant que EL reçoit un offsetParent valide alors on additionne les valeurs de offset.
        
        return {top: top, left: left};
    }
    
&lt;/script&gt;
            </pre>
            
            <h3>Allez on va tester kemême...</h3>
                <style type="text/css">
                    #parentExemple
                    {
                        position: absolute;
                        top: 5430px;
                        left: 405px;
                    }

                    #parentExemple
                    {
                        width: 200px;
                        height: 200px;
                        background-color: dodgerblue;
                    }

                    #childExemple
                    {
                        position: absolute;
                        left: 60px;
                        top: 60px;
                        width: 80px;
                        height: 80px;
                        background-color: orange;
                    }
                </style>

                <div id="parentExemple">
                    <div id="childExemple">
                        <br/>
                        <a href="#" onclick="getPosition(); return false;">Sans Calcul</a>
                        <br/><br/>
                        <a href="#" onclick="getRealPosition(this.parentNode); return false;">Avec calcul</a>
                    </div>
                </div>
                <div style="float: Right; font-size: 200px; margin-top: -20px; font-family: Georgia; color: grey;">
                    }<div style="font-size: 30px; float: right; width: 550px; padding-right: 260px; padding-top: 65px; font-family: Georgia; font-style: italic; color: dodgerblue;">Attention positionnement en ABSOLU... donc pas directement incorporé dans le FLUX!!!</div>
                </div>
                <div style="clear: right;">&nbsp;</div>
                
                <cite>
                    Comme vous pouvez le constater, les valeurs seules de positionnement de notre élément enfant ne sont pas correctes si on souhaite connaître le positionnement exacte de notre par rapport à la page et NON par rapport à l'élément parent. ON est finalement obligé d'utiliser une fonction personnelle de calcul...
                </cite>

                <script type="text/javascript">

                    var parentEx = document.getElementById('parentExemple');
                    var childEx = document.getElementById('childExemple');

                    function getPosition()
                    {
                        alert('Sans la fonction de calcul, la position de l\'élément enfant est: \n\n' + 'offsetTop: ' + childEx.offsetTop + "px \n" + "offsetLeft: " + childEx.offsetLeft + "px");
                    }

                    function getRealPosition(el)
                    {
                        alert('Avec la fonction de calcul, la position de l\'élément enfant est: \n\n' + 'offsetTop: ' + getOffset(el).top + "px \n" + "offsetLeft: " + getOffset(el).left + "px");
                    }

                    function getOffset(el)
                    {
                        //fonction qui calcule la position compète de notre élément enfant
                        var top=0, left=0;

                        do
                        {
                            left += el.offsetLeft;
                            top += el.offsetTop;
                        } while(el = el.offsetParent); // tant que EL reçoit un offsetParent valide alors on additionne les valeurs de offset.

                        return {top: top, left: left};
                    }

                </script>
                
                <cite>
                    <ul>
                        <li>
                            <h3>
                                Explications du code ci-dessus:
                            </h3>
                            <p>Fonction de calcul revue avec les points à comprendre et à retenir</p>
                        </li>
                    </ul>
                    <ol>
                        <li>
                            La boucle s'exécute une première fois en initialisant les variables <strong>top</strong> et <strong>left</strong> avec les valeurs de la position de l'enfant vis-à-vis du parent.
                        </li>
                        <li>
                            A la fin de la boucle il y a la condition; qui dit:
                            <br/>
                            &laquo;Attribue l'objet de l'élément <strong>parent</strong> à l'élément <strong>courant</strong>!&raquo;
                        </li>
                        <li>
                            Puis elle retourne dans la boucle avec les nouvelles valeur (celles de l'élément "parent") puis incrémente les anciennes valeurs avec les nouvelles... et ainsi de suite jusqu'a ce que l'élément parent soit <strong>"undefined"</strong>
                        </li>
                    </ol>
                </cite>
            
        <a name="part_33"></a>
        <h1>Votre premier script interactif<span><a href="#">top</a></span></h1>
            <h2>
                Présentation de l'exercice
            </h2>
            <p>
                Il s'agit d'un système de déplacement d'éléments par un simple cliqué-glissé (<i>drag</i>).
                <br/><br/>
                Avant de se lancer dans le code voici les étapes de fonctionnement d'un système de "Drag n' Drop":
            <ol>
                <li>
                    L'utilisateur clique sur l'élément (sans relâcher).
                    <ol>
                        <li>
                            Initialisation du Drag n' Drop
                        </li>
                        <li>
                            Gestion du déplacement de l'objet.
                        </li>
                        <li>
                            L'évènement à utiliser ici est <strong>mousedown</strong>
                        </li>
                    </ol>    
                </li>
                <li>
                    Déplacement de l'objet, l'utilisateur (tout en gardant le clique enfoncé) déplace son curseur. L'élément suit le curseur à la trace.
                    <ol>
                        <li>
                            Je vous conseille d'appliquer l'évènement à l'élément <strong>document</strong>. <i>// A voir selon l'utilisation voulue</i>
                        </li>
                        <li>
                            L'évènement à utiliser ici est <strong>mousemove</strong>
                        </li>
                    </ol>
                </li>
                <li>
                    L'utilisateur relâche le bouton de la souris. Le "<strong>Drag n' Drop</strong>" prend alors fin et l'élément ne suit plus le curseur de la souris.
                </li>
                <ol>
                    <li>
                        L'évènement à utiliser ici est <strong>mouseup</strong>
                    </li>
                </ol>
            </ol>
            </p>
            
            <p>
                Bon ça n'a pas l'air si tordu que ça... voyons le code de départ:
            </p>
            <pre>
&lt;div class="draggableBox"&gt;1&lt;/div&gt;
&lt;div class="draggableBox"&gt;2&lt;/div&gt;
&lt;div class="draggableBox"&gt;3&lt;/div&gt;
            
&lt;style type="text/css"&gt;
    .draggableBox
    {
        position: absolute;
        width: 50px;
        height: 40px;
        padding-top: 5px;
        text-align: center;
        font-size: 40px;
        background-color: #222;
    }

&lt;/style&gt;            
            </pre>
            
            <h3>&dArr; La résultat... &dArr;</h3>
            
                <style type="text/css">
                    .draggableBox
                    {
                        position: absolute;
                        width: 60px;
                        height: 50px;
                        padding-top: 5px;
                        text-align: center;
                        font-size: 40px;
                        background-color: #222;
                        -webkit-border-radius: 10px;
                        border: 3px lightsteelblue solid;
                        cursor: pointer;
                    }
                    
                    #surfaceDragNDrop
                    {
                        background-color: lightgray;
                        border: 1px dodgerblue solid;
                        height: 350px;
                        -webkit-border-radius: 10px;
                        margin-right: 30px;
                        margin-top: 10px;
                    }

                </style>            
            
            <div id="surfaceDragNDrop">
                <div class="draggableBox">1</div>
                <div class="draggableBox">2</div>
                <div class="draggableBox">3</div>                
            </div>
                
            <script type="text/javascript">
                var storage = {}; //initialise un tableau de gestion des déplacements
                
                //ajout de la fonction gestion IE
                function addEvent(el, event, fonction)
                {
                    if(el.attachEvent)
                    {
                        el.attachEvent('on'+event, fonction);
                    }else{
                        el.addEventListener(event, fonction, true);
                    }
                }
                
                function init()
                {
                    var els = document.getElementById('surfaceDragNDrop').getElementsByTagName('div');
                    var elsLength = els.length;

                    for(i = 0; i < elsLength; i++)
                        {
                            if(els[i].className === 'draggableBox')
                                {
                                    //début des évènements
                                    addEvent(els[i],'mousedown', function(e){
                                        var s = storage;//permet de la réinitialisation de la variable lors de l'appel de l'événement
                                        s['target'] = e.target;
                                        s['offsetLeft'] = e.clientX-s.target.offsetLeft;
                                        s['offsetTop'] = e.clientY-s.target.offsetTop;
                                    }, true);
                                    
                                    addEvent(els[i],'mouseup', function(){
                                        storage = {};
                                    }, true);
                                }
                        }

                        addEvent(document,'mousemove', function(e){
                            var target = storage.target
                            if(target) //permet de vérifier que l'élément target existe
                                {
                                    target.style.top = e.clientY-storage.offsetTop + "px";
                                    target.style.left = e.clientX-storage.offsetLeft + "px";
                                }

                        }, true);                        
                }
                
                init();
            </script>