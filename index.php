

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    <head>
        <h1>Blog</h1>
        <h2>Venez discuter et parler de tout !</h2>
        <a href="login.php">Connexion / Inscription</a>
        <?php 
session_start();
if (isset($_SESSION['login'])) {
    $login = $_SESSION['login'];
    echo "<p>Connecté en tant que : " . ($login) . "</p>";
    echo "<a href='logout.php'>Se déconnecter</a><br><br>";
} else {
    $login = null;
}
?>
    </head>

    <section>
        <div class='conteneurPost'>
<?php 
require_once ('connexion.php');
$stmt = $db->prepare('SELECT * FROM billets');
$stmt->execute();
$resultats = $stmt->fetchAll(PDO::FETCH_ASSOC);
foreach ($resultats as $valeur) {
    echo "<div class='post'>";
    echo "<h3>" .$valeur['date'] . " " . ($valeur['titre']) . "</h3>";
    echo "<p>" . $valeur['contenu'] . "</p>";
    echo "</div>";
}


?>

</div>


    </section>
</body>
</html>