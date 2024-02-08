<?php
session_start();

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

// -------------- SE CONNECTER AU COMPTE ---------------------

if(isset($_POST['submit'])){

    //Vérifier l'existence des datas
    if(isset($_POST['login']) and !empty($_POST['login'])
        and isset($_POST['password']) and !empty($_POST['password'])){

            //Nettoyer les datas
            $login = htmlentities(strip_tags(stripslashes(trim($_POST['login']))));
            $password = htmlentities(strip_tags(stripslashes(trim($_POST['password']))));

            //Instancier l'objet user
            $user = new ModelUser(null, null, null, $login, $password);

            // Si j'utilise les get et set à la place du constructeur
            //$user->setLogin($login)->setMdpUser($password);

            //J'appel le Model pour récupérer mon utilisateur
            $data = $user->loginUser();

            //Test la réponse renvoyer par le Model
            if(gettype($data) == "object"){
                $message = $data->getMessage();
            }else{

            //Vérifier l'existence de l'utilidateur et le mot de passe
            if(!empty($data) and $password === $data[0]['mdp_user']){
            
                //Enregistrer les datas en $_SESSION 
                $_SESSION['id']=$data[0]['id_user'];
                $_SESSION['name']=$data[0]['name_user'];
                $_SESSION['firstname']=$data[0]['first_name_user'];
                $_SESSION['login']=$data[0]['login_user'];
                $_SESSION['connected']=true;

                //Message de confirmation
                $message = 'Vous êtes bien connecté.';

                //Redirection vers index.php pour rafraîchir la page
                header('refresh:0');

                
            } else {
                $message = "Login ou Mot de Passe incorrect.";
            }
        }

    } else {
        $message = "Veuillez remplir tous les champs.";
    }
}

// --------------- CREER UN COMPTE ----------------------

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
        
        $newUser = new ModelUser(null, $name_user, $first_name_user, $login_user, $mdp_user);

        // ------- Utiliser les lignes du dessous si on ne souhaite pas créer de constructeur ----------
        // $newUser->setNameUser($name_user);
        // $newUser->setFirstNameUser($first_name_user);
        // $newUser->setLoginUser($login_user);
        // $newUser->setMdpUser($mdp_user);

        $newUser->createAccount();
        $data = $newUser;
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
