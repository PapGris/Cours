<?php 
        include 'header.php'; 
        include 'data.php';
        

        function calculateTotalPrice($startDate, $endDate, $numPersons, $options = []) { // → Définit une fonction appelée calculateTotalPrice().
            $baseRate = 100; // Tarif de base par nuit est 100€
            $numNights = (new DateTime($startDate))->diff(new DateTime($endDate))->days; // Calcul du nombre de nuits
            // new DateTime($startDate) → Convertit $startDate en objet DateTime.
            // new DateTime($endDate) → Convertit $endDate en objet DateTime.
            // .diff(...) → Calcule la différence entre les deux dates.
            // .days → Extrait le nombre total de jours entre $startDate et $endDate
            $totalPrice = $numNights * $baseRate; // Calcul du prix initial
            // Multiplie le nombre de nuits ($numNights) par le tarif de base ($baseRate).
            
            // Vérification de la fidélité du client
            $clientReservations = rand(0,15);
            $clientReservations = isset($_SESSION['client_reservations']) ? $_SESSION['client_reservations'] : 0;
            if ($clientReservations > 5) {
                $totalPrice *= 0.9; // 10% de réduction pour un client fidèle
            }

            // Réduction pour séjours de 7 nuits ou plus
            if ($numNights >= 7) {
                $totalPrice *= 0.9;// Réduction pour séjours de 7 nuits ou plus
            // Si le séjour dure au moins 7 nuits, on applique une réduction de 10%.
            }

            for ($i = 0; $i < $numNights; $i++) { // Surcharge pour le week-end
                // Boucle for : Parcourt chaque nuit du séjour.
                $dayOfWeek = (new DateTime($startDate))->modify("+$i days")->format('N');
                // modify("+$i days") → Ajoute $i jours à $startDate pour vérifier chaque jour.
                // format('N') → Donne le numéro du jour de la semaine (1 = lundi, ..., 7 = dimanche).
                if ($dayOfWeek >= 5) { $totalPrice *= 1.2; 
                break; 
                }// Si un jour tombe un vendredi, samedi ou dimanche, applique +20% de surcharge (*= 1.2) et stoppe la boucle (break;)
            }

            // Vérification de la saison pour appliquer la majoration ou réduction
            $startMonth = (new DateTime($startDate))->format('m'); // Récupère le mois de la date de début
            if (in_array($startMonth, ['06', '07', '08', '12'])) {
                // Haute saison (juin, juillet, août, décembre)
                $totalPrice *= 1.25; // 25% de majoration
            } elseif (in_array($startMonth, ['01', '02', '11'])) {
                // Basse saison (janvier, février, novembre)
                $totalPrice *= 0.85; // 15% de réduction
            }
        
            // Ajout des options
            if (in_array('petit_dejeuner', $options)) $totalPrice += 10 * $numNights * $numPersons;
            // in_array('petit_dejeuner', $options) → Vérifie si "petit_dejeuner" est sélectionné.
            // Ajoute 10€ par jour et par personne.
            if (in_array('spa', $options)) $totalPrice += 30;
            // in_array('spa', $options) → Vérifie si "spa" est sélectionné
            // Ajoute 30€ par séjour.
            if (in_array('vue_mer', $options)) $totalPrice += 20 * $numNights;
            // in_array('vue_mer', $options) → Vérifie si "vue_mer" est sélectionné
            // Ajoute 20€ par nuit.

            // Application de la taxe de 5%
            $totalPrice *= 1.05; // 5% de taxe

            // Frais de service fixe de 20€
            $totalPrice += 20; // Frais de service
        
            return $totalPrice; // Renvoie le montant total après calculs.
        }
        
        
?>

    <main>
        <section class="reservation-form">
            <h2>Faire une réservation</h2>
            <form action="index.php" method="POST"> <!-- But : La balise <form> définit un formulaire HTML qui permet à l'utilisateur de    soumettre des données. -->
                <label for="roomType">Type de chambre :</label>
                <select id="roomType" name="roomType" required>
                    <option value="standard">Standard</option>
                    <option value="deluxe">Deluxe</option>
                    <option value="suite">Suite</option>
                </select>
                <br><br>
                <label for="numRooms">Nombre de chambres :</label>
                <input type="number" id="numRooms" name="numRooms" min="1" value="1" required>
                <br>
                <label for="startDate">Date de début :</label>
                <input type="date" id="startDate" name="startDate" required>

                <label for="endDate">Date de fin :</label>
                <input type="date" id="endDate" name="endDate" required>

                <label for="numPersons">Nombre de personnes :</label>
                <input type="number" id="numPersons" name="numPersons" min="1" required><br>

                <!-- Options dans un tableau -->
                <h3> Options supplémentaires : </h3>
                <table class="options-table">
                    <thead>
                        <tr>
                            <th>Option</th>
                            <th>Description</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td><input type="checkbox" name="options[]" value="petit_dejeuner"></td>
                            <td>Petit-déjeuner (+10€/jour/personne)</td>
                        </tr>
                        <tr>
                            <td><input type="checkbox" name="options[]" value="spa"></td>
                            <td>Spa (+30€/séjour)</td>
                        </tr>
                        <tr>
                            <td><input type="checkbox" name="options[]" value="vue_mer"></td>
                            <td>Vue sur mer (+20€/jour)</td>
                        </tr>
                    </tbody>
                </table>

                <button type="submit">Calculer le prix</button>
            </form>
        </section>
        
        
        <?php
        if ($_SERVER["REQUEST_METHOD"] == "POST") { // $_SERVER["REQUEST_METHOD"] : C'est une superglobale qui contient des informations sur la méthode HTTP utilisée pour accéder à la page. Les valeurs possibles sont :
            // "GET" : pour les requêtes GET.
            // "POST" : pour les requêtes POST.
            // L'instruction if ($_SERVER["REQUEST_METHOD"] == "POST") vérifie donc si la méthode de la requête est POST, ce qui signifie que le formulaire a été soumis. Ce bloc de code ne sera exécuté que lorsque l'utilisateur soumet le formulaire (en cliquant sur le bouton "Calculer le prix").
            $numRooms = $_POST["numRooms"]; // Récupération du nombre de chambres
            $roomType = $_POST["roomType"]; // Cela permet d'obtenir la valeur du champ roomType envoyé via le formulaire.
            $startDate = $_POST["startDate"]; // $_POST["startDate"] : C'est une superglobale en PHP qui contient toutes les données envoyées via la méthode POST.
            // $_POST["startDate"] correspond au champ startDate du formulaire HTML, qui est un champ de type date.
            // $startDate contient donc la date de début de la réservation choisie par l'utilisateur dans le formulaire (par exemple, "2025-02-20").
            $endDate = $_POST["endDate"]; // $_POST["endDate"] : C'est également une valeur envoyée via la méthode POST, mais cette fois pour le champ endDate du formulaire HTML, qui est aussi un champ de type date.
            // $endDate contient donc la date de fin de la réservation choisie par l'utilisateur.
            $numPersons = $_POST["numPersons"]; // $_POST["numPersons"] : Il s'agit du nombre de personnes, récupéré à partir du champ numPersons dans le formulaire, qui est un champ de type number.
            // $numPersons contient le nombre de personnes que l'utilisateur a saisi dans le formulaire. Il est important que ce champ ait l'attribut min="1", ce qui signifie que l'utilisateur doit saisir au moins 1 personne.
            $options = isset($_POST["options"]) ? $_POST["options"] : []; // $_POST["options"] : Cette variable contient les options sélectionnées par l'utilisateur. Comme les options sont présentées sous forme de cases à cocher, cette variable sera un tableau (par exemple, ['petit_dejeuner', 'spa'] si l'utilisateur a coché ces deux options).
            // $_POST["options"] : [] : C'est un opérateur ternaire. Il permet de vérifier une condition et de retourner une valeur en fonction de cette condition :
                // Si $_POST["options"] existe (c'est-à-dire que l'utilisateur a coché des options), la valeur retournée est le tableau des options sélectionnées ($_POST["options"]).
                // Si $_POST["options"] n'existe pas (c'est-à-dire que l'utilisateur n'a pas coché d'options), la valeur retournée est un tableau vide ([]).
            // $options : Cette variable contient donc un tableau avec les options sélectionnées ou un tableau vide si aucune option n'a été choisie.

            // RESUME DU FONCTIONNEMENT !
                // Lorsque l'utilisateur soumet le formulaire :
                    // 1. $_SERVER["REQUEST_METHOD"] == "POST" vérifie si la requête est bien une requête POST, ce qui signifie que le formulaire a été soumis.
                    // 2. Si la requête est de type POST, le code récupère les valeurs soumises via le formulaire :
                        // $startDate : la date de début de réservation.
                        // $endDate : la date de fin de réservation.
                        // $numPersons : le nombre de personnes.
                        // $options : un tableau contenant les options sélectionnées (ou un tableau vide si aucune option n'est sélectionnée).
                    
                // Ces informations sont ensuite utilisées pour calculer le prix total et afficher un résumé détaillé de la commande.
                        

                 // Vérification de la validité des dates
                if (!strtotime($startDate) || !strtotime($endDate)) {
                    echo "<p style='color:red;'>❌ Une ou les deux dates sont invalides.</p>";
                    exit();
                }
            
                if (strtotime($startDate) >= strtotime($endDate)) {
                    echo "<p style='color:red;'>❌ La date de début doit être avant la date de fin.</p>";
                    exit();
                }

                // Vérification du nombre de personnes et de chambres
                if ($numPersons <= 0 || $numRooms <= 0) {
                    echo "<p style='color:red;'>❌ Le nombre de personnes et de chambres doit être supérieur à zéro.</p>";
                    exit();
                }


                if (!isset($_SESSION['reservations'])) { // ➝ Vérifie si $_SESSION['reservations'] existe.
                    $_SESSION['reservations'] = []; // ➝ Si ce n'est pas le cas, il initialise un tableau vide pour stocker les réservations.
                }
            
                $nbReserves = 0;
                foreach ($_SESSION['reservations'] as $reservation) { // ➝ Parcourt les réservations enregistrées en session.
                    if ($reservation['roomType'] == $roomType && ( // ➝ Vérifie si une réservation du même type de chambre existe sur les mêmes dates.
                        ($startDate >= $reservation['startDate'] && $startDate < $reservation['endDate']) ||
                        ($endDate > $reservation['startDate'] && $endDate <= $reservation['endDate']) ||
                        ($startDate <= $reservation['startDate'] && $endDate >= $reservation['endDate'])
                    )) {
                        $nbReserves++; // ➝ Incrémente $nbReserves pour compter combien de chambres sont déjà prises.
                    }
                }
            
                if ($nbReserves + $numRooms > $chambres_disponibles[$roomType]) { // ➝ Compare $nbReserves avec le nombre de chambres disponibles ($chambres_disponibles[$roomType]) + // ✅ Vérification avec nombre de chambres
                    echo "<p style='color:red; font-weight: bold;'>❌ Désolé, votre demande dépasse la disponibilité actuelle. Il reste seulement " . 
                    ($chambres_disponibles[$roomType] - $nbReserves) . " chambre(s) disponible(s) pour ce type.</p>";
                    exit(); // Stoppe l'exécution pour empêcher l'ajout en session
                } else { // ➝ Affiche un message d’erreur si toutes les chambres sont prises.
                    // Ajouter la réservation dans la session
                    $_SESSION['reservations'][] = [
                        'roomType' => $roomType,
                        'startDate' => $startDate,
                        'endDate' => $endDate
                    ]; // ➝ Enregistre la réservation en session si une chambre est disponible.


            // Calcul du prix total
            $totalPrice = calculateTotalPrice($startDate, $endDate, $numPersons, $options);
            $totalPrice *= $numRooms; // ✅ Multiplication par le nombre de chambres

            echo "<p>Réservation confirmée ! Prix total : $totalPrice €</p>"; // ➝ Affiche un message de confirmation et le prix total de la réservation.

            // Détails de la commande
            echo "<section class='result'>";
            echo "<h2>Détails de la commande :</h2>";

            // Affichage des informations générales
            echo "<table class='details-table'>
                    <thead>
                        <tr>
                            <th>Élément</th>
                            <th>Montant</th>
                        </tr>
                    </thead>
                    <tbody>";
            echo "<tr><td>Type de chambre</td><td>{$roomType}</td></tr>";
            echo "<tr><td>Nombre de chambres</td><td>{$numRooms}</td></tr>";

            // Calcul des nuits et du tarif de base
            $baseRate = 100; // Tarif de base par nuit
            $numNights = (new DateTime($startDate))->diff(new DateTime($endDate))->days;
            $basePrice = $numNights * $baseRate;
            echo "<tr><td>Tarif de base ({$numNights} nuit(s))</td><td>{$basePrice}€</td></tr>";

            // Réduction pour fidélité (si applicable)
            $loyaltyDiscount = 0;
            $clientReservations = isset($_SESSION['client_reservations']) ? $_SESSION['client_reservations'] : 0;
            if ($clientReservations > 5) {
                $loyaltyDiscount = $basePrice * 0.1;  // 10% de réduction
                $basePrice -= $loyaltyDiscount;
                echo "<tr><td>Réduction fidélité (10% pour plus de 5 réservations)</td><td>-{$loyaltyDiscount}€</td></tr>";
            }

            // Réduction si séjour de 7 nuits ou plus
            if ($numNights >= 7) {
                $discount = $basePrice * 0.1;  // 10% de réduction
                $basePrice -= $discount;
                echo "<tr><td>Réduction (10% pour séjour de 7 nuits ou plus)</td><td>-{$discount}€</td></tr>";
            }

            // Surcharge pour les week-ends
            $weekendSurcharge = 0;
            for ($i = 0; $i < $numNights; $i++) {
                $dayOfWeek = (new DateTime($startDate))->modify("+$i days")->format('N');
                if ($dayOfWeek >= 5) {
                    $weekendSurcharge = $basePrice * 0.2; // 20% de surcharge
                    break;
                }
            }
            if ($weekendSurcharge > 0) {
                echo "<tr><td>Surcharge week-end (+20%)</td><td>{$weekendSurcharge}€</td></tr>";
            }

            // Vérification de la saison pour appliquer la majoration ou réduction
            $startMonth = (new DateTime($startDate))->format('m');
            $saisonPrice = 0;
            if (in_array($startMonth, ['06', '07', '08', '12'])) {
                $saisonPrice = $basePrice * 0.25; // 25% de majoration en haute saison
                $basePrice += $saisonPrice;
                echo "<tr><td>Majoration haute saison (juin, juillet, août, décembre)</td><td>+{$saisonPrice}€</td></tr>";
            } elseif (in_array($startMonth, ['01', '02', '11'])) {
                $saisonPrice = $basePrice * 0.15; // 15% de réduction en basse saison
                $basePrice -= $saisonPrice;
                echo "<tr><td>Réduction basse saison (janvier, février, novembre)</td><td>-{$saisonPrice}€</td></tr>";
            }

            // Affichage des options sélectionnées
            if (in_array('petit_dejeuner', $options)) {
                $mealPrice = 10 * $numNights * $numPersons;
                echo "<tr><td>Petit-déjeuner</td><td>+{$mealPrice}€</td></tr>";
            }
            if (in_array('spa', $options)) {
                echo "<tr><td>Spa</td><td>+30€</td></tr>";
            }
            if (in_array('vue_mer', $options)) {
                $seaViewPrice = 20 * $numNights;
                echo "<tr><td>Vue sur mer</td><td>+{$seaViewPrice}€</td></tr>";
            }

            // Application de la taxe de 5%
            $tax = $basePrice * 0.05;
            $basePrice += $tax;
            echo "<tr><td>Taxe de 5%</td><td>+{$tax}€</td></tr>";
                    
            // Frais de service fixes
            $serviceFee = 20;
            $basePrice += $serviceFee;
            echo "<tr><td>Frais de service</td><td>+{$serviceFee}€</td></tr>";

            // Affichage du prix total
            echo "<tr><th>Total</th><th>{$totalPrice}€</th></tr>";

            echo "</tbody></table>";
            echo "</section>";
        }
    }

        
        ?>
    </main>
    
    <div class="upload">
        <h2>Télécharger un fichier</h2>
        <form action="upload.php" method="post" enctype="multipart/form-data">
            Sélectioner un fichier à télécharger :
            <input type = "file" name="fichier" id="fichier">
            <input class="telecharger" type="submit" value="télécharger" name="submit">
        </form>
    </div>
</body>
</html>