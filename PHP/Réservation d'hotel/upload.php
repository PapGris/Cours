<?php
// Répertoire où le fichier sera téléchargé
$repertoireCible = "uploads/";

// Vérifier si le dossier "uploads" existe, sinon le créer
if (!is_dir($repertoireCible)) {
    mkdir($repertoireCible, 0777, true);
}

// Vérifier si un fichier a été soumis
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_FILES["fichier"])) {
    // Nom du fichier téléchargé
    $nomFichier = basename($_FILES["fichier"]["name"]);

    // Chemin complet du fichier téléchargé
    $cheminCible = $repertoireCible . $nomFichier;

    // Vérifier l'extension du fichier
    $typeFichier = strtolower(pathinfo($cheminCible, PATHINFO_EXTENSION));

    // Tableau des extensions autorisées
    $extensionsAutorisees = ["jpg", "jpeg", "png", "gif", "pdf", "txt"];

    // Vérifier si l'extension est autorisée
    if (in_array($typeFichier, $extensionsAutorisees)) {
        // Tentative de déplacement du fichier téléchargé vers le répertoire cible
        if (move_uploaded_file($_FILES["fichier"]["tmp_name"], $cheminCible)) {
            echo "Le fichier <strong>" . htmlspecialchars($nomFichier) . "</strong> a été téléchargé avec succès.";
        } else {
            echo "❌ Désolé, une erreur s'est produite lors du téléchargement de votre fichier.";
        }
    } else {
        echo "❌ Désolé, seuls les fichiers JPG, JPEG, PNG, GIF, PDF et TXT sont autorisés.";
    }
} else {
    echo "❌ Aucun fichier sélectionné.";
}
?>

