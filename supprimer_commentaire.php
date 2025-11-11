<?php
session_start();
include 'connexion.php';
$id_billet = $_POST['id_billet'];
// Autoriser seulement l'admin
if (isset($_SESSION['login']) && $_SESSION['login'] == "remi@mail.com") {

    if (isset($_POST['id_commentaire'])) {

        $id = $_POST['id_commentaire'];

        $stmt = $db->prepare("DELETE FROM commentaires WHERE id_commentaire = ?");
        $stmt->execute([$id]);

        header("Location: detail.php?id=" . $id_billet);
exit();
    }

} else {
    echo "Accès refusé.";
}