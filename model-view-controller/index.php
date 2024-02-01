<?php
session_start();
//CONTROLLER DE LA PAGE ACCUEIL : faire l'intermédiaire entre le MODEL et la VUE. Prendre les Décision if... else. Dire à la Vue comment afficher les infos.


//J'importe les ressources dont j'ai besoin
include './model/modelUser.php';


$formCo = "<h1>Accueil</h1>"; //-> Affiche Accueil à la place du Formulaire de Connexion si on est Connecté
$formCreateAccount = "";
$message = "";


//-> Affiche le Formulaire de Connexion si on n'est pas Connecté
if(!isset($_SESSION['connected'])){
    $formCo = '<form action="index.php" method="post">
    <h2>Connexion</h2>
    <input type="text" name="login" placeholder="Votre Login">
    <input type="password" name="password" placeholder="Votre Mot de Passe">
    <input type="submit" name="submit" value="Se Connecter">
    </form>';
}

//Affiche le Formulaire de création de compte si on est pas connecté
if(!isset($_SESSION['connected'])) {
    $formCreateAccount = '<form action="index.php" method="post">
    <h2>Inscription</h2>
    <input type="text" name="name_user" placeholder="Nom">
    <input type="text" name="first_name_user" placeholder="Prénom">
    <input type="text" name="login_user" placeholder="Nom utilisateur">
    <input type="password" name="mdp_user" placeholder="Mot de passe">
    <input type="submit" name="submitCreate" value="Créer mon compte">
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

            //J'appel le Model pour récupérer mon utilisateur
            $data = loginUser($login);

        //Test la réponse renvoyer par le Model
        if(gettype($data) == "object"){
            $message = $data->getMessage();
        }else{

            //ETAPE 8 Du Diagramme de Sequence : vérifier l'existence de l'utilidateur, et vérifier le mot de passe
            // if(!empty($data) and password_verify($password,$data[0]['mdp_user'])){
            if(!empty($data)){
            
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

if(isset($_POST['submitCreate'])) {
    
    if(isset($_POST['name_user']) and !empty($_POST['name_user']) and
    isset($_POST['first_name_user']) and !empty($_POST['first_name_user']) and
    isset($_POST['login_user']) and !empty($_POST['login_user']) and
    isset($_POST['mdp_user']) and !empty($_POST['mdp_user'])) {
        

        //Nettoyer les données pour obtenir le bon format
        $name_user = htmlentities(strip_tags(stripslashes(trim($_POST['name_user']))));
        $first_name_user = htmlentities(strip_tags(stripslashes(trim($_POST['first_name_user']))));
        $login_user = htmlentities(strip_tags(stripslashes(trim($_POST['login_user']))));
        $mdp_user = htmlentities(strip_tags(stripslashes(trim($_POST['mdp_user']))));
        
        $data = createAccount($name_user,$first_name_user,$login_user,$mdp_user,$message);
        var_dump($data);

    } else {
        $message = "Veuillez remplir tous les champs.";
    }
}

include './controlerNav.php';

include './vue/header.php'; //-> affiche la navbar
include './vue/nav.php'; //-> affiche la navbar
include './vue/vueAccueil.php'
?>
