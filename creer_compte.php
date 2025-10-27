<?php 
require_once ('connexion.php');
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nom = $_POST['nom'];
    $prenom = $_POST['prenom'];
    $login = $_POST['login'];
    $motdepasse = $_POST['motdepasse'];

    $sql = "INSERT INTO utilisateurs (nom, prenom, login, motdepasse, etatbooleen) VALUES (?, ?, ?, ?,0)";
    $stmt = $db->prepare($sql);
    $stmt->execute([$nom, $prenom, $login, $motdepasse]);

    echo "Compte créé avec succès !";
    echo "<br><a href='login.php'>Retour à la page de connexion</a>";
}

?>