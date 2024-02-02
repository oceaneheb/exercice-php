<?php
/* Les variables */

$maVariable = 'Ma Première Variable';
// $maVariable = 1;
// $maVariable = [0,1];
echo($maVariable); //afficher dans la console et ouvrir sur Google : localhost/algo

/* Les fonctions */
function affichage($string = 'Hello world') {
    return $string;
}
$uneVariable = affichage();

if(!$var) {
    echo 'true';
}else {
    echo 'false';
}

/* Opérateurs logiques : OR et XOR */
/*XOR : soit a = vrai ou b=vrai mais impossible les 2 en même temps*/

/* Switch */
$value = 1;
switch($value) {
    case 1 : 
        echo '<br>Est égale à 1';
        break;
    case 2 :
        echo '<br>Est égale à 2';
        break;
    default : 
        echo '<br>Valeur par défaut';
}

/* Les boucles : foreach s'applique sur les tableaux et objets */
$varC = [1,2,3,4,5];
$varD = [
    'prénom'=>'Océane',
    'age'=>24
];
foreach($varD as $int) {
    echo '<br>'.$int;
}

/* Traiter un tableau dans un tableau */
$varE = [[1,2,3], [4,5,6], [7,8,9]]; 
foreach($varE as $tab) {
    foreach($tab as $row) {
        echo '<br>'.$row;
    };
}

/* Tableaux */
$tab1 = [];

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <h1>Ma première page</h1>
    <?php echo($maVariable); ?>

    <a href= <?php echo 'https://www.google.com' ?>>Mon lien</a>

    <p><?php echo gettype($maVariable) ?></p>

    <h2>Concaténation</h2>
    <p><?php echo "Ma concat 1 : $maVariable" ?></p>
    <p><?php echo 'Ma concat 2 : '.$maVariable ?></p>
    <p><?php echo "Ma concat 3 : {$maVariable}" ?></p>

</body>
</html>

<!--Le typage undefined n'existe pas en PHP
Documentation officielle : php.net
-->

