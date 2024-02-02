<?php 
//Activer la super global $_SESSION
session_start();

echo $_SESSION['login_user'];

//Détruire les données de la super global -> Déconnexion
session_destroy();

//Redirection vers la page index.php
header('Location: ./index.php');
// exit;

?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <main>
        <h1>Bonjour <?=$_SESSION['login_user'] ?> !</h1>
        <p>Prénom : <?= $_SESSION['name'] ?></p>
    </main>
    <a href="./index.php">Déconnexion</a>
</body>
</html>