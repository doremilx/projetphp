<?php
require_once('connexion.php');

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    if (
        isset($_POST['nom']) && $_POST['nom'] !== "" &&
        isset($_POST['prenom']) && $_POST['prenom'] !== "" &&
        isset($_POST['login']) && $_POST['login'] !== "" &&
        isset($_POST['motdepasse']) && $_POST['motdepasse'] !== "" /* &&
        isset($_POST['photo']) && $_POST['photo'] !== "" */
    ) {

        $nom = $_POST['nom'];
        $prenom = $_POST['prenom'];
        $login = $_POST['login'];
        $motdepasse = $_POST['motdepasse'];
        $motdepassehash = password_hash($motdepasse, PASSWORD_DEFAULT);

        // ✅ Vérifier si le mail existe déjà
        $sql = "SELECT * FROM utilisateurs WHERE login = ?";
        $stmt = $db->prepare($sql);
        $stmt->execute([$login]);
        $existant = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($existant) {
            echo "Erreur : cet email est déjà utilisé.";
            echo "<br><a href='login.php'>Retour</a>";
            exit;
        }

        // ✅ Gestion de l’image (facultative)
        $photo = "images/default.jpg";
        if (isset($_FILES['photo']) && $_FILES['photo']['error'] == 0) {
            $dossier = "images/";
            $nomFichier = basename($_FILES['photo']['name']);
            $chemin = $dossier . $nomFichier;
            move_uploaded_file($_FILES['photo']['tmp_name'], $chemin);
            $photo = $chemin;
        }

        // ✅ Insertion en base
        $sql = "INSERT INTO utilisateurs (nom, prenom, login, motdepasse, etatbooleen, photo)
                VALUES (?, ?, ?, ?, 0, ?)";
        $stmt = $db->prepare($sql);
        $stmt->execute([$nom, $prenom, $login, $motdepassehash, $photo]);

        echo "Compte créé avec succès ✅";
        echo "<br><a href='login.php'>Retour à la page de connexion</a>";
        exit;
    }

    echo "Erreur : tous les champs doivent être remplis.";
    echo "<br><a href='javascript:history.back()'>Retour</a>";
}
?>
