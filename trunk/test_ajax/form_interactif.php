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
                    <li>MDP deux fois identiques et plus de 6 caractères</li>
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
                }
                
                #TP_form form fieldset div select
                {
                    width: 196px;
                }
                
                #TP_form form fieldset div input:focus, select:focus
                {
                    border: 1px dodgerblue solid;
                    background-color: #D7D7D7;
                    padding: 2px;
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
                    padding: 2px;
                }
                
                .tooltip
                {
                    display: inline-block;
                    -moz-border-radius: 3px;
                    -webkit-border-radius: 3px;
                    border: darkred 1px solid;
                    background: pink;
                    padding: 3px;
                    padding-left: 25px;
                    margin-left: 10px;
                    background-image: url('image/box-error.gif');
                    background-repeat: no-repeat;
                    background-position: 5px;
                    color: darkred;
                }
                
                #secret_question
                {
                    padding: 2px;
                    margin-left: 212px;
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
                            <span class="tooltip">Le mot de passe doit faire plus de 6 caractères</span>
                            <br/>
                            <label for="password2">Re-saisissez votre Password: </label>
                            <input type="password" name="password2" id="password2" class="required" />
                            <span class="tooltip">Les mots de passe doivent correspondre</span>
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
                            <br/>
                                <span id="secret_question"></span>
                            <br/>
                            <label for="answer">Saisissez votre réponse: </label>
                            <input type="text" name="answer" id="answer" class="required" />
                            <span class="tooltip">Vous devez répondre à la question avec un minimum de 4 caractères</span>
                        </div>
                        <div>
                            <input type="submit" value="créer le membre" name="create_user" id="create_user" />
                            <input type="reset" value="effacer le formulaire" name="reset_user" id="reset_user" />
                        </div>
                    </fieldset>
                </form>
                
                
                
                <script type="text/javascript">
                    (function(){ //utilisation d'une fonction anonyme pour plus d'aisance
                        function disableTooltips()
                        {
                            var spans = document.getElementsByTagName('span');
                            var spansLength = spans.length;
                            
                            for(i = 0; i < spansLength; i++)
                                {
                                    if(spans[i].className === 'tooltip')
                                        {
                                            spans[i].style.display = 'none';
                                        }
                                }
                        }
                        
                        function getTooltip(element)
                        {
                            var el = element;
                            
                            while(el)
                                {
                                    if(el.className === 'tooltip')
                                        {
                                            return el; // si la classe eset bien tooltip tu retournes l'élément
                                        }
                                    el = el.nextSibling; //ne pas oublier à la fin de la boucle de changer le statut de l'élément testé... sinon boucle sans fin
                                }
                                
                             return false; //si l'élément n'as pas de frère il n'y a pas de tooltip existant
                        }
                        
                        
                        //Maintenant pour contrôler le formulaire je pense faire un objet JSON
                        var check = {};
                        
                            check['login'] = function(){
                                var login = document.getElementById('login');
                                var value = login.value.length;
                                
                                var tooltipStyle = getTooltip(login).style;
                                
                                if(value <= 4)
                                    {
                                        login.className = 'incorrect';
                                        tooltipStyle.display = 'inline-block';
                                        return false;
                                    }else{
                                        login.className = 'correct';
                                        tooltipStyle.display = 'none';
                                        return true;
                                    }
                            };
                            
                            check['password'] = function(){
                                var pwd1 = document.getElementById('password');
                                var tooltipStyle = getTooltip(pwd1).style;
                                var value = pwd1.value.length;
                                
                                if(value <= 6)
                                    {
                                        pwd1.className = 'incorrect';
                                        tooltipStyle.display = 'inline-block';
                                        return false;
                                    }else{
                                        pwd1.className = 'correct';
                                        tooltipStyle.display = 'none';
                                        return false;
                                    }
                            };
                            
                            check['password2'] = function(){
                                var pwd1 = document.getElementById('password');
                                var pwd2 = document.getElementById('password2');
                                var tooltipStyle = getTooltip(pwd2).style;
                                
                                var pwd1Value = pwd1.value;
                                var pwd2Value = pwd2.value;
                                
                                if(pwd1Value !== pwd2Value)
                                    {
                                        pwd2.className = 'incorrect';
                                        tooltipStyle.display = 'inline-block';
                                        return false;
                                    }else{
                                        pwd2.className = 'correct';
                                        tooltipStyle.display = 'none';
                                        return true;
                                    }
                            };
                            
                            check['question'] = function(){
                                var question = document.getElementById('question');
                                var tooltipStyle = getTooltip(question).style;
                                var wrapper = document.getElementById('secret_question');
                                
                                if(question.options[question.selectedIndex].value !== 'none')
                                    {
                                        var txt = question.options[question.selectedIndex].innerHTML;
                                        question.className = 'correct';
                                        wrapper.style.display = 'inline-block';
                                        wrapper.innerHTML = txt;
                                        wrapper.className = 'correct';
                                        tooltipStyle.display = 'none';
                                        return true;
                                    }else{
                                        question.className = 'incorrect'
                                        tooltipStyle.display = 'inline-block';
                                        wrapper.style.display = 'none';
                                        return false;
                                    }
                            };
                            
                            check['answer'] = function(){
                                var answer = document.getElementById('answer');
                                var tooltipStyle = getTooltip(answer).style;
                                var value = answer.value.length;
                                
                                if(value <= 4)
                                    {
                                        answer.className = 'incorrect';
                                        tooltipStyle.display = 'inline-block';
                                        return false
                                    }else{
                                        answer.className = 'correct';
                                        tooltipStyle.display = 'none';
                                        return true;
                                    }
                            };
                            // Fin de l'objet de contrôle du formulaire
                            
                            
                            //Mise en place des événemnts
                            (function(){
                                //utilisation d'une fonction anonyme afin d'éviter les variables globales
                                var myForm = document.getElementById('create_user_form');
                                var inputs = myForm.getElementsByTagName('*');
                                
                                var inputsLength = inputs.length;
                                
                                for(i = 0; i < inputsLength; i++)
                                    {
                                        if(inputs[i].type == 'text' || inputs[i].type == 'password')
                                            {
                                                inputs[i].onkeyup = function(){
                                                    check[this.id]();
                                                };
                                            }else if (inputs[i].type == 'select-one'){
                                                inputs[i].onchange = function(){
                                                    check[this.id]();
                                                };
                                            }
                                    }
                                    
                                 myForm.onsubmit = function(){
                                     var result = true;
                                     
                                     for(j in check) // le fameux foreach en JS
                                         {
                                             result = check[j] && result;
                                         }
                                         
                                     if (result){
                                         alert('Le Formulaire est bien rempli');
                                     }
                                     
                                     return false;
                                 }
                            })();
                        
                        
                        disableTooltips();
                        testss = document.getElementById('answer');
                        testss.onkeyup = check[testss.id];
                    })();
                </script>
            </div>