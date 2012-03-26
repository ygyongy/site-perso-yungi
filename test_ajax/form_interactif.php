<a href="#part_34">Présentation de l'exercice</a> | <a href="#part_35">Correction du formulaire</a>
        <p>
            Nous sommes presque au bout de cette deuxième partie de cours! Cette dernière aura été très conséquente et il se peut que vous ayez oublié pas mal de choses depuis votre lecture, ce TP va se charger de vous rappeler l'essentiel de ce que nous avons appris ensemble.
        </p>
        <p>
            Le sujet va porter sur la création d'un formulaire dynamique. Qu'est-ce que nous attendons par formulaire dynamique? Eh bien un formulaire dont une partie des vérifications est effectuée par le JS, côté client. On peut par exemple vérifier que l'utilisateur a bien complété tous les champs, ou bien qu'ils contiennent des valeurs valides (si le champ "âge" ne contient pas des lettres au lieu de chiffres par exemple).
        </p>
        <p>
            À ce propos, nous allons tout de suite faire une petite précision très importante pour ce TP et tous vos codes en JS:
        </p>
        
        <cite style="font-weight: bold; padding-top: 15px; font-size: 15px;">
            Une vérification du côté client ne dispense en aucun cas des vérifications serveur!!! En bref utilisez JS pour l'interactivité puis vérifiez réellement côté serveur.
        </cite>
<a name="part_34"></a>
        <h1>Présentation de l'exercice<span><a href="#">top</a></span></h1>
            <p>
                Faire un formulaire c'est bien, mais encore faut-il savoir quoi demander à l'utilisateur. Dans notre cas, nous allons faire simple et classique: un formulaire d'inscription. Notre formulaire comportera un champ pour le pseudo, un autre pour son PWD puis une réponse à une question secrète.
            </p>
            <p>
                <ul>
                    <li>Pseudo plus de 4 caractères</li>
                    <li>MDP deux fois identiques</li>
                    <li>Une réponse secrète de plus de 4 caractères</li>
                </ul>
            </p>
            <p>
                Concrètement, l'utilisateur n'est pas censé connaître toutes ces conditions quand il arrive sur votre formulaire, il faudra donc les lui indiquer avant même qu'il ne commence à entrer des informations, de cette manière il ne perdra pas de temps à corriger ses fautes. Pour cela il va falloir afficher chaque condition d'un champ texte quand l'utilisateur fera une erreur. Pourquoi parlons-nous ici uniquement des champs texte? Tout simplement parce que nous n'allons pas dire à l'utilisateur "Sélectionnez votre sexe" alors qu'il n'a qu'une case à cocher...
            </p>
            
            <p>
                Autre chose, il faudra aussi faire une vérification complète du formulaire lorsque l'utilisateur aura cliqué sur le bouton de soumission. A ce moment là, si l'utilisateur n'a pas coché de case pour son sexe on pourra lui dire qu'il manque une information, pareil s'il n'a pas sélectionnez de pays.
            </p>
            
            <p>
                Vous voilà avec toutes les informations nécessaires pour vous lancer dans ce TP. Nous vous laissons concevoir votre propre code HTML mais vous pouvez très bien utiliser celui de la correction si vous le souhaitez.
            </p>
            
            <h2>
                Début du TP à proprement parler
            </h2>
            
            <style type="text/css">
                #TP_form form fieldset div label
                {
                    display: inline-block;
                    margin-right: 15px;
                    width: 190px;
                    padding: 2px;
                }
                
                #TP_form form fieldset div input, select
                {
                    margin-right: 15px;
                    width: 190px;
                    outline: none;
                    padding: 2px;
                    border: 1px #abadb3 solid;
                }
                
                #TP_form form fieldset div input:focus, select:focus
                {
                    border: 1px dodgerblue solid;
                    background-color: #D7D7D7;
                }
                
                .correct
                {
                    border: 1px #4f8700 solid;
                    background-color: #e5ffce;
                }
                
                .incorrect
                {
                    background-color: pink;
                    border: 1px #DC143C solid;
                    outline: none;
                    font-weight: bold;
                    color: darkred;
                }
                
                .incorrect:focus
                {
                    border: 1px dodgerblue solid;                    
                }                
            </style>
            
            <div id="TP_form">
                <form id="create_user_form">
                    <fieldset>
                        <legend>Formulaire d'authentification</legend>
                        <div>
                            <label for="login">Saisissez votre Login: </label>
                            <input type="text" name="login" id="login" class="required" />
                            <span class="tooltip">Un pseudo doit-être rempli, unique et supérieur à 4 caractères!</span>
                        </div>
                        <div>
                            <label for="password">Saisissez un Password: </label>
                            <input type="password" name="password" id="password" class="required" />
                            <span class="tooltip">Le mot de passe doit correspondre au deuxième</span>
                            <br/>
                            <label for="password2">Re-saisissez votre Password: </label>
                            <input type="password" name="password2" id="password2" class="required" />
                            <span class="tooltip">Le mot de passe doit correspondre au premier</span>
                        </div>
                        <div>
                            <label for="question">Choisissez une question secrète: </label>
                            <select name="question" id="question" class="required">
                                <option value="none">Sélectionnez une question secrète?</option>
                                <option value="ville">Quelle est votre ville d'origine?</option>
                                <option value="maman">Quel est le nom de jeune fille de votre maman?</option>
                                <option value="animal">De quel type était votre premier animal?</option>
                            </select>
                            <span class="tooltip">Vous devez au moins sélectionnez une question</span>
                            <br/><br/>
                            <label for="answer">Saisissez votre réponse: </label>
                            <input type="text" name="answer" id="answer" class="required" />
                            <span class="tooltip">Vous devez répondre à la question avec un minimum de 4 caractères</span>
                        </div>
                        <div>
                            <input type="button" value="créer le membre" name="create_user" id="create_user" />
                            <input type="button" value="effacer le formulaire" name="reset_user" id="reset_user" />
                        </div>
                    </fieldset>
                </form>
            </div>