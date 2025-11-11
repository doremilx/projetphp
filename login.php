<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Compte</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f0f0f0;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            margin: 0;
        }
        .container {
            background-color: white;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            width: 300px;
        }
        h1 {
            text-align: center;
            margin-bottom: 20px;
        }
        form {
            display: flex;
            flex-direction: column;
        }
        input[type="text"], input[type="password"] {
            margin-bottom: 10px;
            padding: 10px;
            border: 1px solid #ccc;
            border-radius: 4px;
        }
        input[type="submit"], button {
            padding: 10px;
            background-color: rgb(91, 87, 217);
            color: white;
            border: none;
            border-radius: 4px;
            cursor: pointer;
        }
        input[type="submit"]:hover, button:hover {
            background-color: rgba(52, 49, 135, 1);
        }
    </style>
</head>
<body>
<?php
include 'connexion.php';
?>


<div class="container">
<h1>Connexion</h1>
    <form action="traitelogin.php" method="post">
        <input type="text" name="login" placeholder="Login">
        <input type="password" name="password" placeholder="Password">
        <input type="submit" value="Se connecter">
    </form>

    <h1>Créer un compte</h1>
    <form action="creer_compte.php" method="POST" enctype="multipart/form-data">
        <input type="text" name="nom" id="nom" placeholder="Nom">
        <input type="text" name="prenom" id="prenom" placeholder="Prénom">
        <input type="text" name="login" id="login" placeholder="Login">
        <div style="display:flex; align-items:center; gap:5px;">
    <input type="password" name="motdepasse" id="motdepasse" placeholder="Mot de passe">
    <button type="button" id="toggleBtn" onclick="togglePassword()">👁️</button>
</div>
        <label for="photo">Photo de profil</label>
        <input type="file" name="photo" id="photo">
        <br>
        <button type="submit">Créer un compte</button>
    </form></div>
</body>
<script>
    function togglePassword() {
    let input = document.getElementById("motdepasse");
    let btn = document.getElementById("toggleBtn");

    if (input.type === "password") {
        input.type = "text";
        btn.textContent = "🙈";
    } else {
        input.type = "password";
        btn.textContent = "👁️";
    }
}

</script>
</html>