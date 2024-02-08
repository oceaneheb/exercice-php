<?php
session_start();
//CONTROLLER DE LA PAGE ACCUEIL : faire l'intermédiaire entre le MODEL et la VUE. Prendre les Décision if... else. Dire à la Vue comment afficher les infos.


//J'importe les ressources dont j'ai besoin
include './model/modelUser.php';


$formCo = "<h1>Accueil</h1>"; //-> Affiche Accueil à la place du Formulaire de Connexion si on est Connecté
$message = "";
$formSign = "";
$messageSign = "";


//-> Affiche le Formulaire de Connexion si on n'est pas Connecté
if(!isset($_SESSION['connected'])){
    $formCo = '<form action="" method="post">
    <h2>Connexion</h2>
    <input type="text" name="login" placeholder="Votre Login">
    <input type="password" name="password" placeholder="Votre Mot de Passe">
    <input type="submit" name="submit" value="Se Connecter">
    </form>';

    $formSign = '<form action="" method="post">
    <h2>Inscription</h2>
    <input type="text" name="nameSign" placeholder="Votre Nom">
    <input type="text" name="firstnameSign" placeholder="Votre Prénom">
    <input type="text" name="loginSign" placeholder="Votre Login">
    <input type="password" name="passwordSign" placeholder="Votre Mot de Passe">
    <input type="password" name="passwordSignVerify" placeholder="Retapper Votre Mot de Passe">
    <input type="submit" name="submitSign" value="S\'Inscrire">
    </form>';
}

//ETAPE 4 Du Diagramme de Sequence : Vérification des infos envoyées par le formulaire
if(isset($_POST['submit'])){
    //Vérification du remplissage des champs
    if(isset($_POST['login']) and !empty($_POST['login'])
        and isset($_POST['password']) and !empty($_POST['password'])){
            //Nettoyer les datas
            $login = htmlentities(strip_tags(stripslashes(trim($_POST['login']))));
            $password = htmlentities(strip_tags(stripslashes(trim($_POST['password']))));

            //Validation de format de data
            //-> je n'attends que des string non formatées, donc pas de vérification

            //Instancier l'objet user
            $user = new ModelUser();

            //Assigner mes données aux Attributs
            $user->setLogin($login)->setPassword($password);

            //J'appel le Model pour récupérer mon utilisateur
            $data = $user->loginUser();

        //Test la réponse renvoyer par le Model
        if(gettype($data) == "object"){
            $message = $data->getMessage();
        }else{

            //ETAPE 8 Du Diagramme de Sequence : vérifier l'existence de l'utilidateur, et vérifier le mot de passe
            if(!empty($data) and password_verify($user->getPassword(),$data[0]['mdp_user'])){
            
                //ETAPE 9 Du Diagramme de Sequence : enregistrer les datas en $_SESSION
                $_SESSION['id']=$data[0]['id_user'];
                $_SESSION['name']=$data[0]['name_user'];
                $_SESSION['firstname']=$data[0]['first_name_user'];
                $_SESSION['login']=$data[0]['login_user'];
                $_SESSION['connected']=true;

                //ETAPE 10 Du Diagramme de Sequence : message de confirmation
                $message = 'Vous êtes bien connecté.';

                //Redirection vers index.php pour rafraîchir la page
                header('refresh:0');

            }else{
                $message = "Utilisateur ou Mot de Passe incorrecte.";
            }
        }

    }else{
        $message = "Veuillez remplir tous les champs.";
    }
}


//ENREGISTREMENT D'UN UTILISATEUR
if(isset($_POST['submitSign'])){
    //Vérification du remplissage des champs
    if(isset($_POST['loginSign']) and !empty($_POST['loginSign'])
        and isset($_POST['passwordSign']) and !empty($_POST['passwordSign'])
        and isset($_POST['nameSign']) and !empty($_POST['nameSign'])
        and isset($_POST['firstnameSign']) and !empty($_POST['firstnameSign'])
        and isset($_POST['passwordSignVerify']) and !empty($_POST['passwordSignVerify'])){
            
            //Nettoyer mes champs
            $nom = htmlentities(strip_tags(stripslashes(trim($_POST['nameSign']))));
            $prenom = htmlentities(strip_tags(stripslashes(trim($_POST['firstnameSign']))));
            $login = htmlentities(strip_tags(stripslashes(trim($_POST['loginSign']))));
            $password = htmlentities(strip_tags(stripslashes(trim($_POST['passwordSign']))));
            $passwordVerify = htmlentities(strip_tags(stripslashes(trim($_POST['passwordSignVerify']))));

            //Vérification de la correspondance des 2 mots de passe
            if($password === $passwordVerify){
                //Hashage du mot de passe
                $password = password_hash($password,PASSWORD_BCRYPT);

                //Instancier l'objet user
                $user = new ModelUser();

                //Assigner les données aux Attributs
                $user->setName($nom)->setFirstName($prenom)->setLogin($login)->setPassword($password);

                //J'appel la fonction d'enregistrement du model, je stocke son message de retour
                $messageSign = $user->signInUser();
            }
    }

}

include './controller/controlerNav.php';

include './vue/header.php'; //-> affiche la header
include './vue/nav.php'; //-> affiche la navbar
include './vue/vueAccueil.php'
?>
