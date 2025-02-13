<?php

$montantcommande = "1200";
$montanttotal = "6500";
$commande = "14";
$jour = "Mercredi";

if ($commande >= 10 && $montanttotal > 1000) {
    $statut = "VIP";
    $reduction = 10;
} elseif ($commande >= 5) {
    $statut = "Régulier";
    $reduction = 5;
} else {
    $statut = "Nouveau client";
    $reduction = 0;
}

if ($montantcommande > 200) {
    $reduction += 5;
}


if ($jour && $statut  == "Mercredi" && "VIP") {
    echo "Réduction supplémentaire de 5% les Mercredi !";
}

$montantFinal = $montantcommande - ($montantcommande * $reduction / 100);

echo "Statut du client : $statut <br>";
echo "Réduction appliquée : $reduction <br>";
echo "Montant final à payer : " . number_format($montantFinal, 2) . "€ <br>";
?>


<?php

$poste = "Développeur";
$ancienneté = 2;
$heuressupp = 4;
$jourabsence = 0;

switch ($poste) {
    case "Développeur":
        $salairedebase = 3000;
        break;
    case "Designer":
        $salairedebase = 2800;
        break;
    case "Manager":
        $salairedebase = 4000;
        break;
    case "Stagiaire":
        $salairedebase = 1200;
        break;
    default:
        echo "Poste inconnu";
        exit;
}

if ($ancienneté > 5) {
    $prime = $salairedebase*0.1;
} elseif ($ancienneté > 10) {
    $prime = $salairedebase*0.2;    
} else {
    $prime = $salairedebase*0; 
}


$deductionabsencesalaire = $jourabsence * 50;
$totalheuressupp = $heuressupp * 25;
$salairetotal = $salairedebase - $deductionabsencesalaire + $totalheuressupp + $prime;

echo "Poste : $poste <br>";
echo "Salaire : $salairedebase € <br>";
echo "Prime d'anciennetée : $ancienneté ans = $prime <br>";
echo "Total heures supplémentaires : $totalheuressupp € <br>";
echo "Total absences injustifiées : $jourabsence <br>";
echo "Déduction absence sur salaire : $deductionabsencesalaire € <br>";
echo "Salaire total : $salairetotal € <br>";

?>


