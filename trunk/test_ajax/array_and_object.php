        <a href="#part_13">Introduction aux Objets</a> | <a href="#part_14">Les Tableaux</a> | <a href="#part_15">Opérations sur les Tableaux</a> | <a href="#part_16">Parcourir un Tableau</a> | <a href="#part_17">Les Objets littéraux</a> | <a href="#part_18">Exercice Récapitulatif</a>
        <cite>
            Les objets sont une notion fondamentale en JavaScript. Il s'agit ici du dernier gros chapitre de la partie 1.
            Nous verrons comment faire des objets simples, <strong>objets littéraux</strong>, qui vont se révéler idenspensables.
        </cite>
        <a name="part_13"></a>
        <h1>Introduction aux Objets <span><a href="#">top</a></span></h1>
            <p>
                Il a été dit dans l'introduction que le JS est un langage dit "orienté objet". Celà signifie que le langage dispose d'<strong>objets</strong>.
            </p>
            <p>
                Un objet est un concept, une idée ou une chose. Un objet possède une structure qui lui permet de pouvoir fonctionner et d'intéragir avec d'autres objets. JS met à notre dispositions des objets dits <strong>natifs</strong>, c'est-à-dire des objets directement utilisables.
                On en a déjà manipulé tout un tas: int, string, boolean.
            </p>
            <p>
                Ce ne sont pas des variables?
                <br />
                - Si, mais en fait, une variable contient un objet.
            </p>
            <pre>
&lt;script&gt;
    var myString = "Je ne suis pas un heros!";
&lt;/script&gt;
            </pre>
            <p>
                La variable <strong>myString</strong> contient un objet, et c'est objet représente une chaîne de caratères. C'est la raison pour laquelle ont dit, au même titre que PHP, que JS n'est pas un langage <strong>typé</strong>!
                Car les variables contiennent toujours la même chose: <strong>un objet</strong>. Mais cet objet peut être de nature différente (int, string, boolean, ...).
            </p>
            <p>
                Outre les objets natifs, JS nous permets de fabriquer nos propres objets. Ceci fera toutefois partie d'un chapitre à part, car la création d'objets est plus compliquée que l'utilisation des objets natifs.
            </p>
            <cite>
                Attention, le JavaScript n'est pas un langage objet au même titre que C++, Java ou autre C#. JavaScript est un langage dit: <strong>orienté objet par prototype</strong>. Si vous avez déjà des notions de programmation objet, vous verrez quelques différences, mais les principales viendront lors de la création d'objets.
            </cite>
            <h2>De quoi sont fait les Objets</h2>
            <ol>
                <li>Un Constructeur</li>
                <li>De Propriétés</li>
                <li>De Méthodes</li>
            </ol>
            
            <h3>Le Constructeur</h3>
            <p>
                Le constructeur est une fonction qui est exécutée lorsque l'on instancie un nouvel objet. Le constructeur permet de définir les actions par défaut a effectué, comme par exemple: la définition de diverses variables au sein même de l'objet [<em>comme le nombre de caractères qu'une chaîne peut contenir, etc...</em>]. Tout cela est fait automatiquement pour les objets natifs, et on en reparlera quand nous aborderons l'orienté objet. Partie dans laquelle nous créerons nous-même cette structure.
            </p>
            
            <h3>Les Propriétés</h3>
            <p>
                Reprenons l'exemple du nbre. de caractères d'une chaîne, cette valeur va être placée dans une variable directement au sein de l'objet: c'est une <strong>propriété</strong>. Une propriété est une variable contenue dans l'objet, et qui contient des informations nécessaires au fonctionnement de l'objet.
            </p>
            
            <h3>Les Méthodes</h3>
            <p>
                Enfin, il est possible de modifier l'objet. Cela se fait par l'intermédiaire des <strong>méthodes</strong>. Les méthodes sont des fonctions contenues dans l'objet, et qui permettent de réaliser des opérations sur le contenu de l'objet. Par exemple, dans le cas de notre String, il existe une méthode qui permet de mettre la chaîne en Majuscules.
            </p>
            
            <h2>⇓ Petit test de mise en pratique ⇓</h2>
            <p>
                On va créer une chaîne, puis afficher le nombre de caractères quelle possède et la transformer en Maj.
            </p>
            <pre>
&lt;script type="text/javascript"&gt;
    var myString = "Je ne suis pas un héro, mais cette image me colle à la peau...";
    var nbCaractere = myString.length;
    var myStringUp = myString.toUpperCase();
&lt;/script&gt;
            </pre>
            
            <div id="resultString">
                <!-- contenu JS -->
            </div>
            <script type="text/javascript">
                var resultString = document.getElementById('resultString');
                
                var myString = "Je ne suis pas un héro, mais cette image me colle à la peau...";
                var nbCaractere = myString.length;
                var myStringUp = myString.toUpperCase();
                
                resultString.innerHTML = "<strong>Original:</strong> "+myString+"<br /><strong>Nb. Caractères:</strong> "+nbCaractere+"<br /><strong>CapsLock:</strong> "+myStringUp;
            </script>
            
            <cite>
                    On remarque qqch. de nouveau dans ce script: la présence d'un point. Le point permet d'accéder aux propriétés et aux méthodes d'un objet.
            </cite>
            
            <h2>Les Objets natifs déjà rencontrés:</h2>
            <ul>
                <li><strong>Number</strong> &rArr; objet qui gère les nombres</li>
                <li><strong>Boolean</strong> &rArr; objet qui gère les booléens</li>
                <li><strong>String</strong> &rArr; objet qui gère les chaînes de caractères</li>
            </ul>
            
            <a name="part_14"></a>
            <h1>Les Tableaux <span><a href="#">top</a></span></h1>
            <p>
                Souvenez-vous: dans le chapitre sur les boucles, que nous avons sauté, il était question de demander à l'utilisateur les prénoms de ses frères et soeurs. Les prénoms étaient concaténés dans une chaîne de caractères, puis affichés.
            </p>
            <p>
                Dans un tel cas les tableaux sont un choix nettement plus judicieux. Un tableau, ou plutôt un <strong>Array</strong>, est une variable qui contient plusieurs valeurs, appelées <strong>items</strong>. Chaque <strong>item</strong> est accessible au moyen d'un <em>indice</em> (<strong>index</strong>) et dont la numérotation commence à "0"!
                Voici un schéma représentant le stockage d'un tableau:
            </p>
            <table>
                <tr>
                    <th>Indice</th>
                    <td>0</td>
                    <td>1</td>
                    <td>2</td>
                    <td>3</td>
                    <td>4</td>
                </tr>
                <tr>
                    <th>Données</th>
                    <td>Valeur1</td>
                    <td>Valeur2</td>
                    <td>Valeur3</td>
                    <td>Valeur4</td>
                    <td>Valeur5</td>
                </tr>
            </table>
            <h2>Les Indices</h2>
            <p>
                Comme vous le voyez dans le tableau ci-dessus, la numérotation des <strong>items</strong> commence à 0! Attention souvent cause de bugs ou erreurs.
            </p>
            
            <h2>Déclarer un tableau</h2>
            <p>
                On utilise bien évidemment <strong>var</strong> pour déclarer un tableau, mais la syntaxe pour définir les valeurs est spécifique:
            </p>
            <pre>
&lt;script type="text/javascript"&gt;
    var myArray = ['Esso', 'SchuSchu', 'Looney'];
&lt;/script&gt;
            </pre>
            
            <p>
                Le contenu du tableau se définit entre crochets, et chaque valeur est séparée par une virgule. Les valeurs sont introduites comme pour des variables simples, c'est-à-dire qu'il faut des guillemets ou des apostrophes pour définir les chaînes de caractères:
            </p>
            <pre>
&lt;script type="text/javascript"&gt;
    var myArray_1 = [42, 16, 6, 3];
    var myArray_2 = [42, 'Esso', 12, 'SchuSchu', 1, 'Looney'];
    
    alert(myArray_2[1]); // affiche Esso
    myArray_2[0] = 'Guillaume'; // assigne Guillaume à la place de '42'
&lt;/script&gt;
            </pre>  
            <cite>
                La déclaration par le biais de crochets est la syntaxe courte. Il se peut que vous rencontriez un jour une syntaxe plus longue qui est vouée à disparaître. Avec le mot clé <strong>new Array('blabal', 12, 'je ne suis pas', 'ce que voooous croyiez');</strong>.
            </cite>
            
            <a name="part_15"></a>
            <h1>Opération sur les Tableaux <span><a href="#">top</a></span></h1>
            <h2>Ajouter et supprimer des item</h2>
            <p>
            	La méthode <strong>push()</strong> permet d'ajouter un ou plusieurs items à un tableau:
            </p>
            <pre>
var myArray = ['Sébastien', 'Nicole']; 
           
myArray.push('Nicolas');
myArray.push('Bastien', 'Carole', 'Carlos'); // Ajout Bastien, Carole et Carlos à la fin du tableau
            </pre>
            <p>
            	<strong>Push</strong> est une méthode et peut recevoir un nombre illimité de paramètres.
            </p>
            <p>
            	La méthode <strong>unshift()</strong> fonctionne comme <strong>push()</strong>, à la différence près que les items sont ajoutés aux <strong>début</strong> du tableau.
            </p>
            <p>
            	Les méthodes <strong>shift()</strong> et <strong>pop()</strong> retirent respectivement le premier ou le dernier élément du tableau.
            </p>
            <pre>
var myArray = ['Séb', 'Laurence', 'Ludo', 'Pauline'];

myArray.shift(); // retire Séb
myArray.pop(); // retire Pauline
            </pre>
            
            <h2>Chaînes de caractères et tableaux</h2>
            <p>
            	Les chaînes de caractères possèdent une méthode <strong>split()</strong> qui permet de découper une chaîne en tableau en fonction d'un séparateur.
            </p>
            <pre>
var cousinString = "Pauline Guillaume Clarisse";
    cousinArray = cousinString.split(' ');

    alert(cousinString);
    alert(cousinArray);
            </pre>
            <p>
                L'inverse de <strong>split()</strong>, c'est-à-dire créer une chaîne de caractères depuis un tableau, se nomme <strong>join()</strong>:
            </p>
            <pre>
var cousinString_2 = cousinsArray.join('-');

    alert(cousinString_2);
            </pre>
            <p>
                Ici, une chaîne de caractère va être créée, et la valeur de chaque item sera séparée par un trait d'union. Si vous ne spécifiez rien, nous obtiendrons "GuillaumeSandraJoséphine..."
            </p>
                        
            
            <a name="part_16"></a>
            <h1>Parcourir des Tableaux <span><a href="#">top</a></span></h1>
            <p>
                Nous avons vu la boucle <strong>for</strong>, et c'est elle qui va nous servir à parcourir les tableaux. Nous allons aussi voir une variante de la boucle <strong>for</strong>: la boucle <strong>for in</strong>.
            </p>
            <cite>
                Utilisation <strong>correcte</strong> de la boucle for.
            </cite>
            <pre>
var c = myArray.length; //déclarer dès que la longueur du tableau est connue, évite de surcharger la boucle
                        //sinon a chaque tour elle ré-exécute myArray.length
for(i = 0; i&lt;c; i++)
{
    alert(myArray[i]);
}
            </pre>
            
            
            <a name="part_17"></a>
            <h1>Les Objets littéraux <span><a href="#">top</a></span></h1>
            <p>
                S'il est possible d'accéder à des items d'un tableau via leur indic, il pourait, dans certains cas, être préférable d'y accéder au moyen d'un identifiant.
                Par exemple, dans le tableau des Prénoms, l'item appelée <strong>soeur</strong> pourrait retourner la valeur <strong>Laurence</strong>.
            </p>
            <p>
                Pour ce faire nous allons créer un..., suspense, <strong>Objet Littéral</strong>!
            </p>
            <pre>
var family = { //attention ici ce sont des <strong>{}</strong> et non pas des <strong>[]</strong>.
        self : 'Moi',
        soeur : 'Selena',
        soeur_2 : 'Flavia',
        frere : 'Looney',
        frere_2 : 'Marco'
    };
            </pre>
            <h2>Accès aux items</h2>
            <p>
                Ce que nous avons créé est un objet, et les identifiants sont en fait des <strong>propriétés</strong>, exactement comme les propriétés classiques. Donc pour récupérer le nom de ma soeur il me suffit de faire:
            </p>
            <pre>
myArray.soeur;
            </pre>
            <p>
                On peut aussi accéder à cet item de cette manière:
            </p>
            <pre>
myArray['soeur'];

var id = 'frere';
    alert(myArray[id]); //Affichera 'Looney'
            </pre>
            <cite>
                Ce qui va nous être particulièrement utile si l'identifiant est contenu dans une variable... Comme lors de l'utilisation d'une boucle.
                <br />
                Pour connaître la longueu d'un tableau je peux aussi faire <strong>myArray['length'];</strong>.
            </cite>
            <h2>Ajouter des éléments</h2>
            <p>
                Ici, pas de méthode <strong>push()</strong>. En revanche, il est possible d'ajouter un item en spécifiant un <em>identifiant</em> qui n'est pas encore existant.
            </p>
            <pre>
var myArray['oncle'] = 'Pipo';
            </pre>
            
            <h2>Parcourir un objet avec <strong>for in</strong></h2>
            <p>
                Il n'est pas possible de parcourir un objet littéral avec une boucle <strong>for</strong>. Normal, puiqu'une boucle <strong>for</strong> est surtout capable d'incrémenter une variable numérique, ce qui dans le cas d'un objet littéral nous est totalement inutile.
                Cependant, la boucle <strong>for in</strong> se révèle très intéressante!
            </p>
            <cite>
                La boucle <strong>for in</strong> est l'équivalent JS de la boucle <strong>foreach</strong> en PHP.
            </cite>
            
            <p>
                Le principe de fonctionnement est exactement le même qu'en PHP... il suffit de fournir une "variable clé" qui reçoit un identifiant et de spécifier l'objet à parcourir.
            </p>
            <pre>
for(var id in famille)
{
    alert(famille[id]);
}
            </pre>
            <h2>&dArr; Rien ne vaut la pratique &dArr;</h2>
            <input type="button" onclick="showArray()" value="Listez-moi l'objet littéral">
            <div id="showMyObject">
                <!-- contenu JS -->
            </div>
            
            <script type="text/javascript">
                var familly = {
                  owner : 'Yann',
                  sister_1 : 'Selena',
                  sister_2 : 'Flavia',
                  frere_1 : 'Loooney',
                  frere_2 : 'Marco'
                };
                
                var compteur = 0;
                
                function showArray()
                {
                    compteur++; // permet de compter le nombre d'instance

                    if (compteur < 2 && compteur > 0)
                    {
                        var wrapper = document.getElementById('showMyObject');
                        var liste = document.createElement('ol');
                        for (var id in familly)
                        {
                            el_liste = document.createElement('li');
                            contenu = document.createTextNode(familly[id]);
                            el_liste.appendChild(contenu);
                            liste.appendChild(el_liste);
                        }

                        wrapper.appendChild(liste);
                    }
                }
            </script>
            
            <h2>Utilisation des Objets Littéraux</h2>
            <p>
                Les objets littéraux ne sont pas souvent utilisés, mais peuvent se révéler très utiles. On les utilisent aussi dans les fonctions:<br/>&Square; les fonctions,
                avec <strong>return</strong> ne savent retourner qu'une seule variable... Donc si on veut plusieurs variables il faut les ajouter à un tableau puis
                le retourner. Cependant il est souvent plus commode d'utiliser un objet littéral.
            </p>
            <cite>
                Un exemple concret est la fonction qui calcule des coordonnées d'un élément HTML sur une page web. Il faut ici retourner les coordonnées X et Y.
            </cite>
            <pre>
function getCoords()
{
    //script incomplet, juste pour l'exemple
    coords = {
        x : 12,
        y : 35
    };

    return coords
}

oCoords = getCoords();

alert(oCoords.x);
alert(oCoords.y);
            </pre>
            <cite>
                La valeur de retour de la fonction getCoords() et placée dans une variable oCoords et l'accès à X et Y en est grandement simplifié.
            </cite>
            
            <a name="part_18"></a>
            <h1>Petit exercice récapitulatif <span><a href="#">top</a></span></h1>
            <h2>Ennoncé</h2>
            <p>
                -  Stocker les prénoms dans un tableau. Pensez à la méthode <strong>push()</strong>.<br />-  A la fin il faudra afficher le contenu du tableau avec une <strong>alert()</strong> seulement si le tableau contient des prénoms.Pour l'affichage séparer chaque prénom par un espace.<br />-  Si le tableau ne contient rien faite les savoir à l'utilisateur, toujours avec une alert().
            </p>
            
            <h2>&dArr; Cliquez pour commencer &dArr;</h2>
            <input type="button" onclick="initExercice(printList)" value="commencer la saisie" />
            
            <script type="text/javascript">
                function initExercice(callback)
                {
                    var family = new Array();
                    var value = null;
                    
                    while (true) // tant que l'utilisateur saisi des valeurs
                    {
                        value = prompt('Saisissez les prénoms de personnes que vous connaissez:');
                        if(value && value !== null) // si value est différent de false on réupère la saisie
                        {
                            var aValues = value.split(' '); // si le user saisi plusieurs nom sur la même ligne

                            var aLength = aValues.length;
                            for(i = 0; i < aLength; i++)
                            {
                                family.push(aValues[i]); //on boucle sur le tableau de valeur et on l'insère dans notre array famille
                            }
                            
                        }else{
                            callback(family);
                            break;
                        }
                    }
                }
                
                function printList(aDatas)
                {
                    if(aDatas.length > 0)
                    {
                        var sChaine = aDatas.join('\n');
                        alert(sChaine);
                    }else{
                        alert('Putain z\'avez rien saisi');
                    }
                }
            </script>