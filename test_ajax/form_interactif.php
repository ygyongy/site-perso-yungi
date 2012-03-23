<a href="#part_34">Présentation de l'exercice</a> | <a href="#part_35">Correction du formulaire</a>
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