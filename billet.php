<?php
include 'connexion.php';
$titre = $_POST['titre'];
$date = $_POST['date'];
$contenu = $_POST['contenu'];


      if (
    isset($_POST['titre'], $_POST['date'], $_POST['contenu'], $_FILES['photo_billet'])
    && !empty($_POST['titre'])
    && !empty($_POST['date'])
    && !empty($_POST['contenu'])
    && $_FILES['photo_billet']['error'] === 0
) {

            $dossier = "photos_billets/";
            $nomFichier = basename($_FILES['photo_billet']['name']);
            $chemin = $dossier . $nomFichier;
            move_uploaded_file($_FILES['photo_billet']['tmp_name'], $chemin);
            $photo_billet = $chemin;


            $stmt = $db-> prepare("INSERT INTO billets (date, titre, contenu,photo_billet, id_auteur) VALUES (?,?,?,?,1)");
$stmt->execute([$date, $titre, $contenu, $photo_billet]);




        }

header("Location: index.php");
/* $stmt = $db-> prepare("INSERT INTO billets (date, titre, contenu,photo_billet, id_auteur) VALUES (?,?,?,$photo_billet,1)");
$stmt->execute([$date, $titre, $contenu, $photo_billet]);
 */

?>