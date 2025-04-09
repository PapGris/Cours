// commentaire en francais

function fizzbuzz(n) { // n est un entier positif qui indique le nombre de nombres a generer
    const result = []; // tableau vide pour stocker les résultats
    for (let i = 1; i <= n; i++) { // boucle de 1 à n inclus
        // Si i est divisible par 3 et 5, on ajoute "FizzBuzz" au tableau
        // Si i est divisible par 3, on ajoute "Fizz" au tableau
        if (i % 3 === 0 && i % 5 === 0) { // Si i est divisible par 3 et 5, on ajoute "FizzBuzz" au tableau
            // Si i est divisible par 3, on ajoute "Fizz" au tableau
            result.push("FizzBuzz"); // On ajoute "FizzBuzz" au tableau
        // Si i est divisible par 5, on ajoute "Buzz" au tableau
        } else if (i % 3 === 0) { // Si i est divisible par 3, on ajoute "Fizz" au tableau  
            result.push("Fizz"); // On ajoute "Fizz" au tableau
        // Si i est divisible par 5, on ajoute "Buzz" au tableau
        } else if (i % 5 === 0) { // Si i est divisible par 5, on ajoute "Buzz" au tableau
            result.push("Buzz");   // On ajoute "Buzz" au tableau
        // Sinon, on ajoute le nombre i au tableau
        } else { // Sinon, on ajoute le nombre i au tableau
            result.push(i); // On ajoute le nombre i au tableau
        }
    }
    return result; // On retourne le tableau contenant les résultats
}

console.log(fizzbuzz(15)); // On affiche le tableau contenant les résultats
