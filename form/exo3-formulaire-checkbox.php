<?php 

$list = "";

    if(isset($_POST['submit'])) {
        echo 'test1';
        if(isset($_POST['list']) and !empty($_POST['list'])) {
            echo 'test2';
            foreach($_POST['list'] as $favori) { 
                $sanitize = htmlentities(strip_tags(stripslashes(trim($favori))));
                $list = $list."<li>".$sanitize."</li>";
            }
        }
        
    };
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <form action="exo3-formulaire-checkbox.php" method="post">
        <label for="favoris">Choisissez vos favoris :</label>
        <div>
            <p><input type="checkbox" name="list[]" value="fantastique"> Fantastique</p>
            <p><input type="checkbox" name="list[]" value="comedie"> Comédie</p>
            <p><input type="checkbox" name="list[]" value="action"> Action</p>
            <p><input type="checkbox" name="list[]" value="romance"> Romance</p>
        </div>
        <input type="submit" name="submit" value="Envoyer">
    </form>

    <ul><?= $list ?></ul>
</body>
</html>