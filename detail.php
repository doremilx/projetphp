<?php
include 'connexion.php';
session_start();

$id_billet = $_GET['id'];

$stmt = $db->prepare('SELECT * FROM billets WHERE id_billet = ?');
$stmt->execute([$id_billet]);
$resultats = $stmt->fetch(PDO::FETCH_ASSOC);

echo "<img src='" . $resultats['photo_billet'] . "' width='50%' />";
echo "<h2>" . $resultats['titre'] . "</h2>";    
echo "<p>" . $resultats['contenu'] . "</p>";
echo "<p>Date de publication : " . $resultats['date'] . "</p>";




?>
<button class="activeCommentaire">Afficher les commentaires</button>
<div class='BlocCommentaire'>
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
 
    /* pour suppression des commentaires quand on est admin */
    if (isset($_SESSION['login']) && $_SESSION['login'] == "remi@mail.com") {
        echo '
            <form action="supprimer_commentaire.php" method="post" style="display:inline;">
                <input type="hidden" name="id_commentaire" value="' . $valeur['id_commentaire'] . '">
                <input type="hidden" name="id_billet" value="' . $id_billet . '">
                <button type="submit" onclick="return confirm(\'Supprimer ce commentaire ?\')" style="color:red; background:none; border:none; cursor:pointer;">
                    Supprimer ce commentaire
                </button>
            </form>
        ';
    }

    
    
}
echo '</div>';
echo'<script src="script.js"> </script>';
?>