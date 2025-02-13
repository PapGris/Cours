

<?php

/* =========  AUTRE EXERCICE TABLEAUX ========== */

$articles = [
    [
        "marque" => "Apple",
        "objet" => "Iphone 15",
        "couleur" => "Noir",
        "prix" => 300,
        "id" => rand(1,100)
    ],
    [
        "marque" => "Samsung",
        "objet" => "Téléviseur",
        "couleur" => "Argenté",
        "prix" => 799,
        "id" => rand(1,100)
    ],
    [
        "marque" => "Nike",
        "objet" => "Baskets",
        "couleur" => "Blanc",
        "prix" => 129,
        "id" => rand(1,100)
    ],
    [
        "marque" => "Sony",
        "objet" => "Casque Audio",
        "couleur" => "Bleu",
        "prix" => 419,
        "id" => rand(1,100)
    ],
    [
        "marque" => "Nintendo",
        "objet" => "Switch",
        "couleur" => "Jaune",
        "prix" => 299,
        "id" => rand(1,100)
    ]
];

$articles_additionnels = [
    [
        "marque" => "Huawei",
        "objet" => "Smartphone",
        "couleur" => "Rouge",
        "prix" => 599,
        "id" => rand(1,100)
    ],
    [
        "marque" => "LG",
        "objet" => "Moniteur",
        "couleur" => "Noir",
        "prix" => 249,
        "id" => rand(1,100)
    ]
];

$articles = array_merge($articles, $articles_additionnels); /* Fusionner les deux tableaux */


usort($articles, function($a, $b) {
    return $a["prix"] <=> $b["prix"];
});

?>
<!DOCTYPE html>
<html lang="fr">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Tableau des Produits</title>
    </head>
    <body>
        <table border="1" style="width:50%;margin:auto;margin-top:80px;border:solid;">
            <tr style="background-color:brown;color:white;">
                <th>ID</th>
                <th>Marque</th>
                <th>Nom</th>
                <th>Couleur</th>
                <th>Prix (€)</th>
            </tr>
            <?php 
            foreach ($articles as $article) {
                echo "<tr>
                    <td>". $article["id"]." </td>
                    <td>".strtoupper ($article["marque"])." </td>
                    <td>". $article["objet"]." </td>
                    <td>". $article["couleur"]." </td>
                    <td>". $article["prix"]." </td>
                </tr>";
            }
            ?>
        </table>
    </body>
</html>

/* ======================== Tableau Client ================================ */<br>

<?php

$users = [
    [
        "prénom" => "Alex", 
        "age" =>31
    ],
    [
        "prénom" => "Adrien", 
        "age" =>29
    ],
    [
        "prénom" => "Aurore", 
        "age" =>35
    ],
    [
        "prénom" => "Marie", 
        "age" =>55
    ],
    [
        "prénom" => "Sacha",
        "age" =>17
    ]
];


foreach  ($users as $user) {
    $prénom = $user ["prénom"];
    $age = $user ["age"];

    if ($age >= 18) {
        echo "<b>$prénom : $age</b><br>";
    } 
    else {
        echo "$prénom : $age<br>";
    }
}

/* $commande =array(
    [
        "prenom"=>"Alex",
        "article"=>["nom" => $produit_liste[1]["nom"],"prix"=> $produit_liste[1]["prix"]],["nom" => $produit_liste[2]["nom"],"prix"=> $produit_liste[2]["prix"]]
    ]
    ); 
*/

?>
<!DOCTYPE html>
<html lang="fr">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Tableau des Produits</title>
    </head>
    <body>
        <table border="1" style="width:50%;margin:auto;margin-top:80px;border:solid;">
            <tr style="background-color:brown;color:white;">
                <th>Prénom</th>
                <th>Age</th>
                <th>Total commande</th>
                <th>Réduction</th>
                <th>Livraison gratuite</th>
                <th>Prix Total (apres réduction)</th>
            </tr>
            <?php
            foreach ($users as $user) {
                echo "<tr>
                    <td>". $user["prénom"]." </td>
                    <td>". $user["age"]." </td>
                    <td>". $user["prénom"]." </td>
                    <td>". $user["prénom"]." </td>
                    <td>". $user["prénom"]." </td>
                    <td>". $user["prénom"]." </td>
                </tr>";
            }
            ?>
        </table>
    </body>
</html>