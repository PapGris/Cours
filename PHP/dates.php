<?php

date_default_timezone_set('UTC');

$evenements = [
    [
        'nom' => 'Concert de rock',
        'date' => '2024-03-15'
    ],
    [
        'nom' => 'Exposition',
        'date' => '2025-02-28'
    ],
    [
        'nom' => 'Conférence PHP',
        'date' => '2025-05-10'
    ],
    [
        'nom' => 'Festival de cinéma',
        'date' => '2025-0-20'
    ],
    [
        'nom' => 'Séminaire sur l\'IA',
        'date' => '2025-06-01'
    ],
    [
        'nom' => 'Rentrée scolaire',
        'date' => '2025-02-18'
    ]
];

//Date d'aujourd'hui
$today = new DateTime();

echo "Nous sommes le " . $today->format('d/m/Y') ."<br><br><br><br>";

// Tri des événements par date croissante
usort($evenements, function($a, $b) {
    return strtotime($a['date']) - strtotime($b['date']);
});

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <style>
        body {
    font-family: Arial, sans-serif;
    background-color: #f4f4f4;
    margin: 20px;
    padding: 20px;
    display: flex;
    justify-content: center;
}

table {
    width: 80%;
    border-collapse: collapse;
    background: white;
    box-shadow: 0px 4px 8px rgba(0, 0, 0, 0.1);
    border-radius: 8px;
    overflow: hidden;
    border: 10px solid #007BFF;
}

thead {
    background-color: #007BFF;
    color: white;
    text-transform: uppercase;
}

th, td {
    padding: 12px;
    text-align: center;
    border: 1px solid #ddd;

}

tbody tr:nth-child(even) {
    background-color: #f9f9f9;
}

tbody tr:hover {
    background-color: #f1f1f1;
}

td:nth-child(3) { /* Colonne "État" */
    font-weight: bold;
}

td:nth-child(3):contains("Passé") {
    color: red;
}

td:nth-child(3):contains("A venir") {
    color: green;
}

td:nth-child(3):contains("Aujourd'hui") {
    color: orange;
}

th {
    font-size: 16px;
}
    </style>
    <table>
        <thead>
            <tr>
                <th>Événement</th>
                <th>Date</th>
                <th>État</th>
                <th>J-</th>
            </tr>
        </thead>
        <tbody>
                    <?php
                // Affichage des événements triés
                foreach ($evenements as $evenement) {
                    echo "<tr>";
                // Création de l'objet DateTime pour chaque événement
                    $date = new DateTime($evenement['date']);
                    echo "<td>" .$evenement['nom']."</td>";
                    // Formatage de la date en français avec IntlDateFormatter
                    $formatter = new IntlDateFormatter('fr_FR', IntlDateFormatter::FULL, IntlDateFormatter::NONE);
                    echo "<td>" .$formatter->format($date). "</td>";
                    $diff = $date->diff($today);
                    // Dire si l'evenement est passé, a venir, ou aujour'hui avec une condition
                    if ($date->format('d/m/Y') == $today->format('d/m/Y')) {
                        $etat = "Aujourd'hui" ;
                        $reste = "💋";
                    } elseif ($date > $today) {
                        $etat = "A venir" ;
                        $reste = $diff->days;
                    } else {
                        $etat = "Passé";
                        $reste = "🤜🤛";
                    }
                    echo "<td>" .$etat."</td>";                   
                    echo "<td>" .  $reste . "</td>";                    
                }
                echo "</tr>";
?>           
        </tbody>
    </table>
</body>
</html>
    


