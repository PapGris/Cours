
<?php

$commandes = [
    [
        "articles" => [
            ["prix" => 50, "quantite" => 2],
            ["prix" => 30, "quantite" => 3],
            ["prix" => 20, "quantite" => 1],
        ],
    ],
    [
        "articles" => [
            ["prix" => 15, "quantite" => 2],
            ["prix" => 25, "quantite" => 1],
            ["prix" => 10, "quantite" => 5],
        ],
    ],
    [
        "articles" => [
            ["prix" => 35, "quantite" => 3],
            ["prix" => 45, "quantite" => 1],
            ["prix" => 5, "quantite" => 10],
        ],
    ],
    [
        "articles" => [
            ["prix" => 20, "quantite" => 4],
            ["prix" => 12, "quantite" => 6],
            ["prix" => 8, "quantite" => 8],
            ["prix" => 30, "quantite" => 20],
        ],
    ],
    [
        "articles" => [
            ["prix" => 60, "quantite" => 1],
            ["prix" => 7, "quantite" => 12],
            ["prix" => 18, "quantite" => 3],
        ],
    ],
    [
        "articles" => [
            ["prix" => 22, "quantite" => 2],
            ["prix" => 9, "quantite" => 7],
        ],
    ],
    [
        "articles" => [
            ["prix" => 150, "quantite" => 1],
            ["prix" => 75, "quantite" => 2],
        ],
    ],
    [
        "articles" => [
            ["prix" => 100, "quantite" => 4],
            ["prix" => 50, "quantite" => 1],
        ],
    ],
];
function calculerTotalCommande($articles)
{
    $total = 0;
    foreach ($articles as $article) {
        $total += $article['prix'] * $article['quantite'];
    }
    return $total;
}
function appliquerReduction($total)
{
    if ($total > 500) {
        $total *= 0.8; // Réduction de 20%
        return ["total" => $total, "message" => "Réduction de 20%"];
    } elseif ($total > 200) {
        $total *= 0.9; // Réduction de 10%
        return ["total" => $total, "message" => "Réduction de 10%"];
    } else {
        return ["total" => $total, "message" => "Pas de réduction !"];
    }
}
function estEligibleLivraisonGratuite($total)
{
    return $total > 100;
}
function classerCommande($total)
{
    if ($total > 500) {
        return "Grande commande";
    } elseif ($total >= 100) {
        return "Commande moyenne";
    } else {
        return "Petite commande";
    }
}
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tableau des Commandes</title>
    <style>
        table {
            width: 100%;
            border-collapse: collapse;
            box-shadow: 5px 5px 0px rgb(241, 215, 45);
        }
        th,
        td {
            border: 1px solid black;
            padding: 8px;
            text-align: left;
        }
        th {
            background-color: rgb(241, 182, 45);
        }
        tr:hover {
            background-color: gray;
        }
        h1 {
            text-align: center;
        }
    </style>
</head>
<body>
    <h1>Tableau de commande</h1>
    <table>
        <thead>
            <tr>
                <th>Commande</th>
                <th>Total Initial</th>
                <th>Total Remise</th>
                <th>Total après Réduction</th>
                <th>Livraison Gratuite</th>
                <th>Classification</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($commandes as $index => $commande) {
                $totalInitial = calculerTotalCommande($commande['articles']);
                $reduction = appliquerReduction($totalInitial);
                $totalApresReduction = $reduction["total"];
                $livraisonGratuite = estEligibleLivraisonGratuite($totalApresReduction);
                $classification = classerCommande($totalApresReduction);
                ?>
                <tr>
                    <td>Commande <?php echo $index + 1; ?></td>
                    <td><?php echo $totalInitial; ?> €</td>
                    <td><?php echo $reduction["message"]; ?></td>
                    <td><?php echo $totalApresReduction; ?> €</td>
                    <td><?php echo $livraisonGratuite ? "Oui" : "Non"; ?></td>
                    <td><?php echo $classification; ?></td>
                </tr>
            <?php } 
            ?>
        </tbody>
    </table>
</body>

</html>