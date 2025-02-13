<?php

/* ========= TABLEAU DES ARTICLES ========== */

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

$articles = array_merge($articles, $articles_additionnels); // Fusionner les articles
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


<?php
$users = [
    [
        "prénom" => "Alex", 
        "age" => 31
    ],
    [
        "prénom" => "Adrien", 
        "age" => 29
    ],
    [
        "prénom" => "Aurore", 
        "age" => 35
    ],
    [
        "prénom" => "Marie", 
        "age" => 55
    ],
    [
        "prénom" => "Sacha", 
        "age" => 17
    ]
];

/* ========= GÉNÉRATION DES COMMANDES ========== */

$commandes = [];

foreach ($users as $user) {
    // Chaque utilisateur commande entre 1 et 3 articles aléatoires
    $nombre_articles = rand(1, 3);
    $articles_commandes = array_rand($articles, $nombre_articles);
    if (!is_array($articles_commandes)) {
        $articles_commandes = [$articles_commandes];
    }

    $total = 0;
    foreach ($articles_commandes as $index) {
        $total += $articles[$index]["prix"];
    }

    // Appliquer les réductions
    $reduction = 0;
    if ($total > 500) {
        $reduction = 0.20;
    } elseif ($total > 200) {
        $reduction = 0.10;
    }

    $total_apres_reduction = $total - ($total * $reduction);

    // Vérifier si la livraison est gratuite
    $livraison_gratuite = $total_apres_reduction > 100 ? "Oui" : "Non";

    // Déterminer la catégorie de la commande
    if ($total_apres_reduction < 100) {
        $categorie = "Petite commande";
    } elseif ($total_apres_reduction <= 500) {
        $categorie = "Commande moyenne";
    } else {
        $categorie = "Grande commande";
    }

    // Stocker la commande
    $commandes[] = [
        "prénom" => $user["prénom"],
        "age" => $user["age"],
        "total" => $total,
        "reduction" => $reduction * 100 . "%",
        "livraison" => $livraison_gratuite,
        "total_apres_reduction" => $total_apres_reduction,
        "categorie" => $categorie
    ];
}

?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tableau des Commandes</title>
</head>
<body>
    <table border="1" style="width:70%;margin:auto;margin-top:50px;border:solid;">
        <tr style="background-color:brown;color:white;">
            <th>Prénom</th>
            <th>Age</th>
            <th>Total commande (€)</th>
            <th>Réduction</th>
            <th>Livraison gratuite</th>
            <th>Total après réduction (€)</th>
            <th>Catégorie</th>
        </tr>
        <?php foreach ($commandes as $commande) : ?>
            <tr>
                <td><?= $commande["prénom"] ?></td>
                <td><?= $commande["age"] ?></td>
                <td><?= $commande["total"] ?> €</td>
                <td><?= $commande["reduction"] ?></td>
                <td><?= $commande["livraison"] ?></td>
                <td><?= $commande["total_apres_reduction"] ?> €</td>
                <td><?= $commande["categorie"] ?></td>
            </tr>
        <?php endforeach; ?>
    </table>
</body>
</html>
