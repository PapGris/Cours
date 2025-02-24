function formsubmit(event) {
    
    document.getElementById("form").querySelectorAll(".error").forEach(function(divError){
        divError.classList.remove("error");
        divError.removeChild(divError.querySelector('div'));
    });

    let allValid = true; // créé la variable allValid = vrai     
    
    document.getElementById('form').querySelectorAll('input[required],textarea,[requierd],select[requierd]').forEach(function(input){
        if (input.value ==""){ // Si (this = l'element en question) le selecteur CSS 'name' a une valeur vide (""), alors allValid = faux
            input.closest('div').classList.add('error'); 
            let div = document.createElement('div');
            let text = document.createTextNode('Attention, champ obligatoire');
            div.append(text);
            input.closest('div').appendChild(div);

            allValid = false;  
        }
    });

    let inputMail = document.getElementById('email');
    if(inputMail.value!=""){
        const regex = new RegExp('^[A-Za-z0-9.\-_\+]+@[A-Za-z0-9.\-]+[.]{1}[A-Za-z0-9]{2,}$',"i"); // => Créé un objet avec les caractère suivant
        if(!regex.test(inputMail.value)){
            inputMail.closest('div').classList.add('error')
            let div = document.createElement('div');
            let text = document.createTextNode('Email invalide');
            div.append(text);
            inputMail.closest('div').appendChild(div);
            allValid=false;
        }
    }

    if(!allValid){   
        event.preventDefault();  // si AllValid ! (faux) alors l'evenement n'a pas lieu
    } 

}

document.getElementById('form').addEventListener('submit',formsubmit);
document.getElementById('btn').addEventListener('click',formsubmit);



