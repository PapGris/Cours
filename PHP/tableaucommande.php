<?php

$commandes = [
    [
        'client' => ['nom' => 'Dupont', 'prenom' => 'Jean'],
        'articles' => [
            ['nom' => 'Chaise', 'prix' => 49.99, 'quantite' => rand(1, 5)],
            ['nom' => 'Table', 'prix' => 49.99, 'quantite' => rand(1, 5)],
            ['nom' => 'Lampe', 'prix' => 19.99, 'quantite' => rand(1, 5)]
        ]
    ],
    [
        'client' => ['nom' => 'Martin', 'prenom' => 'Sophie'],
        'articles' => [
            ['nom' => 'Cahier', 'prix' => 4.99, 'quantite' => rand(1, 5)],
            ['nom' => 'Gomme', 'prix' => 1.49, 'quantite' => rand(1, 5)],
            ['nom' => 'Règle', 'prix' => 2.99, 'quantite' => rand(1, 5)]
        ]
    ],
    [
        'client' => ['nom' => 'Martin', 'prenom' => 'Sophie'],
        'articles' => [
            ['nom' => 'Canapé', 'prix' => 499.99, 'quantite' => rand(1, 5)],
            ['nom' => 'Tapis', 'prix' => 89.99, 'quantite' => rand(1, 5)]
        ]
    ],
    [
        'client' => ['nom' => 'Lefevre', 'prenom' => 'Paul'],
        'articles' => [
            ['nom' => 'Bureau', 'prix' => 199.99, 'quantite' => rand(1, 5)],
            ['nom' => 'Chaise de bureau', 'prix' => 89.99, 'quantite' => rand(1, 5)]
        ]
    ],
    [
        'client' => ['nom' => 'Dubois', 'prenom' => 'Pierre'],
        'articles' => [
            ['nom' => 'Stylo', 'prix' => 1.99, 'quantite' => rand(1, 5)],
            ['nom' => 'Bloc-notes', 'prix' => 3.49, 'quantite' => rand(1, 5)],
            ['nom' => 'Classeur', 'prix' => 7.99, 'quantite' => rand(1, 5)]
        ]
    ],
    [
        'client' => ['nom' => 'Dubois', 'prenom' => 'Claire'],
        'articles' => [
            ['nom' => 'Étagère', 'prix' => 59.99, 'quantite' => rand(1, 5)],
            ['nom' => 'Meuble TV', 'prix' => 199.99, 'quantite' => rand(1, 5)],
            ['nom' => 'Table basse', 'prix' => 79.99, 'quantite' => rand(1, 5)]
        ]
    ],
    [
        'client' => ['nom' => 'Morel', 'prenom' => 'Luc'],
        'articles' => [
            ['nom' => 'Lit', 'prix' => 349.99, 'quantite' => rand(1, 5)],
            ['nom' => 'Armoire', 'prix' => 599.99, 'quantite' => rand(1, 5)]
        ]
    ],
    [
        'client' => ['nom' => 'Leclerc', 'prenom' => 'Marie'],
        'articles' => [
            ['nom' => 'Coussin', 'prix' => 15.99, 'quantite' => rand(1, 5)],
            ['nom' => 'Tapis', 'prix' => 12.49, 'quantite' => rand(1, 5)],
            ['nom' => 'Lampe de bureau', 'prix' => 9.99, 'quantite' => rand(1, 5)]
        ]
    ],
    [
        'client' => ['nom' => 'Lefevre', 'prenom' => 'Paul'],
        'articles' => [
            ['nom' => 'Étiquette', 'prix' => 0.99, 'quantite' => rand(1, 5)],
            ['nom' => 'Agrafeuse', 'prix' => 8.99, 'quantite' => rand(1, 5)],
            ['nom' => 'Pochettes plastiques', 'prix' => 5.49, 'quantite' => rand(1, 5)]
        ]
    ]
];


function calculerTotal($articles) { 
    $total = 0;
    foreach ($articles as $article) {
        $total += $article['prix'] * $article['quantite'];
    }
    return $total;
}

function appliquerReduction($total) {
    $reduction = 0;
    if ($total > 500) {
        $reduction = $total * 0.2;
    } elseif ($total > 200) {
        $reduction = $total * 0.1;        
    }
    return  $reduction;
}

function afficherReduction($total) {
    $reduction = 0;
    if ($total > 500) {
        return '20%';
    } elseif ($total > 200) {
        return '10%';        
    }
    return  '0%';
}

function calculerPrixTotalApresReduction($total, $reduction) {
    return $total - $reduction;
}

function calculerLivraison($prixTotal) {
    $livraison = 0;
    if ($prixTotal > 1000) {
        return 'Oui';
    } else {
        return 'Non';        
    }
}

function calculerTailleCommande($Total) {
    if ($Total > 500) {
        return 'Grande Commande';
    } elseif ($Total >= 100 && $Total <= 500) {
        return 'Commande Moyenne';        
    } elseif ($Total < 100) {
        return 'Petite Commande';
    }
}

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
                <th>Nom</th>
                <th>Prénom</th>
                <th>Total Commande</th>
                <th>Réduction</th>
                <th>Montant de la réduction</th>
                <th>Prix Total (apres réduction)</th>
                <th>Livraison gratuite</th>
                <th>Taille Commande</th>
            </tr>
            <?php
            foreach ($commandes as $commande) {
                $totalCommande = calculerTotal($commande['articles']);
                $reduction = appliquerReduction($totalCommande);
                $afficherReduction = afficherReduction($totalCommande);
                $prixTotal = calculerPrixTotalApresReduction($totalCommande, $reduction);
                $livraison = calculerLivraison($prixTotal);
                $tailleCommande = calculerTailleCommande($totalCommande);
                echo "<tr>
                    <td>". $commande['client']["nom"]." </td>
                    <td>". $commande['client']["prenom"]." </td>
                    <td>". $totalCommande." </td>
                    <td>". $reduction." </td>
                    <td>". $afficherReduction."</td>
                    <td>". $prixTotal."</td>
                    <td>". $livraison."</td>
                    <td>". $tailleCommande."</td>
                </tr>";
            }
            ?>
        </table>
    </body>
</html>