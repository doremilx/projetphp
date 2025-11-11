<?php
session_start();
$id = $_SESSION['id'];

include 'connexion.php';
$commentaire = $_POST['commentaire'];
$id_billet = $_POST['id_billet'];

if (isset($_POST['commentaire']) && $_POST['commentaire'] != '') {
$stmt = $db-> prepare("INSERT INTO commentaires (contenu,id_auteur,id_billet,date) VALUES (?, $id, ?,NOW())");
$stmt->execute([$commentaire, $id_billet]);}
header("location: detail.php?id= $id_billet ")
?>