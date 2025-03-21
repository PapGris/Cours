function formsubmit(event) { // Créé une fonction qui prend en paramètre un evenement
    
    document.getElementById("form").querySelectorAll(".error").forEach(function(divError){ // Pour chaque élément du formulaire qui a la classe "error", on lui retire la classe "error" et on supprime le div qui est dedans
        divError.classList.remove("error"); // Retire la classe "error"
        divError.removeChild(divError.querySelector('div')); // Supprime le div
    });

    let allValid = true; // créé la variable allValid = vrai     
    
    document.getElementById('form').querySelectorAll('input[required],textarea,[requierd],select[requierd]').forEach(function(input){ // Pour chaque élément du formulaire qui a un attribut "required", on lui applique la fonction suivante
        if (input.value ==""){ // Si (this = l'element en question) le selecteur CSS 'name' a une valeur vide (""), alors allValid = faux
            input.closest('div').classList.add('error'); // Ajoute la classe "error" à l'élément le plus proche qui a la balise "div"
            let div = document.createElement('div'); // Créé un élément "div"
            let text = document.createTextNode('Attention, champ obligatoire'); // Créé un texte
            div.append(text); // Ajoute le texte à l'élément "div"
            input.closest('div').appendChild(div); // Ajoute l'élément "div" à l'élément le plus proche qui a la balise "div"

            allValid = false;  // allValid = faux
        }
    });

    let inputMail = document.getElementById('email'); // Créé une variable inputMail qui prend l'élément qui a l'id "email"
    if(inputMail.value!=""){
        const regex = new RegExp('^[A-Za-z0-9.\-_\+]+@[A-Za-z0-9.\-]+[.]{1}[A-Za-z0-9]{2,}$',"i"); // => Créé un objet avec les caractère suivant
        if(!regex.test(inputMail.value)){ // Si l'objet regex ne correspond pas à la valeur de inputMail, alors allValid = faux
            inputMail.closest('div').classList.add('error') // Ajoute la classe "error" à l'élément le plus proche qui a la balise "div"
            let div = document.createElement('div'); // Créé un élément "div"
            let text = document.createTextNode('Email invalide'); // Créé un texte
            div.append(text); // Ajoute le texte à l'élément "div"
            inputMail.closest('div').appendChild(div); // Ajoute l'élément "div" à l'élément le plus proche qui a la balise "div"
            allValid=false; // allValid = faux
        }
    }

    if(!allValid){    // Si allValid = faux
        event.preventDefault();  // si AllValid ! (faux) alors l'evenement n'a pas lieu
    } 

}

document.getElementById('form').addEventListener('submit',formsubmit); //   Ajoute un écouteur d'événements pour le formulaire qui appelle la fonction formsubmit
document.getElementById('btn').addEventListener('click',formsubmit); //   Ajoute un écouteur d'événements pour le bouton qui appelle la fonction formsubmit



