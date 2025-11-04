<?php
include 'connexion.php';
session_start();

$id_billet = $_GET['id'];

$stmt = $db->prepare('SELECT * FROM billets WHERE id_billet = ?');
$stmt->execute([$id_billet]);
$resultats = $stmt->fetch(PDO::FETCH_ASSOC);


echo "<h2>" . $resultats['titre'] . "</h2>";    
echo "<p>" . $resultats['contenu'] . "</p>";
echo "<p>Date de publication : " . $resultats['date'] . "</p>";



?>

<h2>Commentaires :</h2>

<?php 
$stmt = $db->prepare('SELECT * FROM commentaires JOIN utilisateurs ON utilisateurs.id_utilisateur = commentaires.id_auteur WHERE id_billet = ?');
$stmt->execute([$id_billet]);
$resultats = $stmt->fetchAll(PDO::FETCH_ASSOC);


if (isset($_SESSION['login'])) {
echo '<h2> Ecrire un commentaire </h2>';
 $login = $_SESSION['login'];
    echo "<p>Connecté en tant que : " . ($login) . "</p>";

    echo '<form action="commentaire.php" method="post">
    <input type="hidden" name="id_billet" value="'. $id_billet .'" >
    <label for="contenu_commentaire">Commentaire</label>
    <br>
    <textarea name="commentaire" id="contenu_commentaire" rows="10" cols="50" placeholder="Vous pouvez écrire ici"></textarea>
    <br>
    <input type="submit" name="valider">
</form>';
}


foreach ($resultats as $valeur) {
    echo "<div class='commentaire'>";
    echo "<p><strong>" . $valeur['nom'] . " " . $valeur['prenom'] . " " . "(" . $valeur['login'] . ")" .  "</strong> a écrit :</p>";
    echo "<p>" . $valeur['contenu'] . "</p>";
    echo "<p>Date : " . $valeur['date'] . "</p>";
    echo "</div>";
}
