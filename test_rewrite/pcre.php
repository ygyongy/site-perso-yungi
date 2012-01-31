<!--
To change this template, choose Tools | Templates
and open the template in the editor.
-->
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <title>Etude sur les expressions de type PCRE</title>
    </head>
    <body style="width: 600px; font-family: Arial; font-size: 12px; color: #838383; text-align: justify; margin-bottom: 100px; margin-right: auto; margin-left: auto;">
        <a href="#part_1">Partie I</a> | <a href="#part_2">Partie II</a> | <a href="#part_3">Partie III</a> | <a href="#part_4">Partie IV</a>
        <a name="part_1"></a>
        <h1 style="border-bottom: 1px dodgerblue solid;">Etude sur les expressions de type PCRE part. I</h1>
        <p>
            Mon secteur d'étude va se délimiter aux expressions rationnelles dérivée de PERL, soit les PCRE en laissant de côté les POSIX
        </p>
        <p>
            Les PCRE sont bien plus rapides et plus complètes que POSIX.
        </p>
        <h2 style="border-bottom: 1px dodgerblue dotted; font-size: 14px;">La liste des fonctions que nous utiliserons pour faire des REGEX</h2>
        <ul>
            <li>preg_match()</li>
            <li>preg_match_all()</li>
            <li>preg_replace()</li>
            <li>preg_replace_callback()</li>
            <li>preg_split()</li>
            <li>preg_grep()</li>
            <li>preg_quote()</li>
        </ul>
        <h2 style="border-bottom: 1px dodgerblue dotted; font-size: 14px;">Que dois-je savoir avant de commencer?</h2>
        <p>
            <br>
            L'élément primordial avant de commencer, c'est de savoir comment écrire un motif de regex PCRE. Un motif doit ABSOLUMENT, être délimité afin de dire au moteur REGEX où commencer et où se termine le masque de recherche.
            Personnellement je choisirais le dièse # car c'est un caractère très peu utilisé.
            <br>
            Délimité le motif de REGEX sert également à l'emploi d'une série d'options propre aux PCRE. Les PCRE, contrairement aux POSIX, acceptent une série d'options qui agissent sur la manière dont le motif est traiter par le moteur d'expressions régulières.
        </p>
        <code>
            &lt;?php<br>
            preg_match('<b>#</b>((?&lt;!//)(www\.\S+[[:alnum:]]/?))<b>#</b><i>si</i>', $chaine);<br>
            ?&gt;
        </code>
        <h2 style="border-bottom: 1px dodgerblue dotted; font-size: 14px;">REGEX pour vérifier une simple chaine chifrée</h2>
        <code>
            &lt;?php<br>
            $string = 1515;<br>
            if(preg_match('#5#', $string))<br>
            {<br>
                echo "vrai";<br>
            }else{<br>
                echo "faux";<br>
            }<br>
           
            ?&gt;
        </code>
        <h2 style="border-bottom: 1px dodgerblue dotted; font-size: 14px;">Test PHP</h2>
        <p style="width: 400px; border: 1px dodgerblue dotted; background-color: silver; color: white; font-weight: 600; text-align: center; padding: 2px;">
        <?php
            $int = 1515;
            if(preg_match('#5#', $int))
            {
                echo "TRUE";
            }else{
                echo "FALSE";
            }
        ?>
        </p>
        <p>
            Le motif est archi simple, il demande juste au moteur de REGEX de rechercher le chiffre '5' dans la chaine.
            <br><br>
            <strong>Légère variante</strong>: <i>'#^5#'</i>
            <br>
            Vous avez certainement remarqué le circonflexe... => il signifie que la chaine DOIT commencer par un '5'
        </p>
        <h2 style="border-bottom: 1px dodgerblue dotted; font-size: 14px;">re-Testons PHP</h2>
        <p style="width: 400px; border: 1px dodgerblue dotted; background-color: silver; color: white; font-weight: 600; text-align: center; padding: 2px;">
        <?php
            $int = 1515;
            if(preg_match('#^5#', $int))
            {
                echo "TRUE";
            }else{
                echo "FALSE";
            }
        ?>
        </p>
        <p>
            <strong>Autre variante</strong>: <i>'#5$#'</i>
            <br>
            Vous avez certainement remarqué le $... => il signifie que la chaine DOIT finir par un '5'
        </p>
        <h2 style="border-bottom: 1px dodgerblue dotted; font-size: 14px;">re-Testons PHP</h2>
        <p style="width: 400px; border: 1px dodgerblue dotted; background-color: silver; color: white; font-weight: 600; text-align: center; padding: 2px;">
        <?php
            $int = 1515;
            if(preg_match('#5$#', $int))
            {
                echo "TRUE";
            }else{
                echo "FALSE";
            }
        ?>
        </p>
        <a name="part_2"></a>
        <h1 style="border-bottom: 1px dodgerblue solid;">Etude sur les expressions de type PCRE part. II</h1>
        <h2 style="border-bottom: 1px dodgerblue dotted; font-size: 14px;">Introduction au classes ou plages de caractères [0-9][a-z]</h2>
        <p>
            Motif avec classe de caractère:
        </p>
        <h2 style="border-bottom: 1px dodgerblue dotted; font-size: 14px;">REGEX pour vérifier une simple chaine chifrée</h2>
        <code>
            &lt;?php<br>
            $string = 1515;<br>
            if(preg_match('#[0-9]#', $string))<br>
            {<br>
                echo "vrai";<br>
            }else{<br>
                echo "faux";<br>
            }<br>

            ?&gt;
        </code>
        <h2 style="border-bottom: 1px dodgerblue dotted; font-size: 14px;">Test PHP</h2>
        <p>Sans flag pour de placement</p>
        <p style="width: 400px; border: 1px dodgerblue dotted; background-color: silver; color: white; font-weight: 600; text-align: center; padding: 2px;">
        <?php
            $int = 1515;
            if(preg_match('#[0-9]#', $int))
            {
                echo "TRUE";
            }else{
                echo "FALSE";
            }
        ?>
        </p>
        <p>Avec flag de placement '^'</p>
        <p style="width: 400px; border: 1px dodgerblue dotted; background-color: silver; color: white; font-weight: 600; text-align: center; padding: 2px;">
        <?php
            $int = 1515;
            if(preg_match('#^[0-9]#', $int))
            {
                echo "TRUE";
            }else{
                echo "FALSE";
            }
        ?>
        </p>
        <p>Avec flag de placement '$'</p>
        <p style="width: 400px; border: 1px dodgerblue dotted; background-color: silver; color: white; font-weight: 600; text-align: center; padding: 2px;">
        <?php
            $int = 1515;
            if(preg_match('#[0-9]$#', $int))
            {
                echo "TRUE";
            }else{
                echo "FALSE";
            }
        ?>
        </p>
        <p>Avec flag de placement '^' et '$'</p>
        <p style="width: 400px; border: 1px dodgerblue dotted; background-color: silver; color: white; font-weight: 600; text-align: center; padding: 2px;">
        <?php
            $int = 1515;
            if(preg_match('#^[0-9]$#', $int))
            {
                echo "TRUE";
            }else{
                echo "FALSE";
            }
        ?>
        </p>
        <cite>
            "Mais pourquoi est-ce faux?"
            <br>
            Pourtant ma chaine commence bien par un chiffre et se termine aussi par un nombre...
            <br>
            <span style="color: darkred;">Oui en effet, MAIS la chaine contient plus d'un chiffre on va devoir alors commencer à utiliser des <strong>quantificateurs</strong>?!?</span>
            <br>
            Ttels que:
            <ul>
                <li>?</li>
                <li>*</li>
                <li>intervales de reconnaissance {1}, {13}, etc...</li>
            </ul>
        </cite>
        <p>
           Que se passe-t-il réellement dans le moteur de REGEX?
           <br>
           En fait, sans mettre de quantificateurs, le moteur cherche une chaine qui commence et se termine par 1 ET UN SEUL chiffre! Genre 5 ou 8 ou 3, ...
        </p>
        <h2 style="border-bottom: 1px dodgerblue dotted; font-size: 14px;">REGEX avec Quantificateur</h2>
        <code>
            &lt;?php<br>
            $string = 1515;<br>
            if(preg_match('#^[0-9]+$#', $string))<br>
            {<br>
                echo "vrai";<br>
            }else{<br>
                echo "faux";<br>
            }<br>

            ?&gt;
        </code>
        <h2 style="border-bottom: 1px dodgerblue dotted; font-size: 14px;">Et maintenant la fonction retourne:</h2>
        <p style="width: 400px; border: 1px dodgerblue dotted; background-color: silver; color: white; font-weight: 600; text-align: center; padding: 2px;">
        <?php
            $int = 1515;
            if(preg_match('#^[0-9]+$#', $int))
            {
                echo "TRUE";
            }else{
                echo "FALSE";
            }
        ?>
        </p>
        <h2 style="border-bottom: 1px dodgerblue dotted; font-size: 14px;">La même chose avec des caractères</h2>
        <p>
            Premier exemple simple avec la classe [a-z], qui me permet de couvrir les 26 lettres de l'alphabet.
        </p>
        <h2 style="border-bottom: 1px dodgerblue dotted; font-size: 14px;">REGEX pour vérifier une simple chaine de caractères</h2>
        <code>
            &lt;?php<br>
            $string = 'banane';<br>
            if(preg_match('#^[a-z]+$#', $string))<br>
            {<br>
                echo "vrai";<br>
            }else{<br>
                echo "faux";<br>
            }<br>

            ?&gt;
        </code>
        <h2 style="border-bottom: 1px dodgerblue dotted; font-size: 14px;">Test PHP</h2>
        <p style="width: 400px; border: 1px dodgerblue dotted; background-color: silver; color: white; font-weight: 600; text-align: center; padding: 2px;">
        <?php
            $int = 'banane';
            if(preg_match('#^[a-z]+$#', $int))
            {
                echo "TRUE";
            }else{
                echo "FALSE";
            }
        ?>
        </p>
        <h2 style="border-bottom: 1px dodgerblue dotted; font-size: 14px;">Même chose mais avec 'Banane', notez la majuscule</h2>
        <code>
            &lt;?php<br>
            $string = 'Banane';<br>
            if(preg_match('#^[a-z]+$#', $string))<br>
            {<br>
                echo "vrai";<br>
            }else{<br>
                echo "faux";<br>
            }<br>

            ?&gt;
        </code>
        <h2 style="border-bottom: 1px dodgerblue dotted; font-size: 14px;">Test PHP</h2>
        <p style="width: 400px; border: 1px dodgerblue dotted; background-color: silver; color: white; font-weight: 600; text-align: center; padding: 2px;">
        <?php
            $int = 'Banane';
            if(preg_match('#^[a-z]+$#', $int))
            {
                echo "TRUE";
            }else{
                echo "FALSE";
            }
        ?>
        </p>
        <cite>
            "Mais pourquoi est-ce faux?"
            <br>
            Pourtant ma chaine commence bien par une lettre et se termine aussi par une lettre le quantificateur est présent...
            <br>
            <span style="color: darkred;">Oui en effet, MAIS la chaine est composée d'une <strong>Majuscule</strong>, et oui les regex sont casses sensitive!</span>
            <br>
            Dès lors:
            <ul>
                <li>[a-z]</li>
                <li>[A-Z]</li>
                <li>[a-zA-Z]</li>
            </ul>
        </cite>
        <h2 style="border-bottom: 1px dodgerblue dotted; font-size: 14px;">Et cette fois</h2>
        <p style="width: 400px; border: 1px dodgerblue dotted; background-color: silver; color: white; font-weight: 600; text-align: center; padding: 2px;">
        <?php
            $int = 'Banane';
            if(preg_match('#^[a-zA-Z]+$#', $int))
            {
                echo "TRUE";
            }else{
                echo "FALSE";
            }
        ?>
        </p>
        <h2 style="border-bottom: 1px dodgerblue dotted; font-size: 14px;">Même chose mais avec utilisation d'une option #^[a-z]+$#<span style="color: darkred;">i</span></h2>
        <p>Notez bien la position du " I " en dehors des " # "</p>
        <code>
            &lt;?php<br>
            $string = 'Banane';<br>
            if(preg_match('#^[a-z]+$#i', $string))<br>
            {<br>
                echo "vrai";<br>
            }else{<br>
                echo "faux";<br>
            }<br>

            ?&gt;
        </code>
        <h2 style="border-bottom: 1px dodgerblue dotted; font-size: 14px;">Et cette fois aussi...</h2>
        <p style="width: 400px; border: 1px dodgerblue dotted; background-color: silver; color: white; font-weight: 600; text-align: center; padding: 2px;">
        <?php
            $int = 'Banane';
            if(preg_match('#^[a-z]+$#i', $int))
            {
                echo "TRUE";
            }else{
                echo "FALSE";
            }
        ?>
        </p>
        <a name="part_3"></a>
        <h1 style="border-bottom: 1px dodgerblue solid;">Etude sur les expressions de type PCRE part. III</h1>
        <p>
            On continue mais là ca va se corser dure!
        </p>
        <p>
            Nous allons mettre en pratique les INTEVALLES. Nous en avons déjà abordé la syntaxe un peu plus haut.
            Bref rappel {1}, {13}, ... Nous allons donc effectuer trois tests:
        </p>
        <code>
            &lt;?php<br>
            $string_1 = 1;<br>
            $string_2 = 11;<br/>
            $string_3 = 111; <br>
            if(preg_match('#[0-9]{2}#', $string))<br>
            {<br>
                echo "vrai";<br>
            }else{<br>
                echo "faux";<br>
            }<br>

            ?&gt;
        </code>
        <h2 style="border-bottom: 1px dodgerblue dotted; font-size: 14px;">Nos trois tests successifs</h2>
        <p style="width: 400px; border: 1px dodgerblue dotted; background-color: silver; color: white; font-weight: 600; text-align: center; padding: 2px;">
        <?php
            $int = 1;
            if(preg_match('#[0-9]{2}#', $int))
            {
                echo "TRUE";
            }else{
                echo "FALSE";
            }
        ?>
        </p>
        <p style="width: 400px; border: 1px dodgerblue dotted; background-color: silver; color: white; font-weight: 600; text-align: center; padding: 2px;">
        <?php
            $int = 11;
            if(preg_match('#[0-9]{2}#', $int))
            {
                echo "TRUE";
            }else{
                echo "FALSE";
            }
        ?>
        </p>
        <p style="width: 400px; border: 1px dodgerblue dotted; background-color: silver; color: white; font-weight: 600; text-align: center; padding: 2px;">
        <?php
            $int = 111;
            if(preg_match('#[0-9]{2}#', $int))
            {
                echo "TRUE";
            }else{
                echo "FALSE";
            }
        ?>
        </p>
        <cite>
            "Mais pourquoi est-ce vrai?"
            <br>
            Pourtant ma chaine comporte pourtant 3 caractères...
            <br>
            <span style="color: darkred;">Oui en effet, MAIS le moteur demande au <strong>Minimum</strong> 2 caractères!</span>
        </cite>
        <h2 style="border-bottom: 1px dodgerblue dotted; font-size: 14px;">Test d'une url</h2>
        <p style="width: 400px; border: 1px dodgerblue dotted; background-color: silver; color: white; font-weight: 600; text-align: center; padding: 2px;">
        <?php
            $int = '/fr/Accueil/';
            if(preg_match('#^/[a-zA-Z]{2,2}/[a-zA-Z]+/$#', $int))
            {
                echo "TRUE";
            }else{
                echo "FALSE";
            }
        ?>
        </p>
        <h2 style="border-bottom: 1px dodgerblue dotted; font-size: 14px;">Test d'une de saisie d'un E-Mail <?php $int = 'ygyongy.gyongy@tradiluxe.co.uk'; echo "<i>".$int."</i>";?></h2>
        <p style="width: 400px; border: 1px dodgerblue dotted; background-color: silver; color: white; font-weight: 600; text-align: center; padding: 2px;">
        <?php
            if(preg_match('#^([a-z0-9]+)([\.-_]?[a-z0-9]+)@([a-z0-9]+)([\.-_]?[a-z0-9]+)\.([a-z]{2,3})$#i', $int))
            {
                echo "TRUE";
            }else{
                echo "FALSE";
            }
        ?>
        </p>
        <h2 style="border-bottom: 1px dodgerblue dotted; font-size: 14px;">Test de remplacement d'un E-Mail <?php $int = 'ygyongy.gyongy@tradiluxe.co.uk'; echo "<i>".$int."</i>";?></h2>
        <p style="width: 400px; border: 1px dodgerblue dotted; background-color: silver; color: white; font-weight: 600; text-align: center; padding: 2px;">
        <?php
            $regex = '#^([a-z0-9]+)([\.-_]?[a-z0-9]+)@([a-z0-9]+)([\.-_]?[a-z0-9]+)(\.[a-z]{2,3})$#i';
            preg_match_all($regex, $int, $tmp);

            //$tmp est le tableau contenant les variables retourné par la fonction preg_match_all
            $mail_link = "<a href='mailto:$1$2@$3$$4$5'>$int</a>";
            $mail_link .= $tmp[1][0].$tmp[2][0]."@".$tmp[3][0].$tmp[4][0].$tmp[5][0];
            $mail_link .= "'>".$int."</a>";

            //attention les vriables du REPLACE sont prise en compte SANS la concaténation!!!
            $link = preg_replace($regex, '<a href="mailto:$1$2@$3$4$5">'.$int.'</a>', $int);
            echo $link;
        ?>
        </p>
        <a name="part_4"></a>
        <h1 style="border-bottom: 1px dodgerblue solid;">Une histoire de métacaractères part. VI</h1>
        <p>
            Dans le language PCRE il y a un certain nombre de métacaractères:
            <br />
            <span style="color: orange; font-weight: 600;"># ! ^ $ ( ) [ ] { } ? + * . \ |</span>
        </p>
        <p>
            Dès lors si vous voulez utilisez un pattern incluant un de ses caractères il vous est indispensable de l'échapper...
            Il y a juste une règle spéciale pour le - il doit TOUJOURS se trouver en début ou fin de classe [-...] ou [...-]
            Et pour le \ ne pas le mettre en fin de classe
        </p>
        <p style="width: 400px; border: 1px dodgerblue dotted; background-color: silver; color: white; font-weight: 600; text-align: center; padding: 2px;">
            #Quoi ?#
            <br />
            #Quoi <span style="color: red;">\</span>?#
        </p>
        <p>
            Quelques exemples de mise en pratique:
        </p>
        <code>
            &lt;?php<br>
            $string_1 = 'Je suis impatiens!';<br>
            $string_2 = 'Je suis (très) fatigué!';<br/>
            $string_3 = 'J\'ai sommeil...'; <i>on doit échapper " ' " avec le BackSlash déjà en PHP</i><br>
            $string_4 = 'Le smiley :-\\'; <i>on doit doubler le BackSlash déjà en PHP</i><br>
            if(preg_match([<i><span style="color: red;">la regex</span></i>], $string))<br>
            {<br>
                echo "vrai";<br>
            }else{<br>
                echo "faux";<br>
            }<br>

            ?&gt;
        </code>
        <h2 style="border-bottom: 1px dodgerblue dotted; font-size: 14px;">Voici le résultat:</h2>
        <p style="width: 400px; border: 1px dodgerblue dotted; background-color: silver; color: white; font-weight: 600; text-align: center; padding: 2px;">
        <?php
            $string = array(
                1 => 'Je suis impatiens!',
                2 => 'Je suis (tres) fatigue!',
                3 => 'J\'ai sommeil...',
                4 => "Un smiley :-\\"
            );
            
            //attention aux espaces dans les classes
            $regexs = array(
                1 => '#^([a-z ]+)+\!$#i',
                2 => '#^[a-z ]+ [(a-z)]+ [a-z]+\!$#i',   //ici on échappe les parenthèses!!!
                3 => '#^[a-z \']+[\.]{3}$#i',
                4 => '#^[a-z ]+ [-\:]#i'
            );

            foreach($string as $key => $value)
            {
                if(preg_match_all($regexs[$key], $value, $tmp))
                {
                    echo $value.' - '.$regexs[$key]." => TRUE";
                    echo "<br>";
                }else{
                    echo $value.' - '.$regexs[$key]." => FALSE";
                    echo "<br>";
                }
            }
        ?>
        <h2 style="border-bottom: 1px dodgerblue dotted; font-size: 14px;">Les classes abrégées</h2>
        <p>
            Bon maintenant j'arrive presque à faire toutes les REGEXS que je veux, mais seulement PRESQUE.
            <br><br>
            On va donc vous présenté classes abrégées, enfin appelons ça des raccourcis c'est un peu plus parlant.
            Délimité le motif de REGEX sert également à l'emploi d'une série d'options propre aux PCRE. Les PCRE, contrairement aux POSIX, acceptent une série d'options qui agissent sur la manière dont le motif est traiter par le moteur d'expressions régulières.
        </p>
        <ul>
            <li>\d => Indique un chiffre === [0-9]</li>
            <li>\D => Indique un chiffre === [^0-9] => exclusion</li>
            <li>\w => Indique un mot === [a-zA-Z0-9_]</li>
            <li>\W => Indique un mot === [^a-zA-Z0-9_] => exclusion</li>
            <li>\t => Indique un tabulation</li>
            <li>\n => Indique un une nouvelle ligne</li>
            <li>\r => Indique un retour de chariot</li>
            <li>\s => Indique un un retour à la ligne blanc</li>
            <li>\S => Indique un mot => exclusion</li>
            <li>. => Indique un n'importe quel caractères donc TOUT</li>
        </ul>
            <?php
                $pattern_links = '#(http://)?(www\.)?([-\w.]*)\.([a-z0-9]*)#iU';
                $link = 'http://google.com Je entreprise suis la page entreprise';
                $link = preg_replace($pattern_links, '<a href="$1$2$3.$4" target="_blank" title="$2$3.$4">$2$3.$4</a>', $link);
                echo "liens: ".$link;
            ?>
    </body>
</html>
