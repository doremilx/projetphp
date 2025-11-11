<?php
require_once('connexion.php');

// Sélectionner toutes les données de la table billets, commentaires, utilisateurs
$stmt = $db->prepare('
    SELECT * FROM billets
    LEFT JOIN commentaires ON billets.id_billet = commentaires.id_billet
    LEFT JOIN utilisateurs ON commentaires.id_auteur = utilisateurs.id_utilisateur
');
$stmt->execute();
$resultats = $stmt->fetchAll(PDO::FETCH_ASSOC);

// Affichage des résultats
foreach ($resultats as $valeur) {
    echo '<p><strong>Billet : </strong>' . $valeur['titre'] . '</p>';
    echo '<p><strong>Contenu du billet : </strong>' . $valeur['contenu'] . '</p>';
    echo '<p><strong>Commentaire : </strong>' . $valeur['contenu'] . '</p>';
    echo '<p><strong>Nom de l\'auteur du commentaire : </strong>' . $valeur['nom'] . '</p>';
    echo '<hr>';
}

echo '<a href="index.php"> <button>Retour accueil</button></a>';
?>
