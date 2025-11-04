<?php
require_once('connexion.php');

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    // On vérifie que les champs existent et ne sont pas vides
    if (
        isset($_POST['nom']) && $_POST['nom'] !== "" &&
        isset($_POST['prenom']) && $_POST['prenom'] !== "" &&
        isset($_POST['login']) && $_POST['login'] !== "" &&
        isset($_POST['motdepasse']) && $_POST['motdepasse'] !== ""
    ) {

        $nom = $_POST['nom'];
        $prenom = $_POST['prenom'];
        $login = $_POST['login'];
        $motdepasse = $_POST['motdepasse'];


        if (isset($_FILES['photo']) && $_FILES['photo']['error'] == 0) {
            $dossier = "images/";
            $nomFichier = basename($_FILES['photo']['name']);
            $chemin = $dossier . $nomFichier;
            move_uploaded_file($_FILES['photo']['tmp_name'], $chemin);
            $photo = $chemin;
        }

        // insertion en base
        $sql = "INSERT INTO utilisateurs (nom, prenom, login, motdepasse, etatbooleen, photo)
                VALUES (?, ?, ?, ?, 0, ?)";
        $stmt = $db->prepare($sql);
        $stmt->execute([$nom, $prenom, $login, $motdepasse, $photo]);

        echo "Compte créé avec succès !";
        echo "<br><a href='login.php'>Retour à la page de connexion</a>";
        exit;
    }

    // Si on arrive ici, c’est que les champs ne sont pas remplis
    echo "Erreur : tous les champs doivent être remplis.";
    echo "<br><a href='login.php'>Retour</a>";
}
?>