<?php 
$name_user = "";
$first_name_user = "";
$login_user = "";
$mdp_user = "";
$validation = "";
$profil = "";

//Vérifier si le formulaire a bien été pris en compte
if(isset($_POST['submit'])) {

    //Vérifier que les champs existent et ne sont pas vides
    if(isset($_POST['name_user']) and !empty($_POST['name_user']) and
    isset($_POST['first_name_user']) and !empty($_POST['first_name_user']) and
    isset($_POST['login_user']) and !empty($_POST['login_user']) and
    isset($_POST['mdp_user']) and !empty($_POST['mdp_user'])) {

        //Nettoyer les données pour obtenir le bon format
        $name_user = htmlentities(strip_tags(stripslashes(trim($_POST['name_user']))));
        $first_name_user = htmlentities(strip_tags(stripslashes(trim($_POST['first_name_user']))));
        $login_user = htmlentities(strip_tags(stripslashes(trim($_POST['login_user']))));
        $mdp_user = htmlentities(strip_tags(stripslashes(trim($_POST['mdp_user']))));
    
        // CREER DES UTILISATEUR DANS LA BDD

        try {

            //Connexion à la BDD MySQL
            $bdd = new PDO('mysql:host=localhost;dbname=task', 'root', '',array(PDO::ATTR_ERRMODE=>PDO::ERRMODE_EXCEPTION));

            //Stocker dans une variable la requête à exécuter
            $req=$bdd->prepare("INSERT INTO user (name_user,first_name_user,login_user,mdp_user) VALUES (?,?,?,?)");

            //Appeler Bind Param
            $req->bindParam(1,$name_user,PDO::PARAM_STR);
            $req->bindParam(2,$first_name_user,PDO::PARAM_STR);
            $req->bindParam(3,$login_user,PDO::PARAM_STR);
            $req->bindParam(4,$mdp_user,PDO::PARAM_STR);

            //Exécuter la requête 
            $req->execute();
            
            //Afficher un message si tout a fonctionné
            $validation = $name_user.' a bien été ajouté.';

        }catch(Exception $error) {
            $message1 = $error->getMessage();
        };
    }
}
        // AFFICHER LA LISTE DE TOUS LES UTILISATEURS

        try{

            $bdd = new PDO('mysql:host=localhost;dbname=task', 'root', '',array(PDO::ATTR_ERRMODE=>PDO::ERRMODE_EXCEPTION));

            $req = $bdd->prepare('SELECT user.name_user, user.first_name_user, user.login_user, user.mdp_user FROM user');

            $req->execute();

            $result = $req->fetchAll(PDO::FETCH_ASSOC);

            // print_r($result);

            //Utiliser le BUFFER
            ob_start();
            foreach($result as $user) { 
            
?>
        
            <div>
                <h2><?= $user['name_user']?> <?= $user['first_name_user'] ?></h2>
                <p><?= $user['login_user']?></p>
                <p><?= $user['mdp_user']?></p>
            </div>
                
<?php
            }

            $profil =  ob_get_clean();


        }catch(Exception $error) {
            $profil = $error->getMessage();
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
    <form action="index.php" method="post">
        <input type="text" name="name_user" placeholder="Nom">
        <input type="text" name="first_name_user" placeholder="Prénom">
        <input type="text" name="login_user" placeholder="Nom d'utilisateur">
        <input type="password" name="mdp_user" placeholder="Mot de passe">
        <input type="submit" name="submit" value="Ajouter">
    </form>

    <p><?= $validation ?></p>

    <div>
        <h2><?= $name_user?> <?= $first_name_user ?></h2>
        <p><?= $login_user?></p>
        <p><?= $mdp_user?></p>
    </div>

    <div><?= $profil ?></div>

</body>
</html>