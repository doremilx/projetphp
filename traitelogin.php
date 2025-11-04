<?php

 
require_once ('connexion.php');
 $stmt = $db->prepare('SELECT * FROM utilisateurs');
$stmt->execute();
$resultats = $stmt->fetchAll(PDO::FETCH_ASSOC);

session_start();


if( isset($_POST['login']) && isset($_POST['password']) ) {

    $login = $_POST['login'];
    $password = $_POST['password'];

   foreach ($resultats as $valeur) {
        if( $valeur['login'] === $login && $valeur['motdepasse'] === $password ) {
            $_SESSION['login'] = $_POST['login'];
            $_SESSION['id'] = $valeur['id_utilisateur'];
            $_SESSION['photo'] = $valeur['photo'];
            $_SESSION['nom']  = $valeur['nom'];
            $_SESSION['prenom'] = $valeur['prenom'];
            echo "Connexion réussie ! Bienvenue" . " " . $valeur['prenom'] . " " . $valeur['nom'];
            echo "<br><a href='index.php'>Retour à l'accueil</a>";
            exit();
        }
    }

    echo "Login ou mot de passe incorrect.";}

    else {
    echo "Veuillez remplir tous les champs.";
} 
echo "coucou";
?> 