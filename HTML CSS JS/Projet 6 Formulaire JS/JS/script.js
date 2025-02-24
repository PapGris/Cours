document.getElementById('form').addEventListener('submit',function(event){

    let allValid = true; // créé la variable allValid = vrai
    
    let inputArray = ['name', 'firstname', 'email', 'password', 'confirm_password']; // Créé un tableau (liste) pour l'appeler 
    for(inputId of inputArray) {

        let input = this.querySelector('#'+ inputId); // appelle le tableau inputArray
        if (input.value ==""){ // Si (this = l'element en question) le selecteur CSS 'name' a une valeur vide (""), alors allValid = faux
            input.closest('div').classList.add('error'); 
            let div = document.createElement('div');
            let text = document.createTextNode('Attention, champ obligatoire');
            div.appendChild(text);
            input.closest('div').appendChild(div);

            allValid = false;  
        }
    }
    if(!allValid){   
        event.preventDefault();  // si AllValid ! (faux) alors l'evenement n'a pas lieu
    } 
});

