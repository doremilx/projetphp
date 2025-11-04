<?php
require_once('connexion.php');

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    $nom = $_POST['nom'];
    $prenom = $_POST['prenom'];
    $login = $_POST['login'];
    $motdepasse = $_POST['motdepasse'];

    // Gestion de la photo
    $photo = "images/default.jpg"; // valeur par défaut

    if (isset($_FILES['photo']) && $_FILES['photo']['error'] == 0) {

        $dossier = "images/";  // dossier où tu veux stocker les images
        $nomFichier = basename($_FILES['photo']['name']);

        $chemin = $dossier . $nomFichier;

        // Déplace le fichier dans ton dossier images/
        move_uploaded_file($_FILES['photo']['tmp_name'], $chemin);

        // On stocke en base le chemin vers l'image
        $photo = $chemin;
    }

    // insertion en base avec la photo
    $sql = "INSERT INTO utilisateurs (nom, prenom, login, motdepasse, etatbooleen, photo) 
            VALUES (?, ?, ?, ?, 0, ?)";
    $stmt = $db->prepare($sql);
    $stmt->execute([$nom, $prenom, $login, $motdepasse, $photo]);

    echo "Compte créé avec succès !";
    echo "<br><a href='login.php'>Retour à la page de connexion</a>";
}
?>