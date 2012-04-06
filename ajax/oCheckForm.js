/* 
 * Description de l'objet oCheckForm.
 * 
 * Méthodes:
 * ----------------------------------
 * init()
 *  initialise le formulaire
 *
 *  getClassesName(element)
 *  return array classesNames || false
 * 
 * disableToolip()
 * 
 * getTooltip(el)
 *  return el || false
 * 
 * text(el, id)
 *  return true || false
 * 
 * chekBox(el, id)
 *  return true || false
 * 
 * radioButton(el, id)
 *  return true || false
 * 
 * select-one(el, id)
 *  return true || false
 * 
 * password(el, id)
 *  return true || false
 * 
 * textarea(el, id)
 *  return true || false
 * 
 * button(el, id)
 *  return true || false
 * 
 * submit(el, id)
 *  return true || false
 * 
 * reset(el, id)
 * 
 * className(el, id)
 *  return true || false
 * 
 * checkErrors()
 *  return true || false
 * 
 * onSubmit()
 *  return true || false
 * 
 * onReset()
 * ----------------------------------
 * 
 * 
 * 
 * propriétés:
 * ----------------------------------
 * var elements = formElementsCollection
 * var errors = boolean
 * var datasToSend = array
 * var oXHR = oXHR
 * var placeToWrite = divElement
 * var elements = formElementsCollection
 * ----------------------------------
 */

formulaire = {    
    getFormValues : function(oForm){
        if(oForm.length > 1){
            //On essaie d'envoyer plus que 1 formulaire!
            return false;
        }

        var formulaire = oForm[0];
        var inputs = formulaire.getElementsByTagName('*');

        var inputsLength = inputs.length;

            if(inputsLength > 0)
                {
                    return inputs;
                }
            return false;
    },
    
    getClassesName : function(element){
        if(element.className !== undefined)
            {
                var classesName = element.className;
                classesName = classesName.split(' ');
                return classesName;                
            }else{
                return false;
            }
    },
    
    disableTooltip : function(oForm){
        if(oForm.length > 1){
            //On essaie d'envoyer plus que 1 formulaire à la fois!
            return false;
        }
        
        var formulaire = oForm[0];
        
        var spans = formulaire.getElementsByTagName('span');
        var spansLength = spans.length;
        
        for (var i=0; i<spansLength; i++)
            {
                var classesToTest = this.getClassesName(spans[i]);
                var classesToTestLength = classesToTest.length;
                
                for(var j=0; j<classesToTestLength; j++)
                    {
                        if(classesToTest[j] === 'tooltip'){
                            spans[i].style.display = 'none';
                        }                        
                    }
            }
         return true;
    },

    getTooltip : function (element){
        var el = element;
        
        while(el)
            {
                var classesToTest = this.getClassesName(el);
                var classesToTestLength = classesToTest.length;
                
                for(var i=0; i<classesToTestLength; i++)
                    {
                        if(classesToTest[i] === 'tooltip')
                            {
                                return el;
                            }
                    }
                    
                el = el.nextSibling; //sinon on passe au prochain élément
            }
            
         return false;
    },
    
    check : {
        text : function(element){
            
            var el = element;
            var elTooltipStyle = formulaire.getTooltip(el).style;
            var value = el.value;
            var valueLength = value.length;
            
            if(valueLength > 4){
                el.className = 'correct';
                elTooltipStyle.display = 'none';                
                return true;
            }else{
                el.className += ' incorrect';
                elTooltipStyle.display = 'inline-block';
                return false;
            }
        },
        
        password : function(element){
            
            var el = element;
            var elTooltipStyle = formulaire.getTooltip(el).style;
            var value = el.value;
            var valueLength = value.length;
            
            if(valueLength > 6){
                el.className = 'correct';
                elTooltipStyle.display = 'none';
                return true;
            }else{
                el.className += ' incorrect';
                elTooltipStyle.display = 'inline-block';
                return false;
            }
        }        
    }
};


//Initialisation d'une fonction anonyme qui lance l'initialisation
(function(){
    var oForm = document.getElementsByTagName('form');
    var init = {
        elements : formulaire.getFormValues(oForm),
        errors : true,
        dataToSend : new Array(),
        oXHR : getXMLHttpRequest(),
        placeToWrite : document.getElementById('wrapper_fieldset_connexion_user')
    }
    
    var formValues = init.elements;
    var formValuesLength = formValues.length;
    var result = true;
    //result = formulaire.check[formValues[i].type](formValues[i]) && result;

    for(var i=0; i<formValuesLength; i++)
        {
            if(formValues[i].type != undefined)
            {
                formValues[i].onkeyup = function(){
                    formulaire.check[this.type](this);                
                }
            }
        }
    
    formulaire.disableTooltip(oForm);    
})();