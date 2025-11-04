<?php
session_start();
$id = $_SESSION['id'];

include 'connexion.php';
$commentaire = $_POST['commentaire'];
$id_billet = $_POST['id_billet'];


$stmt = $db-> prepare("INSERT INTO commentaires (contenu,id_auteur,id_billet) VALUES (?, $id, ?)");
$stmt->execute([$commentaire, $id_billet]);
header("location: detail.php?id= $id_billet ")
?>