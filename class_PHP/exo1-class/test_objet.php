<?php

require './maison.php';

// -----------1ère méthode -----------------
$maison = new Maison('La Belle Maison',10,6,2);
$maison-> surface();

//----------- 2ème méthode -----------------
$maison2 = new Maison2();
$maison2->nom = "La Pension des Mimosas";
$maison2->longueur = 20;
$maison2->largeur = 10;

$surface = $maison2->surface2(); //inclure la variable dans une balise HTML

//------------ 3ème méthode : Utilisation des get et set -------------
// $maison3 = new Maison();
// $maison3->setNom("Les Amidoniers");
// $maison3->setLongueur(7);
// $maison3->setLargeur(3);

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <p>La maison <?= $maison2->nom ?> possède une superficie de <?= $surface ?> m2</p>
</body>
</html>