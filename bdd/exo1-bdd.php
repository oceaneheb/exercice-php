<?php 
if(isset($_POST['nom_article']) && isset($_POST['contenu_article'])) {
    
    //Nettoyer les données
    $name = htmlentities(strip_tags(stripslashes(trim($_POST['nom_article']))));
    $content = htmlentities(strip_tags(stripslashes(trim($_POST['contenu_article']))));

    //Connexion à la BDD
    $bdd = new PDO('mysql:host=localhost;dbname=articles', 'root','', array(PDO::ATTR_ERRMODE=>PDO::ERRMODE_EXCEPTION)); /*root : utilisateur / '' : mot de passe du root*/

    try{
        //Stocker dans une variable $rek la requête à exécuter
        $req=$bdd->prepare("INSERT INTO article (nom_article, contenu_article) VALUES(?,?)");
        
        $req->bindParam(1,$name,PDO::PARAM_STR);
        $req->bindParam(2,$content,PDO::PARAM_STR);

        $req->execute();

        echo 'L\'article a été enregistré avec succès';

    } catch(Exception $error) {
        die('Erreur :'.$error->getMessage());
    }

    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <form action="exo1-bdd.php" method="post">
        <input type="text" placeholder="Nom de l'article" name="nom_article">
        <input type="text" placeholder="Contenu de l'article" name="contenu_article">
        <input type="submit" value="Ajouter">
    </form>
</body>
</html>