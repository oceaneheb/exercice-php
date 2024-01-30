<?php 

$price = $_POST['price'];
$quantity = $_POST['quantity'];
$tva = $_POST['tva'];

$prixTTC = ($price + ($price * ($tva / 100))) * $quantity;
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <form action="exo2-formulaire.php" method="post">
        <div>
            <label for="price">Prix HT :</label>
            <input type="number" id="price" name="price" step="0.01">
        </div>
        <div>
            <label for="quantity">Nombre d'articles :</label>
            <input type="number" id="quantity" name="quantity" step="1"> <!--step: incrémentation du nombre-->
        </div>
        <div>
            <label for="tva">Taux de TVA :</label>
            <input type="number" id="tva" name="tva" step="0.01">
        </div>
        <input type="submit" value="Calculer le prix de l'article">
    </form>

    <p>Le prix TTC est égal à <?= $prixTTC ?> </p>

</body>
</html>