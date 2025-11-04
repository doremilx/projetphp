<?php session_start(); ?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    <header>
        <h1>Blog</h1>
        <h2>Venez discuter et parler de tout !</h2>
        <?php 
        if (!isset($_SESSION['login'])){
        echo'<a href="login.php">Connexion / Inscription</a>';};
        ?>
        <?php 

if (isset($_SESSION['login'])) {
    $login = $_SESSION['login'];
    echo "<p>Connecté en tant que : " . ($login) . "</p>";
    echo "<a href='logout.php'>Se déconnecter</a><br><br>";

    if ($login == 'remi@mail.com'){ 
        echo '<h3>Session Admin</h3>';
        echo 
    '<form action="billet.php" method="post">
    <label for="titre">titre</label>
    <input type="text" id="titre" name="titre">
    <br>
    <label for="date">date de publication</label>
    <input type="date" id="date" name="date">
    <br>
    <label for="contenu">Contenu du billet</label>
    <input type="textarea" id="contenu" name="contenu">
    <br>
    <input type="submit" name="valider">

</form>';
    };
   
} else {
    $login = null;
}
?>
    </header>

    <section>
        <div class='conteneurPost'>
<?php 
require_once ('connexion.php');
$stmt = $db->prepare('SELECT * FROM billets');
$stmt->execute();
$resultats = $stmt->fetchAll(PDO::FETCH_ASSOC);
foreach ($resultats as $valeur) {
    echo "<div class='post'>";
    echo "<h3>" .$valeur['titre'] . " <br>" . ($valeur['date']) . "</h3>";
    echo "<p>" . $valeur['contenu'] . "</p>";
    echo "<a href='detail.php?id=" . $valeur['id_billet'] . "'>Voir les détails</a>";
    echo "</div>";
}


?>

</div>


    </section>
</body>
</html>