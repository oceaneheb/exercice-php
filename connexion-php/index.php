<?php 

$message = "";

session_start(); //activer la super globale SESSION

//Vérifier si le formulaire est bien soumis
if(isset($_POST['submit'])) {

    //Vérifier que les champs son bien remplis et non vides
    if(isset($_POST['login_user']) and !empty($_POST['login_user']) and isset($_POST['login_user']) and !empty($_POST['login_user'])) {

        //Nettoyer les données par mesure de sécurité
        $login_user = htmlentities(strip_tags(stripslashes(trim($_POST['login_user']))));
        $mdp_user = htmlentities(strip_tags(stripslashes(trim($_POST['mdp_user']))));

        //Validation de format de data 
        //-> Je n'attends que des string non formatées donc pas de validation
    
        //Demander si l'utilisateur existe à la BDD
        try {

            //Connexion à la BDD
            $bdd = new PDO('mysql:host=localhost;dbname=task', 'root', '',array(PDO::ATTR_ERRMODE=>PDO::ERRMODE_EXCEPTION));

            //Préparer la reqûete de récupération de données
            $req = $bdd->prepare('SELECT * FROM user WHERE login_user = ?');

            $req->bindParam(1,$login_user,PDO::PARAM_STR);

            // $recupUser->execute(array($login_user));
            $req->execute();

            //Récupérer la réponse de la BDD
            $data = $req->fetch(PDO::FETCH_ASSOC);

            //Vérifier l'existence de l'utilisateur et le mdp
            //Correction Yoann
            if (!empty($data) and isset($data[0]['mdp_user']) and password_verify($mdp_user,$data[0]['mdp_user'])) {
                
                //Enregistrer les datas dans la super global
                $_SESSION['id'] = $data[0]['id_user'];
                $_SESSION['name'] = $data[0]['name_user'];
                $_SESSION['firstname'] = $data[0]['first_name_user'];
                $_SESSION['login_user'] = $data[0]['login_user'];
                $_SESSION['mdp_user'] = $data[0]['mdp_user'];

                //Afficher un message de confirmation
                $message = "Vous êtes bien connecté";
            } else {    
                $message = "Utilisateur ou mot de passe incorect";
            }

            // if($req->rowCount() > 0) {
            //     $_SESSION['login_user'] = $login_user;
            //     $_SESSION['mdp_user'] = $mdp_user;
            //     $_SESSION['id_user'] = $req->fetch()['id_user'];
            //     // echo $_SESSION['id_user'];
            //     header('Location: compte.php');

            // } else {
            //     echo "Votre mot de passe ou pseudo est incorrect";
            // }

        } catch(Exception $error) {
            $message = $error->getMessage();
        }
    } else {
        $message = "Veuillez compléter tous les champs";
    }
}

?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Formulaire de connexion</title>
</head>
<body>
    <main>
        <form action="index.php" method="post">
            <input type="text" name="login_user" placeholder="Nom d'utilisateur">
            <input type="password" name="mdp_user" placeholder="Mot de passe">
            <input type="submit" name="submit" value="Se connecter">
        </form>

        <p><?= $message ?></p>
    </main>
</body>
</html>