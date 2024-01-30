<?php 
$number1 = $_GET['firstnumber'];
$number2 = $_GET['secondnumber'];

$sum = $number1 + $number2;
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <form action="formulaire.php" method="get">
        <div>
            <label for="firstnumber">Nombre 1</label>
            <input type="number" id="firstnumber" name="firstnumber">
        </div>
        <div>
            <label for="secondnumber">Nombre 2</label>
            <input type="number" id="secondnumber" name="secondnumber">
        </div>
        <input type="submit" value="Calculer la somme">
    </form>

    <p>La somme de <?= $number1 ?> + <?= $number2 ?> est égale à <?= $sum ?></p>
</body>
</html>