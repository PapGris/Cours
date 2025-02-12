<?php
$name = "Jean";
$age = 25;

if ($name == "Jean") {
    echo "utilisateur enregistré";
} else {
    echo "utilisateur inconnu";
}
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Formulaire PHP</title>
</head>
<body>
    <h1>Page PHP</h1>
    <p>Bonjour <?php echo $name ?> tu as <?php echo $age ?></p>
    <form action="traitement.php" method="POST">
        <label for="nom">Nom :</label>
        <input type="text" id="nom" name="nom" required>
        <br><br>

        <label for="email">Email :</label>
        <input type="email" id="email" name="email" required>
        <br><br>

        <label for="message">Message :</label>
        <br>
        <textarea id="message" name="message" rows="5" cols="30" required></textarea>
        <br><br>

        <button type="submit">Envoyer</button>
    </form>    
</body>
</html>