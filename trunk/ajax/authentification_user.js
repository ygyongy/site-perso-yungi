/* 
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

var errorsRequired = new Array();
var datasToSend = new Array();
var classToTest = new Array();
var xhr = getXMLHttpRequest();
var placeToWrite = document.getElementById('wrapper_fieldset_connexion_user');
var login;
var pwd;
var grainDeSel;

function requestAuthentificationUser(oForm, callback)
{
    //si le formulaire est soumis
    if(typeof(oForm) !== 'undefined')
    {
        //instanciation de l'envoi des données
        xhr.onreadystatechange = function()
        {
            if (xhr.readyState === 4 && (xhr.status === 200 || xhr.status === 0))
            {
                callback(xhr.responseText, placeToWrite);
            }
        }
        
        //on récupère les champs du formulaire
        formValues = getFormValues(oForm);
        for(var i = 0; i < formValues.length; i++)
            {
                alert(formValues[i]);
            }
        //détection de la class        
        for(i = 0, c = formValues.length; i < c; i++)
        {          
            if(!isRequired(formValues[i].className, formValues[i]['valeur'], formValues[i]['id']))
            {
                return false;
            }else{

                //si c'est un champ de type password il faut le hasher
                if(formValues[i]["type"] === 'password')
                {
                    formValues[i]["valeur"] = hashPassword(getId(formValues, 'login'), getId(formValues, 'pwd'), formValues);
                }
                
                //n'attribue la valeur que si l'élément du tableau est a UNDEFINED
                if(datasToSend[i] === undefined)
                {
                    datasToSend.push(formValues[i]);
                }
            }//fin du test des champs de formulaire pour savoir si ils ont été rempli
            
        }//fin des traitements des champs de formulaire
        
        sendDatas(datasToSend);
        
    }//fin du test pour savoir si le formulaire a bien été envoyé
    
    return false;
}

function hex_md5(s)
{ 
    return rstr2hex(rstr_md5(str2rstr_utf8(s))); 
}

function getFormValues(form)
{
    //récupération des informations du formulaire
    var tmp_form = new Array();
    var oFormLength = form.length;
    
    for(i = 0; i < oFormLength; i++)
    {
        var el = form.elements[i];
        tmp_form[i] = new Array();

        if(el.type.toLowerCase() !== 'reset' && el.type.toLowerCase() !== 'submit')
        {
            //Je cree pour chaque champ un tableau type
            var tmp_field = new Array();
            
            tmp_field['id'] = el.id;
            tmp_field['type'] = el.type;
            tmp_field['class'] = el.className;
            tmp_field['label'] = el.value;
            
            //j'ai un objet PHP serialise dans certain formulaire...
            if(el.type.toLowerCase() !== 'hidden')
            {
                tmp_field['value'] = encodeURIComponent(el.value);
            }else{
                tmp_field['value'] = el.value;
            }
            
            //je pousse mon tableau du champ dans tableau formulaire
            tmp_form[i].push(el);
        }
    }
    
    return tmp_form;    
}

function isRequired(sClasses, sValue, sId)
{
    //on test si la class required est présente
    if(sClasses !== null && sClasses.indexOf('required', sClasses) !== -1)
    {
        //test des champs REQUIS
        if(testField(sValue, sId))
        {
            return true;
        }
        //si la fonction testField return false
        return false;
    }
    //si classe required n est pas trouvee c est OK
    return true;
}

function testField(sField, id_field)
{
    oLabel = document.getElementById('label_'+id_field);
    oError = document.getElementById('error_field_'+id_field);
    oField = document.getElementById(id_field);
    
    if(sField.length < 1)
    {
        oLabel.style.fontStyle = "italic";
        oLabel.style.fontWeight = "600";
        oField.style.border = "1px red solid";
        oError.style.display = "block";
        return false;
    }else{
        oError.style.display = "none";
        oField.style.border = "none";
        oLabel.style.fontWeight = "normal";
        oLabel.style.fontStyle = "normal";
        oLabel.style.display = "block";
        return true;
    }
}

function getId(aDatas, sId)
{
    for(i = 0; i < aDatas.length; i++)
    {
        if(aDatas[i]["id"] === ""+sId+"")
        {
            return i;
        }
    }
    return false;
}

function hashPassword(intValue, intValue2, aDatas)
{
    grainDeSel = "Je ne_5ui5 pa5_un héro!";
    var hash = null;
    hash = hex_md5(grainDeSel+aDatas[intValue2]["valeur"]+grainDeSel+aDatas[intValue]["valeur"]);
    return hash;
}

function sendDatas(aDatas)
{
    var sChaine = null;

    for(i = 0; i < aDatas.length; i++)
    {
        if(i === 0)
        {
            sChaine = ""+aDatas[i]["id"]+"="+aDatas[i]["valeur"];            
        }else{
            sChaine += "&"+aDatas[i]["id"]+"="+aDatas[i]["valeur"];
        }
    }

    xhr.open("post", "/site_perso_yungi/ajax/authentification_user.php", true);
    xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
    xhr.send(sChaine);
}

function printData(datas, outputHTML)
{
    //masque le formulaire de login
    document.getElementById('fieldset_connexion_user').style.display = 'none';
    
    //créé un div pour les retours d'informations
    var element = document.createElement('div');
    element.style.border = "1px deepskyblue solid";
    element.style.padding = "5px";
    
    //datas = JSON.parse(datas)
    
    for(var key in datas)
        {
            var response = document.createTextNode("- "+datas[key]+"");
            var lineBreak = document.createElement('br');
            response.innerHTML = lineBreak;
            element.appendChild(response);
        }

    outputHTML.appendChild(element);
}


