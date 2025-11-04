<?php
include 'connexion.php';
$titre = $_POST['titre'];
$date = $_POST['date'];
$contenu = $_POST['contenu'];


$stmt = $db-> prepare("INSERT INTO billets (date, titre, contenu, id_auteur) VALUES (?,?,?,1)");
$stmt->execute([$date, $titre, $contenu]);

/* if( isset($titre) & isset($date) & isset($contenu)){


}  */


?>