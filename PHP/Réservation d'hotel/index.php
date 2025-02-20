<?php 
        include 'header.php'; 

        function calculateTotalPrice($startDate, $endDate, $numPersons, $options = []) { // → Définit une fonction appelée calculateTotalPrice().
            $baseRate = 100; // Tarif de base par nuit est 100€
            $numNights = (new DateTime($startDate))->diff(new DateTime($endDate))->days; // Calcul du nombre de nuits
            // new DateTime($startDate) → Convertit $startDate en objet DateTime.
            // new DateTime($endDate) → Convertit $endDate en objet DateTime.
            // .diff(...) → Calcule la différence entre les deux dates.
            // .days → Extrait le nombre total de jours entre $startDate et $endDate
            $totalPrice = $numNights * $baseRate; // Calcul du prix initial
            // Multiplie le nombre de nuits ($numNights) par le tarif de base ($baseRate).
            
            
            if ($numNights >= 7) $totalPrice *= 0.9;// Réduction pour séjours de 7 nuits ou plus
            // Si le séjour dure au moins 7 nuits, on applique une réduction de 10%.
            
            for ($i = 0; $i < $numNights; $i++) { // Surcharge pour le week-end
                // Boucle for : Parcourt chaque nuit du séjour.
                $dayOfWeek = (new DateTime($startDate))->modify("+$i days")->format('N');
                // modify("+$i days") → Ajoute $i jours à $startDate pour vérifier chaque jour.
                // format('N') → Donne le numéro du jour de la semaine (1 = lundi, ..., 7 = dimanche).
                if ($dayOfWeek >= 5) { $totalPrice *= 1.2; break; }
                // Si un jour tombe un vendredi, samedi ou dimanche, applique +20% de surcharge (*= 1.2) et stoppe la boucle (break;)
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
        
            return $totalPrice; // Renvoie le montant total après calculs.
        }
        
        
?>

    <main>
        <section class="reservation-form">
            <h2>Faire une réservation</h2>
            <form action="index.php" method="POST"> <!-- But : La balise <form> définit un formulaire HTML qui permet à l'utilisateur de    soumettre des données. -->
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



            // Calcul du prix total
            $totalPrice = calculateTotalPrice($startDate, $endDate, $numPersons, $options);

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

            // Calcul des nuits et du tarif de base
            $baseRate = 100; // Tarif de base par nuit
            $numNights = (new DateTime($startDate))->diff(new DateTime($endDate))->days;
            $basePrice = $numNights * $baseRate;
            echo "<tr><td>Tarif de base ({$numNights} nuit(s))</td><td>{$basePrice}€</td></tr>";

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

            // Affichage du prix total
            echo "<tr><th>Total</th><th>{$totalPrice}€</th></tr>";

            echo "</tbody></table>";
            echo "</section>";
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