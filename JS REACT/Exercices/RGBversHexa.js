
function toHex(x) { // Convertit un nombre décimal en hexadécimal avec 2 chiffres par octet 
    return x.toString(16).padStart(2, '0'); // Convertit le nombre en hexadécimal et ajoute des zéros à gauche si nécessaire 
}


function toHexColor(r, g, b) { // Convertit les valeurs RGB en couleur hexadécimale 
    const rh = toHex(r); // Convertit la valeur rouge en hexadécimal
    // Convertit la valeur verte en hexadécimal
    const rg = toHex(g); // Convertit la valeur verte en hexadécimal
    // Convertit la valeur bleue en hexadécimal
    const rb = toHex(b); // Convertit la valeur bleue en hexadécimal
    // Retourne la chaîne de caractères représentant la couleur hexadécimale
    return "#" + rh + rg + rb; // Concatène le caractère "#" avec les valeurs hexadécimales
    // Retourne la chaîne de caractères représentant la couleur hexadécimale
}

console.log(toHexColor(255, 0, 0)); // #ff0000